<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_request_detail extends CI_Model
{
	var $table = 't_request_detail';
	var $table_id = 'id_request_detail';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$sqlrequest = "SELECT ta.id_sub_barang, ta.id_satuan, SUM( ta.qty_remain ) AS qty_request FROM ( SELECT ta.id_request, ta.id_sub_barang, ta.id_satuan, ta.qty_request, IFNULL( tb.qty_buffer, 0 ) qty_buffer, ta.qty_request - IFNULL( tb.qty_buffer, 0 ) qty_remain FROM t_request_detail ta LEFT JOIN ( SELECT xb.id_request, XA.id_sub_barang, XA.id_satuan, SUM( XA.qty ) qty_buffer FROM t_wh_buffer XA INNER JOIN t_wh xb ON xb.id_wh = XA.id_wh GROUP BY xb.id_request, XA.id_sub_barang, XA.id_satuan ) tb ON tb.id_request = ta.id_request AND tb.id_sub_barang = ta.id_sub_barang AND tb.id_satuan = ta.id_satuan WHERE ta.qty_request - IFNULL( tb.qty_buffer, 0 ) > 0 ) ta GROUP BY ta.id_sub_barang, ta.id_satuan";
		$sqlstock = "SELECT ta.id_sub_barang, tb.kode_barang, tb.nama_barang, tb.size, ta.id_satuan_terkecil as id_satuan, te.KODE_SATUAN AS kode_satuan, tb.nama_class, SUM( ta.qty ) AS qty_stock, IFNULL(tf.qty_request, 0) as qty_pending FROM t_wh_detail ta LEFT JOIN v_sub_barang tb ON tb.id_sub_barang = ta.id_sub_barang LEFT JOIN t_wh tc ON tc.id_wh = ta.id_wh LEFT JOIN m_jenis_mutasi td ON td.id_jenis_mutasi = tc.id_jenis_mutasi LEFT JOIN ".getdbtpb($this).".referensi_satuan te ON te.ID = ta.id_satuan_terkecil LEFT JOIN ($sqlrequest) tf ON tf.id_sub_barang = ta.id_sub_barang AND tf.id_satuan = ta.id_satuan_terkecil LEFT JOIN m_koordinat tg on tg.id_koordinat = ta.id_koordinat WHERE tc.approval_1 = '1' AND tc.approval_2 = '1' AND tg.id_gudang != '4' GROUP BY ta.id_sub_barang, tb.kode_barang, tb.nama_barang, ta.id_satuan_terkecil, te.KODE_SATUAN, tb.nama_class HAVING SUM( ta.qty ) > 0";
		$this->basesql = "SELECT ta.*, tb.KODE_SATUAN kode_satuan, tc.kode_barang, tc.nama_barang, tc.size, IFNULL(td.qty_stock, 0) qty_stock, IFNULL(td.qty_pending, 0) qty_pending FROM $this->table ta left join ".getdbtpb($this).".referensi_satuan tb on tb.ID = ta.id_satuan left join v_sub_barang tc on tc.id_sub_barang = ta.id_sub_barang left join ($sqlstock) td on td.id_sub_barang = ta.id_sub_barang and td.id_satuan = ta.id_satuan where ta.deleted_at is null";
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

	function viewBasedRequestId($id_request)
	{
		$sql = $this->basesql." and ta.id_request = '$id_request'";
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

	function viewStockRequestDT($in, $opt = true)
	{
		$start = $in->start;
		$sqlrequest = "SELECT ta.id_sub_barang, ta.id_satuan, SUM( ta.qty_remain ) AS qty_request FROM ( SELECT ta.id_request, ta.id_sub_barang, ta.id_satuan, ta.qty_request, IFNULL( tb.qty_buffer, 0 ) qty_buffer, ta.qty_request - IFNULL( tb.qty_buffer, 0 ) qty_remain FROM t_request_detail ta LEFT JOIN ( SELECT xb.id_request, XA.id_sub_barang, XA.id_satuan, SUM( XA.qty ) qty_buffer FROM t_wh_buffer XA INNER JOIN t_wh xb ON xb.id_wh = XA.id_wh GROUP BY xb.id_request, XA.id_sub_barang, XA.id_satuan ) tb ON tb.id_request = ta.id_request AND tb.id_sub_barang = ta.id_sub_barang AND tb.id_satuan = ta.id_satuan WHERE ta.qty_request - IFNULL( tb.qty_buffer, 0 ) > 0 ) ta GROUP BY ta.id_sub_barang, ta.id_satuan";
		$sqlmain = "SELECT ta.id_sub_barang, tb.kode_barang, tb.nama_barang, tb.size, ta.id_satuan_terkecil as id_satuan, te.KODE_SATUAN AS kode_satuan, tb.nama_class, SUM( ta.qty ) AS qty_stock, IFNULL(tf.qty_request, 0) as qty_pending FROM t_wh_detail ta LEFT JOIN v_sub_barang tb ON tb.id_sub_barang = ta.id_sub_barang LEFT JOIN t_wh tc ON tc.id_wh = ta.id_wh LEFT JOIN m_jenis_mutasi td ON td.id_jenis_mutasi = tc.id_jenis_mutasi LEFT JOIN ".getdbtpb($this).".referensi_satuan te ON te.ID = ta.id_satuan_terkecil LEFT JOIN ($sqlrequest) tf ON tf.id_sub_barang = ta.id_sub_barang AND tf.id_satuan = ta.id_satuan_terkecil LEFT JOIN m_koordinat tg on tg.id_koordinat = ta.id_koordinat WHERE tc.approval_1 = '1' AND tc.approval_2 = '1' AND tg.id_gudang != '4' GROUP BY ta.id_sub_barang, tb.kode_barang, tb.nama_barang, ta.id_satuan_terkecil, te.KODE_SATUAN, tb.nama_class HAVING SUM( ta.qty ) > 0";
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
}
