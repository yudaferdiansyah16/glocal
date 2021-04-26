<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
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

    function migrasi($arg1="", $arg2="")
    {
        if(empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        modelLoad($this, array('mmigrasi'));
        if($this->d->_action == 'save'){
            $res = $this->mmigrasi->save();
            printJSON($res);
        } else if($this->d->_action == 'viewdt'){
            $res = $this->mmigrasi->viewDT($this->in);
            printJSON($res);
        }

        $this->load->view('template_view', $this->d);
    }

    function bom($arg1="", $arg2="")
    {
        if(empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        modelLoad($this, array('mt_bom'));
        if($this->d->_action == 'add'){
            $this->d->_modal = array('t_detail_so_bom');
        } else if($this->d->_action == 'store'){
            $this->db->trans_start();
            $t = $this->in;
            $t->tanggal_bom = reverseDate($t->tanggal_bom);
            $id_bom = $this->mt_bom->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if($status){
                $s->status = true;
                $s->message = 'Simpan data BOM berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data BOM gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller.'/'.$this->d->_method.'/workflow/'.$id_bom);
        } else if($this->d->_action == 'edit'){
            $this->d->t_bom = $this->mt_bom->get($arg2);
            $this->d->_modal = array('t_detail_so_bom');
        } else if($this->d->_action == 'workflow'){
            modelLoad($this, array('mt_bom_workflow', 'mt_bom_detail'));
            $this->d->_modal = array('m_sub_barang');
            $this->d->t_bom = $this->mt_bom->get($arg2);
            $this->d->t_bom_workflow = $this->mt_bom_workflow->viewByBOM($arg2);
        } else if($this->d->_action == 'job'){
            $this->d->t_bom = $this->mt_bom->get($arg2);
        } else if($this->d->_action == 'workflow_add'){
            modelLoad($this, array('mm_workflow'));
            $this->d->m_workflow = $this->mm_workflow->view();
            $this->d->t_bom = $this->mt_bom->get($arg2);
        } else if($this->d->_action == 'workflow_store'){
            modelLoad($this, array('mt_bom_workflow'));
            $this->db->trans_start();
            $t = $this->in;
            $this->mt_bom_workflow->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if($status){
                $s->status = true;
                $s->message = 'Simpan data Workflow BOM berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data Workflow BOM gagal';
            }
            setNotification($this, $s);
            redirect('master/bom/workflow/'.$t->id_bom);
        } else if($this->d->_action == 'workflow_edit'){
            modelLoad($this, array('mm_workflow', 'mt_bom_workflow'));
            $this->d->m_workflow = $this->mm_workflow->view();
            $this->d->t_bom_workflow = $this->mt_bom_workflow->get($arg2);
            $this->d->t_bom = $this->mt_bom->get($this->d->t_bom_workflow->id_bom);
        } else if($this->d->_action == 'instruction_edit'){
            modelLoad($this, array('mm_workflow', 'mt_bom_workflow'));
            $this->d->m_workflow = $this->mm_workflow->view();
            $this->d->t_bom_workflow = $this->mt_bom_workflow->get($arg2);
            $this->d->t_bom = $this->mt_bom->get($this->d->t_bom_workflow->id_bom);
        } else if($this->d->_action == 'workflow_update'){
            modelLoad($this, array('mt_bom_workflow'));
            $this->db->trans_start();
            $t = $this->in;
            $this->mt_bom_workflow->update($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if($status){
                $s->status = true;
                $s->message = 'Update data Workflow BOM berhasil';
            } else {
                $s->status = false;
                $s->message = 'Update data Workflow BOM gagal';
            }
            setNotification($this, $s);
            redirect('master/bom/workflow/'.$t->id_bom);
        } else if($this->d->_action == 'update'){
            $this->db->trans_start();
            $this->in->tanggal_bom = reverseDate($this->in->tanggal_bom);
            $this->mt_bom->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if($status){
                $s->status = true;
                $s->message = 'Ubah data BOM berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data BOM gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller.'/'.$this->d->_method);
        } else if($this->d->_action == 'detail_update'){
            modelLoad($this, array('mt_bom_detail', 'mm_sub_barang'));

            //printJSON($this->in);
            
            $this->db->trans_start();

            $this->in->deleted_bom_detail = json_decode(stripslashes($this->in->deleted_bom_detail));
            foreach($this->in->deleted_bom_detail as $v){
                $this->mt_bom_detail->delete($v);
            }

            foreach ($this->in->t_bom_detail as $r) {
                $o = a2o($r);
                if ($o->isterkecil == '0') {
                    $m_sub_barang = $this->mm_sub_barang->get($o->id_sub_barang);
                    $o->qty_bom = floatval($m_sub_barang->hasil_konversi) * $o->qty_bom;
                    $o->id_satuan = $m_sub_barang->id_satuan_terkecil;
                }
                if ($o->id_bom_detail != "") {
                    unset($o->isterkecil);
                    unset($o->deleted_at);
                    $this->mt_bom_detail->update($o);
                } else {
                    $o->id_bom = $this->in->id_bom;
                    unset($o->isterkecil);
                    unset($o->deleted_at);
                    $this->mt_bom_detail->create($o);
                }
            }

            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if($status){
                $s->status = true;
                $s->message = 'Simpan data detail bom berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data detail bom gagal';
            }
            setNotification($this, $s);
            redirect('master/bom/workflow/'.$this->in->id_bom);
        } else if ($this->d->_action == 'delete'){
            modelLoad($this, array('mt_bom', 'mt_bom_workflow', 'mt_bom_detail'));

            $this->d->mt_bom = $this->mt_bom->get($arg2);
            if (intval($this->d->mt_bom->detail_count) > 0 || intval($this->d->mt_bom->detail_workflow) > 0) {
                $s = new stdClass();
                $s->status = false;
                $s->message = 'Hapus data BOM gagal. Workflow dan detail masih tersedia';
                setNotification($this, $s);
                redirect($this->d->_controller.'/'.$this->d->_method);
            }

            $this->db->trans_start();
            $this->mt_bom->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if($status){
                $s->status = true;
                $s->message = 'Hapus data BOM berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data BOM gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller.'/'.$this->d->_method);
        } else if ($this->d->_action == 'viewdt'){
            $res = $this->mt_bom->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'workflow_viewdt'){
            modelLoad($this, array('mt_bom_workflow'));
            $res = $this->mt_bom_workflow->viewDT($arg2, $this->in);
            printJSON($res);
        } else if ($this->d->_action == 'detail_viewdt'){
            modelLoad($this, array('mt_bom_detail'));
            $res = $this->mt_bom_detail->viewDT($arg2, $this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus'){
            $this->db->trans_start();
            $this->mt_bom->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if($status){
                $s->status = true;
                $s->message = 'Ubah status bom berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status bom gagal';
            }
            printJSON($s);
        } else if($this->d->_action == ''){

        }

        $this->load->view('template_view', $this->d);
    }
    
    function bom_detail($arg1="", $arg2="")
    {
        if(empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        modelLoad($this, array('mt_bom_detail'));
        if ($this->d->_action == 'viewjobdt'){
            modelLoad($this, array('mt_bom_detail'));
            $res = $this->mt_bom_detail->viewJobDT($this->in, false);
            printJSON($res);
        } else if($this->d->_action == ''){

        }

        $this->load->view('template_view', $this->d);
    }

    function getBOMqty($qty_bom_master, $qty_bom, $qty_rm)
    {
        return ($qty_rm * $qty_bom) / $qty_bom_master;
    }

    function bom_produksi($arg1 = "", $arg2 = "", $arg3 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        modelLoad($this, array('mt_bom_produksi', 'mt_bom'));
        if ($this->d->_action == 'add') {
            modelLoad($this, array('mt_bom'));
            $this->d->_modal = array('t_bom_master', 't_bom_produksi', 't_detail_so_bom');
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            modelLoad($this, array('mt_bom', 'mt_bom_workflow', 'mt_bom_detail', 'mt_job', 'mt_detail_job'));
            $input = a2o($this->in);
            $id_bom_master = $input->id_bom;
            /** GET DATA FROM BOM MASTER */
            $bom = $this->mt_bom->getMaster($id_bom_master);
            $bom->kode_bom = $this->mt_bom_produksi->generateCode(date('Y-m-d'));
            $qty_bom_master = floatval($bom->qty_master);
            $qty_bom = floatval($input->qty);
            $bom->qty = floatval($input->qty);
            $bom->qty_min_percent = $input->qty_min_percent;
            $bom->qty_max_percent = $input->qty_max_percent;
            $bom->id_detail_po = $input->id_detail_po;
            $bom->tanggal_bom = date('Y-m-d');
            $bom->tipe_bom = 'produksi';
			$bom->id_bom_master = $id_bom_master;
			$bom->is_rerun = $input->is_rerun;
            unset($bom->qty_master);
            $bom = a2o($bom);
            /** INPUT $bom to mt_bom */
            $id_bom = $this->mt_bom_produksi->create($bom);

            $bom_workflow = $this->mt_bom_workflow->getByBom($id_bom_master);
            $bom_workflow = a2o($bom_workflow);

            foreach ($bom_workflow as $bw) {
            	$nama_workflow = $bw->nama_workflow;
            	$nama_part = $bw->nama_part;
                $bw = a2o($bw);
                $bw->id_bom = $id_bom;
                $id_bom_workflow_master = $bw->id_bom_workflow;
				unset($bw->id_bom_workflow);
				unset($bw->nama_workflow);
				unset($bw->nama_part);
                /** INPUT BOM WORKFLOW */
                $id_bom_workflow = $this->mt_bom_workflow->create($bw);
                $bom_detail = $this->mt_bom_detail->getByBOMWorkflow($id_bom_master, $id_bom_workflow_master);

				$id_job = $this->mt_job->create(a2o(array(
					'no_job' => $bom->kode_bom." - ".$nama_workflow." : ".$nama_part,
					'id_bom' => $id_bom,
					'id_bom_workflow' => $id_bom_workflow,
					'tanggal_job' => date('Y-m-d'),
					'id_status' => '1'
				)));
                $bom_detail = a2o($bom_detail);
                foreach ($bom_detail as $bd) {
                    $bd->id_bom = $id_bom;
                    $bd->id_bom_workflow = $id_bom_workflow;
                    $qty_rm = $bd->qty_bom;
                    $bd->qty_bom = $this->getBOMqty($qty_bom_master, $qty_bom, $qty_rm);
                    /** INPUT BOM DETAIL */
                    $id_bom_detail = $this->mt_bom_detail->create($bd);

                    $id_detail_job = $this->mt_detail_job->create(a2o(array(
                    	'id_job' => $id_job,
						'id_bom_detail' => $id_bom_detail,
						'qty_job' => $bd->qty_bom,
						'id_status' => '1'
					)));
                }
            }
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data bom produksi berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data bom produksi gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->t_bom = $this->mt_bom_produksi->get($arg2);
            //printJSON($this->d->t_bom);
            $this->d->_modal = array('t_detail_so_bom');
        } else if ($this->d->_action == 'workflow') {
            modelLoad($this, array('mt_bom_workflow', 'mt_bom_detail'));
            $this->d->app = getAppSetting($this);
            $this->d->_modal = array('m_sub_barang');
            $this->d->t_bom = $this->mt_bom_produksi->get($arg2);
            $this->d->t_bom_workflow = $this->mt_bom_workflow->viewByBOM($arg2);
        } else if ($this->d->_action == 'instruction_edit') {
			modelLoad($this, array('mm_workflow', 'mt_bom_workflow', 'mt_bom_detail'));
			$this->d->m_workflow = $this->mm_workflow->view();
			$this->d->t_bom_workflow = $this->mt_bom_workflow->get($arg2);
			$this->d->t_bom = $this->mt_bom_produksi->get($this->d->t_bom_workflow->id_bom);
			$this->d->t_bom_detail = $this->mt_bom_detail->viewByBOMWorkflow($arg2);
		} else if ($this->d->_action == 'instruction_update') {
			modelLoad($this, array('mt_bom_workflow'));
			//printJSON($_POST);
			$this->db->trans_start();
			$t = $this->in;
			$t->note = isset($_POST['note']) ? $_POST['note'] : null;
			$this->mt_bom_workflow->update($t);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Update data Workflow BOM berhasil';
			} else {
				$s->status = false;
				$s->message = 'Update data Workflow BOM gagal';
			}
			setNotification($this, $s);
			redirect('master/bom_produksi/workflow/' . $t->id_bom);
		} else if ($this->d->_action == 'job') {
			$this->d->t_bom = $this->mt_bom_produksi->get($arg2);
		} else if ($this->d->_action == 'job_detail') {
			$this->d->_modal = array('t_bom_detail_job');
			$this->load->model('mt_detail_job');
			$this->d->t_job = $this->mt_job->get($arg2);
			$this->d->t_detail_job = $this->mt_detail_job->viewByJob($arg2);
		} else if ($this->d->_action == 'pi_print') {
            modelLoad($this, array('mt_bom_workflow', 'mt_bom_detail'));
            $this->d->app = getAppSetting($this);
            $this->d->_modal = array('m_sub_barang');
            $this->d->t_bom = $this->mt_bom_produksi->get($arg2);
            $this->d->t_bom_workflow = $this->mt_bom_workflow->viewByBOM($arg2);
        } else if ($this->d->_action == 'bom_print') {
            modelLoad($this, array('mt_bom_workflow', 'mt_bom_detail'));
            $this->d->_modal = array('m_sub_barang');
            $this->d->app = getAppSetting($this);
            $this->d->t_bom = $this->mt_bom_produksi->get($arg2);
            $this->d->t_bom_workflow = $this->mt_bom_workflow->viewByBOM($arg2);
        } else if ($this->d->_action == 'spk_print') {
            modelLoad($this, array('mt_bom_workflow', 'mt_bom_detail'));
            $this->d->_modal = array('m_sub_barang');
            $this->d->app = getAppSetting($this);
            $this->d->notes = $this->mt_bom_workflow->viewSPK($arg2, $arg3);
            $id_bom = $nama_workflow = '';
            foreach ($this->d->notes as $r) {
                $r = a2o($r);
                $id_bom = $r->id_bom;
                $nama_workflow = $r->nama_workflow;
            }
            $this->d->t_bom = $this->mt_bom_produksi->get($id_bom);
            $this->d->t_bom_workflow = $this->mt_bom_workflow->viewByBOM($arg2);
            $this->d->nama_workflow = $nama_workflow;
        } else if ($this->d->_action == 'all_spk_print') {
			modelLoad($this, array('mt_bom_workflow', 'mt_bom_detail'));
			$this->d->_modal = array('m_sub_barang');
			$this->d->app = getAppSetting($this);
			$this->d->t_bom = $this->mt_bom_produksi->get($arg2);
			$m_workflow = $this->mt_bom_workflow->viewByBOM($arg2);
			foreach ($m_workflow as $key => $workflow) {
				$rincian = json_decode($workflow->rincian);
				$m_workflow[$key]->t_bom_workflow = array();
				foreach ($rincian as $key2 =>$t_bom_workflow) {
					array_push($m_workflow[$key]->t_bom_workflow, a2o(array(
						'id_bom_workflow' => $t_bom_workflow->id_bom_workflow,
						'nama_bagian' => $t_bom_workflow->nama_bagian,
						'note' => $this->mt_bom_workflow->get($t_bom_workflow->id_bom_workflow)->note
					)));
				}
				unset($m_workflow[$key]->rincian);
			}
			$this->d->m_workflow = $m_workflow;
			//printJSON($this->d->m_workflow);
		} else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mt_bom_produksi->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data bom produksi berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data bom produksi gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mt_bom_produksi->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data bom produksi berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data bom produksi gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mt_bom_produksi->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mt_bom_produksi->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status bom produksi berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status bom produksi gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == 'select2') {
			$res = $this->mt_bom_produksi->select2($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }

	function bom_workflow($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this, array('mt_bom_workflow'));
		if ($this->d->_action == 'select2') {
			$res = $this->mt_bom_workflow->select2($this->in);
			printJSON($res);
		} else if ($this->d->_action == '') {
		}
		$this->load->view('template_view', $this->d);
	}

    function grup_akun($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        modelLoad($this, array('mm_grup_akun'));
        if ($this->d->_action == 'add') {
            modelLoad($this, array('mm_jenis_laporan_keuangan'));
            $this->d->sjenis_laporan_keuangan = $this->mm_jenis_laporan_keuangan->view();

        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $this->mm_grup_akun->create($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data grup akun berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data grup akun gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_grup_akun->get($arg2);
            modelLoad($this, array('mm_jenis_laporan_keuangan'));
            $this->d->sjenis_laporan_keuangan = $this->mm_jenis_laporan_keuangan->view();
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_grup_akun->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data grup akun berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data grup akun gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_grup_akun->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data grup akun berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data grup akun gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_grup_akun->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_grup_akun->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status grup akun berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status grup akun gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }

    function barang_asli($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        modelLoad($this, array('mm_barang', 'mm_sub_barang', 'mm_kategori', 'mm_asal_fasilitas', 'mm_fasilitas', 'mreferensi_satuan', 'mm_class', 'mm_barang', 'mm_style', 'mreferensi_asal_barang', 'mreferensi_kemasan', 'mm_brand'));
        if ($this->d->_action == 'add') {
            $this->d->_modal = array('referensi_satuan', 'referensi_kemasan');
            $this->d->scategory = $this->mm_kategori->view();
            $this->d->sclass = $this->mm_class->view();
            $this->d->sfasilitas = $this->mm_fasilitas->view();
            $this->d->sasal = $this->mm_asal_fasilitas->view();
            $this->d->sbrand = $this->mm_brand->view();
            $this->d->sstyle = $this->mm_style->view();
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
			$child = 0;
			$t = a2o($this->in->m_barang);
			$t->id_status = 1;

            if (isset($this->in->havingchild)) $child = $this->in->havingchild;

            $id = $this->mm_barang->create($t);
            if (!$child) {
                $sub = (object) array_merge((array) $t, (array) $this->in->m_sub_barang);
                $sub->id_barang = $id;
                $this->mm_sub_barang->create($sub);
            }
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data barang berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data barang gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_barang->get($arg2);
            $this->d->_modal = array('referensi_satuan', 'referensi_kemasan');
            $this->d->scategory = $this->mm_kategori->view();
            $this->d->sclass = $this->mm_class->view();
            $this->d->sfasilitas = $this->mm_fasilitas->view();
            $this->d->sasal = $this->mm_asal_fasilitas->view();
            $this->d->sbrand = $this->mm_brand->view();
            $this->d->sstyle = $this->mm_style->view();
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_barang->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data barang berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data barang gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_barang->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data barang berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data barang gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_barang->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_barang->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status barang berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status barang gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }

    function barang($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_sub_barang');
        if ($this->d->_action == 'add') {
            $this->d->_modal = array('m_barang', 'referensi_satuan', 'm_kategori', 'm_hs');
            modelLoad($this, array('mreferensi_asal_barang', 'mm_brand', 'mm_class', 'mm_style'));
            $this->d->sasal_barang = $this->mreferensi_asal_barang->view();
            $this->d->sbrand = $this->mm_brand->view();
            $this->d->sclass = $this->mm_class->view();
            $this->d->sstyle = $this->mm_style->view();
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_sub_barang->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data barang berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data barang gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->_modal = array('m_barang', 'referensi_satuan', 'm_kategori', 'm_hs');
            modelLoad($this, array('mreferensi_asal_barang', 'mm_brand', 'mm_class', 'mm_style'));
            $this->d->sasal_barang = $this->mreferensi_asal_barang->view();
            $this->d->sbrand = $this->mm_brand->view();
            $this->d->sclass = $this->mm_class->view();
            $this->d->sstyle = $this->mm_style->view();
            $this->d->data = $this->mm_sub_barang->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            // printJSON($this->in);
            $this->mm_sub_barang->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data barang berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data barang gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_sub_barang->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data barang berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data barang gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_sub_barang->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'viewdtfg') {
            $res = $this->mm_sub_barang->viewDTFG($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_sub_barang->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status barang berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status barang gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == 'getSelect') {
            $search = $this->input->get('q');
            $res = $this->mm_sub_barang->getSelect($search);
            printJSON($res);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }

    function asal_fasilitas($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        modelLoad($this, array('mm_asal_fasilitas'));
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_asal_fasilitas->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data asal fasilitas berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data asal fasilitas gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_asal_fasilitas->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_asal_fasilitas->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data asal fasilitas berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data asal fasilitas gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_asal_fasilitas->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data asal fasilitas berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data asal fasilitas gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_asal_fasilitas->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_asal_fasilitas->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status asal fasilitas berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status asal fasilitas gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }
    //hskajka

    function brand($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_brand');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_brand->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data brand berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data brand gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_brand->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_brand->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data brand berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data brand gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_brand->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data brand berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data brand gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_brand->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_brand->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status brand berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status brand gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }
    function kategori($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_kategori');
        if ($this->d->_action == 'add') {
            modelLoad($this, array('mm_sbu'));

            $this->d->ssbu = $this->mm_sbu->view();
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_kategori->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data kategori berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data kategori gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            modelLoad($this, array('mm_sbu'));

            $this->d->ssbu = $this->mm_sbu->view();
            $this->d->data = $this->mm_kategori->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_kategori->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data kategori berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data kategori gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_kategori->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data kategori berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data kategori gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_kategori->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_kategori->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status kategori berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status kategori gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }

    function part($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_part');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $this->mm_part->create($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data part berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data part gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_part->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data part berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data part gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_part->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data part berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data part gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_part->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_part->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status part berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status part gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }

    function point($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_point');
        if ($this->d->_action == 'add') {
            modelLoad($this, array('mm_workflow', 'mm_part'));
            $this->d->workflow = $this->mm_workflow->view();
            $this->d->part = $this->mm_part->view();
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $this->mm_point->create($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data point berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data point gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            modelLoad($this, array('mm_point', 'mm_workflow', 'mm_part'));
            $this->d->point = $this->mm_point->get($arg2);
            $this->d->workflow = $this->mm_workflow->view();
            $this->d->part = $this->mm_part->view();
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_point->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data point berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data point gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_point->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data point berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data point gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_point->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_point->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status point berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status point gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }

    function akun($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_akun');
        if ($this->d->_action == 'add') {
            modelLoad($this, array('mm_grup_akun', 'mm_tipe_akun'));
            $this->d->sgrup_akun = $this->mm_grup_akun->view();
            $this->d->stipe_akun = $this->mm_tipe_akun->view();
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_akun->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data akun berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data akun gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_akun->get($arg2);
            modelLoad($this, array('mm_grup_akun', 'mm_tipe_akun'));
            $this->d->sgrup_akun = $this->mm_grup_akun->view();
            $this->d->stipe_akun = $this->mm_tipe_akun->view();
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_akun->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data akun berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data akun gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_akun->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data akun berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data akun gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_akun->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'getselect') {
            $search = $this->input->get('search');
            $res = $this->mm_akun->getSelect($search);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_akun->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status akun berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status akun gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == 'select2') {
            $res = $this->mm_akun->select2($this->in);
            printJSON($res);
        }

        $this->load->view('template_view', $this->d);
    }

    function kemasan($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mreferensi_kemasan');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'select2') {
            $res = $this->mreferensi_kemasan->select2($this->in);
            printJSON($res);
        }

        $this->load->view('template_view', $this->d);
    }

    function clas($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_class');
        if ($this->d->_action == 'add') {
            modelLoad($this, array('mm_jenis_laporan'));
            $this->d->_modal = array('m_akun', 'm_akun_lawan');
            $this->d->sjenis_laporan = $this->mm_jenis_laporan->view();
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_class->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data class berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data class gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_class->get($arg2);
            modelLoad($this, array('mm_jenis_laporan'));
            $this->d->_modal = array('m_akun', 'm_akun_lawan');
            $this->d->sjenis_laporan = $this->mm_jenis_laporan->view();
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_class->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data class berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data class gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_class->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data class berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data class gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_class->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_class->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status class berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status class gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }
    function konversi($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_konversi');
        if ($this->d->_action == 'add') {
            $this->d->_modal = array('m_sub_barang', 'referensi_satuan');
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_konversi->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data konversi berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data konversi gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->_modal = array('m_sub_barang', 'referensi_satuan');
            $this->d->data = $this->mm_konversi->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_konversi->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data konversi berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data konversi gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_konversi->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data konversi berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data konversi gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_konversi->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_konversi->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status konversi berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status konversi gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }

    function mutasi($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_mutasi');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_mutasi->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data mutasi berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data mutasi gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_mutasi->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_mutasi->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data mutasi berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data mutasi gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_mutasi->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data mutasi berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data mutasi gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_mutasi->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_mutasi->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status mutasi berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status mutasi gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }

    function tipe_akun($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_tipe_akun');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_tipe_akun->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data tipe akun berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data tipe akun gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_tipe_akun->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_tipe_akun->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data tipe akun berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data tipe akun gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_tipe_akun->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data tipe akun berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data tipe akun gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_tipe_akun->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_tipe_akun->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status tipe_akun berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status tipe_akun gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }

    function jenis_job($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_jenis_job');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_jenis_job->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data jenis job berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data jenis job gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_jenis_job->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_jenis_job->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data jenis job berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data jenis job gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_jenis_job->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data jenis job berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data jenis job gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_jenis_job->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_jenis_job->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status jenis job berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status jenis job gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }

    function jenis_laporan($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_jenis_laporan');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_jenis_laporan->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data jenis laporan berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data jenis laporan gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_jenis_laporan->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_jenis_laporan->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data jenis laporan berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data jenis laporan gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_jenis_laporan->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data jenis laporan berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data jenis laporan gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_jenis_laporan->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_jenis_laporan->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status jenis laporan berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status jenis laporan gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }

    function manager_plant($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_manager_plant');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_manager_plant->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data manager plant berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data manager plant gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_manager_plant->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_manager_plant->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data manager plant berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data manager plant gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_manager_plant->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data manager plant berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data manager plant gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_manager_plant->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_manager_plant->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status manager plant berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status manager plant gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }

    function sbu($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_sbu');
        if ($this->d->_action == 'add') {
            modelLoad($this, array('mm_manager_plant'));
            $this->d->smanager_plant = $this->mm_manager_plant->view();
        } else if ($this->d->_action == 'store') {
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

    function sub_barang($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_sub_barang');
        if ($this->d->_action == 'add') {
            $this->d->_modal = array('m_barang', 'referensi_satuan', 'm_kategori', 'm_hs');
            modelLoad($this, array('mreferensi_asal_barang', 'mm_brand', 'mm_class', 'mm_style'));
            $this->d->sasal_barang = $this->mreferensi_asal_barang->view();
            $this->d->sbrand = $this->mm_brand->view();
            $this->d->sclass = $this->mm_class->view();
            $this->d->sstyle = $this->mm_style->view();
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_sub_barang->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data sub barang berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data sub barang gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->_modal = array('m_barang', 'referensi_satuan', 'm_kategori');
            modelLoad($this, array('mreferensi_asal_barang', 'mm_brand', 'mm_class', 'mm_style'));
            $this->d->sasal_barang = $this->mreferensi_asal_barang->view();
            $this->d->sbrand = $this->mm_brand->view();
            $this->d->sclass = $this->mm_class->view();
            $this->d->sstyle = $this->mm_style->view();
            $this->d->data = $this->mm_sub_barang->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_sub_barang->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data sub barang berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data sub barang gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_sub_barang->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data sub barang berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data sub barang gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_sub_barang->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'viewdtfg') {
            $res = $this->mm_sub_barang->viewDTFG($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_sub_barang->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status sub barang berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status sub barang gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == 'getSelect') {
            $search = $this->input->get('q');
            $res = $this->mm_sub_barang->getSelect($search);
            printJSON($res);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }

    function gudang($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_gudang');
        modelLoad($this, array('mm_gudang', 'mm_koordinat'));
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_gudang->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data gudang berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data gudang gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_gudang->get($arg2);
        } else if ($this->d->_action == 'koordinat') {
            $this->d->m_gudang = $this->mm_gudang->get($arg2);
        } else if ($this->d->_action == 'koordinat_add') {
            $this->d->m_gudang = $this->mm_gudang->get($arg2);
        } else if ($this->d->_action == 'koordinat_store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_koordinat->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data koordinat gudang berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data koordinat gudang gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method . '/koordinat/' . $t->id_gudang);
        } else if ($this->d->_action == 'koordinat_edit') {
            $this->d->m_koordinat = $this->mm_koordinat->get($arg2);
            $this->d->m_gudang = $this->mm_gudang->get($this->d->m_koordinat->id_gudang);
        } else if ($this->d->_action == 'koordinat_update') {
            $this->db->trans_start();
            $this->mm_koordinat->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data koordinat gudang berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data koordinat gudang gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method . '/koordinat/' . $this->in->id_gudang);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_gudang->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data gudang berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data gudang gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_gudang->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data gudang berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data gudang gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_gudang->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'viewkoordinatdt') {
            $res = $this->mm_koordinat->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_gudang->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status gudang berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status gudang gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }
        $this->load->view('template_view', $this->d);
    }

    function job($arg1="", $arg2="")
    {
        if(empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        modelLoad($this, array('mt_job','mt_detail_job','mt_so','mt_bom'));
        if($this->d->_action == 'add'){
            $this->d->_modal = array('t_bom');
            $bom = $this->mt_bom->get($arg2);
            $id_po = $bom->id_po;
            $job = $this->mt_so->getJobBySO($id_po);
            $this->d->no_job = $job->nojob;
            $this->d->t_bom = $this->mt_bom->get($arg2);
        } else if($this->d->_action == 'store'){
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            // $year = substr(date('Y'), -2);
            // $month = date('m');
            // $prefix = 'AL'.$year.''.$month;
            // $t->no_job = $this->mt_job->generateCode($prefix);
            // printJSON($t);
            // die();
            $t->tanggal_job = reverseDate($t->tanggal_job);
            $t->due_date = reverseDate($t->due_date);
            $id_job = $this->mt_job->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if($status){
                $s->status = true;
                $s->message = 'Simpan data job berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data job gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller.'/'.$this->d->_method.'/detail/'.$id_job);
        } else if($this->d->_action == 'edit'){
            $this->d->_modal = array('t_bom');
            $this->d->data = $this->mt_job->get($arg2);
            $this->d->t_bom = $this->mt_bom->get($this->d->data->id_bom);
        } else if($this->d->_action == 'detail'){
            $this->d->_modal = array('t_bom_detail_job');
            $this->load->model('mt_detail_job');
            $this->d->t_job = $this->mt_job->get($arg2);
            $this->d->t_detail_job = $this->mt_detail_job->viewByJob($arg2);
        } else if($this->d->_action == 'update'){
            $this->db->trans_start();
            $t = $this->in;
            $t->tanggal_job = reverseDate($t->tanggal_job);
            $t->due_date = reverseDate($t->due_date);
            $this->mt_job->update($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if($status){
                $s->status = true;
                $s->message = 'Ubah data job berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data job gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller.'/'.$this->d->_method);
        } else if($this->d->_action == 'delete'){
            $this->d->t_job = $this->mt_job->get($arg2);

            if ($this->d->t_job->detail_count > 0) {
                $s = new stdClass();
                $s->status = false;
                $s->message = 'Detail job masih ada';
            } else {
                $this->db->trans_start();
                $this->mt_job->delete($arg2);
                $this->db->trans_complete();
                $status = $this->db->trans_status();
                $s = new stdClass();
                if($status){
                    $s->status = true;
                    $s->message = 'Hapus data job berhasil';
                } else {
                    $s->status = false;
                    $s->message = 'Hapus data job gagal';
                }
            }
            setNotification($this, $s);
            redirect($this->d->_controller.'/'.$this->d->_method);
        } else if ($this->d->_action == 'detail_update') {
            $this->db->trans_start();
            $t_job = a2o($this->in->t_job);
            $t_detail_job = a2o($this->in->t_detail_job);
            // printJSON($t_detail_job->id_bom_detail);
			$this->mt_job->update($t_job);
            foreach ($this->in->t_detail_job as $r) {
                $o = a2o($r);
                if ($o->id_detail_job != "") {
                    $o->id_job = $t_job->id_job;
                    $this->mt_detail_job->update($o);
                } else {
                    $o->id_job = $t_job->id_job;
                    // $o->id_bom_detail = $t_detail_job->id_bom_detail;
                    // $o->id_job = $this->in->id_job;
                    // unset($o->id_bom_detail);
                    $this->mt_detail_job->create($o);
                }
            }

            $deleted_detail_job = json_decode(stripslashes($this->in->deleted_detail_job));
            foreach($deleted_detail_job as $v){
                $this->mt_detail_job->delete($v);
            }
            
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if($status){
                $s->status = true;
                $s->message = 'Simpan data detail job berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data detail job gagal';
            }
            setNotification($this, $s);
            redirect('master/job/detail/'.$t_job->id_job);
        } else if ($this->d->_action == 'viewdt'){
            $res = $this->mt_job->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'viewpackingdt'){
            $res = $this->mt_job->viewPackingDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus'){
            $this->db->trans_start();
                $this->mt_job->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if($status){
                $s->status = true;
                $s->message = 'Ubah status job berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status job gagal';
            }
            printJSON($s);
        } else if($this->d->_action == ''){

        }

        $this->load->view('template_view', $this->d);
    }
    
    function jenis_pp($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_jenis_pp');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_jenis_pp->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data jenis pp berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data jenis pp gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_jenis_pp->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_jenis_pp->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data jenis pp berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data jenis pp gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_jenis_pp->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data jenis pp berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data jenis pp gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_jenis_pp->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_jenis_pp->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status jenis_pp berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status jenis_pp gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }
    function jenis_pp_rutinitas($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_jenis_pp_rutinitas');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_jenis_pp_rutinitas->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data jenis pp rutinitas berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data jenis pp rutinitas gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_jenis_pp_rutinitas->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_jenis_pp_rutinitas->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data jenis pp rutinitas berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data jenis pp rutinitas gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_jenis_pp_rutinitas->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data jenis pp rutinitas berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data jenis pp rutinitas gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_jenis_pp_rutinitas->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status jenis pp rutinitas berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status jenis pp rutinitas gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_jenis_pp_rutinitas->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }
    function bagian($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_bagian');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_bagian->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data bagian berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data bagian gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_bagian->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_bagian->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data bagian berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data bagian gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_bagian->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data bagian berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data bagian gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_bagian->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_bagian->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status bagian berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status bagian gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }
    function hs($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_hs');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_hs->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data HS berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data HS gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_hs->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_hs->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data HS berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data HS gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_hs->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data HS berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data HS gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_hs->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_hs->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status HS berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status HS gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }
    function fasilitas($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_fasilitas');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_fasilitas->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data fasilitas berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data fasilitas gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_fasilitas->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_fasilitas->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data fasilitas berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data fasilitas gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_fasilitas->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data fasilitas berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data fasilitas gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_fasilitas->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_fasilitas->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status fasilitas berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status fasilitas gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }
    function jenis_mutasi($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_jenis_mutasi');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_jenis_mutasi->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data jenis mutasi berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data jenis mutasi gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_jenis_mutasi->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_jenis_mutasi->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data jenis mutasi berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data jenis mutasi gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_jenis_mutasi->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data jenis mutasi berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data jenis mutasi gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_jenis_mutasi->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_jenis_mutasi->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status jenis mutasi berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status jenis mutasi gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }
    function asset($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_asset');
        if ($this->d->_action == 'add') {
            $this->d->_modal = array('m_sub_barang');
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_asset->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data asset berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data asset gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->_modal = array('m_sub_barang');
            $this->d->data = $this->mm_asset->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_asset->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data asset berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data asset gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_asset->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data asset berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data asset gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_asset->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_asset->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status asset berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status asset gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }
    function mesin($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_mesin');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_mesin->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data mesin berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data mesin gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_mesin->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_mesin->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data mesin berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data mesin gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_mesin->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data mesin berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data mesin gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_mesin->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_mesin->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status mesin berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status mesin gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }
    function style($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_style');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_style->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data style berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data style gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_style->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_style->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data style berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data style gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_style->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data style berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data style gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_style->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_style->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status style berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status style gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }
    function status($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_status');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $this->mm_status->create($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data status berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data status gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_status->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_status->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data status berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data status gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_status->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data status berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data status gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_status->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_status->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }
    function workflow($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_workflow');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_workflow->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data workflow berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data workflow gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_workflow->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_workflow->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data workflow berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data workflow gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_workflow->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data workflow berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data workflow gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_workflow->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_workflow->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status workflow berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status workflow gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }
    function tipe_depresiasi($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_tipe_depresiasi');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_tipe_depresiasi->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data tipe depresiasi berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data tipe depresiasi gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_tipe_depresiasi->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_tipe_depresiasi->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data tipe depresiasi berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data tipe depresiasi gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_tipe_depresiasi->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data tipe depresiasi berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data tipe depresiasi gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_tipe_depresiasi->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_tipe_depresiasi->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status tipe depresiasi berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status tipe depresiasi gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }
    function tipe_sales($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_tipe_sales');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_tipe_sales->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data tipe sales berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data tipe sales gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_tipe_sales->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_tipe_sales->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data tipe sales berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data tipe sales gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_tipe_sales->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data tipe sales berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data tipe sales gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_tipe_sales->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_tipe_sales->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status tipe sales berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status tipe sales gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }
    function detail_supplier_destination($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_detail_supplier_destination');
        if ($this->d->_action == 'add') {
            $this->d->_modal = array('referensi_pemasok', 'referensi_negara');
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_detail_supplier_destination->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data detail supplier destination berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data detail supplier destination gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->_modal = array('referensi_pemasok', 'referensi_negara');
            $this->d->data = $this->mm_detail_supplier_destination->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_detail_supplier_destination->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data detail supplier destination berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data detail supplier destination gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_detail_supplier_destination->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data destil supplier destination berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data detail supplier destination gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_detail_supplier_destination->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_detail_supplier_destination->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status detail supplier destination berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status detail supplier destination gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }

    function no_doc($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_no_doc');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->id_status = 1;
            $this->mm_no_doc->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data nomor dokumen berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data nomor dokumen gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_no_doc->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data nomor dokumen berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data nomor dokumen gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_no_doc->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data nomor dokumen berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data nomor dokumen gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_no_doc->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_no_doc->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status nomor dokumen berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status nomor dokumen gagal';
            }
            printJSON($s);
        } else if ($this->d->_action == '') {
        }

        $this->load->view('template_view', $this->d);
    }
    function customer($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_customer');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->kode_customer = $this->mm_customer->generateCode($t->job_prefix);
            $this->mm_customer->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data customer berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data customer gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_customer->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_customer->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data customer berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data customer gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_customer->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data customer berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data customer gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_customer->viewDT($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_customer->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status beneficiary akun berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status beneficiary akun gagal';
            }
            printJSON($s);
        } else if($this->d->_action == 'select2'){
			$res = $this->mm_customer->select2();
			printJSON($res);
		} else if ($this->d->_action == 'getselect') {
            $search = $this->input->get('search');
            $res = $this->mm_customer->getSelect($search);
            printJSON($res);
        }
        $this->load->view('template_view', $this->d);
    }

    function customer_suplier($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_customer_suplier');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->job_prefix = strtoupper($t->job_prefix);
            if($t->tipe == 'CUSTOMER'){
                $kode = 'CUS';
            }else{
                $kode = 'SUP';
            }
            $t->kode_customer = $this->mm_customer_suplier->generateCode($t->job_prefix, $kode);
            // $t->kode_customer = $this->mm_customer_suplier->generateCode($t->job_prefix);
            $this->mm_customer_suplier->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data customer berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data customer gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_customer_suplier->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_customer_suplier->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data customer berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data customer gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_customer_suplier->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data customer berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data customer gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdtcustomer') {
            $res = $this->mm_customer_suplier->viewDTCustomer($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'viewdtsupplier') {
            $res = $this->mm_customer_suplier->viewDTSupplier($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'changeStatus') {
            $this->db->trans_start();
            $this->mm_customer_suplier->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah status beneficiary akun berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah status beneficiary akun gagal';
            }
            printJSON($s);
        } else if($this->d->_action == 'select2'){
			$res = $this->mm_customer_suplier->select2();
			printJSON($res);
		} else if ($this->d->_action == 'getselectcustomer') {
            $search = $this->input->get('q');
            $res = $this->mm_customer_suplier->getSelectCustomer($search);
            printJSON($res);
        }
        $this->load->view('template_view', $this->d);
    }
    function rates($arg1="", $arg2="")
    {
        if(empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        modelLoad($this, array('mm_rates'));
        if($this->d->_action == 'add'){
            $this->d->_modal = array('referensi_valuta');
        } else if($this->d->_action == 'store'){
			$this->db->trans_start();
			$this->mm_rates->create($this->in);

			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if($status){
				$s->status = true;
				$s->message = 'Simpan data Rates berhasil';
			} else {
				$s->status = false;
				$s->message = 'Simpan data Rates gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller.'/'.$this->d->_method);
        } else if($this->d->_action == 'viewdt'){
            $res = $this->mm_rates->viewDT($this->in);
            printJSON($res);
        }

        $this->load->view('template_view', $this->d);
    }

    function supplier($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_supplier');
        $this->load->model('mm_customer_suplier');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->kode_suplier = $this->mm_supplier->generateCode($t->job_prefix);
            $this->mm_supplier->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data akun berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data akun gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_customer_suplier->viewDTSupplier($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_supplier->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_supplier->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data supplier berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data supplier gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_supplier->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data supplier berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data supplier gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        }
        $this->load->view('template_view', $this->d);
    }
    function supplierdocout($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_supplier');
        $this->load->model('mm_customer_suplier');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->kode_suplier = $this->mm_supplier->generateCode($t->job_prefix);
            $this->mm_supplier->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data akun berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data akun gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_customer_suplier->viewDTSupplierDocOut($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_supplier->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_supplier->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data supplier berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data supplier gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_supplier->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data supplier berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data supplier gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        }
        $this->load->view('template_view', $this->d);
    }
    function supplierrn($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_supplier');
        $this->load->model('mm_customer_suplier');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->kode_suplier = $this->mm_supplier->generateCode($t->job_prefix);
            $this->mm_supplier->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data akun berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data akun gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_customer_suplier->viewDTSupplierRn($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_supplier->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_supplier->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data supplier berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data supplier gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_supplier->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data supplier berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data supplier gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        }
        $this->load->view('template_view', $this->d);
    }
    function supplierdocin($arg1 = "", $arg2 = "")
    {
        if (empty($arg1)) $this->d->_action = 'view';
        else $this->d->_action = $arg1;

        $this->load->model('mm_supplier');
        $this->load->model('mm_customer_suplier');
        if ($this->d->_action == 'add') {
        } else if ($this->d->_action == 'store') {
            $this->db->trans_start();
            $t = $this->in;
            $t->kode_suplier = $this->mm_supplier->generateCode($t->job_prefix);
            $this->mm_supplier->create($t);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Simpan data akun berhasil';
            } else {
                $s->status = false;
                $s->message = 'Simpan data akun gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'viewdt') {
            $res = $this->mm_customer_suplier->viewDTSupplierDocIn($this->in);
            printJSON($res);
        } else if ($this->d->_action == 'edit') {
            $this->d->data = $this->mm_supplier->get($arg2);
        } else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mm_supplier->update($this->in);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Ubah data supplier berhasil';
            } else {
                $s->status = false;
                $s->message = 'Ubah data supplier gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        } else if ($this->d->_action == 'delete') {
            $this->db->trans_start();
            $this->mm_supplier->delete($arg2);
            $this->db->trans_complete();
            $status = $this->db->trans_status();
            $s = new stdClass();
            if ($status) {
                $s->status = true;
                $s->message = 'Hapus data supplier berhasil';
            } else {
                $s->status = false;
                $s->message = 'Hapus data supplier gagal';
            }
            setNotification($this, $s);
            redirect($this->d->_controller . '/' . $this->d->_method);
        }
        $this->load->view('template_view', $this->d);
    }
}
