<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exim extends CI_Controller {
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
		$this->load->model('otherdb');
		// Database 1
		$data['data1'] = $this->otherdb->get_db1();
		// Database 2
		$data['data2'] = $this->otherdb->get_db2();
	}

	function cas_doc_in($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('mtpb_header'));
		if($this->d->_action == 'view'){
			modelLoad($this,array('mreferensi_dokumen_pabean'));
			$this->d->sdokumen_pabean = $this->mreferensi_dokumen_pabean->viewPosting(1);
		} else if($this->d->_action == 'getresponse'){
			$this->db->trans_start();
			$this->load->model('mtpb_approval');
			// modelLoad($this,(array('mmigration_setting_tpb')));
			// $datacon = $this->mmigration_setting_tpb->view();
			$res = $this->mtpb_approval->getresponse($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($res){
				$s->status = true;
				$s->message = 'Get Respon Doc In berhasil';
			} else {
				$s->status = false;
				$s->message = 'Nomor Daftar belum ada';
			}
			setNotification($this, $s);
			redirect('exim/cas_doc_in/');
		} else if($this->d->_action == 'viewdt'){
			$res = $this->mtpb_header->viewCASDocIn($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewjaminan'){
			modelLoad($this,array('mtpb_jaminan'));
			$res = $this->mtpb_jaminan->viewjaminan($this->in,$arg2);
			printJSON($res);
		} else if($this->d->_action == 'detail'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen','mtpb_kontainer'));
			$this->d->tpbHeader = $this->mtpb_header->getHeader($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->kontainer = $this->mtpb_kontainer->getKontainer($arg2);
		} else if($this->d->_action == 'detail_23'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen','mtpb_kontainer'));
			$this->d->tpbHeader = $this->mtpb_header->getHeader($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->kontainer = $this->mtpb_kontainer->getKontainer($arg2);
		} else if($this->d->_action == 'detail_262'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen'));
			$this->d->tpbHeader = $this->mtpb_header->get($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
		} else if($this->d->_action == 'detail_27IN'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen'));
			$this->d->tpbHeader = $this->mtpb_header->get($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
		} else if($this->d->_action == 'detail_40'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen'));
			$this->d->tpbHeader = $this->mtpb_header->get($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
		} else if ($this->d->_action == 'viewDetailDocIn'){
			$this->load->model('mtpb_header');
			$res = $this->mtpb_header->viewDetailDocIn($this->in,$arg2);
			printJSON($res);
		} else if ($this->d->_action == 'viewDokumenDocIn'){
			$this->load->model('mtpb_header');
			$res = $this->mtpb_header->viewDokumenDocIn($this->in,$arg2);
			printJSON($res);
		} else if ($this->d->_action == 'approval1'){
			$this->db->trans_start();
			$this->load->model('mtpb_approval');
			modelLoad($this,(array('mmigration_setting_tpb')));
			// $datacon = $this->mmigration_setting_tpb->view();
			$this->mtpb_approval->approval1($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Doc In berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Doc In gagal';
			}
			setNotification($this, $s);
			redirect('exim/cas_doc_in/detail/'.$arg2);
		} else if ($this->d->_action == 'approval2'){
			$this->db->trans_start();
			$this->load->model('mtpb_approval');
			$this->mtpb_approval->approval2($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval 2 data Doc In berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval 2 data Doc In gagal';
			}
			setNotification($this, $s);
			redirect('exim/cas_doc_in/detail/'.$arg2);
		}

		$this->load->view('template_view', $this->d);
	}

	function cas_doc_out($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('mtpb_header'));
		if($this->d->_action == 'view'){
			modelLoad($this,array('mreferensi_dokumen_pabean'));
			$this->d->sdokumen_pabean = $this->mreferensi_dokumen_pabean->viewPosting(0);
		} else if($this->d->_action == 'getresponse'){
			$this->db->trans_start();
			$this->load->model('mtpb_approval');
			modelLoad($this,(array('mmigration_setting_tpb')));
			$datacon = $this->mmigration_setting_tpb->view();
			$res = $this->mtpb_approval->getresponse($arg2, $datacon);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($res){
				$s->status = true;
				$s->message = 'Get Respon Doc Out berhasil';
			} else {
				$s->status = false;
				$s->message = 'Nomor Daftar belum ada';
			}
			setNotification($this, $s);
			redirect('exim/cas_doc_out/');
		} else if($this->d->_action == 'viewdt'){
			$res = $this->mtpb_header->viewCASDocOut($this->in);
			printJSON($res);
		} else if($this->d->_action == 'detail'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen','mtpb_kontainer'));
			$this->d->tpbHeader = $this->mtpb_header->getHeader($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->kontainer = $this->mtpb_kontainer->getKontainer($arg2);
		} else if($this->d->_action == 'viewBahanBakuDT'){
			modelLoad($this,array('mt_invoice'));
			$res = $this->mtpb_header->viewBahanBakuDT($this->in, $arg2);
			printJSON($res);
		} else if ($this->d->_action == 'viewDetailDocIn'){
			$this->load->model('mtpb_header');
			$res = $this->mtpb_header->viewDetailDocIn($this->in,$arg2);
			printJSON($res);
		} else if ($this->d->_action == 'viewDokumenDocIn'){
			$this->load->model('mtpb_header');
			$res = $this->mtpb_header->viewDokumenDocIn($this->in,$arg2);
			printJSON($res);
		} else if ($this->d->_action == 'approval1'){
			$this->db->trans_start();
			$this->load->model('mtpb_approval');
			// modelLoad($this,(array('mmigration_setting_tpb')));
			// $datacon = $this->mmigration_setting_tpb->view();
			$this->mtpb_approval->approval1($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Doc Out berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Doc Out gagal';
			}
			setNotification($this, $s);
			redirect('exim/cas_doc_out/detail/'.$arg2);
		} else if ($this->d->_action == 'approval2'){
			$this->db->trans_start();
			$this->load->model('mtpb_approval');
			$this->mtpb_approval->approval2($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval 2 data Doc Out berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval 2 data Doc Out gagal';
			}
			setNotification($this, $s);
			redirect('exim/cas_doc_out/detail/'.$arg2);
		}

		$this->load->view('template_view', $this->d);
	}

	function reporting_doc_in($arg1="", $arg2="")
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

	function reporting_doc_out($arg1="", $arg2="")
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

	function transaksi_doc_in($arg1="", $arg2="")
	{
		modelLoad($this,array('mtpb_header'));
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;
		$this->d->_modal = array('referensi_pengusaha');
		modelLoad($this,array('mtpb_approval','mm_customer_suplier'));
		if($this->d->_action == 'view'){
			modelLoad($this,array('mreferensi_dokumen_pabean'));
			$this->d->ssupplier = $this->mm_customer_suplier->viewSupplier();
			$this->d->sdokumen_pabean = $this->mreferensi_dokumen_pabean->viewPosting(1);
		} else if($this->d->_action == 'add'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_tujuan_pemasukan','mreferensi_tujuan_tpb','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan'));
			$this->d->_modal = array('referensi_valuta','t_detail_dn_exim_in','referensi_pengusaha','add_tarif','referensi_pelabuhan','referensi_pelabuhan_muat','referensi_pelabuhan_transit','referensi_pelabuhan_bongkar','referensi_negara','bc_261','referensi_kemasan','referensi_kemasan_docin','t_dn_docin','m_customer', 'm_sub_barang','m_supplier_docin');
			$this->d->sjenis_tpb = $this->mreferensi_jenis_tpb->view();
			$this->d->stujuan_pengiriman = $this->mreferensi_tujuan_pengiriman->view();
			$this->d->stujuan_pemasukan = $this->mreferensi_tujuan_pemasukan->view();
			$this->d->stujuan_tpb = $this->mreferensi_tujuan_tpb->view();
			$this->d->scara_angkut = $this->mreferensi_cara_angkut->view();
			$this->d->sdokumen_pabean = $this->mreferensi_dokumen_pabean->viewPosting(1);
			$this->d->sjenis_jaminan = $this->mreferensi_jenis_jaminan->view();
			$this->d->stipe_kontainer = $this->mreferensi_tipe_kontainer->view();
			$this->d->sukuran_kontainer = $this->mreferensi_ukuran_kontainer->view();
			$this->d->sskema_tarif = $this->mreferensi_skema_tarif->view();
			$this->d->sdokumen = $this->mreferensi_dokumen->view();
			// $this->d->sbarang = $this->mreferensi_dokumen->view();
			$this->d->skode_kemasan = $this->mreferensi_kemasan->view();
		} else if($this->d->_action == 'store'){
			modelLoad($this,array('mreferensi_dokumen','mtpb_header','mtpb_barang','mtpb_barang_tarif','mtpb_kontainer','mtpb_dokumen','mtpb_dokumen_detail','mtpb_barang_dokumen','mtpb_jaminan','mtpb_kemasan','mtpb_detil_status','mtpb_approval','mm_supplier','mreferensi_tps','mtpb_pungutan','mt_detail_dn','mt_dn'));
			$no_aju = $this->mtpb_header->generateCode($this->in->tpb_header['KODE_DOKUMEN_PABEAN'], $this->in->tpb_header['TANGGAL_AJU']);
			$this->db->trans_start();
			$jenis_doc = $this->in->tpb_header['KODE_DOKUMEN_PABEAN'];
			getAppSetting($this);

			if ($jenis_doc==23){
				$this->processdocinbc23($this->in, $no_aju);
			} else if ($jenis_doc==262){
				$this->processdocinbc262($this->in, $no_aju);
			} else if ($jenis_doc==40){
				// printJSON($this->in);
				$this->processdocinbc40($this->in, $no_aju);
			} else if ($jenis_doc==27){
				$this->processdocinbc27($this->in, $no_aju);
			}

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data Doc In berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data Doc In gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'getdndetail'){
			modelLoad($this,array('mt_detail_dn'));
			$res = $this->mt_detail_dn->getAllbyDN($arg2);
			printJSON($res);
		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$res = $this->mtpb_header->viewDTDocIn($this->in);
			printJSON($res);
		}else if($this->d->_action == 'viewDetailBarang'){
			modelLoad($this,array('mtpb_barang'));
			$data = $this->input->post();
			$query['tampil'] = $this->mtpb_barang->getDetailBarangg($data["id_header"],$this->in);
			printJSON($query);
		} else if($this->d->_action == 'viewReferensiBarang261'){
			$res = $this->mtpb_header->viewReferensiBarang261($this->in);
			printJSON($res);
		} else if($this->d->_action == 'view261'){
			$res = $this->mtpb_header->view261($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewjaminan'){
			$res = $this->mtpb_jaminan->viewjaminan($this->in,$arg2);
			printJSON($res);
		}  else if($this->d->_action == 'viewDetailDNDocIn'){
			modelLoad($this,array('mt_detail_dn'));
			$res = $this->mt_detail_dn->viewDetailDNDocIn($this->in);
			printJSON($res);
		}  else if($this->d->_action == 'viewInvoiceDocIn'){
			modelLoad($this,array('mt_dn'));
			$res = $this->mt_dn->viewDocInDT($this->in);
			printJSON($res);
		}  else if($this->d->_action == 'viewDetailDokumen'){
			$data = $this->input->post();
			$this->load->model('mtpb_dokumen');
			$res = $this->mtpb_dokumen->getDetailDokumenLainnya($data["id_header"],$this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewDetailKemasan'){
			$data = $this->input->post();
			modelLoad($this,array('mtpb_kemasan'));
			$res = $this->mtpb_kemasan->getDetailKemasan($data["id_header"],$this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewDetailKontainer'){
			$data = $this->input->post();
			modelLoad($this,array('mtpb_kontainer'));
			$res = $this->mtpb_kontainer->getDetailKontainer($data["id_header"],$this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewDetailJaminan'){
			$data = $this->input->post();
			modelLoad($this,array('mtpb_jaminan'));
			$res = $this->mtpb_jaminan->getDetailJaminan($data["id_header"],$this->in);
			printJSON($res);
		} else if($this->d->_action == 'detail'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen','mtpb_kontainer','mtpb_kemasan','mtpb_jaminan'));
			$this->d->_modal = array('m_kontainer','m_detail_kontainer','m_harga','m_dokumen','m_detail_dokumen','m_detail_kemasan','m_barangdt','m_jaminan','m_detail_jaminan','m_kemasan','m_barangdt40');
			$this->d->tpbHeader = $this->mtpb_header->getHeader($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->kontainer = $this->mtpb_kontainer->getKontainer($arg2);
			$this->d->kemasan = $this->mtpb_kemasan->getKemasan($arg2);
			$this->d->jaminan = $this->mtpb_jaminan->getJaminan($arg2);

		} else if($this->d->_action == 'detail_23'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen','mtpb_kontainer'));
			
			$this->d->tpbHeader = $this->mtpb_header->getHeader($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->kontainer = $this->mtpb_kontainer->getKontainer($arg2);
		} else if($this->d->_action == 'detail_262'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen','mtpb_kontainer','mtpb_kemasan','mtpb_jaminan','mtpb_barang','mtpb_bahan_baku','mtpb_bahan_baku_tarif','mtpb_barang_tarif'));
			$this->d->tpbHeader = $this->mtpb_header->get($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
			$this->d->kemasan = $this->mtpb_kemasan->getKemasan($arg2);
			$this->d->kontainer = $this->mtpb_kontainer->getKontainer($arg2);
			$this->d->jaminan = $this->mtpb_jaminan->getJaminan($arg2);
			$this->d->barang = $this->mtpb_barang->getBarang($arg2);
			$this->d->barangtarif = $this->mtpb_barang_tarif->getBarang($arg2);
			$this->d->bahantarif = $this->mtpb_bahan_baku_tarif->getBahantarif($arg2);

		} else if($this->d->_action == 'detail_27IN'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen','mtpb_kontainer','mtpb_kemasan', 'mtpb_barang', 'mtpb_bahan_baku'));
			$this->d->tpbHeader = $this->mtpb_header->get($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
			$this->d->kontainer = $this->mtpb_kontainer->getKontainer($arg2);
			$this->d->kemasan = $this->mtpb_kemasan->getKemasan($arg2);
			$this->d->barang = $this->mtpb_barang->getBarang($arg2);
			$this->d->barangtarif = $this->mtpb_barang_tarif->getBarang($arg2);
			$this->d->bahantarif = $this->mtpb_bahan_baku_tarif->getBahantarif($arg2);
		} else if($this->d->_action == 'detail_40'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen','mtpb_kemasan'));
			$this->d->_modal = array('m_kontainer','m_harga','m_dokumen','m_detail_dokumen','m_detail_kemasan','m_barangdt','m_jaminan','m_kemasan','m_barangdt40');
			$this->d->tpbHeader = $this->mtpb_header->get($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
			$this->d->kemasan = $this->mtpb_kemasan->getKemasan($arg2);

		} else if($this->d->_action == 'edit_23'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen','mtpb_kontainer'));
			
			$this->d->tpbHeader = $this->mtpb_header->getHeader($arg2);
			// $this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			// $this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			// $this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			// $this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			// $this->d->kontainer = $this->mtpb_kontainer->getKontainer($arg2);
		} else if($this->d->_action == 'edit_262'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen'));
			$this->d->tpbHeader = $this->mtpb_header->get($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
		} else if($this->d->_action == 'edit_40'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen','mtpb_kontainer','mtpb_kemasan','mtpb_jaminan'));
			$this->d->_modal = array('m_kontainer','m_harga','m_dokumen','m_detail_dokumen','m_detail_kemasan','m_barangdt','m_jaminan','m_kemasan','m_barangdt40');
			$this->d->tpbHeader = $this->mtpb_header->getHeader($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->kontainer = $this->mtpb_kontainer->getKontainer($arg2);
			$this->d->kemasan = $this->mtpb_kemasan->getKemasan($arg2);
			$this->d->jaminan = $this->mtpb_jaminan->getJaminan($arg2);
		} else if($this->d->_action == 'approval1'){
			$this->db->trans_start();
			$this->tpb_approval->approval1($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Doc In berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Doc In gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'approval2'){
			$this->db->trans_start();
			$this->tpb_approval->approval2($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Doc In berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Doc In gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'disapprove'){
			$this->db->trans_start();
			$this->tpb_approval->disapprove($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Disapprove data Doc In berhasil';
			} else {
				$s->status = false;
				$s->message = 'Disapprove data Doc In gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'cancel'){
			$this->db->trans_start();
			$this->tpb_approval->cancel($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Cancel data Doc In berhasil';
			} else {
				$s->status = false;
				$s->message = 'Cancel data Doc In gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'closing'){
			$this->db->trans_start();
			$this->tpb_approval->closing($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Closing data Doc In berhasil';
			} else {
				$s->status = false;
				$s->message = 'Closing data Doc In gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		}

		$this->load->view('template_view', $this->d);
	}
	function dua_tujuh_in($arg1="", $arg2="")
	{
		modelLoad($this,array('mtpbdb_header'));
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;
		modelLoad($this,array('mtpb_approval','mtpb_jaminan'));
		if($this->d->_action == 'view'){
			modelLoad($this,array('mreferensi_dokumen_pabean'));
			$this->d->sdokumen_pabean = $this->mreferensi_dokumen_pabean->viewPosting(1);
		
		} else if($this->d->_action == 'edit'){

		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$res = $this->mtpbdb_header->viewDTDocIn($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewReferensiBarang261'){
			$res = $this->mtpb_header->viewReferensiBarang261($this->in);
			printJSON($res);
		} else if($this->d->_action == 'view261'){
			$res = $this->mtpb_header->view261($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewjaminan'){
			$res = $this->mtpb_jaminan->viewjaminan($this->in,$arg2);
			printJSON($res);
		}  else if($this->d->_action == 'viewDetailDNDocIn'){
			modelLoad($this,array('mt_detail_dn'));
			$res = $this->mt_detail_dn->viewDetailDNDocIn($this->in);
			printJSON($res);
		} else if($this->d->_action == 'detail'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen','mtpb_kontainer'));
			$this->d->tpbHeader = $this->mtpb_header->getHeader($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->kontainer = $this->mtpb_kontainer->getKontainer($arg2);
		} else if($this->d->_action == 'detail_23'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen','mtpb_kontainer'));
			$this->d->tpbHeader = $this->mtpb_header->getHeader($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->kontainer = $this->mtpb_kontainer->getKontainer($arg2);
		} else if($this->d->_action == 'detail_262'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen'));
			$this->d->tpbHeader = $this->mtpb_header->get($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
		} else if($this->d->_action == 'detail_27IN'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen'));
			$this->d->tpbHeader = $this->mtpb_header->get($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
		} else if($this->d->_action == 'detail_40'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen'));
			$this->d->tpbHeader = $this->mtpb_header->get($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
		} else if($this->d->_action == 'edit_23'){
			modelLoad($this,array('mtpb_header','mreferensi_jenis_tpb','mreferensi_tujuan_tpb','mtpb_dokumen','mtpb_kontainer','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer'));
			$this->d->sjenis_tpb = $this->mreferensi_jenis_tpb->view();
			$this->d->stujuan_tpb = $this->mreferensi_tujuan_tpb->view();
			$this->d->stipe_kontainer = $this->mreferensi_tipe_kontainer->view();
			$this->d->sukuran_kontainer = $this->mreferensi_ukuran_kontainer->view();

			$this->d->tpbheader = $this->mtpb_header->get($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
			$this->d->tpbkontainer = $this->mtpb_kontainer->getByIDHeader($arg2);
		}
		else if($this->d->_action == 'edit_262'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen'));
			$this->d->tpbHeader = $this->mtpb_header->get($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
		}
		else if($this->d->_action == 'edit_40'){
			modelLoad($this,array('mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen'));
			$this->d->tpbHeader = $this->mtpb_header->get($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
		}
		else if($this->d->_action == 'approval1'){
			$this->db->trans_start();
			$this->tpb_approval->approval1($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Doc In berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Doc In gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'approval2'){
			$this->db->trans_start();
			$this->tpb_approval->approval2($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Doc In berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Doc In gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'disapprove'){
			$this->db->trans_start();
			$this->tpb_approval->disapprove($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Disapprove data Doc In berhasil';
			} else {
				$s->status = false;
				$s->message = 'Disapprove data Doc In gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'cancel'){
			$this->db->trans_start();
			$this->tpb_approval->cancel($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Cancel data Doc In berhasil';
			} else {
				$s->status = false;
				$s->message = 'Cancel data Doc In gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'closing'){
			$this->db->trans_start();
			$this->tpb_approval->closing($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Closing data Doc In berhasil';
			} else {
				$s->status = false;
				$s->message = 'Closing data Doc In gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		}

		$this->load->view('template_view', $this->d);
	}

	function processdocinbc23($in, $no_aju){
		$seri_dokumen=0;
		$seri_barang=0;
		$jumlahbarang = 0;
		$d = 1;
		$netto=0;
		$kemasan=0;
		$kode_kemasan='';
		$harga_invoice=0;
		// THIS LOGIC IS TO GET DISTINCT DATA DOKUMEN TPB
		$tpb_barang = new StdClass();
		$tpb_barang = a2o($in->tpb_barang);
		// printJSON($tpb_barang);
		$tpb_barang = a2o($in->tpb_barang);	
		foreach ($tpb_barang as $row){	
			$row = a2o($row);	
			$tpb_dokumen[$d] = $row->dokumen_po;	
			$d++;	
			$tpb_dokumen[$d] = $row->dokumen_dn;	
			$d++;	
			$netto += floatval($row->NETTO);	
			$harga_invoice += floatval($row->HARGA_INVOICE);	
			$jumlahbarang++;	
		}	


		$x = 1;
		foreach ($tpb_dokumen as $row){
			$row = a2o($row);
			if (empty($tpb_dokumen_filter)) {
				$tpb_dokumen_filter[$x] = $row;
				$x++;
			}
			else if (filterObject($tpb_dokumen_filter,$row,'NOMOR_DOKUMEN')) {
				$tpb_dokumen_filter[$x] = $row;
				$x++;
			}
		}
		// END
		if(isset($in->dokumen_tambahan)) $tpb_dokumen_tambahan = a2o($in->dokumen_tambahan);
		$tpb_kemasan = a2o($in->tpb_kemasan);
		foreach ($tpb_kemasan as $r){
			$r = a2o($r);
			$kemasan += floatval($r->JUMLAH_KEMASAN);
		}

		//CREATE TPB HEADER GET ID
		$tpb_header = a2o($in->tpb_header);
		$tpb_header->JUMLAH_BARANG = $jumlahbarang;
		$tpb_header->JUMLAH_KEMASAN = $kemasan;
		$tpb_header->HARGA_INVOICE = $harga_invoice;
		$id_supplier = $in->id_supplier;
		$supplier = $this->mm_supplier->get($id_supplier);
		$tpb_header->ALAMAT_PEMASOK = $supplier->alamat;
		$tpb_header->ID_PENGIRIM = $supplier->npwp;
		$tpb_header->NAMA_PEMASOK = $supplier->nama;
		$tpb_header->NAMA_PENGIRIM = $supplier->nama;
		$tpb_header->KODE_NEGARA_PEMASOK = $supplier->kode_negara;
		$tpb_header->KODE_HARGA = 'CIF';
		if ($tpb_header->KODE_KANTOR_BONGKAR!=""){
			$get_tps = $this->mreferensi_tps->getByCode($tpb_header->KODE_KANTOR_BONGKAR);
			$tpb_header->KODE_TPS = $get_tps->KODE_TPS;
		}

		$app = getAppSetting($this);
		$tpb_header->ALAMAT_PENGUSAHA = $app->alamat;
		$tpb_header->ALAMAT_PEMILIK = $app->alamat;
		$tpb_header->ID_PENGUSAHA = $app->NPWP;
		$tpb_header->ID_PEMILIK = $app->NPWP;
		$tpb_header->API_PEMILIK = $app->API_PENGUSAHA;
		$tpb_header->API_PENGUSAHA = $app->API_PENGUSAHA;
		$tpb_header->JABATAN_TTD = $app->JABATAN;
		$tpb_header->KODE_ID_PEMASOK = $app->KODE_ID_PENGIRIM;
		$tpb_header->KODE_ID_PENGUSAHA = $app->KODE_ID_PENGUSAHA;
		$tpb_header->KODE_ID_PEMILIK = $app->KODE_ID_PENGUSAHA;
		$tpb_header->KODE_JENIS_API_PEMILIK = $app->KODE_JENIS_API_PEMILIK;
		$tpb_header->KODE_JENIS_API_PENGUSAHA = $app->KODE_JENIS_API_PENGUSAHA;
	
		$tpb_header->KOTA_TTD = $app->KOTA_TTD;
		$tpb_header->NAMA_TTD = $app->NAMA_TTD;
		$tpb_header->NOMOR_IJIN_TPB = $app->NOMOR_SKEP;
		$tpb_header->SERI = $app->SERI;
		$tpb_header->VERSI_MODUL = $app->VERSI_MODUL;
		$tpb_header->ID_MODUL = $app->ID_MODUL;
		$tpb_header->ASAL_DATA = $app->ASAL_DATA;
		$tpb_header->KODE_STATUS = '01';
		$tpb_header->NAMA_PENGUSAHA = $app->nama_sbu;
		$tpb_header->NAMA_PEMILIK = $app->nama_sbu;
		$tpb_header->KODE_KANTOR = $app->KPPBC;
		$tpb_header->NOMOR_AJU = $no_aju;
		$tpb_header->NETTO = $netto;
		$tpb_header->TANGGAL_AJU = reverseDate($tpb_header->TANGGAL_AJU);
		$tgl = $tpb_header->TANGGAL_AJU;
		$tpb_header->TANGGAL_BC11 = reverseDate($tpb_header->TANGGAL_BC11);

		unset($tpb_header->HARGA_PENYERAHAN,$tpb_header->NAMA_PENGANGKUTAN,$tpb_header->TANGGAL_DAFTAR,$tpb_header->NOMOR_DAFTAR);
		$id_header = $this->mtpb_header->create($tpb_header);

		$detail_status = new stdClass();
		$detail_status->KODE_STATUS = '01';
		$detail_status->WAKTU_STATUS = $tgl;
		$detail_status->ID_HEADER = $id_header;
		$this->mtpb_detil_status->create($detail_status);

		$approval = new stdClass();
		$approval->ID_HEADER = $id_header;
		$this->mtpb_approval->create($approval);
		$k_kemasan= '';
		$tpb_kemasan = a2o($in->tpb_kemasan);
		foreach ($tpb_kemasan as $r){
			$r = a2o($r);
			$r->ID_HEADER = $id_header;
			$k_kemasan = $r->KODE_JENIS_KEMASAN;
			$this->mtpb_kemasan->create($r);
		}


		//CREATE TPB DOCUMENT
		$tpb_dokumen_filter = a2o($tpb_dokumen_filter);
		$tpb_dokumen = a2o($in->tpb_dokumen);
		$drd = 0;
		foreach ($tpb_dokumen as $row){
			$drd++;
			$row = a2o($row);
			$row->TANGGAL_DOKUMEN = reverseDate($row->TANGGAL_DOKUMEN);
			$dokumen_reverseDate[$drd] = $row;
		}
		$tpb_dokumen_filter = (object) (array_merge((array) $tpb_dokumen_filter,(array) $dokumen_reverseDate ));
		foreach ($tpb_dokumen_filter as $row){
			if (!empty($row->NOMOR_DOKUMEN)){
				$seri_dokumen++;
				$row = a2o($row);
				$row->SERI_DOKUMEN = $seri_dokumen;
				$row->ID_HEADER = $id_header;

				/** Hack Remove SERI_BARANG */
				unset($row->SERI_BARANG);
				/** End of Hack */
				$this->mtpb_dokumen->create($row);
			}
		}

		foreach ($tpb_barang as $tb){
			$seri_barang++;
			$tb = a2o($tb);
			$po = a2o($tb->dokumen_po);
			$dn = a2o($tb->dokumen_dn);
			$kode_barang = $tb->KODE_BARANG;
			unset($tb->dokumen_po);
			unset($tb->dokumen_dn);
			$barang_tarif = a2o($tb->TARIF);
			$id_detail_dn = $tb->id_detail_dn;
			$getdn = $this->mt_detail_dn->get($id_detail_dn);
			$this->mt_dn->setFlagDocIn($getdn->id_dn,$id_header);
			unset($tb->TARIF,$tb->id_detail_dn);
			$tb->ID_HEADER = $id_header;
			$tb->SERI_BARANG = $seri_barang;
			$tb->KODE_KEMASAN = $k_kemasan;
			//INPUT TBP BARANG GET ID
			$id_barang = $this->mtpb_barang->create($tb);

			$po->ID_HEADER = $id_header;
			$po->KODE_BARANG = $kode_barang;
			//INPUT TPB DOKUMEN DETAIL
			$this->mtpb_dokumen_detail->create($po);

			$dn->ID_HEADER = $id_header;
			$dn->KODE_BARANG = $kode_barang;
			//INPUT TPB DOKUMEN DETAIL
			$this->mtpb_dokumen_detail->create($dn);

			foreach ($barang_tarif as $bt){
				$bt = a2o($bt);
				if ($bt->NILAI_FASILITAS!='' || $bt->NILAI_FASILITAS!=null || $bt->NILAI_FASILITAS>0){
					$bt->ID_BARANG = $id_barang;
					$bt->ID_HEADER = $id_header;
					$bt->SERI_BARANG = $seri_barang;
					$this->mtpb_barang_tarif->create($bt);
				}
			}

			if(isset($in->dokumen_tambahan)){
                foreach ($tpb_dokumen_tambahan as $row) {
                    $seri_dokumen++;
                    $row = a2o($row);
                    $get = $this->mreferensi_dokumen->getByCode($row->KODE_JENIS_DOKUMEN);
                    $row->TIPE_DOKUMEN = $get->TIPE_DOKUMEN;
                    $row->TANGGAL_DOKUMEN = reverseDate($row->TANGGAL_DOKUMEN);
                    $row->SERI_DOKUMEN = $seri_dokumen;
                    $row->ID_HEADER = $id_header;
                    $this->mtpb_dokumen->create($row);

                    $bd = new stdClass();
                    $bd->SERI_DOKUMEN = $seri_dokumen;
                    $bd->ID_BARANG = $id_barang;
                    $bd->ID_HEADER = $id_header;
                    $this->mtpb_barang_dokumen->create($bd);
                }
            }
		}

		$tpb_pungutan = a2o($in->tpb_pungutan);
		foreach ($tpb_pungutan as $row){
			$row = a2o($row);
			if ($row->NILAI_PUNGUTAN!=0){
				$row->ID_HEADER = $id_header;
				$this->mtpb_pungutan->create($row);
			}
		}

		$tpb_kontainer = a2o($in->tpb_kontainer);
		$tpb_kontainer->ID_HEADER = $id_header;
		$this->mtpb_kontainer->create($tpb_kontainer);
	}

	function processdocinbc262($in, $no_aju){
		$seri_dokumen=0;
		$seri_barang=0;
		$jumlahbarang=0;
		$d = 1;
		$netto=0;
		$kemasan=0;
		$harga=0;
		$kode_kemasan='';

		// printJSON($in);
		// THIS LOGIC IS TO GET DISTINCT DATA DOKUMEN TPB
		
		$tpb_barang = a2o($in->tpb_barang);
		if(empty($tpb_barang)){
			echo "null";
		}else{
			foreach ($tpb_barang as $row){
				$row = a2o($row);
				$tpb_dokumen[$d] = $row->dokumen_po;
				$d++;
				$tpb_dokumen[$d] = $row->dokumen_dn;
				$d++;
				$netto += floatval($row->NETTO);
				$harga += floatval($row->HARGA_INVOICE);
				$jumlahbarang++;
			}
		}

		$x = 1;
		foreach ($tpb_dokumen as $row){
			$row = a2o($row);
			if (empty($tpb_dokumen_filter)) {
				$tpb_dokumen_filter[$x] = $row;
				$x++;
			}
			else if (filterObject($tpb_dokumen_filter,$row,'NOMOR_DOKUMEN')) {
				$tpb_dokumen_filter[$x] = $row;
				$x++;
			}
		}

		// END
		if(isset($in->dokumen_tambahan)) $tpb_dokumen_tambahan = a2o($in->dokumen_tambahan);

		$tpb_kemasan = a2o($in->tpb_kemasan);
		foreach ($tpb_kemasan as $r){
			$r = a2o($r);
			$kemasan += floatval($r->JUMLAH_KEMASAN);
		}

		$tpb_header = a2o($in->tpb_header);
		$tpb_header->JUMLAH_BARANG = $jumlahbarang;
		$tpb_header->JUMLAH_KEMASAN = $kemasan;
		$tpb_header->CIF = $harga;
		$id_supplier = $in->id_supplier;
		$supplier = $this->mm_supplier->get($id_supplier);
		$tpb_header->ALAMAT_PENGIRIM = $supplier->alamat;
		$tpb_header->ID_PENGIRIM = $supplier->npwp;
		$tpb_header->NAMA_PENGIRIM = $supplier->nama;
		$tpb_header->KODE_NEGARA_PEMASOK = $supplier->kode_negara;
		$app = getAppSetting($this);
		$tpb_header->ALAMAT_PENGUSAHA = $app->alamat;
		$tpb_header->ID_PENGUSAHA = $app->NPWP;
		$tpb_header->JABATAN_TTD = $app->JABATAN;
		$tpb_header->KODE_ID_PENGIRIM = $app->KODE_ID_PENGIRIM;
		$tpb_header->KODE_ID_PENGUSAHA = $app->KODE_ID_PENGUSAHA;
		$tpb_header->KOTA_TTD = $app->KOTA_TTD;
		$tpb_header->NAMA_TTD = $app->NAMA_TTD;
		$tpb_header->NOMOR_IJIN_TPB = $app->NOMOR_SKEP;
		$tpb_header->SERI = $app->SERI;
		$tpb_header->VERSI_MODUL = $app->VERSI_MODUL;
		$tpb_header->ID_MODUL = $app->ID_MODUL;
		$tpb_header->ASAL_DATA = $app->ASAL_DATA;
		$tpb_header->KODE_STATUS = '01';
		$tpb_header->NAMA_PENGUSAHA = $app->nama_sbu;
		$tpb_header->KODE_KANTOR = $app->KPPBC;
		$tpb_header->NOMOR_AJU = $no_aju;
		$tpb_header->KODE_HARGA = 'CIF';
		$tpb_header->TANGGAL_AJU = reverseDate($tpb_header->TANGGAL_AJU);
		$tgl = $tpb_header->TANGGAL_AJU;
		$tpb_header->NAMA_PENGANGKUT ;
		 unset ($tpb_header->NAMA_PENGANGKUTAN);
		// unset($tpb_header->NAMA_PENGANGKUTAN,$tpb_header->TANGGAL_DAFTAR,$tpb_header->NOMOR_DAFTAR,$tpb_header->NOMOR_BC11,$tpb_header->TANGGAL_BC11,$tpb_header->POS_BC11,$tpb_header->SUBPOS_BC11,$tpb_header->SUBSUBPOS_BC11,$tpb_header->NDPBM,$tpb_header->FREIGHT,$tpb_header->KODE_VALUTA,$tpb_header->FOB,$tpb_header->ASURANSI,$tpb_header->CIF,$tpb_header->CIF_RUPIAH,$tpb_header->NOMOR_VOY_FLIGHT,$tpb_header->KODE_NEGARA_PEMASOK,$tpb_header->KODE_PEL_MUAT,$tpb_header->KODE_PEL_TRANSIT,$tpb_header->KODE_KANTOR_BONGKAR,$tpb_header->KODE_PEL_BONGKAR,$tpb_header->TOTAL_TANGGUH,$tpb_header->TOTAL_BEBAS,$tpb_header->TOTAL_TIDAK_DIPUNGUT);
		$id_header = $this->mtpb_header->create($tpb_header);
		$approval = new stdClass();
		$approval->ID_HEADER = $id_header;
		$this->mtpb_approval->create($approval);

		$tpb_kemasan = a2o($in->tpb_kemasan);
		foreach ($tpb_kemasan as $r){
			$r = a2o($r);
			$r->ID_HEADER = $id_header;
			$this->mtpb_kemasan->create($r);
		}

		$detail_status = new stdClass();
		$detail_status->KODE_STATUS = '01';
		$detail_status->WAKTU_STATUS = $tgl;
		$detail_status->ID_HEADER = $id_header;
		$this->mtpb_detil_status->create($detail_status);

		$row = a2o($in->tpb_jaminan);
		$row = a2o($row);
		$row->TANGGAL_JAMINAN = reverseDate($row->TANGGAL_JAMINAN);
		$row->TANGGAL_JATUH_TEMPO = reverseDate($row->TANGGAL_JATUH_TEMPO);
		$row->TANGGAL_BPJ = reverseDate($row->TANGGAL_BPJ);
		$row->ID_HEADER = $id_header;
		$this->mtpb_jaminan->create($row);

		//CREATE TPB DOCUMENT
		$tpb_dokumen_filter = a2o($tpb_dokumen_filter);
		$tpb_dokumen = a2o($in->tpb_dokumen);
		$tpb_dokumen_filter = (object) (array_merge((array) $tpb_dokumen_filter,(array) $tpb_dokumen ));
		foreach ($tpb_dokumen_filter as $row){
			if (!empty($row->NOMOR_DOKUMEN)){
				$seri_dokumen++;
				$row = a2o($row);
				$row->SERI_DOKUMEN = $seri_dokumen;
				$row->ID_HEADER = $id_header;

				/** Hack Remove SERI_BARANG */
				unset($row->SERI_BARANG);
				/** End of Hack */
				$this->mtpb_dokumen->create($row);
			}
		}

		foreach ($tpb_barang as $tb){
			$seri_barang++;
			$tb = a2o($tb);
			$po = a2o($tb->dokumen_po);
			$dn = a2o($tb->dokumen_dn);
			$kode_barang = $tb->KODE_BARANG;
			unset($tb->dokumen_po);
			unset($tb->dokumen_dn);
			$barang_tarif = a2o($tb->TARIF);
			$id_detail_dn = $tb->id_detail_dn;
			$getdn = $this->mt_detail_dn->get($id_detail_dn);
			$this->mt_dn->setFlagDocIn($getdn->id_dn,$id_header);
			unset($tb->TARIF, $tb->FOB, $tb->HARGA_INVOICE, $tb->id_detail_dn);
			$tb->ID_HEADER = $id_header;
			$tb->SERI_BARANG = $seri_barang;
			//INPUT TBP BARANG GET ID
			$id_barang = $this->mtpb_barang->create($tb);

			$po->ID_HEADER = $id_header;
			$po->KODE_BARANG = $kode_barang;
			//INPUT TPB DOKUMEN DETAIL
			$this->mtpb_dokumen_detail->create($po);

			$dn->ID_HEADER = $id_header;
			$dn->KODE_BARANG = $kode_barang;
			//INPUT TPB DOKUMEN DETAIL
			$this->mtpb_dokumen_detail->create($dn);

			foreach ($barang_tarif as $bt){
				$bt = a2o($bt);
				if ($bt->NILAI_FASILITAS!=''){
					$bt->ID_BARANG = $id_barang;
					$bt->ID_HEADER = $id_header;
					$bt->SERI_BARANG = $seri_barang;
					$this->mtpb_barang_tarif->create($bt);
				}
			}

			if(isset($in->dokumen_tambahan)){
				foreach ($tpb_dokumen_tambahan as $row) {
					$seri_dokumen++;
					$row = a2o($row);
					$get = $this->mreferensi_dokumen->getByCode($row->KODE_JENIS_DOKUMEN);
					$row->TIPE_DOKUMEN = $get->TIPE_DOKUMEN;
					$row->TANGGAL_DOKUMEN = reverseDate($row->TANGGAL_DOKUMEN);
					$row->SERI_DOKUMEN = $seri_dokumen;
					$row->ID_HEADER = $id_header;
					$this->mtpb_dokumen->create($row);

					$bd = new stdClass();
					$bd->SERI_DOKUMEN = $seri_dokumen;
					$bd->ID_BARANG = $id_barang;
					$bd->ID_HEADER = $id_header;
					$this->mtpb_barang_dokumen->create($bd);
				}
			}
		}
	}

	function processdocinbc40($in, $no_aju){
		$seri_dokumen=0;
		$seri_barang=0;
		$jumlahbarang=0;
		$d = 1;
		$netto=0;
		$kemasan=0;
		$harga=0;
		$kode_kemasan='';
		// THIS LOGIC IS TO GET DISTINCT DATA DOKUMEN TPB
		$tpb_barang = a2o($in->tpb_barang);
		foreach ($tpb_barang as $row){
			$row = a2o($row);
			$tpb_dokumen[$d] = $row->dokumen_po;
			$d++;
			$tpb_dokumen[$d] = $row->dokumen_dn;
			$d++;
			$netto += floatval($row->NETTO);
			$harga += floatval($row->HARGA_PENYERAHAN);
			$jumlahbarang++;
		}

		$x = 1;
		foreach ($tpb_dokumen as $row){
			$row = a2o($row);
			if (empty($tpb_dokumen_filter)) {
				$tpb_dokumen_filter[$x] = $row;
				$x++;
			}
			else if (filterObject($tpb_dokumen_filter,$row,'NOMOR_DOKUMEN')) {
				$tpb_dokumen_filter[$x] = $row;
				$x++;
			}
		}

		// END
		if(isset($in->dokumen_tambahan)) $tpb_dokumen_tambahan = a2o($in->dokumen_tambahan);

		$tpb_kemasan = a2o($in->tpb_kemasan);
		foreach ($tpb_kemasan as $r){
			$r = a2o($r);
			$kemasan += floatval($r->JUMLAH_KEMASAN);
			// $this->mtpb_kemasan->create($r);

		}

		$tpb_header = a2o($in->tpb_header);
		$tpb_header->JUMLAH_BARANG = $jumlahbarang;
		$tpb_header->JUMLAH_KEMASAN = $kemasan;
		$tpb_header->HARGA_PENYERAHAN = $harga;
		$id_supplier = $in->id_supplier;
		// print_r($id_supplier);
		$supplier = $this->mm_supplier->get($id_supplier);
		
		$tpb_header->ALAMAT_PENGIRIM = $supplier->alamat;
		$tpb_header->ID_PENGIRIM = $supplier->npwp;
		$tpb_header->NAMA_PENGIRIM = $supplier->nama;
		$tpb_header->NAMA_PEMASOK = $supplier->nama;

		$tpb_header->KODE_NEGARA_PEMASOK = $supplier->kode_negara;
		$app = getAppSetting($this);
		$tpb_header->ALAMAT_PENGUSAHA = $app->alamat;
		$tpb_header->ID_PENGUSAHA = $app->NPWP;
		$tpb_header->JABATAN_TTD = $app->JABATAN;
		$tpb_header->KODE_ID_PENGIRIM = $app->KODE_ID_PENGIRIM;
		$tpb_header->KODE_ID_PENGUSAHA = $app->KODE_ID_PENGUSAHA;
		$tpb_header->KOTA_TTD = $app->KOTA_TTD;
		$tpb_header->NAMA_TTD = $app->NAMA_TTD;
		$tpb_header->NOMOR_IJIN_TPB = $app->NOMOR_SKEP;
		$tpb_header->SERI = $app->SERI;
		$tpb_header->VERSI_MODUL = $app->VERSI_MODUL;
		$tpb_header->ID_MODUL = $app->ID_MODUL;
		$tpb_header->ASAL_DATA = $app->ASAL_DATA;
		$tpb_header->KODE_STATUS = '01';
		$tpb_header->NAMA_PENGUSAHA = $app->nama_sbu;
		$tpb_header->KODE_KANTOR = $app->KPPBC;
		$tpb_header->NOMOR_AJU = $no_aju;
		$tpb_header->NETTO = $netto;
		$tpb_header->TANGGAL_AJU = reverseDate($tpb_header->TANGGAL_AJU);
		$tgl = $tpb_header->TANGGAL_AJU;
		$tpb_header->NAMA_PENGANGKUT = $tpb_header->NAMA_PENGANGKUTAN;

		unset($tpb_header->NAMA_PENGANGKUTAN,$tpb_header->TANGGAL_DAFTAR,$tpb_header->NOMOR_DAFTAR,$tpb_header->NOMOR_BC11,$tpb_header->TANGGAL_BC11,$tpb_header->POS_BC11,$tpb_header->SUBPOS_BC11,$tpb_header->SUBSUBPOS_BC11,$tpb_header->NDPBM,$tpb_header->FREIGHT,$tpb_header->KODE_VALUTA,$tpb_header->FOB,$tpb_header->ASURANSI,$tpb_header->CIF,$tpb_header->CIF_RUPIAH,$tpb_header->NOMOR_VOY_FLIGHT,$tpb_header->KODE_NEGARA_PEMASOK,$tpb_header->KODE_PEL_MUAT,$tpb_header->KODE_PEL_TRANSIT,$tpb_header->KODE_KANTOR_BONGKAR,$tpb_header->KODE_PEL_BONGKAR,$tpb_header->TOTAL_TANGGUH,$tpb_header->TOTAL_BEBAS,$tpb_header->TOTAL_TIDAK_DIPUNGUT);
		$id_header = $this->mtpb_header->create($tpb_header);
		$approval = new stdClass();
		$approval->ID_HEADER = $id_header;
		$this->mtpb_approval->create($approval);

		$k_kemasan = '' ;
		$tpb_kemasan = a2o($in->tpb_kemasan);
		foreach ($tpb_kemasan as $r){
			$r = a2o($r);
			$r->ID_HEADER = $id_header;
			$k_kemasan = $r->KODE_JENIS_KEMASAN;
			$this->mtpb_kemasan->create($r);
		}

		$detail_status = new stdClass();
		$detail_status->KODE_STATUS = '01';
		$detail_status->WAKTU_STATUS = $tgl;
		$detail_status->ID_HEADER = $id_header;
		$this->mtpb_detil_status->create($detail_status);

		//CREATE TPB DOCUMENT
		$tpb_dokumen_filter = a2o($tpb_dokumen_filter);
		$tpb_dokumen = a2o($in->tpb_dokumen);
		$drd = 0;	
		foreach ($tpb_dokumen as $row){	
			$drd++;	
			$row = a2o($row);	
			$row->TANGGAL_DOKUMEN = reverseDate($row->TANGGAL_DOKUMEN);	
			$dokumen_reverseDate[$drd] = $row;	
		}	
		$tpb_dokumen_filter = (object) (array_merge((array) $tpb_dokumen_filter,(array) $dokumen_reverseDate ));
		foreach ($tpb_dokumen_filter as $row){
			if (!empty($row->NOMOR_DOKUMEN)){
				$seri_dokumen++;
				$row = a2o($row);
				$row->SERI_DOKUMEN = $seri_dokumen;
				$row->ID_HEADER = $id_header;

				/** Hack Remove SERI_BARANG */
				unset($row->SERI_BARANG);
				/** End of Hack */
				$this->mtpb_dokumen->create($row);
			}
		}

		foreach ($tpb_barang as $tb){
			$seri_barang++;	
			$tb = a2o($tb);
			$po = a2o($tb->dokumen_po);
			$dn = a2o($tb->dokumen_dn);
			$kode_barang = $tb->KODE_BARANG;
			unset($tb->dokumen_po);
			unset($tb->dokumen_dn);
			$barang_tarif = a2o($tb->TARIF);
			$id_detail_dn = $tb->id_detail_dn;
			$getdn = $this->mt_detail_dn->get($id_detail_dn);
			$this->mt_dn->setFlagDocIn($getdn->id_dn,$id_header);
			unset($tb->TARIF, $tb->CIF, $tb->CIF_RUPIAH, $tb->FOB, $tb->HARGA_INVOICE,$tb->id_detail_dn);
			$tb->ID_HEADER = $id_header;
			$tb->SERI_BARANG = $seri_barang;
			$tb->KODE_KEMASAN = $k_kemasan;
			//INPUT TBP BARANG GET ID
			$id_barang = $this->mtpb_barang->create($tb);

			$po->ID_HEADER = $id_header;
			$po->KODE_BARANG = $kode_barang;
			//INPUT TPB DOKUMEN DETAIL
			$this->mtpb_dokumen_detail->create($po);

			$dn->ID_HEADER = $id_header;
			$dn->KODE_BARANG = $kode_barang;
			//INPUT TPB DOKUMEN DETAIL
			$this->mtpb_dokumen_detail->create($dn);

			foreach ($barang_tarif as $bt){
				$bt = a2o($bt);
				if ($bt->NILAI_FASILITAS!=''){
					$bt->ID_BARANG = $id_barang;
					$bt->ID_HEADER = $id_header;
					$bt->SERI_BARANG = $seri_barang;
					$this->mtpb_barang_tarif->create($bt);
				}
			}

			if(isset($in->dokumen_tambahan)){
				foreach ($tpb_dokumen_tambahan as $row) {
					$seri_dokumen++;
					$row = a2o($row);
					$get = $this->mreferensi_dokumen->getByCode($row->KODE_JENIS_DOKUMEN);
					$row->TIPE_DOKUMEN = $get->TIPE_DOKUMEN;
					$row->TANGGAL_DOKUMEN = reverseDate($row->TANGGAL_DOKUMEN);
					$row->SERI_DOKUMEN = $seri_dokumen;
					$row->ID_HEADER = $id_header;
					$this->mtpb_dokumen->create($row);

					$bd = new stdClass();
					$bd->SERI_DOKUMEN = $seri_dokumen;
					$bd->ID_BARANG = $id_barang;
					$bd->ID_HEADER = $id_header;
					$this->mtpb_barang_dokumen->create($bd);
				}
			}
		}
	}

	function processdocinbc27($in, $no_aju){
		$seri_dokumen=0;
		$seri_barang=0;
		$jumlahbarang=0;
		$d = 1;
		$netto=0;
		$kemasan=0;
		$harga=0;
		$kode_kemasan='';
		// THIS LOGIC IS TO GET DISTINCT DATA DOKUMEN TPB
		$tpb_barang = a2o($in->tpb_barang);
		foreach ($tpb_barang as $row){
			$row = a2o($row);
			$tpb_dokumen[$d] = $row->dokumen_po;
			$d++;
			$tpb_dokumen[$d] = $row->dokumen_dn;
			$d++;
			$netto += floatval($row->NETTO);
			$harga += floatval($row->HARGA_PENYERAHAN);
			$jumlahbarang++;
		}

		$x = 1;
		foreach ($tpb_dokumen as $row){
			$row = a2o($row);
			if (empty($tpb_dokumen_filter)) {
				$tpb_dokumen_filter[$x] = $row;
				$x++;
			}
			else if (filterObject($tpb_dokumen_filter,$row,'NOMOR_DOKUMEN')) {
				$tpb_dokumen_filter[$x] = $row;
				$x++;
			}
		}

		// END
		if(isset($in->dokumen_tambahan)) $tpb_dokumen_tambahan = a2o($in->dokumen_tambahan);

		$tpb_kemasan = a2o($in->tpb_kemasan);
		foreach ($tpb_kemasan as $r){
			$r = a2o($r);
			$kemasan += floatval($r->JUMLAH_KEMASAN);
		}

		$tpb_header = a2o($in->tpb_header);
		$tpb_header->JUMLAH_BARANG = $jumlahbarang;
		$tpb_header->JUMLAH_KEMASAN = $kemasan;
		$tpb_header->HARGA_PENYERAHAN = $harga;
		$id_supplier = $in->id_supplier;
		$supplier = $this->mm_supplier->get($id_supplier);
		// printJSON($supplier);
		$tpb_header->ALAMAT_PENGIRIM = $supplier->alamat;
		$tpb_header->ID_PENGIRIM = $supplier->npwp;
		$tpb_header->NAMA_PENGIRIM = $supplier->nama;
		$tpb_header->KODE_NEGARA_PEMASOK = $supplier->kode_negara;
		$app = getAppSetting($this);
		$tpb_header->ALAMAT_PENGUSAHA = $app->alamat;
		$tpb_header->ID_PENGUSAHA = $app->NPWP;
		$tpb_header->JABATAN_TTD = $app->JABATAN;
		$tpb_header->KODE_ID_PENGIRIM = $app->KODE_ID_PENGIRIM;
		$tpb_header->KODE_ID_PENGUSAHA = $app->KODE_ID_PENGUSAHA;
		$tpb_header->KOTA_TTD = $app->KOTA_TTD;
		$tpb_header->NAMA_TTD = $app->NAMA_TTD;
		$tpb_header->NOMOR_IJIN_TPB = $app->NOMOR_SKEP;
		$tpb_header->SERI = $app->SERI;
		$tpb_header->VERSI_MODUL = $app->VERSI_MODUL;
		$tpb_header->ID_MODUL = $app->ID_MODUL;
		$tpb_header->ASAL_DATA = $app->ASAL_DATA;
		$tpb_header->KODE_STATUS = '01';
		$tpb_header->KODE_KANTOR = $app->KPPBC;
		$tpb_header->NAMA_PENGUSAHA = $app->nama_sbu;
		$tpb_header->TANGGAL_AJU = reverseDate($tpb_header->TANGGAL_AJU);
		$tpb_header->TANGGAL_DAFTAR = reverseDate($tpb_header->TANGGAL_DAFTAR);
		$tgl = $tpb_header->TANGGAL_AJU;
		unset($tpb_header->NOMOR_BC11,$tpb_header->TANGGAL_BC11,$tpb_header->POS_BC11,$tpb_header->SUBPOS_BC11,$tpb_header->SUBSUBPOS_BC11,$tpb_header->NDPBM,$tpb_header->FREIGHT,$tpb_header->KODE_VALUTA,$tpb_header->FOB,$tpb_header->ASURANSI,$tpb_header->CIF,$tpb_header->CIF_RUPIAH,$tpb_header->NOMOR_VOY_FLIGHT,$tpb_header->KODE_NEGARA_PEMASOK,$tpb_header->KODE_PEL_MUAT,$tpb_header->KODE_PEL_TRANSIT,$tpb_header->KODE_KANTOR_BONGKAR,$tpb_header->KODE_PEL_BONGKAR,$tpb_header->TOTAL_TANGGUH,$tpb_header->TOTAL_BEBAS,$tpb_header->TOTAL_TIDAK_DIPUNGUT);
		$id_header = $this->mtpb_header->create($tpb_header);
		$approval = new stdClass();
		$approval->ID_HEADER = $id_header;
		$this->mtpb_approval->create($approval);

		$tpb_kemasan = a2o($in->tpb_kemasan);
		foreach ($tpb_kemasan as $r){
			$r = a2o($r);
			$r->ID_HEADER = $id_header;
			$this->mtpb_kemasan->create($r);
		}

		$detail_status = new stdClass();
		$detail_status->KODE_STATUS = '01';
		$detail_status->WAKTU_STATUS = $tgl;
		$detail_status->ID_HEADER = $id_header;
		$this->mtpb_detil_status->create($detail_status);

		//CREATE TPB DOCUMENT
		$tpb_dokumen_filter = a2o($tpb_dokumen_filter);
		$tpb_dokumen = a2o($in->tpb_dokumen);
		$tpb_dokumen_filter = (object) (array_merge((array) $tpb_dokumen_filter,(array) $tpb_dokumen ));
		foreach ($tpb_dokumen_filter as $row){
			if (!empty($row->NOMOR_DOKUMEN)){
				$seri_dokumen++;
				$row = a2o($row);
				$row->SERI_DOKUMEN = $seri_dokumen;
				$row->ID_HEADER = $id_header;

				/** Hack Remove SERI_BARANG */
				unset($row->SERI_BARANG);
				/** End of Hack */
				$this->mtpb_dokumen->create($row);
			}
		}

		foreach ($tpb_barang as $tb){
			$tb = a2o($tb);
			$po = a2o($tb->dokumen_po);
			$dn = a2o($tb->dokumen_dn);
			$kode_barang = $tb->KODE_BARANG;
			unset($tb->dokumen_po);
			unset($tb->dokumen_dn);
			$barang_tarif = a2o($tb->TARIF);
			$id_detail_dn = $tb->id_detail_dn;
			$getdn = $this->mt_detail_dn->get($id_detail_dn);
			$this->mt_dn->setFlagDocIn($getdn->id_dn,$id_header);
			unset($tb->TARIF, $tb->CIF, $tb->CIF_RUPIAH, $tb->FOB, $tb->HARGA_INVOICE,$tb->id_detail_dn);
			$tb->ID_HEADER = $id_header;
			$tb->SERI_BARANG = $seri_barang;
			//INPUT TBP BARANG GET ID
			$id_barang = $this->mtpb_barang->create($tb);

			$po->ID_HEADER = $id_header;
			$po->KODE_BARANG = $kode_barang;
			//INPUT TPB DOKUMEN DETAIL
			$this->mtpb_dokumen_detail->create($po);

			$dn->ID_HEADER = $id_header;
			$dn->KODE_BARANG = $kode_barang;
			//INPUT TPB DOKUMEN DETAIL
			$this->mtpb_dokumen_detail->create($dn);

			foreach ($barang_tarif as $bt){
				$bt = a2o($bt);
				if ($bt->NILAI_FASILITAS!=''){
					$bt->ID_BARANG = $id_barang;
					$bt->ID_HEADER = $id_header;
					$bt->SERI_BARANG = $seri_barang;
					$this->mtpb_barang_tarif->create($bt);
				}
			}

			if(isset($in->dokumen_tambahan)){
				foreach ($tpb_dokumen_tambahan as $row) {
					$seri_dokumen++;
					$row = a2o($row);
					$get = $this->mreferensi_dokumen->getByCode($row->KODE_JENIS_DOKUMEN);
					$row->TIPE_DOKUMEN = $get->TIPE_DOKUMEN;
					$row->TANGGAL_DOKUMEN = reverseDate($row->TANGGAL_DOKUMEN);
					$row->SERI_DOKUMEN = $seri_dokumen;
					$row->ID_HEADER = $id_header;
					$this->mtpb_dokumen->create($row);

					$bd = new stdClass();
					$bd->SERI_DOKUMEN = $seri_dokumen;
					$bd->ID_BARANG = $id_barang;
					$bd->ID_HEADER = $id_header;
					$this->mtpb_barang_dokumen->create($bd);
				}
			}
		}
	}

	function transaksi_doc_out($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,array('mtpb_header','mreferensi_jenis_tpb','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_asuransi','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mreferensi_cara_bayar','mm_customer','mreferensi_lokasi_bayar','mreferensi_kategori_barangbc25','mreferensi_kode_guna','mreferensi_kondisi_barang','mreferensi_tujuan_tpb','mreferensi_jenis_jaminan','mtpb_pungutan','mtpb_approval'));
		if($this->d->_action == 'view'){
			modelLoad($this,array('mreferensi_dokumen_pabean','mm_customer_suplier'));
			$this->d->scustomer = $this->mm_customer_suplier->view();

			$this->d->sdokumen_pabean = $this->mreferensi_dokumen_pabean->viewPosting(0);
		} else if($this->d->_action == 'add'){
		
			$this->d->_modal = array('referensi_valuta','t_detail_dn_exim_in','referensi_pemasok','add_tarif','referensi_pelabuhan','referensi_pelabuhan_muat','referensi_pelabuhan_muat_eksport','referensi_pelabuhan_transit','referensi_pelabuhan_bongkar','referensi_negara','t_invoice_doc_out','referensi_kemasan','m_customer','m_supplier_docout');
			$app = getAppSetting($this);
			$this->d->app = $app;
			$this->d->sjenis_tpb = $this->mreferensi_jenis_tpb->view();
			$this->d->stujuan_pengiriman = $this->mreferensi_tujuan_pengiriman->view();
			$this->d->scara_angkut = $this->mreferensi_cara_angkut->view();
			$this->d->scara_bayar = $this->mreferensi_cara_bayar->view();
			$this->d->sasuransi = $this->mreferensi_asuransi->view();
			$this->d->sdokumen_pabean = $this->mreferensi_dokumen_pabean->viewPosting(0);
			$this->d->stipe_kontainer = $this->mreferensi_tipe_kontainer->view();
			$this->d->sukuran_kontainer = $this->mreferensi_ukuran_kontainer->view();
			$this->d->sskema_tarif = $this->mreferensi_skema_tarif->view();
			$this->d->sdokumen = $this->mreferensi_dokumen->view();
			$this->d->skode_kemasan = $this->mreferensi_kemasan->view();
			$this->d->slokasi_bayar = $this->mreferensi_lokasi_bayar->view();
			$this->d->skategori_barang = $this->mreferensi_kategori_barangbc25->view();
			$this->d->sguna = $this->mreferensi_kode_guna->view();
			$this->d->skondisi = $this->mreferensi_kondisi_barang->view();
			$this->d->stujuan_tpb = $this->mreferensi_tujuan_tpb->view();
			$this->d->sjenis_jaminan = $this->mreferensi_jenis_jaminan->view();
		} else if($this->d->_action == 'add_30'){
			modelLoad($this,array('mpeb_tbltabel','mreferensi_dokumen'));
			$this->d->_modal = array('mpeb_tblpelln','referensi_valuta','mpeb_tblbank','mpeb_tblkpbc','referensi_pemasok','mpeb_tblnegara','mpeb_tblkapal','mpeb_tblpeldn','mpeb_tbldaerah','t_invoice_doc_out','referensi_kemasan','mpeb_jenisekspor', 'mpeb_kategoriekspor');
			$app = getAppSetting($this);
			$this->d->app = $app;
			$this->d->jenisEkspor = $this->mpeb_tbltabel->viewJenisEkspor();
			$this->d->kategoriEkspor = $this->mpeb_tbltabel->viewKategoriEkspor();
			$this->d->caraDagang = $this->mpeb_tbltabel->viewCaraDagang();
			$this->d->caraBayar = $this->mpeb_tbltabel->viewCaraBayar();
			$this->d->caraAngkut = $this->mpeb_tbltabel->viewCaraAngkut();
			$this->d->caraPenyerahan = $this->mpeb_tbltabel->viewCaraPenyerahan();
			$this->d->idPPJK = $this->mpeb_tbltabel->viewPPJK();
			$this->d->sdokumen = $this->mreferensi_dokumen->view();
		} else if($this->d->_action == 'store_30'){
			// modelLoad($this,array('mpeb_tblpebdok','mpeb_tblpebdtl','mpeb_tblkpbc','mpeb_tblpebhdr'));
			$this->db->trans_start();
			// $car = $this->mpeb_tblpebhdr->generateCode($this->in->peb_header['CAR']);
			// $jenis_doc = $this->in->peb_detail['KODE_DOKUMEN_PABEAN'];
			// getAppSetting($this);
			$this->processdocoutbc30($this->in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data Doc In berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data Doc In gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/view_30');
		} else if($this->d->_action == 'store'){
			modelLoad($this,array('mreferensi_dokumen','mtpb_header','mtpb_barang','mtpb_barang_tarif','mtpb_kontainer','mtpb_dokumen','mtpb_dokumen_detail','mtpb_barang_dokumen','mtpb_jaminan','mtpb_kemasan','mtpb_approval','mm_supplier','mm_customer_suplier'));
			$this->db->trans_start();
			$no_aju = $this->mtpb_header->generateCode($this->in->tpb_header['KODE_DOKUMEN_PABEAN'],$this->in->tpb_header['TANGGAL_AJU']);
			$jenis_doc = $this->in->tpb_header['KODE_DOKUMEN_PABEAN'];
			getAppSetting($this);

			if ($jenis_doc==25){
				$this->processdocoutbc25($this->in, $no_aju);
			} else if ($jenis_doc==27){
				$this->processdocoutbc27($this->in, $no_aju);
			} else if ($jenis_doc==261){
				$this->processdocoutbc261($this->in, $no_aju);
			} else if ($jenis_doc==41){
				$this->processdocoutbc41($this->in, $no_aju);
			}

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data Doc In berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data Doc In gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'edit'){
			modelLoad($this,array('mreferensi_jenis_tpb','mtpb_barang','mtpb_bahan_baku','mtpb_bahan_baku_tarif','mtpb_kemasan','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen','mtpb_kontainer','mtpb_barang_tarif'));
			// $this->d->_modal = array('m_dokumen','m_kontainer','m_jaminan');
			$this->d->tpbHeader = $this->mtpb_header->getHeader($arg2);
			$this->d->tpbBb = $this->mtpb_bahan_baku->getBahanbaku($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->kontainer = $this->mtpb_kontainer->getKontainer($arg2);
			$this->d->kemasan = $this->mtpb_kemasan->getKemasan($arg2);
			$this->d->barang = $this->mtpb_barang->getBarang($arg2);
			$this->d->barangtarif = $this->mtpb_barang_tarif->getBarang($arg2);
			$this->d->bahantarif = $this->mtpb_bahan_baku_tarif->getBahantarif($arg2);

		}else if($this->d->_action == 'edit_25'){
			printJSON('sa');
			
		} else if($this->d->_action == 'update'){

		} else if($this->d->_action == 'detail'){
			modelLoad($this,array('mreferensi_jenis_tpb','mtpb_barang','mtpb_bahan_baku','mtpb_bahan_baku_tarif','mtpb_kemasan','mreferensi_tujuan_pengiriman','mreferensi_cara_angkut','mreferensi_dokumen_pabean','mreferensi_jenis_jaminan','mreferensi_tipe_kontainer','mreferensi_ukuran_kontainer','mreferensi_skema_tarif','mreferensi_dokumen','mreferensi_kemasan','mtpb_approval','mtpb_dokumen','mtpb_kontainer','mtpb_barang_tarif'));
			$this->d->_modal = array('m_dokumen','m_kontainer','m_kemasan','m_jaminan', 'm_barangdt40');
			$this->d->tpbHeader = $this->mtpb_header->getHeader($arg2);
			$this->d->tpbBb = $this->mtpb_bahan_baku->getBahanbaku($arg2);
			$this->d->dokumen = $this->d->tpbHeader->KODE_DOKUMEN_PABEAN;
			$this->d->status = $this->mtpb_approval->getByHeader($arg2);
			$this->d->docinv = $this->mtpb_dokumen->getInvoice($arg2);
			$this->d->docbl = $this->mtpb_dokumen->getBL($arg2);
			$this->d->doclc = $this->mtpb_dokumen->getLC($arg2);
			$this->d->doclain = $this->mtpb_dokumen->getDokumenLainnya($arg2);
			$this->d->kontainer = $this->mtpb_kontainer->getKontainer($arg2);
			$this->d->kemasan = $this->mtpb_kemasan->getKemasan($arg2);
			$this->d->barang = $this->mtpb_barang->getBarang($arg2);
			$this->d->barangtarif = $this->mtpb_barang_tarif->getBarang($arg2);
			$this->d->bahantarif = $this->mtpb_bahan_baku_tarif->getBahantarif($arg2);


		} else if($this->d->_action == 'detail_30'){
			modelLoad($this,array('mpeb_tblpebhdr','mpeb_approval','mpeb_tblpebdtl','mpeb_tblpebdok','mpeb_tblpebkms'));
			// $this->d->_modal = array('m_detail_barang_30');
			$this->d->_modal = array('m_barangdt40');
			$this->d->tblpebhdr = $this->mpeb_tblpebhdr->get($arg2);
			$this->d->pebdetail = a2o($this->mpeb_tblpebdtl->viewByCAR($arg2));
			$this->d->pebdok = a2o($this->mpeb_tblpebdok->viewByCAR($arg2));
			$this->d->pebkms = a2o($this->mpeb_tblpebkms->viewByCAR($arg2));
			$this->d->status = $this->mpeb_approval->getByHeader($arg2);
		} else if($this->d->_action == 'viewBahanBakuDT'){
			modelLoad($this,array('mt_invoice'));
			$res = $this->mtpb_header->viewBahanBakuDT($this->in, $arg2);
			printJSON($res);
		} else if($this->d->_action == 'viewdt'){
			$res = $this->mtpb_header->viewDTDocOut($this->in);
			printJSON($res);
		} else if($this->d->_action == 'view30'){
			modelLoad($this,array('mpeb_tblpebhdr'));
			$res = $this->mpeb_tblpebhdr->viewDT($this->in);
			printJSON($res);

		}else if($this->d->_action == 'viewDetailBarang'){
			modelLoad($this,array('mtpb_barang'));
			$data = $this->input->post();
			$query['tampil'] = $this->mtpb_barang->getDetailBarangg($data["id_header"],$this->in);
			printJSON($query);
		}else if($this->d->_action == 'viewDetailLokalBarang'){
			modelLoad($this,array('mtpb_barang'));
			$data = $this->input->post();
			$query = $this->mtpb_barang->getBarangDT25($data["id_header"],$this->in);
			printJSON($query);
		}else if($this->d->_action == 'viewDetailImportBarang'){
			modelLoad($this,array('mtpb_barang'));
			$data = $this->input->post();
			$query = $this->mtpb_barang->getBarangDT23($data["id_header"],$this->in);
			printJSON($query);

		} else if($this->d->_action == 'viewkpbc'){
			modelLoad($this,array('mpeb_tblkpbc'));
			$res = $this->mpeb_tblkpbc->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewpeldn'){
			modelLoad($this,array('mpeb_tblpeldn'));
			$res = $this->mpeb_tblpeldn->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewnegara'){
			modelLoad($this,array('mpeb_tblnegara'));
			$res = $this->mpeb_tblnegara->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewdaerah'){
			modelLoad($this,array('mpeb_tbldaerah'));
			$res = $this->mpeb_tbldaerah->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewkapal'){
			modelLoad($this,array('mpeb_tblkapal'));
			$res = $this->mpeb_tblkapal->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewbank'){
			modelLoad($this,array('mpeb_tblbank'));
			$res = $this->mpeb_tblbank->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewpelln'){
			modelLoad($this,array('mpeb_tblpelln'));
			$res = $this->mpeb_tblpelln->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewjenisekspor'){
			modelLoad($this,array('mpeb_tbltabel'));
			$res = $this->mpeb_tbltabel->viewJenisEkspor($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewkategoriekspor'){
			modelLoad($this,array('mpeb_tbltabel'));
			$res = $this->mpeb_tbltabel->viewKategoriEkspor($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewvaluta'){
			modelLoad($this,array('mpeb_tblvaluta'));
			$res = $this->mpeb_tblvaluta->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewHistoryDocument'){
			modelLoad($this,array('vhistory_dokumen'));
			$res = $this->vhistory_dokumen->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewInvoiceDocOut'){
			modelLoad($this,array('mt_invoice'));
			$res = $this->mt_invoice->viewInvoiceDocOut($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewBahanBakuDT'){
			modelLoad($this,array('mt_invoice'));
			$res = $this->mtpb_header->viewBahanBakuDT($this->in, $arg2);
			printJSON($res);
		}

		$this->load->view('template_view', $this->d);
	}

	function processdocoutbc25($in, $no_aju){
		$seri_dokumen = $seri_barang = $netto = $bruto = $kemasan = $harga = $cif = $cif_rupiah = $barang = 0;
		$d = 1;
		// THIS LOGIC IS TO GET DISTINCT DATA DOKUMEN TPB
		$tpb_barang = a2o($in->tpb_barang);
		foreach ($tpb_barang as $row){
			$row = a2o($row);
			$tpb_dokumen[$d] = $row->dokumen_inv;
			$d++;
			$tpb_dokumen[$d] = $row->dokumen_stuffing;
			$d++;
			$netto += floatval($row->NETTO);
			$bruto += floatval($row->BRUTO);
			$harga += floatval($row->HARGA_PENYERAHAN);
			$cif += floatval($row->CIF);
			$cif_rupiah += floatval($row->CIF_RUPIAH);
			$barang++;
		}

		$x = 1;
		foreach ($tpb_dokumen as $row){
			$row = a2o($row);
			if (empty($tpb_dokumen_filter)) {
				$tpb_dokumen_filter[$x] = $row;
				$x++;
			}
			else if (filterObject($tpb_dokumen_filter,$row,'NOMOR_DOKUMEN')) {
				$tpb_dokumen_filter[$x] = $row;
				$x++;
			}
		}
		// END

		$tpb_kemasan = a2o($in->tpb_kemasan);
		foreach ($tpb_kemasan as $r){
			$r = a2o($r);
			$kemasan += floatval($r->JUMLAH_KEMASAN);
		}

		$tpb_header = a2o($in->tpb_header);
		$id_supplier = $in->id_supplier;
		// printJSON($in);
		$supplier = $this->mm_customer_suplier->get($id_supplier);
		$tpb_header->ALAMAT_PENERIMA_BARANG = $supplier->alamat;
		$tpb_header->ALAMAT_PENGIRIM = $supplier->alamat;
		$tpb_header->ID_PENGIRIM = $supplier->npwp;
		$tpb_header->NAMA_PENGIRIM = $supplier->nama;
		$tpb_header->KODE_NEGARA_PEMASOK = $supplier->kode_negara;
		$tpb_header->ALAMAT_PENERIMA_BARANG = $supplier->alamat;
		$app = getAppSetting($this);
		$tpb_header->ALAMAT_PENGUSAHA = $app->alamat;
		$tpb_header->NAMA_PENGUSAHA = $app->nama_sbu;
		$tpb_header->ALAMAT_PEMILIK = $app->alamat;
		$tpb_header->API_PEMILIK = $app->API_PENGUSAHA;
		$tpb_header->API_PENGUSAHA = $app->API_PENGUSAHA;
		$tpb_header->ASAL_DATA = $app->ASAL_DATA;
		$tpb_header->ID_MODUL = $app->ID_MODUL;
		$tpb_header->ID_PEMILIK = $app->NPWP;
		$tpb_header->ID_PENGUSAHA = $app->NPWP;
		$tpb_header->ID_PENERIMA_BARANG = $supplier->npwp;
		$tpb_header->JABATAN_TTD = $app->JABATAN;
		$tpb_header->NAMA_PEMILIK = $app->nama_sbu;
		$tpb_header->NAMA_PENERIMA_BARANG = $supplier->nama;
		$tpb_header->KODE_ID_PEMILIK = $app->KODE_ID_PEMILIK;
		$tpb_header->KODE_ID_PENERIMA_BARANG = $app->KODE_ID_PENERIMA_BARANG;
		$tpb_header->KODE_ID_PENGUSAHA = $app->KODE_ID_PENGUSAHA;
		$tpb_header->KODE_JENIS_API_PEMILIK = $app->KODE_JENIS_API_PEMILIK;
		$tpb_header->KODE_JENIS_API_PENGUSAHA = $app->KODE_JENIS_API_PENGUSAHA;
		$tpb_header->KOTA_TTD = $app->KOTA_TTD;
		$tpb_header->NAMA_TTD = $app->NAMA_TTD;
		$tpb_header->NOMOR_IJIN_TPB = $app->NOMOR_SKEP;
		$tpb_header->VERSI_MODUL = $app->VERSI_MODUL;
		$tpb_header->KODE_STATUS = '01';
		$tpb_header->TANGGAL_AJU = reverseDate($tpb_header->TANGGAL_AJU);
		$tpb_header->JUMLAH_BARANG = $barang;
		$tpb_header->JUMLAH_KEMASAN = $kemasan;
		$tpb_header->NOMOR_AJU = $no_aju;
		$tpb_header->NETTO = $netto;
		$tpb_header->BRUTO = $bruto;
		$tpb_header->CIF = $cif;
		$tpb_header->CIF_RUPIAH = $cif_rupiah;
		$tpb_header->HARGA_PENYERAHAN = $harga;
		$tpb_header->KODE_KANTOR = $app->KPPBC;
		unset($tpb_header->NOMOR_BC11,$tpb_header->TANGGAL_BC11,$tpb_header->POS_BC11,$tpb_header->SUBPOS_BC11,$tpb_header->SUBSUBPOS_BC11,$tpb_header->KODE_NEGARA_PEMASOK,$tpb_header->KODE_PEL_MUAT,$tpb_header->KODE_PEL_TRANSIT,$tpb_header->KODE_KANTOR_BONGKAR,$tpb_header->KODE_PEL_BONGKAR);

		$tpb_header = sortObject($tpb_header);
		unset($tpb_header->KODE_PEL_MUAT_EKSPORT);
		$id_header = $this->mtpb_header->create($tpb_header);

		$tpb_kemasan = a2o($in->tpb_kemasan);
		foreach ($tpb_kemasan as $r){
			$r = a2o($r);
			$r->ID_HEADER = $id_header;
			$this->mtpb_kemasan->create($r);
		}

		$approval = new stdClass();
		$approval->ID_HEADER = $id_header;
		$this->mtpb_approval->create($approval);

		$d = 1;
		$x = 1;

		$tpb_dokumen_filter = a2o($tpb_dokumen_filter);
		$tpb_dokumen = a2o($in->tpb_dokumen);
		$tpb_dokumen_filter = (object) (array_merge((array) $tpb_dokumen_filter,(array) $tpb_dokumen ));
		foreach ($tpb_dokumen_filter as $row){
			$row = a2o($row);
			if ($row->NOMOR_DOKUMEN!='' || $row->NOMOR_DOKUMEN!= null){
				$seri_dokumen++;
				$row = a2o($row);
				$row->SERI_DOKUMEN = $seri_dokumen;
				$row->ID_HEADER = $id_header;
				$row = sortObject($row);
				$this->mtpb_dokumen->create($row);
			}
		}

		$tpb_barang = a2o($in->tpb_barang);
		foreach ($tpb_barang as $tb){
			$seri_barang++;
			$seri_dokumen++;
			$tb = a2o($tb);
			$inv = a2o($tb->dokumen_inv);
			$stuffing = a2o($tb->dokumen_stuffing);
			$kode_barang = $tb->KODE_BARANG;
			unset($tb->dokumen_inv);
			unset($tb->dokumen_stuffing);
			$barang_tarif = a2o($tb->TARIF);
			unset($tb->TARIF);
			$tb->ID_HEADER = $id_header;
			$tb->SERI_BARANG = $seri_barang;
			$tb->KODE_NEGARA_ASAL = $app->KODE_NEGARA;
			$tb->KODE_STATUS = '01';

			unset($tb->BRUTO,$tb->HARGA_INVOICE,$tb->HARGA_SATUAN);
			$tb = sortObject($tb);
			$id_barang = $this->mtpb_barang->create($tb);

			$inv->ID_HEADER = $id_header;
			$inv->KODE_BARANG = $kode_barang;
			$inv->SERI_DOKUMEN = $seri_dokumen;
			$inv->TANGGAL_DOKUMEN = reverseDate($inv->TANGGAL_DOKUMEN);
			$this->mtpb_dokumen_detail->create($inv);

			$seri_dokumen++;
			$stuffing->ID_HEADER = $id_header;
			$stuffing->KODE_BARANG = $kode_barang;
			$stuffing->SERI_DOKUMEN = $seri_dokumen;
			$stuffing->TANGGAL_DOKUMEN = reverseDate($stuffing->TANGGAL_DOKUMEN);
			$this->mtpb_dokumen_detail->create($stuffing);

			foreach ($barang_tarif as $bt){
				$bt = a2o($bt);
				if ($bt->NILAI_FASILITAS!=''){
					if ($bt->NILAI_FASILITAS!='' || $bt->NILAI_FASILITAS!=null || $bt->NILAI_FASILITAS>0){
						$bt->ID_BARANG = $id_barang;
						$bt->ID_HEADER = $id_header;
						$bt->SERI_BARANG = $seri_barang;
						$bt->NILAI_BAYAR = $bt->NILAI_FASILITAS;
						$bt->NILAI_FASILITAS = '0.00';
						$bt = sortObject($bt);
						$this->mtpb_barang_tarif->create($bt);
					}
				}
			}

			foreach ($barang_tarif as $bt){
				$bt = a2o($bt);
				if ($bt->NILAI_FASILITAS!=''){
					if ($bt->NILAI_FASILITAS!='' || $bt->NILAI_FASILITAS!=null || $bt->NILAI_FASILITAS>0){
						$bt->ID_BARANG = $id_barang;
						$bt->ID_HEADER = $id_header;
						$bt->SERI_BARANG = $seri_barang;
						$bt->NILAI_BAYAR = $bt->NILAI_FASILITAS;
						$bt->NILAI_FASILITAS = '0.00';
						$bt = sortObject($bt);
						$this->mtpb_barang_tarif->create($bt);
					}
				}
			}

			if(isset($in->dokumen_tambahan)) {
				$tpb_dokumen_tambahan = a2o($in->dokumen_tambahan);
				foreach ($tpb_dokumen_tambahan as $row) {
					$seri_dokumen++;
					$row = a2o($row);
					$get = $this->mreferensi_dokumen->getByCode($row->KODE_JENIS_DOKUMEN);
					$row->TIPE_DOKUMEN = $get->TIPE_DOKUMEN;
					$row->TANGGAL_DOKUMEN = reverseDate($row->TANGGAL_DOKUMEN);
					$row->SERI_DOKUMEN = $seri_dokumen;
					$row->ID_HEADER = $id_header;
					$this->mtpb_dokumen->create($row);

					$bd = new stdClass();
					$bd->SERI_DOKUMEN = $seri_dokumen;
					$bd->ID_BARANG = $id_barang;
					$bd->ID_HEADER = $id_header;
					$this->mtpb_barang_dokumen->create($bd);
				}
			}
		}
		$tpb_pungutan = a2o($in->tpb_pungutan);
		foreach ($tpb_pungutan as $row){
			$row = a2o($row);
			if ($row->NILAI_PUNGUTAN!=0){
				$row->ID_HEADER = $id_header;
				$this->mtpb_pungutan->create($row);
			}
		}
	}

	function processdocoutbc27($in, $no_aju){
		$seri_dokumen = $seri_barang = $netto = $bruto = $kemasan = $harga = $cif = $cif_rupiah = $barang = 0;
		$d = 1;
		// THIS LOGIC IS TO GET DISTINCT DATA DOKUMEN TPB
		$tpb_barang = a2o($in->tpb_barang);
		foreach ($tpb_barang as $row){
			$row = a2o($row);
			$tpb_dokumen[$d] = $row->dokumen_inv;
			$d++;
			$tpb_dokumen[$d] = $row->dokumen_stuffing;
			$d++;
			$netto += floatval($row->NETTO);
			$bruto += floatval($row->BRUTO);
			$harga += floatval($row->HARGA_PENYERAHAN);
			$cif += floatval($row->CIF);
			$cif_rupiah += floatval($row->CIF_RUPIAH);
			$barang++;
		}

		$x = 1;
		foreach ($tpb_dokumen as $row){
			$row = a2o($row);
			if (empty($tpb_dokumen_filter)) {
				$tpb_dokumen_filter[$x] = $row;
				$x++;
			}
			else if (filterObject($tpb_dokumen_filter,$row,'NOMOR_DOKUMEN')) {
				$tpb_dokumen_filter[$x] = $row;
				$x++;
			}
		}

		// END

		$tpb_kemasan = a2o($in->tpb_kemasan);
		foreach ($tpb_kemasan as $r){
			$r = a2o($r);
			$kemasan += floatval($r->JUMLAH_KEMASAN);
		}

		$tpb_header = a2o($in->tpb_header);
		$id_customer = $in->id_supplier;
		$supplier = $this->mm_customer_suplier->get($id_customer);
		$tpb_header->ALAMAT_PENERIMA_BARANG = $supplier->alamat;
		$tpb_header->ALAMAT_PENGIRIM = $supplier->alamat;
		$tpb_header->ID_PENGIRIM = $supplier->npwp;
		$tpb_header->NAMA_PENGIRIM = $supplier->nama;
		$tpb_header->KODE_NEGARA_PEMASOK = $supplier->kode_negara;
		$app = getAppSetting($this);
		$tpb_header->ALAMAT_PENGUSAHA = $app->alamat;
		$tpb_header->NAMA_PENGUSAHA = $app->nama_sbu;
		$tpb_header->ASAL_DATA = $app->ASAL_DATA;
		$tpb_header->ID_MODUL = $app->ID_MODUL;
		$tpb_header->ID_PENGUSAHA = $app->NPWP;
		$tpb_header->ID_PENERIMA_BARANG = $supplier->npwp;
		$tpb_header->JABATAN_TTD = $app->JABATAN;
		$tpb_header->NAMA_PENERIMA_BARANG = $supplier->nama;
		$tpb_header->KODE_ID_PENERIMA_BARANG = $app->KODE_ID_PENERIMA_BARANG;
		$tpb_header->KODE_ID_PENGUSAHA = $app->KODE_ID_PENGUSAHA;
		$tpb_header->KOTA_TTD = $app->KOTA_TTD;
		$tpb_header->NAMA_TTD = $app->NAMA_TTD;
		$tpb_header->NOMOR_IJIN_TPB = $app->NOMOR_SKEP;
		$tpb_header->VERSI_MODUL = $app->VERSI_MODUL;
		$tpb_header->KODE_STATUS = '01';
		$tpb_header->TANGGAL_AJU = reverseDate($tpb_header->TANGGAL_AJU);
		$tpb_header->JUMLAH_BARANG = $barang;
		$tpb_header->JUMLAH_KEMASAN = $kemasan;
		$tpb_header->NOMOR_AJU = $no_aju;
		$tpb_header->NETTO = $netto;
		$tpb_header->BRUTO = $bruto;
		$tpb_header->CIF = $cif;
		$tpb_header->CIF_RUPIAH = $cif_rupiah;
		$tpb_header->HARGA_PENYERAHAN = $harga;
		$tpb_header->KODE_KANTOR = $app->KPPBC;
		$tpb_header->NAMA_PENGANGKUT = $tpb_header->NAMA_PENGANGKUT;
		unset($tpb_header->NOMOR_BC11,$tpb_header->TANGGAL_BC11,$tpb_header->POS_BC11,$tpb_header->SUBPOS_BC11,$tpb_header->SUBSUBPOS_BC11,$tpb_header->KODE_NEGARA_PEMASOK,$tpb_header->KODE_PEL_MUAT,$tpb_header->KODE_PEL_TRANSIT,$tpb_header->KODE_KANTOR_BONGKAR,$tpb_header->KODE_PEL_BONGKAR,$tpb_header->NAMA_PENGANGKUT,$tpb_header->NAMA_PENGANGKUT);

		$tpb_header = sortObject($tpb_header);
		unset($tpb_header->KODE_PEL_MUAT_EKSPORT);
		$id_header = $this->mtpb_header->create($tpb_header);

		$tpb_kemasan = a2o($in->tpb_kemasan);
		foreach ($tpb_kemasan as $r){
			$r = a2o($r);
			$r->ID_HEADER = $id_header;
			$this->mtpb_kemasan->create($r);
		}

		$approval = new stdClass();
		$approval->ID_HEADER = $id_header;
		$this->mtpb_approval->create($approval);

		$d = 1;
		$x = 1;

		$tpb_dokumen_filter = a2o($tpb_dokumen_filter);
		$tpb_dokumen = a2o($in->tpb_dokumen);
		$tpb_dokumen_filter = (object) (array_merge((array) $tpb_dokumen_filter,(array) $tpb_dokumen ));
		foreach ($tpb_dokumen_filter as $row){
			$row = a2o($row);
			if ($row->NOMOR_DOKUMEN!='' || $row->NOMOR_DOKUMEN!= null){
				$seri_dokumen++;
				$row = a2o($row);
				$row->SERI_DOKUMEN = $seri_dokumen;
				$row->ID_HEADER = $id_header;
				$row = sortObject($row);
				$this->mtpb_dokumen->create($row);
			}
		}

		$tpb_barang = a2o($in->tpb_barang);
		foreach ($tpb_barang as $tb){
			$seri_barang++;
			$seri_dokumen++;
			$tb = a2o($tb);
			$inv = a2o($tb->dokumen_inv);
			$stuffing = a2o($tb->dokumen_stuffing);
			$kode_barang = $tb->KODE_BARANG;
			unset($tb->dokumen_inv);
			unset($tb->dokumen_stuffing);
			$barang_tarif = a2o($tb->TARIF);
			unset($tb->TARIF);
			$tb->ID_HEADER = $id_header;
			$tb->SERI_BARANG = $seri_barang;
			$tb->KODE_STATUS = '01';

			unset($tb->BRUTO,$tb->HARGA_INVOICE,$tb->HARGA_SATUAN);
			$tb = sortObject($tb);
			$id_barang = $this->mtpb_barang->create($tb);

			$inv->ID_HEADER = $id_header;
			$inv->KODE_BARANG = $kode_barang;
			$inv->SERI_DOKUMEN = $seri_dokumen;
			$inv->TANGGAL_DOKUMEN = reverseDate($inv->TANGGAL_DOKUMEN);
			$this->mtpb_dokumen_detail->create($inv);

			$seri_dokumen++;
			$stuffing->ID_HEADER = $id_header;
			$stuffing->KODE_BARANG = $kode_barang;
			$stuffing->SERI_DOKUMEN = $seri_dokumen;
			$stuffing->TANGGAL_DOKUMEN = reverseDate($stuffing->TANGGAL_DOKUMEN);
			$this->mtpb_dokumen_detail->create($stuffing);

			if(isset($in->dokumen_tambahan)) {
				$tpb_dokumen_tambahan = a2o($in->dokumen_tambahan);
				foreach ($tpb_dokumen_tambahan as $row) {
					$seri_dokumen++;
					$row = a2o($row);
					$get = $this->mreferensi_dokumen->getByCode($row->KODE_JENIS_DOKUMEN);
					$row->TIPE_DOKUMEN = $get->TIPE_DOKUMEN;
					$row->TANGGAL_DOKUMEN = reverseDate($row->TANGGAL_DOKUMEN);
					$row->SERI_DOKUMEN = $seri_dokumen;
					$row->ID_HEADER = $id_header;
					$this->mtpb_dokumen->create($row);
				}
			}
		}
	}

	function processdocoutbc261($in, $no_aju){
		$seri_dokumen = $seri_barang = $netto = $bruto = $kemasan = $harga = $cif = $cif_rupiah = $barang = $jaminan = 0;
		$d = 1;
		// THIS LOGIC IS TO GET DISTINCT DATA DOKUMEN TPB
		$tpb_barang = a2o($in->tpb_barang);
		foreach ($tpb_barang as $row){
			$row = a2o($row);
			$tpb_dokumen[$d] = $row->dokumen_inv;
			$d++;
			$tpb_dokumen[$d] = $row->dokumen_stuffing;
			$d++;
			$netto += floatval($row->NETTO);
			$bruto += floatval($row->BRUTO);
			$harga += floatval($row->HARGA_PENYERAHAN);
			$cif += floatval($row->CIF);
			$cif_rupiah += floatval($row->CIF_RUPIAH);
			$barang++;
		}

		$x = 1;
		foreach ($tpb_dokumen as $row){
			$row = a2o($row);
			if (empty($tpb_dokumen_filter)) {
				$tpb_dokumen_filter[$x] = $row;
				$x++;
			}
			else if (filterObject($tpb_dokumen_filter,$row,'NOMOR_DOKUMEN')) {
				$tpb_dokumen_filter[$x] = $row;
				$x++;
			}
		}
		// END

		$tpb_kemasan = a2o($in->tpb_kemasan);
		foreach ($tpb_kemasan as $r){
			$r = a2o($r);
			$kemasan += floatval($r->JUMLAH_KEMASAN);
		}

		$tpb_jaminan = a2o($in->tpb_jaminan);
		$jaminan += floatval($tpb_jaminan->NILAI_JAMINAN);


		$tpb_header = a2o($in->tpb_header);
		$id_customer = $in->id_supplier;
		$supplier = $this->mm_customer_suplier->get($id_customer);
		$tpb_header->ALAMAT_PENERIMA_BARANG = $supplier->alamat;
		$tpb_header->ALAMAT_PENGIRIM = $supplier->alamat;
		$tpb_header->ID_PENGIRIM = $supplier->npwp;
		$tpb_header->NAMA_PENGIRIM = $supplier->nama;
		$tpb_header->KODE_NEGARA_PEMASOK = $supplier->kode_negara;
		$app = getAppSetting($this);
		$tpb_header->ALAMAT_PENGUSAHA = $app->alamat;
		$tpb_header->NAMA_PENGUSAHA = $app->nama_sbu;
		$tpb_header->ASAL_DATA = $app->ASAL_DATA;
		$tpb_header->ID_MODUL = $app->ID_MODUL;
		$tpb_header->ID_PENGUSAHA = $app->NPWP;
		$tpb_header->API_PENGUSAHA = $app->API_PENGUSAHA;
		$tpb_header->KODE_JENIS_API_PENGUSAHA = $app->KODE_JENIS_API_PENGUSAHA;
		$tpb_header->ID_PENERIMA_BARANG = $supplier->npwp;
		$tpb_header->JABATAN_TTD = $app->JABATAN;
		$tpb_header->NAMA_PENERIMA_BARANG = $supplier->nama;
		$tpb_header->KODE_ID_PENERIMA_BARANG = $app->KODE_ID_PENERIMA_BARANG;
		$tpb_header->KODE_ID_PENGUSAHA = $app->KODE_ID_PENGUSAHA;
		$tpb_header->KOTA_TTD = $app->KOTA_TTD;
		$tpb_header->NAMA_TTD = $app->NAMA_TTD;
		$tpb_header->NOMOR_IJIN_TPB = $app->NOMOR_SKEP;
		$tpb_header->VERSI_MODUL = $app->VERSI_MODUL;
		$tpb_header->KODE_STATUS = '01';
		$tpb_header->TANGGAL_AJU = reverseDate($tpb_header->TANGGAL_AJU);
		$tpb_header->JUMLAH_BARANG = $barang;
		$tpb_header->JUMLAH_KEMASAN = $kemasan;
		$tpb_header->NOMOR_AJU = $no_aju;
		$tpb_header->NETTO = $netto;
		$tpb_header->BRUTO = $bruto;
		$tpb_header->CIF = $cif;
		$tpb_header->CIF_RUPIAH = $cif_rupiah;
		$tpb_header->HARGA_PENYERAHAN = $harga;
		$tpb_header->KODE_KANTOR = $app->KPPBC;
		$tpb_header->NAMA_PENGANGKUT = $tpb_header->NAMA_PENGANGKUT;
		unset($tpb_header->NOMOR_BC11,$tpb_header->TANGGAL_BC11,$tpb_header->POS_BC11,$tpb_header->SUBPOS_BC11,$tpb_header->SUBSUBPOS_BC11,$tpb_header->KODE_NEGARA_PEMASOK,$tpb_header->KODE_PEL_MUAT,$tpb_header->KODE_PEL_TRANSIT,$tpb_header->KODE_KANTOR_BONGKAR,$tpb_header->KODE_PEL_BONGKAR,$tpb_header->NAMA_PENGANGKUT,$tpb_header->NAMA_PENGANGKUT,$tpb_header->NAMA_PENGANGKUT);

		$tpb_header = sortObject($tpb_header);
		unset($tpb_header->KODE_PEL_MUAT_EKSPORT);
		$id_header = $this->mtpb_header->create($tpb_header);

		$tpb_kemasan = a2o($in->tpb_kemasan);
		foreach ($tpb_kemasan as $r){
			$r = a2o($r);
			$r->ID_HEADER = $id_header;
			$this->mtpb_kemasan->create($r);
		}

		$approval = new stdClass();
		$approval->ID_HEADER = $id_header;
		$this->mtpb_approval->create($approval);

		$d = 1;
		$x = 1;

		$tpb_dokumen_filter = a2o($tpb_dokumen_filter);
		$tpb_dokumen = a2o($in->tpb_dokumen);
		$tpb_dokumen_filter = (object) (array_merge((array) $tpb_dokumen_filter,(array) $tpb_dokumen ));
		foreach ($tpb_dokumen_filter as $row){
			$row = a2o($row);
			if ($row->NOMOR_DOKUMEN!='' || $row->NOMOR_DOKUMEN!= null){
				$seri_dokumen++;
				$row = a2o($row);
				$row->SERI_DOKUMEN = $seri_dokumen;
				$row->ID_HEADER = $id_header;
				$row = sortObject($row);
				$this->mtpb_dokumen->create($row);
			}
		}

		$tpb_barang = a2o($in->tpb_barang);
		foreach ($tpb_barang as $tb){
			$seri_barang++;
			$seri_dokumen++;
			$tb = a2o($tb);
			$inv = a2o($tb->dokumen_inv);
			$stuffing = a2o($tb->dokumen_stuffing);
			$kode_barang = $tb->KODE_BARANG;
			unset($tb->dokumen_inv);
			unset($tb->dokumen_stuffing);
			$barang_tarif = a2o($tb->TARIF);
			unset($tb->TARIF);
			$tb->ID_HEADER = $id_header;
			$tb->SERI_BARANG = $seri_barang;
			$tb->KODE_STATUS = '01';

			unset($tb->BRUTO,$tb->HARGA_INVOICE,$tb->HARGA_PENYERAHAN);
			$tb = sortObject($tb);
			$id_barang = $this->mtpb_barang->create($tb);

			$inv->ID_HEADER = $id_header;
			$inv->KODE_BARANG = $kode_barang;
			$inv->SERI_DOKUMEN = $seri_dokumen;
			$inv->TANGGAL_DOKUMEN = reverseDate($inv->TANGGAL_DOKUMEN);
			$this->mtpb_dokumen_detail->create($inv);

			$seri_dokumen++;
			$stuffing->ID_HEADER = $id_header;
			$stuffing->KODE_BARANG = $kode_barang;
			$stuffing->SERI_DOKUMEN = $seri_dokumen;
			$stuffing->TANGGAL_DOKUMEN = reverseDate($stuffing->TANGGAL_DOKUMEN);
			$this->mtpb_dokumen_detail->create($stuffing);

			if(isset($in->dokumen_tambahan)) {
				$tpb_dokumen_tambahan = a2o($in->dokumen_tambahan);
				foreach ($tpb_dokumen_tambahan as $row) {
					$seri_dokumen++;
					$row = a2o($row);
					$get = $this->mreferensi_dokumen->getByCode($row->KODE_JENIS_DOKUMEN);
					$row->TIPE_DOKUMEN = $get->TIPE_DOKUMEN;
					$row->TANGGAL_DOKUMEN = reverseDate($row->TANGGAL_DOKUMEN);
					$row->SERI_DOKUMEN = $seri_dokumen;
					$row->ID_HEADER = $id_header;
					$this->mtpb_dokumen->create($row);
				}
			}
		}

		$tpb_jaminan = a2o($in->tpb_jaminan);
		$tpb_jaminan->TANGGAL_JAMINAN = reverseDate($tpb_jaminan->TANGGAL_JAMINAN);
		$tpb_jaminan->TANGGAL_JATUH_TEMPO = reverseDate($tpb_jaminan->TANGGAL_JATUH_TEMPO);
		$tpb_jaminan->TANGGAL_BPJ = reverseDate($tpb_jaminan->TANGGAL_BPJ);
		$tpb_jaminan->ID_HEADER = $id_header;
		$tpb_jaminan = sortObject($tpb_jaminan);
		$this->mtpb_jaminan->create($tpb_jaminan);

		$tpb_pungutan = a2o($in->tpb_pungutan);
		foreach ($tpb_pungutan as $row){
			$row = a2o($row);
			if ($row->NILAI_PUNGUTAN!=0){
				$row->ID_HEADER = $id_header;
				$this->mtpb_pungutan->create($row);
			}
		}

	}

	function processdocoutbc41($in, $no_aju){
		$seri_dokumen = $seri_barang = $netto = $bruto = $kemasan = $harga = $cif = $cif_rupiah = $barang = 0;
		$d = 1;
		// THIS LOGIC IS TO GET DISTINCT DATA DOKUMEN TPB
		$tpb_barang = a2o($in->tpb_barang);
		foreach ($tpb_barang as $row){
			$row = a2o($row);
			$tpb_dokumen[$d] = $row->dokumen_inv;
			$d++;
			$tpb_dokumen[$d] = $row->dokumen_stuffing;
			$d++;
			$netto += floatval($row->NETTO);
			$bruto += floatval($row->BRUTO);
			$harga += floatval($row->HARGA_PENYERAHAN);
			$cif += floatval($row->CIF);
			$cif_rupiah += floatval($row->CIF_RUPIAH);
			$barang++;
		}

		$x = 1;
		foreach ($tpb_dokumen as $row){
			$row = a2o($row);
			if (empty($tpb_dokumen_filter)) {
				$tpb_dokumen_filter[$x] = $row;
				$x++;
			}
			else if (filterObject($tpb_dokumen_filter,$row,'NOMOR_DOKUMEN')) {
				$tpb_dokumen_filter[$x] = $row;
				$x++;
			}
		}
		// END

		$tpb_kemasan = a2o($in->tpb_kemasan);
		foreach ($tpb_kemasan as $r){
			$r = a2o($r);
			$kemasan += floatval($r->JUMLAH_KEMASAN);
		}

		$tpb_header = a2o($in->tpb_header);
		// printJSON($in);
		$id_customer = $in->id_supplier;
		$supplier = $this->mm_customer_suplier->get($id_customer);
		$tpb_header->ALAMAT_PENERIMA_BARANG = $supplier->alamat;
		$tpb_header->ALAMAT_PENGIRIM = $supplier->alamat;
		$tpb_header->ID_PENGIRIM = $supplier->npwp;
		$tpb_header->NAMA_PENGIRIM = $supplier->nama;
		$tpb_header->KODE_NEGARA_PEMASOK = $supplier->kode_negara;
		$app = getAppSetting($this);
		$tpb_header->ALAMAT_PENGUSAHA = $app->alamat;
		$tpb_header->NAMA_PENGUSAHA = $app->nama_sbu;
		$tpb_header->ASAL_DATA = $app->ASAL_DATA;
		$tpb_header->ID_MODUL = $app->ID_MODUL;
		$tpb_header->ID_PENGUSAHA = $app->NPWP;
		$tpb_header->ID_PENERIMA_BARANG = $supplier->npwp;
		$tpb_header->JABATAN_TTD = $app->JABATAN;
		$tpb_header->NAMA_PENERIMA_BARANG = $supplier->nama;
		$tpb_header->KODE_ID_PENERIMA_BARANG = $app->KODE_ID_PENERIMA_BARANG;
		$tpb_header->KODE_ID_PENGUSAHA = $app->KODE_ID_PENGUSAHA;
		$tpb_header->KOTA_TTD = $app->KOTA_TTD;
		$tpb_header->NAMA_TTD = $app->NAMA_TTD;
		$tpb_header->NOMOR_IJIN_TPB = $app->NOMOR_SKEP;
		$tpb_header->VERSI_MODUL = $app->VERSI_MODUL;
		$tpb_header->KODE_STATUS = '01';
		$tpb_header->TANGGAL_AJU = reverseDate($tpb_header->TANGGAL_AJU);
		$tpb_header->JUMLAH_BARANG = $barang;
		$tpb_header->JUMLAH_KEMASAN = $kemasan;
		$tpb_header->NOMOR_AJU = $no_aju;
		$tpb_header->NETTO = $netto;
		$tpb_header->BRUTO = $bruto;
		$tpb_header->HARGA_PENYERAHAN = $harga;
		$tpb_header->KODE_KANTOR = $app->KPPBC;
		$tpb_header->NAMA_PENGANGKUT = $tpb_header->NAMA_PENGANGKUT;
		unset($tpb_header->NOMOR_BC11,$tpb_header->TANGGAL_BC11,$tpb_header->POS_BC11,$tpb_header->SUBPOS_BC11,$tpb_header->SUBSUBPOS_BC11,$tpb_header->KODE_NEGARA_PEMASOK,$tpb_header->KODE_PEL_MUAT,$tpb_header->KODE_PEL_TRANSIT,$tpb_header->KODE_KANTOR_BONGKAR,$tpb_header->KODE_PEL_BONGKAR,$tpb_header->NAMA_PENGANGKUT,$tpb_header->NAMA_PENGANGKUT);


		$tpb_header = sortObject($tpb_header);
		unset($tpb_header->KODE_PEL_MUAT_EKSPORT);
		$id_header = $this->mtpb_header->create($tpb_header);

		$tpb_kemasan = a2o($in->tpb_kemasan);
		foreach ($tpb_kemasan as $r){
			$r = a2o($r);
			$r->ID_HEADER = $id_header;
			$this->mtpb_kemasan->create($r);
		}

		$approval = new stdClass();
		$approval->ID_HEADER = $id_header;
		$this->mtpb_approval->create($approval);

		$d = 1;
		$x = 1;

		$tpb_dokumen_filter = a2o($tpb_dokumen_filter);
		$tpb_dokumen = a2o($in->tpb_dokumen);
		$tpb_dokumen_filter = (object) (array_merge((array) $tpb_dokumen_filter,(array) $tpb_dokumen ));
		foreach ($tpb_dokumen_filter as $row){
			$row = a2o($row);
			if ($row->NOMOR_DOKUMEN!='' || $row->NOMOR_DOKUMEN!= null){
				$seri_dokumen++;
				$row = a2o($row);
				$row->SERI_DOKUMEN = $seri_dokumen;
				$row->ID_HEADER = $id_header;
				$row = sortObject($row);
				$this->mtpb_dokumen->create($row);
			}
		}

		$tpb_barang = a2o($in->tpb_barang);
		foreach ($tpb_barang as $tb){
			$seri_barang++;
			$seri_dokumen++;
			$tb = a2o($tb);
			$inv = a2o($tb->dokumen_inv);
			$stuffing = a2o($tb->dokumen_stuffing);
			$kode_barang = $tb->KODE_BARANG;
			unset($tb->dokumen_inv);
			unset($tb->dokumen_stuffing);
			$barang_tarif = a2o($tb->TARIF);
			unset($tb->TARIF);
			$tb->ID_HEADER = $id_header;
			$tb->SERI_BARANG = $seri_barang;
			$tb->KODE_STATUS = '01';

			unset($tb->BRUTO,$tb->HARGA_INVOICE,$tb->HARGA_SATUAN,$tb->CIF,$tb->CIF_RUPIAH,$tb->ASURANSI,$tb->DISKON);
			$tb = sortObject($tb);
			$id_barang = $this->mtpb_barang->create($tb);

			$inv->ID_HEADER = $id_header;
			$inv->KODE_BARANG = $kode_barang;
			$inv->SERI_DOKUMEN = $seri_dokumen;
			$inv->TANGGAL_DOKUMEN = reverseDate($inv->TANGGAL_DOKUMEN);
			$this->mtpb_dokumen_detail->create($inv);

			$seri_dokumen++;
			$stuffing->ID_HEADER = $id_header;
			$stuffing->KODE_BARANG = $kode_barang;
			$stuffing->SERI_DOKUMEN = $seri_dokumen;
			$stuffing->TANGGAL_DOKUMEN = reverseDate($stuffing->TANGGAL_DOKUMEN);
			$this->mtpb_dokumen_detail->create($stuffing);

			if(isset($in->dokumen_tambahan)) {
				$tpb_dokumen_tambahan = a2o($in->dokumen_tambahan);
				foreach ($tpb_dokumen_tambahan as $row) {
					$seri_dokumen++;
					$row = a2o($row);
					$get = $this->mreferensi_dokumen->getByCode($row->KODE_JENIS_DOKUMEN);
					$row->TIPE_DOKUMEN = $get->TIPE_DOKUMEN;
					$row->TANGGAL_DOKUMEN = reverseDate($row->TANGGAL_DOKUMEN);
					$row->SERI_DOKUMEN = $seri_dokumen;
					$row->ID_HEADER = $id_header;
					$this->mtpb_dokumen->create($row);
				}
			}
		}
	}

	function processdocoutbc30($in){
		modelLoad($this,array('mpeb_tblpebhdr','mpeb_tblpebdok','mpeb_tblpebdtl','mpeb_tblpebkms','mpeb_approval'));
		// $tblpebhdr = new StdClass();
		$in = a2o($in);
		$peb_header = a2o($in->peb_header);
		/** SET CAR (NOMOR AJU) */
		
		$tgl_aju = reverseDate($peb_header->no_aju);
		// $peb_header->TGEKS = $tgl_aju;
		// $peb_header->TgTdp = reverseDate($peb_header->TgTdp);
		// $peb_header->TgPpjk = reverseDate($peb_header->TgPpjk);
		$peb_header->TGEKS = reverseDate($peb_header->TGEKS);
		
		// printJSON($peb_header->TGEKS);
		$peb_header->TGSIAP = reverseDate($peb_header->TGSIAP);
		unset($peb_header->no_aju);
		$car = $this->mpeb_tblpebhdr->generateCode($tgl_aju);
		$peb_header->CAR = $car;
		
		$d=1;
		$tblpebdtl = a2o($in->peb_detail);
		$tblpebdok=[];
		foreach ($tblpebdtl as $row){
			$row = a2o($row);
			$tblpebdok[$d] = $row->dokumen_inv;
			$d++;
			$tblpebdok[$d] = $row->dokumen_stuffing;
			$d++;
		}

		$x = 1;
		$pebdok_filter=[];
		foreach ($tblpebdok as $row){
			$row = a2o($row);
			if (empty($pebdok_filter)) {
				$pebdok_filter[$x] = $row;
				$x++;
			}
			else if (filterObject($pebdok_filter,$row,'NoDok')) {
				$pebdok_filter[$x] = $row;
				$x++;
			}
		}
		$dokumen_tambahan = a2o($in->dokumen_tambahan);
		$pebdok_filter = a2o($pebdok_filter);
		$pebdok_filter = (object) (array_merge((array) $pebdok_filter,(array) $dokumen_tambahan ));
		//END

		/** IF RECEIVER = CUSTOMER, SET RECEIVER DATA SAME AS CUSTOMER */
		// if ($in->flag_penerima){
		// 	$peb_header->NAMABELI = $peb_header->NAMABELI2;
		// 	$peb_header->ALMTBELI = $peb_header->ALMTBELI2;
		// 	$peb_header->NEGBELI = $peb_header->NEGBELI2;
		// }
		/** END */

		/** SET CARRIER VALUE FROM MODAL OR INPUT */
		if ($peb_header->CARRIER_MODAL != ''){
			$peb_header->CARRIER = $peb_header->CARRIER_MODAL;
		} else if ($peb_header->CARRIER_INPUT != ''){
			$peb_header->CARRIER = $peb_header->CARRIER_INPUT;
		}
		unset($peb_header->CARRIER_MODAL,$peb_header->CARRIER_INPUT);
		/** END */

		/** INSERT $peb_header TO tblpebhdr */
		$this->mpeb_tblpebhdr->create($peb_header);

		$peb_detail = a2o($in->peb_detail);
		foreach ($peb_detail as $r){
			$r = a2o($r);
			$r->FOBPERBRG = $r->DNilInv;
			unset($r->dokumen_inv,$r->dokumen_stuffing);
			/** INJECT CAR (NOMOR AJU) TO $r */
			$r->CAR = $car;
			/** INSERT $r TO tblpebdtl */
			$this->mpeb_tblpebdtl->create($r);
		}

		$pebdok_filter = a2o($pebdok_filter);
		foreach ($pebdok_filter as $r){
			$r = a2o($r);
			$r->TgDok = reverseDate($r->TgDok);
			/** INJECT CAR (NOMOR AJU) TO $r */
			$r->CAR = $car;
			/** INSERT $r TO tblpebdok */
			$this->mpeb_tblpebdok->create($r);
		}

		$peb_kemasan = a2o($in->peb_kemasan);
		foreach ($peb_kemasan as $r){
			$r = a2o($r);
			/** INJECT CAR (NOMOR AJU) TO $r */
			$r->CAR = $car;
			/** INSERT $r TO tblpebkms */
			$this->mpeb_tblpebkms->create($r);
		}

		$approval = new stdClass();
		$approval->ID_HEADER = $car;
		$this->mpeb_approval->create($approval);

	}

	function purchase_return($arg1="", $arg2="")
	{
		modelLoad($this,array('mt_return','mt_return_detail'));
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		if($this->d->_action == 'view'){
			
		} else if($this->d->_action == 'add'){
			$this->d->_modal = array('t_dn_return','t_detail_dn_return');
		} else if($this->d->_action == 'store'){
			$this->db->trans_start();
			$t_return = a2o($this->in->t_return);
			$t_return->tanggal_return = reverseDate($t_return->tanggal_return);
			$t_return->kode_return = $this->mt_return->generateCode($t_return->tanggal_return);
			
			$id_return = $this->mt_return->create($t_return);

			$t_return_detail = a2o($this->in->t_return_detail);
			foreach ($t_return_detail as $row) {
				$row = a2o($row);
				$row->id_return = $id_return;
				$this->mt_return_detail->create($row);
			}

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data Retur berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data Retur gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'detail'){
			$this->d->return = $this->mt_return->getDetail($arg2);
		} else if($this->d->_action == 'edit'){
			$this->d->return = $this->mt_return->getDetail($arg2);
		} else if($this->d->_action == 'update'){
			$this->db->trans_start();
			
			$t_return_detail = a2o($this->in->t_return_detail);
			foreach ($t_return_detail as $row) {
				$row = a2o($row);
				$this->mt_return_detail->update($row);
			}

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Update data Retur berhasil';
			} else {
				$s->status = false;
				$s->message = 'Update data Retur gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'delete'){
			$this->db->trans_start();
			
			$this->mt_return->delete($arg2);

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Delete data Retur berhasil';
			} else {
				$s->status = false;
				$s->message = 'Delete data Retur gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'viewdt'){
			$res = $this->mt_return->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewreturndt'){
			modelLoad($this,array('mt_dn'));
			$res = $this->mt_dn->viewReturnDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewDetailDNReturn'){
			modelLoad($this,array('mt_detail_dn'));
			$res = $this->mt_detail_dn->viewDetailDNReturn($this->in);
			printJSON($res);
		} else if($this->d->_action == 'approval1'){
			$this->db->trans_start();
			$this->mt_return->approval1($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Retur berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Retur gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'approval2'){
			$this->db->trans_start();
			$this->mt_return->approval2($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval data Retur berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data Retur gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'disapprove1'){
			$this->db->trans_start();
			$this->mt_return->disapprove1($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Disapprove data Retur berhasil';
			} else {
				$s->status = false;
				$s->message = 'Disapprove data Retur gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		} else if($this->d->_action == 'disapprove2'){
			$this->db->trans_start();
			$this->mt_return->disapprove2($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Disapprove data Retur berhasil';
			} else {
				$s->status = false;
				$s->message = 'Disapprove data Retur gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		}

		$this->load->view('template_view', $this->d);
	}
}
