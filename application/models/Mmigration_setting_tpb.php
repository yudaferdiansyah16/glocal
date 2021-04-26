<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mmigration_setting_tpb extends CI_Model
{
    var $table = 'setting_tpb';
    var $table_id = 'id';
    var $nowdt, $nowd, $nowt, $basesql;

    function __construct()
    {
        parent::__construct();
        $this->nowdt = date('Y-m-d H:i:s');
        $this->nowd = date('Y-m-d');
        $this->nowt = date('H:i:s');
        $this->basesql = "select * from $this->table limit 1";
    }

    function view()
    {
        $sql = $this->basesql;
        $res = $this->db->query($sql);
        $row = $res->row();
        return $row;
    }

    function update($in)
    {
        $this->db->where($this->table_id, $in->{$this->table_id});
        $this->db->update($this->table, $in);
    }
}
