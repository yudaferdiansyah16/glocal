<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mtpb_barang extends CI_Model
{
	var $nowdt, $nowd, $nowt, $basesql, $table, $table_id;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->table = getdbtpb($this).'.tpb_barang';
		$this->table_id = 'ID';
		$this->basesql = "select ta.* from $this->table";
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

	function getDetailBarang( $id)
	{
		$sql = "select ta.*,tb.*,tc.* from
		 (select * from  ".getdbtpb($this).".tpb_barang where ID_HEADER = '$id') ta 
		 inner join  smartone_tpb_dps1.referensi_status tb on ta.KODE_STATUS = tb.KODE_STATUS inner join smartone_tpb_dps1.referensi_kode_guna tc on ta.KODE_GUNA = tc.KODE_GUNA";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function getDetailBarangg($id,$in, $opt = true)
	{
		$sql = "select ta.* from
		 (select * from  ".getdbtpb($this).".tpb_barang where ID_HEADER = '$id') ta ";

		//  inner join  smartone_tpb_dps1.referensi_status tb on ta.KODE_STATUS = tb.KODE_STATUS inner join smartone_tpb_dps1.referensi_kode_guna tc on ta.KODE_GUNA = tc.KODE_GUNA

		// printJSON($sql);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=0+1;
			foreach ($res->result() as $r){
				$r->no = $i;
				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->data = $data;
		return $k;
	}

	function viewReportCustomsDT($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = "SELECT ta.KODE_BARANG, ta.URAIAN, ta.KODE_SATUAN, ta.HARGA_INVOICE, ta.CIF_RUPIAH, ta.ID_HEADER, tb.KODE_DOKUMEN_PABEAN, td.URAIAN_DOKUMEN_PABEAN, td.STATUS AS STATUS_DOKUMEN_PABEAN, tb.NOMOR_AJU, tb.TANGGAL_AJU, tb.NOMOR_DAFTAR, tb.TANGGAL_DAFTAR, tb.NAMA_PEMASOK, tb.KODE_NEGARA_PEMASOK, tc.URAIAN_NEGARA AS URAIAN_NEGARA_PEMASOK, tb.KODE_VALUTA, te.URAIAN_VALUTA FROM ".getdbtpb($this).".tpb_barang ta left JOIN ".getdbtpb($this).".tpb_header tb ON tb.ID = ta.ID_HEADER LEFT JOIN ".getdbtpb($this).".referensi_negara tc ON tc.KODE_NEGARA = tb.KODE_NEGARA_PEMASOK LEFT JOIN ".getdbtpb($this).".referensi_dokumen_pabean td ON td.KODE_DOKUMEN_PABEAN = tb.KODE_DOKUMEN_PABEAN LEFT JOIN ".getdbtpb($this).".referensi_valuta te ON te.KODE_VALUTA = tb.KODE_VALUTA";
		if (isset($in->STATUS_DOKUMEN_PABEAN)) {
			$sqlmain .= " AND td.STATUS = '".$in->STATUS_DOKUMEN_PABEAN."' ";
		}
		if (isset($in->KODE_DOKUMEN_PABEAN)) {
			$sqlmain .= " AND tb.KODE_DOKUMEN_PABEAN = '".$in->KODE_DOKUMEN_PABEAN."' ";
		}
		if (isset($in->TANGGAL_AJU_START)) {
			$sqlmain .= " AND tb.TANGGAL_AJU >= '".$in->TANGGAL_AJU_START."' ";
		}
		if (isset($in->TANGGAL_AJU_END)) {
			$sqlmain .= " AND tb.TANGGAL_AJU <= '".$in->TANGGAL_AJU_END."' ";
		}
		if (isset($in->TANGGAL_DAFTAR_START)) {
			$sqlmain .= " AND tb.TANGGAL_DAFTAR >= '".$in->TTANGGAL_DAFTAR_START."' ";
		}
		if (isset($in->TANGGAL_DAFTAR_END)) {
			$sqlmain .= " AND tb.TANGGAL_DAFTAR <= '".$in->TANGGAL_DAFTAR_END."' ";
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
	
	function viewCustomsIn($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = "select td.kode_dn, td.tgl_kedatangan, ta.*, tb.detail, tc.URAIAN_DOKUMEN_PABEAN from (select *, (case when NAMA_PEMASOK is null then NAMA_PENGIRIM else NAMA_PEMASOK end) as supplier from ".getdbtpb($this).".tpb_header where KODE_DOKUMEN_PABEAN = '23' or KODE_DOKUMEN_PABEAN = '262' or KODE_DOKUMEN_PABEAN = '40' or KODE_DOKUMEN_PABEAN = '27IN') ta left join (select json_arrayagg(json_object('SERI_BARANG',SERI_BARANG,'KODE_BARANG',KODE_BARANG,'URAIAN',URAIAN,'KODE_SATUAN',KODE_SATUAN,'JUMLAH_SATUAN',JUMLAH_SATUAN,'hargarp',(case when CIF is null then HARGA_PENYERAHAN else CIF_RUPIAH end),'hargaasli',(case when CIF is null then '' else CIF end),'ID_HEADER',ID_HEADER)) as detail, ID_HEADER from ".getdbtpb($this).".tpb_barang group by ID_HEADER) tb on ta.ID = tb.ID_HEADER left join ".getdbtpb($this).".referensi_dokumen_pabean tc on ta.KODE_DOKUMEN_PABEAN = tc.KODE_DOKUMEN_PABEAN left join t_dn td on ta.ID = td.ID_HEADER left join tpb_approval tx on ta.ID = tx.ID_HEADER";
		$sqlmain = "select * from ($sqlmain) pa where ID is not null";
		if (isset($in->dokumenbc)) {
			$i =1;
			$sqlmain .= ' and (';
			foreach ($in->dokumenbc as $row) {
				if ($i==1) {
					$sqlmain .= " KODE_DOKUMEN_PABEAN = '".$row."' ";
				} else {
					$sqlmain .= " OR KODE_DOKUMEN_PABEAN = '".$row."' ";
				}
				$i++;
			}
			$sqlmain .= ' ) ';
		}
		
		$sqlmain = "select * from ($sqlmain) pa where ID is not null";
		
		if (isset($in->tglajuawal)) {
			$tglajuawal = reverseDate($in->tglajuawal);
			$sqlmain .= " and TANGGAL_AJU >= '$tglajuawal'";
		}
		if (isset($in->tglajuakhir)) {
			$tglajuakhir = reverseDate($in->tglajuakhir);
			$sqlmain .= " and TANGGAL_AJU <= '$tglajuakhir'";
		}
		if (isset($in->tglrecieveawal)) {
			$tgl = reverseDate($in->tglrecieveawal);
			$sqlmain .= " and tgl_kedatangan >= '".$tgl."' ";
		}
		if (isset($in->tglrecieveakhir)) {
			$tgl = reverseDate($in->tglrecieveakhir);
			$sqlmain .= " and tgl_kedatangan <= '".$tgl."' ";
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
				
				$r->detail = a2o(json_decode(sterilizeJSON($r->detail)));
				$item = '';
				$qty = '';
				$hargarp = '';
				$hargaasli = '';
				foreach ($r->detail as $row) {
					$item .= "<p style='margin:0;padding:0;'>".$row->URAIAN."</p><small style='margin:0;padding:0;'>".$row->KODE_BARANG."</small><br><br>";
					$qty .= "<p style='margin:0;padding:0;'>".number_format($row->JUMLAH_SATUAN,3)."</p><small style='margin:0;padding:0;'>".$row->KODE_SATUAN."</small><br><br>";
					$hargarp .= "<p style='margin:0;padding:0;'>".number_format(floatval($row->hargarp),2)."</p><small style='margin:0;padding:0;'>&nbsp;</small><br><br>";
					$hargaasli .= "<p style='margin:0;padding:0;'>".number_format(floatval($row->hargaasli),2)."</p><small style='margin:0;padding:0;'>&nbsp;</small><br><br>";
				}
				$r->URAIAN = $item;
				$r->JUMLAH_SATUAN = $qty;
				$r->hargarp = $hargarp;
				$r->hargaasli = $hargaasli;
				
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
	
	function viewCustomsOut($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = "select td.NOMOR_DOKUMEN as kode_dokumen, td.TANGGAL_DOKUMEN as tgl_dokumen, ta.NOMOR_AJU, ta.TANGGAL_AJU, ta.NOMOR_DAFTAR, ta.TANGGAL_DAFTAR, ta.NAMA_PENERIMA_BARANG, 'ID' KODE_BENDERA, ta.ID, ta.KODE_DOKUMEN_PABEAN, tb.detail, tc.URAIAN_DOKUMEN_PABEAN from (select * from smartone_tpb_dps1.tpb_header where KODE_DOKUMEN_PABEAN = '25' or KODE_DOKUMEN_PABEAN = '261' or KODE_DOKUMEN_PABEAN = '41' or KODE_DOKUMEN_PABEAN = '27') ta left join (select json_arrayagg(json_object('SERI_BARANG',SERI_BARANG,'KODE_BARANG',KODE_BARANG,'URAIAN',URAIAN,'KODE_SATUAN',KODE_SATUAN,'JUMLAH_SATUAN',JUMLAH_SATUAN,'hargarp',(case when CIF is null then HARGA_PENYERAHAN else CIF_RUPIAH end),'hargaasli',(case when CIF is null then '' else CIF end),'ID_HEADER',ID_HEADER)) as detail, ID_HEADER from smartone_tpb_dps1.tpb_barang group by ID_HEADER) tb on ta.ID = tb.ID_HEADER left join smartone_tpb_dps1.referensi_dokumen_pabean tc on ta.KODE_DOKUMEN_PABEAN = tc.KODE_DOKUMEN_PABEAN left join (select * from smartone_tpb_dps1.tpb_dokumen where KODE_JENIS_DOKUMEN = '999' and NOMOR_DOKUMEN like '%SID%' group by ID_HEADER) td on ta.ID = td.ID_HEADER left join tpb_approval tx on ta.ID = tx.ID_HEADER UNION SELECT tb.NoDok NOMOR_DOKUMEN, tb.TgDok TANGGAL_DOKUMEN, ta.CAR NOMOR_AJU, ta.TGEKS TANGGAL_AJU, ta.NODAFT NOMOR_DAFTAR, ta.TGDAFT TANGGAL_DAFTAR, ta.NAMABELI2 NAMA_PENERIMA_BARANG, ta.NEGBELI2 KODE_BENDERA, ta.CAR ID, '30' as KODE_DOKUMEN_PABEAN, tc.detail,'BC 3.0' as URAIAN_DOKUMEN_PABEAN FROM smartone_peb.tblpebhdr ta left join (select * from smartone_peb.tblpebdok where KdDok = '217') tb on ta.CAR = tb.CAR left join (SELECT CAR, JSON_ARRAYAGG(JSON_OBJECT('SERI_BARANG',SERIBRG,'KODE_BARANG',KDBRG,'URAIAN',CONCAT(URBRG1,' - ',URBRG2,' - ',URBRG3,' - ',URBRG4),'KODE_SATUAN',JNSATUAN,'JUMLAH_SATUAN',JMSATUAN,'hargarp',DNilInv,'hargaasli',FOBPERBRG)) AS detail FROM smartone_peb.tblpebdtl GROUP BY CAR) tc on ta.CAR = tc.CAR";
		$sqlmain = "select * from ($sqlmain) pa where ID is not null";
		
		
		$sqlmain = "select * from ($sqlmain) pa where ID is not null";
		
		if (isset($in->tglajuawal)) {
			$tglajuawal = reverseDate($in->tglajuawal);
			$sqlmain .= " and TANGGAL_AJU >= '$tglajuawal'";
		}
		if (isset($in->tglajuakhir)) {
			$tglajuakhir = reverseDate($in->tglajuakhir);
			$sqlmain .= " and TANGGAL_AJU <= '$tglajuakhir'";
		}
		if (isset($in->tglstuffingawal)) {
			$tgl = reverseDate($in->tglstuffingawal);
			$sqlmain .= " and tgl_dokumen >= '".$tgl."' ";
		}
		if (isset($in->tglstuffingakhir)) {
			$tgl = reverseDate($in->tglstuffingakhir);
			$sqlmain .= " and tgl_dokumen <= '".$tgl."' ";
		}
		if (isset($in->dokumenbc)) {
			$i =1;
			$sqlmain .= ' and (';
			foreach ($in->dokumenbc as $row) {
				if ($i==1) {
					$sqlmain .= " KODE_DOKUMEN_PABEAN = '".$row."' ";
				} else {
					$sqlmain .= " OR KODE_DOKUMEN_PABEAN = '".$row."' ";
				}
				$i++;
			}
			$sqlmain .= ' ) ';
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
				
				$r->detail = a2o(json_decode(sterilizeJSON($r->detail)));
				$item = '';
				$qty = '';
				$hargarp = '';
				$hargaasli = '';
				foreach ($r->detail as $row) {
					$item .= "<p style='margin:0;padding:0;'>".$row->URAIAN."</p><small style='margin:0;padding:0;'>".$row->KODE_BARANG."</small><br><br>";
					$qty .= "<p style='margin:0;padding:0;'>".number_format($row->JUMLAH_SATUAN,3)."</p><small style='margin:0;padding:0;'>".$row->KODE_SATUAN."</small><br><br>";
					$hargarp .= "<p style='margin:0;padding:0;'>".number_format(floatval($row->hargarp),2)."</p><small style='margin:0;padding:0;'>&nbsp;</small><br><br>";
					$hargaasli .= "<p style='margin:0;padding:0;'>".number_format(floatval($row->hargaasli),2)."</p><small style='margin:0;padding:0;'>&nbsp;</small><br><br>";
				}
				$r->URAIAN = $item;
				$r->JUMLAH_SATUAN = $qty;
				$r->hargarp = $hargarp;
				$r->hargaasli = $hargaasli;
				
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
		$sql = $this->basesql." and $this->table_id = '$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}
	
	function getBarang($id)
	{
		$sql = "select ta.*,tb.*,tc.* from
		 (select * from  ".getdbtpb($this).".tpb_barang where ID_HEADER = '$id') ta 
		 inner join  smartone_tpb_dps1.referensi_status tb on ta.KODE_STATUS = tb.KODE_STATUS inner join smartone_tpb_dps1.referensi_kode_guna tc on ta.KODE_GUNA = tc.KODE_GUNA";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}
	function getBarangDT25($id)
	{
		$sql = "SELECT-- tpr.id_production,
		-- twd.id_production,
		xu.ID_HEADER,
		tb.ID_HEADER,
		xq.SERI_BARANG,
		xq.HARGA_SATUAN,
		xq.SPESIFIKASI_LAIN,
		xq.UKURAN,
		xq.TIPE,
		xq.MERK,
		vb.uraian_satuan_terkecil,
		td.NOMOR_DOKUMEN,
		tds.id_detail_stuffing,
		tds.id_wh_detail,
		twd.id_wh,
		t_wh.id_master,
		xs.ID_HEADER AS idh,
		xq.KODE_BARANG,
		vb.nama_barang,
		xz.* 
		FROM
			smartone_tpb_dps1.tpb_barang tb
			INNER JOIN smartone_tpb_dps1.tpb_header th ON th.ID = tb.ID_HEADER
			INNER JOIN smartone_tpb_dps1.tpb_dokumen td ON td.ID_HEADER = tb.ID_HEADER
			INNER JOIN t_invoice ti ON ti.kode_invoice = td.NOMOR_DOKUMEN
			INNER JOIN t_invoice_detail tid ON tid.id_invoice = ti.id_invoice
			INNER JOIN t_detail_stuffing tds ON tds.id_detail_stuffing = tid.id_detail_stuffing
			INNER JOIN t_wh_detail twd ON twd.id_wh_detail = tds.id_wh_detail
			INNER JOIN t_wh ON t_wh.id_wh = twd.id_wh
			INNER JOIN ( SELECT tw.ID_HEADER, tw.id_wh FROM t_wh_detail tw ) xs ON xs.id_wh = t_wh.id_master
			INNER JOIN (
			SELECT
				tw.ID_HEADER,
				tw.id_wh 
			FROM
				t_wh_detail tw
				INNER JOIN v_sub_barang vb ON vb.id_sub_barang = tw.id_sub_barang 
			WHERE
		
			vb.id_class = 1
			) xu ON xu.ID_HEADER = xs.ID_HEADER
			INNER JOIN t_wh th ON th.id_wh = xu.id_wh
			INNER JOIN ( SELECT tw.ID_HEADER, tw.id_wh FROM t_wh_detail tw ) xs2 ON xs2.id_wh =th.id_wh
		
			INNER JOIN ( SELECT b.* FROM smartone_tpb_dps1.tpb_barang b ) xq ON xq.ID_HEADER = xs2.ID_HEADER
			INNER JOIN ( SELECT * FROM smartone_tpb_dps1.tpb_header ) xz ON xz.ID = xq.ID_HEADER
			INNER JOIN v_sub_barang vb ON vb.KODE_BARANG = xq.KODE_BARANG 
		WHERE
			tb.ID_HEADER = '133' 
			AND td.KODE_JENIS_DOKUMEN = '380' 
			AND xz.KODE_DOKUMEN_PABEAN = '40'
		GROUP BY vb.id_sub_barang";
		$res = $this->db->query($sql);
	
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=0+1;
			foreach ($res->result() as $r){
				$r->no = $i;
				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->data = $data;
		return $k;
	}
	function getBarangDT23($id)
	{
		$sql = "SELECT-- tpr.id_production,
		-- twd.id_production,
		xu.ID_HEADER,
		tb.ID_HEADER,
		xq.SERI_BARANG,
		xq.HARGA_SATUAN,
		xq.SPESIFIKASI_LAIN,
		xq.UKURAN,
		xq.TIPE,
		xq.MERK,
		vb.uraian_satuan_terkecil,
		td.NOMOR_DOKUMEN,
		tds.id_detail_stuffing,
		tds.id_wh_detail,
		twd.id_wh,
		t_wh.id_master,
		xs.ID_HEADER AS idh,
		xq.KODE_BARANG,
		vb.nama_barang,
		xz.* 
		FROM
			smartone_tpb_dps1.tpb_barang tb
			INNER JOIN smartone_tpb_dps1.tpb_header th ON th.ID = tb.ID_HEADER
			INNER JOIN smartone_tpb_dps1.tpb_dokumen td ON td.ID_HEADER = tb.ID_HEADER
			INNER JOIN t_invoice ti ON ti.kode_invoice = td.NOMOR_DOKUMEN
			INNER JOIN t_invoice_detail tid ON tid.id_invoice = ti.id_invoice
			INNER JOIN t_detail_stuffing tds ON tds.id_detail_stuffing = tid.id_detail_stuffing
			INNER JOIN t_wh_detail twd ON twd.id_wh_detail = tds.id_wh_detail
			INNER JOIN t_wh ON t_wh.id_wh = twd.id_wh
			INNER JOIN ( SELECT tw.ID_HEADER, tw.id_wh FROM t_wh_detail tw ) xs ON xs.id_wh = t_wh.id_master
			INNER JOIN (
			SELECT
				tw.ID_HEADER,
				tw.id_wh 
			FROM
				t_wh_detail tw
				INNER JOIN v_sub_barang vb ON vb.id_sub_barang = tw.id_sub_barang 
			WHERE
		
			vb.id_class = 1
			) xu ON xu.ID_HEADER = xs.ID_HEADER
			INNER JOIN t_wh th ON th.id_wh = xu.id_wh
			INNER JOIN ( SELECT tw.ID_HEADER, tw.id_wh FROM t_wh_detail tw ) xs2 ON xs2.id_wh =th.id_wh
		
			INNER JOIN ( SELECT b.* FROM smartone_tpb_dps1.tpb_barang b ) xq ON xq.ID_HEADER = xs2.ID_HEADER
			INNER JOIN ( SELECT * FROM smartone_tpb_dps1.tpb_header ) xz ON xz.ID = xq.ID_HEADER
			INNER JOIN v_sub_barang vb ON vb.KODE_BARANG = xq.KODE_BARANG 
		WHERE
			tb.ID_HEADER = '133' 
			AND td.KODE_JENIS_DOKUMEN = '380' 
				AND xz.KODE_DOKUMEN_PABEAN = '23'
		GROUP BY vb.id_sub_barang";
		$res = $this->db->query($sql);
	
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=0+1;
			foreach ($res->result() as $r){
				$r->no = $i;
				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		$k->data = $data;
		return $k;
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
}
