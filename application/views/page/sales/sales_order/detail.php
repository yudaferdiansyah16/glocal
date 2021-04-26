<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Sales</li>
		<li class="breadcrumb-item">Sales Order</li>
		<li class="breadcrumb-item"><?= $t_po->kode_po ?></li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Detail Sales Order<small><?= $t_po->kode_po ?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<?php if($t_po->approval_1 == 0 && $t_po->approval_2 == 0): ?>
						<button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass-start"></i> Waiting for Approve 1
						</button>
					<?php endif; ?>
					<?php if($t_po->approval_1 == 1 && $t_po->approval_2 == 0){ ?>
						<button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 1
						</button>
						<button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass-start"></i> Waiting for Approve 2
						</button>
					<?php }?>
					<?php if($t_po->approval_1 == 1 && $t_po->approval_2 == 1): ?>
						<button type="button" disabled class="btn btn-primary btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 2
						</button>
					<?php endif; ?>
				</div>
				<div class="card-body">
					<dl class="row">
						<dt class="col-sm-2">SO Number</dt>
						<dd class="col-sm-9"><?= $t_po->kode_po ?></dd>
						<dt class="col-sm-2">SO Date</dt>
						<dd class="col-sm-9"><?= date('d-m-Y', strtotime($t_po->tanggal_dibuat)) ?></dd>
						<dt class="col-sm-2">Sales Type</dt>
						<dd class="col-sm-9"><?= $t_po->nama_tipe_sales ?></dd>
						<dt class="col-sm-2">Customer</dt>
						<dd class="col-sm-9"><?= $t_po->nama_consignee ?></dd>
						<dt class="col-sm-2">PO Buyer</dt>
						<dd class="col-sm-9"><?= $t_po->po_buyer ?></dd>
						<dt class="col-sm-2">Currency</dt>
						<dd class="col-sm-1"><?= $t_po->kode_valuta ?></dd>
						<dd class="col-sm-2">Rate = <?= number_format($t_po->rate, 2) ?></dd>
					</dl>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover table-sm">
									<thead>
									<tr class="text-center">
										<th>No.</th>
										<th>Item</th>
										<th>Description</th>
										<th style="width: 120px;">Pack Quantity</th>
										<th style="width: 80px;">Quantity</th>
										<th style="width: 100px;">Price</th>
										<th style="width: 100px;">Subtotal</th>
									</tr>
									</thead>
									<tbody>
									<?php
									$total_po = 0;
									$total_mc = 0;
									?>
									<?php foreach ($t_detail_po as $i => $detail): ?>
										<tr>
											<td class="text-center"><?= $i + 1 ?></td>
											<td>
												<?= $detail->nama_sub_barang ?><br>
												<small><?=$detail->kode_barang?></small>
											</td>
											<td><?= $detail->keterangan ?></td>
											<td class="text-right"><?= number_format($detail->qty_mc, 0) ?> <?= $detail->kode_kemasan ?></td>
											<td class="text-right"><?= number_format($detail->qty_po, 2) ?><br><small><?= $detail->kode_satuan ?></small></td>
											<td class="text-right"><?= number_format($detail->harga, 2) ?><br><small><?= $t_po->kode_valuta ?></small></td>
											<td class="text-right"><?= number_format(floatval($detail->harga) * floatval($detail->qty_po), 2) ?><br><small><?= $t_po->kode_valuta ?></small></td>
										</tr>
										<?php
										$total_mc += floatval($detail->qty_mc);
										$total_po += (floatval($detail->qty_po) * floatval($detail->harga));
										?>
									<?php endforeach; ?>
									</tbody>
									<tfoot>
										<tr>
											<th colspan="3" class="text-center">Total</th>
											<th class="text-right"><?=number_format($total_mc, 0)?></th>
											<th colspan="2"></th>
											<th class="text-right">
												<?=number_format($total_po, 2)?><br><small><?= $t_po->kode_valuta ?></small>
											</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<?php if($t_po->approval_2 == 0): ?>
								<form class="form-inline" style="float:left; margin-left: 5px;" method="post" action="<?= base_url('sales/sales_order/approve') ?>">
									<input type="hidden" name="id_po" value="<?=$t_po->id_po?>">
									<input type="hidden" name="approval_1" value="<?=($t_po->approval_1 == 0 ? 1 : 0)?>">
										<?php if($t_po->approval_1 == 0): ?>
											<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-check-circle"></i> Approve 1
										</button>
										<?php else: ?>
											<button type="submit" class="btn btn-sm btn-secondary"><i class="fal fa fa-circle"></i> Disapprove 1
											</button>
										<?php endif; ?>
								</form>
							<?php endif; ?>
							<?php if($t_po->approval_1 == 1): ?>
								<form class="form-inline" style="float:left; margin-left: 5px;" method="post" action="<?= base_url('sales/sales_order/approve') ?>">
									<input type="hidden" name="id_po" value="<?=$t_po->id_po?>">
									<input type="hidden" name="approval_2" value="<?=($t_po->approval_2 == 0 ? 1 : 0)?>">
									<?php if($t_po->approval_2 == 0): ?>
										<button type="submit" class="btn btn-sm btn-primary"><i class="fal fa fa-check-circle"></i> Approve 2
										</button>
									<?php else: ?>
										<button type="submit" class="btn btn-sm btn-secondary"><i class="fal fa fa-circle"></i> Disapprove 2
										</button>
									<?php endif; ?>
								</form>
							<?php endif; ?>
							<a href="<?=base_url('sales/sales_order')?>" style="margin-left: 5px;" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Back</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
