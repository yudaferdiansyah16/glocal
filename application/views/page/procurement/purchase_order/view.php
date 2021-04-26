<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Procurement</li>
		<li class="breadcrumb-item active">Purchase Order</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Purchase Order
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<a href="<?=base_url('procurement/purchase_order/add')?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> <?=$this->lang->line('button_add')?></a>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-3">
							<label class="form-label">Date</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-datepicker x-readonly tglawal" readonly placeholder="Select date" onchange="reloadDT('tglawal')">
								<div class="input-group-append">
									<button class="tglawalclose btn btn-sm btn-default x-hidden" onclick="removeFilter('tglawal')">
										<i class="text-danger fal fa-times"></i>
									</button>
									<button class="tglawalcal input-group-text fs-xl">
										<i class="fa fal fa-calendar"></i>
									</button>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<label class="form-label">&nbsp;</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-datepicker x-readonly tglakhir" readonly placeholder="Select date" onchange="reloadDT('tglakhir')">
								<div class="input-group-append">
									<button class="tglakhirclose btn btn-sm btn-default x-hidden" onclick="removeFilter('tglakhir')">
										<i class="text-danger fal fa-times"></i>
									</button>
									<button class="tglakhircal input-group-text fs-xl">
										<i class="fa fal fa-calendar"></i>
									</button>
								</div>
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-sm-12">
							<div class="table-responsive">
								<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" style="white-space: nowrap">
									<thead>
									<tr>
										<th width="40px">No</th>
										<th>PO Code</th>
										<!-- <th>Date</th> -->
										<th>Due Date</th>
										<th>Supplier</th>
										<th>Valuta</th>
										<!-- <th>Rate</th> -->
										<th>Harga Total</th>
										<!-- <th>Requirement</th> -->
										<!-- <th>Remark</th> -->
										<th>Status</th>
										<th width="130px">Option</th>
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
