<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_lap_hpp extends CI_Model
{
	function view($in)
	{
		$s = 	new stdClass();

		if(isset($in->tgl1) && isset($in->tgl2)){
			$tgl1 = explode('-', $in->tgl1);
			$tgl2 = explode('-', $in->tgl2);

			$sqlbulan = "SELECT TIMESTAMPDIFF(MONTH, '".$tgl1[2]."-".$tgl1[1]."-01','".$tgl2[2]."-".$tgl2[1]."-01') as bulan";
			$resbulan = $this->db->query($sqlbulan);
			$range = $resbulan->row('bulan');
			$s->range = $range;
			$s->awal = intval($tgl1[1]);

			$nilai1 = [];
			$nilai3 = [];
			$nilai4 = [];
			for($i=0; $i<=$range+1; $i++){				
				if($i<>0){
					$sqlbulan = "SELECT DATE_ADD( '".$tgl1[2]."-".$tgl1[1]."-01', INTERVAL ".$i." month ) AS tgl";
					$resbulan = $this->db->query($sqlbulan);
					$r2 = $resbulan->row();
					$tgl = $r2->tgl;
				}else $tgl = $tgl1[2]."-".$tgl1[1]."-01";
				$tglakun = explode('-', $tgl);

				$sql16 = "SELECT ta.amount, ta.jumlah_rp FROM t_finance_detail ta INNER JOIN t_finance tb ON ta.id_finance=tb.id_finance WHERE ta.id_akun='18' AND tb.tgl_trans LIKE '".$tglakun[0]."-".$tglakun[1]."-%' AND tb.closing<>'0'";
				$res16 = $this->db->query($sql16);
				$subkredit16 = 0;
				$subdebet16 = 0;
				$hasil16 = 0;
				foreach ($res16->result() as $r16){
					if(substr($r16->amount, 0, 1)=='-'){
						$kredit16 = $r16->jumlah_rp;
						$subkredit16 = $subkredit16 + $kredit16;
					}
					else{
						$debet16 = $r16->jumlah_rp;
						$subdebet16 = $subdebet16 + $debet16;
					}
					$hasil16 = $subdebet16 - $subkredit16;
				}
				$nilai1[] = $hasil16;

				$sqlWip = "SELECT ta.amount, ta.jumlah_rp FROM t_finance_detail ta INNER JOIN t_finance tb ON ta.id_finance=tb.id_finance WHERE ta.id_akun='19' AND tb.tgl_trans LIKE '".$tglakun[0]."-".$tglakun[1]."-%' AND tb.closing<>'0'";
				$resWip = $this->db->query($sqlWip);
				$subkreditWip = 0;
				$subdebetWip = 0;
				$hasilWip = 0;
				foreach ($resWip->result() as $rWip){
					if(substr($rWip->amount, 0, 1)=='-'){
						$kreditWip = $rWip->jumlah_rp;
						$subkreditWip = $subkreditWip + $kreditWip;
					}
					else{
						$debetWip = $rWip->jumlah_rp;
						$subdebetWip = $subdebetWip + $debetWip;
					}
					$hasilWip = $subdebetWip - $subkreditWip;
				}
				$nilai3[] = $hasilWip;

				$sqlBj = "SELECT ta.amount, ta.jumlah_rp FROM t_finance_detail ta INNER JOIN t_finance tb ON ta.id_finance=tb.id_finance WHERE ta.id_akun='20' AND tb.tgl_trans LIKE '".$tglakun[0]."-".$tglakun[1]."-%' AND tb.closing<>'0'";
				$resBj = $this->db->query($sqlBj);
				$subkreditBj = 0;
				$subdebetBj = 0;
				$hasilBj = 0;
				foreach ($resBj->result() as $rBj){
					if(substr($rBj->amount, 0, 1)=='-'){
						$kreditBj = $rBj->jumlah_rp;
						$subkreditBj = $subkreditBj + $kreditBj;
					}
					else{
						$debetBj = $rBj->jumlah_rp;
						$subdebetBj = $subdebetBj + $debetBj;
					}
					$hasilBj = $subdebetBj - $subkreditBj;
				}
				$nilai4[] = $hasilBj;

			}
			$s->nilai16 = $nilai1;
			$s->nilaiWip = $nilai3;
			$s->nilaiBj = $nilai4;
			
			$sqlakun = "SELECT id_akun, kode_akun, nama_akun FROM m_akun WHERE kode_akun LIKE '51%' ORDER BY kode_akun ASC";
			$resakun = $this->db->query($sqlakun);
			$s->akun = $resakun;
			foreach ($resakun->result() as $r){
				$nilai2 = [];
				for($i=0; $i<=$range; $i++){
					if($i<>0){
						$sqlbulan = "SELECT DATE_ADD( '".$tgl1[2]."-".$tgl1[1]."-01', INTERVAL ".$i." month ) AS tgl";
						$resbulan = $this->db->query($sqlbulan);
						$r2 = $resbulan->row();
						$tgl = $r2->tgl;
					}else $tgl = $tgl1[2]."-".$tgl1[1]."-01";
					$tglakun = explode('-', $tgl);

					$sql51 = "SELECT ta.amount, ta.jumlah_rp FROM t_finance_detail ta INNER JOIN t_finance tb ON ta.id_finance=tb.id_finance WHERE ta.id_akun='".$r->id_akun."' AND tb.tgl_trans LIKE '".$tglakun[0]."-".$tglakun[1]."-%' AND tb.closing<>'0'";
					$res51 = $this->db->query($sql51);
					$subkredit51 = 0;
					$subdebet51 = 0;
					$hasil51 = 0;
					foreach ($res51->result() as $r51){
						if(substr($r51->amount, 0, 1)=='-'){
							$kredit51 = $r51->jumlah_rp;
							$subkredit51 = $subkredit51 + $kredit51;
						}
						else{
							$debet51 = $r51->jumlah_rp;
							$subdebet51 = $subdebet51 + $debet51;
						}
						$hasil51 = $subdebet51 - $subkredit51;
					}
					$nilai2[] = $hasil51;
				}
				$nilai51[] = $nilai2;
			}
			$s->nilai51 = $nilai51;
			return $s;
		}
	}
}