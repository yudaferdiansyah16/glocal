<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_detail_job extends CI_Model
{
	var $table = 't_detail_job';
	var $table_id = 'id_detail_job';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "SELECT ta.*, tc.id_satuan, te.kode_bom, te.tanggal_bom, td.nama_bagian, ti.nama_workflow, tj.kode_barang, tj.nama_barang AS nama_sub_barang, tk.KODE_SATUAN AS kode_satuan, tk.URAIAN_SATUAN AS uraian_satuan, th.NAMA AS nama_supplier, tg.kode_po, tc.qty_bom, tl.qty_total_job FROM t_detail_job ta INNER JOIN t_job tb ON ta.id_job = tb.id_job INNER JOIN t_bom_detail tc ON tc.id_bom_detail = ta.id_bom_detail INNER JOIN t_bom_workflow td ON td.id_bom_workflow = tc.id_bom_workflow INNER JOIN t_bom te ON te.id_bom = tc.id_bom LEFT JOIN t_detail_po tf ON tf.id_detail_po = te.id_detail_po LEFT JOIN t_po tg ON tg.id_po = tf.id_po LEFT JOIN smartone_tpb_dps1.referensi_pemasok AS th ON th.ID = tg.id_supplier LEFT JOIN m_workflow ti ON ti.id_workflow = td.id_workflow LEFT JOIN m_sub_barang tj ON tj.id_sub_barang = tc.id_sub_barang LEFT JOIN smartone_tpb_dps1.referensi_satuan tk ON tk.ID = tc.id_satuan LEFT JOIN ( SELECT id_bom_detail, SUM( qty_job ) AS qty_total_job FROM t_detail_job where deleted_at is null GROUP BY id_bom_detail ) tl ON tl.id_bom_detail = ta.id_bom_detail WHERE ta.deleted_at IS NULL";
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

	function viewByJob($id_job)
	{
		$sql = $this->basesql." and ta.id_job = '$id_job'";
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
					$r->option .= '&nbsp;<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
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

	function viewDetailjobPP($in, $opt = true)
	{
		$start = $in->start;
		// $sqlmain = "select ta.id_detail_job, ta.harga, case when td.qty_pp > 0 then (ta.qty_job - td.qty_pp) else ta.qty_job end as qty_sisa, ta.keterangan, ta.id_status, tb.no_job, tc.id_sub_barang, tc.kode_barang, tc.nama_barang, tc.nama_brand, tc.dimensi, tc.size, tc.colour, tc.nama_style from t_detail_job ta inner join t_job tb on ta.id_job = tb.id_job inner join (select xa.id_bom_detail, xb.id_sub_barang, xb.kode_barang, xb.nama_barang, xb.nama_brand, xb.dimensi, xb.size, xb.colour, xb.nama_style from t_bom_detail xa inner join v_sub_barang xb on xa.id_sub_barang = xb.id_sub_barang) tc on ta.id_bom_detail = tc.id_bom_detail left join (select xb.flag_btl, xa.id_detail_pp, xa.id_detail_job, sum(xa.qty_pp) as qty_pp from t_detail_pp xa inner join t_pp xb on xa.id_pp = xb.id_pp where xb.deleted_at is null and ( xb.flag_btl = '0' or xb.flag_btl is null ) group by xa.id_detail_job) td on ta.id_detail_job = td.id_detail_job where ta.deleted_at is null having qty_sisa > 0";
		$sqlstock = "SELECT ta.id_sub_barang, tb.kode_barang, tb.nama_barang, ta.id_satuan_terkecil as id_satuan, te.KODE_SATUAN AS kode_satuan, tb.nama_class, SUM( CASE WHEN td.id_status = 'IN' THEN ta.qty ELSE ((- 1 ) * ta.qty) END ) AS qty FROM t_wh_detail ta LEFT JOIN v_sub_barang tb ON tb.id_sub_barang = ta.id_sub_barang LEFT JOIN t_wh tc ON tc.id_wh = ta.id_wh LEFT JOIN m_jenis_mutasi td ON td.id_jenis_mutasi = tc.id_jenis_mutasi LEFT JOIN smartone_tpb_dps1.referensi_satuan te ON te.ID = ta.id_satuan_terkecil WHERE tc.approval_1 = '1' AND tc.approval_2 = '1' GROUP BY ta.id_sub_barang, tb.kode_barang, tb.nama_barang, ta.id_satuan_terkecil, te.KODE_SATUAN, tb.nama_class HAVING SUM( CASE WHEN td.id_status = 'IN' THEN ta.qty ELSE ((- 1 ) * ta.qty) END ) > 0";
		$sqlmain = "select ta.id_detail_job, ta.harga, case when td.qty_pp > 0 then (ta.qty_job - td.qty_pp) else ta.qty_job end as qty_sisa, ifnull(te.qty, 0) as qty_stock, ta.keterangan, ta.id_status, tb.no_job, tc.id_sub_barang, tc.kode_barang, tc.nama_barang, tc.nama_brand, tc.dimensi, tc.size, tc.colour, tc.nama_style, tc.kode_satuan from t_detail_job ta inner join t_job tb on ta.id_job = tb.id_job inner join (select xa.id_bom_detail, xb.id_sub_barang, xb.kode_barang, xb.nama_barang, xb.nama_brand, xb.dimensi, xb.size, xb.colour, xb.nama_style, xb.kode_satuan_terkecil kode_satuan from t_bom_detail xa inner join v_sub_barang xb on xa.id_sub_barang = xb.id_sub_barang) tc on ta.id_bom_detail = tc.id_bom_detail left join (select xb.flag_btl, xa.id_detail_pp, xa.id_detail_job, sum(xa.qty_pp) as qty_pp from t_detail_pp xa inner join t_pp xb on xa.id_pp = xb.id_pp where xb.deleted_at is null and ( xb.flag_btl = '0' or xb.flag_btl is null ) group by xa.id_detail_job) td on ta.id_detail_job = td.id_detail_job left join ($sqlstock) te on te.id_sub_barang = tc.id_sub_barang where ta.deleted_at is null having qty_sisa > 0";
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
		$sql = $this->basesql." and $this->table_id = '$id'";
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
