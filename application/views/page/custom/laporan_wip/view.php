<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item active">Laporan WIP</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Laporan WIP
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<div class="form-group row">
						<div class="col-md-2">
							<label class="form-label">Start Date</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-datepicker tglajuawal x-readonly" placeholder="Select date" value="<?=date('01-m-Y')?>" onchange="reloadDT('tglajuawal')">
								<div class="input-group-append">
									<span class="input-group-text fs-xl">
										<i class="fa fal fa-calendar"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<label class="form-label">Due Date</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-datepicker x-readonly tglajuakhir" placeholder="Select date" value="<?=date('t-m-Y')?>" onchange="reloadDT('tglajuakhir')">
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
					<form method="post" action="<?=base_url('custom/laporan_wip/store')?>" autocomplete="off">
						<div class="form-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-sm table-bordered table-striped table-hover" id="dt">
										<thead>
										<tr>
											<th class="text-center" rowspan="2">No.</th>
											<th class="text-center" colspan="4">Item</th>
											<th class="text-center" rowspan="2">Description</th>
										</tr>
										<tr>
											<th class="text-center" style="width: 80px;">Code</th>
											<th class="text-center" style="width: 120px;">Name</th>
											<th class="text-center" style="width: 80px;">Unit</th>
											<th class="text-center" style="width: 90px;">Quamtity</th>
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

