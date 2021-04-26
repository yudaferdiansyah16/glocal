<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Tproduction_approval_realisasi extends CI_Model
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
		$this->basesql = "SELECT ta.* FROM $this->table ta WHERE ta.deleted_at IS NULL AND (ta.id_jenis_mutasi = '14' OR ta.id_jenis_mutasi = '8' OR ta.id_jenis_mutasi = '11' OR ta.id_jenis_mutasi = '16' OR ta.id_jenis_mutasi = '12') AND (ta.approval_1='1' OR ta.approval_2='1')";
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

				$r->kode_mutasi = "<a href='".base_url('production/approval_realisasi_produksi/print/'.$r->id_production)."'>$r->kode_mutasi</a>";

				$r->status_approve = "";
				if ($r->flag_btl == 1) {
					$r->status_approve = "<button type='button' disabled class='btn btn-danger btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Canceled</button>";
				} else if ($r->flag_closing == 1) {
					$r->status_approve = "<button type='button' disabled class='btn btn-success btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Closed</button>";
				} else {
					if ($r->approval_1 == 0) {
						$r->status_approve = "<button type='button' disabled class='btn btn-default btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-hourglass'></i> Ready</button>";
					}
					if ($r->approval_1 == 1) {
						$r->status_approve = "<button type='button' disabled class='btn btn-success btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved 1</button>";
					}
					if ($r->approval_2 == 1) {
						$r->status_approve = "<button type='button' disabled class='btn btn-primary btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved 2</button>";
					}
				}

				$r->option='';
				if ($opt){
					// if ($r->approval_1 == '0' && $r->approval_2 == '0') {
					// 	$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					// }
					$r->option .= '<a href="'.base_url('warehouse/approval_realisasi_produksi/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
					if ($r->approval_1 == '0' && $r->approval_2 == '0') {
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

	function viewDTApprovalRealiasi($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = $this->basesql;
		$sql = "select * from (SELECT ta.* FROM t_wh ta WHERE ta.deleted_at IS NULL AND (ta.id_jenis_mutasi = '14' OR ta.id_jenis_mutasi = '8' OR ta.id_jenis_mutasi = '11' OR ta.id_jenis_mutasi = '16' OR ta.id_jenis_mutasi = '12') AND (ta.approval_1='1' OR ta.approval_2='1')) pa  WHERE id_jenis_mutasi=14 AND approval_1 = 1";
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

				$r->kode_mutasi = "<a href='".base_url('production/approval_realisasi_produksi/print/'.$r->id_wh)."'>$r->kode_mutasi</a>";

				$r->status_approve = "";
				if ($r->flag_btl == 1) {
					$r->status_approve = "<button type='button' disabled class='btn btn-danger btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Canceled</button>";
				} else if ($r->flag_closing == 1) {
					$r->status_approve = "<button type='button' disabled class='btn btn-success btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Closed</button>";
				} else {
					if ($r->approval_1 == 0) {
						$r->status_approve = "<button type='button' disabled class='btn btn-default btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-hourglass'></i> Ready</button>";
					}
					if ($r->approval_1 == 1) {
						$r->status_approve = "<button type='button' disabled class='btn btn-success btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved 1</button>";
					}
					if ($r->approval_2 == 1) {
						$r->status_approve = "<button type='button' disabled class='btn btn-primary btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved 2</button>";
					}
				}

				$r->option='';
				if ($opt){
					// if ($r->approval_1 == '0' && $r->approval_2 == '0') {
					// 	$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					// }
					$r->option .= '<a href="'.base_url('warehouse/approval_realisasi_produksi/detail/'.$r->id_wh).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
					if ($r->approval_1 == '0' && $r->approval_2 == '0') {
						$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete/'.$r->id_wh).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
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

	function viewitemDT($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = "SELECT td.id_wh_detail, td.id_wh, td.id_header, ta.*, tb.id_sub_barang, tb.kode_barang, tb.nama_barang, tc.id_detail_dn, sum(td.qty_wh) as qty_wh, td.seri_barang from (select a1.id_detail_job, a1.id_job, a2.no_job from t_detail_job a1 inner join t_job a2 on a1.id_job = a2.id_job) ta inner join (select a1.id_detail_pp, a1.id_sub_barang, a1.id_detail_job, a2.kode_barang, a2.nama_barang from t_detail_pp a1 inner join m_sub_barang a2 on a1.id_sub_barang = a2.id_sub_barang) tb on ta.id_detail_job = tb.id_detail_job inner join (select a1.id_detail_dn, a1.no_sj, a2.id_detail_po, a2.id_detail_pp, a3.kode_po from t_detail_dn a1 inner join t_detail_po a2 on a1.id_detail_po = a2.id_detail_po inner join t_po a3 on a2.id_po = a3.id_po) tc on tb.id_detail_pp = tc.id_detail_pp inner join (select a1.id_wh_detail, a1.id_wh, a1.id_detail_dn, a1.qty as qty_wh, a1.seri_barang, a1.id_sub_barang, a1.id_header from t_wh_detail a1 inner join t_wh a2 on a1.id_wh = a2.id_wh) td on tc.id_detail_dn = td.id_detail_dn group by tb.kode_barang, ta.no_job";
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
		$sql = "SELECT * FROM (SELECT a.*, ta.no_job, te.nama AS customer, td.kode_po, tf.nama_barang, tc.qty_po FROM (SELECT * FROM ($this->basesql) ta WHERE $this->table_id = '$id') a INNER JOIN t_job ta ON ta.id_job=a.id_job INNER JOIN t_bom tb ON ta.id_bom=tb.id_bom INNER JOIN t_detail_po tc ON tb.id_detail_po=tc.id_detail_po INNER JOIN t_po td ON tc.id_po=td.id_po INNER JOIN m_customer_suplier te ON td.id_supplier=te.id_customer  INNER JOIN v_sub_barang tf ON tc.id_sub_barang=tf.id_sub_barang INNER JOIN m_class tg ON tf.id_class=tg.id_class WHERE tg.kode_class='02') pa ";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function getItem($id)
	{
		$sql = "SELECT * FROM (SELECT ta.SERI_BARANG, ta.qty, ta.id_job, tb.rate, tb.id_sub_barang, tb.harga_satuan, tb.id_satuan_terbesar, tb.id_satuan_terkecil FROM (SELECT * FROM t_production_detail WHERE id_production='7') ta LEFT JOIN (SELECT ta.id_job, ta.rate, ta.id_sub_barang, ta.harga_satuan, ta.id_satuan_terbesar, ta.id_satuan_terkecil FROM t_wh_detail ta INNER JOIN t_wh tb ON ta.id_wh=tb.id_wh WHERE tb.jenis_transaksi='M' AND tb.id_jenis_mutasi='9') tb ON ta.id_job=tb.id_job AND ta.id_sub_barang=tb.id_sub_barang) pa ";
		$res = $this->db->query($sql);
		$r = $res->result();
		return $r;
	}

	function getIDByCode($id)
	{
		$sql = "select * from ($this->basesql) pa where kode_mutasi = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function create($id_produksi)
	{
		$produksi = $this->get($id_produksi);

		$a  = new stdClass();
		$a->jenis_transaksi = 'T';
		$a->tanggal_terima = $this->nowd;
		$a->id_jenis_mutasi = $produksi->id_jenis_mutasi;
		$a->kode_mutasi = $this->generateCode($this->nowd, $produksi->id_jenis_mutasi);
		$a->created_at = $this->nowdt;
		$a->updated_at = $this->nowdt;
		$this->db->insert('t_wh', $a);
		
		$id = $this->db->insert_id();

		return $id;
	}

	function createDetail($in)
	{
		$in->created_at = $this->nowdt;
		$in->updated_at = $this->nowdt;
		$this->db->insert('t_wh_detail', $in);
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

	function generateCode($date, $id_jenis_mutasi)
	{
		$month = date('m', strtotime($date));
		$year = date('Y', strtotime($date));
		$res = $this->db->query("select kode_mutasi from $this->table where tanggal_mutasi >= '".date('Y-m-01', strtotime($date))."' and tanggal_mutasi <= '".date('Y-m-t', strtotime($date))."' and id_jenis_mutasi = '$id_jenis_mutasi' order by kode_mutasi desc limit 1");
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
