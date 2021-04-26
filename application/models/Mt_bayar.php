<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_bayar extends CI_Model
{
	var $table = 't_bayar';
	var $table_id = 'id_bayar';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->load->model('mt_finance');
		// $this->basesql = "SELECT ta.*, tb.jumlah FROM (SELECT ta.id_invoice, tb.id_invoice_detail, ta.tanggal_invoice, ta.kode_invoice, SUM(tb.subtotal) as nilai, tc.NAMA AS customer, td.KODE_VALUTA AS kode_valuta, td.URAIAN_VALUTA AS uraian_valuta, te.URAIAN_NEGARA AS negara from t_invoice ta INNER JOIN t_invoice_detail tb ON ta.id_invoice=tb.id_invoice INNER JOIN smartone_tpb_dps1.referensi_pengusaha tc on tc.ID = ta.id_supplier INNER JOIN smartone_tpb_dps1.referensi_valuta td ON td.ID=ta.id_valuta INNER JOIN smartone_tpb_dps1.referensi_negara te ON te.ID=ta.id_country) ta LEFT JOIN (SELECT ta.id_invoice, SUM(tb.jumlah_bayar) AS jumlah FROM t_invoice_detail ta, t_bayar tb WHERE ta.id_invoice_detail=tb.id_invoice_detail GROUP BY ta.id_invoice) tb ON ta.id_invoice=tb.id_invoice";
		$this->basesql = "SELECT ta.*, tb.jumlah FROM (SELECT ta.id_invoice, tb.id_invoice_detail, ta.tanggal_invoice, ta.kode_invoice, SUM(tb.harga) as nilai, ta.id_valuta, tg.rates_jual AS rate, ta.is_posting, tc.id_customer, tc.nama AS customer, td.KODE_VALUTA AS kode_valuta, td.URAIAN_VALUTA AS uraian_valuta, te.URAIAN_NEGARA AS negara from t_invoice ta INNER JOIN t_invoice_detail tb ON ta.id_invoice=tb.id_invoice INNER JOIN m_customer_suplier tc on tc.id_customer = ta.id_supplier INNER JOIN smartone_tpb_dps1.referensi_valuta td ON td.ID=ta.id_valuta INNER JOIN m_rates tg ON tg.kode_valuta = td.KODE_VALUTA INNER JOIN smartone_tpb_dps1.referensi_negara te ON te.ID=ta.id_country WHERE ta.date_approval_2 IS NOT NULL GROUP BY ta.id_invoice) ta LEFT JOIN (SELECT ta.id_invoice, SUM(tb.jumlah_bayar) AS jumlah FROM t_invoice_detail ta, t_bayar tb WHERE ta.id_invoice_detail=tb.id_invoice_detail GROUP BY ta.id_invoice) tb ON ta.id_invoice=tb.id_invoice";
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

	function viewDTPiutang($in)
	{
		$start = $in->start;
		$sqlmain = $this->basesql;
		// $sqlmain = $this->basesql." WHERE ta.is_posting='1'";

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
				// $r->nilai = $r->kode_valuta." ".substr($r->nilai, 0, -6);
				// $r->nilai = substr($r->nilai, 0, -6);
				$r->option = '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->id_invoice).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a>';
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

	function viewByInvoiceId($in, $invoice, $scoa)
	{
		$start = $in->start;

		$sql = "SELECT ta.*, te.jumlah, tb.kode_barang, tb.nama_barang, te.id_po, te.kode_po, te.po_buyer, te.tanggal_dibuat, tb.kode_satuan_terkecil as kode_satuan, tb.kode_kemasan, tf.id_akun from t_invoice_detail ta left join v_sub_barang tb on tb.id_sub_barang = ta.id_sub_barang INNER JOIN m_class tf ON tb.id_class = tf.id_class left join t_detail_stuffing tc on tc.id_detail_stuffing= ta.id_detail_stuffing left join t_detail_po td on td.id_detail_po = tc.id_detail_po left join t_po te on te.id_po = td.id_po LEFT JOIN (SELECT id_invoice_detail, SUM(jumlah_bayar) AS jumlah FROM t_bayar GROUP BY id_invoice_detail) te ON ta.id_invoice_detail=te.id_invoice_detail where ta.deleted_at is null and ta.id_invoice = '$invoice'";
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
				if($r->harga<>$r->jumlah){
					// $r->bayar = '<input type="hidden" name="hid[]" value="'.$r->id_invoice_detail.'"><input type="text" name="hakun[]" value="'.$r->id_akun.'"><input type="text" class="form-control form-control-sm input-mask amount text-right" size="8" name="t_bayar_detail[]" placeholder="0" value="0" data-inputmask="\'alias\': \'currency\', \'prefix\': \'\', \'suffix\': \'\', \'allowMinus\': false" />';
					$r->bayar = '<input type="hidden" name="hid[]" value="'.$r->id_invoice_detail.'"><input type="text" class="form-control form-control-sm input-mask amount text-right" size="8" name="t_bayar_detail[]" placeholder="0" value="0" data-inputmask="\'alias\': \'currency\', \'prefix\': \'\', \'suffix\': \'\', \'allowMinus\': false" />';
					$r->option = '<input type="checkbox" style="margin-top: 10px" class="bayarfull" name="cekbayar" />';
					$r->current = $r->jumlah;
					$r->coa = '<select class="form-control form-control-sm select2 coaid" name="t_finance_detail[]"><option value="" disabled selected>Select Data . . .</option>'.createOption($scoa,'id_akun',array('kode_akun','nama_akun'),' - ').'</select>';
				}else{
					$r->coa = '';
					$r->current = $r->jumlah;
					$r->bayar = '';
					$r->option = '';
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
		$sql = $this->basesql." WHERE ta.id_invoice ='$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
	}

	function createBC($in)
    {
		$sisa = $in->sisa;
		for($i=0; $i<count($in->t_bayar_detail); $i++){
			if($in->t_bayar_detail[$i]){
				$sisa  = $sisa - $in->t_bayar_detail[$i];
				$b = new stdClass();
				$b->tgl_bayar = $this->nowd;
				$b->id_invoice_detail = $in->hid[$i];
				$b->jumlah_bayar = $in->t_bayar_detail[$i];
				$b->sisa_bayar = $sisa;
				$this->db->insert('t_bayar', $b);
			}
		}
	}
	
	function create($in)
    {
		$a = new stdClass();
		$a->no_trans = $this->mt_finance->generateCode($this->nowd, 'JV');
		$a->id_valuta = $in->hvaluta;
		$a->rate = $in->hrate;
		$a->tgl_trans = $this->nowd;
		$a->id_status = $in->id_status;
		$a->approval_1 = $in->approval_1;
		$a->approval_2 = $in->approval_2;
		$a->id_user_approval_1 = $in->id_user_approval_1;
		$a->id_user_approval_2 = $in->id_user_approval_2;
		$a->closing = 0;
		// $a->closing = $in->closing;
		$a->created_at = $this->nowdt;
		$this->db->insert('t_finance', $a);
        $finance = $this->db->insert_id();
		$sisa = $in->sisa;
		$bayar = 0;

		$c = new stdClass();
		$c->id_finance = $finance;
		$c->id_akun = $in->hakun;
		$c->trans_description = $in->hinvoice . ' ' . $in->customer . ' (' . $this->nowd . ')';
		$c->description = $in->hinvoice . ' ' . $in->customer . ' (' . $this->nowd . ')';
		$c->created_at = $this->nowdt;
		$c->jumlah_rp = array_sum($in->t_bayar_detail[$i]);
		$c->amount = array_sum($in->t_bayar_detail[$i]);
		$this->db->insert('t_finance_detail', $c);
				
		for($i=0; $i<count($in->t_bayar_detail); $i++){
			if($in->t_bayar_detail[$i]){
				$sisa  = $sisa - $in->t_bayar_detail[$i];
				$bayar = $bayar + $in->t_bayar_detail[$i]; 

				$b = new stdClass();
				$b->tgl_bayar = $this->nowd;
				$b->id_invoice_detail = $in->hid[$i];
				$b->jumlah_bayar = $in->t_bayar_detail[$i];
				$b->sisa_bayar = $sisa;
				$this->db->insert('t_bayar', $b);

				$d = new stdClass();
				$d->id_finance = $finance;
				$d->id_akun = $in->t_finance_detail[$i];
				$d->trans_description = $in->hinvoice . ' ' . $in->customer . ' (' . $this->nowd . ')';
				$d->description = $in->hinvoice . ' ' . $in->customer . ' (' . $this->nowd . ')';
				$d->created_at = $this->nowdt;
				$d->jumlah_rp = $in->t_bayar_detail[$i];
				$d->amount = (-1) * $in->t_bayar_detail[$i];
				$this->db->insert('t_finance_detail', $d);
			}
		}

		// $e = new stdClass();
        // $e->jumlah_rp = $bayar;
        // $this->db->where('id_finance', $finance);
		// $this->db->update('t_finance_detail', $e);
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
