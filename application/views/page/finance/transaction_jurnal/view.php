<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item">Transaction</li>
		<li class="breadcrumb-item active">General Journal</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
		General Journal
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<a href="<?=base_url('finance/transaction_jurnal/add')?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> Add New</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid">
							<thead>
							<tr>
								<th class="text-center" rowspan="2">No</th>
								<th class="text-center" rowspan="2">Transaction No.</th>
								<th class="text-center" rowspan="2">Date</th>
								<th class="text-center" rowspan="2">No. Ref</th>
								<th class="text-center" colspan="2">Amount</th>
								<th class="text-center" rowspan="2">Approval<br>Status</th>
								<th class="text-center" rowspan="2">Option</th>
							</tr>
							<tr>
								<th class="text-center">Debet</th>
								<th class="text-center">Kredit</th>
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
