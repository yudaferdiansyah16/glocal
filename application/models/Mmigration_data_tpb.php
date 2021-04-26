<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mmigration_data_tpb extends CI_Model
{
    var $table = 'tpb_header';
    var $table_id = 'ID';
    var $nowdt, $nowd, $nowt, $basesql;

    function __construct()
    {
        parent::__construct();
        $this->nowdt = date('Y-m-d H:i:s');
        $this->nowd = date('Y-m-d');
        $this->nowt = date('H:i:s');
        // $this->basesql = "select * from $this->table where TANGGAL_AJU >= '$awal' and TANGGAL_AJU <= '$akhir'";
        $this->basesql = "select * from $this->table";
    }

    function viewTPBLocal($datacon)
    {
        $config['hostname'] = $datacon->iphost;
        $config['username'] = $datacon->username;
        $config['password'] = $datacon->pass;
        $config['database'] = $datacon->db;
        $config['dbdriver'] = "mysqli";
        $config['dbprefix'] = "";
        $config['pconnect'] = FALSE;
        $config['db_debug'] = (ENVIRONMENT !== 'production');
        $config['cache_on'] = FALSE;
        $config['cachedir'] = "";
        $config['char_set'] = "utf8";
        $config['dbcollat'] = "utf8_general_ci";
        $config['swap_pre'] = '';
        $config['encrypt'] = FALSE;
        $config['compress'] = FALSE;
        $config['stricton'] = FALSE;
        $config['failover'] = array();
        $config['save_queries'] = TRUE;

        $dbtpb = $this->load->database($config, TRUE);

		$sqlmain = "select * from (select count(ID) as tpb_bahan_baku from  tpb_bahan_baku) t1, (select count(ID) as tpb_bahan_baku_dokumen from tpb_bahan_baku_dokumen) t2, (select count(ID) as tpb_bahan_baku_tarif from tpb_bahan_baku_tarif) t3, (select count(ID) as tpb_barang from tpb_barang) t4, (select count(ID) as tpb_barang_dokumen from tpb_barang_dokumen) t5, (select count(ID) as tpb_barang_penerima from tpb_barang_penerima) t6, (select count(ID) as tpb_barang_tarif from tpb_barang_tarif) t7, (select count(ID) as tpb_detil_status from tpb_detil_status) t8, (select count(ID) as tpb_dokumen from tpb_dokumen) t9, (select count(ID) as tpb_header from tpb_header) t10, (select count(ID) as tpb_jaminan from tpb_jaminan) t11, (select count(ID) as tpb_kemasan from tpb_kemasan) t12, (select count(ID) as tpb_kontainer from tpb_kontainer) t13, (select count(ID) as tpb_npwp_billing from tpb_npwp_billing) t14, (select count(ID) as tpb_penerima from tpb_penerima) t15, (select count(ID) as tpb_pungutan from tpb_pungutan)  t16, (select count(ID) as tpb_respon from tpb_respon) t17";
		$sql = "select * from ($sqlmain) pa";
        $res = $dbtpb->query($sql);
        $row = $res->row();

        $dbtpb->close();
        return $row;
    }

    function viewTPBOnline()
    {
        $sqlmain = "select * from (select count(ID) as tpb_bahan_baku from ".getdbtpb($this).".tpb_bahan_baku) t1, (select count(ID) as tpb_bahan_baku_dokumen from ".getdbtpb($this).".tpb_bahan_baku_dokumen) t2, (select count(ID) as tpb_bahan_baku_tarif from ".getdbtpb($this).".tpb_bahan_baku_tarif) t3, (select count(ID) as tpb_barang from ".getdbtpb($this).".tpb_barang) t4, (select count(ID) as tpb_barang_dokumen from ".getdbtpb($this).".tpb_barang_dokumen) t5, (select count(ID) as tpb_barang_penerima from ".getdbtpb($this).".tpb_barang_penerima) t6, (select count(ID) as tpb_barang_tarif from ".getdbtpb($this).".tpb_barang_tarif) t7, (select count(ID) as tpb_detil_status from ".getdbtpb($this).".tpb_detil_status) t8, (select count(ID) as tpb_dokumen from ".getdbtpb($this).".tpb_dokumen) t9, (select count(ID) as tpb_header from ".getdbtpb($this).".tpb_header) t10, (select count(ID) as tpb_jaminan from ".getdbtpb($this).".tpb_jaminan) t11, (select count(ID) as tpb_kemasan from ".getdbtpb($this).".tpb_kemasan) t12, (select count(ID) as tpb_kontainer from ".getdbtpb($this).".tpb_kontainer) t13, (select count(ID) as tpb_npwp_billing from ".getdbtpb($this).".tpb_npwp_billing) t14, (select count(ID) as tpb_penerima from ".getdbtpb($this).".tpb_penerima) t15, (select count(ID) as tpb_pungutan from ".getdbtpb($this).".tpb_pungutan)  t16, (select count(ID) as tpb_respon from ".getdbtpb($this).".tpb_respon) t17";
        $sql = "select * from ($sqlmain) pa";
        $res = $this->db->query($sql);
        $row = $res->row();
        return $row;
    }

    function update($in)
    {
        $this->db->where($this->table_id, $in->{$this->table_id});
        $this->db->update($this->table, $in);
    }

    
}
