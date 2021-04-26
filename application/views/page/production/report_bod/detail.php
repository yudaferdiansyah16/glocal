<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">DPS</a></li>
		<li class="breadcrumb-item">Production</li>
		<li class="breadcrumb-item ">Bill Of Document</li>
		<li class="breadcrumb-item active">Bill Of Document</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Bill Of Document
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<div class="row">
						<div class="col-md-2">
							<p><b>No Pengajuan</b></p>
							<p><b>Tanggal Pengajuan</b></p>
							<p><b>No Pendaftaran</b></p>
							<p><b>Tanggal Pendaftaran</b></p>							
							<p><b>Customer</b></p>
							<p><b>Admin</b></p>
						</div>
						<div class="col-md-7">
							<p>: <?=$detailbod->NOMOR_AJU?> </p>
							<p>: <?=$detailbod->TANGGAL_AJU?> </p>
							<p>: <?=$detailbod->NOMOR_DAFTAR?> </p>
							<p>: <?=$detailbod->TANGGAL_AJU?> </p>
							<p>: <?=$detailbod->nama?> </p>
							<p>: <?=$detailbod->NOMOR_AJU?> </p>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid">
							<thead>
							<tr>
								<th class="text-center" rowspan="2">No</th>
								<th class="text-center" colspan="5">Barang Keluar</th>
								<th class="text-center" colspan="6">Data Asal</th>
								<th class="text-center" rowspan="2">Supplier</th>
							</tr>
							<tr>
								<th class="text-center">Kode</th>
								<th class="text-center">Nama</th>
								<th class="text-center">Satuan</th>
								<th class="text-center">Qty</th>
								<th class="text-center">Harga</th>
								<th class="text-center">No Dokumen</th>
								<th class="text-center">Tanggal Dokumen</th>
								<th class="text-center">Nama Barang</th>
								<th class="text-center">Kode</th>
								<th class="text-center">Qty</th>
								<th class="text-center">Harga</th>
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
</main>
<script>
    let id_po = <?=$poheader->id_po?>;
</script>
