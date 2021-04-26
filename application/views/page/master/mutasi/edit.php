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
					<form method="post" action="<?=base_url('master/mutasi/update')?>">
						<input type="hidden" name="id_mutasi" value="<?=placeValue($data,'id_mutasi')?>">
						<div class="form-group">
							<label class="form-label"><?=$this->lang->line('label_nama_mutasi')?></label>
							<input type="text" name="nama_mutasi" class="form-control" placeholder="" value="<?=placeValue($data,'nama_mutasi')?>" required>
						</div>
						<div class="form-group">
							<label class="form-label"><?=$this->lang->line('label_deskripsi_mutasi')?></label>
							<input type="text" name="keterangan" class="form-control" placeholder="" value="<?=placeValue($data,'keterangan')?>" required>
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
