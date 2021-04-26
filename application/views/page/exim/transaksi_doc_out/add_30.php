<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Exim</li>
		<li class="breadcrumb-item">Transaksi Doc Out</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Transaksi Doc Out BC 3.0
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?= base_url('exim/transaksi_doc_out/store_30') ?>">
						<input type="hidden" name="tpb_header[KODE_DOKUMEN_PABEAN]" value="30">
				</div>
				<div class="row">
					<div class="col-sm-12 col-lg-12 col-xl-12">
						<div class="card mb-g">
							<div class="card-header ">

							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-sm-12 col-lg-12 col-xl-12">
										<dl class="row">
											<dt class="col-sm-12 col-lg-2 col-xl-2">STATUS</dt>
											<dd class="col-sm-12 col-lg-3 col-xl-3"></dd>
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
											<dd class="col-sm-12 col-lg-2 col-xl-2">
												<input type="text"
													class="form-control form-control-sm x-datepicker x-readonly"
													readonly placeholder="Select date" name="peb_header[no_aju]">
											</dd>
											<dd class="col-sm-12 col-lg-2 col-xl-2">
												<input type="text"
													class="form-control form-control-sm x-datepicker x-readonly"
													readonly placeholder="Select date" name="peb_header[no_aju]">
											</dd>
											<dd class="col-sm-12 col-lg-2 col-xl-2">
												<input type="text" class="form-control form-control-sm" value=""
													disabled>
											</dd>
											<dd class="col-sm-12 col-lg-2 col-xl-2">
												<input type="text" class="form-control form-control-sm"
													name="peb_header[no_aju]">
											</dd>

										</dl>
									</div>
									<div class="col-sm-12 col-lg-12 col-xl-12">
										<dl class="row"
											style="margin-top: -10px; padding-top: 10px; border-style:dotted; border-width:1px;">

											<dt class="col-sm-12 col-lg-8 col-xl-8">&nbsp;</dt>
											<dt class="col-sm-12 col-lg-12 col-xl-12">A. KANTOR PABEAN</dt>
											<dt class="col-sm-12 col-lg-2 col-xl-2">Ktr Pabean Muat</dt>
											<dd class="col-sm-12 col-lg-4 col-xl-4">
												<input type="text"
													class="form-control form-control-sm x-readonly uraian_kpmuat"
													type="button" class="btn btn-default" onclick="setAsal('kpmuat')"
													data-toggle="modal" data-target="#tblkpbc_modal" readonly />
												<input type="hidden" class="form-control form-control-sm kode_kpmuat"
													name="peb_header[KDKTR]" />
											</dd>
											<dd class="col-sm-12 col-lg-4 col-xl-4">KPPBC Tanjung Perak</dd>
											<dt class="col-sm-12 col-lg-2 col-xl-2">
												<a href="#" data-toogle="modal" data-target="#m_barangdt40_modal">
													Detail Barang</a>
											</dt>
											<dt class="col-sm-12 col-lg-12 col-xl-12">&nbsp;</dt>
											<dt class="col-sm-12 col-lg-2 col-xl-2">Ktr Pabean Ekspor</dt>
											<dd class="col-sm-12 col-lg-4 col-xl-4">
												<input type="text"
													class="form-control form-control-sm x-readonly uraian_kpmuat"
													type="button" class="btn btn-default" onclick="setAsal('kpmuat')"
													data-toggle="modal" data-target="#tblkpbc_modal" readonly />
												<input type="hidden" class="form-control form-control-sm kode_kpmuat"
													name="peb_header[KDKTR]" />
											</dd>
											<dd class="col-sm-12 col-lg-3 col-xl-3">KPPBC TANJUNG PERAK </dd>
											<dt class="col-sm-12 col-lg-12 col-xl-12">&nbsp;</dt>
											<dt class="col-sm-12 col-lg-2 col-xl-2">Jenis Ekspor</dt>
											<dd class="col-sm-12 col-lg-4 col-xl-4">
												<select class="form-control form-control-sm select2"
													name="peb_header[JnEks]">
													<option value="" disabled selected>Select Data . . .</option>
													<?=createOption($jenisEkspor,'KDREC',array('Uraian'),'-')?>
												</select>
											</dd>
											<dd class="col-sm-12 col-lg-5 col-xl-5">Ekspor Biasa</dd>
											<dt class="col-sm-12 col-lg-12 col-xl-12">&nbsp;</dt>
											<dt class="col-sm-12 col-lg-2 col-xl-2">Kategori Ekspor</dt>
											<dd class="col-sm-12 col-lg-4 col-xl-4">
												<select class="form-control form-control-sm select2"
													name="peb_header[KatEks]">
													<option value="" disabled selected>Select Data . . .</option>
													<?=createOption($kategoriEkspor,'KDREC',array('Uraian'),'-')?>
												</select>
											</dd>
											<dd class="col-sm-12 col-lg-5 col-xl-5">TPB dari Kawasan Berikat</dd>
											<dt class="col-sm-12 col-lg-12 col-xl-12">&nbsp;</dt>
											<dt class="col-sm-12 col-lg-2 col-xl-2">Cara Perdagangan</dt>
											<dd class="col-sm-12 col-lg-4 col-xl-4">
												<select class="form-control form-control-sm select2"
													name="peb_header[JNDAG]">
													<option value="" disabled selected>Select Data . . .</option>
													<?=createOption($caraDagang,'KDREC',array('Uraian'),'-')?>
												</select>
											</dd>
											<dd class="col-sm-12 col-lg-5 col-xl-5">Lainnya</dd>
											<dt class="col-sm-12 col-lg-12 col-xl-12">&nbsp;</dt>
											<dt class="col-sm-12 col-lg-2 col-xl-2">Cara Pembayaran</dt>
											<dd class="col-sm-12 col-lg-4 col-xl-4">
												<select class="form-control form-control-sm select2"
													name="peb_header[JNBYR]">
													<option value="" disabled selected>Select Data . . .</option>
													<?=createOption($caraBayar,'KDREC',array('Uraian'),'-')?>
												</select>
											</dd>
											<dd class="col-sm-12 col-lg-4 col-xl-4">Lainnya</dd>
											<dt class="col-sm-12 col-lg-2 col-xl-2"><a href="#"> Uraian Pembayaran</a>
											</dt>
										</dl>
									</div>
									<div class="col-sm-12 col-lg-6 col-xl-6">
										<dl class="row"
											style="margin-top: -10px; padding-top: 10px; border-style: dotted; border-width:1px;">
											<h5 class="col-sm-12 col-lg-12 col-xl-12">H. KOLOM KHUSUS BEA DA CUKAI</h5>
											<dt class="col-sm-12 col-lg-4 col-xl-4">1. No. & tgl.Pendaftaran</dt>
											<dd class="col-sm-12 col-lg-4 col-xl-4">
												<input type="text" class="form-control form-control-sm" value=""
													disabled>
											</dd>
											<dd class="col-sm-12 col-lg-4 col-xl-4">
												<input type="text" class="form-control form-control-sm" value=""
													disabled>
											</dd>
											<dt class="col-sm-12 col-lg-4 col-xl-4">No. & tgl. BC 1.1.</dt>
											<dd class="col-sm-12 col-lg-4 col-xl-4">
												<input type="text" class="form-control form-control-sm" value=""
													disabled>
											</dd>
											<dd class="col-sm-12 col-lg-4 col-xl-4">
												<input type="text" class="form-control form-control-sm" value=""
													disabled>
											</dd>
											<dt class="col-sm-12 col-lg-4 col-xl-4">Pos/Sub Pos</dt>
											<dd class="col-sm-12 col-lg-4 col-xl-4">
												<input type="text" class="form-control form-control-sm" value=""
													disabled>
											</dd>
											<dd class="col-sm-12 col-lg-4 col-xl-4">
												<input type="text" class="form-control form-control-sm" value=""
													disabled>
											</dd>
										</dl>
										<dl class="row"
											style="margin-top: -17px; padding-top: 15px; border-style: dotted; border-width:1px;">
											<h5 class="col-sm-12 col-lg-12 col-xl-12">EKSPORTIR</h5>
											<dt class="col-sm-12 col-lg-2 col-xl-2">ID Ekspt</dt>
											<dd class="col-sm-12 col-lg-4 col-xl-4">
												<input type="text" class="form-control form-control-sm"
													value="NPWP 15 DIGIT" disabled>
											</dd>
											<dd class="col-sm-12 col-lg-6 col-xl-6">
												<input type="text" class="form-control form-control-sm x-readonly"
													name="peb_header[NPWPEKS]" value="<?=placeValue($app,'NPWP')?>"
													readonly>
											</dd>
											<dt class="col-sm-12 col-lg-2 col-xl-2"> Nama</dt>
											<dd class="col-sm-12 col-lg-9 col-xl-9">
												<input type="text" class="form-control form-control-sm x-readonly"
													name="peb_header[NamaEks]" value="<?=placeValue($app,'nama_sbu')?>"
													readonly>
											</dd>
											<dt class="col-sm-12 col-lg-2 col-xl-2"> Alamat</dt>
											<dd class="col-sm-12 col-lg-9 col-xl-9">
												<input type="text" class="form-control form-control-sm x-readonly"
													name="peb_header[AlmtEks]" value="<?=placeValue($app,'alamat')?>"
													readonly>
											</dd>
											<dt class="col-sm-12 col-lg-2 col-xl-2"> Status</dt>
											<dd class="col-sm-12 col-lg-2 col-xl-2">
												<input type="text" class="form-control form-control-sm x-readonly"
													name="" value="<?=placeValue($app,'STATUS_EKSPORTIR')?>" readonly>
												<input type="hidden" class="form-control form-control-sm x-readonly"
													name="peb_header[StatusH]"
													value="<?=placeValue($app,'ID_STATUS_EKSPORTIR')?>" readonly>
											</dd>PMA ( non migas )
										</dl>
										<dl class="row"
											style="margin-top: -17px; padding-top: 15px; border-style: dotted; border-width:1px;">
											<h5 class="col-sm-12 col-lg-12 col-xl-12">PPJK</h5>
											<dt class="col-sm-12 col-lg-3 col-xl-3">ID PPJK</dt>
											<dd class="col-sm-12 col-lg-4 col-xl-4">
												<input type="text" class="form-control form-control-sm" value=""
													disabled>
											</dd>
											<dd class="col-sm-12 col-lg-5 col-xl-5">
												<input type="text" class="form-control form-control-sm" value=""
													disabled>
											</dd>
											<dt class="col-sm-12 col-lg-3 col-xl-3">Nama</dt>
											<dd class="col-sm-12 col-lg-9 col-xl-9">
												<input type="text" class="form-control form-control-sm" value=""
													disabled>
											</dd>
											<!-- <dt class="col-sm-12 col-lg-3 col-xl-3">&nbsp;</dt> -->
											<dt class="col-sm-12 col-lg-3 col-xl-3"> Alamat</dt>
											<dd class="col-sm-12 col-lg-9 col-xl-9">
												<input type="text" class="form-control form-control-sm" value=""
													disabled>
											</dd>
											<dt class="col-sm-12 col-lg-3 col-xl-3"> Tanggal PPJK</dt>
											<dd class="col-sm-12 col-lg-4 col-xl-4">
												<div class="input-group input-group-sm">
													<input type="text"
														class="form-control form-control-sm x-datepicker x-readonly"
														readonly placeholder="Select date" name="peb_header[TGEKS]">
													<div class="input-group-append">
														<span class="input-group-text fs-xl"><i
																class="fa fal fa-calendar"></i></span>
													</div>
												</div>
											</dd>
										</dl>
										<dl class="row"
											style="margin-top: -17px; padding-top: 15px; border-style: dotted; border-width:1px;">
											<h5 class="col-sm-12 col-lg-12 col-xl-12">DATA PENGANGKUTAN</h5>
											<dt class="col-sm-12 col-lg-5 col-xl-5">Cara Pengangkutan</dt>
											<dd class="col-sm-12 col-lg-5 col-xl-5">
												<select class="form-control form-control-sm select2"
													name="peb_header[MODA]" id="caraAngkut">
													<option value="" disabled selected>Select Data . . .</option>
													<?=createOption($caraAngkut,'KDREC',array('Uraian'),'-')?>
												</select>
											</dd>
											<dt class="col-sm-12 col-lg-5 col-xl-5">Nama Sarana Pengangkutan</dt>
											<dd class="col-sm-12 col-lg-5 col-xl-5">
												<input type="text"
													class="form-control form-control-sm nama_sarana_angkut"
													name="peb_header[CARRIER_MODAL]" type="button"
													class="btn btn-default" data-toggle="modal"
													data-target="#tblkapal_modal" id="#dt_tblkapal" readonly />

											</dd>
											<div class="col-sm-12 col-lg-2 col-xl-2 sarana_angkut let-other x-hidden">
												<label class="form-label">Sarana Pengangkutan</label>
												<input type="text" class="form-control form-control-sm"
													name="peb_header[CARRIER_INPUT]">
											</div>
											<dd class="col-sm-12 col-lg-2 col-xl-2">
												<input type="text"
													class="form-control form-control-sm x-readonly uraian_negaraBenderaKapal"
													type="button" class="btn btn-default"
													onclick="setAsal('negaraBenderaKapal')" data-toggle="modal"
													data-target="#tblnegara_modal" readonly />
												<input type="hidden"
													class="form-control form-control-sm kode_negaraBenderaKapal"
													name="peb_header[BENDERA]" />
											</dd>
											<dt class="col-sm-12 col-lg-5 col-xl-5"> No. Pengangkut</dt>
											<dd class="col-sm-12 col-lg-4 col-xl-4">
												<input type="text" class="form-control form-control-sm"
													name="peb_header[VOY]" value="">
											</dd>Marshall Islands
											<dt class="col-sm-12 col-lg-5 col-xl-5">Tgl. Perkiraan Ekspor</dt>
											<dd class="col-sm-12 col-lg-5 col-xl-5">
												<div class="input-group input-group-sm">
													<input type="text"
														class="form-control form-control-sm x-datepicker x-readonly"
														readonly placeholder="Select date" name="peb_header[TGEKS]">
													<div class="input-group-append">
														<span class="input-group-text fs-xl"><i
																class="fa fal fa-calendar"></i></span>
													</div>
												</div>
											</dd>
										</dl>
										<!-- <dl class="row"
											style="margin-top: -17px; padding-top: 15px; border-style: dotted; border-width:1px;"> -->
											<div class="form-group row" 
											style="margin-top: -17px; padding-top: 15px; border-style: dotted; border-width:1px;">
											<div class="col-md-12">
												<label><b>Dokumen Tambahan</b></label>
												<div class="table-responsive">
													<table
														class="table table-hover table-bordered table-striped table-sm dt_inv_add"
														id="table_dokumen"
														style="white-space: nowrap; min-width: 600px">
														<thead>
															<tr>
																<th class="text-center" width="5px">
																	<button type="button"
																		class="btn btn-xs btn-success btn-add-dokumen"><i
																			class="fal fa-plus-circle"></i></button>
																</th>
																<th class="text-center">No</th>
																<th class="text-center">Jenis Dokumen</th>
																<th class="text-center">Nomor Dokumen</th>
																<th class="text-center">Tanggal</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
												</div>
											</div>
									</div>
									<!-- </dl> -->
									<dl class="row"
										style="margin-top: -17px; padding-top: 15px; border-style: dotted; border-width:1px;">
										<h5 class="col-sm-12 col-lg-12 col-xl-12">DATA TRANSAKSI EKSPOR </h5>
										<dt class="col-sm-12 col-lg-4 col-xl-4">
											<u><a href="#" data-target="modal" data-toogle="">Bank DHE</a></u>
										</dt>
										<dd class="col-sm-12 col-lg-6 col-xl-6">
											<input type="text"
												class="form-control form-control-sm x-readonly uraian_bank"
												type="button" class="btn btn-default" data-toggle="modal"
												data-target="#tblbank_modal" readonly />
											<input type="hidden" class="form-control form-control-sm kode_bank"
												name="peb_header[KDBANK]" />
										</dd>
										<dt class="col-sm-12 col-lg-4 col-xl-4">Valuta</dt>
										<dd class="col-sm-12 col-lg-6 col-xl-6">
											<input type="text"
												class="form-control form-control-sm x-readonly uraian_valuta"
												type="button" class="btn btn-default" data-toggle="modal"
												data-target="#referensi_valuta_modal" readonly />
											<input type="hidden" class="form-control form-control-sm kode_valuta"
												name="peb_header[KDVAL]" />
										</dd> US Dollar
										<dt class="col-sm-12 col-lg-4 col-xl-4">Nilai Ekspor</dt>
										<dd class="col-sm-12 col-lg-5 col-xl-5">
											<input type="text" class="form-control form-control-sm" value="">
										</dd>(Incoterm FOB)
										<dt class="col-sm-12 col-lg-4 col-xl-4"></dt>
									</dl>

								</div>
								<div class="col-sm-12 col-lg-6 col-xl-6">
									<dl class="row"
										style="margin-top: -10px; padding-top: 10px; border-style: dotted; border-width:1px;">
										<h5 class="col-sm-12 col-lg-12 col-xl-12">PENERIMA</h5>
										<dt class="col-sm-12 col-lg-4 col-xl-4">Nama</dt>
										<dd class="col-sm-12 col-lg-6 col-xl-6">
											<input type="text" class="form-control form-control-sm"
												name="peb_header[NAMABELI]" value="">
										</dd>
										<dt class="col-sm-12 col-lg-4 col-xl-4">Alamat</dt>
										<dd class="col-sm-12 col-lg-6 col-xl-6">
											<input type="text" class="form-control form-control-sm"
												name="peb_header[ALMTBELI]" value="">
										</dd>
										<dt class="col-sm-12 col-lg-4 col-xl-4">Negara</dt>
										<dd class="col-sm-12 col-lg-2 col-xl-2">
											<input type="text"
												class="form-control form-control-sm x-readonly uraian_negaraPenerima"
												name="peb_header[NEGBELI]" type="button" class="btn btn-default"
												onclick="setAsal('negaraPenerima')" data-toggle="modal"
												data-target="#tblnegara_modal" readonly />
										</dd>Singapore
									</dl>
									<dl class="row"
										style="margin-top: -17px; padding-top: 15px; border-style: dotted; border-width:1px;">
										<h5 class="col-sm-12 col-lg-12 col-xl-12">PEMBELI</h5>
										<dt class="col-sm-12 col-lg-4 col-xl-4">Nama</dt>
										<dd class="col-sm-12 col-lg-6 col-xl-6">
											<input type="text"
												class="form-control form-control-sm x-readonly uraian_pemasok"
												name="peb_header[NAMABELI2]" type="button" class="btn btn-default"
												data-toggle="modal" data-target="#referensi_pemasok_modal" readonly />
										</dd>
										<dt class="col-sm-12 col-lg-4 col-xl-4">Alamat</dt>
										<dd class="col-sm-12 col-lg-6 col-xl-6">
											<input type="text"
												class="form-control form-control-sm x-readonly alamat_pemasok"
												name="peb_header[ALMTBELI2]" value="" readonly>
										</dd>
										<dt class="col-sm-12 col-lg-4 col-xl-4">Negara</dt>
										<dd class="col-sm-12 col-lg-2 col-xl-2">
											<input type="text"
												class="form-control form-control-sm x-readonly uraian_negara_pemasok"
												name="peb_header[NEGBELI2]" value="" readonly />
										</dd>
									</dl>
									<dl class="row"
										style="margin-top: -17px; padding-top: 15px; border-style: dotted; border-width:1px;">
										<h5 class="col-sm-12 col-lg-12 col-xl-12">DATA PELABUHAN/TEMPAT MUAT EKSPOR
										</h5>
										<dt class="col-sm-12 col-lg-4 col-xl-4">Pel. Muat Asal</dt>
										<dd class="col-sm-12 col-lg-2 col-xl-2">
											<input type="text"
												class="form-control form-control-sm x-readonly uraian_muatAsal"
												type="button" class="btn btn-default" onclick="setAsal('muatAsal')"
												data-toggle="modal" data-target="#tblpeldn_modal" readonly />
											<input type="hidden" class="form-control form-control-sm kode_muatAsal"
												name="peb_header[PELMUAT]" />
										</dd>
										<dt class="col-sm-12 col-lg-4 col-xl-4">&nbsp;</dt>
										<dt class="col-sm-12 col-lg-4 col-xl-4">Pel/Temp Muat Ekspor</dt>
										<dd class="col-sm-12 col-lg-4 col-xl-4">
											<input type="text"
												class="form-control form-control-sm x-readonly uraian_muatEkspor"
												type="button" class="btn btn-default" onclick="setAsal('muatEkspor')"
												data-toggle="modal" data-target="#tblpeldn_modal" readonly />
											<input type="hidden" class="form-control form-control-sm kode_muatEkspor"
												name="peb_header[PELMUATEKS]" />
										</dd>
										<dt class="col-sm-12 col-lg-4 col-xl-4">&nbsp;</dt>
										<dt class="col-sm-12 col-lg-4 col-xl-4">Tempat Penimbunan</dt>
										<dd class="col-sm-12 col-lg-4 col-xl-4">
											<input type="text" class="form-control form-control-sm text-right" value=""
												disabled>
										</dd>
										<dt class="col-sm-12 col-lg-4 col-xl-4">&nbsp;</dt>
										<dt class="col-sm-12 col-lg-4 col-xl-4">Pel. Bongkar</dt>
										<dd class="col-sm-12 col-lg-4 col-xl-4">
											<input type="text"
												class="form-control form-control-sm x-readonly uraian_bongkar"
												type="button" class="btn btn-default" onclick="setAsal('bongkar')"
												data-toggle="modal" data-target="#tblpelln_modal" readonly />
											<input type="hidden" class="form-control form-control-sm kode_bongkar"
												name="peb_header[DELIVERY]" />
										</dd>
										<dt class="col-sm-12 col-lg-4 col-xl-4">&nbsp;</dt>
										<dt class="col-sm-12 col-lg-4 col-xl-4">Pel. Tujuan</dt>
										<dd class="col-sm-12 col-lg-4 col-xl-4">
											<input type="text"
												class="form-control form-control-sm x-readonly uraian_bongkar"
												type="button" class="btn btn-default" onclick="setAsal('bongkar')"
												data-toggle="modal" data-target="#tblpelln_modal" readonly />
											<input type="hidden" class="form-control form-control-sm kode_bongkar"
												name="peb_header[DELIVERY]" />
										</dd>
										<dt class="col-sm-12 col-lg-4 col-xl-4">&nbsp;</dt>
										<dt class="col-sm-12 col-lg-4 col-xl-4">&nbsp; &nbsp; &nbsp; Neg. Tujuan
											Ekspor</dt>
										<dd class="col-sm-12 col-lg-4 col-xl-4">
											<input type="text"
												class="form-control form-control-sm x-readonly uraian_negaraTujuan"
												type="button" class="btn btn-default" onclick="setAsal('negaraTujuan')"
												data-toggle="modal" data-target="#tblnegara_modal" readonly />
											<input type="hidden" class="form-control form-control-sm kode_negaraTujuan"
												name="peb_header[NEGTUJU]" />
										</dd>
									</dl>
									<dl class="row"
										style="margin-top: -17px; padding-top: 15px; border-style: dotted; border-width:1px;">
										<h5 class="col-sm-12 col-lg-12 col-xl-12">DATA TEMPAT PEMERIKSAAN</h5>
										<dt class="col-sm-12 col-lg-4 col-xl-4">Lok/Tg Periksa</dt>
										<dd class="col-sm-12 col-lg-4 col-xl-4">
											<select class="form-control form-control-sm select2"
												name="peb_header[KDLOKBRG]">
												<option value="" disabled selected>Select Data . . .</option>
												<option value="1">KP Tempat Pemuatan</option>
												<option value="2">Gudang Eksportir</option>
												<option value="3">Tempat Lain yang Diizinkan</option>
												<option value="4">TPS</option>
												<option value="5">TPP</option>
												<option value="6">TPB</option>
											</select>
										</dd>
										<dd class="col-sm-12 col-lg-4 col-xl-4">
											<div class="input-group input-group-sm">
												<input type="text"
													class="form-control form-control-sm x-datepicker x-readonly"
													readonly placeholder="Select date" name="peb_header[TGSIAP]">
												<div class="input-group-append">
													<span class="input-group-text fs-xl"><i
															class="fa fal fa-calendar"></i></span>
												</div>
											</div>
										</dd>
										<dt class="col-sm-12 col-lg-4 col-xl-4">KPPBC Periksa</dt>
										<dd class="col-sm-12 col-lg-5 col-xl-5">
											<input type="text"
												class="form-control form-control-sm x-readonly uraian_kpperiksa"
												type="button" class="btn btn-default" onclick="setAsal('kpperiksa')"
												data-toggle="modal" data-target="#tblkpbc_modal" readonly />
											<input type="hidden" class="form-control form-control-sm kode_kpperiksa"
												name="peb_header[KDKTRPRIKS]" />
										</dd>
									</dl>
									<dl class="row"
										style="margin-top: -17px; padding-top: 15px; border-style: dotted; border-width:1px;">
										<h5 class="col-sm-12 col-lg-12 col-xl-12">DATA PENYERAHAN</h5>
										<dt class="col-sm-12 col-lg-4 col-xl-4">Cara Penyerahan Barang </dt>
										<dd class="col-sm-12 col-lg-5 col-xl-5">
											<select class="form-control form-control-sm select2"
												name="peb_header[DELIVERY]">
												<option value="" disabled selected>Select Data . . .</option>
												<?=createOption($caraPenyerahan,'KDREC',array('Uraian'),'-')?>
											</select>
										</dd>

									</dl>
									<dl class="row"
										style="margin-top: -17px; padding-top: 15px; border-style: dotted; border-width:1px;">
										<dt class="col-sm-12 col-lg-4 col-xl-4">Freight</dt>
										<dd class="col-sm-12 col-lg-3 col-xl-3">
											<input type="text" class="form-control form-control-sm text-right"
												name="peb_header[FREIGHT]">
										</dd>
										<dt class="col-sm-12 col-lg-5 col-xl-5">&nbsp;</dt>
										<dt class="col-sm-12 col-lg-4 col-xl-4">Asuransi</dt>
										<dd class="col-sm-12 col-lg-3 col-xl-3">
											<select class="form-control form-control-sm select2"
												name="peb_header[KdAss]">
												<option value="0">LN</option>
												<option value="1" selected="">DN</option>
											</select>
										</dd>
										<dd class="col-sm-12 col-lg-3 col-xl-3">
											<input type="text" class="form-control form-control-sm text-right" value=""
												disabled>
										</dd>
										<!-- <dt class="col-sm-12 col-lg-5 col-xl-5">&nbsp;</dt> -->
										<dt class="col-sm-12 col-lg-4 col-xl-4"> Nilai Maklon</dt>
										<dd class="col-sm-12 col-lg-3 col-xl-3">
											<input type="text" class="form-control form-control-sm text-right"
												name="peb_header[ASURANSI]">
										</dd>
									</dl>

								</div>
								<div class="col-sm-12 col-lg-6 col-xl-6">
									<dl class="row"
										style="margin-top: -10px; padding-top: 10px; border-style: dotted; border-width:1px;">
										<h5 class="col-sm-12 col-lg-10 col-xl-10">
											<u><a href="#" data-toogle="" data-target="">Jumlah & No Kemasan/Peti
													Kemas</a></u>
										</h5>
										<dd class="col-sm-12 col-lg-2 col-xl-2">
											<input type="text" class="form-control form-control-sm" value="" disabled>
										</dd>
										<dd class="col-sm-12 col-lg-12 col-xl-12">
											<div class="table-responsive">
												<table
													class="table table-hover table-bordered table-striped table-sm dt_po_add"
													id="table_dokumen1" role="grid" style="white-space: nowrap;">
													<thead>
														<tr>
															<th class="text-center">NO</th>
															<th class="text-center">NOMOR CONT</th>
															<th class="text-center">UKURAN</th>
															<th class="text-center">TIPE</th>
															<th class="text-center"></th>
													</thead>
													<tbody>

													</tbody>
												</table>
											</div>
										</dd>
									</dl>
								</div>
								<div class="col-sm-12 col-lg-6 col-xl-6">
									<dl class="row"
										style="margin-top: -10px; padding-top: 10px; border-style: dotted; border-width:1px;">
										<h5 class="col-sm-12 col-lg-10 col-xl-10">
											<u><a href="#" data-toogle="" data-target="">Jenis, Jumlah & Merk Kemas
												</a></u>
										</h5>
										<dd class="col-sm-12 col-lg-2 col-xl-2">
											<input type="text" class="form-control form-control-sm" value="" disabled>
										</dd>
										<dd class="col-sm-12 col-lg-12 col-xl-12">
											<div class="table-responsive">
												<table
													class="table table-hover table-bordered table-striped table-sm dt_po_add"
													id="table_dokumen1" role="grid" style="white-space: nowrap;">
													<thead>
														<tr>
															<th class="text-center">NO</th>
															<th class="text-center">NOMOR CONT</th>
															<th class="text-center">UKURAN</th>
															<th class="text-center">TIPE</th>
															<th class="text-center"></th>
													</thead>
													<tbody>

													</tbody>
												</table>
											</div>
										</dd>
									</dl>
								</div>
								<div class="col-sm-12 col-lg-12 col-xl-12">
									<dl class="row"
										style="margin-top: -10px; padding-top: 10px; border-style: dotted; border-width:1px;">
										<dd class="col-sm-12 col-lg-1 col-xl-1">Komoditi</dd>
										<dd class="col-sm-12 col-lg-2 col-xl-2">
											<select class="form-control form-control-sm select2"
												name="peb_header[KMDT]">
												<option value="1" selected="">Non Migas</option>
												<option value="2">Migas</option>
											</select>
										</dd>
										<dd class="col-sm-12 col-lg-1 col-xl-1">Curah</dd>
										<dd class="col-sm-12 col-lg-2 col-xl-2">
											<input type="text" class="form-control form-control-sm"
												name="peb_header[CURAH]">
										</dd>
										<dd class="col-sm-12 col-lg-1 col-xl-1">Bruto</dd>
										<dd class="col-sm-12 col-lg-2 col-xl-2">
											<input type="text" class="form-control form-control-sm"
												name="peb_header[BRUTO]">
										</dd>
										<dd class="col-sm-12 col-lg-1 col-xl-1">Netto</dd>
										<dd class="col-sm-12 col-lg-2 col-xl-2">
											<input type="text" class="form-control form-control-sm"
												name="peb_header[NETTO]">
										</dd>


									</dl>
								</div>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i>
								Save</button>
							<a href="<?=base_url('exim/transaksi_doc_out/view_30')?>" class="btn btn-sm btn-danger"><i
									class="fal fa-times-circle"></i> Cancel</a>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
