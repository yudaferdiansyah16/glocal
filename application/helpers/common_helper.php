<?php
function api_url($uri){
    //return "http://localhost/eja/api/".$uri;
    return "http://smartone.smartnusantara.id:8192/".$uri;
}

function assets_url($uri=""){
    return base_url('assets/'.$uri);
}

function js_url($controller, $method, $action){
    $p = getcwd().'/assets/app/'.$controller.'/'.$method.'/'.$action.'.js';
    if(file_exists($p)){
        echo '<script src="'.base_url().'assets/app/'.$controller.'/'.$method.'/'.$action.'.js?_m='.uniqid().'" type="text/javascript"></script>';
    }
}

function modal_url($v){
    $p = getcwd().'/assets/modal/'.$v.'.js';
    if(file_exists($p)){
        echo '<script src="'.base_url().'assets/modal/'.$v.'.js?_m='.uniqid().'" type="text/javascript"></script>';
    }
}

function a2o($v){
    return (object) $v;
}

function getSession($app){
    $a = new stdClass();
    $a->_id = $app->session->userdata('so_uid');
    $a->_name = $app->session->userdata('so_unama');
    $a->_uname = $app->session->userdata('so_uname');
    $a->_app_id = $app->session->userdata('so_uapps');
    $a->_app_level = $app->session->userdata('so_uaccess');
    return $a;
}

function getPostAsObject($app) {
    $post = $app->input->post();
    $a = new stdClass();
    foreach ($post as $key => $val){
        $a->{$key} = $app->db->escape_str($app->input->post($key, TRUE));
    }
    return $a;
}

function getPostAsArray($app) {
    $post = $app->input->post();
    $a = array();
    foreach ($post as $key => $val){
        $a[$key] = $app->db->escape_str($app->input->post($key, TRUE));
    }
    return $a;
}

function printJSON($v){
    header('Access-Control-Allow-Origin: *');
    header("Content-type: application/json");
    echo json_encode($v, JSON_PRETTY_PRINT);
    exit;
}

function doGet($uri){
    $token = 'foEX2rMPqTiS4VDQDwkxUrd97sPq25GH';
    try{
        $options = array(
            'verify' => false
        );

        $headers = array(
            'x-token'=> $token
        );

        $url = api_url($uri);
        $res = Requests::get($url, $headers, $options);
        $data = json_decode($res->body);
        return $data;
    } catch (Exception $e){
        $s = new stdClass();
        $s->status = false;
        $s->message = $e;
        return $s;
    }
}

function doPost($uri, $parameter){
    $token = 'foEX2rMPqTiS4VDQDwkxUrd97sPq25GH';
    try{
        $options = array(
            'verify' => false
        );

        $headers = array(
            'x-token' => $token
        );

        $url = api_url($uri);
        $res = Requests::post($url, $headers, (array) $parameter, $options);
        $data = json_decode($res->body);
        return $data;
    } catch (Exception $e){
        $s = new stdClass();
        $s->status = false;
        $s->message = $e;
        return $s;
    }
}

function doJSON($app, $uri, $parameter){
    $cid = $app->config->item('clientID');
    try{
        $options = array(
            'verify' => false
        );

        $headers = array(
            'Content-Type' => 'application/json'
        );

        $url = api_url($uri."/".$cid);
        $res = Requests::post($url, $headers, json_encode($parameter), $options);
        $data = json_decode($res->body);
        return $data;
    } catch (Exception $e){
        $s = new stdClass();
        $s->status = false;
        $s->message = $e;
        return $s;
    }
}

function sendTPB($app, $table, $tipe, $id){
    if(in_array($tipe, array('insert','update'))){
        $sql = "select * from $table where ID=$id";
        $res = $app->db->query($sql);
        $row = $res->row();
    } else {
        $row = new stdClass();
        $row->ID = $id;
    }

    $o = new stdClass();
    $o->table = $table;
    $o->type = $tipe;
    $o->record = $row;
    doJSON($app, 'totpb', $o);
}

function getNotification($app)
{
    $m = $app->session->flashdata('alert');
    if(empty($m)) $h = '<script type="text/javascript">var _alert = null;</script>';
    else $h = '<script type="text/javascript">var _alert = '.json_encode($m).';</script>';
    return $h;
}

function setNotification($app, $o)
{
    $app->session->set_flashdata('alert', $o);
}

function reverseDate($v)
{
    if(!empty($v)){
        $a = explode('-',$v);
        return $a[2].'-'.$a[1].'-'.$a[0];
    } else return '-';
}

