<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">SMARTONE</a></li>
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item">Reporting Asset</li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Detail Report Asseting
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">

					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-hover table-bordered table-striped table-sm" role="grid"
									style="white-space: nowrap">
									<thead>
										<tr class="text-center">

											<th>Nama Barang</th>
											<!-- <th>Kode Suplier</th> -->
											<th>Metode</th>
											<th>Type Depresiasi</th>
										</tr>
									</thead>
									<tbody>
										<tr class="text-center">

											<th><?=$data->nama_barang ?></th>
											<!-- <th><?=$data->kode_suplier ?></th> -->
											<th><?=$data->metode ?></th>
											<th><?=$data->type_depresiasi ?></th>

										</tr>

									</tbody>
								</table>
								<a href="javascript:window.history.go(-1);" class="btn btn-sm btn-primary">Kembali</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
