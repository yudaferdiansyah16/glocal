<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">

		<li class="breadcrumb-item">Master</li>
		<li class="breadcrumb-item active">Job</li>
		<li class="breadcrumb-item"><?=$t_job->no_job?></li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Detail Job<small><?=$t_job->no_job?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('master/job/detail_update')?>">
						<input type="hidden" name="id_job" value="<?=$t_job->id_job?>">
						<input type="hidden" class="id_bom" name="id_bom" value="<?=$t_job->id_bom?>">
						<input type="hidden" name="deleted_detail_job" id="deleted_detail_job"/>
						<dl class="row">
							<dt class="col-sm-2">Job Number</dt>
							<dd class="col-sm-10"><?=$t_job->no_job?></dd>
							<dt class="col-sm-2">Job Date</dt>
							<dd class="col-sm-10"><?=date('d-m-Y', strtotime($t_job->tanggal_job))?></dd>
							<dt class="col-sm-2">Due Date</dt>
							<dd class="col-sm-10"><?=date('d-m-Y', strtotime($t_job->due_date))?></dd>
							<dt class="col-sm-2">BOM Code</dt>
							<dd class="col-sm-10"><?=$t_job->kode_bom?></dd>
							<dt class="col-sm-2">Customer</dt>
							<dd class="col-sm-10"><?=$t_job->nama_supplier?></dd>
						</dl>
						<div class="table-responsive">
							<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" style="width: 100%;">
								<thead>
								<tr class="text-center">
									<th>No</th>
									<th>Workflow</th>
									<th>Part Name</th>
									<th>Item</th>
									<th>Remain Quantity</th>
									<th style="width: 100px;">Job Quantity</th>
									<th style="width: 50px;"><button type="button" class="btn btn-success btn-xs btn-add" data-toggle="modal" data-target="#t_bom_detail_job_modal"><i class="fa fal fa-plus-circle"></i></button></th>
								</tr>
								</thead>
								<tbody>
									<?php foreach($t_detail_job as $i => $detail_job): ?>
									<tr>
										<td class="text-center"><?=($i+1)?></td>
										<td>
											<?=$detail_job->nama_workflow?>
										</td>
										<td><?=$detail_job->nama_bagian?></td>
										<td>
											<span class="nama_sub_barang"><?=$detail_job->nama_sub_barang?></span><br>
											<small class="kode_barang"><?=$detail_job->kode_barang?></small>
										</td>
										<td class="text-right"><?=($detail_job->qty_bom-$detail_job->qty_total_job+$detail_job->qty_job)?> <?=$detail_job->kode_satuan?></td>
										<td>
											<input type="hidden" class="id_detail_job" name="t_detail_job[<?=$i?>][id_detail_job]" value="<?=$detail_job->id_detail_job?>">
											<input type="hidden" class="id_bom_detail" name="t_detail_job[<?=$i?>][id_bom_detail]" value="<?=$detail_job->id_bom_detail?>">
											<input type="hidden" class="id_satuan" name="t_detail_job[<?=$i?>][id_satuan]" value="<?=$detail_job->id_satuan?>" disabled>
											<input type="text" name="t_detail_job[<?=$i?>][qty_job]" class="form-control form-control-sm input-mask input-qty-job" data-inputmask="'alias': 'currency', 'prefix': ''" value="<?=$detail_job->qty_job?>"/>
										</td>
										<td class="text-center">
											<button type="button" class="btn btn-xs btn-danger btn-delete"><i class="fa fal fa-trash"></i></button>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fal fa-save"></i> Save</button>
								<a href="<?=base_url('master/bom/job/'.$t_job->id_bom)?>" class="btn btn-sm btn-danger"><i class="fal fa fa-times-circle"></i> Back</a>
							</div>
						</div>
					</form>
					<table class="x-hidden" id="template-row">
						<tbody>
							<tr>
								<td class="text-center"></td>
								<td></td>
								<td></td>
								<td>
									<span class="nama_sub_barang"></span><br>
									<small class="kode_barang"></small>
								</td>
								<td class="text-right"></td>
								<td>
									<input type="hidden" class="id_detail_job" name="t_detail_job[x][id_detail_job]" value="">
									<input type="hidden" class="id_bom_detail" name="t_detail_job[x][id_bom_detail]" value="">
									<input type="hidden" class="id_satuan" name="t_detail_job[x][id_satuan]" value="" disabled>

									<input type="text" name="t_detail_job[x][qty_job]" class="form-control form-control-sm input-mask input-qty-job" data-inputmask="'alias': 'currency', 'prefix': ''" value="0"/>
								</td>
								<td class="text-center">
									<button type="button" class="btn btn-xs btn-danger btn-delete"><i class="fa fal fa-trash"></i></button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</main>
<?php
