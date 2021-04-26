<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mm_koordinat extends CI_Model
{
    var $table = 'm_koordinat';
    var $table_id = 'id_koordinat';
    var $nowdt, $nowd, $nowt, $basesql;

    function __construct()
    {
        parent::__construct();
        $this->nowdt = date('Y-m-d H:i:s');
        $this->nowd = date('Y-m-d');
        $this->nowt = date('H:i:s');
        $this->basesql = "select ta.*, tc.nama_gudang, tb.status_trans from $this->table as ta inner join m_status as tb on tb.id_status = ta.id_status inner join m_gudang tc on tc.id_gudang = ta.id_gudang where ta.deleted_at is null";
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
        if (isset($in->id_gudang)) {
        	$sqlmain .= " and ta.id_gudang = '".$in->id_gudang."' ";
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

				$st_checked = '';
				if($r->id_status) $st_checked = 'checked';
				$r->status_trans = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="switch'.$i.'" data-url="'.base_url('master/'.$this->d->_method.'/changeStatus').'" data-id="'.$r->{$this->table_id}.'" data-key="'.$this->table_id.'" data-status="id_status" onclick="changeStatus(this)" '.$st_checked.'><label class="custom-control-label" for="switch'.$i.'"></label></div>';

                if($opt){
					$r->option = '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/koordinat_edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
                    if ($r->id_koordinat != 7) {
						$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
					}
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

    function getGudang($id)
    {
        $sql = $this->basesql." and ta.id_gudang = '$id'";
        $res = $this->db->query($sql);
        
        $data = array();
        foreach ($res->result() as $r){
            $data[] = $r;
        }

        return $data;
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
