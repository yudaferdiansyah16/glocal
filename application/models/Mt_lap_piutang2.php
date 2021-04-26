<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_lap_piutang extends CI_Model
{
	function view($in)
	{
		$s = 	new stdClass();

		if(isset($in->tgl1) && isset($in->tgl2)){
			$tgl1 = explode('-', $in->tgl1);
			$tgl2 = explode('-', $in->tgl2);

			$sql = "SELECT ta.*, tb.jumlah_bayar, tb.tgl_bayar, tb.sisa_bayar FROM (SELECT ta.id_invoice, ta.payment, tb.id_invoice_detail, ta.tanggal_invoice, ta.kode_invoice, SUM(tb.subtotal) as nilai, tc.NPWP AS npwp, tc.NAMA AS customer, td.KODE_VALUTA AS kode_valuta, td.URAIAN_VALUTA AS uraian_valuta, te.URAIAN_NEGARA AS negara from t_invoice ta INNER JOIN t_invoice_detail tb ON ta.id_invoice=tb.id_invoice INNER JOIN smartone_tpb_dps1.referensi_pengusaha tc on tc.ID = ta.id_supplier INNER JOIN smartone_tpb_dps1.referensi_valuta td ON td.ID=ta.id_valuta INNER JOIN smartone_tpb_dps1.referensi_negara te ON te.ID=ta.id_country) ta, t_bayar tb WHERE tb.id_invoice_detail=tb.id_invoice_detail AND (ta.tanggal_invoice BETWEEN '".$tgl1[2]."-".$tgl1[1]."-".$tgl1[0]."' AND '".$tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."')";

			$res = $this->db->query($sql);
			$s->res = $res;
			return $s;
		}
	}
}