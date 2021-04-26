<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mtpb_bahan_baku_tarif extends CI_Model
{
	var $nowdt, $nowd, $nowt, $basesql, $table, $table_id;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->table = getdbtpb($this).'.tpb_bahan_baku_tarif ';
		$this->table_id = 'ID';
		$this->basesql = "select ta.* from $this->table";
	}

	function getBahantarif($id)
	{
		$sql = "select ta.*,tb.* from
		 (select * from  ".$this->table." where ID_HEADER = '$id') ta 
		 inner join  smartone_tpb_dps1.referensi_pungutan tb on ta.JENIS_TARIF = tb.KODE_PUNGUTAN ";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

}
