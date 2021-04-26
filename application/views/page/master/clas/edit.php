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
					<form method="post" action="<?=base_url('master/clas/update	')?>">
						<input type="hidden" name="id_class" value="<?=placeValue($data,'id_class')?>">
						<div class="form-group row">
							<div class="col-md-12">
								<label class="form-label"><?=$this->lang->line('label_kode_klasifikasi_clas')?></label>
								<input type="text" name="kode_class" class=" form-control  form-control-sm" placeholder="" value="<?=placeValue($data,'kode_class')?>" required>
							</div>
							<div class="col-md-12">
								<label class="form-label"><?=$this->lang->line('label_nama_clas')?></label>
								<input type="text" name="nama_class" class=" form-control  form-control-sm" placeholder="" value="<?=placeValue($data,'nama_class')?>" required>
							</div>
							<div class="col-md-12">
								<label class="form-label"><?=$this->lang->line('label_deskripsi_clas')?></label>
								<input type="text" name="keterangan" class=" form-control  form-control-sm" placeholder="" value="<?=placeValue($data,'keterangan')?>">
							</div>
							<div class="col-md-12">
								<label class="form-label">
									<?=$this->lang->line('label_tipe_laporan_clas')?>
								</label>
								<select class="form-control form-control-sm select2" name="id_jenis_laporan" required>
									<?= createOption($sjenis_laporan, 'id_jenis_laporan', array('nama_jenis_laporan'), ' - ', $data->id_jenis_laporan) ?>
								</select>
							</div>
							<div class="col-md-12">
								<label class="form-label"><?=$this->lang->line('label_akun_clas')?></label>
								<div class="input-group input-group-sm">
									<div class="input-group input-group-sm">
										<input type="text" class="form-control form-control form-control-sm x-readonly nama_akun" readonly placeholder="Select akun..." value="<?=placeValue($data,'nama_akun')?>">
										<input type="hidden" name="id_akun" value="<?=placeValue($data,'id_akun')?>"/>
										<div class="input-group-append">
											<button type="button" class="btn btn-default" data-toggle="modal" data-target="#m_akun_modal"><i class="fal fa-search"></i></button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<label class="form-label">Opponent Account</label>
								<div class="input-group input-group-sm">
									<div class="input-group input-group-sm">
										<input type="text" class="form-control form-control form-control-sm x-readonly nama_akun_lawan" readonly placeholder="Select akun..." value="<?=placeValue($data,'nama_akun_lawan')?>">
										<input type="hidden" name="id_akun_lawan" value="<?=placeValue($data,'id_akun_lawan')?>"/>
										<div class="input-group-append">
											<button type="button" class="btn btn-default" data-toggle="modal" data-target="#m_akun_lawan_modal"><i class="fal fa-search"></i></button>
										</div>
									</div>
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
