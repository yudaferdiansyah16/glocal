<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_bom_detail extends CI_Model
{
	var $table = 't_bom_detail';
    var $table_id = 'id_bom_detail';
    var $nowdt, $nowd, $nowt, $basesql;

    function __construct()
    {
        parent::__construct();
        $this->nowdt = date('Y-m-d H:i:s');
        $this->nowd = date('Y-m-d');
        $this->nowt = date('H:i:s');
        $this->basesql = "select ta.*, tb.nama_barang as nama_sub_barang, tc.kode_satuan, tc.uraian_satuan as nama_satuan from $this->table as ta left join m_sub_barang as tb on tb.id_sub_barang = ta.id_sub_barang left join smartone_tpb_dps1.referensi_satuan as tc on tc.ID = ta.id_satuan inner join t_bom_workflow as td on td.id_bom_workflow = ta.id_bom_workflow inner join t_bom as te on te.id_bom = td.id_bom left join t_detail_po as tf on tf.id_detail_po = te.id_detail_po left join t_po as tg on tg.id_po = tf.id_po where ta.deleted_at is null";
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

    function viewByBOM($id_bom)
    {
        $sql = $this->basesql." and ta.id_bom = '$id_bom'";
        $res = $this->db->query($sql);

        $data = array();
        foreach ($res->result() as $r){
            $data[] = $r;
        }

        return $data;
    }

    function viewDT($id_bom_workflow, $in, $opt = true)
    {
        $start = $in->start;
        $sqlmain = $this->basesql . " and ta.id_bom_workflow = '$id_bom_workflow' ";
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
                    $r->option .= ' <a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/workflow_delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
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

    function viewJobDT($in, $opt = true)
    {
        $start = $in->start;
        $sqlmain = "SELECT ta.id_bom_detail, ta.id_bom_workflow, td.id_workflow, td.nama_bagian, mw.nama_workflow, ta.id_bom, te.kode_bom, te.tanggal_bom, tg.kode_po, ta.id_sub_barang, tb.kode_barang, tb.nama_barang AS nama_sub_barang, ta.prosentase_waste, ta.id_satuan, tc.kode_satuan, tc.uraian_satuan AS nama_satuan, ta.qty_bom AS qty_total, IFNULL(dj.qty_total_job, 0) AS qty_total_job, ta.qty_bom - IFNULL(dj.qty_total_job, 0) AS qty_sisa_bom FROM t_bom_detail AS ta LEFT JOIN m_sub_barang AS tb ON tb.id_sub_barang = ta.id_sub_barang LEFT JOIN smartone_tpb_dps1.referensi_satuan AS tc ON tc.ID = ta.id_satuan INNER JOIN t_bom_workflow AS td ON td.id_bom_workflow = ta.id_bom_workflow INNER JOIN m_workflow AS mw ON mw.id_workflow = td.id_workflow INNER JOIN t_bom AS te ON te.id_bom = td.id_bom LEFT JOIN t_detail_po AS tf ON tf.id_detail_po = te.id_detail_po LEFT JOIN t_po AS tg ON tg.id_po = tf.id_po LEFT JOIN ( SELECT id_bom_detail, SUM( qty_job ) AS qty_total_job FROM t_detail_job where deleted_at is null GROUP BY id_bom_detail ) as dj ON dj.id_bom_detail = ta.id_bom_detail WHERE ta.qty_bom - IFNULL(dj.qty_total_job, 0) > 0 and ta.deleted_at IS NULL";
        if (isset($in->id_bom)) {
			$sqlmain .= " and ta.id_bom = '$in->id_bom'";
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
                    $r->option .= ' <a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/workflow_delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
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
        $in->created_at = $this->nowdt;
        $in->updated_at = $this->nowdt;
        $this->db->insert($this->table, $in);
        $id = $this->db->insert_id();
        return $id;
    }

    function update($in)
    {
        $in->updated_at = $this->nowdt;
        $this->db->where($this->table_id, $in->id_bom_detail);
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
