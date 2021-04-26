<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_lap_pembelian_local extends CI_Model
{
	function view($in)
	{
		$s = 	new stdClass();
		if(isset($in->tgl1) && isset($in->tgl2)){
			$tgl1 = $in->tgl1;
			$tgl2 = $in->tgl2;

			$tgl11 = date("Y-m-d", strtotime($tgl1));
			$tgl22 = date("Y-m-d", strtotime($tgl2));
		
			$sql16 = "SELECT * FROM t_dn ta 
				INNER JOIN t_detail_dn tb ON ta.id_dn=tb.id_dn
				INNER JOIN m_suplier tc ON ta.id_supplier=tc.id_suplier
				WHERE ta.tgl_kedatangan BETWEEN '$tgl11' AND '$tgl22'";
			$res16 = $this->db->query($sql16);
			return $res16;		
		}

	}
}