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
	<div class="card-header ">
				<div class="row">
				<div class="col-sm-12 col-md-5">
				<div class="dataTables_paginate paging_simple_numbers" style="" id="dt_paginate">
						<ul class="pagination">
							<li class="paginate_button page-item previous " id="dt_previous"><a href="<?=base_url('exim/transaksi_doc_out/edit/')?><?=placeValue($tpbHeader,'ID')-1?>"
									aria-controls="dt" data-dt-idx="0" tabindex="0" class="page-link"><i
										class="fal fa-chevron-left"></i></a></li>
						
							
						</ul>
					</div>
				</div>
				<div class="col-sm-12 col-md-6" style=" text-align: right;" >
				</div>
				<div class="col-sm-12 col-md-1" style=" padding-left: 40px; text-align: right;" >
				<div class="dataTables_paginate paging_simple_numbers" style=" text-align: right; " id="dt_paginate">
						<ul class="pagination">
							<li class="paginate_button page-item next" id="dt_next"><a
									href="<?=base_url('exim/transaksi_doc_out/edit/')?><?=placeValue($tpbHeader,'ID')+1?>"
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
				<div class="card-header   ">
				 <center>
				 PEMBERITAHUAN IMPOR BARANG UNTUK DITIMBUN DI TEMPAT PENIMBUNAN BERIKAT
				 </center>
				 </div>
				</div>
