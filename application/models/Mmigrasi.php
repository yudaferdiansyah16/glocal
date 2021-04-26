<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mmigrasi extends CI_Model
{
	var $table = 'm_akun';
    var $table_id = 'id_akun';
    var $nowdt, $nowd, $nowt, $basesql;
    var $db;

    function __construct()
    {
        parent::__construct();
        $this->nowdt = date('Y-m-d H:i:s');
        $this->nowd = date('Y-m-d');
        $this->nowt = date('H:i:s');
        $this->db = $this->load->database('postgre', TRUE);
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
        $sqlmain = "SELECT isprimary, kode_barang, nama_barang, kategori, asal, clas, satuan, transaksi FROM original WHERE deleted_at is null or (deleted_at is not null and isprimary=1)";
        $sql = "select * from ($sqlmain) pa";
        $res = $this->db->query($sql);
        $recordsTotal = $res->num_rows();

        //$sql .= dtSearch($this, $in);
        if(!empty($in->search['value'])) {
            $v = $in->search['value'];
            $sqlmain = "SELECT similarity(nama_barang, '$v') similarity, isprimary, kode_barang, nama_barang, kategori, asal, clas, satuan, transaksi FROM original WHERE nama_barang % '$v' and (deleted_at is null or (deleted_at is not null and isprimary=1)) ORDER BY similarity DESC";
            $sql = "select * from ($sqlmain) pa";
        }
        $res = $this->db->query($sql);
        $recordsFiltered = $res->num_rows();

        $sql .= dtSort($in);
        $sql .= dtLimitPG($in);
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

    function getLastID()
    {
        $sql = "select id_barang from sprimary order by id_barang desc limit 1";
        $res = $this->db->query($sql);
        $num = $res->num_rows();

        if($num>0){
            $row = $res->row();
            $id = ($row->id_barang * 1) + 1;
        } else {
            $id = 1;
        }

        return $id;
    }

    function save()
    {
        $in = $this->in;
        $id = $this->getLastID();
        foreach ($in->primary as $r){
            $sql = "select * from original where kode_barang='$r'";
            $res = $this->db->query($sql);
            $row = $res->row();

            $a = new stdClass();
            $a->id_barang = $id;
            $a->kode_barang = $row->kode_barang;
            $a->nama_barang = $row->nama_barang;
            $this->db->insert('sprimary', $a);

            $this->db->set('deleted_at', date('Y-m-d H:i:s'));
            $this->db->where('kode_barang', $r);
            $this->db->update('original');
        }

        if(isset($in->secondary)) foreach ($in->secondary as $r){
            $sql = "select * from original where kode_barang='$r'";
            $res = $this->db->query($sql);
            $row = $res->row();

            $a = new stdClass();
            $a->id_barang = $id;
            $a->kode_barang = $row->kode_barang;
            $a->nama_barang = $row->nama_barang;
            $this->db->insert('secondary', $a);

            $this->db->set('deleted_at', date('Y-m-d H:i:s'));
            $this->db->where('kode_barang', $r);
            $this->db->update('original');
        }

        if(isset($in->remove)) foreach ($in->remove as $r){
            $this->db->set('deleted_at', date('Y-m-d H:i:s'));
            $this->db->where('kode_barang', $r);
            $this->db->update('original');
        }
    }
}
