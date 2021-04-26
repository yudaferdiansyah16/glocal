<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Warehouse</li>
		<li class="breadcrumb-item">Stuffing</li>
		<li class="breadcrumb-item"><?= $t_stuffing->kode_stuffing ?></li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Detail Stuffing<small><?= $t_stuffing->kode_stuffing ?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<?php if($t_stuffing->approval_1 == 0 && $t_stuffing->approval_2 == 0): ?>
						<button type="button" disabled class="btn btn-default btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass"></i> Ready
						</button>
					<?php endif; ?>
					<?php if($t_stuffing->approval_1 == 1 && $t_stuffing->approval_2 == 0): ?>
						<button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 1
						</button>
					<?php endif; ?>
					<?php if($t_stuffing->approval_1 == 1 && $t_stuffing->approval_2 == 1): ?>
						<button type="button" disabled class="btn btn-primary btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 2
						</button>
					<?php endif; ?>
				</div>
				<div class="card-body">
					<dl class="row">
						<dt class="col-sm-2">Transaction Number</dt>
						<dd class="col-sm-9"><?= $t_stuffing->kode_stuffing ?></dd>
						<dt class="col-sm-2">Stuffing Date</dt>
						<dd class="col-sm-9"><?= date('d-m-Y', strtotime($t_stuffing->tanggal_stuffing)) ?></dd>
						<dt class="col-sm-2">Supplier</dt>
						<dd class="col-sm-9"><?= $t_stuffing->nama_supplier ?></dd>
						<dt class="col-sm-2">Container Number</dt>
						<dd class="col-sm-9"><?= $t_stuffing->container_number ?></dd>
					</dl>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover table-sm">
									<thead>
										<tr class="text-center">
											<th rowspan="2">No.</th>
											<th rowspan="2">Item Product</th>
											<th rowspan="2">SO Number</th>
											<th rowspan="2">Job Number</th>
											<th colspan="2">Plan</th>
											<th colspan="2">Realisasi</th>
											<th rowspan="2">Netto</th>
											<th rowspan="2">Bruto</th>
										</tr>
										<tr class="text-center">
											<th>QTY</th>
											<th>MC</th>
											<th>QTY</th>
											<th>MC</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($t_detail_stuffing as $i => $detail): ?>
										<tr>
											<td class="text-center"><?= $i + 1 ?></td>
											<td>
												<?= $detail->nama_barang ?><br>
												<small><?= $detail->kode_barang ?></small>
											</td>
											<td>
												<?=$detail->kode_po?><br>
												<small>SO Date: <?= date('d-m-Y', strtotime($detail->tanggal_dibuat)) ?></small>
											</td>
											<td>
												<?=$detail->no_job?><br>
												<small>Job Date: <?= date('d-m-Y', strtotime($detail->tanggal_job)) ?></small>
											</td>
											<td class="text-right">
												<?= number_format($detail->qty_si_plan, 2) ?><br>
												<small><?= $detail->kode_satuan ?></small>
											</td>
											<td class="text-right">
												<?= number_format($detail->qty_mc_plan, 0) ?><br>
												<small><?= $detail->kode_kemasan ?></small>
											</td>
											<td class="text-right">
												<?= number_format($detail->qty_si_real, 2) ?><br>
												<small><?= $detail->kode_satuan ?></small>
											</td>
											<td class="text-right">
												<?= number_format($detail->qty_mc_real, 0) ?><br>
												<small><?= $detail->kode_kemasan ?></small>
											</td>
											<td class="text-right">
												<?= number_format($detail->netto, 0) ?><br>
												<small>KGM</small>
											</td>
											<td class="text-right">
												<?= number_format($detail->bruto, 0) ?><br>
												<small>KGM</small>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<?php if($t_stuffing->approval_2 == 0): ?>
								<form class="form-inline" style="float:left; margin-left: 5px;" method="post" action="<?= base_url('warehouse/stuffing/approve') ?>">
									<input type="hidden" name="id_stuffing" value="<?=$t_stuffing->id_stuffing?>">
									<input type="hidden" name="approval_1" value="<?=($t_stuffing->approval_1 == 0 ? 1 : 0)?>">
									<?php if($t_stuffing->approval_1 == 0): ?>
										<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-check-circle"></i> Approve 1
										</button>
									<?php else: ?>
										<button type="submit" class="btn btn-sm btn-secondary"><i class="fal fa fa-circle"></i> Disapprove 1
										</button>
									<?php endif; ?>
								</form>
							<?php endif; ?>
							<?php if($t_stuffing->approval_1 == 1): ?>
								<form class="form-inline" style="float:left; margin-left: 5px;" method="post" action="<?= base_url('warehouse/stuffing/approve2') ?>">
									<input type="hidden" name="id_stuffing" value="<?=$t_stuffing->id_stuffing?>">
									<input type="hidden" name="approval_2" value="<?=($t_stuffing->approval_2 == 0 ? 1 : 0)?>">
									<?php if($t_stuffing->approval_2 == 0): ?>
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
