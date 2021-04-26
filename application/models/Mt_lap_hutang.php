<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_lap_hutang extends CI_Model
{
	function view($in)
	{
		$s = 	new stdClass();

		if(isset($in->tgl1) && isset($in->tgl2)){
			$tgl1 = explode('-', $in->tgl1);
			$tgl2 = explode('-', $in->tgl2);

			$sql = "SELECT ta.jumlah_hbayar, ta.tgl_hbayar, ta.sisa_hbayar, tc.nilai, tc.no_invoice, tc.tgl_invoice, tc.npwp, tc.vendor, tc.kode_vendor FROM (SELECT id_detail_dn, jumlah_hbayar, tgl_hbayar, sisa_hbayar FROM t_hbayar) ta INNER JOIN (select id_dn, id_detail_dn from t_detail_dn) tb ON ta.id_detail_dn=tb.id_detail_dn INNER JOIN (select ta.id_dn, sum(ta.harga) as nilai, tb.tgl_invoice, tb.no_invoice, tc.NPWP AS npwp, tc.NAMA AS vendor, tc.kode_customer AS kode_vendor from t_detail_dn ta INNER JOIN t_dn tb ON ta.id_dn=tb.id_dn INNER JOIN m_customer_suplier tc on tc.id_customer = tb.id_supplier group by ta.id_dn) tc ON tb.id_dn=tc.id_dn WHERE (tc.tgl_invoice BETWEEN '".$tgl1[2]."-".$tgl1[1]."-".$tgl1[0]."' AND '".$tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."')";
			$res = $this->db->query($sql);
			$s->res = $res;
			return $s;
		}
	}
}