<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mfinance_setting_akun_supplier extends CI_Model
{
    var $table = 'm_customer_suplier';
    var $table_id = 'id_customer';
    var $nowdt, $nowd, $nowt, $basesql;

    function __construct()
    {
        parent::__construct();
        $this->nowdt = date('Y-m-d H:i:s');
        $this->nowd = date('Y-m-d');
        $this->nowt = date('H:i:s');
        // $this->basesql = "select ta.*, tb.kode_akun as kode_akun_utang, tb.nama_akun as nama_akun_utang, tc.kode_akun as kode_akun_um, tc.nama_akun as nama_akun_um from m_customer_suplier ta left join m_akun tb on ta.id_akun_utang = tb.id_akun left join m_akun tc on ta.id_akun_um=tc.id_akun where ta.deleted_at is null and ta.tipe='SUPLIER'";
        $this->basesql = "select ta.*, tb.kode_akun, tb.nama_akun from m_customer_suplier ta left join m_akun tb on ta.id_akun = tb.id_akun where ta.deleted_at is null and ta.tipe='SUPLIER'";
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
                $r->npwp = $r->npwp > 0 ? $r->npwp : '';
                $r->nama = "<p style='margin:0;padding:0;'>" . $r->nama . "</p><small style='margin:0;padding:0;'>" . $r->npwp . "</small>";
                if ($opt) {
                    $r->option = '<a href="' . base_url($this->d->_controller . '/' . $this->d->_method . '/edit/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
                    // $r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="' . base_url($this->d->_controller . '/' . $this->d->_method . '/delete/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
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
        $sql = $this->basesql . " and $this->table_id = '$id'";
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

    function delete($id)
    {
        $b = new stdClass();
        $b->deleted_at = $this->nowdt;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }
}
