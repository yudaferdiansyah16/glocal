<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mcustom_bahan_baku extends CI_Model
{
		function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
	}

	function view()
	{
		$sql = "";
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
		// $in->tglawal = reverseDate($in->tglawal);
		// $in->tglakhir = reverseDate($in->tglakhir);
		$sqlmain = "SELECT c.nama_barang, c.kode_barang, c.kode_hs, b.nama_koordinat, SUM(a.qty) as qty, d.KODE_SATUAN as kode_satuan, d.URAIAN_SATUAN as uraian_satuan, a.deskripsi, a.tanggal_terima FROM (SELECT a.*,b.deskripsi,b.tanggal_terima FROM t_wh_detail a LEFT JOIN t_wh b on a.id_wh = b.id_wh) a LEFT JOIN (SELECT * FROM m_koordinat WHERE id_gudang = '8') b on a.id_koordinat = b.id_koordinat INNER JOIN m_sub_barang c on a.id_sub_barang = c.id_sub_barang LEFT JOIN ".getdbtpb($this).".referensi_satuan d on a.id_satuan_terkecil = d.ID GROUP BY a.id_sub_barang HAVING SUM(a.qty) <> 0";
		
		$sqlmain = "select * from ($sqlmain) pa where ID is not null";		

		if(isset($in->tglajuawal)){
		$tglajuawal = reverseDate($in->tglajuawal);
		$sqlmain = "SELECT c.nama_barang, c.kode_barang, c.kode_hs, b.nama_koordinat, SUM(a.qty) as qty, d.KODE_SATUAN as kode_satuan, d.URAIAN_SATUAN as uraian_satuan, a.deskripsi, a.tanggal_terima FROM (SELECT a.*,b.deskripsi,b.tanggal_terima FROM t_wh_detail a LEFT JOIN t_wh b on a.id_wh = b.id_wh) a LEFT JOIN (SELECT * FROM m_koordinat WHERE id_gudang = '8') b on a.id_koordinat = b.id_koordinat INNER JOIN m_sub_barang c on a.id_sub_barang = c.id_sub_barang LEFT JOIN smartone_tpb_dps1.referensi_satuan d on a.id_satuan_terkecil = d.ID WHERE a.tanggal_terima>='$tglajuawal' GROUP BY a.id_sub_barang HAVING SUM(a.qty) <> 0";
		} else if (isset($in->tglajuakhir)){
		$tglajuakhir = reverseDate($in->tglajuakhir);
		$sqlmain = "SELECT c.nama_barang, c.kode_barang, c.kode_hs, b.nama_koordinat, SUM(a.qty) as qty, d.KODE_SATUAN as kode_satuan, d.URAIAN_SATUAN as uraian_satuan, a.deskripsi, a.tanggal_terima FROM (SELECT a.*,b.deskripsi,b.tanggal_terima FROM t_wh_detail a LEFT JOIN t_wh b on a.id_wh = b.id_wh) a LEFT JOIN (SELECT * FROM m_koordinat WHERE id_gudang = '8') b on a.id_koordinat = b.id_koordinat INNER JOIN m_sub_barang c on a.id_sub_barang = c.id_sub_barang LEFT JOIN smartone_tpb_dps1.referensi_satuan d on a.id_satuan_terkecil = d.ID WHERE a.tanggal_terima<='$tglajuakhir' GROUP BY a.id_sub_barang HAVING SUM(a.qty) <> 0";
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
}
