<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Warehouse</li>
		<li class="breadcrumb-item active">Report Receive Material</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">Report Receive Material</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<div class="row">
						<div class="col-md-2">
							<label class="form-label">Type of DN</label>
							<select class="form-control form-control-sm id_fasilitas form-filter">
								<option value="">All</option>
								<?=createOption($tipe_sales,'id_tipe_sales',array('nama_tipe_sales'),'-')?>
							</select>
						</div>
						<div class="col-md-4">
							<label class="form-label">Supplier</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-readonly nama_supplier" readonly placeholder="Select supplier..." required>
								<input type="hidden" class="id_supplier"/>
								<div class="input-group-append">
									<button type="button" class="btn btn-default btn-search-customer" data-toggle="modal" data-target="#referensi_pengusaha_modal"><i class="fal fa-search"></i></button>
									<button type="button" class="btn btn-danger btn-clear-customer"><i class="fal fa-times-circle"></i></button>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<label class="form-label">Start Date</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-datepicker x-readonly start_date form-filter" placeholder="Select date" value="<?=date('01-m-Y')?>">
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
								<input type="text" class="form-control form-control-sm x-datepicker x-readonly end_date form-filter" placeholder="Select date" value="<?=date('t-m-Y')?>">
								<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top: 15px;">
						<div class="col-md-12">
							<div class="table-responsive">
								<table id="dt" class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" style="white-space: nowrap">
									<thead>
									<tr class="text-center">
										<th>No</th>
										<th>Receive Number</th>
										<th>Receive Date</th>
										<th>Supplier</th>
										<th>Invoice Number</th>
										<th>Invoice Date</th>
										<th>SJ Number</th>
										<th>SJ Date</th>
										<th>Item Code</th>
										<th>Item Name</th>
										<th>Receive Quantity</th>
										<th>Unit Quantity</th>
										<th>Warehouse</th>
										<th>Coordinate</th>
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
