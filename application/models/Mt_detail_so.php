<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_detail_so extends CI_Model
{
	var $table = 't_detail_po';
	var $table_id = 'id_detail_po';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "select ta.*, te.kode_po, tb.kode_barang, tb.nama_barang as nama_sub_barang, tc.kode_kemasan, tc.uraian_kemasan, td.kode_satuan, td.uraian_satuan, tb.id_satuan_terkecil, sk.kode_satuan as kode_satuan_terkecil, sk.uraian_satuan as uraian_satuan_terkecil, tb.id_satuan_terbesar, sb.kode_satuan as kode_satuan_terbesar, sb.uraian_satuan as uraian_satuan_terbesar from $this->table ta left join m_sub_barang as tb on tb.id_sub_barang = ta.id_sub_barang left join smartone_tpb_dps1.referensi_kemasan as tc on tc.id = ta.id_kemasan left join smartone_tpb_dps1.referensi_satuan as td on td.id = ta.id_satuan left join smartone_tpb_dps1.referensi_satuan sk on sk.id = tb.id_satuan_terkecil left join smartone_tpb_dps1.referensi_satuan as sb on sb.id = tb.id_satuan_terbesar inner join t_po as te on te.id_po = ta.id_po inner join m_customer_suplier as tf on tf.id_customer = te.id_supplier where te.type_trans = 'sales' and ta.deleted_at is null";
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

	function viewBasedSOId($id_po)
	{
		$sql = $this->basesql." and ta.id_po = '$id_po'";
		$res = $this->db->query($sql);

		$data = array();
		foreach ($res->result() as $r){
			$data[] = $r;
		}

		return $data;
	}

	function viewDT($in)
	{
		$start = $in->start;
		$this->db->select("ta.*, tb.kode_barang, tb.nama_barang as nama_sub_barang, tc.kode_kemasan, tb.id_satuan_terkecil, sk.KODE_SATUAN as kode_satuan_kecil, tb.id_satuan_terbesar, sb.KODE_SATUAN as kode_satuan_besar, td.kode_po, td.id_supplier, td.po_buyer, td.tanggal_dibuat, te.nama_consignee as nama_supplier, tf.KODE_VALUTA as kode_valuta, tf.URAIAN_VALUTA as nama_valuta, tg.KODE_SATUAN as kode_satuan, tg.URAIAN_SATUAN as nama_satuan");
		$this->db->from("$this->table as ta");
		$this->db->join("m_sub_barang as tb", "tb.id_sub_barang = ta.id_sub_barang", "left");
		$this->db->join("smartone_tpb_dps1.referensi_kemasan as tc", "tc.id = ta.id_kemasan", "left");
		$this->db->join("t_po as td", "td.id_po = ta.id_po", "left");
		$this->db->join("m_customer_suplier as te", "te.id_customer = td.id_supplier", "left");
		$this->db->join("smartone_tpb_dps1.referensi_valuta as tf", "tf.id = td.id_valuta", "left");
		$this->db->join("smartone_tpb_dps1.referensi_satuan as tg", "tg.id = ta.id_satuan", "left");
		$this->db->join("smartone_tpb_dps1.referensi_satuan as sk", "sk.id = tb.id_satuan_terkecil", "left");
		$this->db->join("smartone_tpb_dps1.referensi_satuan as sb", "sb.id = tb.id_satuan_terbesar", "left");
		$this->db->where("td.type_trans = 'sales'");
		$this->db->where("ta.deleted_at is null");
		if (isset($in->id_supplier)) {
			$this->db->where('td.id_supplier', $in->id_supplier);
		}
		if (isset($in->id_tipe_sales)) {
			$this->db->where('td.id_tipe_sales', $in->id_tipe_sales);
		}
		if (isset($in->start_date)) {
			$this->db->where('td.tanggal_dibuat >= ', reverseDate($in->start_date));
		}
		if (isset($in->end_date)) {
			$this->db->where('td.tanggal_dibuat <= ', reverseDate($in->end_date));
		}

		$sqlmain = $this->db->get_compiled_select();
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
				$r->option = '<a href="'.base_url('procurement/purchase_order/detail/'.$r->id_po).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
				$r->option .= '<a href="'.base_url('procurement/purchase_order/edit/'.$r->id_po).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
				$r->option .= '<button type="button" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url('procurement/purchase_order/delete/'.$r->id_po).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></button>';
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

	function viewBOMDT($in)
	{
		$start = $in->start;
		$sqlmain = "SELECT ma.*, ifnull( qty_total - sisa, 0 ) qty_bom, CASE WHEN sisa IS NOT NULL THEN sisa ELSE qty_total END qty_sisa_bom FROM ( SELECT id_detail_po, id_po, kode_po, tanggal_dibuat, id_supplier, nama_supplier, id_tipe_sales, nama_tipe_sales, id_valuta, kode_valuta, uraian_valuta, id_sub_barang, kode_barang, nama_barang AS nama_sub_barang, unit_konversi, qty_po qty_total, id_satuan, kode_satuan, satuan uraian_satuan, id_kemasan, kode_kemasan, uraian_kemasan, qty_mc, harga, approval_1, approval_2 FROM ( SELECT tb.id_detail_po, tb.id_po, ta.kode_po, ta.tanggal_dibuat, ta.id_tipe_sales, tf.nama_tipe_sales, ta.id_valuta, tg.KODE_VALUTA kode_valuta, tg.URAIAN_VALUTA uraian_valuta, ta.id_supplier, te.NAMA nama_supplier, tb.id_sub_barang, tc.kode_barang, tc.nama_barang, tc.unit_konversi, tb.id_kemasan, th.KODE_KEMASAN kode_kemasan, th.URAIAN_KEMASAN uraian_kemasan, tb.qty_mc, tb.id_satuan, KODE_SATUAN kode_satuan, td.URAIAN_SATUAN satuan, tb.harga, ta.approval_1, ta.approval_2, qty_po FROM t_po ta left join t_detail_po tb on ta.id_po = tb.id_po left join m_sub_barang tc on tb.id_sub_barang = tc.id_sub_barang left join smartone_tpb_dps1.referensi_satuan td on tb.id_satuan = td.ID left join smartone_tpb_dps1.referensi_pemasok te on ta.id_supplier = te.ID left join m_tipe_sales tf on ta.id_tipe_sales = tf.id_tipe_sales left join smartone_tpb_dps1.referensi_valuta tg on ta.id_valuta = tg.ID left join smartone_tpb_dps1.referensi_kemasan th on tb.id_kemasan = th.ID WHERE ta.type_trans = 'sales' ) pa WHERE pa.id_detail_po NOT IN ( SELECT id_detail_po FROM ( SELECT pa.id_detail_po, sum( pa.qty ) qty_po, max FROM t_bom pa, ( SELECT ta.*, tb.id_detail_po, qty_po max FROM t_po ta, t_detail_po tb WHERE ta.id_po = tb.id_po AND ta.type_trans = 'sales' ) pb WHERE pa.id_detail_po = pb.id_detail_po GROUP BY pa.id_detail_po ) na WHERE qty_po = max )) ma LEFT JOIN ( SELECT id_detail_po, max - qty_po sisa FROM ( SELECT pa.id_detail_po, sum( pa.qty ) qty_po, max FROM t_bom pa, ( SELECT ta.*, tb.id_detail_po, qty_po max FROM t_po ta, t_detail_po tb WHERE ta.id_po = tb.id_po AND ta.type_trans = 'sales' ) pb WHERE pa.id_detail_po = pb.id_detail_po GROUP BY pa.id_detail_po ) na WHERE qty_po < max ) mb ON ma.id_detail_po = mb.id_detail_po WHERE approval_1 = '1' AND approval_2 = '1'";
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
				$r->option = '<a href="'.base_url('procurement/purchase_order/detail/'.$r->id_po).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
				$r->option .= '<a href="'.base_url('procurement/purchase_order/edit/'.$r->id_po).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
				$r->option .= '<button type="button" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url('procurement/purchase_order/delete/'.$r->id_po).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></button>';
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

	function viewStuffingDT($in)
	{
		$start = $in->start;
		$sqlmain = "SELECT ma.*, ifnull( qty_total - sisa, 0 ) qty_bom, CASE WHEN sisa IS NOT NULL THEN sisa ELSE qty_total END qty_sisa_stuffing FROM ( SELECT id_detail_po, id_po, kode_po, po_buyer, tanggal_dibuat, id_supplier, nama_supplier, id_tipe_sales, nama_tipe_sales, id_valuta, kode_valuta, uraian_valuta, id_sub_barang, kode_barang, nama_barang AS nama_sub_barang, qty_po qty_total, id_satuan, kode_satuan, satuan uraian_satuan, id_kemasan, kode_kemasan, uraian_kemasan, qty_mc, harga, approval_1, approval_2 FROM ( SELECT tb.id_detail_po, tb.id_po, ta.kode_po, ta.po_buyer, ta.tanggal_dibuat, ta.id_tipe_sales, tf.nama_tipe_sales, ta.id_valuta, tg.KODE_VALUTA kode_valuta, tg.URAIAN_VALUTA uraian_valuta, ta.id_supplier, te.NAMA nama_supplier, tb.id_sub_barang, tc.kode_barang, tc.nama_barang, tb.id_kemasan, th.KODE_KEMASAN kode_kemasan, th.URAIAN_KEMASAN uraian_kemasan, tb.qty_mc, tb.id_satuan, KODE_SATUAN kode_satuan, td.URAIAN_SATUAN satuan, tb.harga, ta.approval_1, ta.approval_2, qty_po FROM t_po ta LEFT JOIN t_detail_po tb ON ta.id_po = tb.id_po LEFT JOIN m_sub_barang tc ON tb.id_sub_barang = tc.id_sub_barang LEFT JOIN smartone_tpb_dps1.referensi_satuan td ON tb.id_satuan = td.ID LEFT JOIN smartone_tpb_dps1.referensi_pemasok te ON ta.id_supplier = te.ID LEFT JOIN m_tipe_sales tf ON ta.id_tipe_sales = tf.id_tipe_sales LEFT JOIN smartone_tpb_dps1.referensi_valuta tg ON ta.id_valuta = tg.ID LEFT JOIN smartone_tpb_dps1.referensi_kemasan th ON tb.id_kemasan = th.ID WHERE ta.type_trans = 'sales' ) pa WHERE pa.id_detail_po NOT IN ( SELECT id_detail_po FROM ( SELECT pa.id_detail_po, sum( pa.qty_si_real ) qty_po, max FROM t_detail_stuffing pa, ( SELECT ta.*, tb.id_detail_po, qty_po max FROM t_po ta, t_detail_po tb WHERE ta.id_po = tb.id_po AND ta.type_trans = 'sales' ) pb WHERE pa.id_detail_po = pb.id_detail_po GROUP BY pa.id_detail_po ) na WHERE qty_po = max )) ma LEFT JOIN ( SELECT id_detail_po, max - qty_po sisa FROM ( SELECT pa.id_detail_po, sum( pa.qty_si_real ) qty_po, max FROM t_detail_stuffing pa, ( SELECT ta.*, tb.id_detail_po, qty_po max FROM t_po ta, t_detail_po tb WHERE ta.id_po = tb.id_po AND ta.type_trans = 'sales' ) pb WHERE pa.id_detail_po = pb.id_detail_po GROUP BY pa.id_detail_po ) na WHERE qty_po < max ) mb ON ma.id_detail_po = mb.id_detail_po WHERE approval_1 = '1' AND approval_2 = '1'";
		if (isset($this->in->id_supplier)) {
			$sqlmain .= " and id_supplier = '".$this->in->id_supplier."' ";
		}
		if (isset($this->in->id_tipe_sales)) {
			$sqlmain .= " and id_tipe_sales = '".$this->in->id_tipe_sales."' ";
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
				$r->option = '<a href="'.base_url('procurement/purchase_order/detail/'.$r->id_po).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
				$r->option .= '<a href="'.base_url('procurement/purchase_order/edit/'.$r->id_po).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
				$r->option .= '<button type="button" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url('procurement/purchase_order/delete/'.$r->id_po).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></button>';
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
		$a = $this->in;
		$sql = "select * from $this->table where $this->table_id='$id' and deleted_at is null";
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
        $this->db->where($this->table_id, $in->id_detail_po);
        $this->db->update($this->table, $in);
    }

    function delete($id)
    {
        $b = new stdClass();
        $b->deleted_at = $this->nowdt;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }

	function deleteBasedSOId($id_po)
	{
		$b = new stdClass();
		$b->deleted_at = $this->nowdt;
		$this->db->where('id_po', $id_po);
		$this->db->update($this->table, $b);
	}

	function viewplanningstuffingdt($in, $opt = true)
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


}
