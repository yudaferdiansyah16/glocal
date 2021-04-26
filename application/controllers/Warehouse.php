<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends CI_Controller {

    var $d;
    var $in;

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('authenticated') == FALSE) {
            $this->session->sess_destroy();
			redirect('login');
		}
		helper_log();
        if (!isset($_SERVER['HTTP_REFERER']))
            redirect('/');
        $this->d = getSession($this);
        $this->d->_notification = getNotification($this);
        $this->d->_controller = $this->router->fetch_class();
        $this->d->_method = $this->router->fetch_method();
        loadLanguage($this, $this->d->_controller, $this->d->_method);
        $this->in = getPostAsObject($this);
    }

    public function index() {
        $this->load->view('template_view');
    }

	function return_supplier($arg1="", $arg2="")
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
		} else if($this->d->_action == 'print'){
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

	function request_wh($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('twarehouse_request','twarehouse_approval_request','twarehouse_detail_request','twarehouse_detail_approval_request','mt_wh','mm_tipe_sales'));
		if($this->d->_action == 'add'){

		$this->d->_modal = array('t_job','t_wh_detail_request');
		modelLoad($this,array('mm_bagian','mm_jenis_mutasi'));
		$this->d->sbagian = $this->mm_bagian->view();
		$this->d->m_tipe_sales = $this->mm_tipe_sales->view();
		$this->d->sjenis_mutasi = $this->mm_jenis_mutasi->view();

		} else if($this->d->_action == 'store'){
            modelLoad($this,array('mt_request','mt_request_detail'));

            $t = a2o($this->in->t_request);
            $t->id_jenis_mutasi = 13;
            // $t->jenis_transaksi = 'M';
            $t->tgl_request = $t->tgl_request != '' ? reverseDate($t->tgl_request) : null;

            $this->db->trans_start();
            // $this->mt_dn->update($dn);
            $id_request = $this->mt_request->create($t);
            foreach ($this->in->t_request_detail as $i => $detail) {
                $a = a2o($detail);
                $a->id_request = $id_request;
                // $a->user_admin = 9;
                $this->mt_request_detail->create($a);
            }

            // $t_dn = new stdClass();
            // $t_dn->id_dn = $t->id_dn;
            // $t_dn->is_closed = '1';
            // $this->mt_dn->update($t_dn);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data request warehouse berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data request warehouse  gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method.'/detail/'.$id_wh);
			
		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'detail'){
			$this->d->reqheader = $this->twarehouse_request->get($arg2);
		}  else if($this->d->_action == 'print'){
		} else if($this->d->_action == 'detaildt'){         
		    modelLoad($this,array('twarehouse_detail_request'));
			$res = $this->twarehouse_detail_request->viewBasedID($arg2);
			printJSON($res);
		}  else if($this->d->_action == 'viewdt'){
			$res = $this->twarehouse_request->viewDT($this->in);
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
			$this->twarehouse_request->approval1($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval request warehouse berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data request warehouse gagal';
			}
			setNotification($this, $s);
            redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);;
		} else if($this->d->_action == 'approval2'){
			$this->db->trans_start();
			$this->twarehouse_request->approval2($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval request warehouse berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data request warehouse gagal';
			}
			setNotification($this, $s);
            redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);;
		} else if($this->d->_action == 'disapprove1'){
            $this->db->trans_start();
            $this->twarehouse_request->disapprove1($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if($status){
                $s->status = true;
                $s->message = 'Disapprove receive material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Disapprove data receive material gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'disapprove2'){
            $this->db->trans_start();
            $this->twarehouse_request->disapprove2($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if($status){
                $s->status = true;
                $s->message = 'Disapprove receive material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Disapprove data receive material gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
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
	
	function approval_request_produksi($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('tproduction_request','twarehouse_approval_request','tproduction_detail_request','twarehouse_detail_approval_request','mt_wh'));
		if($this->d->_action == 'add'){

		} else if($this->d->_action == 'store'){
			
		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'detail'){
            // $this->d->reqheader = $this->tproduction_request->get($arg2);

			$this->d->reqheader = $this->twarehouse_approval_request->get($arg2);
            $getpro = $this->twarehouse_approval_request->get($arg2);
            //  printJSON($getpro);
			$kode = $getpro->kode_mutasi;
			$this->d->proheader = $this->twarehouse_approval_request->getByCode($kode);
		
		}  else if($this->d->_action == 'viewdt'){
			$res = $this->twarehouse_approval_request->viewDT($this->in);
			printJSON($res);
		}  else if($this->d->_action == 'detaildt'){
			$res = $this->twarehouse_detail_approval_request->viewBasedID($arg2);
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
            redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
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
            redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
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

	function approval_realisasi_produksi($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('tproduction_approval_realisasi', 'tproduction_realisasi_request','twarehouse_approval_request'));
		if($this->d->_action == 'add'){

		$this->d->_modal = array('t_job');

		} else if($this->d->_action == 'store'){
			
		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'detail'){
            $this->d->reqheader = $this->twarehouse_approval_request->getFg($arg2);
            $getpro = $this->twarehouse_approval_request->getFg($arg2);
            //  printJSON($getpro);
			$kode = $getpro->kode_mutasi;
			$this->d->proheader = $this->twarehouse_approval_request->getByCode($kode);
			$this->d->realisasi = $this->tproduction_realisasi_request->get2($getpro->id_production);
			$this->d->idrealisasi = $getpro->id_production;
		} else if($this->d->_action == 'print'){
		} else if($this->d->_action == 'detaildt'){
			$res = $this->tproduction_detail_request->viewBasedID($arg2);
			printJSON($res);
		}  else if($this->d->_action == 'viewdt'){
			$res = $this->twarehouse_approval_request->viewDTpacking($this->in);
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
            modelLoad($this,array('mt_wh','twarehouse_approval_request','mt_production'));
            $this->db->trans_start();
            
            // printJSON($_GET['id_wh']);
            $a=$this->mt_production->getwip($_GET['no_job']);
            $this->twarehouse_approval_request->approval2($_GET['id_wh']);
			$this->tproduction_realisasi_request->approval2($_GET['id_p']);
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
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$_GET['id_wh']);
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

	function approval_packing($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('tproduction_realisasi_request','twarehouse_approval_request','tproduction_request', 'tproduction_detail_realisasi_request', 'mt_production','mt_production_detail', 'mt_job'));
		
		if($this->d->_action == 'add'){
			$this->d->_modal = array('t_job', 't_production_detail_realisasi');

		} else if($this->d->_action == 'store'){
		
			
		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'detail'){
            $this->d->reqheader = $this->twarehouse_approval_request->getFg($arg2);
            $getpro = $this->twarehouse_approval_request->getFg($arg2);
            //  printJSON($getpro);
			$kode = $getpro->kode_mutasi;
			$this->d->proheader = $this->twarehouse_approval_request->getByCode($kode);
			$this->d->realisasi = $this->tproduction_realisasi_request->get2($getpro->id_production);
			$this->d->idrealisasi = $getpro->id_production;
			
		} else if($this->d->_action == 'print'){
		} else if($this->d->_action == 'detaildt'){
			$res = $this->tproduction_detail_request->viewBasedID($arg2);
			printJSON($res);
		}  else if($this->d->_action == 'viewdt'){
			$res = $this->twarehouse_approval_request->viewDTpacking($this->in);
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
            $this->db->trans_start();
           
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
            modelLoad($this,array('mt_wh','twarehouse_approval_request'));
            $this->db->trans_start();
            
            // printJSON($_GET['id_wh']);
            $a=$this->mt_production->getwip($_GET['no_job']);
            $this->twarehouse_approval_request->approval2($_GET['id_wh']);

            // printJSON($a);
			$this->tproduction_realisasi_request->approval2($_GET['id_p']);
			$this->tproduction_realisasi_request->approval2packing($a->id_production_detail);

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
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$_GET['id_wh']);
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
            $this->db->trans_start();
			$this->tproduction_request->disapprove2($arg2);
			$getpro = $this->tproduction_request->getBy($arg2);
			// printJSON($arg2);
			$kode = $getpro->kode_mutasi;
			$getwh = $this->twarehouse_approval_request->getByCode($kode);
			$id_wh = $getwh->id_wh;
			$this->twarehouse_approval_request->disapprove2($id_wh);
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
		} else if($this->d->_action == 'cancel'){
		} else if($this->d->_action == 'closing'){
		}


		$this->load->view('template_view', $this->d);
	}

	function packing_list($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;
		    modelLoad($this, array('mm_tipe_sales', 'mt_stuffing','mt_detail_stuffing', 'mt_wh', 'mt_wh_detail', 'mreferensi_ukuran_kontainer'));
		if($this->d->_action == 'add'){
		} else if($this->d->_action == 'store'){
		} else if($this->d->_action == 'edit'){
		} else if($this->d->_action == 'update'){
		} else if($this->d->_action == 'detail'){
		} else if($this->d->_action == 'delete') {
            //print
		} else if($this->d->_action == 'print'){
			$this->d->app = getAppSetting($this);
			$this->d->t_stuffing = $this->mt_stuffing->get($arg2);
			$this->d->t_detail_stuffing = $this->mt_detail_stuffing->viewByStuffingId($arg2);
		} else if($this->d->_action == 'viewdt'){
			$res = $this->mt_stuffing->viewDTPacking($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewdetaildt'){
			$res = $this->mt_detail_stuffing->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewwhdt'){
			modelLoad($this, array('mt_wh_detail'));
			$res = $this->mt_wh_detail->viewStuffingDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewinvoicedt'){
			modelLoad($this, array('mt_detail_stuffing'));
			$res = $this->mt_detail_stuffing->viewInvoiceDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewstuffingdt'){
			$res = $this->mt_detail_stuffing->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'approve') {
		} else if ($this->d->_action == 'approve2') {
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function kartu_stok($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;
        
        modelLoad($this,array('mm_class', 'mm_sub_barang','mt_kartu_stok'));

		if ($this->d->_action == 'view') {
            $this->d->_modal = array('m_barang', 'm_sub_barang_single');
            $this->d->sklasifikasi = $this->mm_class->view();
            $in = a2o($this->input->post());
            if(isset($in->tgl1) && isset($in->tgl2)){
                if(isset($in->barang) && isset($in->klasifikasi)){
                    $this->d->tgl1 = $in->tgl1;
                    $this->d->tgl2 = $in->tgl2;
                    $this->d->barang = $in->barang;
                    $this->d->nama_barang = $in->nama_barang;
                    $this->d->klasifikasi = $in->klasifikasi;
                }else{
                    $this->d->tgl1 = $in->tgl1;
                    $this->d->tgl2 = $in->tgl2;
                }
                $this->d->data = $this->mt_kartu_stok->view($in);
            }
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}    

    function stock($arg1 = "", $arg2 = "") {
        if (empty($arg1))
            $this->d->_action = 'view';
        else
            $this->d->_action = $arg1;

        if ($this->d->_action == 'add') {
            
        } else if ($this->d->_action == 'viewstockdt') {
            $this->load->model('mt_wh_detail');
            $res = $this->mt_wh_detail->viewStockDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'viewstockdtfg') {
            $this->load->model('mt_wh_detail');
            $res = $this->mt_wh_detail->viewStockDTFG($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'viewstockdtwip') {
            $this->load->model('mt_wh_detail');
            $res = $this->mt_wh_detail->viewStockDTWIP($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'viewdetailstockdt') {
            $this->load->model('mt_wh_detail');
            $res = $this->mt_wh_detail->viewDetailStockDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'viewkoordinatdt') {
            $this->load->model('mt_wh_detail');
            $res = $this->mt_wh_detail->viewKoordinatDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'viewstockproductdt') {
            $this->load->model('mt_wh_detail');
            $res = $this->mt_wh_detail->viewProductStokDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'delete') {
            
        } else if ($this->d->_action == '') {
            
        }

        $this->load->view('template_view', $this->d);
    }

    function reporting($arg1 = "", $arg2 = "") {
        if (empty($arg1))
            $this->d->_action = 'view';
        else
            $this->d->_action = $arg1;

        $this->load->model('mwarehouse_reporting');
        if ($this->d->_action == 'add') {
            
        } else if ($this->d->_action == 'store') {
            
        } else if ($this->d->_action == 'edit') {
            
        } else if ($this->d->_action == 'update') {
            
        } else if ($this->d->_action == 'delete') {
            
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mwarehouse_reporting->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == '') {
            
        } else if ($this->d->_action == 'viewplanningstuffingdt') {
            $res = $this->mt_po->viewplanningstuffingdt($this->in);
            printJSON($res);
        }

        $this->load->view('template_view', $this->d);
    }

    function retur($arg1 = "", $arg2 = "") {
        if (empty($arg1))
            $this->d->_action = 'view';
        else
            $this->d->_action = $arg1;

        $this->load->model('mwarehouse_return');
        if ($this->d->_action == 'add') {
            
        } else if ($this->d->_action == 'store') {
            
        } else if ($this->d->_action == 'edit') {
            
        } else if ($this->d->_action == 'update') {
            
        } else if ($this->d->_action == 'delete') {
            
        } else if ($this->d->_action == 'detail') {
            $this->d->rtnheader = $this->tproduction_return_request->get($arg2);
        } else if ($this->d->_action == 'detaildt') {
            $res = $this->tproduction_detail_request->viewBasedID($arg2);
            printJSON($res);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mwarehouse_return->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == '') {
            
        }

        $this->load->view('template_view', $this->d);
    }

    function approval_request($arg1 = "", $arg2 = "") {
        if (empty($arg1))
            $this->d->_action = 'view';
        else
            $this->d->_action = $arg1;

        modelLoad($this, array('tproduction_request', 'twarehouse_approval_request'));

        if ($this->d->_action == 'viewdt') {
            $res = $this->twarehouse_approval_request->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'detail') {
            $this->d->reqheader = $this->twarehouse_approval_request->get($arg2);
            $getpro = $this->twarehouse_approval_request->get($arg2);
            $kode = $getpro->kode_mutasi;
            $this->d->proheader = $this->tproduction_request->getIDByCode($kode);
        }

        $this->load->view('template_view', $this->d);
    }

    function approval_return($arg1 = "", $arg2 = "") {
        if (empty($arg1))
            $this->d->_action = 'view';
        else
            $this->d->_action = $arg1;

        modelLoad($this, array('twarehouse_return_request', 'tproduction_return_request',
            'tproduction_detail_request'));

        if ($this->d->_action == 'viewdt') {
            $res = $this->twarehouse_return_request->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'detail') {
            $this->d->rtnheader = $this->twarehouse_return_request->get($arg2);
            $getwh = $this->twarehouse_return_request->get($arg2);
            $kode = $getwh->kode_mutasi;
            $getpro = $this->tproduction_return_request->getIDByCode($kode);
            $this->d->id_production = $getpro->id_production;
        } else if ($this->d->_action == 'detaildt') {
            $res = $this->tproduction_detail_request->viewBasedID($arg2);
            printJSON($res);
        }

        $this->load->view('template_view', $this->d);
    }

    function approval_realisasi($arg1 = "", $arg2 = "") {
        if (empty($arg1))
            $this->d->_action = 'view';
        else
            $this->d->_action = $arg1;

        modelLoad($this, array('tproduction_realisasi_request', 'twarehouse_realisasi_request'));
        if ($this->d->_action == 'viewdt') {
            $res = $this->twarehouse_realisasi_request->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'detail') {
            $this->d->rlzheader = $this->twarehouse_realisasi_request->get($arg2);
            $getwh = $this->twarehouse_realisasi_request->get($arg2);
            $kode = $getwh->kode_mutasi;
            $getpro = $this->tproduction_realisasi_request->getIDByCode($kode);
            $this->d->id_production = $getpro->id_production;
        } else if ($this->d->_action == 'detaildt') {
            $res = $this->tproduction_detail_request->viewBasedID($arg2);
            printJSON($res);
        }

        $this->load->view('template_view', $this->d);
    }

    function receive_material($arg1 = "", $arg2 = "") {
        if (empty($arg1))
            $this->d->_action = 'view';
        else
            $this->d->_action = $arg1;
        modelLoad($this, array('mt_dn', 'mt_wh', 'mt_wh_detail', 'vt_receive_material', 'vt_receive_material_detail', 'mt_doc_repo'));
        if ($this->d->_action == 'add') {
            modelLoad($this, array('mm_gudang', 'mm_koordinat'));
            $this->d->_modal = array('t_dn_receive', 't_detail_dn_receive');
            $this->d->m_gudang = $this->mm_gudang->view();
            $this->d->m_koordinat = $this->mm_koordinat->view();
        } else if ($this->d->_action == 'store') {
            $t = a2o($this->in->t_wh);
            $t->id_jenis_mutasi = 9;
            $t->jenis_transaksi = 'M';
            $t->tanggal_terima = $t->tanggal_terima != '' ? reverseDate($t->tanggal_terima) : null;

            $this->db->trans_start();
            $this->mt_dn->update($dn);
            $id_wh = $this->mt_wh->create($t);
            foreach ($this->in->t_wh_detail as $i => $detail) {
                $a = a2o($detail);
                $a->id_wh = $id_wh;
                $a->user_admin = 9;
                $this->mt_wh_detail->create($a);
            }

            $t_dn = new stdClass();
            $t_dn->id_dn = $t->id_dn;
            $t_dn->is_closed = '1';
            $this->mt_dn->update($t_dn);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data receiving material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data receiving materials gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method.'/detail/'.$id_wh);
        } else if ($this->d->_action == 'edit') {
            modelLoad($this, array('mm_gudang', 'mm_koordinat'));
            $this->d->m_gudang = $this->mm_gudang->view();
            $this->d->m_koordinat = $this->mm_koordinat->view();
            $this->d->t_wh = $this->vt_receive_material->get($arg2);
            $this->d->t_wh_detail = $this->vt_receive_material_detail->viewBasedWHId($arg2);
        } else if ($this->d->_action == 'update') {
            $t = a2o($this->in->t_wh_detail);
            $this->db->trans_start();
            $this->mt_doc_repo->deleteWhere(array(
                'jenis' => 'LPB',
                'id_doc' => $this->in->t_wh['id_wh']
            ));
            foreach ($t as $i => $detail) {
                $a = a2o($detail);
                $this->mt_wh_detail->update($a);
            }
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Update data receiving material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Update data receiving materials gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->vt_receive_material->delete($arg2);
            $this->d->t_wh_detail = $this->mt_wh_detail->viewBasedWHId($arg2);
            foreach ($this->d->t_wh_detail as $detail) {
                $this->mt_wh_detail->delete($detail->id_wh_detail);
            }
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data receive material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data receive material gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'detail') {
            $this->d->t_wh = $this->vt_receive_material->get($arg2);
            $this->d->t_wh_detail = $this->vt_receive_material_detail->viewBasedWHId($arg2);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->vt_receive_material->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'viewdetaildt') {
            modelLoad($this, array('vt_receive_material_detail'));
            $res = $this->vt_receive_material_detail->viewDT($this->in);
            printJSON($res);
        } else if($this->d->_action == 'approval1'){
			$this->db->trans_start();
			$this->mt_wh->approval1($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval receive material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data receive material gagal';
			}
			setNotification($this, $s);
            redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
        } else if($this->d->_action == 'approval2'){
			$this->db->trans_start();
			$this->mt_wh->approval2($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval receive material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data receive material gagal';
			}
			setNotification($this, $s);
            redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
        } else if($this->d->_action == 'unapprove1'){
            $this->db->trans_start();
            $this->mt_wh->disapprove1($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if($status){
                $s->status = true;
                $s->message = 'Disapprove receive material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Disapprove data receive material gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
        } else if($this->d->_action == 'unapprove2'){
			$this->db->trans_start();
			$this->mt_wh->disapprove2($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Disapprove receive material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Dispprove data receive material gagal';
			}
			setNotification($this, $s);
            redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
            
        } else if ($this->d->_action == '') {
            
        }

        $this->load->view('template_view', $this->d);
    }

	function request_material($arg1 = "", $arg2 = "") {
		if (empty($arg1))
			$this->d->_action = 'view';
		else
			$this->d->_action = $arg1;
		modelLoad($this, array('mt_request', 'mt_request_detail'));

		if ($this->d->_action == 'add') {
			modelLoad($this, array('mm_jenis_mutasi'));
			$this->d->_modal = array('t_stock_request');
			$this->d->m_jenis_mutasi = $this->mm_jenis_mutasi->viewBasedIssue();
		} else if ($this->d->_action == 'store') {
			$t = a2o($this->in->t_request);
			if (empty($t->id_bom)) $t->id_bom = null;
			if (empty($t->id_po)) $t->id_po = null;
			$t->tgl_request = $t->tgl_request != '' ? reverseDate($t->tgl_request) : null;
			$t->id_user_created = $this->session->get_userdata('id_user');
			$t->id_user_updated = $this->session->get_userdata('id_user');
			$this->db->trans_start();
			$id_request = $this->mt_request->create($t);

			foreach ($this->in->t_request_detail as $i => $detail) {
				$a = a2o($detail);
				$a->id_request = $id_request;

				$this->Mt_request_detail->create(a2o(array(
					'id_request' => $id_request,
					'id_sub_barang' => $a->id_sub_barang,
					'id_satuan' => $a->id_satuan,
					'qty_request' => $a->qty_request
				)));
			}

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Simpan data request material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data request material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'edit') {
			modelLoad($this, array('mm_jenis_mutasi'));
			$this->d->m_jenis_mutasi = $this->mm_jenis_mutasi->viewBasedIssue();
			$this->d->t_request = $this->mt_request->get($arg2);
			$this->d->t_request_detail = $this->mt_request_detail->viewBasedRequestId($arg2);
		} else if ($this->d->_action == 'update') {
			$t_request = a2o($this->in->t_request);
			$this->db->trans_start();
			$t_request->id_user_updated = $this->session->get_userdata('id_user');
			$this->mt_request->update($t_request);

			$this->in->deleted_detail = json_decode(stripslashes($this->in->deleted_detail));
			foreach ($this->in->deleted_detail as $v) {
				$this->mt_wh_buffer->delete($v);
			}

			$t = a2o($this->in->t_request_detail);
			foreach ($t as $i => $detail) {
				$a = a2o($detail);

				if (isset($a->id_request_detail)) {
					$this->mt_request_detail->update($a);
				} else {
					$a->id_request = $t_request->id_request;
					$this->mt_request_detail->create($a);
				}
			}
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Update data request material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Update data request materials gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'delete') {
			$this->db->trans_start();
			$this->mt_request->delete($arg2);
			$this->d->t_request_detail = $this->mt_request_detail->viewBasedRequestId($arg2);
			foreach ($this->d->t_request_detail as $detail) {
				$this->mt_request_detail->delete($detail->id_request_detail);
			}
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Hapus data request material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Hapus data request material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'detail') {
			$this->d->t_request = $this->mt_request->get($arg2);
			$this->d->t_request_detail = $this->mt_request_detail->viewBasedRequestId($arg2);
		} else if ($this->d->_action == 'print') {
			$this->d->app = getAppSetting($this);
			$this->d->t_request = $this->mt_request->get($arg2);
			$this->d->t_request_detail = $this->mt_request_detail->viewBasedRequestId($arg2);
			$this->d->idreq = $arg2;
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mt_request->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'viewstockdt') {
			$res = $this->mt_request_detail->viewStockRequestDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'approve1') {
			$t = a2o($this->in);
			$this->db->trans_start();
			$t->approval_1 = '1';
			$t->date_approval_1 = date('Y-m-d H:i:s');
			$t->id_user_approval_1 = $this->session->userdata('id_user');
			$this->mt_request->update($t);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Approve request material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approve request material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method . '/detail/' . $t->id_request);
		} else if ($this->d->_action == 'unapprove1') {
			$t = a2o($this->in);
			$this->db->trans_start();
			$t->approval_1 = '0';
			$t->date_approval_1 = date('Y-m-d H:i:s');
			$t->id_user_approval_1 = $this->session->userdata('id_user');
			$this->mt_request->update($t);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Unpprove request material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Unapprove request material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method . '/detail/' . $t->id_request);
		} else if ($this->d->_action == 'approve2') {
			$t = a2o($this->in);
			$this->db->trans_start();
			$t->approval_2 = '1';
			$t->date_approval_2 = date('Y-m-d H:i:s');
			$t->id_user_approval_2 = $this->session->userdata('id_user');
			$this->mt_request->update($t);
			$s = new stdClass();
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			if ($status) {
				$s->status = true;
				$s->message = 'Approve request material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approve request material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method . '/detail/' . $t->id_request);
		} else if ($this->d->_action == 'unapprove2') {
			$t = a2o($this->in);
			$this->db->trans_start();
			$t->approval_2 = '0';
			$t->date_approval_2 = date('Y-m-d H:i:s');
			$t->id_user_approval_2 = $this->session->userdata('id_user');
			$this->mt_request->update($t);
			$s = new stdClass();
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			if ($status) {
				$s->status = true;
				$s->message = 'Approve 2 request material berhasil';
			} else {
				$s->status = false;
				$s->message = 'Unapprove 2 request material gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method . '/detail/' . $t->id_request);
		} else if ($this->d->_action == '') {

		}

		$this->load->view('template_view', $this->d);
	}

    function issue_material($arg1 = "", $arg2 = "") {
        if (empty($arg1))
            $this->d->_action = 'view';
        else
            $this->d->_action = $arg1;
        modelLoad($this, array('mt_wh', 'mt_wh_detail', 'mt_wh_buffer', 'vt_issue_material',
            'vt_issue_material_detail', 'mt_doc_repo'));

        if ($this->d->_action == 'add') {
            modelLoad($this, array('mm_jenis_mutasi'));
            $this->d->_modal = array('t_wh_detail_stock');
            $this->d->m_jenis_mutasi = $this->mm_jenis_mutasi->viewBasedIssue();
        } else if ($this->d->_action == 'store') {
            $t = a2o($this->in->t_wh);
            $t->jenis_transaksi = 'T';
            $t->tanggal_terima = $t->tanggal_terima != '' ? reverseDate($t->tanggal_terima) : null;
            $t->id_user_created = $this->session->get_userdata('id_user');
            $t->id_user_updated = $this->session->get_userdata('id_user');
            $this->db->trans_start();
            $id_wh = $this->mt_wh->create($t);

            $t_wh = $this->mt_wh->get($id_wh);

            $this->mt_wh_detail->deleteWhere(array('id_wh' => $id_wh));

            foreach ($this->in->t_wh_detail as $i => $detail) {
                $a = a2o($detail);
                $a->id_wh = $id_wh;

                $this->mt_wh_buffer->create(a2o(array(
                    'id_wh' => $id_wh,
                    'id_job' => $a->id_job,
                    'id_detail_dn' => $a->id_detail_dn,
                    'id_production' => $a->id_production,
                    'id_sub_barang' => $a->id_sub_barang,
                    'id_satuan' => $a->id_satuan,
                    'qty' => $a->qty,
                    'harga_satuan' => $a->harga_satuan,
                    'rate' => $a->rate,
                    'id_koordinat_asal' => $a->id_koordinat_asal,
                    'id_koordinat_tujuan' => '7'
                )));

                $this->mt_wh_detail->create(a2o(array(
                    'id_wh' => $id_wh,
                    'id_job' => $a->id_job,
                    'id_detail_dn' => $a->id_detail_dn,
                    'id_production' => $a->id_production,
                    'id_sub_barang' => $a->id_sub_barang,
                    'id_satuan_terkecil' => $a->id_satuan,
                    'id_satuan_terkecil' => $a->id_satuan,
                    'qty' => $a->qty * (-1),
                    'harga_satuan' => $a->harga_satuan,
                    'rate' => $a->rate,
                    'id_koordinat' => $a->id_koordinat_asal
                )));
                $this->mt_wh_detail->create(a2o(array(
                    'id_wh' => $id_wh,
                    'id_job' => $a->id_job,
                    'id_detail_dn' => $a->id_detail_dn,
                    'id_production' => $a->id_production,
                    'id_sub_barang' => $a->id_sub_barang,
                    'id_satuan_terkecil' => $a->id_satuan,
                    'id_satuan_terkecil' => $a->id_satuan,
                    'qty' => $a->qty,
                    'harga_satuan' => $a->harga_satuan,
                    'rate' => $a->rate,
                    'id_koordinat' => 7
                )));
            }

            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data issue material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data issue materials gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            modelLoad($this, array('mm_jenis_mutasi'));
            $this->d->_modal = array('t_wh_detail_stock');
            $this->d->m_jenis_mutasi = $this->mm_jenis_mutasi->viewBasedIssue();
            $this->d->t_wh = $this->vt_issue_material->get($arg2);
            $this->d->t_wh_buffer = $this->vt_issue_material_detail->viewBasedWHId($arg2);
        } else if ($this->d->_action == 'update') {
            $t_wh = a2o($this->in->t_wh);
            $this->db->trans_start();
            $this->mt_wh->update($t_wh);

            $this->in->deleted_detail = json_decode(stripslashes($this->in->deleted_detail));
            foreach ($this->in->deleted_detail as $v) {
                $this->mt_wh_buffer->delete($v);
            }

            $t_wh = $this->mt_wh->get($t_wh->id_wh);
            $this->mt_wh_detail->deleteWhere(array('id_wh' => $t_wh->id_wh));

            $t = a2o($this->in->t_wh_buffer);
            foreach ($t as $i => $detail) {
                $a = a2o($detail);

                if (isset($a->id_wh_buffer)) {
                    $this->mt_wh_buffer->update($a);
                } else {
                    $a->id_wh = $this->in->t_wh->id_wh;
                    $this->mt_wh_buffer->create($a);
                }

                $this->mt_wh_detail->create(a2o(array(
                    'id_wh' => $t_wh->id_wh,
                    'id_job' => $a->id_job,
                    'id_detail_dn' => $a->id_detail_dn,
                    'id_production' => $a->id_production,
                    'id_sub_barang' => $a->id_sub_barang,
                    'id_satuan_terkecil' => $a->id_satuan,
                    'id_satuan_terkecil' => $a->id_satuan,
                    'qty' => $a->qty * (-1),
                    'harga_satuan' => $a->harga_satuan,
                    'rate' => $a->rate,
                    'id_koordinat' => $a->id_koordinat_asal
                )));
                $this->mt_wh_detail->create(a2o(array(
                    'id_wh' => $t_wh->id_wh,
                    'id_job' => $a->id_job,
                    'id_detail_dn' => $a->id_detail_dn,
                    'id_production' => $a->id_production,
                    'id_sub_barang' => $a->id_sub_barang,
                    'id_satuan_terkecil' => $a->id_satuan,
                    'id_satuan_terkecil' => $a->id_satuan,
                    'qty' => $a->qty,
                    'harga_satuan' => $a->harga_satuan,
                    'rate' => $a->rate,
                    'id_koordinat' => 7
                )));
            }
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Update data issue material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Update data issue materials gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->vt_issue_material->delete($arg2);
            $this->d->t_wh_buffer = $this->vt_issue_material_detail->viewBasedWHId($arg2);
            foreach ($this->d->t_wh_buffer as $buffer) {
                $this->mt_wh_buffer->delete($buffer->id_wh_buffer);
            }
            $this->mt_wh_detail->deleteWhere(array('id_wh' => $arg2));
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data issue material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data issue material gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'detail') {
            $this->d->t_wh = $this->vt_issue_material->get($arg2);
            $this->d->t_wh_detail = $this->vt_issue_material_detail->viewBasedWHId($arg2);
        } else if ($this->d->_action == 'print') {
            $this->d->app = getAppSetting($this);
            $this->d->t_wh = $this->vt_issue_material->get($arg2);
            $this->d->t_wh_detail = $this->vt_issue_material_detail->viewBasedWHId($arg2);
            $this->d->idreq = $arg2;
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->vt_issue_material->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'viewdetaildt') {
            modelLoad($this, array('vt_receive_material_detail'));
            $res = $this->vt_receive_material_detail->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'approve1') {
            $t = a2o($this->in);
            $this->db->trans_start();
            $t->approval_1 = '1';
            $t->date_approval_1 = date('Y-m-d H:i:s');
            $t->id_user_approval_1 = $this->session->userdata('id_user');
            $this->mt_wh->update($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Approve issue material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Approve issue material gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method . '/detail/' . $t->id_wh);
        } else if ($this->d->_action == 'unapprove1') {
            $t = a2o($this->in);
            $this->db->trans_start();
            $t->approval_1 = '0';
            $t->date_approval_1 = date('Y-m-d H:i:s');
            $t->id_user_approval_1 = $this->session->userdata('id_user');
            $this->mt_wh->update($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Unpprove issue material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Unapprove issue material gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method . '/detail/' . $t->id_wh);
        } else if ($this->d->_action == 'approve2') {
            $t = a2o($this->in);
            $this->db->trans_start();
            $t->approval_2 = '1';
            $t->date_approval_2 = date('Y-m-d H:i:s');
            $t->id_user_approval_2 = $this->session->userdata('id_user');
            $this->mt_wh->update($t);
            $s = new stdClass();
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            if ($status) {
                $s->status = true;
                $s->message = 'Approve receive material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Approve data receive material gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method . '/detail/' . $t->id_wh);
        } else if ($this->d->_action == 'unapprove2') {
            $t = a2o($this->in);
            $this->db->trans_start();
            $t->approval_2 = '0';
            $t->date_approval_2 = date('Y-m-d H:i:s');
            $t->id_user_approval_2 = $this->session->userdata('id_user');
            $this->mt_wh->update($t);
            $s = new stdClass();
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            if ($status) {
                $s->status = true;
                $s->message = 'Approve issue material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Unapprove 2 issue material gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method . '/detail/' . $t->id_wh);
        } else if ($this->d->_action == '') {
            
        }

        $this->load->view('template_view', $this->d);
    }

    function report_receive_material($arg1 = "", $arg2 = "") {
        if (empty($arg1))
            $this->d->_action = 'view';
        else
            $this->d->_action = $arg1;

        $this->d->_modal = array('referensi_pengusaha');
        modelLoad($this, array('vt_receive_material_detail'));
        if ($this->d->_action == 'view') {
            $this->load->model('mm_fasilitas');
            $this->d->m_fasilitas = $this->mm_fasilitas->view();
        } else if ($this->d->_action == '') {
            
        }

        $this->load->view('template_view', $this->d);
    }

    function stuffing($arg1 = "", $arg2 = "") {
        	if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;
		modelLoad($this, array('mm_tipe_sales', 'mt_stuffing','mt_detail_stuffing', 'mt_wh', 'mt_wh_detail', 'mreferensi_ukuran_kontainer'));
		if($this->d->_action == 'add'){
			$this->d->_modal = array('referensi_pemasok', 't_wh_detail_stuffing', 't_detail_stuffing_invoice', 'detail_supplier_destination', 'm_supplier');
			$this->d->m_tipe_sales = $this->mm_tipe_sales->view();
			$this->d->referensi_ukuran_container = $this->mreferensi_ukuran_kontainer->view();
		} else if($this->d->_action == 'store'){
			$t = a2o($this->in->t_stuffing);
			$t->tanggal_stuffing = reverseDate($t->tanggal_stuffing);
			$t->loading_date = $t->loading_date != '' ? reverseDate($t->loading_date) : null;
			$t->closing_date = $t->closing_date != '' ? reverseDate($t->closing_date) : null;
			$t->bl_date= $t->bl_date != '' ? reverseDate($t->bl_date) : null;
			//printJSON($this->in);
			$this->db->trans_start();
			$id_stuffing = $this->mt_stuffing->create($t);
			$t_stuffing = $this->mt_stuffing->get($id_stuffing);

			$id_jenis_mutasi_stuffing = "";
			if ($t->id_tipe_sales == '1') {
				$id_jenis_mutasi_stuffing = 6;
			}
			if ($t->id_tipe_sales == '2') {
				$id_jenis_mutasi_stuffing = 7;
			}
			if ($t->id_tipe_sales == '3') {
				$id_jenis_mutasi_stuffing = 5;
			}

			foreach ($this->in->t_detail_stuffing as $i => $detail) {
				$a = a2o($detail);

				$t_wh_detail = $this->mt_wh_detail->get($a->id_wh_detail);

				$t_wh = new stdClass();
				$t_wh->id_master = $t_wh_detail->id_wh;
				$t_wh->jenis_transaksi = 'T';
				$t_wh->tanggal_terima = $t->tanggal_stuffing;
				$t_wh->id_jenis_mutasi = $id_jenis_mutasi_stuffing;
				$t_wh->kode_mutasi = $t_stuffing->kode_stuffing;
				$id_wh = $this->mt_wh->create($t_wh);

				$b = new stdClass();
				$b->id_wh = $id_wh;
				$b->id_job = $t_wh_detail->id_job;
				$b->id_gudang = $t_wh_detail->id_gudang;
				$b->koordinat = $t_wh_detail->koordinat;
				$b->id_sub_barang = $t_wh_detail->id_sub_barang;
				$b->harga_satuan = $t_wh_detail->harga_satuan;
				$b->rate = $t_wh_detail->rate;
				$b->id_satuan_terbesar = $t_wh_detail->id_satuan_terbesar;
				$b->id_satuan_terkecil = $t_wh_detail->id_satuan_terkecil;
				$b->qty = $a->qty_si_plan;
				$id_wh_detail = $this->mt_wh_detail->create($b);

				$a->id_stuffing = $id_stuffing;
				$a->id_wh_detail = $id_wh_detail;
				$this->mt_detail_stuffing->create($a);
			}

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data stuffing berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data stuffing gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'edit'){
			$this->d->_modal = array('referensi_pemasok', 't_wh_detail_stuffing', 'detail_supplier_destination');
			$this->d->m_tipe_sales = $this->mm_tipe_sales->view();
			$this->d->referensi_ukuran_container = $this->mreferensi_ukuran_kontainer->view();

			$this->d->t_stuffing = $this->mt_stuffing->get($arg2);
			$this->d->t_detail_stuffing = $this->mt_detail_stuffing->viewByStuffingId($arg2);
		} else if($this->d->_action == 'update'){

			$t = a2o($this->in->t_stuffing);
			$t->tanggal_stuffing = reverseDate($t->tanggal_stuffing);
			$t->loading_date = $t->loading_date != '' ? reverseDate($t->tanggal_stuffing) : null;
			$t->closing_date = $t->closing_date != '' ? reverseDate($t->closing_date) : null;

			$this->db->trans_start();
			$this->mt_stuffing->update($t);
			$t_stuffing = $this->mt_stuffing->get($t->id_stuffing);

			$id_jenis_mutasi_stuffing = "";
			if ($t_stuffing->id_tipe_sales == '1') {
				$id_jenis_mutasi_stuffing = 6;
			}
			if ($t_stuffing->id_tipe_sales == '2') {
				$id_jenis_mutasi_stuffing = 7;
			}
			if ($t_stuffing->id_tipe_sales == '3') {
				$id_jenis_mutasi_stuffing = 5;
			}

			foreach ($this->in->t_detail_stuffing as $i => $detail) {
				$a = a2o($detail);

				$t_wh_detail = $this->mt_wh_detail->get($a->id_wh_detail);

				$id_wh_detail = "";
				if (isset($a->id_detail_stuffing)) {
					$b = new stdClass();
					$b->id_wh_detail = $a->id_wh_detail;
					$b->qty = $a->qty_si_plan;
					$this->mt_wh_detail->update($b);

					$id_wh_detail = $a->id_wh_detail;
				} else {
					$t_wh = new stdClass();
					$t_wh->id_master = $t_wh_detail->id_wh;
					$t_wh->jenis_transaksi = 'T';
					$t_wh->tanggal_terima = $t->tanggal_stuffing;
					$t_wh->id_jenis_mutasi = $id_jenis_mutasi_stuffing;
					$t_wh->kode_mutasi = $t_stuffing->kode_stuffing;
					$id_wh = $this->mt_wh->create($t_wh);

					$b = new stdClass();
					$b->id_wh = $id_wh;
					$b->id_job = $t_wh_detail->id_job;
					$b->id_gudang = $t_wh_detail->id_gudang;
					$b->koordinat = $t_wh_detail->koordinat;
					$b->id_sub_barang = $t_wh_detail->id_sub_barang;
					$b->harga_satuan = $t_wh_detail->harga_satuan;
					$b->rate = $t_wh_detail->rate;
					$b->id_satuan_terbesar = $t_wh_detail->id_satuan_terbesar;
					$b->id_satuan_terkecil = $t_wh_detail->id_satuan_terkecil;
					$b->qty = $a->qty_si_plan;
					$id_wh_detail = $this->mt_wh_detail->create($b);
				}

				$a->id_stuffing = $t->id_stuffing;
				$a->id_wh_detail = $id_wh_detail;
				if (isset($a->id_detail_stuffing)) {
					$this->mt_detail_stuffing->update($a);
				} else {
					$this->mt_detail_stuffing->create($a);
				}
			}

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data stuffing berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data stuffing gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'detail'){
			$this->d->t_stuffing = $this->mt_stuffing->get($arg2);
			$this->d->t_detail_stuffing = $this->mt_detail_stuffing->viewByStuffingId($arg2);
		} else if($this->d->_action == 'delete') {
			$this->db->trans_start();
            		$this->mt_stuffing->delete($arg2);
            		$this->db->trans_complete();
            		$status = $this->db->trans_status();
            		$s = new stdClass();
            		if ($status) {
                		$s->status = true;
        		        $s->message = 'Hapus data stuffing berhasil';
		            } else {
		                $s->status = false;
		                $s->message = 'Hapus data stuffing gagal';
        		    }
	            	setNotification($this, $s);
            		redirect($this->d->_controller . '/' . $this->d->_method);
//print
		}else if($this->d->_action == 'print'){
			$this->d->app = getAppSetting($this);
			$this->d->t_stuffing = $this->mt_stuffing->get($arg2);
			$this->d->t_detail_stuffing = $this->mt_detail_stuffing->viewByStuffingId($arg2);

		} else if($this->d->_action == 'viewdt'){
			$res = $this->mt_stuffing->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewdetaildt'){
			$res = $this->mt_detail_stuffing->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewwhdt'){
			modelLoad($this, array('mt_wh_detail'));
			$res = $this->mt_wh_detail->viewStuffingDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewinvoicedt'){
			modelLoad($this, array('mt_detail_stuffing'));
			$res = $this->mt_detail_stuffing->viewInvoiceDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewstuffingdt'){
			$res = $this->mt_detail_stuffing->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'approve') {
			modelLoad($this, array('mt_stuffing', 'mt_detail_stuffing', 'mt_wh', 'mt_wh_detail'));
			$t = a2o($this->in);
			$this->db->trans_start();
			$t_stuffing = $this->mt_stuffing->get($t->id_stuffing);
			$t->date_approval_1 = date('Y-m-d H:i:s');
			$this->mt_stuffing->update($t);
			$mt_wh = $this->mt_wh->getByKodeMutasi($t_stuffing->kode_stuffing);

			$t_detail_stuffing = $this->mt_detail_stuffing->viewByStuffingId($t->id_stuffing);
			foreach ($t_detail_stuffing as $detail) {
				$o = new stdClass();
				$o->id_detail_stuffing = $detail->id_detail_stuffing;
				if ($t->approval_1 == '1') {
					$o->qty_si_real = $detail->qty_si_plan;
					$o->qty_mc_real = $detail->qty_mc_plan;
				} else {
					$o->qty_si_real = 0;
					$o->qty_mc_real = 0;
				}
				//printJSON($o);
				$this->mt_detail_stuffing->update($o);
			}

			$c = new stdClass();
			$c->id_wh = $mt_wh->id_wh;
			$c->approval_1 = $t->approval_1;
			$c->date_approval_1 = $t->date_approval_1;
			$this->mt_wh->update($c);

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approve data stuffing berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approve data stuffing gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$t->id_stuffing);
		} else if ($this->d->_action == 'approve2') {
			modelLoad($this, array('mt_stuffing', 'mt_detail_stuffing'));
			$t = a2o($this->in);
			$this->db->trans_start();
			$t->date_approval_2 = date('Y-m-d H:i:s');
			$this->mt_stuffing->update($t);

			$t_stuffing = $this->mt_stuffing->get($t->id_stuffing);
			$mt_wh = $this->mt_wh->getByKodeMutasi($t_stuffing->kode_stuffing);

			$c = new stdClass();
			$c->id_wh = $mt_wh->id_wh;
			$c->approval_2 = $t->approval_2;
			$c->date_approval_2 = $t->date_approval_2;
			$this->mt_wh->update($c);

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approve data stuffing berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approve data stuffing gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$t->id_stuffing);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
    }

    function report_stuffing($arg1 = "", $arg2 = "") {
        if (empty($arg1))
            $this->d->_action = 'view';
        else
            $this->d->_action = $arg1;

        $this->d->_modal = array('referensi_pemasok');
        modelLoad($this, array('mm_tipe_sales', 'mt_detail_stuffing'));
        if ($this->d->_action == 'view') {
            $this->d->tipe_sales = $this->mm_tipe_sales->view();
        }

        $this->load->view('template_view', $this->d);
    }

    function planning_stuffing($arg1 = "", $arg2 = "") {
        if (empty($arg1))
            $this->d->_action = 'view';
        else
            $this->d->_action = $arg1;
        modelLoad($this, array('mt_po', 'mt_stuffing'));
        if ($this->d->_action == 'add') {

            $this->d->_modal = array('t_po', 'referensi_pemasok', 'referensi_negara',
                't_po_detail_planning_stuffing', 't_so', 't_job', 't_stuffing');
        } else if ($this->d->_action == 'store') {
            printJSON($this->in);

            $this->db->trans_start();
            $t = a2o($this->in->t_po);
            $t->type_trans = 'sales';
            $t->tanggal_dibuat = reverseDate($t->tanggal_dibuat);
            $t->tanggal_dibutuhkan = $t->tanggal_dibuat;

            $id = $this->mt_so->create($t);

            foreach ($this->in->t_detail_po as $r) {
                $o = a2o($r);
                $o->id_po = $id;
                $this->mt_detail_so->create($o);
            }
        } else if ($this->d->_action == 'edit') {
            
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $t_po = a2o($this->in->t_po);
            $t_detail_po = a2o($this->in->t_detail_po);
            $this->mt_po->update($t_po);
            $this->mt_detail_po->create($t_detail_po);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data Planning Stuffing berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data Planning Stuffing gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mt_stuffing->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'viewdetaildt') {
            $res = $this->mt_stuffing->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == '') {
            
        } else if ($this->d->_action == 'viewplanningstuffingdt') {
            modelLoad($this, array('mt_detail_so'));
            $res = $this->mt_detail_so->viewplanningstuffingdt($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'viewjobdt') {
            modelLoad($this, array('mt_job'));
            $res = $this->mt_job->viewjobdt($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'approval1') {
            $this->db->trans_start();
            $this->mt_pp->approval1($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Approval data Planning Stuffing berhasil';
            } else {
                $s->status = false;
                $s->message = 'Approval data Planning Stuffing gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'approval2') {
            $this->db->trans_start();
            $this->mt_po->approval2($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Approval data Planning Stuffing berhasil';
            } else {
                $s->status = false;
                $s->message = 'Approval data Planning Stuffing gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'disapprove') {
            $this->db->trans_start();
            $this->mt_po->disapprove($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Disapprove data Planning Stuffing berhasil';
            } else {
                $s->status = false;
                $s->message = 'Disapprove data Planning Stuffing gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'cancel') {
            $this->db->trans_start();
            $this->mt_po->cancel($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Cancel data Planning Stuffing berhasil';
            } else {
                $s->status = false;
                $s->message = 'Cancel data Planning Stuffing gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'closing') {
            $this->db->trans_start();
            $this->mt_po->closing($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Closing data planning Stuffing berhasil';
            } else {
                $s->status = false;
                $s->message = 'Closing data planning Stuffing gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        }

        $this->load->view('template_view', $this->d);
    }

    function adjust_material($arg1 = "", $arg2 = "") {
        if (empty($arg1))
            $this->d->_action = 'view';
        else
            $this->d->_action = $arg1;
        modelLoad($this, array('mt_wh', 'mt_wh_detail', 'mt_wh_buffer', 'vt_adjust_material',
            'vt_adjust_material_detail'));

        if ($this->d->_action == 'viewdt') {
            $res = $this->vt_adjust_material->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'add') {
            $this->d->_modal = array('t_wh_detail_stock');
        } else if ($this->d->_action == 'store') {
            $t = a2o($this->in->t_wh);
            $t->jenis_transaksi = 'T';
            $t->tanggal_terima = $t->tanggal_terima != '' ? reverseDate($t->tanggal_terima) : null;
            $t->id_user_created = $this->session->get_userdata('id_user');
            $t->id_user_updated = $this->session->get_userdata('id_user');
            $this->db->trans_start();
            $id_wh = $this->mt_wh->create($t);

            foreach ($this->in->t_wh_detail as $i => $detail) {
                $a = a2o($detail);
                $a->id_wh = $id_wh;

                $this->mt_wh_detail->create($a);
            }

            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data adjust material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data adjust materials gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->_modal = array('t_wh_detail_stock');
            $this->d->t_wh = $this->vt_adjust_material->get($arg2);
            $this->d->t_wh_detail = $this->vt_adjust_material_detail->viewBasedWHId($arg2);
        } else if ($this->d->_action == 'update') {
            $t_wh = a2o($this->in->t_wh);
            $this->db->trans_start();
            $this->mt_wh->update($t_wh);

            $this->in->deleted_detail = json_decode(stripslashes($this->in->deleted_detail));
            foreach ($this->in->deleted_detail as $v) {
                $this->mt_wh_detail->delete($v);
            }


            $t = a2o($this->in->t_wh_detail);
            foreach ($t as $i => $detail) {
                $a = a2o($detail);

                if (isset($a->id_wh_detail)) {
                    $this->mt_wh_detail->update($a);
                } else {
                    $a->id_wh = $this->in->t_wh->id_wh;
                    $this->mt_wh_detail->create($a);
                }
            }
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Update data adjust material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Update data adjust materials gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->vt_adjust_material->delete($arg2);
            $this->d->t_wh_detail = $this->vt_adjust_material_detail->viewBasedWHId($arg2);
            foreach ($this->d->t_wh_detail as $detail) {
                $this->mt_wh_detail->delete($detail->id_wh_detail);
            }
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data adjust material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data adjust material gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'detail') {
            $this->d->t_wh = $this->vt_adjust_material->get($arg2);
            $this->d->t_wh_detail = $this->vt_adjust_material_detail->viewBasedWHId($arg2);
        } else if ($this->d->_action == 'print') {
            $this->d->app = getAppSetting($this);
            $this->d->t_wh = $this->vt_adjust_material->get($arg2);
            $this->d->t_wh_detail = $this->vt_adjust_material_detail->viewBasedWHId($arg2);
        } else if ($this->d->_action == 'approve') {
            $t = a2o($this->in);
            $this->db->trans_start();
            $t->date_approval_1 = date('Y-m-d H:i:s');
            $t->id_user_approval_1 = $this->session->userdata('id_user');
            $this->mt_wh->update($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Approve adjust material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Approve data adjust material gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method . '/detail/' . $t->id_wh);
        } else if ($this->d->_action == 'approve2') {
            $t = a2o($this->in);
            $this->db->trans_start();
            $t->date_approval_2 = date('Y-m-d H:i:s');
            $t->id_user_approval_2 = $this->session->userdata('id_user');
            $this->mt_wh->update($t);
            $s = new stdClass();
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            if ($status) {
                $s->status = true;
                $s->message = 'Approve adjust material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Approve data adjust material gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method . '/detail/' . $t->id_wh);
        }

        $this->load->view('template_view', $this->d);
    }

    function return_material($arg1 = "", $arg2 = "") {
        if (empty($arg1))
            $this->d->_action = 'view';
        else
            $this->d->_action = $arg1;

        modelLoad($this, array('mt_wh', 'mt_wh_detail', 'mt_wh_buffer', 'vt_return_material',
            'vt_return_material_detail', 'mm_koordinat'));

        if ($this->d->_action == 'viewdt') {
            $res = $this->vt_return_material->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'add') {
            $this->d->_modal = array('t_wh_detail_stock_product');
        } else if ($this->d->_action == 'getgudang') {
            $res = $this->mm_koordinat->getGudang($arg2);
            printJSON($res);
        } else if ($this->d->_action == 'store') {
            $t = a2o($this->in->t_wh);
            $t->jenis_transaksi = 'T';
            $t->tanggal_terima = $t->tanggal_terima != '' ? reverseDate($t->tanggal_terima) : null;
            $t->id_user_created = $this->session->get_userdata('id_user');
            $t->id_user_updated = $this->session->get_userdata('id_user');
            $this->db->trans_start();
            $id_wh = $this->mt_wh->create($t);

            foreach ($this->in->t_wh_detail as $i => $detail) {
                $b = $this->in->t_wh_detail_opt;
                $bb = a2o($b[$i]);

                $a = a2o($detail);
                $a->id_wh = $id_wh;
                $a->qty = $bb->qty * (-1);
                $a->id_koordinat = $bb->id_koordinat_asal;
                $this->mt_wh_detail->create($a);

                $a->qty = $bb->qty;
                $a->id_koordinat = $bb->id_koordinat_tujuan;
                $this->mt_wh_detail->create($a);
            }

            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data return material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data return materials gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->vt_return_material->delete($arg2);
            $this->d->t_wh_detail = $this->vt_return_material_detail->viewBasedWHId($arg2);
            foreach ($this->d->t_wh_detail as $detail) {
                $this->mt_wh_detail->delete($detail->id_wh_detail);
            }
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data return material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data return material gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->t_wh = $this->vt_return_material->get($arg2);
            $this->d->t_wh_detail = $this->vt_return_material_detail->viewBasedWHId($arg2);
            $this->d->t_gudang = $this->mm_koordinat->getGudang(1);
        } else if ($this->d->_action == 'update') {
            $t_wh = a2o($this->in->t_wh);
            $this->db->trans_start();
            $this->mt_wh->update($t_wh);

            $this->in->deleted_detail = json_decode(stripslashes($this->in->deleted_detail));
            foreach ($this->in->deleted_detail as $v) {
                $this->mt_wh_detail->deleteByInvID($t_wh->id_wh, $v);
            }

            foreach ($this->in->t_wh_detail as $i => $detail) {
                $a = a2o($detail);
                $b = $this->in->t_wh_detail_opt;
                $bb = a2o($b[$i]);

                $a->id_wh = $t_wh->id_wh;
                $a->qty = $a->qty;
                $a->id_koordinat = $bb->id_koordinat_tujuan;
                $this->mt_wh_detail->update($a);


                $nw = new stdClass();
                $nw->id_wh = $t_wh->id_wh;
                $nw->id_sub_barang = $a->id_sub_barang;
                $nw->id_koordinat = $bb->id_koordinat_asal;
                $nw->qty = $a->qty * (-1);
                $this->mt_wh_detail->updateByInvID($nw);
            }

            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Update data return material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Update data return materials gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'detail') {
            $this->d->t_wh = $this->vt_return_material->get($arg2);
            $this->d->t_wh_detail = $this->vt_return_material_detail->viewBasedWHId($arg2);
		} else if ($this->d->_action == 'print') {
			$this->d->app = getAppSetting($this);
			$this->d->t_wh = $this->vt_return_material->get($arg2);
			$this->d->t_wh_detail = $this->vt_return_material_detail->viewBasedWHId($arg2);
        } else if ($this->d->_action == 'approve') {
            $t = a2o($this->in);
            $this->db->trans_start();
            $t->date_approval_1 = date('Y-m-d H:i:s');
            $t->id_user_approval_1 = $this->session->userdata('id_user');
            $this->mt_wh->update($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Approve return material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Approve data return material gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method . '/detail/' . $t->id_wh);
        } else if ($this->d->_action == 'approve2') {
            $t = a2o($this->in);
            //            var_dump($t);
            //            exit();
            $this->db->trans_start();
            $t->date_approval_2 = date('Y-m-d H:i:s');
            $t->id_user_approval_2 = $this->session->userdata('id_user');
            $this->mt_wh->update($t);
            $s = new stdClass();
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            if ($status) {
                $s->status = true;
                $s->message = 'Approve return material berhasil';
            } else {
                $s->status = false;
                $s->message = 'Approve data return material gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method . '/detail/' . $t->id_wh);
        }

        $this->load->view('template_view', $this->d);
    }

}
