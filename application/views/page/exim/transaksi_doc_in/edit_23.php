<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Exim</li>
		<li class="breadcrumb-item">Transaksi Doc In</li>
		<li class="breadcrumb-item active">Edit</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Edit Transaksi Doc In
		</h1>
	</div>
	<div class="card-header">
		<div class="row">
			<div class="col-sm-12 col-md-5">
				<div class="dataTables_paginate paging_simple_numbers" style="" id="dt_paginate">
					<ul class="pagination">
						<li class="paginate_button page-item previous " id="dt_previous"><a
								href="<?=base_url('exim/transaksi_doc_out/detail/')?><?=placeValue($tpbHeader,'ID')-1?>"
								aria-controls="dt" data-dt-idx="0" tabindex="0" class="page-link"><i
									class="fal fa-chevron-left"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="col-sm-12 col-md-6" style=" text-align: right;">
			</div>
			<div class="col-sm-12 col-md-1" style=" padding-left: 40px; text-align: right;">
				<div class="dataTables_paginate paging_simple_numbers" style=" text-align: right; " id="dt_paginate">
					<ul class="pagination">
						<li class="paginate_button page-item next" id="dt_next"><a
								href="<?=base_url('exim/transaksi_doc_out/detail/')?><?=placeValue($tpbHeader,'ID')+1?>"
								aria-controls="dt" data-dt-idx="3" tabindex="0" class="page-link"><i
									class="fal fa-chevron-right"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<?php if ($status->FLAG_APPROVAL2 == 1) { ?>
					<button type="button" disabled class="btn btn-primary btn-sm btn-pills waves-effect waves-themed">
						<i class="fa fal fa-check"></i> Approved 2
					</button>
					<?php } else if ($status->FLAG_APPROVAL1 == 1) { ?>
					<button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
						<i class="fa fal fa-check"></i> Approved 1
					</button>
					<button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
						<i class="fa fal fa-hourglass-start"></i> Waiting for Approve 2
					</button>
					<?php } else if ($status->FLAG_APPROVAL1 == 0) { ?>
					<button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
						<i class="fa fal fa-hourglass-start"></i> Waiting for Approve 1
					</button>
					<?php } ?>
					<center>PEMBERITAHUAN IMPOR BARANG UNTUK DITIMBUN DI TEMPAT PENIMBUNAN BERIKAT</center>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12 col-lg-12 col-xl-12">
							<dl class="row">
								<dt class="col-sm-12 col-lg-2 col-xl-2">STATUS</dt>
								<dd class="col-sm-12 col-lg-3 col-xl-3">: <?=placeValue($tpbHeader,'URAIAN_STATUS')?></dd>
							</dl>
							<dl class="row">
								<dt class="col-sm-12 col-lg-2 col-xl-2">STATUS PERBAIKAN</dt>
								<dd class="col-sm-12 col-lg-3 col-xl-3">: </dd>

							</dl>
						</div>
						<div class="col-sm-12 col-lg-12 col-xl-12">
							<dl class="row"
								style="margin-top: -10px; padding-top: 10px; border-style: dotted; border-width:1px;">
								<dt class="col-sm-2 col-lg-2 col-xl-2">No Pengajuan</dt>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'NOMOR_AJU')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-6 col-xl-6">&nbsp;</dt>
								<dt class="col-sm-12 col-lg-2 col-xl-2">No Pendaftaran</dt>
								<dd class="col-sm-12 col-lg-2 col-xl-2">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'NOMOR_DAFTAR')?>" disabled> </dd>
								<dt class="col-sm-12 col-lg-8 col-xl-8">&nbsp;</dt>
								<dt class="col-sm-12 col-lg-2 col-xl-2">Tanggal Pendaftaran</dt>
								<dd class="col-sm-12 col-lg-2 col-xl-2">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'TANGGAL_DAFTAR')?>" disabled>
								</dd>
							</dl>
						</div>
						<div class="col-sm-12 col-lg-12 col-xl-12">
							<dl class="row"
								style="margin-top: -10px; padding-top: 10px; border-style:dotted; border-width:1px;">
								<dt class="col-sm-12 col-lg-2 col-xl-2">KPPBC Bongkar</dt>
								<dd class="col-sm-12 col-lg-2 col-xl-2">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'KODE_KANTOR_BONGKAR')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-8 col-xl-8">&nbsp;</dt>
								<dt class="col-sm-12 col-lg-2 col-xl-2">KPPBC Pengawas</dt>
								<dd class="col-sm-12 col-lg-2 col-xl-2">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'KODE_KANTOR')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-8 col-xl-8">&nbsp;</dt>
								<dt class="col-sm-12 col-lg-2 col-xl-2">Tujuan</dt>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'KODE_TUJUAN_TPB')." - ".placeValue($tpbHeader,'URAIAN_TUJUAN_TPB')?>" disabled>
								</dd>
							</dl>
						</div>
						<div class="col-sm-12 col-lg-6 col-xl-6">
							<dl class="row"
								style="margin-top: -10px; padding-top: 10px; border-style: dotted; border-width:1px;">
								<h5 class="col-sm-12 col-lg-12 col-xl-12">PEMASOK</h5>
								<dt class="col-sm-12 col-lg-3 col-xl-3">1. Nama</dt>
								<dd class="col-sm-12 col-lg-9 col-xl-9">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'NAMA_PEMASOK')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-3 col-xl-3">&nbsp; &nbsp; Alamat</dt>
								<dd class="col-sm-12 col-lg-9 col-xl-9">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'ALAMAT_PEMASOK')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-3 col-xl-3">&nbsp; &nbsp; Negara</dt>
								<dd class="col-sm-12 col-lg-2 col-xl-2">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'KODE_NEGARA_PEMASOK')?>" disabled>
								</dd>
							</dl>
							<dl class="row"
								style="margin-top: -17px; padding-top: 15px; border-style: dotted; border-width:1px;">
								<h5 class="col-sm-12 col-lg-12 col-xl-12">IMPORTIR</h5>
								<dt class="col-sm-12 col-lg-3 col-xl-3">2. Identitas</dt>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dd class="col-sm-12 col-lg-5 col-xl-5">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'ID_PENGUSAHA')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-3 col-xl-3">3. Nama</dt>
								<dd class="col-sm-12 col-lg-9 col-xl-9">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'NAMA_PENGUSAHA')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-3 col-xl-3">&nbsp; &nbsp; No.izin</dt>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'NO_IZIN_TPB')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-3 col-xl-3">&nbsp;</dt>
								<dt class="col-sm-12 col-lg-3 col-xl-3">&nbsp; &nbsp; Alamat</dt>
								<dd class="col-sm-12 col-lg-9 col-xl-9">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'ALAMAT_PENGUSAHA')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-3 col-xl-3">4. API</dt>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dd class="col-sm-12 col-lg-5 col-xl-5">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'API_PENGUSAHA')?>" disabled>
								</dd>
							</dl>
							<dl class="row"
								style="margin-top: -17px; padding-top: 15px; border-style: dotted; border-width:1px;">
								<h5 class="col-sm-12 col-lg-8 col-xl-8">PEMILIK</h5>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<a href=#" class="btn btn-sm btn-primary">Copy Data Importir </a>
								</dd>
								<dt class="col-sm-12 col-lg-1 col-xl-1">5.</dt>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'ID_PEMILIK')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-3 col-xl-3"><a href="#">Cek NPWP</a></dt>
								<dt class="col-sm-12 col-lg-3 col-xl-3">6. Nama</dt>
								<dd class="col-sm-12 col-lg-9 col-xl-9">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'NAMA_PEMILIK')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-3 col-xl-3">&nbsp; &nbsp; Alamat</dt>
								<dd class="col-sm-12 col-lg-9 col-xl-9">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'ALAMAT_PEMILIK')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-3 col-xl-3">&nbsp; &nbsp; API</dt>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dd class="col-sm-12 col-lg-5 col-xl-5">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'API_PEMILIK')?>" disabled>
								</dd>
							</dl>
							<dl class="row" style="margin-top: -17px; padding-top: 15px; border-style: dotted; border-width:1px;">
								<h5 class="col-sm-12 col-lg-12 col-xl-12">PPJK</h5>
								<dt class="col-sm-12 col-lg-3 col-xl-3">7. NPWP</dt>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dd class="col-sm-12 col-lg-5 col-xl-5">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-3 col-xl-3">8. Nama</dt>
								<dd class="col-sm-12 col-lg-9 col-xl-9">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-3 col-xl-3">&nbsp; &nbsp; Alamat</dt>
								<dd class="col-sm-12 col-lg-9 col-xl-9">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-3 col-xl-3">9. NP-PPJK</dt>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dd class="col-sm-12 col-lg-5 col-xl-5">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
							</dl>
							<dl class="row" style="margin-top: -17px; padding-top: 15px; border-style: dotted; border-width:1px;">
								<h5 class="col-sm-12 col-lg-12 col-xl-12">PENGANGKUTAN</h5>
								<dt class="col-sm-12 col-lg-5 col-xl-5">10. Cara Pengangkutan</dt>
								<dd class="col-sm-12 col-lg-7 col-xl-7">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'KODE_CARA_ANGKUT')." - ".placeValue($tpbHeader,'URAIAN_CARA_ANGKUT')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-5 col-xl-5">11. Nama Sarana Pengangkutan</dt>
								<dd class="col-sm-12 col-lg-7 col-xl-7">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'NAMA_PENGANGKUT')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-5 col-xl-5">&nbsp; &nbsp; &nbsp; Voy/Flight & Negara</dt>
								<dd class="col-sm-12 col-lg-5 col-xl-5">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'NOMOR_VOY_FLIGHT')?>" disabled>
								</dd>
								<dd class="col-sm-12 col-lg-2 col-xl-2">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'TANGGAL_DAFTAR')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-5 col-xl-5">12. Pelabuhan Muat</dt>
								<dd class="col-sm-12 col-lg-3 col-xl-3">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'KODE_PEL_MUAT')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-4 col-xl-4">&nbsp;</dt>
								<dt class="col-sm-12 col-lg-5 col-xl-5">13. Pelabuhan Transit</dt>
								<dd class="col-sm-12 col-lg-3 col-xl-3">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'KODE_PEL_TRANSIT')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-4 col-xl-4">&nbsp;</dt>
								<dt class="col-sm-12 col-lg-5 col-xl-5">14. Pelabuhan Bongkar</dt>
								<dd class="col-sm-12 col-lg-3 col-xl-3">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'KODE_PEL_BONGKAR')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-4 col-xl-4"><?=placeValue($tpbHeader,'URAIAN_PELABUHAN')?></dt>
							</dl>
							<dl class="row" style="margin-top: -17px; padding-top: 15px; border-style: dotted; border-width:1px;">
								<h5 class="col-sm-12 col-lg-10 col-xl-10">29. KEMASAN</h5>
								<dd class="col-sm-12 col-lg-2 col-xl-2">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'JUMLAH_KEMASAN')?>" disabled>
								</dd>
								<dd class="col-sm-12 col-lg-12 col-xl-12">
									<div class="table-responsive">
										<table class="table table-hover table-bordered table-striped table-sm dt_po_add"
											id="table_dokumen" role="grid" style="white-space: nowrap;">
											<thead>
												<tr>
													<th class="text-center">Jumlah</th>
													<th class="text-center">Kode</th>
													<th class="text-center">Jenis</th>
											</thead>
											<tbody>
												<tr>
													<td><?=placeValue($tpbHeader,'JUMLAH_KEMASAN')?></td>
													<td><?=placeValue($tpbHeader,'KODE_JENIS_KEMASAN')?></td>
													<td><?=placeValue($tpbHeader,'URAIAN_KEMASAN')?></td>
												</tr>
											</tbody>
										</table>
									</div>
								</dd>
							</dl>
						</div>
						<div class="col-sm-12 col-lg-6 col-xl-6">
							<dl class="row" style="margin-top: -10px; padding-top: 10px; border-style: dotted; border-width:1px;">
								<h5 class="col-sm-12 col-lg-12 col-xl-12">DOKUMEN</h5>
								<dt class="col-sm-12 col-lg-4 col-xl-4">15. Invoice</dt>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-4 col-xl-4">16. Fasilitas Impor</dt>
								<dd class="col-sm-12 col-lg-3 col-xl-3">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dd class="col-sm-12 col-lg-3 col-xl-3">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dd class="col-sm-12 col-lg-2 col-xl-2">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-12 col-xl-12">17. Surat Keputusan / Dokumen Lainnya</dt>
								<dd class="col-sm-12 col-lg-12 col-xl-12">
									<div class="table-responsive" style="padding-top: 10px">
										<table class="table table-hover table-bordered table-striped table-sm dt_po_add"
											id="table_dokumen" role="grid" style="white-space: nowrap;">
											<thead>
												<tr>
													<th class="text-center">Jenis Dokumen</th>
													<th class="text-center">Nomor Dokumen</th>
													<th class="text-center">Tanggal</th>
											</thead>
											<tbody>
											<?php 
											foreach($doclain as $p){ 
												$tgldoc = explode(" ", $p->TANGGAL_DOKUMEN);	
											?>
												<tr>
													<td><?=$p->URAIAN_DOKUMEN?></td>
													<td><?=$p->NOMOR_DOKUMEN?></td>
													<td><?=reverseDate($tgldoc[0])?></td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
									</div>
								</dd>
								<dt class="col-sm-12 col-lg-4 col-xl-4">18. LC</dt>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-1 col-xl-1">19.</dt>
								<dd class="col-sm-12 col-lg-3 col-xl-3">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-1 col-xl-1">20.</dt>
								<div class="col-sm-12 col-lg-3 col-xl-3">
									<a href="#" class="btn btn-sm btn-primary">
										</i> BC 1.1 </a>
								</div>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-4 col-xl-4">&nbsp;</dt>
								<dt class="col-sm-12 col-lg-2 col-xl-2">Pos</dt>
								<dd class="col-sm-12 col-lg-2 col-xl-2">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dd class="col-sm-12 col-lg-2 col-xl-2">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dd class="col-sm-12 col-lg-2 col-xl-2">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
							</dl>
							<dl class="row" style="margin-top: -17px; padding-top: 15px; border-style: dotted; border-width:1px;">
								<h5 class="col-sm-12 col-lg-12 col-xl-12">PENIMBUNAN</h5>
								<dt class="col-sm-12 col-lg-4 col-xl-4">21. Tempat Penimbunan</dt>
								<dd class="col-sm-12 col-lg-2 col-xl-2">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'KODE_TPS')?>" disabled>
								</dd>
							</dl>
							<dl class="row" style="margin-top: -17px; padding-top: 15px; border-style: dotted; border-width:1px;">
								<h5 class="col-sm-12 col-lg-12 col-xl-12">HARGA</h5>
								<dt class="col-sm-12 col-lg-4 col-xl-4">22. Valuta</dt>
								<dd class="col-sm-12 col-lg-2 col-xl-2">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'KODE_VALUTA')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-4 col-xl-6">&nbsp;</dt>
								<dt class="col-sm-12 col-lg-4 col-xl-4">23. NDPBM</dt>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm text-right" value="<?=placeValue($tpbHeader,'NDPBM')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-4 col-xl-4">&nbsp;</dt>
								<dt class="col-sm-12 col-lg-4 col-xl-4">24. FOB</dt>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm text-right" value="<?=number_format(placeValue($tpbHeader,'FOB'), 2)?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-4 col-xl-4">&nbsp;</dt>
								<dt class="col-sm-12 col-lg-4 col-xl-4">25. Freight</dt>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm text-right" value="<?=number_format(placeValue($tpbHeader,'FREIGHT'), 2)?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-4 col-xl-4">&nbsp;</dt>
								<dt class="col-sm-12 col-lg-4 col-xl-4">26. Asuransi LN / DN</dt>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm text-right" value="<?=number_format(placeValue($tpbHeader,'ASURANSI'), 2)?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-4 col-xl-4">&nbsp;</dt>
								<dt class="col-sm-12 col-lg-4 col-xl-4">27. Nilai CIF</dt>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm text-right" value="<?=number_format(placeValue($tpbHeader,'CIF'), 2)?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-4 col-xl-4">&nbsp;</dt>
								<dt class="col-sm-12 col-lg-4 col-xl-4">&nbsp; &nbsp; &nbsp; Nilai CIF Rupiah</dt>
								<dd class="col-sm-12 col-lg-4 col-xl-4">
									<input type="text" class="form-control form-control-sm text-right" value="<?=number_format(placeValue($tpbHeader,'CIF_RUPIAH'), 2)?>" disabled>
								</dd>
							</dl>
							<dl class="row" style="margin-top: -17px; padding-top: 15px; border-style: dotted; border-width:1px;">
								<h5 class="col-sm-12 col-lg-10 col-xl-10">28. Container</h5>
								<dd class="col-sm-12 col-lg-2 col-xl-2">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'')?>" disabled>
								</dd>
								<dd class="col-sm-12 col-lg-12 col-xl-12">
									<div class="table-responsive">
										<table class="table table-hover table-bordered table-striped table-sm dt_po_add"
											id="table_dokumen" role="grid" style="white-space: nowrap;">
											<thead>
												<tr>
													<th class="text-center">Nom Or Count</th>
													<th class="text-center">Ukuran</th>
													<th class="text-center">Tipe</th>
											</thead>
											<tbody>
												<tr>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</div>
								</dd>
							</dl>
							<dl class="row" style="margin-top: -17px; padding-top: 15px; border-style: dotted; border-width:1px;">
								<h5 class="col-sm-12 col-lg-12 col-xl-12">Barang</h5>
								<dt class="col-sm-12 col-lg-4 col-xl-4">30. Bruto (Kg)</dt>
								<dd class="col-sm-12 col-lg-3 col-xl-3">
									<input type="text" class="form-control form-control-sm text-right" value="<?=placeValue($tpbHeader,'BRUTO')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-5 col-xl-5">&nbsp;</dt>
								<dt class="col-sm-12 col-lg-4 col-xl-4">31. Netto (Kg)</dt>
								<dd class="col-sm-12 col-lg-3 col-xl-3">
									<input type="text" class="form-control form-control-sm text-right" value="<?=placeValue($tpbHeader,'NETTO')?>" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-5 col-xl-5">&nbsp;</dt>
								<dt class="col-sm-12 col-lg-4 col-xl-4">&nbsp; &nbsp; &nbsp; Jumlah Barang</dt>
								<dd class="col-sm-12 col-lg-3 col-xl-3">
									<input type="text" class="form-control form-control-sm text-right" value="<?=placeValue($tpbHeader,'JUMLAH_BARANG')?>" disabled>
								</dd>
							</dl>
						</div>
						<div class="col-sm-12 col-lg-12 col-xl-12">
							<dd class="col-sm-12 col-lg-12 col-xl-12">
								<div class="table-responsive" style="padding-top: 10px">
									<table class="table table-hover table-bordered table-striped table-sm dt_po_add"
										id="table_dokumen" role="grid" style="white-space: nowrap;">
										<thead>
											<tr>
												<th class="text-center">Jenis Pungutan</th>
												<th class="text-center">Ditangguhkan (Rp)</th>
												<th class="text-center">Dibebaskan (Rp)</th>
												<th class="text-center">Tidak Dipungut (Rp)</th>
										</thead>
										<tbody>
											<tr>
												<td class="text-center">BM</td>
												<td class="text-right">&nbsp;</td>
												<td class="text-right">&nbsp;</td>
												<td class="text-right">&nbsp;</td>
											</tr>
											<tr>
												<td class="text-center">BMT</td>
												<td class="text-right">&nbsp;</td>
												<td class="text-right">&nbsp;</td>
												<td class="text-right">&nbsp;</td>
											</tr>
											<tr>
												<td class="text-center">Cukai</td>
												<td class="text-right">&nbsp;</td>
												<td class="text-right">&nbsp;</td>
												<td class="text-right">&nbsp;</td>
											</tr>
											<tr>
												<td class="text-center">PPN</td>
												<td class="text-right">&nbsp;</td>
												<td class="text-right">&nbsp;</td>
												<td class="text-right">&nbsp;</td>
											</tr>
											<tr>
												<td class="text-center">PPnBM</td>
												<td class="text-right">&nbsp;</td>
												<td class="text-right">&nbsp;</td>
												<td class="text-right">&nbsp;</td>
											</tr>
											<tr>
												<td class="text-center">PPH</td>
												<td class="text-right">&nbsp;</td>
												<td class="text-right">&nbsp;</td>
												<td class="text-right">&nbsp;</td>
											</tr>
										</tbody>
										<tfoot>
											<tr>
												<th class="text-center">TOTAL</th>
												<th class="text-right">&nbsp;</th>
												<th class="text-right">&nbsp;</th>
												<th class="text-right">&nbsp;</th>
											</tr>
										</tfoot>
									</table>
								</div>
							</dd>
						</div>
						<div class="col-sm-12 col-lg-12 col-xl-12">
							<dl class="row">
								<dd class="col-sm-12 col-lg-12 col-xl-12">Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal yang diberitahukan dalam dokumen ini.</dd>
								<dd class="col-sm-12 col-lg-3 col-xl-3">
									<input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'KOTA_TTD')?>" disabled>
								</dd>
								<dd class="col-sm-12 col-lg-3 col-xl-3">
									<input type="text" class="form-control form-control-sm" value="<?=substr(placeValue($tpbHeader,'TANGGAL_TTD'),0, 10)?>" disabled>
								</dd>
								<dd class="col-sm-12 col-lg-6 col-xl-6">&nbsp;</dd>
								<dt class="col-sm-12 col-lg-2 col-xl-2">Pemberitahu</dt>
								<dd class="col-sm-12 col-lg-4 col-xl-4"><input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'NAMA_TTD')?>" disabled></dd>
								<dt class="col-sm-12 col-lg-6 col-xl-6">&nbsp;</dt>
								<dt class="col-sm-12 col-lg-2 col-xl-2">Jabatan</dt>
								<dd class="col-sm-12 col-lg-4 col-xl-4"><input type="text" class="form-control form-control-sm" value="<?=placeValue($tpbHeader,'JABATAN_TTD')?>" disabled></dd>
							</dl>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<a href="<?=base_url('exim/transaksi_doc_in/')?>" class="btn btn-sm btn-info"><i class="fal fa fa-times-circle"></i> Back</a>
				</div>
			</div>
		</div>
	</div>
</main>
<script>
	let id_header=<?=$tpbHeader->ID?>;
</script>
