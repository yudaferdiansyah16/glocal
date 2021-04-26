<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_production_detail extends CI_Model
{
	var $table = 't_production_detail';
	var $table_id = 'id_production_detail';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "SELECT * FROM $this->table ta WHERE ta.deleted_at IS NULL";
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

				$st_checked = '';
				if($r->id_status) $st_checked = 'checked';
				$r->status_trans = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="switch'.$i.'" data-url="'.base_url('master/'.$this->d->_method.'/changeStatus').'" data-id="'.$r->{$this->table_id}.'" data-key="'.$this->table_id.'" data-status="id_status" onclick="changeStatus(this)" '.$st_checked.'><label class="custom-control-label" for="switch'.$i.'"></label></div>';

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
		$sql = $this->basesql." and ta.$this->table_id = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function getFg($id)
	{
		$sql = "SELECT
		tpd.id_production,
		-- tpd.id_production_detail,
		-- vb.nama_barang,
		tdn.id_detail_dn,

		tpd.id_job,
		tpd.id_sub_barang,
		vb.id_satuan_terkecil,
		tpd.tanggal_produksi,
		vb.id_satuan_terbesar,
		td.ID_HEADER,
		tpd.qty 
	FROM
		t_production_detail tpd
		INNER JOIN t_production tp ON tp.id_production = tpd.id_production
		INNER JOIN v_sub_barang vb ON vb.id_sub_barang = tpd.id_sub_barang
		INNER JOIN m_class mc ON vb.id_class = mc.id_class
		INNER JOIN t_detail_dn tdn ON tp.id_detail_dn = tdn.id_detail_dn
		INNER JOIN t_dn td ON td.id_dn = tdn.id_dn 
	WHERE
		mc.id_class = '02' 
		AND tpd.id_production = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function getWhere($in)
	{
		// if($in->klasifikasi == 'ALL'){
		$sql = "SELECT DISTINCT ta.id_production FROM t_production ta LEFT JOIN t_production_detail tb ON ta.id_production = tb.id_production LEFT JOIN t_job tc ON tb.id_job=tc.id_job LEFT JOIN t_detail_job td ON tc.id_job=td.id_job LEFT JOIN t_bom te ON tb.id_bom=te.id_bom LEFT JOIN t_bom_detail tf ON te.id_bom=tf.id_bom WHERE ta.deleted_at IS NULL AND (ta.tanggal_mutasi BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') and ta.is_posting = 0";
		// }else{
		// 	$sql = "SELECT ta.*, tb.satuan_terkecil, tb.qty, tb.harga_satuan FROM t_production ta LEFT JOIN t_production_detail tb ON ta.id_production = tb.id_production WHERE ta.deleted_at IS NULL AND ta.id_supplier = '".$in->customer."' AND (ta.tanggal_mutasi BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') and ta.is_posting = 0";
		// }
		$res = $this->db->query($sql);
		$result = $res->result();
		return $result;
	}

	function getDetail($id, $klasifikasi)
	{
		if($klasifikasi == 'ALL'){
			$sql = "select td.id_production, td.id_sub_barang, td.satuan_terkecil, td.qty, td.harga_satuan, ifnull(td.qty * td.harga_satuan, 0) as amount, tv.nama_barang, tv.kode_barang, tv.kode_satuan_terkecil, tc.id_akun, tc.id_akun_lawan, tx.kode_akun, tx.nama_akun, ty.kode_akun as kode_akun_lawan, ty.nama_akun as nama_akun_lawan, tj.no_job from t_production_detail td left join v_sub_barang tv on td.id_sub_barang=tv.id_sub_barang left join m_class tc on tv.id_class=tc.id_class left join m_akun tx on tc.id_akun=tx.id_akun left join m_akun ty on tc.id_akun_lawan=ty.id_akun left join t_job tj on td.id_job=tj.id_job where td.id_production = '$id'";
		}else{
			$sql = "select td.id_production, td.id_sub_barang, td.satuan_terkecil, td.qty, td.harga_satuan, ifnull(td.qty * td.harga_satuan, 0) as amount, tv.nama_barang, tv.kode_barang, tv.kode_satuan_terkecil, tc.id_akun, tc.id_akun_lawan, tx.kode_akun, tx.nama_akun, ty.kode_akun as kode_akun_lawan, ty.nama_akun as nama_akun_lawan, tj.no_job from t_production_detail td left join v_sub_barang tv on td.id_sub_barang=tv.id_sub_barang left join m_class tc on tv.id_class=tc.id_class left join m_akun tx on tc.id_akun=tx.id_akun left join m_akun ty on tc.id_akun_lawan=ty.id_akun left join t_job tj on td.id_job=tj.id_job where td.id_production = '$id' and tv.id_class='$klasifikasi'";
		}
		$res = $this->db->query($sql);
		$row = $res->result_array();
		return $row;
	}

	function getRate($id)
	{
		$sql = "select distinct tpo.rate from t_dn tdn inner join t_detail_dn tdnd on tdn.id_dn = tdnd.id_dn left join t_detail_po tdpo on tdnd.id_detail_po = tdpo.id_detail_po inner join t_po tpo on tdpo.id_po = tpo.id_po where tdn.id_dn = '$id'";
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

}
