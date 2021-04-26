<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Vt_issue_material_detail extends CI_Model
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
		$sqlstock = "SELECT ta.id_detail_dn, ta.id_job, ta.id_production, ta.id_koordinat, ta.harga_satuan, ta.rate, ta.id_sub_barang, ta.id_satuan_terkecil AS id_satuan, SUM( CASE WHEN td.id_status = 'IN' THEN ta.qty ELSE ((- 1 ) * ta.qty ) END ) AS qty_stock FROM t_wh_detail ta LEFT JOIN t_wh tc ON tc.id_wh = ta.id_wh LEFT JOIN m_jenis_mutasi td ON td.id_jenis_mutasi = tc.id_jenis_mutasi WHERE tc.approval_1 = '1' AND tc.approval_2 = '1' GROUP BY ta.id_detail_dn, ta.id_job, ta.id_production, ta.id_koordinat, ta.harga_satuan, ta.rate, ta.id_sub_barang, ta.id_satuan_terkecil HAVING SUM( CASE WHEN td.id_status = 'IN' THEN ta.qty ELSE ((- 1 ) * ta.qty ) END ) > 0 ";
		$this->basesql = "SELECT ta.*, tb.qty_dn, tb.no_sj, tb.tanggal_sj, tb.harga, tb.seri_barang, tc.id_supplier, tc.id_fasilitas, tc.kode_dn, tc.no_invoice, tc.tgl_kedatangan, tc.ID_HEADER as id_header, te.kode_barang, te.nama_barang, tf.KODE_SATUAN kode_satuan, tf.URAIAN_SATUAN uraian_satuan, tj.kode_po, tj.tanggal_dibuat, tk.kode_valuta, tk.uraian_valuta, tl.id_akun, tm.id_jenis_mutasi, tm.kode_mutasi, tm.tanggal_terima, tn.NAMA as nama_supplier, tr.no_job, tr.tanggal_job, tt.nama_gudang, ts.nama_koordinat, ifnull(tu.qty_stock, 0) as qty_stock FROM t_wh_buffer ta LEFT JOIN t_detail_dn tb ON tb.id_detail_dn = ta.id_detail_dn LEFT JOIN t_dn tc ON tc.id_dn = tb.id_dn LEFT JOIN m_fasilitas td ON td.id_fasilitas = tc.id_fasilitas LEFT JOIN m_sub_barang AS te ON te.id_sub_barang = ta.id_sub_barang LEFT JOIN ".getdbtpb($this).".referensi_satuan tf ON tf.ID = ta.id_satuan LEFT JOIN t_detail_po ti on ti.id_detail_po = tb.id_detail_po LEFT join t_po tj on tj.id_po = ti.id_po left join ".getdbtpb($this).".referensi_valuta as tk on tk.ID = tj.id_valuta LEFT JOIN m_class tl on tl.id_class = te.id_class LEFT JOIN t_wh tm on tm.id_wh = ta.id_wh left JOIN ".getdbtpb($this).".referensi_pengusaha tn ON tn.ID = tc.id_supplier LEFT JOIN t_detail_pp tp ON tp.id_detail_pp = ti.id_detail_pp LEFT JOIN t_detail_job tq ON tq.id_detail_job = tp.id_detail_job LEFT JOIN t_job tr ON tr.id_job = tq.id_job LEFT JOIN m_koordinat ts on ts.id_koordinat = ta.id_koordinat_asal LEFT JOIN m_gudang tt ON tt.id_gudang = ts.id_gudang LEFT JOIN ($sqlstock) tu on tu.id_detail_dn = ta.id_detail_dn and tu.id_job = ta.id_job and tu.id_production = ta.id_production and tu.id_koordinat = ta.id_koordinat_asal and tu.rate = ta.rate and tu.id_sub_barang = ta.id_sub_barang and tu.id_satuan = ta.id_satuan WHERE ta.deleted_at IS NULL and tm.id_jenis_mutasi IN (13, 15, 16, 17) ";
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
		if (isset($in->id_supplier)) {
			$sqlmain .= " and tc.id_supplier = '$in->id_supplier' ";
		}
		if (isset($in->id_fasilitas)) {
			$sqlmain .= " and tc.id_fasilitas = '$in->id_fasilitas' ";
		}
		if (isset($in->start_date)) {
			$sqlmain .= ' and tm.tanggal_terima >= "'.reverseDate($in->start_date).'" ';
		}
		if (isset($in->end_date)) {
			$sqlmain .= ' and tm.tanggal_terima <= "'.reverseDate($in->end_date).'" ';
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
