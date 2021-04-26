	<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		
		<li class="breadcrumb-item">Master</li>
		<li class="breadcrumb-item">BOM</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add BOM
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('master/bom/store')?>">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label class="form-label">
									SO Number
								</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly kode_po" readonly placeholder="Select SO Number...">
									<input type="hidden" name="id_detail_po" value=""/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#t_detail_so_bom_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label class="form-label">Customer</label>
								<input type="text" class="form-control form-control-sm nama_supplier x-readonly" readonly/>
							</div>
							<div class="form-group col-md-2">
								<label class="form-label">Order Date</label>
								<input type="text" class="form-control form-control-sm tanggal_dibuat x-readonly" readonly/>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-5">
								<label class="form-label">Item Product</label>
								<input type="hidden" name="id_sub_barang"/>
								<input type="text" class="form-control form-control-sm nama_sub_barang x-readonly" readonly/>
							</div>
							<div class="form-group col-md-2">
								<label class="form-label">Quantity</label>
								<div class="input-group input-group-sm">
									<input type="hidden" name="id_satuan"/>
									<input type="text" name="qty" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''"/>
									<div class="input-group-append">
										<span class="input-group-text kode_satuan"></span>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label">BOM Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" placeholder="Select date" id="date" name="tanggal_bom" required>
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<!--<div class="form-group col-md-2">
								<label class="form-label">Residual</label>
								<div class="input-group input-group-sm">
									<input type="text" name="residual" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" value="0"/>
									<div class="input-group-append">
										<span class="input-group-text">%</span>
									</div>
								</div>
							</div>-->
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Save</button>
							<a href="<?=base_url('master/bom')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Cancel</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
