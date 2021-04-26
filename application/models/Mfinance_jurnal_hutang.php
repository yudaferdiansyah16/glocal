<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mfinance_jurnal_hutang extends CI_Model
{
    var $nowdt, $nowd, $nowt;

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->nowdt = date('Y-m-d H:i:s');
        $this->nowd = date('Y-m-d');
        $this->nowt = date('H:i:s');
        $this->load->model('mt_finance');
    }

    function create($in)
    {
        for ($x = 0; $x < count($in->id_dn); $x++) {
            $delimit = explode('==', $in->id_dn[$x]);
            $count = $delimit[5];
            $nama_supplier = $delimit[1];
            $tgl_trans = $this->nowd;
            // $tgl_trans = reverseDate($in->tgl_invoice[$count]);
            $no_trans = $this->mt_finance->generateCode($tgl_trans, 'JV');
            $rate = $in->rate[$count];
            $id_akun_credit = $delimit[7];
            $id_valuta = $delimit[9];

            $arq = explode('<br>', $delimit[2]);
            $sum_qty = array_sum($arq);
            $arh = explode('<br>', $delimit[3]);
            $sum_harga = array_sum($arh);
            $ara = explode('<br>', $delimit[4]);
            $sum_amount = array_sum($ara);
            
            $items = array(
                'no_trans' => $no_trans,
                'tgl_trans' => $tgl_trans,
                'id_valuta' => $id_valuta,
                'rate' => $rate,
                'id_status' => $in->id_status,
                'approval_1' => $in->approval_1,
                'approval_2' => $in->approval_2,
                'id_user_approval_1' => $in->id_user_approval_1,
                'id_user_approval_2' => $in->id_user_approval_2,
                'closing' => 0,
                // 'closing' => $in->closing,
                'created_at' => $this->nowdt,
                'updated_at' => $this->nowdt,
            );
            $this->db->insert('t_finance', $items);

            $finance_id = $this->db->insert_id();

            $limit = explode('<br>', $delimit[6]);

            for ($y = 0; $y < count($limit); $y++) {

            	$arr = explode('|', $limit[$y]);
            	$id_akun = $arr[0];
            	$id_akun_lawan = $arr[1];
            	$qty = $arr[2];
            	$jumlah_rp = $arr[3];

            	$items_detail = array(
	                'id_finance' => $finance_id,
	                'id_akun' => $id_akun,
	                'description' => 'POSTING JURNAL HUTANG ' . $nama_supplier . ' ('  . $tgl_trans . ')',
	                'jumlah_rp' => $jumlah_rp * $rate,
	                'amount' => $jumlah_rp,
	                // 'amount' => $jumlah_rp * $qty,
	                'qty' => $qty,
	                'created_at' => $this->nowdt,
	                'updated_at' => $this->nowdt,
	            );
	            $this->db->insert('t_finance_detail', $items_detail);
            }

            $qty_lawan = $delimit[2];
            $jumlah_rp_lawan = $delimit[3];
            
            $items_detail_lawan = array(
                'id_finance' => $finance_id,
                'id_akun' => $id_akun_credit,
                'description' => 'POSTING JURNAL HUTANG ' . $nama_supplier . ' ('  . $tgl_trans . ')',
                'jumlah_rp' => $jumlah_rp_lawan  * $rate,
                'amount' => $jumlah_rp_lawan * -1,
                // 'amount' => $sum_amount * -1,
                'qty' => $qty_lawan,
                'created_at' => $this->nowdt,
                'updated_at' => $this->nowdt,
            );
            $this->db->insert('t_finance_detail', $items_detail_lawan);

            $items_dn = array(
                'is_posting' => 1,
                'updated_at' => $this->nowdt,
            );
            $this->db->where('id_dn', $delimit[0]);
            $this->db->update('t_dn', $items_dn);
        }
        return true;
    }

    function create2($in)
    {
        for ($x = 0; $x < count($in->id_dn); $x++) {
            $delimit = explode('==', $in->id_dn[$x]);
            $count = $delimit[8];
            $tgl_trans = reverseDate($in->tgl_invoice[$count]);
            $no_trans = $this->mt_finance->generateCode($tgl_trans, 'JV');
            $rate = $in->rate[$count];
            
            $items = array(
                'no_trans' => $no_trans,
                'tgl_trans' => $tgl_trans,
                'rate' => $rate,
                'created_at' => $this->nowdt,
                'updated_at' => $this->nowdt,
            );
            $this->db->insert('t_finance', $items);

            $finance_id = $this->db->insert_id();

            $items_detail = array(
                'id_finance' => $finance_id,
                'id_akun' => $delimit[2],
                'trans_description' => $delimit[4],
                'description' => $delimit[1] . ' PERSEDIAAN BAHAN BAKU ' . $nama_supplier . ' ('  . $tgl_trans . ')',
                'jumlah_rp' => $delimit[7],
                'amount' => $delimit[6] * $delimit[7],
                'qty' => $delimit[6],
                'created_at' => $this->nowdt,
                'updated_at' => $this->nowdt,
            );
            $this->db->insert('t_finance_detail', $items_detail);

            $items_detail_lawan = array(
                'id_finance' => $finance_id,
                'id_akun' => $delimit[3],
                'trans_description' => $delimit[5],
                'description' => $delimit[1] . ' PERSEDIAAN BAHAN BAKU ' . $nama_supplier . ' ('  . $tgl_trans . ')',
                'jumlah_rp' => $delimit[7],
                'amount' => ($delimit[6] * $delimit[7]) * -1,
                'qty' => $delimit[6],
                'created_at' => $this->nowdt,
                'updated_at' => $this->nowdt,
            );
            $this->db->insert('t_finance_detail', $items_detail_lawan);

            $items_dn = array(
                'is_posting' => 1,
                'updated_at' => $this->nowdt,
            );
            $this->db->where('id_dn', $delimit[0]);
            $this->db->update('t_dn', $items_dn);
        }
        return true;
    }
}
