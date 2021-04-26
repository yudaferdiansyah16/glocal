<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">Finance</li>
        <li class="breadcrumb-item active">Posting Pemakaian</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">Posting Pemakaian</h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="card mb-g">
                <form method="post" action="<?=base_url('finance/posting_pemakaian/view')?>" autocomplete="off">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">Start</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select start date" name="tgl1" value="<?php if(isset($tgl1)) echo $tgl1; ?>" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text fs-xl">
                                            <i class="fa fal fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">End</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select end date" name="tgl2" value="<?php if(isset($tgl2)) echo $tgl2; ?>" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text fs-xl">
                                            <i class="fa fal fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-2">
                			    <label class="form-label">Request Type</label>
                                <div class="input-group input-group-sm">
                    				<select class="form-control form-control-sm select2" name="tipe_request" id="tipe_request">
                    					<option value="ALL" selected>All</option>
                    					<option value="job">JOB</option>
                    					<option value="nonjob">NON JOB</option>
                    				</select>
                			    </div>
                            </div> -->
                            <div class="col-md-2">
                                <label class="form-label">Classification</label>
                                <div class="input-group input-group-sm">
                                    <select id="klasifikasi" name="klasifikasi" class="form-control form-control-sm select2">
                                        <option value="ALL" selected>All</option>
                                        <?=createOption($sklasifikasi,'id_class',array('nama_class'),' - ', $klasifikasi);?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <div class="input-group input-group-sm">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fal fa fa-file"></i> &nbsp; View</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php if(isset($tgl1) && isset($tgl2) && isset($klasifikasi)){ ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <form action="<?= base_url('finance/posting_pemakaian/store') ?>" method="post">
                                        <table id="dt" class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" width="1500px">
                                            <thead>
                                            	<tr>
			                                        <th rowspan="2" style="width: 5px; text-align: center">Ceklist</th>
			                                        <th rowspan="2" style="width: 100px; text-align: left">No. Job</th>
			                                        <th colspan="2" style="width: 90px; text-align: center">Akun</th>
			                                        <th colspan="5" style="width: 220px; text-align: center">Barang</th>
			                                    </tr>
			                                    <tr>
			                                        <th style="width: 45px; text-align: left">Debet</th>
			                                        <th style="width: 45px; text-align: left">Kredit</th>
			                                        <th style="width: 115px; text-align: left">Nama</th>
			                                        <th style="width: 15px; text-align: left">Kode</th>
			                                        <th style="width: 20px; text-align: left">Satuan</th>
			                                        <th style="width: 20px; text-align: left">Jumlah</th>
			                                        <th style="width: 20px; text-align: left">Harga</th>
			                                    </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $count = -1;
                                                    foreach ($data as $row) :
                                                        $count++;
                                                        $CI = &get_instance();
                                                        $CI->load->model('mt_production_detail');
                                                        $detail = $CI->mt_production_detail->getDetail($row->id_production, $klasifikasi);
                                                        if(!empty($detail)){
                                                            $arr = array();
                                                            foreach($detail as $key => $item)
                                                            {
                                                                if(!array_key_exists($item['id_production'],$arr)){
                                                                    $arr[$item['id_production']][$item['id_production']]['id_production'] = $item['id_production'];
                                                                    $arr[$item['id_production']][$item['id_production']]['no_job'] = $item['no_job'];
                                                                    $arr[$item['id_production']][$item['id_production']]['nama_barang'] = $item['nama_barang'];
                                                                    $arr[$item['id_production']][$item['id_production']]['kode_barang'] = $item['kode_barang'];
                                                                    $arr[$item['id_production']][$item['id_production']]['satuan_terkecil'] = $item['satuan_terkecil'];
                                                                    $arr[$item['id_production']][$item['id_production']]['qty'] = $item['qty'];
                                                                    $arr[$item['id_production']][$item['id_production']]['harga_satuan'] = $item['harga_satuan'];
                                                                    $arr[$item['id_production']][$item['id_production']]['id_akun'] = $item['id_akun'].'|'.$item['id_akun_lawan'].'|'.$item['qty'].'|'.$item['harga_satuan'];
                                                                    $arr[$item['id_production']][$item['id_production']]['kode_akun'] = $item['kode_akun'];
                                                                    $arr[$item['id_production']][$item['id_production']]['nama_akun'] = $item['nama_akun'];
                                                                    $arr[$item['id_production']][$item['id_production']]['kode_akun_lawan'] = $item['kode_akun_lawan'];
                                                                    $arr[$item['id_production']][$item['id_production']]['nama_akun_lawan'] = $item['nama_akun_lawan'];
                                                                    $arr[$item['id_production']][$item['id_production']]['amount'] = $item['amount'];
                                                                }else{
                                                                	$arr[$item['id_production']][$item['id_production']]['no_job'] .= ",".$item['no_job'];
                                                                    $arr[$item['id_production']][$item['id_production']]['nama_barang'] .= ",".$item['nama_barang'];
                                                                    $arr[$item['id_production']][$item['id_production']]['kode_barang'] .= ",".$item['kode_barang'];
                                                                    $arr[$item['id_production']][$item['id_production']]['satuan_terkecil'] .= ",".$item['satuan_terkecil'];
                                                                    $arr[$item['id_production']][$item['id_production']]['qty'] .= ",".$item['qty'];
                                                                    $arr[$item['id_production']][$item['id_production']]['harga_satuan'] .= ",".$item['harga_satuan'];
                                                                    $arr[$item['id_production']][$item['id_production']]['id_akun'] .= ",".$item['id_akun'].'|'.$item['id_akun_lawan'].'|'.$item['qty'].'|'.$item['harga_satuan'];
                                                                    $arr[$item['id_production']][$item['id_production']]['kode_akun'] .= ",".$item['kode_akun'];
                                                                    $arr[$item['id_production']][$item['id_production']]['nama_akun'] .= ",".$item['nama_akun'];
                                                                    $arr[$item['id_production']][$item['id_production']]['kode_akun_lawan'] .= ",".$item['kode_akun_lawan'];
                                                                    $arr[$item['id_production']][$item['id_production']]['nama_akun_lawan'] .= ",".$item['nama_akun_lawan'];
                                                                    $arr[$item['id_production']][$item['id_production']]['amount'] .= ",".$item['amount'];
                                                                }
                                                            }
                                                            ksort($arr, SORT_NUMERIC);
                                                            foreach($arr as $key => $item){
                                                            	$xpl_job = explode(",", $item[$key]['no_job']);
                                                                $n_job = "";
                                                                foreach($xpl_job as $j => $b){
                                                                    $n_job .= ($j!=0) ? "<br>".$b : $b ;
                                                                }
                                                                $xpl_kode_akun = explode(",", $item[$key]['kode_akun']);
                                                                $n_kode_akun = "";
                                                                foreach($xpl_kode_akun as $a => $k){
                                                                    $n_kode_akun .= ($a!=0) ? "<br>".$k : $k ;
                                                                }
                                                                $xpl_akun = explode(",", $item[$key]['nama_akun']);
                                                                $n_akun = "";
                                                                foreach($xpl_akun as $a => $k){
                                                                    $n_akun .= ($a!=0) ? "<br>".$k : $k ;
                                                                }
                                                                $xpl_kode_akun_lawan = explode(",", $item[$key]['kode_akun_lawan']);
                                                                $n_kode_akun_lawan = "";
                                                                foreach($xpl_kode_akun_lawan as $a => $k){
                                                                    $n_kode_akun_lawan .= ($a!=0) ? "<br>".$k : $k ;
                                                                }
                                                                $xpl_akun_lawan = explode(",", $item[$key]['nama_akun_lawan']);
                                                                $n_akun_lawan = "";
                                                                foreach($xpl_akun_lawan as $a => $k){
                                                                    $n_akun_lawan .= ($a!=0) ? "<br>".$k : $k ;
                                                                }
                                                                $xpl = explode(",", $item[$key]['nama_barang']);
                                                                $n_category = "";
                                                                foreach($xpl as $b => $a){
                                                                    $n_category .= ($b!=0) ? "<br>".$a : $a ;
                                                                }
                                                                $xpl_kode = explode(",", $item[$key]['kode_barang']);
                                                                $n_kode = "";
                                                                foreach($xpl_kode as $k => $o){
                                                                    $n_kode .= ($k!=0) ? "<br>".$o : $o ;
                                                                }
                                                                $xpl_satuan = explode(",", $item[$key]['satuan_terkecil']);
                                                                $n_satuan = "";
                                                                foreach($xpl_satuan as $s => $a){
                                                                    $n_satuan .= ($s!=0) ? "<br>".$a : $a ;
                                                                }
                                                                $xpl_qty = explode(",", $item[$key]['qty']);
                                                                $n_qty = "";
                                                                foreach($xpl_qty as $q => $t){
                                                                    $n_qty .= ($q!=0) ? "<br>".$t : $t ;
                                                                }
                                                                $xpl_harga = explode(",", $item[$key]['harga_satuan']);
                                                                $n_harga = "";
                                                                foreach($xpl_harga as $h => $r){
                                                                    $n_harga .= ($h!=0) ? "<br>".$r : $r ;
                                                                }

                                                                $xpl_amount = explode(",", $item[$key]['amount']);
                                                                $n_amount = "";
                                                                foreach($xpl_amount as $am => $va){
                                                                    $n_amount .= ($am!=0) ? "<br>".$va : $va ;
                                                                }

                                                                $xpl_campur = explode(",", $item[$key]['id_akun']);
                                                                $n_campur = "";
                                                                foreach($xpl_campur as $s => $a){
                                                                    $n_campur .= ($s!=0) ? "<br>".$a : $a ;
                                                                }
                                                            }
                                                        }else{ 
                                                            $data = [];
                                                            return false;
                                                        }
                                                        
                                                ?>
                                                <tr class="text-center">
                                                    <td><input type="checkbox" name="id_production[]" class="check" value="<?php echo $row->id_production.'=='.$count.'=='.$n_campur.'=='.$n_qty.'=='.$n_harga.'=='.$n_amount; ?>"></td>
                                                    <td style="text-align: left;"><?php echo $n_job; ?></td>
                                                    <td style="text-align: left;">
                                                        <?php echo $n_kode_akun_lawan; ?>
                                                    </td>
                                                    <td style="text-align: left;"><?php echo $n_kode_akun; ?></td>
                                                    <td style="text-align: left;"><?php echo $n_category; ?></td>
                                                    <td style="text-align: left;"><?php echo $n_kode; ?></td>
                                                    <td style="text-align: left;"><?php echo $n_satuan; ?></td>
                                                    <td style="text-align: left;"><?php echo $n_qty; ?></td>
                                                    <td style="text-align: left;"><?php echo $n_harga; ?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <?php if(count($data) > 0) { ?>
                                        <hr>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sm btn-success" id="btnSave"><i class="fal fa fa-save"></i> Save</button>
                                        </div>
                                        <hr>
                                        <?php } ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>