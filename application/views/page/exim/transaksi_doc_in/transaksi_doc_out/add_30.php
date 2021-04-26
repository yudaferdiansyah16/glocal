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
						<div class="form-group row">
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Tanggal Aju</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="peb_header[no_aju]">
									<div class="input-group-append">
										<span class="input-group-text fs-xl"><i class="fa fal fa-calendar"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Kantor Pabean Muat</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly uraian_kpmuat" readonly />
									<input type="hidden" class="form-control form-control-sm kode_kpmuat" name="peb_header[KDKTR]" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" onclick="setAsal('kpmuat')" data-toggle="modal" data-target="#tblkpbc_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Kantor Pabean Ekspor</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly uraian_kpekspor" readonly />
									<input type="hidden" class="form-control form-control-sm kode_kpekspor" name="peb_header[KDKTREKS]" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" onclick="setAsal('kpekspor')" data-toggle="modal" data-target="#tblkpbc_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Jenis Ekspor</label>
								<select class="form-control form-control-sm select2" name="peb_header[JnEks]">
									<option value="" disabled selected>Select Data . . .</option>
									<?=createOption($jenisEkspor,'KDREC',array('Uraian'),'-')?>
								</select>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Kategori Ekspor</label>
								<select class="form-control form-control-sm select2" name="peb_header[KatEks]">
									<option value="" disabled selected>Select Data . . .</option>
									<?=createOption($kategoriEkspor,'KDREC',array('Uraian'),'-')?>
								</select>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Lokasi TPB</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly uraian_kploktpb" readonly />
									<input type="hidden" class="form-control form-control-sm uraian_kploktpb" name="peb_header[LOKTPB]" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" onclick="setAsal('kploktpb')" data-toggle="modal" data-target="#tblkpbc_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Cara Perdagangan</label>
								<select class="form-control form-control-sm select2" name="peb_header[JNDAG]">
									<option value="" disabled selected>Select Data . . .</option>
									<?=createOption($caraDagang,'KDREC',array('Uraian'),'-')?>
								</select>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Cara Pembayaran</label>
								<select class="form-control form-control-sm select2" name="peb_header[JNBYR]">
									<option value="" disabled selected>Select Data . . .</option>
									<?=createOption($caraBayar,'KDREC',array('Uraian'),'-')?>
								</select>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Catatan Pembayaran</label>
								<input type="text" class="form-control form-control-sm" name="peb_header[URCARABAYAR]">
							</div>
						</div>
						<br>
						<div class="form-group row">
							<div class="col-sm-12 col-lg-2 col-xl-2">
								<label class="form-label">Jenis ID</label>
								<input type="text" class="form-control form-control-sm x-readonly" name="" value="<?=placeValue($app,'URAIAN_EKSPORTIR')?>" readonly>
								<input type="hidden" class="form-control form-control-sm x-readonly" name="peb_header[IDEKS]" value="<?=placeValue($app,'ID_EKSPORTIR')?>" readonly>
							</div>
							<div class="col-sm-12 col-lg-2 col-xl-2">
								<label class="form-label">ID</label>
								<input type="text" class="form-control form-control-sm x-readonly" name="peb_header[NPWPEKS]" value="<?=placeValue($app,'NPWP')?>" readonly>
							</div>
							<div class="col-sm-12 col-lg-2 col-xl-2">
								<label class="form-label">Nama</label>
								<input type="text" class="form-control form-control-sm x-readonly" name="peb_header[NamaEks]" value="<?=placeValue($app,'nama_sbu')?>" readonly>
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label">Alamat</label>
								<input type="text" class="form-control form-control-sm x-readonly" name="peb_header[AlmtEks]" value="<?=placeValue($app,'alamat')?>" readonly>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Status</label>
								<input type="text" class="form-control form-control-sm x-readonly" name="" value="<?=placeValue($app,'STATUS_EKSPORTIR')?>" readonly>
								<input type="hidden" class="form-control form-control-sm x-readonly" name="peb_header[StatusH]" value="<?=placeValue($app,'ID_STATUS_EKSPORTIR')?>" readonly>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">No TDP</label>
								<input type="text" class="form-control form-control-sm x-readonly" name="peb_header[NoTdp]" value="<?=placeValue($app,'NOMOR_TDP')?>" readonly>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Tanggal TDP</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly" readonly placeholder="Select date" name="peb_header[TgTdp]" value="<?=placeValue($app,'TANGGAL_TDP')?>">
									<div class="input-group-append">
										<span class="input-group-text fs-xl"><i class="fa fal fa-calendar"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">NIPER</label>
								<input type="text" class="form-control form-control-sm x-readonly" name="peb_header[Niper]" value="" readonly>
							</div>
						</div>
						<br>
						<div class="form-group row">
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">PPJK</label>
								<select class="form-control form-control-sm select2" name="peb_header[IDPPJK]">
									<option value="" disabled selected>Select Data . . .</option>
									<?=createOption($idPPJK,'KDREC',array('Uraian'),'-')?>
								</select>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">ID</label>
								<input type="text" class="form-control form-control-sm" name="peb_header[NPWPPPJK]" value="">
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Nama</label>
								<input type="text" class="form-control form-control-sm" name="peb_header[NamaPpjk]" value="">
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Alamat</label>
								<input type="text" class="form-control form-control-sm" name="peb_header[AlmtPpjk]" value="">
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">NPP PPJK</label>
								<input type="text" class="form-control form-control-sm" name="peb_header[NoPpjk]" value="">
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Tanggal PPJK</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="peb_header[TgPpjk]">
									<div class="input-group-append">
										<span class="input-group-text fs-xl"><i class="fa fal fa-calendar"></i></span>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="form-group row">
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Customer</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly uraian_pemasok" name="peb_header[NAMABELI2]" readonly />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_pemasok_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label">Alamat</label>
								<input type="text" class="form-control form-control-sm x-readonly alamat_pemasok" name="peb_header[ALMTBELI2]" value="" readonly>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Negara</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly uraian_negara_pemasok" name="peb_header[NEGBELI2]" readonly />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
						</div>
						<br>
						<label class="form-label">Penerima = Pembeli</label>
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" class="custom-control-input" id="defaultInline1Radio" name="flag_penerima" value="1" checked="" onclick="hidePenerima()">
							<label class="custom-control-label" for="defaultInline1Radio">YES</label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" class="custom-control-input" id="defaultInline2Radio" name="flag_penerima" value="0" onclick="showPenerima()">
							<label class="custom-control-label" for="defaultInline2Radio">NO</label>
						</div>
						<br>
						<br>
						<div class="penerima_template x-hidden">
							<div class="form-group row">
								<div class="col-sm-12 col-lg-3 col-xl-3">
									<label class="form-label">Penerima</label>
									<input type="text" class="form-control form-control-sm" name="peb_header[NAMABELI]" value="">
								</div>
								<div class="col-sm-12 col-lg-6 col-xl-6">
									<label class="form-label">Alamat</label>
									<input type="text" class="form-control form-control-sm" name="peb_header[ALMTBELI]" value="">
								</div>
								<div class="col-sm-12 col-lg-3 col-xl-3">
									<label class="form-label">Negara</label>
									<div class="input-group input-group-sm">
										<input type="text" class="form-control form-control-sm x-readonly uraian_negaraPenerima" name="peb_header[NEGBELI]" readonly />
										<div class="input-group-append">
											<button type="button" class="btn btn-default" onclick="setAsal('negaraPenerima')" data-toggle="modal" data-target="#tblnegara_modal"><i class="fal fa-search"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="form-group row">
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Bendera Kapal</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly uraian_negaraBenderaKapal" readonly />
									<input type="hidden" class="form-control form-control-sm kode_negaraBenderaKapal" name="peb_header[BENDERA]" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" onclick="setAsal('negaraBenderaKapal')" data-toggle="modal" data-target="#tblnegara_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Cara Angkut</label>
								<select class="form-control form-control-sm select2" name="peb_header[MODA]" id="caraAngkut">
									<option value="" disabled selected>Select Data . . .</option>
									<?=createOption($caraAngkut,'KDREC',array('Uraian'),'-')?>
								</select>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3 sarana_angkut let-1">
								<label class="form-label">Sarana Pengangkutan</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly nama_sarana_angkut" name="peb_header[CARRIER_MODAL]" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#tblkapal_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3 sarana_angkut let-other x-hidden">
								<label class="form-label">Sarana Pengangkutan</label>
								<input type="text" class="form-control form-control-sm" name="peb_header[CARRIER_INPUT]">
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Nomor Pengangkut</label>
								<input type="text" class="form-control form-control-sm" name="peb_header[VOY]" value="">
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Tanggal Perkiraan Ekspor</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="peb_header[TGEKS]">
									<div class="input-group-append">
										<span class="input-group-text fs-xl"><i class="fa fal fa-calendar"></i></span>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="form-group row">
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Pelabuhan Muat Asal</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly uraian_muatAsal" readonly />
									<input type="hidden" class="form-control form-control-sm kode_muatAsal" name="peb_header[PELMUAT]" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" onclick="setAsal('muatAsal')" data-toggle="modal" data-target="#tblpeldn_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Pelabuhan Muat Ekspor</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly uraian_muatEkspor" readonly />
									<input type="hidden" class="form-control form-control-sm kode_muatEkspor" name="peb_header[PELMUATEKS]" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" onclick="setAsal('muatEkspor')" data-toggle="modal" data-target="#tblpeldn_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Pelabuhan Muat Transit Ekspor</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly uraian_transit" readonly />
									<input type="hidden" class="form-control form-control-sm kode_transit" name="peb_header[PELTRANSIT]" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" onclick="setAsal('transit')" data-toggle="modal" data-target="#tblpelln_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Pelabuhan Bongkar</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly uraian_bongkar" readonly />
									<input type="hidden" class="form-control form-control-sm kode_bongkar" name="peb_header[DELIVERY]" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" onclick="setAsal('bongkar')" data-toggle="modal" data-target="#tblpelln_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="form-group row">
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Lokasi Pemeriksaan</label>
								<select class="form-control form-control-sm select2" name="peb_header[KDLOKBRG]">
									<option value="" disabled selected>Select Data . . .</option>
									<option value="1">KP Tempat Pemuatan</option>
									<option value="2">Gudang Eksportir</option>
									<option value="3">Tempat Lain yang Diizinkan</option>
									<option value="4">TPS</option>
									<option value="5">TPP</option>
									<option value="6">TPB</option>
								</select>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Tanggal Periksa</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="peb_header[TGSIAP]">
									<div class="input-group-append">
										<span class="input-group-text fs-xl"><i class="fa fal fa-calendar"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">KPPBC Periksa</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly uraian_kpperiksa" readonly />
									<input type="hidden" class="form-control form-control-sm kode_kpperiksa" name="peb_header[KDKTRPRIKS]" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" onclick="setAsal('kpperiksa')" data-toggle="modal" data-target="#tblkpbc_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Cara Penyerahan Barang</label>
								<select class="form-control form-control-sm select2" name="peb_header[DELIVERY]">
									<option value="" disabled selected>Select Data . . .</option>
									<?=createOption($caraPenyerahan,'KDREC',array('Uraian'),'-')?>
								</select>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Asal Barang</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly uraian_daerah" readonly />
									<input type="hidden" class="form-control form-control-sm kode_daerah" name="peb_header[PROPBRG]" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#tbldaerah_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Negara Tujuan</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly uraian_negaraTujuan" readonly />
									<input type="hidden" class="form-control form-control-sm kode_negaraTujuan" name="peb_header[NEGTUJU]" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" onclick="setAsal('negaraTujuan')" data-toggle="modal" data-target="#tblnegara_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="form-group row">
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Bank Devisa Hasil Ekspor</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly uraian_bank" readonly />
									<input type="hidden" class="form-control form-control-sm kode_bank" name="peb_header[KDBANK]" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#tblbank_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Valuta</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly uraian_valuta" readonly />
									<input type="hidden" class="form-control form-control-sm kode_valuta" name="peb_header[KDVAL]" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#tblvaluta_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">FOB</label>
								<input type="text" class="form-control form-control-sm" name="peb_header[FOB]">
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Freight</label>
								<input type="text" class="form-control form-control-sm" name="peb_header[FREIGHT]">
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Jenis Asuransi</label>
								<select class="form-control form-control-sm select2" name="peb_header[KdAss]">
									<option value="0">LN</option>
									<option value="1" selected="">DN</option>
								</select>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Nilai Asuransi</label>
								<input type="text" class="form-control form-control-sm" name="peb_header[ASURANSI]">
							</div>
						</div>
						<br>
						<div class="form-group row">
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Komoditi</label>
								<select class="form-control form-control-sm select2" name="peb_header[KMDT]">
									<option value="1" selected="">Non Migas</option>
									<option value="2">Migas</option>
								</select>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Volume</label>
								<input type="text" class="form-control form-control-sm" name="peb_header[VOLUME]">
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Bruto</label>
								<input type="text" class="form-control form-control-sm" name="peb_header[BRUTO]">
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Netto</label>
								<input type="text" class="form-control form-control-sm" name="peb_header[NETTO]">
							</div>
						</div>
						<br>
						<div class="form-group row">
							<div class="col-md-12">
								<label><b>Kemasan</b></label>
								<div class="table-responsive">
									<table class="table table-hover table-bordered table-striped table-sm dt_inv_add" id="table_kemasan" style="white-space: nowrap; min-width: 600px">
										<thead>
										<tr>
											<th class="text-center" width="5px">
												<button type="button" class="btn btn-xs btn-success btn-add-kemasan"><i class="fal fa-plus-circle"></i></button>
											</th>
											<th class="text-center">No</th>
											<th class="text-center">Jenis Kemasan</th>
											<th class="text-center">Jumlah Kemasan</th>
											<th class="text-center">Merk Kemasan</th>
										</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<label><b>Barang</b></label>
								<div class="table-responsive">
									<table class="table table-hover table-bordered table-striped table-sm dt_inv_add" id="dt_doc_out_add" style="white-space: nowrap">
										<thead>
										<tr>
											<th class="text-center" width="5px">
												<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#t_invoice_doc_out_modal"><i class="fal fa-plus-circle"></i></button>
											</th>
											<th class="text-center">No</th>
											<th class="text-center">No Invoice</th>
											<th class="text-center">Stuffing</th>
											<th class="text-center">Barang</th>
											<th class="text-center">Quantity</th>
											<th class="text-center">FOB Satuan</th>
											<th class="text-center">FOB</th>
											<th class="text-center">Kemasan</th>
											<th class="text-center">Netto</th>
											<th class="text-center">Volume</th>
											<th class="text-center">Negara Asal</th>
											<th class="text-center">Detail Bahan Baku</th>
											<th class="text-center">Detail Dokumen</th>
										</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<label><b>Dokumen Tambahan</b></label>
								<div class="table-responsive">
									<table class="table table-hover table-bordered table-striped table-sm dt_inv_add" id="table_dokumen" style="white-space: nowrap; min-width: 600px">
										<thead>
										<tr>
											<th class="text-center" width="5px">
												<button type="button" class="btn btn-xs btn-success btn-add-dokumen"><i class="fal fa-plus-circle"></i></button>
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
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Save</button>
							<a href="<?=base_url('exim/transaksi_doc_out/view_30')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Cancel</a>
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
			<input type="hidden" class="kode_inv" name="peb_detail[x][dokumen_inv][NoDok]"/>
			<input type="hidden" class="tanggal_inv" name="peb_detail[x][dokumen_inv][TgDok]"/>
			<input type="hidden" name="peb_detail[x][dokumen_inv][KdDok]" value="380"/>
		</td>
		<td>
			<p class="text_kode_stuffing" style="margin: 0;padding: 0;"></p>
			<small class="text_tanggal_stuffing" style="margin: 0;padding: 0;font-style: italic"></small>
			<input type="hidden" class="kode_stuffing" readonly name="peb_detail[x][dokumen_stuffing][NoDok]"/>
			<input type="hidden" class="tanggal_stuffing" name="peb_detail[x][dokumen_stuffing][TgDok]"/>
			<input type="hidden" name="peb_detail[x][dokumen_stuffing][KdDok]" value="999"/>
		</td>
		<td>
			<p class="text_nama_barang" style="margin: 0;padding: 0;"></p>
			<small class="text_kode_barang" style="margin: 0;padding: 0;font-style: italic"></small>
			<input type="hidden" class="kode_barang" name="peb_detail[x][KDBRG]"/>
			<input type="hidden" class="nama_barang" name="peb_detail[x][URBRG1]"/>
			<input type="hidden" class="kode_hs" name="peb_detail[x][HS]"/>
		</td>
		<td>
			<p class="text_jumlah_satuan" style="margin: 0;padding: 0;"></p>
			<small class="text_kode_satuan" style="margin: 0;padding: 0;font-style: italic"></small>
			<input type="hidden" class="kode_satuan" name="peb_detail[x][JNSATUAN]"/>
			<input type="hidden" class="jumlah_satuan" name="peb_detail[x][JMSATUAN]"/>
		</td>
		<td>
			<p class="text_fob_satuan" style="margin: 0;padding: 0;"></p>
			<input type="hidden" class="fob_satuan" name="peb_detail[x][FOBPERSAT]"/>
		</td>
		<td>
			<p class="text_fob" style="margin: 0;padding: 0;"></p>
			<input type="hidden" class="fob" name="peb_detail[x][DNilInv]"/>
		</td>
		<td>
			<p class="text_jumlah_kemasan" style="margin: 0;padding: 0;"></p>
			<small class="text_kode_kemasan" style="margin: 0;padding: 0;font-style: italic"></small>
			<input type="hidden" name="peb_detail[x][JMKOLI]" class="jumlah_kemasan">
			<input type="hidden" name="peb_detail[x][JNKOLI]" class="kode_kemasan">
		</td>
		<td>
			<p class="text_netto" style="margin: 0;padding: 0;"></p>
			<input type="hidden" class="netto" name="peb_detail[x][NETDET]"/>
		</td>
		<td>
			<p class="text_volume" style="margin: 0;padding: 0;"></p>
			<input type="hidden" class="volume" name="peb_detail[x][Dvolume]"/>
		</td>
		<td>
			<p style="margin: 0;padding: 0">INDONESIA</p>
			<small style="margin: 0;padding: 0;font-style: italic">ID</small>
			<input type="hidden" class="form-control form-control-sm x-readonly" value="Indonesia" />
			<input type="hidden" class="form-control form-control-sm" name="peb_detail[x][NegAsal]" value="ID" />
		</td>
		<td>
			<button type="button" class="btn btn-default btn-detail-bahan-baku" onclick="setDetailBahanBaku(this)" data-id="" data-toggle="modal" data-target="#detail_bahan_baku_modal"><i class="fal fa-list"></i></button>
		</td>
		<td>
			<button type="button" class="btn btn-default btn-detail-dokumen" onclick="setDetailDokumen(this)" data-id="" data-toggle="modal" data-target="#detail_dokumen_modal"><i class="fal fa-list"></i></button>
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
			<input type="text" class="form-control form-control-sm" name="dokumen_tambahan[x][NoDok]"/>
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" class="form-control form-control-sm x-datepicker x-readonly"
					   readonly placeholder="Select date" name="dokumen_tambahan[x][TgDok]">
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
				<input type="text" class="form-control form-control-sm x-readonly" id="uraian_kemasan[x]"/>
				<input type="hidden" class="form-control form-control-sm" id="kode_kemasan[x]" name="peb_kemasan[x][JnKemas]" />
				<div class="input-group-append">
					<button type="button" class="btn btn-default" onclick="setKemasanIndex('[x]')"><i class="fal fa-search"></i></button>
				</div>
			</div>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="peb_kemasan[x][JmKemas]">
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="peb_kemasan[x][MERKKEMAS]"/>
		</td>
	</tr>
	</tbody>
</table>