function bln($a){
    if($a=="01") $bln = "Januari";
    elseif($a=="02") $bln = "Februari";
    elseif($a=="03") $bln = "Maret";
    elseif($a=="04") $bln = "April";
    elseif($a=="05") $bln = "Mei";
    elseif($a=="06") $bln = "Juni";
    elseif($a=="07") $bln = "Juli";
    elseif($a=="08") $bln = "Agustus";
    elseif($a=="09") $bln = "September";
    elseif($a=="10") $bln = "Oktober";
    elseif($a=="11") $bln = "November";
    elseif($a=="12") $bln = "Desember";

    return $bln;
}

function toMoney($v="", $tail=false)
{
    if(empty($v)) return 0;
    else {
        if(hasDecimal($v)) return number_format($v,2,',','.');
        else {
            if($tail) return number_format($v,0,',','.').",-";
            else return number_format($v,0,',','.');
        }
    }
}

function hasDecimal($v){
    if(fmod($v, 1) !== 0.00){
        // your code if its decimals has a value
        return true;
    } else {
        // your code if the decimals are .00, or is an integer
        return false;
    }
}

function createOption($data, $key, $val, $separator, $value=""){
    $h = '';
    foreach ($data as $r){
        $v = '';
        $max = count($val);
        if($val>1){
            for($i=0;$i<$max;$i++){
                if($i>0) $v .= $separator;
                $v .= $r->{$val[$i]};
            }
        } else $v = $val[0];
        $selected = '';

        if((!empty($value) or $value==0) and $r->{$key} == $value) $selected = ' selected';

        $h .= '<option value="'.$r->{$key}.'"'.$selected.'>'.$v.'</option>';
    }
    return $h;
}

function modelLoad($app, $modelList)
{
    foreach ($modelList as $r){
        $app->load->model($r);
    }
}

function insertModal($modalname){
	include(APPPATH.'views/modal/'.$modalname.'.php');
}

function getAppSetting($app){
    $res = $app->db->query("select * from m_sbu where deleted_at is null limit 1");
    $data = array();
    foreach ($res->result() as $r){
        $data = $r;
    }
    $app = a2o($data);
    return $app;
}

function integerToRoman($integer){
    $integer = intval($integer);
    $result = '';
 
    $lookup = array('M' => 1000,
    'CM' => 900,
    'D' => 500,
    'CD' => 400,
    'C' => 100,
    'XC' => 90,
    'L' => 50,
    'XL' => 40,
    'X' => 10,
    'IX' => 9,
    'V' => 5,
    'IV' => 4,
    'I' => 1);
    
    foreach($lookup as $roman => $value){
        $matches = intval($integer/$value);
        $result .= str_repeat($roman,$matches);
        $integer = $integer % $value;
    }
    return $result;
}

function placeValue($data, $key){
    $v = isset($data->{$key}) ? $data->{$key} : '';
    return $v;
}

function sterilizeJSON($v){
    $a = str_replace("\t","",$v);
    $b = str_replace("\n","",$a);
    $c = str_replace("\'","'",$b);
    //$d = str_replace('\"','"',$c);

    return $c;
}

function filterObject($data, $datacheck, $instance){
	$datacheck = a2o($datacheck);
	foreach ($data as $row) {
		$row = a2o($row);
		if ($row->{$instance}=='' || $row->{$instance}==null) return false;
		if ($row->{$instance}==$datacheck->{$instance}) return false;
	}
	return true;
}

function sortObject($data){
	$arrayObject = new ArrayObject($data);
	$arrayObject->ksort();

	$return = new stdClass();
	foreach ($arrayObject as $key => $val) {
		$return->{$key} = $val;
	}

	return $return;
}

function getdbtpb($app){
    return $app->config->item('db_tpb');
}

function getdbpeb($app){
    return $app->config->item('db_peb');
}

function loadLanguage($app, $controller, $method) {
	$app->lang->load('button', $app->session->userdata('lang_code'));
	if (file_exists('application/language/'.$app->session->userdata('lang_code').'/' . $controller."/".$method."_lang.php")) $app->lang->load($controller."/".$method, $app->session->userdata('lang_code'));
}

function generateBreadcrumb($string) {
	$arrstring = explode('|', $string);
	$textBreadcrumb = "<ol class='breadcrumb page-breadcrumb'>";
	foreach ($arrstring as $i => $item) {
		if ($i < count($arrstring) - 1) {
			$textBreadcrumb .= "<li class='breadcrumb-item'>$item</li>";
		} else {
			$textBreadcrumb .= "<li class='breadcrumb-item active'>$item</li>";
		}
	}
	$textBreadcrumb .= "<li class='position-absolute pos-top pos-right d-none d-sm-block'><span class='js-get-date'></span></li>";
	$textBreadcrumb .= "</ol>";
	return $textBreadcrumb;
}
