<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mm_module extends CI_Model
{
	var $table = 'm_modul';
	var $table_id = 'id_modul';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "select b.nama_modul_en as nama_modul_parent, a.* from $this->table a left join $this->table b on a.id_modul_parent=b.id_modul where a.deleted_at is null";
	}

	function view()
	{
		$sql = "WITH RECURSIVE cte AS ( SELECT id_modul, nama_modul_en, icon_class, url, order_menu, 1 AS depth, CAST( LPAD( order_menu, 3, '0' ) AS CHAR ( 255 )) AS path FROM m_modul WHERE id_modul_parent = '0' UNION ALL SELECT c.id_modul, c.nama_modul_en, c.icon_class, c.url, c.order_menu, cte.depth + 1, CONCAT( cte.path, \",\", LPAD( c.order_menu, 3, '0' ) ) FROM m_modul c JOIN cte ON cte.id_modul = c.id_modul_parent ) SELECT * FROM cte ORDER BY path";
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
		$sqlmain = "WITH RECURSIVE cte AS ( SELECT id_modul, nama_modul_en, icon_class, url, order_menu, 1 AS depth, CAST( LPAD(order_menu, 2, '0') AS CHAR ( 255 )) AS path, id_status FROM m_modul WHERE id_modul_parent = '0' UNION ALL SELECT c.id_modul, c.nama_modul_en, c.icon_class, c.url, c.order_menu, cte.depth + 1, CONCAT( cte.path, \",\", LPAD(c.order_menu, 2, '0') ), c.id_status FROM m_modul c JOIN cte ON cte.id_modul = c.id_modul_parent ) SELECT * FROM cte";
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

				if ($opt) {
					$r->option = '<a href="' . base_url($this->d->_controller . '/' . $this->d->_method . '/edit/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-success"><i class="fal fa fa-edit"></i></a> ';
//					$r->option .= '<a href="javascript://" onclick="confirmDialog(this)" data-header="Confirm Delete" data-body="Do you want to delete this data?" data-url="' . base_url($this->d->_controller . '/' . $this->d->_method . '/delete/' . $r->{$this->table_id}) . '" class="btn btn-xs btn-danger"><i class="fal fa fa-trash"></i></a>';
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
		$sql = $this->basesql . " and a.$this->table_id = '$id'";
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
