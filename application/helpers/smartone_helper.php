<?php

function generateMenu($menu, $c="", $p=""){
    if(!empty($c)){
        $aa = substr($c,0,2);
        $apl = array(
            'ga'=>'HRD',
            'pp'=>'PPIC',
            'mt'=>'MARKETING',
            'wh'=>'WAREHOUSE',
            'sc'=>'SUPPLY CHAIN',
            'ex'=>'EXIM',
            'rn'=>'RND',
            'qa'=>'QA',
            'fn'=>'FINANCE',
        );
        $appxo = $apl[$aa];
    } else $appxo = '';
    $h = '';
    $i=1;
    $app = '';
    $single = 0;
    $switch = 0;
    foreach ($menu as $r){
        if(isset($r->apps)){
            $appx = preg_replace('/\s+/', '', $r->apps);
            $collapsed = 'collapsed '; $extended = 'false'; $height = 'style="height: 0px;"'; $hin = '';
            if($appx==$appxo) {
                $collapsed = '';
                $extended = 'true';
                $height = 'style';
                $hin = ' in';
            }
            if($i==1){
                $app = $r->apps;
                //$h .= '<li style="height:30px; padding-top:12px" class="text-center header-sub">'.$r->apps.'</li>'."\n";
                $h .= '<div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$appx.'" aria-expanded="'.$extended.'" class="'.$collapsed.'nav-title"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> '.$r->apps.' </a></h4></div><div id="collapse'.$appx.'" class="panel-collapse collapse'.$hin.'" aria-expanded="'.$extended.'" '.$height.'><div class="panel-body no-padding nav-list"><ul>';
            } else {
                if($r->apps != $app){
                    $app = $r->apps;
                    $switch = 1;
                    if(!$single) $h .= '</ul></li></ul>'."\n";
                    //$h .= '<li style="color:white; height:30px; padding-top:12px" class="text-center header-sub">'.$r->apps.'</li>'."\n";
                    $h .= '</div></div></div><div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$appx.'" class="'.$collapsed.'nav-title" aria-expanded="'.$extended.'"> <i class="fa fa-lg fa-angle-down pull-right"></i> <i class="fa fa-lg fa-angle-up pull-right"></i> '.$r->apps.' </a></h4></div><div id="collapse'.$appx.'" class="panel-collapse collapse'.$hin.'" aria-expanded="'.$extended.'" '.$height.'><div class="panel-body no-padding nav-list"><ul>';
                }
            }
        }

        $open = ''; $display= 'none'; $active = '';
        if($c==$r->controller) {
            $open = ' class="open"';
            $display = 'block';
            if($p==$r->method){
                $active = ' class="active"';
            }
        }

        if($r->parent==0){
            if($i>1 and $single==0 and $switch==0) $h .= '</ul></li>'."\n";
            $switch = 0;

            if($r->tipe==1){
                $single = 0;
                $h .= '<li'.$open.'>'."\n";
                $h .= '<a href="#"><i class="'.$r->icon.'"></i> &nbsp;&nbsp;<span class="menu-item-parent">'.$r->nmenu.'</span></a>'."\n";
                $h .= '<ul style="display: '.$display.'">'."\n";
            } else {
                $single = 1;
                $h .= '<li'.$active.'><a href="'.base_url().$r->controller.'/'.$r->method.'"><i class="'.$r->icon.'"></i> &nbsp;&nbsp;'.$r->nmenu.'</a></li>'."\n";
            }
        } else {
            $single = 0;
            $h .= '<li'.$active.'><a href="'.base_url().$r->controller.'/'.$r->method.'">'.$r->nmenu.'</a></li>'."\n";
        }
        $i++;
    }
    return $h;
}

function checkRequest($v){
    if($v>0) return true;
    else return false;
}

function checkApproval($v){
    if($v>0) return true;
    else return false;
}

function checkAdd($v){
    if(in_array($v, array(1,2,4))) return true;
    else return false;
}

function checkUpdate($v){
    if(in_array($v, array(1,2,3))) return true;
    else return false;
}

function getclientID($app){
    return $app->config->item('clientID');
}

function getDBSmartOld($app){
	return $app->config->item('db_smartold');
}