<div class="card-body">
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top: 15px; border-width:1px;  ">
			<dl class="row">
				<dt class="col-sm-3">STATUS</dt>
				<dd class="col-sm-3">: <?=placeValue($tpbHeader,'URAIAN_STATUS')?></dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">STATUS PERBAIKAN</dt>
				<dd class="col-sm-3">: <?=placeValue($tpbHeader,'KODE_STATUS_PERBAIKAN')?></dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-3">NOMOR PENGAJUAN</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'NOMOR_AJU')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">NOMOR PENDAFTARAN</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'NOMOR_DAFTAR')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">TANGGAL PENDAFTARAN</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'TANGGAL_DAFTAR')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-3">KANTOR PABEAN</dt>
				<dd class="col-sm-3">
					<input type="text" value="<?=placeValue($tpbHeader,'KODE_KANTOR')?>" class="form-control form-control-sm " readOnly>
				</dd>
				<dt class="col-sm-3">KODE GUDANG PLB</dt>
				<dd class="col-sm-3">
					<input type="text" value="<?=placeValue($tpbHeader,'KODE_JENIS_TPB')?>" class="form-control form-control-sm " readOnly>
				</dd>
				<dt class="col-sm-3">TUJUAN PEMASUKAN</dt>
				<dd class="col-sm-3"><input type="text" value="<?=placeValue($tpbHeader,'URAIAN_JENIS_TPB')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>		
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-9"><u>PENGUSAHA TPB</u></dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">1. NPWP</dt>
				<dd class="col-sm-4">
					<input type="text" value="1 - NPWP 15 DIGIT" class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-5">
					<input type="text" value="<?=placeValue($tpbHeader,'ID_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">2. NAMA</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'NAMA_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">ALAMAT</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'ALAMAT_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">3. IJIN TPB</dt>
				<dd class="col-sm-4">
					<input type="text" value="<?=placeValue($tpbHeader,'NOMOR_IJIN_TPB')?>" class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-5">
					<input type="text" value="<?=placeValue($tpbHeader,'NOMOR_IJIN_TPB')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">4. API</dt>
				<dd class="col-sm-4">
					<input type="text" value="<?=placeValue($tpbHeader,'NOMOR_IJIN_TPB')?>" class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-5">
					<input type="text" value="<?=placeValue($tpbHeader,'NOMOR_IJIN_TPB')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-9"><u>PENGIRIM BARANG</u></dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">5. </dt>
				<dd class="col-sm-4"><input type="text" value="1 - NPWP 15 DIGIT" class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-4">
					<input type="text" value="<?=placeValue($tpbHeader,'ID_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-1">
					<a href="">CEK N</a>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">6. NAMA</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'NAMA_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">7. ALAMAT</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'ALAMAT_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-9"><u><a href="#" data-toggle="modal" data-target="#m_dokumen_modal">DOKUMEN [F6]</a></u></dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">8. PACKING LIST</dt>
				<dd class="col-sm-5">
					<input type="text" value="<?=placeValue($tpbHeader,'ID_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-4">
					<input type="text" value="<?=placeValue($tpbHeader,'ID_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">9. SURAT KEPUTUSAN</dt>
				<dd class="col-sm-5">
					<input type="text" value="<?=placeValue($tpbHeader,'ID_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-4">
					<input type="text" value="<?=placeValue($tpbHeader,'ID_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">10. DOK. BC 2.6</dt>
				<dd class="col-sm-5">
					<input type="text" value="<?=placeValue($tpbHeader,'ID_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-4">
					<input type="text" value="<?=placeValue($tpbHeader,'ID_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-9">DOKUMEN LAINNYA</dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-12">
					<table class="table table-hover table-bordered table-striped table-sm" id="" role="grid" style="white-space: nowrap; min-width: 600px">
						<thead>
							<tr>
								<th class="text-center">JENIS DOKUMEN</th>
								<th class="text-center">NOMOR DOKUMEN</th>
								<th class="text-center">TANGGAL</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</dt>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-9"><u>HARGA</u></dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">11. VALUTA</dt>
				<dd class="col-sm-3"></dd>
				<dd class="col-sm-6">
					<input type="text" value="<?=placeValue($tpbHeader,'ID_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">12. NDPBM</dt>
				<dd class="col-sm-3"><a href="" class="btn btn-sm btn-primary">NDPBM</a></dd>
				<dd class="col-sm-6">
					<input type="text" value="<?=placeValue($tpbHeader,'ID_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">13. NILAI CIF</dt>
				<dd class="col-sm-3"></dd>
				<dd class="col-sm-6">
					<input type="text" value="<?=placeValue($tpbHeader,'ID_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">NILAI CIF (Rp)</dt>
				<dd class="col-sm-3"></dd>
				<dd class="col-sm-6">
					<input type="text" value="<?=placeValue($tpbHeader,'ID_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-9"><u>PENGANGKUTAN</u></dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">14. JENIS SARANA PENGANGKUTAN</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'ID_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-11"><u><a href="#" data-toggle="modal" data-target="#m_kontainner_modal">15. KONTAINER [F5]</a></u></dt>
				<dd class="col-sm-1"><input type="text" value="" class="form-control form-control-sm "></dd>
				<dt class="col-sm-12">
					<table class="table table-hover table-bordered table-striped table-sm" id="" role="grid" style="white-space: nowrap; min-width: 600px">
						<thead>
							<tr>
								<th class="text-center">NOMOR CONT</th>
								<th class="text-center">UKURAN</th>
								<th class="text-center">TIPE</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</dt>
			</dl>
			<dl class="row">
				<dt class="col-sm-11"><u><a href="#" data-toggle="modal" data-target="#m_kemasan_modal">16. KEMASAN [F7]</a></u></dt>
				<dd class="col-sm-1"><input type="text" value="1" class="form-control form-control-sm"></dd>
				<dt class="col-sm-12">
					<table class="table table-hover table-bordered table-striped table-sm" id="" role="grid" style="white-space: nowrap; min-width: 600px">
						<thead>
							<tr>
								<th class="text-center">JUMLAH</th>
								<th class="text-center">KODE JENIS</th>
								<th class="text-center">JENIS</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</dt>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-9"><u><a href="#" data-toggle="modal" data-target="#m_barang_modal">BARANG [F4]</a></u></dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">17. BRUTO (Kg)</dt>
				<dd class="col-sm-1"></dd>
				<dd class="col-sm-8">
					<input type="text" value="<?=placeValue($tpbHeader,'ID_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
				<dt class="col-sm-3">18. NETTO (Kg)</dt>
				<dd class="col-sm-1"></dd>
				<dd class="col-sm-8">
					<input type="text" value="<?=placeValue($tpbHeader,'ID_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
				<dt class="col-sm-3">JUMLAH BARANG</dt>
				<dd class="col-sm-1">
					<input type="text" value="1" class="form-control form-control-sm" readOnly>
				</dd>
				<dd class="col-sm-8"></dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-3">JENIS PUNGUTAN</dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">DITANGGUHKAN (Rp)</dt>
				<dd class="col-sm-3"></dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-6">19. BM</dt>
				<dd class="col-sm-6">
					<input type="text" value="" class="form-control form-control-sm" readOnly>
				</dd>
				<dt class="col-sm-6">20. BMT</dt>
				<dd class="col-sm-6">
					<input type="text" value="" class="form-control form-control-sm" readOnly>
				</dd>
				<dt class="col-sm-6">21. CUKAI</dt>
				<dd class="col-sm-6">
					<input type="text" value="" class="form-control form-control-sm" readOnly>
				</dd>
				<dt class="col-sm-6">22. PPN</dt>
				<dd class="col-sm-6">
					<input type="text" value="" class="form-control form-control-sm" readOnly>
				</dd>
				<dt class="col-sm-6">23. PPnBM</dt>
				<dd class="col-sm-6">
					<input type="text" value="" class="form-control form-control-sm" readOnly>
				</dd>
				<dt class="col-sm-6">24. PPh</dt>
				<dd class="col-sm-6">
					<input type="text" value="" class="form-control form-control-sm" readOnly>
				</dd>
				<dt class="col-sm-6">25. JUMLAH TOTAL</dt>
				<dd class="col-sm-6">
					<input type="text" value="" class="form-control form-control-sm" readOnly>
				</dd>
			</dl>		
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-11"><u><a href="#" data-toggle="modal" data-target="#m_jaminan_modal">26. JAMINAN [F3]</a></u></dt>
				<dd class="col-sm-1"><input type="text" value="" class="form-control form-control-sm "></dd>
				<dt class="col-sm-12">
					<table class="table table-hover table-bordered table-striped table-sm" id="" role="grid" style="white-space: nowrap; min-width: 600px">
						<thead>
							<tr>
								<th class="text-center">JENIS</th>
								<th class="text-center">NOMOR</th>
								<th class="text-center">TANGGAL</th>
								<th class="text-center">NILAI</th>
								<th class="text-center">JATUH TEMPO</th>
								<th class="text-center">PENJAMIN</th>
								<th class="text-center">NOMOR PBJ</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</dt>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-6 col-xl-6" style="margin-top:15px;">
			<dl class="row">
				<dt class="col-sm-11">Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal yang diberitahukan dalam dokumen pabean ini.</dt>
				<dd class="col-sm-1"></dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-6"><input type="text" value="NGAWI" class="form-control form-control-sm " readOnly></dt>
				<dd class="col-sm-6"><input type="text" value="12-10-2020" class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Pemberitahu</dt>
				<dd class="col-sm-9"><input type="text" value="IRAWAN" class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Jabatan</dt>
				<dd class="col-sm-9"><input type="text" value="Manager" class="form-control form-control-sm " readOnly></dd>
			</dl>
		</div>
	</div>
