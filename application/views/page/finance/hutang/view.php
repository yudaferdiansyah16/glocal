<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item active">Debit</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Debit
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('finance/hutang/store')?>" autocomplete="off">
						<div class="form-group row">
							<div class="col-md-3">
								<label class="form-label">Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" id="date" name="t_po[tanggal_dibuat]" required>
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label class="form-label">Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" id="date" name="t_po[tanggal_dibuat]" required>
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label"></label>
								<div class="form-group">
									<button type="button" class="btn btn btn-success"><i class="fal fa fa-search"></i> Search</button>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-sm table-bordered table-striped table-hover" id="dt">
										<thead>
										<tr>
											<th class="text-center" style="width: 80px;">No</th>
											<th class="text-center" style="width: 120px;">Date</th>
											<th class="text-center" style="width: 80px;">Due Date</th>
											<th class="text-center" style="width: 90px;">Token</th>
											<th class="text-center" style="width: 90px;">Supplier</th>
											<th class="text-center" style="width: 90px;">Currency</th>
											<th class="text-center" style="width: 90px;">0-30 Dyas</th>
											<th class="text-center" style="width: 90px;">60-90 Days</th>
											<th class="text-center" style="width: 90px;">60-90 Dyas</th>
											<th class="text-center" style="width: 90px;"><90 Dyas</th>
											<th class="text-center" style="width: 90px;">Total</th>
										</tr>
										</thead>
										<tbody>
										<tr data-index="0">
											<td class="text-center">1</td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" readonly></td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" readonly/></td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" readonly/></td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" readonly/></td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" readonly/></td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" readonly/></td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" readonly/></td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" readonly/></td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" readonly/></td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" readonly/></td>
										</tr>
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
