<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">

		<li class="breadcrumb-item">Master</li>
		<li class="breadcrumb-item active">Rates</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Master Rates
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<a href="<?=base_url('master/rates/add')?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> Add New</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped table-sm" id="dt" style="width:99%;">
							<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Valuta</th>
								<th class="text-center">Sell Rates</th>
								<th class="text-center">Buy Rates</th>
								<th class="text-center">Date</th>
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
