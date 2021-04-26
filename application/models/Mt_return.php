<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_return extends CI_Model
{
	var $table = 't_return';
	var $table_id = 'id_return';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "select * from $this->table";
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

	function viewDT($in)
	{
		$start = $in->start;
		$sqlmain = "SELECT tb.kode_dn, tb.tgl_kedatangan, td.nama nama_supplier, tc.detail, ta.* FROM (select * from t_return where deleted_at is null) ta LEFT JOIN t_dn tb on ta.id_dn = tb.id_dn LEFT JOIN (select xa.id_return, JSON_ARRAYAGG(JSON_OBJECT('id_return_detail',xa.id_return,'nama_barang',xd.nama_barang, 'kode_barang', xd.kode_barang,'quantity',xa.qty,'satuan',xd.kode_satuan_terkecil)) as detail from t_return_detail xa LEFT JOIN t_detail_dn xb on xa.id_detail_dn = xb.id_detail_dn LEFT JOIN t_detail_po xc on xb.id_detail_po = xc.id_detail_po LEFT JOIN v_sub_barang xd on xc.id_sub_barang = xd.id_sub_barang GROUP BY xa.id_return) tc on ta.id_return = tc.id_return LEFT JOIN m_suplier td on tb.id_supplier = td.id_suplier";
        $sqlmain = "select * from ($sqlmain) pa where id_return is not null ";
        if (isset($in->tglawal)) {
			$tglawal = reverseDate($in->tglawal);
			$sqlmain .= " and tanggal_return >= '$tglawal'";
		}
		if (isset($in->tglakhir)) {
			$tglakhir = reverseDate($in->tglakhir);
			$sqlmain .= " and tanggal_return <= '$tglakhir'";
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

                $item = $qty = '';
                $r->detail = a2o(json_decode(sterilizeJSON($r->detail)));
                foreach ($r->detail as $row) {
					$item .= "<p style='margin:0;padding:0;'>".$row->nama_barang."</p><small style='margin:0;padding:0;'>".$row->kode_barang."</small><br><br>";
					$qty .= "<p style='margin:0;padding:0;'>".number_format($row->quantity,2)."</p><small style='margin:0;padding:0;'>".$row->satuan."</small><br><br>";
                }
                
                $r->detailitem = $item;
                $r->detailqty = $qty;
                
                $r->status_approve = "";
                if ($r->approval_1 == 0) {
                    $r->status_approve = "<button type='button' disabled class='btn btn-default btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-hourglass'></i> Ready</button>";
                }
                if ($r->approval_1 == 1) {
                    $r->status_approve = "<button type='button' disabled class='btn btn-success btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved 1</button>";
                }
                if ($r->approval_2 == 1) {
                    $r->status_approve = "<button type='button' disabled class='btn btn-primary btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved 2</button>";
                }
				

                $r->option = "";
				if ($r->approval_1 == '0' && $r->approval_2 == '0') {
					$r->option .= '<a href="' . base_url($this->d->_controller . '/' . $this->d->_method . '/edit/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
				}
				$r->option .= ' <a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
				if ($r->approval_1 == '0' && $r->approval_2 == '0') {
					$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="' . base_url($this->d->_controller . '/' . $this->d->_method . '/delete/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
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
		$sql = $this->basesql." and ta.id_return ='$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function getDetail($id)
	{
		$sql = "SELECT tb.kode_dn, tb.tgl_kedatangan, td.nama nama_supplier, tc.detail, ta.* FROM (select * from t_return where id_return = '$id') ta LEFT JOIN t_dn tb on ta.id_dn = tb.id_dn LEFT JOIN (select xa.id_return, JSON_ARRAYAGG(JSON_OBJECT('id_return_detail',xa.id_return_detail,'nama_barang',xd.nama_barang, 'kode_barang', xd.kode_barang,'quantity',xa.qty,'qty_dn',xe.qty_dn,'satuan',xd.kode_satuan_terkecil,'keterangan',xa.keterangan)) as detail from t_return_detail xa LEFT JOIN t_detail_dn xb on xa.id_detail_dn = xb.id_detail_dn LEFT JOIN t_detail_po xc on xb.id_detail_po = xc.id_detail_po LEFT JOIN v_sub_barang xd on xc.id_sub_barang = xd.id_sub_barang LEFT JOIN t_detail_dn xe on xa.id_detail_dn = xe.id_detail_dn GROUP BY xa.id_return) tc on ta.id_return = tc.id_return LEFT JOIN m_suplier td on tb.id_supplier = td.id_suplier";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

    function create($in)
    {
        $in->created_at = $this->nowdt;
        $in->updated_at = $this->nowdt;
        $this->db->insert($this->table, $in);
        $id = $this->db->insert_id();
        return $id;
    }

    function update($in)
    {
        $in->updated_at = $this->nowdt;
        $this->db->where($this->table_id, $in->id_return);
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
	
	function generateCode($so_date)
	{
		$month = date('m', strtotime($so_date));
		$year = date('Y', strtotime($so_date));
		$res = $this->db->query("select kode_return from $this->table where tanggal_return >= '".date('Y-m-01', strtotime($so_date))."' and tanggal_return <= '".date('Y-m-t', strtotime($so_date))."' order by kode_return desc limit 1");
		$num = $res->num_rows();
		$latest_number = 1;
		if ($num > 0) {
			$index_number = '0000';
			foreach ($res->result() as $r){
				$arrnumber = explode('/', $r->kode_return);
				$index_number = $arrnumber[0];
			}
			$latest_number = intval($index_number);
			$latest_number++;
		}
		$app_setting = getAppSetting($this);
        return str_pad($latest_number, 4, '0', STR_PAD_LEFT)."/PUR-RTN-".$app_setting->kode_sbu."/".integerToRoman($month)."/".$year;
	}
}
