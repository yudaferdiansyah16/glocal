<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends CI_Controller {
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

	function laporan_depresiasi($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$in = a2o($this->input->post());

		$this->load->model('mt_lap_piutang');
		$this->d->data = $this->mt_lap_piutang->view($in);
		if(isset($in->tgl1) && isset($in->tgl2)){
			$this->d->tgl1 = $in->tgl1;
			$this->d->tgl2 = $in->tgl2;
		}

		$this->load->view('template_view', $this->d);
	}

	function laporan_kasbon($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$in = a2o($this->input->post());

		$this->load->model('mt_lap_kasbon');
		$this->d->data = $this->mt_lap_kasbon->view($in);
		
		if(isset($in->tgl1) && isset($in->tgl2)){
			$this->d->tgl1 = $in->tgl1;
			$this->d->tgl2 = $in->tgl2;
		}

		$this->load->view('template_view', $this->d);
	}

	function laporan_arus_kas($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$in = a2o($this->input->post());

		$this->load->model('mt_laporan_arus_kas');
		$this->d->data = $this->mt_laporan_arus_kas->view($in);
		
		if(isset($in->tgl1) && isset($in->tgl2)){
			$this->d->tgl1 = $in->tgl1;
			$this->d->tgl2 = $in->tgl2;
		}

		$this->load->view('template_view', $this->d);
	}

	function arus_kas($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$in = a2o($this->input->post());

		$this->load->model('mt_arus_kas');
		$this->d->data = $this->mt_arus_kas->view($in);
		
		if(isset($in->tgl1) && isset($in->tgl2)){
			$this->d->tgl1 = $in->tgl1;
			$this->d->tgl2 = $in->tgl2;
		}

		$this->load->view('template_view', $this->d);
	}

	function laporan_pembelian($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->d->_modal = array('referensi_pengusaha');
		modelLoad($this, array('mm_customer_suplier', 'mt_dn'));
		if ($this->d->_action == 'view') {
			$in = a2o($this->input->post());
			$this->d->ssupplier = $this->mm_customer_suplier->viewSupplier();
			if(isset($in->tgl1) && isset($in->tgl2) && isset($in->supplier) && isset($in->type)){
				$this->d->tgl1 = $in->tgl1;
				$this->d->tgl2 = $in->tgl2;
				$this->d->type = $in->type;
				$this->d->supplier = $in->supplier;
				$this->d->data = $this->mt_dn->getReport($in);
			}
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function laporan_penjualan($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->d->_modal = array('referensi_pemasok');
		modelLoad($this, array('mm_customer_suplier', 'mt_invoice'));
		if ($this->d->_action == 'view') {
			$in = a2o($this->input->post());
			$this->d->scustomer = $this->mm_customer_suplier->viewCustomer();
			if(isset($in->tgl1) && isset($in->tgl2) && isset($in->type) && isset($in->customer)){
				$this->d->tgl1 = $in->tgl1;
				$this->d->tgl2 = $in->tgl2;
				$this->d->type = $in->type;
				$this->d->customer = $in->customer;
				$this->d->data = $this->mt_invoice->getReport($in);
			}
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function kasbon($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;
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

	function posting_pemakaian($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this, array('mm_class', 'mt_production_detail'));

		if ($this->d->_action == 'view') {
			$in = a2o($this->input->post());
			$this->d->sklasifikasi = $this->mm_class->view();
			if(isset($in->tgl1) && isset($in->tgl2) && isset($in->klasifikasi)){
				$this->d->tgl1 = $in->tgl1;
				$this->d->tgl2 = $in->tgl2;
				// $this->d->tipe_request = $in->tipe_request;
				$this->d->klasifikasi = $in->klasifikasi;
				$this->d->data = $this->mt_production_detail->getWhere($in);
			}
		}  else if ($this->d->_action == 'store') {
			$this->load->model('mfinance_jurnal_pemakaian');
			$t = $this->in;
			$t->id_status = 1;
			$t->approval_1 = 1;
			$t->approval_2 = 1;
			$t->id_user_approval_1 = $this->session->userdata('id_user');
			$t->id_user_approval_2 = $this->session->userdata('id_user');
			$t->closing = 1;
			$this->db->trans_start();
			$this->mfinance_jurnal_pemakaian->create($t);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Simpan jurnal pemakaian berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan jurnal pemakaian gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function jurnal_hutang($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mt_dn');
		$this->load->model('mt_detail_dn');
		$this->load->model('mm_customer_suplier');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'store') {
			$this->load->model('mfinance_jurnal_hutang');
			$t = $this->in;
			$t->id_status = 1;
			$t->approval_1 = 1;
			$t->approval_2 = 1;
			$t->id_user_approval_1 = $this->session->userdata('id_user');
			$t->id_user_approval_2 = $this->session->userdata('id_user');
			$t->closing = 1;
			$this->db->trans_start();
			$this->mfinance_jurnal_hutang->create($t);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Simpan jurnal hutang berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan jurnal hutang gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mt_dn->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'view') {
			$this->d->_modal = array('referensi_valuta');
			$in = a2o($this->input->post());
			$this->d->ssupplier = $this->mm_customer_suplier->viewSupplier();
			if(isset($in->tgl1) && isset($in->tgl2) && isset($in->supplier)){
				$this->d->tgl1 = $in->tgl1;
				$this->d->tgl2 = $in->tgl2;
				$this->d->supplier = $in->supplier;
				$this->d->data = $this->mt_dn->getWhere($in);
			}
		} else if ($this->d->_action == '') {
		}


		$this->load->view('template_view', $this->d);
	}

	function jurnal_piutang($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mt_invoice');
		$this->load->model('mm_customer_suplier');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'store') {
			$this->load->model('mfinance_jurnal_piutang');
			$t = $this->in;
			$t->id_status = 1;
			$t->approval_1 = 1;
			$t->approval_2 = 1;
			$t->id_user_approval_1 = $this->session->userdata('id_user');
			$t->id_user_approval_2 = $this->session->userdata('id_user');
			$t->closing = 1;
			$this->db->trans_start();
			$this->mfinance_jurnal_piutang->create($t);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			var_dump($status);
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Simpan jurnal piutang berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan jurnal piutang gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mt_invoice->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'view') {
			$this->d->_modal = array('referensi_valuta');
			$in = a2o($this->input->post());
			$this->d->scustomer = $this->mm_customer_suplier->viewCustomer();
			if(isset($in->tgl1) && isset($in->tgl2) && isset($in->customer)){
				$this->d->tgl1 = $in->tgl1;
				$this->d->tgl2 = $in->tgl2;
				$this->d->customer = $in->customer;
				$this->d->data = $this->mt_invoice->getWhere($in);
			}
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function transaction_jurnal($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		if ($this->d->_action == 'view') {
		} else if ($this->d->_action == 'add') {
			$this->d->_modal = array('referensi_valuta', 'm_akun');
			$this->load->model('mm_jenis_jurnal');
			$this->d->stype_journal = $this->mm_jenis_jurnal->view();
		} else if ($this->d->_action == 'store') {
			$this->load->model('mt_finance');
			$this->load->model('mt_finance_detail');
			$this->load->model('mm_akun');

			$t = a2o($this->in->t_finance);
			// $td = a2o($this->in->t_finance_detail);
			// printJSON($td);
			$kode = $t->no_trans;
			$t->id_valuta = $t->id_valuta;
			$t->rate = $t->rate;
			$t->tgl_trans = reverseDate($t->tgl_trans);
			$t->no_trans = $this->mt_finance->generateCode($t->tgl_trans, $kode);
			$t->trans_description = $t->trans_description;
			$t->id_status = 1;
			$t->approval_1 = 1;
			$t->approval_2 = 1;
			$t->id_user_approval_1 = $this->session->userdata('id_user');
			$t->id_user_approval_2 = $this->session->userdata('id_user');
			$t->closing = 1;
			$this->db->trans_start();
			$t->id_finance = $this->mt_finance->create($t);
			foreach ($this->in->t_finance_detail as $detail) {
				$d = a2o($detail);
				$d->id_finance = $t->id_finance;
				if ($d->position == 'credit') {
					$d->amount = (-1) * floatval($d->amount);
					$d->jumlah_rp = (-1) * floatval($d->amount) * floatval($t->rate);
				}else{
					$d->amount = floatval($d->amount);
					$d->jumlah_rp = floatval($d->amount) * floatval($t->rate);
				}
				unset($d->position);
				$this->mt_finance_detail->create($d);
			}

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Create general journal berhasil';
			} else {
				$s->status = false;
				$s->message = 'Create general journal gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'edit') {
			$this->d->_modal = array('referensi_valuta', 'm_akun');
			$this->load->model('mt_finance');
			$this->load->model('mt_finance_detail');
			$this->d->jenis_jurnal = $this->mt_finance->jenis_jurnal();
			$this->d->data = $this->mt_finance->geta($arg2);
			$this->d->detail = $this->mt_finance_detail->getid($arg2);
		} else if ($this->d->_action == 'update') {
			$this->load->model('mt_finance');
			$this->load->model('mt_finance_detail');
			$this->db->trans_start();
			$t_finance = a2o($this->in->t_finance);
			$t_finance_detail = a2o($this->in->t_finance_detail);
			$t_finance->tgl_trans = reverseDate($t_finance->tgl_trans);
			$this->mt_finance->update($t_finance);

			foreach ($this->in->t_finance_detail as $detail) {
				$d = a2o($detail);
				$d->id_finance = $t_finance->id_finance;
				if ($d->position == 'credit') {
					$d->amount = (-1) * floatval($d->amount);
					$d->jumlah_rp = ((-1) * floatval($d->amount)) * floatval($t_finance->rate);
				}else{
					$d->amount = floatval($d->amount);
					$d->jumlah_rp = floatval($d->amount) * floatval($t_finance->rate);
				}
				unset($d->position);
				if (isset($d->id_finance_detail)) {
					$this->mt_finance_detail->update($d);
				} else {
					$d->id_finance = $t_finance->id_finance;
					$this->mt_finance_detail->create($d);
				}
			}
		
			$delete = $this->in->deleted_finance_detail;
			$delete = json_decode(stripslashes($delete));
			foreach ($delete as $r) {
				$this->mt_finance_detail->delete($r);
			}
			
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Ubah data general jurnal berhasil';
			} else {
				$s->status = false;
				$s->message = 'Ubah data general jurnal gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'delete') {
			$this->load->model('mt_finance');
			$this->db->trans_start();
			$this->mt_finance->delete($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Hapus global journal berhasil';
			} else {
				$s->status = false;
				$s->message = 'Hapus global journal gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'viewdt') {
			$this->load->model('mt_finance');
			$res = $this->mt_finance->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'detail') {
			$this->load->model('mt_finance');
			$this->load->model('mt_finance_detail');
			$this->d->detail = $this->mt_finance->geta($arg2);
			$this->d->data = $this->mt_finance_detail->getid($arg2);
		}

		$this->load->view('template_view', $this->d);
	}

	function setting_akun_customer($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mfinance_setting_akun_customer');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'store') {
		} else if ($this->d->_action == 'edit') {
			$this->d->data = $this->mfinance_setting_akun_customer->get($arg2);
		} else if ($this->d->_action == 'update') {
			// printJSON($this->in);
			$this->db->trans_start();
			$this->mfinance_setting_akun_customer->update($this->in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Ubah setting akun customer berhasil';
			} else {
				$s->status = false;
				$s->message = 'Ubah setting akun customer gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'delete') {
			$this->db->trans_start();
			$this->mfinance_setting_akun_customer->delete($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Hapus setting akun customer berhasil';
			} else {
				$s->status = false;
				$s->message = 'Hapus setting akun customer gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mfinance_setting_akun_customer->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function setting_akun_supplier($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mfinance_setting_akun_supplier');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'store') {
		} else if ($this->d->_action == 'edit') {
			$this->d->data = $this->mfinance_setting_akun_supplier->get($arg2);
		} else if ($this->d->_action == 'update') {
			$this->db->trans_start();
			$this->mfinance_setting_akun_supplier->update($this->in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Ubah setting akun supplier berhasil';
			} else {
				$s->status = false;
				$s->message = 'Ubah setting akun supplier gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'delete') {
			$this->db->trans_start();
			$this->mfinance_setting_akun_supplier->delete($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Hapus setting akun supplier berhasil';
			} else {
				$s->status = false;
				$s->message = 'Hapus setting akun supplier gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mfinance_setting_akun_supplier->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function setting_akun_sub_barang($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mfinance_setting_akun_sub_barang');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'store') {
		} else if ($this->d->_action == 'edit') {
			$this->d->data = $this->mfinance_setting_akun_sub_barang->get($arg2);
		} else if ($this->d->_action == 'update') {
			$this->db->trans_start();
			$this->mfinance_setting_akun_sub_barang->update($this->in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Ubah setting akun sub barang berhasil';
			} else {
				$s->status = false;
				$s->message = 'Ubah setting akun sub barang gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'delete') {
			$this->db->trans_start();
			$this->mfinance_setting_akun_sub_barang->delete($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Hapus setting akun sub barang berhasil';
			} else {
				$s->status = false;
				$s->message = 'Hapus setting akun sub barang gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mfinance_setting_akun_sub_barang->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function setting_akun_global_aplikasi($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mfinance_setting_akun_global_aplikasi');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'store') {
		} else if ($this->d->_action == 'edit') {
		} else if ($this->d->_action == 'update') {
			$this->db->trans_start();
			$this->mfinance_setting_akun_global_aplikasi->update($this->in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Setting akun global aplikasi berhasil';
			} else {
				$s->status = false;
				$s->message = 'Setting akun global aplikasi gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'delete') {
		} else if ($this->d->_action == 'viewdt') {
		} else if ($this->d->_action == 'view') {
			$this->d->data = $this->mfinance_setting_akun_global_aplikasi->getLimit();
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function saldo_awal($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mfinance_saldo_awal');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'store') {
			$this->load->model('mfinance_saldo_awal');
			$check = $this->mfinance_saldo_awal->check();
			if ($check->trans > 0) {
				$t = $this->in;
				$t->id_status = 1;
				$t->approval_1 = 1;
				$t->approval_2 = 1;
				$t->id_user_approval_1 = $this->session->userdata('id_user');
				$t->id_user_approval_2 = $this->session->userdata('id_user');
				$t->closing = 1;
				$this->db->trans_start();
				$this->mfinance_saldo_awal->update($t);
				$this->db->trans_complete();
				$status = $this->db->trans_status();
				$s = new stdClass();
				if ($status) {
					$s->status = true;
					$s->message = 'Ubah saldo awal berhasil';
				} else {
					$s->status = false;
					$s->message = 'Ubah saldo awal gagal';
				}
				setNotification($this, $s);
				redirect($this->d->_controller . '/' . $this->d->_method);
			} else {
				$t = $this->in;
				$t->id_status = 1;
				$t->approval_1 = 1;
				$t->approval_2 = 1;
				$t->id_user_approval_1 = $this->session->userdata('id_user');
				$t->id_user_approval_2 = $this->session->userdata('id_user');
				$t->closing = 1;
				$this->db->trans_start();
				$this->mfinance_saldo_awal->create($t);
				$this->db->trans_complete();
				$status = $this->db->trans_status();
				$s = new stdClass();
				if ($status) {
					$s->status = true;
					$s->message = 'Simpan saldo awal berhasil';
				} else {
					$s->status = false;
					$s->message = 'Simpan saldo awal gagal';
				}
				setNotification($this, $s);
				redirect($this->d->_controller . '/' . $this->d->_method);
			}
		} else if ($this->d->_action == 'edit') {
		} else if ($this->d->_action == 'update') {
			$this->db->trans_start();
			$this->mfinance_saldo_awal->update($this->in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Setting saldo awal aplikasi berhasil';
			} else {
				$s->status = false;
				$s->message = 'Setting saldo awal aplikasi gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'delete') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mfinance_saldo_awal->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'getselect') {
			$search = $this->input->get('search');
			$res = $this->mm_akun->getSelect($search);
			printJSON($res);
		} else if ($this->d->_action == 'view') {
			$this->d->data = $this->mfinance_saldo_awal->getAll();
		}

		$this->load->view('template_view', $this->d);
	}	
	
	function approval($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mfinance_approval');
		if($this->d->_action == 'add'){

		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$res = $this->mfinance_approval->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function posting($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mfinance_posting');
		if($this->d->_action == 'add'){

		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$res = $this->mfinance_posting->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function reporting($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mfinance_reporting');
		if($this->d->_action == 'add'){

		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$res = $this->mfinance_reporting->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function assettingLama($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		if($this->d->_action == 'add'){

		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$this->load->model('mm_asset');
			$res = $this->mm_asset->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function assetting($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('m_finance_asseting');
		$this->load->model('mm_asset');
		$this->load->model('m_asset');
		$this->load->model('mt_finance');
		$this->load->model('mt_finance_detail');
		$this->load->model('mm_akun');
		if ($this->d->_action == 'add') {
			modelLoad($this, array('mm_akun'));
			// $this->d->mm_akun = $this->mm_akun->view();
			$this->d->mm_akun1 = $this->mm_akun->view(); /* 121*/
			$this->d->mm_akun2 = $this->mm_akun->viewAccount2(); /* 122*/
			$this->d->mm_akun3 = $this->mm_akun->viewAccount3(); /* kode diatas >< 500*/
			// $this->d->_modal = array('refrensi_asseting');
		} else if ($this->d->_action == 'store') {
			$this->db->trans_start();
			$t = $this->in;
			$t->tgl_depresiasi = reverseDate($this->in->tgl_depresiasi);
			// printJSON($t);
			$this->mm_asset->create($t);
			$tf = new stdClass();
			$tf->no_trans=$this->mt_finance->generateCode(reverseDate($t->tgl_depresiasi), "AST");
			$tf->rate = 1;
			$tf->tgl_trans = reverseDate($t->tgl_depresiasi);
			$tf->id_status = 1;
			$tf->approval_1 = 1;
			$tf->approval_2 = 1;
			$tf->id_user_approval_1 = $this->session->userdata('id_user');
			$tf->id_user_approval_2 = $this->session->userdata('id_user');
			$tf->closing = 1;
			$id_finance = $this->mt_finance->create($tf);
			$tfd = new stdClass();
			$tfd->id_finance = $id_finance;
			$tfd->id_akun = $t->id_akun;
			$tfd->jumlah_rp = $t->harga;
			$tfd->amount = $t->rate;
			$tfd->description = $t->deskripsi;
			$tfd->id_status = 1;
			$this->mt_finance_detail->create($tfd);
			$tfdmin = new stdClass();
			$tfdmin->id_finance = $id_finance;
			// $tfdmin->id_akun = $t->id_supplier;
			$tfdmin->id_akun = $t->id_akun_beban_penyusutan;
			$tfdmin->jumlah_rp = $t->harga;
			$tfdmin->amount ="-".$t->rate;
			$tfdmin->description = $t->deskripsi;
			$tfdmin->id_status = 1;
			$this->mt_finance_detail->create($tfdmin);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Simpan data Asset berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data Asset gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'edit') {
		} else if ($this->d->_action == 'update') {
		} else if ($this->d->_action == 'delete') {
		} else if ($this->d->_action == 'simulasi') {
			$res = $this->m_finance_asseting->viewsimulasi($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'hasil_penyusutan') {
			$res = $this->m_finance_asseting->viewsimulasi($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->m_finance_asseting->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'hasil_simulasi') {
			$res = $this->m_asset->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'toExcel') {
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet->setCellValue('A1', 'No');
			$sheet->setCellValue('B1', 'Kode Barang');
			$sheet->setCellValue('C1', 'Kode Asset');
			$sheet->setCellValue('D1', 'Nama Barang');
			$sheet->setCellValue('E1', 'Harga');
			$sheet->setCellValue('F1', 'Tanggal Perolehan');
			$sheet->setCellValue('G1', 'Tipe Depresiasi');
			$res = $this->m_finance_asseting->view();
			$no = 1;
			$x = 2;
			foreach($res as $res) {
				$sheet->setCellValue('A' .$x, $no++);
				$sheet->setCellValue('B' .$x, $res->kode_aset1);
				$sheet->setCellValue('C' .$x, $res->kode_aset2);
				$sheet->setCellValue('D' .$x, $res->nama_barang);
				$sheet->setCellValue('E' .$x, number_format($res->harga,2));
				$sheet->setCellValue('F' .$x, $res->tgl_depresiasi);
				$sheet->setCellValue('G' .$x, $res->nama_tipe_depresiasi);
				$x++;
			}
			$writer = new Xlsx($spreadsheet);
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Asseting.xlsx"'); 
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
		}

		$this->load->view('template_view', $this->d);
	}

	function report_assetting($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mt_finance');
		$this->load->model('mt_finance_detail');
		$this->load->model('mm_akun');
		$this->load->model('m_asset');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'store') {
		} else if ($this->d->_action == 'edit') {
		} else if ($this->d->_action == 'update') {
		} else if ($this->d->_action == 'delete') {
			$this->load->model('m_reporting_asset');
			$this->db->trans_start();
			$this->m_reporting_asset->delete($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Hapus Asset berhasil';
			} else {
				$s->status = false;
				$s->message = 'Hapus Asset gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'viewdt') {
			$this->load->model('m_reporting_asset');
			$res = $this->m_reporting_asset->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'detail') {
			$this->load->model('m_reporting_asset');
			$this->d->data = $this->m_reporting_asset->getid($arg2);
		}

		$this->load->view('template_view', $this->d);
	}

	function general_ledger($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		if($this->d->_action == 'add'){

		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}
	function approval_kasbon($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

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
			$this->mt_kasbon->update_status($arg2, 2);
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

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$this->load->model('mt_kasbon');
			$res = $this->mt_kasbon->viewDT($this->in, 2);
			printJSON($res);
		} else if($this->d->_action == ''){

		} else if($this->d->_action == 'viewppdt'){
			$res = $this->mt_pp->viewppdt($this->in, 1);
			printJSON($res);
		}

		$this->load->view('template_view', $this->d);
	}
	function approval_realisasi($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;
		if($this->d->_action == 'add'){
			$this->d->_modal = array('referensi_valuta','referensi_dokumen','m_akun');
		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$this->load->model('mt_kasbon');
			$res = $this->mt_kasbon->viewDTRealisasi($this->in, 2);
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
			$this->mt_kasbon->update_realisasi($arg2, 4);
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
	function pembayaran_piutang($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		if($this->d->_action == 'viewdtpiutang'){
			$this->load->model('mt_bayar');
			$res = $this->mt_bayar->viewDTPiutang($this->in);
			printJSON($res);
		} else if($this->d->_action == 'detail'){
			$this->load->model('mt_bayar');
			$this->load->model('mm_customer_suplier');
			$this->d->piutang = $this->mt_bayar->get($arg2);
			$this->d->akun_piutang = $this->mm_customer_suplier->get($this->d->piutang->id_customer);
			$this->d->idinvoice = $arg2;
		} else if($this->d->_action == 'detaildtpiutang'){
			modelLoad($this, array('mm_akun'));
			$this->load->model('mt_bayar');
			$scoa = $this->mm_akun->view();
			$res = $this->mt_bayar->viewByInvoiceId($this->in, $arg2, $scoa);
			printJSON($res);
		} else if($this->d->_action == 'payment'){
			$u = a2o($this->input->post());
			$u->id_status = 1;
			$u->approval_1 = 1;
			$u->approval_2 = 1;
			$u->id_user_approval_1 = $this->session->userdata('id_user');
			$u->id_user_approval_2 = $this->session->userdata('id_user');
			$u->closing = 1;
			$this->load->model('mt_bayar');
			$this->db->trans_start();
			$this->mt_bayar->create($u);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Payment Piutang berhasil';
			} else {
				$s->status = false;
				$s->message = 'Payment Piutang gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$u->invoice);
		}

		$this->load->view('template_view', $this->d);
	}
	function pembayaran_hutang($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		if($this->d->_action == 'viewdthutang'){
			$this->load->model('mt_hbayar');
			$res = $this->mt_hbayar->viewDTHutang($this->in);
			printJSON($res);
		} else if($this->d->_action == 'detail'){
			$this->load->model('mt_hbayar');
			$this->load->model('mm_customer_suplier');
			$this->d->hutang = $this->mt_hbayar->get($arg2);
			$this->d->akun_hutang = $this->mm_customer_suplier->get($this->d->hutang->id_vendor);
			$this->d->iddn = $arg2;
		} else if($this->d->_action == 'detaildthutang'){
			modelLoad($this, array('mm_akun'));
			$this->load->model('mt_hbayar');
			$scoa = $this->mm_akun->view();
			$res = $this->mt_hbayar->viewByInvoiceId($this->in, $arg2, $scoa);
			printJSON($res);
		} else if($this->d->_action == 'payment'){
			$u = a2o($this->input->post());
			$u->id_status = 1;
			$u->approval_1 = 1;
			$u->approval_2 = 1;
			$u->id_user_approval_1 = $this->session->userdata('id_user');
			$u->id_user_approval_2 = $this->session->userdata('id_user');
			$u->closing = 1;
			$this->load->model('mt_hbayar');
			$this->db->trans_start();
			$this->mt_hbayar->create($u);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Payment Hutang berhasil';
			} else {
				$s->status = false;
				$s->message = 'Payment Hutang gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$u->invoice);
		}

		$this->load->view('template_view', $this->d);
	}
	function hpp($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$in = a2o($this->input->post());

		$this->load->model('mt_lap_hpp');
		$this->d->data = $this->mt_lap_hpp->view($in);
		if(isset($in->tgl1) && isset($in->tgl2)){
			$this->d->tgl1 = $in->tgl1;
			$this->d->tgl2 = $in->tgl2;
		}

		$this->load->view('template_view', $this->d);
	}
	function neraca($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$in = a2o($this->input->post());

		$this->load->model('mt_lap_neraca');
		$this->d->data = $this->mt_lap_neraca->view($in);
		if(isset($in->tgl1) && isset($in->tgl2)){
			$this->d->tgl1 = $in->tgl1;
			$this->d->tgl2 = $in->tgl2;
		}

		$this->load->view('template_view', $this->d);
	}
	function laba_rugi($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$in = a2o($this->input->post());

		$this->load->model('mt_lap_laba_rugi');
		$this->d->data = $this->mt_lap_laba_rugi->view($in);
		if(isset($in->tgl1) && isset($in->tgl2)){
			$this->d->tgl1 = $in->tgl1;
			$this->d->tgl2 = $in->tgl2;
		}

		$this->load->view('template_view', $this->d);
	}
	function neraca_saldo($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$in = a2o($this->input->post());

		$this->load->model('mt_lap_neraca_saldo');
		$this->d->data = $this->mt_lap_neraca_saldo->view($in);
		
		if(isset($in->tgl1) && isset($in->tgl2)){
			$this->d->tgl1 = $in->tgl1;
			$this->d->tgl2 = $in->tgl2;
		}

		$this->load->view('template_view', $this->d);
	}
	function buku_besar($arg1="", $arg2="")
	{
		// print_r(getSession($this));
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$in = a2o($this->input->post());

		$this->load->model('mt_lap_bukubesar');
		$this->d->data = $this->mt_lap_bukubesar->view($in);

		modelLoad($this, array('mm_akun'));
		$this->d->scoa = $this->mm_akun->view();
		
		if(isset($in->tgl1) && isset($in->tgl2) && isset($in->coa)){
			$this->d->tgl1 = $in->tgl1;
			$this->d->tgl2 = $in->tgl2;
			$this->d->coa = $in->coa;
		}

		$this->load->view('template_view', $this->d);
	}
	function laporan_piutang($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$in = a2o($this->input->post());

		$this->load->model('mt_lap_piutang');
		$this->d->data = $this->mt_lap_piutang->view($in);
		if(isset($in->tgl1) && isset($in->tgl2)){
			$this->d->tgl1 = $in->tgl1;
			$this->d->tgl2 = $in->tgl2;
		}

		$this->load->view('template_view', $this->d);
	}
	function laporan_hutang($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$in = a2o($this->input->post());

		$this->load->model('mt_lap_hutang');
		$this->d->data = $this->mt_lap_hutang->view($in);
		if(isset($in->tgl1) && isset($in->tgl2)){
			$this->d->tgl1 = $in->tgl1;
			$this->d->tgl2 = $in->tgl2;
		}

		$this->load->view('template_view', $this->d);
	}
	function hutang($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		if($this->d->_action == 'add'){
			$this->d->_modal = array('m_akun');
		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}
	function laporan_pemasukan($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		if($this->d->_action == 'add'){
			$this->d->_modal = array('referensi_dokumen_pabean','referensi_valuta');
			$this->d->sdokumen_pabean = $this->mreferensi_dokumen_pabean->viewPosting(1);
		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}
	function laporan_pengeluaran($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		if($this->d->_action == 'add'){
			$this->d->_modal = array('referensi_dokumen_pabean');
		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function laporan_wip($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		if($this->d->_action == 'add'){
			$this->d->_modal = array('referensi_dokumen_pabean');
		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function laporan_mutasi_bahan_baku($arg1="", $arg2="")
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
//			$res = $this->msales_approval->viewDT($this->in);
//			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function laporan_mutasi_bahan_bakar($arg1="", $arg2="")
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
//			$res = $this->msales_approval->viewDT($this->in);
//			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function laporan_mutasi_barang_jadi($arg1="", $arg2="")
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
//			$res = $this->msales_approval->viewDT($this->in);
//			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function laporan_mutasi_barang_modal($arg1="", $arg2="")
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
//			$res = $this->msales_approval->viewDT($this->in);
//			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function laporan_mutasi_keperluan_penelitian($arg1="", $arg2="")
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
//			$res = $this->msales_approval->viewDT($this->in);
//			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function laporan_mutasi_peralatan_kantor($arg1="", $arg2="")
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
//			$res = $this->msales_approval->viewDT($this->in);
//			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function laporan_mutasi_sisa_produksi_scrap($arg1="", $arg2="")
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
//			$res = $this->msales_approval->viewDT($this->in);
//			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}
	
}