function updateRateBC($app, $date = null){
	$post = array(
		"tglKurs" => !empty($date) ? date('d-m-Y', strtotime($date)) : date('d-m-Y'),
		"content" => 'browseKurs'
	);
	$fields_string = '';
	foreach($post as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');
	$ch = curl_init('https://www.beacukai.go.id/kurs.html');
	curl_setopt($ch, CURLOPT_POST, $post);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	$dom = new DOMDocument();
	$dom->loadHTML($response);
	$array = array();
	foreach($dom->getElementsByTagName('tr') as $tr) {
		$row = $tr->nodeValue;
		$exp = explode("Rp",$row);
		if (str_replace("1 ","",$exp[0]) != "IDR") {
			$in = new stdClass();
			$in->kode_valuta = str_replace("1 ","",$exp[0]);
			$in->rates_jual = floatval(str_replace(".","",$exp[1]));
			$in->rates_beli = floatval(str_replace(".","",$exp[1]));
			$in->created_at = date("Y-m-d h:i:s");
			$array[] = $in;
			unset($in);
		} else {
			$in = new stdClass();
			$in->kode_valuta = str_replace("1 ","",$exp[0]);
			$in->rates_jual = 1;
			$in->rates_beli = 1;
			$in->created_at = date("Y-m-d h:i:s");
			$array[] = $in;
			unset($in);
		}
	}
	$app->db->trans_start();
	modelLoad($app,array('mm_rates'));
	foreach ($array as $input) {
		$resrate = $app->db->query("SELECT * FROM m_rates where DATE(created_at) = '".date('Y-m-d', strtotime($input->created_at))."' and kode_valuta = '$input->kode_valuta' limit 1");
		if ($resrate->num_rows() == 0) {
			$id_rates = $app->mm_rates->create($input);
		}
	}
	$app->db->trans_complete();
	$status = $app->db->trans_status();
	$s = new stdClass();
	if ($status) {
		$s->status = true;
		$s->message = 'Update Kurs Berhasil';
	} else {
		$s->status = false;
		$s->message = 'Update Kurs Gagal';
	}
	return $s;
}

function getresponse($id)
{
	$config['hostname'] = '103.82.240.141';
	$config['username'] = 'itone';
	$config['password'] = 'itlinasone';
	$config['database'] = 'tpbdb';
	$config['dbdriver'] = "mysqli";
	$config['dbprefix'] = "";
	$config['pconnect'] = FALSE;
	$config['db_debug'] = (ENVIRONMENT !== 'production');
	$config['cache_on'] = FALSE;
	$config['cachedir'] = "";
	$config['char_set'] = "utf8";
	$config['dbcollat'] = "utf8_general_ci";
	$config['swap_pre'] = '';
	$config['encrypt'] = FALSE;
	$config['compress'] = FALSE;
	$config['stricton'] = FALSE;
	$config['failover'] = array();
	$config['save_queries'] = TRUE;

	$dbtpb = $this->load->database($config, TRUE);
	
	$sqlheader = "select NOMOR_DAFTAR from tpb_header where ID = '$id'";
	$resheader = $dbtpb->query($sqlheader);
	$header = $resheader->row();

	if (($header->NOMOR_DAFTAR == '' || $header->NOMOR_DAFTAR == null)) {
		return false;
	} else {
		$sqldetil_status = "select * from tpb_detil_status where ID_HEADER = '$id'";
		$resdetil_status = $dbtpb->query($sqldetil_status);
		$detil_status = array();
		foreach ($resdetil_status->result() as $r){
			$detil_status[] = $r;
		}
		$countdetil_status = count($detil_status);

		$sqlrespon = "select * from tpb_respon where ID_HEADER = '$id'";
		$resrespon = $dbtpb->query($sqlrespon);
		$respon = array();
		foreach ($resrespon->result() as $r){
			$respon[] = $r;
		}
		$countrespon = count($respon);

		$this->db->where('ID', $id);
		$this->db->update(getdbtpb($this).'.tpb_header', $header);

		if ($countdetil_status>0) {
			foreach ($detil_status as $row) {
				$this->db->where('ID_HEADER', $id);
				$this->db->update(getdbtpb($this).'.tpb_detil_status', $row);
			}
		}

		if ($countrespon>0) {
			foreach ($respon as $row) {
				$this->db->where('ID_HEADER', $id);
				$this->db->update(getdbtpb($this).'.tpb_respon', $row);
			}
		}

		return true;
	}
}

function isAuthorized($app, $action) {
	$moduls = $app->session->userdata('user_moduls');
	$isFound = false;
	foreach ($moduls as $item) {
		$arrurl = explode('/', $item['modul_url']);
		if ($app->d->_controller == $arrurl[0] && $app->d->_method == (isset($arrurl[1]) ? $arrurl[1] : '')) {
			$actions = explode('|', $item['modul_actions']);
			var_dump($actions);
			if (in_array($action, $actions)) {
				$isFound = true;
				break;
			}
		}
	}
	return $isFound;
}

function generateSizeProduct($produk_size, $id_satuan, $id_kategori){
	$pz = json_decode($produk_size);
	$produk_size = array();
	$arrlabel = array();
	$arrlabel['length'] = 0;
	$arrlabel['width'] = 0;
	$arrlabel['height'] = 0;
	$arrlabel['turntop'] = 0;
	$arrlabel['gusset'] = 0;
	$arrlabel['flap'] = 0;
	$arrlabel['lid'] = 0;
	foreach ($pz as $key => $q) {
		$size_value = $q->size_value;
		if ($id_satuan != '14') {
			$size_value = $size_value * 2.54;
		}

		if (strpos(strtolower($q->size_label), 'width') !== false) {
			$arrlabel['width'] = $size_value;
		}
		if (strpos(strtolower($q->size_label), 'length') !== false) {
			$arrlabel['length'] = $size_value;
		}
		if (strpos(strtolower($q->size_label), 'height') !== false || strpos(strtolower($q->size_label), 'depth') !== false) {
			$arrlabel['height'] = $size_value;
		}
		if (strpos(strtolower($q->size_label), 'gusset') !== false) {
			$arrlabel['gusset'] = $size_value;
		}
		if (strpos(strtolower($q->size_label), 'turntop') !== false) {
			$arrlabel['turntop'] = $size_value;
		}
		if (strpos(strtolower($q->size_label), 'flap') !== false) {
			$arrlabel['flap'] = $size_value;
		}
		if (strpos(strtolower($q->size_label), 'lid') !== false) {
			$arrlabel['lid'] = $size_value;
		}

		array_push($produk_size,$q->size_label.':'.$size_value);
	}
	$produk_size = implode(', ',$produk_size);

	$template_size = "";
	if (in_array($id_kategori, array('11'))) {
		$template_size = "[width] + [gusset] x [height] + [turntop]";
	}
	if (in_array($id_kategori, array('10'))) {
		$template_size = "[width] + [gusset] x [height] + [flap]";
	}
	if (in_array($id_kategori, array('3'))) {
		$template_size = "[length] + [width] x [height] + [flap]";
	}
	if (in_array($id_kategori, array('4'))) {
		$template_size = "[length] + [width] x [height] + [lid]";
	}
	if (in_array($id_kategori, array('5'))) {
		$template_size = "[length] + [width] x [height]";
	}
	if (in_array($id_kategori, array('7'))) {
		$template_size = "[length] x [width]";
	}
	$produk_size = str_replace(array('[width]', '[length]', '[height]', '[gusset]', '[flap]', '[lid]', '[turntop]'), array($arrlabel['width'], $arrlabel['length'], $arrlabel['height'], $arrlabel['gusset'], $arrlabel['flap'], $arrlabel['lid'], $arrlabel['turntop']), $template_size);
	return $produk_size;
}

function checkstatus($app){
	$sbu = getAppSetting($app)->kode_sbu;
	$cek = $app->db->query("SELECT * FROM clientmanager_smartone.status_app WHERE nama_sbu = '$sbu'");
	$row = $cek->row();
	if ($row->status==0){
		redirect('E403');
	}
}

function addSpace($r){
	$d = '';
	for ($i=0;$i<$r;$i++){
		$d.= '&nbsp;';
	}
	return $d;
}

function lineBreak($r){
	$d = '';
	for ($i=0;$i<$r;$i++){
		$d.= '<br>';
	}
	return $d;
}

function getkodeakunneraca($app, $id_akun, $tglawal, $tglakhir){
	$tglawal = reverseDate($tglawal);
	$tglakhir = reverseDate($tglakhir);
	$get = $app->db->query("SELECT * FROM m_akun WHERE id_akun = '$id_akun'");
	if ($get->num_rows()>0){
		$row = $get->row();
		return $row->kode_akun;
	} else {
		return null;
	}
}

function getnamaakunneraca($app, $id_akun, $tglawal, $tglakhir){
	$tglawal = reverseDate($tglawal);
	$tglakhir = reverseDate($tglakhir);
	$get = $app->db->query("SELECT * FROM m_akun WHERE id_akun = '$id_akun'");
	if ($get->num_rows()>0){
		$row = $get->row();
		return $row->nama_akun;
	} else {
		return null;
	}
}

function getjumlahneraca($app, $id_akun, $tglawal, $tglakhir){
	$tglawal = reverseDate($tglawal);
	$tglakhir = reverseDate($tglakhir);
	$get = $app->db->query("SELECT SUM(a.jumlah_rp) as jumlah_rp, a.id_akun,b.kode_akun,b.nama_akun from t_finance_detail a left join m_akun b on a.id_akun = b.id_akun inner join t_finance c on a.id_finance = c.id_finance where a.id_akun = '$id_akun' and c.tgl_trans <= '$tglakhir' GROUP BY id_akun");
	if ($get->num_rows()>0){
		$row = $get->row();
		return $row->jumlah_rp;
	} else {
		return null;
	}
}

function getakunbiayarm($app){
	$get = $app->db->query("SELECT * FROM m_akun WHERE id_akun = '68'");
	if ($get->num_rows()>0){
		$row = $get->row();
		return $row;
	} else {
		return null;
	}
}

function getakunpersediaanwip($app){
	$get = $app->db->query("SELECT * FROM m_akun WHERE id_akun = '19'");
	if ($get->num_rows()>0){
		$row = $get->row();
		return $row;
	} else {
		return null;
	}
}

function getakunpersediaanfg($app){
	$get = $app->db->query("SELECT * FROM m_akun WHERE id_akun = '20'");
	if ($get->num_rows()>0){
		$row = $get->row();
		return $row;
	} else {
		return null;
	}
}

function getakunpersediaanfgxl($app){
	$get = $app->db->query("SELECT * FROM m_akun WHERE id_akun = '43'");
	if ($get->num_rows()>0){
		$row = $get->row();
		return $row;
	} else {
		return null;
	}
}

function getakunhpp($app){
	$get = $app->db->query("SELECT * FROM m_akun WHERE id_akun = '66'");
	if ($get->num_rows()>0){
		$row = $get->row();
		return $row;
	} else {
		return null;
	}
}

function getakunhppxl($app){
	$get = $app->db->query("SELECT * FROM m_akun WHERE id_akun = '1958'");
	if ($get->num_rows()>0){
		$row = $get->row();
		return $row;
	} else {
		return null;
	}
}

function get_client_ip() {
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}

function helper_log($tipe = "", $str = ""){
    $CI =& get_instance();
    $CI->load->library('user_agent');
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') { 
    }else {
        if (preg_match("/signin/i", current_url())){
            $log_tipe   = "Login";
        }
        elseif(preg_match("/logout/i", current_url()))
        {
            $log_tipe   = "Logout";
        }
        elseif(preg_match("/Add/i", current_url()))
        {
            $log_tipe = "Halaman Tambah ".$CI->router->fetch_method();
        }
        elseif (preg_match("/Store/i", current_url())) 
        {
            $log_tipe = "Menyimpan ".$CI->router->fetch_method();
        }
        elseif (preg_match("/Edit/i", current_url())) {
            $log_tipe = "Edit ".$CI->router->fetch_method();
        }
        elseif (preg_match("/Delete/i", current_url())) {
            $log_tipe = "Hapus ".$CI->router->fetch_method();
        }
        elseif (preg_match("/Update/i", current_url())) {
            $log_tipe = "Update ".$CI->router->fetch_method();
        }
        elseif (preg_match("/Detail/i", current_url())) {
            $log_tipe = "Detail ".$CI->router->fetch_method();
        }
        elseif (preg_match("/approval1/i", current_url())) {
            $log_tipe = "Approvve 1".$CI->router->fetch_method();
        }
        elseif (preg_match("/approval2/i", current_url())) {
            $log_tipe = "Approve 2 ".$CI->router->fetch_method();
        }
        elseif (preg_match("/disapprove1/i", current_url())) {
            $log_tipe = "Diasapprove 1 ".$CI->router->fetch_method();
        }
        elseif (preg_match("/disapprove2/i", current_url())) {
            $log_tipe = "Diasapprove 2 ".$CI->router->fetch_method();
        }
        elseif (preg_match("/Unapprove1/i", current_url())) {
            $log_tipe = "Diasapprove 1 ".$CI->router->fetch_method();
        }
        elseif (preg_match("/Unapprove2/i", current_url())) {
            $log_tipe = "Diasapprove 2 ".$CI->router->fetch_method();
        }
        else{
            $log_tipe = "view ".$CI->router->fetch_method();
        }
    }
    $param['log_id_user']   = $CI->session->userdata('id_user');
    $param['log_nama_user'] = $CI->session->userdata('nama');
    $param['log_aktivitas'] = !empty($log_tipe) ? $log_tipe : $CI->router->fetch_class();
    $param['log_ip']      	= get_client_ip();
    $param['log_browser']   = $CI->agent->browser();
    $param['log_os']		= $CI->agent->platform();
    $param['log_url']		= current_url();
    $param['log_menu']		= $CI->router->fetch_class();
    $param['log_sub_menu']	= $CI->router->fetch_method();
    $param['sbu']			= !empty(getAppSetting($CI)->nama_sbu) ? getAppSetting($CI)->nama_sbu : '-';
    date_default_timezone_set('Asia/Jakarta');
    $param['log_time']		= date('Y-m-d H:i:s');
    $param['log_request']		= json_encode($CI->in);
    // printJSON($CI->in);
    $CI->load->model('m_log');
    $CI->m_log->save_log($param);     
}

