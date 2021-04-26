<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mfinance_jurnal_pemakaian extends CI_Model
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
        $this->load->model('mt_production_detail');
    }

    function create($in)
    {
        for ($x = 0; $x < count($in->id_production); $x++) {
            $delimit = explode('==', $in->id_production[$x]);
            $count = $delimit[1];
            $tgl_trans = $this->nowd;
            $no_trans = $this->mt_finance->generateCode($tgl_trans, 'JM');

            $arq = explode('<br>', $delimit[3]);
            $sum_qty = array_sum($arq);

            $arh = explode('<br>', $delimit[4]);
            $sum_harga = array_sum($arh);

            $ara = explode('<br>', $delimit[5]);
            $sum_amount = array_sum($ara);

            $items = array(
                'no_trans' => $no_trans,
                'tgl_trans' => $tgl_trans,
                // 'rate' => $rate,
                'id_status' => $in->id_status,
                'approval_1' => $in->approval_1,
                'approval_2' => $in->approval_2,
                'id_user_approval_1' => $in->id_user_approval_1,
                'id_user_approval_2' => $in->id_user_approval_2,
                'closing' => $in->closing,
                'created_at' => $this->nowdt,
                'updated_at' => $this->nowdt,
            );
            $this->db->insert('t_finance', $items);
            $finance_id = $this->db->insert_id();

            $limit = explode('<br>', $delimit[2]);

            for ($y = 0; $y < count($limit); $y++) {

            	$arr = explode('|', $limit[$y]);
            	$id_akun = $arr[0];
            	$id_akun_lawan = $arr[1];
            	$qty = $arr[2];
            	$jumlah_rp = $arr[3];

            	$items_detail = array(
	                'id_finance' => $finance_id,
	                'id_akun' => $id_akun_lawan,
	                // 'trans_description' => $delimit[4],
	                'description' => 'POSTING JURNAL PEMAKAIAN',
	                'jumlah_rp' => $jumlah_rp,
	                'amount' => $jumlah_rp,
	                // 'amount' => $jumlah_rp * $qty,
	                'qty' => $qty,
	                'created_at' => $this->nowdt,
	                'updated_at' => $this->nowdt,
	            );
	            $this->db->insert('t_finance_detail', $items_detail);
	            
	            $items_detail_lawan = array(
	                'id_finance' => $finance_id,
	                'id_akun' => $id_akun,
	                // 'trans_description' => $delimit[5],
	                'description' => 'POSTING JURNAL PEMAKAIAN',
	                'jumlah_rp' => $jumlah_rp,
	                'amount' => $jumlah_rp * -1,
	                // 'amount' => ($qty * $jumlah_rp) * -1,
	                'qty' => $qty,
	                'created_at' => $this->nowdt,
	                'updated_at' => $this->nowdt,
	            );
	            $this->db->insert('t_finance_detail', $items_detail_lawan);
	        }

            $items_production = array(
                'is_posting' => 1,
                'updated_at' => $this->nowdt,
            );
            $this->db->where('id_production', $delimit[0]);
            $this->db->update('t_production', $items_production);
        }
        return true;
    }
}