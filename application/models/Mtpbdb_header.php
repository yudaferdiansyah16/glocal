<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mtpbdb_header extends CI_Model
{
	var $nowdt, $nowd, $nowt, $basesql, $table,$table_id;

	function __construct()
	{
		

		parent::__construct();
		$db2 = $this->load->database('otherdb', TRUE);

		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->table = $db2->get('tpb_header');
		$this->table_id = 'ID';
		$this->basesql ="SELECT tc.total_item, tb.URAIAN_DOKUMEN_PABEAN, ta.*,(case when ta.KODE_DOKUMEN_PABEAN = '23' then ta.HARGA_INVOICE else ta.HARGA_PENYERAHAN end) as HARGA_DOCIN FROM tpb_header ta left join referensi_dokumen_pabean tb on ta.KODE_DOKUMEN_PABEAN = tb.KODE_DOKUMEN_PABEAN left join (SELECT ID_HEADER, count(ID) as total_item FROM tpb_barang GROUP BY ID_HEADER) tc on ta.ID = tc.ID_HEADER ";
	}

	function view()
	{
		$sql = $this->basesql;
		$res = $this->db->query($sql);

		$data = array();
		foreach ($res->result() as $r){
			$data[] = $r;
		}

		return $data;
	}

	function viewDT($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = $this->basesql;
		$sql = "select * from ($sqlmain) pa";
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		$sql .= dtSort($in);
		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;

				if($opt){
					$r->option = '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
					$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
				}
				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->draw = $in->draw;
		$k->recordsTotal = $recordsTotal;
		$k->recordsFiltered = $recordsFiltered;
		$k->data = $data;

		return $k;
	}

	function viewDTDocIn($in, $opt = true)
	{
		$db2 = $this->load->database('otherdb', TRUE);
		$start = $in->start;
		$sqlmain = "select * from ( SELECT tc.total_item, tb.URAIAN_DOKUMEN_PABEAN, ta.*,(case when ta.KODE_DOKUMEN_PABEAN = '23' then ta.HARGA_INVOICE else ta.HARGA_PENYERAHAN end) as HARGA_DOCIN FROM tpb_header ta left join referensi_dokumen_pabean tb on ta.KODE_DOKUMEN_PABEAN = tb.KODE_DOKUMEN_PABEAN left join (SELECT ID_HEADER, count(ID) as total_item FROM tpb_barang GROUP BY ID_HEADER) tc on ta.ID = tc.ID_HEADER ) pa where ID is not null";
// printJSON($sqlmain);
		if (isset($in->tglajuawal)) {
			$tglajuawal = reverseDate($in->tglajuawal);
			$sqlmain .= " and TANGGAL_AJU >= '$tglajuawal'";
		}
		if (isset($in->tglajuakhir)) {
			$tglajuakhir = reverseDate($in->tglajuakhir);
			$sqlmain .= " and TANGGAL_AJU <= '$tglajuakhir'";
		}
	
		$sql = "select * from ($sqlmain) pa";
		//  printJSON($sql);
		$res = $db2->query($sql);

		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $db2->query($sql);
		$recordsFiltered = $res->num_rows();

		$sql .= dtSort($in);
		$sql .= dtLimit($in);
		$res = $db2->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;

				$r->HARGA_DOCIN = number_format($r->HARGA_DOCIN,2);
				$r->JUMLAH_KEMASAN = number_format($r->JUMLAH_KEMASAN,2);
				$r->NETTO = number_format($r->NETTO,2);
				$r->BRUTO = number_format($r->BRUTO,2);
				$r->JUMLAH_BARANG = number_format($r->JUMLAH_BARANG,2);

				// if (($r->NOMOR_DAFTAR=='' || $r->NOMOR_DAFTAR==null) && $r->FLAG_APPROVAL1 == '1') {
				// 	$r->NOMOR_DAFTAR = "<span class='badge badge-info'>Ready to get response</span>";
				// 	$r->TANGGAL_DAFTAR = '';
				// } else if (($r->NOMOR_DAFTAR=='' || $r->NOMOR_DAFTAR==null) && $r->FLAG_APPROVAL1 != '1') {
				// 	$r->NOMOR_DAFTAR = '';
				// 	$r->TANGGAL_DAFTAR = '';
				// }

				// $r->status_approve = "";
				// if ($r->FLAG_APPROVAL2 == '1') {
				// 	$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check-circle'></i> Approved</span>";
				// } else if ($r->FLAG_APPROVAL1 == '1'){
				// 	$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check-circle'></i> Sychronized</span>";
				// } else {
				// 	$r->status_approve = "<span class='badge badge-warning'><i class='fa fal fa-exclamation-circle'></i> Not Synchronized</span>";
				// }

				// $r->option='';
				// if ($opt){
				// 	if ($r->FLAG_APPROVAL1 == '0' && $r->FLAG_APPROVAL2 == '0') {
				// 		switch ($r->KODE_DOKUMEN_PABEAN) {
				// 			case '23':
				// 				$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit_23/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
				// 				break;
				// 			case '262':
				// 				$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit_262/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
				// 				break;
				// 			case '40':
				// 				$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit_40/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
				// 				break;
				// 			case '27IN':
				// 				$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit_27in/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
				// 				break;
				// 			default:
				// 				break;
				// 		}
				// 	}
					// $r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
				// 	if ($r->FLAG_APPROVAL1 == '0' && $r->FLAG_APPROVAL2 == '0') {
				// 		$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
				// 	}
				// }
				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->draw = $in->draw;
		$k->recordsTotal = $recordsTotal;
		$k->recordsFiltered = $recordsFiltered;
		$k->data = $data;

		return $k;
	}

	function viewCASDocIn($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = $this->basesql." where ta.KODE_DOKUMEN_PABEAN = '23' or ta.KODE_DOKUMEN_PABEAN = '262' or ta.KODE_DOKUMEN_PABEAN = '40' or ta.KODE_DOKUMEN_PABEAN = '27IN'";
		$sqlmain = "select * from ($sqlmain) pa where ID is not null";
		if (isset($in->dokumenbc)) {
			$i =1;
			$sqlmain .= ' and (';
			foreach ($in->dokumenbc as $row) {
				if ($i==1) {
					$sqlmain .= " KODE_DOKUMEN_PABEAN = '".$row."' ";
				} else {
					$sqlmain .= " OR KODE_DOKUMEN_PABEAN = '".$row."' ";
				}
				$i++;
			}
			$sqlmain .= ' ) ';
		}

		$sqlmain = "select * from ($sqlmain) pa where ID is not null";

		if (isset($in->tglajuawal)) {
			$tglajuawal = reverseDate($in->tglajuawal);
			$sqlmain .= " and TANGGAL_AJU >= '$tglajuawal'";
		}
		if (isset($in->tglajuakhir)) {
			$tglajuakhir = reverseDate($in->tglajuakhir);
			$sqlmain .= " and TANGGAL_AJU <= '$tglajuakhir'";
		}
		$sql = "select pa.*, pb.FLAG_APPROVAL1, pb.FLAG_APPROVAL2 from ($sqlmain) pa inner join tpb_approval pb on pa.ID = pb.ID_HEADER";
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		$sql .= dtSort($in);
		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;

				if (($r->NOMOR_DAFTAR=='' || $r->NOMOR_DAFTAR==null) && $r->FLAG_APPROVAL1 == '1') {
					$r->NOMOR_DAFTAR = '<a href="'.base_url('exim/cas_doc_in/getresponse/'.$r->ID).'" class="btn btn-xs btn-warning">Get Response</a>';
					$r->TANGGAL_DAFTAR = '';
				} else if (($r->NOMOR_DAFTAR=='' || $r->NOMOR_DAFTAR==null) && $r->FLAG_APPROVAL1 != '1') {
					$r->NOMOR_DAFTAR = '';
					$r->TANGGAL_DAFTAR = '';
				}
				
				$r->status_approve = "";
				if ($r->FLAG_APPROVAL2 == '1') {
					$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check-circle'></i> Approved</span>";
				} else if ($r->FLAG_APPROVAL1 == '1'){
					$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check-circle'></i> Sychronized</span>";
				} else {
					$r->status_approve = "<span class='badge badge-warning'><i class='fa fal fa-exclamation-circle'></i> Not Synchronized</span>";
				}

				$r->option='';
				if ($opt){
					$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
				}

				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->draw = $in->draw;
		$k->recordsTotal = $recordsTotal;
		$k->recordsFiltered = $recordsFiltered;
		$k->data = $data;

		return $k;
	}

	function viewCASDocOut($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = $this->basesql." where ta.KODE_DOKUMEN_PABEAN = '25' or ta.KODE_DOKUMEN_PABEAN = '27' or ta.KODE_DOKUMEN_PABEAN = '261' or ta.KODE_DOKUMEN_PABEAN = '41'";
		$sqlmain = "select * from ($sqlmain) pa where ID is not null";
		if (isset($in->dokumenbc)) {
			$i =1;
			$sqlmain .= ' and (';
			foreach ($in->dokumenbc as $row) {
				if ($i==1) {
					$sqlmain .= " KODE_DOKUMEN_PABEAN = '".$row."' ";
				} else {
					$sqlmain .= " OR KODE_DOKUMEN_PABEAN = '".$row."' ";
				}
				$i++;
			}
			$sqlmain .= ' ) ';
		}

		$sqlmain = "select * from ($sqlmain) pa where ID is not null";

		if (isset($in->tglajuawal)) {
			$tglajuawal = reverseDate($in->tglajuawal);
			$sqlmain .= " and TANGGAL_AJU >= '$tglajuawal'";
		}
		if (isset($in->tglajuakhir)) {
			$tglajuakhir = reverseDate($in->tglajuakhir);
			$sqlmain .= " and TANGGAL_AJU <= '$tglajuakhir'";
		}
		$sql = "select pa.*, pb.FLAG_APPROVAL1, pb.FLAG_APPROVAL2 from ($sqlmain) pa inner join tpb_approval pb on pa.ID = pb.ID_HEADER";
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		$sql .= dtSort($in);
		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;

				if (($r->NOMOR_DAFTAR=='' || $r->NOMOR_DAFTAR==null) && $r->FLAG_APPROVAL1 == '1') {
					$r->NOMOR_DAFTAR = '<a href="'.base_url('exim/cas_doc_in/getresponse/'.$r->ID).'" class="btn btn-xs btn-warning">Get Response</a>';
					$r->TANGGAL_DAFTAR = '';
				} else if (($r->NOMOR_DAFTAR=='' || $r->NOMOR_DAFTAR==null) && $r->FLAG_APPROVAL1 != '1') {
					$r->NOMOR_DAFTAR = '';
					$r->TANGGAL_DAFTAR = '';
				}

				$r->status_approve = "";
				if ($r->FLAG_APPROVAL2 == '1') {
					$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check-circle'></i> Approved</span>";
				} else if ($r->FLAG_APPROVAL1 == '1'){
					$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check-circle'></i> Sychronized</span>";
				} else {
					$r->status_approve = "<span class='badge badge-warning'><i class='fa fal fa-exclamation-circle'></i> Not Synchronized</span>";
				}

				$r->option='';
				if ($opt){
					$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
				}

				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->draw = $in->draw;
		$k->recordsTotal = $recordsTotal;
		$k->recordsFiltered = $recordsFiltered;
		$k->data = $data;

		return $k;
	}

	function viewApprovalDocIn($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = $this->basesql." where ta.KODE_DOKUMEN_PABEAN = '23' or ta.KODE_DOKUMEN_PABEAN = '262' or ta.KODE_DOKUMEN_PABEAN = '40' or ta.KODE_DOKUMEN_PABEAN = '27IN'";
		$sql = "select pa.*, pb.FLAG_APPROVAL1, pb.FLAG_APPROVAL2 from ($sqlmain) pa inner join tpb_approval pb on pa.ID = pb.ID_HEADER";
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		$sql .= dtSort($in);
		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;

				$r->status_approve = "";
				if ($r->FLAG_APPROVAL2 == '1') {
					$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check-circle'></i> Approved</span>";
				} else if ($r->FLAG_APPROVAL1 == '1'){
					$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check-circle'></i> Sychronized</span>";
				} else {
					$r->status_approve = "<span class='badge badge-warning'><i class='fa fal fa-exclamation-circle'></i> Not Synchronized</span>";
				}

				$r->option='';
				if ($opt){
					if ($r->FLAG_APPROVAL1 == '0' && $r->FLAG_APPROVAL2 == '0') {
						$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					}
					$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
					if ($r->FLAG_APPROVAL1 == '0' && $r->FLAG_APPROVAL2 == '0') {
						$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
					}
				}
				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->draw = $in->draw;
		$k->recordsTotal = $recordsTotal;
		$k->recordsFiltered = $recordsFiltered;
		$k->data = $data;

		return $k;
	}

	function viewReportingDocIn($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = $this->basesql." where ta.KODE_DOKUMEN_PABEAN = '23' or ta.KODE_DOKUMEN_PABEAN = '262' or ta.KODE_DOKUMEN_PABEAN = '40' or ta.KODE_DOKUMEN_PABEAN = '27IN'";
		$sql = "select pa.*, pb.FLAG_APPROVAL1, pb.FLAG_APPROVAL2 from ($sqlmain) pa inner join tpb_approval pb on pa.ID = pb.ID_HEADER";
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		$sql .= dtSort($in);
		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;

				$r->status_approve = "";
				if ($r->FLAG_APPROVAL2 == '1') {
					$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check-circle'></i> Approved</span>";
				} else if ($r->FLAG_APPROVAL1 == '1'){
					$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check-circle'></i> Sychronized</span>";
				} else {
					$r->status_approve = "<span class='badge badge-warning'><i class='fa fal fa-exclamation-circle'></i> Not Synchronized</span>";
				}

				$r->option='';
				if ($opt){
					$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
				}
				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->draw = $in->draw;
		$k->recordsTotal = $recordsTotal;
		$k->recordsFiltered = $recordsFiltered;
		$k->data = $data;

		return $k;
	}

	function viewApprovalDocOut($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = $this->basesql." where ta.KODE_DOKUMEN_PABEAN = '25' or ta.KODE_DOKUMEN_PABEAN = '27' or ta.KODE_DOKUMEN_PABEAN = '261' or ta.KODE_DOKUMEN_PABEAN = '41' or ta.KODE_DOKUMEN_PABEAN = '30'";
		$sql = "select pa.*, pb.FLAG_APPROVAL1, pb.FLAG_APPROVAL2 from ($sqlmain) pa inner join tpb_approval pb on pa.ID = pb.ID_HEADER";
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		$sql .= dtSort($in);
		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;

				$r->status_approve = "";
				if ($r->FLAG_APPROVAL2 == '1') {
					$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check-circle'></i> Approved</span>";
				} else if ($r->FLAG_APPROVAL1 == '1'){
					$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check-circle'></i> Sychronized</span>";
				} else {
					$r->status_approve = "<span class='badge badge-warning'><i class='fa fal fa-exclamation-circle'></i> Not Synchronized</span>";
				}

				$r->option='';
				if ($opt){
					if ($r->FLAG_APPROVAL1 == '0' && $r->FLAG_APPROVAL2 == '0') {
						$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					}
					$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
					if ($r->FLAG_APPROVAL1 == '0' && $r->FLAG_APPROVAL2 == '0') {
						$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
					}
				}
				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->draw = $in->draw;
		$k->recordsTotal = $recordsTotal;
		$k->recordsFiltered = $recordsFiltered;
		$k->data = $data;

		return $k;
	}

	function viewReportingDocOut($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = $this->basesql." where ta.KODE_DOKUMEN_PABEAN = '25' or ta.KODE_DOKUMEN_PABEAN = '27' or ta.KODE_DOKUMEN_PABEAN = '261' or ta.KODE_DOKUMEN_PABEAN = '41' or ta.KODE_DOKUMEN_PABEAN = '30'";
		$sql = "select pa.*, pb.FLAG_APPROVAL1, pb.FLAG_APPROVAL2 from ($sqlmain) pa inner join tpb_approval pb on pa.ID = pb.ID_HEADER";
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		$sql .= dtSort($in);
		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;

				$r->status_approve = "";
				if ($r->FLAG_APPROVAL2 == '1') {
					$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check-circle'></i> Approved</span>";
				} else if ($r->FLAG_APPROVAL1 == '1'){
					$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check-circle'></i> Sychronized</span>";
				} else {
					$r->status_approve = "<span class='badge badge-warning'><i class='fa fal fa-exclamation-circle'></i> Not Synchronized</span>";
				}

				$r->option='';
				if ($opt){
					$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
				}
				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->draw = $in->draw;
		$k->recordsTotal = $recordsTotal;
		$k->recordsFiltered = $recordsFiltered;
		$k->data = $data;

		return $k;
	}

	function viewDetailDocIn($in, $id)
	{
		$start = $in->start;
		$sqlmain = "select tb.NOMOR_DOKUMEN, tb.KODE_JENIS_DOKUMEN, tc.KODE_VALUTA, ta.* from (select xa.*, xb.URAIAN_KEMASAN, xc.URAIAN_SATUAN from ".getdbtpb($this).".tpb_barang xa inner join ".getdbtpb($this).".referensi_kemasan xb on xa.KODE_KEMASAN = xb.KODE_KEMASAN inner join ".getdbtpb($this).".referensi_satuan xc on xa.KODE_SATUAN = xc.KODE_SATUAN where ID_HEADER = '$id') ta inner join (select * from ".getdbtpb($this).".tpb_dokumen where KODE_JENIS_DOKUMEN = '999') tb on ta.ID_HEADER = tb.ID_HEADER inner join (select ID, KODE_VALUTA from ".getdbtpb($this).".tpb_header where ID = '$id') tc on ta.ID_HEADER = tc.ID";
		$sql = "select pa.* from ($sqlmain) pa";
		
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		$sql .= dtSort($in);
		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;

				$r->detaildt = '<button type="button" class="btn btn-xs btn-default" data-toggle="modal" data-target="#detail['.$r->ID.']"><i class="fal fa-plus-circle"></i></button>';
				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->draw = $in->draw;
		$k->recordsTotal = $recordsTotal;
		$k->recordsFiltered = $recordsFiltered;
		$k->data = $data;

		return $k;
	}

	function viewDokumenDocIn($in, $id)
	{
		$start = $in->start;
		$sqlmain = "select tb.URAIAN_DOKUMEN, ta.*  from (select * from ".getdbtpb($this).".tpb_dokumen where ID_HEADER = '$id') ta inner join ".getdbtpb($this).".referensi_dokumen tb on ta.KODE_JENIS_DOKUMEN = tb.KODE_DOKUMEN where ta.NOMOR_DOKUMEN <>''";
		$sql = "select pa.* from ($sqlmain) pa";
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		$sql .= dtSort($in);
		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;

				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->draw = $in->draw;
		$k->recordsTotal = $recordsTotal;
		$k->recordsFiltered = $recordsFiltered;
		$k->data = $data;

		return $k;
	}

	function view261($in)
	{
		$start = $in->start;
		$sqlmain = "select NOMOR_AJU, TANGGAL_AJU from ".getdbtpb($this).".tpb_header where KODE_DOKUMEN_PABEAN = '261'";
		$sql = "select pa.* from ($sqlmain) pa";
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		$sql .= dtSort($in);
		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;

				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->draw = $in->draw;
		$k->recordsTotal = $recordsTotal;
		$k->recordsFiltered = $recordsFiltered;
		$k->data = $data;

		return $k;
	}

	function viewReferensiBarang261($in)
	{
		$start = $in->start;
		$sqlmain = "select tb.NOMOR_AJU, ta.KODE_BARANG, ta.URAIAN, ta.JUMLAH_SATUAN, ta.KODE_SATUAN from ".getdbtpb($this).".tpb_barang ta inner join (select ID as tpb_headerID, NOMOR_AJU from ".getdbtpb($this).".tpb_header) tb on ta.ID_HEADER = tb.tpb_headerID";
		$sql = "select pa.* from ($sqlmain) pa";
		if (isset($in->no_aju)) { $sql .= " where pa.NOMOR_AJU = '$in->no_aju' ";}
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		$sql .= dtSort($in);
		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;

				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->draw = $in->draw;
		$k->recordsTotal = $recordsTotal;
		$k->recordsFiltered = $recordsFiltered;
		$k->data = $data;

		return $k;
	}

	function viewDTDocOut($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = $this->basesql." where ta.KODE_DOKUMEN_PABEAN = '25' or ta.KODE_DOKUMEN_PABEAN = '27' or ta.KODE_DOKUMEN_PABEAN = '261' or ta.KODE_DOKUMEN_PABEAN = '41'";
		$sqlmain = "select * from ($sqlmain) pa where ID is not null";
		if (isset($in->dokumenbc)) {
			$i =1;
			$sqlmain .= ' and (';
			foreach ($in->dokumenbc as $row) {
				if ($i==1) {
					$sqlmain .= " KODE_DOKUMEN_PABEAN = '".$row."' ";
				} else {
					$sqlmain .= " OR KODE_DOKUMEN_PABEAN = '".$row."' ";
				}
				$i++;
			}
			$sqlmain .= ' ) ';
		}

		$sqlmain = "select * from ($sqlmain) pa where ID is not null";

		if (isset($in->tglajuawal)) {
			$tglajuawal = reverseDate($in->tglajuawal);
			$sqlmain .= " and TANGGAL_AJU >= '$tglajuawal'";
		}
		if (isset($in->tglajuakhir)) {
			$tglajuakhir = reverseDate($in->tglajuakhir);
			$sqlmain .= " and TANGGAL_AJU <= '$tglajuakhir'";
		}
		$sql = "select pa.*, pb.FLAG_APPROVAL1, pb.FLAG_APPROVAL2 from ($sqlmain) pa inner join tpb_approval pb on pa.ID = pb.ID_HEADER";
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		$sql .= dtSort($in);
		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;

				if (($r->NOMOR_DAFTAR=='' || $r->NOMOR_DAFTAR==null) && $r->FLAG_APPROVAL1 == '1') {
					$r->NOMOR_DAFTAR = "<span class='badge badge-info'>Ready to get response</span>";
					$r->TANGGAL_DAFTAR = '';
				} else if (($r->NOMOR_DAFTAR=='' || $r->NOMOR_DAFTAR==null) && $r->FLAG_APPROVAL1 != '1') {
					$r->NOMOR_DAFTAR = '';
					$r->TANGGAL_DAFTAR = '';
				}

				$r->status_approve = "";
				if ($r->FLAG_APPROVAL2 == '1') {
					$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check-circle'></i> Approved</span>";
				} else if ($r->FLAG_APPROVAL1 == '1'){
					$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check-circle'></i> Sychronized</span>";
				} else {
					$r->status_approve = "<span class='badge badge-warning'><i class='fa fal fa-exclamation-circle'></i> Not Synchronized</span>";
				}

				$r->option='';
				if ($opt){
					if ($r->FLAG_APPROVAL1 == '0' && $r->FLAG_APPROVAL2 == '0') {
						$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					}
					$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
					if ($r->FLAG_APPROVAL1 == '0' && $r->FLAG_APPROVAL2 == '0') {
						$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
					}
				}
				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->draw = $in->draw;
		$k->recordsTotal = $recordsTotal;
		$k->recordsFiltered = $recordsFiltered;
		$k->data = $data;

		return $k;
	}

	function viewapprovalDT($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = $this->basesql;
		$sql = "select * from ($sqlmain) pa";
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		$sql .= dtSort($in);
		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;
				$r->status_approve = "";
				if ($r->FLAG_APPROVAL2 == '1') {
					$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check-circle'></i> Approved</span>";
				} else {
					$r->status_approve = "<span class='badge badge-warning'><i class='fa fal fa-exclamation-circle'></i> Not Approved</span>";
				}

				if($opt){
					$r->option = '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a>';
				}
				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->draw = $in->draw;
		$k->recordsTotal = $recordsTotal;
		$k->recordsFiltered = $recordsFiltered;
		$k->data = $data;

		return $k;
	}

	function viewBahanBakuDT($in, $id)
	{
		$start = $in->start;
		$sqlmain = "select ta.* from (select * from ".getdbtpb($this).".tpb_bahan_baku where ID_HEADER = '$id') ta ";
		$sql = "select pa.* from ($sqlmain) pa";
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		$sql .= dtSort($in);
		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;

				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->draw = $in->draw;
		$k->recordsTotal = $recordsTotal;
		$k->recordsFiltered = $recordsFiltered;
		$k->data = $data;

		return $k;
	}

	function get($id)
	{
		$sql = $this->basesql." where ta.$this->table_id = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function getHeader($id)
	{
		$sql = "select ta.*, tb.URAIAN_CARA_ANGKUT, tc.URAIAN_DOKUMEN_PABEAN, td.URAIAN_JENIS_TPB, te.URAIAN_NEGARA as URAIAN_NEGARA_PEMASOK, tf.KODE_KANTOR as KODE_KANTOR_MUAT, tf.URAIAN_PELABUHAN as URAIAN_PELABUHAN_MUAT, tg.KODE_KANTOR as KODE_KANTOR_TRANSIT, tg.URAIAN_PELABUHAN as URAIAN_PELABUHAN_TRANSIT, th.KODE_KANTOR as KODE_KANTOR_BONGKAR, th.URAIAN_PELABUHAN as URAIAN_PELABUHAN_BONGKAR, ti.URAIAN_TUJUAN_PENGIRIMAN, tj.URAIAN_TUJUAN_TPB, tk.URAIAN_VALUTA, tl.URAIAN_TUJUAN_PEMASUKAN from (select * from ".getdbtpb($this).".tpb_header where ID = $id) ta left join ".getdbtpb($this).".referensi_cara_angkut tb on ta.KODE_CARA_ANGKUT = tb.KODE_CARA_ANGKUT left join ".getdbtpb($this).".referensi_dokumen_pabean tc on ta.KODE_DOKUMEN_PABEAN = tc.KODE_DOKUMEN_PABEAN left join ".getdbtpb($this).".referensi_jenis_tpb td on ta.KODE_JENIS_TPB = td.KODE_JENIS_TPB left join ".getdbtpb($this).".referensi_negara te on ta.KODE_NEGARA_PEMASOK = te.KODE_NEGARA left join ".getdbtpb($this).".referensi_pelabuhan tf on ta.KODE_PEL_MUAT = tf.KODE_PELABUHAN left join ".getdbtpb($this).".referensi_pelabuhan tg on ta.KODE_PEL_TRANSIT = tg.KODE_PELABUHAN left join ".getdbtpb($this).".referensi_pelabuhan th on ta.KODE_PEL_BONGKAR = th.KODE_PELABUHAN left join ".getdbtpb($this).".referensi_tujuan_pengiriman ti on (ta.KODE_DOKUMEN_PABEAN = ti.KODE_DOKUMEN and ta.KODE_TUJUAN_PENGIRIMAN = ti.KODE_TUJUAN_PENGIRIMAN) left join ".getdbtpb($this).".referensi_tujuan_tpb tj on ta.KODE_TUJUAN_TPB = tj.KODE_TUJUAN_TPB left join ".getdbtpb($this).".referensi_valuta tk on ta.KODE_VALUTA = tk.KODE_VALUTA left join ".getdbtpb($this).".referensi_tujuan_pemasukan tl on (ta.KODE_DOKUMEN_PABEAN = tl.KODE_DOKUMEN and ta.KODE_TUJUAN_PEMASUKAN = tl.KODE_TUJUAN_PEMASUKAN)";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function create($in)
	{
		$this->db->insert($this->table, $in);
		$id = $this->db->insert_id();
		//sendTPB($this, $this->table, 'insert', $id);

        /*
        $sql = "select ID from ".getdbtpb($this).".tpb_barang where id_header=$id";
        $res = $this->db->query($sql);
        foreach ($res->result() as $r){
            sendTPB($this, 'tpb_barang', 'insert', $r->ID);
        }

        $sql = "select ID from ".getdbtpb($this).".tpb_dokumen where id_header=$id";
        $res = $this->db->query($sql);
        foreach ($res->result() as $r){
            sendTPB($this, 'tpb_dokumen', 'insert', $r->ID);
        }
        /**/

		return $id;
	}

	function update($in)
	{
		$this->db->where($this->table_id, $in->{$this->table_id});
		$this->db->update($this->table, $in);
        //sendTPB($this, $this->table, 'update', $in->{$this->table_id});
	}

	function delete($id)
	{
		$b = new stdClass();
		$b->deleted_at = $this->nowdt;
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table, $b);
        //sendTPB($this, $this->table, 'delete', $id);
	}

	function generateCode($kode_dokumen = '',$tanggal){
        $app = getAppSetting($this);
        $prefix = substr($app->KPPBC,0,4).substr($kode_dokumen,0,2).$app->KODE_PERUSAHAAN;
        $sql = "select * from ".getdbtpb($this).".tpb_header where NOMOR_AJU like '$prefix%' AND TANGGAL_AJU >= '".date('Y-01-01',strtotime($tanggal))."' and  TANGGAL_AJU <= '".date('Y-12-31',strtotime($tanggal))."' order by NOMOR_AJU desc limit 1";
		$res = $this->db->query($sql);
		$num = $res->num_rows();
		if($num > 0 ){
			$row = $res->row();
			$lastaju = substr($row->NOMOR_AJU,0,26);
			$last = ((substr($lastaju, -6)) * 1) + 1;
		} else {
			$last = 1;
		}
		return substr($app->KPPBC,0,4).substr($kode_dokumen,0,2).$app->KODE_PERUSAHAAN.date('Y',strtotime($tanggal)).date('m',strtotime($tanggal)).date('d',strtotime($tanggal)).str_pad($last, 6, '0', STR_PAD_LEFT);
	}
}
