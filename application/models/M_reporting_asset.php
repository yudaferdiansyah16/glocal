<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_reporting_asset extends CI_Model
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
        $this->basesql = "SELECT ma.*, ms.kode_suplier from m_asset ma left join m_suplier ms ON ma.id_supplier=ms.id_suplier where ma.deleted_at is null";
        // $this->basesql = "SELECT * from m_asset ma where ma.deleted_at is null";
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
                $r->status_approve = "";
				$r->status_approve = "";
				$r->option = "";
				$r->option .= ' <a href="' . base_url($this->d->_controller . '/' . $this->d->_method . '/detail/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
				$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="' . base_url($this->d->_controller . '/' . $this->d->_method . '/delete/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
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
    function getid($id)
    {
        $sql = $this->basesql . " and ma.id_asset = '$id'";
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

    // function generateCode($nama)
    // {
    //     $nama = substr($nama, 0, 1);
    //     $kode = 'CUS.' . $nama;
    //     $sql = "SELECT (cast(right(kode_customer,3) as unsigned )+1) as urutan FROM m_customer_suplier WHERE kode_customer LIKE '$kode%' ORDER BY kode_customer DESC LIMIT 1";
    //     $res = $this->db->query($sql);
    //     $num = $res->num_rows();
    //     $result = $res->row();
    //     if ($num > 0) {
    //         $last = $result->urutan;
    //     } else {
    //         $last = 1;
    //     }
    //     $code = $kode . str_pad($last, 3, '0', STR_PAD_LEFT);
    //     return $code;
    // }
}
