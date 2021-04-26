<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mm_sub_barang extends CI_Model
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
		$sqlstock = "SELECT ta.id_sub_barang, tb.kode_barang, tb.nama_barang, ta.id_satuan_terkecil as id_satuan, te.KODE_SATUAN AS kode_satuan, tb.nama_class, SUM( CASE WHEN td.id_status = 'IN' THEN ta.qty ELSE ((- 1 ) * ta.qty) END ) AS qty FROM t_wh_detail ta LEFT JOIN v_sub_barang tb ON tb.id_sub_barang = ta.id_sub_barang LEFT JOIN t_wh tc ON tc.id_wh = ta.id_wh LEFT JOIN m_jenis_mutasi td ON td.id_jenis_mutasi = tc.id_jenis_mutasi LEFT JOIN ".getdbtpb($this).".referensi_satuan te ON te.ID = ta.id_satuan_terkecil WHERE tc.approval_1 = '1' AND tc.approval_2 = '1' GROUP BY ta.id_sub_barang, tb.kode_barang, tb.nama_barang, ta.id_satuan_terkecil, te.KODE_SATUAN, tb.nama_class HAVING SUM( CASE WHEN td.id_status = 'IN' THEN ta.qty ELSE ((- 1 ) * ta.qty) END ) > 0";
        $this->basesql = "select ta.*, tb.nama_barang as nama_barang_parent, tc.ID as id_sat, tc.URAIAN_SATUAN as uraian_satuan_terkecil, tc.KODE_SATUAN as kode_satuan_terkecil, td.URAIAN_SATUAN as uraian_satuan_terbesar, td.KODE_SATUAN as kode_satuan_terbesar, te.nama_kategori, tf.nama_class, tg.nama_asal, th.nama_brand, ti.nama_style, tj.KODE_KEMASAN as kode_kemasan, tj.ID as id_kem, tj.URAIAN_KEMASAN as uraian_kemasan, ifnull(mk.hasil, 1) as hasil_konversi, ifnull(tk.qty, 0) as qty_stock from $this->table ta left join m_barang tb on ta.id_barang = tb.id_barang left join ".getdbtpb($this).".referensi_satuan tc on ta.id_satuan_terkecil = tc.ID left join ".getdbtpb($this).".referensi_satuan td on ta.id_satuan_terbesar = td.ID left join m_kategori te on ta.id_kategori = te.id_kategori left join m_class tf on ta.id_class = tf.id_class left join m_asal_fasilitas tg on tg.id_asal = ta.id_asal left join m_brand th on ta.id_brand = th.id_brand left join m_style ti on ta.id_style = ti.id_style left join m_konversi as mk on mk.id_sub_barang = ta.id_sub_barang left join ".getdbtpb($this).".referensi_kemasan tj on tj.ID = ta.id_kemasan left join ($sqlstock) as tk on tk.id_sub_barang = ta.id_sub_barang where ta.deleted_at is null";
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

    function viewDT($in, $opt = true)
    {
        $start = $in->start;
        $sqlmain = $this->basesql;
        if (isset($in->exc_id_class)) {
        	$sqlmain .= " and ta.id_class not like '$in->exc_id_class' ";
        }
        if (isset($in->classFilter)) {
        	$sqlmain .= " and ta.id_class like '$in->classFilter' ";
        }
        if (isset($in->klasifikasi)) {
        	$sqlmain .= " and ta.id_class like '$in->klasifikasi' ";
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
        if($num>0){
            $i=$start+1;
            foreach ($res->result() as $r){
                $r->no = $i;
                $r->blank = '';

				$st_checked = '';
				if($r->id_status) $st_checked = 'checked';
				$r->status_trans = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="switch'.$i.'" data-url="'.base_url('master/'.$this->d->_method.'/changeStatus').'" data-id="'.$r->{$this->table_id}.'" data-key="'.$this->table_id.'" data-status="id_status" onclick="changeStatus(this)" '.$st_checked.'><label class="custom-control-label" for="switch'.$i.'"></label></div>';

                if($opt){
                    $r->option = '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
                    $r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
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
        // $sqlmain = $this->basesql." and ta.id_class = '2'";
        $sqlmain = $this->basesql;
        if (isset($in->exc_id_class)) {
        	$sqlmain .= " and ta.id_class not like '$in->exc_id_class' ";
        }
        if (isset($in->classFilter)) {
        	$sqlmain .= " and ta.id_class like '$in->classFilter' ";
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
        if($num>0){
            $i=$start+1;
            foreach ($res->result() as $r){
                $r->no = $i;
                $r->blank = '';

				$st_checked = '';
				if($r->id_status) $st_checked = 'checked';
				$r->status_trans = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="switch'.$i.'" data-url="'.base_url('master/'.$this->d->_method.'/changeStatus').'" data-id="'.$r->{$this->table_id}.'" data-key="'.$this->table_id.'" data-status="id_status" onclick="changeStatus(this)" '.$st_checked.'><label class="custom-control-label" for="switch'.$i.'"></label></div>';

                if($opt){
                    $r->option = '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
                    $r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
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
		$sql = $this->basesql." and ta.$this->table_id='$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
    }
    
    function getSelect($search)
    {
        $search = strtolower($search);
        $sql = "select ta.id_sub_barang id, ta.nama_barang text, ta.nama_barang nama, ta.kode_barang kode from m_sub_barang ta where lower(ta.nama_barang) like '%$search%' and ta.deleted_at is null";
        $res = $this->db->query($sql);

        $data = array();
        foreach ($res->result() as $r){
            $data[] = $r;
        }

        return $data;
    }

    function create($in)
    {
        $kode = $this->generateCode($in);
        $in->kode_barang = $kode->kode;
        $in->serial_sub_barang = $kode->last;
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

    function generateCode($in)
    {
        $prefix = $in->id_fasilitas;
        $sql1 = "select * from m_kategori where id_kategori=$in->id_kategori";
        $res1 = $this->db->query($sql1);
        $row1 = $res1->row();

        $prefix .= $row1->kode_kategori;
        $prefix .= '.';
        $prefix .= $in->id_asal;

        $sql2 = "select * from m_class where id_class=$in->id_class";
        $res2 = $this->db->query($sql2);
        $row2 = $res2->row();

        $prefix .= $row2->kode_class;
        $prefix .= '.';

        $sql3 = "select * from m_brand where id_brand=$in->id_brand";
        $res3 = $this->db->query($sql3);
        $row3 = $res3->row();

        $prefix .= $row3->kode_brand;
        $prefix .= '.';

        // $sql4 = "select serial_barang from m_barang where id_barang=$in->id_barang order by serial_barang desc limit 0,1";
        // $res4 = $this->db->query($sql4);
        // $row4 = $res4->row();
        // $prefix .= str_pad($row4->serial_barang,3,'0', STR_PAD_LEFT);

        // $sql5 = "select serial_sub_barang from m_sub_barang where id_fasilitas=$in->id_fasilitas and id_kategori=$in->id_kategori and id_asal=$in->id_asal and id_class=$in->id_class and id_brand=$in->id_brand and serial_barang=$in->serial_barang  order by serial_barang desc, serial_sub_barang desc limit 0,1";
        // $res5 = $this->db->query($sql5);
        // $num5 = $res5->num_rows();

        if($num5>0){
            $row5 = $res5->row();
            $last = $row5->serial_sub_barang + 1;
            $prefix .= str_pad($last,3,'0', STR_PAD_LEFT);
        } else {
            $prefix .= '001';
            $last = 1;
        }

        $s = new stdClass();
        $s->last = $last;
        $s->kode = $prefix;

        return $s;
    }
}
