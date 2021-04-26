<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class hrd extends CI_Controller {
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

	function kasbon($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

//		$this->load->model('msales_approval');
		if($this->d->_action == 'store'){
			$this->load->model('mt_kasbon');
			$t = a2o($this->in->t_kasbon);

			$this->db->trans_start();
			$t->id_kasbon = $this->mt_kasbon->create($t);

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Create Kasbon berhasil';
			} else {
				$s->status = false;
				$s->message = 'Create Kasbon gagal';
			}
			redirect($this->d->_controller.'/'.$this->d->_method.'/add/'.$t->id_kasbon);
		}else if($this->d->_action == 'store2'){
			$this->load->model('mt_kasbon');
			$this->load->model('mt_kasbon_detail');

			$t = a2o($this->in->t_kasbon_detail);
			$u = a2o($this->input->post());

			$this->db->trans_start();
			$this->mt_kasbon->update_status($arg2, 1);
			$total = 0;
			foreach ($this->in->t_kasbon_detail as $detail) {
				$d = a2o($detail);
				$d->id_kasbon = $arg2;
				$d->jumlah = floatval($d->jumlah);
				$total = $total + $d->jumlah;
				$this->mt_kasbon_detail->create($d);
			}
			$this->mt_kasbon->total($arg2, $total, $u->catatan);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Create kasbon berhasil';
			} else {
				$s->status = false;
				$s->message = 'Create kasbon gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'add'){
			$this->load->model('mt_kasbon');
			$this->load->model('mt_kasbon_detail');
			$this->d->kasbonheader = $this->mt_kasbon->get($arg2);
			$this->d->kasbondetail = $this->mt_kasbon_detail->viewTotal($arg2);
			$this->d->idkasbon = $arg2;
		} else if($this->d->_action == 'approval'){
			$this->load->model('mt_kasbon');
			$this->db->trans_start();
			$this->mt_kasbon->update_status($arg2, 2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Kasbon berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Kasbon gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'detail'){
			$this->load->model('mt_kasbon');
			$this->load->model('mt_kasbon_detail');
			$this->d->kasbonheader = $this->mt_kasbon->get($arg2);
			$this->d->idkasbon = $arg2;
		} else if($this->d->_action == 'detaildt'){
			$this->load->model('mt_kasbon_detail');
			$res = $this->mt_kasbon_detail->viewBasedKasbonID($arg2);
			printJSON($res);
		} else if($this->d->_action == 'edit'){
			$this->load->model('mt_kasbon');
			$this->load->model('mt_kasbon_detail');
			$this->d->kasbonheader = $this->mt_kasbon->get($arg2);
			$this->d->kasbondetail = $this->mt_kasbon_detail->viewTotal($arg2);
			$this->d->idkasbon = $arg2;
		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$this->load->model('mt_kasbon');
			$res = $this->mt_kasbon->viewDT($this->in, 1);
			printJSON($res);
		} else if($this->d->_action == ''){

		} else if($this->d->_action == 'viewppdt'){
			$res = $this->mt_pp->viewppdt($this->in);
			printJSON($res);
		}

		$this->load->view('template_view', $this->d);
	}
	function realisasi($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

//		$this->load->model('msales_approval');
		if($this->d->_action == 'add'){
			$this->d->_modal = array('referensi_valuta','referensi_dokumen','m_akun');
		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$this->load->model('mt_kasbon');
			$res = $this->mt_kasbon->viewDTRealisasi($this->in, 1);
			printJSON($res);
		} else if($this->d->_action == 'detail'){
			$this->load->model('mt_kasbon');
			$this->load->model('mt_kasbon_detail');
			$this->d->kasbonheader = $this->mt_kasbon->get($arg2);
			$this->d->idkasbon = $arg2;
		} else if($this->d->_action == 'detaildt'){
			$this->load->model('mt_kasbon_detail');
			$res = $this->mt_kasbon_detail->viewBasedKasbonID($arg2);
			printJSON($res);
		} else if($this->d->_action == 'closing'){
			$this->load->model('mt_kasbon');
			$this->db->trans_start();
			$this->mt_kasbon->update_status($arg2, 3);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Close data Realisasi berhasil';
			} else {
				$s->status = false;
				$s->message = 'Close data Realisasi gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}	
}
