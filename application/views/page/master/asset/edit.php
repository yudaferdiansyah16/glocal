<main id="js-page-content" role="main" class="page-content">
	<?=generateBreadcrumb($this->lang->line('breadcrumb_edit'))?>
	<div class="subheader">
		<h1 class="subheader-title">
			<?=$this->lang->line('title_edit')?>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('master/asset/update')?>">
						<input type="hidden" name="id_asset" value="<?=placeValue($data,'id_asset')?>">
						<div class="form-group row">
							<div class="col-md-12">
								<label class="form-label"><?=$this->lang->line('label_barang_asset')?></label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" name="nama_barang" placeholder="Pilih Barang..." value="<?=placeValue()?>"/>
									<input type="hidden" name="id_barang" value="<?=isset($data) ? $data->id_barang : ''?>"/>
									<input type="hidden" name="id_satuan_terkecil" value="<?=isset($data) ? $data->id_satuan_terkecil : ''?>"/>
									<input type="hidden" name="id_satuan_terbesar" value="<?=isset($data) ? $data->id_satuan_terbesar : ''?>"/>
									<input type="hidden" name="kode_hs" value="<?=isset($data) ? $data->kode_hs : ''?>"/>
									<input type="hidden" name="id_kategori" value="<?=isset($data) ? $data->id_kategori : ''?>"/>
									<input type="hidden" name="id_class" value="<?=isset($data) ? $data->id_class : ''?>"/>
									<input type="hidden" name="id_asal" value="<?=isset($data) ? $data->id_asal : ''?>"/>
									<input type="hidden" name="id_brand" value="<?=isset($data) ? $data->id_brand : ''?>"/>
									<input type="hidden" name="style" value="<?=isset($data) ? $data->style : ''?>"/>
									<input type="hidden" name="colour" value="<?=isset($data) ? $data->colour : ''?>"/>
									<input type="hidden" name="size" value="<?=isset($data) ? $data->size : ''?>"/>
									<input type="hidden" name="dimensi" value="<?=isset($data) ? $data->dimensi : ''?>"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#m_sub_barang_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<label class="form-label"><?=$this->lang->line('label_stok_asset')?></label>
								<input type="text" name="stock" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data) ? $data->stock : ''?>" required>
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
