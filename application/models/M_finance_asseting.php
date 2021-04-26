<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_finance_asseting extends CI_Model
{
    var $table = 'm_asset';
    var $table_id = 'id_asset';
    var $nowdt, $nowd, $nowt, $basesql;

    function __construct()
    {
        parent::__construct();
        $this->nowdt = date('Y-m-d H:i:s');
        $this->nowd = date('Y-m-d');

        $this->nowt = date('H:i:s');
        $this->basesql = "select a.*, b.nama_tipe_depresiasi from m_asset a inner join m_tipe_depresiasi b on a.type_depresiasi = b.id_tipe_depresiasi";
    }

    function view()
    {
        $sql = $this->basesql;
        $res = $this->db->query($sql);

        $data = array();
        foreach ($res->result() as $r) {
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
        if ($num > 0) {
            $i = $start + 1;
            foreach ($res->result() as $r) {
                $r->no = $i;
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

    function viewsimulasi($in, $opt = true)
    {
        if(isset($in->simulasi_harga) && isset($in->type) && isset($in->depresiasi) && ($in->tgl_depresiasi) && isset($in->type_rate)){
            $start = $in->start;
            $data = array();
         
                $i = $start + 1;
                $hasil_penyusutan =  0;
                $nilai_asset = $in->simulasi_harga;
                $type = $in->type;
                $type_rate = $in->type_rate;
                $depresiasi = $in->depresiasi;
                $tgl_depresiasi = strtotime(reverseDate($in->tgl_depresiasi));
                if($type_rate == "Persen"){
                    if($type == "bulan"){
                        $tgl_sementara = date('Y-m-d',strtotime('+1 month',$tgl_depresiasi)); 
                        $nilai_sementara = 0;    
                        do {
                            $r=new stdClass();
                            $r->no = $i;
                            $r->tgl = $tgl_sementara;
                            $r->simulasi = "Rp.".number_format($nilai_asset,2)." x ".number_format($depresiasi,2)."%";
                            $nilai_sementara = $nilai_asset * $depresiasi / 100;
                            $r->nilai = number_format($nilai_sementara,2);
                            $hasil_penyusutan += $nilai_sementara;
                            $temp = strtotime($tgl_sementara);
                            $tgl_sementara = date('Y-m-d',strtotime('+1 month',$temp));
                            $data[] = $r;
                            unset($r);
                            $i++;
                        }
                        while($hasil_penyusutan < $nilai_asset);
                    }
                    else if($type == "tahun"){
                        $thn_sementara = date('Y-m-d',strtotime('+1 Year',$tgl_depresiasi)); 
                        $nilai_sementara = 0;    
                        do {
                            $r=new stdClass();
                            $r->no = $i;
                            $r->tgl = $thn_sementara;
                            $r->simulasi = "Rp.".number_format($nilai_asset,2)." x ".number_format($depresiasi,2)."%";
                            $nilai_sementara = $nilai_asset * $depresiasi / 100;
                            $r->nilai = number_format($nilai_sementara,2);
                            $hasil_penyusutan += $nilai_sementara;
                            $temp = strtotime($thn_sementara);
                            $thn_sementara = date('Y-m-d',strtotime('+1 Year',$temp));
                            $data[] = $r;
                            unset($r);
                            $i++;
                        }
                        while($hasil_penyusutan < $nilai_asset);
                    }
                }
                if($type_rate == "Rupiah"){
                    if($type == "bulan"){
                        $tgl_sementara = date('Y-m-d',strtotime('+1 month',$tgl_depresiasi)); 
                        $nilai_sementara = 0;    
                        do {
                            $r=new stdClass();
                            $r->no = $i;
                            $r->tgl = $tgl_sementara;
                            $r->simulasi = "Rp.".$nilai_asset." / ".$depresiasi;
                            $nilai_sementara = $nilai_asset / $depresiasi ;
                            $r->nilai = $nilai_sementara;
                            $hasil_penyusutan += $nilai_sementara;
                            $temp = strtotime($tgl_sementara);
                            $tgl_sementara = date('Y-m-d',strtotime('+1 month',$temp));
                            $data[] = $r;
                            unset($r);
                            $i++;
                        }
                        while($hasil_penyusutan < $nilai_asset);
                    }
                    else if($type == "tahun"){
                        $thn_sementara = date('Y-m-d',strtotime('+1 Year',$tgl_depresiasi)); 
                        $nilai_sementara = 0;    
                        do {
                            $r=new stdClass();
                            $r->no = $i;
                            $r->tgl = $thn_sementara;
                            $r->simulasi = "Rp.".$nilai_asset." / ".$depresiasi;
                            $nilai_sementara = $nilai_asset / $depresiasi ;
                            $r->nilai = $nilai_sementara;
                            $hasil_penyusutan += $nilai_sementara;
                            $temp = strtotime($thn_sementara);
                            $thn_sementara = date('Y-m-d',strtotime('+1 Year',$temp));
                            $data[] = $r;
                            unset($r);
                            $i++;
                        }
                        while($hasil_penyusutan < $nilai_asset);
                    }
                }
              
            $k = new stdClass();
            $k->draw = $in->draw;
            $k->data = $data;
    
            return $k;
        }
       else{
            $data = array();
            $k = new stdClass();
            $k->draw = $in->draw;
            $k->data = $data;
            return $k;
       }
    }
    
    function get($id)
    {
        $sql = $this->basesql . " and $this->table_id = '$id'";
        $res = $this->db->query($sql);
        $row = $res->row();
        return $row;
    }

    function create($in)
    {
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
}
