<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mt_finance_detail extends CI_Model
{
	var $table = 't_finance_detail';
	var $table_id = 'id_finance_detail';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "select ta.*, tc.kode_akun, tc.nama_akun, td.KODE_VALUTA, td.URAIAN_VALUTA from $this->table ta left join t_finance tb on ta.id_finance=tb.id_finance left join m_akun tc on ta.id_akun=tc.id_akun left join ".getdbtpb($this).".referensi_valuta td on tb.id_valuta=td.ID where ta.deleted_at is null";
	}

	function view()
	{
		$sql = $this->basesql;
		$res = $this->db->query($sql);

		$data = array();
		foreach ($res->result() as $r) {
			$data[] = $r;
		}

		return $data;
	}

	function viewBasedSOId($id_po)
	{
		$sql = $this->basesql . " and ta.id_po = '$id_po'";
		$res = $this->db->query($sql);

		$data = array();
		foreach ($res->result() as $r) {
			$data[] = $r;
		}

		return $data;
	}

	function viewDT($in)
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
		if ($num > 0) {
			$i = $start + 1;
			foreach ($res->result() as $r) {
				$r->no = $i;
				$r->option = '<a href="' . base_url('procurement/purchase_order/detail/' . $r->id_po) . '" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
				$r->option .= '<a href="' . base_url('procurement/purchase_order/edit/' . $r->id_po) . '" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
				$r->option .= '<button type="button" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="' . base_url('procurement/purchase_order/delete/' . $r->id_po) . '" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></button>';
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
		$a = $this->in;
		$sql = $this->basesql . " and $this->table_id = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function getid($id)
	{
		$sql = $this->basesql. " and ta.id_finance = '$id'";
		$res = $this->db->query($sql);

		$data = array();
		foreach ($res->result() as $r) {
			$data[] = $r;
		}

		return $data;
	}

	function create($in)
	{
		$in->created_at = $this->nowdt;
		$in->updated_at = $this->nowdt;
		$this->db->insert($this->table, $in);
		$id = $this->db->insert_id();
		return $id;
	}

	// function update($in)
	// {
	// 	$in->updated_at = $this->nowdt;
	// 	$this->db->where($this->table_id, $in->id_detail_po);
	// 	$this->db->update($this->table, $in);
	// }

	function update($in)
	{
		// printJSON($in);
		// die();
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
}
