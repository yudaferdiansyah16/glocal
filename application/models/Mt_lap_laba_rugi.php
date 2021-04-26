<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_lap_laba_rugi extends CI_Model
{
	function view($in)
	{
		$s = new stdClass();

		if(isset($in->tgl1) && isset($in->tgl2)){
			$tgl1 = explode('-', $in->tgl1);
			$tgl2 = explode('-', $in->tgl2);

			$sqlbulan = "SELECT TIMESTAMPDIFF(MONTH, '".$tgl1[2]."-".$tgl1[1]."-01','".$tgl2[2]."-".$tgl2[1]."-01') as bulan";
			$resbulan = $this->db->query($sqlbulan);
			$range = $resbulan->row('bulan');
			$s->range = $range;

			$awal = $tgl1[1] - 1;
			if(!$awal) $awal = 12;
			else $awal = $awal;	
			
			$s->awal = intval($awal);
			$s->tahun = intval($tgl1[2]);
			
			$sql11 = "SELECT tb.*, ta.nilai FROM (SELECT ta.id_akun, SUM(tb.amount) AS nilai FROM m_akun ta, t_finance_detail tb, t_finance tc WHERE ta.id_akun=tb.id_akun AND tb.id_finance=tc.id_finance AND ta.kode_akun LIKE '5%' AND tc.tgl_trans < '".$tgl1[2]."-".$tgl1[1]."-01' GROUP BY ta.id_akun) ta RIGHT JOIN (SELECT id_akun, kode_akun, nama_akun FROM m_akun WHERE kode_akun LIKE '5%') tb ON ta.id_akun=tb.id_akun ORDER BY tb.kode_akun ASC";
			$res11 = $this->db->query($sql11);
			$s->akun11 = $res11;
			foreach ($res11->result() as $r){
				$nilaiAl = [];
				for($i=0; $i<=$range; $i++){
					if($i<>0){
						$sqlbulan = "SELECT DATE_ADD( '".$tgl1[2]."-".$tgl1[1]."-01', INTERVAL ".$i." month ) AS tgl";
						$resbulan = $this->db->query($sqlbulan);
						$r2 = $resbulan->row();
						$tgl = $r2->tgl;
					}else $tgl = $tgl1[2]."-".$tgl1[1]."-01";

					$tglakun = explode('-', $tgl);

					// $tgl = $tgl1[2]."-".$tgl1[1]."-01";
					// $tglakun = explode('-', $tgl);

					$sqlAl = "SELECT ta.amount, ta.jumlah_rp FROM t_finance_detail ta INNER JOIN t_finance tb ON ta.id_finance=tb.id_finance WHERE ta.id_akun='".$r->id_akun."' AND tb.tgl_trans LIKE '".$tglakun[0]."-".$tglakun[1]."-%' AND tb.closing<>'0'";
					$resAl = $this->db->query($sqlAl);
					$subkreditAl = 0;
					$subdebetAl = 0;
					$hasilAl = 0;
					foreach ($resAl->result() as $rAl){
						if(substr($rAl->amount, 0, 1)=='-'){
							$kreditAl = $rAl->jumlah_rp;
							$subkreditAl = $subkreditAl + $kreditAl;
						}
						else{
							$debetAl = $rAl->jumlah_rp;
							$subdebetAl = $subdebetAl + $debetAl;
						}
						$hasilAl = $subdebetAl - $subkreditAl;
					}
					$nilaiAl[] = $hasilAl;
				}
				$nilaiAl2[] = $nilaiAl;
			}
			$s->nilai11 = $nilaiAl2;

			$sql12 = "SELECT tb.*, ta.nilai FROM (SELECT ta.id_akun, SUM(tb.amount) AS nilai FROM m_akun ta, t_finance_detail tb, t_finance tc WHERE ta.id_akun=tb.id_akun AND tb.id_finance=tc.id_finance AND ta.kode_akun LIKE '6%' AND tc.tgl_trans < '".$tgl1[2]."-".$tgl1[1]."-01' GROUP BY ta.id_akun) ta RIGHT JOIN (SELECT id_akun, kode_akun, nama_akun FROM m_akun WHERE kode_akun LIKE '6%') tb ON ta.id_akun=tb.id_akun ORDER BY tb.kode_akun ASC";
			$res12 = $this->db->query($sql12);
			$s->akun12 = $res12;
			foreach ($res12->result() as $r){
				$nilaiAt = [];
				for($i=0; $i<=$range; $i++){
					if($i<>0){
						$sqlbulan = "SELECT DATE_ADD( '".$tgl1[2]."-".$tgl1[1]."-01', INTERVAL ".$i." month ) AS tgl";
						$resbulan = $this->db->query($sqlbulan);
						$r2 = $resbulan->row();
						$tgl = $r2->tgl;
					}else $tgl = $tgl1[2]."-".$tgl1[1]."-01";
					$tglakun = explode('-', $tgl);

					// $tgl = $tgl1[2]."-".$tgl1[1]."-01";
					// $tglakun = explode('-', $tgl);

					$sqlAt = "SELECT ta.amount, ta.jumlah_rp FROM t_finance_detail ta INNER JOIN t_finance tb ON ta.id_finance=tb.id_finance WHERE ta.id_akun='".$r->id_akun."' AND tb.tgl_trans LIKE '".$tglakun[0]."-".$tglakun[1]."-%' AND tb.closing<>'0'";
					$resAt = $this->db->query($sqlAt);
					$subkreditAt = 0;
					$subdebetAt = 0;
					$hasilAt = 0;
					foreach ($resAt->result() as $rAt){
						if(substr($rAt->amount, 0, 1)=='-'){
							$kreditAt = $rAt->jumlah_rp;
							$subkreditAt = $subkreditAt + $kreditAt;
						}
						else{
							$debetAt = $rAt->jumlah_rp;
							$subdebetAt = $subdebetAt + $debetAt;
						}
						$hasilAt = $subdebetAt - $subkreditAt;
					}
					$nilaiAt = $hasilAt;
				}
				$nilaiAt2[] = $nilaiAt;
			}
			$s->nilai12 = $nilaiAt2;

			return $s;
		}
	}
}