<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_lap_kasbon extends CI_Model
{
	function view($in)
	{
		$s = 	new stdClass();

		if(isset($in->tgl1) && isset($in->tgl2)){
			$tgl1 = explode('-', $in->tgl1);
			$tgl2 = explode('-', $in->tgl2);

			$sql = "SELECT * FROM t_kasbon WHERE (tgl_kasbon BETWEEN '".$tgl1[2]."-".$tgl1[1]."-".$tgl1[0]."' AND '".$tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."') ORDER BY tgl_kasbon DESC";
			$res = $this->db->query($sql);
			$s->res = $res;
			return $s;
		}
	}
}