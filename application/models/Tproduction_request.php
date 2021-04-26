<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Tproduction_request extends CI_Model
{
	var $table = 't_production';
	var $table_id = 'id_production';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "select ta.* from $this->table ta where ta.id_jenis_mutasi = '13' and ta.deleted_at is null ";
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
		$sql = "select * from ($sqlmain) pa order by tanggal_mutasi DESC";
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

				$r->kode_mutasi = "<a href='".base_url('production/request_produksi/print/'.$r->id_production)."'>$r->kode_mutasi</a>";


				$r->status_approve = "";
				if ($r->flag_btl == 1) {
					$r->status_approve = "<button type='button' disabled class='btn btn-danger btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Canceled</button>";
				} else if ($r->flag_closing == 1) {
					$r->status_approve = "<button type='button' disabled class='btn btn-success btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Closed</button>";
				} else {
					if ($r->approval_1 == 0) {
						$r->status_approve = "<button type='button' disabled class='btn btn-default btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-hourglass'></i> Ready</button>";
					}
					if ($r->approval_1 == 1) {
						$r->status_approve = "<button type='button' disabled class='btn btn-success btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved 1</button>";
					}
					if ($r->approval_2 == 1) {
						$r->status_approve = "<button type='button' disabled class='btn btn-primary btn-xs btn-pills waves-effect waves-themed'><i class='fa fal fa-check'></i> Approved 2</button>";
					}
				}

				$r->option='';
				if ($opt){
					if ($r->approval_1 == '0' && $r->approval_2 == '0') {
						$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					}
					$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->{$this->table_id}).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
					if ($r->approval_1 == '0' && $r->approval_2 == '0') {
						$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
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
	function viewDTBod($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = "SELECT
		ta.ID,
		ta.JUMLAH_BARANG,
		tb.ID_HEADER,
		tb.KODE_BARANG,
		vb.nama_barang,
		td.qty_mc,
		tp.id_po,
		ta.TANGGAL_AJU,
		tf.qty_invoice,
		mc.nama,
		ta.NOMOR_AJU,
		ta.NOMOR_DAFTAR,
		tf.harga,
		vb.uraian_satuan_terkecil
	FROM
		smartone_tpb_dps1.tpb_header ta
		INNER JOIN smartone_tpb_dps1.tpb_barang tb ON tb.ID_HEADER = ta.ID
		INNER JOIN v_sub_barang vb ON vb.kode_barang = tb.KODE_BARANG
		INNER JOIN t_po tp INNER JOIN t_detail_po td ON tp.id_po = td.id_po
		INNER JOIN m_customer_suplier mc ON mc.id_customer = tp.id_supplier
		INNER JOIN t_invoice ti INNER JOIN t_invoice_detail tf ON ti.id_invoice = tf.id_invoice
		where (ta.KODE_DOKUMEN_PABEAN = '25' OR ta.KODE_DOKUMEN_PABEAN = '41' OR ta.KODE_DOKUMEN_PABEAN = '27' OR ta.KODE_DOKUMEN_PABEAN = '30') and ta.NOMOR_DAFTAR is not null GROUP BY ta.ID
		";

	if (isset($in->tglawal)) {
			$sqlmain .= " AND ta.tanggal_dibuat >= '".reverseDate($in->tglawal)."' ";
		}

		if (isset($in->tglakhir)) {
			$sqlmain .= " AND ta.tanggal_dibuat <= '".reverseDate($in->tglakhir)."' ";
		}

		if (isset($in->id_supplier)) {
			$sqlmain .= " AND mc.id_customer = '$in->id_supplier'";
			// printJSON($in->id_supplier);
		}

		$sql = "select * from ($sqlmain) pa ";
		// printJSON($sql);
		
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;
				$r->blank = '';
				$r->option='';
				if ($opt){
					// if ($r->approval_1 == '0' && $r->approval_2 == '0') {
					// 	$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					// }
					$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->ID).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
					// if ($r->approval_1 == '0' && $r->approval_2 == '0') {
					// 	$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
					// }
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
	
	function viewDTBom($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = "SELECT
						tp.id_po,
						tp.kode_po,
						tp.tanggal_dibuat,
						tp.tanggal_dibutuhkan,
						tp.po_buyer,
						vb.nama_barang,
						IFNULL(md.alamat,'-') as alamat,
						mc.nama,
						mc.id_customer,
						tdp.qty_po 
					FROM
						t_po tp
						INNER JOIN t_detail_po tdp ON tdp.id_po = tp.id_po
						INNER JOIN m_customer_suplier mc ON mc.id_customer = tp.id_supplier
						INNER JOIN v_sub_barang vb ON vb.id_sub_barang = tdp.id_sub_barang 
						LEFT JOIN m_detail_supplier_destination md ON md.id_supplier = mc.id_customer
					WHERE
						tp.kode_po LIKE '%SO%' 
					";
		if (isset($in->tglawal)) {
			$sqlmain .= " AND tp.tanggal_dibuat >= '".reverseDate($in->tglawal)."' ";
		}

		if (isset($in->tglakhir)) {
			$sqlmain .= " AND tp.tanggal_dibuat <= '".reverseDate($in->tglakhir)."' ";
		}

		if (isset($in->id_supplier)) {
			$sqlmain .= " AND mc.id_customer = '$in->id_supplier'";
			// printJSON($in->id_supplier);
		}

		$sql = "select * from ($sqlmain) pa ORDER BY
		tanggal_dibuat DESC";
		// printJSON($sql);
		
		$res = $this->db->query($sql);
		$recordsTotal = $res->num_rows();

		$sql .= dtSearch($this, $in);
		$res = $this->db->query($sql);
		$recordsFiltered = $res->num_rows();

		$sql .= dtLimit($in);
		$res = $this->db->query($sql);
		$num = $res->num_rows();

		$data = array();
		if($num>0){
			$i=$start+1;
			foreach ($res->result() as $r){
				$r->no = $i;
				$r->blank = '';
				$r->option='';
				if ($opt){
					// if ($r->approval_1 == '0' && $r->approval_2 == '0') {
					// 	$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/edit/'.$r->{$this->table_id}).'" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
					// }
					$r->option .= '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->id_po).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a> ';
					// if ($r->approval_1 == '0' && $r->approval_2 == '0') {
					// 	$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="'.base_url($this->d->_controller.'/'.$this->d->_method.'/delete/'.$r->{$this->table_id}).'" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
					// }
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


	function viewitemDT($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = "select td.rate,tb.uraian_satuan_terbesar uraian_satuan,tb.uraian_satuan_terkecil uraian_satuan_terkecil,tb.unit_konversi,td.id_wh_detail, td.id_wh, tc.ID_HEADER, tc.nomor_aju, tc.nomor_daftar, ta.*, tb.id_sub_barang, tb.kode_barang, tb.nama_barang, tc.id_detail_dn, tc.no_sj, td.seri_barang, (sum(case when td.saldo_mutasi = 'K' then td.qty_wh else 0 end)) - (sum(case when td.saldo_mutasi = 'D' then td.qty_wh else 0 end)) as qty_sisa from (select a1.id_detail_job, a1.id_job, a2.no_job from t_detail_job a1 inner join t_job a2 on a1.id_job = a2.id_job) ta inner join (select a2.uraian_satuan_terbesar,a2.uraian_satuan_terkecil,a2.unit_konversi,a1.id_detail_pp, a1.id_sub_barang, a1.id_detail_job, a2.kode_barang, a2.nama_barang from t_detail_pp a1 inner join v_sub_barang a2 on a1.id_sub_barang = a2.id_sub_barang) tb on ta.id_detail_job = tb.id_detail_job inner join (select a1.id_detail_dn, a1.no_sj, a2.id_detail_po, a2.id_detail_pp, a3.kode_po, a4.ID_HEADER, a5.NOMOR_AJU as nomor_aju, a5.NOMOR_DAFTAR as nomor_daftar from t_detail_dn a1 inner join t_dn a4 on a1.id_dn = a4.id_dn inner join t_detail_po a2 on a1.id_detail_po = a2.id_detail_po inner join t_po a3 on a2.id_po = a3.id_po left join smartone_tpb_dps1.tpb_header a5 on a4.ID_HEADER = a5.ID ) tc on tb.id_detail_pp = tc.id_detail_pp left join (select a1.rate,a2.id_jenis_mutasi, a3.saldo_mutasi, a1.id_wh_detail, a1.id_wh, a1.id_detail_dn, a1.qty as qty_wh, a1.seri_barang, a1.id_sub_barang from t_wh_detail a1 inner join t_wh a2 on a1.id_wh = a2.id_wh inner join m_jenis_mutasi a3 on a2.id_jenis_mutasi = a3.id_jenis_mutasi ) td on tc.id_detail_dn = td.id_detail_dn group by tc.nomor_aju, tb.kode_barang, ta.no_job having qty_sisa > 0";
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

	function viewReporting($in)
	{
		$start = $in->start;
		$sqlmain = "select ta.id_production, ta.kode_mutasi, ta.tanggal_mutasi, tg.kode_barang, tg.nama_barang,ta.qty_req, tb.qty_rlz, tc.qty_rtn, te.NOMOR_AJU, te.NOMOR_DAFTAR, te.TANGGAL_AJU, te.TANGGAL_DAFTAR, tf.kode_dn, tf.tgl_kedatangan from (select xa.id_production, xa.id_detail_dn, xa.id_job, xa.id_master, xa.kode_mutasi, xa.tanggal_mutasi, xa.id_workflow, xa.id_line, xa.id_mesin, xa.kelompok, xa.status, xa.approval_1, xa.approval_2, xa.id_user_approval_1, xa.id_user_approval_2, xa.date_approval_1, xa.date_approval_2, xa.date_closing, xa.id_user_closing, xa.flag_closing, xa.flag_edit, xa.flag_btl, xa.id_user_btl, xa.btl_date, xa.kode_sbu, xa.created_at, xa.updated_at, xa.deleted_at, xa.`return`, xa.id_jenis_mutasi, xa.id_bom, xb.id_production_detail, xb.id_sub_barang, xb.qty as qty_req from t_production xa inner join t_production_detail xb on xa.id_production = xb.id_production where xa.id_jenis_mutasi = '13') ta left join (select xa.id_master, xb.id_sub_barang,sum(ifnull(xb.qty,0)) as qty_rlz from t_production xa inner join t_production_detail xb on xa.id_production = xb.id_production where xa.id_jenis_mutasi = '14' group by xb.id_sub_barang, xa.id_master) tb on (ta.id_production = tb.id_master and ta.id_sub_barang = tb.id_sub_barang) left join (select xa.id_master, xb.id_sub_barang,sum(ifnull(xb.qty,0)) as qty_rtn from t_production xa inner join t_production_detail xb on xa.id_production = xb.id_production where xa.id_jenis_mutasi = '12' group by xb.id_sub_barang, xa.id_master) tc on (ta.id_production = tc.id_master and ta.id_sub_barang = tc.id_sub_barang) left join (select xa.id_wh, xa.id_master as master_wh,xa.kode_mutasi, xa.id_dn, xb.id_header, xb.seri_barang, xb.id_sub_barang from t_wh xa inner join t_wh_detail xb on xa.id_wh = xb.id_wh) td on (ta.kode_mutasi = td.kode_mutasi and ta.id_sub_barang = td.id_sub_barang) left join (select ID, NOMOR_AJU, TANGGAL_AJU, NOMOR_DAFTAR, TANGGAL_DAFTAR from ".getdbtpb($this).".tpb_header) te on td.id_header = te.ID left join (select xa.id_wh as wh_check, xb.kode_dn, xb.tgl_kedatangan from t_wh xa inner join t_dn xb on xa.id_dn = xb.id_dn) tf on td.master_wh = tf.wh_check left join v_sub_barang tg on ta.id_sub_barang = tg.id_sub_barang";
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
			$aju = $daftar = '';
			$temp = '';
			$c = 0;
			foreach ($res->result() as $r){
				if ($temp == $r->kode_mutasi) {
					$c++;
					$temp = $r->kode_mutasi;
				} else {
					$c = 1;
					$temp = $r->kode_mutasi;
				}
				$r->no = $c;
				$r->blank = '';
				$r->mutasi = "<p style='margin: 0;padding: 0'>$r->kode_mutasi</p><small style='margin: 0;padding: 0'>".date('d-m-Y',strtotime($r->tanggal_mutasi))."</small>";
				$r->barang = "<p style='margin: 0;padding: 0'>$r->nama_barang</p><small style='margin: 0;padding: 0'>$r->kode_barang</small>";
				$r->dn = "<p style='margin: 0;padding: 0'>$r->kode_dn</p><small style='margin: 0;padding: 0'>".date('d-m-Y',strtotime($r->tgl_kedatangan))."</small>";
				if ($r->TANGGAL_AJU !=null || $r->TANGGAL_AJU != '') $aju = date('d-m-Y',strtotime($r->TANGGAL_AJU));
				$r->AJU = "<p style='margin: 0;padding: 0'>$r->NOMOR_AJU</p><small style='margin: 0;padding: 0'>".$aju."</small>";
				if ($r->TANGGAL_DAFTAR !=null || $r->TANGGAL_DAFTAR != '') $daftar = date('d-m-Y',strtotime($r->TANGGAL_DAFTAR));
				$r->DAFTAR = "<p style='margin: 0;padding: 0'>$r->NOMOR_DAFTAR</p><small style='margin: 0;padding: 0'>".$daftar."</small>";
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
	function getDetailReportBod($id)
	{
		$sql = "SELECT
		-- tpr.id_production,
		-- twd.id_production,
		xu.ID_HEADER,
		tb.ID_HEADER,
		vbi.nama_barang as fgbarang,
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
		tid.harga,
		tid.qty_invoice,
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
			INNER JOIN ( SELECT tw.ID_HEADER, tw.id_wh FROM t_wh_detail tw ) xs2 ON xs2.id_wh = th.id_wh
			INNER JOIN ( SELECT b.* FROM smartone_tpb_dps1.tpb_barang b ) xq ON xq.ID_HEADER = xs2.ID_HEADER
			INNER JOIN ( SELECT * FROM smartone_tpb_dps1.tpb_header ) xz ON xz.ID = xq.ID_HEADER
			INNER JOIN v_sub_barang vb ON vb.KODE_BARANG = xq.KODE_BARANG 
			INNER JOIN v_sub_barang vbi ON vbi.id_sub_barang = tid.id_sub_barang 
		WHERE
			tb.ID_HEADER = '133' 
			AND td.KODE_JENIS_DOKUMEN = '380' 
		-- 	AND xz.KODE_DOKUMEN_PABEAN = '23' 
		GROUP BY
			vb.id_sub_barang";

			$res = $this->db->query($sql);
			$num = $res->num_rows();
			$recordsTotal = $res->num_rows();
			$data = array();
			if($num>0){
				$i=1;
				foreach ($res->result() as $r){
					$r->no = $i;
					$r->blank = '';
					$data[] = $r;
					$i++;
				}
			}
			$k = new stdClass();
			// $k->recordsTotal = $recordsTotal;
			// $k->recordsFiltered = $recordsFiltered;
			$k->data = $data;
	
			return $k;
	}

	function getDetailReportBom($id)
	{
		$sql = "SELECT
		tp.id_po,
		tp.kode_po,
		tp.tanggal_dibuat,
		tp.tanggal_dibutuhkan,
		tp.po_buyer,
		vb.nama_barang,
		IFNULL(md.alamat,'-') as alamat,
		mc.nama,
		mc.id_customer,
		tdp.qty_po 
	FROM
		t_po tp
		INNER JOIN t_detail_po tdp ON tdp.id_po = tp.id_po
		INNER JOIN m_customer_suplier mc ON mc.id_customer = tp.id_supplier
		INNER JOIN v_sub_barang vb ON vb.id_sub_barang = tdp.id_sub_barang 
		LEFT JOIN m_detail_supplier_destination md ON md.id_supplier = mc.id_customer
	WHERE
		tp.kode_po LIKE '%SO%' AND tp.id_po='$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}
	function getDetailBod($id)
	{
		$sql ="SELECT
		ta.ID,
		ta.TANGGAL_DAFTAR,
		ta.JUMLAH_BARANG,
		tb.ID_HEADER,
		tb.KODE_BARANG,
		vb.nama_barang,
		td.qty_mc,
		tp.id_po,
		ta.TANGGAL_AJU,
		tf.qty_invoice,
		mc.nama,
		ta.NOMOR_AJU,
		ta.NOMOR_DAFTAR,
		tf.harga,
		vb.uraian_satuan_terkecil
	FROM
		smartone_tpb_dps1.tpb_header ta
		INNER JOIN smartone_tpb_dps1.tpb_barang tb ON tb.ID_HEADER = ta.ID
		INNER JOIN v_sub_barang vb ON vb.kode_barang = tb.KODE_BARANG
		INNER JOIN t_po tp INNER JOIN t_detail_po td ON tp.id_po = td.id_po
		INNER JOIN m_customer_suplier mc ON mc.id_customer = tp.id_supplier
		INNER JOIN t_invoice ti INNER JOIN t_invoice_detail tf ON ti.id_invoice = tf.id_invoice
		where ta.ID = '$id' GROUP BY ta.ID";

$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function getDetailBom($id)
	{
		$sql = "SELECT
		dr.*,
		tb.id_bom,
		tbd.id_sub_barang,
		tb.tanggal_bom,
		pa.nomor as no_job,
		tj.tanggal_job,
		tbd.qty_bom,
		tdp.harga,
		vb.nama_barang 
	FROM
		docs_repo dr
		INNER JOIN t_bom tb ON tb.kode_bom = dr.nomor
		INNER JOIN t_bom_detail tbd ON tbd.id_bom = tb.id_bom
		INNER JOIN v_sub_barang vb ON vb.id_sub_barang = tbd.id_sub_barang
		INNER JOIN t_detail_po tpo ON tpo.id_detail_po = tb.id_detail_po
		INNER JOIN ( SELECT dr.* FROM docs_repo dr WHERE dr.id_po = '$id' AND jenis = 'Job' ) pa ON pa.id_po = dr.id_po
		INNER JOIN t_job tj ON tj.no_job = pa.nomor
		INNER JOIN t_detail_po tdp ON tdp.id_po = dr.id_po
	WHERE
		dr.id_po = '$id'";
		$res = $this->db->query($sql);
		$num = $res->num_rows();
		$recordsTotal = $res->num_rows();
		$data = array();
		if($num>0){
			$i=1;
			foreach ($res->result() as $r){
				$r->no = $i;
				$r->blank = '';
				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		// $k->recordsTotal = $recordsTotal;
		// $k->recordsFiltered = $recordsFiltered;
		$k->data = $data;

		return $k;
	}
	function getDetailBomPo($id)
	{
		$sql = "SELECT
					tp.id_po,
					mc.nama,
					tp.kode_po,
					tp.tanggal_dibutuhkan,
					t_job.no_job,
					t_job.tanggal_job,
					t_bom.kode_bom,
					vb.nama_barang,
					vb.kode_barang,
					vb.uraian_satuan_terkecil,
					tdp.qty_po,
					mr.kode_valuta,
					tdp.harga 
				FROM
					t_po tp
					INNER JOIN t_detail_po tdp ON tp.id_po = tdp.id_po
					INNER JOIN t_detail_pp tdpp ON tdpp.id_detail_pp = tdp.id_detail_pp
					INNER JOIN t_pp ON t_pp.id_pp = tdpp.id_pp
					INNER JOIN t_detail_job tdj ON tdj.id_detail_job = tdpp.id_detail_job
					INNER JOIN t_job ON t_job.id_job = tdj.id_job
					INNER JOIN t_bom ON t_bom.id_bom = t_job.id_bom
					INNER JOIN v_sub_barang vb ON vb.id_sub_barang = tdp.id_sub_barang
					INNER JOIN m_customer_suplier mc ON mc.id_customer = tp.id_supplier
					LEFT JOIN m_rates mr ON mr.id_rates = tp.id_valuta 
				WHERE
					t_bom.kode_bom = '0039/BOM-GCI/XII/2020' 
					AND vb.id_sub_barang = '28152'";
		$res = $this->db->query($sql);
		$num = $res->num_rows();
		$recordsTotal = $res->num_rows();
		$data = array();
		if($num>0){
			$i=1;
			foreach ($res->result() as $r){
				$r->no = $i;
				$r->blank = '';
				$data[] = $r;
				$i++;
			}
		}
		$k = new stdClass();
		// $k->recordsTotal = $recordsTotal;
		// $k->recordsFiltered = $recordsFiltered;
		$k->data = $data;

		return $k;
	}

	function getIDByCode($id)
	{
		$sql = "select * from ($this->basesql) pa where kode_mutasi = '$id'";
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

	function disapprove1($id)
	{
		$b = new stdClass();
		$b->approval_1 = 0;
		$b->id_user_approval_1 = 0;
		$b->date_approval_1 = $this->nowdt;
		$this->db->where($this->table_id, $id);
		$this->db->update($this->table, $b);
	}

	function disapprove2($id)
	{
		$b = new stdClass();
		$b->approval_2 = 0;
		$b->id_user_approval_2 = 0;
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
