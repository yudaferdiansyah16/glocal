<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">SMARTONE</a></li>
		<li class="breadcrumb-item">Sales</li>
		<li class="breadcrumb-item ">Sales Invoice</li>
		<li class="breadcrumb-item active">Detail Sales Invoice</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
	</div>
	<div class="container">
		<div data-size="A4">
			<!--HEADER-->
			<div class="row">
				<div class="col-sm-1">
					<div class="img-container mb-3 text-left">
						<img src="<?= assets_url('') ?>img/cop_sbp.png" alt="SBP" aria-roledescription="logo" width="100">
					</div>
				</div>
				<div class="col-sm-10">
					<div class="d-flex align-items-center">
						<h2 class="keep-print-font fw-700 mb-0 text-dark flex-1 position-relative" align="center">
							<?=$app->nama_sbu?>
						</h2>
					</div>
					<div class="d-flex align-items-center mb-6">
						<h6 class="keep-print-font fw-400 mb-0 text-dark flex-1 position-relative" align="center">
							<?=$app->alamat?>
						</h6>
					</div>
				</div>
				<div class="col-sm-1 text-right">
					<div id="qrcode"></div>
					<input type="hidden" id="kode_qrcode" value="<?= $t_invoice->kode_invoice ?>">
				</div>
			</div>
			<!--END HEADER-->
			<div class="row">
				<div class="col-sm-6 text-left">
					<p class="fw-300 display-4 fw-500 color-primary-600 keep-print-font l-h-n m-0">
						Sales Ivoice
					</p>
				</div>
				<div class="col-sm-6 text-right">
					<div class="text-dark fw-700 h1 mb-g keep-print-font">
						<p>#<?= $t_invoice->kode_invoice ?></p>
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
									Invoice Date
								</td>
								<td>
									<strong>: <?= date('d-m-Y', strtotime($t_invoice->tanggal_invoice)) ?></strong>
								</td>
							</tr>
							<tr>
								<td>
									Supplier
								</td>
								<td>
									<strong>: <?= $t_invoice->nama_supplier ?></strong>
								</td>
							</tr>
							<tr>
								<td>
									Destination
								</td>
								<td>
									<strong>: <?= $t_invoice->destination ?>, <?= $t_invoice->uraian_negara ?></strong>
								</td>
							</tr>
							<tr>
								<td>
									BL Number
								</td>
								<td>
									<strong>: <?= $t_invoice->no_bl ?></strong>
								</td>
							</tr>
							<tr>
								<td>
									Currency
								</td>
								<td>
									<strong>: <?= $t_invoice->kode_valuta ?></strong>
								</td>
							</tr>
							<tr>
								<td>
									Rate
								</td>
								<td>
									<strong>: <?= number_format($t_invoice->rate, 0) ?></strong>
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
							<tr>
								<th class="text-center table-scale-border-bottom table-scale-border-top">No</th>
								<th class="text-center table-scale-border-bottom table-scale-border-top">Item Product</th>
								<th class="text-center table-scale-border-bottom table-scale-border-top">SO Number</th>
								<th class="text-center table-scale-border-bottom table-scale-border-top">Quantity</th>
								<th class="text-center table-scale-border-bottom table-scale-border-top">Carton</th>
								<th class="text-center table-scale-border-bottom table-scale-border-top">Price</th>
								<th class="text-center table-scale-border-bottom table-scale-border-top">Netto</th>
								<th class="text-center table-scale-border-bottom table-scale-border-top">Bruto</th>
								<th class="text-center table-scale-border-bottom table-scale-border-top">Subtotal</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$total_pp = 0;
							$i = 0;
							?>
							<?php foreach ($t_invoice_detail as $detail): ?>

								<tr>
									<td class="text-center"><?= $i + 1 ?></td>
									<td class="text-center"><?= $detail->nama_barang ?><small><?= $detail->kode_barang ?></small></td>

									<td class="text-center"><?=$detail->kode_po?>
										<small><?= date('d-m-Y', strtotime($detail->tanggal_dibuat)) ?></small>
										<small>PO Buyer: <?= $detail->po_buyer ?></small></td>

									<td class="text-center"><?= number_format($detail->qty_invoice, 2) ?><br>
										<small><?= $detail->kode_satuan ?></small></td>

									<td class="text-center"><?= number_format($detail->qty_mc, 0) ?>
										<small><?= $detail->kode_kemasan ?></small></td>

									<td class="text-center"><?=$t_invoice->kode_valuta?> <?= number_format($detail->harga, 2) ?></td>

									<td class="text-center"><?= number_format($detail->netto, 0) ?><br>
										<small>KGM</small></td>

									<td class="text-center"><?= number_format($detail->bruto, 0) ?><br>
										<small>KGM</small></small></td>

									<td class="text-right"><?=$t_invoice->kode_valuta?> <?= number_format($detail->qty_invoice * $detail->harga, 2) ?><br>
									</td>

								</tr>
								<?php $total_pp += floatval($detail->nama_barang); ?>
								<?php $i++; endforeach; ?>
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
								<span class="m-0 fw-700 h2 keep-print-font"><?=number_format($total_pp, 3)?> </span>
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

