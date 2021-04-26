<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Referensi extends CI_Controller
{
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
		if (!isset($_SERVER['HTTP_REFERER'])) redirect('/');
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

	function kategori_barang($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_kategori_barang');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_kategori_barang->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function kapal($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_kapal');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_kapal->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function kantor_pabean($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_kantor_pabean');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_kantor_pabean->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function jenis_tpb($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_jenis_tpb');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_jenis_tpb->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function jenis_tarif($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_jenis_tarif');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_jenis_tarif->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function jenis_tanda_pengaman($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_jenis_tanda_pengaman');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_jenis_tanda_pengaman->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function jenis_pemasukan02($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_jenis_pemasukan02');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_jenis_pemasukan02->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function jenis_pemasukan01($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_jenis_pemasukan01');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_jenis_pemasukan01->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function jenis_nilai($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_jenis_nilai');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_jenis_nilai->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function jenis_kendaraan($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_jenis_kendaraan');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_jenis_kendaraan->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function jenis_jaminan($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_jenis_jaminan');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_jenis_jaminan->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function jenis_bc25($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_jenis_bc25');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_jenis_bc25->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function jenis_api($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_jenis_api');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_jenis_api->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function identitas($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_identitas');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_identitas->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function harga($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_harga');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_harga->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function filter_komunikasi($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_filter_komunikasi');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_filter_komunikasi->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function fasilitas($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_fasilitas');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_fasilitas->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function asal_barang($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_asal_barang');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_asal_barang->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function asal_data($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_asal_data');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_asal_data->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function asuransi($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_asuransi');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_asuransi->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function cara_angkut($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_cara_angkut');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_cara_angkut->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function cara_bayar($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_cara_bayar');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_cara_bayar->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function daerah($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_daerah');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_daerah->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function dokumen($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_dokumen');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_dokumen->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function detail_dokumen($arg1 = "", $arg2 = "")
	{
		$data = $this->input->post();
		$this->load->model('mtpb_dokumen');
		$res = $this->mtpb_dokumen->getDetailDokumenLainnya($data["id_header"],$this->in);
	
	
		$this->load->view('template_view', 	printJSON($res));
	}

	function detail_kemasan($arg1 = "", $arg2 = "")
	{
		$data = $this->input->post();
		$this->load->model('mtpb_kemasan');
		$res = $this->mtpb_kemasan->getDetailKemasan($data["id_header"],$this->in);
	
	
		$this->load->view('template_view', 	printJSON($res));
	}


	function dokumen_pabean($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_dokumen_pabean');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_dokumen_pabean->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function kategori_barangbc25($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_kategori_barangbc25');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_kategori_barangbc25->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function kemasan($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_kemasan');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_kemasan->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function kode_barang($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_kode_barang');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'store') {
			$this->db->trans_start();
			$this->mreferensi_kode_barang->create($this->in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Simpan data Referensi Kode Barang berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data Referensi Kode Barang gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'edit') {
			$this->d->data = $this->mreferensi_kode_barang->get($arg2);
		} else if ($this->d->_action == 'update') {
			$this->db->trans_start();
			$this->mreferensi_kode_barang->update($this->in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Ubah data Referensi Kode Barang berhasil';
			} else {
				$s->status = false;
				$s->message = 'Ubah data Referensi Kode Barang gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'delete') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_kode_barang->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function kode_guna($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_kode_guna');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_kode_guna->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function kode_id($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_kode_id');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_kode_id->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function komoditi($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_komoditi');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_komoditi->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function kondisi_barang($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_kondisi_barang');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_kondisi_barang->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function lokasi_bayar($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_lokasi_bayar');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_lokasi_bayar->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function mata_uang($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_mata_uang');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_mata_uang->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function module($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_module');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_module->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function privilage($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_privilage');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_privilage->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function negara($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_negara');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_negara->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'getselect') {
			$search = $this->input->get('search');
			$res = $this->mreferensi_negara->getSelect($search);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function bank($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mm_bank');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mm_bank->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'getselect') {
			$search = $this->input->get('search');
			$res = $this->mm_bank->getSelect($search);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function npwp_billing($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_npwp_billing');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_npwp_billing->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function pelabuhan($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_pelabuhan');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_pelabuhan->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function pemasok($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_pemasok');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'store') {
			$this->db->trans_start();
			$this->mreferensi_pemasok->create($this->in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Simpan data Referensi Pemasok berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data Referensi Pemasok gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'edit') {
			$this->d->data = $this->mreferensi_pemasok->get($arg2);
		} else if ($this->d->_action == 'update') {
			$this->db->trans_start();
			$this->mreferensi_pemasok->update($this->in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Ubah data Referensi Pemasok berhasil';
			} else {
				$s->status = false;
				$s->message = 'Ubah data Referensi Pemasok gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'delete') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_pemasok->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function pembayar($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_pembayar');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_pembayar->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function pengusaha($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_pengusaha');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'store') {
			$this->db->trans_start();
			$this->mreferensi_pengusaha->create($this->in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Simpan data Referensi Pengusaha berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data Referensi Pengusaha gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'edit') {
			$this->d->data = $this->mreferensi_pengusaha->get($arg2);
		} else if ($this->d->_action == 'update') {
			$this->db->trans_start();
			$this->mreferensi_pengusaha->update($this->in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Ubah data Referensi Pengusaha berhasil';
			} else {
				$s->status = false;
				$s->message = 'Ubah data Referensi Pengusaha gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		} else if ($this->d->_action == 'delete') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_pengusaha->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function pilihan_komunikasi($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_pilihan_komunikasi');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_pilihan_komunikasi->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function pos_tarif($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_pos_tarif');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_pos_tarif->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function ppjk($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_ppjk');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_ppjk->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function pungutan($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_pungutan');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_pungutan->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function refeteks($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_refeteks');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_refeteks->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function respon($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_respon');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_respon->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function satuan($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_satuan');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_satuan->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function skema_tarif($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_skema_tarif');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_skema_tarif->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function status($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_status');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_status->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function status_pengusaha($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_status_pengusaha');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_status_pengusaha->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function tarif_fasilitas($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_tarif_fasilitas');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_tarif_fasilitas->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function tipe_kontainer($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_tipe_kontainer');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_tipe_kontainer->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function tps($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_tps');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_tps->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function tujuan_pemasukan($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_tujuan_pemasukan');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_tujuan_pemasukan->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function tujuan_pengiriman($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_tujuan_pengiriman');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_tujuan_pengiriman->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function tujuan_tpb($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_tujuan_tpb');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_tujuan_tpb->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function tutup_pu($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_tutup_pu');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_tutup_pu->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function ukuran_kontainer($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_ukuran_kontainer');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_ukuran_kontainer->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function validasi($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_validasi');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_validasi->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function validasi_jenis_nilai($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_validasi_jenis_nilai');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_validasi_jenis_nilai->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}

	function valuta($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->load->model('mreferensi_valuta');
		if ($this->d->_action == 'add') {
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mreferensi_valuta->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'getselect') {
			$search = $this->input->get('search');
			$res = $this->mreferensi_valuta->getSelect($search);
			printJSON($res);
		} else if ($this->d->_action == 'select2') {
			$res = $this->mreferensi_valuta->select2($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}

		$this->load->view('template_view', $this->d);
	}
}
