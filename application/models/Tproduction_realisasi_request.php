<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Tproduction_realisasi_request extends CI_Model
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
		$this->basesql = "SELECT ta.* FROM $this->table ta WHERE ta.deleted_at IS NULL AND (ta.id_jenis_mutasi = '14' OR ta.id_jenis_mutasi = '8' OR ta.id_jenis_mutasi = '11' OR ta.id_jenis_mutasi = '16' OR ta.id_jenis_mutasi = '12') ";
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

	function viewBasedID($id,$class)
	{
		$in = a2o($this->in);
		$start = $in->start;
		// $sqlmain = "select tb.no_job, tc.kode_barang, tc.nama_barang, td.nomor_aju, td.nomor_daftar, td.no_sj ,ta.* from (select * from t_production_detail where id_production = '$id') ta inner join t_job tb on ta.id_job = tb.id_job inner join m_sub_barang tc on ta.id_sub_barang = tc.id_sub_barang inner join (select xa.id_wh_detail , xb.NOMOR_AJU as nomor_aju, xb.NOMOR_DAFTAR as nomor_daftar, xc.no_sj from t_wh_detail xa inner join ".getdbtpb($this).".tpb_header xb on xa.id_header = xb.ID inner join t_detail_dn xc on xa.id_detail_dn = xc.id_detail_dn) td on ta.id_wh_detail = td.id_wh_detail where qty > 0";
		$sqlmain ="SELECT ta.id_production, ta.kode_produksi, tc.no_job, tb.nama_barang, tb.kode_barang, tb.uraian_satuan_terkecil, tb.unit_konversi, tc.qty_po, ta.qty FROM t_production_detail ta INNER JOIN v_sub_barang tb ON ta.id_sub_barang=tb.id_sub_barang LEFT JOIN (SELECT ta.id_production, td.qty_po , tb.no_job FROM t_production ta INNER JOIN t_job tb ON ta.id_job=tb.id_job INNER JOIN t_bom tc ON tb.id_bom=tc.id_bom INNER JOIN t_detail_po td ON tc.id_detail_po=td.id_detail_po) tc ON ta.id_production=tc.id_production WHERE ta.id_production='$id' AND ta.id_jenis_mutasi='14' AND tb.id_class='$class'";

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
				$r->barang = $r->nama_barang."<br><small>".$r->kode_barang."</small>";	
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
	function viewBasedID21($id,$class)
	{
		$in = a2o($this->in);
		$start = $in->start;
		// $sqlmain = "select tb.no_job, tc.kode_barang, tc.nama_barang, td.nomor_aju, td.nomor_daftar, td.no_sj ,ta.* from (select * from t_production_detail where id_production = '$id') ta inner join t_job tb on ta.id_job = tb.id_job inner join m_sub_barang tc on ta.id_sub_barang = tc.id_sub_barang inner join (select xa.id_wh_detail , xb.NOMOR_AJU as nomor_aju, xb.NOMOR_DAFTAR as nomor_daftar, xc.no_sj from t_wh_detail xa inner join ".getdbtpb($this).".tpb_header xb on xa.id_header = xb.ID inner join t_detail_dn xc on xa.id_detail_dn = xc.id_detail_dn) td on ta.id_wh_detail = td.id_wh_detail where qty > 0";
		$sqlmain ="SELECT
						ta.id_production,
						ta.id_production_detail,
						ta.kode_produksi,
						tc.no_job,
						tb.nama_barang,
						tb.kode_barang,
						tb.uraian_satuan_terkecil,
						tc.qty_po,
						ta.qty 
					FROM
						t_production_detail ta
						INNER JOIN v_sub_barang tb ON ta.id_sub_barang = tb.id_sub_barang
						LEFT JOIN (
						SELECT
							ta.id_production,
							td.qty_po,
							tb.no_job 
						FROM
							t_production ta
							INNER JOIN t_production_detail tpd ON tpd.id_production = ta.id_production
							INNER JOIN t_job tb ON ta.id_job = tb.id_job
							INNER JOIN t_bom tc ON tb.id_bom = tc.id_bom
							INNER JOIN t_detail_po td ON tc.id_detail_po = td.id_detail_po 
							WHERE
						ta.id_job = '$id' and tpd.id_wh_detail is null
						GROUP BY ta.id_job
						) tc ON ta.id_production = tc.id_production 
					WHERE
					-- 	ta.id_job = 79 
						ta.id_jenis_mutasi = '14' 
						AND tb.id_class = 14
						AND tc.no_job IS NOT NULL";

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
				$r->barang = $r->nama_barang."<br><small>".$r->kode_barang."</small>";	
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

	function viewBasedID2($id, $kat)	
	{	
		$in = a2o($this->in);	
		$start = $in->start;	
		$sqlmain = "SELECT ta.kode_produksi, tb.nama_barang, tb.kode_barang, tb.uraian_satuan_terkecil, tb.unit_konversi, ta.qty FROM t_production_detail ta INNER JOIN v_sub_barang tb ON ta.id_sub_barang=tb.id_sub_barang WHERE ta.id_production='$id' AND ta.id_jenis_mutasi='$kat'";	
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
				$r->barang = $r->nama_barang."<br><small>".$r->kode_barang."</small>";	
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
	
				$r->kode_mutasi = "<a href='".base_url('production/realisasi_request_material/print/'.$r->id_production)."'>$r->kode_mutasi</a>";

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
					if ($r->approval_1 == '0' && $r->approval_2 == '0') {
						$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					}
					$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
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
	function viewDTPacking($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = $this->basesql;
		$sql = "select * from ($sqlmain) pa  WHERE id_jenis_mutasi=14 AND approval_1 = 1 ";
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
	
				$r->kode_mutasi = "<a href='".base_url('production/realisasi_request_material/print/'.$r->id_production)."'>$r->kode_mutasi</a>";

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
					if ($r->approval_1 == '0' && $r->approval_2 == '0') {
						$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					}
					$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
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

	function viewitemDT($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = "select td.id_wh_detail, td.id_wh, td.id_header, ta.*, tb.id_sub_barang, tb.kode_barang, tb.nama_barang, tc.id_detail_dn, sum(td.qty_wh) as qty_wh, td.seri_barang from (select a1.id_detail_job, a1.id_job, a2.no_job from t_detail_job a1 inner join t_job a2 on a1.id_job = a2.id_job) ta inner join (select a1.id_detail_pp, a1.id_sub_barang, a1.id_detail_job, a2.kode_barang, a2.nama_barang from t_detail_pp a1 inner join m_sub_barang a2 on a1.id_sub_barang = a2.id_sub_barang) tb on ta.id_detail_job = tb.id_detail_job inner join (select a1.id_detail_dn, a1.no_sj, a2.id_detail_po, a2.id_detail_pp, a3.kode_po from t_detail_dn a1 inner join t_detail_po a2 on a1.id_detail_po = a2.id_detail_po inner join t_po a3 on a2.id_po = a3.id_po) tc on tb.id_detail_pp = tc.id_detail_pp inner join (select a1.id_wh_detail, a1.id_wh, a1.id_detail_dn, a1.qty as qty_wh, a1.seri_barang, a1.id_sub_barang, a1.id_header from t_wh_detail a1 inner join t_wh a2 on a1.id_wh = a2.id_wh) td on tc.id_detail_dn = td.id_detail_dn group by tb.kode_barang, ta.no_job";
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
		// $sql = "select * from ($this->basesql) pa where $this->table_id = '$id'";
		$sql = "SELECT * FROM (SELECT a.*, ta.no_job, te.nama AS customer, td.kode_po, tf.nama_barang, tc.qty_po FROM (SELECT * FROM ($this->basesql) ta WHERE $this->table_id = '$id') a INNER JOIN t_job ta ON ta.id_job=a.id_job INNER JOIN t_bom tb ON ta.id_bom=tb.id_bom INNER JOIN t_detail_po tc ON tb.id_detail_po=tc.id_detail_po INNER JOIN t_po td ON tc.id_po=td.id_po INNER JOIN m_customer_suplier te ON td.id_supplier=te.id_customer  INNER JOIN v_sub_barang tf ON tc.id_sub_barang=tf.id_sub_barang INNER JOIN m_class tg ON tf.id_class=tg.id_class ) pa ";

		// WHERE tg.kode_class='02'
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}
	function get2($id)
	{
		// $sql = "select * from ($this->basesql) pa where $this->table_id = '$id'";
		$sql = "SELECT * 
				FROM
					(
					SELECT
						tpd.id_production_detail+1 as id_production_detail,
						a.*,
					
						ta.no_job,
						te.nama AS customer,
						td.kode_po,
						tf.nama_barang,
						tc.qty_po 
					FROM
						( SELECT * FROM ( SELECT ta.* FROM t_production ta WHERE ta.deleted_at IS NULL AND (ta.id_jenis_mutasi = '14' OR ta.id_jenis_mutasi = '8' OR ta.id_jenis_mutasi = '11' OR ta.id_jenis_mutasi = '16' OR ta.id_jenis_mutasi = '12') ) ta WHERE id_production = '$id' ) a
						INNER JOIN t_production_detail tpd ON tpd.id_production = a.id_production
						INNER JOIN t_job ta ON ta.id_job = a.id_job
						INNER JOIN t_bom tb ON ta.id_bom = tb.id_bom
						INNER JOIN t_detail_po tc ON tb.id_detail_po = tc.id_detail_po
						INNER JOIN t_po td ON tc.id_po = td.id_po
						INNER JOIN m_customer_suplier te ON td.id_supplier = te.id_customer
						INNER JOIN v_sub_barang tf ON tc.id_sub_barang = tf.id_sub_barang
					INNER JOIN m_class tg ON tf.id_class = tg.id_class 
					WHERE tpd.id_wh_detail is null
					GROUP BY ta.id_job
					) pa
		
		";

		// WHERE tg.kode_class='02'
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function getIDByCode($id)
	{
		$sql = "select * from ($this->basesql) pa where kode_mutasi = '$id'";
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
	
	function approval1packing($id)
	{
		
		$b = new stdClass();
		$b->approval_1 = 1;
		$b->id_user_approval_1 = 1;
		$b->date_approval_1 = $this->nowdt;
		$this->db->where('id_production_detail', $id);
		$this->db->update('t_production_detail', $b);
	}

	function approval1cek($id)
	{

		$sql = "SELECT
		tp.id_production,
		tpp.id_production_detail,
		vb.nama_barang,
		vb.nama_class,
		tpp.qty ,
		tdp.id_detail_po,
		tdp.qty_realisasi,
		tp.approval_1,
		tp.approval_2
	FROM
	t_job tj
		INNER JOIN t_production tp on tp.id_job = tj.id_job
		INNER JOIN t_production_detail tpp ON tpp.id_production = tp.id_production AND tpp.id_job = tj.id_job
		INNER JOIN t_detail_dn tdn ON tdn.id_detail_dn = tp.id_detail_dn
		INNER JOIN t_detail_po tdp ON tdn.id_detail_po = tdp.id_detail_po 
		INNER JOIN v_sub_barang vb ON  vb.id_sub_barang= tpp.id_sub_barang
	WHERE
		tp.id_production = '$id' 
		AND tpp.id_production = '$id' AND tpp.id_wh_detail is null";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
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
	function approval2packing($id)
	{
		$b = new stdClass();
		$b->approval_2 = 1;
		$b->id_user_approval_2 = 1;
		$b->status=2;
		$b->date_approval_2 = $this->nowdt;
		$this->db->where('id_production_detail', $id);
		$this->db->update('t_production_detail', $b);
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
		$res = $this->db->query("select kode_mutasi from $this->table where id_jenis_mutasi='14' and tanggal_mutasi >= '".date('Y-m-01', strtotime($date))."' and tanggal_mutasi <= '".date('Y-m-t', strtotime($date))."' and deleted_at is null order by tanggal_mutasi desc, kode_mutasi desc limit 1");
		$num = $res->num_rows();
		if($num > 0 ){
			$row = $res->row();
			$last = (substr($row->kode_mutasi, 0, 4) * 1)+1;
		} else {
			$last = 1;
		}

		$app_setting = getAppSetting($this);
		return str_pad($last, 4, '0', STR_PAD_LEFT)."/RLZ-".$app_setting->kode_sbu."/".integerToRoman($month)."/".$year;
	}
}
