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
					<form method="post" action="<?=base_url('master/barang/update')?>">
						<input type="hidden" name="id_barang" value="<?=placeValue($data, 'id_barang')?>">
						<div class="form-group row">
                            <!-- <div class="col-md-12" style="padding-bottom: 20px">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" name="havingchild" value="1" id="havingchild">
                                    <label class="custom-control-label" for="havingchild"><?=$this->lang->line('label_having_child_barang')?></label>
                                </div>
                            </div> -->
                            <div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_nama_barang')?></label>
                                <input type="text" name="m_barang[nama_barang]" class="form-control" placeholder="" value="<?=placeValue($data, 'nama_barang')?>" required>
                            </div>
                            <div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_fasilitas_barang')?></label>
                                <input type="text" class="form-control x-readonly" placeholder="" value="<?=placeValue($data, 'nama_fasilitas')?>" readonly>
                            </div>
                            <div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_kategori_barang')?></label>
                                <input type="text" class="form-control x-readonly" placeholder="" value="<?=placeValue($data, 'nama_kategori')?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><?=$this->lang->line('label_asal_barang_barang')?></label>
                                <input type="text" class="form-control x-readonly" placeholder="" value="<?=placeValue($data, 'nama_asal')?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><?=$this->lang->line('label_kelas_barang')?></label>
                                <input type="text" class="form-control x-readonly" placeholder="" value="<?=placeValue($data, 'nama_class')?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><?=$this->lang->line('label_merek_barang')?></label>
                                <input type="text" class="form-control x-readonly" placeholder="" value="<?=placeValue($data, 'nama_brand')?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><?=$this->lang->line('label_pengemasan_barang')?></label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control x-readonly" placeholder="" value="<?=placeValue($data, 'nama_kemasan')?>" readonly>
                                </div>
                            </div>
                            <!-- <div class="col-md-6 is-child">
                                <label class="form-label"><?=$this->lang->line('label_kode_hs_barang')?></label>
                                <input type="text" name="m_sub_barang[kode_hs]" class="form-control" placeholder="" value="<?=placeValue($data, 'kode_hs')?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label is-child"><?=$this->lang->line('label_per_kemasan_barang')?></label>
                                <input type="text" name="m_sub_barang[nilai_terbesar]" class="form-control" placeholder="" value="<?=placeValue($data, 'nilai_terbesar')?>" required>
                            </div>
                            <div class="col-md-6 is-child">
                                <label class="form-label"><?=$this->lang->line('label_unit_terbesar_barang')?></label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm x-readonly nama_satuan" readonly placeholder="Choose Data...">
                                    <input type="hidden" name="m_sub_barang[id_satuan_terbesar]" class="id_satuan" value="<?=placeValue($data, 'id_satuan_terbesar')?>"/>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-default btn-search-satuan" data-toggle="modal" data-target="#referensi_satuan_modal"><i class="fal fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 is-child">
                                <label class="form-label"><?=$this->lang->line('label_per_unit_terbesar_barang')?></label>
                                <input type="text" name="m_sub_barang[nilai_terkecil]" class="form-control" placeholder="" value="<?=placeValue($data, 'nilai_terkecil')?>" required>
                            </div>
                            <div class="col-md-6 is-child">
                                <label class="form-label"><?=$this->lang->line('label_unit_terendah_barang')?></label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm x-readonly nama_satuan" readonly placeholder="Choose Data..." required>
                                    <input type="hidden" name="m_sub_barang[id_satuan_terkecil]" class="id_satuan" value="<?=placeValue($data, 'id_satuan_terkecil')?>"/>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-default btn-search-satuan" data-toggle="modal" data-target="#referensi_satuan_modal"><i class="fal fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 is-child">
                                <label class="form-label"><?=$this->lang->line('label_netto_barang')?></label>
                                <input type="text" name="m_sub_barang[netto]" class="form-control" placeholder="" value="<?=placeValue($data, 'netto')?>" required>
                            </div>
                            <div class="col-md-6 is-child">
                                <label class="form-label"><?=$this->lang->line('label_bruto_barang')?></label>
                                <input type="text" name="m_sub_barang[bruto]" class="form-control form-control-sm" placeholder="" value="<?=placeValue($data, 'bruto')?>">
                            </div>
                            <div class="col-md-6 is-child">
                                <label class="form-label"><?=$this->lang->line('label_gaya_barang')?></label>
                                <select class="form-control form-control-sm select2" name="m_sub_barang[id_style]">
                                    <option value="" disabled selected>Select Data . . .</option>
                                    <?= createOption($sstyle, 'id_style', array('kode_style','nama_style'), ' - ', $data->id_style) ?>
                                </select>
                            </div>
                            <div class="col-md-6 is-child">
                                <label class="form-label"><?=$this->lang->line('label_warna_barang')?></label>
                                <input type="text" name="m_sub_barang[colour]" class="form-control" placeholder="" value="<?=placeValue($data, 'colour')?>">
                            </div>
                            <div class="col-md-6 is-child">
                                <label class="form-label"><?=$this->lang->line('label_ukuran_barang')?></label>
                                <input type="text" name="m_sub_barang[size]" class="form-control" placeholder="" value="<?=placeValue($data, 'size')?>">
                            </div> -->
                            <!-- <div class="col-md-12 is-child">
                                <label class="form-label"><?=$this->lang->line('label_dimensi_barang')?></label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <em>p</em>
                                                </span>
                                            </div>
                                            <input type="text" name="m_sub_barang[dimensi_panjang]" class="form-control form-control-sm" value="<?=placeValue($data, 'dimensi_panjang')?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <em>l</em>
                                                </span>
                                            </div>
                                            <input type="text" name="m_sub_barang[dimensi_lebar]" class="form-control form-control-sm" value="<?=placeValue($data, 'dimensi_lebar')?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <em>t</em>
                                                </span>
                                            </div>
                                            <input type="text" name="m_sub_barang[dimensi_tinggi]" class="form-control form-control-sm" value="<?=placeValue($data, 'dimensi_tinggi')?>">
                                        </div>
                                    </div>
                                </div>
							</div> -->
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
