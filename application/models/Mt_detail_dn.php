<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_detail_dn extends CI_Model
{
	var $table = 't_detail_dn';
    var $table_id = 'id_detail_dn';
    var $nowdt, $nowd, $nowt, $basesql;

    function __construct()
    {
        parent::__construct();
        $this->nowdt = date('Y-m-d H:i:s');
        $this->nowd = date('Y-m-d');
        $this->nowt = date('H:i:s');
		$sqldoc = "SELECT DISTINCT tbh.ID AS id_header, tbd.NOMOR_DOKUMEN nomor_dokumen, tbh.NOMOR_AJU nomor_aju, IFNULL( tbh.TANGGAL_AJU, STR_TO_DATE( SUBSTR( tbh.NOMOR_AJU, 13, 8 ), '%Y%m%d' )) tanggal_aju, tbh.NOMOR_DAFTAR nomor_daftar, tbh.TANGGAL_DAFTAR tanggal_daftar FROM ".getdbtpb($this).".tpb_dokumen tbd INNER JOIN ".getdbtpb($this).".tpb_header tbh ON tbh.ID = tbd.ID_HEADER where tbh.NOMOR_AJU IS NOT NULL";
        $this->basesql = "SELECT ta.*, tg.id_satuan, tb.kode_dn, tb.id_fasilitas, tb.tgl_kedatangan, tb.no_invoice, tb.tgl_invoice, td.kode_po, td.tanggal_dibuat, td.id_supplier, tj.nama nama_supplier, td.id_valuta, tk.KODE_VALUTA kode_valuta, tk.URAIAN_VALUTA uraian_valuta, te.id_sub_barang, th.kode_barang, th.nama_barang AS nama_sub_barang, ti.KODE_SATUAN AS kode_satuan, ti.URAIAN_SATUAN AS uraian_satuan, td.rate, tc.qty_po, ifnull(tl.total_qty_dn, 0) total_qty_dn, tc.qty_po - ifnull(tl.total_qty_dn, 0) sisa_qty_dn FROM t_detail_dn ta INNER JOIN t_dn tb ON ta.id_dn = tb.id_dn INNER JOIN t_detail_po tc ON tc.id_detail_po = ta.id_detail_po LEFT JOIN t_po td ON td.id_po = tc.id_po LEFT JOIN t_detail_pp te ON te.id_detail_pp = tc.id_detail_pp LEFT JOIN t_detail_job tf ON tf.id_detail_job = te.id_detail_job LEFT JOIN t_bom_detail tg ON tg.id_bom_detail = tf.id_bom_detail LEFT JOIN m_sub_barang th ON th.id_sub_barang = tc.id_sub_barang LEFT JOIN ".getdbtpb($this).".referensi_satuan ti ON ti.ID = tg.id_satuan LEFT JOIN m_customer_suplier tj ON tj.id_customer = td.id_supplier LEFT JOIN ".getdbtpb($this).".referensi_valuta tk ON tk.ID = td.id_valuta LEFT JOIN ( SELECT id_detail_po, SUM( qty_dn ) AS total_qty_dn FROM t_detail_dn where deleted_at is null GROUP BY id_detail_dn ) tl ON tl.id_detail_po = ta.id_detail_po left join ($sqldoc) sdc on sdc.nomor_dokumen = tb.no_invoice LEFT JOIN ".getdbtpb($this).".tpb_barang tbb on tbb.ID_HEADER = sdc.id_header and tbb.KODE_BARANG = th.kode_barang WHERE ta.deleted_at IS NULL";
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

	function viewByDN($id_dn)
	{
		$sql = "SELECT id_detail_dn, id_detail_po, kode_po, tgl_po, rate, ua.id_sub_barang, ua.id_detail_po, tj.id_job, tj.no_job, tj.tanggal_job, ua.id_detail_pp, kode_barang, nama_barang, seri_barang, ub.id_satuan_terkecil as id_satuan, ub.kode_satuan_terkecil as kode_satuan, uc.KODE_VALUTA as kode_valuta, ua.harga, no_sj, tanggal_sj, qty_po, qty_dn, ( qty_po - qty_dn ) total_qty_dn FROM ( SELECT kode_po, rate, tanggal_dibuat tgl_po, id_detail_dn, ta.id_detail_po, tb.id_detail_pp, ta.id_sub_barang, seri_barang, no_sj, tanggal_sj, tc.id_valuta, qty_dn, qty_po, tb.harga FROM t_detail_dn ta, t_detail_po tb, t_po tc WHERE ta.id_detail_po = tb.id_detail_po AND tb.id_po = tc.id_po AND id_dn = '$id_dn' AND ta.deleted_at IS NULL ) ua LEFT JOIN ( SELECT id_sub_barang, kode_barang, nama_barang, id_satuan_terkecil, kode_satuan_terkecil FROM v_sub_barang WHERE id_sub_barang IN ( SELECT ta.id_sub_barang FROM t_detail_dn ta LEFT JOIN t_detail_po tb ON ta.id_detail_po = tb.id_detail_po WHERE ta.id_dn = '$id_dn' AND ta.deleted_at IS NULL )) ub ON ua.id_sub_barang = ub.id_sub_barang LEFT JOIN ".getdbtpb($this).".referensi_valuta uc ON ua.id_valuta = uc.ID LEFT JOIN t_detail_pp th on th.id_detail_pp = ua.id_detail_pp lEFT JOIN t_detail_job ti ON ti.id_detail_job = th.id_detail_job LEFT JOIN t_job tj ON tj.id_job = ti.id_job ";
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
        if (isset($in->id_supplier)) {
        	$sqlmain .= " and td.id_supplier = '$in->id_supplier' ";
		}
		if (isset($in->id_fasilitas)) {
			$sqlmain .= " and tb.id_fasilitas = '$in->id_fasilitas' ";
		}
		if (isset($in->start_date)) {
			$sqlmain .= ' and tb.tgl_kedatangan >= "'.reverseDate($in->start_date).'" ';
		}
		if (isset($in->end_date)) {
			$sqlmain .= ' and tb.tgl_kedatangan <= "'.reverseDate($in->end_date).'" ';
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

                if($opt){
                    $r->option = '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
                    $r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
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

    function viewDetailDNDocIn($in)
    {
        $start = $in->start;
        $sqlmain = "select ta.*,SUM(tbb.netto ) as netto, tb.rate, tb.qty_po, tb.kode_po, tb.tanggal_po, tc.kode_pp, tc.tanggal_pp, td.no_job, td.tanggal_job, tf.nama_kategori, tf.nama_barang as nama_sub_barang, tf.kode_barang, tf.kode_satuan_terkecil as kode_satuan, tf.uraian_satuan_terkecil as uraian_satuan, th.nama as nama_supplier from (select xa.*, xb.kode_dn, xb.no_invoice, tgl_kedatangan as tanggal_invoice from t_detail_dn xa inner join t_dn xb on xa.id_dn = xb.id_dn where xa.flag_docin is null and xb.deleted_at is null) ta left join (select xa.id_detail_po, xb.rate,xa.qty_po, xa.id_detail_pp, xb.id_supplier,xb.kode_po, xb.tanggal_dibuat as tanggal_po from t_detail_po xa inner join t_po xb on xa.id_po = xb.id_po where xb.deleted_at is null and xb.type_trans = 'purchase') tb on ta.id_detail_po = tb.id_detail_po left join (select xa.id_detail_pp, xa.id_detail_job, xb.kode_pp, xb.tanggal_dibuat as tanggal_pp from t_detail_pp xa inner join t_pp xb on xa.id_pp = xb.id_pp where xb.deleted_at is null) tc on tb.id_detail_pp = tc.id_detail_pp left join (select xa.id_detail_job, xa.id_bom_detail, xb.id_so, xb.no_job, xb.tanggal_job from t_detail_job xa inner join t_job xb on xa.id_job = xb.id_job where xb.deleted_at is null) td on tc.id_detail_job = td.id_detail_job left join (select xa.id_bom_detail, xa.id_sub_barang from t_bom_detail xa inner join t_bom xb on xa.id_bom = xb.id_bom) te on td.id_bom_detail = te.id_bom_detail left join v_sub_barang tf on te.id_sub_barang = tf.id_sub_barang left join smartone_tpb_dps1.tpb_barang  tbb on tbb.URAIAN = tf.nama_barang left join m_customer_suplier th on tb.id_supplier = th.id_customer";
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

    function viewDetailDNReturn($in)
    {
        $start = $in->start;
        $sqlmain = "select ta.*, tb.rate, tb.qty_po, tb.kode_po, tb.tanggal_po, tc.kode_pp, tc.tanggal_pp, td.no_job, td.tanggal_job, tf.nama_kategori, tf.nama_barang as nama_sub_barang, tf.kode_barang, tf.kode_satuan_terkecil as kode_satuan, tf.uraian_satuan_terkecil as uraian_satuan, th.nama as nama_supplier from (select xa.*, xb.kode_dn, xb.no_invoice, tgl_kedatangan as tanggal_invoice from t_detail_dn xa inner join t_dn xb on xa.id_dn = xb.id_dn where xa.flag_docin is null and xb.deleted_at is null) ta left join (select xa.id_detail_po, xb.rate,xa.qty_po, xa.id_detail_pp, xb.id_supplier,xb.kode_po, xb.tanggal_dibuat as tanggal_po from t_detail_po xa inner join t_po xb on xa.id_po = xb.id_po where xb.deleted_at is null and xb.type_trans = 'purchase') tb on ta.id_detail_po = tb.id_detail_po left join (select xa.id_detail_pp, xa.id_detail_job, xb.kode_pp, xb.tanggal_dibuat as tanggal_pp from t_detail_pp xa inner join t_pp xb on xa.id_pp = xb.id_pp where xb.deleted_at is null) tc on tb.id_detail_pp = tc.id_detail_pp left join (select xa.id_detail_job, xa.id_bom_detail, xb.id_so, xb.no_job, xb.tanggal_job from t_detail_job xa inner join t_job xb on xa.id_job = xb.id_job where xb.deleted_at is null) td on tc.id_detail_job = td.id_detail_job left join (select xa.id_bom_detail, xa.id_sub_barang from t_bom_detail xa inner join t_bom xb on xa.id_bom = xb.id_bom) te on td.id_bom_detail = te.id_bom_detail left join v_sub_barang tf on te.id_sub_barang = tf.id_sub_barang left join m_suplier th on tb.id_supplier = th.id_suplier";
        if (isset($in->id_dn)) {
            $sqlmain .= " where id_dn = '$in->id_dn' ";    
        } else {
            $sqlmain .= " limit 0 ";
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

    function getAllbyDN($id)
    {
        $sql = "select ta.*, tb.rate, tb.qty_po, tb.kode_po, tb.tanggal_po, tc.kode_pp, tc.tanggal_pp, td.no_job, td.tanggal_job, tf.nama_kategori, tf.nama_barang as nama_sub_barang, tf.kode_barang, tf.kode_satuan_terkecil as kode_satuan, tf.uraian_satuan_terkecil as uraian_satuan, th.nama as nama_supplier from (select xa.*, xb.kode_dn, xb.no_invoice, tgl_kedatangan as tanggal_invoice from t_detail_dn xa inner join t_dn xb on xa.id_dn = xb.id_dn where xa.flag_docin is null and xb.deleted_at is null) ta left join (select xa.id_detail_po, xb.rate,xa.qty_po, xa.id_detail_pp, xb.id_supplier,xb.kode_po, xb.tanggal_dibuat as tanggal_po from t_detail_po xa inner join t_po xb on xa.id_po = xb.id_po where xb.deleted_at is null and xb.type_trans = 'purchase') tb on ta.id_detail_po = tb.id_detail_po left join (select xa.id_detail_pp, xa.id_detail_job, xb.kode_pp, xb.tanggal_dibuat as tanggal_pp from t_detail_pp xa inner join t_pp xb on xa.id_pp = xb.id_pp where xb.deleted_at is null) tc on tb.id_detail_pp = tc.id_detail_pp left join (select xa.id_detail_job, xa.id_bom_detail, xb.id_so, xb.no_job, xb.tanggal_job from t_detail_job xa inner join t_job xb on xa.id_job = xb.id_job where xb.deleted_at is null) td on tc.id_detail_job = td.id_detail_job left join (select xa.id_bom_detail, xa.id_sub_barang from t_bom_detail xa inner join t_bom xb on xa.id_bom = xb.id_bom) te on td.id_bom_detail = te.id_bom_detail left join v_sub_barang tf on te.id_sub_barang = tf.id_sub_barang left join smartone_tpb_dps1.tpb_barang  tbb on tbb.URAIAN = tf.nama_barang  left join m_suplier th on tb.id_supplier = th.id_suplier where ta.deleted_at is null and ta.id_dn = '$id' GROUP BY ta.id_detail_dn";
        $res = $this->db->query($sql);
        
        $data = array();
        foreach ($res->result() as $r){
            $data[] = $r;
        }

        return $data;
    }

    function get($id)
    {
        $sql = $this->basesql." and ta.$this->table_id = '$id'";
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

    function setFlagDocIn($id,$idheader)
    {
    	$b = new stdClass();
    	$b->flag_docin = 1;
    	$b->ID_HEADER = $idheader;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }

    function setSeriBarang($id,$seri)
    {
    	$b = new stdClass();
    	$b->flag_docin = 1;
    	$b->seri_barang = $seri;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }

    function delete($id)
    {
        $b = new stdClass();
        $b->deleted_at = $this->nowdt;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }
}
