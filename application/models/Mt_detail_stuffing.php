<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_detail_stuffing extends CI_Model
{
	var $table = 't_detail_stuffing';
	var $table_id = 'id_detail_stuffing';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$sqlout = "SELECT tb.id_master, ta.id_job, ta.id_sub_barang, SUM( qty ) AS qty_out FROM t_wh_detail ta INNER JOIN t_wh tb ON tb.id_wh = ta.id_wh INNER JOIN m_jenis_mutasi tc ON tc.id_jenis_mutasi = tb.id_jenis_mutasi WHERE ta.deleted_at IS NULL AND tb.id_master IS NOT NULL AND tb.jenis_transaksi = 'T' AND tc.id_status = 'OUT' GROUP BY tb.id_master, ta.id_job, ta.id_sub_barang";
		$this->basesql = "SELECT td.id_po,ta.*, tb.kode_barang, tb.nama_barang, tb.nilai_kemasan, td.kode_po, td.po_buyer, td.tanggal_dibuat, th.nama AS nama_supplier, tb.kode_kemasan, tb.kode_satuan_terkecil kode_satuan, tc.qty_po, tc.qty_mc, tg.kode_stuffing, tg.tanggal_stuffing, tg.container_number, tg.seal_number, te.id_job, tf.no_job, tf.tanggal_job, tk.kode_mutasi, tk.tanggal_terima, ti.id_master, tj.qty, IFNULL( tl.qty_out, 0 ) AS qty_out, tj.qty - IFNULL( tl.qty_out, 0 ) AS qty_remain FROM t_detail_stuffing ta LEFT JOIN v_sub_barang tb ON tb.id_sub_barang = ta.id_sub_barang LEFT JOIN t_detail_po tc ON tc.id_detail_po = ta.id_detail_po LEFT JOIN t_po td ON td.id_po = tc.id_po LEFT JOIN t_wh_detail te ON te.id_wh_detail = ta.id_wh_detail LEFT JOIN t_job tf ON tf.id_job = te.id_job LEFT JOIN t_stuffing tg ON tg.id_stuffing = ta.id_stuffing LEFT JOIN m_customer_suplier th ON th.id_customer = td.id_supplier LEFT JOIN t_wh ti ON ti.id_wh = te.id_wh LEFT JOIN t_wh tk ON tk.id_wh = ti.id_master LEFT JOIN t_wh_detail tj ON tj.id_wh = ti.id_master AND tj.id_sub_barang = te.id_sub_barang AND tj.id_job = te.id_job LEFT JOIN ( $sqlout ) tl ON tl.id_master = ti.id_master AND tl.id_job = te.id_job AND tl.id_sub_barang = ta.id_sub_barang WHERE ta.deleted_at IS NULL";
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

	function viewByStuffingId($id_stuffing)
	{
		$sql = $this->basesql." and ta.id_stuffing = '$id_stuffing'";
		$res = $this->db->query($sql);

		$data = array();
		foreach ($res->result() as $r){
			$data[] = $r;
		}

		return $data;
	}

	function viewInvoiceDT($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = "SELECT
		tc.id_po,
		tj.no_job,
		tj.tanggal_job,
		ta.*,
		te.tanggal_stuffing,
		te.kode_stuffing,
		tb.kode_barang,
		tb.nama_barang,
		td.kode_po,
		td.po_buyer,
		td.tanggal_dibutuhkan,
		td.id_supplier,
		td.id_tipe_sales,
		td.tanggal_dibuat,
		
		tb.kode_kemasan,
		tb.id_satuan_terkecil AS id_satuan,
		tb.kode_satuan_terkecil kode_satuan,
		tb.nilai_kemasan,
		ta.qty_si_plan AS qty_invoice,
		ta.qty_si_real AS qty_remain 
	FROM
		t_detail_stuffing ta
		INNER JOIN t_stuffing ts ON ts.id_stuffing = ta.id_stuffing
		LEFT JOIN v_sub_barang tb ON tb.id_sub_barang = ta.id_sub_barang
		LEFT JOIN t_detail_po tc ON tc.id_detail_po = ta.id_detail_po
		LEFT JOIN t_po td ON td.id_po = tc.id_po
		LEFT JOIN t_stuffing te ON te.id_stuffing = ta.id_stuffing 
		INNER JOIN t_wh_detail tw ON tw.id_wh_detail = ta.id_wh_detail
		INNER JOIN t_job tj On tj.id_job = tw.id_job
	WHERE
		ts.approval_1 = '1' 
		AND ts.approval_2 = '1' 
		AND ta.deleted_at IS NULL 
		-- AND ta.qty_si_real -IF( ta.qty_si_plan IS NULL, ta.qty_si_plan, 0 ) > 0
		";
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

	function viewByWhere($arrclause) {
        $sqlmain = $this->basesql;
        $sql = "select * from ($sqlmain) pa WHERE 1 = 1 ";
        foreach ($arrclause as $key => $item) {
            $sql .= " and pa.$key = '$item' ";
        }
        $res = $this->db->query($sql);

        $data = array();
        foreach ($res->result() as $r) {
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

	function viewstuffingdt($in, $opt = true)
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

	function get($id)
	{
		$sql = $this->basesql." and $this->table_id = '$id'";
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
		$this->db->where($this->table_id, $in->id_detail_stuffing);
		$this->db->update($this->table, $in);
	}

	function delete($in)
	{
		$this->db->where($this->table_id, $in->id);
		$this->db->delete($this->table);
	}
}
