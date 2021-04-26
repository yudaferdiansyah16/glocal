<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_wh_buffer extends CI_Model
{
	var $table = 't_wh_buffer';
	var $table_id = 'id_wh_buffer';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "SELECT ta.* FROM $this->table ta WHERE ta.deleted_at IS NULL";
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

				$st_checked = '';
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

	function viewDetailStockDT($in, $opt = true)
	{
		$start = $in->start;
		$sqlstock = "SELECT ta.id_detail_dn, ta.id_job, ta.id_production, ta.id_koordinat, ta.harga_satuan, ta.rate, ta.id_sub_barang, ta.id_satuan_terkecil AS id_satuan, SUM( CASE WHEN td.id_status = 'IN' THEN ta.qty ELSE ((- 1 ) * ta.qty ) END ) AS qty_stock FROM t_wh_detail ta LEFT JOIN t_wh tc ON tc.id_wh = ta.id_wh LEFT JOIN m_jenis_mutasi td ON td.id_jenis_mutasi = tc.id_jenis_mutasi WHERE tc.approval_1 = '1' AND tc.approval_2 = '1' GROUP BY ta.id_detail_dn, ta.id_job, ta.id_production, ta.id_koordinat, ta.harga_satuan, ta.rate, ta.id_sub_barang, ta.id_satuan_terkecil HAVING SUM( CASE WHEN td.id_status = 'IN' THEN ta.qty ELSE ((- 1 ) * ta.qty ) END ) > 0 ";
		$sqlmain = "SELECT xa .*, xb.kode_barang, xb.nama_barang, xb.nama_class, xc.KODE_SATUAN kode_satuan, xd.no_job, xd.id_bom, xe.no_sj, xe.tanggal_sj, xf.tgl_kedatangan, xg.NOMOR_AJU nomor_aju, xg.TANGGAL_AJU tanggal_aju, xg.NOMOR_DAFTAR nomor_daftar, xg.TANGGAL_DAFTAR tanggal_daftar, xh.nama_koordinat, xi.nama_gudang, xl.po_buyer, xm.nama as nama_customer FROM ($sqlstock) xa LEFT JOIN v_sub_barang xb ON xb.id_sub_barang = xa.id_sub_barang LEFT JOIN ".getdbtpb($this).".referensi_satuan xc ON xc.ID = xa.id_satuan LEFT JOIN t_job xd ON xd.id_job = xa.id_job LEFT JOIN t_detail_dn xe ON xe.id_detail_dn = xa.id_detail_dn LEFT JOIN t_dn xf ON xf.id_dn = xe.id_dn LEFT JOIN ".getdbtpb($this).".tpb_header xg ON xg.ID = xf.ID_HEADER LEFT JOIN m_koordinat xh on xh.id_koordinat = xa.id_koordinat LEFT JOIN m_gudang xi on xi.id_gudang = xh.id_gudang LEFT JOIN t_bom xj ON xj.id_bom = xd.id_bom LEFT JOIN t_detail_po xk ON xk.id_detail_po = xj.id_detail_po LEFT JOIN t_po xl ON xl.id_po = xk.id_po LEFT JOIN m_customer_suplier xm ON xm.id_customer = xl.id_supplier";
		if (isset($this->in->id_supplier)) {
			$sqlmain .= " and ti.id_supplier = '".$this->in->id_supplier."' ";
		}
		if (isset($this->in->id_tipe_sales)) {
			$sqlmain .= " and ti.id_tipe_sales = '".$this->in->id_tipe_sales."' ";
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
				$r->blank = '';

				if($opt){
					$r->option = "<button class='btn btn-xs btn-success btn-detail'><i class='fa fal fa-plus-circle'></i> Show</button>";
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

	function deleteWhere($arrClause)
	{
		$this->db->delete($this->table, $arrClause);
	}
}
