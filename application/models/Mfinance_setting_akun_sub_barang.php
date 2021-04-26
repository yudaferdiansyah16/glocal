<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mfinance_setting_akun_sub_barang extends CI_Model
{
    var $table = 'm_sub_barang';
    var $table_id = 'id_sub_barang';
    var $nowdt, $nowd, $nowt, $basesql;

    function __construct()
    {
        parent::__construct();
        $this->nowdt = date('Y-m-d H:i:s');
        $this->nowd = date('Y-m-d');
        $this->nowt = date('H:i:s');
        $this->basesql = "select ta.*, tk.kode_akun, tk.nama_akun, tb.nama_barang as nama_barang_parent, tc.URAIAN_SATUAN as uraian_satuan_terkecil, tc.KODE_SATUAN as kode_satuan_terkecil, td.URAIAN_SATUAN as uraian_satuan_terbesar, td.KODE_SATUAN as kode_satuan_terbesar, te.nama_kategori, tf.nama_class, tg.nama_asal, th.nama_brand, ti.nama_style, tj.KODE_KEMASAN as kode_kemasan, ifnull(mk.hasil, 1) as hasil_konversi from $this->table ta left join m_barang tb on ta.id_barang = tb.id_barang left join ".getdbtpb($this).".referensi_satuan tc on ta.id_satuan_terkecil = tc.ID left join ".getdbtpb($this).".referensi_satuan td on ta.id_satuan_terbesar = td.ID left join m_kategori te on ta.id_kategori = te.id_kategori left join m_class tf on ta.id_class = tf.id_class left join m_asal_fasilitas tg on tg.id_asal = ta.id_asal left join m_brand th on ta.id_brand = th.id_brand left join m_style ti on ta.id_style = ti.id_style left join m_konversi as mk on mk.id_sub_barang = ta.id_sub_barang and mk.id_satuan_terkecil = ta.id_satuan_terkecil and mk.id_satuan_terbesar = ta.id_satuan_terbesar left join ".getdbtpb($this).".referensi_kemasan tj on tj.ID = ta.id_kemasan left join m_akun tk on ta.id_akun=tk.id_akun where ta.deleted_at is null";
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
        if (isset($in->exc_id_class)) {
            $sqlmain .= " and ta.id_class not like '$in->exc_id_class' ";
        }
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
                $r->blank = '';

                $st_checked = '';
                if ($r->id_status) $st_checked = 'checked';
                $r->status_trans = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="switch' . $i . '" data-url="' . base_url('master/' . $this->d->_method . '/changeStatus') . '" data-id="' . $r->{$this->table_id} . '" data-key="' . $this->table_id . '" data-status="id_status" onclick="changeStatus(this)" ' . $st_checked . '><label class="custom-control-label" for="switch' . $i . '"></label></div>';

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

    function viewDTFG($in, $opt = true)
    {
        $start = $in->start;
        $sqlmain = $this->basesql . " and ta.id_class = '2'";
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
                $r->blank = '';

                $st_checked = '';
                if ($r->id_status) $st_checked = 'checked';
                $r->status_trans = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="switch' . $i . '" data-url="' . base_url('master/' . $this->d->_method . '/changeStatus') . '" data-id="' . $r->{$this->table_id} . '" data-key="' . $this->table_id . '" data-status="id_status" onclick="changeStatus(this)" ' . $st_checked . '><label class="custom-control-label" for="switch' . $i . '"></label></div>';

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
        $sql = $this->basesql . " and ta.$this->table_id='$id'";
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
