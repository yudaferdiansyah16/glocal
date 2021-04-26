<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">GCI</a></li>
		<li class="breadcrumb-item">Exim</li>
		<li class="breadcrumb-item">Doc Out</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Doc Out
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<a href="<?=base_url('exim/transaksi_doc_out/add')?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> Add New</a>
					<a href="<?=base_url('exim/transaksi_doc_out/view_30')?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> BC 3.0</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" style="white-space: nowrap">
							<thead>
							<tr><th>No</th>
								<th>No Pengajuan</th>
								<th>Tanggal</th>
								<th>Jenis TPB</th>
								<th>Jenis Dokumen</th>
								<th>Tujuan Pengiriman</th>
								<th>Harga Penyerahan</th>
								<th>Kemasan</th>
								<th>Netto</th>
								<th>Bruto</th>
								<th>Quantity</th>
								<th>Option</th>
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