</main>
<table class="x-hidden" id="table-template">
	<tbody>
		<tr data-index="x">
			<td class="text-center">
				<button class="btn btn-xs btn-danger btn-delete-row"><i class="fa fal fa-trash"></i></button>
			</td>
			<td class="text-center"></td>
			<td>
				<p class="text_kode_inv" style="margin: 0;padding: 0;"></p>
				<small class="text_tanggal_inv" style="margin: 0;padding: 0;font-style: italic"></small>
				<input type="hidden" class="kode_inv" name="peb_detail[x][dokumen_inv][NoDok]" />
				<input type="hidden" class="tanggal_inv" name="peb_detail[x][dokumen_inv][TgDok]" />
				<input type="hidden" name="peb_detail[x][dokumen_inv][KdDok]" value="380" />
			</td>
			<td>
				<p class="text_kode_stuffing" style="margin: 0;padding: 0;"></p>
				<small class="text_tanggal_stuffing" style="margin: 0;padding: 0;font-style: italic"></small>
				<input type="hidden" class="kode_stuffing" readonly name="peb_detail[x][dokumen_stuffing][NoDok]" />
				<input type="hidden" class="tanggal_stuffing" name="peb_detail[x][dokumen_stuffing][TgDok]" />
				<input type="hidden" name="peb_detail[x][dokumen_stuffing][KdDok]" value="999" />
			</td>
			<td>
				<p class="text_nama_barang" style="margin: 0;padding: 0;"></p>
				<small class="text_kode_barang" style="margin: 0;padding: 0;font-style: italic"></small>
				<input type="hidden" class="kode_barang" name="peb_detail[x][KDBRG]" />
				<input type="hidden" class="nama_barang" name="peb_detail[x][URBRG1]" />
				<input type="hidden" class="kode_hs" name="peb_detail[x][HS]" />
			</td>
			<td>
				<p class="text_jumlah_satuan" style="margin: 0;padding: 0;"></p>
				<small class="text_kode_satuan" style="margin: 0;padding: 0;font-style: italic"></small>
				<input type="hidden" class="kode_satuan" name="peb_detail[x][JNSATUAN]" />
				<input type="hidden" class="jumlah_satuan" name="peb_detail[x][JMSATUAN]" />
			</td>
			<td>
				<p class="text_fob_satuan" style="margin: 0;padding: 0;"></p>
				<input type="hidden" class="fob_satuan" name="peb_detail[x][FOBPERSAT]" />
			</td>
			<td>
				<p class="text_fob" style="margin: 0;padding: 0;"></p>
				<input type="hidden" class="fob" name="peb_detail[x][DNilInv]" />
			</td>
			<td>
				<p class="text_jumlah_kemasan" style="margin: 0;padding: 0;"></p>
				<small class="text_kode_kemasan" style="margin: 0;padding: 0;font-style: italic"></small>
				<input type="hidden" name="peb_detail[x][JMKOLI]" class="jumlah_kemasan">
				<input type="hidden" name="peb_detail[x][JNKOLI]" class="kode_kemasan">
			</td>
			<td>
				<p class="text_netto" style="margin: 0;padding: 0;"></p>
				<input type="hidden" class="netto" name="peb_detail[x][NETDET]" />
			</td>
			<td>
				<p class="text_volume" style="margin: 0;padding: 0;"></p>
				<input type="hidden" class="volume" name="peb_detail[x][Dvolume]" />
			</td>
			<td>
				<p style="margin: 0;padding: 0">INDONESIA</p>
				<small style="margin: 0;padding: 0;font-style: italic">ID</small>
				<input type="hidden" class="form-control form-control-sm x-readonly" value="Indonesia" />
				<input type="hidden" class="form-control form-control-sm" name="peb_detail[x][NegAsal]" value="ID" />
			</td>
			<td>
				<button type="button" class="btn btn-default btn-detail-bahan-baku" onclick="setDetailBahanBaku(this)"
					data-id="" data-toggle="modal" data-target="#detail_bahan_baku_modal"><i
						class="fal fa-list"></i></button>
			</td>
			<td>
				<button type="button" class="btn btn-default btn-detail-dokumen" onclick="setDetailDokumen(this)"
					data-id="" data-toggle="modal" data-target="#detail_dokumen_modal"><i
						class="fal fa-list"></i></button>
			</td>
		</tr>
	</tbody>
