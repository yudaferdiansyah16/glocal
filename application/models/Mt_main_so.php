<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_main_so extends CI_Model
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
		$this->basesql = "select ta.*, tc.nama as nama_supplier, td.KODE_VALUTA as kode_valuta, td.URAIAN_VALUTA as uraian_valuta, te.nama_tipe_sales, tb.amount from $this->table as ta left join (select id_po, sum(harga * qty_po) as amount from t_detail_po group by id_po) as tb on tb.id_po = ta.id_po left join m_customer_suplier as tc on tc.id_customer = ta.id_supplier left join ".getdbtpb($this).".referensi_valuta as td ON td.id = ta.id_valuta left join m_tipe_sales te on te.id_tipe_sales = ta.id_tipe_sales where ta.type_trans = 'main_so' and ta.deleted_at is null";
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
		$sqlmain = $this->basesql;
		if(isset($in->is_approved)){
			$sqlmain .=" and ta.approval_1='1' and ta.approval_2='1' ";
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
				$r->amount = $r->kode_valuta." ".number_format($r->amount, 2);
				$r->status_approve = "";
				if ($r->approval_1 == '0') {
					$r->status_approve = "<button type='button' disabled class='btn btn-default btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-hourglass'></i> Ready</button>";
				}
				if ($r->approval_2 == '0' && $r->approval_1 == '1') {
					$r->status_approve = "<button type='button' disabled class='btn btn-success btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved</button>";
				}
				if ($r->approval_2 == '1' && $r->approval_1 == '1') {
					$r->status_approve = "<button type='button' disabled class='btn btn-primary btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Released</button>";
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

	function viewdtmodal($in)
	{
		$start = $in->start;
		$sqlmain = $this->basesql." and ta.is_callof ='1'";
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
				$r->amount = $r->kode_valuta." ".number_format($r->amount, 2);
				$r->status_approve = "";
				if ($r->approval_1 == '0') {
					$r->status_approve = "<button type='button' disabled class='btn btn-default btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-hourglass'></i> Ready</button>";
				}
				if ($r->approval_2 == '0' && $r->approval_1 == '1') {
					$r->status_approve = "<button type='button' disabled class='btn btn-success btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved</button>";
				}
				if ($r->approval_2 == '1' && $r->approval_1 == '1') {
					$r->status_approve = "<button type='button' disabled class='btn btn-primary btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Released</button>";
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
		$sql = $this->basesql." and ta.id_po ='$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function create($in,$status='',$main_so= '')
	{
		$in->kode_po = $this->generateCode($in->tanggal_dibuat, $in->id_tipe_sales,$status,$main_so);
		$in->created_at = $this->nowdt;
		$in->updated_at = $this->nowdt;
		$this->db->insert($this->table, $in);
		$id = $this->db->insert_id();
		return $id;
	}

	function update($in)
	{
		$in->updated_at = $this->nowdt;
		$this->db->where($this->table_id, $in->id_po);
		$this->db->update($this->table, $in);
	}

	function delete($id)
	{
		$b = new stdClass();
		$b->deleted_at = $this->nowdt;
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table, $b);
	}

	function generateCode($so_date, $id_tipe_sales,$status='',$main_so= '')
	{
		$month = date('m', strtotime($so_date));
		$year = date('Y', strtotime($so_date));
		$res = $this->db->query("select kode_po from $this->table where tanggal_dibuat >= '".date('Y-m-01', strtotime($so_date))."' and tanggal_dibuat <= '".date('Y-m-t', strtotime($so_date))."' and id_tipe_sales = '$id_tipe_sales' order by kode_po desc limit 1");
		$num = $res->num_rows();
		$latest_number = 1;
		if ($num > 0) {
			$index_number = '0000';
			foreach ($res->result() as $r){
				$arrnumber = explode('/', $r->kode_po);
				$index_number = $arrnumber[0];
			}
			$latest_number = intval($index_number);
			$latest_number++;
		}
		modelLoad($this, array('mm_tipe_sales'));
		$kode_tipe_sales = $this->mm_tipe_sales->get($id_tipe_sales)->kode_tipe_sales;

		$app_setting = getAppSetting($this);
		switch ($status){
			case 'callof_parent' :
				return str_pad($latest_number, 4, '0', STR_PAD_LEFT)."/".$kode_tipe_sales."-".$app_setting->kode_sbu."/".integerToRoman($month)."/".$year;
				break;
			case 'callof_child' :
				$res = $this->db->query("select kode_po from $this->table where id_main_so = '$main_so'");
				$num = $res->num_rows();
				$num++;
				$res = $this->db->query("select kode_po from $this->table where id_po = '$main_so'");
				$row = $res->row();
				$code = explode('/',$row->kode_po);
				return $code[0]."-".str_pad($num, 2, '0', STR_PAD_LEFT)."/".$kode_tipe_sales."-".$app_setting->kode_sbu."/".integerToRoman($month)."/".$year;
				break;
			case 'not_callof' :
				$res = $this->db->query("select kode_po from $this->table where id_po = '$main_so'");
				$row = $res->row();
				$code = explode('/',$row->kode_po);
				return $code."-00/".$kode_tipe_sales."-".$app_setting->kode_sbu."/".integerToRoman($month)."/".$year;
				break;
			default:
				break;
		}
	}
}
