<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mm_customer_suplier extends CI_Model
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
        $this->basesql = "select ta.*, tb.URAIAN_NEGARA from m_customer_suplier ta left join ".getdbtpb($this).".referensi_negara tb on ta.kode_negara = tb.KODE_NEGARA";
    }

    function view()
    {
        $sql = $this->basesql;
        $res = $this->db->query($sql);

        $data = array();
        foreach ($res->result() as $r){
            $data[] = $r;
        }

        return $data;
    }

    function viewCustomer()
    {
        $sql = $this->basesql." where ta.tipe = 'CUSTOMER'";
        $res = $this->db->query($sql);

        $data = array();
        foreach ($res->result() as $r){
            $data[] = $r;
        }

        return $data;
    }

    function viewSupplier()
    {
        $sql = $this->basesql." where ta.tipe = 'SUPLIER'";
        $res = $this->db->query($sql);

        $data = array();
        foreach ($res->result() as $r){
            $data[] = $r;
        }

        return $data;
    }

    function getSelectCustomer($search)
    {
        $search = strtolower($search);
        $sql = "select ta.id_customer id, ta.nama_consignee text, ta.nama_consignee NAMA, ifnull(ta.destinasi,'') ALAMAT from m_customer_suplier ta left join ".getdbtpb($this).".referensi_negara tb on ta.kode_negara = tb.KODE_NEGARA where ta.tipe='CUSTOMER' and lower(ta.nama) like '%$search%'";
        $res = $this->db->query($sql);

        $data = array();
        foreach ($res->result() as $r){
            $data[] = $r;
        }

        return $data;
    }

    function viewDTCustomer($in, $opt = true)
    {
        $start = $in->start;
        $sqlmain = $this->basesql." where tipe = 'CUSTOMER'";
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
        if($num>0){
            $i=$start+1;
            foreach ($res->result() as $r){
                $r->no = $i;
                
                if($opt){
                    $r->option = '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success btn-block"><i class="fal fa fa-edit"></i></a> ';
                    $r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger btn-block"><i class="fal fa fa-trash"></i></a>';
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

    function viewDTSupplier($in, $opt = true)
    {
        $start = $in->start;
        $sqlmain = $this->basesql." where tipe = 'SUPLIER'";
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
        if($num>0){
            $i=$start+1;
            foreach ($res->result() as $r){
                $r->no = $i;
                
                if($opt){
                    $r->option = '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success btn-block"><i class="fal fa fa-edit"></i></a> ';
                    $r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger btn-block"><i class="fal fa fa-trash"></i></a>';
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
    function viewDTSupplierDocOut($in, $opt = true)
    {
        $start = $in->start;
        $sqlmain = $this->basesql." ";
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
        if($num>0){
            $i=$start+1;
            foreach ($res->result() as $r){
                $r->no = $i;
                
                if($opt){
                    $r->option = '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success btn-block"><i class="fal fa fa-edit"></i></a> ';
                    $r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger btn-block"><i class="fal fa fa-trash"></i></a>';
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
    function viewDTSupplierRn($in, $opt = true)
    {
        $start = $in->start;
        $sqlmain = "SELECT  DISTINCT(th.id_customer),th.kode_customer,tb.id_supplier, th.NAMA nama,th.alamat,th.kode_negara,th.npwp FROM t_detail_po ta INNER JOIN t_po tb ON tb.id_po = ta.id_po INNER JOIN t_detail_pp tc ON tc.id_detail_pp = ta.id_detail_pp LEFT JOIN t_detail_job td ON td.id_detail_job = tc.id_detail_job LEFT JOIN t_bom_detail te ON te.id_bom_detail = td.id_bom_detail LEFT JOIN m_sub_barang tf ON tf.id_sub_barang = te.id_sub_barang LEFT JOIN smartone_tpb_dps1.referensi_satuan tg ON tg.ID = te.id_satuan LEFT JOIN m_customer_suplier th ON th.id_customer = tb.id_supplier LEFT JOIN smartone_tpb_dps1.referensi_valuta ti ON ti.ID = tb.id_valuta LEFT JOIN ( SELECT id_detail_po, sum( qty_dn ) AS qty_dn FROM t_detail_dn WHERE deleted_at is null GROUP BY id_detail_po ) tj ON tj.id_detail_po = ta.id_detail_po WHERE ta.deleted_at IS NULL AND  th.tipe = 'SUPLIER' AND ta.qty_po - ifnull( tj.qty_dn, 0 ) > 0 AND tb.type_trans = 'purchase' ";
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
        if($num>0){
            $i=$start+1;
            foreach ($res->result() as $r){
                $r->no = $i;
                
                if($opt){
                    $r->option = '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success btn-block"><i class="fal fa fa-edit"></i></a> ';
                    $r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger btn-block"><i class="fal fa fa-trash"></i></a>';
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
    function viewDTSupplierDocIn($in, $opt = true)
    {
        $start = $in->start;
        $sqlmain = "select DISTINCT(tb.id_customer),tb.kode_customer, tb.NAMA nama,tb.alamat,tb.kode_negara,tb.npwp  from (SELECT * FROM t_dn WHERE flag_docin IS NULL ) ta left join m_customer_suplier tb on tb.id_customer = ta.id_supplier left join smartone_tpb_dps1.referensi_jenis_kendaraan tc on tc.ID = ta.id_jenis_kendaraan left join m_fasilitas td on td.id_fasilitas = ta.id_fasilitas left join smartone_tpb_dps1.tpb_header tf on tf.ID = ta.ID_HEADER left join (select id_dn, count(id_detail_dn) as jumlah_barang from t_detail_dn group by id_dn) tg on ta.id_dn = tg.id_dn where ta.deleted_at is null and ta.is_closed = '0'  AND ta.flag_docin is null group by tg.id_dn ";
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
        if($num>0){
            $i=$start+1;
            foreach ($res->result() as $r){
                $r->no = $i;
                
                if($opt){
                    $r->option = '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success btn-block"><i class="fal fa fa-edit"></i></a> ';
                    $r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger btn-block"><i class="fal fa fa-trash"></i></a>';
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
        $sql = $this->basesql." where $this->table_id = '$id'";
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

    function generateCode($prefix, $kode){
        $prefix = substr($prefix,0,1);
        $kode = $kode.'.'.$prefix;
        $sql = "SELECT (cast(right(kode_customer,3) as unsigned )+1) as urutan FROM m_customer_suplier WHERE kode_customer LIKE '$kode%' ORDER BY kode_customer DESC LIMIT 1";
        $res = $this->db->query($sql);
        $num = $res->num_rows();
        $result = $res->row();
        if ($num>0) {
            $last = $result->urutan;
            $last++;
        } else {
            $last = 1;
        }
        $code = $kode.str_pad($last,3,'0',STR_PAD_LEFT);
        return $code;
    }
}
