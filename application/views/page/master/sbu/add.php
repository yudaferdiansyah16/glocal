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
					<form method="post" action="<?=base_url('master/sbu/store')?>">
						<div class="form-group row">
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label"><?=$this->lang->line('label_kode_sbu')?></label>
								<input type="text" name="kode_sbu" class="form-control" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label"><?=$this->lang->line('label_nama_sbu')?></label>
								<input type="text" name="nama_sbu" class="form-control" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-12 col-xl-12">
								<label class="form-label"><?=$this->lang->line('label_alamat_sbu')?></label>
								<input type="text" name="alamat" class="form-control" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label"><?=$this->lang->line('label_kota_sbu')?></label>
								<input type="text" name="KOTA_TTD" class="form-control" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label"><?=$this->lang->line('label_kppbc_sbu')?></label>
								<input type="text" name="KPPBC" class="form-control" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label"><?=$this->lang->line('label_npwp_sbu')?></label>
								<input type="text" name="NPWP" class="form-control" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label"><?=$this->lang->line('label_niper_sbu')?></label>
								<input type="text" name="NIPER" class="form-control" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label"><?=$this->lang->line('label_no_skep_sbu')?></label>
								<input type="text" name="NOMOR_SKEP" class="form-control" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label"><?=$this->lang->line('label_tgl_skep_sbu')?></label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="TANGGAL_SKEP">
									<div class="input-group-append">
										<span class="input-group-text fs-xl"><i class="fa fal fa-calendar"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label"><?=$this->lang->line('label_no_tdp_sbu')?></label>
								<input type="text" name="NOMOR_TDP" class="form-control" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label"><?=$this->lang->line('label_tgl_tdp_sbu')?></label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="TANGGAL_TDP">
									<div class="input-group-append">
										<span class="input-group-text fs-xl"><i class="fa fal fa-calendar"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label"><?=$this->lang->line('label_kode_perusahaan_sbu')?></label>
								<input type="text" name="KODE_PERUSAHAAN" class="form-control" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label"><?=$this->lang->line('label_api_perusahaan_sbu')?></label>
								<input type="text" name="API_PENGUSAHA" class="form-control" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label"><?=$this->lang->line('label_nama_pj_sbu')?></label>
								<input type="text" name="NAMA_TTD" class="form-control" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label"><?=$this->lang->line('label_jabatan_sbu')?></label>
								<input type="text" name="JABATAN" class="form-control" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label"><?=$this->lang->line('label_id_modul_sbu')?></label>
								<input type="text" name="ID_MODUL" class="form-control" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label"><?=$this->lang->line('label_versi_modul_sbu')?></label>
								<input type="text" name="VERSI_MODUL" class="form-control" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label"><?=$this->lang->line('label_format_no_aju_bc_30_sbu')?></label>
								<input type="text" name="NO_AJU_BC30" class="form-control" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6"></div>
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
