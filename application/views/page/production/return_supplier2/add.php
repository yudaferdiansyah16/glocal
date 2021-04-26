	<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Production</li>
		<li class="breadcrumb-item">Return Supplier 2</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Return Supplier 2
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('production/return_supplier2/store')?>">
						<div class="form-group row">
							<div class="col-md-2">
								<label class="form-label">Tanggal</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="t_production[tanggal_mutasi]">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<label class="form-label">No Receive</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly kode_production_filter" name="kode_produksi" readonly placeholder=""/>
									<input type="hidden" class="form-control form-control-sm id_production_filter" name="id_production" placeholder=""/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#return_request_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-hover table-bordered table-striped table-sm" role="grid">
										<thead>
											<tr class="text-center">
												<th class="text-center" rowspan="2" width="20px">No</th>
												<th class="text-center" rowspan="2">No Receive LPB</th>
												<th class="text-center" rowspan="2">Tanggal LPB</th>
												<th class="text-center" rowspan="2">No Job</th>
												<th class="text-center" colspan="5">Barang</th>
												<th class="text-center" rowspan="2" width="80px">Add Item<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#t_wh_detail_request_modal"><i class="fal fa-plus-circle"></i></button></th>
												<th class="text-center" rowspan="2">Catatan Return</th>
											</tr>
											<tr>
												<th>Nama</th>
												<th>Kode</th>
												<th>Satuan</th>
												<th>Qty WH</th>
												<th>Return</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="form-group">
							<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>