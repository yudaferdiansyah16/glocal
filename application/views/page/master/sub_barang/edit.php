<main id="js-page-content" role="main" class="page-content">
	<?=generateBreadcrumb($this->lang->line('breadcrumb_edit'))?>
	<div class="subheader">
		<h1 class="subheader-title">
			<?=$this->lang->line('title_edit')?>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-8 col-xl-8">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('master/sub_barang/update')?>">
						<input type="hidden" name="id_sub_barang" value="<?=placeValue($data,'id_sub_barang')?>">
						<div class="form-group row">
							<div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_induk_sub_barang')?></label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly nama_barang_parent" readonly placeholder="Pilih Satuan..." value="<?=placeValue($data,'nama_barang_parent')?>">
									<input type="hidden" name="id_barang" value="<?=placeValue($data,'id_barang')?>"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#m_barang_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_nama_sub_barang')?></label>
								<input type="text" name="nama_barang" class="form-control" placeholder="" value="<?=placeValue($data,'nama_barang')?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">
									<?=$this->lang->line('label_unit_terkecil_sub_barang')?>
								</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly nama_satuan" readonly placeholder="Pilih Satuan..." value="<?=placeValue($data,'uraian_satuan_terkecil')?>">
									<input type="hidden" name="id_satuan_terkecil" class="id_satuan" value="<?=placeValue($data,'id_satuan_terkecil')?>"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default btn-search-satuan" data-toggle="modal" data-target="#referensi_satuan_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<label class="form-label">
									<?=$this->lang->line('label_unit_terbesar_sub_barang')?>
								</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly nama_satuan" readonly placeholder="Pilih Satuan..." value="<?=placeValue($data,'uraian_satuan_terbesar')?>">
									<input type="hidden" name="id_satuan_terbesar" class="id_satuan" value="<?=placeValue($data,'id_satuan_terbesar')?>"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default btn-search-satuan" data-toggle="modal" data-target="#referensi_satuan_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<label class="form-label">
									<?=$this->lang->line('label_kategori_sub_barang')?>
								</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly nama_kategori" readonly placeholder="Pilih Kategori..." value="<?=placeValue($data,'nama_kategori')?>">
									<input type="hidden"  name="id_kategori" value="<?=placeValue($data,'id_kategori')?>"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#m_kategori_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<label class="form-label">
									<?=$this->lang->line('label_klasifikasi_sub_barang')?>
								</label>
								<select class="form-control form-control-sm select2" name="id_class">
									<?=createOption($sclass,'id_class',array('kode_class','nama_class'),' - ',$data->id_class)?>
								</select>
							</div><div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_asal_sub_barang')?></label>
								<select class="form-control form-control-sm select2" name="id_asal">
									<?=createOption($sasal_barang,'ID',array('KODE_ASAL_BARANG','URAIAN_ASAL_BARANG'),' - ',$data->id_asal)?>
								</select>
							</div>
							<div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_merek_sub_barang')?></label>
								<select class="form-control form-control-sm select2" name="id_brand">
									<?=createOption($sbrand,'id_brand',array('kode_brand','nama_brand'),' - ',$data->id_brand)?>
								</select>
							</div>
							<div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_gaya_sub_barang')?></label>
								<select class="form-control form-control-sm select2" name="id_style">
									<?=createOption($sstyle	,'id_style',array('kode_style','nama_style'),' - ',$data->id_style)?>
								</select>
							</div>
							<div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_warna_sub_barang')?></label>
								<input type="text" name="colour" class="form-control" placeholder="" value="<?=placeValue($data,'colour')?>">
							</div>
							<div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_ukuran_sub_barang')?></label>
								<input type="text" name="size" class="form-control" value="<?=placeValue($data,'size')?>">
							</div>
							<!-- <div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_dimensi_sub_barang')?></label>
								<input type="text" name="dimensi" class="form-control" placeholder="" value="<?=placeValue($data,'dimensi')?>">
							</div> -->
							<div class="col-md-6 is-child">
                                <label class="form-label"><?=$this->lang->line('label_dimensi_barang')?></label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <em>p</em>
                                                </span>
                                            </div>
                                            <input type="text" name="dimensi_panjang" value="<?=placeValue($data,'dimensi_panjang')?>" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                	<em>l</em>
                                                </span>
                                            </div>
                                            <input type="text" name="dimensi_lebar" value="<?=placeValue($data,'dimensi_lebar')?>" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <em>t</em>
                                                </span>
                                            </div>
                                            <input type="text" name="dimensi_tinggi" value="<?=placeValue($data,'dimensi_tinggi')?>" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
							</div>
							<!-- <div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_stok_sub_barang')?></label>
								<input type="text" name="min_stock" class="form-control" placeholder="" value="<?=placeValue($data,'min_stock')?>">
							</div> -->
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
