<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">DPS</a></li>
		<li class="breadcrumb-item">Procurement</li>
		<li class="breadcrumb-item">Receive Note</li>
		<li class="breadcrumb-item"><?=$t_dn->kode_dn?></li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Detail Receive Note <small><?=$t_dn->kode_dn?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<?php if($t_dn->approval_1 == 0 && $t_dn->approval_2 == 0): ?>
						<button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass-start"></i> Waiting for Approve 1
						</button>
					<?php endif; ?>
					<?php if($t_dn->approval_1 == 1 && $t_dn->approval_2 == 0): ?>
						<button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 1
						</button>
						<button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass-start"></i> Waiting for Approve 2
						</button>
					<?php endif; ?>
					<?php if($t_dn->approval_1 == 1 && $t_dn->approval_2 == 1): ?>
						<button type="button" disabled class="btn btn-primary btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 2
						</button>
					<?php endif; ?>
				</div>
				<div class="card-body">
					<dl class="row">
						<dt class="col-sm-2">RN Number</dt>
						<dd class="col-sm-9"><?= $t_dn->kode_dn ?></dd>
						<dt class="col-sm-2">Arrival Date</dt>
						<dd class="col-sm-9"><?= date('d-m-Y', strtotime($t_dn->tgl_kedatangan)) ?></dd>
						<dt class="col-sm-2">Supplier</dt>
						<dd class="col-sm-9"><?= $t_dn->nama_supplier ?></dd>
						<dt class="col-sm-2">Invoice Number</dt>
						<dd class="col-sm-3"><?= $t_dn->no_invoice ?></dd>
						<dt class="col-sm-2">Invoice Date</dt>
						<dd class="col-sm-5"><?= !empty($t_dn->tgl_invoice) ?date('d-m-Y', strtotime($t_dn->tgl_invoice)) : '-' ?></dd>
						<dt class="col-sm-2">Tax Invoice Number</dt>
						<dd class="col-sm-3"><?= !empty($t_dn->no_faktur) ? $t_dn->no_faktur : '-' ?></dd>
						<dt class="col-sm-2">Tax Invoice Date</dt>
						<dd class="col-sm-5"><?= !empty($t_dn->tgl_faktur) ?date('d-m-Y', strtotime($t_dn->tgl_faktur)) : '-' ?></dd>
						<dt class="col-sm-2">Vehicle Type</dt>
						<dd class="col-sm-3"><?=$t_dn->uraian_jenis_kendaraan?></dd>
						<dt class="col-sm-2">Lisence Plate</dt>
						<dd class="col-sm-3"><?=$t_dn->plat_kendaraan?></dd>
						<dd class="col-sm-2"><span class="badge badge-info"><?=$t_dn->nama_fasilitas?></span></dd>
					</dl>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" style="white-space: nowrap">
									<thead>
									<tr class="text-center">
										<th>No.</th>
										<th>Job Number</th>
										<th>PO Number</th>
										<th>Item Name</th>
										<th>DN Number</th>
										<th>Price</th>
										<th>Quantity</th>
										<th>Subtotal</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach($t_detail_dn as $i => $detail): ?>
										<tr>
											<td class="text-center"><?=($i+1)?></td>
											<td>
												<?=$detail->no_job?><br>
												<small>Job Date: <?=(!empty($detail->tanggal_job) ? date('d-m-Y', strtotime($detail->tanggal_job)) : '-')?></small>
											</td>
											<td>
												<?=$detail->kode_po?><br>
												<small>PO Date: <?=date('d-m-Y', strtotime($detail->tgl_po))?></small>
											</td>
											<td>
												<?= $detail->nama_barang ?><br>
											</td>
											<td>
												<?=$detail->no_sj?><br>
												<small>DN Date: <?=(!empty($detail->tanggal_sj) ? date('d-m-Y', strtotime($detail->tanggal_sj)) : '-')?></small>
											</td>
											<td class="text-right">
												<?=number_format($detail->harga, 2)?><br>
												<small><?=$detail->kode_valuta?></small>
											</td>
											<td class="text-right">
												<?=number_format($detail->qty_dn, 2)?><br>
												<small><?=$detail->kode_satuan?></small>
											</td>
											<td class="text-right">
												<?=number_format($detail->harga * $detail->qty_dn, 2)?><br>
												<small><?=$detail->kode_valuta?></small>
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
							<?php if($t_dn->approval_2 == 0): ?>
								<form class="form-inline" style="float:left; margin-left: 5px;" method="post" action="<?= base_url('procurement/delivery_note_po/approve') ?>">
									<input type="hidden" name="id_dn" value="<?=$t_dn->id_dn?>">
									<input type="hidden" name="approval_1" value="<?=($t_dn->approval_1 == 0 ? 1 : 0)?>">
									<?php if($t_dn->approval_1 == 0): ?>
										<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-check-circle"></i> Approve 1
										</button>
									<?php else: ?>
										<button type="submit" class="btn btn-sm btn-secondary"><i class="fal fa fa-circle"></i> Disapprove 1
										</button>
									<?php endif; ?>
								</form>
							<?php endif; ?>
							<?php if($t_dn->approval_1 == 1): ?>
								<form class="form-inline" style="float:left; margin-left: 5px;" method="post" action="<?= base_url('procurement/delivery_note_po/approve2') ?>">
									<input type="hidden" name="id_dn" value="<?=$t_dn->id_dn?>">
									<input type="hidden" name="approval_2" value="<?=($t_dn->approval_2 == 0 ? 1 : 0)?>">
									<?php if($t_dn->approval_2 == 0): ?>
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
