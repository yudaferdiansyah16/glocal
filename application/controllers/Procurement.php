<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procurement extends CI_Controller {
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
		loadLanguage($this, $this->d->_controller, $this->d->_method);
		$this->in = getPostAsObject($this);
	}

	public function index()
	{
		$this->load->view('template_view');
	}

	function purchase_requisition($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this, array('mt_pp', 'mm_jenis_pp', 'mm_jenis_pp_rutinitas', 'mm_bagian','mt_detail_pp','mm_class'));
		if($this->d->_action == 'add'){
			$this->d->_modal = array('t_detail_job_pp','m_sub_barang');
			$this->d->sjenis_pp = $this->mm_jenis_pp->view();
			$this->d->sjenis_pp_rutinitas = $this->mm_jenis_pp_rutinitas->view();
			$this->d->sbagian = $this->mm_bagian->view();
			$this->d->sclass = $this->mm_class->view();
		} else if($this->d->_action == 'store'){
			//printJSON($this->in);
			$this->db->trans_start();
			$t_pp = a2o($this->in->t_pp);
			$t_pp->tanggal_dibuat = reverseDate($t_pp->tanggal_dibuat);
			$t_pp->tanggal_dibutuhkan = reverseDate($t_pp->tanggal_dibutuhkan);
			$t_detail_pp = a2o($this->in->t_detail_pp);

			//printJSON($this->in);
			$id = $this->mt_pp->create($t_pp);

			foreach ($this->in->t_detail_pp  as $row){
				$d = a2o($row);
				if(isset($d->id_sub_barang) and !empty($d->id_sub_barang)){
                    $d->id_pp = $id;
                    $this->mt_detail_pp->create($d);
                }
			}
			$this->mt_detail_pp->create($t_detail_pp);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data Purchase Requisition berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data Purchase Requisition gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'edit'){
			$this->d->_modal = array('t_detail_job_pp','m_sub_barang');
			$this->d->data = $this->mt_pp->get($arg2);
			$this->d->detail = $this->mt_detail_pp->getByIDPP($arg2);
			$this->d->sjenis_pp = $this->mm_jenis_pp->view();
			$this->d->sjenis_pp_rutinitas = $this->mm_jenis_pp_rutinitas->view();
			$this->d->sbagian = $this->mm_bagian->view();
			$this->d->sclass = $this->mm_class->view();
		} else if($this->d->_action == 'update'){
			$this->db->trans_start();
			$t_pp = a2o($this->in->t_pp);
			$t_detail_pp = a2o($this->in->t_detail_pp);
			
			$this->mt_pp->update($t_pp);
			foreach ($t_detail_pp as $r) {
				$r = a2o($r);
				if (isset($r->id_detail_pp)) {
					$this->mt_detail_pp->update($r);
				} else {
					$r->id_pp = $t_pp->id_pp;
					$this->mt_detail_pp->create($r);
				}
			}

			$delete = $this->in->deleted_detail_pp;
			$delete = json_decode(stripslashes($delete));
			foreach ($delete as $r) {
				$this->mt_detail_pp->delete($r);
			}

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Ubah data BOM berhasil';
			} else {
				$s->status = false;
				$s->message = 'Ubah data BOM gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'delete'){
			$this->db->trans_start();
			$this->mt_pp->delete($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Hapus data Purchase Requisition berhasil';
			} else {
				$s->status = false;
				$s->message = 'Hapus data Purchase Requisition gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'detail'){
			$this->d->ppheader = $this->mt_pp->get($arg2);
			$this->d->idpp = $arg2;
		} else if($this->d->_action == 'print'){
			$this->d->app = getAppSetting($this);
			$this->d->ppdetail = $this->mt_detail_pp->viewPrint($arg2);
			$this->d->ppheader = $this->mt_pp->get($arg2);
			$this->d->idpp = $arg2;
		} else if($this->d->_action == 'detaildt'){
			$res = $this->mt_detail_pp->viewBasedPPID($arg2);
			printJSON($res);
		} else if($this->d->_action == 'viewdt'){
			$res = $this->mt_pp->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewDetailjobPP'){
			modelLoad($this,array('mt_detail_job'));
			$res = $this->mt_detail_job->viewDetailjobPP($this->in);
			printJSON($res);
		} else if($this->d->_action == 'approval1'){
			$this->db->trans_start();
			$this->mt_pp->approval1($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Purchase Requisition berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Purchase Requisition gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'approval2'){
			$this->db->trans_start();
			$this->mt_pp->approval2($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Purchase Requisition berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Purchase Requisition gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'disapprove1'){
			$this->db->trans_start();
			$this->mt_pp->disapprove1($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Disapprove data Purchase Requisition berhasil';
			} else {
				$s->status = false;
				$s->message = 'Disapprove data Purchase Requisition gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'disapprove2'){
			$this->db->trans_start();
			$this->mt_pp->disapprove2($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Disapprove data Purchase Requisition berhasil';
			} else {
				$s->status = false;
				$s->message = 'Disapprove data Purchase Requisition gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'cancel'){
			$this->db->trans_start();
			$this->mt_pp->cancel($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Cancel data Purchase Requisition berhasil';
			} else {
				$s->status = false;
				$s->message = 'Cancel data Purchase Requisition gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'closing'){
			$this->db->trans_start();
			$this->mt_pp->closing($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Closing data Purchase Requisition berhasil';
			} else {
				$s->status = false;
				$s->message = 'Closing data Purchase Requisition gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		}

		$this->load->view('template_view', $this->d);
	}
	function purchase_order($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this, array('mt_po','mt_detail_po','mm_harga'));
		if($this->d->_action == 'add'){
			modelLoad($this,array('mt_pp','mt_po','mreferensi_valuta','mm_jenis_pembayaran'));
			$this->d->_modal = array('t_detail_pp_po','referensi_valuta','t_job', 'm_supplier');
			$this->d->sales_type = $this->mt_po->view();
			$this->d->jenis_pembayaran = $this->mm_jenis_pembayaran->view();
		} else if($this->d->_action == 'store'){
			$this->db->trans_start();
			$t_po = a2o($this->in->t_po);
			$t_po->tanggal_dibuat = reverseDate($t_po->tanggal_dibuat);
			$t_po->tanggal_dibutuhkan = reverseDate($t_po->tanggal_dibutuhkan);
			$t_po->type_trans = 'purchase';
			$harga = new stdClass();
			$harga->kode_valuta = a2o($this->in->kode_valuta);
			$harga->id_supplier = $t_po->id_supplier;
			$harga->tanggal_harga = $t_po->tanggal_dibuat;

			$id = $this->mt_po->create($t_po);

			$tdp = a2o($this->in->t_detail_po);
			foreach ($tdp as $r){
			    $r = a2o($r);
				$r->id_po = $id;
				$harga->id_sub_barang = $r->id_sub_barang;
				$harga->harga = floatval($r->harga);
				$harga->flag_status = 1;
				$this->mm_harga->unFlagStatus($harga->id_supplier,$harga->id_sub_barang);
				$this->mm_harga->create($harga);
				$this->mt_detail_po->create($r);
			}
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data Purchase Order berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data Purchase Order gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'edit'){
			modelLoad($this,array('mt_pp','mt_po','mreferensi_valuta','mm_jenis_pembayaran'));
			$this->d->poheader = $this->mt_po->get($arg2);
			$this->d->detail = $this->mt_detail_po->getDetail($arg2);
			$this->d->_modal = array('t_detail_pp_po','m_supplier','referensi_valuta');
			$this->d->jenis_pembayaran = $this->mm_jenis_pembayaran->view();
		} else if($this->d->_action == 'update'){
			// printJSON($this->in);
			$this->db->trans_start();
			$t_po = a2o($this->in->t_po);
			$this->mt_po->update($t_po);

			$t_detail_po = a2o($this->in->t_detail_po);
			foreach ($t_detail_po as $r) {
				$r = a2o($r);
				if (isset($r->id_detail_po)) {
					$this->mt_detail_po->update($r);
				} else {
					$r->id_po = $t_po->id_po;
					$this->mt_detail_po->create($r);
				}
			}
			
			$delete = $this->in->deleted_detail_po;
			$delete = json_decode(stripslashes($delete));
			foreach ($delete as $r) {
				$this->mt_detail_po->delete($r);
			}
			
			// printJSON($delete);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Update data Purchase Order berhasil';
			} else {
				$s->status = false;
				$s->message = 'Update data Purchase Order gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'delete'){
			$this->db->trans_start();
			$this->mt_po->delete($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Hapus data Purchase Order berhasil';
			} else {
				$s->status = false;
				$s->message = 'Hapus data Purchase Order gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'viewdt'){
			$res = $this->mt_po->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'detail'){
			$this->d->poheader = $this->mt_po->get($arg2);
		} else if($this->d->_action == 'print'){
			$this->d->app = getAppSetting($this);
			$this->d->poheader = $this->mt_po->get($arg2);
			$this->d->podetail = $this->mt_detail_po->viewPrint($arg2);
		} else if($this->d->_action == 'detaildt'){
			$res = $this->mt_detail_po->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewDetailPPPO'){
			modelLoad($this,array('mt_detail_pp'));
			// printJSON($this->in->kode_job);
			$res = $this->mt_detail_pp->viewDetailPPPO($this->in);
			printJSON($res);
		} else if($this->d->_action == 'approval1'){
			$this->db->trans_start();
			$this->mt_po->approval1($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Purchase Order berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Purchase Order gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'approval2'){
			$this->db->trans_start();
			$this->mt_po->approval2($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Purchase Order berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Purchase Order gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'disapprove1'){
			$this->db->trans_start();
			$this->mt_po->disapprove1($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Disapprove data Purchase Order berhasil';
			} else {
				$s->status = false;
				$s->message = 'Disapprove data Purchase Order gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'disapprove2'){
			$this->db->trans_start();
			$this->mt_po->disapprove2($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Disapprove data Purchase Order berhasil';
			} else {
				$s->status = false;
				$s->message = 'Disapprove data Purchase Order gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'cancel'){
			$this->db->trans_start();
			$this->mt_po->cancel($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Cancel data Purchase Order berhasil';
			} else {
				$s->status = false;
				$s->message = 'Cancel data Purchase Order gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'closing'){
			$this->db->trans_start();
			$this->mt_po->closing($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Closing data Purchase Order berhasil';
			} else {
				$s->status = false;
				$s->message = 'Closing data Purchase Order gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		}

		$this->load->view('template_view', $this->d);
	}
	function reporting_pr($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('mt_pp','mt_detail_pp','mm_jenis_pp_rutinitas'));
		if($this->d->_action == 'view'){
			$this->d->sjenis_pp_rutinitas = $this->mm_jenis_pp_rutinitas->view();
		} else if($this->d->_action == 'viewdt'){
			$res = $this->mt_pp->viewReporting($this->in);
			printJSON($res);
		} else if($this->d->_action == 'detail'){
			$this->d->ppheader = $this->mt_pp->get($arg2);
		} else if($this->d->_action == 'detaildt'){
			$res = $this->mt_detail_pp->viewDT($this->in);
			printJSON($res);
		}

		$this->load->view('template_view', $this->d);
	}
	function reporting_po($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mt_po');
		if($this->d->_action == 'view'){
			$this->d->_modal = array('m_supplier');
		} else if($this->d->_action == 'viewdt'){
			$res = $this->mt_po->viewReporting($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}
	function closing_pr($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('tprocurement_closing_pr','mt_detail_pp'));
		if($this->d->_action == 'add'){

		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$res = $this->tprocurement_closing_pr->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'detail'){
			$this->d->ppheader = $this->tprocurement_closing_pr->get($arg2);
		} else if($this->d->_action == 'detaildt'){
			$res = $this->mt_detail_pp->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}
	function closing_po($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('tprocurement_closing_po');
		if($this->d->_action == 'add'){

		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$res = $this->tprocurement_closing_po->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}
	function cancel_pr($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('tprocurement_cancel_pr','mt_detail_pp'));
		if($this->d->_action == 'add'){

		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$res = $this->tprocurement_cancel_pr->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'detail'){
			$this->d->ppheader = $this->tprocurement_cancel_pr->get($arg2);
		} else if($this->d->_action == 'detaildt'){
			$res = $this->mt_detail_pp->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}
	function cancel_po($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('tprocurement_cancel_po');
		if($this->d->_action == 'add'){

		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$res = $this->tprocurement_cancel_po->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}
	function approval_pr($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('tprocurement_approval_pr','mt_detail_pp'));
		if($this->d->_action == 'add'){

		} else if($this->d->_action == 'approve'){

		} else if($this->d->_action == 'reject'){

		} else if($this->d->_action == 'viewdt'){
			$res = $this->tprocurement_approval_pr->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'detail'){
			$this->d->ppheader = $this->tprocurement_approval_pr->get($arg2);
		} else if($this->d->_action == 'detaildt'){
			$res = $this->mt_detail_pp->viewDT($this->in);
			printJSON($res);
		}

		$this->load->view('template_view', $this->d);
	}
	function approval_po($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('tprocurement_approval_po');
		if($this->d->_action == 'add'){

		} else if($this->d->_action == 'approve'){

		} else if($this->d->_action == 'reject'){

		} else if($this->d->_action == 'viewdt'){
			$res = $this->tprocurement_approval_po->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}
	function delivery_note_po($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;
		$this->load->model('mt_dn');
		$this->load->model('mt_detail_dn');

		if($this->d->_action == 'add'){
			modelLoad($this,array('mreferensi_jenis_kendaraan'));
			$this->d->_modal = array('m_supplier_rn', 't_detail_po_dn');
			$this->d->sjenis_kendaraan = $this->mreferensi_jenis_kendaraan->view();

		} else if($this->d->_action == 'store'){
			$t_dn = a2o($this->in->t_dn);
			$t_dn->tgl_kedatangan = reverseDate($t_dn->tgl_kedatangan);
			if ($t_dn->tgl_invoice != '') $t_dn->tgl_invoice = reverseDate($t_dn->tgl_invoice); else $t_dn->tgl_invoice = null;
			if ($t_dn->tgl_faktur != '') $t_dn->tgl_faktur = reverseDate($t_dn->tgl_faktur); else $t_dn->tgl_faktur = null;
			if (!isset($t_dn->id_fasilitas)) $t_dn->id_fasilitas = "1";
			$this->db->trans_start();
			$id_dn = $this->mt_dn->create($t_dn);
			foreach ($this->in->t_detail_dn as $r) {
				$o = a2o($r);
				if ($o->id_detail_dn != "")
					if ($o->deleted_at != "") {
                        $this->mt_detail_dn->delete($o->id_detail_dn);
					} else {
						$o->tanggal_sj = ($o->tanggal_sj != '') ? reverseDate($o->tanggal_sj) : null;
						unset($o->deleted_at);
						$this->mt_detail_dn->update($o);
					}
				else {
					$o->id_dn = $id_dn;
					unset($o->id_detail_dn);
					unset($o->deleted_at);
                    if(!empty($o->qty_dn)) {
						$o->tanggal_sj = ($o->tanggal_sj != '') ? reverseDate($o->tanggal_sj) : null;
						$this->mt_detail_dn->create($o);
					}
                }
			}
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data delivery note berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data delivery note gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);

		} else if($this->d->_action == 'edit'){
			modelLoad($this,array('mreferensi_jenis_kendaraan'));
			$this->d->_modal = array('m_supplier', 't_detail_po_dn');
			$this->d->sjenis_kendaraan = $this->mreferensi_jenis_kendaraan->view();
			$this->d->t_dn = $this->mt_dn->get($arg2);
			$this->d->t_detail_dn = $this->mt_detail_dn->viewByDN($arg2);

		} else if($this->d->_action == 'detail'){
			modelLoad($this,array('mreferensi_jenis_kendaraan','mt_dn'));
			$this->d->_modal = array('referensi_pengusaha', 't_detail_po_dn');
			$this->d->sjenis_kendaraan = $this->mreferensi_jenis_kendaraan->view();
			$this->d->t_dn = $this->mt_dn->get($arg2);
			$this->d->t_detail_dn = $this->mt_detail_dn->viewByDN($arg2);

		} else if($this->d->_action == 'update'){
			$t_dn = a2o($this->in->t_dn);
			$t_dn->tgl_kedatangan = reverseDate($t_dn->tgl_kedatangan);
			if ($t_dn->tgl_invoice != '') $t_dn->tgl_invoice = reverseDate($t_dn->tgl_invoice); else $t_dn->tgl_invoice = null;
			if ($t_dn->tgl_faktur != '') $t_dn->tgl_faktur = reverseDate($t_dn->tgl_faktur); else $t_dn->tgl_faktur = null;
			if (!isset($t_dn->id_fasilitas)) $t_dn->id_fasilitas = "1";

			$this->db->trans_start();
			$this->mt_dn->update($t_dn);

			$this->in->deleted_detail_dn = json_decode(stripslashes($this->in->deleted_detail_dn));
			foreach($this->in->deleted_detail_dn as $v){
				$this->mt_detail_dn->delete($v);
			}

			foreach ($this->in->t_detail_dn as $r) {
				$o = a2o($r);
				if ($o->id_detail_dn != "") {
					$o->tanggal_sj = ($o->tanggal_sj != '') ? reverseDate($o->tanggal_sj) : null;
					$this->mt_detail_dn->update($o);
				} else {
					$o->id_dn = $t_dn->id_dn;
					unset($o->id_detail_dn);
					unset($o->deleted_at);
					if(!empty($o->qty_dn)) {
						$o->tanggal_sj = ($o->tanggal_sj != '') ? reverseDate($o->tanggal_sj) : null;
						$this->mt_detail_dn->create($o);
					}
				}
			}
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data delivery note berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data delivery note gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		}else if($this->d->_action == 'viewDNDT'){
			modelLoad($this,array('mt_detail_po'));
			$res = $this->mt_detail_po->viewDNDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewdt'){
			$res = $this->mt_dn->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'print'){
			$this->d->t_dn = $this->mt_dn->get($arg2);
			$this->d->t_detail_dn = $this->mt_detail_dn->viewByDN($arg2);
			$this->d->app = getAppSetting($this);
		} else if($this->d->_action == 'viewreceivedt'){
			$res = $this->mt_dn->viewReceiveDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewdocindt'){
			$res = $this->mt_dn->viewDocInDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewdetaildt'){
			$res = $this->mt_detail_dn->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'detailjson'){
			$res = $this->mt_detail_dn->viewByDN($arg2);
			printJSON($res);
		} else if($this->d->_action == 'delete'){
			$this->db->trans_start();
			$this->mt_detail_dn->delete($arg2);
			$this->d->t_detail_dn = $this->mt_detail_dn->viewByDN($arg2);
			foreach ($this->d->t_detail_dn as $detail) {
				$this->mt_detail_dn->delete($detail->id_detail_dn);
			}
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Hapus data delivery note berhasil';
			} else {
				$s->status = false;
				$s->message = 'Hapus data delivery note gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if ($this->d->_action == 'approve') {
			$t = a2o($this->in);
			$this->db->trans_start();
			$t->date_approval_1 = date('Y-m-d H:i:s');
			$this->mt_dn->update($t);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approve delivery note berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approve delivery note gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$t->id_dn);
		} else if ($this->d->_action == 'approve2') {
			$t = a2o($this->in);
			$this->db->trans_start();
			$t->date_approval_2 = date('Y-m-d H:i:s');
			$this->mt_dn->update($t);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approve delivery note berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approve delivery note gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$t->id_dn);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}
	function report_delivery_note_po($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->d->_modal = array('referensi_pengusaha');
		if ($this->d->_action == 'view') {
			$this->load->model('mm_fasilitas');
			$this->d->m_fasilitas = $this->mm_fasilitas->view();
		} else if ($this->d->_action == '') {

		}

		$this->load->view('template_view', $this->d);
	}
}
