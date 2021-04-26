<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    var $d;
    var $in;

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('authenticated') == true) {
			redirect(base_url('dashboard'));
		}
        $this->d = getSession($this);
        $this->d->_notification = getNotification($this);
        $this->d->_controller = $this->router->fetch_class();
        $this->d->_method = $this->router->fetch_method();
        $this->in = getPostAsObject($this);
    }

    function index()
    {
        $this->load->view('template_login', $this->d);
    }

    function signin()
    {
        $this->db->trans_start();
        modelLoad($this, array('maccount'));
        $response = $this->maccount->signin($this->in);
	helper_log();
        $this->db->trans_complete();
        $status = $this->db->trans_status();
        
        $s = new stdClass();
        if($response->success){
            $s->status = true;
            $s->message = 'Welcome, '.$this->session->userdata('nama');
			setNotification($this, $s);
			redirect(base_url('dashboard'));
        } else {
            $s->status = false;
            $s->message = 'Maaf Login Gagal';
			setNotification($this, $s);
			redirect(base_url('login'));
        }
    }
}
