<main id="js-page-content" role="main" class="page-content">
	<?=generateBreadcrumb($this->lang->line('breadcrumb_edit'))?>
	<div class="subheader">
		<h1 class="subheader-title">
			Edit BOM <small><?=$t_bom->kode_bom?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('master/bom_produksi/update')?>" accept-charset="UTF-8" enctype="multipart/form-data">
						<input type="hidden" name="id_bom" value="<?=$t_bom->id_bom?>"/>
						<div class="form-row">
							<div class="form-group col-md-3">
								<label class="form-label">
									SO Number
								</label>
								<input type="text" class="form-control form-control-sm form-control-plaintext x-readonly kode_po" readonly value="<?=$t_bom->kode_po?>">
							</div>
							<div class="form-group col-md-2">
								<label class="form-label">
									PO Buyer
								</label>
								<input type="text" class="form-control form-control-sm form-control-plaintext x-readonly po_buyer" readonly value="#<?=$t_bom->po_buyer?>">
							</div>
							<div class="form-group col-md-4">
								<label class="form-label">Customer</label>
								<input type="text" class="form-control form-control-sm form-control-plaintext nama_supplier x-readonly" value="<?=$t_bom->nama_supplier?>" readonly required/>
							</div>
							<div class="form-group col-md-2">
								<label class="form-label">Order Date</label>
								<input type="text" class="form-control form-control-sm form-control-plaintext tanggal_dibuat x-readonly" value="<?=date('d-m-Y', strtotime($t_bom->tanggal_dibuat))?>" readonly required/>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label class="form-label">Item Product</label>
								<input type="hidden" name="id_sub_barang" value="<?=$t_bom->id_sub_barang?>"/>
								<input type="text" class="form-control form-control-sm form-control-plaintext nama_sub_barang x-readonly" value="<?=$t_bom->nama_barang?>" readonly required/>
							</div>
							<div class="form-group col-md-2">
								<label class="form-label">Quantity</label>
								<div class="input-group input-group-sm">
									<input type="hidden" name="id_satuan" value="<?=$t_bom->id_satuan?>"/>
									<input type="text" name="qty" class="form-control form-control-sm form-control-plaintext input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" value="<?=$t_bom->qty?>" readonly/>
									<div class="input-group-append">
										<span class="input-group-text kode_satuan"><?=$t_bom->kode_satuan?></span>
									</div>
								</div>
							</div>
							<div class="form-group col-md-2">
								<label class="form-label">Min Tolerance</label>
								<div class="input-group input-group-sm">
									<input type="text" name="qty_min_percent" class="form-control form-control-sm form-control-plaintext input-mask" value="<?=$t_bom->qty_min_percent?>" data-inputmask="'alias': 'currency', 'prefix': ''" readonly/>
									<div class="input-group-append">
										<span class="input-group-text">%</span>
									</div>
								</div>
							</div>
							<div class="form-group col-md-2">
								<label class="form-label">Max Tolerance</label>
								<div class="input-group input-group-sm">
									<input type="text" name="qty_max_percent" class="form-control form-control-sm form-control-plaintext input-mask" value="<?=$t_bom->qty_max_percent?>" data-inputmask="'alias': 'currency', 'prefix': ''" readonly/>
									<div class="input-group-append">
										<span class="input-group-text">%</span>
									</div>
								</div>
							</div>
							<!--<div class="form-group col-md-2">
								<label class="form-label">Residual</label>
								<div class="input-group input-group-sm">
									<input type="text" name="residual" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" value="<?/*=$t_bom->residual*/?>" required/>
									<div class="input-group-append">
										<span class="input-group-text">%</span>
									</div>
								</div>
							</div>-->
						</div>
						<hr>
						<div class="form-group row">
							<div class="col-sm-12">
								<textarea id="summernote" name="note" class="summernote"><?=$t_bom->note?></textarea>
							</div>
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
</main>
