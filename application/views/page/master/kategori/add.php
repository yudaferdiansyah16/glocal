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
					<form method="post" action="<?=base_url('master/kategori/store')?>">
						<div class="form-group">
							<label class="form-label"><?=$this->lang->line('label_kode_kategori')?></label>
							<input type="text" name="kode_kategori" class="form-control" placeholder="" required>
						</div>
						<div class="form-group">
							<label class="form-label"><?=$this->lang->line('label_nama_kategori')?></label>
							<input type="text" name="nama_kategori" class="form-control" placeholder="" required>
						</div>
						<div class="form-group">
							<label class="form-label">
								<?=$this->lang->line('label_sbu_kategori')?>
							</label>
							<select class="form-control form-control-sm select2" name="kode_sbu" required>
								<option value="" disabled selected>Select Data . . .</option>
								<?=createOption($ssbu,'id_sbu',array('kode_sbu','nama_sbu'),' - ')?>
							</select>
						</div>
						<div class="form-group">
							<label class="form-label"><?=$this->lang->line('label_deskripsi_kategori')?></label>
							<input type="text" name="keterangan" class="form-control" placeholder=""">
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
