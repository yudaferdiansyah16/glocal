<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_bom_workflow extends CI_Model
{
	var $table = 't_bom_workflow';
    var $table_id = 'id_bom_workflow';
    var $nowdt, $nowd, $nowt, $basesql;

    function __construct()
    {
        parent::__construct();
        $this->nowdt = date('Y-m-d H:i:s');
        $this->nowd = date('Y-m-d');
        $this->nowt = date('H:i:s');
        $this->basesql = "select ta.*, tb.nama_workflow from $this->table as ta left join m_workflow as tb on tb.id_workflow = ta.id_workflow where ta.deleted_at is null";
    }

    function view($id_bom)
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
        $sql = "SELECT id_bom, id_workflow, nama_workflow, json_arrayagg( json_object( 'id_bom_workflow', id_bom_workflow, 'nama_bagian', nama_bagian, 'residual', residual, 'detail', detail )) rincian FROM ( SELECT pa.id_bom, pa.id_bom_workflow, id_workflow, nama_workflow, nama_bagian, residual, CASE WHEN nama_sub_barang IS NOT NULL THEN json_arrayagg( json_object( 'id_bom_detail', id_bom_detail, 'id_sub_barang', id_sub_barang, 'kode_barang', kode_barang, 'nama_sub_barang', nama_sub_barang, 'id_satuan', id_satuan, 'kode_satuan', kode_satuan, 'uraian_satuan', uraian_satuan, 'id_satuan_terkecil', id_satuan_terkecil, 'kode_satuan_terkecil', kode_satuan_terkecil, 'uraian_satuan_terkecil', uraian_satuan_terkecil, 'id_satuan_terbesar', id_satuan_terbesar, 'kode_satuan_terbesar', kode_satuan_terbesar, 'uraian_satuan_terbesar', uraian_satuan_terbesar, 'qty_bom', qty_bom, 'prosentase_waste', prosentase_waste )) ELSE json_array() END detail FROM ( SELECT ta.id_bom, tb.id_bom_workflow, tb.id_workflow, tc.nama_workflow, tb.nama_bagian, tb.residual FROM t_bom ta, t_bom_workflow tb, m_workflow tc WHERE ta.id_bom = tb.id_bom AND tb.id_workflow = tc.id_workflow AND tb.deleted_at IS NULL ) pa LEFT JOIN ( SELECT taa.id_bom, ta.id_bom_detail, ta.id_bom_workflow, tb.id_sub_barang, tb.kode_barang, tb.nama_barang nama_sub_barang, tb.id_satuan_terkecil, sk.KODE_SATUAN kode_satuan_terkecil, sk.URAIAN_SATUAN uraian_satuan_terkecil, tb.id_satuan_terbesar, sb.KODE_SATUAN kode_satuan_terbesar, sb.URAIAN_SATUAN uraian_satuan_terbesar, ta.id_satuan, tc.KODE_SATUAN kode_satuan, tc.URAIAN_SATUAN uraian_satuan, ta.qty_bom, ta.prosentase_waste FROM t_bom_detail ta LEFT JOIN t_bom_workflow taa ON ta.id_bom_workflow = taa.id_bom_workflow LEFT JOIN m_sub_barang tb ON ta.id_sub_barang = tb.id_sub_barang LEFT JOIN smartone_tpb_dps1.referensi_satuan sk ON tb.id_satuan_terkecil = sk.ID LEFT JOIN smartone_tpb_dps1.referensi_satuan sb ON tb.id_satuan_terbesar = sb.ID LEFT JOIN smartone_tpb_dps1.referensi_satuan tc ON ta.id_satuan = tc.ID WHERE ta.deleted_at IS NULL ) pb ON pa.id_bom = pb.id_bom AND pa.id_bom_workflow = pb.id_bom_workflow GROUP BY id_workflow, pa.id_bom_workflow, pa.id_bom, nama_workflow, residual ) na WHERE na.id_bom = '$id_bom' GROUP BY id_bom, id_workflow ORDER BY na.id_bom, id_workflow";
        $res = $this->db->query($sql);

        $data = array();
        foreach ($res->result() as $r){
            $data[] = $r;
        }

        return $data;
    }

    function viewDT($id_bom, $in, $opt = true)
    {
        $start = $in->start;
        $sqlmain = $this->basesql . " and ta.id_bom = '$id_bom' ";
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
                    $r->option = ' <button type="button" class="btn btn-xs btn-info btn-detail"><i class="fal fa fa-info"></i></button>';
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
        $this->db->where($this->table_id, $in->id_bom_workflow);
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
