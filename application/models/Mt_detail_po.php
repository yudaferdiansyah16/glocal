<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_detail_po extends CI_Model
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
		//$this->basesql = "select ta.* from t_detail_po ta";
		$this->basesql = "select na.id_po, na.id_detail_po, kode_bom, no_job, kode_barang, nama_barang, kode_satuan_terkecil satuan, dimensi, size, nama_brand, colour, nama_style, uraian_kemasan, qty_mc, qty_po, na.harga, na.keterangan from (select ta.*, tc.kode_barang, tc.nama_barang, kode_satuan_terkecil, dimensi, size, colour, nama_brand, nama_style, uraian_kemasan, tb.id_detail_job from t_detail_po ta, t_detail_pp tb, v_sub_barang tc where ta.id_detail_pp=tb.id_detail_pp and ta.id_sub_barang=tc.id_sub_barang and ta.deleted_at is null and tb.deleted_at is null) na left join t_detail_job nb on na.id_detail_job=nb.id_detail_job left join t_job nc on nb.id_job=nc.id_job left join t_bom_detail nd on nb.id_bom_detail=nd.id_bom_detail left join t_bom ne on nd.id_bom=ne.id_bom";
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

	function getDetail($id_po)
	{
		$sql = "select ta.*, tb.kode_pp, tc.nama_barang, tc.kode_barang from (select xa.* from t_detail_po xa inner join t_po xb on xa.id_po = xb.id_po where xb.type_trans='purchase' and xb.id_po = '$id_po' and xa.deleted_at is null) ta left join (select xa.*, xb.kode_pp from t_detail_pp xa inner join t_pp xb on xa.id_pp = xb.id_pp) tb on ta.id_detail_pp = tb.id_detail_pp left join v_sub_barang tc on ta.id_sub_barang = tc.id_sub_barang";
		$res = $this->db->query($sql);

		$data = array();
		foreach ($res->result() as $r){
			$data[] = $r;
		}

		return $data;
	}

	function viewPrint($id_po)
	{
		$sql = $this->basesql." where na.id_po='$id_po'";
		$res = $this->db->query($sql);

		$data = array();
		foreach ($res->result() as $r){

			$qty = number_format($r->qty_po,3);
			$satuan = $r->satuan;
			$harga = number_format($r->harga,2);

			$r->harga = $harga;
			$r->qty = $r->qty_po;
			$r->qty_po = "<p style='margin: 0;padding: 0'>$qty</p><small style='margin: 0;padding: 0'>$satuan</small>";
			$r->barang = "<p style='margin: 0;padding: 0'>$r->nama_barang</p><small style='margin: 0;padding: 0'>$r->kode_barang</small>";

			$data[] = $r;
		}

		return $data;
	}

	function viewDT($in)
	{
	    $where = '';
	    if(!empty($in->id_po)) $where = " where na.id_po=$in->id_po";
		$start = $in->start;
		$sqlmain = $this->basesql.$where;
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

				$qty = number_format($r->qty_po,3);
				$satuan = $r->satuan;
				$harga = number_format($r->harga,2);

				$r->harga = $harga;
				$r->qty_po = "<p style='margin: 0;padding: 0'>$qty</p><small style='margin: 0;padding: 0'>$satuan</small>";
				$r->barang = "<p style='margin: 0;padding: 0'>$r->nama_barang</p><small style='margin: 0;padding: 0'>$r->kode_barang</small>";

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

	function viewDNDT($in)
	{
		$start = $in->start;
		$sqlmain = "SELECT ta.id_detail_po, ta.id_po, ta.id_detail_pp, tb.kode_po, tb.id_supplier, th.NAMA nama_supplier, tb.tanggal_dibuat, te.id_sub_barang, tf.kode_barang, tf.nama_barang, te.id_satuan, tg.KODE_SATUAN kode_satuan, tg.URAIAN_SATUAN uraian_satuan, tb.id_valuta, tb.rate, ti.KODE_VALUTA kode_valuta, ti.URAIAN_VALUTA uraian_valuta, ta.qty_po, ifnull( tj.qty_dn, 0 ) qty_dn, ta.qty_po - ifnull( tj.qty_dn, 0 ) sisa_qty_dn, ta.harga FROM t_detail_po ta INNER JOIN t_po tb ON tb.id_po = ta.id_po INNER JOIN t_detail_pp tc ON tc.id_detail_pp = ta.id_detail_pp LEFT JOIN t_detail_job td ON td.id_detail_job = tc.id_detail_job LEFT JOIN t_bom_detail te ON te.id_bom_detail = td.id_bom_detail LEFT JOIN m_sub_barang tf ON tf.id_sub_barang = te.id_sub_barang LEFT JOIN ".getdbtpb($this).".referensi_satuan tg ON tg.ID = te.id_satuan LEFT JOIN m_customer_suplier th ON th.id_customer = tb.id_supplier LEFT JOIN ".getdbtpb($this).".referensi_valuta ti ON ti.ID = tb.id_valuta LEFT JOIN ( SELECT id_detail_po, sum( qty_dn ) AS qty_dn FROM t_detail_dn WHERE deleted_at is null GROUP BY id_detail_po ) tj ON tj.id_detail_po = ta.id_detail_po WHERE ta.deleted_at IS NULL AND ta.qty_po - ifnull( tj.qty_dn, 0 ) > 0 AND tb.type_trans = 'purchase'";
		if (isset($in->id_supplier)) {
			$sqlmain .= " and tb.id_supplier = '$in->id_supplier' ";
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
				$r->harga = number_format($r->harga,2);
				$r->qty_po = number_format($r->qty_po,2);
				$r->qty_dn = number_format($r->qty_dn,2);
				$r->sisa_qty_dn = number_format($r->sisa_qty_dn,2);
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
