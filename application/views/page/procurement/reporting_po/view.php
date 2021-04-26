<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">SMARTONE</a></li>
		<li class="breadcrumb-item">Procurement</li>
		<li class="breadcrumb-item active">Reporting Purchase Order</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Reporting Purchase Order
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<div class="col-md-3">
						<label class="form-label">Supplier</label>
						<div class="input-group input-group-sm">
							<input type="text" class="form-control form-control-sm x-readonly nama_supplier" readonly/>
							<input type="hidden" class="form-control form-control-sm id_supplier"/>
							<div class="input-group-append">
								<button type="button" class="btn btn-default" data-toggle="modal" data-target="#m_supplier_modal"><i class="fal fa-search"></i></button>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" style="white-space: nowrap">
							<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">PO Code</th>
								<th class="text-center">Date</th>
								<th class="text-center">Due Date</th>
								<th class="text-center">Supplier</th>
								<th class="text-center">Item</th>
								<th class="text-center">Quantity</th>
								<th class="text-center">Price</th>
								<th class="text-center">Rates</th>
								<th class="text-center">Requirement</th>
								<th class="text-center">Remark</th>
								<th class="text-center">Status</th>
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
