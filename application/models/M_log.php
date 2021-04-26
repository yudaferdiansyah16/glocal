<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class M_log extends CI_Model {
 
    public function save_log($param)
    {
        $sql = $this->db->insert_string('h_log',$param);
        $ex  = $this->db->query($sql);
        return $this->db->affected_rows($sql);
    }

    function view($in)
    {
        $sbu = getAppSetting($this)->nama_sbu;
        $sql = "SELECT * FROM h_log WHERE log_aktivitas != '-' AND log_time LIKE '$in->tglawal%' AND sbu = '$sbu' ORDER BY log_time DESC";
        $res = $this->db->query($sql);

        $data = array();
        foreach ($res->result() as $r) {
            $data[] = $r;
        }

        return $data;
    }

    function reset($in)
    {
        $sbu = getAppSetting($this)->nama_sbu;
        $sql = "DELETE from h_log WHERE log_time LIKE '$in->tahun%' AND sbu = '$sbu'";
        $this->db->query($sql);
    }
  
}