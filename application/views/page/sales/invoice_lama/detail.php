<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Sales</li>
		<li class="breadcrumb-item">Sales Invoice</li>
		<li class="breadcrumb-item"><?= $t_invoice->kode_invoice ?></li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Detail Sales Invoice<small><?= $t_invoice->kode_invoice ?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<?php if($t_invoice->approval_1 == 1): ?>
						<button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 1
						</button>
					<?php else: ?>
						<button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass-start"></i> Waiting for Approve 1
						</button>
					<?php endif; ?>
					<?php if($t_invoice->approval_2 == 1): ?>
						<button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 2
						</button>
					<?php else: ?>
						<button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass-start"></i> Waiting for Approve 2
						</button>
					<?php endif; ?>
				</div>
				<div class="card-body">
					<dl class="row">
						<dt class="col-sm-2">Transaction Number</dt>
						<dd class="col-sm-9"><?= $t_invoice->kode_invoice ?></dd>
						<dt class="col-sm-2">Invoice Date</dt>
						<dd class="col-sm-9"><?= date('d-m-Y', strtotime($t_invoice->tanggal_invoice)) ?></dd>
						<dt class="col-sm-2">Supplier</dt>
						<dd class="col-sm-9"><?= $t_invoice->nama_supplier ?></dd>
						<dt class="col-sm-2">Destination</dt>
						<dd class="col-sm-9"><?= $t_invoice->destination ?>, <?= $t_invoice->uraian_negara ?></dd>
						<dt class="col-sm-2">BL Number</dt>
						<dd class="col-sm-9"><?= $t_invoice->no_bl ?></dd>
						<dt class="col-sm-2">Currency</dt>
						<dd class="col-sm-2"><?= $t_invoice->kode_valuta ?></dd>
						<dd class="col-sm-3">Rate: <?= number_format($t_invoice->rate, 0) ?></dd>
					</dl>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover table-sm">
									<thead>
										<tr class="text-center">
											<th>No.</th>
											<th>Item Product</th>
											<th>SO Number</th>
											<th>Quantity</th>
											<th>Carton</th>
											<th>Price</th>
											<th>Netto</th>
											<th>Bruto</th>
											<th>Subtotal</th>
										</tr>
									</thead>
									<tbody>
									<?php $total = 0; ?>
									<?php foreach ($t_invoice_detail as $i => $detail): ?>
										<tr>
											<td class="text-center"><?= $i + 1 ?></td>
											<td>
												<?= $detail->nama_barang ?><br>
												<small><?= $detail->kode_barang ?></small>
											</td>
											<td>
												<?=$detail->kode_po?><br>
												<small><?= date('d-m-Y', strtotime($detail->tanggal_dibuat)) ?></small><br>
												<small>PO Buyer: <?= $detail->po_buyer ?></small>
											</td>
											<td class="text-right">
												<?= number_format($detail->qty_invoice, 2) ?><br>
												<small><?= $detail->kode_satuan ?></small>
											</td>
											<td class="text-right">
												<?= number_format($detail->qty_mc, 0) ?><br>
												<small><?= $detail->kode_kemasan ?></small>
											</td>
											<td class="text-right">
												<?=$t_invoice->kode_valuta?> <?= number_format($detail->harga, 2) ?><br>
											</td>
											<td class="text-right">
												<?= number_format($detail->netto, 0) ?><br>
												<small>KGM</small>
											</td>
											<td class="text-right">
												<?= number_format($detail->bruto, 0) ?><br>
												<small>KGM</small>
											</td>
											<td class="text-right">
												<?=$t_invoice->kode_valuta?> <?= number_format($detail->qty_invoice * $detail->harga, 2) ?><br>
											</td>
										</tr>
									<?php $total += ($detail->qty_invoice * $detail->harga); ?>
									<?php endforeach; ?>
									</tbody>
									<tfoot>
										<tr>
											<th class="text-right" colspan="8">Total</th>
											<th class="text-right"><?=$t_invoice->kode_valuta?> <?=number_format($total, 2)?></th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<?php if($t_invoice->approval_2 == 0): ?>
								<form class="form-inline" style="float:left; margin-left: 5px;" method="post" action="<?= base_url('sales/invoice/approve') ?>">
									<input type="hidden" name="id_invoice" value="<?=$t_invoice->id_invoice?>">
									<input type="hidden" name="approval_1" value="<?=($t_invoice->approval_1 == 0 ? 1 : 0)?>">
									<?php if($t_invoice->approval_1 == 0): ?>
										<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-check-circle"></i> Approve 1
										</button>
									<?php else: ?>
										<button type="submit" class="btn btn-sm btn-danger"><i class="fal fa fa-shield-cross"></i> Unapprove 1
										</button>
									<?php endif; ?>
								</form>
							<?php endif; ?>
							<?php if($t_invoice->approval_1 == 1): ?>
								<form class="form-inline" style="float:left; margin-left: 5px;" method="post" action="<?= base_url('sales/invoice/approve2') ?>">
									<input type="hidden" name="id_invoice" value="<?=$t_invoice->id_invoice?>">
									<input type="hidden" name="approval_2" value="<?=($t_invoice->approval_2 == 0 ? 1 : 0)?>">
									<?php if($t_invoice->approval_2 == 0): ?>
										<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-check-circle"></i> Approve 2
										</button>
									<?php else: ?>
										<button type="submit" class="btn btn-sm btn-danger"><i class="fal fa fa-shield-cross"></i> Unapprove 2
										</button>
									<?php endif; ?>
								</form>
							<?php endif; ?>
							<a href="<?=base_url($_controller.'/'.$_method)?>" style="margin-left: 5px;" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
