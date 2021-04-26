<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mt_kartu_stok extends CI_Model
{
    var $table = 't_wh';
	var $table_id = 'id_wh';
    var $nowdt, $nowd, $nowt, $basesql;

    function __construct()
    {
        parent::__construct();
        $this->nowdt = date('Y-m-d H:i:s');
        $this->nowd = date('Y-m-d');
        $this->nowt = date('H:i:s');
        $this->basesql = "select ta.*, tb.id_sub_barang, tb.qty, tc.nama_jenis_mutasi, tc.saldo_mutasi, th.KODE_DOKUMEN_PABEAN, th.NOMOR_AJU, CAST(th.TANGGAL_AJU AS DATE) AS TANGGAL_AJU, tv.kode_barang, tv.nama_barang, tv.kode_satuan_terbesar, tv.id_class from t_wh ta left join t_wh_detail tb on tb.id_wh = ta.id_wh left join m_jenis_mutasi tc on tc.id_jenis_mutasi=ta.id_jenis_mutasi left join v_sub_barang tv on tb.id_sub_barang=tv.id_sub_barang left join smartone_tpb_dps1.tpb_header th on th.ID = tb.id_header where ta.deleted_at is null";
    }

    function view($in)
	{
		$s = new stdClass();
		if(isset($in->tgl1) && isset($in->tgl2)){
            if(isset($in->barang) && isset($in->klasifikasi)){
                $sqlsaldo = "SELECT CASE WHEN tb.jenis_transaksi = 'M' THEN ta.qty ELSE ta.qty * - 1 END AS saldo, tb.jenis_transaksi, tc.id_class FROM t_wh_detail ta INNER JOIN t_wh tb ON ta.id_wh = tb.id_wh INNER JOIN m_sub_barang tc ON ta.id_sub_barang=tc.id_sub_barang WHERE tb.tanggal_terima < '".reverseDate($in->tgl1)."' AND ta.id_sub_barang = '$in->barang' AND tc.id_class='$in->klasifikasi'";
                $ressaldo = $this->db->query($sqlsaldo);
                $saldo_awal = 0;
                foreach($ressaldo->result() as $key => $value){
                    if(isset($value->saldo)){
                        $saldo_awal += $value->saldo;
                    }
                }
                $s->saldoawal = $saldo_awal;
                $sql = $this->basesql." AND tb.id_sub_barang = '$in->barang' AND tv.id_class='$in->klasifikasi' AND ta.tanggal_terima BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."' ORDER BY ta.tanggal_terima ASC";
                $res = $this->db->query($sql);
                $data = [];
                $hasil = $saldo_awal;
                $total_in = 0;
                $total_out = 0;
                foreach ($res->result() as $r){
                    if($r->id_sub_barang != 0) {
                        $a = new stdClass();
                        $a->kode_mutasi = $r->kode_mutasi;
                        $a->tanggal_terima = $r->tanggal_terima;
                        $a->kode_barang = $r->kode_barang;
                        $a->nama_barang = $r->nama_barang;
                        $a->kode_satuan_terbesar = $r->kode_satuan_terbesar;
                        $a->nama_jenis_mutasi = $r->nama_jenis_mutasi;
                        $a->nomor_aju = $r->NOMOR_AJU;
                        if($r->jenis_transaksi == 'M'){
                            $a->in = $r->qty;
                            $a->out = 0;
                            $total_in = $total_in + $r->qty;
                            $hasil = $hasil + $r->qty;
                        }else{
                            $a->out = $r->qty;
                            $a->in = 0;
                            $total_out = $total_out + $r->qty;
                            $hasil = $hasil - $r->qty;
                        }
                        $a->hasil = $hasil;
                        $data[] = $a;
                    }
                }
                $s->total_in = $total_in;
                $s->total_out = $total_out;
                $s->data = $data;
                return $s;
            }else{
                $sqlsaldo = "SELECT CASE WHEN tb.jenis_transaksi = 'M' THEN ta.qty ELSE ta.qty * - 1 END AS saldo, tb.jenis_transaksi, tc.id_class FROM t_wh_detail ta INNER JOIN t_wh tb ON ta.id_wh = tb.id_wh INNER JOIN m_sub_barang tc ON ta.id_sub_barang=tc.id_sub_barang WHERE tb.tanggal_terima < '".reverseDate($in->tgl1)."'";
                $ressaldo = $this->db->query($sqlsaldo);
                $saldo_awal = 0;
                foreach($ressaldo->result() as $key => $value){
                    if(isset($value->saldo)){
                        $saldo_awal += $value->saldo;
                    }
                }
                $s->saldoawal = $saldo_awal;
                $sql = $this->basesql." AND ta.tanggal_terima BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."' ORDER BY ta.tanggal_terima ASC";
                $res = $this->db->query($sql);
                $data = [];
                $hasil = $saldo_awal;
                $total_in = 0;
                $total_out = 0;
                foreach ($res->result() as $r){
                    if($r->id_sub_barang != 0) {
                        $a = new stdClass();
                        $a->kode_mutasi = $r->kode_mutasi;
                        $a->tanggal_terima = $r->tanggal_terima;
                        $a->kode_barang = $r->kode_barang;
                        $a->nama_barang = $r->nama_barang;
                        $a->kode_satuan_terbesar = $r->kode_satuan_terbesar;
                        $a->nama_jenis_mutasi = $r->nama_jenis_mutasi;
                        $a->nomor_aju = $r->NOMOR_AJU;
                        if($r->jenis_transaksi == 'M'){
                            $a->in = $r->qty;
                            $a->out = 0;
                            $total_in = $total_in + $r->qty;
                            $hasil = $hasil + $r->qty;
                        }else{
                            $a->out = $r->qty;
                            $a->in = 0;
                            $total_out = $total_out + $r->qty;
                            $hasil = $hasil - $r->qty;
                        }
                        $a->hasil = $hasil;
                        $data[] = $a;
                    }
                }
                $s->total_in = $total_in;
                $s->total_out = $total_out;
                $s->data = $data;
                return $s;
            }
        }		
	}
}