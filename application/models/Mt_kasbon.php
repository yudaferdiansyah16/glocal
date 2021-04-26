<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_kasbon extends CI_Model
{
	var $table = 't_kasbon';
	var $table_id = 'id_kasbon';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "SELECT ta.*, tb.nama FROM $this->table ta INNER JOIN m_user tb ON ta.id_user = tb.id_user WHERE ta.deleted_at is null";
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

	function viewDT($in, $m)
	{
		$start = $in->start;
		$sqlmain = $this->basesql." AND (ta.status_kasbon = '1' OR ta.status_kasbon = '2') AND ta.status_kasbon IS NOT NULL";

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
				$r->jumlah = number_format($r->total_kasbon, 2).",-";
				if ($r->status_kasbon == '1') {
					$r->status = "<button type='button' disabled class='btn btn-default btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-hourglass'></i> New</button>";
				}
				if ($r->status_kasbon == '2') {
					$r->status = "<button type='button' disabled class='btn btn-success btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved</button>";
				}

				$r->option = "";
				if($m==1){
					if ($r->status_kasbon == '1') {
						$r->option .= '<a href="' . base_url($this->d->_controller . '/' . $this->d->_method . '/edit/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';

						$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="' . base_url($this->d->_controller . '/' . $this->d->_method . '/delete/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
					}
				}elseif($m==2){
					if ($r->status_kasbon == '1') {
						$r->option .= ' <a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
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

	function viewDTRealisasi($in, $m)
	{
		$start = $in->start;
		$sqlmain = $this->basesql." AND (ta.status_kasbon = '2' OR ta.status_kasbon = '3'  OR ta.status_kasbon = '4')";

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
				if(!$r->total_realisasi) $r->jumlah = number_format($r->total_kasbon, 2).",-";
				else $r->jumlah = number_format($r->total_realisasi, 2).",-";
				if ($r->status_kasbon == '2') {
					$r->status = "<button type='button' disabled class='btn btn-default btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-hourglass'></i> New</button>";
				}
				if ($r->status_kasbon == '3') {
					$r->status = "<button type='button' disabled class='btn btn-primary btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Realisasi</button>";
				}
				if ($r->status_kasbon == '4') {
					$r->status = "<button type='button' disabled class='btn btn-success btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Closed</button>";
				}

				$r->option = "";
				if($m == 2){
					if ($r->status_kasbon == '3' OR $r->status_kasbon == '4') {
						$r->option .= '<a href="' . base_url($this->d->_controller . '/' . $this->d->_method . '/detail/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					}
				}elseif($m == 1){
					$r->option .= '<a href="' . base_url($this->d->_controller . '/' . $this->d->_method . '/edit/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
				}

				// $r->option .= ' <a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
				// if ($r->status_kasbon == '1') {
				// 	$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="' . base_url($this->d->_controller . '/' . $this->d->_method . '/delete/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
				// }
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
		$sql = $this->basesql." AND id_kasbon ='$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

    function create($in)
    {
        $in->tgl_kasbon = $this->nowd;
        $in->id_user = 1;
		$this->db->insert('t_kasbon', $in);
        $id = $this->db->insert_id();
        return $id;
    }

    function update($in)
    {
        $this->db->where($this->table_id, $in->id_kasbon);
        $this->db->update($this->table, $in);
    }

    function update_status($id, $status)
    {
        $b = new stdClass();
		$b->status_kasbon = $status;
		if($status==2) $b->approve_kasbon = $this->nowdt;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }

	function update_realisasi($id, $status)
    {
        $b = new stdClass();
		$b->status_kasbon = $status;
		if($status==4) $b->approve_realisasi = $this->nowdt;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }

    function total($id, $total, $catatan)
    {
        $b = new stdClass();
        $b->total_kasbon = $total;
        $b->ket_kasbon = $catatan;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }

	function realisasi($id, $total)
    {
        $b = new stdClass();
        $b->total_realisasi = $total;
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

	function approval($id, $status)
    {
        $b = new stdClass();
        $b->status_kasbon = $status;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
	}
}
