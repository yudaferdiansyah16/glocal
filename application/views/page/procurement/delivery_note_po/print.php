<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Procurement</li>
		<li class="breadcrumb-item">Receive Note</li>
		<li class="breadcrumb-item active">Print</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
	</div>
	<div class="container">
		<div data-size="A4">
			<!--HEADER-->
			<div class="row">
				<div class="col-sm-1">
					<div class="img-container mb-3" align="center">
						<img src="<?= assets_url('img/'.$app->img) ?>" alt="DPS" aria-roledescription="logo" width="100">
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
					<input type="hidden" id="kode_qrcode" value="<?=$t_dn->kode_dn?>">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 text-left">
					<p class="fw-300 display-4 fw-500 color-primary-600 keep-print-font l-h-n m-0">
						Receive Note
					</p>
				</div>
				<div class="col-sm-6 text-right">
					<div class="text-dark fw-700 h1 mb-g keep-print-font">
						<p># <?=$t_dn->kode_dn?></p>
					</div>
				</div>
			</div>
			<!--END HEADER-->
			<div class="row">
				<div class="col-sm-12">
				<dl class="row">
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
					<!-- Table -->
					<div class="row">
						<div class="col-sm-12">
							<div class="table-responsive">
								<table class="table table-mt-5 table-sm" id="dt" role="grid" style="width: 99%">
									<thead>
									<tr>
										<th class="text-center table-scale-border-bottom table-scale-border-top">No</th>
										<th class="text-left table-scale-border-bottom table-scale-border-top">PO Number
										</th>
										<th class="text-left table-scale-border-bottom table-scale-border-top">Item Name
										</th>
										<th class="text-center table-scale-border-bottom table-scale-border-top">
											DO Number
										</th>
										<th class="text-right table-scale-border-bottom table-scale-border-top">
											Unit Price
										</th>
										<th class="text-right table-scale-border-bottom table-scale-border-top">
											Arrival Quantity
										</th>
										<th class="text-right table-scale-border-bottom table-scale-border-top">
											Subtotal
										</th>
									</tr>
									</thead>
									<tbody>

									<?php
									$total_pp = 0; $total_amount = 0;
									$i = 0;
									?>
									<?php foreach($t_detail_dn as $i => $detail): ?>
										<tr>
											<td class="text-center"><?= $i + 1 ?></td>
											<td class="text-left"><?=$detail->kode_po?></td>
											<td class="text-left">
												<?=$detail->nama_barang?>
											</td>
											<td class="text-center">
												<?= $detail->no_sj ?>
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
												<?=number_format($detail->qty_dn * $detail->harga, 2)?><br>
												<small><?=$detail->kode_valuta?></small>
											</td>
										</tr>
										<?php $total_pp += floatval($detail->qty_dn);
										$total_amount += (floatval($detail->qty_dn) * floatval($detail->harga));
										$satuan = $detail->kode_satuan; ?>
										<?php $i++; endforeach; ?>

									</tbody>
									<tfoot>
										<tr>
											<th colspan="6" class="text-center table-scale-border-bottom table-scale-border-top">Total</th>
											<th class="text-right table-scale-border-bottom table-scale-border-top">
												<?= number_format($total_amount, 2) ?>
											</th>
										</tr>
									</tfoot>
								</table>
							</div>
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
	<input type="checkbox" class="menu-open" name="menu-open" id="menu_open"/>
	<label for="menu_open" class="menu-open-button ">
		<span class="app-shortcut-icon d-block"></span>
	</label>
	<a href="#" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Scroll Top">
		<i class="fal fa-arrow-up"></i>
	</a>
	<a href="#" class="menu-item btn" data-action="app-fullscreen" data-toggle="tooltip" data-placement="left"
	   title="Full Screen">
		<i class="fal fa-expand"></i>
	</a>
	<a href="#" class="menu-item btn" data-action="app-print" data-toggle="tooltip" data-placement="left"
	   title="Print page">
		<i class="fal fa-print"></i>
	</a>
</nav>
<script>
	let idpp = <?=$idpp?>;
</script>
