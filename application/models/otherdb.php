<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class otherdb extends CI_Model {
 // db2 digunakan untuk mengakses database ke-2
 private $db2;

 public function __construct()
 {
  parent::__construct();
         $this->db2 = $this->load->database('tpbdb', TRUE);
 }
 public function get_db1()
 {
  return $this->db->get('smart_dps1');
 }
 public function get_db2()
 {
  return $this->db2->get('tpbdb');
 }
} 