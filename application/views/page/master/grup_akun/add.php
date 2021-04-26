<main id="js-page-content" role="main" class="page-content">
	<?=generateBreadcrumb($this->lang->line('breadcrumb_add'))?>
	<div class="subheader">
		<h1 class="subheader-title">
			<?=$this->lang->line('button_add')?>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('master/grup_akun/store')?>">
						<div class="form-group row">
							<div class="col-md-12">
								<label class="form-label"><?=$this->lang->line('label_sub_grup_akun')?></label>
								<input type="text" name="sub_group_type" class="form-control form-control-sm" placeholder="" value="<?=isset($sub_group_type)? $sub_group_type: '';?>" required>
							</div>
							<div class="col-md-12">
								<label class="form-label"><?=$this->lang->line('label_tipe_grup_grup_akun')?></label>
								<input type="text" name="group_type" class="form-control form-control-sm" placeholder="" value="<?=isset($group_type)? $group_type: '';?>" required>
							</div>
							<div class="col-md-12">
								<label class="form-label"><?=$this->lang->line('label_tipe_keseimbangan_grup_akun')?></label>
								<input type="text" name="balance_type" class="form-control form-control-sm" placeholder="" value="<?=isset($group_type)? $group_type: '';?>" required>
							</div>
							<div class="col-md-12">
								<label class="form-label"><?=$this->lang->line('label_report_to_grup_akun')?></label>
								<select class="form-control form-control-sm select2" name="id_jenis_laporan_keuangan">
									<option value="" disabled selected></option>
									<?=createOption($sjenis_laporan_keuangan,'id_jenis_laporan_keuangan',array('nama_jenis_laporan_keuangan'),'-')?>
								</select>
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
