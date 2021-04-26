<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Warehouse</li>
		<li class="breadcrumb-item">Receive Material</li>
		<li class="breadcrumb-item"><?= $t_wh->kode_mutasi ?></li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Detail Receive Material<small><?= $t_wh->kode_mutasi ?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<?php if($t_wh->approval_1 == 0 && $t_wh->approval_2 == 0): ?>
						<button type="button" disabled class="btn btn-default btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass"></i> Ready
						</button>
					<?php endif; ?>
					<?php if($t_wh->approval_1 == 1 && $t_wh->approval_2 == 0): ?>
						<button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 1
						</button>
					<?php endif; ?>
					<?php if($t_wh->approval_1 == 1 && $t_wh->approval_2 == 1): ?>
						<button type="button" disabled class="btn btn-primary btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 2
						</button>
					<?php endif; ?>
				</div>
				<div class="card-body">
					<dl class="row">
						<dt class="col-sm-2">Transaction Number</dt>
						<dd class="col-sm-9"><?= $t_wh->kode_mutasi ?></dd>
						<dt class="col-sm-2">Receive Date</dt>
						<dd class="col-sm-9"><?= date('d-m-Y', strtotime($t_wh->tanggal_terima)) ?></dd>
						<dt class="col-sm-2">RN Number</dt>
						<dd class="col-sm-9"><?= $t_wh->kode_dn ?></dd>
						<dt class="col-sm-2">No. Invoice</dt>
						<dd class="col-sm-9"><?= $t_wh->no_invoice ?></dd>
						<dt class="col-sm-2">Invoice Date</dt>
						<dd class="col-sm-9"><?=(!empty($t_wh->no_invoice) ? date('d-m-Y', strtotime($t_wh->no_invoice)) : '-')?></dd>
						<dt class="col-sm-2">Tax. Invoice</dt>
						<dd class="col-sm-9"><?= $t_wh->no_faktur ?></dd>
						<dt class="col-sm-2">Tax Invoice Date</dt>
						<dd class="col-sm-9"><?=(!empty($t_wh->tgl_faktur) ? date('d-m-Y', strtotime($t_wh->tgl_faktur)) : '-')?></dd>
						<dt class="col-sm-2">Submission No.</dt>
						<dd class="col-sm-9"><?=(!empty($t_wh->NOMOR_AJU) ? $t_wh->NOMOR_AJU  : '-')?></dd>
						<dt class="col-sm-2">Submission Date</dt>
						<dd class="col-sm-9"><?=(!empty($t_wh->TANGGAL_AJU) ? date('d-m-Y', strtotime($t_wh->TANGGAL_AJU)) : '-')?></dd>
						<dt class="col-sm-2">Registration No.</dt>
						<dd class="col-sm-9"><?=(!empty($t_wh->NOMOR_DAFTAR) ? $t_wh->NOMOR_DAFTAR : '-')?></dd>
						<dt class="col-sm-2">Registration Date</dt>
						<dd class="col-sm-9"><?=(!empty($t_wh->TANGGAL_DAFTAR) ? date('d-m-Y', strtotime($t_wh->TANGGAL_DAFTAR)) : '-')?></dd>
					</dl>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover table-sm">
									<thead>
										<tr class="text-center">
											<th rowspan="2">No.</th>
											<th rowspan="2">Item Material</th>
											<th rowspan="2">Job Number</th>
											<th rowspan="2">PO Number</th>
											<th rowspan="2">DN Number</th>
											<th rowspan="2" style="width: 80px;">Quantity<br>Receive</th>
											<th rowspan="2">Warehouse<br>Location</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$total_po = 0;
									$total_mc = 0;
									?>
									<?php foreach ($t_wh_detail as $i => $detail): ?>
										<tr>
											<td class="text-center"><?= $i + 1 ?></td>
											<td>
												<?= $detail->nama_barang ?><br>
												<small><?= $detail->kode_barang ?></small>
											</td>
											<td class="text-left">
												<?= $detail->no_job ?><br>
												<small>PO Date: <?=!empty($detail->tanggal_job)?date('d-m-Y', strtotime($detail->tanggal_dibuat)):''?></small>
											</td>
											<td class="text-left">
												<?= $detail->kode_po ?><br>
												<small>PO Date: <?=date('d-m-Y', strtotime($detail->tanggal_dibuat))?></small>
											</td>
											<td class="text-left">
												<?= $detail->no_sj ?><br>
												<small>DN Date: <?=(!empty($detail->tanggal_sj) ? date('d-m-Y', strtotime($detail->tanggal_sj)) : '-')?></small>
											</td>
											<td class="text-right">
												<?= number_format($detail->qty, 2) ?><br>
												<small><?= $detail->kode_satuan_terkecil ?></small>
											</td>
											<td>
												<?= $detail->nama_gudang ?><br>
												<small><?= $detail->nama_koordinat ?></small>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12">
						<?php if ($t_wh->approval_1 == 0) { ?>
								<a href="<?=base_url($_controller.'/'.$_method.'/approval1/'.$t_wh->id_wh)?>" class="btn btn-sm btn-success"><i class="fal fa fa-check-circle"></i> Approve 1</a>
							<?php }?>
							<?php if ($t_wh->approval_1 == 1 && $t_wh->approval_2 == 0) { ?>
								<a href="<?=base_url($_controller.'/'.$_method.'/unapprove1/'.$t_wh->id_wh)?>" class="btn btn-sm btn-secondary"><i class="fal fa fa-circle"></i> Disapprove 1</a>
								<a href="<?=base_url($_controller.'/'.$_method.'/approval2/'.$t_wh->id_wh)?>" class="btn btn-sm btn-primary"><i class="fal fa fa-check-circle"></i> Approve 2</a>
							<?php }?>
							<?php if ($t_wh->approval_2 == 1) { ?>
								<a href="<?=base_url($_controller.'/'.$_method.'/unapprove2/'.$t_wh->id_wh)?>" class="btn btn-sm btn-secondary"><i class="fal fa fa-circle"></i> Disapprove 2</a>
							<?php }?>
								<a href="<?=base_url($_controller.'/'.$_method)?>" style="margin-left: 5px;" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Back</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
