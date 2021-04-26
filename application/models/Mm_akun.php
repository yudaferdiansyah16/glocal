<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mm_akun extends CI_Model
{
    var $table = 'm_akun';
    var $table_id = 'id_akun';
    var $nowdt, $nowd, $nowt, $basesql;

    function __construct()
    {
        parent::__construct();
        $this->nowdt = date('Y-m-d H:i:s');
        $this->nowd = date('Y-m-d');
        $this->nowt = date('H:i:s');
        $this->basesql = "select ta.*, tb.nama_tipe_akun, tc.sub_group_type, tc.group_type, tc.balance_type, td.nama_jenis_laporan_keuangan from $this->table ta left join m_tipe_akun tb on ta.id_tipe_akun = tb.id_tipe_akun left join m_grup_akun tc on tb.id_grup_akun = tc.id_grup_akun left join m_jenis_laporan_keuangan td on tc.id_jenis_laporan_keuangan = td.id_jenis_laporan_keuangan where ta.deleted_at is null";
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
    function viewAccount1()
    {
        $res = $this->db->query("select * from m_akun where kode_akun <= 121 ");

        $data = array();
        foreach ($res->result() as $r) {
            $data[] = $r;
        }

        return $data;
    }
    function viewAccount2()
    {
        $res = $this->db->query("select * from m_akun where kode_akun >= 122 and kode_akun <= 123 ");

        $data = array();
        foreach ($res->result() as $r) {
            $data[] = $r;
        }

        return $data;
    }
    function viewAccount3()
    {
        $res = $this->db->query("select * from m_akun where kode_akun >= '500'");

        $data = array();
        foreach ($res->result() as $r) {
            $data[] = $r;
        }

        return $data;
    }

    function getSelect($search)
    {
        $this->db->select('*');
        $this->db->limit(10);
        $this->db->from($this->table);
        $this->db->like('nama_akun', $search);
        $res = $this->db->get()->result_array();

        $data = array();
        foreach ($res as $r) {
            $text = '[' . $r['kode_akun'] . '] ' . $r['nama_akun'];
            $data[] = array(
                "id" => $r['id_akun'],
                "text" => $text
            );
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

                $st_checked = '';
                if ($r->id_status) $st_checked = 'checked';
                $r->id_status = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="switch' . $i . '" data-url="' . base_url('master/' . $this->d->_method . '/changeStatus') . '" data-id="' . $r->{$this->table_id} . '" data-key="' . $this->table_id . '" data-status="id_status" onclick="changeStatus(this)" ' . $st_checked . '><label class="custom-control-label" for="switch' . $i . '"></label></div>';

                if ($opt) {
                    $r->option = '<a href="' . base_url($this->d->_controller . '/' . $this->d->_method . '/edit/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
                    $r->option .= '&nbsp;<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="' . base_url($this->d->_controller . '/' . $this->d->_method . '/delete/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
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

    function create($in)
    {
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

    function select2($in)
    {
        if(isset($in->term)){
            $q = strtolower($in->term);
            $sql = $this->basesql." and (LOWER(ta.kode_akun) LIKE '%$q%' OR LOWER(ta.nama_akun) LIKE '%$q%') ORDER BY ta.nama_akun";
        } else  $sql = $this->basesql;
        $sql .= " limit 10 ";
        $res = $this->db->query($sql);

        $data = array();
        foreach ($res->result() as $r){
            $data[] = array(
                'id_akun' => $r->id_akun,
                'kode_akun' => $r->kode_akun,
                'nama_akun' => $r->nama_akun
            );
        }

        return $data;
    }
}