</div>

<div class="modal fade modal" id="m_jaminan_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">JAMINAN</h5>
				<button type="button" class="close" data-dismiss="modal" >&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<table class="table table-hover table-bordered table-striped table-sm" id="" role="grid">
						<thead>
							<tr>
								<th class="text-center">JENIS</th>
								<th class="text-center">NOMOR</th>
								<th class="text-center">TANGGAL</th>
								<th class="text-center">JATUH TEMPO</th>
								<th class="text-center">PENJAMIN</th>
								<th class="text-center">NOMOR BPJ</th>
								<th class="text-center">TANGGAL</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="col-sm-12">
					<dl class="row">
						<dt class="col-sm-4">JENIS JAMINAN</dt>
						<dd class="col-sm-5">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
						<dd class="col-sm-3"></dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">NOMOR JAMINAN</dt>
						<dd class="col-sm-5">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
						<dd class="col-sm-3">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">NILAI JAMINAN</dt>
						<dd class="col-sm-5">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
						<dd class="col-sm-3"></dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">TANGGAL JATUH TEMPO</dt>
						<dd class="col-sm-5">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
						<dd class="col-sm-3"></dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">PENJAMIN</dt>
						<dd class="col-sm-5">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
						<dd class="col-sm-3"></dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">NOMOR DAN TANGGAL BUKTI PENERIMAAN JAMINAN</dt>
						<dd class="col-sm-5">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
						<dd class="col-sm-3">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal" id="m_barang_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">BARANG</h5>
				<button type="button" class="close" data-dismiss="modal" >&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top: 15px; border-width:1px;  ">
						<dl class="row">
							<dt class="col-sm-3">STATUS</dt>
							<dd class="col-sm-3"></dd>
						</dl>
					</div>
					<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
						<dl class="row">
							<dt class="col-sm-3">KODE BARANG</dt>
							<dd class="col-sm-3">
								<input type="text" value="" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-3">NOMOR H</dt>
							<dd class="col-sm-3">
								<input type="text" value="" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-3">SERI IJIN</dt>
							<dd class="col-sm-3">
								<input type="text" value="" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-3">KATEGORI BARANG</dt>
							<dd class="col-sm-3">
								<input type="text" value="" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-3">URAIAN BARANG</dt>
							<dd class="col-sm-9">
								<input type="text" value="" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-3">MERK</dt>
							<dd class="col-sm-3">
								<input type="text" value="" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-3">TIPE</dt>
							<dd class="col-sm-3">
								<input type="text" value="" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-3">UKURAN</dt>
							<dd class="col-sm-3">
								<input type="text" value="" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-3">SPF LAIN</dt>
							<dd class="col-sm-3">
								<input type="text" value="" class="form-control form-control-sm ">
							</dd>
						</dl>
					</div>
					<div class="col-sm-12 col-lg-6 col-xl-6" style="margin-top:15px; border-style:dotted; border-width:1px;">
						<dl class="row">
							<dt class="col-sm-12">HARGA</dt>
							<dt class="col-sm-6">JUMLAH SATUAN</dt>
							<dd class="col-sm-6">
								<input type="text" value="" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-6">SATUAN</dt>
							<dd class="col-sm-6">
								<input type="text" value="" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-6">HARGA SATUAN</dt>
							<dd class="col-sm-6">
								<input type="text" value="" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-6">HARGA CIF</dt>
							<dd class="col-sm-6">
								<input type="text" value="" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-6">CIF Rp</dt>
							<dd class="col-sm-6">
								<input type="text" value="" class="form-control form-control-sm ">
							</dd>
						</dl>
					</div>
					<div class="col-sm-12 col-lg-6 col-xl-6" style="margin-top:15px; border-style:dotted; border-width:1px;">
						<dl class="row">
							<dt class="col-sm-12">KEMASAN</dt>
							<dt class="col-sm-6">JUMLAH</dt>
							<dd class="col-sm-6">
								<input type="text" value="" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-6">JENIS</dt>
							<dd class="col-sm-6">
								<input type="text" value="" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-6">NETTO</dt>
							<dd class="col-sm-6">
								<input type="text" value="" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-6">NEGARA ASAL BARANG</dt>
							<dd class="col-sm-6">
								<input type="text" value="" class="form-control form-control-sm ">
							</dd>
						</dl>
					</div>
					<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
						<dl class="row">
							<dt class="col-sm-9">DOKUMEN</dt>
							<dd class="col-sm-3"></dd>
							<dt class="col-sm-12">
								<table class="table table-hover table-bordered table-striped table-sm" id="" role="grid">
									<thead>
										<tr>
											<th class="text-center">JENIS DOKUMEN</th>
											<th class="text-center">NOMOR DOKUMEN</th>
											<th class="text-center">TANGGAL</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</dt>
						</dl>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal" id="m_kemasan_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">KEMASAN</h5>
				<button type="button" class="close" data-dismiss="modal" >&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<table class="table table-hover table-bordered table-striped table-sm" id="" role="grid">
						<thead>
							<tr>
								<th class="text-center">NO</th>
								<th class="text-center">JUMLAH</th>
								<th class="text-center">KODE</th>
								<th class="text-center">URAIAN</th>
								<th class="text-center">MERK KEMASAN</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="col-sm-12">
					<dl class="row">
						<dt class="col-sm-4">JUMLAH</dt>
						<dd class="col-sm-8">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">JENIS</dt>
						<dd class="col-sm-8">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">MERK</dt>
						<dd class="col-sm-8">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal" id="m_kontainner_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">KONTAINER</h5>
				<button type="button" class="close" data-dismiss="modal" >&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<table class="table table-hover table-bordered table-striped table-sm" id="" role="grid">
						<thead>
							<tr>
								<th class="text-center">NO</th>
								<th class="text-center">NOMOR KONTAINER</th>
								<th class="text-center">UKURAN</th>
								<th class="text-center">TIPE</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="col-sm-12">
					<dl class="row">
						<dt class="col-sm-4">NO KONTAINER</dt>
						<dd class="col-sm-4">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
						<dd class="col-sm-4">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">KETERANGAN</dt>
						<dd class="col-sm-8">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">UKURAN</dt>
						<dd class="col-sm-8">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">TIPE</dt>
						<dd class="col-sm-8">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal" id="m_dokumen_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">DOKUMEN</h5>
				<button type="button" class="close" data-dismiss="modal" >&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<table class="table table-hover table-bordered table-striped table-sm" id="" role="grid">
						<thead>
							<tr>
								<th class="text-center">SERI</th>
								<th class="text-center">KODE DOKUMEN</th>
								<th class="text-center">JENIS DOKUMEN</th>
								<th class="text-center">NOMOR</th>
								<th class="text-center">TANGGAL</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="col-sm-12">
					<dl class="row">
						<dt class="col-sm-4">DOKUMEN</dt>
						<dd class="col-sm-8">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">NOMOR</dt>
						<dd class="col-sm-8">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">TANGGAL</dt>
						<dd class="col-sm-8">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
				</div>
			</div>
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
    let id_header = <?=$tpbHeader->ID?>;
</script>