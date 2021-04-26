<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_invoice extends CI_Model
{
	var $table = 't_invoice';
	var $table_id = 'id_invoice';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		// $this->basesql = "select ta.*, tb.nama nama_supplier, td.URAIAN_NEGARA uraian_negara, tc.KODE_VALUTA kode_valuta, tc.URAIAN_VALUTA uraian_valuta, ifnull(te.amount, 0) amount from $this->table ta left join m_customer_suplier tb on tb.id_customer = ta.id_supplier left join ".getdbtpb($this).".referensi_valuta tc on tc.ID = ta.id_valuta left join ".getdbtpb($this).".referensi_negara td on td.ID = ta.id_country left join (select id_invoice, sum(qty_invoice * harga) as amount, count(*) as detail_count from t_invoice_detail group by id_invoice) te on te.id_invoice = ta.id_invoice where ta.deleted_at is null";
		// $this->basesql = "select ta.*, tb.nama nama_supplier, td.URAIAN_NEGARA uraian_negara, tc.KODE_VALUTA kode_valuta, tc.URAIAN_VALUTA uraian_valuta, ifnull(te.qty_invoice, 0) qty_invoice, ifnull(te.harga, 0) as harga from $this->table ta left join m_customer_suplier tb on tb.id_customer = ta.id_supplier left join ".getdbtpb($this).".referensi_valuta tc on tc.ID = ta.id_valuta left join ".getdbtpb($this).".referensi_negara td on td.ID = ta.id_country left join t_invoice_detail te on te.id_invoice = ta.id_invoice where ta.deleted_at is null";
		$this->basesql = "select th.ID_PENERIMA_BARANG, th.KODE_DOKUMEN_PABEAN, th.NOMOR_DAFTAR, th.NOMOR_AJU, CAST(th.TANGGAL_AJU AS DATE) AS TANGGAL_AJU, ta.*, tb.kode_customer, tb.nama nama_supplier, td.URAIAN_NEGARA uraian_negara, tc.KODE_VALUTA kode_valuta, tc.URAIAN_VALUTA uraian_valuta, ifnull(te.qty_invoice, 0) qty_invoice, ifnull(te.harga, 0) as harga from $this->table ta left join m_customer_suplier tb on tb.id_customer = ta.id_supplier left join ".getdbtpb($this).".referensi_valuta tc on tc.ID = ta.id_valuta left join ".getdbtpb($this).".referensi_negara td on td.ID = ta.id_country left join t_invoice_detail te on te.id_invoice = ta.id_invoice left join ".getdbtpb($this).".tpb_header th on th.ID=ta.ID_HEADER where ta.deleted_at is null";
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

				$r->kode_invoice = "<a href='".base_url('sales/invoice/print/'.$r->id_invoice)."'>$r->kode_invoice</a>";

				$r->status_approve = "";
				if ($r->approval_1 == '0') {
					$r->status_approve = "<span class='badge badge-warning'><i class='fa fal fa-exclamation-triangle'></i> Apv1</span>";
				}
				if ($r->approval_1 == '1') {
					$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check'></i> Apv1</span>";
				}
				if ($r->approval_2 == '0' && $r->approval_1 == '1') {
					$r->status_approve = "<span class='badge badge-warning'><i class='fa fal fa-exclamation-triangle'></i> Apv2</span>";
				}
				if ($r->approval_2 == '1' && $r->approval_1 == '1') {
					$r->status_approve = "<span class='badge badge-success'><i class='fa fal fa-check'></i> Apv2</span>";
				}

				if($opt){
					$r->option = "";
					if ($r->approval_1 == '0' && $r->approval_2 == '0') {
						$r->option .= '<a href="' . base_url($this->d->_controller . '/' . $this->d->_method . '/edit/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					}
					$r->option .= ' <a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
					if ($r->approval_1 == '0' && $r->approval_2 == '0') {
						$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="' . base_url($this->d->_controller . '/' . $this->d->_method . '/delete/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
					}
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

	function viewInvoiceDocIn($in)
	{
		$start = $in->start;
		$sqlmain = "select ta.id_po, ta.kode_po, ta.tanggal_po, ta.id_detail_dn, ta.no_sj, ta.tanggal_sj, ta.id_job, tb.kode_job, tb.tanggal_stuffing, tc.kode_barang, tc.nama_barang, td.URAIAN_SATUAN as satuan, td.KODE_SATUAN, ta.netto, ta.bruto, ta.qty_invoice,ta.harga as harga_satuan, (ta.qty_invoice * ta.harga) as harga_invoice, ta.rate, ta.qty_mc, te.KODE_KEMASAN, te.URAIAN_KEMASAN, tf.NAMA as NAMA_CUSTOMER from (select xa.*, xb.rate,xb.kode_invoice, xb.tanggal_invoice, xb.id_supplier from smartone_sbp.t_invoice_detail xa inner join smartone_sbp.t_invoice xb on xa.id_invoice = xb.id_invoice) ta inner join (select xa.*, xb.kode_stuffing, xb.tanggal_stuffing from smartone_sbp.t_detail_stuffing xa inner join smartone_sbp.t_stuffing xb on xa.id_stuffing = xb.id_stuffing) tb on ta.id_detail_stuffing = tb.id_detail_stuffing inner join smartone_dps1.m_sub_barang tc on ta.id_sub_barang = tc.id_sub_barang inner join  ".getdbtpb($this).".referensi_satuan td on ta.id_satuan = td.ID inner join  ".getdbtpb($this).".referensi_kemasan te on ta.id_kemasan = te.ID inner join  ".getdbtpb($this).".referensi_pemasok tf on ta.id_supplier = tf.ID";
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

				$r->blank='';

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

	function getReportLocal($in)
	{
		if($in->customer == 'ALL'){
			$sql = $this->basesql." AND th.KODE_DOKUMEN_PABEAN IN ('40', '27') AND (ta.tanggal_invoice BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') and ta.is_posting = 0";
		}else{
			$sql = $this->basesql." AND th.KODE_DOKUMEN_PABEAN IN ('40', '27') AND ta.id_supplier = '".$in->customer."' AND (ta.tanggal_invoice BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') and ta.is_posting = 0";
		}
		$res = $this->db->query($sql);
		$result = $res->result();
		return $result;
	}

	function getReportExport($in)
	{
		if($in->customer == 'ALL'){
			$sql = $this->basesql." AND th.KODE_DOKUMEN_PABEAN = '23' AND (ta.tanggal_invoice BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') and ta.is_posting = 0";
		}else{
			$sql = $this->basesql." AND th.KODE_DOKUMEN_PABEAN = '23' AND ta.id_supplier = '".$in->customer."' AND (ta.tanggal_invoice BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') and ta.is_posting = 0";
		}
		$res = $this->db->query($sql);
		$result = $res->result();
		return $result;
	}

	function getAll()
	{
		$sql = $this->basesql." and ta.is_posting = 0";
		$res = $this->db->query($sql);
		$result = $res->result();
		return $result;
	}

	function getWhere($in)
	{
		if($in->customer == 'ALL'){
			$sql = $this->basesql." AND (ta.tanggal_invoice BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') and ta.is_posting = 0";
		}else{
			$sql = $this->basesql." AND ta.id_supplier = '".$in->customer."' AND (ta.tanggal_invoice BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') and ta.is_posting = 0";
		}
		$res = $this->db->query($sql);
		$result = $res->result();
		return $result;
	}

	function getRate($id)
	{
		$sql = "select distinct tpo.rate from t_invoice tdn inner join t_invoice_detail tdnd on tdn.id_invoice = tdnd.id_invoice left join t_detail_stuffing tds on tdnd.id_detail_stuffing=tds.id_detail_stuffing left join t_detail_po tdpo on tds.id_detail_po = tdpo.id_detail_po left join t_po tpo on tdpo.id_po = tpo.id_po where tdn.id_invoice = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function getAkun($id)
	{
		$sql = "select ta.*,tb.id_akun as id_akun_jual, tb.kode_akun as kode_akun_jual, tb.nama_akun as nama_akun_jual, tc.id_akun as id_akun_piutang, tc.kode_akun as kode_akun_piutang, tc.nama_akun as nama_akun_piutang from m_customer ta left join m_akun tb on ta.id_akun_jual = tb.id_akun left join m_akun tc on ta.id_akun_piutang=tc.id_akun where ta.deleted_at is null and ta.id_supplier='$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function getDetail($id)
	{
		$sql = "select td.id_invoice, td.harga, td.qty_invoice, td.id_sub_barang, tv.nama_barang, tv.kode_barang, tv.kode_satuan_terkecil from t_invoice_detail td left join v_sub_barang tv on td.id_sub_barang=tv.id_sub_barang where td.id_invoice = '$id'";
		$res = $this->db->query($sql);
		$row = $res->result_array();
		return $row;
	}

	function getPO($id)
	{
		$sql = "SELECT tpo.kode_po FROM t_po tpo LEFT JOIN t_detail_po tdp ON tpo.id_po=tdp.id_po LEFT JOIN t_detail_stuffing tds ON tdp.id_detail_po=tds.id_detail_po LEFT JOIN t_invoice_detail tid ON tds.id_detail_stuffing=tid.id_detail_stuffing LEFT JOIN t_invoice ti ON tid.id_invoice=ti.id_invoice WHERE tid.id_invoice = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function get($id)
	{
		$sql = $this->basesql." and  ta.$this->table_id='$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

    function create($in)
    {
    	$in->kode_invoice = $this->generateCode($in->tanggal_invoice, $in->id_tipe_sales);
        $in->created_at = $this->nowdt;
        $in->updated_at = $this->nowdt;
        $this->db->insert($this->table, $in);
        $id = $this->db->insert_id();
        return $id;
    }

    function update($in)
    {
        $in->updated_at = $this->nowdt;
        $this->db->where($this->table_id, $in->id_stuffing);
        $this->db->update($this->table, $in);
    }

    function delete($id)
    {
        $b = new stdClass();
        $b->deleted_at = $this->nowdt;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }

	function generateCode($tanggal_invoice, $id_tipe_sales)
	{
		modelLoad($this, array('mm_tipe_sales', 'mt_so'));
		$month = date('m', strtotime($tanggal_invoice));
		$year = date('Y', strtotime($tanggal_invoice));

		$kode_tipe_sales = "";
		switch ($id_tipe_sales) {
			case '1':
				$kode_tipe_sales = "INVE";
				break;
			case '2':
				$kode_tipe_sales = "INVD";
				break;
			case '3':
				$kode_tipe_sales = "INVS";
				break;
			default:
				break;
		}

		$res = $this->db->query("select kode_invoice from $this->table where tanggal_invoice >= '".date('Y-m-01', strtotime($tanggal_invoice))."' and tanggal_invoice <= '".date('Y-m-t', strtotime($tanggal_invoice))."' and id_tipe_sales = '$id_tipe_sales' and deleted_at is null order by kode_invoice desc limit 1");
		$num = $res->num_rows();
		$latest_number = 1;
		if ($num > 0) {
			$index_number = '0000';
			foreach ($res->result() as $r){
				$arrnumber = explode('/', $r->kode_invoice);
				$index_number = $arrnumber[0];
			}
			$latest_number = intval($index_number);
			$latest_number++;
		}

		$app_setting = getAppSetting($this);
		return str_pad($latest_number, 4, '0', STR_PAD_LEFT)."/".$kode_tipe_sales."-".$app_setting->kode_sbu."/".integerToRoman($month)."/".$year;
	}
}
