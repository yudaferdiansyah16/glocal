<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom extends CI_Controller {
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

	function laporan_pemasukan($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('mtpb_header'));
		if($this->d->_action == 'view'){
			modelLoad($this,array('mreferensi_dokumen_pabean'));
			$this->d->sdokumen_pabean = $this->mreferensi_dokumen_pabean->viewPosting(1);
		} else if($this->d->_action == 'viewdt'){
			modelLoad($this,array('mtpb_barang'));
			$res = $this->mtpb_barang->viewCustomsIn($this->in);
			printJSON($res);
		}

		$this->load->view('template_view', $this->d);
	}

	function laporan_pengeluaran($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('mtpb_header'));
		if($this->d->_action == 'view'){
			modelLoad($this,array('mreferensi_dokumen_pabean'));
			$this->d->sdokumen_pabean = $this->mreferensi_dokumen_pabean->viewPosting(2);
		} else if($this->d->_action == 'viewdt'){
			modelLoad($this,array('mtpb_barang'));
			$res = $this->mtpb_barang->viewCustomsOut($this->in);
			printJSON($res);
		}

		$this->load->view('template_view', $this->d);
	}

	function laporan_wip($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

//		$this->load->model('msales_approval');
		if($this->d->_action == 'add'){
			$this->d->_modal = array('referensi_dokumen_pabean');
		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			modelLoad($this,array('mt_wh_detail'));
			$res = $this->mt_wh_detail->viewMutationDT($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}


	function laporan_mutasi_bahan_baku($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mt_wh_detail');
		if($this->d->_action == 'add'){
			$this->d->_modal = array('referensi_dokumen_pabean');
		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$res = $this->mt_wh_detail->viewMutationDT($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function laporan_mutasi_bahan_bakar($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mt_wh_detail');
		if($this->d->_action == 'add'){
			$this->d->_modal = array('referensi_dokumen_pabean');
		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$res = $this->mt_wh_detail->viewMutationDT($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function laporan_mutasi_barang_jadi($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mt_wh_detail');
		if($this->d->_action == 'add'){
			$this->d->_modal = array('referensi_dokumen_pabean');
		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$res = $this->mt_wh_detail->viewMutationDT($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function laporan_mutasi_barang_modal($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mt_wh_detail');
		if($this->d->_action == 'add'){
			$this->d->_modal = array('referensi_dokumen_pabean');
		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$res = $this->mt_wh_detail->viewMutationDT($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function laporan_mutasi_keperluan_penelitian($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mt_wh_detail');
		if($this->d->_action == 'add'){
			$this->d->_modal = array('referensi_dokumen_pabean');
		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$res = $this->mt_wh_detail->viewMutationDT($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function laporan_mutasi_peralatan_kantor($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mt_wh_detail');
		if($this->d->_action == 'add'){
			$this->d->_modal = array('referensi_dokumen_pabean');
		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$res = $this->mt_wh_detail->viewMutationDT($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function laporan_mutasi_sisa_produksi_scrap($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mt_wh_detail');
		if($this->d->_action == 'add'){
			$this->d->_modal = array('referensi_dokumen_pabean');
		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$res = $this->mt_wh_detail->viewMutationDT($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

}
