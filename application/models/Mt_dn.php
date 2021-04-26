<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_dn extends CI_Model
{
	var $table = 't_dn';
	var $table_id = 'id_dn';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
			$this->basesql = "select th.ID_PENERIMA_BARANG, th.KODE_DOKUMEN_PABEAN, th.NOMOR_DAFTAR, th.NOMOR_AJU, CAST(th.TANGGAL_AJU AS DATE) AS TANGGAL_AJU, ta.*, tb.id_customer, tb.kode_customer, tb.nama nama_supplier, tc.KODE_JENIS_KENDARAAN kode_jenis_kendaraan, tc.URAIAN_JENIS_KENDARAAN uraian_jenis_kendaraan, td.nama_fasilitas, ifnull(te.qty_dn, 0) qty_dn, ifnull(te.harga, 0) harga, ifnull(te.amount, 0) amount, ifnull(te.detail_count, 0) as detail_count, tw.kode_mutasi, tw.tanggal_terima from t_dn ta left join m_customer_suplier tb on tb.id_customer = ta.id_supplier left join smartone_tpb_dps1.referensi_jenis_kendaraan tc on tc.ID = ta.id_jenis_kendaraan left join m_fasilitas td on td.id_fasilitas = ta.id_fasilitas left join (select id_dn, sum(qty_dn) as qty_dn, sum(harga) as harga, sum(qty_dn * harga) as amount, count(*) as detail_count from t_detail_dn group by id_dn) te on te.id_dn = ta.id_dn left join t_wh tw on ta.id_dn=tw.id_dn left join smartone_tpb_dps1.tpb_header th on th.ID = ta.ID_HEADER where ta.deleted_at is null";
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
		$sql = "select * from ($sqlmain) pa order by tgl_kedatangan desc ";
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		// $sql .= dtSort($in);
		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;

				$st_checked = '';

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
					$r->option .= "<a href='".base_url('procurement/delivery_note_po/print/'.$r->id_dn)."' class='btn btn-xs btn-default'><i class='fal fa-print'></i></a>";
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

	function viewReceiveDT($in)
	{
		$start = $in->start;
		$sqlmain = "select ta.*, tb.NAMA nama_supplier, tc.KODE_JENIS_KENDARAAN kode_jenis_kendaraan, tc.URAIAN_JENIS_KENDARAAN uraian_jenis_kendaraan, td.nama_fasilitas, tf.NOMOR_AJU nomor_aju, IFNULL(tf.TANGGAL_AJU, STR_TO_DATE(SUBSTR(tf.NOMOR_AJU, 13, 8), '%Y%m%d')) tanggal_aju, tf.NOMOR_DAFTAR nomor_daftar, tf.TANGGAL_DAFTAR tanggal_daftar from t_dn ta left join m_customer_suplier tb on tb.id_customer = ta.id_supplier left join smartone_tpb_dps1.referensi_jenis_kendaraan tc on tc.ID = ta.id_jenis_kendaraan left join m_fasilitas td on td.id_fasilitas = ta.id_fasilitas left join (select * from smartone_tpb_dps1.tpb_header ) tf on tf.ID = ta.ID_HEADER where ta.deleted_at is null and ta.is_closed = '0' AND ((ta.id_fasilitas = '1') or (ta.id_fasilitas = '0' )) AND tf.NOMOR_DAFTAR is not null group by id_dn";
		//printJSON($sqlmain);
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

	function viewReturnDT($in)
	{
		$start = $in->start;
			$sqlmain = "select ta.*, tb.nama nama_supplier from t_dn ta LEFT JOIN m_suplier tb on ta.id_supplier = tb.id_suplier";
		//printJSON($sqlmain);
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

	function viewDocInDT($in)
	{
		$start = $in->start;
		$sqlmain = "select ta.*,SUM(tbb.netto ) as netto, tb.nama nama_supplier, tc.KODE_JENIS_KENDARAAN kode_jenis_kendaraan, tc.URAIAN_JENIS_KENDARAAN uraian_jenis_kendaraan, td.nama_fasilitas, tf.NOMOR_AJU nomor_aju, IFNULL(tf.TANGGAL_AJU, STR_TO_DATE(SUBSTR(tf.NOMOR_AJU, 13, 8), '%Y%m%d')) tanggal_aju, tf.NOMOR_DAFTAR nomor_daftar, tf.TANGGAL_DAFTAR tanggal_daftar, tg.jumlah_barang from (SELECT * FROM t_dn WHERE flag_docin IS NULL ) ta left join m_customer_suplier tb on tb.id_customer = ta.id_supplier left join ".getdbtpb($this).".referensi_jenis_kendaraan tc on tc.ID = ta.id_jenis_kendaraan left join m_fasilitas td on td.id_fasilitas = ta.id_fasilitas left join ".getdbtpb($this).".tpb_header tf on tf.ID = ta.ID_HEADER left join (select id_dn,id_sub_barang, count(id_detail_dn) as jumlah_barang from t_detail_dn group by id_dn) tg on ta.id_dn = tg.id_dn left join v_sub_barang tf on tg.id_sub_barang = tf.id_sub_barang left join smartone_tpb_dps1.tpb_barang  tbb on tbb.URAIAN = tf.nama_barang where ta.deleted_at is null and ta.is_closed = '0'  AND ta.flag_docin is null group by id_dn";

		// where ta.deleted_at is null and ta.is_closed = '0' AND ta.id_fasilitas = '0' AND ta.flag_docin is null group by id_dn
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

		// $sql .= dtSort($in);
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

	function viewJurnalDT($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = $this->basesql;
		// if (isset($in->supplier)) {
		// 	if($in->supplier == 'ALL'){
		// 		$sqlmain .= " and ta.id_supplier = '$in->supplier' ";
		// 	}
		// }
		// if (isset($in->start_date)) {
		// 	$sqlmain .= ' and ta.tgl_kedatangan >= "'.reverseDate($in->start_date).'" ';
		// }
		// if (isset($in->end_date)) {
		// 	$sqlmain .= ' and ta.tgl_kedatangan <= "'.reverseDate($in->end_date).'" ';
		// }
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
				// printJSON($r);
				// $r->no = $i;

                $rate = $this->getRate($r->id_dn);
                $akun = $this->getAkun($r->id_suplier);
                $detail = $this->getDetail($r->id_dn);

				// $r->checklist = '<input type="checkbox" name="id_dn[]" class="check" value="">';
				$r->no_invoice = '<input type="text" class="form-control no_invoice" name="no_invoice[]" value="'.$r->no_invoice.'">';
				$r->tgl_invoice = '<input type="text" class="form-control tgl_invoice" name="tgl_invoice[]" value="'.$r->tgl_invoice.'">';
				$r->kode_mutasi = $r->kode_mutasi;
				$r->nama_supplier = $r->nama_supplier;
				$r->akun_debet = $akun->nama_akun_um;
				$r->akun_credit = $akun->nama_akun_utang;

                $arr = array();

				foreach($detail as $key => $item)
				{
					if(!array_key_exists($item['id_dn'],$arr)){
						// Add new data in array with id_dn as an index
						$arr[$item['id_dn']][$item['id_dn']]['id_dn'] = $item['id_dn'];
						$arr[$item['id_dn']][$item['id_dn']]['nama_barang'] = $item['nama_barang'];
						$arr[$item['id_dn']][$item['id_dn']]['kode_barang'] = $item['kode_barang'];
						$arr[$item['id_dn']][$item['id_dn']]['uraian_satuan_terkecil'] = $item['uraian_satuan_terkecil'];
						$arr[$item['id_dn']][$item['id_dn']]['qty_dn'] = $item['qty_dn'];
						$arr[$item['id_dn']][$item['id_dn']]['harga'] = $item['harga'];
						$arr[$item['id_dn']][$item['id_dn']]['amount'] = intval($item['harga']) * intval($item['qty_dn']);
					}else{
						// Only alter category index
						$arr[$item['id_dn']][$item['id_dn']]['nama_barang'] .= ",".$item['nama_barang'];
						$arr[$item['id_dn']][$item['id_dn']]['kode_barang'] .= ",".$item['kode_barang'];
						$arr[$item['id_dn']][$item['id_dn']]['uraian_satuan_terkecil'] .= ",".$item['uraian_satuan_terkecil'];
						$arr[$item['id_dn']][$item['id_dn']]['qty_dn'] .= ",".$item['qty_dn'];
						$arr[$item['id_dn']][$item['id_dn']]['harga'] .= ",".$item['harga'];
						$arr[$item['id_dn']][$item['id_dn']]['amount'] .= ",".intval($item['harga']) * intval($item['qty_dn']);
					}
				}

				ksort($arr, SORT_NUMERIC);

				foreach($arr as $key => $item){
				    $xpl = explode(",", $item[$key]['nama_barang']);
				    $n_category = "";
				    foreach($xpl as $b => $a){
				        $n_category .= ($b!=0) ? "<br>".$a : $a ;
				    }
				    $xpl_kode = explode(",", $item[$key]['kode_barang']);
				    $n_kode = "";
				    foreach($xpl_kode as $k => $o){
				        $n_kode .= ($k!=0) ? "<br>".$o : $o ;
				    }
				    $xpl_satuan = explode(",", $item[$key]['uraian_satuan_terkecil']);
				    $n_satuan = "";
				    foreach($xpl_satuan as $s => $a){
				        $n_satuan .= ($s!=0) ? "<br>".$a : $a ;
				    }
				    $xpl_qty = explode(",", $item[$key]['qty_dn']);
				    $n_qty = "";
				    foreach($xpl_qty as $q => $t){
				        $n_qty .= ($q!=0) ? "<br>".$t : $t ;
				    }
				    $xpl_harga = explode(",", $item[$key]['harga']);
				    $n_harga = "";
				    foreach($xpl_harga as $h => $r){
				        $n_harga .= ($h!=0) ? "<br>".$r : $r ;
				    }
				    $xpl_amount = explode(",", $item[$key]['amount']);
				    $n_amount = "";
				    foreach($xpl_amount as $a => $m){
				        $n_amount .= ($a!=0) ? "<br>".$m : $m ;
				    }
				}

				// $r->nama_barang = $n_category;
				// $r->kode_barang = $n_kode;
				// $r->satuan = $n_satuan;
				// $r->qty = $n_qty;
				// $r->harga = $n_harga;
				// $r->amount = $n_amount;
				
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
		if($in->supplier == 'ALL'){
			if($in->type == 'import'){
				$sql = $this->basesql." AND th.KODE_DOKUMEN_PABEAN = '23' AND (ta.tgl_kedatangan BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') and ta.is_posting != 1";
			}else{
				$sql = $this->basesql." AND th.KODE_DOKUMEN_PABEAN IN ('40', '27') AND (ta.tgl_kedatangan BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') and ta.is_posting != 1";
			}
		}else {
			if($in->type == 'import'){
				$sql = $this->basesql." AND th.KODE_DOKUMEN_PABEAN = '23' AND ta.id_supplier = '".$in->supplier."' AND (ta.tgl_kedatangan BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') and ta.is_posting != 1";
			}else{
				$sql = $this->basesql." AND th.KODE_DOKUMEN_PABEAN IN ('40', '27') AND ta.id_supplier = '".$in->supplier."' AND (ta.tgl_kedatangan BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') and ta.is_posting != 1";
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
		if($in->supplier == 'ALL'){
			$sql = $this->basesql." AND ta.date_approval_2 IS NOT NULL AND (ta.tgl_kedatangan BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') and ta.is_posting != 1";
		}else{
			$sql = $this->basesql." AND ta.date_approval_2 IS NOT NULL AND ta.id_supplier = '".$in->supplier."' AND (ta.tgl_kedatangan BETWEEN '".reverseDate($in->tgl1)."' AND '".reverseDate($in->tgl2)."') and ta.is_posting != 1";
		}
		$res = $this->db->query($sql);
		$result = $res->result();
		return $result;
	}

	function getRate($id)
	{
		$sql = "select distinct tpo.rate, tpo.id_valuta, tv.KODE_VALUTA from t_dn tdn inner join t_detail_dn tdnd on tdn.id_dn = tdnd.id_dn left join t_detail_po tdpo on tdnd.id_detail_po = tdpo.id_detail_po inner join t_po tpo on tdpo.id_po = tpo.id_po left join smartone_tpb_dps1.referensi_valuta tv on tpo.id_valuta=tv.ID where tdn.id_dn = '$id'";
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
		// $sql = "select td.id_dn, td.harga, td.qty_dn, td.id_sub_barang, tv.nama_barang, tv.kode_barang, tv.kode_satuan_terkecil from t_detail_dn td left join v_sub_barang tv on td.id_sub_barang=tv.id_sub_barang where td.id_dn = '$id'";
		$sql = "select td.id_dn, td.id_sub_barang, td.qty_dn, td.harga, ifnull(td.qty_dn * td.harga, 0) as amount, tv.nama_barang, tv.kode_barang, tv.kode_satuan_terkecil, tc.id_akun, tx.kode_akun, tc.id_akun_lawan, tx.nama_akun, ty.kode_akun as kode_akun_lawan, ty.nama_akun as nama_akun_lawan from t_detail_dn td left join v_sub_barang tv on td.id_sub_barang=tv.id_sub_barang left join m_class tc on tv.id_class=tc.id_class left join m_akun tx on tc.id_akun=tx.id_akun left join m_akun ty on tc.id_akun_lawan=ty.id_akun where td.id_dn = '$id'";
		$res = $this->db->query($sql);
		$row = $res->result_array();
		return $row;
	}

	function getBarang($id)
	{
		$sql = "select * from v_sub_barang where id_sub_barang = '$id'";
		$res = $this->db->query($sql);
		$row = $res->result();
		return $row;
	}

	function get($id)
	{
		$sql = $this->basesql." and ta.id_dn = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function create($in)
	{
		$in->kode_dn = $this->generateCode($in->tgl_kedatangan);
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

	function setFlagDocIn($id,$idheader)
	{
		$b = new stdClass();
		$b->flag_docin = 1;
		$b->ID_HEADER = $idheader;
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table, $b);
	}

	function generateCode($tgl_kedatangan)
	{
		$month = date('m', strtotime($tgl_kedatangan));
		$year = date('Y', strtotime($tgl_kedatangan));
		$res = $this->db->query("select kode_dn from $this->table where tgl_kedatangan >= '".date('Y-m-01', strtotime($tgl_kedatangan))."' and tgl_kedatangan <= '".date('Y-m-t', strtotime($tgl_kedatangan))."' and deleted_at is null order by kode_dn desc limit 1");
		$num = $res->num_rows();
		$latest_number = 1;
		if ($num > 0) {
			$index_number = '0000';
			foreach ($res->result() as $r){
				$arrnumber = explode('/', $r->kode_dn);
				$index_number = $arrnumber[0];
			}
			$latest_number = intval($index_number);
			$latest_number++;
		}

		$app_setting = getAppSetting($this);
		return str_pad($latest_number, 4, '0', STR_PAD_LEFT)."/RN-".$app_setting->kode_sbu."/".integerToRoman($month)."/".$year;
	}
}
