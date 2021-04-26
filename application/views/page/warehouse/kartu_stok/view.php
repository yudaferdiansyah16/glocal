<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">Warehouse</li>
        <li class="breadcrumb-item active">Kartu Stok</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">Kartu Stok</h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="card mb-g">
                <form method="post" action="<?=base_url('warehouse/kartu_stok/view')?>" autocomplete="off">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="form-label">Start</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm x-datepicker x-readonly" placeholder="Select start date" name="tgl1" value="<?php if(isset($tgl1)) echo $tgl1; else echo ''; ?>" required />
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
                                    <input type="text" class="form-control form-control form-control-sm x-datepicker x-readonly" placeholder="Select end date" name="tgl2" value="<?php if(isset($tgl2)) echo $tgl2; else echo ''; ?>" required />
                                    <div class="input-group-append">
                                        <span class="input-group-text fs-xl">
                                            <i class="fa fal fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Item</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm x-readonly barang" placeholder="Search Item" value="<?php if(isset($nama_barang)) echo $nama_barang; ?>" readonly required>
									<input type="hidden" name="barang" class="id_sub_barang" value="<?php if(isset($barang)) echo $barang; else echo '';  ?>" />
									<input type="hidden" name="nama_barang" class="nama_barang" value="<?php if(isset($nama_barang)) echo $nama_barang; else echo '';  ?>" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default btn-search-barang" data-toggle="modal" data-target="#m_sub_barang_single_modal"><i class="fal fa-search"></i></button>
									</div>
                                </div> 
                            </div>
                            <!-- <div class="col-md-4">
								<label class="form-label">Item</label>
								<div class="input-group input-group-sm">
									<div class="input-group input-group-sm">
                                        <select name="barang" class="form-control form-control-sm select-remote id_sub_barang"></select>
									</div>
								</div>
							</div> -->
                            <div class="col-md-2">
                                <label class="form-label">Klasifikasi</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-control form-control-sm select2 klasifikasi" name="klasifikasi">
                                        <option value="" disabled selected>Select Data . . .</option>
                                        <?=createOption($sklasifikasi,'id_class',array('kode_class','nama_class'), ' - ',$klasifikasi)?>
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
                <?php if(isset($tgl1) && isset($tgl2)){ ?>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" style="white-space: nowrap">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-center" rowspan="2">No</th>
                                            <th class="text-center" rowspan="2">No Bukti</th>
                                            <th class="text-center" rowspan="2">Tanggal</th>
                                            <th class="text-center" colspan="3">Barang</th>
                                            <th class="text-center" rowspan="2">Jenis Mutasi</th>
                                            <th class="text-center" colspan="2">Dokumen</th>
                                            <th class="text-center" colspan="2">Jumlah</th>
                                            <th class="text-center" rowspan="2">Saldo</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Kode Barang</th>
                                            <th class="text-center">Nama Barang</th>
                                            <th class="text-center">Satuan</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">No</th>
                                            <th class="text-center">In</th>
                                            <th class="text-center">Out</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="text-align: right; font-weight: bold;" colspan="11">Saldo Akhir (<?=$tgl1?>)</td>
                                            <td style="text-align: left;  font-weight: bold;"><?php echo number_format($data->saldoawal); ?></td>
                                        </tr>
                                        <?php
                                            $count = 0;
                                            foreach ($data->data as $row) {
                                                $count++;
                                        ?>
                                        <tr>
                                            <td style="text-align: center;">
                                                <?php echo $count; ?>
                                            </td>
                                            <td style="text-align: left;">
                                                <?php echo $row->kode_mutasi; ?>
                                            </td>
                                            <td style="text-align: left;">
                                                <?php echo $row->tanggal_terima; ?>
                                            </td>
                                            <td style="text-align: left;">
                                                <?php echo $row->kode_barang; ?>
                                            </td>
                                            <td style="text-align: left;">
                                                <?php echo $row->nama_barang; ?>
                                            </td>
                                            <td style="text-align: left;">
                                                <?php echo $row->kode_satuan_terbesar; ?>
                                            </td>
                                            <td style="text-align: left;">
                                                <?php echo $row->nama_jenis_mutasi; ?>
                                            </td>
                                            <td style="text-align: left;"><?php echo ''; ?></td>
                                            <td style="text-align: left;"><?php echo $row->nomor_aju; ?></td>
                                            <td class="text-left"><?php if($row->in) echo number_format($row->in); else echo "-"; ?></td>
											<td class="text-left"><?php if($row->out) echo number_format($row->out); else echo "-"; ?></td>
											<td class="text-left"><?php echo number_format($row->hasil); ?></td>
                                        </tr>
                                        <?php } ?>
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