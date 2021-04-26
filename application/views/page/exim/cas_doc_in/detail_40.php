<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Exim</li>
		<li class="breadcrumb-item">Transaksi Doc In</li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Detail Transaksi Doc In
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<?php if ($status->FLAG_APPROVAL2 == 1) { ?>
						<button type="button" disabled class="btn btn-primary btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 2
						</button>
					<?php } else if ($status->FLAG_APPROVAL1 == 1) { ?>
						<button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 1
						</button>
						<button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass-start"></i> Waiting for Approve 2
						</button>
					<?php } else if ($status->FLAG_APPROVAL1 == 0) { ?>
						<button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass-start"></i> Waiting for Approve 1
						</button>
					<?php } ?>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12 col-lg-12 col-xl-12">
							<dl class="row">
								<dt class="col-sm-6 col-lg-3">No Pengajuan</dt>
								<dd class="col-sm-6 col-lg-3"><?=placeValue($tpbHeader,'NOMOR_AJU')?></dd>
								<dt class="col-sm-6 col-lg-3">No Pendaftaran</dt>
								<dd class="col-sm-6 col-lg-3"><?=placeValue($tpbHeader,'NOMOR_DAFTAR')?></dd>
								<dt class="col-sm-6 col-lg-3">Tanggal Pengajuan</dt>
								<dd class="col-sm-6 col-lg-3"><?=$tpbHeader->TANGGAL_AJU != null ?date('d-m-Y',strtotime($tpbHeader->TANGGAL_AJU)) : ''?></dd>
								<dt class="col-sm-6 col-lg-3">Tanggal Pendaftaran</dt>
								<dd class="col-sm-6 col-lg-3"><?=$tpbHeader->TANGGAL_DAFTAR != null ?date('d-m-Y',strtotime($tpbHeader->TANGGAL_DAFTAR)) : ''?></dd>
								<dt class="col-sm-6 col-lg-3">Jenis TPB</dt>
								<dd class="col-sm-6 col-lg-9"><?=placeValue($tpbHeader,'URAIAN_JENIS_TPB')?></dd>
								<dt class="col-sm-6 col-lg-3">Tujuan</dt>
								<dd class="col-sm-6 col-lg-9"><?=placeValue($tpbHeader,'URAIAN_TUJUAN_PENGIRIMAN')?></dd>
								<dt class="col-sm-6 col-lg-3">Jenis Dokumen</dt>
								<dd class="col-sm-6 col-lg-9"><?=placeValue($tpbHeader,'URAIAN_DOKUMEN_PABEAN')?></dd>
							</dl>
						</div>
						<div class="col-sm-12 col-lg-12 col-xl-12">
							<div class="row">
								<div class="col-sm-12 col-lg-6 col-xl-6">
									<p style="margin: 0;padding-top: 10px"><b>PENGUSAHA</b></p>
									<p style="margin: 0;padding: 0"><b>NPWP</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
									<p style="margin: 0;padding: 0"><b>NAMA</b> : <?=placeValue($tpbHeader,'NAMA_PENGUSAHA')?></p>
									<p style="margin: 0;padding: 0"><b>ALAMAT</b> : <?=placeValue($tpbHeader,'ALAMAT_PENGUSAHA')?></p>
									<p style="margin: 0;padding: 0"><b>NO IJIN TPB</b> : <?=placeValue($tpbHeader,'NOMOR_IJIN_TPB')?></p>
								</div>
								<div class="col-sm-12 col-lg-6 col-xl-6">
									<p style="margin: 0;padding-top: 10px"><b>PENGIRIM</b></p>
									<p style="margin: 0;padding: 0"><b>NAMA</b> : <?=placeValue($tpbHeader,'NAMA_PENGIRIM')?></p>
									<p style="margin: 0;padding: 0"><b>ALAMAT</b> : <?=placeValue($tpbHeader,'ALAMAT_PENGIRIM')?></p>
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<label><b>Barang</b></label>
								<table class="table table-hover table-bordered table-striped table-sm" id="dt_doc_in_detail" role="grid" style="white-space: nowrap;width: 99%">
									<thead>
									<tr>
										<th class="text-center">No</th>
										<th class="text-center">Nama Barang</th>
										<th class="text-center">Quantity</th>
										<th class="text-center">Harga</th>
										<th class="text-center">Kemasan</th>
									</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<label><b>Dokumen</b></label>
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
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<?php if ($status->FLAG_APPROVAL1 == 0 && $status->FLAG_APPROVAL2 == 0) { ?>
						<a href="<?=base_url('exim/cas_doc_in/approval1/'.$tpbHeader->ID)?>" class="btn btn-sm btn-primary"><i class="fal fa fa-check-circle"></i> Approve 1</a>
					<?php } else if ($status->FLAG_APPROVAL1 == 1 && $status->FLAG_APPROVAL2 == 0) {?>
						<a href="<?=base_url('exim/cas_doc_in/approval2/'.$tpbHeader->ID)?>" class="btn btn-sm btn-primary"><i class="fal fa fa-check-circle"></i> Approve 2</a>
					<?php } ?>
					<a href="<?=base_url('exim/cas_doc_in/')?>" class="btn btn-sm btn-info"><i class="fal fa fa-times-circle"></i> Back</a>
				</div>
			</div>
		</div>
	</div>
</main>
<script>
    let id_header = <?=$tpbHeader->ID?>;
</script>
