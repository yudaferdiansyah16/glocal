<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mpeb_approval extends CI_Model
{
	var $table = 'peb_approval';
	var $table_id = 'ID';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "select ta.* from $this->table ta";
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

	function get($id)
	{
		$sql = "select * from ($this->basesql) pa where $this->table_id = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function getByHeader($id)
	{
		$sql = "select * from ($this->basesql) pa where ID_HEADER = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function create($in)
	{
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
		$b->FLAG_APPROVAL1 = 1;
		$b->DATE_APPROVAL1 = $this->nowdt;
		$this->db->where('ID_HEADER', $id);
		$this->db->update($this->table, $b);
//		sendTPB($this,'smartone_tpb.tpb_header','insert',$id);
//
//		$sql = "select * from smartone_tpb.smartone_tpb.tpb_barang where ID_HEADER = $id";
//		$res = $this->db->query($sql);
//		foreach ($res->result() as $r){
//			sendTPB($this,'smartone_tpb.tpb_barang','insert',$r->ID);
//		}
//
//		$sql = "select * from smartone_tpb.smartone_tpb.tpb_dokumen where ID_HEADER = $id";
//		$res = $this->db->query($sql);
//		foreach ($res->result() as $r){
//			sendTPB($this,'smartone_tpb.tpb_barang','insert',$r->ID);
//		}
//
//		$sql = "select * from smartone_tpb.smartone_tpb.tpb_kemasan where ID_HEADER = $id";
//		$res = $this->db->query($sql);
//		foreach ($res->result() as $r){
//			sendTPB($this,'smartone_tpb.tpb_barang','insert',$r->ID);
//		}
//
//		$sql = "select * from smartone_tpb.smartone_tpb.tpb_detail_status where ID_HEADER = $id";
//		$res = $this->db->query($sql);
//		foreach ($res->result() as $r){
//			sendTPB($this,'smartone_tpb.tpb_barang','insert',$r->ID);
//		}
	}

	function approval2($id)
	{
		$b = new stdClass();
		$b->FLAG_APPROVAL2 = 1;
		$b->DATE_APPROVAL2 = $this->nowdt;
		$this->db->where('ID_HEADER', $id);
		$this->db->update($this->table, $b);
	}
}
