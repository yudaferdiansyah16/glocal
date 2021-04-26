<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">GCI</a></li>
		<li class="breadcrumb-item">Master</li>
		<li class="breadcrumb-item active">BOM</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Master BOM
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<a href="<?=base_url('master/bom/add')?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> Add New</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped table-sm w-100" id="dt" role="grid">
							<thead>
							<tr class="text-center">
								<th>No</th>
								<th style="width: 150px;">BOM Code</th>
								<th style="width: 100px;">Date</th>
								<th style="width: 150px;">SO Number</th>
								<th>Customer</th>
								<th>Item Product</th>
								<th>Quantity</th>
								<th style="width: 140px;">Option</th>
								<th style="width: 50px;">Job</th>
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
