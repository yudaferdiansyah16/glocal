<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_po extends CI_Model
{
	var $table = 't_po';
	var $table_id = 'id_po';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "select ta.*, tb.nama as nama_supplier, tc.KODE_VALUTA as kode_valuta, tc.KODE_VALUTA as valuta, tc.URAIAN_VALUTA as uraian_valuta, td.harga_total from t_po ta left join m_customer_suplier tb on ta.id_supplier = tb.id_customer left join ".getdbtpb($this).".referensi_valuta tc on ta.id_valuta = tc.ID left join (select id_po, sum(harga) as harga_total from t_detail_po group by id_po) td on ta.id_po = td.id_po where ta.type_trans = 'purchase' and ta.deleted_at is null ";
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

	function viewDT($in, $opt = 'true')
	{
		$start = $in->start;
		$sqlmain = $this->basesql;
		if (isset($in->tglawal)) {
			$sqlmain .= " AND ta.tanggal_dibuat >= '".reverseDate($in->tglawal)."' ";
		}
		if (isset($in->tglakhir)) {
			$sqlmain .= " AND ta.tanggal_dibuat <= '".reverseDate($in->tglakhir)."' ";
		}
		$sql = "select * from ($sqlmain) pa order by tanggal_dibuat desc";
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		// $sql .= dtSort($in);
		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;

				$r->harga_total = number_format($r->harga_total,2);

				$r->rate = number_format($r->rate,2);

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
						$r->option .= '<a href="'.($r->type_trans == 'purchase' ? base_url('procurement/purchase_order/edit/'.$r->id_po) : base_url('distribution/sales_order/edit/'.$r->id_po)).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					}
					$r->option .= '<a href="'.($r->type_trans == 'purchase' ? base_url('procurement/purchase_order/detail/'.$r->id_po) : base_url('distribution/sales_order/detail/'.$r->id_po)).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
					if ($r->approval_1 == '0' && $r->approval_2 == '0') {
						$r->option .= '<button type="button" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.($r->type_trans == 'purchase' ? base_url('procurement/purchase_order/delete/'.$r->id_po) : base_url('distribution/sales_order/delete/'.$r->id_po)).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></button> ';
					}
					$r->option .= "<a href='".base_url('procurement/purchase_order/print/'.$r->id_po)."' class='btn btn-xs btn-default'><i class='fal fa-print'></i></a>";
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

	function viewReporting($in, $opt = 'true')
	{
		$start = $in->start;
		$sqlmain = "select ta.*, te.KODE_VALUTA as kode_valuta,  td.KODE_SATUAN as satuan, tb.kode_barang, tb.nama_barang, tc.nama as nama_supplier from ( select xb.kode_po, xb.type_trans, xb.id_tipe_sales, xb.tanggal_dibuat, xb.tanggal_dibutuhkan, xb.id_supplier, xb.id_valuta, xb.rate, xb.down_payment, xb.diskon, xb.pajak, xb.pph, xb.biaya_kirim, xb.catatan_dibutuhkan, xb.catatan_po, xb.po_buyer, xb.id_status, xb.approval_1, xb.approval_2, xb.id_user_approval_1, xb.id_user_approval_2, xb.date_approval_1, xb.date_approval_2, xb.date_closing, xb.id_user_closing, xb.flag_closing, xb.flag_edit, xb.flag_btl, xb.kode_sbu, xb.id_user_btl, xb.btl_date, xa.* from t_detail_po xa inner join t_po xb on xa.id_po = xb.id_po where xb.type_trans = 'purchase' ) ta inner join m_sub_barang tb on ta.id_sub_barang = tb.id_sub_barang left join m_suplier tc on ta.id_supplier = tc.id_suplier left join ".getdbtpb($this).".referensi_satuan td on ta.id_satuan = td.ID inner join ".getdbtpb($this).".referensi_valuta te on ta.id_valuta = te.ID where ta.deleted_at is null";
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
			$c = 0;
			$temp = '';
			foreach ($res->result() as $r){
				if ($temp == $r->kode_po) {
					$c++;
					$temp = $r->kode_po;
				} else {
					$c = 1;
					$temp = $r->kode_po;
				}
				$r->no = $c;

				$qty = number_format($r->qty_po,3);
				$satuan = $r->satuan;
				$harga = number_format($r->harga,2);

				$r->qty_po = "<p style='margin: 0;padding: 0'>$qty</p><small style='margin: 0;padding: 0'>$satuan</small>";
				$r->barang = "<p style='margin: 0;padding: 0'>$r->nama_barang</p><small style='margin: 0;padding: 0'>$r->kode_barang</small>";

				$r->valuta = "<p style='margin: 0;padding: 0'>$r->rate</p>";
				$harga = "<p style='margin: 0;padding: 0'>$harga</p><small style='margin: 0;padding: 0'>$r->kode_valuta</small>";
				$r->harga = $harga;

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

	function viewDTDetail($in)
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
		$sql = $this->basesql." and ta.$this->table_id='$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

    function create($in)
    {
    	$in->kode_po = $this->generateCode($in->tanggal_dibuat);
        $in->created_at = $this->nowdt;
        $in->updated_at = $this->nowdt;
        $this->db->insert($this->table, $in);
        $id = $this->db->insert_id();
        return $id;
    }

    function update($in)
    {
        $in->updated_at = $this->nowdt;
        $this->db->where($this->table_id, $in->{$this->table_id});
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
		$b->btl_date = $this->nowdt;
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

    function generateCode($po_date)
    {
        $month = date('m', strtotime($po_date));
        $year = date('Y', strtotime($po_date));
        $res = $this->db->query("select kode_po from $this->table where type_trans='purchase' and tanggal_dibuat >= '".date('Y-m-01', strtotime($po_date))."' and tanggal_dibuat <= '".date('Y-m-t', strtotime($po_date))."' order by kode_po desc, tanggal_dibuat desc limit 1");
        $num = $res->num_rows();
        if($num > 0 ){
            $row = $res->row();
            $last = (substr($row->kode_po, 0, 4) * 1)+1;
        } else {
            $last = 1;
        }

        $app_setting = getAppSetting($this);
        return str_pad($last, 4, '0', STR_PAD_LEFT)."/PO-".$app_setting->kode_sbu."/".integerToRoman($month)."/".$year;
    }

	function viewplanningstuffingdt($in, $opt = true)
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
				if($opt){
					$r->option = '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
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
}
