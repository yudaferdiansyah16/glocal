<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mfinance_setting_akun_global_aplikasi extends CI_Model
{
    var $table = 'm_sbu';
    var $table_id = 'id_sbu';
    var $nowdt, $nowd, $nowt, $basesql;

    function __construct()
    {
        parent::__construct();
        $this->nowdt = date('Y-m-d H:i:s');
        $this->nowd = date('Y-m-d');
        $this->nowt = date('H:i:s');
        $this->basesql = "select x.*, ma.kode_akun AS kode_akun_retur_beli, ma.nama_akun AS nama_akun_retur_beli, mb.kode_akun AS kode_akun_diskon_beli, mb.nama_akun AS nama_akun_diskon_beli, mc.kode_akun AS kode_akun_retur_jual, mc.nama_akun AS nama_akun_retur_jual, md.kode_akun AS kode_akun_diskon_jual, md.nama_akun AS nama_akun_diskon_jual, me.kode_akun AS kode_akun_cogs, me.nama_akun AS nama_akun_cogs, mf.kode_akun AS kode_akun_ppn_masuk, mf.nama_akun AS nama_akun_ppn_masuk, mg.kode_akun AS kode_akun_ppn_keluar, mg.nama_akun AS nama_akun_ppn_keluar, mh.kode_akun AS kode_akun_laba_ditahan, mh.nama_akun AS nama_akun_laba_ditahan, mi.kode_akun AS kode_akun_pajak_hasil, mi.nama_akun AS nama_akun_pajak_hasil from $this->table AS x left join m_akun ma on x.id_akun_retur_beli=ma.id_akun left join m_akun mb on x.id_akun_diskon_beli=mb.id_akun left join m_akun mc on x.id_akun_retur_jual=mc.id_akun left join m_akun md on x.id_akun_diskon_jual=md.id_akun left join m_akun me on x.id_akun_cogs=me.id_akun left join m_akun mf on x.id_akun_ppn_masuk=mf.id_akun left join m_akun mg on x.id_akun_ppn_keluar=mg.id_akun left join m_akun mh on x.id_akun_laba_ditahan=mh.id_akun left join m_akun mi on x.id_akun_pajak_hasil=mi.id_akun where x.deleted_at is NULL";
    }

    function getLimit()
    {
        $sql = $this->basesql . " LIMIT 1";
        $res = $this->db->query($sql);
        $row = $res->row();
        return $row;
    }

    function update($in)
    {
        $in->updated_at = $this->nowdt;
        $this->db->where($this->table_id, $in->{$this->table_id});
        $this->db->update($this->table, $in);
    }
}
