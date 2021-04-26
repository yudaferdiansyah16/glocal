<?php

class Gfp extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}
	public function halaman_reset()
	{
		$this->load->view('email_check');
	}
	public function index()
	{

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('email_check');
		}
		else
		{
			$email= $this->input->post('email');

			$this->load->helper('string');
			$rs= random_string('alnum', 12);

			$data = array(
				'passwd' => $rs
			);
			$this->db->where('email', $email);
			$this->db->update('m_user', $data);

			$this->load->library('email');

			$this->email->initialize(array(
				'protocol' => 'smtp',
				'smtp_host' => 'in-v3.mailjet.com',
				'smtp_port' => 587,
				'smtp_user' => 'd8138afb31cc55d3046e94dec0e387ee',
				'smtp_pass' => 'b730d9726f7eac1e4e8cacd2b5b46651',
				'mailtype' => 'html',
				'charset' => 'utf-8',
				'crlf' => "\r\n",
				'newline' => "\r\n"
			));

				$this->email->from('khafit.insyaf66@gmail.com', 'Khaf');
				$this->email->to($email);

				$this->email->subject('Get your forgotten Password');
				$this->email->message('Please go to this link to get your password.
     			  http://192.168.0.12/sbp/get_password/'.$rs );

				$this->email->send();
				echo "Please check your email address.";


//			$this->load->library('email');
//
//			//SMTP & mail configuration
//			$config = array(
//				'protocol' => 'smtp',
//				'smtp_host' => 'ssl://in-v3.mailjet.com',
//				'smtp_port' => 465,
//				'smtp_user' => 'd8138afb31cc55d3046e94dec0e387ee',
//				'smtp_pass' => 'b730d9726f7eac1e4e8cacd2b5b46651',
//				'mailtype' => 'html',
//				'charset' => 'utf-8'
//			);
//
//			$this->email->initialize($config);

// 			 $config['protocol'] = 'smtp';
// 			 $config['smtp_host'] = 'in-v3.mailjet.com';
//             $config['smtp_port'] = 465;
//             $config['smtp_user'] = 'd8138afb31cc55d3046e94dec0e387ee';
//             $config['smtp_pass'] = 'b730d9726f7eac1e4e8cacd2b5b46651';
//             $config['starttls'] = true;

//			ini_set("SMTP","in-v3.mailjet.com");
//			ini_set("smtp_port","465");
//			ini_set('sendmail_from', 'khafit.insyaf66@gmail.com');

//              $this->email->library('email', $config);

//              	$this->email->from('khafit.insyaf66@gmail.com', 'Khaf');
//				$this->email->to($email);
//
//				$this->email->subject('Get your forgotten Password');
//				$this->email->message('Please go to this link to get your password.
//     			  http://192.168.0.14/sbp/get_password/'.$rs );
//
//				$this->email->send();
//				echo "Please check your email address.";
		}
	}

	public function email_check($str)
	{
		$query = $this->db->get_where('m_user', array('email' => $str), 1);

		if ($query->num_rows()== 1)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('email_check', 'This Email does not exist.');
			return false;

		}
	}
}
