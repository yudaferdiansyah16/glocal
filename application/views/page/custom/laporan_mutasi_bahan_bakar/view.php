<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">

		<li class="breadcrumb-item">Custom</li>
		<li class="breadcrumb-item active">Laporan Mutasi Bahan Bakar</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Laporan Mutasi Bahan Bakar
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<div class="form-group row">
					<div class="col-md-2">
						<label class="form-label">Due Date</label>
						<div class="input-group input-group-sm">
							<input type="text" class="form-control form-control-sm x-datepicker x-readonly" placeholder="Select date" name="">
							<div class="input-group-append">
								<span class="input-group-text fs-xl">
									<i class="fa fal fa-calendar"></i>
								</span>
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<label class="form-label">Start Date</label>
						<div class="input-group input-group-sm">
							<input type="text" class="form-control form-control-sm x-datepicker x-readonly" placeholder="Select date" name="">
							<div class="input-group-append">
								<span class="input-group-text fs-xl">
									<i class="fa fal fa-calendar"></i>
								</span>
							</div>
						</div>
					</div>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid">
							<thead>
							<tr>
								<th class="text-center" rowspan="2">No</th>
								<th class="text-center" colspan="3">Item</th>
								<th class="text-center" rowspan="2">Saldo Awal</th>
								<th class="text-center" rowspan="2">Pemasukan</th>
								<th class="text-center" rowspan="2">Pengeluaran</th>
								<th class="text-center" rowspan="2">Penyesuaian Adjustmen</th>
								<th class="text-center" rowspan="2">Saldo Akhir</th>
								<th class="text-center" rowspan="2">Stock Opame</th>
								<th class="text-center" rowspan="2">Selisih</th>
								<th class="text-center" rowspan="2">Keterangan</th>
							</tr>
							<tr>
								<th class="text-center">Code</th>
								<th class="text-center">Name</th>
								<th class="text-center">Unit</th>
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
