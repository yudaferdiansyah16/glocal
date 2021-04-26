<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Custom</li>
		<li class="breadcrumb-item active">Laporan Pengeluaran</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Laporan Pengeluaran
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<div class="form-group row">
						<div class="col-md-3">
							<label class="form-label">Type of Dates</label>
							<select class="form-control form-control-sm select2" name="" required>
								<option value="" disabled selected>Select Dates . . .</option>
								<option value="TGL1">Tanggal Pendaftaran</option>
								<option value="TGL2">Tanggal Pengeluaran</option>
							</select>
						</div>
						<div class="col-md-2">
							<label class="form-label">Start Date</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-datepicker x-readonly tglstuffingawal" readonly placeholder="Select date" value="<?=date('01-m-Y')?>" onchange="reloadDT('tglstuffingawal')" />
								<div class="input-group-append">
									<button class="tglstuffingawalclose btn btn-sm btn-default" onclick="removeFilter('tglstuffingawal')">
										<i class="text-danger fal fa-times"></i>
									</button>
									<button class="tglstuffingawalcal btn btn-sm btn-default x-hidden">
										<i class="fa fal fa-calendar"></i>
									</button>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<label class="form-label">Due Date</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-datepicker x-readonly tglstuffingakhir" readonly placeholder="Select date" value="<?=date('t-m-Y')?>" onchange="reloadDT('tglstuffingakhir')" />
								<div class="input-group-append">
									<button class="tglstuffingakhirclose btn btn-sm btn-default" onclick="removeFilter('tglstuffingakhir')">
										<i class="text-danger fal fa-times"></i>
									</button>
									<button class="tglstuffingakhircal btn btn-sm btn-default x-hidden">
										<i class="fa fal fa-calendar"></i>
									</button>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-5">
							<label class="form-label">Document</label>
							<div class="input-group input-group-sm">
								<select class="form-control form-control-sm select2 dokumenbc" multiple="multiple" id="dokumenbc" required>
									<option value="">Choose Part...</option>
									<?=createOption($sdokumen_pabean,'KODE_DOKUMEN_PABEAN',array('URAIAN_DOKUMEN_PABEAN'),'-')?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="post" action="<?=base_url('custom/laporan_pengeluaran/store')?>" autocomplete="off">
						<div class="form-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-sm table-bordered table-striped table-hover" id="dt">
										<thead>
										<tr>
											<th class="text-center" rowspan="2">No.</th>
											<th class="text-center" rowspan="2">Document Type</th>
											<th class="text-center" colspan="2">Pabean Document</th>
											<th class="text-center" colspan="2">Receive Document</th>
											<th class="text-center" rowspan="2">Supplier</th>
											<th class="text-center" rowspan="2">Country</th>
											<th class="text-center" colspan="6">Item</th>
										</tr>
										<tr>
											<th class="text-center" style="width: 80px;">Number</th>
											<th class="text-center" style="width: 120px;">Date</th>
											<th class="text-center" style="width: 80px;">Number</th>
											<th class="text-center" style="width: 90px;">Date</th>
											<th class="text-center" style="width: 90px;">Code</th>
											<th class="text-center" style="width: 90px;">Name</th>
											<th class="text-center" style="width: 90px;">Unit</th>
											<th class="text-center" style="width: 90px;">Qty.</th>
											<th class="text-center" style="width: 90px;">Price(Rp)</th>
											<th class="text-center" style="width: 90px;">Price(Other)</th>
										</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
