<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migrasi extends CI_Controller
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

	function setting_tpb($arg1 = "", $arg2 = "")
	{
		if (empty($arg1)) $this->d->_action = 'view';
		else $this->d->_action = $arg1;

		modelLoad($this,(array('mmigration_setting_tpb')));
		if ($this->d->_action == 'view') {
            $this->d->_tpbsetting = $this->mmigration_setting_tpb->view();
		} else if ($this->d->_action == 'update') {
            $this->db->trans_start();
            $this->mmigration_setting_tpb->update($this->in);
			$this->db->trans_complete();
			$status = $this->db->trans_status();
			$s = new stdClass();
			if ($status) {
				$s->status = true;
				$s->message = 'Setting DB TPB berhasil';
			} else {
				$s->status = false;
				$s->message = 'Setting DB TPB gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		}

		$this->load->view('template_view', $this->d);
    }
	
	function data_tpb($arg1 = "", $arg2 = "")
	{

		if (empty($arg1)) $this->d->_action = 'view';

		else $this->d->_action = $arg1;

		modelLoad($this,(array('mmigration_setting_tpb','mmigration_data_tpb','mreferensi_dokumen_pabean')));
		$datacon = $this->mmigration_setting_tpb->view();
		if ($this->d->_action == 'view') {
			$local = $this->mmigration_data_tpb->viewTPBLocal($datacon);
			$online = $this->mmigration_data_tpb->viewTPBOnline();
			$this->d->_tpbsetting = $datacon;
			$this->d->_tpblocal = $local;
			$this->d->_tpbonline = $online;
			$this->d->_checkData = checkData($local,$online);
		} else if ($this->d->_action == 'sync') {
            $h_asal = $datacon->iphost;
			$u_asal = $datacon->username;
			$p_asal = $datacon->pass;
			$d_asal = $datacon->db;
			$tbl = "tpb_bahan_baku tpb_bahan_baku_dokumen tpb_bahan_baku_tarif tpb_barang tpb_barang_dokumen tpb_barang_penerima tpb_barang_tarif tpb_detil_status tpb_dokumen tpb_header tpb_jaminan tpb_kemasan tpb_kontainer tpb_npwp_billing tpb_penerima tpb_pungutan tpb_respon";

			$h_tujuan = $this->db->hostname;
			$u_tujuan = $this->db->username;
			$p_tujuan = $this->db->password;
			$d_tujuan = getdbtpb($this);

			$command = "mysqldump --user={$u_asal} --password={$p_asal} --host={$h_asal} {$d_asal} {$tbl} | mysql --user={$u_tujuan} --password={$p_tujuan} --host={$h_tujuan} {$d_tujuan}";
			exec($command,$output,$return);
			$s = new stdClass();
			if ($return = 0) {
				$s->status = true;
				$s->message = 'Syncronize Data TPB berhasil';
			} else {
				$s->status = false;
				$s->message = 'Syncronize Data TPB gagal';
			}
			setNotification($this, $s);
			redirect($this->d->_controller . '/' . $this->d->_method);
		}

		$this->load->view('template_view', $this->d);
	}

	function backup_restore($arg1 = "", $arg2 = "")
	{

		if (empty($arg1)) $this->d->_action = 'view';

		else $this->d->_action = $arg1;

		
		
		if ($this->d->_action == 'view') {
			$files = glob('backup/APP*',GLOB_BRACE);
			$data = array();
			$i = 1;
			foreach ($files as $row) {
				$rpc1 = str_replace("backup/APP-","",$row);
				$rpc2 = str_replace(".sql.gz","",$rpc1);
				$split = explode("_",$rpc2);
				$date = date('Y-m-d',strtotime($split[0]));
				$time = date('H:i:s',strtotime($split[1]));
				$r = new stdClass();
				$r->no = $i;
				$r->datetime = $date." at ".$time;
				$r->option = '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Restore" data-body="Do you want to restore this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/restore/'.$rpc1).'" class="btn btn-xs btn-success"><i class="fal fa fa-upload"></i></a>';
				$data[] = $r;
				unset($r);
				$i++;
			}
			$this->d->_backupdata = a2o($data);
		} else if ($this->d->_action == 'restore') {
			$files = glob('backup/*'.$arg2,GLOB_BRACE);
			foreach ($files as $row) {
				$check = getStringBetween($row,'/','-');
				$h_tujuan = $this->db->hostname;
				$u_tujuan = $this->db->username;
				$p_tujuan = $this->db->password;
				switch ($check) {
					case 'APP':
						$d_tujuan = $this->db->database;
						break;
					case 'TPB':
						$d_tujuan = getdbtpb($this);
						break;
					case 'PEB':
						$d_tujuan = getdbpeb($this);
						break;
					default:
						break;
				}
				$d_tujuan = '';

				$command = "gunzip --keep {$row} | mysql --user={$u_tujuan} --password={$p_tujuan} --host={$h_tujuan} {$d_tujuan}";
				exec($command,$output,$return);
				$rm = str_replace('.gz','',$row);
				exec("rm {$rm}");
				$s = new stdClass();
				if ($return = 0) {
					$s->status = true;
					$s->message = 'Restore Data berhasil';
				} else {
					$s->status = false;
					$s->message = 'Restore Data gagal';
				}
				setNotification($this, $s);
				redirect($this->d->_controller . '/' . $this->d->_method);
			}
		}
		$this->load->view('template_view', $this->d);
    }
}

