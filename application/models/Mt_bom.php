<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_bom extends CI_Model
{
	var $table = 't_bom';
    var $table_id = 'id_bom';
    var $nowdt, $nowd, $nowt, $basesql;

    function __construct()
    {
        parent::__construct();
        $this->nowdt = date('Y-m-d H:i:s');
        $this->nowd = date('Y-m-d');
        $this->nowt = date('H:i:s');
        $this->basesql = "select ta.*, tb.nama_consignee as nama_supplier, tc.id_po, tc.kode_po, tc.tanggal_dibuat, tc.po_buyer, tc.id_supplier, td.status_trans, te.kode_barang, te.nama_barang, tf.KODE_SATUAN as kode_satuan, tf.URAIAN_SATUAN as uraian_satuan, IFNULL(bw.workflow_count, 0) as workflow_count, IFNULL(bd.detail_count, 0) as detail_count, be.no_job from $this->table as ta left join t_detail_po tj on tj.id_detail_po =ta.id_detail_po left join t_po as tc on tc.id_po = tj.id_po left join m_customer_suplier as tb on tb.id_customer = tc.id_supplier left join m_status as td on td.id_status = ta.id_status left join m_sub_barang as te on te.id_sub_barang = ta.id_sub_barang left join smartone_tpb_dps1.referensi_satuan as tf on tf.ID = tj.id_satuan left join (select id_bom, count(*) as workflow_count from t_bom_workflow group by id_bom) as bw on bw.id_bom = ta.id_bom left join (select t_bom_workflow.id_bom, count(*) as detail_count from t_bom_detail inner join t_bom_workflow on t_bom_workflow.id_bom_workflow = t_bom_detail.id_bom_workflow group by t_bom_workflow.id_bom) as bd on bd.id_bom = ta.id_bom left join t_job be on ta.id_bom=be.id_bom where ta.deleted_at is null";
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
        $sqlmain = $this->basesql . " order by ta.id_bom desc";
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
                    $r->option = '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/workflow/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
                    $r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
                }
				$r->job_option = '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/job/'.$r->{$this->table_id}).'" class="btn btn-xs btn-secondary"><i class="fal fa fa-briefcase"></i></a> ';
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
        $sql = $this->basesql." and ta.$this->table_id = '$id'";
        $res = $this->db->query($sql);
        $row = $res->row();
        return $row;
    }

    function create($in)
    {
        $in->kode_bom = $this->generateCode($in->tanggal_bom);
        $in->id_status = 1;
        $in->created_at = $this->nowdt;
        $in->updated_at = $this->nowdt;
        $this->db->insert($this->table, $in);
        $id = $this->db->insert_id();

        //doc repo
        $d = new stdClass();
        $d->id = $id;
        $d->id_detail_po = $in->id_detail_po;
        $d->kode_bom = $in->kode_bom;
        docProcess($this, 'BOM', $d);

        return $id;
    }

    function update($in)
    {
        $in->updated_at = $this->nowdt;
        $this->db->where($this->table_id, $in->id_bom);
        $this->db->update($this->table, $in);
    }

    function delete($id)
    {
        $b = new stdClass();
        $b->deleted_at = $this->nowdt;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }

    function generateCode($bom_date)
	{
		$month = date('m', strtotime($bom_date));
		$year = date('Y', strtotime($bom_date));
		$res = $this->db->query("select kode_bom from $this->table where tanggal_bom >= '".date('Y-m-01', strtotime($bom_date))."' and tanggal_bom <= '".date('Y-m-t', strtotime($bom_date))."' and deleted_at is null order by kode_bom desc limit 1");
		$num = $res->num_rows();
		$latest_number = 1;
		if ($num > 0) {
			$index_number = '0000';
			foreach ($res->result() as $r){
				$arrnumber = explode('/', $r->kode_bom);
				$index_number = $arrnumber[0];
			}
			$latest_number = intval($index_number);
			$latest_number++;
		}

		$app_setting = getAppSetting($this);
		return str_pad($latest_number, 4, '0', STR_PAD_LEFT)."/BOM-".$app_setting->kode_sbu."/".integerToRoman($month)."/".$year;
	}
}
