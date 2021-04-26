<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Exim</li>
		<li class="breadcrumb-item">Transaksi Doc In</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Transaksi Doc In
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?= base_url('exim/transaksi_doc_in/store') ?>">
						<div class="form-group row">
							<div class="col-sm-12 col-lg-12 col-xl-12">
								<div class="row">
									<div class="col-sm-12 col-lg-4 col-xl-4">
										<label class="form-label">
											Jenis TPB
										</label>
										<select class="form-control form-control-sm select2" name="tpb_header[KODE_JENIS_TPB]">
											<option value="" disabled selected>Select Data . . .</option>
											<?= createOption($sjenis_tpb, 'KODE_JENIS_TPB', array('URAIAN_JENIS_TPB'), ' - ') ?>
										</select>
									</div>
									<div class="col-sm-12 col-lg-4 col-xl-4">
										<label class="form-label">
											Jenis Dokumen
										</label>
										<select class="form-control form-control-sm select2" name="tpb_header[KODE_DOKUMEN_PABEAN]" id="jenis_dokumen">
											<option value="" disabled selected>Select Data . . .</option>
											<?= createOption($sdokumen_pabean, 'KODE_DOKUMEN_PABEAN', array('URAIAN_DOKUMEN_PABEAN'), ' - ') ?>
										</select>
									</div>
									<div class="col-sm-12 col-lg-4 col-xl-4 x-hidden dokumen_template include-40">
										<label class="form-label">
												Tujuan Pengiriman
											</label>
											<select class="form-control form-control-sm select2" id="tujuan_pengiriman" name="tpb_header[KODE_TUJUAN_PENGIRIMAN]">
												<option value="" disabled selected>Select Data . . .</option>
											</select>
									</div>
									<div class="col-sm-12 col-lg-4 col-xl-4 x-hidden dokumen_template include-23">
										<label class="form-label">
											Tujuan TPB
										</label>
										<select class="form-control form-control-sm select2" id="tujuan_tpb" name="tpb_header[KODE_TUJUAN_TPB]">
											<option value="" disabled selected>Select Data . . .</option>
											<?=createOption($stujuan_tpb,'KODE_TUJUAN_TPB',array('URAIAN_TUJUAN_TPB'),'-')?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-12 col-xl-12">
								<div class="row">
									<div class="col-sm-12 col-lg-3 col-xl-3 x-hidden dokumen_template include-27IN">
										<label class="form-label">Nomor Aju</label>
										<input type="text" name="tpb_header[NOMOR_AJU]" class="form-control form-control-sm">
									</div>
									<div class="col-sm-12 col-lg-3 col-xl-3">
										<label class="form-label">Tanggal Aju</label>
										<div class="input-group input-group-sm">
											<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="tpb_header[TANGGAL_AJU]">
											<div class="input-group-append">
											<span class="input-group-text fs-xl"><i class="fa fal fa-calendar"></i></span>
											</div>
										</div>
									</div>
									<div class="col-sm-12 col-lg-3 col-xl-3 x-hidden dokumen_template include-27IN">
										<label class="form-label">Nomor Daftar</label>
										<input type="text" name="tpb_header[NOMOR_DAFTAR]" class="form-control form-control-sm">
									</div>
									<div class="col-sm-12 col-lg-3 col-xl-3 x-hidden dokumen_template include-27IN">
										<label class="form-label">Tanggal Pendaftaran</label>
										<div class="input-group input-group-sm">
											<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="tpb_header[TANGGAL_DAFTAR]">
											<div class="input-group-append">
											<span class="input-group-text fs-xl"><i class="fa fal fa-calendar"></i></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label">Supplier</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly nama_supplier_filter" readonly/>
									<input type="hidden" class="form-control form-control-sm id_supplier_filter" name="id_supplier"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_pengusaha_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label">Delivery Notes</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly kode_dn" readonly/>
									<input type="hidden" class="form-control form-control-sm id_dn" name="id_dn"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#t_dn_docin_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-12 col-xl-12">
								<div class="row">
									<div class="col-sm-12 col-lg-3 col-xl-3">
										<label class="form-label">Jumlah Barang</label>
										<input type="text" name="tpb_header[JUMLAH_BARANG]" class="form-control form-control-sm input-mask jumlah_barang x-readonly" readonly data-inputmask="'alias': 'currency', 'prefix': ''" >
									</div>
									<div class="col-sm-12 col-lg-3 col-xl-3">
										<label class="form-label">NETTO</label>
										<input type="text" name="tpb_header[NETTO]" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" >
									</div>
									<div class="col-sm-12 col-lg-3 col-xl-3">
										<label class="form-label">Bruto</label>
										<input type="text" name="tpb_header[BRUTO]" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" >
									</div>
									<div class="col-sm-12 col-lg-3 col-xl-3 dokumen_template x-hidden include-40 include-27IN">
										<label class="form-label">Nama Pengangkut</label>
										<input type="text" name="tpb_header[NAMA_PENGANGKUT]" class="form-control form-control-sm nama_pengangkut"  >
									</div>
								</div>
							</div>
						</div>
						<?php include('include_23.php')?>
						<?php include('include_262.php')?>
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
									<table class="table table-hover table-bordered table-striped table-sm dt_po_add" id="dt_doc_in_add" style="white-space: nowrap;">
										<thead>
										<tr>
										<th class="text-center" width="5px">
										<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#t_invoice_doc_in_modal"><i class="fal fa-plus-circle"></i></button>
											</th>
											<th class="text-center">No</th>
											<th class="text-center">PO</th>
											<th class="text-center">Surat Jalan</th>
											<th class="text-center">Job</th>
											<th class="text-center">Barang</th>
											<th class="text-center">Quantity</th>
											<th class="text-center dokumen_template x-hidden include-23">Harga Satuan</th>
											<th class="text-center dokumen_template x-hidden include-23 include-262">Harga Total</th>
											<th class="text-center dokumen_template x-hidden include-23">CIF Rupiah</th>
											<th class="text-center dokumen_template x-hidden include-40 include-27IN">Harga Penyerahan</th>
											<th class="text-center">Netto</th>
											<th class="text-center">Asuransi</th>
											<th class="text-center">Diskon</th>
											<th class="text-center">Jumlah Kemasan</th>
											<th class="text-center">Tipe Kemasan</th>
											<th class="text-center x-hidden include-23 dokumen_template">Skema Tarif</th>
											<th class="text-center x-hidden include-23 dokumen_template">Tarif</th>
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
									<table class="table table-hover table-bordered table-striped table-sm dt_po_add" id="table_dokumen" role="grid" style="white-space: nowrap; min-width: 600px">
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
							<a href="<?=base_url('exim/transaksi_doc_in')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Cancel</a>
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
		<td class="text-center"></td>
		<td>
			<p class="text_kode_po" style="margin: 0;padding: 0"></p>
			<small class="text_tanggal_po" style="margin: 0;padding: 0"></small>
			<input type="hidden" class="kode_po"name="tpb_barang[x][dokumen_po][NOMOR_DOKUMEN]"/>
			<input type="hidden" class="tanggal_po" name="tpb_barang[x][dokumen_po][TANGGAL_DOKUMEN]"/>
			<input type="hidden" name="tpb_barang[x][dokumen_po][KODE_JENIS_DOKUMEN]" value="999"/>
			<input type="hidden" name="tpb_barang[x][dokumen_po][TIPE_DOKUMEN]" value="02"/>
		</td>
		<td>
			<p class="text_no_sj" style="margin: 0;padding: 0"></p>
			<small class="text_tanggal_dn" style="margin: 0;padding: 0"></small>
			<input type="hidden" class="no_sj" name="tpb_barang[x][dokumen_dn][NOMOR_DOKUMEN]"/>
			<input type="hidden" class="tanggal_dn" name="tpb_barang[x][dokumen_dn][TANGGAL_DOKUMEN]"/>
			<input type="hidden" name="tpb_barang[x][dokumen_dn][KODE_JENIS_DOKUMEN]" value="640"/>
			<input type="hidden" name="tpb_barang[x][dokumen_dn][TIPE_DOKUMEN]" value="02"/>
		</td>
		<td>
			<p class="text_no_job" style="margin: 0;padding: 0"></p>
		</td>
		<td>
			<p class="text_nama_barang" style="margin: 0;padding: 0"></p>
			<small class="text_kode_barang" style="margin: 0;padding: 0"></small>
			<input type="hidden" class="kode_barang" name="tpb_barang[x][KODE_BARANG]"/>
			<input type="hidden" class="nama_barang" name="tpb_barang[x][URAIAN]"/>
			<input type="hidden" class="seri_barang" name="tpb_barang[x][SERI_BARANG]"/>
			<input type="hidden" class="id_detail_dn" name="tpb_barang[x][id_detail_dn]"/>
		</td>
		<td class="text-right">
			<p class="text_jumlah_satuan" style="margin: 0;padding: 0"></p>
			<small class="text_kode_satuan" style="margin: 0;padding: 0"></small>
			<input type="hidden" class="jumlah_satuan" name="tpb_barang[x][JUMLAH_SATUAN]"/>
			<input type="hidden" class="kode_satuan" name="tpb_barang[x][KODE_SATUAN]"/>
		</td>
		<td class=" dokumen_template x-hidden include-40 include-27IN">
			<input type="text" class="form-control form-control-sm harga_penyerahan x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly name="tpb_barang[x][HARGA_PENYERAHAN]" size="2000"/>
		</td>
		<td class=" dokumen_template x-hidden include-23">
			<input type="text" class="form-control form-control-sm harga_satuan x-readonly input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" readonly size="2000"/>
		</td>
		<td class=" dokumen_template x-hidden include-23 include-262">
			<input type="text" class="form-control form-control-sm harga_invoice x-readonly input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" readonly name="tpb_barang[x][HARGA_INVOICE]" id="tpb_barang[x][HARGA_INVOICE]" size="2000"/>
			<input type="hidden" class="fob_barang" name="tpb_barang[x][FOB]"/>
			<input type="hidden" class="cif_barang" name="tpb_barang[x][CIF]"/>
		</td>
		<td class=" dokumen_template x-hidden include-23">
			<input type="text" class="form-control form-control-sm input-mask cif_rupiah_barang" name="tpb_barang[x][CIF_RUPIAH]" id="tpb_barang[x][CIF_RUPIAH]" data-inputmask="'alias': 'currency', 'prefix': ''" size="2000"/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''"  name="tpb_barang[x][NETTO]" size="1000"/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''"  name="tpb_barang[x][ASURANSI]" size="1000"/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''"  name="tpb_barang[x][DISKON]" size="1000"/>
		</td>
		<td>
			<input type="text" name="tpb_barang[x][JUMLAH_KEMASAN]" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" size="1000">
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" class="form-control form-control-sm x-readonly" id="uraian_kemasan_barang[x]" readonly size="1000"/>
				<input type="hidden" id="kode_jenis_kemasan[x]" name="tpb_barang[x][KODE_KEMASAN]"/>
				<div class="input-group-append">
					<button type="button" class="btn btn-default" onclick="setKemasanIndex('[x]')" data-toggle="modal" data-target="#referensi_kemasan_docin_modal"><i class="fal fa-search"></i></button>
				</div>
			</div>
		</td>
		<td class="x-hidden dokumen_template include-23">
			<select class="form-control form-control-sm mselect2" name="tpb_barang[x][KODE_SKEMA_TARIF]">
				<option value="" disabled selected>Select Data . . .</option>
				<?= createOption($sskema_tarif, 'KODE_SKEMA', array('URAIAN_SKEMA'), ' - ') ?>
			</select>
		</td>
		<td class="x-hidden dokumen_template include-23">
			<div class="input-group input-group-sm">
				<div class="input-group-append">
					<button type="button" class="btn btn-default" onclick="setModalIndex('[x]')"><i class="fal fa-search"></i></button>
				</div>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BM_DITANGGUHKAN][TARIF]" id="tpb_barang[x][TARIF][BM_DITANGGUHKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BM_DITANGGUHKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][BM_DITANGGUHKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][BM_DITANGGUHKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][BM_DITANGGUHKAN][JENIS_TARIF]" value="BM"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BM_DITANGGUHKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][BM_DITANGGUHKAN][KODE_FASILITAS]" value="2"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BM_DITANGGUHKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][BM_DITANGGUHKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BM_DIBEBASKAN][TARIF]" id="tpb_barang[x][TARIF][BM_DIBEBASKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BM_DIBEBASKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][BM_DIBEBASKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][BM_DIBEBASKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][BM_DIBEBASKAN][JENIS_TARIF]" value="BM"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BM_DIBEBASKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][BM_DIBEBASKAN][KODE_FASILITAS]" value="4"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BM_DIBEBASKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][BM_DIBEBASKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BM_TIDAK_DIPUNGUT][TARIF]" id="tpb_barang[x][TARIF][BM_TIDAK_DIPUNGUT][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BM_TIDAK_DIPUNGUT][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][BM_TIDAK_DIPUNGUT][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][BM_TIDAK_DIPUNGUT][JENIS_TARIF]" id="tpb_barang[x][TARIF][BM_TIDAK_DIPUNGUT][JENIS_TARIF]" value="BM"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BM_TIDAK_DIPUNGUT][KODE_FASILITAS]" id="tpb_barang[x][TARIF][BM_TIDAK_DIPUNGUT][KODE_FASILITAS]" value="5"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BM_TIDAK_DIPUNGUT][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][BM_TIDAK_DIPUNGUT][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BMT_DITANGGUHKAN][TARIF]" id="tpb_barang[x][TARIF][BMT_DITANGGUHKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BMT_DITANGGUHKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][BMT_DITANGGUHKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][BMT_DITANGGUHKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][BMT_DITANGGUHKAN][JENIS_TARIF]" value="BMT"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BMT_DITANGGUHKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][BMT_DITANGGUHKAN][KODE_FASILITAS]" value="2"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BMT_DITANGGUHKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][BMT_DITANGGUHKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BMT_DIBEBASKAN][TARIF]" id="tpb_barang[x][TARIF][BMT_DIBEBASKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BMT_DIBEBASKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][BMT_DIBEBASKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][BMT_DIBEBASKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][BMT_DIBEBASKAN][JENIS_TARIF]" value="BMT"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BMT_DIBEBASKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][BMT_DIBEBASKAN][KODE_FASILITAS]" value="4"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BMT_DIBEBASKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][BMT_DIBEBASKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BMT_TIDAK_DIPUNGUT][TARIF]" id="tpb_barang[x][TARIF][BMT_TIDAK_DIPUNGUT][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BMT_TIDAK_DIPUNGUT][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][BMT_TIDAK_DIPUNGUT][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][BMT_TIDAK_DIPUNGUT][JENIS_TARIF]" id="tpb_barang[x][TARIF][BMT_TIDAK_DIPUNGUT][JENIS_TARIF]" value="BMT"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BMT_TIDAK_DIPUNGUT][KODE_FASILITAS]" id="tpb_barang[x][TARIF][BMT_TIDAK_DIPUNGUT][KODE_FASILITAS]" value="5"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BMT_TIDAK_DIPUNGUT][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][BMT_TIDAK_DIPUNGUT][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][CUKAI_DITANGGUHKAN][TARIF]" id="tpb_barang[x][TARIF][CUKAI_DITANGGUHKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][CUKAI_DITANGGUHKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][CUKAI_DITANGGUHKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][CUKAI_DITANGGUHKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][CUKAI_DITANGGUHKAN][JENIS_TARIF]" value="CUKAI"/>
				<input type="hidden" name="tpb_barang[x][TARIF][CUKAI_DITANGGUHKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][CUKAI_DITANGGUHKAN][KODE_FASILITAS]" value="2"/>
				<input type="hidden" name="tpb_barang[x][TARIF][CUKAI_DITANGGUHKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][CUKAI_DITANGGUHKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][CUKAI_DIBEBASKAN][TARIF]" id="tpb_barang[x][TARIF][CUKAI_DIBEBASKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][CUKAI_DIBEBASKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][CUKAI_DIBEBASKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][CUKAI_DIBEBASKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][CUKAI_DIBEBASKAN][JENIS_TARIF]" value="CUKAI"/>
				<input type="hidden" name="tpb_barang[x][TARIF][CUKAI_DIBEBASKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][CUKAI_DIBEBASKAN][KODE_FASILITAS]" value="4"/>
				<input type="hidden" name="tpb_barang[x][TARIF][CUKAI_DIBEBASKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][CUKAI_DIBEBASKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][CUKAI_TIDAK_DIPUNGUT][TARIF]" id="tpb_barang[x][TARIF][CUKAI_TIDAK_DIPUNGUT][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][CUKAI_TIDAK_DIPUNGUT][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][CUKAI_TIDAK_DIPUNGUT][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][CUKAI_TIDAK_DIPUNGUT][JENIS_TARIF]" id="tpb_barang[x][TARIF][CUKAI_TIDAK_DIPUNGUT][JENIS_TARIF]" value="PPN"/>
				<input type="hidden" name="tpb_barang[x][TARIF][CUKAI_TIDAK_DIPUNGUT][KODE_FASILITAS]" id="tpb_barang[x][TARIF][CUKAI_TIDAK_DIPUNGUT][KODE_FASILITAS]" value="5"/>
				<input type="hidden" name="tpb_barang[x][TARIF][CUKAI_TIDAK_DIPUNGUT][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][CUKAI_TIDAK_DIPUNGUT][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPN_DITANGGUHKAN][TARIF]" id="tpb_barang[x][TARIF][PPN_DITANGGUHKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPN_DITANGGUHKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][PPN_DITANGGUHKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][PPN_DITANGGUHKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][PPN_DITANGGUHKAN][JENIS_TARIF]" value="PPN"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPN_DITANGGUHKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][PPN_DITANGGUHKAN][KODE_FASILITAS]" value="2"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPN_DITANGGUHKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][PPN_DITANGGUHKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPN_DIBEBASKAN][TARIF]" id="tpb_barang[x][TARIF][PPN_DIBEBASKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPN_DIBEBASKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][PPN_DIBEBASKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][PPN_DIBEBASKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][PPN_DIBEBASKAN][JENIS_TARIF]" value="PPN"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPN_DIBEBASKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][PPN_DIBEBASKAN][KODE_FASILITAS]" value="4"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPN_DIBEBASKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][PPN_DIBEBASKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPN_TIDAK_DIPUNGUT][TARIF]" id="tpb_barang[x][TARIF][PPN_TIDAK_DIPUNGUT][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPN_TIDAK_DIPUNGUT][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][PPN_TIDAK_DIPUNGUT][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][PPN_TIDAK_DIPUNGUT][JENIS_TARIF]" id="tpb_barang[x][TARIF][PPN_TIDAK_DIPUNGUT][JENIS_TARIF]" value="PPNBM"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPN_TIDAK_DIPUNGUT][KODE_FASILITAS]" id="tpb_barang[x][TARIF][PPN_TIDAK_DIPUNGUT][KODE_FASILITAS]" value="5"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPN_TIDAK_DIPUNGUT][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][PPN_TIDAK_DIPUNGUT][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPNBM_DITANGGUHKAN][TARIF]" id="tpb_barang[x][TARIF][PPNBM_DITANGGUHKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPNBM_DITANGGUHKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][PPNBM_DITANGGUHKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][PPNBM_DITANGGUHKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][PPNBM_DITANGGUHKAN][JENIS_TARIF]" value="PPNBM"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPNBM_DITANGGUHKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][PPNBM_DITANGGUHKAN][KODE_FASILITAS]" value="2"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPNBM_DITANGGUHKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][PPNBM_DITANGGUHKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPNBM_DIBEBASKAN][TARIF]" id="tpb_barang[x][TARIF][PPNBM_DIBEBASKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPNBM_DIBEBASKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][PPNBM_DIBEBASKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][PPNBM_DIBEBASKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][PPNBM_DIBEBASKAN][JENIS_TARIF]" value="PPNBM"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPNBM_DIBEBASKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][PPNBM_DIBEBASKAN][KODE_FASILITAS]" value="4"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPNBM_DIBEBASKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][PPNBM_DIBEBASKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPNBM_TIDAK_DIPUNGUT][TARIF]" id="tpb_barang[x][TARIF][PPNBM_TIDAK_DIPUNGUT][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPNBM_TIDAK_DIPUNGUT][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][PPNBM_TIDAK_DIPUNGUT][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][PPNBM_TIDAK_DIPUNGUT][JENIS_TARIF]" id="tpb_barang[x][TARIF][PPNBM_TIDAK_DIPUNGUT][JENIS_TARIF]" value="PPH"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPNBM_TIDAK_DIPUNGUT][KODE_FASILITAS]" id="tpb_barang[x][TARIF][PPNBM_TIDAK_DIPUNGUT][KODE_FASILITAS]" value="5"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPNBM_TIDAK_DIPUNGUT][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][PPNBM_TIDAK_DIPUNGUT][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPH_DITANGGUHKAN][TARIF]" id="tpb_barang[x][TARIF][PPH_DITANGGUHKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPH_DITANGGUHKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][PPH_DITANGGUHKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][PPH_DITANGGUHKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][PPH_DITANGGUHKAN][JENIS_TARIF]" value="PPH"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPH_DITANGGUHKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][PPH_DITANGGUHKAN][KODE_FASILITAS]" value="2"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPH_DITANGGUHKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][PPH_DITANGGUHKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPH_DIBEBASKAN][TARIF]" id="tpb_barang[x][TARIF][PPH_DIBEBASKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPH_DIBEBASKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][PPH_DIBEBASKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][PPH_DIBEBASKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][PPH_DIBEBASKAN][JENIS_TARIF]" value="PPH"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPH_DIBEBASKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][PPH_DIBEBASKAN][KODE_FASILITAS]" value="4"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPH_DIBEBASKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][PPH_DIBEBASKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPH_TIDAK_DIPUNGUT][TARIF]" id="tpb_barang[x][TARIF][PPH_TIDAK_DIPUNGUT][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPH_TIDAK_DIPUNGUT][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][PPH_TIDAK_DIPUNGUT][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][PPH_TIDAK_DIPUNGUT][JENIS_TARIF]" id="tpb_barang[x][TARIF][PPH_TIDAK_DIPUNGUT][JENIS_TARIF]" value="PPH"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPH_TIDAK_DIPUNGUT][KODE_FASILITAS]" id="tpb_barang[x][TARIF][PPH_TIDAK_DIPUNGUT][KODE_FASILITAS]" value="5"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPH_TIDAK_DIPUNGUT][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][PPH_TIDAK_DIPUNGUT][TARIF_FASILITAS]" value="100.00"/>
			</div>
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
			<select class="form-control form-control-sm mselect2" name="dokumen_tambahan[x][KODE_JENIS_DOKUMEN]">
				<option value="" disabled selected>Select Data . . .</option>
				<?= createOption($sdokumen, 'KODE_DOKUMEN', array('URAIAN_DOKUMEN'), ' - ') ?>
			</select>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="dokumen_tambahan[x][NOMOR_DOKUMEN]" />
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" class="form-control form-control-sm x-datepicker x-readonly"
					   readonly placeholder="Select date" name="dokumen_tambahan[x][TANGGAL_DOKUMEN]">
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
				<input type="text" class="form-control form-control-sm x-readonly" readonly id="uraian_kemasan[x]"/>
				<input type="hidden" class="form-control form-control-sm" id="kode_kemasan[x]" name="tpb_kemasan[x][KODE_JENIS_KEMASAN]" />
				<div class="input-group-append">
					<button type="button" class="btn btn-default" onclick="setKemasanIndexDocIn('[x]')"><i class="fal fa-search"></i></button>
				</div>
			</div>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" name="tpb_kemasan[x][JUMLAH_KEMASAN]">
		</td>
	</tr>
	</tbody>
</table>
<table class="x-hidden add_barang_template">
	<tbody>
	<tr data-index="x">
		<td class="text-center">
			<button class="btn btn-xs btn-danger btn-delete-barang"><i class="fa fal fa-trash"></i></button>
		</td>
		<td class="text-center"></td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" class="form-control form-control-sm x-readonly" readonly id="uraian_kemasan[x]"/>
				<input type="hidden" class="form-control form-control-sm" id="barang[x]" name="tpb_kemasan[x][KODE_JENIS_KEMASAN]" />
				<div class="input-group-append">
					<button type="button" class="btn btn-default" onclick="setIndexDocIn('[x]')"><i class="fal fa-search"></i></button>
				</div>
			</div>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" name="tpb_kemasan[x][JUMLAH_KEMASAN]">
		</td>
	</tr>
	</tbody>
</table>

<script>
    let arr_tujuan = <?=json_encode($stujuan_pengiriman)?>;
</script>
