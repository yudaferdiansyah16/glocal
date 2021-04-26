<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Exim</li>
		<li class="breadcrumb-item active">Reporting Doc IN</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Reporting Doc IN
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
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
						<div class="col-sm-12 col-lg-2">
							<label class="form-label">Recieve Notes Date</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-datepicker x-readonly tglrecieveawal" readonly placeholder="Select date" onchange="reloadDT('tglrecieveawal')" />
								<div class="input-group-append">
									<button class="tglrecieveawalclose btn btn-sm btn-default x-hidden" onclick="removeFilter('tglrecieveawal')">
										<i class="text-danger fal fa-times"></i>
									</button>
									<button class="tglrecieveawalcal btn btn-sm btn-default">
										<i class="fa fal fa-calendar"></i>
									</button>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-2">
							<label class="form-label">&nbsp;</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-datepicker x-readonly tglrecieveakhir" readonly placeholder="Select date" onchange="reloadDT('tglrecieveakhir')" />
								<div class="input-group-append">
									<button class="tglrecieveakhirclose btn btn-sm btn-default x-hidden" onclick="removeFilter('tglrecieveakhir')">
										<i class="text-danger fal fa-times"></i>
									</button>
									<button class="tglrecieveakhircal btn btn-sm btn-default">
										<i class="fa fal fa-calendar"></i>
									</button>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-4">
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
					<div class="form-group row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-sm table-bordered table-striped table-hover nowrap" id="dt">
									<thead>
									<tr>
										<th class="text-center" rowspan="2">No.</th>
										<th class="text-center" rowspan="2">Document Type</th>
										<th class="text-center" colspan="2">Submission</th>
										<th class="text-center" colspan="2">Recieve Notes</th>
										<th class="text-center" rowspan="2">Supplier</th>
										<th class="text-center" rowspan="2">Country</th>
										<th class="text-center" colspan="4">Item</th>
									</tr>
									<tr>
										<th class="text-center" style="width: 80px;">Number</th>
										<th class="text-center" style="width: 120px;">Date</th>
										<th class="text-center" style="width: 80px;">Number</th>
										<th class="text-center" style="width: 90px;">Date</th>
										<th class="text-center" style="width: 90px;">Name</th>
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
				</div>
			</div>
		</div>
	</div>
</main>
