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
					<form method="post" action="<?=base_url('master/akun/store')?>">
						<div class="form-group">
							<label class="form-label"><?=$this->lang->line('label_kode_akun')?></label>
							<input type="text" name="kode_akun" class="form-control" placeholder="" value="<?=isset($nama_akun)? $nama_akun : '';?>" required>
						</div>
						<div class="form-group">
							<label class="form-label"><?=$this->lang->line('label_nama_akun')?></label>
							<input type="text" name="nama_akun" class="form-control" placeholder="" value="<?=isset($nama_akun)? $nama_akun : '';?>" required>
						</div>
						<div class="form-group">
							<label class="form-label"><?=$this->lang->line('label_description_akun')?></label>
							<input type="text" name="keterangan" class="form-control" placeholder="" value="<?=isset($keterangan)? $keterangan: '';?>">
						</div>
						<div class="form-group">
							<label class="form-label"><?=$this->lang->line('label_account_type_akun')?></label>
							<select class="form-control form-control-sm select2" name="id_tipe_akun" required>
								<option value="" disabled selected>Select Data . . .</option>
								<?=createOption($stipe_akun, 'id_tipe_akun',array('nama_tipe_akun','balance_type'),' - ')?>
							</select>
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
