<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">

		<li class="breadcrumb-item">Master</li>
		<li class="breadcrumb-item">BOM</li>
		<li class="breadcrumb-item"><?=$t_bom->kode_bom?></li>
		<li class="breadcrumb-item">Workflow Instruction</li>
		<li class="breadcrumb-item active">Edit</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Edit Workflow Instruction <small><?=$t_bom_workflow->nama_workflow?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<dl class="row">
						<dt class="col-sm-2">BOM Code</dt>
						<dd class="col-sm-10"><?=$t_bom->kode_bom?></dd>
						<dt class="col-sm-2">BOM Date</dt>
						<dd class="col-sm-10"><?=date('d-m-Y', strtotime($t_bom->tanggal_bom))?></dd>
						<dt class="col-sm-2">SO Number</dt>
						<dd class="col-sm-10"><?=$t_bom->kode_po?></dd>
						<dt class="col-sm-2">Customer</dt>
						<dd class="col-sm-10"><?=$t_bom->nama_supplier?></dd>
						<dt class="col-sm-2">Item Product</dt>
						<dd class="col-sm-10"><?=$t_bom->nama_barang?></dd>
						<dt class="col-sm-2">Item Quantity</dt>
						<dd class="col-sm-10"><?=$t_bom->qty?> <?=$t_bom->kode_satuan?></dd>
						<dt class="col-sm-2">Workflow Name</dt>
						<dd class="col-sm-10"><?=$t_bom_workflow->nama_workflow?></dd>
						<dt class="col-sm-2">Part Name</dt>
						<dd class="col-sm-10"><?=$t_bom_workflow->nama_bagian?></dd>
					</dl>
					<div class="row">
						<div class="col-md-12">
							<form method="post" action="<?=base_url('master/bom/workflow_update')?>">
								<input type="hidden" name="id_bom_workflow" value="<?=$t_bom_workflow->id_bom_workflow?>"/>
								<div class="form-group">
									<label class="control-label">Instruction Note:</label>
									<textarea class="form-control"></textarea>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Save</button>
									<a href="<?=base_url('master/bom/workflow/'.$t_bom->id_bom)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Cancel</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
