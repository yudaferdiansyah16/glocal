<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item active">Posting Jurnal Hutang</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
            Posting Jurnal Hutang
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="card mb-g">
            	<form method="post" action="<?=base_url('finance/jurnal_hutang/view')?>" autocomplete="off">
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
								<label class="form-label">Supplier</label>
								<div class="input-group input-group-sm">
									<div class="input-group input-group-sm">
										<select class="form-control form-control-sm select2 coaid" id="coaid" name="supplier" required>
											<option value="ALL" selected>All</option>
											<?=createOption($ssupplier,'id_customer',array('kode_customer','nama'),' - ', $supplier);?>
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
				<?php if(isset($tgl1) && isset($tgl2) && isset($supplier)){ ?>
					<div class="card-body">
	                	<div class="form-group row">
	                		<div class="col-md-12">
			                    <div class="table-responsive">
			                        <form action="<?= base_url('finance/jurnal_hutang/store') ?>" method="post">
			                            <table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" width="2500px">
			                                <thead>
			                                    <tr>
			                                        <th rowspan="2" style="width: 5px; text-align: center">Ceklist</th>
			                                        <th rowspan="2" style="width: 100px; text-align: left">No. Receive</th>
			                                        <th rowspan="2" style="width: 70px; text-align: left">Tanggal Receive</th>
			                                        <th rowspan="2" style="width: 70px; text-align: left">No. Invoice</th>
			                                        <th rowspan="2" style="width: 70px; text-align: left">Tanggal Invoice</th>
			                                        <th rowspan="2" style="width: 130px; text-align: left">Supplier</th>
			                                        <th colspan="2" style="width: 90px; text-align: center">Akun</th>
			                                        <th colspan="7" style="width: 300px; text-align: center">Barang</th>
			                                    </tr>
			                                    <tr>
			                                        <th style="width: 45px; text-align: left">Debet</th>
			                                        <th style="width: 45px; text-align: left">Kredit</th>
			                                        <th style="width: 115px; text-align: left">Nama</th>
			                                        <th style="width: 15px; text-align: left">Kode</th>
			                                        <th style="width: 20px; text-align: left">Satuan</th>
			                                        <th style="width: 20px; text-align: left">Jumlah</th>
			                                        <th style="width: 60px; text-align: left">Harga</th>
			                                        <th style="width: 60px; text-align: left">Amount</th>
			                                        <th style="width: 10px; text-align: left">Rate</th>
			                                    </tr>
			                                </thead>
			                                <tbody>
			                                    <?php
			                                    	$count = -1;
			                                    	foreach ($data as $row) {
				                                        $count++;
				                                        $CI = &get_instance();
				                                        $CI->load->model('mt_dn');
				                                        $rate = $CI->mt_dn->getRate($row->id_dn);
				                                        $akun = $CI->mt_dn->getAkun($row->id_supplier);
				                                        $detail = $CI->mt_dn->getDetail($row->id_dn);
				                                        $arr = array();
														foreach($detail as $key => $item)
														{
															if(!array_key_exists($item['id_dn'],$arr)){
																$arr[$item['id_dn']][$item['id_dn']]['id_dn'] = $item['id_dn'];
																$arr[$item['id_dn']][$item['id_dn']]['nama_barang'] = $item['nama_barang'];
																$arr[$item['id_dn']][$item['id_dn']]['kode_barang'] = $item['kode_barang'];
																$arr[$item['id_dn']][$item['id_dn']]['kode_satuan_terkecil'] = $item['kode_satuan_terkecil'];
																$arr[$item['id_dn']][$item['id_dn']]['qty_dn'] = $item['qty_dn'];
																$arr[$item['id_dn']][$item['id_dn']]['harga'] = intval($item['harga']);
																$arr[$item['id_dn']][$item['id_dn']]['amount'] = intval($item['amount']);
																$arr[$item['id_dn']][$item['id_dn']]['id_akun'] = $item['id_akun'].'|'.$item['id_akun_lawan'].'|'.$item['qty_dn'].'|'.$item['harga'];
																$arr[$item['id_dn']][$item['id_dn']]['kode_akun'] = $item['kode_akun'];
																$arr[$item['id_dn']][$item['id_dn']]['nama_akun'] = $item['nama_akun'];
                                                                $arr[$item['id_dn']][$item['id_dn']]['nama_akun_lawan'] = $item['nama_akun_lawan'];
															}else{
																$arr[$item['id_dn']][$item['id_dn']]['nama_barang'] .= ",".$item['nama_barang'];
																$arr[$item['id_dn']][$item['id_dn']]['kode_barang'] .= ",".$item['kode_barang'];
																$arr[$item['id_dn']][$item['id_dn']]['kode_satuan_terkecil'] .= ",".$item['kode_satuan_terkecil'];
																$arr[$item['id_dn']][$item['id_dn']]['qty_dn'] .= ",".$item['qty_dn'];
																$arr[$item['id_dn']][$item['id_dn']]['harga'] .= ",".intval($item['harga']);
																$arr[$item['id_dn']][$item['id_dn']]['amount'] .= ",".intval($item['amount']);
																$arr[$item['id_dn']][$item['id_dn']]['id_akun'] .= ",".$item['id_akun'].'|'.$item['id_akun_lawan'].'|'.$item['qty_dn'].'|'.$item['harga'];
																$arr[$item['id_dn']][$item['id_dn']]['kode_akun'] .= ",".$item['kode_akun'];
																$arr[$item['id_dn']][$item['id_dn']]['nama_akun'] .= ",".$item['nama_akun'];
                                                                $arr[$item['id_dn']][$item['id_dn']]['nama_akun_lawan'] .= ",".$item['nama_akun_lawan'];
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
														    $xpl_qty = explode(",", $item[$key]['qty_dn']);
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
		                                        <tr>
		                                            <td style="text-align: center;">
														<!-- <input type="checkbox" name="id_dn[]" class="check" value="<?php echo $row->id_dn.'=='.$row->nama_supplier.'=='.$id_akun_debet.'=='.$id_akun_credit.'=='.$nama_akun_debet.'=='.$nama_akun_credit.'=='.$row->qty_dn.'=='.$row->harga.'=='.$count; ?>"> -->
														<!-- <?php echo $row->id_dn.'=='.$row->nama_supplier.'=='.$row->qty_dn.'=='.$row->harga.'=='.$n_amount.'=='.$count.'=='.$n_campur.'=='.$id_akun_credit.'=='.$nama_akun_credit.'=='.$rate->id_valuta; ?> -->
														<input type="checkbox" name="id_dn[]" class="check" value="<?php echo $row->id_dn.'=='.$row->nama_supplier.'=='.$row->qty_dn.'=='.$row->harga.'=='.$n_amount.'=='.$count.'=='.$n_campur.'=='.$id_akun_credit.'=='.$nama_akun_credit.'=='.$rate->id_valuta; ?>">
														</td>
		                                            <td style="text-align: left;">
		                                                <?php echo $row->kode_mutasi; ?>
		                                            </td>
		                                            <td style="text-align: left;">
		                                                <?php echo $row->tgl_kedatangan; ?>
		                                            </td>
		                                            <td style="text-align: left;">
		                                                <input type="text" class="form-control no_invoice" name="no_invoice[]" value="<?php echo $row->no_invoice; ?>">
		                                            </td>
		                                            <td style="text-align: left;">
		                                                <input type="text" name="tgl_invoice[]" class="form-control x-datepicker tgl_invoice" value="<?php echo reverseDate($row->tgl_invoice); ?>" autocomplete="off" readonly>
		                                            </td>
		                                            <td style="text-align: left;">
		                                                <?php echo $row->nama_supplier; ?>
		                                            </td>
		                                            <td style="text-align: left;">
														<?php echo $n_kode_akun; ?>
		                                            </td>
		                                            <td style="text-align: left;">
														<?= $kode_akun_credit == 'NULL' ? '-' : $kode_akun_credit; ?>
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
			                                    <?php } ?>
			                                </tbody>
			                            </table>
			                            <?php if (count($data) > 0) { ?>
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
