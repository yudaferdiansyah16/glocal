<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		
		<li class="breadcrumb-item">Master</li>
		<li class="breadcrumb-item">BOM</li>
		<li class="breadcrumb-item">Workflow</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Workflow<small>BOM Code - <?=$t_bom->kode_bom?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('master/bom_produksi/workflow_store')?>">
						<input type="hidden" name="id_bom" value="<?=$t_bom->id_bom?>"/>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label class="form-label">
									Workflow
								</label>
								<select class="form-control form-control-sm" name="id_workflow" required>
									<option value="">Choose Workflow...</option>
									<?php foreach ($m_workflow as $workflow): ?>
									<option value="<?=$workflow->id_workflow?>"><?=$workflow->nama_workflow?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label class="form-label">Part Name</label>
								<input type="text" name="nama_bagian" class="form-control form-control-sm" value=""/>
							</div>
							<div class="form-group col-md-2">
								<label class="form-label">Order Work</label>
								<input type="text" class="form-control form-control-sm" name="order_workflow"/>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
							<a href="<?=base_url('master/bom_produksi')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
