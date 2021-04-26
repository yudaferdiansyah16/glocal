<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	var $d;
	var $in;

	public function __construct()
	{
		parent::__construct();
//		if(!isset($_SERVER['HTTP_REFERER'])) redirect('/');
		helper_log();
		$this->d = getSession($this);
		$this->d->_notification = getNotification($this);
		$this->d->_controller = $this->router->fetch_class();
		$this->d->_method = $this->router->fetch_method();
		loadLanguage($this, $this->d->_controller, $this->d->_method);
		$this->in = getPostAsObject($this);
	}

	public function index()
	{
		$this->load->view('auth/login');
	}
}
