<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    var $d;
    var $in;

    public function __construct() {
        parent::__construct();
        if (!isset($_SERVER['HTTP_REFERER'])) redirect('/');
        if($this->session->userdata('authenticated') == FALSE) {
            $this->session->sess_destroy();
			redirect('login');
        }
        helper_log();
        updateRateBC($this, date('d-m-Y'));
        $this->d = getSession($this);
        $this->d->_notification = getNotification($this);
        $this->d->_controller = $this->router->fetch_class();
        $this->d->_method = $this->router->fetch_method();
        loadLanguage($this, $this->d->_controller, $this->d->_method);
        $this->in = getPostAsObject($this);
    }

    public function index() {
        modelLoad($this, array('Mm_module'));
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;
        modelLoad($this,array('mm_rates','mtpb_header'));
        if ($this->d->_action == 'view') {
            $this->d->checkrate = $this->mm_rates->checkrate();
            $this->d->datarate = $this->mm_rates->dashboardLatest();
        } else if ($this->d->_action == 'store') { 
        } else if ($this->d->_action == 'edit') {
        } else if ($this->d->_action == 'updaterate'){
			$this->db->trans_start();
			// updateRateBC($this, date('d-m-Y'));
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
                $s->status = true;
                $s->message = 'Update Kurs Berhasil';
            } else {
                $s->status = false;
                $s->message = 'Update Kurs Gagal';
            }
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {  
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_module->viewDT($this->in);
            printJSON($res);
        }


        $this->load->view('template_view', $this->d);
    }

}
