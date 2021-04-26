<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Exim</li>
		<li class="breadcrumb-item">CAS In</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			CAS In
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12 col-lg-2">
							<label class="form-label">Submission Date</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-datepicker x-readonly tglajuawal" readonly placeholder="Select date" value="<?=date('01-m-Y')?>" onchange="reloadDT('tglajuawal')" />
								<div class="input-group-append">
									<button class="tglajuawalclose btn btn-sm btn-default" onclick="removeFilter('tglajuawal')">
										<i class="text-danger fal fa-times"></i>
									</button>
									<button class="tglajuawalcal btn btn-sm btn-default x-hidden">
										<i class="fa fal fa-calendar"></i>
									</button>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-2">
							<label class="form-label">&nbsp;</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-datepicker x-readonly tglajuakhir" readonly placeholder="Select date" value="<?=date('t-m-Y')?>" onchange="reloadDT('tglajuakhir')" />
								<div class="input-group-append">
									<button class="tglajuakhirclose btn btn-sm btn-default" onclick="removeFilter('tglajuakhir')">
										<i class="text-danger fal fa-times"></i>
									</button>
									<button class="tglajuakhircal btn btn-sm btn-default x-hidden">
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
						<div class="col-sm-12 col-lg-3">
							<label class="form-label">Supplier</label>
							<div class="input-group input-group-sm">
								<select class="form-control form-control-sm select2" id="supplier" name="supplier" required>
									<option value="ALL" selected>All</option>
									<?=createOption($ssupplier,'nama_consignee',array('kode_customer','nama'),' - ', $supplier);?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-lg-12 col-lx-12">
							<div class="table-responsive">
								<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" style="white-space: nowrap">
									<thead>
										<tr>
											<th class="text-center" rowspan="2">No</th>
											<th class="text-center" colspan="3">Dokumen</th>
											<th class="text-center" rowspan="2">Nama Supplier</th>
											<th class="text-center" rowspan="2">Valuta</th>
											<th class="text-center" rowspan="2">Harga Perolehan</th>
											<th class="text-center" rowspan="2">CIF</th>
											<th class="text-center" rowspan="2">CIF Rupiah</th>
											<th class="text-center" rowspan="2">Status</th>
											<th class="text-center" rowspan="2">Option</th>
										</tr>
										<tr>
											<th class="text-center">Tanggal</th>
											<th class="text-center">Nomor</th>
											<th class="text-center">Jenis BC</th>
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
