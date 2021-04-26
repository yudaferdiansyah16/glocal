<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item active">Posting Jurnal Piutang</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
            Posting Jurnal Piutang
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
                <form method="post" action="<?=base_url('finance/jurnal_piutang/view')?>" autocomplete="off">
				    <div class="card-header">
                        <div class="form-group row">
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
                            <div class="col-md-4">
                                <label class="form-label">Customer</label>
                                <div class="input-group input-group-sm">
                                    <div class="input-group input-group-sm">
                                        <select class="form-control form-control-sm select2 coaid" id="coaid" name="customer" required>
                                            <option value="ALL" selected>All</option>
                                            <?=createOption($scustomer,'id_customer',array('kode_customer','nama'),' - ', $customer);?>
                                        </select>
                                    </div>
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
                <?php if(isset($tgl1) && isset($tgl2) && isset($customer)){ ?>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-12">
            					<div class="table-responsive">
                                    <form action="<?= base_url('finance/jurnal_piutang/store') ?>" method="post">
                                        <table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" width="1800px">
                                            <thead>
                                                <tr class="text-center">
                                                    <th rowspan="2" style="width: 5px; text-align: center">Ceklist</th>
                                                    <th rowspan="2" style="width: 100px; text-align: left">No. PO</th>
                                                    <th rowspan="2" style="width: 70px; text-align: left">No. Invoice</th>
                                                    <th rowspan="2" style="width: 70px; text-align: left">Tanggal Invoice</th>
                                                    <th rowspan="2" style="width: 150px; text-align: left">Customer</th>
                                                    <th colspan="2" style="width: 90px; text-align: center">Akun</th>
                                                    <th colspan="7" style="width: 220px; text-align: center">Barang</th>
                                                </tr>
                                                <tr class="text-center">
                                                    <th style="width: 45px; text-align: left">Debet</th>
                                                    <th style="width: 45px; text-align: left">Kredit</th>
                                                    <th style="width: 115px; text-align: left">Nama</th>
                                                    <th style="width: 15px; text-align: left">Kode</th>
                                                    <th style="width: 20px; text-align: left">Satuan</th>
                                                    <th style="width: 20px; text-align: left">Jumlah</th>
                                                    <th style="width: 20px; text-align: left">Harga</th>
                                                    <th style="width: 20px; text-align: left">Amount</th>
                                                    <th style="width: 10px; text-align: left">Rate</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $count = -1;
                                                    foreach ($data as $row) :
                                                        $count++;
                                                        $CI = &get_instance();
                                                        // $CI->load->model('mfinance_setting_akun_customer');
                                                        $CI->load->model('mt_invoice');
                                                        // $akun = $CI->mfinance_setting_akun_customer->get($row->id_supplier);
                                                        $akun = $CI->mt_invoice->getAkun($row->id_supplier);
                                                        $rate = $CI->mt_invoice->getRate($row->id_invoice);
                                                        $po = $CI->mt_invoice->getPO($row->id_invoice);
                                                        $detail = $CI->mt_invoice->getDetail($row->id_invoice);
                                                        $arr = array();
                                                        foreach($detail as $key => $item)
                                                        {
                                                            if(!array_key_exists($item['id_invoice'],$arr)){
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['id_invoice'] = $item['id_invoice'];
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['nama_barang'] = $item['nama_barang'];
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['kode_barang'] = $item['kode_barang'];
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['kode_satuan_terkecil'] = $item['kode_satuan_terkecil'];
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['qty_invoice'] = $item['qty_invoice'];
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['harga'] = intval($item['harga']);
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['amount'] = intval($item['amount']);
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['id_akun'] = $item['id_akun'].'|'.$item['id_akun_lawan'].'|'.$item['qty_invoice'].'|'.$item['harga'];
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['kode_akun'] = $item['kode_akun'];
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['nama_akun'] = $item['nama_akun'];
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['nama_akun_lawan'] = $item['nama_akun_lawan'];
                                                            }else{
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['nama_barang'] .= ",".$item['nama_barang'];
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['kode_barang'] .= ",".$item['kode_barang'];
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['kode_satuan_terkecil'] .= ",".$item['kode_satuan_terkecil'];
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['qty_invoice'] .= ",".$item['qty_invoice'];
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['harga'] .= ",".intval($item['harga']);
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['amount'] .= ",".intval($item['amount']);
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['id_akun'] .= ",".$item['id_akun'].'|'.$item['id_akun_lawan'].'|'.$item['qty_invoice'].'|'.$item['harga'];
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['kode_akun'] .= ",".$item['kode_akun'];
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['nama_akun'] .= ",".$item['nama_akun'];
                                                                $arr[$item['id_invoice']][$item['id_invoice']]['nama_akun_lawan'] .= ",".$item['nama_akun_lawan'];
                                                            }
                                                        }
                                                        ksort($arr, SORT_NUMERIC);
                                                        foreach($arr as $key => $item){
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
                                                            $xpl_satuan = explode(",", $item[$key]['kode_satuan_terkecil']);
                                                            $n_satuan = "";
                                                            foreach($xpl_satuan as $s => $a){
                                                                $n_satuan .= ($s!=0) ? "<br>".$a : $a ;
                                                            }
                                                            $xpl_qty = explode(",", $item[$key]['qty_invoice']);
                                                            $n_qty = "";
                                                            foreach($xpl_qty as $q => $t){
                                                                $n_qty .= ($q!=0) ? "<br>".$t : $t ;
                                                            }
                                                            $xpl_harga = explode(",", $item[$key]['harga']);
                                                            $n_harga = "";
                                                            foreach($xpl_harga as $h => $r){
                                                                $n_harga .= ($h!=0) ? "<br>".$r : $r ;
                                                            }
                                                            $xpl_amount = explode(",", $item[$key]['amount']);
                                                            $n_amount = "";
                                                            foreach($xpl_amount as $a => $m){
                                                                $n_amount .= ($a!=0) ? "<br>".$m : $m ;
                                                            }
                                                            $xpl_akun = explode(",", $item[$key]['nama_akun']);
															$n_akun = "";
															foreach($xpl_akun as $a => $k){
																$n_akun .= ($a!=0) ? "<br>".$k : $k ;
                                                            }
                                                            $xpl_kode_akun = explode(",", $item[$key]['kode_akun']);
															$n_kode_akun = "";
															foreach($xpl_kode_akun as $a => $k){
																$n_kode_akun .= ($a!=0) ? "<br>".$k : $k ;
															}
															$xpl_akun_lawan = explode(",", $item[$key]['nama_akun_lawan']);
															$n_akun_lawan = "";
															foreach($xpl_akun_lawan as $a => $k){
																$n_akun_lawan .= ($a!=0) ? "<br>".$k : $k ;
															}
															$xpl_campur = explode(",", $item[$key]['id_akun']);
															$n_campur = "";
															foreach($xpl_campur as $s => $a){
																$n_campur .= ($s!=0) ? "<br>".$a : $a ;
															}
                                                        }
                                                        $id_akun_credit = $akun->id_akun == '' ? 'NULL' : $akun->id_akun;
                                                        $kode_akun_credit = $akun->kode_akun == '' ? 'NULL' : $akun->kode_akun;
                                                        $nama_akun_credit = $akun->nama_akun == '' ? 'NULL' : $akun->nama_akun;
                                                ?>
                                                <tr class="text-center">
                                                    <!-- <td><input type="checkbox" name="id_invoice[]" class="check" value="<?php echo $row->id_invoice.'=='.$row->nama_supplier.'=='.$id_akun_debet.'=='.$id_akun_credit.'=='.$nama_akun_debet.'=='.$nama_akun_credit.'=='.$row->qty_invoice.'=='.$row->harga.'=='.$count; ?>"></td> -->
                                                    <td>
                                                        <input type="checkbox" name="id_invoice[]" class="check" value="<?php echo $row->id_invoice.'=='.$row->nama_supplier.'=='.$row->qty_invoice.'=='.$row->harga.'=='.$n_amount.'=='.$count.'=='.$n_campur.'=='.$id_akun_credit.'=='.$nama_akun_credit.'=='.$rate->id_valuta; ?>">
                                                    </td>
                                                    <td>
                                                        <?php echo $po->kode_po; ?>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control no_invoice" name="kode_invoice[]" value="<?php echo $row->kode_invoice; ?>" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="tanggal_invoice[]" class="form-control x-datepicker tgl_invoice" value="<?php echo reverseDate($row->tanggal_invoice); ?>" readonly>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->nama_supplier; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $n_kode_akun; ?>
                                                        <!-- <?php echo $n_kode_akun; ?> <br> <?=$n_akun; ?> -->
                                                    </td>
                                                    <td>
                                                        <?= $kode_akun_credit == 'NULL' ? '-' : $kode_akun_credit ?>
                                                        <!-- <?= $kode_akun_credit == 'NULL' ? '-' : $kode_akun_credit .'<br>'.$nama_akun_credit; ?> -->
                                                    </td>
                                                    <td style="text-align: left;"><?php echo $n_category; ?></td>
                                                    <td style="text-align: left;"><?php echo $n_kode; ?></td>
                                                    <td style="text-align: left;"><?php echo $n_satuan; ?></td>
                                                    <td style="text-align: left;"><?php echo $n_qty; ?></td>
                                                    <td style="text-align: left;"><?php echo $n_harga; ?></td>
                                                    <td style="text-align: left;"><?php echo $n_amount; ?></td>
                                                    <td style="text-align: left;">
                                                        <input type="text" class="form-control form-control-sm input-mask rate" name="rate[]" data-inputmask="'alias': 'currency', 'prefix': ''" value="<?php echo $rate->rate; ?>" readonly />  
                                                    </td>
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
