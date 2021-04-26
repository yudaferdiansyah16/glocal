<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mtpb_dokumen extends CI_Model
{
	var $nowdt, $nowd, $nowt, $basesql, $table, $table_id;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->table = getdbtpb($this).'.tpb_dokumen';
		$this->table_id = 'ID';
		$this->basesql = "select ta.* from $this->table";
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
		$sql = $this->basesql." and $this->table_id = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function getDokumenLainnya($id)
	{
		$sql = "select ta.*, tb.URAIAN_DOKUMEN, tb.KODE_DOKUMEN from (select DISTINCT KODE_JENIS_DOKUMEN,NOMOR_DOKUMEN,TANGGAL_DOKUMEN FROM ".getdbtpb($this).".tpb_dokumen where ID_HEADER = '$id') ta left join ".getdbtpb($this).".referensi_dokumen tb on ta.KODE_JENIS_DOKUMEN = tb.KODE_DOKUMEN";
		$res = $this->db->query($sql);

		$data = array();
		foreach ($res->result() as $r){
			$data[] = $r;
		}

		return $data;
	}

	function getDetailDokumenLainnya($id,$in, $opt = true)
	{
		$start = $in->start;

		$sql = "select ta.*, tb.URAIAN_DOKUMEN from (select DISTINCT KODE_JENIS_DOKUMEN,NOMOR_DOKUMEN,TANGGAL_DOKUMEN FROM ".getdbtpb($this).".tpb_dokumen where ID_HEADER = '$id') ta left join ".getdbtpb($this).".referensi_dokumen tb on ta.KODE_JENIS_DOKUMEN = tb.KODE_DOKUMEN";
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

	function getInvoice($id)
	{
		$sql = "select ta.* from (select * FROM ".getdbtpb($this).".tpb_dokumen where ID_HEADER = '$id') ta where ta.KODE_JENIS_DOKUMEN = '640'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function getLC($id)
	{
		$sql = "select ta.* from (select * FROM ".getdbtpb($this).".tpb_dokumen where ID_HEADER = '$id') ta where ta.KODE_JENIS_DOKUMEN = '465'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function getBL($id)
	{
		$sql = "select ta.* from (select * FROM ".getdbtpb($this).".tpb_dokumen where ID_HEADER = '$id') ta where ta.KODE_JENIS_DOKUMEN = '705'";
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
}
