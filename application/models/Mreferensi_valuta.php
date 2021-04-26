<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mreferensi_valuta extends CI_Model
{
    
    var $nowdt, $nowd, $nowt, $basesql,$table,$table_id;

    function __construct()
    {
        parent::__construct();
        $this->table = getdbtpb($this).'.referensi_valuta';
        $this->table_id = 'ID';
        $this->nowdt = date('Y-m-d H:i:s');
        $this->nowd = date('Y-m-d');
        $this->nowt = date('H:i:s');
        $this->basesql = "select ta.*,tb.rates_jual, tb.rates_beli from $this->table ta left join (SELECT tt.* FROM m_rates tt INNER JOIN (SELECT kode_valuta, MAX(created_at) AS MaxDateTime FROM m_rates GROUP BY kode_valuta) groupedtt  ON tt.kode_valuta = groupedtt.kode_valuta  AND tt.created_at = groupedtt.MaxDateTime) tb on ta.KODE_VALUTA = tb.kode_valuta";
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
                if ($opt) {
                    $r->option = '<a href="' . base_url($this->d->_controller . '/' . $this->d->_method . '/edit/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
                    $r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="' . base_url($this->d->_controller . '/' . $this->d->_method . '/delete/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
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
        $this->db->insert($this->table, $in);
        $id = $this->db->insert_id();
        return $id;
    }

    function update($in)
    {
        $this->db->where($this->table_id, $in->id);
        $this->db->update($this->table, $in);
    }

    function delete($in)
    {
        $this->db->where($this->table_id, $in->id);
        $this->db->delete($this->table);
    }

    function getSelect($search)
    {
        $this->db->select('*');
        $this->db->limit(10);
        $this->db->from($this->table);
        $this->db->like('KODE_VALUTA', $search);
        $res = $this->db->get()->result_array();

        $data = array();
        foreach ($res as $r) {
            $data[] = array(
                "id" => $r['ID'],
                "text" => $r['URAIAN_VALUTA']
            );
        }

        return $data;
    }

    function select2($in)
    {
        $sqlmain = $this->basesql;
        if (isset($in->term)) {
            $sqlmain = "select * from ($sqlmain) ta where KODE_VALUTA LIKE '%$in->term%' OR URAIAN_VALUTA LIKE '%$in->term%'";
        }
        $sql = "select * from ($sqlmain) ta limit 10";
        $res = $this->db->query($sql);

        $data = array();
        foreach ($res->result_array() as $r) {
            $data[] = $r;
        }
        return $data;
    }
}
