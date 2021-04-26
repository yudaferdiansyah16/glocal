<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/RESTController.php';

use Restserver\Libraries\RESTController;

class Api2 extends RestController
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function login_post()
	{
		modelLoad($this, array('maccount'));
		$in = array(
			'uname' => $this->post('username'),
			'passwd' => $this->post('password')
		);
		$response = $this->maccount->signin(a2o($in));
		if ($response->success) {
			$this->response(array(
				'status' => true
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Unauthorized'
			), 401);
		}
	}

	public function peb_header_get()
	{
		$page = $this->input->get('page');
		$min_exp_date = $this->input->get('min_exp_date');
		$max_exp_date = $this->input->get('max_exp_date');
		$status = $this->input->get('status');
		if (empty($page)) $page = 1;
		$id = $this->get('id');

		$data = array();
		if (empty($id)) {
			$this->db->select('ta.*, IFNULL(tb.FLAG_APPROVAL1, 0) as FLAG_APPROVAL1')->from(getdbpeb($this) . ".tblpebhdr ta")->join('peb_approval as tb', 'tb.ID_HEADER = ta.CAR', 'left');
			if (!empty($min_exp_date)) {
				$this->db->where('TGEKS >=', $min_exp_date);
			}
			if (!empty($max_exp_date)) {
				$this->db->where('TGEKS <=', $max_exp_date);
			}
			if (!empty($status)) {
				switch ($status) {
					case "approved":
						$this->db->where("IFNULL(tb.FLAG_APPROVAL1, 0) = '1'");
						break;
					case "pending":
						$this->db->where("IFNULL(tb.FLAG_APPROVAL1, 0) = '0'");
						break;
				}
			}
			$result = $this->db->get();
			$data = array();
			foreach ($result->result() as $r) {
				$data[] = $r;
			}
		} else {
			$peb_header = $this->db->where('CAR', $id)->get(getdbpeb($this) . ".tblpebhdr")->row();
			if (!empty($peb_header)) {
				$data['peb_header'] = $peb_header;

				$data['peb_details'] = array();
				$result = $this->db->where('CAR', $id)->get(getdbpeb($this) . ".tblpebdtl");
				foreach ($result->result() as $r) {
					$data['peb_details'][] = $r;
				}

				$data['peb_docs'] = array();
				$result = $this->db->where('CAR', $id)->get(getdbpeb($this) . ".tblpebdok");
				foreach ($result->result() as $r) {
					$data['peb_docs'][] = $r;
				}

				$data['peb_packs'] = array();
				$result = $this->db->where('CAR', $id)->get(getdbpeb($this) . ".tblpebkms");
				foreach ($result->result() as $r) {
					$data['peb_packs'][] = $r;
				}

				$data['peb_containers'] = array();
				$result = $this->db->where('CAR', $id)->get(getdbpeb($this) . ".tblpebcon");
				foreach ($result->result() as $r) {
					$data['peb_containers'][] = $r;
				}

				$data['peb_banks'] = array();
				$result = $this->db->where('CAR', $id)->get(getdbpeb($this) . ".tblpebdhe");
				foreach ($result->result() as $r) {
					$data['peb_banks'][] = $r;
				}
			} else {
				$this->response(array(
					'status' => false,
					'data' => null
				), 404);
			}
		}

		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_header_put()
	{
		$id = $this->input->get('id');
		if (!empty($id)) {
			$peb_header = $this->db->where('CAR', $id)->get(getdbpeb($this) . ".tblpebhdr")->row();
			if (!empty($peb_header)) {
				$peb_approval = $this->db->where('ID_HEADER', $id)->get("peb_approval")->row();
				if (empty($peb_approval)) {
					$this->db->insert('peb_approval', array(
						'ID_HEADER' => $id,
						'FLAG_APPROVAL1' => '1',
						'DATE_APPROVAL1' => date('Y-m-d H:i:s')
					));
				} else {
					$this->db->where('ID_HEADER', $id)->update('peb_approval', array(
						'FLAG_APPROVAL1' => '1',
						'DATE_APPROVAL1' => date('Y-m-d H:i:s')
					));
				}
				$this->response(array(
					'status' => true,
				), 200);
			} else {
				$this->response(array(
					'status' => false,
					'data' => null
				), 404);
			}
		} else {
			$this->response(array(
				'status' => false,
				'data' => null
			), 404);
		}
	}

	public function peb_response_put()
	{
		$id = $this->put('id');
		$status = $this->put('$status');
		if (!empty($id)) {
			$peb_header = $this->db->where('CAR', $id)->get(getdbpeb($this) . ".tblpebhdr")->row();
			if (!empty($peb_header)) {
				$this->db->where('CAR', $id)->update(getdbpeb($this) . ".tblpebhdr", array(
					'STATUS' => $status
				));
				$this->response(array(
					'status' => true,
				), 200);
			} else {
				$this->response(array(
					'status' => false,
					'data' => null
				), 404);
			}
		} else {
			$this->response(array(
				'status' => false,
				'data' => null
			), 404);
		}
	}

	public function peb_bank_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tblbank", 2, 1);
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_daerah_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tbldaerah", 2, 1);
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_data_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tbldata");
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_data1_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tbldata1");
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_dppkb_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tbldppkb");
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_eksportir_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tbleksportir");
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_gudang_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tblgudang");
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_hanggar_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tblhanggar", 2, 1);
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_kapal_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tblkapal", 2, 1);
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_kemasan_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tblkemasan", 2, 1);
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_komlog_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tblkomlog", 2, 1);
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_kpbc_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tblkpbc", 2, 1);
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_kpker_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tblkpker", 2, 1);
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_kurs_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tblkurs");
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_modatambahan_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tblmodatambahan");
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_negara_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tblnegara", 2, 1);
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_nomor_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tblnomor");
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_partner_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tblpartner");
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_ipe_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tblipe");
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_pebberkala_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tblpebberkala");
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_pebcon_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tblpebcon", 2, 1);
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_pebconr_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tblpebconr");
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_pebdhe_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tblpebdhe", 2, 1);
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}

	public function peb_pebdok_get()
	{
		$result = $this->db->get(getdbpeb($this) . ".tblpebdok", 2, 1);
		$data = array();
		foreach ($result->result() as $r) {
			$data[] = $r;
		}
		$this->response(array(
			'status' => true,
			'data' => $data
		), 200);
	}
}
