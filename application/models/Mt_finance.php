<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mt_finance extends CI_Model
{
	var $table = 't_finance';
	var $table_id = 'id_finance';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "select ta.*, tc.debet, tc.kredit, tb.KODE_VALUTA, tb.URAIAN_VALUTA from $this->table ta left join ".getdbtpb($this).".referensi_valuta tb on ta.id_valuta=tb.ID left join (select id_finance, sum(case when amount > 0 then amount else 0 end) as debet, sum(case when amount < 0 then amount else 0 end) as kredit from t_finance_detail where deleted_at is null group by id_finance) tc on ta.id_finance = tc.id_finance where ta.deleted_at is null and ta.no_trans not like '%JVAWAL%'";
	}

	function view()
	{
		$sql = $this->basesql;
		$res = $this->db->query($sql);

		$data = array();
		foreach ($res->result() as $r) {
			$data[] = $r;
		}

		return $data;
	}

	function viewDT($in)
	{
		$start = $in->start;
		$sqlmain = $this->basesql;
		if (isset($in->is_approved)) {
			$sqlmain .= " and ta.approval_1='1' and ta.approval_2='1' ";
		}
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
		if ($num > 0) {
			$i = $start + 1;
			foreach ($res->result() as $r) {
				$r->no = $i;
				$r->status_approve = "";
				$r->status_approve = "";
				if ($r->approval_1 == '0' || $r->approval_1 == null) {
					$r->status_approve = "<button type='button' disabled class='btn btn-default btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-hourglass'></i> Ready</button>";
				}
				if (($r->approval_2 == '0' || $r->approval_2 == null) && $r->approval_1 == '1') {
					$r->status_approve = "<button type='button' disabled class='btn btn-success btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved 1</button>";
				}
				if ($r->approval_2 == '1' && $r->approval_1 == '1') {
					$r->status_approve = "<button type='button' disabled class='btn btn-primary btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved 2</button>";
				}
				if ($r->closing == '1') {
					$r->status_approve = "<button type='button' disabled class='btn btn-warning btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-min-circle'></i> Closed</button>";
				}

				$r->option = "";
				if (($r->approval_1 == '0' || $r->approval_1 == null) && ($r->approval_2 == '0' || $r->approval_2 == null) && $r->closing != '1') {
					$r->option .= '<a href="' . base_url($this->d->_controller . '/' . $this->d->_method . '/edit/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
				}
				$r->option .= ' <a href="' . base_url($this->d->_controller . '/' . $this->d->_method . '/detail/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
				if (($r->approval_1 == '0' || $r->approval_1 == null) && ($r->approval_2 == '0' || $r->approval_2 == null) && $r->closing != '1') {
					$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="' . base_url($this->d->_controller . '/' . $this->d->_method . '/delete/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
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

	function get($id)
	{
		$sql = $this->basesql . " and ta.id_po ='$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function geta($id)
	{
		$sql = $this->basesql . " and ta.$this->table_id ='$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function create($in)
	{
		$in->created_at = $this->nowdt;
		$in->updated_at = $this->nowdt;
		$this->db->insert($this->table, $in);
		$id = $this->db->insert_id();
		return $id;
	}

	function update($in)
	{
		$in->updated_at = $this->nowdt;
		$this->db->where($this->table_id, $in->{$this->table_id});
		$this->db->update($this->table, $in);
	}

	function delete($id)
	{
		$b = new stdClass();
		$b->deleted_at = $this->nowdt;
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table, $b);
	}

	function generateCode($tgl_trans, $kode)
	{
		$month = date('m', strtotime($tgl_trans));
		$year = date('Y', strtotime($tgl_trans));
		$res = $this->db->query("select no_trans from $this->table where tgl_trans >= '" . date('Y-m-01', strtotime($tgl_trans)) . "' and tgl_trans <= '" . date('Y-m-t', strtotime($tgl_trans)) . "' and no_trans LIKE '%/$kode-%' order by no_trans desc limit 1");
		$num = $res->num_rows();
		$latest_number = 1;
		if ($num > 0) {
			$index_number = '0000';
			foreach ($res->result() as $r) {
				$arrnumber = explode('/', $r->no_trans);
				$index_number = $arrnumber[0];
			}
			$latest_number = intval($index_number);
			$latest_number++;
		}

		$app_setting = getAppSetting($this);
		return str_pad($latest_number, 4, '0', STR_PAD_LEFT) . "/" . $kode . "-" . $app_setting->kode_sbu . "/" . integerToRoman($month) . "/" . $year;
	}
	function search_blog($title){
        $this->db->like('nama_barang', $title , 'both');
        $this->db->order_by('nama_barang', 'ASC');
        $this->db->limit(10);
        return $this->db->get('m_barang')->result();
    }

    function jenis_jurnal()
    {
        $res = $this->db->query("SELECT * FROM m_jenis_jurnal");
        $data = array();
        foreach ($res->result() as $r) {
            $data[] = $r;
        }
        return $data;
	}
}
