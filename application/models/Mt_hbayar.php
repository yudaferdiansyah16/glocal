<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mt_hbayar extends CI_Model
{
	var $table = 't_hbayar';
	var $table_id = 'id_hbayar';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->load->model('mt_finance');
		// $this->basesql = "SELECT ta.*, tb.jumlah FROM (SELECT ta.id_dn, tb.id_detail_dn, ta.tgl_invoice, ta.no_invoice, tc.NAMA AS vendor, SUM(tb.harga) as nilai, tf.KODE_VALUTA AS kode_valuta, tf.URAIAN_VALUTA AS uraian_valuta, te.rate, te.id_valuta FROM t_dn ta INNER JOIN t_detail_dn tb ON ta.id_dn=tb.id_dn INNER JOIN smartone_tpb_dps1.referensi_pengusaha tc on tc.ID = ta.id_supplier INNER JOIN t_detail_po td ON td.id_detail_po=tb.id_detail_po INNER JOIN t_po te ON td.id_po=te.id_po INNER JOIN smartone_tpb_dps1.referensi_valuta tf ON tf.ID=te.id_valuta WHERE ta.date_approval_2 IS NOT NULL) ta LEFT JOIN (SELECT ta.id_dn, SUM(tb.jumlah_hbayar) AS jumlah FROM t_detail_dn ta, t_hbayar tb WHERE ta.id_detail_dn=tb.id_detail_dn GROUP BY ta.id_dn) tb ON ta.id_dn=tb.id_dn";
		// $this->basesql = "SELECT ta.*, tb.jumlah FROM (SELECT ta.id_dn, tb.id_detail_dn, ta.tgl_invoice, ta.no_invoice, ta.is_posting, tc.NAMA AS vendor, SUM(tb.harga) as nilai, tf.KODE_VALUTA AS kode_valuta, tf.URAIAN_VALUTA AS uraian_valuta, te.rate, te.id_valuta FROM t_dn ta INNER JOIN t_detail_dn tb ON ta.id_dn=tb.id_dn INNER JOIN m_customer_suplier tc on tc.id_customer = ta.id_supplier INNER JOIN t_detail_po td ON td.id_detail_po=tb.id_detail_po INNER JOIN t_po te ON td.id_po=te.id_po INNER JOIN smartone_tpb_dps1.referensi_valuta tf ON tf.ID=te.id_valuta WHERE ta.date_approval_2 IS NOT NULL GROUP BY ta.id_dn) ta LEFT JOIN (SELECT ta.id_dn, SUM(tb.jumlah_hbayar) AS jumlah FROM t_detail_dn ta, t_hbayar tb WHERE ta.id_detail_dn=tb.id_detail_dn GROUP BY ta.id_dn) tb ON ta.id_dn=tb.id_dn";
		$this->basesql = "SELECT ta.*, tb.jumlah FROM (SELECT ta.id_dn, tb.id_detail_dn, ta.tgl_invoice, ta.no_invoice, ta.is_posting, tc.id_customer AS id_vendor, tc.nama AS vendor, SUM(tb.harga) AS nilai, tf.KODE_VALUTA AS kode_valuta, tf.URAIAN_VALUTA AS uraian_valuta, te.id_valuta, tg.rates_jual AS rate FROM t_dn ta INNER JOIN t_detail_dn tb ON ta.id_dn = tb.id_dn INNER JOIN m_customer_suplier tc ON tc.id_customer = ta.id_supplier INNER JOIN t_detail_po td ON td.id_detail_po = tb.id_detail_po INNER JOIN t_po te ON td.id_po = te.id_po INNER JOIN smartone_tpb_dps1.referensi_valuta tf ON tf.ID = te.id_valuta INNER JOIN m_rates tg ON tg.kode_valuta = tf.KODE_VALUTA WHERE ta.date_approval_2 IS NOT NULL GROUP BY ta.id_dn) ta LEFT JOIN (SELECT ta.id_dn, SUM( tb.jumlah_hbayar ) AS jumlah FROM t_detail_dn ta, t_hbayar tb WHERE ta.id_detail_dn = tb.id_detail_dn GROUP BY ta.id_dn) tb ON ta.id_dn = tb.id_dn";
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

	function viewDTHutang($in)
	{
		$start = $in->start;
		$sqlmain = $this->basesql;
		// $sqlmain = $this->basesql. " WHERE ta.is_posting='1'";

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
				$r->option = '<a href="'.base_url($this->d->_controller.'/'.$this->d->_method.'/detail/'.$r->id_dn).'" class="btn btn-xs btn-warning"><i class="fal fa fa-list"></i></a>';
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

		$sql = "SELECT ta.*, te.jumlah, tc.kode_barang, tc.nama_barang, td.id_po, td.kode_po, tc.kode_satuan_terkecil as kode_satuan, tc.kode_kemasan, tf.id_akun from t_detail_dn ta INNER JOIN t_detail_po tb ON ta.id_detail_po=tb.id_detail_po INNER JOIN v_sub_barang tc on tc.id_sub_barang = tb.id_sub_barang INNER JOIN m_class tf ON tc.id_class=tf.id_class INNER JOIN t_po td ON tb.id_po=td.id_po LEFT JOIN (SELECT id_detail_dn, SUM(jumlah_hbayar) AS jumlah FROM t_hbayar GROUP BY id_detail_dn) te ON ta.id_detail_dn=te.id_detail_dn where ta.deleted_at is null and ta.id_dn = '$invoice'";
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
					// $r->bayar = '<input type="hidden" name="hid[]" value="'.$r->id_detail_dn.'"><input type="hidden" name="hakun[]" value="'.$r->id_akun.'"><input type="text" class="form-control form-control-sm input-mask amount text-right" size="8" name="t_bayar_detail[]" placeholder="0" value="0" data-inputmask="\'alias\': \'currency\', \'prefix\': \'\', \'suffix\': \'\', \'allowMinus\': false" />';
					$r->bayar = '<input type="hidden" name="hid[]" value="'.$r->id_detail_dn.'"><input type="text" class="form-control form-control-sm input-mask amount text-right" size="8" name="t_bayar_detail[]" placeholder="0" value="0" data-inputmask="\'alias\': \'currency\', \'prefix\': \'\', \'suffix\': \'\', \'allowMinus\': false" />';
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
		$sql = $this->basesql." WHERE ta.id_dn ='$id'";
		$res = $this->db->query($sql);
		$row = $res->row();
		return $row;
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
		for($i=0; $i<count($in->t_bayar_detail); $i++){
			if($in->t_bayar_detail[$i]){
				$sisa  = $sisa - $in->t_bayar_detail[$i];
				$bayar = $bayar + $in->t_bayar_detail[$i]; 

				$b = new stdClass();
				$b->tgl_hbayar = $this->nowd;
				$b->id_detail_dn = $in->hid[$i];
				$b->jumlah_hbayar = $in->t_bayar_detail[$i];
				$b->sisa_hbayar = $sisa;
				$this->db->insert('t_hbayar', $b);

				$c = new stdClass();
				$c->id_finance = $finance;
				$c->id_akun = $in->t_finance_detail[$i];
				$c->trans_description = $in->hinvoice . ' ' . $in->vendor . ' (' . $this->nowd . ')';
				$c->description = $in->hinvoice . ' ' . $in->vendor . ' (' . $this->nowd . ')';
				$c->created_at = $this->nowdt;
				$c->jumlah_rp = $in->t_bayar_detail[$i];
				$c->amount = $in->t_bayar_detail[$i];
				$this->db->insert('t_finance_detail', $c);
			}
		}

		$d = new stdClass();
		$d->id_finance = $finance;
		$d->id_akun = $in->hakun;
		$d->trans_description = $in->hinvoice . ' ' . $in->vendor . ' (' . $this->nowd . ')';
		$d->description = $in->hinvoice . ' ' . $in->vendor . ' (' . $this->nowd . ')';
		$d->created_at = $this->nowdt;
		$d->jumlah_rp = array_sum($in->t_bayar_detail);
		$d->amount = (-1) * array_sum($in->t_bayar_detail);
		$this->db->insert('t_finance_detail', $d);

		// $e = new stdClass();
        // $e->jumlah_rp = $bayar;
        // $this->db->where('id_finance', $finance);
		// $this->db->update('t_finance_detail', $e);
    }
}
