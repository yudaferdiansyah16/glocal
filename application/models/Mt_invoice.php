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
		$this->basesql = "select th.ID_PENERIMA_BARANG, th.KODE_DOKUMEN_PABEAN, th.NOMOR_DAFTAR, th.NOMOR_AJU, CAST(th.TANGGAL_AJU AS DATE) AS TANGGAL_AJU, ta.*, tg.kode_customer, tg.nama nama_supplier, tf.nama_tujuan, tf.alamat, td.URAIAN_NEGARA uraian_negara, tc.KODE_VALUTA kode_valuta, tc.URAIAN_VALUTA uraian_valuta, ifnull(te.qty_invoice, 0) qty_invoice, ifnull(te.harga, 0) harga, ifnull(te.amount, 0) amount, ifnull(te.detail_count, 0) as detail_count from t_invoice ta left join m_customer_suplier tg on tg.id_customer = ta.id_supplier left join ".getdbtpb($this).".referensi_valuta tc on tc.ID = ta.id_valuta left join m_detail_supplier_destination tf on tf.id_supplier_destination = ta.destination left join ".getdbtpb($this).".referensi_negara td on td.ID = tf.id_negara left join (select id_invoice, sum(qty_invoice) as qty_invoice, sum(harga) as harga, sum(qty_invoice * harga) as amount, count(*) as detail_count from t_invoice_detail group by id_invoice) te on te.id_invoice = ta.id_invoice left join ".getdbtpb($this).".tpb_header th on th.ID = ta.ID_HEADER where ta.deleted_at is null";
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
					$r->status_approve = "<button type='button' disabled class='btn btn-default btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-hourglass'></i> Ready</button>";
				}
				if ($r->approval_2 == '0' && $r->approval_1 == '1') {
					$r->status_approve = "<button type='button' disabled class='btn btn-success btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved 1</button>";
				}
				if ($r->approval_2 == '1' && $r->approval_1 == '1') {
					$r->status_approve = "<button type='button' disabled class='btn btn-primary btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved 2</button>";
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
					$r->option .= "<a href='".base_url('warehouse/issue_material/print/'.$r->id_invoice)."' class='btn btn-xs btn-default'><i class='fal fa-print'></i></a>";
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

	function viewInvoiceDocOut($in)
	{
		$start = $in->start;
		$sqlmain = "select te.KODE_KEMASAN,ta.id_invoice_detail,ta.id_supplier, ta.kode_invoice, ta.tanggal_invoice, ta.id_detail_stuffing, tb.kode_stuffing, tb.tanggal_stuffing, tc.kode_barang, tc.nama_barang, td.URAIAN_SATUAN as satuan, td.KODE_SATUAN, ta.netto, ta.bruto, ta.qty_invoice,ta.harga as harga_satuan, (ta.qty_invoice * ta.harga) as harga_invoice, ta.rate, ta.qty_mc,  tf.NAMA as NAMA_CUSTOMER from (select xa.*, xb.rate,xb.kode_invoice, xb.tanggal_invoice, xb.id_supplier from smartone_dps1.t_invoice_detail xa inner join smartone_dps1.t_invoice xb on xa.id_invoice = xb.id_invoice) ta inner join (select xa.*, xb.kode_stuffing, xb.tanggal_stuffing from smartone_dps1.t_detail_stuffing xa inner join smartone_dps1.t_stuffing xb on xa.id_stuffing = xb.id_stuffing) tb on ta.id_detail_stuffing = tb.id_detail_stuffing left join smartone_tpb_dps1.referensi_kemasan te on ta.id_kemasan = te.ID inner join smartone_dps1.m_sub_barang tc on ta.id_sub_barang = tc.id_sub_barang inner join  ".getdbtpb($this).".referensi_satuan td on ta.id_satuan = td.ID inner join  m_customer_suplier tf on ta.id_supplier = tf.id_customer";
		// printJSON($in->id_supplier);
		if (isset($in->id_supplier)){
			$sqlmain = "select * from ($sqlmain) pa where id_supplier = '$in->id_supplier'";
		}
		// printJSON($sqlmain);
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

	function getReport($in)
	{
		if($in->customer == 'ALL'){
			if($in->type == 'export'){
				$sql = $this->basesql." AND th.KODE_DOKUMEN_PABEAN = '23' AND (ta.tanggal_invoice BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') and ta.is_posting != 1";
			}else{
				$sql = $this->basesql." AND th.KODE_DOKUMEN_PABEAN IN ('40', '27') AND (ta.tanggal_invoice BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') and ta.is_posting != 1";
			}
		}else{
			if($in->type == 'export'){
				$sql = $this->basesql." AND th.KODE_DOKUMEN_PABEAN = '23' AND ta.id_supplier = '".$in->customer."' AND (ta.tanggal_invoice BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') and ta.is_posting != 1";
			}else{
				$sql = $this->basesql." AND th.KODE_DOKUMEN_PABEAN IN ('40', '27') AND ta.id_supplier = '".$in->customer."' AND (ta.tanggal_invoice BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') and ta.is_posting != 1";
			}
		}
		$res = $this->db->query($sql);
		$result = $res->result();
		return $result;
	}

	function getAll()
	{
		$sql = $this->basesql." and ta.is_posting != 1";
		$res = $this->db->query($sql);
		$result = $res->result();
		return $result;
	}

	function getWhere($in)
	{
		if($in->customer == 'ALL'){
			$sql = $this->basesql."  AND ta.date_approval_2 IS NOT NULL AND (ta.tanggal_invoice BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') and ta.is_posting != 1";
		}else{
			$sql = $this->basesql." AND ta.date_approval_2 IS NOT NULL AND ta.id_supplier = '".$in->customer."' AND (ta.tanggal_invoice BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') and ta.is_posting != 1";
		}
		$res = $this->db->query($sql);
		$result = $res->result();
		return $result;
	}

	function getRate($id)
	{
		$sql = "select distinct tpo.rate, tpo.id_valuta from t_invoice tdn inner join t_invoice_detail tdnd on tdn.id_invoice = tdnd.id_invoice left join t_detail_stuffing tds on tdnd.id_detail_stuffing=tds.id_detail_stuffing left join t_detail_po tdpo on tds.id_detail_po = tdpo.id_detail_po left join t_po tpo on tdpo.id_po = tpo.id_po where tdn.id_invoice = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function getAkun($id)
	{
		$sql = "select ta.kode_customer, ta.nama, tb.id_akun, tb.kode_akun as kode_akun, tb.nama_akun as nama_akun from m_customer_suplier ta left join m_akun tb on ta.id_akun = tb.id_akun where ta.deleted_at is null and ta.id_customer='$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function getDetail($id)
	{
		// $sql = "select td.id_invoice, td.harga, td.qty_invoice, td.id_sub_barang, tv.nama_barang, tv.kode_barang, tv.kode_satuan_terkecil from t_invoice_detail td left join v_sub_barang tv on td.id_sub_barang=tv.id_sub_barang where td.id_invoice = '$id'";
		$sql = "select td.id_invoice, td.id_sub_barang, td.qty_invoice, td.harga, ifnull(td.qty_invoice * td.harga, 0) as amount, tv.nama_barang, tv.kode_barang, tv.kode_satuan_terkecil, tc.id_akun, tc.id_akun_lawan, tx.kode_akun, tx.nama_akun, ty.nama_akun as nama_akun_lawan from t_invoice_detail td left join v_sub_barang tv on td.id_sub_barang=tv.id_sub_barang left join m_class tc on tv.id_class=tc.id_class left join m_akun tx on tc.id_akun=tx.id_akun left join m_akun ty on tc.id_akun_lawan=ty.id_akun where td.id_invoice = '$id'";
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

	function approval1($id)
    {
        $b = new stdClass();
        $b->approval_1 = 1;
        $b->id_user_approval_1 =  $this->session->userdata('id_user');
        $b->date_approval_1 = $this->nowdt;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
	}
	function approval2($id)
    {
        $b = new stdClass();
        $b->approval_2 = 1;
        $b->id_user_approval_2 =  $this->session->userdata('id_user');
        $b->date_approval_2 = $this->nowdt;
       
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }

    function disapprove1($id)
    {
        $b = new stdClass();
        $b->approval_1 = 0;
        $b->id_user_approval_1 =  $this->session->userdata('id_user');
        $b->date_approval_1 = $this->nowdt;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }

    function disapprove2($id)
    {
        $b = new stdClass();
        $b->approval_2 = 0;
        $b->id_user_approval_2 =  $this->session->userdata('id_user');
        $b->date_approval_2 = $this->nowdt;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }
}


