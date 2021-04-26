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
					<form id="form" method="post" action="<?=base_url('master/bom_produksi/instruction_update')?>" accept-charset="UTF-8" enctype="multipart/form-data">
						<input type="hidden" name="id_bom" value="<?=$t_bom_workflow->id_bom?>"/>
						<input type="hidden" name="id_bom_workflow" value="<?=$t_bom_workflow->id_bom_workflow?>"/>
						<dl class="row">
							<dt class="col-sm-2">BOM Code</dt>
							<dd class="col-sm-10"><?=$t_bom->kode_bom?></dd>
							<dt class="col-sm-2">BOM Date</dt>
							<dd class="col-sm-10"><?=date('d-m-Y', strtotime($t_bom->tanggal_bom))?></dd>
							<dt class="col-sm-2">SO Number</dt>
							<dd class="col-sm-10"><?=$t_bom->kode_po?>, PO Buyer: #<?=$t_bom->po_buyer?></dd>
							<dt class="col-sm-2">Customer</dt>
							<dd class="col-sm-10"><?=$t_bom->nama_supplier?></dd>
							<dt class="col-sm-2">Item Product</dt>
							<dd class="col-sm-10"><?=$t_bom->nama_barang?></dd>
							<dt class="col-sm-2">Size</dt>
							<dd class="col-sm-10"><?=(!empty($t_bom->size) ? $t_bom->size : '-')?></dd>
							<dt class="col-sm-2">Item Quantity</dt>
							<dd class="col-sm-10"><?=$t_bom->qty?> <?=$t_bom->kode_satuan?> Tolerance: (-<?=number_format($t_bom->qty_min_percent, 2)?>% +<?=number_format($t_bom->qty_max_percent, 2)?>%)</dd>
							<dt class="col-sm-2">Workflow Name</dt>
							<dd class="col-sm-10"><?=$t_bom_workflow->nama_workflow?></dd>
							<dt class="col-sm-2">Part Name</dt>
							<dd class="col-sm-10"><?=$t_bom_workflow->nama_part?></dd>
						</dl>
						<hr>
						<!--<div class="row">
							<div class="col-md-12">
								<label class="form-label">Source and Result Material:</label>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="table-responsive">
									<table class="table table-sm table-bordered table-striped table-hover">
										<thead>
										<tr class="text-center">
											<th style="width: 50px;">No</th>
											<th>Material Item</th>
											<th>Quantity</th>
										</tr>
										</thead>
										<tbody>
											<?php /*foreach ($t_bom_detail as $i => $detail): */?>
											<tr>
												<td class="text-center"><?/*=($i+1)*/?></td>
												<td>
													<?/*=$detail->nama_sub_barang*/?><br>
													<small><?/*=$detail->kode_barang*/?></small>
												</td>
												<td class="text-right">
													<?/*=number_format($detail->qty_bom, 2)*/?><br>
													<small><?/*=$detail->kode_satuan*/?></small>
												</td>
											</tr>
											<?php /*endforeach; */?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-md-6">
								<div class="table-responsive">
									<table class="table table-sm table-bordered table-striped table-hover">
										<thead>
										<tr class="text-center">
											<th style="width: 50px;">No</th>
											<th>Result Item</th>
											<th class="text-center" style="width: 50px;">
												<button type="button" class="btn btn-xs btn-success">
													<i class="fa fal fa-plus-circle"></i>
												</button>
											</th>
										</tr>
										</thead>
										<tbody>
											<tr>
												<td></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<hr>-->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="form-label">Instruction Note:</label>
									<textarea id="summernote" name="note" class="summernote">
										<?=$t_bom_workflow->note?>
									</textarea>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<button type="submit" class="btn btn-sm btn-success btn-<?=$this->lang->line('button_save')?>"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
									<a href="<?=base_url('master/bom_produksi/workflow/'.$t_bom->id_bom)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Back</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
