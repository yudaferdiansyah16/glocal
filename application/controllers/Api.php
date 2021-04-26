<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    function send()
    {
        $url = 'https://api.github.com/some/endpoint';
        $headers = array('Content-Type' => 'application/json');
        $data = array('some' => 'data');
        $response = Requests::post($url, $headers, json_encode($data));

        curl_init();
    }

    function keepSession()
    {
        printJSON(1);
    }

    function terima(){
        $in = a2o($this->input->post());
        $tpb = a2o($in->tpb_barang);
        $i = 1;
        foreach ($tpb as $r){
            echo $i."<br>";
            $i++;
        }
    }
    function simulasi()
    {
        $this->load->view('template_simulasi');

    }

    function ujitpb()
    {
        $sql = "select * from tpb_header where ID=11502";
        $res = $this->db->query($sql);
        $row = $res->row();

        $o = new stdClass();
        $o->table = 'tpb_header';
        $o->type = 'insert';
        $o->record = $row;
        doJSON($this, 'totpb', $o);
    }

    function updateRates()
    {
        try {
            $headers = array();

            $options = array(
                'verify' => false,
                'timeout' => 30
            );

            $params = array("tglKurs" => date('d-m-Y'), "content" => 'browseKurs');

            $url = 'https://www.beacukai.go.id/kurs.html';
            $res = Requests::post($url, $headers, $params, $options);
            $html = $res->body;

            $dom = new Dom;
            $dom->loadStr($html);

            $a = $dom->find('div.panel-body > p > strong');
            $b = $a->toArray()[0];
            $range = $b->innerHtml;
            list($start,$end) = explode(' s.d ', $range);

            if(date('Y-m-d')>$end){
                /* Kurs Value */
                $tables = $dom->find('table');
                foreach ($tables as $table){
                    $converter = HtmlTableConverter\HtmlTableConverterFactory::fromHtml($table);
                    foreach ($converter->convert() as $r){
                        if(count($r)>0){
                            $a = new stdClass();
                            $valuta = explode(' ',$r['col0'])[1];
                            $a->kode_valuta = $valuta;
                            if($valuta == 'IDR') $rates = 1;
                            else $rates = str_replace(',','.',str_replace('.','',$r['col3']));
                            $a->rates_jual = $rates;
                            $a->rates_beli = $rates;
                            $a->created_at = date('Y-m-d H:i:s');
                            $this->db->insert('m_rates', $a);
                        }
                    }
                }
                /**/
            }
        } catch (Requests_Exception $e){
            $s = new stdClass();
            $s->success = false;
            $s->message = "Tidak dapat terhubung dengan Kurs Pajak.";
        }
    }
}