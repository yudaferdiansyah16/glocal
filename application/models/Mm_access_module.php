<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mm_access_module extends CI_Model
{
	var $table = 't_priv_modul';
	var $table_id = 'id_priv_modul';
	var $nowdt, $nowd, $nowt, $basesql;

	function __construct()
	{
		parent::__construct();
		$this->nowdt = date('Y-m-d H:i:s');
		$this->nowd = date('Y-m-d');
		$this->nowt = date('H:i:s');
		$this->basesql = "select pm.id_priv_modul, pm.id_priv, p.nama_priv, group_concat(m.nama_modul_in separator ', ') modul_in, group_concat(m.nama_modul_en separator ', ') modul_en from m_priv p inner join t_priv_modul pm on p.id_priv = pm.id_priv inner join m_modul m on pm.id_modul = m.id_modul where pm.deleted_at is null group by p.id_priv";
	}

	function viewDTP($in, $opt = true)
	{
		$start = $in->start;
		$sqlmain = $this->basesql;
		$sql = "select * from m_priv where deleted_at is null";
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

	function viewDTM($in, $opt = true)
	{
		$priv = $in->priv;
		$start = $in->start;
		$sqlmain = "SELECT a.*, b.id_priv, b.modul_actions FROM ( WITH RECURSIVE cte AS ( SELECT id_modul, nama_modul_id, nama_modul_en, icon_class, url, order_menu, 1 AS depth, CAST( order_menu AS CHAR ( 200 )) AS path FROM m_modul WHERE id_modul_parent = '0' UNION ALL SELECT c.id_modul, c.nama_modul_id, c.nama_modul_en, c.icon_class, c.url, c.order_menu, cte.depth + 1, CONCAT( cte.path, \",\", c.order_menu ) FROM m_modul c JOIN cte ON cte.id_modul = c.id_modul_parent ) SELECT * FROM cte ORDER BY path ) a LEFT JOIN ( SELECT id_modul, id_priv, max( modul_actions ) AS modul_actions FROM t_priv_modul GROUP BY id_modul, id_priv ) b ON b.id_modul = a.id_modul and b.id_priv = '$priv'";
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

		$sqlm = "select * from m_modul_action";
		$resm = $this->db->query($sqlm);

		$data = array();
		if ($num > 0) {
			$i = $start + 1;
			foreach ($res->result() as $r) {
				$r->no = $i;

				if ($opt) {
					$r->option = "";
					$r->option .= "
						<input type='hidden' name='modul[$i][id_priv]' value='$priv'>
						<input type='hidden' name='modul[$i][path]' value='$r->path'>
						<input type='hidden' name='modul[$i][id_modul]' value='$r->id_modul'>
					";
					if (!empty($r->modul_actions)) {
						$action = json_decode($r->modul_actions);
					} else {
						$action = [];
					}
					foreach ($resm->result() as $rm) {
						$st_checked = '';
						if(in_array($rm->url_modul_action, $action)) $st_checked = 'checked';
						$r->{'action_'.$rm->url_modul_action} = "
							<input type='checkbox' $st_checked name='modul[$i][modul_actions][]' value='$rm->url_modul_action'>
						";
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

	public function update($priv, $modul, $value = array()){
        if(count($value) > 0){
			$res = $this->db->query("SELECT * FROM $this->table where id_modul = '$modul' and id_priv = '$priv'");
			$row = $res->row();
			if (empty($row)) {
				$in = new stdClass();
				$in->id_priv = $priv;
				$in->id_modul = $modul;
				$in->modul_actions = json_encode($value);
				$in->created_at = $this->nowdt;
				$in->updated_at = $this->nowdt;
				$this->db->insert($this->table, $in);
			} else {
				$in = new stdClass();
				$in->modul_actions = json_encode($value);
				$in->updated_at = $this->nowdt;
				$this->db->where('id_priv', $priv)->where('id_modul', $modul)->update($this->table, $in);
			}
		} else if (count($value) == 0) {
			$this->db->delete($this->table, "id_priv = $priv AND id_modul = $modul");
		} else {
			return false;
		}
	}

	function deleteWhere($arrClause)
	{
		$this->db->delete($this->table, $arrClause);
	}
}
