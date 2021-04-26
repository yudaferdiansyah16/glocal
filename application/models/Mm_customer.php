<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mm_customer extends CI_Model
{
    var $table = 'm_customer_suplier';
    var $table_id = 'id_customer';
    var $nowdt, $nowd, $nowt, $basesql;

    function __construct()
    {
        parent::__construct();
        $this->nowdt = date('Y-m-d H:i:s');
        $this->nowd = date('Y-m-d');
        $this->nowt = date('H:i:s');
        $this->basesql = "select ta.*,tb.kode_akun,tb.nama_akun,tc.URAIAN_NEGARA as uraian_negara from m_customer_suplier ta left join m_akun tb on ta.id_akun = tb.id_akun left join ".getdbtpb($this).".referensi_negara tc on ta.kode_negara = tc.KODE_NEGARA ";
    }

    function view()
    {
        $sql = $this->basesql;
        $res = $this->db->query($sql);

        $data = array();
        foreach ($res->result() as $r) {
            $data[] = $r;
        }

        return $data;
    }

	function select2()
	{
		$q = strtolower($this->input->get('q'));
		if(!empty($q)){
			$sql = $this->basesql." and LOWER(ta.nama) LIKE '%$q%' ORDER BY ta.nama";
		} else  $sql = $this->basesql;
		$res = $this->db->query($sql);

		$data = array();
		foreach ($res->result() as $r){
			$data[] = array(
				'id_customer' => $r->id_customer,
				'kode_customer' => $r->kode_customer,
				'nama' => $r->nama,
				'alamat' => $r->alamat,
				'uraian_negara' => $r->uraian_negara
			);
		}

		return $data;
    }
    
    function getSelect($search)
    {
        $this->db->select('*');
        $this->db->limit(10);
        $this->db->from($this->table);
        $this->db->like('nama', $search);
        $res = $this->db->get()->result_array();

        $data = array();
        foreach ($res as $r) {
            $text = $r['nama'] . ' [ ' . $r['alamat']. ' ] ';
            $data[] = array(
                "id" => $r['id_customer'],
                "text" => $text
            );
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
        if ($num > 0) {
            $i = $start + 1;
            foreach ($res->result() as $r) {
                $r->no = $i;
                $r->npwp = $r->npwp > 0 ? $r->npwp : '';
                if ($r->beneficiary == 1) {
                    $r->beneficiary = "<button class='btn btn-xs btn-primary'><i class='fal fa-check'></i></button>";
                } else {
                    $r->beneficiary = "<button class='btn btn-xs btn-secondary'><i class='fal fa-times'></i></button>";
                }

                $st_checked = '';
                if ($r->beneficiary == 1) $st_checked = 'checked';
                $r->beneficiary = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="switch' . $i . '" data-url="' . base_url('master/' . $this->d->_method . '/changeStatus') . '" data-id="' . $r->{$this->table_id} . '" data-key="' . $this->table_id . '" data-status="id_customer" onclick="changeStatus(this)" ' . $st_checked . '><label class="custom-control-label" for="switch' . $i . '"></label></div>';

                if ($opt) {
                    $r->option = '<a href="' . base_url($this->d->_controller . '/' . $this->d->_method . '/edit/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
                    $r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="' . base_url($this->d->_controller . '/' . $this->d->_method . '/delete/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
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
        $sql = $this->basesql . " and $this->table_id = '$id'";
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

    function generateCode($nama)
    {
        $nama = substr($nama, 0, 1);
        $kode = 'CUS.' . $nama;
        $sql = "SELECT (cast(right(kode_customer,3) as unsigned )+1) as urutan FROM m_customer_suplier WHERE kode_customer LIKE '$kode%' ORDER BY kode_customer DESC LIMIT 1";
        $res = $this->db->query($sql);
        $num = $res->num_rows();
        $result = $res->row();
        if ($num > 0) {
            $last = $result->urutan;
        } else {
            $last = 1;
        }
        $code = $kode . str_pad($last, 3, '0', STR_PAD_LEFT);
        return $code;
    }
}
