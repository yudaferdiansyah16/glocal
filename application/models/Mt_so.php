<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_so extends CI_Model
{
	var $table = 't_po';
	var $table_id = 'id_po';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		//$this->basesql = "select ta.*, tc.NAMA as nama_supplier, td.KODE_VALUTA as kode_valuta, td.URAIAN_VALUTA as uraian_valuta, te.nama_tipe_sales, tb.amount from $this->table as ta left join (select id_po, sum(harga * qty_po) as amount from t_detail_po group by id_po) as tb on tb.id_po = ta.id_po left join smartone_tpb_dps1.referensi_pemasok as tc on tc.ID = ta.id_supplier left join smartone_tpb_dps1.referensi_valuta as td ON td.id = ta.id_valuta left join m_tipe_sales te on te.id_tipe_sales = ta.id_tipe_sales where ta.type_trans = 'sales' and ta.deleted_at is null";
		// $this->basesql = "select ta.*, tc.nama_consignee as nama_supplier, td.KODE_VALUTA as kode_valuta, td.URAIAN_VALUTA as uraian_valuta, te.nama_tipe_sales, rincian, tb.amount from t_po as ta left join (select id_po, json_object('kode',kode_barang,'nama',nama_barang) rincian, sum(harga * qty_po) as amount from t_detail_po ma, v_sub_barang mb where ma.id_sub_barang=mb.id_sub_barang group by id_po) as tb on tb.id_po = ta.id_po left join m_customer_suplier as tc on tc.id_customer = ta.id_supplier left join smartone_tpb_dps1.referensi_valuta as td ON td.id = ta.id_valuta left join m_tipe_sales te on te.id_tipe_sales = ta.id_tipe_sales where ta.type_trans = 'sales' and ta.deleted_at is null";
		$this->basesql = "select ta.*, tp.NAMA as nama_supplier, tp.nama_consignee, td.KODE_VALUTA as kode_valuta, td.URAIAN_VALUTA as uraian_valuta, te.nama_tipe_sales, rincian, tb.amount from t_po as ta left join (select id_po, json_object('kode',kode_barang,'nama',nama_barang) rincian, sum(harga * qty_po) as amount from t_detail_po ma, m_sub_barang mb where ma.id_sub_barang=mb.id_sub_barang group by id_po) as tb on tb.id_po = ta.id_po left join m_customer_suplier as tc on tc.id_customer = ta.id_supplier left join smartone_tpb_dps1.referensi_valuta as td ON td.id = ta.id_valuta left join m_tipe_sales te on te.id_tipe_sales = ta.id_tipe_sales left join m_customer_suplier tp on ta.id_supplier=tp.id_customer where ta.type_trans = 'sales' and ta.deleted_at is null";
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

	function viewDT($in)
	{
		$start = $in->start;
		$sqlmain = $this->basesql;
		if(isset($in->is_approved)){
			$sqlmain .=" and ta.approval_1='1' and ta.approval_2='1' ";
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
				//$r->nama_supplier = $r->nama_supplier.' <span style="display:none">'.$r->rincian.'</span>';
				$r->amount = $r->kode_valuta." ".number_format($r->amount, 2);
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
				$r->option = "";
				if ($r->approval_1 == '0' && $r->approval_2 == '0') {
					$r->option .= '<a href="' . base_url($this->d->_controller . '/' . $this->d->_method . '/edit/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
				}
				$r->option .= ' <a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
				if ($r->approval_1 == '0' && $r->approval_2 == '0') {
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
		$sql = $this->basesql." and ta.id_po ='$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function getJobBySO($id)
    {
        $sql = "select id_po, id_supplier, tanggal_dibuat from t_po where id_po=$id";
        $res = $this->db->query($sql);
        $row = $res->row();

        $sql1 = "select job_prefix from m_customer_suplier where id_customer='$row->id_supplier'";
        $res1 = $this->db->query($sql1);
        $row1 = $res1->row();

		$arr = explode('-', $row->tanggal_dibuat);
		$year = $arr[0];
		$month = $arr[1];
		$prefix = $row1->job_prefix.substr($year, 2).$month;
		// $prefix = $row1->job_prefix.substr( date('Y'), -2).date('m');
        $sql2 = "select * from t_job where no_job like '$prefix%' order by no_job desc limit 1";
        $res2 = $this->db->query($sql2);
        $num2 = $res2->num_rows();
        if($num2>0) {
            $row2 = $res2->row();
            $prefix .= str_pad(((substr($row2->no_job, -3) * 1) + 1), 3, '0', STR_PAD_LEFT);
        } else $prefix .= '001';

        $row->nojob = $prefix;
        return $row;
    }

	function getDetail($id)
    {
        $sql = "select id_detail_po, id_sub_barang, tanggal_dibuat,sum(qty_po) as qty from t_po ta, t_detail_po tb where ta.id_po=tb.id_po and ta.id_po=$id group by id_sub_barang";
        $res = $this->db->query($sql);
        $data = array();
        foreach ($res->result() as $r){
            $data[] = $r;
        }
        return $data;
    }

    function create($in)
    {
		$in->kode_po = $this->generateCode($in->tanggal_dibuat, $in->id_tipe_sales);
        $in->created_at = $this->nowdt;
        $in->updated_at = $this->nowdt;
        $this->db->insert($this->table, $in);
        $id = $this->db->insert_id();

        //doc repo
        $d = new stdClass();
        $d->id = $id;
        $d->kode_po = $in->kode_po;
        docProcess($this, 'SO', $d);

        return $id;
    }

    function update($in)
    {
        $in->updated_at = $this->nowdt;
        $this->db->where($this->table_id, $in->id_po);
        $this->db->update($this->table, $in);
    }

    function delete($id)
    {
        $b = new stdClass();
        $b->deleted_at = $this->nowdt;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
	}
	
	function generateCode($so_date, $id_tipe_sales)
	{
		$month = date('m', strtotime($so_date));
		$year = date('Y', strtotime($so_date));
		$res = $this->db->query("select kode_po from $this->table where tanggal_dibuat >= '".date('Y-m-01', strtotime($so_date))."' and tanggal_dibuat <= '".date('Y-m-t', strtotime($so_date))."' and id_tipe_sales = '$id_tipe_sales' order by kode_po desc limit 1");
		$num = $res->num_rows();
		$latest_number = 1;
		if ($num > 0) {
			$index_number = '0000';
			foreach ($res->result() as $r){
				$arrnumber = explode('/', $r->kode_po);
				$index_number = $arrnumber[0];
			}
			$latest_number = intval($index_number);
			$latest_number++;
		}
		modelLoad($this, array('mm_tipe_sales'));
		$kode_tipe_sales = $this->mm_tipe_sales->get($id_tipe_sales)->kode_tipe_sales;

		$app_setting = getAppSetting($this);
		return str_pad($latest_number, 4, '0', STR_PAD_LEFT)."/".$kode_tipe_sales."-".$app_setting->kode_sbu."/".integerToRoman($month)."/".$year;
	}
}
