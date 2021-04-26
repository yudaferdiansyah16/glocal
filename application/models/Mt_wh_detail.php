<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_wh_detail extends CI_Model
{
	var $table = 't_wh_detail';
	var $table_id = 'id_wh_detail';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "SELECT ta.*, tb.qty_dn, tb.no_sj, tb.harga, tc.kode_dn, tc.no_invoice, te.kode_barang, te.nama_barang, tf.KODE_SATUAN kode_satuan_terkecil, tf.URAIAN_SATUAN uraian_satuan_terkecil, tg.KODE_SATUAN kode_satuan_terbesar, tg.URAIAN_SATUAN uraian_satuan_terbesar, th.nama_gudang, tk.kode_valuta, tk.uraian_valuta, tl.id_akun, tm.kode_mutasi, tm.tanggal_terima, tn.NAMA as nama_supplier, tp.no_job, tp.tanggal_job FROM t_wh_detail ta LEFT JOIN t_detail_dn tb ON tb.id_detail_dn = ta.id_detail_dn LEFT JOIN t_dn tc ON tc.id_dn = tb.id_dn LEFT JOIN m_fasilitas td ON td.id_fasilitas = tc.id_fasilitas LEFT JOIN m_sub_barang AS te ON te.id_sub_barang = ta.id_sub_barang LEFT JOIN smartone_tpb_dps1.referensi_satuan tf ON tf.ID = ta.id_satuan_terkecil LEFT JOIN smartone_tpb_dps1.referensi_satuan tg ON tg.ID = ta.id_satuan_terbesar LEFT JOIN m_gudang th ON th.id_gudang = ta.id_gudang LEFT JOIN t_detail_po ti on ti.id_detail_po = tb.id_detail_po LEFT join t_po tj on tj.id_po = ti.id_po left join smartone_tpb_dps1.referensi_valuta as tk on tk.ID = tj.id_valuta LEFT JOIN m_class tl on tl.id_class = te.id_class LEFT JOIN t_wh tm on tm.id_wh = ta.id_wh left JOIN smartone_tpb_dps1.referensi_pengusaha tn ON tn.ID = tc.id_supplier LEFT JOIN t_job tp on tp.id_job = ta.id_job WHERE ta.deleted_at IS NULL";
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

	function viewBasedWHId($id_wh)
	{
		$sql = $this->basesql." and ta.id_wh = '$id_wh'";
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

				$st_checked = '';
				$r->status_trans = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="switch'.$i.'" data-url="'.base_url('master/'.$this->d->_method.'/changeStatus').'" data-id="'.$r->{$this->table_id}.'" data-key="'.$this->table_id.'" data-status="id_status" onclick="changeStatus(this)" '.$st_checked.'><label class="custom-control-label" for="switch'.$i.'"></label></div>';

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

	function viewStuffingDT($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = "";
		if (in_array((isset($this->in->id_tipe_sales) ? $this->in->id_tipe_sales : null), array(4, 5, 6))) {
			$sqlout = "SELECT tb.id_master, ta.id_job, ta.id_sub_barang, SUM( qty ) AS qty_out FROM t_wh_detail ta INNER JOIN t_wh tb ON tb.id_wh = ta.id_wh INNER JOIN m_jenis_mutasi tc ON tc.id_jenis_mutasi = tb.id_jenis_mutasi WHERE ta.deleted_at IS NULL AND tb.id_master IS NOT NULL AND tb.jenis_transaksi = 'T' AND tc.id_status = 'OUT'";
			$sqlmain = "SELECT ta.id_wh_detail, ta.id_wh, ta.id_job, tab.no_job, tab.tanggal_job, tj.kode_mutasi, tj.tanggal_terima, tj.jenis_transaksi, tb.id_detail_po, tb.id_po, ti.kode_po, ti.po_buyer, ti.tanggal_dibuat, ti.type_trans, ti.id_tipe_sales, tf.nama_tipe_sales, ti.id_valuta, tg.KODE_VALUTA kode_valuta, tg.URAIAN_VALUTA uraian_valuta, ti.id_supplier, te.NAMA nama_supplier, tb.id_sub_barang, tc.kode_barang, tc.nama_barang, tc.nilai_kemasan, tb.id_kemasan, th.KODE_KEMASAN kode_kemasan, th.URAIAN_KEMASAN uraian_kemasan, tb.qty_mc, tb.id_satuan, KODE_SATUAN kode_satuan, td.URAIAN_SATUAN satuan, tb.harga, ti.approval_1, ti.approval_2, tb.qty_po, ta.qty, IFNULL( tk.qty_out, 0 ) AS qty_out, ta.qty - IFNULL( tk.qty_out, 0 ) AS qty_remain FROM t_wh_detail ta LEFT JOIN t_job tab ON tab.id_job = ta.id_job LEFT JOIN t_bom tac ON tac.id_bom = tab.id_bom LEFT JOIN t_detail_po tb ON tb.id_sub_barang = ta.id_sub_barang LEFT JOIN t_po ti ON ti.id_po = tb.id_po LEFT JOIN m_sub_barang tc ON tc.id_sub_barang = ta.id_sub_barang LEFT JOIN smartone_tpb_dps1.referensi_satuan td ON tb.id_satuan = td.ID LEFT JOIN smartone_tpb_dps1.referensi_pemasok te ON ti.id_supplier = te.ID LEFT JOIN m_tipe_sales tf ON ti.id_tipe_sales = tf.id_tipe_sales LEFT JOIN smartone_tpb_dps1.referensi_valuta tg ON ti.id_valuta = tg.ID LEFT JOIN smartone_tpb_dps1.referensi_kemasan th ON tb.id_kemasan = th.ID LEFT JOIN t_wh tj ON tj.id_wh = ta.id_wh LEFT JOIN ( $sqlout ) tk ON tk.id_master = ta.id_wh AND tk.id_job = ta.id_job AND tk.id_sub_barang = ta.id_sub_barang WHERE tj.jenis_transaksi = 'M' AND ti.type_trans = 'sales' AND ta.deleted_at IS NULL AND ta.id_job IS NULL";
		} else {
			$sqlout = "SELECT tb.id_master, ta.id_job, ta.id_sub_barang, SUM( qty ) AS qty_out FROM t_wh_detail ta INNER JOIN t_wh tb ON tb.id_wh = ta.id_wh INNER JOIN m_jenis_mutasi tc ON tc.id_jenis_mutasi = tb.id_jenis_mutasi WHERE ta.deleted_at IS NULL AND tb.id_master IS NOT NULL AND tb.jenis_transaksi = 'T' AND tc.id_status = 'OUT'";
			$sqlmain = "SELECT ta.id_wh_detail, ta.id_wh, ta.id_job, tab.no_job, tab.tanggal_job, tj.kode_mutasi, tj.tanggal_terima, tj.jenis_transaksi, tb.id_detail_po, tb.id_po, ti.kode_po, ti.po_buyer, ti.tanggal_dibuat, ti.id_tipe_sales, tf.nama_tipe_sales, ti.id_valuta, tg.KODE_VALUTA kode_valuta, tg.URAIAN_VALUTA uraian_valuta, ti.id_supplier, te.NAMA nama_supplier, tb.id_sub_barang, tc.kode_barang, tc.nama_barang, tc.nilai_kemasan, tb.id_kemasan, th.KODE_KEMASAN kode_kemasan, th.URAIAN_KEMASAN uraian_kemasan, tb.qty_mc, tb.id_satuan, KODE_SATUAN kode_satuan, td.URAIAN_SATUAN satuan, tb.harga, ti.approval_1, ti.approval_2, tb.qty_po, ta.qty, IFNULL(tk.qty_out, 0) AS qty_out, ta.qty - IFNULL(tk.qty_out, 0) AS qty_remain FROM t_wh_detail ta LEFT JOIN t_job tab ON tab.id_job = ta.id_job LEFT JOIN t_bom tac ON tac.id_bom = tab.id_bom LEFT JOIN t_detail_po tb ON tb.id_detail_po = tac.id_detail_po LEFT JOIN t_po ti ON ti.id_po = tb.id_po LEFT JOIN m_sub_barang tc ON tc.id_sub_barang = ta.id_sub_barang LEFT JOIN smartone_tpb_dps1.referensi_satuan td ON tb.id_satuan = td.ID 	LEFT JOIN m_customer_suplier te ON ti.id_supplier = te.id_customer
			LEFT JOIN m_tipe_sales tf ON ti.id_tipe_sales = tf.id_tipe_sales LEFT JOIN smartone_tpb_dps1.referensi_valuta tg ON ti.id_valuta = tg.ID LEFT JOIN smartone_tpb_dps1.referensi_kemasan th ON tb.id_kemasan = th.ID LEFT JOIN t_wh tj on tj.id_wh = ta.id_wh LEFT JOIN ($sqlout) tk ON tk.id_master = ta.id_wh AND tk.id_job = ta.id_job AND tk.id_sub_barang = ta.id_sub_barang WHERE tj.jenis_transaksi = 'M' and ta.deleted_at is null AND
			ta.qty - IFNULL( tk.qty_out, 0 ) > 0 ";	
		}
		if (isset($this->in->id_supplier)) {
			$sqlmain .= " and ti.id_supplier = '".$this->in->id_supplier."' ";
		}
		if (isset($this->in->id_tipe_sales)) {
			$sqlmain .= " and ti.id_tipe_sales = '".$this->in->id_tipe_sales."' ";
		}
		if (isset($this->in->id_po)) {
			$sqlmain .= " and ti.id_po = '".$this->in->id_po."' ";
		}
		$sql = "select * from ($sqlmain) pa ORDER BY id_wh DESC";
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

	function viewMutationDT($in, $opt = true)
	{
		$start = $in->start;
		$tglajuawal = reverseDate($in->tglajuawal);
		$tglajuakhir = reverseDate($in->tglajuakhir);
		$sqlbegin = "SELECT ta.id_sub_barang, SUM( CASE WHEN tc.id_status = 'IN' THEN ta.qty ELSE ((- 1 ) * ta.qty ) END ) AS qty_begin FROM t_wh_detail ta INNER JOIN t_wh tb ON tb.id_wh = ta.id_wh INNER JOIN m_jenis_mutasi tc ON tc.id_jenis_mutasi = tb.id_jenis_mutasi WHERE tb.id_jenis_mutasi != '14' AND tb.tanggal_terima < '".$tglajuawal."' AND ta.deleted_at IS NULL GROUP BY ta.id_sub_barang";
		$sqldebit = "SELECT ta.id_sub_barang, SUM(ta.qty) AS qty_in FROM t_wh_detail ta INNER JOIN t_wh tb ON tb.id_wh = ta.id_wh INNER JOIN m_jenis_mutasi tc ON tc.id_jenis_mutasi = tb.id_jenis_mutasi WHERE tb.id_jenis_mutasi != '14' AND tc.id_status = 'IN' AND tb.tanggal_terima between '".$tglajuawal."' and '".$tglajuakhir."' AND ta.deleted_at IS NULL GROUP BY ta.id_sub_barang";
		$sqlcredit = "SELECT ta.id_sub_barang, SUM(ta.qty) AS qty_out FROM t_wh_detail ta INNER JOIN t_wh tb ON tb.id_wh = ta.id_wh INNER JOIN m_jenis_mutasi tc ON tc.id_jenis_mutasi = tb.id_jenis_mutasi WHERE tb.id_jenis_mutasi != '14' AND tc.id_status = 'OUT' AND tb.tanggal_terima between '".$tglajuawal."' and '".$tglajuakhir."' AND ta.deleted_at IS NULL GROUP BY ta.id_sub_barang";
		$sqlend = "SELECT ta.id_sub_barang, SUM( CASE WHEN tc.id_status = 'IN' THEN ta.qty ELSE ((- 1 ) * ta.qty ) END ) AS qty_end FROM t_wh_detail ta INNER JOIN t_wh tb ON tb.id_wh = ta.id_wh INNER JOIN m_jenis_mutasi tc ON tc.id_jenis_mutasi = tb.id_jenis_mutasi WHERE tb.id_jenis_mutasi != '14' AND tb.tanggal_terima <= '".$tglajuakhir."' AND ta.deleted_at IS NULL GROUP BY ta.id_sub_barang";
		$sqlmain = "SELECT ta.id_sub_barang, ta.kode_barang, ta.nama_barang, ta.id_satuan_terkecil id_satuan, ta.kode_satuan_terkecil kode_satuan, ta.id_class, tf.id_jenis_laporan, IFNULL(tb.qty_begin, 0) qty_begin, IFNULL(tc.qty_in, 0) qty_in, IFNULL(td.qty_out, 0) qty_out, IFNULL(te.qty_end, 0) qty_end FROM v_sub_barang ta LEFT JOIN ($sqlbegin) tb ON tb.id_sub_barang = ta.id_sub_barang LEFT JOIN ($sqldebit) tc ON tc.id_sub_barang = ta.id_sub_barang LEFT JOIN ($sqlcredit) td ON td.id_sub_barang = ta.id_sub_barang LEFT JOIN ($sqlend) te ON te.id_sub_barang = ta.id_sub_barang LEFT JOIN m_class tf ON tf.id_class = ta.id_class WHERE ta.deleted_at IS NULL AND (IFNULL(tc.qty_in, 0) > 0 OR IFNULL(td.qty_out, 0) > 0) ";
		if (isset($in->id_jenis_laporan)) {
			$sqlmain .= " and tf.id_jenis_laporan = '".$in->id_jenis_laporan."'";
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
				$r->blank = '';
				$r->qty_adjust = 0;
				$r->qty_opname = 0;
				$r->qty_selisih = 0;
				$r->description = '';

				if($opt){

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

	function viewStockDT($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = "SELECT
		td.rate,
		tb.size,
		tb.nama_class,
		te.KODE_SATUAN kode_satuan,
		tb.kode_satuan_terbesar kode_satuan_terbesar,
		-- tb.uraian_satuan_terkecil uraian_satuan_terkecil,
		tb.unit_konversi,
		tb.id_satuan_terkecil AS id_satuan,
		td.id_wh_detail,
		td.id_wh,
		tc.ID_HEADER,
		tc.nomor_aju,
		tc.nomor_daftar,
		ta.*,
		tb.id_sub_barang,
		tb.kode_barang,
		tb.nama_barang,
		tc.id_detail_dn,
		tc.no_sj,
		td.seri_barang,
		(
			sum( CASE WHEN td.saldo_mutasi = 'K' THEN td.qty_wh ELSE 0 END )) - (
		sum( CASE WHEN td.saldo_mutasi = 'D' THEN td.qty_wh ELSE 0 END )) AS qty 
	FROM
		(
		SELECT
			a1.id_detail_job,
			a1.id_job,
			a2.no_job 
		FROM
			t_detail_job a1
			INNER JOIN t_job a2 ON a1.id_job = a2.id_job 
		) ta
		INNER JOIN (
		SELECT
			a2.kode_satuan_terbesar,
			-- a2.uraian_satuan_terkecil,
			a2.unit_konversi,
			a1.id_detail_pp,
			a1.id_sub_barang,
			a1.id_detail_job,
			a2.kode_barang,
			a2.nama_barang,
			a2.size,
			a2.nama_class,
			mc.id_class,
			a2.id_satuan_terkecil 
		FROM
			t_detail_pp a1
			INNER JOIN v_sub_barang a2 ON a1.id_sub_barang = a2.id_sub_barang 
			INNER JOIN m_class mc ON mc.nama_class =  a2.nama_class

		) tb ON ta.id_detail_job = tb.id_detail_job
		INNER JOIN (
		SELECT
			a1.id_detail_dn,
			a1.no_sj,
			a2.id_detail_po,
			a2.id_detail_pp,
			a3.kode_po,
			a4.ID_HEADER,
			a5.NOMOR_AJU AS nomor_aju,
			a5.NOMOR_DAFTAR AS nomor_daftar 
		FROM
			t_detail_dn a1
			INNER JOIN t_dn a4 ON a1.id_dn = a4.id_dn
			INNER JOIN t_detail_po a2 ON a1.id_detail_po = a2.id_detail_po
			INNER JOIN t_po a3 ON a2.id_po = a3.id_po
			LEFT JOIN smartone_tpb_dps1.tpb_header a5 ON a4.ID_HEADER = a5.ID 
		) tc ON tb.id_detail_pp = tc.id_detail_pp
		LEFT JOIN (
		SELECT
			a1.rate,
			a2.id_jenis_mutasi,
			a2.approval_1,
			approval_2,
			a3.saldo_mutasi,
			a1.id_wh_detail,
			a1.id_wh,
			a1.id_detail_dn,
			a1.qty AS qty_wh,
			a1.seri_barang,
			a1.id_sub_barang 
		FROM
			t_wh_detail a1
			INNER JOIN t_wh a2 ON a1.id_wh = a2.id_wh
			INNER JOIN m_jenis_mutasi a3 ON a2.id_jenis_mutasi = a3.id_jenis_mutasi 
		) td ON tc.id_detail_dn = td.id_detail_dn
		LEFT JOIN smartone_tpb_dps1.referensi_satuan te ON te.ID = tb.id_satuan_terkecil 
	WHERE
		td.approval_1 = '1' 
		AND td.approval_2 = '1' 
		AND tb.id_class ='01' 
	GROUP BY
			-- tc.nomor_aju,
			ta.no_job ,
		tb.kode_barang
	HAVING
		qty > 0";
		// $sqlmain = "SELECT ta.id_sub_barang, tb.kode_barang, tb.nama_barang, tb.size, ta.id_satuan_terkecil as id_satuan, te.KODE_SATUAN AS kode_satuan, tb.nama_class, SUM( ta.qty  ) AS qty FROM 
		// t_wh_detail ta LEFT JOIN v_sub_barang tb ON tb.id_sub_barang = ta.id_sub_barang LEFT JOIN t_wh tc ON tc.id_wh = ta.id_wh LEFT JOIN m_jenis_mutasi td ON td.id_jenis_mutasi = tc.id_jenis_mutasi LEFT JOIN smartone_tpb_dps1.referensi_satuan te ON te.ID = ta.id_satuan_terkecil WHERE tc.approval_1 = '1' AND tc.approval_2 = '1' GROUP BY ta.id_sub_barang, tb.kode_barang, tb.nama_barang, ta.id_satuan_terkecil, te.KODE_SATUAN, tb.nama_class HAVING SUM( ta.qty ) > 0";
		if (isset($this->in->id_supplier)) {
			$sqlmain .= " and ti.id_supplier = '".$this->in->id_supplier."' ";
		}
		if (isset($this->in->id_tipe_sales)) {
			$sqlmain .= " and ti.id_tipe_sales = '".$this->in->id_tipe_sales."' ";
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
				$r->blank = '';

				if($opt){
					$r->option = "<button class='btn btn-xs btn-success btn-detail'><i class='fa fal fa-plus-circle'></i> Show</button>";
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

	function viewStockDTFG($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = "SELECT
		tp.id_production,
		tpp.id_production_detail,
		vb.nama_barang,
		vb.id_sub_barang,
		vb.kode_barang,
		vb.kode_satuan_terbesar,
		vb.unit_konversi,
		-- vb.uraian_satuan_terkecil uraian_satuan_terkecil,
		vb.nama_class,
		vb.size,
		mc.kode_class,
		vb.kode_satuan_terkecil as kode_satuan,
		sum(tpp.qty) as qty,
		tdp.id_detail_po,
		tdp.qty_realisasi,
		tp.approval_1,
		tp.approval_2 
	FROM
		t_job tj
		INNER JOIN t_production tp ON tp.id_job = tj.id_job
		INNER JOIN t_production_detail tpp ON tpp.id_production = tp.id_production 
		AND tpp.id_job = tj.id_job
		INNER JOIN t_detail_dn tdn ON tdn.id_detail_dn = tp.id_detail_dn
		INNER JOIN t_detail_po tdp ON tdn.id_detail_po = tdp.id_detail_po
		INNER JOIN v_sub_barang vb ON vb.id_sub_barang = tpp.id_sub_barang 
		INNER JOIN m_class mc ON mc.id_class = vb.id_class

	WHERE
	-- 	tp.id_production = 99 
	-- 	AN
	--  tpp.id_production = 99 
	-- 	AND
	tp.approval_1 = '1' AND tp.approval_2 = '1' AND
		tpp.id_wh_detail IS NULL AND mc.kode_class ='02' AND qty > 0
		GROUP BY tpp.id_sub_barang";
		// $sqlmain = "SELECT ta.id_sub_barang, tb.kode_barang, tb.nama_barang, tb.size, ta.id_satuan_terkecil as id_satuan, te.KODE_SATUAN AS kode_satuan, tb.nama_class, SUM( ta.qty  ) AS qty FROM 
		// t_wh_detail ta LEFT JOIN v_sub_barang tb ON tb.id_sub_barang = ta.id_sub_barang LEFT JOIN t_wh tc ON tc.id_wh = ta.id_wh LEFT JOIN m_jenis_mutasi td ON td.id_jenis_mutasi = tc.id_jenis_mutasi LEFT JOIN smartone_tpb_dps1.referensi_satuan te ON te.ID = ta.id_satuan_terkecil WHERE tc.approval_1 = '1' AND tc.approval_2 = '1' GROUP BY ta.id_sub_barang, tb.kode_barang, tb.nama_barang, ta.id_satuan_terkecil, te.KODE_SATUAN, tb.nama_class HAVING SUM( ta.qty ) > 0";
		if (isset($this->in->id_supplier)) {
			$sqlmain .= " and ti.id_supplier = '".$this->in->id_supplier."' ";
		}
		if (isset($this->in->id_tipe_sales)) {
			$sqlmain .= " and ti.id_tipe_sales = '".$this->in->id_tipe_sales."' ";
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
				$r->blank = '';

				if($opt){
					// $r->option = "<button class='btn btn-xs btn-success btn-datail2'><i class='fa fal fa-plus-circle'></i> Show</button>";
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
	function viewStockDTWIP($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = "SELECT
		tp.id_production,
		tpp.id_production_detail,
		vb.nama_barang,
		vb.id_sub_barang,
		vb.kode_barang,
		vb.kode_satuan_terbesar,
		vb.unit_konversi,
		vb.nama_class,
		vb.size,
		mc.kode_class,
		vb.kode_satuan_terkecil as kode_satuan,
		sum(tpp.qty) as qty,
		tdp.id_detail_po,
		tdp.qty_realisasi,
		tp.approval_1,
		tp.approval_2 
	FROM
		t_job tj
		INNER JOIN t_production tp ON tp.id_job = tj.id_job
		INNER JOIN t_production_detail tpp ON tpp.id_production = tp.id_production 
		AND tpp.id_job = tj.id_job
		INNER JOIN t_detail_dn tdn ON tdn.id_detail_dn = tp.id_detail_dn
		INNER JOIN t_detail_po tdp ON tdn.id_detail_po = tdp.id_detail_po
		INNER JOIN v_sub_barang vb ON vb.id_sub_barang = tpp.id_sub_barang 
		INNER JOIN m_class mc ON mc.id_class = vb.id_class

	WHERE
	-- 	tp.id_production = 99 
	-- 	AN
	--  tpp.id_production = 99 
	-- 	AND
	tp.approval_1 = '1' AND tp.approval_2 = '1' AND
		tpp.id_wh_detail IS NULL AND mc.kode_class ='14' AND tpp.`status` != '2'
		GROUP BY id_sub_barang,tdp.id_detail_po";
		// $sqlmain = "SELECT ta.id_sub_barang, tb.kode_barang, tb.nama_barang, tb.size, ta.id_satuan_terkecil as id_satuan, te.KODE_SATUAN AS kode_satuan, tb.nama_class, SUM( ta.qty  ) AS qty FROM 
		// t_wh_detail ta LEFT JOIN v_sub_barang tb ON tb.id_sub_barang = ta.id_sub_barang LEFT JOIN t_wh tc ON tc.id_wh = ta.id_wh LEFT JOIN m_jenis_mutasi td ON td.id_jenis_mutasi = tc.id_jenis_mutasi LEFT JOIN smartone_tpb_dps1.referensi_satuan te ON te.ID = ta.id_satuan_terkecil WHERE tc.approval_1 = '1' AND tc.approval_2 = '1' GROUP BY ta.id_sub_barang, tb.kode_barang, tb.nama_barang, ta.id_satuan_terkecil, te.KODE_SATUAN, tb.nama_class HAVING SUM( ta.qty ) > 0";
		if (isset($this->in->id_supplier)) {
			$sqlmain .= " and ti.id_supplier = '".$this->in->id_supplier."' ";
		}
		if (isset($this->in->id_tipe_sales)) {
			$sqlmain .= " and ti.id_tipe_sales = '".$this->in->id_tipe_sales."' ";
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
				$r->blank = '';

				if($opt){
					// $r->option = "<button class='btn btn-xs btn-success btn-datail2'><i class='fa fal fa-plus-circle'></i> Show</button>";
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

	function viewKoordinatDT($in, $opt = true)
	{
		$start = $in->start;
		$clause = "";
		if (isset($this->in->id_sub_barang)) {
			$clause .= " and ta.id_sub_barang = '".$this->in->id_sub_barang."' ";
		}
		$sqlmain = "SELECT ta.id_sub_barang, tb.kode_barang, tb.nama_barang, ta.id_satuan_terkecil as id_satuan, te.KODE_SATUAN AS kode_satuan, ta.id_koordinat, tf.id_gudang, tf.nama_koordinat, tg.nama_gudang, SUM( CASE WHEN td.id_status = 'IN' THEN ta.qty ELSE ((- 1 ) * ta.qty) END ) AS qty FROM t_wh_detail ta LEFT JOIN v_sub_barang tb ON tb.id_sub_barang = ta.id_sub_barang LEFT JOIN t_wh tc ON tc.id_wh = ta.id_wh LEFT JOIN m_jenis_mutasi td ON td.id_jenis_mutasi = tc.id_jenis_mutasi LEFT JOIN smartone_tpb_dps1.referensi_satuan te ON te.ID = ta.id_satuan_terkecil LEFT JOIN m_koordinat tf ON tf.id_koordinat = ta.id_koordinat LEFT JOIN m_gudang tg ON tg.id_gudang = tf.id_gudang WHERE 1 = 1 AND tc.approval_1 = '1' AND tc.approval_2 = '1' $clause GROUP BY ta.id_sub_barang, tb.kode_barang, tb.nama_barang, ta.id_satuan_terkecil, te.KODE_SATUAN, ta.id_koordinat, tf.id_gudang, tf.nama_koordinat, tg.nama_gudang HAVING SUM( CASE WHEN td.id_status = 'IN' THEN ta.qty ELSE ((- 1 ) * ta.qty) END ) > 0";
		
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

				if($opt){
					$r->option = "<button class='btn btn-xs btn-success btn-detail'><i class='fa fal fa-plus-circle'></i> Show</button>";
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
		$sql = $this->basesql." and ta.$this->table_id = '$id'";
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
}
