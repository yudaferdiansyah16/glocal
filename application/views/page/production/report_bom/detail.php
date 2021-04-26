<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">DPS</a></li>
		<li class="breadcrumb-item">Production</li>
		<li class="breadcrumb-item ">Report BOM</li>
		<li class="breadcrumb-item active">Report BOM</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Report BOM
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<div class="row">
						<div class="col-md-2">
							<p><b>NO SO</b></p>
							<p><b>Tanggal SO</b></p>
							<p><b>PO Customer</b></p>
							<p><b>Destination</b></p>
							<p><b>Admin</b></p>
						</div>
						<div class="col-md-2">
							<p>: <?= $reqheader->kode_po?></p>
							<p>: <?= $reqheader->tanggal_dibutuhkan?></p>
							<p>: <?= $reqheader->po_buyer?></p>
							<p>: <?= $reqheader->alamat?></p>
							<p>: </p>

						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<?php
							$i = 1;
							foreach ($detailbom->data as $row) {
							?>
								<li class="nav-item">
									<a class="nav-link" id="home-tab_<?= $i ?>" data-toggle="tab" href="#tab_bom_<?= $i ?>" role="tab"
										aria-controls="tab_bom_<?= $i ?>" aria-selected="true">BOM <?=$i?> </a>
								</li>
								<?php	$i++; }?>

							</ul>
							<div class="tab-content" id="myTabContent">
										<?php
									$i = 1;
									foreach ($detailbom->data as $row) {
			
									?>
								<div class="tab-pane fade " id="tab_bom_<?= $i ?>" role="tabpanel" aria-labelledby="home-tab_<?= $i ?>">
									<div class="row" style="margin-top: 15px;">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-2">
													<p><b>NO BOM</b></p>
													<p><b>Tanggal BOM</b></p>
													<p><b>NO JOB</b></p>
													<p><b>Tanggal JOB</b></p>
													<p><b>Nama Barang</b></p>
													<p><b>Kode Barang</b></p>
													<p><b>QTY Order</b></p>
													<p><b>Harga</b></p>
												</div>
												<div class="col-md-10">
													<p>: <?= $row->nomor ?></p>
													<p>: <?= $row->tanggal_bom ?></p>
													<p>: <?= $row->no_job ?></p>
													<p>: <?= $row->tanggal_job ?></p>
													<p>: <?= $row->nama_barang ?></p>
													<p>: <?= $row->id_sub_barang ?></p>
													<p>: <?= $row->qty_bom ?></p>
													<p>: <?= $row->harga ?></p>

												</div>

											</div>
											<div class="row">
												<div class="col-md-12">
													<ul class="nav nav-tabs" id="myTab2" role="tablist">
														<li class="nav-item">
															<a class="nav-link active" id="home-tab" data-toggle="tab"
																href="#tab_purchase_order" role="tab"
																aria-controls="tab_purchase_order"
																aria-selected="true">Purchase
																Order</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" id="home-tab" data-toggle="tab"
																href="#tab_receive_note" role="tab"
																aria-controls="tab_receive_note"
																aria-selected="false">Receive Note</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" id="home-tab" data-toggle="tab"
																href="#tab_wh" role="tab" aria-controls="tab_wh"
																aria-selected="false">WH</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" id="home-tab" data-toggle="tab"
																href="#tab_production" role="tab"
																aria-controls="tab_production"
																aria-selected="false">Production</a>
														</li>
													</ul>
													<div class="tab-content" id="myTabContents">
														<div class="tab-pane fade show active" id="tab_purchase_order"
															role="tabpanel" aria-labelledby="home-tab">
															<div class="row" style="margin-top: 15px;">
																<div class="col-md-12">
																	<div class="table-responsive">
																		<table
																			class="table table-sm table-bordered table-striped table-hover">
																			<thead>
																				<tr class="text-center">
																					<th rowspan="2">No.</th>
																					<th rowspan="2">No PO</th>
																					<th rowspan="2">Tanggal PO</th>
																					<th rowspan="2">No JOB</th>
																					<th rowspan="2">Supplier</th>
																					<th colspan="6">Barang</th>
																				</tr>
																				<tr class="text-center">
																					<th>Nama</th>
																					<th>Kode</th>
																					<th>Satuan</th>
																					<th>QTY</th>
																					<th>Valuta</th>
																					<th>Harga</th>
																				</tr>
																			</thead>
																			<tbody>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>
														</div>
														<div class="tab-pane fade" id="tab_receive_note" role="tabpanel"
															aria-labelledby="home-tab">
															<div class="row" style="margin-top: 15px;">
																<div class="col-md-12">
																	<div class="table-responsive">
																		<table
																			class="table table-sm table-bordered table-striped table-hover">
																			<thead>
																				<tr class="text-center">
																					<th rowspan="2">No.</th>
																					<th rowspan="2">No Receive</th>
																					<th rowspan="2">Tanggal Receive</th>
																					<th rowspan="2">No JOB</th>
																					<th rowspan="2">Supplier</th>
																					<th rowspan="2">No SJ</th>
																					<th rowspan="2">Tanggal SJ</th>
																					<th colspan="7">Barang</th>
																				</tr>
																				<tr class="text-center">
																					<th>Nama</th>
																					<th>Kode</th>
																					<th>Satuan</th>
																					<th>QTY</th>
																					<th>Valuta</th>
																					<th>Harga</th>
																					<th>ID Header</th>
																				</tr>
																			</thead>
																			<tbody>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>
														</div>
														<div class="tab-pane fade" id="tab_wh" role="tabpanel"
															aria-labelledby="home-tab">
															<div class="row" style="margin-top: 15px;">
																<div class="col-md-12">
																	<div class="table-responsive">
																		<table
																			class="table table-sm table-bordered table-striped table-hover">
																			<thead>
																				<tr class="text-center">
																					<th rowspan="2">No.</th>
																					<th rowspan="2">No Receive</th>
																					<th rowspan="2">No JOB</th>
																					<th colspan="9">Barang</th>
																				</tr>
																				<tr class="text-center">
																					<th>Nama</th>
																					<th>Kode</th>
																					<th>Satuan</th>
																					<th>Request</th>
																					<th>Realisasi</th>
																					<th>Return</th>
																					<th>Scrap</th>
																					<th>Waste</th>
																					<th>Loss</th>
																				</tr>
																			</thead>
																			<tbody>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>
														</div>
														<div class="tab-pane fade" id="tab_production" role="tabpanel"
															aria-labelledby="home-tab">
															<div class="row" style="margin-top: 15px;">
																<div class="col-md-12">
																	<div class="table-responsive">
																		<table
																			class="table table-sm table-bordered table-striped table-hover">
																			<thead>
																				<tr class="text-center">
																					<th rowspan="2">No.</th>
																					<th colspan="2">History JOB</th>
																					<th rowspan="2">No Receive</th>
																					<th colspan="11">Barang</th>
																				</tr>
																				<tr class="text-center">
																					<th>No JOB</th>
																					<th>No JOB Lain</th>
																					<th>Nama</th>
																					<th>Kode</th>
																					<th>Satuan</th>
																					<th>Request</th>
																					<th>Realisasi</th>
																					<th>Return</th>
																					<th>FG</th>
																					<th>WIP</th>
																					<th>Scrap</th>
																					<th>Waste</th>
																					<th>Loss</th>
																				</tr>
																			</thead>
																			<tbody>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										

										</div>
										
									</div>
								</div>
								<?php	$i++; }?>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

</main>
<script>
	let id_po =<?= $poheader->id_po ?> ;
</script>