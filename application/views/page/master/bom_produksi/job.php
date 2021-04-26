<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">SMARTONE</a></li>
		<li class="breadcrumb-item">Master</li>
		<li class="breadcrumb-item">BOM</li>
		<li class="breadcrumb-item"><?=$t_bom->kode_bom?></li>
		<li class="breadcrumb-item active">Job</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Job of BOM<small><?=$t_bom->kode_bom?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<input type="hidden" name="id_bom" value="<?=$t_bom->id_bom?>"/>
					<!--<a href="<?/*=base_url('master/job/add/'.$t_bom->id_bom)*/?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> <?=$this->lang->line('button_add')?></a>-->
					<a href="<?=base_url('master/bom_produksi')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Back</a>
				</div>
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
						<dd class="col-sm-10"><?=number_format($t_bom->qty, 2)?> <?=$t_bom->kode_satuan?></dd>
					</dl>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<input type="hidden" class="id_bom" value="<?=$t_bom->id_bom?>">
							<div class="table-responsive">
								<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" style="width: 100%;">
									<thead>
									<tr>
										<th class="text-center">No</th>
										<th class="text-center">Job Number</th>
										<th class="text-center">Date</th>
										<th class="text-center">Due Date</th>
										<th class="text-center">Status</th>
										<th class="text-center" style="width: 130px;">Option</th>
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
