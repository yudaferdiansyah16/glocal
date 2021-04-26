<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Vhistory_rm extends CI_Model
{
	var $table = 't_production';
	var $table_id = 'id_production';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "select ta.* from (select xa.*, xb.kode_stuffing, tanggal_stuffing from t_detail_stuffing xa inner join t_stuffing xb on xa.id_stuffing = xb.id_stuffing) ta";
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
		$sql = "select * from ($this->basesql) pa where pa.id_detail_stuffing = '$in->id'";
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			foreach ($res->result() as $r){
				$data[] = $r;
			}
		}

		return $data;
		/*$start = $in->start;
		$sqlmain = $this->basesql;
		$sql = "select * from ($sqlmain) pa where pa.id_detail_stuffing = '$id'";
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

		return $k;*/
	}

	function get($id)
	{
		$sql = "select * from ($this->basesql) pa where $this->table_id = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function create($in)
	{
		$in->kode_mutasi = $this->generateCode($in->tanggal_mutasi);
		$in->created_at = $this->nowdt;
		$in->updated_at = $this->nowdt;
		$this->db->insert($this->table, $in);
		$id = $this->db->insert_id();
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

	function disapprove($id)
	{
		$b = new stdClass();
		$b->approval_1 = 0;
		$b->id_user_approval_1 = 0;
		$b->date_approval_1 = $this->nowdt;
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

	function generateCode($date)
	{
		$month = date('m', strtotime($date));
		$year = date('Y', strtotime($date));
		$id_jenis_mutasi = '1';
		$res = $this->db->query("select kode_mutasi from $this->table where tanggal_mutasi >= '".date('Y-m-01', strtotime($date))."' and tanggal_mutasi <= '".date('Y-m-t', strtotime($date))."' and id_jenis_mutasi = '$id_jenis_mutasi' and deleted_at is null order by kode_mutasi desc limit 1");
		$num = $res->num_rows();
		$latest_number = 1;
		if ($num > 0) {
			$index_number = '0000';
			foreach ($res->result() as $r){
				$arrnumber = explode('/', $r->kode_mutasi);
				$index_number = $arrnumber[0];
			}
			$latest_number = intval($index_number);
			$latest_number++;
		}

		modelLoad($this, array('mm_jenis_mutasi'));
		$m_jenis_mutasi = $this->mm_jenis_mutasi->get($id_jenis_mutasi);

		$app_setting = getAppSetting($this);
		return str_pad($latest_number, 4, '0', STR_PAD_LEFT)."/".$m_jenis_mutasi->kode_doc."-".$app_setting->kode_sbu."/".integerToRoman($month)."/".$year;
	}
}
