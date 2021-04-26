<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Production</li>
		<li class="breadcrumb-item">Request Material</li>
		<li class="breadcrumb-item active">Return</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Return Request Material
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="card mb-g">
				<div class="card-header">
					<div class="row">
						<div class="col-md-12">
							<form method="post" action="<?=base_url('production/return_request_material/add')?>">
								<div class="form-group">
									<label class="form-label">Request</label>
									<div class="input-group input-group-sm">
										<input type="text" class="form-control form-control-sm x-readonly kode_production_filter" name="kode_produksi" readonly placeholder=""/>
										<input type="hidden" class="form-control form-control-sm id_production_filter" name="id_production" placeholder=""/>
										<div class="input-group-append">
											<button type="button" class="btn btn-default" data-toggle="modal" data-target="#return_request_modal"><i class="fal fa-search"></i></button>
										</div>
									</div>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Filter</button>
									<a href="<?=base_url('production/return_request_material')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
