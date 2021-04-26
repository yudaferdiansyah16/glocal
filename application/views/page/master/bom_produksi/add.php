<main id="js-page-content" role="main" class="page-content">
	<?=generateBreadcrumb($this->lang->line('breadcrumb_add'))?>
	<div class="subheader">
		<h1 class="subheader-title">
			Add BOM
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<div class="row">
						<div class="col-md-3">
							<label class="form-label">Type of BOM</label>
							<select class="form-control form-control-sm bom_type">
								<option value="">Choose Type...</option>
								<option value="0">General</option>
								<option value="1">Rerun</option>
							</select>
						</div>
					</div>
					<hr>
					<div class="row form-general" style="display: none;">
						<div class="col-md-12">
							<form method="post" action="<?=base_url('master/bom_produksi/store')?>" autocomplete="off">
								<div class="form-row">
									<div class="form-group col-md-3">
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
									<div class="form-group col-md-2">
										<label class="form-label">PO Buyer</label>
										<input type="text" class="form-control form-control-sm form-control-plaintext po_buyer x-readonly" value="-" readonly/>
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Customer</label>
										<input type="text" class="form-control form-control-sm nama_supplier form-control-plaintext x-readonly" value="-" readonly/>
									</div>
									<div class="form-group col-md-4">
										<label class="form-label">Item Product</label>
										<input type="hidden" class="id_sub_barang" name="id_sub_barang" onchange="reloadMasterBom()"/>
										<input type="text" class="form-control form-control-sm form-control-plaintext nama_sub_barang x-readonly" value="-" readonly/>
									</div>
								</div>
								<div class="form-row">
<!--									<div class="form-group col-md-2">-->
<!--										<label class="form-label">Order Date</label>-->
<!--										<input type="text" class="form-control form-control-sm form-control-plaintext tanggal_dibuat x-readonly" readonly/>-->
<!--									</div>-->
									<div class="form-group col-md-3">
										<label class="form-label">
											BOM Master
										</label>
										<div class="input-group input-group-sm">
											<input type="text" class="form-control form-control form-control-sm x-readonly kode_bom" readonly placeholder="Select BOM Number...">
											<input type="hidden" name="id_bom" value=""/>
											<input type="hidden" name="is_rerun" value="0"/>
											<div class="input-group-append">
												<button type="button" class="btn btn-default" data-toggle="modal" data-target="#t_bom_master_modal"><i class="fal fa-search"></i></button>
											</div>
										</div>
									</div>
									<div class="form-group col-md-2">
										<label class="form-label">Quantity</label>
										<div class="input-group input-group-sm">
											<input type="hidden" name="id_satuan"/>
											<input type="text" name="qty" class="form-control form-control-plaintext form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" readonly/>
											<input type="hidden" name="qty_bom" class="qty_bom"/>
											<div class="input-group-append">
												<span class="input-group-text kode_satuan"></span>
											</div>
										</div>
									</div>
									<div class="form-group col-md-2">
										<label class="form-label">Min Tolerance</label>
										<div class="input-group input-group-sm">
											<input type="text" name="qty_min_percent" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''"/>
											<div class="input-group-append">
												<span class="input-group-text">%</span>
											</div>
										</div>
									</div>
									<div class="form-group col-md-2">
										<label class="form-label">Max Tolerance</label>
										<div class="input-group input-group-sm">
											<input type="text" name="qty_max_percent" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''"/>
											<div class="input-group-append">
												<span class="input-group-text">%</span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-row">
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
								<hr>
								<div class="form-group">
									<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
									<a href="<?=base_url('master/bom_produksi')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
								</div>
							</form>
						</div>
					</div>
					<div class="row form-rerun" style="display: none;">
						<div class="col-md-12">
							<form method="post" action="<?=base_url('master/bom_produksi/store')?>" autocomplete="off">
								<div class="form-row">
									<div class="form-group col-md-3">
										<label class="form-label">
											BOM Production
										</label>
										<div class="input-group input-group-sm">
											<input type="text" class="form-control form-control form-control-sm x-readonly kode_bom" readonly placeholder="Select BOM Number...">
											<input type="hidden" name="id_bom" value=""/>
											<input type="hidden" name="is_rerun" value="1"/>
											<div class="input-group-append">
												<button type="button" class="btn btn-default" data-toggle="modal" data-target="#t_bom_produksi_modal"><i class="fal fa-search"></i></button>
											</div>
										</div>
									</div>
									<div class="form-group col-md-2">
										<label class="form-label">PO Buyer</label>
										<input type="text" class="form-control form-control-sm form-control-plaintext po_buyer x-readonly" value="-" readonly/>
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">
											SO Number
										</label>
										<input type="text" class="form-control form-control form-control-sm form-control-plaintext x-readonly kode_po" readonly value="-">
										<input type="hidden" name="id_detail_po" value=""/>
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Customer</label>
										<input type="text" class="form-control form-control-sm form-control-plaintext nama_supplier x-readonly" readonly/>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-3">
										<label class="form-label">BOM Master</label>
										<input type="text" class="form-control form-control-sm form-control-plaintext kode_bom_master x-readonly" value="-" readonly/>
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Item Product</label>
										<input type="hidden" class="id_sub_barang" name="id_sub_barang"/>
										<input type="text" class="form-control form-control-sm form-control-plaintext nama_sub_barang x-readonly" value="-" readonly/>
									</div>
									<div class="form-group col-md-2">
										<label class="form-label">Quantity</label>
										<div class="input-group input-group-sm">
											<input type="hidden" name="id_satuan"/>
											<input type="text" name="qty" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''"/>
											<input type="hidden" name="qty_bom" class="qty_bom"/>
											<div class="input-group-append">
												<span class="input-group-text kode_satuan"></span>
											</div>
										</div>
									</div>
									<div class="form-group col-md-2">
										<label class="form-label">Min Tolerance</label>
										<div class="input-group input-group-sm">
											<input type="text" name="qty_min_percent" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''"/>
											<div class="input-group-append">
												<span class="input-group-text">%</span>
											</div>
										</div>
									</div>
									<div class="form-group col-md-2">
										<label class="form-label">Max Tolerance</label>
										<div class="input-group input-group-sm">
											<input type="text" name="qty_max_percent" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''"/>
											<div class="input-group-append">
												<span class="input-group-text">%</span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-row">
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
								<hr>
								<div class="form-group">
									<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
									<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
