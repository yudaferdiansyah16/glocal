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
					<form method="post" action="<?=base_url('master/status/update')?>">
						<input type="hidden" name="id_status" value="<?=placeValue($data,'id_status')?>">
						<div class="form-group">
							<label class="form-label"><?=$this->lang->line('label_tipe_status')?></label>
							<input type="text" name="status_type" class=" form-control  form-control-sm" value="<?=placeValue($data,'status_type')?>">
						</div>
						<div class="form-group">
							<label class="form-label"><?=$this->lang->line('label_status_status')?></label>
							<input type="text" name="status_trans" class=" form-control  form-control-sm" value="<?=placeValue($data,'status_trans')?>">
						</div>
						<div class="form-group">
							<label class="form-label"><?=$this->lang->line('label_warna_status')?></label>
							<input type="text" class="form-control form-control-sm x-colorpicker" value="<?=placeValue($data,'status_color')?>"/>
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
