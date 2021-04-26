<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item">Laporan</li>
		<li class="breadcrumb-item">Laporan Jurnal</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Laporan Jurnal
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
						<div class="form-group row">
							<div class="col-md-2">
								<label class="form-label">Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="" value="<?= date('d-m-Y') ?>">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label">Description</label>
								<input type="text" class="form-control form-control-sm input-mask description" name="description" placeholder="" required />
							</div>
							<div class="col-md-2">
			    					<label class="form-label">Type Jurnal</label>
                            					<div class="input-group input-group-sm">
									<select name="type_jurnal" class="form-control form-control-sm select2" id="typejurnal">
										<option value="">Type Jurnal</option>
									</select>
			     					</div>
                        				</div>
							<div class="col-md-2">
								<label class="form-label">Currency</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly nama_valuta" readonly placeholder="Select currency...">
									<input type="hidden" name="id_valuta" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_valuta_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label">Rate</label>
								<input type="text" class="form-control form-control-sm input-mask rate" name="rate" placeholder="" data-inputmask="'alias': 'currency', 'prefix': '', 'digits': '0'" value="1" required />
							</div>
							<div class="col-md-2">
                            					<label class="form-label"></label>
                            					<div class="input-group input-group-sm">
                                					<button type="button" class="btn btn-primary" value="view">View</button>
                            					</div>
                        				</div>
						</div>
						<div class="from-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="dt" class="table table-sm table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>Position</th>
												<th>Akun</th>
												<th>Description</th>
												<th>Nilai</th>
												<th>Jumlah</th>
												<th>Amount</th>
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