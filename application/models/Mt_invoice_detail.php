<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_invoice_detail extends CI_Model
{
	var $table = 't_invoice_detail';
	var $table_id = 'id_invoice_detail';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "select ts.kode_stuffing,ts.tanggal_stuffing, ta.*, tb.kode_barang, tb.nama_barang, te.id_po, te.kode_po, te.po_buyer, te.tanggal_dibuat, tb.kode_satuan_terkecil as kode_satuan, tb.kode_kemasan from $this->table ta left join v_sub_barang tb on tb.id_sub_barang = ta.id_sub_barang left join t_detail_stuffing tc on tc.id_detail_stuffing= ta.id_detail_stuffing left join t_stuffing ts on ts.id_stuffing = tc.id_stuffing  left join t_detail_po td on td.id_detail_po = tc.id_detail_po left join t_po te on te.id_po = td.id_po where ta.deleted_at is null";
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

	function viewByInvoiceId($id_invoice)
	{
		$sql = $this->basesql." and ta.id_invoice = '$id_invoice'";
		$res = $this->db->query($sql);

		$data = array();
		foreach ($res->result() as $r){
			$data[] = $r;
		}

		return $data;
	}

	function viewInvoiceDT($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = "SELECT ta.*, te.tanggal_stuffing, te.kode_stuffing, tb.kode_barang, tb.nama_barang, td.kode_po, td.po_buyer, td.id_supplier, td.id_tipe_sales, td.tanggal_dibuat, tb.kode_kemasan, tb.id_satuan_terkecil as id_satuan, tb.kode_satuan_terkecil kode_satuan, tb.nilai_kemasan, IFNULL(td.qty_invoice, 0) as qty_invoice, ta.qty_si_real - IFNULL(td.qty_invoice, 0) as qty_remain FROM t_detail_stuffing ta LEFT JOIN v_sub_barang tb ON tb.id_sub_barang = ta.id_sub_barang LEFT JOIN t_detail_po tc ON tc.id_detail_po = ta.id_detail_po LEFT JOIN t_po td ON td.id_po = tc.id_po LEFT JOIN ( SELECT id_detail_stuffing, sum( qty_invoice ) AS qty_invoice FROM t_invoice_detail GROUP BY id_detail_stuffing ) td ON td.id_detail_stuffing = ta.id_detail_stuffing LEFT JOIN t_stuffing te on te.id_stuffing = ta.id_stuffing WHERE ta.deleted_at IS NULL AND ta.qty_si_real - IFNULL(td.qty_invoice, 0) > 0";
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
		$sql = $this->basesql." and $this->table_id = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function create($in)
	{
		$this->db->insert($this->table, $in);
		$id = $this->db->insert_id();
		return $id;
	}

	function update($in)
	{
		$this->db->where($this->table_id, $in->id_invoice_detail);
		$this->db->update($this->table, $in);
	}

	function delete($in)
	{
		$this->db->where($this->table_id, $in->id);
		$this->db->delete($this->table);
	}
}
