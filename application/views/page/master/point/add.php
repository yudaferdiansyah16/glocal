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
					<form method="post" action="<?=base_url('master/point/store')?>">
						<div class="form-group">
							<label class="form-label"><?=$this->lang->line('label_workflow_point')?></label>
							<select class="form-control form-control-sm select2" name="id_workflow">
								<option disabled selected>Choose Workflow . . .</option>
								<?=createOption($workflow,'id_workflow',array('nama_workflow'),'-')?>
							</select>
						</div>
						<div class="form-group">
							<label class="form-label"><?=$this->lang->line('label_part_point')?></label>
							<select class="form-control form-control-sm select2" name="id_part">
								<option disabled selected>Choose Part . . .</option>
								<?=createOption($part,'id_part',array('nama_part'),'-')?>
							</select>
						</div>
						<div class="form-group">
							<label class="form-label"><?=$this->lang->line('label_poin_point')?></label>
							<input type="number" name="jumlah_point" class="form-control form-control-sm" step="0.01" min="0" placeholder="">
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