function getStringBetween($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function checkData($local, $online){
	$return = new stdClass();
	if ($local->tpb_bahan_baku != $online->tpb_bahan_baku) {
		$return->button = "<a href='".base_url('migrasi/data_tpb/sync')."' class='btn btn-sm btn-primary'><i class='fal fa-sync'></i> Sync Now</a>";
		$return->view = "<button type='button' disabled class='btn btn-danger btn-sm btn-pills waves-effect waves-themed'><i class='fal fa-exclamation-triangle'></i> Not Sync</button>";
		return $return;
	}
	if ($local->tpb_bahan_baku_dokumen != $online->tpb_bahan_baku_dokumen) {
		$return->button = "<a href='".base_url('migrasi/data_tpb/sync')."' class='btn btn-sm btn-primary'><i class='fal fa-sync'></i> Sync Now</a>";
		$return->view = "<button type='button' disabled class='btn btn-danger btn-sm btn-pills waves-effect waves-themed'><i class='fal fa-exclamation-triangle'></i> Not Sync</button>";
		return $return;
	}
	if ($local->tpb_bahan_baku_tarif != $online->tpb_bahan_baku_tarif) {
		$return->button = "<a href='".base_url('migrasi/data_tpb/sync')."' class='btn btn-sm btn-primary'><i class='fal fa-sync'></i> Sync Now</a>";
		$return->view = "<button type='button' disabled class='btn btn-danger btn-sm btn-pills waves-effect waves-themed'><i class='fal fa-exclamation-triangle'></i> Not Sync</button>";
		return $return;
	}
	if ($local->tpb_barang != $online->tpb_barang) {
		$return->button = "<a href='".base_url('migrasi/data_tpb/sync')."' class='btn btn-sm btn-primary'><i class='fal fa-sync'></i> Sync Now</a>";
		$return->view = "<button type='button' disabled class='btn btn-danger btn-sm btn-pills waves-effect waves-themed'><i class='fal fa-exclamation-triangle'></i> Not Sync</button>";
		return $return;
	}
	if ($local->tpb_barang_dokumen != $online->tpb_barang_dokumen) {
		$return->button = "<a href='".base_url('migrasi/data_tpb/sync')."' class='btn btn-sm btn-primary'><i class='fal fa-sync'></i> Sync Now</a>";
		$return->view = "<button type='button' disabled class='btn btn-danger btn-sm btn-pills waves-effect waves-themed'><i class='fal fa-exclamation-triangle'></i> Not Sync</button>";
		return $return;
	}
	if ($local->tpb_barang_penerima != $online->tpb_barang_penerima) {
		$return->button = "<a href='".base_url('migrasi/data_tpb/sync')."' class='btn btn-sm btn-primary'><i class='fal fa-sync'></i> Sync Now</a>";
		$return->view = "<button type='button' disabled class='btn btn-danger btn-sm btn-pills waves-effect waves-themed'><i class='fal fa-exclamation-triangle'></i> Not Sync</button>";
		return $return;
	}
	if ($local->tpb_barang_tarif != $online->tpb_barang_tarif) {
		$return->button = "<a href='".base_url('migrasi/data_tpb/sync')."' class='btn btn-sm btn-primary'><i class='fal fa-sync'></i> Sync Now</a>";
		$return->view = "<button type='button' disabled class='btn btn-danger btn-sm btn-pills waves-effect waves-themed'><i class='fal fa-exclamation-triangle'></i> Not Sync</button>";
		return $return;
	}
	if ($local->tpb_detil_status != $online->tpb_detil_status) {
		$return->button = "<a href='".base_url('migrasi/data_tpb/sync')."' class='btn btn-sm btn-primary'><i class='fal fa-sync'></i> Sync Now</a>";
		$return->view = "<button type='button' disabled class='btn btn-danger btn-sm btn-pills waves-effect waves-themed'><i class='fal fa-exclamation-triangle'></i> Not Sync</button>";
		return $return;
	}
	if ($local->tpb_dokumen != $online->tpb_dokumen) {
		$return->button = "<a href='".base_url('migrasi/data_tpb/sync')."' class='btn btn-sm btn-primary'><i class='fal fa-sync'></i> Sync Now</a>";
		$return->view = "<button type='button' disabled class='btn btn-danger btn-sm btn-pills waves-effect waves-themed'><i class='fal fa-exclamation-triangle'></i> Not Sync</button>";
		return $return;
	}
	if ($local->tpb_header != $online->tpb_header) {
		$return->button = "<a href='".base_url('migrasi/data_tpb/sync')."' class='btn btn-sm btn-primary'><i class='fal fa-sync'></i> Sync Now</a>";
		$return->view = "<button type='button' disabled class='btn btn-danger btn-sm btn-pills waves-effect waves-themed'><i class='fal fa-exclamation-triangle'></i> Not Sync</button>";
		return $return;
	}
	if ($local->tpb_jaminan != $online->tpb_jaminan) {
		$return->button = "<a href='".base_url('migrasi/data_tpb/sync')."' class='btn btn-sm btn-primary'><i class='fal fa-sync'></i> Sync Now</a>";
		$return->view = "<button type='button' disabled class='btn btn-danger btn-sm btn-pills waves-effect waves-themed'><i class='fal fa-exclamation-triangle'></i> Not Sync</button>";
		return $return;
	}
	if ($local->tpb_kemasan != $online->tpb_kemasan) {
		$return->button = "<a href='".base_url('migrasi/data_tpb/sync')."' class='btn btn-sm btn-primary'><i class='fal fa-sync'></i> Sync Now</a>";
		$return->view = "<button type='button' disabled class='btn btn-danger btn-sm btn-pills waves-effect waves-themed'><i class='fal fa-exclamation-triangle'></i> Not Sync</button>";
		return $return;
	}
	if ($local->tpb_kontainer != $online->tpb_kontainer) {
		$return->button = "<a href='".base_url('migrasi/data_tpb/sync')."' class='btn btn-sm btn-primary'><i class='fal fa-sync'></i> Sync Now</a>";
		$return->view = "<button type='button' disabled class='btn btn-danger btn-sm btn-pills waves-effect waves-themed'><i class='fal fa-exclamation-triangle'></i> Not Sync</button>";
		return $return;
	}
	if ($local->tpb_npwp_billing != $online->tpb_npwp_billing) {
		$return->button = "<a href='".base_url('migrasi/data_tpb/sync')."' class='btn btn-sm btn-primary'><i class='fal fa-sync'></i> Sync Now</a>";
		$return->view = "<button type='button' disabled class='btn btn-danger btn-sm btn-pills waves-effect waves-themed'><i class='fal fa-exclamation-triangle'></i> Not Sync</button>";
		return $return;
	}
	if ($local->tpb_penerima != $online->tpb_penerima) {
		$return->button = "<a href='".base_url('migrasi/data_tpb/sync')."' class='btn btn-sm btn-primary'><i class='fal fa-sync'></i> Sync Now</a>";
		$return->view = "<button type='button' disabled class='btn btn-danger btn-sm btn-pills waves-effect waves-themed'><i class='fal fa-exclamation-triangle'></i> Not Sync</button>";
		return $return;
	}
	if ($local->tpb_pungutan != $online->tpb_pungutan) {
		$return->button = "<a href='".base_url('migrasi/data_tpb/sync')."' class='btn btn-sm btn-primary'><i class='fal fa-sync'></i> Sync Now</a>";
		$return->view = "<button type='button' disabled class='btn btn-danger btn-sm btn-pills waves-effect waves-themed'><i class='fal fa-exclamation-triangle'></i> Not Sync</button>";
		return $return;
	}
	if ($local->tpb_respon != $online->tpb_respon) {
		$return->button = "<a href='".base_url('migrasi/data_tpb/sync')."' class='btn btn-sm btn-primary'><i class='fal fa-sync'></i> Sync Now</a>";
		$return->view = "<button type='button' disabled class='btn btn-danger btn-sm btn-pills waves-effect waves-themed'><i class='fal fa-exclamation-triangle'></i> Not Sync</button>";
		return $return;
	}
	$return->button = '';
	$return->view = "<button type='button' disabled class='btn btn-success btn-sm btn-pills waves-effect waves-themed'><i class='fal fa-check'></i> Synchronized</button>";
	return $return;
}
