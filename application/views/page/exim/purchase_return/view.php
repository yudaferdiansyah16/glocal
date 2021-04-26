<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Exim</li>
		<li class="breadcrumb-item">Purchase Return</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
            Purchase Return
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<a href="<?=base_url('exim/purchase_return/add')?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> Add New</a>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12 col-lg-3">
							<label class="form-label">Return Date</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-datepicker x-readonly tglawal" readonly placeholder="Select date" value="<?=date('01-m-Y')?>" onchange="reloadDT('tglawal')" />
								<div class="input-group-append">
									<button class="tglawalclose btn btn-sm btn-default" onclick="removeFilter('tglawal')">
										<i class="text-danger fal fa-times"></i>
									</button>
									<button class="tglawalcal btn btn-sm btn-default x-hidden">
										<i class="fa fal fa-calendar"></i>
									</button>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-3">
							<label class="form-label">&nbsp;</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-datepicker x-readonly tglakhir" readonly placeholder="Select date" value="<?=date('t-m-Y')?>" onchange="reloadDT('tglakhir')" />
								<div class="input-group-append">
									<button class="tglakhirclose btn btn-sm btn-default" onclick="removeFilter('tglakhir')">
										<i class="text-danger fal fa-times"></i>
									</button>
									<button class="tglakhircal btn btn-sm btn-default x-hidden">
										<i class="fa fal fa-calendar"></i>
									</button>
								</div>
							</div>
						</div>
					</div> <br>
					<div class="row">
						<div class="col-sm-12">
							<div class="table-responsive">
								<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" style="white-space: nowrap">
									<thead>
									<tr>
										<th class="text-center">No</th>
										<th class="text-center">Return Code</th>
										<th class="text-center">Return Date</th>
										<th class="text-center">Receive Notes Code</th>
										<th class="text-center">Receive Notes Date</th>
										<th class="text-center">Supplier</th>
										<th class="text-center">Notes</th>
										<th class="text-center">Item</th>
										<th class="text-center">Quantity</th>
										<th class="text-center">Status</th>
										<th class="text-center">Option</th>
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
