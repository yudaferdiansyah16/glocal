<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		
		<li class="breadcrumb-item">Master</li>
		<li class="breadcrumb-item">BOM</li>
		<li class="breadcrumb-item"><?=$t_bom->kode_bom?></li>
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
						<div class="form-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-hover table-bordered table-striped table-sm dt_workflow_add" id="table_workflow" role="grid" style="white-space: nowrap; min-width: 600px">
										<thead>
										<tr>
											<th class="text-center" width="5px">
												<button type="button" class="btn btn-xs btn-success btn-add-workflow"><i class="fal fa-plus-circle"></i></button>
											</th>
											<th class="text-center">No</th>
											<th class="text-center">Workflow</th>
											<th class="text-center">Part Name</th>
											<th class="text-center" style="width: 150px;">Residual</th>
										</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
							<a href="<?=base_url('master/bom_produksi/workflow/'.$t_bom->id_bom)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
<table class="x-hidden add_workflow_template">
	<tbody>
	<tr data-index="x">
		<td class="text-center">
			<button class="btn btn-xs btn-danger btn-delete-workflow"><i class="fa fal fa-trash"></i></button>
		</td>
		<td class="text-center"></td>
		<td>
			<select class="form-control form-control-sm mselect2" name="t_bom_workflow[x][id_workflow]" required>
				<option value="">Choose Workflow...</option>
				<?=createOption($m_workflow,'id_workflow',array('nama_workflow'),'-')?>
			</select>
		</td>
		<td>
			<select class="form-control form-control-sm mselect2" multiple="multiple" name="t_bom_workflow[x][id_part][]" required>
				<option value="">Choose Part...</option>
				<?=createOption($m_part,'id_part',array('nama_part'),'-')?>
			</select>
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" name="t_bom_workflow[x][residual]" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" value="0"/>
				<div class="input-group-append">
					<span class="input-group-text">%</span>
				</div>
			</div>
		</td>
	</tr>
	</tbody>
</table>
