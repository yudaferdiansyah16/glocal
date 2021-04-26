<main id="js-page-content" role="main" class="page-content">
	<?=generateBreadcrumb($this->lang->line('breadcrumb_edit'))?>
	<div class="subheader">
		<h1 class="subheader-title">
			Edit Workflow
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('master/workflow/update')?>">
						<input type="hidden" name="id_workflow" value="<?=placeValue($data,'id_workflow')?>">
						<div class="form-group">
							<label class="form-label"><?=$this->lang->line('label_nama_workflow')?></label>
							<input type="text" name="nama_workflow" class=" form-control  form-control-sm" placeholder="" value="<?=placeValue($data,'nama_workflow')?>">
						</div>
						<div class="form-group">
							<label class="form-label"><?=$this->lang->line('label_deskripsi_workflow')?></label>
							<input type="text" name="description" class=" form-control  form-control-sm" placeholder="" value="<?=placeValue($data,'description')?>">
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
