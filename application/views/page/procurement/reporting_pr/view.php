<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Procurement</li>
		<li class="breadcrumb-item active">Reporting Purchase Requesition</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Reporting Purchase Requesition
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<div class="row">
						<div class="col-md-2">
							<label class="form-label">Type</label>
							<select class="form-control form-control-sm select2 jenis_rutinitas" id="jenis_rutinitas">
								<option value="">All</option>
								<?=createOption($sjenis_pp_rutinitas, 'id_jenis_pp_rutinitas', array('nama_jenis_pp_rutinitas'), ' - ')?>
							</select>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid">
							<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">PP Number</th>
								<th class="text-center">Date</th>
								<th class="text-center">Type</th>
								<th class="text-center">Type</th>
								<th class="text-center">Type</th>
								<th class="text-center">Item</th>
								<th class="text-center">Quantity</th>
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
