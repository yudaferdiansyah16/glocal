<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maccount extends CI_Model
{
	function signin($in)
	{
		// $auname = 'admin';
		// $apasswd = '4dm!nS13P';
		//$passwd = md5(strtolower($in->passwd));

		$s = new stdClass();
		if (!empty($in->uname) && !empty($in->passwd)) {
			$this->load->model('mm_user');
			$user = $this->mm_user->getByColumn('email', $in->uname);
			$user = empty($user) ? $this->mm_user->getByColumn('username', $in->uname) : $user;

			if (!empty($user)) {
				if (password_verify($in->passwd, $user->passwd)) {
					$priv = $this->db->query("select * from t_priv_modul where id_priv = '$user->id_priv'");
					$user_modul = array();
					$id_modul = array();
					foreach ($priv->result() as $p) {
						array_push($user_modul, ['id_modul' => $p->id_modul, 'modul_actions' => $p->modul_actions]);
						array_push($id_modul, $p->id_modul);
					}
					//printJSON($id_modul);
					$this->session->set_userdata(array(
						'authenticated' => true,
						'so_id' => $user->id_user,
						'id_user' => $user->id_user,
						'nama' => $user->nama,
						'username' => $user->username,
						'email' => $user->email,
						'id_priv' => $user->id_priv,
						'lang_code' => $user->lang_code,
						'nama_priv' => $user->nama_priv,
						'user_moduls' => $user_modul,
						'id_moduls' => $id_modul
					));
					$s->success = true;
					$s->message = '';
				} else {
					$s->success = false;
					$s->message = 'Access Denied';
				}
			} else {
				$s->success = false;
				$s->message = 'Access Denied. User Unregistered';
			}
		} else {
			$s->success = false;
			$s->message = 'Access Denied';
		}

		return $s;
	}
}
