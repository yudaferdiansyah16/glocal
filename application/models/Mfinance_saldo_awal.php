<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mfinance_saldo_awal extends CI_Model
{
    var $table = 'm_akun';
    var $table_id = 'id_akun';
    var $nowdt, $nowd, $nowt, $basesql;

    function __construct()
    {
        parent::__construct();
        $this->nowdt = date('Y-m-d H:i:s');
        $this->nowd = date('Y-m-d');
        $this->nowt = date('H:i:s');
        $this->basesql = "select ta.*, ifnull(te.jumlah_rp,0) as jumlah_rp, te.id_finance, te.id_finance_detail, te.no_trans, tb.nama_tipe_akun, tc.sub_group_type, tc.group_type, tc.balance_type, td.nama_jenis_laporan_keuangan from $this->table ta left join m_tipe_akun tb on ta.id_tipe_akun = tb.id_tipe_akun left join m_grup_akun tc on tb.id_grup_akun = tc.id_grup_akun left join m_jenis_laporan_keuangan td on tc.id_jenis_laporan_keuangan = td.id_jenis_laporan_keuangan left join (select t_finance_detail.id_akun, t_finance.id_finance, t_finance.no_trans, t_finance_detail.jumlah_rp, t_finance_detail.id_finance_detail from t_finance_detail inner join t_finance on t_finance_detail.id_finance=t_finance.id_finance where t_finance.no_trans='JVAWAL') te on te.id_akun=ta.id_akun";
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

    function getSelect($search)
    {
        $this->db->select('*');
        $this->db->limit(10);
        $this->db->from($this->table);
        $this->db->like('nama_akun', $search);
        $res = $this->db->get()->result_array();

        $data = array();
        foreach ($res as $r) {
            $text = '[' . $r['kode_akun'] . '] ' . $r['nama_akun'];
            $data[] = array(
                "id" => $r['id_akun'],
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

                // $st_checked = '';
                // if ($r->id_status) $st_checked = 'checked';
                // $r->status_trans = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="switch' . $i . '" data-url="' . base_url('master/' . $this->d->_method . '/changeStatus') . '" data-id="' . $r->{$this->table_id} . '" data-key="' . $this->table_id . '" data-status="id_status" onclick="changeStatus(this)" ' . $st_checked . '><label class="custom-control-label" for="switch' . $i . '"></label></div>';

                if ($opt) {
                    $r->option = '<a href="' . base_url($this->d->_controller . '/' . $this->d->_method . '/edit/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
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

    function getAll()
    {
        $sql = $this->basesql;
        $res = $this->db->query($sql);
        $row = $res->result();
        return $row;
    }

    function get($id)
    {
        $sql = $this->basesql . " and $this->table_id = '$id'";
        $res = $this->db->query($sql);
        $row = $res->row();
        return $row;
    }

    function check()
    {
        $sql = "select count(*) as trans from t_finance where no_trans = 'JVAWAL'";
        $res = $this->db->query($sql);
        $row = $res->row();
        return $row;
    }

    function create($in)
    {
        $count_jumlah = count($in->jumlah_rp);
        $items = array(
            'no_trans' => 'JVAWAL',
            'tgl_trans' => reverseDate($in->tgl_trans),
            'id_status' => $in->id_status,
            'approval_1' => $in->approval_1,
            'approval_2' => $in->approval_2,
            'id_user_approval_1' => $in->id_user_approval_1,
            'id_user_approval_2' => $in->id_user_approval_2,
            'closing' => 0,
            'created_at' => $this->nowdt,
            'updated_at' => $this->nowdt,
        );
        $this->db->insert('t_finance', $items);

        $finance_id = $this->db->insert_id();

        for ($x = 0; $x < $count_jumlah; $x++) {
            $items_detail = array(
                'id_finance' => $finance_id,
                'id_akun' => $in->id_akun[$x],
                'description' => 'Saldo Awal ' . reverseDate($in->tgl_trans),
                'jumlah_rp' => $in->jumlah_rp[$x],
                'amount' => $in->jumlah_rp[$x],
                'created_at' => $this->nowdt,
                'updated_at' => $this->nowdt,
            );

            $this->db->insert('t_finance_detail', $items_detail);
        }
        return $finance_id;
    }

    function update($in)
    {
        $count_jumlah = count($in->jumlah_rp);
        $items = array(
            'tgl_trans' => reverseDate($in->tgl_trans),
            'id_status' => $in->id_status,
            'approval_1' => $in->approval_1,
            'approval_2' => $in->approval_2,
            'id_user_approval_1' => $in->id_user_approval_1,
            'id_user_approval_2' => $in->id_user_approval_2,
            'closing' => 0,
            'updated_at' => $this->nowdt,
        );
        $this->db->where('id_finance', $in->id_finance);
        $this->db->update('t_finance', $items);

        $this->db->where('id_finance', $in->id_finance);
        $this->db->delete('t_finance_detail');

        for ($x = 0; $x < $count_jumlah; $x++) {
            $items_detail = array(
                'id_finance' => $in->id_finance,
                'id_akun' => $in->id_akun[$x],
                'description' => 'Saldo Awal ' . reverseDate($in->tgl_trans),
                'jumlah_rp' => $in->jumlah_rp[$x],
                'amount' => $in->jumlah_rp[$x],
                'created_at' => $this->nowdt,
                'updated_at' => $this->nowdt,
            );

            $this->db->insert('t_finance_detail', $items_detail);
        }
        return true;
    }

    function delete($id)
    {
        $b = new stdClass();
        $b->deleted_at = $this->nowdt;
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $b);
    }
}
