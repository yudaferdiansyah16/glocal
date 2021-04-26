<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
	var $d;
	var $in;

	public function __construct()
	{
		parent::__construct();
		if (!isset($_SERVER['HTTP_REFERER'])) redirect('/');
		if($this->session->userdata('authenticated') == FALSE) {
            $this->session->sess_destroy();
			redirect('login');
		}
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
		$this->load->view('template_view');
	}

	function user_list($arg1 = "", $arg2 = "")
	{
		modelLoad($this, array('mm_user', 'mm_role'));
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		if ($this->d->_action == 'add') {
			modelLoad($this, array('mm_user'));
			$this->d->priv = $this->mm_role->view();
		} else if ($this->d->_action == 'store') {
			modelLoad($this, array('mm_user'));
			$this->db->trans_start();
			$t = a2o($this->in);
			$id = $this->mm_user->create($t);

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Simpan user berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan user gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'edit') {
			$this->d->data = $this->mm_user->get($arg2);
			$this->d->priv = $this->mm_role->view();
		} else if ($this->d->_action == 'update') {
			$this->db->trans_start();

			$this->mm_user->update($this->in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Ubah akun berhasil';
			} else {
				$s->status = false;
				$s->message = 'Ubah akun gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'image_update') {
			$t_bom = $this->mt_bom->get($this->in->id_bom);
			if (!empty($t_bom->image_file)) {
				unlink('upload/bom/' . $t_bom->image_file);
			}

			$config['upload_path']          = './upload/bom/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 1000;
			$config['file_name']             = 'bom_' . $t_bom->id_bom . "_" . date('YmdHis');

			$this->load->library('upload', $config);
			$s = new stdClass();
			if (!$this->upload->do_upload('bom_image')) {
				$error = array('error' => $this->upload->display_errors());
				$s->status = false;
				$s->message = 'Update image BOM gagal';
			} else {
				$data = array('upload_data' => $this->upload->data());
				$t = new stdClass();
				$t->id_bom = $t_bom->id_bom;
				$t->image_file = $data['upload_data']['orig_name'];
				$this->mt_bom->update($t);
				//printJSON($data);
				$s->status = true;
				$s->message = 'Update image BOM berhasil';
			}
		} else if ($this->d->_action == 'delete') {
			$this->db->trans_start();
			$this->mm_user->delete($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Hapus akun berhasil';
			} else {
				$s->status = false;
				$s->message = 'Hapus akun gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mm_user->viewDT($this->in);
			printJSON($res);
		}


		$this->load->view('template_view', $this->d);
	}

	function role($arg1 = "", $arg2 = "")
	{
		modelLoad($this, array('mm_role'));
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		if ($this->d->_action == 'add') {
			modelLoad($this, array('mm_role'));
		} else if ($this->d->_action == 'store') {
			modelLoad($this, array('mm_role'));
			$this->db->trans_start();
			$t = a2o($this->in);
			$id = $this->mm_role->create($t);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Tambah berhasil';
			} else {
				$s->status = false;
				$s->message = 'Tambah gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'edit') {
			$this->d->data = $this->mm_role->get($arg2);
		} else if ($this->d->_action == 'update') {
			$this->db->trans_start();
			$this->mm_role->update($this->in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Ubah role berhasil';
			} else {
				$s->status = false;
				$s->message = 'Ubah role gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'delete') {
			$this->db->trans_start();
			$this->mm_role->delete($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Hapus role berhasil';
			} else {
				$s->status = false;
				$s->message = 'Hapus role gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mm_role->viewDT($this->in);
			printJSON($res);
		}
		$this->load->view('template_view', $this->d);
	}

	function module($arg1 = "", $arg2 = "")
	{
		modelLoad($this, array('mm_module'));
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;
		if ($this->d->_action == 'add') {
			$this->d->modules = $this->mm_module->view();
		} else if ($this->d->_action == 'store') {
			modelLoad($this, array('mm_module'));
			$this->db->trans_start();
			$t = a2o($this->in);
			$id = $this->mm_module->create($t);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Tambah module berhasil';
			} else {
				$s->status = false;
				$s->message = 'Tambah module gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'edit') {
			modelLoad($this, array('mm_module'));
			$this->d->data = $this->mm_module->get($arg2);
			$this->d->modules = $this->mm_module->view();
		} else if ($this->d->_action == 'update') {
			$this->db->trans_start();
			$this->mm_module->update($this->in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Ubah module berhasil';
			} else {
				$s->status = false;
				$s->message = 'Ubah module gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'update_state') {
			function parseJsonArray($jsonArray, $parentID = 0) {

				$return = array();
				foreach ($jsonArray as $subArray) {
					$returnSubSubArray = array();
					if (isset($subArray->children)) {
						$returnSubSubArray = parseJsonArray($subArray->children, $subArray->id);
					}

					$return[] = array('id' => $subArray->id, 'parentID' => $parentID);
					$return = array_merge($return, $returnSubSubArray);
				}
				return $return;
			}

			$modules = parseJsonArray(json_decode($_POST['modules']));

			$this->db->trans_start();
			foreach ($modules as $i => $item) {
				$t = new stdClass();
				$t->id_modul = $item['id'];
				$t->id_modul_parent = $item['parentID'];
				$t->order_menu = $i;
				$this->mm_module->update($t);
			}
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Ubah module berhasil';
			} else {
				$s->status = false;
				$s->message = 'Ubah module gagal';
			}
			printJSON($s);
		} else if ($this->d->_action == 'delete') {
			$this->db->trans_start();
			$this->mm_module->delete($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Hapus module berhasil';
			} else {
				$s->status = false;
				$s->message = 'Hapus module gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mm_module->viewDT($this->in);
			printJSON($res);
		}


		$this->load->view('template_view', $this->d);
	}

	function access_module($arg1 = "", $arg2 = "")
	{
		modelLoad($this, array('mm_access_module'));
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;
		if ($this->d->_action == 'add') {
			$this->load->model('mreferensi_module');
			$this->d->modul = $this->mreferensi_module->view();
			$this->load->model('mreferensi_privilage');
			$this->d->privi = $this->mreferensi_privilage->view();
		} else if ($this->d->_action == 'store') {
			modelLoad($this, array('mm_access_module'));
			$this->db->trans_start();
			$t = a2o($this->in);
			$id = $this->mm_access_module->create($t);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Tambah access module berhasil';
			} else {
				$s->status = false;
				$s->message = 'Tambah access module gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'edit') {
		} else if ($this->d->_action == 'update') {
		} else if ($this->d->_action == 'delete') {
			$this->db->trans_start();
			$this->mm_access_module->delete($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Hapus access module berhasil';
			} else {
				$s->status = false;
				$s->message = 'Hapus access module gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mm_access_module->viewDTP($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'viewdtm') {
			$this->in->priv = $arg2;
			$res = $this->mm_access_module->viewDTM($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'changeStatus') {
			//printJSON($this->in->modul);
			$this->db->trans_start();
			if (count($this->in->modul) > 0) {
				$this->mm_access_module->deleteWhere(array('id_priv' => $this->in->modul[0]['id_priv']));
			}
			foreach ($this->in->modul as $modul) {
				if(isset($modul['modul_actions'])){
					$this->mm_access_module->update($modul['id_priv'], $modul['id_modul'], $modul['modul_actions']);
				} else {
					$this->mm_access_module->update($modul['id_priv'], $modul['id_modul']);
				}
				// if ($modul['id_modul_parent'] != 0) {
				// 	$this->mm_access_module->update($modul['id_priv'], $modul['id_modul_parent'], $modul['modul_actions']);
				// }
			}
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status access module berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status access module gagal';
            }
            setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		}
		$this->load->view('template_view', $this->d);
	}

	function profile($arg1 = "", $arg2 = "")
	{
		modelLoad($this, array('mm_profile', 'mm_user', 'mm_role'));
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;
		$this->d->data = $this->mm_user->get($arg2);
		if ($this->d->_action == 'view') {
			$this->d->m_user = $this->mm_user->getByColumn('id_user', $this->session->userdata('id_user'));
		} else if ($this->d->_action == 'store') {
			modelLoad($this, array('mm_user'));
			$this->db->trans_start();
			$t = a2o($this->in);
			$id = $this->mm_user->create($t);

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Simpan user berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan user gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'edit') {
			$this->d->data = $this->mm_user->view();
		} else if ($this->d->_action == 'update') {
			$this->db->trans_start();
			$this->in->id_user = $this->session->userdata('id_user');

			if (empty($this->in->passwd)) {
				unset($this->in->passwd);
			}else if (!empty($user->photo_file)) {
					unlink('assets/img/' . $user->photo_file);
				}
	
				$config['upload_path']          = './assets/img/';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_size']             = 1000;
				$config['file_name']             = $this->photo_file;
	
				
			
			$this->mm_user->update($this->in);
			$user = $this->mm_user->getByColumn('id_user', $this->session->userdata('id_user'));
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
				'photo_file' => $user->photo_file,
				
				
			));
			$this->load->library('upload', $config);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Ubah akun berhasil';
			} else {
				$s->status = false;
				$s->message = 'Ubah akun gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'delete') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mm_profile->viewDT($this->in);
			printJSON($res);
		}
		$this->load->view('template_view', $this->d);
	}

	function reset_password($arg1 = "", $arg2 = "")
	{
		modelLoad($this, array('mm_profile'));
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'store') {
		} else if ($this->d->_action == 'edit') {
		} else if ($this->d->_action == 'update') {
		} else if ($this->d->_action == 'delete') {
			$this->db->trans_start();
			$this->mm_user->delete($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Hapus akun berhasil';
			} else {
				$s->status = false;
				$s->message = 'Hapus akun gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mm_profile->viewDT($this->in);
			printJSON($res);
		}
		$this->load->view('template_view', $this->d);
	}

	function perusahaan($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mm_sbu');
		if ($this->d->_action == 'view') {
			modelLoad($this, array('mm_manager_plant'));
			$this->d->smanager_plant = $this->mm_manager_plant->view();
			$this->d->m_sbu = $this->mm_sbu->getCurrent();
		} else if ($this->d->_action == 'view') {
			$this->db->trans_start();
			$t = $this->in;
			$t->id_status = 1;
			$this->mm_sbu->create($t);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Simpan data sbu berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data sbu gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'edit') {
			modelLoad($this, array('mm_manager_plant'));
			$this->d->smanager_plant = $this->mm_manager_plant->view();
			$this->d->data = $this->mm_sbu->get($arg2);
		} else if ($this->d->_action == 'update') {
			$this->db->trans_start();
			$this->mm_sbu->update($this->in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Ubah data sbu berhasil';
			} else {
				$s->status = false;
				$s->message = 'Ubah data sbu gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'delete') {
			$this->db->trans_start();
			$this->mm_sbu->delete($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Hapus data sbu berhasil';
			} else {
				$s->status = false;
				$s->message = 'Hapus data sbu gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mm_sbu->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'changeStatus') {
			$this->db->trans_start();
			$this->mm_sbu->update($this->in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Ubah status sbu berhasil';
			} else {
				$s->status = false;
				$s->message = 'Ubah status sbu gagal';
			}
			printJSON($s);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function dokumen_perusahaan($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mm_sbu');
		if ($this->d->_action == 'view') {
			modelLoad($this, array('mm_manager_plant'));
			$this->d->smanager_plant = $this->mm_manager_plant->view();
			$this->d->m_sbu = $this->mm_sbu->getCurrent();
		} else if ($this->d->_action == 'view') {
			$this->db->trans_start();
			$t = $this->in;
			$t->id_status = 1;
			$this->mm_sbu->create($t);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Simpan Dokumen Perusahaan berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan Dokumen Perusahaan gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'edit') {
			modelLoad($this, array('mm_manager_plant'));
			$this->d->smanager_plant = $this->mm_manager_plant->view();
			$this->d->data = $this->mm_sbu->get($arg2);
		} else if ($this->d->_action == 'update') {
			$this->db->trans_start();
			$this->mm_sbu->update($this->in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Ubah Dokumen Perusahaan berhasil';
			} else {
				$s->status = false;
				$s->message = 'Ubah Dokumen Perusahaan gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'delete') {
			$this->db->trans_start();
			$this->mm_sbu->delete($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Hapus data sbu berhasil';
			} else {
				$s->status = false;
				$s->message = 'Hapus data sbu gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mm_sbu->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'changeStatus') {
			$this->db->trans_start();
			$this->mm_sbu->update($this->in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Ubah status sbu berhasil';
			} else {
				$s->status = false;
				$s->message = 'Ubah status sbu gagal';
			}
			printJSON($s);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function log($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;
		modelLoad($this, array('m_log'));

		if($this->d->_action == 'view') {
			$in = a2o($this->in);
			if(isset($in->tglawal)){
				$this->d->tglawal = $in->tglawal;
				if ($in->tglawal != '') $in->tglawal = reverseDate($in->tglawal); else $in->tglawal = null;
				$this->d->data = $this->m_log->view($in);
			}else{
				$in = new stdClass();
				$in->tglawal = date('Y-m-d');
				$this->d->data = $this->m_log->view($in);
			}
			$this->load->view('template_view', $this->d);
		}else if($this->d->_action == 'resetLog') {
			$this->db->trans_start();
			$in = a2o($this->in);
			$this->m_log->reset($in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status) {
				$s->status = true;
				$s->message = 'Reset Log berhasil';
			}else{
				$s->status = false;
				$s->message = 'Reset Log gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		}
	}
}
