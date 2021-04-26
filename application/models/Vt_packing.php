<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Vt_packing extends CI_Model
{
	var $table = 't_production';
	var $table_id = 'id_production';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "select ta.*, tb.no_job, tb.tanggal_job, te.kode_barang, te.nama_barang, te.kode_satuan_terkecil as kode_satuan, td.id_wh_detail, td.id_sub_barang, td.id_satuan_terkecil, td.id_satuan_terbesar, td.qty as qty_pack, td.id_gudang, tf.nama_gudang, td.koordinat from $this->table ta left join t_job tb on tb.id_job = ta.id_job left join t_wh tc on tc.kode_mutasi = ta.kode_mutasi left join t_wh_detail td on td.id_wh = tc.id_wh left join v_sub_barang as te on te.id_sub_barang = td.id_sub_barang left join m_gudang tf on tf.id_gudang = td.id_gudang where ta.id_jenis_mutasi = '1'  and ta.deleted_at is null";
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
		if (isset($in->id_job)) {
			$sqlmain .= " and ta.id_job = '$in->id_job' ";
		}
		if (isset($in->start_date)) {
			$sqlmain .= ' and ta.tanggal_mutasi >= "'.reverseDate($in->start_date).'" ';
		}
		if (isset($in->end_date)) {
			$sqlmain .= ' and ta.tanggal_mutasi <= "'.reverseDate($in->end_date).'" ';
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
					if ($r->approval_1 == '0' && $r->approval_2 == '0') {
						$r->option .= '<a href="' . base_url($this->d->_controller . '/' . $this->d->_method . '/edit/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					}
					$r->option .= ' <a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
					if ($r->approval_1 == '0' && $r->approval_2 == '0') {
						$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="' . base_url($this->d->_controller . '/' . $this->d->_method . '/delete/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
					}
					$r->option .= "<a href='".base_url('production/packing/print/'.$r->id_production)."' class='btn btn-xs btn-default '><i class='fal fa-print'></i></a>";
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

	function viewitemDT($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = "select td.id_wh_detail, td.id_wh, td.id_header, ta.*, tb.id_sub_barang, tb.kode_barang, tb.nama_barang, tc.id_detail_dn, td.seri_barang, ((sum(case when td.saldo_mutasi = 'K' then td.qty_wh else 0 end))-(sum(case when td.saldo_mutasi = 'D' then td.qty_wh else 0 end))) as qty_wh from (select a1.id_detail_job, a1.id_job, a2.no_job from t_detail_job a1 inner join t_job a2 on a1.id_job = a2.id_job) ta inner join (select a1.id_detail_pp, a1.id_sub_barang, a1.id_detail_job, a2.kode_barang, a2.nama_barang from t_detail_pp a1 inner join m_sub_barang a2 on a1.id_sub_barang = a2.id_sub_barang) tb on ta.id_detail_job = tb.id_detail_job inner join (select a1.id_detail_dn, a1.no_sj, a2.id_detail_po, a2.id_detail_pp, a3.kode_po from t_detail_dn a1 inner join t_detail_po a2 on a1.id_detail_po = a2.id_detail_po inner join t_po a3 on a2.id_po = a3.id_po) tc on tb.id_detail_pp = tc.id_detail_pp inner join (select a2.id_jenis_mutasi, a3.saldo_mutasi ,a1.id_wh_detail, a1.id_wh, a1.id_detail_dn, a1.qty as qty_wh, a1.seri_barang, a1.id_sub_barang, a1.id_header from t_wh_detail a1 inner join t_wh a2 on a1.id_wh = a2.id_wh inner join m_jenis_mutasi a3 on a2.id_jenis_mutasi = a3.id_jenis_mutasi) td on tc.id_detail_dn = td.id_detail_dn group by tb.kode_barang, ta.no_job";
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
				$r->blank = '';
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
		$sql = "select * from ($this->basesql) pa where $this->table_id = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function create($in)
	{
		$in->kode_mutasi = $this->generateCode($in->tanggal_mutasi);
		$in->created_at = $this->nowdt;
		$in->updated_at = $this->nowdt;
		$this->db->insert($this->table, $in);
		$id = $this->db->insert_id();
		return $id;
	}

	function update($in)
	{
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


	function approval1($id)
	{
		$b = new stdClass();
		$b->approval_1 = 1;
		$b->id_user_approval_1 = 1;
		$b->date_approval_1 = $this->nowdt;
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table, $b);
	}

	function approval2($id)
	{
		$b = new stdClass();
		$b->approval_2 = 1;
		$b->id_user_approval_2 = 1;
		$b->date_approval_2 = $this->nowdt;
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table, $b);
	}

	function disapprove($id)
	{
		$b = new stdClass();
		$b->approval_1 = 0;
		$b->id_user_approval_1 = 0;
		$b->date_approval_1 = $this->nowdt;
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table, $b);
	}

	function cancel($id)
	{
		$b = new stdClass();
		$b->flag_btl = 1;
		$b->id_user_btl = 1;
		$b->btl_date = $this->nowdt;
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table, $b);
	}

	function closing($id)
	{
		$b = new stdClass();
		$b->flag_closing = 1;
		$b->id_user_closing = 1;
		$b->date_closing = $this->nowdt;
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table, $b);
	}

	function generateCode($date)
	{
		$month = date('m', strtotime($date));
		$year = date('Y', strtotime($date));
		$id_jenis_mutasi = '1';
		$res = $this->db->query("select kode_mutasi from $this->table where tanggal_mutasi >= '".date('Y-m-01', strtotime($date))."' and tanggal_mutasi <= '".date('Y-m-t', strtotime($date))."' and id_jenis_mutasi = '$id_jenis_mutasi' and deleted_at is null order by kode_mutasi desc limit 1");
		$num = $res->num_rows();
		$latest_number = 1;
		if ($num > 0) {
			$index_number = '0000';
			foreach ($res->result() as $r){
				$arrnumber = explode('/', $r->kode_mutasi);
				$index_number = $arrnumber[0];
			}
			$latest_number = intval($index_number);
			$latest_number++;
		}

		modelLoad($this, array('mm_jenis_mutasi'));
		$m_jenis_mutasi = $this->mm_jenis_mutasi->get($id_jenis_mutasi);

		$app_setting = getAppSetting($this);
		return str_pad($latest_number, 4, '0', STR_PAD_LEFT)."/".$m_jenis_mutasi->kode_doc."-".$app_setting->kode_sbu."/".integerToRoman($month)."/".$year;
	}
}