function getlabarugikodeakun($app,$tglawal,$tglakhir,$akun){
    $tglawal = reverseDate($tglawal);
    $tglakhir = reverseDate($tglakhir);
    $res = $app->db->query("SELECT a.kode_akun FROM (SELECT * FROM m_akun WHERE kode_akun LIKE '$akun%') a LEFT JOIN (SELECT a.* FROM t_finance_detail a INNER JOIN t_finance b on a.id_finance = b.id_finance WHERE b.tgl_trans >= '$tglawal' AND b.tgl_trans <= '$tglakhir') b on a.id_akun = b.id_akun");
    return $res->row()->kode_akun;
}
function getlabaruginamaakun($app,$tglawal,$tglakhir,$akun){
    $tglawal = reverseDate($tglawal);
    $tglakhir = reverseDate($tglakhir);
    $res = $app->db->query("SELECT a.nama_akun FROM (SELECT * FROM m_akun WHERE kode_akun LIKE '$akun%') a LEFT JOIN (SELECT a.* FROM t_finance_detail a INNER JOIN t_finance b on a.id_finance = b.id_finance WHERE b.tgl_trans >= '$tglawal' AND b.tgl_trans <= '$tglakhir') b on a.id_akun = b.id_akun");
    return $res->row()->nama_akun;
}
function getlabarugisaldo($app,$tglawal,$tglakhir,$akun){
    $tglawal = reverseDate($tglawal);
    $tglakhir = reverseDate($tglakhir);
    $res = $app->db->query("SELECT SUM(b.amount) as saldo FROM (SELECT * FROM m_akun WHERE kode_akun LIKE '$akun%') a LEFT JOIN (SELECT a.* FROM t_finance_detail a INNER JOIN t_finance b on a.id_finance = b.id_finance WHERE b.tgl_trans >= '$tglawal' AND b.tgl_trans <= '$tglakhir') b on a.id_akun = b.id_akun");
    return $res->row()->saldo;
}
function getlabarugihpp($app,$tglawal,$tglakhir,$akun){
    $tglawal = reverseDate($tglawal);
    $tglakhir = reverseDate($tglakhir);
    $res = $app->db->query("SELECT SUM(b.amount) as saldo FROM (SELECT * FROM m_akun WHERE kode_akun LIKE '$akun%') a LEFT JOIN (SELECT a.* FROM t_finance_detail a INNER JOIN t_finance b on a.id_finance = b.id_finance WHERE b.tgl_trans >= '$tglawal' AND b.tgl_trans <= '$tglakhir' AND a.amount > 0) b on a.id_akun = b.id_akun");
    return $res->row()->saldo;
}