</table>
<table class="x-hidden add_dokumen_template">
	<tbody>
		<tr data-index="x">
			<td class="text-center">
				<button class="btn btn-xs btn-danger btn-delete-dokumen"><i class="fa fal fa-trash"></i></button>
			</td>
			<td class="text-center"></td>
			<td>
				<select class="form-control form-control-sm mselect2" name="dokumen_tambahan[x][KdDok]">
					<option value="" disabled selected>Select Data . . .</option>
					<?= createOption($sdokumen, 'KODE_DOKUMEN', array('URAIAN_DOKUMEN'), ' - ') ?>
				</select>
			</td>
			<td>
				<input type="text" class="form-control form-control-sm" name="dokumen_tambahan[x][NoDok]" />
			</td>
			<td>
				<div class="input-group input-group-sm">
					<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly
						placeholder="Select date" name="dokumen_tambahan[x][TgDok]">
					<div class="input-group-append">
						<span class="input-group-text fs-xl">
							<i class="fa fal fa-calendar"></i>
						</span>
					</div>
				</div>
			</td>
		</tr>
	</tbody>
</table>
<table class="x-hidden add_kemasan_template">
	<tbody>
		<tr data-index="x">
			<td class="text-center">
				<button class="btn btn-xs btn-danger btn-delete-kemasan"><i class="fa fal fa-trash"></i></button>
			</td>
			<td class="text-center"></td>
			<td>
				<div class="input-group input-group-sm">
					<input type="text" class="form-control form-control-sm x-readonly" id="uraian_kemasan[x]" />
					<input type="hidden" class="form-control form-control-sm" id="kode_kemasan[x]"
						name="peb_kemasan[x][JnKemas]" />
					<div class="input-group-append">
						<button type="button" class="btn btn-default" onclick="setKemasanIndex('[x]')"><i
								class="fal fa-search"></i></button>
					</div>
				</div>
			</td>
			<td>
				<input type="text" class="form-control form-control-sm" name="peb_kemasan[x][JmKemas]">
			</td>
			<td>
				<input type="text" class="form-control form-control-sm" name="peb_kemasan[x][MERKKEMAS]" />
			</td>
		</tr>
	</tbody>
</table>