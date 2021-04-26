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
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12 col-lg-6 col-xl-6">
							<table class="table table-sm table-bordered" role="grid" style="table-layout: fixed">
								<tr>
									<td><b>No Pengajuan</b></td>
									<td colspan="3"><?=$tpbHeader->NOMOR_AJU?></td>
								</tr>
								<tr>
									<td><b>Jenis TPB</b></td>
									<td><?=$tpbHeader->KODE_JENIS_TPB?></td>
									<td><b>Tanggal Pengajuan</b></td>
									<td><?=$tpbHeader->TANGGAL_AJU?></td>
								</tr>
								<tr>
									<td><b>Jenis Dokumen</b></td>
									<td><?=$tpbHeader->KODE_DOKUMEN_PABEAN?></td>
									<td><b>Tujuan Pengiriman</b></td>
									<td><?=$tpbHeader->KODE_TUJUAN_PENGIRIMAN?></td>
								</tr>
							</table>
						</div>
						<div class="col-sm-12 col-lg-6 col-xl-6">
							<table class="table table-sm table-bordered" role="grid" style="table-layout: fixed">
								<tr>
									<td><b>Jumlah Barang</b></td>
									<td><?=$tpbHeader->JUMLAH_BARANG?></td>
									<td><b>Jumlah KEMASAN</b></td>
									<td><?=$tpbHeader->JUMLAH_KEMASAN?></td>
								</tr>
								<tr>
									<td><b>Netto</b></td>
									<td><?=$tpbHeader->NETTO?></td>
									<td><b>Bruto</b></td>
									<td><?=$tpbHeader->BRUTO?></td>
								</tr>
								<tr>
									<td><b>Harga Penyerahan</b></td>
									<td colspan="3"><?=$tpbHeader->HARGA_PENYERAHAN?></td>
							</table>
						</div>
					</div>
					<?php
					if ($dokumen=='23') include('detail_23.php');
					if ($dokumen=='262') include('detail_262.php');
					?>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<label><b>Barang</b></label>
								<table class="table table-hover table-bordered table-striped table-sm" id="dt_doc_in_detail" role="grid" style="white-space: nowrap;overflow-x: auto">
									<thead>
									<tr>
										<th class="text-center">No</th>
										<th class="text-center">Kode Barang</th>
										<th class="text-center">Nama Barang</th>
										<th class="text-center">Satuan</th>
										<th class="text-center">Quantity</th>
										<th class="text-center">Harga Satuan</th>
										<th class="text-center">Harga Invoice</th>
										<th class="text-center">Asuransi</th>
										<th class="text-center">Diskon</th>
										<th class="text-center">Jumlah Kemasan</th>
										<th class="text-center">Tipe Kemasan</th>
										<?php if ($dokumen=='23') { ?>
										<th class="text-center">Skema Tarif</th>
										<th class="text-center">Tarif</th>
										<?php } ?>
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
			</div>
		</div>
	</div>
</main>
<script>
	let id_header = <?=$tpbHeader->ID?>;
</script>
