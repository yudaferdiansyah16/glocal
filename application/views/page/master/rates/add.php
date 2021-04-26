<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">

		<li class="breadcrumb-item">Master</li>
		<li class="breadcrumb-item">Rates</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Rates
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('master/rates/store')?>">
						<div class="form-group row">
							<div class="col-sm-12 col-lg-4 col-xl-4">
								<label class="form-label">Valuta</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly nama_valuta" readonly placeholder=""/>
									<input type="hidden" class="form-control form-control-sm kode_valuta" name="kode_valuta" placeholder=""/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_valuta_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-4 col-xl-4">
								<label class="form-label">Rates Jual</label>
								<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" value="0" name="rates_jual"/>
							</div>
							<div class="col-sm-12 col-lg-4 col-xl-4">
								<label class="form-label">Rates Beli</label>
								<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" value="0" name="rates_beli"/>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Save</button>
							<a href="<?=base_url('master/rates')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Cancel 	</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
