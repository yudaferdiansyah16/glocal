<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_lap_neraca_saldo extends CI_Model
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
			
			$awal = $tgl1[1] - 1;
			if(!$awal) $awal = 12;
			else $awal = $awal;	
			
			$s->awal = intval($awal);
			$s->tahun = intval($tgl1[2]);
			
			$sql11 = "SELECT tb.*, ta.nilai FROM (SELECT ta.id_akun, SUM(tb.amount) AS nilai FROM m_akun ta, t_finance_detail tb, t_finance tc WHERE ta.id_akun=tb.id_akun AND tb.id_finance=tc.id_finance AND ta.kode_akun LIKE '11%' AND tc.tgl_trans < '".$tgl1[2]."-".$tgl1[1]."-01' GROUP BY ta.id_akun) ta RIGHT JOIN (SELECT id_akun, kode_akun, nama_akun FROM m_akun WHERE kode_akun LIKE '11%') tb ON ta.id_akun=tb.id_akun ORDER BY tb.kode_akun ASC";
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

			$sql12 = "SELECT tb.*, ta.nilai FROM (SELECT ta.id_akun, SUM(tb.amount) AS nilai FROM m_akun ta, t_finance_detail tb, t_finance tc WHERE ta.id_akun=tb.id_akun AND tb.id_finance=tc.id_finance AND ta.kode_akun LIKE '12%' AND tc.tgl_trans < '".$tgl1[2]."-".$tgl1[1]."-01' GROUP BY ta.id_akun) ta RIGHT JOIN (SELECT id_akun, kode_akun, nama_akun FROM m_akun WHERE kode_akun LIKE '12%') tb ON ta.id_akun=tb.id_akun ORDER BY tb.kode_akun ASC";
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
					$nilaiAt[] = $hasilAt;
				}
				$nilaiAt2[] = $nilaiAt;
			}
			$s->nilai12 = $nilaiAt2;

			$sql13 = "SELECT tb.*, ta.nilai FROM (SELECT ta.id_akun, SUM(tb.amount) AS nilai FROM m_akun ta, t_finance_detail tb, t_finance tc WHERE ta.id_akun=tb.id_akun AND tb.id_finance=tc.id_finance AND ta.kode_akun LIKE '13%' AND tc.tgl_trans < '".$tgl1[2]."-".$tgl1[1]."-01' GROUP BY ta.id_akun) ta RIGHT JOIN (SELECT id_akun, kode_akun, nama_akun FROM m_akun WHERE kode_akun LIKE '13%') tb ON ta.id_akun=tb.id_akun ORDER BY tb.kode_akun ASC";
			$res13 = $this->db->query($sql13);
			$s->akun13 = $res13;
			foreach ($res13->result() as $r){
				$nilaiAdp = [];
				for($i=0; $i<=$range; $i++){
					if($i<>0){
						$sqlbulan = "SELECT DATE_ADD( '".$tgl1[2]."-".$tgl1[1]."-01', INTERVAL ".$i." month ) AS tgl";
						$resbulan = $this->db->query($sqlbulan);
						$r2 = $resbulan->row();
						$tgl = $r2->tgl;
					}else $tgl = $tgl1[2]."-".$tgl1[1]."-01";
					$tglakun = explode('-', $tgl);

					$sqlAdp = "SELECT ta.amount, ta.jumlah_rp FROM t_finance_detail ta INNER JOIN t_finance tb ON ta.id_finance=tb.id_finance WHERE ta.id_akun='".$r->id_akun."' AND tb.tgl_trans LIKE '".$tglakun[0]."-".$tglakun[1]."-%' AND tb.closing<>'0'";
					$resAdp = $this->db->query($sqlAdp);
					$subkreditAdp = 0;
					$subdebetAdp = 0;
					$hasilAdp = 0;
					foreach ($resAdp->result() as $rAdp){
						if(substr($rAdp->amount, 0, 1)=='-'){
							$kreditAdp = $rAdp->jumlah_rp;
							$subkreditAdp = $subkreditAdp + $kreditAdp;
						}
						else{
							$debetAdp = $rAdp->jumlah_rp;
							$subdebetAdp = $subdebetAdp + $debetAdp;
						}
						$hasilAdp = $subdebetAdp - $subkreditAdp;
					}
					$nilaiAdp[] = $hasilAdp;
				}
				$nilaiAdp2[] = $nilaiAdp;
			}
			$s->nilai13 = $nilaiAdp2;

			$sql21 = "SELECT tb.*, ta.nilai FROM (SELECT ta.id_akun, SUM(tb.amount) AS nilai FROM m_akun ta, t_finance_detail tb, t_finance tc WHERE ta.id_akun=tb.id_akun AND tb.id_finance=tc.id_finance AND ta.kode_akun LIKE '21%' AND ta.kode_akun <> '211.00.00' AND ta.kode_akun <> '212.01.00' AND ta.kode_akun <> '216.00.00' AND ta.kode_akun <> '216.01.00' AND ta.kode_akun <> '216.02.00' AND tc.tgl_trans < '".$tgl1[2]."-".$tgl1[1]."-01' GROUP BY ta.id_akun) ta RIGHT JOIN (SELECT id_akun, kode_akun, nama_akun FROM m_akun WHERE kode_akun LIKE '21%' AND kode_akun <> '211.00.00' AND kode_akun <> '212.01.00' AND kode_akun <> '216.00.00' AND kode_akun <> '216.01.00' AND kode_akun <> '216.02.00') tb ON ta.id_akun=tb.id_akun ORDER BY tb.kode_akun ASC";
			$res21 = $this->db->query($sql21);
			$s->akun21 = $res21;
			foreach ($res21->result() as $r){
				$nilaiHl = [];
				for($i=0; $i<=$range; $i++){
					if($i<>0){
						$sqlbulan = "SELECT DATE_ADD( '".$tgl1[2]."-".$tgl1[1]."-01', INTERVAL ".$i." month ) AS tgl";
						$resbulan = $this->db->query($sqlbulan);
						$r2 = $resbulan->row();
						$tgl = $r2->tgl;
					}else $tgl = $tgl1[2]."-".$tgl1[1]."-01";
					$tglakun = explode('-', $tgl);

					$sqlHl = "SELECT ta.amount, ta.jumlah_rp FROM t_finance_detail ta INNER JOIN t_finance tb ON ta.id_finance=tb.id_finance WHERE ta.id_akun='".$r->id_akun."' AND tb.tgl_trans LIKE '".$tglakun[0]."-".$tglakun[1]."-%' AND tb.closing<>'0'";
					$resHl = $this->db->query($sqlHl);
					$subkreditHl = 0;
					$subdebetHl = 0;
					$hasilHl = 0;
					foreach ($resHl->result() as $rHl){
						if(substr($rHl->amount, 0, 1)=='-'){
							$kreditHl = $rHl->jumlah_rp;
							$subkreditHl = $subkreditHl + $kreditHl;
						}
						else{
							$debetHl = $rHl->jumlah_rp;
							$subdebetHl = $subdebetHl + $debetHl;
						}
						$hasilHl = $subdebetHl - $subkreditHl;
					}
					$nilaiHl[] = $hasilHl;
				}
				$nilaiHl2[] = $nilaiHl;
			}
			$s->nilai21 = $nilaiHl2;

			$sql22 = "SELECT tb.*, ta.nilai FROM (SELECT ta.id_akun, SUM(tb.amount) AS nilai FROM m_akun ta, t_finance_detail tb, t_finance tc WHERE ta.id_akun=tb.id_akun AND tb.id_finance=tc.id_finance AND (ta.kode_akun = '212.01.00' OR ta.kode_akun = '216.01.00' OR ta.kode_akun = '216.02.00') AND tc.tgl_trans < '".$tgl1[2]."-".$tgl1[1]."-01' GROUP BY ta.id_akun) ta RIGHT JOIN (SELECT id_akun, kode_akun, nama_akun FROM m_akun WHERE (kode_akun = '212.01.00' OR kode_akun = '216.01.00' OR kode_akun = '216.02.00')) tb ON ta.id_akun=tb.id_akun ORDER BY tb.kode_akun ASC";
			$res22 = $this->db->query($sql22);
			$s->akun22 = $res22;
			foreach ($res22->result() as $r){
				$nilaiHb = [];
				for($i=0; $i<=$range; $i++){
					if($i<>0){
						$sqlbulan = "SELECT DATE_ADD( '".$tgl1[2]."-".$tgl1[1]."-01', INTERVAL ".$i." month ) AS tgl";
						$resbulan = $this->db->query($sqlbulan);
						$r2 = $resbulan->row();
						$tgl = $r2->tgl;
					}else $tgl = $tgl1[2]."-".$tgl1[1]."-01";
					$tglakun = explode('-', $tgl);

					$sqlHb = "SELECT ta.amount, ta.jumlah_rp FROM t_finance_detail ta INNER JOIN t_finance tb ON ta.id_finance=tb.id_finance WHERE ta.id_akun='".$r->id_akun."' AND tb.tgl_trans LIKE '".$tglakun[0]."-".$tglakun[1]."-%' AND tb.closing<>'0'";
					$resHb = $this->db->query($sqlHb);
					$subkreditHb = 0;
					$subdebetHb = 0;
					$hasilHb = 0;
					foreach ($resHb->result() as $rHb){
						if(substr($rHb->amount, 0, 1)=='-'){
							$kreditHb = $rHb->jumlah_rp;
							$subkreditHb = $subkreditHb + $kreditHb;
						}
						else{
							$debetHb = $rHb->jumlah_rp;
							$subdebetHb = $subdebetHb + $debetHb;
						}
						$hasilHb = $subdebetHb - $subkreditHb;
					}
					$nilaiHb[] = $hasilHb;
				}
				$nilaiHb2[] = $nilaiHb;
			}
			$s->nilai22 = $nilaiHb2;

			$sql3 = "SELECT tb.*, ta.nilai FROM (SELECT ta.id_akun, SUM(tb.amount) AS nilai FROM m_akun ta, t_finance_detail tb, t_finance tc WHERE ta.id_akun=tb.id_akun AND tb.id_finance=tc.id_finance AND (ta.kode_akun = '311.01.00' OR ta.kode_akun = '311.02.00' OR ta.kode_akun = '311.03.00') AND tc.tgl_trans < '".$tgl1[2]."-".$tgl1[1]."-01' GROUP BY ta.id_akun) ta RIGHT JOIN (SELECT id_akun, kode_akun, nama_akun FROM m_akun WHERE (kode_akun = '311.01.00' OR kode_akun = '311.02.00' OR kode_akun = '311.03.00')) tb ON ta.id_akun=tb.id_akun ORDER BY tb.kode_akun ASC";
			$res3 = $this->db->query($sql3);
			$s->akun3 = $res3;
			foreach ($res3->result() as $r){
				$nilaiMdl = [];
				for($i=0; $i<=$range; $i++){
					if($i<>0){
						$sqlbulan = "SELECT DATE_ADD( '".$tgl1[2]."-".$tgl1[1]."-01', INTERVAL ".$i." month ) AS tgl";
						$resbulan = $this->db->query($sqlbulan);
						$r2 = $resbulan->row();
						$tgl = $r2->tgl;
					}else $tgl = $tgl1[2]."-".$tgl1[1]."-01";
					$tglakun = explode('-', $tgl);

					$sqlMdl = "SELECT ta.amount, ta.jumlah_rp FROM t_finance_detail ta INNER JOIN t_finance tb ON ta.id_finance=tb.id_finance WHERE ta.id_akun='".$r->id_akun."' AND tb.tgl_trans LIKE '".$tglakun[0]."-".$tglakun[1]."-%' AND tb.closing<>'0'";
					$resMdl = $this->db->query($sqlMdl);
					$subkreditMdl = 0;
					$subdebetMdl = 0;
					$hasilMdl = 0;
					foreach ($resMdl->result() as $rHb){
						if(substr($rMdl->amount, 0, 1)=='-'){
							$kreditMdl = $rMdl->jumlah_rp;
							$subkreditMdl = $subkreditMdl + $kreditMdl;
						}
						else{
							$debetMdl = $rMdl->jumlah_rp;
							$subdebetMdl = $subdebetMdl + $debetMdl;
						}
						$hasilMdl = $subdebetMdl - $subkreditMdl;
					}
					$nilaiMdl[] = $hasilMdl;
				}
				$nilaiMdl2[] = $nilaiMdl;
			}
			$s->nilai3 = $nilaiMdl2;

			return $s;
		}
	}
}