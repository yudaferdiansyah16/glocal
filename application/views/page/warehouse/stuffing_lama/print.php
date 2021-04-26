<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">SMARTONE</a></li>
		<li class="breadcrumb-item">Warehouse</li>
		<li class="breadcrumb-item">Stuffing</li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
	</div>
	<div class="container">
		<div data-size="A4">
			<div class="row">
				<div class="col-sm-12">
					<div class="img-container mb-3" align="center">
						<img src="<?= assets_url('') ?>img/cop_sbp.png" alt="SBP" aria-roledescription="logo" width="100">
					</div>
					<div class="d-flex align-items-center">
						<h2 class="keep-print-font fw-700 mb-0 text-dark flex-1 position-relative" align="center">
							<!--							--><?//= $t_stuffing->nama_supplier ?>
						</h2>
					</div>
					<div class="d-flex align-items-center mb-6">
						<h6 class="keep-print-font fw-400 mb-0 text-dark flex-1 position-relative" align="center">
							<!--							--><?//=$app->alamat?>
						</h6>
					</div>
					<h5 class="fw-300 display-4 fw-500 color-primary-600 keep-print-font pt-4 l-h-n m-0">
						Stuffing
					</h5>
					<div class="text-dark fw-700 h1 mb-g keep-print-font">
						<!--						<p>--><?//= $t_stuffing->kode_stuffing ?><!--</p>-->
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 d-flex">
					<div class="table-responsive">
						<table class="table table-clean table-sm align-self-end">
							<tbody>
							<tr>
								<td>
									Transaction Number
								</td>
								<td>
									<!--									<strong>: --><?//= date('d-m-Y', strtotime($ppheader->tanggal_dibuat)) ?><!--</strong>-->
								</td>
							</tr>
							<tr>
								<td>
									Stuffing Date
								</td>
								<td>
									<!--									<strong>: --><?//= date('d-m-Y', strtotime($t_stuffing->tanggal_stuffing)) ?><!--</strong>-->
								</td>
							</tr>
							<tr>
								<td>
									Supplier
								</td>
								<td>
									<!--									<strong>: --><?//= $t_stuffing->nama_supplier ?><!--</strong>-->
								</td>
							</tr>
							<tr>
								<td>
									Container Number
								</td>
								<td>
									<!--									<strong>: --><?//= $t_stuffing->container_number ?><!--</strong>-->
								</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>

			</div>

			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table class="table table-mt-5 table-sm" id="dt" role="grid" style="width: 99%">
							<thead>
							<tr class="text-center">
								<th class="text-center table-scale-border-bottom table-scale-border-top" rowspan="2">No.</th>
								<th class="text-center table-scale-border-bottom table-scale-border-top" rowspan="2">Item Product</th>
								<th class="text-center table-scale-border-bottom table-scale-border-top" rowspan="2">SO Number</th>
								<th class="text-center table-scale-border-bottom table-scale-border-top" rowspan="2">Job Number</th>
								<th class="text-center table-scale-border-bottom table-scale-border-top" colspan="2">Plan</th>
								<th class="text-center table-scale-border-bottom table-scale-border-top" colspan="2">Realisasi</th>
								<th class="text-center table-scale-border-bottom table-scale-border-top" rowspan="2">Netto</th>
								<th class="text-center table-scale-border-bottom table-scale-border-top" rowspan="2">Bruto</th>
							</tr>
							<tr class="text-center">
								<th class="text-center table-scale-border-bottom table-scale-border-top"> QTY</th>
								<th class="text-center table-scale-border-bottom table-scale-border-top">MC</th>
								<th class="text-center table-scale-border-bottom table-scale-border-top">QTY</th>
								<th class="text-center table-scale-border-bottom table-scale-border-top">MC</th>
							</tr>
							</thead>

							<!--
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
							-->
							<tbody>
							<!--
							<?php
							$total_pp = 0;
							$i = 0;
							?>
							<?php foreach ($ppdetail as $detail): ?>
								<tr>
									<td class="text-center"><?= $i + 1 ?></td>
									<td class="text-left"><?= $detail->no_job ?></td>
									<td class="text-left">
										<?= $detail->barang?>
									</td>
									<td class="text-right">
										<?= $detail->qty_pp ?>
									</td>
									<td class="text-right">
										<?= $detail->keterangan ?>
									</td>
								</tr>
								<?php $total_pp += floatval($detail->qty); $satuan = $detail->satuan; ?>
								<?php $i++; endforeach; ?>
								-->
							</tbody>
						</table>
					</div>
				</div>
			</div>



			<div class="row">
				<div class="col-sm-4 ml-sm-auto">
					<table class="table table-clean">
						<tbody>
						<tr class="table-scale-border-top border-left-0 border-right-0 border-bottom-0">
							<td class="text-left keep-print-font">
								<h4 class="m-0 fw-700 h2 keep-print-font color-primary-700">Total</h4>
							</td>
							<td class="text-left keep-print-font">
								<!--								<span class="m-0 fw-700 h2 keep-print-font">--><?//=number_format($total_pp, 3)?><!-- </span>-->
								<!--								<small class="m-0 fw-700 h2 keep-print-font">--><?//=$satuan?><!-- </small>-->
							</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 ml-sm-auto">
					<table class="table table-clean">
						<tbody>
						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
</main>

<nav class="shortcut-menu d-none d-sm-block">
	<input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
	<label for="menu_open" class="menu-open-button ">
		<span class="app-shortcut-icon d-block"></span>
	</label>
	<a href="#" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Scroll Top">
		<i class="fal fa-arrow-up"></i>
	</a>
	<a href="#" class="menu-item btn" data-action="app-fullscreen" data-toggle="tooltip" data-placement="left" title="Full Screen">
		<i class="fal fa-expand"></i>
	</a>
	<a href="#" class="menu-item btn" data-action="app-print" data-toggle="tooltip" data-placement="left" title="Print page">
		<i class="fal fa-print"></i>
	</a>
</nav>
<script>
	let idpp = <?=$idpp?>;
</script>

