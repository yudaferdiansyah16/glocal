<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_lap_bukubesar extends CI_Model
{
	function view($in)
	{
		$s = new stdClass();

		if(isset($in->tgl1) && isset($in->tgl2) && isset($in->coa)){
			$sqlsaldo = "SELECT SUM(ta.amount) AS saldoawal, tc.kode_akun AS kode, tc.nama_akun AS nama, td.nama_tipe_akun AS tipe FROM t_finance_detail ta INNER JOIN t_finance tb ON ta.id_finance=tb.id_finance INNER JOIN m_akun tc ON ta.id_akun=tc.id_akun INNER JOIN m_tipe_akun td ON tc.id_tipe_akun=td.id_tipe_akun WHERE ta.id_akun='".$in->coa."' AND tb.tgl_trans < '".reverseDate($in->tgl1)."'";
			$ressaldo = $this->db->query($sqlsaldo);
			$s->saldoawal = $ressaldo->row('saldoawal');
			$s->nama = $ressaldo->row('nama');
			$s->kode = $ressaldo->row('kode');
			$s->tipe = $ressaldo->row('tipe');

			$sql = "SELECT tb.id_finance, tb.no_trans, tb.tgl_trans, tb.no_trans FROM t_finance_detail ta INNER JOIN t_finance tb ON ta.id_finance=tb.id_finance WHERE ta.id_akun='".$in->coa."' AND (tb.tgl_trans BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') ORDER BY tb.tgl_trans ASC";
			$res = $this->db->query($sql);
			$data = [];
			$hasil = $ressaldo->row('saldoawal');
			$totaldebet = 0;
			$totalkredit = 0;
			foreach ($res->result() as $r){
				$sqlakun = "SELECT tb.kode_akun, ta.description, ta.amount, ta.jumlah_rp, tc.nama_akun, td.nama_tipe_akun FROM t_finance_detail ta INNER JOIN m_akun tb ON ta.id_akun=tb.id_akun INNER JOIN m_akun tc ON ta.id_akun=tc.id_akun LEFT JOIN m_tipe_akun td ON tc.id_tipe_akun=td.id_tipe_akun WHERE ta.id_finance='".$r->id_finance."' AND ta.id_akun<>'".$in->coa."'";
				$resakun = $this->db->query($sqlakun);
				foreach ($resakun->result() as $rakun){
					$a = new stdClass();

					$a->kode = $rakun->kode_akun;
					$a->nama = $rakun->nama_akun;
					$a->tipe = $rakun->nama_tipe_akun;
					$a->tgl = $r->tgl_trans;
					$a->no = $r->no_trans;
					$a->ket = $rakun->description;
					if(substr($rakun->amount, 0, 1)=='-'){
						$a->debet = $rakun->jumlah_rp;
						$a->kredit = 0;
						$totaldebet = $totaldebet + $rakun->jumlah_rp;
						$hasil = $hasil + $rakun->jumlah_rp;
					}else{
						$a->kredit = $rakun->jumlah_rp;
						$a->debet = 0;
						$totalkredit = $totalkredit + $rakun->jumlah_rp;
						$hasil = $hasil - $rakun->jumlah_rp;
					}
					$a->hasil = $hasil;

					$data[] = $a;
				}
			}
			$s->totaldebet = $totaldebet;
			$s->totalkredit = $totalkredit;
			$s->akun = $data;

			return $s;
		}
		
	}
}