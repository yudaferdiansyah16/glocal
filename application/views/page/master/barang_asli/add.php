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
                            <div class="col-md-12" style="padding-bottom: 20px">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" name="havingchild" value="1" id="havingchild">
                                    <label class="custom-control-label" for="havingchild"><?=$this->lang->line('label_having_child_barang')?></label>
                                </div>
                            </div>
							<div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_nama_barang')?></label>
								<input type="text" name="m_barang[nama_barang]" class="form-control form-control-sm" placeholder="" value="<?=isset($nama_barang)? $nama_barang : '';?>" required>
							</div>
                            <div class="col-md-6">
                                <label class="form-label"><?=$this->lang->line('label_fasilitas_barang')?></label>
                                <select class="form-control form-control-sm select2" name="m_barang[id_fasilitas]" required>
                                    <option value="" disabled selected>Select Data . . .</option>
                                    <?= createOption($sfasilitas, 'id_fasilitas', array('nama_fasilitas'), '') ?>
                                </select>
                            </div>
							<div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_kategori_barang')?></label>
                                <select class="form-control form-control-sm select2" name="m_barang[id_kategori]" required>
                                    <option value="" disabled selected>Select Data . . .</option>
                                    <?= createOption($scategory, 'id_kategori', array('nama_kategori'), '') ?>
                                </select>
							</div>
							<div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_asal_barang_barang')?></label>
								<select class="form-control form-control-sm select2" name="m_barang[id_asal]" required>
									<option value="" disabled selected>Select Data . . .</option>
									<?= createOption($sasal, 'id_asal', array('nama_asal'), '') ?>
								</select>
							</div>
                            <div class="col-md-6">
                                <label class="form-label"><?=$this->lang->line('label_kelas_barang')?></label>
                                <select class="form-control form-control-sm select2" name="m_barang[id_class]" required>
                                    <option value="" disabled selected>Select Data . . .</option>
                                    <?= createOption($sclass, 'id_class', array('kode_class','nama_class'), ' - ') ?>
                                </select>
                            </div>
							<div class="col-md-6">
								<label class="form-label"><?=$this->lang->line('label_merek_barang')?></label>
								<select class="form-control form-control-sm select2" name="m_barang[id_brand]" required>
									<option value="" disabled selected>Select Data . . .</option>
									<?= createOption($sbrand, 'id_brand', array('kode_brand','nama_brand'), ' - ') ?>
								</select>
							</div>
                            <div class="col-md-6">
                                <label class="form-label"><?=$this->lang->line('label_pengemasan_barang')?></label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm x-readonly nama_kemasan" readonly placeholder="Choose Data...">
                                    <input type="hidden" name="m_barang[id_kemasan]" class="id_kemasan" value="<?=isset($id_kemasan) ? $id_kemasan : ''?>"/>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-default btn-search-packaging" data-toggle="modal" data-target="#referensi_kemasan_modal"><i class="fal fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 is-child">
                                <label class="form-label"><?=$this->lang->line('label_kode_hs_barang')?></label>
                                <input type="text" name="m_sub_barang[kode_hs]" class="form-control form-control-sm" placeholder="" value="<?=isset($kode_hs)? $kode_hs : '';?>">
                            </div>
                            <div class="col-md-6 is-child">
                                <label class="form-label is-child"><?=$this->lang->line('label_per_kemasan_barang')?></label>
                                <input type="text" name="m_sub_barang[nilai_terbesar]" class="form-control form-control-sm" placeholder="" value="<?=isset($nilai_terbesar)? $nilai_terbesar : '';?>" >
                            </div>
                            <div class="col-md-6 is-child">
                                <label class="form-label"><?=$this->lang->line('label_unit_terbesar_barang')?></label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm x-readonly nama_satuan" readonly placeholder="Choose Data...">
                                    <input type="hidden" name="m_sub_barang[id_satuan_terbesar]" class="id_satuan" value="<?=isset($id_satuan_terbesar) ? $id_satuan_terbesar : ''?>"/>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-default btn-search-satuan" data-toggle="modal" data-target="#referensi_satuan_modal"><i class="fal fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 is-child">
                                <label class="form-label"><?=$this->lang->line('label_per_unit_terbesar_barang')?></label>
                                <input type="text" name="m_sub_barang[nilai_terkecil]" class="form-control form-control-sm" placeholder="" value="<?=isset($nilai_terkecil)? $nilai_terkecil : '';?>" >
                            </div>
                            <div class="col-md-6 is-child">
                                <label class="form-label"><?=$this->lang->line('label_unit_terendah_barang')?></label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm x-readonly nama_satuan" readonly placeholder="Choose Data...">
                                    <input type="hidden" name="m_sub_barang[id_satuan_terkecil]" class="id_satuan" value="<?=isset($id_satuan_terkecil) ? $id_satuan_terkecil : ''?>"/>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-default btn-search-satuan" data-toggle="modal" data-target="#referensi_satuan_modal"><i class="fal fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 is-child">
                                <label class="form-label"><?=$this->lang->line('label_netto_barang')?></label>
                                <input type="text" name="m_sub_barang[netto]" class="form-control form-control-sm" placeholder="" value="<?=isset($netto)? $netto: '';?>">
                            </div>
                            <div class="col-md-6 is-child">
                                <label class="form-label"><?=$this->lang->line('label_bruto_barang')?></label>
                                <input type="text" name="m_sub_barang[bruto]" class="form-control form-control-sm" placeholder="" value="<?=isset($bruto)? $bruto: '';?>">
                            </div>
                            <div class="col-md-6 is-child">
                                <label class="form-label"><?=$this->lang->line('label_gaya_barang')?></label>
                                <select class="form-control form-control-sm select2" name="m_sub_barang[id_style]">
                                    <option value="" disabled selected>Select Data . . .</option>
                                    <?= createOption($sstyle, 'id_style', array('kode_style','nama_style'), ' - ') ?>
                                </select>
                            </div>
							<div class="col-md-6 is-child">
								<label class="form-label"><?=$this->lang->line('label_warna_barang')?></label>
								<input type="text" name="m_sub_barang[colour]" class="form-control form-control-sm" placeholder="" value="<?=isset($colour)? $colour : '';?>">
							</div>
							<div class="col-md-6 is-child">
								<label class="form-label"><?=$this->lang->line('label_ukuran_barang')?></label>
								<input type="text" name="m_sub_barang[size]" class="form-control form-control-sm" placeholder="" value="<?=isset($size)? $size : '';?>">
							</div>
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
                                            <input type="text" name="m_sub_barang[dimensi_panjang]" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <em>l</em>
                                                </span>
                                            </div>
                                            <input type="text" name="m_sub_barang[dimensi_lebar]" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <em>t</em>
                                                </span>
                                            </div>
                                            <input type="text" name="m_sub_barang[dimensi_tinggi]" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
							</div>
							<!-- <div class="col-md-6 is-child">
								<label class="form-label"><?=$this->lang->line('label_dimensi_barang')?></label>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-default btn-search-packaging">P</button>
                                            </div>
                                            <input type="text" name="m_sub_barang[dimensi]" class="form-control form-control-sm" placeholder="" value="<?=isset($dimension)? $dimension : '';?>">
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
