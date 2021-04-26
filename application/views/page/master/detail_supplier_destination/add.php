<main id="js-page-content" role="main" class="page-content">
	<?=generateBreadcrumb($this->lang->line('breadcrumb_add'))?>
	<div class="subheader">
		<h1 class="subheader-title">
			<?=$this->lang->line('title_add')?>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('master/detail_supplier_destination/store')?>">
						<div class="form-group row">
							<div class="col-md-12">
								<label class="form-label"><?=$this->lang->line('label_kustomer_detail_supplier_destination')?></label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm nama_supplier" placeholder="Choose Customer..." value="<?=isset($NAMA) ? $NAMA : ''?>"/>
									<input type="hidden" name="id_supplier" value="<?=isset($id_supplier) ? $id_supplier : ''?>"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#referensi_pemasok_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<label class="form-label"><?=$this->lang->line('label_penerima_barang_detail_supplier_destination')?></label>
								<input type="text" name="nama_tujuan" class="form-control form-control-sm" placeholder="" value="">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<label class="form-label"><?=$this->lang->line('label_alamat_detail_supplier_destination')?></label>
								<textarea class="form-control" name="alamat"><?=isset($alamat)? $alamat : '';?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<label class="form-label"><?=$this->lang->line('label_negara_detail_supplier_destination')?></label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm nama_negara" placeholder="Choose Country..." value="<?=isset($URAIAN_NEGARA) ? $URAIAN_NEGARA : ''?>"/>
									<input type="hidden" name="id_negara" value="<?=isset($id_negara) ? $id_negara : ''?>"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#referensi_negara_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
						</div>
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
