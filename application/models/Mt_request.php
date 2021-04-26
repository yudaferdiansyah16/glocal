<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_request extends CI_Model
{
	var $table = 't_request';
	var $table_id = 'id_request';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "select ta.*, tb.nama_jenis_mutasi, te.kode_bom, td.kode_po, td.po_buyer, tg.kode_barang, tg.nama_barang, tg.size, ifnull(tc.detail_count, 0) detail_count, usc.nama as nama_user_created, usu.nama as nama_user_updated from $this->table ta LEFT JOIN m_jenis_mutasi tb ON tb.id_jenis_mutasi = ta.id_jenis_mutasi left join (select id_request, count(*) detail_count from t_request_detail where deleted_at is null group by id_request) tc on tc.id_request = ta.id_request left join t_po td on td.id_po = ta.id_po left join t_bom te on te.id_bom = ta.id_bom left join t_detail_po tf on tf.id_detail_po = te.id_detail_po left join v_sub_barang tg on tg.id_sub_barang = tf.id_sub_barang left join m_user usc ON usc.id_user = ta.id_user_created left join m_user usu ON usu.id_user = ta.id_user_updated where ta.deleted_at is null";
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

				$r->status_approve = "";
				if ($r->approval_1 == '0') {
					$r->status_approve = "<button type='button' disabled class='btn btn-default btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-hourglass'></i> Ready</button>";
				}
				if ($r->approval_2 == '0' && $r->approval_1 == '1') {
					$r->status_approve = "<button type='button' disabled class='btn btn-success btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved 1</button>";
				}
				if ($r->approval_2 == '1' && $r->approval_1 == '1') {
					$r->status_approve = "<button type='button' disabled class='btn btn-primary btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved 2</button>";
				}

				if($opt){
					$r->option = "";
					if ($r->approval_1 == 0 && $r->approval_2 == 0) {
						$r->option .= '<a href="' . base_url($this->d->_controller . '/' . $this->d->_method . '/edit/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					}
					$r->option .= ' <a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
					if ($r->approval_1 == 0 && $r->approval_2 == 0) {
						$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="' . base_url($this->d->_controller . '/' . $this->d->_method . '/delete/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
					}
					$r->option .= "<a href='".base_url('warehouse/request_material/print/'.$r->{$this->table_id})."' class='btn btn-xs btn-default'><i class='fal fa-print'></i></a>";
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
		$sql = $this->basesql." and ta.$this->table_id = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function create($in)
	{
		$in->kode_request = $this->generateCode($in->tgl_request);
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

	function generateCode($tgl_request)
	{
		$month = date('m', strtotime($tgl_request));
		$year = date('Y', strtotime($tgl_request));
		$res = $this->db->query("select kode_request from $this->table where tgl_request >= '".date('Y-m-01', strtotime($tgl_request))."' and tgl_request <= '".date('Y-m-t', strtotime($tgl_request))."' order by kode_request desc, tgl_request desc limit 1");
		$num = $res->num_rows();
		if($num > 0 ){
			$row = $res->row();
			$last = (substr($row->kode_po, 0, 4) * 1)+1;
		} else {
			$last = 1;
		}

		$app_setting = getAppSetting($this);
		return str_pad($last, 4, '0', STR_PAD_LEFT)."/RQS-".$app_setting->kode_sbu."/".integerToRoman($month)."/".$year;
	}
}
