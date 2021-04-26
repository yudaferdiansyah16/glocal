<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mm_barang extends CI_Model
{
    var $table = 'm_barang';
    var $table_id = 'id_barang';
    var $nowdt, $nowd, $nowt, $basesql;

    function __construct()
    {
        parent::__construct();
        $this->nowdt = date('Y-m-d H:i:s');
        $this->nowd = date('Y-m-d');
        $this->nowt = date('H:i:s');
        $this->basesql = "select ta.*, tb.nama_fasilitas, tc.nama_kategori, td.nama_class, te.nama_asal, tf.nama_brand, tg.URAIAN_KEMASAN as nama_kemasan from $this->table ta left join m_fasilitas tb on ta.id_fasilitas = tb.id_fasilitas inner join m_kategori tc on ta.id_kategori = tc.id_kategori inner join m_class td on ta.id_class = td.id_class inner join m_asal_fasilitas te on ta.id_asal = te.id_asal inner join m_brand tf on ta.id_brand = tf.id_brand left join ".getdbtpb($this).".referensi_kemasan tg on ta.id_kemasan = tg.ID where ta.deleted_at is null";
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
        //printJSON($row);
        return $row;
    }

    function create($in)
    {
        $kode = $this->generateCode($in);
        $in->kode_barang = $kode->kode;
        $in->serial_barang = $kode->last;
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

    function generateCode($in)
    {
        $prefix = $in->id_fasilitas;
        $sql1 = "select * from m_kategori where id_kategori=$in->id_kategori";
        $res1 = $this->db->query($sql1);
        $row1 = $res1->row();

        $prefix .= $row1->kode_kategori;
        $prefix .= '.';
        $prefix .= $in->id_asal;

        $sql2 = "select * from m_class where id_class=$in->id_class";
        $res2 = $this->db->query($sql2);
        $row2 = $res2->row();

        $prefix .= $row2->kode_class;
        $prefix .= '.';

        $sql3 = "select * from m_brand where id_brand=$in->id_brand";
        $res3 = $this->db->query($sql3);
        $row3 = $res3->row();

        $prefix .= $row3->kode_brand;
        $prefix .= '.';

        $sql4 = "select serial_barang from m_barang where id_fasilitas='$in->id_fasilitas' and id_kategori='$in->id_kategori' and id_asal='$in->id_asal' and id_class='$in->id_class' and id_brand='$in->id_brand' order by serial_barang desc limit 0,1";
        $res4 = $this->db->query($sql4);
        $num4 = $res4->num_rows();

        if($num4>0){
            $row4 = $res4->row();
            $last = $row4->serial_barang + 1;
            $prefix .= str_pad($last,3,'0', STR_PAD_LEFT);
        } else {
            $prefix .= '001';
            $last = 1;
        }
        $prefix .= '000';

        $s = new stdClass();
        $s->last = $last;
        $s->kode = $prefix;

        return $s;
    }
}
