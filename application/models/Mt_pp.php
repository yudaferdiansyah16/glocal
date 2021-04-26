<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_pp extends CI_Model
{
	var $table = 't_pp';
	var $table_id = 'id_pp';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "select ta.*, tb.nama_bagian, tc.nama_jenis_pp, td.nama_jenis_pp_rutinitas, te.status_trans, te.status_color from $this->table ta inner join m_bagian tb on ta.id_bagian = tb.id_bagian inner join m_jenis_pp tc on ta.id_jenis_pp = tc.id_jenis_pp inner join m_jenis_pp_rutinitas td on ta.id_jenis_pp_rutinitas = td.id_jenis_pp_rutinitas inner join m_status te on ta.id_status = te.id_status where ta.deleted_at is null";
	}

	function view()
	{
		$sql = $this->basesql;
		$res = $this->db->query($sql);

		$data = array();
		foreach ($res->result() as $r){
			$data[] = $r;
		}

		return $data;
	}

	function viewDT($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = $this->basesql;
		if (isset($in->tglawal)) {
			$sqlmain .= " AND ta.tanggal_dibuat >= '".reverseDate($in->tglawal)."' ";
		}
		if (isset($in->tglakhir)) {
			$sqlmain .= " AND ta.tanggal_dibuat <= '".reverseDate($in->tglakhir)."' ";
		}
		$sql = "select * from ($sqlmain) pa";
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		$sql .= dtSort($in);
		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;

				$status = $r->status_trans;
				$color = $r->status_color;

				$r->status_approve = "";
				if ($r->flag_btl == 1) {
					$r->status_approve = "<button type='button' disabled class='btn btn-danger btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Canceled</button>";
				} else if ($r->flag_closing == 1) {
					$r->status_approve = "<button type='button' disabled class='btn btn-success btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Closed</button>";
				} else {
					if ($r->approval_1 == 0) {
						$r->status_approve = "<button type='button' disabled class='btn btn-default btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-hourglass'></i> Ready</button>";
					}
					if ($r->approval_1 == 1) {
						$r->status_approve = "<button type='button' disabled class='btn btn-success btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved 1</button>";
					}
					if ($r->approval_2 == 1) {
						$r->status_approve = "<button type='button' disabled class='btn btn-primary btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved 2</button>";
					}
				}

				$r->option='';
				if ($opt){
					if ($r->approval_1 == '0' && $r->approval_2 == '0') {
						$r->option .= '<a href="'.base_url('procurement/purchase_requisition/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					}
					$r->option .= '<a href="'.base_url('procurement/purchase_requisition/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
					if ($r->approval_1 == '0' && $r->approval_2 == '0') {
						$r->option .= '<button type="button" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url('procurement/purchase_requisition/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></button>';
					}
					$r->option .= "<a href='".base_url('procurement/purchase_requisition/print/'.$r->id_pp)."' class='btn btn-xs btn-default'><i class='fal fa-print'></i></a>";
				}
				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->draw = $in->draw;
		$k->recordsTotal = $recordsTotal;
		$k->recordsFiltered = $recordsFiltered;
		$k->data = $data;
		return $k;
	}

	function viewReporting($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = "select tb.nama_jenis_pp, tc.nama_jenis_pp_rutinitas, td.nama_bagian, te.detail, ta.* from (select * from t_pp WHERE deleted_at is null) ta LEFT JOIN m_jenis_pp tb on ta.id_jenis_pp = tb.id_jenis_pp LEFT JOIN m_jenis_pp_rutinitas tc on ta.id_jenis_pp_rutinitas = tc.id_jenis_pp_rutinitas LEFT JOIN m_bagian td on ta.id_bagian = td.id_bagian LEFT JOIN (select xa.id_pp, JSON_ARRAYAGG(JSON_OBJECT('id_pp',xa.id_pp,'id_detail_pp',xa.id_detail_pp,'id_detail_job',xa.id_detail_job,'id_sub_barang',xa.id_sub_barang,'nama_barang',xc.nama_barang,'kode_barang',xc.kode_barang,'satuan',xc.kode_satuan_terkecil,'qty',xa.qty_pp,'harga',xa.harga,'keterangan',xa.keterangan)) as detail from t_detail_pp xa LEFT JOIN (select za.id_detail_job, zb.no_job, zb.tanggal_job from t_detail_job za LEFT JOIN t_job zb on za.id_job = zb.id_job) xb on xa.id_detail_job = xb.id_detail_job LEFT JOIN v_sub_barang xc on xa.id_sub_barang = xc.id_sub_barang GROUP BY xa.id_pp) te on ta.id_pp = te.id_pp";
		$sqlmain = "select * from ($sqlmain) pa where id_pp is not null";
		if (isset($in->jenis_rutinitas)) {
			$sqlmain .= " and tb.id_jenis_pp_rutinitas = $in->jenis_rutinitas";
		}
		$sql = "select * from ($sqlmain) pa";
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		$sql .= dtSort($in);
		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;

				$r->detail = a2o(json_decode(sterilizeJSON($r->detail)));
				$item = '';
				$qty = '';
				foreach ($r->detail as $row) {
					$item .= "<p style='margin:0;padding:0;'>".$row->nama_barang."</p><small style='margin:0;padding:0;'>".$row->kode_barang."</small><br><br>";
					$qty .= "<p style='margin:0;padding:0;'>".number_format($row->qty,3)."</p><small style='margin:0;padding:0;'>".$row->satuan."</small><br><br>";
				}
				$r->item = $item;
				$r->qty = $qty;
				
				$r->status_approve = "";
				if ($r->flag_btl == 1) {
					$r->status_approve = "<button type='button' disabled class='btn btn-danger btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Canceled</button>";
				} else if ($r->flag_closing == 1) {
					$r->status_approve = "<button type='button' disabled class='btn btn-success btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Closed</button>";
				} else {
					if ($r->approval_1 == 0) {
						$r->status_approve = "<button type='button' disabled class='btn btn-default btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-hourglass'></i> Ready</button>";
					}
					if ($r->approval_1 == 1) {
						$r->status_approve = "<button type='button' disabled class='btn btn-success btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved 1</button>";
					}
					if ($r->approval_2 == 1) {
						$r->status_approve = "<button type='button' disabled class='btn btn-primary btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved 2</button>";
					}
				}

				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->draw = $in->draw;
		$k->recordsTotal = $recordsTotal;
		$k->recordsFiltered = $recordsFiltered;
		$k->data = $data;
		return $k;
	}

	function get($id)
	{
		$sql = $this->basesql." and $this->table_id='$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

    function create($in)
    {
        $in->kode_pp = $this->generateCode($in->tanggal_dibuat);
        $in->created_at = $this->nowdt;
        $in->updated_at = $this->nowdt;
        $this->db->insert($this->table, $in);
        $id = $this->db->insert_id();
        return $id;
    }

    function update($in)
    {
        $in->updated_at = $this->nowdt;
        $this->db->where($this->table_id, $in->id);
        $this->db->update($this->table, $in);
    }

    function delete($id)
    {
        $b = new stdClass();
        $b->deleted_at = $this->nowdt;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }

    function approval1($id)
    {
        $b = new stdClass();
        $b->approval_1 = 1;
        $b->id_user_approval_1 = 1;
        $b->date_approval_1 = $this->nowdt;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }

    function approval2($id)
    {
        $b = new stdClass();
        $b->approval_2 = 1;
        $b->id_user_approval_2 = 1;
        $b->date_approval_2 = $this->nowdt;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }

    function disapprove1($id)
    {
        $b = new stdClass();
        $b->approval_1 = 0;
        $b->id_user_approval_1 = 0;
        $b->date_approval_1 = $this->nowdt;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }

    function disapprove2($id)
    {
        $b = new stdClass();
        $b->approval_2 = 0;
        $b->id_user_approval_2 = 0;
        $b->date_approval_2 = $this->nowdt;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }

    function cancel($id)
    {
        $b = new stdClass();
        $b->flag_btl = 1;
        $b->id_user_btl = 1;
        $b->date_btl = $this->nowdt;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }

    function closing($id)
    {
        $b = new stdClass();
        $b->flag_closing = 1;
        $b->id_user_closing = 1;
        $b->date_closing = $this->nowdt;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }

    function generateCode($pr_date)
    {
        $month = date('m', strtotime($pr_date));
        $year = date('Y', strtotime($pr_date));
        $res = $this->db->query("select kode_pp from $this->table where tanggal_dibuat >= '".date('Y-m-01', strtotime($pr_date))."' and tanggal_dibuat <= '".date('Y-m-t', strtotime($pr_date))."' and deleted_at is null order by kode_pp desc limit 1");
        $num = $res->num_rows();
        if($num > 0 ){
            $row = $res->row();
            $last = (substr($row->kode_pp, 0, 4) * 1)+1;
        } else {
            $last = 1;
        }

        $app_setting = getAppSetting($this);
        return str_pad($last, 4, '0', STR_PAD_LEFT)."/PR-".$app_setting->kode_sbu."/".integerToRoman($month)."/".$year;
    }

	function viewppdt($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = $this->basesql;
		$sql = "select * from ($sqlmain) pa";
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		$sql .= dtSort($in);
		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;
				$r->blank = '';
				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->draw = $in->draw;
		$k->recordsTotal = $recordsTotal;
		$k->recordsFiltered = $recordsFiltered;
		$k->data = $data;

		return $k;
	}
}
