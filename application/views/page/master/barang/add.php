<main id="js-page-content" role="main" class="page-content">
	<?=generateBreadcrumb($this->lang->line('breadcrumb_add'))?>
	<div class="subheader">
		<h1 class="subheader-title">
			<?=$this->lang->line('title_add')?>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-8 col-xl-8">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('master/barang/store')?>">
						<div class="form-group row">
							<div class="col-md-6 x-hidden" >
								<label class="form-label"><?=$this->lang->line('label_induk_barang')?></label>
								<div class="input-group input-group-sm ">
									<input type="text" class="form-control form-control form-control-sm x-readonly nama_barang_parent" readonly placeholder="Select barang...">
									<input type="hidden" name="id_barang"/>
									<input type="hidden" name="id_fasilitas"/>
									<input type="hidden" name="serial_barang"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#m_barang_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_nama_barang')?></label>
								<input type="text" name="nama_barang" class="form-control" placeholder="">
							</div>
							<div class="col-md-6">
								<label class="form-label">
									<!-- <?=$this->lang->line('label_unit_terkecil_barang')?> -->
                                    Unit Terkecil
								</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly nama_satuan" name="" readonly value="<?=isset($data) ? $data->nama_satuan_kecil : ''?>" required>
									<input type="hidden" name="id_satuan_terkecil" class="id_satuan" value="<?=isset($data) ? $data->id_satuan_terkecil : ''?>"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default btn-search-satuan" data-toggle="modal" data-target="#referensi_satuan_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<label class="form-label">
									<?=$this->lang->line('label_unit_terbesar_barang')?>
								</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly nama_satuan" readonly value="<?=isset($data) ? $data->nama_satuan_besar : ''?>" required>
									<input type="hidden" name="id_satuan_terbesar" class="id_satuan" value="<?=isset($data) ? $data->id_satuan_terbesar : ''?>"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default btn-search-satuan" data-toggle="modal" data-target="#referensi_satuan_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<label class="form-label">Unit Konversi</label>
								<input type="text" name="unit_konversi" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" value="">
							</div>
							<div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_kode_hs_barang')?></label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" name="kode_hs" placeholder="" value="<?=isset($data) ? $data->kode_hs : ''?>" required/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#m_hs_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<label class="form-label">
									<?=$this->lang->line('label_kategori_barang')?>
								</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly nama_kategori" readonly placeholder="Pilih Kategori...">
									<input type="hidden" name="id_kategori"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#m_kategori_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<label class="form-label">
									<?=$this->lang->line('label_klasifikasi_barang')?>
								</label>
								<select class="form-control form-control-sm select2" name="id_class">
									<option value="" disabled selected>Select Data . . .</option>
									<?=createOption($sclass,'id_class',array('kode_class','nama_class'),' - ')?>
								</select>
							</div><div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_asal_barang')?></label>
								<select class="form-control form-control-sm select2" name="id_asal">
									<option value="" disabled selected>Select Data . . .</option>
									<?=createOption($sasal_barang,'ID',array('KODE_ASAL_BARANG','URAIAN_ASAL_BARANG'),' - ')?>
								</select>
							</div>
							<div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_merek_barang')?></label>
								<select class="form-control form-control-sm select2" name="id_brand">
									<option value="" disabled selected>Select Data . . .</option>
									<?=createOption($sbrand,'id_brand',array('kode_brand','nama_brand'),' - ')?>
								</select>
							</div>
							<div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_gaya_barang')?></label>
								<select class="form-control form-control-sm select2" name="id_style">
									<option value="" disabled selected>Select Data . . .</option>
									<?=createOption($sstyle	,'id_style',array('kode_style','nama_style'),' - ')?>
								</select>
							</div>
							<div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_warna_barang')?></label>
								<input type="text" name="colour" class="form-control" placeholder="" >
							</div>
							<div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_ukuran_barang')?></label>
								<input type="text" name="size" class="form-control">
							</div>
							<!-- <div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_dimensi_barang')?></label>
								<input type="text" name="dimensi" class="form-control" placeholder="">
							</div> -->
							<!-- <div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_stok_barang')?></label>
								<input type="text" name="min_stock" class="form-control" placeholder="">
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
                                            <input type="text" name="dimensi_panjang" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                	<em>l</em>
                                                </span>
                                            </div>
                                            <input type="text" name="dimensi_lebar" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <em>t</em>
                                                </span>
                                            </div>
                                            <input type="text" name="dimensi_tinggi" class="form-control form-control-sm">
                                        </div>
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
