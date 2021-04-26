<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mpeb_tblpebhdr extends CI_Model
{
	var $table = 'smartone_peb.tblpebhdr';
	var $table_id = 'CAR';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "select * from $this->table ta left join peb_approval tb on ta.CAR = tb.ID_HEADER";
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
		$sqlmain = "select * from ($sqlmain) pa where CAR is not null ";
		if (isset($in->tglajuawal)) {
			$tglajuawal = reverseDate($in->tglajuawal);
			$sqlmain .= " and TGEKS >= '$tglajuawal'";
		}
		if (isset($in->tglajuakhir)) {
			$tglajuakhir = reverseDate($in->tglajuakhir);
			$sqlmain .= " and TGEKS <= '$tglajuakhir'";
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

				$r->status_approve = "";
				if ($r->FLAG_APPROVAL2 == '1') {
					$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check-circle'></i> Approved</span>";
				} else if ($r->FLAG_APPROVAL1 == '1'){
					$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check-circle'></i> Sychronized</span>";
				} else {
					$r->status_approve = "<span class='badge badge-warning'><i class='fa fal fa-exclamation-circle'></i> Not Synchronized</span>";
				}

				$r->option='';
				if ($opt){
					if ($r->FLAG_APPROVAL1 == '0' && $r->FLAG_APPROVAL2 == '0') {
						$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit_30/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					}
					$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail_30/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
					if ($r->FLAG_APPROVAL1 == '0' && $r->FLAG_APPROVAL2 == '0') {
						$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete_30/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
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
		$sql = $this->basesql." and $this->table_id = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function create($in)
	{
		// $in->car = $this->generateCode($this->nowdt);

		$id = $this->db->insert($this->table, $in);
		// $id = $this->db->insert_id();
		return $id;
	}

	function update($in)
	{
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

	function generateCode($tanggal){
		$app = getAppSetting($this);
		$prefix = $app->NO_AJU_BC30;
		$sql = "select * from smartone_peb.tblpebhdr where CAR like '$prefix%' AND TGSIAP >= '".date('Y-01-01',strtotime($tanggal))."' AND TGSIAP <='".date('Y-12-31',strtotime($tanggal))."' order by CAR desc limit 1";
		$res = $this->db->query($sql);
		$num = $res->num_rows();
		if($num > 0 ){
			$row = $res->row();
			$lastaju = substr($row->CAR,0,26);
			$last = ((substr($lastaju, -6)) * 1) + 1;
		} else {
			$last = 1;
		}
		return $prefix.date('Y',strtotime($tanggal)).date('m',strtotime($tanggal)).date('d',strtotime($tanggal)).str_pad($last, 6, '0', STR_PAD_LEFT);
	}
}
