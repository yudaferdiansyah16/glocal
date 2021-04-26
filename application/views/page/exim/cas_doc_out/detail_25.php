<div class="card-body">
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<dl class="row" style="margin-top: 15px;">
		        <dt class="col-sm-3">No Pengajuan</dt>
		        <dd class="col-sm-3">: <?=placeValue($tpbHeader,'NOMOR_AJU')?></dd>
		        <dt class="col-sm-3">No Pendaftaran</dt>
                <dd class="col-sm-3">: <?=placeValue($tpbHeader,'NOMOR_DAFTAR')?></dd>
                <dt class="col-sm-3">Tanggal Pengajuan</dt>
		        <dd class="col-sm-3">: <?=isset($tpbHeader->TANGGAL_AJU) ? date('d-m-Y',strtotime($tpbHeader->TANGGAL_AJU)) : ''?></dd>
		        <dt class="col-sm-3">Tanggal Pendaftaran</dt>
		        <dd class="col-sm-3">: <?=isset($tpbHeader->TANGGAL_DAFTAR) ? date('d-m-Y',strtotime($tpbHeader->TANGGAL_DAFTAR)) : ''?></dd>
		        <dt class="col-sm-3">Jenis TPB</dt>
                <dd class="col-sm-9">: <?=placeValue($tpbHeader,'URAIAN_JENIS_TPB')?></dd>
                <dt class="col-sm-3">Jenis Dokumen</dt>
		        <dd class="col-sm-9">: <?=placeValue($tpbHeader,'URAIAN_DOKUMEN_PABEAN')?></dd>
		    </dl>
        </div>
        <div class="col-sm-12 col-lg-6 col-xl-6">
			<dl class="row" style="margin-top: 15px;">
				<dt class="col-sm-3">PENGUSAHA</dt>
		        <dd class="col-sm-9"></dd>
		        <dt class="col-sm-3">NPWP</dt>
		        <dd class="col-sm-9"><?=placeValue($tpbHeader,'ID_PENGUSAHA')?></dd>
		        <dt class="col-sm-3">Nama</dt>
		        <dd class="col-sm-9"><?=placeValue($tpbHeader,'NAMA_PENGUSAHA')?></dd>
		        <dt class="col-sm-3">Alamat</dt>
		        <dd class="col-sm-9"><?=placeValue($tpbHeader,'ALAMAT_PENGUSAHA')?></dd>
		        <dt class="col-sm-3">No. Ijin TPB</dt>
		        <dd class="col-sm-9"><?=placeValue($tpbHeader,'NOMOR_IJIN_TPB')?></dd>
		    </dl>
		</div>
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<dl class="row" style="margin-top: 15px;">
				<dt class="col-sm-3">PENERIMA</dt>
		        <dd class="col-sm-9"></dd>
		        <dt class="col-sm-3">Nama</dt>
		        <dd class="col-sm-9"><?=placeValue($tpbHeader,'NAMA_PENERIMA_BARANG')?></dd>
		        <dt class="col-sm-3">Alamat</dt>
		        <dd class="col-sm-9"><?=placeValue($tpbHeader,'ALAMAT_PENERIMA_BARANG')?></dd>
		    </dl>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab_detail_barang" role="tab" aria-controls="tab_detail_barang" aria-selected="true">Data Detail Barang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab_detail_rm_import" role="tab" aria-controls="tab_detail_rm_import" aria-selected="false">Detail Bahan Baku Impor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#tab_detail_rm_lokal" role="tab" aria-controls="tab_detail_rm_lokal" aria-selected="false">Detail Bahan Baku Lokal</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab_detail_barang" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="dt_doc_in_detail" class="table table-sm table-bordered table-striped table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No.</th>
                                            <th>Uraian Barang</th>
                                            <th>Merk</th>
                                            <th>Tipe</th>
                                            <th>Ukuran</th>
                                            <th>Spf Lain</th>
                                            <th>Jumlah<br>Satuan</th>
                                            <th>Netto<br>(KGM)</th>
                                            <th>Volume<br>(m3)</th>
                                            <th>Nilai<br>CIF</th>
                                            <th>Harga<br>Penyerahan Rp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab_detail_rm_import" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="dt_rm_import" class="table table-sm table-bordered table-striped table-hover">
                                    <thead>
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th>Dok Asal</th>
                                        <th>No. Aju</th>
                                        <th>Urut Barang</th>
                                        <th>Uraian Barang</th>
                                        <th>Merk</th>
                                        <th>Tipe</th>
                                        <th>Ukuran</th>
                                        <th>Spf Lain</th>
                                        <th>Harga CIF<br>USD</th>
                                        <th>Jumlah<br>Satuan</th>
                                        <th>NDPBM</th>
                                        <th>Netto<br>(KGM)</th>
                                        <th>CIF Rp</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab_detail_rm_lokal" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="dt_rm_lokal" class="table table-sm table-bordered table-striped table-hover">
                                    <thead>
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th>Dok Asal</th>
                                        <th>No. Aju</th>
                                        <th>Uraian Barang</th>
                                        <th>Merk</th>
                                        <th>Tipe</th>
                                        <th>Ukuran</th>
                                        <th>Spf Lain</th>
                                        <th>Harga Perolehan</th>
                                        <th>Jumlah Penyerahan</th>
                                        <th>Jumlah<br>Satuan</th>
                                        <th>PPN</th>
                                        <th>PPN Bayar (Rp)</th>
                                        <th>PPN Fasilitas (Rp)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
	<dl class="row" style="margin-top: 15px;">
        <dt class="col-sm-3">Volume (m3)</dt>
        <dd class="col-sm-9"><?=number_format(floatval(placeValue($tpbHeader,'VOLUME')), 4)?></dd>
        <dt class="col-sm-3">Berat Kotor (KG)</dt>
        <dd class="col-sm-9"><?=number_format(placeValue($tpbHeader,'BRUTO'), 4)?></dd>
        <dt class="col-sm-3">Berat Bersih (KG)</dt>
        <dd class="col-sm-9"><?=number_format(placeValue($tpbHeader,'NETTO'), 4)?></dd>
    </dl>
    <hr>
    <div class="row">
    	<div class="col-md-12">
    		<b>Dokumen</b>
    	</div>
    </div>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<label></label>
				<table class="table table-hover table-bordered table-striped table-sm dt_po_add" id="table_dokumen" role="grid" style="white-space: nowrap; min-width: 600px">
					<thead>
					<tr>
						<th class="text-center">No</th>
						<th class="text-center">Jenis Dokumen</th>
						<th class="text-center">Nomor Dokumen</th>
						<th class="text-center">Tanggal</th>
					</tr>
					</thead>
					<tbody>
                    <?php
                    $i = 1;
                    foreach ($doclain as $row) {
                        echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        echo '<td>'.$row->URAIAN_DOKUMEN.'</td>';
                        echo '<td>'.$row->NOMOR_DOKUMEN.'</td>';
                        $tgl = isset($row->TANGGAL_DOKUMEN) ? date('d-m-Y', strtotime($row->TANGGAL_DOKUMEN)) : '';
                        echo '<td>'.$tgl.'</td>';
                        echo '</tr>';
                        $i++;
                    }
                    ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="card-footer">
    <?php if ($status->FLAG_APPROVAL1 == 0 && $status->FLAG_APPROVAL2 == 0) { ?>
        <a href="<?=base_url('exim/cas_doc_out/approval1/'.$tpbHeader->ID)?>" class="btn btn-sm btn-primary"><i class="fal fa fa-check-circle"></i> Approve 1</a>
    <?php } else if ($status->FLAG_APPROVAL1 == 1 && $status->FLAG_APPROVAL2 == 0) {?>
        <a href="<?=base_url('exim/cas_doc_out/approval2/'.$tpbHeader->ID)?>" class="btn btn-sm btn-primary"><i class="fal fa fa-check-circle"></i> Approve 2</a>
    <?php } ?>
    <a href="<?=base_url('exim/cas_doc_out/')?>" class="btn btn-sm btn-info"><i class="fal fa fa-times-circle"></i> Back</a>
</div>