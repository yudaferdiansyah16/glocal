<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_job extends CI_Model
{
	var $table = 't_job';
    var $table_id = 'id_job';
    var $nowdt, $nowd, $nowt, $basesql;

    function __construct()
    {
        parent::__construct();
        $this->nowdt = date('Y-m-d H:i:s');
        $this->nowd = date('Y-m-d');
        $this->nowt = date('H:i:s');
        $this->basesql = "SELECT ta.*, tb.kode_bom, tx.nama_consignee AS nama_supplier, td.kode_po, ms.status_trans, te.detail_count FROM $this->table ta LEFT JOIN t_bom tb ON ta.id_bom = tb.id_bom LEFT JOIN t_detail_po tc ON tc.id_detail_po = tb.id_detail_po LEFT JOIN t_po td ON td.id_po = tc.id_po LEFT JOIN m_customer_suplier tx on tx.id_customer = td.id_supplier INNER JOIN m_status ms ON ms.id_status = ta.id_status LEFT JOIN ( SELECT id_job, COUNT(*) AS detail_count FROM t_detail_job GROUP BY id_job ) AS te ON te.id_job = ta.id_job WHERE ta.deleted_at IS NULL";
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
        if (isset($in->id_bom)) {
        	$sqlmain .= " and ta.id_bom = '$in->id_bom' ";
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
                    $r->option = '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
                    $r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
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

    function getNo($id)	
    {	
        $sql = "SELECT te.nama AS customer, td.kode_po, tf.nama_barang, tc.qty_po FROM t_job ta INNER JOIN t_bom tb ON ta.id_bom=tb.id_bom INNER JOIN t_detail_po tc ON tb.id_detail_po=tc.id_detail_po INNER JOIN t_po td ON tc.id_po=td.id_po INNER JOIN m_customer_suplier te ON td.id_supplier=te.id_customer  INNER JOIN v_sub_barang tf ON tc.id_sub_barang=tf.id_sub_barang INNER JOIN m_class tg ON tf.id_class=tg.id_class WHERE ta.id_job='$id->id'";	
        // AND tg.kode_class='02'
        $res = $this->db->query($sql);	
        $row = $res->row();	
        return $row;	
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

        //doc repo
        $d = new stdClass();
        $d->id = $id;
        $d->nomor = $in->no_job;
        docProcess($this, 'Job', $d);

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

	function viewjobdt($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = $this->basesql;
		$sql = "select * from ($sqlmain) pa ";
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

        $sql ="$sql order by tanggal_job desc";
		// $sql .= dtSort($in);
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
	function viewjobdtpo($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = $this->basesql;
		$sql = "select tc.no_job,tc.tanggal_job  from (select xa.*, xb.kode_pp, xb.tanggal_dibuat from t_detail_pp xa LEFT JOIN t_pp xb on xa.id_pp = xb.id_pp) ta LEFT JOIN v_sub_barang tb on ta.id_sub_barang = tb.id_sub_barang LEFT JOIN (select xa.id_detail_job, xb.no_job, xb.tanggal_job from t_detail_job xa LEFT JOIN t_job xb on xa.id_job = xb.id_job) tc on ta.id_detail_job = tc.id_detail_job LEFT JOIN (select id_detail_po, id_detail_pp, id_sub_barang, SUM(qty_po) as qty_terbeli from (select xa.* from t_detail_po xa LEFT JOIN t_po xb on xa.id_po = xb.id_po WHERE xb.type_trans = 'purchase' and xb.deleted_at is null ) ta GROUP BY id_sub_barang,id_detail_pp) td on ta.id_detail_pp = td.id_detail_pp and ta.id_sub_barang = td.id_sub_barang WHERE (ta.qty_pp - (case when td.qty_terbeli is null then 0 else td.qty_terbeli end)) > 0 ";
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

	function viewPackingdt($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = "SELECT ta.*, tb.kode_bom, tf.NAMA AS nama_supplier, td.kode_po, tc.id_sub_barang, te.kode_barang, te.nama_barang, tc.id_kemasan, th.kode_kemasan, te.nilai_kemasan, tc.id_satuan, tg.kode_satuan, tc.qty_po, tc.qty_mc, ms.status_trans FROM t_job ta LEFT JOIN t_bom tb ON tb.id_bom = ta.id_bom LEFT JOIN t_detail_po tc ON tc.id_detail_po = tb.id_detail_po LEFT JOIN t_po td ON td.id_po = tc.id_po LEFT JOIN m_sub_barang te ON te.id_sub_barang = tc.id_sub_barang LEFT JOIN smartone_tpb_dps1.referensi_pemasok tf ON tf.ID = td.id_supplier LEFT JOIN smartone_tpb_dps1.referensi_satuan tg ON tg.ID = tc.id_satuan LEFT JOIN smartone_tpb_dps1.referensi_kemasan th ON th.ID = tc.id_kemasan INNER JOIN m_status ms ON ms.id_status = ta.id_status WHERE ta.deleted_at IS NULL";
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
    
    function generateCode($id)
	{
        $sql = "select id_po, id_supplier, tanggal_dibuat from t_po where id_po=$id";
        $res = $this->db->query($sql);
        $row = $res->row();

        $sql1 = "select job_prefix from m_customer_suplier where id_customer='$row->id_supplier'";
        $res1 = $this->db->query($sql1);
        $row1 = $res1->row();

		$arr = explode('-', $row->tanggal_dibuat);
		$year = $arr[0];
		$month = $arr[1];
		$prefix = $row1->job_prefix.substr($year, 2).$month;
		// $prefix = $row1->job_prefix.substr( date('Y'), -2).date('m');
        $sql2 = "select * from t_job where no_job like '$prefix%' order by no_job desc limit 1";
        $res2 = $this->db->query($sql2);
        $num2 = $res2->num_rows();
        if($num2>0) {
            $row2 = $res2->row();
            $prefix .= str_pad(((substr($row2->no_job, -3) * 1) + 1), 3, '0', STR_PAD_LEFT);
        } else $prefix .= '001';

        $row->nojob = $prefix;
        return $row;
	}
}
