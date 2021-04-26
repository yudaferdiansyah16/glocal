<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mm_rates extends CI_Model
{
	var $table = 'm_rates';
	var $table_id = 'id_rates';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		// $this->basesql = "select * from m_rates";
		$this->basesql = "SELECT tt.* FROM m_rates tt INNER JOIN (SELECT kode_valuta, MAX(created_at) AS MaxDateTime FROM m_rates GROUP BY kode_valuta) groupedtt ON tt.kode_valuta = groupedtt.kode_valuta AND tt.created_at = groupedtt.MaxDateTime";
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
	function checkrate()
	{
		$d = $this->nowd;
		$sql = "SELECT COUNT(id_rates) AS jumlah FROM m_rates WHERE created_at LIKE '$d%'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row->jumlah;
	}
	function dashboardLatest()
	{
		$sql = $this->basesql. " WHERE tt.kode_valuta='USD'";
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

	function getRates($id)
    {
        $sql = "SELECT tt.* FROM m_rates tt INNER JOIN (SELECT kode_valuta, MAX(created_at) AS MaxDateTime FROM m_rates WHERE kode_valuta = '$id' GROUP BY kode_valuta) groupedtt  ON tt.kode_valuta = groupedtt.kode_valuta  AND tt.created_at = groupedtt.MaxDateTime";
        $res = $this->db->query($sql);
        $row = $res->row();

        return $row;
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
		$in->created_at = $this->nowdt;
		$this->db->insert($this->table, $in);
		$id = $this->db->insert_id();
		return $id;
	}
}
