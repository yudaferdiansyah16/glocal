<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_detail_pp extends CI_Model
{
	var $table = 't_detail_pp';
	var $table_id = 'id_detail_pp';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "select ta.id_detail_pp, ta.id_pp, ta.harga, ta.keterangan, ta.id_sub_barang, ta.qty_pp, ta.kode_pp, tb.no_job, tc.kode_barang, tc.kode_satuan_terkecil as satuan, tc.nama_barang, tc.nama_brand, tc.dimensi, tc.size, tc.colour  from (select xa.*,xb.kode_pp from t_detail_pp xa inner join t_pp xb on xa.id_pp = xb.id_pp) ta left join (select xa.id_detail_job, xa.id_bom_detail, xb.no_job from t_detail_job xa left join t_job xb on xa.id_job = xb.id_job) tb on ta.id_detail_job = tb.id_detail_job inner join v_sub_barang tc on ta.id_sub_barang = tc.id_sub_barang where ta.deleted_at is null";
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

	function getByIDPP($id_pp)
	{
		$sqlmain = "select ta.*, tb.no_job, tc.kode_barang,tc.nama_barang, tc.kode_satuan_terkecil as satuan, tc.nama_brand from t_detail_pp ta left join (select xa.id_detail_job, xa.id_job, xb.no_job from t_detail_job xa inner join t_job xb on xa.id_job = xb.id_job) tb on ta.id_detail_job = tb.id_detail_job left join v_sub_barang tc on ta.id_sub_barang = tc.id_sub_barang where ta.deleted_at is null and ta.id_pp = '$id_pp'";
		$res = $this->db->query($sqlmain);

		$data = array();
		foreach ($res->result() as $r){

			$r->barang = "<p style='margin: 0;padding: 0'>$r->nama_barang</p><small style='margin: 0;padding: 0'>$r->kode_barang</small>";

			$harga = number_format($r->harga,2);
			$r->harga = "<p>$harga</p>";

			$r->qty = $r->qty_pp;
			$qty = number_format($r->qty_pp,3);
			$satuan = $r->satuan;
			$r->qty_pp = "<p style='margin: 0;padding: 0'>$qty</p><small style='margin: 0;padding: 0'>$satuan</small>";

			$data[] = $r;
		}

		$data = a2o($data);
		return $data;
	}

	function viewPrint($id_pp)
	{
		$sqlmain = $this->basesql." and ta.id_pp = '$id_pp'";
		$res = $this->db->query($sqlmain);

		$data = array();
		foreach ($res->result() as $r){

			$r->barang = "<p style='margin: 0;padding: 0'>$r->nama_barang</p><small style='margin: 0;padding: 0'>$r->kode_barang</small>";

			$harga = number_format($r->harga,2);
			$r->harga = "<p>$harga</p>";

			$r->qty = $r->qty_pp;
			$qty = number_format($r->qty_pp,3);
			$satuan = $r->satuan;
			$r->qty_pp = "<p style='margin: 0;padding: 0'>$qty</p><small style='margin: 0;padding: 0'>$satuan</small>";

			$data[] = $r;
		}

		$data = a2o($data);
		return $data;
	}

	function viewDT($in)
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
				$r->option = '<a href="'.base_url('procurement/purchase_order/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
				$r->option .= '<button type="button" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url('procurement/purchase_order/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></button>';
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

	function viewDetailPPPO($in)
	{
		$start = $in->start;
		$sqlmain = "select td.qty_terbeli, (ta.qty_pp - (case when td.qty_terbeli is null then 0 else td.qty_terbeli end)) qty_sisa,ta.*, tb.nama_barang, tb.kode_barang, tb.kode_satuan_terkecil as satuan, tc.no_job, tc.tanggal_job from (select xa.*, xb.kode_pp, xb.tanggal_dibuat from t_detail_pp xa LEFT JOIN t_pp xb on xa.id_pp = xb.id_pp) ta LEFT JOIN v_sub_barang tb on ta.id_sub_barang = tb.id_sub_barang LEFT JOIN (select xa.id_detail_job, xb.no_job, xb.tanggal_job from t_detail_job xa LEFT JOIN t_job xb on xa.id_job = xb.id_job) tc on ta.id_detail_job = tc.id_detail_job LEFT JOIN (select id_detail_po, id_detail_pp, id_sub_barang, SUM(qty_po) as qty_terbeli from (select xa.* from t_detail_po xa LEFT JOIN t_po xb on xa.id_po = xb.id_po WHERE xb.type_trans = 'purchase' and xb.deleted_at is null ) ta GROUP BY id_sub_barang,id_detail_pp) td on ta.id_detail_pp = td.id_detail_pp and ta.id_sub_barang = td.id_sub_barang WHERE (ta.qty_pp - (case when td.qty_terbeli is null then 0 else td.qty_terbeli end)) > 0";
		if(isset($in->nama_job)){
			$sqlmain .= " and tc.no_job='$in->nama_job'";
		}
		// if(isset($in->id_supplier)){
		// 	$sqlmain .= " and tc.no_job='$in->nama_job'";
		// }
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

	function viewBasedPPID($id_pp)
	{
	    $in = a2o($this->in);
        $start = $in->start;
        $sqlmain = $this->basesql." and ta.id_pp = '$id_pp'";
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

				$r->barang = "<p style='margin: 0;padding: 0'>$r->nama_barang</p><small style='margin: 0;padding: 0'>$r->kode_barang</small>";

				$harga = number_format($r->harga,2);
				$r->harga = "<p>$harga</p>";

				$qty = number_format($r->qty_pp,3);
				$satuan = $r->satuan;
				$r->qty_pp = "<p style='margin: 0;padding: 0'>$qty</p><small style='margin: 0;padding: 0'>$satuan</small>";

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
		$sql = $this->basesql." and ta.id_pp ='$id'";
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
