<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item active">Dashboard</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date">Saturday, August 8,
				2020</span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			<i class="subheader-icon fal fa-chart-area"></i> Dashboard</span>
		</h1>
	</div>
	<div class="row">
	<div class="col-sm-12 col-lg-6">
			<div class="card mb-g">
				<div class="card-header">
					<a target="_blank" rel="noopener noreferrer"><i
							class="fal fa-chart-bar"></i></a>
					&nbsp; Info Perusahaan &nbsp;
					
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12 col-lg-12">
							<div class="table-responsive">
								<table class="table-sm table-hover">
									<thead>
										<tr>
											<strong>PT GLOCAL INDOASIA </strong>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-left">Alamat</td>
											<td class="text-left">:</td>
											<td class="text-left">Jl. Ringroad Mojoagung – Jombang , Kec. Mojoagung Kab. Jombang Jawa Timur</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6">
			<div class="card mb-g">
				<div class="card-header">
					<a href="https://www.beacukai.go.id/kurs.html" target="_blank" rel="noopener noreferrer"><i class="fal fa-external-link"></i></a>
					&nbsp; Nilai Kurs Bea Cukai &nbsp;
					<?php if ($checkrate==0) { ?>
						<a href="<?=base_url('master/rates/update')?>" class="btn btn-xs btn-default"><i class="fal fa-update"></i> Update Rates</a>
					<?php } else { ?>
						<span disabled><?=date('d M Y')?></span>
					<?php } ?>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12 col-lg-12">
							<div class="table-responsive">
								<table class="table table-sm table-hover table-bordered">
									<thead>
										<tr>
											<th class="text-center">Valuta</th>
											<th class="text-right">Rates Jual</th>
											<th class="text-right">Rates Beli</th>
										</tr>
									</thead>
									<?php foreach ($datarate as $row) { ?>
										<tr>
											<td class="text-center"><?=placeValue($row,'kode_valuta')?></td>
											<td class="text-right"><?=number_format($row->rates_beli,2)?></td>
											<td class="text-right"><?=number_format($row->rates_jual,2)?></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-12">
			<div class="card mb-2">
				<div class="card-header">
					<b>Dokumen BC IN</b>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12 col-lg-3">
							<table class="table table-sm table-bordered">
								<thead>
									<tr>
										<th class="text-center" colspan="2">BC 2.3</th>
									</tr>
									<tr>
										<th class="text-center">Status</th>
										<th class="text-center">Jumlah</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>GATE OUT KANTOR BONGKAR</td>
										<td class="text-right">3</td>
									</tr>
									<tr>
										<td>SPPD</td>
										<td class="text-right">25</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-sm-12 col-lg-3">
							<table class="table table-sm table-bordered">
								<thead>
									<tr>
										<th class="text-center" colspan="2">BC 2.6.2</th>
									</tr>
									<tr>
										<th class="text-center">Status</th>
										<th class="text-center">Jumlah</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>READY</td>
										<td class="text-right">1</td>
									</tr>
									<tr>
										<td>GATE IN TPB</td>
										<td class="text-right">1</td>
									</tr>
									<tr>
										<td>SPPD</td>
										<td class="text-right">109</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-sm-12 col-lg-3">
							<table class="table table-sm table-bordered">
								<thead>
									<tr>
										<th class="text-center" colspan="2">BC 4.0</th>
									</tr>
									<tr>
										<th class="text-center">Status</th>
										<th class="text-center">Jumlah</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>READY</td>
										<td class="text-right">1</td>
									</tr>
									<tr>
										<td>GATE IN TPB</td>
										<td class="text-right">4</td>
									</tr>
									<tr>
										<td>SPPD</td>
										<td class="text-right">48</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-sm-12 col-lg-3">
							<table class="table table-sm table-bordered">
								<thead>
									<tr>
										<th class="text-center" colspan="2">BC 2.7 IN</th>
									</tr>
									<tr>
										<th class="text-center">Status</th>
										<th class="text-center">Jumlah</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-12">
			<div class="card mb-2">
				<div class="card-header">
					<b>Dokumen BC OUT</b>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12 col-lg-3">
							<table class="table table-sm table-bordered">
								<thead>
									<tr>
										<th class="text-center" colspan="2">BC 2.5</th>
									</tr>
									<tr>
										<th class="text-center">Status</th>
										<th class="text-center">Jumlah</th>
									</tr>
								</thead>
									<tr>
										<td> </td>
										<td class="text-right">1</td>
									</tr>
									<tr>
										<td>KONFIRMASI PEMBAYARAN</td>
										<td class="text-right">1</td>
									</tr>
									<tr>
										<td>SELESAI PROSES</td>
										<td class="text-right">1</td>
									</tr>
								<tbody>
								</tbody>
							</table>
						</div>
						<div class="col-sm-12 col-lg-3">
							<table class="table table-sm table-bordered">
								<thead>
									<tr>
										<th class="text-center" colspan="2">BC 2.6.1</th>
									</tr>
									<tr>
										<th class="text-center">Status</th>
										<th class="text-center">Jumlah</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>READY</td>
										<td class="text-right">2</td>
									</tr>
									<tr>
										<td>STUFFING</td>
										<td class="text-right">1</td>
									</tr>
									<tr>
										<td>SELESAI PROSES</td>
										<td class="text-right">47</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-sm-12 col-lg-3">
							<table class="table table-sm table-bordered">
								<thead>
									<tr>
										<th class="text-center" colspan="2">BC 4.1</th>
									</tr>
									<tr>
										<th class="text-center">Status</th>
										<th class="text-center">Jumlah</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>SPPD</td>
										<td class="text-right">2</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-sm-12 col-lg-3">
							<table class="table table-sm table-bordered">
								<thead>
									<tr>
										<th class="text-center" colspan="2">BC 2.7</th>
									</tr>
									<tr>
										<th class="text-center">Status</th>
										<th class="text-center">Jumlah</th>
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
</main>