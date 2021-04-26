<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mtpb_approval extends CI_Model
{
	var $table = 'tpb_approval';
	var $table_id = 'ID';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "select ta.* from $this->table ta";
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
		$sql = "select * from ($this->basesql) pa where $this->table_id = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function getByHeader($id)
	{
		$sql = "select * from ($this->basesql) pa where ID_HEADER = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function create($in)
	{
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
		$b->FLAG_APPROVAL1 = 1;
		$b->DATE_APPROVAL1 = $this->nowdt;
		$this->db->where('ID_HEADER', $id);
		$this->db->update($this->table, $b);
		$data = array(
			'TANGGAL_TTD' =>$this->nowdt
		);
		$this->db->where('ID', $id);
		$this->db->update('smartone_tpb_dps1.tpb_header',$data);
		
		$config['hostname'] = '103.82.240.141';
        $config['username'] = 'itone';
        $config['password'] = 'itlinasone';
        $config['database'] = 'tpbdb';
        $config['dbdriver'] = "mysqli";
        $config['dbprefix'] = "";
        $config['pconnect'] = FALSE;
        $config['db_debug'] = (ENVIRONMENT !== 'production');
        $config['cache_on'] = FALSE;
        $config['cachedir'] = "";
        $config['char_set'] = "utf8";
        $config['dbcollat'] = "utf8_general_ci";
        $config['swap_pre'] = '';
        $config['encrypt'] = FALSE;
        $config['compress'] = FALSE;
        $config['stricton'] = FALSE;
        $config['failover'] = array();
        $config['save_queries'] = TRUE;

        $dbtpb = $this->load->database($config, TRUE);
		
		$sqlheader = "select * from ".getdbtpb($this).".tpb_header where ID = '$id'";
		$resheader = $this->db->query($sqlheader);
		$header = $resheader->row();

		$sqlbahan_baku = "select * from ".getdbtpb($this).".tpb_bahan_baku where ID_HEADER = '$id'";
		$resbahan_baku = $this->db->query($sqlbahan_baku);
		$bahan_baku = array();
		foreach ($resbahan_baku->result() as $r){
			$bahan_baku[] = $r;
		}
		$countbahan_baku = count($bahan_baku);

		$sqlbahan_baku_dokumen = "select * from ".getdbtpb($this).".tpb_bahan_baku_dokumen where ID_HEADER = '$id'";
		$resbahan_baku_dokumen = $this->db->query($sqlbahan_baku_dokumen);
		$bahan_baku_dokumen = array();
		foreach ($resbahan_baku_dokumen->result() as $r){
			$bahan_baku_dokumen[] = $r;
		}
		$countbahan_baku_dokumen = count($bahan_baku_dokumen);

		$sqlbahan_baku_tarif = "select * from ".getdbtpb($this).".tpb_bahan_baku_tarif where ID_HEADER = '$id'";
		$resbahan_baku_tarif = $this->db->query($sqlbahan_baku_tarif);
		$bahan_baku_tarif = array();
		foreach ($resbahan_baku_tarif->result() as $r){
			$bahan_baku_tarif[] = $r;
		}
		$countbahan_baku_tarif = count($bahan_baku_tarif);

		$sqlbarang = "select * from ".getdbtpb($this).".tpb_barang where ID_HEADER = '$id'";
		$resbarang = $this->db->query($sqlbarang);
		$barang = array();
		foreach ($resbarang->result() as $r){
			$barang[] = $r;
		}
		$countbarang = count($barang);

		$sqlbarang_dokumen = "select * from ".getdbtpb($this).".tpb_barang_dokumen where ID_HEADER = '$id'";
		$resbarang_dokumen = $this->db->query($sqlbarang_dokumen);
		$barang_dokumen = array();
		foreach ($resbarang_dokumen->result() as $r){
			$barang_dokumen[] = $r;
		}
		$countbarang_dokumen = count($barang_dokumen);

		$sqlbarang_penerima = "select * from ".getdbtpb($this).".tpb_barang_penerima where ID_HEADER = '$id'";
		$resbarang_penerima = $this->db->query($sqlbarang_penerima);
		$barang_penerima = array();
		foreach ($resbarang_penerima->result() as $r){
			$barang_penerima[] = $r;
		}
		$countbarang_penerima = count($barang_penerima);

		$sqlbarang_tarif = "select * from ".getdbtpb($this).".tpb_barang_tarif where ID_HEADER = '$id'";
		$resbarang_tarif = $this->db->query($sqlbarang_tarif);
		$barang_tarif = array();
		foreach ($resbarang_tarif->result() as $r){
			$barang_tarif[] = $r;
		}
		$countbarang_tarif = count($barang_tarif);

		$sqldokumen = "select * from ".getdbtpb($this).".tpb_dokumen where ID_HEADER = '$id'";
		$resdokumen = $this->db->query($sqldokumen);
		$dokumen = array();
		foreach ($resdokumen->result() as $r){
			$dokumen[] = $r;
		}
		$countdokumen = count($dokumen);

		$sqljaminan = "select * from ".getdbtpb($this).".tpb_jaminan where ID_HEADER = '$id'";
		$resjaminan = $this->db->query($sqljaminan);
		$jaminan = array();
		foreach ($resjaminan->result() as $r){
			$jaminan[] = $r;
		}
		$countjaminan = count($jaminan);

		$sqlkemasan = "select * from ".getdbtpb($this).".tpb_kemasan where ID_HEADER = '$id'";
		$reskemasan = $this->db->query($sqlkemasan);
		$kemasan = array();
		foreach ($reskemasan->result() as $r){
			$kemasan[] = $r;
		}
		$countkemasan = count($kemasan);

		$sqlkontainer = "select * from ".getdbtpb($this).".tpb_kontainer where ID_HEADER = '$id'";
		$reskontainer = $this->db->query($sqlkontainer);
		$kontainer = array();
		foreach ($reskontainer->result() as $r){
			$kontainer[] = $r;
		}
		$countkontainer = count($kontainer);

		$sqlpungutan = "select * from ".getdbtpb($this).".tpb_pungutan where ID_HEADER = '$id'";
		$respungutan = $this->db->query($sqlpungutan);
		$pungutan = array();
		foreach ($respungutan->result() as $r){
			$pungutan[] = $r;
		}
		$countpungutan = count($pungutan);
		unset($header->ID);
		$dbtpb->insert('tpb_header',$header);
		$id_header = $dbtpb->insert_id();

		if ($countbahan_baku>0) {
			foreach ($bahan_baku as $row) {
				$row->ID_HEADER = $id_header;
				$dbtpb->insert('tpb_bahan_baku',$row);
			}
		}

		if ($countbahan_baku_dokumen>0) {
			foreach ($bahan_baku_dokumen as $row) {
				$row->ID_HEADER = $id_header;
				$dbtpb->insert('tpb_bahan_baku_dokumen',$row);
			}
		}

		if ($countbahan_baku_tarif>0) {
			foreach ($bahan_baku_tarif as $row) {
				$row->ID_HEADER = $id_header;
				$dbtpb->insert('tpb_bahan_baku_tarif',$row);
			}
		}

		if ($countbarang>0) {
			foreach ($barang as $row) {
				unset($row->ID);
				$row->ID_HEADER = $id_header;
				$dbtpb->insert('tpb_barang',$row);
				$id_barang = $dbtpb->insert_id();
				if ($countbarang_tarif>0) {
					foreach ($barang_tarif as $row) {
						unset($row->ID);
		
						$row->ID_HEADER = $id_header;
						$row->ID_BARANG= $id_barang;
						$dbtpb->insert('tpb_barang_tarif',$row);
						// $id_barang_tarif =
					}
				}

				if ($countbarang_dokumen>0) {
					foreach ($barang_dokumen as $row) {
						unset($row->ID);
						$row->ID_BARANG= $id_barang;
						$row->ID_HEADER = $id_header;
						$dbtpb->insert('tpb_barang_dokumen',$row);
					}
				}
			}
		}

		// if ($countbarang_dokumen>0) {
		// 	foreach ($barang_dokumen as $row) {
		// 		unset($row->ID);
		// 		$row->ID_HEADER = $id_header;
		// 		$dbtpb->insert('tpb_barang_dokumen',$row);
		// 	}
		// }

		if ($countbarang_penerima>0) {
			foreach ($barang_penerima as $row) {
				$row->ID_HEADER = $id_header;
				$dbtpb->insert('tpb_barang_penerima',$row);
			}
		}
		$id_barang_tarif=0;
		// if ($countbarang_tarif>0) {
		// 	foreach ($barang_tarif as $row) {
		// 		unset($row->ID);

		// 		$row->ID_HEADER = $id_header;
		// 		$dbtpb->insert('tpb_barang_tarif',$row);
		// 		// $id_barang_tarif =
		// 	}
		// }

		if ($countdokumen>0) {
			foreach ($dokumen as $row) {
				unset($row->ID);
				$row->ID_HEADER = $id_header;
				$dbtpb->insert('tpb_dokumen',$row);
			}
		}

		if ($countjaminan>0) {
			foreach ($jaminan as $row) {
				unset($row->ID);
				$row->ID_HEADER = $id_header;
				$dbtpb->insert('tpb_jaminan',$row);
			}
		}

		if ($countkemasan>0) {
			foreach ($kemasan as $row) {
				unset($row->ID);
				$row->ID_HEADER = $id_header;
				$dbtpb->insert('tpb_kemasan',$row);
			}
		}

		if ($countkontainer>0) {
			foreach ($kontainer as $row) {
				unset($row->ID);
				$row->ID_HEADER = $id_header;
				$dbtpb->insert('tpb_kontainer',$row);
			}
		}

		if ($countpungutan>0) {
			foreach ($pungutan as $row) {
				unset($row->ID);
				$row->ID_HEADER = $id_header;
				$dbtpb->insert('tpb_pungutan',$row);
			}
		}

	}

	function approval2($id)
	{
		$b = new stdClass();
		$b->FLAG_APPROVAL2 = 1;
		$b->DATE_APPROVAL2 = $this->nowdt;
		$this->db->where('ID_HEADER', $id);
		$this->db->update($this->table, $b);
	}

	function getresponse($id)
	{
		$config['hostname'] = '103.82.240.141';
        $config['username'] = 'itone';
        $config['password'] = 'itlinasone';
        $config['database'] = 'tpbdb';
        $config['dbdriver'] = "mysqli";
        $config['dbprefix'] = "";
        $config['pconnect'] = FALSE;
        $config['db_debug'] = (ENVIRONMENT !== 'production');
        $config['cache_on'] = FALSE;
        $config['cachedir'] = "";
        $config['char_set'] = "utf8";
        $config['dbcollat'] = "utf8_general_ci";
        $config['swap_pre'] = '';
        $config['encrypt'] = FALSE;
        $config['compress'] = FALSE;
        $config['stricton'] = FALSE;
        $config['failover'] = array();
        $config['save_queries'] = TRUE;

        $dbtpb = $this->load->database($config, TRUE);
		
		$sqlheader = "select NOMOR_DAFTAR from tpb_header where ID = '$id'";
		$resheader = $dbtpb->query($sqlheader);
		$header = $resheader->row();

		if (($header->NOMOR_DAFTAR == '' || $header->NOMOR_DAFTAR == null)) {
			return false;
		} else {
			$sqldetil_status = "select * from tpb_detil_status where ID_HEADER = '$id'";
			$resdetil_status = $dbtpb->query($sqldetil_status);
			$detil_status = array();
			foreach ($resdetil_status->result() as $r){
				$detil_status[] = $r;
			}
			$countdetil_status = count($detil_status);

			$sqlrespon = "select * from tpb_respon where ID_HEADER = '$id'";
			$resrespon = $dbtpb->query($sqlrespon);
			$respon = array();
			foreach ($resrespon->result() as $r){
				$respon[] = $r;
			}
			$countrespon = count($respon);

			$this->db->where('ID', $id);
			$this->db->update(getdbtpb($this).'.tpb_header', $header);

			if ($countdetil_status>0) {
				foreach ($detil_status as $row) {
					$this->db->where('ID_HEADER', $id);
					$this->db->update(getdbtpb($this).'.tpb_detil_status', $row);
				}
			}

			if ($countrespon>0) {
				foreach ($respon as $row) {
					$this->db->where('ID_HEADER', $id);
					$this->db->update(getdbtpb($this).'.tpb_respon', $row);
				}
			}

			return true;
		}
	}

	function getresponseall()
	{
		$config['hostname'] = '103.82.240.141';
        $config['username'] = 'itone';
        $config['password'] = 'itlinasone';
        $config['database'] = 'tpbdb';
        $config['dbdriver'] = "mysqli";
        $config['dbprefix'] = "";
        $config['pconnect'] = FALSE;
        $config['db_debug'] = (ENVIRONMENT !== 'production');
        $config['cache_on'] = FALSE;
        $config['cachedir'] = "";
        $config['char_set'] = "utf8";
        $config['dbcollat'] = "utf8_general_ci";
        $config['swap_pre'] = '';
        $config['encrypt'] = FALSE;
        $config['compress'] = FALSE;
        $config['stricton'] = FALSE;
        $config['failover'] = array();
        $config['save_queries'] = TRUE;

        $dbtpb = $this->load->database($config, TRUE);
		
		$sqlheader = "select NOMOR_DAFTAR from tpb_header where ID = '$id'";
		$resheader = $dbtpb->query($sqlheader);
		$header = $resheader->result();

		if (($header->NOMOR_DAFTAR == '' || $header->NOMOR_DAFTAR == null)) {
			return false;
		} else {
			$sqldetil_status = "select * from tpb_detil_status where ID_HEADER = '$id'";
			$resdetil_status = $dbtpb->query($sqldetil_status);
			$detil_status = array();
			foreach ($resdetil_status->result() as $r){
				$detil_status[] = $r;
			}
			$countdetil_status = count($detil_status);

			$sqlrespon = "select * from tpb_respon where ID_HEADER = '$id'";
			$resrespon = $dbtpb->query($sqlrespon);
			$respon = array();
			foreach ($resrespon->result() as $r){
				$respon[] = $r;
			}
			$countrespon = count($respon);

			$this->db->where('ID', $id);
			$this->db->update(getdbtpb($this).'.tpb_header', $header);

			if ($countdetil_status>0) {
				foreach ($detil_status as $row) {
					$this->db->where('ID_HEADER', $id);
					$this->db->update(getdbtpb($this).'.tpb_detil_status', $row);
				}
			}

			if ($countrespon>0) {
				foreach ($respon as $row) {
					$this->db->where('ID_HEADER', $id);
					$this->db->update(getdbtpb($this).'.tpb_respon', $row);
				}
			}

			return true;
		}
	}

}