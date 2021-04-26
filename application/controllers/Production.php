<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends CI_Controller {
	var $d;
	var $in;

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('authenticated') == FALSE) {
            $this->session->sess_destroy();
			redirect('login');
		}
		helper_log();
		if(!isset($_SERVER['HTTP_REFERER'])) redirect('/');
		$this->d = getSession($this);
		$this->d->_notification = getNotification($this);
		$this->d->_controller = $this->router->fetch_class();
		$this->d->_method = $this->router->fetch_method();
		$this->in = getPostAsObject($this);
	}

	public function index()
	{
		$this->load->view('template_view');
	}
	
	function report_bod($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;
			modelLoad($this,array('mreferensi_dokumen_pabean'));

			$this->d->sdokumen_pabean = $this->mreferensi_dokumen_pabean->viewPosting(1);

		if($this->d->_action == 'add'){

		} else if($this->d->_action == 'store'){
			
		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'detail'){
			modelLoad($this,array('tproduction_request'));
			// $this->d->reqheader = $this->tproduction_request->getDetailReportBod($arg2);
			$this->d->detailbod = $this->tproduction_request->getDetailBod($arg2);
			// printJSON($this->d->detailbod);
		} else if($this->d->_action == 'print'){
		} else if($this->d->_action == 'viewDetailPPPO'){
			modelLoad($this,array('mt_detail_pp'));
			$res = $this->mt_detail_pp->viewDetailPPPO($this->in);
			printJSON($res);
		}  else if($this->d->_action == 'viewdt'){
			$res = $this->tproduction_request->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewitemdt'){
			$res = $this->tproduction_request->viewitemDT($this->in);
			printJSON($res);
		}  else if($this->d->_action == 'viewdtbod'){
			modelLoad($this,array('tproduction_request'));
			$res = $this->tproduction_request->viewDTBod($this->in);
			printJSON($res);
		}  else if($this->d->_action == 'viewdtreportbod'){
			modelLoad($this,array('tproduction_request'));
			$res = $this->tproduction_request->getDetailReportBod($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewjobDT'){
			modelLoad($this,array('mt_job'));
			$res = $this->mt_job->viewjobdt($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewbarangDT'){
		} else if($this->d->_action == 'approval1'){
		} else if($this->d->_action == 'approval2'){
		} else if($this->d->_action == 'disapprove1'){
		} else if($this->d->_action == 'disapprove2'){
		} else if($this->d->_action == 'cancel'){
		} else if($this->d->_action == 'closing'){
		}


		$this->load->view('template_view', $this->d);
	}	

	function report_bom($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

			$this->d->_modal = array('referensi_pemasok');
			modelLoad($this,array('tproduction_request'));


		if($this->d->_action == 'add'){

		} else if($this->d->_action == 'store'){
			
		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'detail'){
			$this->d->reqheader = $this->tproduction_request->getDetailReportBom($arg2);
			$this->d->detailbom = $this->tproduction_request->getDetailBom($arg2);
			// printJSON($this->d->detailbom);
		}  else if($this->d->_action == 'print'){
		} else if($this->d->_action == 'detaildt'){
			$res = $this->tproduction_detail_request->viewBasedID($arg2);
			printJSON($res);
		}  else if($this->d->_action == 'viewdt'){
			$res = $this->tproduction_request->viewDT($this->in);
			printJSON($res);
		}  else if($this->d->_action == 'viewdtbom'){
			$res = $this->tproduction_request->viewDTBom($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewitemdt'){
			$res = $this->tproduction_request->viewitemDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewjobDT'){
			modelLoad($this,array('mt_job'));
			$res = $this->mt_job->viewjobdt($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewbarangDT'){
		} else if($this->d->_action == 'approval1'){
		} else if($this->d->_action == 'approval2'){
		} else if($this->d->_action == 'disapprove1'){
		} else if($this->d->_action == 'disapprove2'){
		} else if($this->d->_action == 'cancel'){
		} else if($this->d->_action == 'closing'){
		}


		$this->load->view('template_view', $this->d);
	}
	
	function packing($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('tproduction_realisasi_request','tproduction_request', 'tproduction_detail_realisasi_request', 'mt_production','mt_production_detail', 'mt_job'));
		
		if($this->d->_action == 'add'){
			$this->d->_modal = array('t_job', 't_production_detail_realisasi');

		} else if($this->d->_action == 'store'){
			modelLoad($this,array('mt_detail_po'));
			// printJSON($this->in);
			$this->db->trans_start();
			$t_production = a2o($this->in->t_production);
			$t_production->tanggal_mutasi = reverseDate($t_production->tanggal_mutasi);
			$t_production->id_jenis_mutasi = 14;
			$id_production = $this->mt_production->create($t_production);
			$production = $this->mt_production->get($id_production);
			// $t_production_material = a2o($this->in->t_production_detail_material);
			$t_detail_dn = a2o($this->in->t_detail_dn);
			$qtyfg=$t_detail_dn->qty_realisasi;
			$a = $this->mt_detail_po->get($t_detail_dn->id_detail_po);
			
			if ($a->qty_realisasi > 0){
				// $qtyfg=	$t_detail_dn->qty_realisasi;
				$x=  $a->qty_realisasi+ $qtyfg;
				$t_detail_dn->qty_realisasi = $x;
				// printJSON($t_detail_dn->qty_realisasi);
				$detail_po = $this->mt_detail_po->update($t_detail_dn);
			}else{
				
				$detail_po = $this->mt_detail_po->update($t_detail_dn);
			}
			// $detail_po = $this->mt_detail_po->update($t_detail_dn);

			// foreach ($t_production_material as $detail_material) {
			// 	$d = a2o($detail_material);
			// 	$dm=a2o(array(
			// 		'id_production' => $id_production,
			// 		'id_job' => $t_production->id_job,
			// 		'id_wh_detail' => $d->id_wh_detail,
			// 		'kode_produksi' => $production->kode_mutasi,
			// 		'SERI_BARANG' => $d->seri_barang,
			// 		'id_sub_barang' => $d->id_sub_barang,
			// 		'id_jenis_mutasi' => 14,
			// 		'qty' => $d->qty,
			// 		'tanggal_produksi' => $production->tanggal_mutasi,
			// 		'status' => 1,
			// 	));
			// 	$this->mt_production_detail->create($dm);
			// }

			
			$fg = $this->mt_production->getFg($t_production->id_job);
			foreach ($fg as $detail_fg) {
				$d = a2o($detail_fg);
				$wh_detail = NULL;
				$seri_barang = NULL;
				$dfg=a2o(array(
					'id_production' => $id_production,
					'id_job' => $t_production->id_job,
					'id_wh_detail' => $wh_detail,
					'kode_produksi' => $production->kode_mutasi,
					'SERI_BARANG' => $seri_barang,
					'id_sub_barang' => $d->id_sub_barang,
					'id_jenis_mutasi' => 14,
					'qty' => $qtyfg,
					'tanggal_produksi' => $production->tanggal_mutasi,
					'status' => 1,
				));
				$this->mt_production_detail->create($dfg);
			}
			$t_production_wip = a2o($this->in->t_production_detail_wip);
			foreach ($t_production_wip as $detail_wip) {
				$d = a2o($detail_wip);
				$wh_detail = NULL;
				$seri_barang = NULL;
				if($d->id_wh_detail) $wh_detail = $d->id_wh_detail;
				if($d->seri_barang) $seri_barang = $d->seri_barang;
				$dwip=a2o(array(
					'id_production' => $id_production,
					'id_job' => $t_production->id_job,
					'id_wh_detail' => $wh_detail,
					'kode_produksi' => $production->kode_mutasi,
					'SERI_BARANG' => $seri_barang,
					'id_sub_barang' => $d->id_sub_barang,
					'id_jenis_mutasi' => 14,
					'qty' => $d->qty,
					'tanggal_produksi' => $production->tanggal_mutasi,
					'status' => 1,
				));
				$this->mt_production_detail->create($dwip);
			}
			$t_production_waste = a2o($this->in->t_production_detail_waste);
			$numwaste = count((array)$t_production_waste);
			if($numwaste>0){
				$t_production->id_jenis_mutasi = 8;
				$id_production = $this->mt_production->create($t_production);
				$production = $this->mt_production->get($id_production);
				foreach ($t_production_waste as $detail_waste) {
					$d = a2o($detail_waste);
					$wh_detail = NULL;
					$seri_barang = NULL;
					if($d->id_wh_detail) $wh_detail = $d->id_wh_detail;
					if($d->seri_barang) $seri_barang = $d->seri_barang;
					$dwaste=a2o(array(
						'id_production' => $id_production,
						'id_job' => $t_production->id_job,
						'id_wh_detail' => $wh_detail,
						'kode_produksi' => $production->kode_mutasi,
						'SERI_BARANG' => $seri_barang,
						'id_sub_barang' => $d->id_sub_barang,
						'id_jenis_mutasi' => 8,
						'qty' => $d->qty,
						'tanggal_produksi' => $production->tanggal_mutasi,
						'status' => 1,
					));
					$this->mt_production_detail->create($dwaste);
				}
			}
			$t_production_scrap = a2o($this->in->t_production_detail_scrap);
			$numscrap = count((array)$t_production_scrap);
			if($numscrap>0){
				$t_production->id_jenis_mutasi = 11;
				$id_production = $this->mt_production->create($t_production);
				$production = $this->mt_production->get($id_production);
				foreach ($t_production_scrap as $detail_scrap) {
					$d = a2o($detail_scrap);
					$wh_detail = NULL;
					$seri_barang = NULL;
					if($d->id_wh_detail) $wh_detail = $d->id_wh_detail;
					if($d->seri_barang) $seri_barang = $d->seri_barang;
					$dscrap=a2o(array(
						'id_production' => $id_production,
						'id_job' => $t_production->id_job,
						'id_wh_detail' => $wh_detail,
						'kode_produksi' => $production->kode_mutasi,
						'SERI_BARANG' => $seri_barang,
						'id_sub_barang' => $d->id_sub_barang,
						'id_jenis_mutasi' => 11,
						'qty' => $d->qty,
						'tanggal_produksi' => $production->tanggal_mutasi,
						'status' => 1,
					));
					$this->mt_production_detail->create($dscrap);
				}
			}
			$t_production_loss = a2o($this->in->t_production_detail_loss);
			$numloss = count((array)$t_production_loss);
			if($numloss>0){
				$t_production->id_jenis_mutasi = 16;
				$id_production = $this->mt_production->create($t_production);
				$production = $this->mt_production->get($id_production);
				foreach ($t_production_loss as $detail_loss) {
					$d = a2o($detail_loss);
					$wh_detail = NULL;
					$seri_barang = NULL;
					if($d->id_wh_detail) $wh_detail = $d->id_wh_detail;
					if($d->seri_barang) $seri_barang = $d->seri_barang;
					$dloss=a2o(array(
						'id_production' => $id_production,
						'id_job' => $t_production->id_job,
						'id_wh_detail' => $wh_detail,
						'kode_produksi' => $production->kode_mutasi,
						'SERI_BARANG' => $seri_barang,
						'id_sub_barang' => $d->id_sub_barang,
						'id_jenis_mutasi' => 16,
						'qty' => $d->qty,
						'tanggal_produksi' => $production->tanggal_mutasi,
						'status' => 1,
					));
					$this->mt_production_detail->create($dloss);
				}
			}
			$t_production_return = a2o($this->in->t_production_detail_return);
			$sumReturn = 0;
			foreach($t_production_return as $total){
				$sumReturn += $total['qty'];
			}
			if($sumReturn>0){
				$t_production->id_jenis_mutasi = 12;
				$id_production = $this->mt_production->create($t_production);
				$production = $this->mt_production->get($id_production);
				foreach ($t_production_return as $detail_return) {
					$d = a2o($detail_return);
					if($d->qty>=1){
						$wh_detail = NULL;
						$seri_barang = NULL;
						if($d->id_wh_detail) $wh_detail = $d->id_wh_detail;
						if($d->seri_barang) $seri_barang = $d->seri_barang;
						$dreturn=a2o(array(
							'id_production' => $id_production,
							'id_job' => $t_production->id_job,
							'id_wh_detail' => $wh_detail,
							'kode_produksi' => $production->kode_mutasi,
							'SERI_BARANG' => $seri_barang,
							'id_sub_barang' => $d->id_sub_barang,
							'id_jenis_mutasi' => 12,
							'qty' => $d->qty,
							'tanggal_produksi' => $production->tanggal_mutasi,
							'status' => 1,
						));
						$this->mt_production_detail->create($dreturn);
					}
				}
			}
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data realisasi produksi berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data realisasi produksi gagal';
			}
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method.'/');
			
		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'detail'){
			$this->d->realisasi = $this->tproduction_realisasi_request->get2($arg2);
			$this->d->idrealisasi = $arg2;
			
		} else if($this->d->_action == 'print'){
		} else if($this->d->_action == 'detaildt'){
			$res = $this->tproduction_detail_request->viewBasedID($arg2);
			printJSON($res);
		}  else if($this->d->_action == 'viewdt'){
			$res = $this->tproduction_realisasi_request->viewDTpacking($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewitemdt'){
			$res = $this->tproduction_request->viewitemDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewjobDT'){
			modelLoad($this,array('mt_job'));
			$res = $this->mt_job->viewjobdt($this->in);
			printJSON($res);
		} else if($this->d->_action == 'detaildtWip'){
			// printJSON($this->in->id);
			$res = $this->mt_production->viewDetailWIP($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewbarangDT'){
		} else if($this->d->_action == 'approval1'){
			modelLoad($this,array('mt_production_detail','mt_wh_detail','mt_wh'));
			$this->db->trans_start();
			$getfg = $this->mt_production_detail->getFg($_GET['id_p']);

			$t_wh = new stdClass();
			$t_wh->id_jenis_mutasi = 14;

			$t_wh->tanggal_terima = $getfg->tanggal_produksi;
			// $t_wh->id_production = $id_production;
			$t_wh->jenis_transaksi = 'M';
			$t_wh->approval_1 = 1;
			// $t_wh->approval_2 = 1;
			$t_wh->id_user_created = $this->session->get_userdata('id_user');
			$t_wh->id_user_updated = $this->session->get_userdata('id_user');
			$id_wh = $this->mt_wh->create($t_wh);

			$getfg->id_wh = $id_wh;
			unset(	$getfg->tanggal_produksi);
			$this->mt_wh_detail->create($getfg);
			$this->tproduction_realisasi_request->approval1($_GET['id_p']);
			$this->tproduction_realisasi_request->approval1packing($_GET['id_d_p']);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Realization Request berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Realization Request gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$_GET['id_p']);
		} else if($this->d->_action == 'approval2'){
			$this->db->trans_start();
			$this->tproduction_realisasi_request->approval2($_GET['id_p']);
			$this->tproduction_realisasi_request->approval2packing($_GET['id_d_p']);

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Realization Request berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Realization Request gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'disapprove1'){
			$this->db->trans_start();
			$this->tproduction_request->disapprove1($arg2);
			$getpro = $this->tproduction_request->getBy($arg2);
			// printJSON($arg2);
			$kode = $getpro->kode_mutasi;
			$getwh = $this->twarehouse_approval_request->getByCode($kode);
			$id_wh = $getwh->id_wh;
			$this->twarehouse_approval_request->disapprove1($id_wh);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Request Material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'disapprove2'){
		} else if($this->d->_action == 'cancel'){
		} else if($this->d->_action == 'closing'){
		}


		$this->load->view('template_view', $this->d);
	}

	function return_supplier2($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('tproduction_request','twarehouse_approval_request','tproduction_detail_request','twarehouse_detail_approval_request','mt_wh','mm_tipe_sales'));
		if($this->d->_action == 'add'){

		$this->d->_modal = array('return_request', 't_wh_detail_request');

		} else if($this->d->_action == 'store'){
			
		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'detail'){
			$this->d->reqheader = $this->tproduction_request->get($arg2);
		}  else if($this->d->_action == 'print'){
		} else if($this->d->_action == 'detaildt'){
			$res = $this->tproduction_detail_request->viewBasedID($arg2);
			printJSON($res);
		}  else if($this->d->_action == 'viewdt'){
			$res = $this->tproduction_request->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewitemdt'){
			$res = $this->tproduction_request->viewitemDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewjobDT'){
			modelLoad($this,array('mt_job'));
			$res = $this->mt_job->viewjobdt($this->in);
			printJSON($res);
		} 

		$this->load->view('template_view', $this->d);
	}
	
	function realisasi_produksi($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('tproduction_realisasi_request', 'tproduction_detail_realisasi_request', 'mt_production','mt_production_detail', 'mt_job'));
		
		if($this->d->_action == 'add'){
			$this->d->_modal = array('t_job', 't_production_detail_realisasi');
		} else if($this->d->_action == 'store'){
			modelLoad($this,array('mt_detail_po'));
			// printJSON($this->in);
			$this->db->trans_start();
			$t_production = a2o($this->in->t_production);
			$t_production->tanggal_mutasi = $t_production->tanggal_mutasi;
			$t_production->id_jenis_mutasi = 14;
			$id_production = $this->mt_production->create($t_production);
			$production = $this->mt_production->get($id_production);
			$t_production_material = a2o($this->in->t_production_detail_material);
			$t_detail_dn = a2o($this->in->t_detail_dn);
			$qtyfg=$t_detail_dn->qty_realisasi;
			$a = $this->mt_detail_po->get($t_detail_dn->id_detail_po);
			// printJSON($a);
			
				// if ($a->qty_realisasi > 0){
				// 	// $qtyfg=	$t_detail_dn->qty_realisasi;
				// 	$x=  $a->qty_realisasi+ $qtyfg;
				// 	$t_detail_dn->qty_realisasi = $x;
				// 	// printJSON($t_detail_dn->qty_realisasi);
				// 	$detail_po = $this->mt_detail_po->update($t_detail_dn);
				// }else{
					
				// 	$detail_po = $this->mt_detail_po->update($t_detail_dn);
				// }
			
			

			foreach ($t_production_material as $detail_material) {
				$d = a2o($detail_material);
				$dm=a2o(array(
					'id_production' => $id_production,
					'id_job' => $t_production->id_job,
					'id_wh_detail' => $d->id_wh_detail,
					'kode_produksi' => $production->kode_mutasi,
					'SERI_BARANG' => $d->seri_barang,
					'id_sub_barang' => $d->id_sub_barang,
					'id_jenis_mutasi' => 14,
					'qty' => $d->qty,
					'tanggal_produksi' => $production->tanggal_mutasi,
					'status' => 1,
				));
				$this->mt_production_detail->create($dm);
			}
			$fg = $this->mt_production->getFg($t_production->id_job);
			foreach ($fg as $detail_fg) {
				$d = a2o($detail_fg);
				$wh_detail = NULL;
				$seri_barang = NULL;
				$dfg=a2o(array(
					'id_production' => $id_production,
					'id_job' => $t_production->id_job,
					'id_wh_detail' => $wh_detail,
					'kode_produksi' => $production->kode_mutasi,
					'SERI_BARANG' => $seri_barang,
					'id_sub_barang' => $d->id_sub_barang,
					'id_jenis_mutasi' => 14,
					'qty' => $qtyfg,
					'tanggal_produksi' => $production->tanggal_mutasi,
					'status' => 1,
				));
				$this->mt_production_detail->create($dfg);
			}
			$t_production_wip = a2o($this->in->t_production_detail_wip);
			foreach ($t_production_wip as $detail_wip) {
				$d = a2o($detail_wip);
				$wh_detail = NULL;
				$seri_barang = NULL;
				if($d->id_wh_detail) $wh_detail = $d->id_wh_detail;
				if($d->seri_barang) $seri_barang = $d->seri_barang;
				$dwip=a2o(array(
					'id_production' => $id_production,
					'id_job' => $t_production->id_job,
					'id_wh_detail' => $wh_detail,
					'kode_produksi' => $production->kode_mutasi,
					'SERI_BARANG' => $seri_barang,
					'id_sub_barang' => $d->id_sub_barang,
					'id_jenis_mutasi' => 14,
					'qty' => $d->qty,
					'tanggal_produksi' => $production->tanggal_mutasi,
					'status' => 1,
				));
				$this->mt_production_detail->create($dwip);
			}
			$t_production_waste = a2o($this->in->t_production_detail_waste);
			$numwaste = count((array)$t_production_waste);
			if($numwaste>0){
				$t_production->id_jenis_mutasi = 8;
				$id_production = $this->mt_production->create($t_production);
				$production = $this->mt_production->get($id_production);
				foreach ($t_production_waste as $detail_waste) {
					$d = a2o($detail_waste);
					$wh_detail = NULL;
					$seri_barang = NULL;
					if($d->id_wh_detail) $wh_detail = $d->id_wh_detail;
					if($d->seri_barang) $seri_barang = $d->seri_barang;
					$dwaste=a2o(array(
						'id_production' => $id_production,
						'id_job' => $t_production->id_job,
						'id_wh_detail' => $wh_detail,
						'kode_produksi' => $production->kode_mutasi,
						'SERI_BARANG' => $seri_barang,
						'id_sub_barang' => $d->id_sub_barang,
						'id_jenis_mutasi' => 8,
						'qty' => $d->qty,
						'tanggal_produksi' => $production->tanggal_mutasi,
						'status' => 1,
					));
					$this->mt_production_detail->create($dwaste);
				}
			}
			$t_production_scrap = a2o($this->in->t_production_detail_scrap);
			$numscrap = count((array)$t_production_scrap);
			if($numscrap>0){
				$t_production->id_jenis_mutasi = 11;
				$id_production = $this->mt_production->create($t_production);
				$production = $this->mt_production->get($id_production);
				foreach ($t_production_scrap as $detail_scrap) {
					$d = a2o($detail_scrap);
					$wh_detail = NULL;
					$seri_barang = NULL;
					if($d->id_wh_detail) $wh_detail = $d->id_wh_detail;
					if($d->seri_barang) $seri_barang = $d->seri_barang;
					$dscrap=a2o(array(
						'id_production' => $id_production,
						'id_job' => $t_production->id_job,
						'id_wh_detail' => $wh_detail,
						'kode_produksi' => $production->kode_mutasi,
						'SERI_BARANG' => $seri_barang,
						'id_sub_barang' => $d->id_sub_barang,
						'id_jenis_mutasi' => 11,
						'qty' => $d->qty,
						'tanggal_produksi' => $production->tanggal_mutasi,
						'status' => 1,
					));
					$this->mt_production_detail->create($dscrap);
				}
			}
			$t_production_loss = a2o($this->in->t_production_detail_loss);
			$numloss = count((array)$t_production_loss);
			if($numloss>0){
				$t_production->id_jenis_mutasi = 16;
				$id_production = $this->mt_production->create($t_production);
				$production = $this->mt_production->get($id_production);
				foreach ($t_production_loss as $detail_loss) {
					$d = a2o($detail_loss);
					$wh_detail = NULL;
					$seri_barang = NULL;
					if($d->id_wh_detail) $wh_detail = $d->id_wh_detail;
					if($d->seri_barang) $seri_barang = $d->seri_barang;
					$dloss=a2o(array(
						'id_production' => $id_production,
						'id_job' => $t_production->id_job,
						'id_wh_detail' => $wh_detail,
						'kode_produksi' => $production->kode_mutasi,
						'SERI_BARANG' => $seri_barang,
						'id_sub_barang' => $d->id_sub_barang,
						'id_jenis_mutasi' => 16,
						'qty' => $d->qty,
						'tanggal_produksi' => $production->tanggal_mutasi,
						'status' => 1,
					));
					$this->mt_production_detail->create($dloss);
				}
			}
			$t_production_return = a2o($this->in->t_production_detail_return);
			$sumReturn = 0;
			foreach($t_production_return as $total){
				$sumReturn += $total['qty'];
			}
			if($sumReturn>0){
				$t_production->id_jenis_mutasi = 12;
				$id_production = $this->mt_production->create($t_production);
				$production = $this->mt_production->get($id_production);
				foreach ($t_production_return as $detail_return) {
					$d = a2o($detail_return);
					if($d->qty>=1){
						$wh_detail = NULL;
						$seri_barang = NULL;
						if($d->id_wh_detail) $wh_detail = $d->id_wh_detail;
						if($d->seri_barang) $seri_barang = $d->seri_barang;
						$dreturn=a2o(array(
							'id_production' => $id_production,
							'id_job' => $t_production->id_job,
							'id_wh_detail' => $wh_detail,
							'kode_produksi' => $production->kode_mutasi,
							'SERI_BARANG' => $seri_barang,
							'id_sub_barang' => $d->id_sub_barang,
							'id_jenis_mutasi' => 12,
							'qty' => $d->qty,
							'tanggal_produksi' => $production->tanggal_mutasi,
							'status' => 1,
						));
						$this->mt_production_detail->create($dreturn);
					}
				}
			}
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data realisasi produksi berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data realisasi produksi gagal';
			}
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method.'/');
		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'detail'){
			$this->d->realisasi = $this->tproduction_realisasi_request->get($arg2);
			$this->d->idrealisasi = $arg2;
		} else if($this->d->_action == 'print'){
		} else if($this->d->_action == 'detaildtMaterial'){
			$res = $this->tproduction_realisasi_request->viewBasedID($arg2, 1);
			printJSON($res);
		} else if($this->d->_action == 'detaildtFg'){
			// printJSON($arg2);
			$res = $this->mt_production->viewDetailFg($this->in);
			printJSON($res);
		} else if($this->d->_action == 'detaildtWip'){
			$res = $this->mt_production->viewDetailWIP($this->in);
			printJSON($res);
		} else if($this->d->_action == 'detaildtWip2'){
			$data = $this->input->post();
			$res = $this->tproduction_realisasi_request->viewBasedID21($data['id'], 14);
			printJSON($res);
		} else if($this->d->_action == 'detaildtScrap'){
			$res = $this->tproduction_realisasi_request->viewBasedID2($arg2, 11);
			printJSON($res);
		} else if($this->d->_action == 'detaildtWaste'){
			$res = $this->tproduction_realisasi_request->viewBasedID2($arg2, 8);
			printJSON($res);
		} else if($this->d->_action == 'detaildtReturn'){
			$res = $this->tproduction_realisasi_request->viewBasedID2($arg2, 12);
			printJSON($res);
		} else if($this->d->_action == 'detaildtLoss'){
			$res = $this->tproduction_realisasi_request->viewBasedID2($arg2, 16);
			printJSON($res);
		} else if($this->d->_action == 'viewdt'){
			$res = $this->tproduction_realisasi_request->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewdtItemMaterial'){
			$res = $this->mt_production->viewDTMaterial($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewdtItemWip'){
			$res = $this->mt_production->viewDtRealisasi(14);
			// $res = $this->mt_production->viewDTMaterial($this->in);

			printJSON($res);
		} else if($this->d->_action == 'viewdtItemScrap'){
			$res = $this->mt_production->viewDtRealisasi(11);
			printJSON($res);
		} else if($this->d->_action == 'viewdtItemWaste'){
			$res = $this->mt_production->viewDtRealisasi(8);
			printJSON($res);
		} else if($this->d->_action == 'viewdtItemLoss'){
			$res = $this->mt_production->viewDtRealisasi(16);
			printJSON($res);
		} else if($this->d->_action == 'viewdtItemFg'){
			$res = $this->mt_production->viewDTFg($this->in);
			printJSON($res);
		} else if($this->d->_action == 'getJob'){
			$res = $this->mt_job->getNo($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewitemdt'){
			$res = $this->tproduction_request->viewitemDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewjobDT'){
			modelLoad($this,array('mt_job'));
			$res = $this->mt_job->viewjobdt($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewbarangDT'){
		} else if($this->d->_action == 'approval1'){
			modelLoad($this,array('mt_production_detail','mt_wh_detail','mt_wh','mt_detail_po'));
			$this->db->trans_start();
			$getfg = $this->mt_production_detail->getFg($arg2);
			// printJSON($getfg);
			$t_wh = new stdClass();
			$t_wh->id_jenis_mutasi = 14;

			$t_wh->tanggal_terima = $getfg->tanggal_produksi;
			// $t_wh->id_production = $id_production;
			$t_wh->jenis_transaksi = 'M';
			$t_wh->approval_1 = 1;
			// $t_wh->approval_2 = 1;
			$t_wh->id_user_created = $this->session->get_userdata('id_user');
			$t_wh->id_user_updated = $this->session->get_userdata('id_user');
			$id_wh = $this->mt_wh->create($t_wh);

			$getfg->id_wh = $id_wh;
			unset(	$getfg->tanggal_produksi);
			$this->mt_wh_detail->create($getfg);
			$detail_po = $this->mt_detail_po->update($t_detail_dn);
			$this->tproduction_realisasi_request->approval1($arg2);

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Realization Request berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Realization Request gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'disapprove1'){
			$this->db->trans_start();
			$this->tproduction_realisasi_request->disapprove($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Disapprove data Realization Request berhasil';
			} else {
				$s->status = false;
				$s->message = 'Disapprove data Realization Request gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'cancel'){
		} else if($this->d->_action == 'closing'){
			$this->db->trans_start();
			$this->tproduction_realisasi_request->closing($arg2);
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Closing data Realization Request berhasil';
			} else {
				$s->status = false;
				$s->message = 'Closing data Realization Request gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		}

		$this->load->view('template_view', $this->d);
	}

	function approval_realisasi_produksi($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('tproduction_approval_realisasi', 'tproduction_realisasi_request'));
		if($this->d->_action == 'add'){

		$this->d->_modal = array('t_job');

		} else if($this->d->_action == 'store'){
			
		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'detail'){
			$this->d->realisasi = $this->tproduction_approval_realisasi->get($arg2);
			$this->d->idrealisasi = $arg2;
		} else if($this->d->_action == 'print'){
		} else if($this->d->_action == 'detaildt'){
			$res = $this->tproduction_detail_request->viewBasedID($arg2);
			printJSON($res);
		}  else if($this->d->_action == 'viewdt'){
			$res = $this->tproduction_approval_realisasi->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewitemdt'){
			$res = $this->tproduction_request->viewitemDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewjobDT'){
			modelLoad($this,array('mt_job'));
			$res = $this->mt_job->viewjobdt($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewbarangDT'){
		} else if($this->d->_action == 'approval2'){
			$this->db->trans_start();
			$a = $this->tproduction_realisasi_request->approval1cek($arg2);
			// printJSON($a);
			$x=0;
			if ($a->qty_realisasi > 0 || $a->qty_realisasi = ''){
				// $qtyfg=	$t_detail_dn->qty_realisasi;
				$x=  $a->qty_realisasi + $a->qty;
				// / printJSON($t_detail_dn->qty_realisasi);
					
				$array = array(
					'id_detail_dn' => $a->id_detail_po,
					'qty_realisasi' => $x,
					// 'status' => $status
				);


				$detail_po = $this->mt_detail_po->update($t_detail_dn);
			}else{
				$array = array(
					'id_detail_dn' => $a->id_detail_po,
					'qty_realisasi' => $a->qty,
					// 'status' => $status
				);
					$detail_po = $this->mt_detail_po->update($t_detail_dn);
			}
			$this->tproduction_realisasi_request->approval2($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Realization Request berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Realization Request gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'cancel'){
		} else if($this->d->_action == 'closing'){
            $this->db->trans_start();
			$id_wh = $this->tproduction_approval_realisasi->create($arg2);
            $dataItem = $this->tproduction_approval_realisasi->getItem($arg2);
            print_r($dataItem);
			foreach ($dataItem as $data) {
                $d = $data;
                $dwh = a2o(array(
                    'id_wh' => $id_wh,
                    'id_job' => $d->id_job,
                    'id_sub_barang' => $d->id_sub_barang,
                    'id_satuan_terbesar' => $d->id_satuan_terbesar,
                    'id_satuan_terkecil' => $d->id_satuan_terkecil,
                    'rate' => $d->rate,
                    'harga_satuan' => $d->harga_satuan,
                    'qty' => $d->qty,
                    'seri_barang' => $d->SERI_BARANG
                ));
				$this->tproduction_approval_realisasi->createDetail($dwh);
            }
			$this->tproduction_realisasi_request->closing($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Closing data Realization Request berhasil';
			} else {
				$s->status = false;
				$s->message = 'Closing data Realization Request gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		}

		$this->load->view('template_view', $this->d);
	}

	function request_produksi($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('mt_production','mt_production_detail','tproduction_request','twarehouse_approval_request','tproduction_detail_request','twarehouse_detail_approval_request','mt_wh', 'mt_wh_detail', 'mm_workflow', 'mt_bom_workflow', 'mt_doc_repo'));
		if($this->d->_action == 'add'){

		$this->d->_modal = array('t_job','t_wh_detail_request');
		modelLoad($this,array('mm_bagian','mm_jenis_mutasi'));
		$this->d->sbagian = $this->mm_bagian->view();
		$this->d->sjenis_mutasi = $this->mm_jenis_mutasi->view();

		} else if($this->d->_action == 'store'){
			// printJSON($this->in);
			$this->db->trans_start();
			$t_production = a2o($this->in->t_production);
			$t_production->tanggal_mutasi = reverseDate($t_production->tanggal_mutasi);
			$t_production->id_jenis_mutasi = 13;
			$id_production = $this->mt_production->create($t_production);
			$tgl_prod= $t_production->tanggal_mutasi;

			$mt_bom_workflow = $this->mt_bom_workflow->get($t_production->id_job);
			// $m_workflow = $this->mm_workflow->get($mt_bom_workflow->id_workflow);

			$t_wh = new stdClass();
			$t_wh->id_jenis_mutasi = 13;
			$t_wh->tanggal_terima = $t_production->tanggal_mutasi;
			// $t_wh->id_production = $id_production;
			$t_wh->jenis_transaksi = 'T';
			// $t_wh->approval_1 = 1;
			// $t_wh->approval_2 = 1;
			$t_wh->id_user_created = $this->session->get_userdata('id_user');
			$t_wh->id_user_updated = $this->session->get_userdata('id_user');
			$id_wh = $this->mt_wh->create($t_wh);

			$this->mt_doc_repo->deleteWhere(array(
				'id_production' => $id_production
			));

			$t_production_detail = a2o($this->in->t_production_detail);
			
			$total_harga_material = 0;
			foreach ($t_production_detail as $detail) {
				$d = a2o($detail);
				$d->id_production = $id_production;

				
				$t_wh_detail = a2o(array(
					'id_wh' => $id_wh,
					'id_detail_dn' => $d->id_detail_dn,
					'id_job' => $d->id_job,
					'id_production' => $d->id_production,
					'id_sub_barang' => $d->id_sub_barang,
					'id_satuan_terkecil' => $d->id_satuan,
					'id_satuan_terbesar' => $d->id_satuan,
					'id_header'=>$d->id_header,
					'harga_satuan' => $d->harga_satuan,
					
					'rate' => $d->rate,
					'qty' => $d->qty,
					'id_koordinat' => $d->id_koordinat
				));

				$id_wh_detail = $this->mt_wh_detail->create($t_wh_detail);
				$tp=a2o(array(
					'id_job' => $d->id_job,
					'id_wh_detail' => $id_wh_detail,
					'harga_satuan' => $d->harga_satuan,
					'id_jenis_mutasi' => 13,
					'id_sub_barang' => $d->id_sub_barang,
					'seri_barang' => $d->seri_barang,
					'qty' => $d->qty,
					'tanggal_produksi'=> $tgl_prod,
					'id_production' => $d->id_production
				));
				$this->mt_production_detail->create($tp);
				if (empty($d->id_production)) {
				
					$this->mt_doc_repo->create(a2o(array(
						'id_bom' => $t_production->id_job,
						'id_production' => $id_production,
						'id_detail_dn' => $d->id_detail_dn,
						'id_sub_barang' => $d->id_sub_barang,
						'id_satuan' => $d->id_satuan,
						'qty' => $d->qty_detail
					)));
				} else {
					$t_doc_repo = $this->mt_doc_repo->viewBasedProductionId($d->id_production);
					
					// $d->id_satuan = $t_production_d->id_satuan;
					foreach ($t_doc_repo as $doc_repo) {
						$this->mt_doc_repo->create(a2o(array(
							'id_bom' => $t_production->id_job,
							'id_production' => $id_production,
							'id_detail_dn' => $doc_repo->id_detail_dn,
							'id_sub_barang' => $doc_repo->id_sub_barang,
							'id_satuan' => $doc_repo->id_satuan,
							'qty' => $doc_repo->qty
						)));
					}
				}
			
				// $t_wh_detail = a2o(array(
				// 	'id_wh' => $id_wh,
				// 	'id_detail_dn' => $d->id_detail_dn,
				// 	'id_job' => $d->id_job,
				// 	'id_production' => $d->id_production,
				// 	'id_sub_barang' => $d->id_sub_barang,
				// 	'id_satuan_terkecil' => $d->id_satuan,
				// 	'id_satuan_terbesar' => $d->id_satuan,
				// 	'id_header'=>$d->id_header,
				// 	'harga_satuan' => $d->harga_satuan,
					
				// 	'rate' => $d->rate,
				// 	'qty' => $d->qty,
				// 	'id_koordinat' => $d->id_koordinat
				// ));

				// $this->mt_wh_detail->create($t_wh_detail);

				// $total_harga_material += floatval($d->harga_satuan * $d->rate * $d->qty_detail);
			}
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data request produksi berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data request produksi gagal';
			}
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method.'/detail/'.$id_production);

			
		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){
			$this->db->trans_start();
			$this->tproduction_request->delete($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Hapus data Request Produksi berhasil';
			} else {
				$s->status = false;
				$s->message = 'Hapus data Request Produksi gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);


		} else if($this->d->_action == 'detail'){
			$this->d->reqheader = $this->tproduction_request->get($arg2);
		}  else if($this->d->_action == 'print'){
		} else if($this->d->_action == 'detaildt'){
			$res = $this->tproduction_detail_request->viewBasedID($arg2);
			printJSON($res);
		}  else if($this->d->_action == 'viewdt'){
			$res = $this->tproduction_request->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewitemdt'){
			$res = $this->tproduction_request->viewitemDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewjobDT'){
			modelLoad($this,array('mt_job'));
			$res = $this->mt_job->viewjobdt($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewbarangDT'){
		} else if($this->d->_action == 'approval1'){
			$this->db->trans_start();
			// $this->tproduction_request->approval1($arg2);
			$getpro = $this->tproduction_request->get($arg2);
		
			$kode = $getpro->kode_mutasi;
			$getwh = $this->twarehouse_approval_request->getByCode($kode);
			$id_wh = $getwh->id_wh;
			$this->twarehouse_approval_request->approval1($id_wh);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Request Material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'approval2'){
			$this->db->trans_start();
			$this->twarehouse_approval_request->approval2($arg2);
			$getwh = $this->twarehouse_approval_request->get($arg2);
			$kode = $getwh->kode_mutasi;
			$getpro = $this->tproduction_request->getIDByCode($kode);
			$id_production = $getpro->id_production;
			$this->tproduction_request->approval2($id_production);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Request Material gagal';
			}
			setNotification($this, $s);
			redirect('warehouse/approval_request/detail/'.$arg2);
		} else if($this->d->_action == 'disapprove1'){
			$this->db->trans_start();
			$this->tproduction_request->disapprove1($arg2);
			$getpro = $this->tproduction_request->get($arg2);
			$kode = $getpro->kode_mutasi;
			$getwh = $this->twarehouse_approval_request->getByCode($kode);
			$id_wh = $getwh->id_wh;
			$this->twarehouse_approval_request->disapprove1($id_wh);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Request Material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'disapprove2'){
			$this->db->trans_start();
			$this->twarehouse_approval_request->disapprove2($arg2);
			$getwh = $this->twarehouse_approval_request->get($arg2);
			$kode = $getwh->kode_mutasi;
			$getpro = $this->tproduction_request->getIDByCode($kode);
			$id_production = $getpro->id_production;
			$this->tproduction_request->disapprove2($id_production);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Request Material gagal';
			}
			setNotification($this, $s);
			redirect('warehouse/approval_request/detail/'.$arg2);
		} else if($this->d->_action == 'cancel'){
			$this->db->trans_start();
			$this->tproduction_request->cancel($arg2);
			$getpro = $this->tproduction_request->get($arg2);
			$kode = $getpro->kode_mutasi;
			$getwh = $this->twarehouse_approval_request->getByCode($kode);
			$id_wh = $getwh->id_wh;
			$this->twarehouse_approval_request->cancel($id_wh);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Cancel data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Cancel data Request Material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'closing'){
			$this->db->trans_start();
			$this->tproduction_request->closing($arg2);
			$getpro = $this->tproduction_request->get($arg2);
			$kode = $getpro->kode_mutasi;
			$getwh = $this->twarehouse_approval_request->getByCode($kode);
			$id_wh = $getwh->id_wh;
			$this->twarehouse_approval_request->closing($id_wh);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Closing data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Closing data Request Material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		}

		$this->load->view('template_view', $this->d);
	}
	
	function request_material($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('tproduction_request','twarehouse_approval_request','tproduction_detail_request','twarehouse_detail_approval_request','mt_wh'));
		if($this->d->_action == 'add'){

		$this->d->_modal = array('t_job','t_wh_detail_request');
		modelLoad($this,array('mm_bagian','mm_jenis_mutasi'));
		$this->d->sbagian = $this->mm_bagian->view();
		$this->d->sjenis_mutasi = $this->mm_jenis_mutasi->view();

		} else if($this->d->_action == 'store'){
			$this->db->trans_start();

			$production = a2o($this->in->t_production);
			$production->tanggal_mutasi = reverseDate($production->tanggal_mutasi);
			$code = $this->tproduction_request->generateCode($production->tanggal_mutasi);
			$production->kode_mutasi = $code;
			$id_production = $this->tproduction_request->create($production);

			$production_detail = a2o($this->in->t_production_detail);

			$wh_detail = $production_detail;
			$i = 1;
			foreach ($production_detail as $row){
				$row = a2o($row);
				$row->id_production = $id_production;
				$id_master = $row->id_wh;
				$row->tanggal_produksi = $production->tanggal_mutasi;
				unset($row->id_wh,$row->id_detail_dn,$row->id_header);
				$i++;
				$this->tproduction_detail_request->create($row);
			}

			$wh = new stdClass();
			$wh->jenis_transaksi = 'T';
			$wh->id_jenis_mutasi = '13';
			$wh->tanggal_terima = $production->tanggal_mutasi;
			$wh->kode_mutasi = $code;
			$wh->id_master = $id_master;
			$id_wh = $this->twarehouse_approval_request->create($wh);

			$wh_detail = a2o($wh_detail);
			foreach ($wh_detail as $row){
				$row = a2o($row);
				$row->id_wh = $id_wh;
				unset($row->id_wh_detail,$row->id_job,$row->id_jenis_mutasi);
				$this->twarehouse_detail_approval_request->create($row);
			}

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data Request Material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'detail'){
			$this->d->reqheader = $this->tproduction_request->get($arg2);

		}  else if($this->d->_action == 'print'){
			$this->d->app = getAppSetting($this);
			$this->d->reqheader = $this->tproduction_request->get($arg2);
			$this->d->reqdetail = $this->tproduction_detail_request->viewPrint($arg2);
			$this->d->idreq = $arg2;
		} else if($this->d->_action == 'detaildt'){
			$res = $this->tproduction_detail_request->viewBasedID($arg2);
			printJSON($res);
		}  else if($this->d->_action == 'viewdt'){
			$res = $this->tproduction_request->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewitemdt'){
			$res = $this->tproduction_request->viewitemDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewjobDT'){
			modelLoad($this,array('mt_job'));
			$res = $this->mt_job->viewjobdt($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewbarangDT'){

		} else if($this->d->_action == 'approval1'){
			$this->db->trans_start();
			$this->tproduction_request->approval1($arg2);
			$getpro = $this->tproduction_request->get($arg2);
			$kode = $getpro->kode_mutasi;
			$getwh = $this->twarehouse_approval_request->getByCode($kode);
			$id_wh = $getwh->id_wh;
			$this->twarehouse_approval_request->approval1($id_wh);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Request Material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'approval2'){
			$this->db->trans_start();
			$this->twarehouse_approval_request->approval2($arg2);
			$getwh = $this->twarehouse_approval_request->get($arg2);
			$kode = $getwh->kode_mutasi;
			$getpro = $this->tproduction_request->getIDByCode($kode);
			$id_production = $getpro->id_production;
			$this->tproduction_request->approval2($id_production);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Request Material gagal';
			}
			setNotification($this, $s);
			redirect('warehouse/approval_request/detail/'.$arg2);
		} else if($this->d->_action == 'disapprove1'){
			$this->db->trans_start();
			$this->tproduction_request->disapprove1($arg2);
			$getpro = $this->tproduction_request->get($arg2);
			$kode = $getpro->kode_mutasi;
			$getwh = $this->twarehouse_approval_request->getByCode($kode);
			$id_wh = $getwh->id_wh;
			$this->twarehouse_approval_request->disapprove1($id_wh);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Request Material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'disapprove2'){
			$this->db->trans_start();
			$this->twarehouse_approval_request->disapprove2($arg2);
			$getwh = $this->twarehouse_approval_request->get($arg2);
			$kode = $getwh->kode_mutasi;
			$getpro = $this->tproduction_request->getIDByCode($kode);
			$id_production = $getpro->id_production;
			$this->tproduction_request->disapprove2($id_production);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Request Material gagal';
			}
			setNotification($this, $s);
			redirect('warehouse/approval_request/detail/'.$arg2);
		} else if($this->d->_action == 'cancel'){
			$this->db->trans_start();
			$this->tproduction_request->cancel($arg2);
			$getpro = $this->tproduction_request->get($arg2);
			$kode = $getpro->kode_mutasi;
			$getwh = $this->twarehouse_approval_request->getByCode($kode);
			$id_wh = $getwh->id_wh;
			$this->twarehouse_approval_request->cancel($id_wh);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Cancel data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Cancel data Request Material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'closing'){
			$this->db->trans_start();
			$this->tproduction_request->closing($arg2);
			$getpro = $this->tproduction_request->get($arg2);
			$kode = $getpro->kode_mutasi;
			$getwh = $this->twarehouse_approval_request->getByCode($kode);
			$id_wh = $getwh->id_wh;
			$this->twarehouse_approval_request->closing($id_wh);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Closing data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Closing data Request Material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		}


		$this->load->view('template_view', $this->d);
	}
	
	function realisasi_request_material($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('tproduction_realisasi_request','tproduction_request','tproduction_detail_request','mt_job','twarehouse_approval_request','twarehouse_realisasi_request','twarehouse_detail_realisasi_request'));
		if($this->d->_action == 'add'){

			$id = $this->in->id_production;
			modelLoad($this,array('mm_bagian','mm_jenis_mutasi'));
			$this->d->sbagian = $this->mm_bagian->view();
			$this->d->sjenis_mutasi = $this->mm_jenis_mutasi->view();
			$this->d->requestheader = $this->tproduction_request->get($id);
			$this->d->requestdetail = $this->tproduction_detail_request->viewRlz($id);
			$req = $this->d->requestheader;
			$this->d->jobdt = $this->mt_job->get($req->id_job);

		} else if($this->d->_action == 'add_filter'){
			$this->d->_modal = array('realisasi_request');
		} else if($this->d->_action == 'store'){
			$this->db->trans_start();

			$realisasi = a2o($this->in->t_production);
			$tanggal = reverseDate($realisasi->tanggal_mutasi);
			$realisasi->tanggal_mutasi = $tanggal;
			$id_master_production = $realisasi->id_master;
			$masterdata = $this->tproduction_request->get($id_master_production);
			$whdata = $this->twarehouse_realisasi_request->getIDByCode($masterdata->kode_mutasi);
			$id_master_wh = $whdata->id_master;

			$code = $this->tproduction_realisasi_request->generateCode($realisasi->tanggal_mutasi);
			$realisasi->kode_mutasi  = $code;
			$id_production = $this->tproduction_request->create($realisasi);

			$realisasi_detail = a2o($this->in->tproduction_detail);

			$wh_detail = $realisasi_detail;
			foreach ($realisasi_detail as $row){
				$row = a2o($row);
				$row->id_production = $id_production;
				$this->tproduction_detail_request->create($row);
			}

			$wh = new stdClass();
			$wh->id_master = $id_master_wh;
			$wh->jenis_transaksi = 'T';
			$wh->id_jenis_mutasi ='14';
			$wh->tanggal_terima = $tanggal;
			$wh->kode_mutasi = $code;
			$id_wh = $this->twarehouse_realisasi_request->create($wh);

			foreach ($wh_detail as $row){
				$row = a2o($row);
				$row->seri_barang = $row->SERI_BARANG;
				$getheader = $this->twarehouse_detail_realisasi_request->viewByWHID($id_master_wh,$row->SERI_BARANG);
				$row->id_header = $getheader->id_header;
				$row->id_wh = $id_wh;
				unset($row->id_wh_detail,$row->id_job,$row->id_jenis_mutasi,$row->SERI_BARANG);
				$this->twarehouse_detail_realisasi_request->create($row);
			}

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data Realisasi Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data Realisasi Material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'detail'){
			$this->d->rlzheader = $this->tproduction_realisasi_request->get($arg2);

		} else if($this->d->_action == 'print'){
			$this->d->app = getAppSetting($this);
			$this->d->rlzheader = $this->tproduction_realisasi_request->get($arg2);
			$this->d->rlzdetail = $this->tproduction_detail_request->viewPrint($arg2);
			$this->d->idrlz = $arg2;
		} else if($this->d->_action == 'detaildt'){
			$res = $this->tproduction_detail_request->viewBasedID($arg2);
			printJSON($res);
		} else if($this->d->_action == 'viewrequestdt'){
			$res = $this->tproduction_request->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewdt'){
			$res = $this->tproduction_realisasi_request->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		} else if($this->d->_action == 'approval1'){
			$this->db->trans_start();
			$this->tproduction_request->approval1($arg2);
			$getpro = $this->tproduction_realisasi_request->get($arg2);
			$kode = $getpro->kode_mutasi;
			$getwh = $this->twarehouse_approval_request->getByCode($kode);
			$id_wh = $getwh->id_wh;
			$this->twarehouse_approval_request->approval1($id_wh);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Request Material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'approval2'){
			$this->db->trans_start();
			$this->twarehouse_realisasi_request->approval2($arg2);
			$getwh = $this->twarehouse_realisasi_request->get($arg2);
			$kode = $getwh->kode_mutasi;
			$getpro = $this->tproduction_realisasi_request->getIDByCode($kode);
			$id_production = $getpro->id_production;
			$this->tproduction_request->approval2($id_production);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Request Material gagal';
			}
			setNotification($this, $s);
			redirect('warehouse/approval_realisasi/detail/'.$arg2);
		} else if($this->d->_action == 'disapprove1'){
			$this->db->trans_start();
			$this->tproduction_request->disapprove1($arg2);
			$get = $this->tproduction_realisasi_request->get($arg2);
			$kode = $get->kode_mutasi;
			$getid = $this->twarehouse_realisasi_request->getIDByCode($kode);
			$id = $getid->id_wh;
			$this->twarehouse_realisasi_request->disapprove1($id);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Request Material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'disapprove2'){
			$this->db->trans_start();
			$this->twarehouse_realisasi_request->disapprove2($arg2);
			$getwh = $this->twarehouse_realisasi_request->get($arg2);
			$kode = $getwh->kode_mutasi;
			$getpro = $this->tproduction_realisasi_request->getIDByCode($kode);
			$id_production = $getpro->id_production;
			$this->tproduction_request->disapprove2($id_production);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Request Material gagal';
			}
			setNotification($this, $s);
			redirect('warehouse/approval_realisasi/detail/'.$arg2);
		} else if($this->d->_action == 'cancel'){
			$this->db->trans_start();
			$this->tproduction_request->cancel($arg2);
			$get = a2o($this->tproduction_request->get($arg2));
			$kode = $get->kode_mutasi;
			$this->twarehouse_approval_request->cancel($kode);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Cancel data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Cancel data Request Material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'closing'){
			$this->db->trans_start();
			$this->tproduction_request->closing($arg2);
			$get = a2o($this->tproduction_request->get($arg2));
			$kode = $get->kode_mutasi;
			$this->twarehouse_approval_request->closing($kode);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Closing data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Closing data Request Material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		}

		$this->load->view('template_view', $this->d);
	}
	function return_request_material($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('tproduction_request','tproduction_detail_request','mt_job','tproduction_return_request','twarehouse_realisasi_request','twarehouse_detail_realisasi_request','twarehouse_approval_request','twarehouse_return_request'));
		if($this->d->_action == 'add'){
			$id = $this->in->id_production;
			modelLoad($this,array('mm_bagian','mm_jenis_mutasi'));
			$this->d->sbagian = $this->mm_bagian->view();
			$this->d->sjenis_mutasi = $this->mm_jenis_mutasi->view();
			$this->d->requestheader = $this->tproduction_request->get($id);
			$this->d->requestdetail = $this->tproduction_detail_request->viewRlz($id);
			$req = $this->d->requestheader;
			$this->d->jobdt = $this->mt_job->get($req->id_job);

		} else if($this->d->_action == 'add_filter'){
			$this->d->_modal = array('return_request');
		} else if($this->d->_action == 'store'){
			$this->db->trans_start();

			$realisasi = a2o($this->in->t_production);
			$tanggal = reverseDate($realisasi->tanggal_mutasi);
			$realisasi->tanggal_mutasi = $tanggal;
			$id_master_production = $realisasi->id_master;
			$masterdata = $this->tproduction_request->get($id_master_production);
			$whdata = $this->twarehouse_realisasi_request->getIDByCode($masterdata->kode_mutasi);
			$id_master_wh = $whdata->id_master;

			$code = $this->tproduction_return_request->generateCode($realisasi->tanggal_mutasi);
			$realisasi->kode_mutasi = $code;
			$id_production = $this->tproduction_request->create($realisasi);

			$realisasi_detail = a2o($this->in->tproduction_detail);

			$wh_detail = $realisasi_detail;
			foreach ($realisasi_detail as $row){
				$row = a2o($row);
				$row->id_production = $id_production;
				$this->tproduction_detail_request->create($row);
			}

			$wh = new stdClass();
			$wh->id_master = $id_master_wh;
			$wh->jenis_transaksi = 'T';
			$wh->id_jenis_mutasi ='12';
			$wh->tanggal_terima = $tanggal;
			$wh->kode_mutasi = $code;
			$id_wh = $this->twarehouse_realisasi_request->create($wh);

			foreach ($wh_detail as $row){
				$row = a2o($row);
				$row->seri_barang = $row->SERI_BARANG;
				$getheader = $this->twarehouse_detail_realisasi_request->viewByWHID($id_master_wh,$row->SERI_BARANG);
				$row->id_header = $getheader->id_header;
				$row->id_wh = $id_wh;
				unset($row->id_wh_detail,$row->id_job,$row->id_jenis_mutasi,$row->SERI_BARANG);
				$this->twarehouse_detail_realisasi_request->create($row);
			}

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data Request Material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'detail'){
			$this->d->rtnheader = $this->tproduction_return_request->get($arg2);

		} else if($this->d->_action == 'print'){
			$this->d->app = getAppSetting($this);
			$this->d->rtnheader = $this->tproduction_return_request->get($arg2);
			$this->d->rtndetail = $this->tproduction_detail_request->viewPrint($arg2);
			$this->d->idrtn = $arg2;
		} else if($this->d->_action == 'detaildt'){
			$res = $this->tproduction_detail_request->viewBasedID($arg2);
			printJSON($res);
		} else if($this->d->_action == 'viewdt'){
			$res = $this->tproduction_return_request->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewrequestdt'){
			$res = $this->tproduction_request->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'approval1'){
			$this->db->trans_start();
			$this->tproduction_request->approval1($arg2);
			$getpro = $this->tproduction_return_request->get($arg2);
			$kode = $getpro->kode_mutasi;
			$getwh = $this->twarehouse_approval_request->getByCode($kode);
			$id_wh = $getwh->id_wh;
			$this->twarehouse_approval_request->approval1($id_wh);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Request Material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'approval2'){
			$this->db->trans_start();
			$this->twarehouse_return_request->approval2($arg2);
			$getwh = $this->twarehouse_return_request->get($arg2);
			$kode = $getwh->kode_mutasi;
			$getpro = $this->tproduction_return_request->getIDByCode($kode);
			$id_production = $getpro->id_production;
			$this->tproduction_request->approval2($id_production);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Request Material gagal';
			}
			setNotification($this, $s);
			redirect('warehouse/approval_return/detail/'.$arg2);
		} else if($this->d->_action == 'disapprove1'){
			$this->db->trans_start();
			$this->tproduction_request->disapprove1($arg2);
			$get = $this->tproduction_return_request->get($arg2);
			$kode = $get->kode_mutasi;
			$getid = $this->twarehouse_return_request->getIDByCode($kode);
			$id = $getid->id_wh;
			$this->twarehouse_approval_request->disapprove1($id);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Request Material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'disapprove2'){
			$this->db->trans_start();
			$this->twarehouse_return_request->disapprove2($arg2);
			$getwh = $this->twarehouse_return_request->get($arg2);
			$kode = $getwh->kode_mutasi;
			$getpro = $this->tproduction_return_request->getIDByCode($kode);
			$id_production = $getpro->id_production;
			$this->tproduction_request->disapprove2($id_production);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Request Material gagal';
			}
			setNotification($this, $s);
			redirect('warehouse/approval_return/detail/'.$arg2);
		} else if($this->d->_action == 'cancel'){
			$this->db->trans_start();
			$this->tproduction_request->cancel($arg2);
			$get = a2o($this->tproduction_request->get($arg2));
			$kode = $get->kode_mutasi;
			$this->twarehouse_approval_request->cancel($kode);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Cancel data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Cancel data Request Material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'closing'){
			$this->db->trans_start();
			$this->tproduction_request->closing($arg2);
			$get = a2o($this->tproduction_request->get($arg2));
			$kode = $get->kode_mutasi;
			$this->twarehouse_approval_request->closing($kode);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Closing data Request Material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Closing data Request Material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}
	function packing_lama($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;
		$this->load->model('mt_po');
		if($this->d->_action == 'add'){
			$this->d->_modal = array('t_job_packing', 't_production_detail_packing');
			modelLoad($this,array('mm_gudang'));
			$this->d->m_gudang = $this->mm_gudang->view();
		} else if($this->d->_action == 'store'){
			modelLoad($this,array('vt_packing','vt_packing_detail', 'mt_wh', 'mt_wh_detail'));

			$this->db->trans_start();

			$t_production = a2o($this->in->t_production);
			$t_production->id_jenis_mutasi = '1';
			$t_production->tanggal_mutasi = reverseDate($t_production->tanggal_mutasi);
			$t_production->kode_mutasi = $this->vt_packing->generateCode($t_production->tanggal_mutasi);

			//printJSON($this->in->t_production_detail);

			$id = $this->vt_packing->create($t_production);

			$t_production_detail = a2o($this->in->t_production_detail);
			foreach ($t_production_detail as $r) {
				$o = a2o($r);
				$o->id_production = $id;
				$o->id_jenis_mutasi = '1';
				$this->vt_packing_detail->create($o);
			}

			$t_wh = new stdClass();
			$t_wh->jenis_transaksi = 'M';
			$t_wh->tanggal_terima = $t_production->tanggal_mutasi;
			$t_wh->id_jenis_mutasi = $t_production->id_jenis_mutasi;
			$t_wh->kode_mutasi = $t_production->kode_mutasi;

			$id_wh = $this->mt_wh->create($t_wh);
			$t_wh_detail = a2o($this->in->t_wh_detail);
			foreach ($t_wh_detail as $r) {
				$o = a2o($r);
				$o->id_wh = $id_wh;
				$o->id_job = $t_production->id_job;
				$this->mt_wh_detail->create($o);
			}

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data packing berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data packing gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'update'){
			modelLoad($this,array('vt_packing','vt_packing_detail', 'mt_wh', 'mt_wh_detail'));

			$this->db->trans_start();

			$t_production = a2o($this->in->t_production);
			$t_production->tanggal_mutasi = reverseDate($t_production->tanggal_mutasi);

			$this->vt_packing->update($t_production);

			$t_production_detail = a2o($this->in->t_production_detail);
			foreach ($t_production_detail as $r) {
				$o = a2o($r);
				$o->id_production = $t_production->id_production;
				$o->id_jenis_mutasi = '1';
				if (isset($o->id_production_detail)) {
					$this->vt_packing_detail->update($o);
				} else {
					$this->vt_packing_detail->create($o);
				}
			}

			$t_wh_detail = a2o($this->in->t_wh_detail);
			foreach ($t_wh_detail as $r) {
				$o = a2o($r);
				$this->mt_wh_detail->update($o);
			}

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data packing berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data packing gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'edit'){
			$this->d->_modal = array('t_job_packing', 't_production_detail_packing');
			modelLoad($this, array('vt_packing', 'vt_packing_detail', 'mm_gudang', 'mt_wh', 'mt_wh_detail'));
			$this->d->m_gudang = $this->mm_gudang->view();
			$this->d->t_production = $this->vt_packing->get($arg2);
			$this->d->t_production_detail = $this->vt_packing_detail->viewByProductionId($arg2);
		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'detail'){
			modelLoad($this, array('vt_packing', 'vt_packing_detail'));
			$this->d->t_production = $this->vt_packing->get($arg2);
			$this->d->t_production_detail = $this->vt_packing_detail->viewByProductionId($arg2);

		} else if($this->d->_action == 'print'){
			$this->d->app = getAppSetting($this);
			modelLoad($this, array('vt_packing', 'vt_packing_detail'));
			$this->d->t_production = $this->vt_packing -> get($arg2);
			$this->d->t_production_detail = $this->vt_packing_detail->viewByProductionId($arg2);

		} else if($this->d->_action == 'viewdt'){
			modelLoad($this, array('vt_packing'));
			$res = $this->vt_packing->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewremaindt'){
			modelLoad($this,array('mt_production_detail'));
			$res = $this->mt_production_detail->viewPackingDT($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		} else if($this->d->_action == 'viewplanningstuffingdt'){
			modelLoad($this,array('mt_detail_so'));
			$res = $this->mt_detail_so->viewplanningstuffingdt($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewjobdt'){
			modelLoad($this,array('mt_job'));
			$res = $this->mt_job->viewjobdt($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'approve') {
			modelLoad($this, array('vt_packing', 'vt_packing_detail'));
			$t = a2o($this->in);
			$this->db->trans_start();
			$t->date_approval_1 = date('Y-m-d H:i:s');
			$this->vt_packing->update($t);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approve data packing berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approve data packing gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$t->id_production);
		} else if ($this->d->_action == 'approve2') {
			modelLoad($this, array('vt_packing', 'vt_packing_detail'));
			$t = a2o($this->in);
			$this->db->trans_start();
			$t->date_approval_2 = date('Y-m-d H:i:s');
			$this->vt_packing->update($t);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approve data packing berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approve data packing gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$t->id_production);
		}
		$this->load->view('template_view', $this->d);
	}

	function report_packing($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;
		$this->load->model('mt_po');
		$this->d->_modal = array('t_job');
		if($this->d->_action == 'view'){

		} else if($this->d->_action == 'viewdt'){

		}
		$this->load->view('template_view', $this->d);
	}

	function reporting_request_material($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;
		$this->load->model('tproduction_request');
		if($this->d->_action == 'view'){

		} else if($this->d->_action == 'viewdt'){
			$res = $this->tproduction_request->viewReporting($this->in);
			printJSON($res);
		}
		$this->load->view('template_view', $this->d);
	}
}
