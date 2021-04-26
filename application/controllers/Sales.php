<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {
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
		loadLanguage($this, $this->d->_controller, $this->d->_method);
		$this->in = getPostAsObject($this);
	}

	public function index()
	{
		$this->load->view('template_view');
	}

	function invoice_lama($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;
		modelLoad($this, array('mm_tipe_sales', 'mt_stuffing','mt_detail_stuffing', 'mt_wh', 'mt_wh_detail', 'mreferensi_ukuran_kontainer'));
		if($this->d->_action == 'add'){
			$this->d->_modal = array('referensi_pemasok', 't_wh_detail_stuffing', 'detail_supplier_destination', 'referensi_valuta');
			$this->d->m_tipe_sales = $this->mm_tipe_sales->view();
			$this->d->referensi_ukuran_container = $this->mreferensi_ukuran_kontainer->view();
		} else if($this->d->_action == 'store'){
		} else if($this->d->_action == 'edit'){
		} else if($this->d->_action == 'update'){
		} else if($this->d->_action == 'detail'){
		} else if($this->d->_action == 'delete') {
			//print
		} else if($this->d->_action == 'print'){
		} else if($this->d->_action == 'viewdt'){
			$res = $this->mt_stuffing->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewdetaildt'){
			$res = $this->mt_detail_stuffing->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewwhdt'){
			modelLoad($this, array('mt_wh_detail'));
			$res = $this->mt_wh_detail->viewStuffingDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewinvoicedt'){
			modelLoad($this, array('mt_detail_stuffing'));
			$res = $this->mt_detail_stuffing->viewInvoiceDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewstuffingdt'){
			$res = $this->mt_detail_stuffing->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'approve') {
		} else if ($this->d->_action == 'approve2') {
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function sales_order($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this, array('mt_so', 'mt_detail_so'));
		if($this->d->_action == 'add'){
			$this->d->_modal = array('m_sub_barang', 'referensi_valuta', 'referensi_kemasan');
			modelLoad($this, array('mm_tipe_sales','mm_class'));
			$this->d->tipe_sales = $this->mm_tipe_sales->view();
			$this->d->klasifikasi = $this->mm_class->view();
		} else if($this->d->_action == 'store'){
			// printJSON($this->in);
			$this->db->trans_start();
			$t = a2o($this->in->t_po);
			if(isset($t->autojob)){
                $auto = $t->autojob;
                unset($t->autojob);
            } else $auto = 0;
			$t->type_trans = 'sales';
			$t->tanggal_dibuat = reverseDate($t->tanggal_dibuat);
			$t->tanggal_dibutuhkan = $t->tanggal_dibuat;
			//printJSON($t);
			$id = $this->mt_so->create($t);
			foreach ($this->in->t_detail_po as $r) {
				$o = a2o($r);
				$o->id_po = $id;
				if ($o->id_sub_barang != '') {
					$this->mt_detail_so->create($o);
				}
			}
			//if($auto) $this->createBOMandJOB($id);
			$this->createBOMandJOB($id);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data sales order berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data sales order gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if($this->d->_action == 'edit'){
			$this->d->_modal = array('m_sub_barang', 'referensi_pemasok', 'referensi_valuta', 'referensi_kemasan');
			modelLoad($this, array('mm_tipe_sales', 'mm_class'));
			$this->d->tipe_sales = $this->mm_tipe_sales->view();
			$this->d->klasifikasi = $this->mm_class->view();
			$this->d->t_po = $this->mt_so->get($arg2);
			$this->d->t_detail_po = $this->mt_detail_so->viewBasedSOId($arg2);
		} else if($this->d->_action == 'update'){
			$this->db->trans_start();
			$t = a2o($this->in->t_po);
			$this->mt_so->update($t);
			$this->in->deleted_detail_po = json_decode(stripslashes($this->in->deleted_detail_po));
			foreach($this->in->deleted_detail_po as $v){
				$this->mt_detail_so->delete($v);
			}
			//printJSON($this->in->t_detail_po);
			foreach ($this->in->t_detail_po as $r) {
				$o = a2o($r);
				if ($o->id_detail_po) 
					$this->mt_detail_so->update($o);
				else {
					$o->id_po = $t->id_po;
					$this->mt_detail_so->create($o);
				}
			}
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data sales order berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data sales order gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if ($this->d->_action == 'detail') {
			modelLoad($this, array('mt_so', 'mt_detail_so'));
			$this->d->t_po = $this->mt_so->get($arg2);
			$this->d->t_detail_po = $this->mt_detail_so->viewBasedSOId($arg2);
		} else if ($this->d->_action == 'approve') {
			$t = a2o($this->in);
			$this->db->trans_start();
			$t->date_approval_1 = date('Y-m-d H:i:s');
			$this->mt_so->update($t);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approve sales order berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approve data sales order gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$t->id_po);
		} else if ($this->d->_action == 'approve2') {
			$t = a2o($this->in);
			$this->db->trans_start();
			$t->date_approval_2 = date('Y-m-d H:i:s');
			$this->mt_so->update($t);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approve sales order berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approve data sales order gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$t->id_po);
		} else if ($this->d->_action == 'delete') {
			$this->d->t_so = $this->mt_so->get($arg2);
			$s = new stdClass();
			if ($this->d->t_so->approval_1 == '0' && $this->d->t_so->approval_2 == '0') {
				$this->db->trans_start();
				$this->mt_so->delete($arg2);
				$this->mt_detail_so->deleteBasedSOId($arg2);
				$this->db->trans_complete();
				$status = $this->db->trans_status();
				if($status){
					$s->status = true;
					$s->message = 'Hapus sales order berhasil';
				} else {
					$s->status = false;
					$s->message = 'Hapus data sales order gagal';
				}
			} else {
				$s->status = false;
				$s->message = 'Tidak bisa hapus sales order yang sudah diapprove';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mt_so->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'rates') {
		    modelLoad($this, array('mm_rates'));
			$res = $this->mm_rates->getRates($arg2);
			printJSON($res);
		} else if ($this->d->_action == '') {

		}

		$this->load->view('template_view', $this->d);
	}

	function createBOMandJOB($id)
    {
        modelLoad($this, array('mt_bom','mt_job','mt_bom_workflow'));

        $newso = $this->mt_so->getDetail($id);
        foreach ($newso as $r){
            $bom = new stdClass();
            $bom->tanggal_bom = $r->tanggal_dibuat;
            $bom->id_detail_po = $r->id_detail_po;
            $bom->id_sub_barang = $r->id_sub_barang;
            $bom->qty = $r->qty;
            $bom->id_status = 1;
            $idbom = $this->mt_bom->create($bom);

            $wf = new stdClass();
            $wf->id_bom = $idbom;
            $wf->id_workflow = 18;
            $wf->created_at = date('Y-m-d H:i:s');
            $wf->updated_at = date('Y-m-d H:i:s');
            $this->mt_bom_workflow->create($wf);

            //insert job
            $djob = $this->mt_so->getJobBySO($id);
            $job = new stdClass();
            $job->no_job = $djob->nojob;
            $job->id_bom = $idbom;
            $job->id_supplier = $djob->id_supplier;
            $job->id_so = $djob->id_so;
            $job->tanggal_job = $djob->tanggal_dibuat;
            $job->due_date = $djob->tanggal_dibuat;
            $job->id_status = 1;
            $job->created_at = date('Y-m-d H:i:s');
            $job->updated_at = date('Y-m-d H:i:s');
            $this->mt_job->create($job);
        }
    }

	function main_so($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this, array('mt_so', 'mt_detail_so','mt_main_so','mt_main_so_detail'));
		if($this->d->_action == 'add'){
			$this->d->_modal = array('m_sub_barang', 'referensi_valuta', 'referensi_kemasan', 'm_customer');

			modelLoad($this, array('mm_tipe_sales'));

			$this->d->tipe_sales = $this->mm_tipe_sales->viewActive();

		} else if($this->d->_action == 'store') {
			$this->db->trans_start();
			$t = a2o($this->in->t_po);
			if (!isset($this->in->callof)){ $t->is_callof = 0; }
			else {$t->is_callof = 1;}
			$t->type_trans = 'main_so';
			$t->tanggal_dibuat = reverseDate($t->tanggal_dibuat);
			$t->tanggal_dibutuhkan = reverseDate($t->tanggal_dibutuhkan);

			$id = $this->mt_main_so->create($t,"callof_parent");

			foreach ($this->in->t_detail_po as $r) {
				$o = a2o($r);
				$o->id_po = $id;
				if ($o->id_sub_barang != '') {
					$this->mt_main_so_detail->create($o);
				}
			}

			if (!isset($this->in->callof)){

				$t->type_trans = 'sales';
				$t->id_main_so = $id;
				$id_so = $this->mt_so->create($t,"not_callof",$id);

				foreach ($this->in->t_detail_po as $r) {
					$o = a2o($r);
					$o->id_po = $id_so;
					if ($o->id_sub_barang != '') {
						$this->mt_detail_so->create($o);
					}
				}
			}

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data sales order berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data sales order gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);

		} else if($this->d->_action == 'edit'){
			$this->d->_modal = array('m_sub_barang', 'm_customer', 'referensi_valuta', 'referensi_kemasan');

			modelLoad($this, array('mm_tipe_sales'));

			$this->d->tipe_sales = $this->mm_tipe_sales->view();
			$this->d->t_po = $this->mt_so->get($arg2);
			$this->d->t_detail_po = $this->mt_detail_so->viewBasedSOId($arg2);
		} else if($this->d->_action == 'update'){
			$this->db->trans_start();
			$t = a2o($this->in->t_po);
			$this->mt_so->update($t);

			$this->in->deleted_detail_po = json_decode(stripslashes($this->in->deleted_detail_po));
			foreach($this->in->deleted_detail_po as $v){

				$this->mt_detail_so->delete($v);
			}

			//printJSON($this->in->t_detail_po);
			foreach ($this->in->t_detail_po as $r) {
				$o = a2o($r);
				if ($o->id_detail_po)
					$this->mt_detail_so->update($o);
				else {
					$o->id_po = $t->id_po;
					$this->mt_detail_so->create($o);
				}
			}

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data sales order berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data sales order gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);

		} else if ($this->d->_action == 'detail') {
			modelLoad($this, array('mt_so', 'mt_detail_so'));
			$this->d->t_po = $this->mt_so->get($arg2);
			$this->d->t_detail_po = $this->mt_detail_so->viewBasedSOId($arg2);
		} else if ($this->d->_action == 'detailjson') {
			modelLoad($this, array('mt_main_so', 'mt_main_so_detail'));
			$t_detail_po = $this->mt_main_so_detail->viewBasedSOId($arg2);
			printJSON($t_detail_po);
		} else if ($this->d->_action == 'approve') {
			$t = a2o($this->in);
			$this->db->trans_start();
			$t->date_approval_1 = date('Y-m-d H:i:s');
			$this->mt_so->update($t);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approve sales order berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approve data sales order gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$t->id_po);
		} else if ($this->d->_action == 'approve2') {
			$t = a2o($this->in);
			$this->db->trans_start();
			$t->date_approval_2 = date('Y-m-d H:i:s');
			$this->mt_so->update($t);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approve sales order berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approve data sales order gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$t->id_po);
		} else if ($this->d->_action == 'delete') {
			$this->d->t_so = $this->mt_so->get($arg2);
			$s = new stdClass();
			if ($this->d->t_so->approval_1 == '0' && $this->d->t_so->approval_2 == '0') {
				$this->db->trans_start();
				$this->mt_so->delete($arg2);
				$this->mt_detail_so->deleteBasedSOId($arg2);
				$this->db->trans_complete();
				$status = $this->db->trans_status();
				if($status){
					$s->status = true;
					$s->message = 'Hapus sales order berhasil';
				} else {
					$s->status = false;
					$s->message = 'Hapus data sales order gagal';
				}
			} else {
				$s->status = false;
				$s->message = 'Tidak bisa hapus sales order yang sudah diapprove';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
		} else if ($this->d->_action == 'viewdt') {
			$res = $this->mt_main_so->viewDT($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'viewdtmodal') {
			$res = $this->mt_main_so->viewdtmodal($this->in);
			printJSON($res);
		} else if ($this->d->_action == 'viewdetaildt') {
			$res = $this->mt_main_so_detail->viewdetaildt($this->in,$arg2);
			printJSON($res);
		} else if ($this->d->_action == '') {

		}

		$this->load->view('template_view', $this->d);
	}

	function sales_order_detail($arg1="", $arg2="")
	{
		modelLoad($this, array('mt_detail_so'));
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;
		if($this->d->_action == 'add'){

		} else if($this->d->_action == 'store'){

		} else if($this->d->_action == 'edit'){
			
		} else if($this->d->_action == 'update'){
		
		} else if($this->d->_action == 'delete'){

		} else if($this->d->_action == 'viewdt'){
			$res = $this->mt_detail_so->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewbomdt'){
			$res = $this->mt_detail_so->viewBOMDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewstuffingdt'){
			$res = $this->mt_detail_so->viewStuffingDT($this->in);
			printJSON($res);
		} else if($this->d->_action == ''){

		}

		$this->load->view('template_view', $this->d);
	}

	function invoice($arg1="", $arg2="")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this, array('mt_so', 'mt_detail_so', 'mt_detail_stuffing','mt_invoice'));
		if ($this->d->_action == 'add') {
			$this->d->_modal = array('referensi_valuta', 'referensi_pemasok', 'detail_supplier_destination', 't_detail_stuffing_invoice','t_wh_detail_stuffing','t_detail_stuffing_invoice','m_supplier');
			modelLoad($this, array('mm_tipe_sales','mreferensi_ukuran_kontainer','mm_jenis_pembayaran'));
			$this->d->tipe_sales = $this->mm_tipe_sales->view();
			$this->d->referensi_ukuran_container = $this->mreferensi_ukuran_kontainer->view();
			$this->d->jenis_pembayaran = $this->mm_jenis_pembayaran->view();
		} else if ($this->d->_action == 'store') {
			//printJSON($this->in);
			modelLoad($this, array('mt_invoice', 'mt_invoice_detail', 'mt_detail_stuffing'));
			$this->db->trans_start();
			$t = a2o($this->in->t_invoice);
			$t->tanggal_invoice = reverseDate($t->tanggal_invoice);

			$id = $this->mt_invoice->create($t);

			foreach ($this->in->t_detail_invoice as $r) {
				$o = a2o($r);
				$o->id_invoice = $id;
				$detail_stuffings = $this->mt_detail_stuffing->viewByWhere(array(
					'id_po' => $o->id_po,
					'id_stuffing' => $o->id_stuffing,
					'id_sub_barang' => $o->id_sub_barang,
					// 'id_satuan' => $o->id_satuan,
					'id_kemasan' => $o->id_kemasan
				));
				$qty_sisa = $o->qty_invoice;
				// printJSON($o);
				foreach ($detail_stuffings as $detail) {
					if ($qty_sisa > 0) {
						$quantity = 0;
						if ($detail->qty_si_plan > $qty_sisa) {
							$quantity = $qty_sisa;
						} else {
							$quantity = $detail->qty_si_plan;
						}
						$this->mt_invoice_detail->create(a2o(
							array(
								'id_invoice' => $id,
								// 'id_po' => $detail->id_po,
								'id_detail_stuffing' => $detail->id_detail_stuffing,
								'id_sub_barang' => $detail->id_sub_barang,
								// 'id_detail_dn' => $detail->id_detail_dn,
								// 'id_job' => $detail->id_job,
								// 'id_production' => $detail->id_production,
								'id_sub_barang' => $detail->id_sub_barang,
								'id_satuan' => $o->id_satuan,
								'id_kemasan' => $detail->id_kemasan,
								'netto' => $detail->netto,
								'bruto' => $detail->bruto,
								'qty_invoice' => $quantity,
								'harga' => $o->harga,
							)
						));
						$qty_sisa = $qty_sisa - $quantity;
					} else {
						break;
					}
				}
				// $this->mt_invoice_buffer->create($o);
			}

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Simpan data invoice berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data invoice gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method . '/detail/'.$id);



		} else if ($this->d->_action == 'edit') {
			$this->d->_modal = array('m_sub_barang', 'referensi_pemasok', 'referensi_valuta', 'referensi_kemasan');

			modelLoad($this, array('mm_tipe_sales'));

			$this->d->tipe_sales = $this->mm_tipe_sales->view();
			$this->d->t_po = $this->mt_so->get($arg2);
			$this->d->t_detail_po = $this->mt_detail_so->viewBasedSOId($arg2);

		} else if ($this->d->_action == 'detail') {
			modelLoad($this, array('mt_invoice', 'mt_invoice_detail'));
			$this->d->t_invoice = $this->mt_invoice->get($arg2);
			$this->d->t_invoice_detail = $this->mt_invoice_detail->viewByInvoiceId($arg2);

		} else if ($this->d->_action == 'update') {
			$this->db->trans_start();
			$t = a2o($this->in->t_po);
			$this->mt_so->update($t);
			$this->in->deleted_detail_po = json_decode(stripslashes($this->in->deleted_detail_po));
			foreach ($this->in->deleted_detail_po as $v) {

				$this->mt_detail_so->delete($v);
			}

			//printJSON($this->in->t_detail_po);
			foreach ($this->in->t_detail_po as $r) {
				$o = a2o($r);
				if ($o->id_detail_po)
					$this->mt_detail_so->update($o);
				else {
					$o->id_po = $t->id_po;
					$this->mt_detail_so->create($o);
				}
			}

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Simpan data invoice berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data invoice gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);

		} else if ($this->d->_action == 'delete'){

		} else if ($this->d->_action == 'print'){
			$this->d->app = getAppSetting($this);
			modelLoad($this, array('mt_invoice', 'mt_invoice_detail'));
			$this->d->t_invoice = $this->mt_invoice->get($arg2);
			$this->d->t_invoice_detail = $this->mt_invoice_detail->viewByInvoiceId($arg2);
			//$this->d->t_invoice = $this->mt_invoice_detail->viewPrint($arg2);

		} else if($this->d->_action == 'viewdt'){
			modelLoad($this, array('mt_invoice'));
			$res = $this->mt_invoice->viewDT($this->in);
			printJSON($res);
		} else if($this->d->_action == 'viewstuffingdt'){
			$res = $this->mt_detail_stuffing->viewstuffingdt($this->in);
			printJSON($res);
		}  else if($this->d->_action == 'approval1'){
			$this->db->trans_start();
			$this->mt_invoice->approval1($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval invoice berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data invoice gagal';
			}
			setNotification($this, $s);
            redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
        } else if($this->d->_action == 'approval2'){
			$this->db->trans_start();
			$this->mt_invoice->approval2($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Approval invoice berhasil';
			} else {
				$s->status = false;
				$s->message = 'Approval data invoice gagal';
			}
			setNotification($this, $s);
            redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
        } else if($this->d->_action == 'unapprove1'){
            $this->db->trans_start();
            $this->mt_invoice->disapprove1($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if($status){
                $s->status = true;
                $s->message = 'Disapprove invoice berhasil';
            } else {
                $s->status = false;
                $s->message = 'Disapprove data invoice gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
        } else if($this->d->_action == 'unapprove2'){
			$this->db->trans_start();
			$this->mt_invoice->disapprove2($arg2);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Disapprove invoice berhasil';
			} else {
				$s->status = false;
				$s->message = 'Dispprove data invoice gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$arg2);
		}

		$this->load->view('template_view', $this->d);
	}

	function report_sales_order($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->d->_modal = array('m_sub_barang', 'referensi_pemasok');
		modelLoad($this, array('mm_tipe_sales', 'mt_detail_so'));
		if ($this->d->_action == 'view') {
			$this->d->tipe_sales = $this->mm_tipe_sales->view();
		} else if ($this->d->_action == 'add') {
			$this->d->tipe_sales = $this->mm_tipe_sales->view();
		} else if ($this->d->_action == '') {

		}

		$this->load->view('template_view', $this->d);
	}

	function report_sales_invoice($arg1="", $arg2="")
	{
		if(empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		$this->d->_modal = array('m_sub_barang', 'referensi_pemasok');
		modelLoad($this, array('mm_tipe_sales', 'mt_detail_so'));
		if ($this->d->_action == 'view') {
			$this->d->tipe_sales = $this->mm_tipe_sales->view();
		} else if ($this->d->_action == 'add') {
			$this->d->tipe_sales = $this->mm_tipe_sales->view();
		} else if ($this->d->_action == '') {

		}

		$this->load->view('template_view', $this->d);
	}
}
