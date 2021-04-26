<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    var $d;
    var $in;

    public function __construct()
    {
        parent::__construct();
        $this->d = getSession($this);
        $this->d->_notification = getNotification($this);
        $this->d->_controller = $this->router->fetch_class();
        $this->d->_method = $this->router->fetch_method();
        $this->in = getPostAsObject($this);
        if(empty($this->d->_id) and $this->d->method!='signin') redirect('/login');

        //$this->load->model('mmenu');
        //$this->d->_app_menu = generateMenu($this->mmenu->getMenu($this->d->_app_id, $this->d->_app_level), $this->d->_controller, $this->d->_method);
    }

	public function index()
	{
	    //printJSON($this->_app_menu);
		$this->load->view('template_view', $this->d);
	}
}
