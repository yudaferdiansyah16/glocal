<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">Finance</li>
        <li class="breadcrumb-item active">Laporan Penjualan</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">Laporan Penjualan</h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="card mb-g">
                <form method="post" action="<?=base_url('finance/laporan_penjualan/view')?>">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
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
                            <div class="col-md-2">
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
                            <div class="col-md-3">
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
                                <label class="form-label">Local/Export</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control form-control-sm select2" name="type">
                                        <?php
                                            if($type == 'local'){
                                                echo '
                                                    <option value="local" selected>Local</option>
                                                    <option value="export">Export</option>
                                                ';
                                            }else if($type == 'export'){
                                                echo '
                                                    <option value="local">Local</option>
                                                    <option value="export" selected>Export</option>
                                                ';
                                            }else{
                                                echo '
                                                    <option value="local">Local</option>
                                                    <option value="export">Export</option>
                                                ';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">&nbsp;</label>
                                <div class="input-group input-group-sm">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fal fa fa-file"></i> &nbsp; View</button>
                                    &nbsp;
                                    <!-- <button type="button" class="btn btn-sm btn-success"><i class="fal fa fa-file-excel"></i> &nbsp; Excel</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php if(isset($tgl1) && isset($tgl2) && isset($type) && isset($customer)){ ?>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="dt" class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" style="white-space: nowrap">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-center" rowspan="2">No</th>
                                            <th class="text-center" colspan="4">Dokumen</th>
                                            <th class="text-center" rowspan="2">Jenis</th>
                                            <th class="text-center" class="text-center" rowspan="2">Kode Customer</th>
                                            <th class="text-center" rowspan="2">Customer</th>
                                            <th class="text-center" colspan="5">Barang</th>
                                            <th class="text-center" rowspan="2">Kurs</th>
                                            <th class="text-center" rowspan="2">Amount(Rp)</th>
                                            <th class="text-center" colspan="2">B/L</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">No Pend</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">No Invoice</th>
                                            <th class="text-center">No PO</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Unit</th>
                                            <th class="text-center">Kode</th>
                                            <th class="text-center">Price(Lain)</th>
                                            <th class="text-center">Amount</th>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $count = 0;
                                            foreach($data as $row) :
                                            $count++;
                                            $CI = &get_instance();
                                            $CI->load->model('mt_invoice');
                                            $detail = $CI->mt_invoice->getDetail($row->id_invoice);
                                            $rate = $CI->mt_invoice->getRate($row->id_invoice);
                                            $po = $CI->mt_invoice->getPO($row->id_invoice);
                                            $arr = array();
                                            foreach($detail as $key => $item){
                                                if(!array_key_exists($item['id_invoice'],$arr)){
                                                    $arr[$item['id_invoice']][$item['id_invoice']]['id_invoice'] = $item['id_invoice'];
                                                    $arr[$item['id_invoice']][$item['id_invoice']]['nama_barang'] = $item['nama_barang'];
                                                    $arr[$item['id_invoice']][$item['id_invoice']]['kode_barang'] = $item['kode_barang'];
                                                    $arr[$item['id_invoice']][$item['id_invoice']]['kode_satuan_terkecil'] = $item['kode_satuan_terkecil'];
                                                    $arr[$item['id_invoice']][$item['id_invoice']]['qty_invoice'] = $item['qty_invoice'];
                                                    $arr[$item['id_invoice']][$item['id_invoice']]['harga'] = $item['harga'];
                                                    $arr[$item['id_invoice']][$item['id_invoice']]['amount'] = intval($item['amount']);
                                                }else{
                                                    $arr[$item['id_invoice']][$item['id_invoice']]['nama_barang'] .= ",".$item['nama_barang'];
                                                    $arr[$item['id_invoice']][$item['id_invoice']]['kode_barang'] .= ",".$item['kode_barang'];
                                                    $arr[$item['id_invoice']][$item['id_invoice']]['kode_satuan_terkecil'] .= ",".$item['kode_satuan_terkecil'];
                                                    $arr[$item['id_invoice']][$item['id_invoice']]['qty_invoice'] .= ",".$item['qty_invoice'];
                                                    $arr[$item['id_invoice']][$item['id_invoice']]['harga'] .= ",".$item['harga'];
                                                    $arr[$item['id_invoice']][$item['id_invoice']]['amount'] .= ",".intval($item['amount']);
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
                                                $xpl_amount = explode(",", $item[$key]['harga']);
                                                $n_amount = array_sum($xpl_amount);
                                            }
                                        ?>
                                        <tr>
                                        <td><?= $count; ?></td>
                                            <td><?= $row->NOMOR_DAFTAR ?></td>
                                            <td><?= $row->tanggal_invoice ?></td>
                                            <td><?= $row->kode_invoice ?></td>
                                            <td><?= $po->kode_po ?></td>
                                            <td>
                                                <?php
                                                    if($row->KODE_DOKUMEN_PABEAN == '23'){
                                                        echo 'Export';
                                                    }else if($row->KODE_DOKUMEN_PABEAN == '40' || $row->KODE_DOKUMEN_PABEAN == '27'){
                                                        echo 'Local';
                                                    }
                                                ?>
                                            </td>
                                            <td><?= $row->kode_customer ?></td>
                                            <td><?= $row->nama_supplier ?></td>
                                            <td><?= $n_category ?></td>
                                            <td><?= $n_satuan ?></td>
                                            <td><?= $n_kode ?></td>
                                            <td><?= $n_harga ?></td>
                                            <td><?= number_format($n_amount, 2) ?></td>
                                            <td><?= number_format($rate->rate, 2) ?></td>
                                            <td><?= number_format($n_amount * $rate->rate, 2) ?></td>
                                            <td><?= $row->no_bl ?></td>
                                            <td></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>