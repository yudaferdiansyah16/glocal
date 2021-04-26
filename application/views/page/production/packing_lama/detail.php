<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Production</li>
		<li class="breadcrumb-item">Packing</li>
		<li class="breadcrumb-item"><?= $t_production->kode_mutasi ?></li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Detail Packing<small><?= $t_production->kode_mutasi ?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<?php if($t_production->approval_1 == 0 && $t_production->approval_2 == 0): ?>
						<button type="button" disabled class="btn btn-default btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass"></i> Ready
						</button>
					<?php endif; ?>
					<?php if($t_production->approval_1 == 1 && $t_production->approval_2 == 0): ?>
						<button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 1
						</button>
					<?php endif; ?>
					<?php if($t_production->approval_1 == 1 && $t_production->approval_2 == 1): ?>
						<button type="button" disabled class="btn btn-primary btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 2
						</button>
					<?php endif; ?>
				</div>
				<div class="card-body">
					<dl class="row">
						<dt class="col-sm-2">Transaction Number</dt>
						<dd class="col-sm-9"><?= $t_production->kode_mutasi ?></dd>
						<dt class="col-sm-2">Packing Date</dt>
						<dd class="col-sm-9"><?= date('d-m-Y', strtotime($t_production->tanggal_mutasi)) ?></dd>
						<dt class="col-sm-2">Job Number</dt>
						<dd class="col-sm-9"><?= $t_production->no_job ?></dd>
						<dt class="col-sm-2">Product</dt>
						<dd class="col-sm-9"><?= $t_production->nama_barang ?></dd>
						<dt class="col-sm-2">Packing Quantity</dt>
						<dd class="col-sm-9"><?= number_format($t_production->qty_pack) ?> <?=$t_production->kode_satuan?></dd>
					</dl>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover table-sm">
									<thead>
										<tr class="text-center">
											<th>No.</th>
											<th>Item Material</th>
											<th>Production Code</th>
											<th>Job Number</th>
											<th>Quantity</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$total_po = 0;
									$total_mc = 0;
									?>
									<?php foreach ($t_production_detail as $i => $detail): ?>
										<tr>
											<td class="text-center"><?= $i + 1 ?></td>
											<td>
												<?= $detail->nama_barang ?><br>
												<small><?= $detail->kode_barang ?></small>
											</td>
											<td>
												<?=$detail->kode_mutasi_old?><br>
												<small>Transaction Date: <?=date('d-m-Y', strtotime($detail->tanggal_mutasi_old))?></small>
											</td>
											<td>
												<?= $detail->no_job ?><br>
												<small>Job Date: <?=date('d-m-Y', strtotime($detail->tanggal_job))?></small>
											</td>
											<td class="text-right"><?= number_format($detail->qty, 0) ?> <?= $detail->kode_satuan ?></td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<?php if($t_production->approval_2 == 0): ?>
								<form class="form-inline" style="float:left; margin-left: 5px;" method="post" action="<?= base_url('production/packing/approve') ?>">
									<input type="hidden" name="id_production" value="<?=$t_production->id_production?>">
									<input type="hidden" name="approval_1" value="<?=($t_production->approval_1 == 0 ? 1 : 0)?>">
									<?php if($t_production->approval_1 == 0): ?>
										<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-check-circle"></i> Approve 1
										</button>
									<?php else: ?>
										<button type="submit" class="btn btn-sm btn-secondary"><i class="fal fa fa-circle"></i> Disapprove 1
										</button>
									<?php endif; ?>
								</form>
							<?php endif; ?>
							<?php if($t_production->approval_1 == 1): ?>
								<form class="form-inline" style="float:left; margin-left: 5px;" method="post" action="<?= base_url('production/packing/approve2') ?>">
									<input type="hidden" name="id_production" value="<?=$t_production->id_production?>">
									<input type="hidden" name="approval_2" value="<?=($t_production->approval_2 == 0 ? 1 : 0)?>">
									<?php if($t_production->approval_2 == 0): ?>
										<button type="submit" class="btn btn-sm btn-primary"><i class="fal fa fa-check-circle"></i> Approve 2
										</button>
									<?php else: ?>
										<button type="submit" class="btn btn-sm btn-secondary"><i class="fal fa fa-circle"></i> Disapprove 2
										</button>
									<?php endif; ?>
								</form>
							<?php endif; ?>
							<a href="<?=base_url($_controller.'/'.$_method)?>" style="margin-left: 5px;" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Back</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
