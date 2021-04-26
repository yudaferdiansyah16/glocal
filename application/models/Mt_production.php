<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_production extends CI_Model
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
		$this->basesql = "SELECT ta.*, tc.nama_workflow, td.nama_part, tg.kode_po, tg.po_buyer, th.nama nama_customer, ti.kode_barang, ti.nama_barang, ti.size FROM $this->table ta LEFT JOIN t_bom_workflow tb on tb.id_bom_workflow = ta.id_bom_workflow LEFT JOIN m_workflow tc on tc.id_workflow = tb.id_workflow LEFT JOIN m_part td on td.id_part = tb.id_part LEFT JOIN t_bom te on te.id_bom = tb.id_bom LEFT JOIN t_detail_po tf on tf.id_detail_po = te.id_detail_po LEFT JOIN t_po tg ON tg.id_po = tf.id_po LEFT JOIN m_customer_suplier th on th.id_customer = tg.id_supplier LEFT JOIN m_sub_barang ti ON ti.id_sub_barang = tf.id_sub_barang WHERE ta.deleted_at IS NULL";
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


	function viewBasedWHId($id_wh)
	{
		$sql = $this->basesql." and ta.id_wh = '$id_wh'";
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
					$r->option = '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					$r->option .= ' <a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
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

	function getFg($id)	
	{	
		$sql = "SELECT td.id_sub_barang, tc.qty_po FROM t_job ta INNER JOIN t_bom tb ON ta.id_bom=tb.id_bom INNER JOIN t_detail_po tc ON tb.id_detail_po=tc.id_detail_po INNER JOIN v_sub_barang td ON tc.id_sub_barang=td.id_sub_barang INNER JOIN t_po te ON tc.id_po=te.id_po INNER JOIN m_customer_suplier tf ON te.id_supplier=tf.id_customer WHERE ta.id_job='$id' AND td.id_class='2'";	
		$res = $this->db->query($sql);	
		$data = array();	
		$no = 1;	
		foreach ($res->result() as $r){	
			$r->no = $no++;	
			$data[] = $r;	
		}	
		return $data;	
	}	
	function viewDetailFg($in)	
	{	
		// printJSON($this->in->id);
		$id = $this->in->id;
		$sql = "SELECT
		tc.id_detail_po,
		tpd.id_production_detail,
		tf.nama_barang,
		tf.kode_barang,
		tf.uraian_satuan_terkecil,
		tf.unit_konversi,
		tc.qty_po,
		tpd.qty
			
	FROM
		t_job ta
		INNER JOIN t_bom tb ON ta.id_bom = tb.id_bom
		INNER JOIN t_production tp ON tp.id_job = ta.id_job
		INNER JOIN t_production_detail tpd ON tpd.id_production = tp.id_production
		INNER JOIN t_detail_po tc ON tb.id_detail_po = tc.id_detail_po
		INNER JOIN t_po td ON tc.id_po = td.id_po
		INNER JOIN m_customer_suplier te ON td.id_supplier = te.id_customer
		INNER JOIN v_sub_barang tf ON tpd.id_sub_barang = tf.id_sub_barang
		INNER JOIN m_class tg ON tf.id_class = tg.id_class 
	WHERE
		tp.id_production = '$id' 
	AND
		tpd.id_wh_detail IS NULL 
		GROUP BY id_detail_po";
			// AND tg.kode_class='02'	
		$res = $this->db->query($sql);	
		$data = array();	
		$no = 1;	
		foreach ($res->result() as $r){	
			$r->no = $no++;	
			$data[] = $r;	
		}	
		
		$k = new stdClass();	
		$k->aaData = $data;	
		return $k;	
	}
	

	function viewDetailWIP($in)	
	{	
		// printJSON($this->in->id);
		$id = $this->in->id;
		$sql = "SELECT
		tc.id_detail_po,
		tpd.kode_produksi,
		ta.no_job,
-- 		tpd.qty,
		tf.nama_barang,
		tpd.id_sub_barang,
		tf.uraian_satuan_terkecil,
		tf.unit_konversi,
		tpd.qty
	FROM
		t_job ta
		INNER JOIN t_bom tb ON ta.id_bom = tb.id_bom
		INNER JOIN t_production tp ON tp.id_job = ta.id_job
		INNER JOIN t_production_detail tpd ON tpd.id_production = tp.id_production
		INNER JOIN t_detail_po tc ON tb.id_detail_po = tc.id_detail_po
		INNER JOIN t_po td ON tc.id_po = td.id_po
		INNER JOIN m_customer_suplier te ON td.id_supplier = te.id_customer
		INNER JOIN v_sub_barang tf ON tpd.id_sub_barang = tf.id_sub_barang
		INNER JOIN m_class tg ON tf.id_class = tg.id_class 
	WHERE
		tpd.id_production = '$id'
		AND tg.id_class = 14 
		AND tpd.id_wh_detail IS NULL ";
			// AND tg.kode_class='02'	
		$res = $this->db->query($sql);	
		$data = array();	
		$no = 1;	
		foreach ($res->result() as $r){	
			$r->no = $no++;	
			$data[] = $r;	
		}	
		
		$k = new stdClass();	
		$k->aaData = $data;	
		return $k;	
	}
	
	function viewDtFg($in)	
	{	
		if(!isset($in->id)){	
			$data = [];	
		}else{	
			$sql = "SELECT
			tc.id_detail_po,
			tf.nama_barang,
			tf.kode_barang,
			tf.uraian_satuan_terkecil,
			tc.qty_po,
			tdn.id_detail_dn
			
		FROM
			t_job ta
			INNER JOIN t_bom tb ON ta.id_bom = tb.id_bom
			INNER JOIN t_detail_po tc ON tb.id_detail_po = tc.id_detail_po
			INNER JOIN t_po td ON tc.id_po = td.id_po
			INNER JOIN t_detail_job tjb on tjb.id_job = ta.id_job
			INNER JOIN t_detail_pp tpp ON tpp.id_detail_job = tjb.id_detail_job
			INNER JOIN t_detail_po tpo ON tpo.id_detail_pp = tpp.id_detail_pp
			INNER JOIN t_detail_dn tdn on tdn.id_detail_po = tpo.id_detail_po
			INNER JOIN m_customer_suplier te ON td.id_supplier = te.id_customer
			INNER JOIN v_sub_barang tf ON tc.id_sub_barang = tf.id_sub_barang
			INNER JOIN m_class tg ON tf.id_class = tg.id_class 
		WHERE
			ta.id_job = '$in->id'
		GROUP BY ta.id_job";
			// AND tg.kode_class='02'	
			$res = $this->db->query($sql);	
			$data = array();	
			$no = 1;	
			foreach ($res->result() as $r){	
				$r->no = $no++;	
				$data[] = $r;	
			}	
		}	
		$k = new stdClass();	
		$k->aaData = $data;	
		return $k;	
	}

	function viewDtMaterial($opt = true)	
	{	
		$in = a2o($this->in);	
		if(isset($in->id)){	
			$start = $in->start;	
			$sqlmain = "SELECT ta.id_job,ms.nama_consignee nama,td.id_wh_detail,tb.tanggal_mutasi, 
			tb.id_detail_dn,tb.kode_mutasi, td.seri_barang, ta.no_job, te.id_sub_barang, te.nama_barang, te.kode_barang, te.uraian_satuan_terkecil, te.unit_konversi, tc.qty, tg.qty_total, th.qty_pakai FROM t_job ta INNER JOIN t_production tb ON ta.id_job=tb.id_job INNER JOIN t_production_detail tc ON tb.id_production=tc.id_production INNER JOIN t_wh_detail td ON tc.id_wh_detail=td.id_wh_detail INNER JOIN v_sub_barang te ON td.id_sub_barang=te.id_sub_barang INNER JOIN m_class tf ON te.id_class=tf.id_class LEFT JOIN (SELECT ta.id_sub_barang, SUM(ta.qty) AS qty_total FROM t_wh_detail ta WHERE ta.id_job='1' GROUP BY ta.id_sub_barang) tg ON te.id_sub_barang=tg.id_sub_barang LEFT JOIN (SELECT ta.id_job, ta.id_sub_barang, SUM(ta.qty) AS qty_pakai FROM t_production_detail ta WHERE ta.kode_produksi LIKE '%/RLZ-%' GROUP BY ta.id_sub_barang) th ON te.id_sub_barang=th.id_sub_barang LEFT JOIN m_customer_suplier ms on ms.id_customer = ta.id_supplier  WHERE ta.id_job='$in->id' AND tb.id_jenis_mutasi='13' AND tf.kode_class='01'";	
			$sql = "SELECT * FROM ($sqlmain) pa";	
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
					$qty_sisa = $r->qty_total - $r->qty_pakai;	
					if($qty_sisa>=$r->qty) $qty_max = $r->qty;	
					else $qty_max = $qty_sisa;	
					$r->qty_max = $qty_max;	
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
		}else{	
			$k = new stdClass();	
			$data = [];	
			$k->draw = $in->draw;	
			$k->recordsTotal = 0;	
			$k->recordsFiltered = 0;	
			$k->data = $data;	
			return $k;	
		}	

	}


	function viewDtRealisasi($kat, $opt = true)	
	{	
		$in = a2o($this->in);	
		if(isset($in->id)){	
			$start = $in->start;	
			$sqlmain = "SELECT ta.id_sub_barang, ta.nama_barang, ta.kode_barang, ta.uraian_satuan_terkecil, ta.unit_konversi, tb.id_wh_detail, tb.id_job, tc.no_job, tb.kode_produksi, te.seri_barang FROM v_sub_barang ta LEFT JOIN t_wh_detail tb ON ta.id_sub_barang=tb.id_sub_barang LEFT JOIN t_job tc ON tb.id_job=tc.id_job LEFT JOIN t_production td ON tc.id_job=td.id_job LEFT JOIN t_production_detail te ON td.id_production=te.id_production WHERE ta.id_class='$kat'";	
			$sql = "SELECT * FROM ($sqlmain) pa";	
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
					if(!$r->kode_produksi) $r->kode_produksi = '-';	
					if(!$r->no_job) $r->no_job = '-';	
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
		}else{	
			$k = new stdClass();	
			$data = [];	
			$k->draw = $in->draw;	
			$k->recordsTotal = 0;	
			$k->recordsFiltered = 0;	
			$k->data = $data;	
			return $k;	
		}	
	}

	function viewPackingDT($in, $opt = true)
	{
		$start = $in->start;
		$sqlexclude = "SELECT tb.id_production_detail FROM ( SELECT id_production_detail, production_material FROM t_production ta, t_production_detail tb WHERE ta.id_production = tb.id_production AND ta.id_jenis_mutasi = 1 ) ta, t_production_detail tb WHERE tb.id_production_detail MEMBER of ( ta.production_material )";
		$sqlmain = "SELECT ta.id_production_detail, ta.id_production, ta.id_job, tg.no_job, tg.tanggal_job, tb.kode_mutasi, tb.tanggal_mutasi, ta.id_wh_detail, tc.id_header, tc.seri_barang, tc.id_detail_dn, tf.id_sub_barang, vsb.kode_barang, vsb.nama_barang, vsb.kode_satuan_terkecil AS kode_satuan, vsb.uraian_satuan_terbesar AS uraian_satuan, ta.qty, tc.harga_satuan, tc.rate, th.id_production_detail as ipd_packing FROM t_production_detail ta INNER JOIN t_production tb ON tb.id_production = ta.id_production INNER JOIN t_wh_detail tc ON tc.id_wh_detail = ta.id_wh_detail INNER JOIN t_detail_dn td ON td.id_detail_dn = tc.id_detail_dn INNER JOIN t_detail_po te ON te.id_detail_po = td.id_detail_po INNER JOIN t_detail_pp tf ON tf.id_detail_pp = te.id_detail_pp INNER JOIN v_sub_barang vsb ON vsb.id_sub_barang = tf.id_sub_barang INNER JOIN t_job tg ON tg.id_job = ta.id_job LEFT JOIN t_production_detail th on th.id_wh_detail = ta.id_wh_detail and th.id_jenis_mutasi = '1' WHERE tb.id_jenis_mutasi = 14 AND ta.deleted_at IS NULL and ta.id_production_detail NOT IN ($sqlexclude) ";
		if (isset($in->id_job)) {
			$sqlmain .= " and ta.id_job = '$in->id_job' ";
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

				$r->blank = "";

				if($opt){
					$r->option = '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
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

	function get($id)
	{
		$sql = "select * from $this->table where id_production = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}
	function getwip($id)
	{
		$sql = "SELECT
		tp.id_production,
		tpd.id_production_detail,
		tpd.id_job,
		tj.no_job 
	FROM
		t_production tp
		INNER JOIN t_production_detail tpd ON tpd.id_production = tp.id_production
		INNER JOIN v_sub_barang vb ON vb.id_sub_barang = tpd.id_sub_barang
		INNER JOIN t_job tj ON tj.id_job = tpd.id_job 
	WHERE
		tpd.id_wh_detail IS NULL 
		AND tj.no_job = '$id' 
		AND vb.id_class = 14";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function create($in)
	{
		$in->created_at = $this->nowdt;
		$in->updated_at = $this->nowdt;
		$in->kode_mutasi = $this->generateCode($in->tanggal_mutasi, $in->id_jenis_mutasi);
		// if($in->id_jenis_mutasi==14) $in->tanggal_mutasi = $this->nowd;	
		// $in->kode_mutasi = $this->generateCode($this->nowd, $in->id_jenis_mutasi);
		// $in->created_by = $this->session->userdata('id_user');
        // $in->updated_by = $this->session->userdata('id_user');
		$this->db->insert($this->table, $in);
		$id = $this->db->insert_id();
		return $id;
	}

	function update($in)
	{
		$in->updated_at = $this->nowdt;
		// $in->updated_by = $this->session->userdata('id_user');
		$this->db->where($this->table_id, $in->{$this->table_id});
		$this->db->update($this->table, $in);
	}

	function delete($id)
	{
		$b = new stdClass();
		$b->deleted_at = $this->nowdt;
		// $b->deleted_by = $this->session->userdata('id_user');
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

	function updatePosting($in)
	{
		$in->updated_at = $this->nowdt;
		$this->db->where($this->table_id, $in->id_production);
		$this->db->update($this->table, $in);
	}

	function getAllPosting()
	{
		$sql = "SELECT b.jumlah_rp_detail, c.jumlah_rp_result, a.* FROM (SELECT b.no_job, a.* from t_production a LEFT JOIN t_job b on a.id_bom = b.id_bom AND a.id_bom_workflow = b.id_bom_workflow WHERE a.id_jenis_mutasi = '14') a LEFT JOIN (SELECT id_production, SUM(qty_detail*harga_satuan*rate) as jumlah_rp_detail FROM t_production_detail GROUP BY id_production) b on a.id_production = b.id_production LEFT JOIN (SELECT id_production, SUM(qty_result*harga_satuan*rate) as jumlah_rp_result FROM t_production_result GROUP BY id_production) c on a.id_production = c.id_production";
		$res = $this->db->query($sql);
		$data = array();
		foreach ($res->result() as $r){
			$data[] = $r;
		}
		// printJSON($data);

		return $data;
	}

}


