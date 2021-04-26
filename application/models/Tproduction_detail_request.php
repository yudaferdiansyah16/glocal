<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Tproduction_detail_request extends CI_Model
{
	var $table = 't_production_detail';
	var $table_id = 'id_production_detail';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "select ta.* from $this->table ta where ta.id_jenis_mutasi = '13'";
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



	function viewReq($id)
	{
		$sql = "select ta.*, tb.kode_barang, tb.nama_barang from (select * from t_production_detail where id_production = '$id') ta inner join m_sub_barang tb on ta.id_sub_barang = tb.id_sub_barang";
		$res = $this->db->query($sql);

		$data = array();
		foreach ($res->result() as $r){
			$data[] = $r;
		}

		return $data;
	}

	function viewRlz($id)
	{
		$sql = "select ta.*, tc.qty_rlz, td.qty_rtn, (ta.qty_req-ifnull(tc.qty_rlz,0)-ifnull(td.qty_rtn,0)) qty_sisa, tb.nama_barang, tb.kode_barang, tb.kode_satuan_terkecil as kode_satuan from (select xa.id_production, xa.id_detail_dn, xa.id_job, xa.id_master, xa.kode_mutasi, xa.tanggal_mutasi, xa.status, xa.approval_1, xa.approval_2, xa.id_user_approval_1, xa.id_user_approval_2, xa.date_approval_1, xa.date_approval_2, xa.date_closing, xa.id_user_closing, xa.flag_closing, xa.flag_edit, xa.flag_btl, xa.id_user_btl, xa.btl_date, xa.deleted_at, xa.id_jenis_mutasi, xb.qty as qty_req, xb.id_sub_barang from t_production xa inner join t_production_detail xb on xa.id_production = xb.id_production where xa.id_jenis_mutasi = '13' and xa.id_production = '$id') ta inner join v_sub_barang tb on ta.id_sub_barang = tb.id_sub_barang left join (select xa.id_production, xa.id_master, xa.id_jenis_mutasi, sum(xb.qty) as qty_rlz, xb.id_sub_barang from t_production xa inner join t_production_detail xb on xa.id_production = xb.id_production where xa.id_jenis_mutasi = '14' group by xb.id_sub_barang, xa.id_master) tc on (ta.id_production = tc.id_master and ta.id_sub_barang = tc.id_sub_barang) left join (select xa.id_production, xa.id_master, xa.id_jenis_mutasi, sum(xb.qty) as qty_rtn, xb.id_sub_barang from t_production xa inner join t_production_detail xb on xa.id_production = xb.id_production where xa.id_jenis_mutasi = '12' group by xb.id_sub_barang, xa.id_master) td on (ta.id_production = td.id_master and ta.id_sub_barang = td.id_sub_barang) having qty_sisa > 0";
		$res = $this->db->query($sql);

		$data = array();
		foreach ($res->result() as $r){
			$data[] = $r;
		}

		return $data;
	}

	function viewPrint()
	{
		$sqlmain = "select tb.no_job, tc.kode_barang, tc.nama_barang, td.nomor_aju, td.nomor_daftar, td.no_sj ,ta.* from (select * from t_production_detail where id_production = '$id') ta inner join t_job tb on ta.id_job = tb.id_job inner join m_sub_barang tc on ta.id_sub_barang = tc.id_sub_barang left join (select xa.id_wh_detail , xb.NOMOR_AJU as nomor_aju, xb.NOMOR_DAFTAR as nomor_daftar, xc.no_sj from t_wh_detail xa left join ".getdbtpb($this).".tpb_header xb on xa.id_header = xb.ID left join t_detail_dn xc on xa.id_detail_dn = xc.id_detail_dn) td on ta.id_wh_detail = td.id_wh_detail where qty > 0";
		$sql = $this->db->query($sqlmain);

		$data = array();
		foreach ($sql->result() as $r){
			$data[] = $r;
		}

		return $data;
	}

	function viewBasedID($id)
	{
		$in = a2o($this->in);
		$start = $in->start;
		$sqlmain = "select tb.no_job, tc.kode_barang,tc.id_satuan_terkecil ,te.KODE_SATUAN, tc.nama_barang, td.nomor_aju, td.nomor_daftar, td.no_sj ,ta.* from (select * from t_production_detail where id_production = '$id') ta inner join t_job tb on ta.id_job = tb.id_job inner join v_sub_barang tc on ta.id_sub_barang = tc.id_sub_barang left join (select xa.id_wh_detail , xb.NOMOR_AJU as nomor_aju, xb.NOMOR_DAFTAR as nomor_daftar, xc.no_sj from t_wh_detail xa left join smartone_tpb_dps1.tpb_header xb on xa.id_header = xb.ID left join t_detail_dn xc on xa.id_detail_dn = xc.id_detail_dn) td on ta.id_wh_detail = td.id_wh_detail LEFT JOIN smartone_tpb_dps1.referensi_satuan te ON te.ID = tc.id_satuan_terkecil where qty > 0";
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

	function get($id)
	{
		$sql = "select * from ($this->basesql) pa where $this->table_id = '$id'";
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


	function approval1($id)
	{
		$b = new stdClass();
		$b->approval_1 = 1;
		$b->id_user_approval_1 = 1;
		$b->date_approval_1 = $this->nowdt;
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table, $b);
	}

	function approval2($id)
	{
		$b = new stdClass();
		$b->approval_2 = 1;
		$b->id_user_approval_2 = 1;
		$b->date_approval_2 = $this->nowdt;
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table, $b);
	}

	function disapprove($id)
	{
		$b = new stdClass();
		$b->approval_1 = 0;
		$b->id_user_approval_1 = 0;
		$b->date_approval_1 = $this->nowdt;
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table, $b);
	}

	function cancel($id)
	{
		$b = new stdClass();
		$b->flag_btl = 1;
		$b->id_user_btl = 1;
		$b->btl_date = $this->nowdt;
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table, $b);
	}

	function closing($id)
	{
		$b = new stdClass();
		$b->flag_closing = 1;
		$b->id_user_closing = 1;
		$b->date_closing = $this->nowdt;
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table, $b);
	}

	function generateCode($date)
	{
		$month = date('m', strtotime($date));
		$year = date('Y', strtotime($date));
		$res = $this->db->query("select kode_mutasi from $this->table where id_jenis_mutasi='13' and tanggal_mutasi >= '".date('Y-m-01', strtotime($date))."' and tanggal_mutasi <= '".date('Y-m-t', strtotime($date))."' and deleted_at is null order by tanggal_mutasi desc, kode_mutasi desc limit 1");
		$num = $res->num_rows();
		if($num > 0 ){
			$row = $res->row();
			$last = (substr($row->kode_mutasi, 0, 4) * 1)+1;
		} else {
			$last = 1;
		}

		$app_setting = getAppSetting($this);
		return str_pad($last, 4, '0', STR_PAD_LEFT)."/RQS-".$app_setting->kode_sbu."/".integerToRoman($month)."/".$year;
	}
}
