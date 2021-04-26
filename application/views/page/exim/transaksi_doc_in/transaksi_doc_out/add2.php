<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Exim</li>
		<li class="breadcrumb-item">Posting In</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Posting In
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?= base_url('exim/posting_doc_in/store') ?>">
						<div class="form-group row">
							<div class="col-sm-12 col-lg-4 col-xl-4">
								<label class="form-label">Nomor Pengajuan</label>
								<input type="text" name="no_pengajuan" class=" form-control  form-control-sm" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-4 col-xl-4">
								<label class="form-label">Nomor Pendaftaran</label>
								<input type="text" name="no_pendaftaran" class=" form-control  form-control-sm" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-4 col-xl-4">
								<label class="form-label">Tanggal Pengajuan</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly"
										   readonly placeholder="Select date" name="tanggal_pengajuan">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-4 col-xl-4">
								<label class="form-label">
									Jenis TPB
								</label>
								<select class="form-control form-control-sm select2" name="id_jenis_tpb">
									<option value="" disabled selected>Select Data . . .</option>
									<?= createOption($sjenis_tpb, 'ID', array('URAIAN_JENIS_TPB'), ' - ') ?>
								</select>
							</div>
							<div class="col-sm-12 col-lg-4 col-xl-4">
								<label class="form-label">
									Jenis Dokumen
								</label>
								<select class="form-control form-control-sm select2" name="id_jenis_dokumen"
										id="jenis_dokumen">
									<option value="" disabled selected>Select Data . . .</option>
									<?= createOption($sdokumen_pabean, 'ID', array('URAIAN_DOKUMEN_PABEAN'), ' - ') ?>
								</select>
							</div>
							<div class="col-sm-12 col-lg-4 col-xl-4">
								<label class="form-label">
									Tujuan Pengiriman
								</label>
								<select class="form-control form-control-sm select2" name="id_tujuan">
									<option value="" disabled selected>Select Data . . .</option>
									<?= createOption($stujuan_pengiriman, 'ID', array('URAIAN_TUJUAN_PENGIRIMAN'), ' - ') ?>
								</select>
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label">Harga Penyerahan</label>
								<input type="text" name="harga_penyerahan" class=" form-control  form-control-sm" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label">Kemasan</label>
								<input type="text" name="Kemasan" class="form-control form-control-sm" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-4 col-xl-4">
								<label class="form-label">Netto</label>
								<input type="text" name="Netto" class="form-control form-control-sm" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-4 col-xl-4">
								<label class="form-label">Bruto</label>
								<input type="text" name="Bruto" class="form-control form-control-sm" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-4 col-xl-4">
								<label class="form-label">Jumlah Barang</label>
								<input type="text" name="quantity" class="form-control form-control-sm" placeholder="">
							</div>
						</div>
						<div class="x-hidden dokumen_template include-14">
							<div class="form-group row">
								<div class="col-md-4">
									<label class="form-label">Jenis Dokumen</label>
									<input type="text" class="form-control form-control-sm" name="jenis_dokumen" placeholder=""/>
								</div>
								<div class="col-md-4">
									<label class="form-label">No Dokumen</label>
									<input type="text" class="form-control form-control-sm" name="no_dokumen" placeholder=""/>
								</div>
								<div class="col-md-4">
									<label class="form-label">Tanggal</label>
									<div class="input-group input-group-sm">
										<input type="text" class="form-control form-control-sm x-datepicker x-readonly"
											   readonly placeholder="Select date" name="tanggal_dokumen">
										<div class="input-group-append">
											<span class="input-group-text fs-xl">
												<i class="fa fal fa-calendar"></i>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="x-hidden dokumen_template include-15">
							<div class="form-group row">
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-sm" id="table-detail-261">
											<thead>
											<tr>
												<th class="text-center">No</th>
												<th class="text-center">Jenis Jaminan</th>
												<th class="text-center">Nomor</th>
												<th class="text-center">Tanggal</th>
												<th class="text-center">Nilai</th>
												<th class="text-center">Jatuh Tempo</th>
												<th class="text-center">Penjamin</th>
												<th class="text-center">Nomor BPJ</th>
												<th class="text-center">Tanggal BPJ</th>
												<th class="text-center">
													<button type="button" class="btn btn-success btn-xs btn-add-row-261"><i class="fa fal fa-plus-circle"></i></button>
												</th>
											</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="x-hidden dokumen_template include-30" id="30">
							<div class="form-group row">
								<div class="col-md-3">
									<label class="form-label">Nomor LC</label>
									<input type="text" class="form-control form-control-sm" name="no_lc"
										   placeholder=""/>
								</div>
								<div class="col-md-3">
									<label class="form-label">Date</label>
									<div class="input-group input-group-sm">
										<input type="text" class="form-control form-control-sm x-datepicker x-readonly"
											   readonly placeholder="Select date" name="tgl_lc">
										<div class="input-group-append">
											<span class="input-group-text fs-xl">
												<i class="fa fal fa-calendar"></i>
											</span>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<label class="form-label">Nomor B/L</label>
									<input type="text" class="form-control form-control-sm" name="no_bl"
										   placeholder=""/>
								</div>
								<div class="col-md-3">
									<label class="form-label">Date</label>
									<div class="input-group input-group-sm">
										<input type="text" class="form-control form-control-sm x-datepicker x-readonly"
											   readonly placeholder="Select date" name="tgl_bl">
										<div class="input-group-append">
											<span class="input-group-text fs-xl">
												<i class="fa fal fa-calendar"></i>
											</span>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<label class="form-label">Nomor BC 1.1</label>
									<input type="text" class="form-control form-control-sm" name="no_bc11"
										   placeholder=""/>
								</div>
								<div class="col-md-3">
									<label class="form-label">Date</label>
									<div class="input-group input-group-sm">
										<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="tgl_bc11">
										<div class="input-group-append">
											<span class="input-group-text fs-xl">
												<i class="fa fal fa-calendar"></i>
											</span>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<label class="form-label">Pos 1</label>
									<input type="text" class="form-control form-control-sm" name="pos1" placeholder=""/>
								</div>
								<div class="col-md-3">
									<label class="form-label">Pos 2</label>
									<input type="text" class="form-control form-control-sm" name="pos2" placeholder=""/>
								</div>
								<div class="col-md-3">
									<label class="form-label">Jenis Export</label>
									<input type="text" class="form-control form-control-sm" name="jenis_eksport" placeholder=""/>
								</div>
								<div class="col-md-3">
									<label class="form-label">Kategori Export</label>
									<input type="text" class="form-control form-control-sm" name="kategori_eksport" placeholder=""/>
								</div>
								<div class="col-md-3">
									<label class="form-label">Cara Perdagangan</label>
									<input type="text" class="form-control form-control-sm" name="cara_perdagangan" placeholder=""/>
								</div>
								<div class="col-md-3">
									<label class="form-label">Cara Pembayaran</label>
									<input type="text" class="form-control form-control-sm" name="cara_pembayaran" placeholder=""/>
								</div>
								<div class="col-md-3">
									<label class="form-label">
										Cara Pengangkutan
									</label>
									<select class="form-control form-control-sm select2" name="referensi_cara_angkut">
										<option value="" disabled selected>Select Data . . .</option>
										<?= createOption($scara_angkut, '$ID', array('URAIAN_CARA_ANGKUT'), ' - ') ?>
									</select>
								</div>
								<div class="col-md-3">
									<label class="form-label">Nama Sarana Pengangkutan</label>
									<input type="text" class="form-control form-control-sm" name="nama_pengangkut" placeholder=""/>
								</div>
								<div class="col-md-3">
									<label class="form-label">VOY / Flight</label>
									<input type="text" class="form-control form-control-sm" name="voy_flight" placeholder=""/>
								</div>
								<div class="col-md-3">
									<label class="form-label">Negara</label>
									<input type="text" class="form-control form-control-sm" name="negara" placeholder=""/>
								</div>
								<div class="col-md-4">
									<label class="form-label">Pelabuhan Muat</label>
									<input type="text" class="form-control form-control-sm" name="pelabuhan_muat" placeholder=""/>
								</div>
								<div class="col-md-4">
									<label class="form-label">Pelabuhan Transit</label>
									<input type="text" class="form-control form-control-sm" name="pelabuhan_transit" placeholder=""/>
								</div>
								<div class="col-md-4">
									<label class="form-label">Pelabuhan Bongkar</label>
									<input type="text" class="form-control form-control-sm" name="pelabuhan_bongkar" placeholder=""/>
								</div>
								<div class="col-md-4">
									<label class="form-label">Tipe Kontainer</label>
									<input type="text" class="form-control form-control-sm" name="tipe_kontainer" placeholder=""/>
								</div>
								<div class="col-md-4">
									<label class="form-label">Nomor Kontainer</label>
									<input type="text" class="form-control form-control-sm" name="no_kontainer" placeholder=""/>
								</div>
								<div class="col-md-4">
									<label class="form-label">Ukuran Kontainer</label>
									<input type="text" class="form-control form-control-sm" name="ukuran_kontainer" placeholder=""/>
								</div>
							</div>
						</div>
						<div class="x-hidden dokumen_template include-14 include-15 include-30">
							<div class="form-group row">
								<div class="col-md-3">
									<label class="form-label">NDPDM</label>
									<input type="text" class="form-control form-control-sm" name="ndpdm" placeholder=""/>
								</div>
								<div class="col-md-3">
									<label class="form-label">Freight</label>
									<input type="text" class="form-control form-control-sm" name="freight" placeholder=""/>
								</div>
								<div class="col-md-3">
									<label class="form-label">Valuta</label>
									<input type="text" class="form-control form-control-sm" name="valuta" placeholder=""/>
								</div>
								<div class="col-md-3">
									<label class="form-label">FOB</label>
									<input type="text" class="form-control form-control-sm" name="fob" placeholder=""/>
								</div>
								<div class="col-md-4">
									<label class="form-label">Asuransi</label>
									<input type="text" class="form-control form-control-sm" name="asuransi" placeholder=""/>
								</div>
								<div class="col-md-4">
									<label class="form-label">Nilai CIF</label>
									<input type="text" class="form-control form-control-sm" name="nilaicif" placeholder=""/>
								</div>
								<div class="col-md-4">
									<label class="form-label">Nilai CIF Rupiah</label>
									<input type="text" class="form-control form-control-sm" name="nilaicifrupiah" placeholder=""/>
								</div>
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-sm">
											<thead>
											<tr>
												<td class="text-center">JENIS PUNGUTAN</td>
												<td class="text-center">DITANGGUHKAN</td>
												<td class="text-center">DIBEBASKAN</td>
												<td class="text-center">TIDAK DIPUNGUT</td>
											</tr>
											</thead>
											<tbody>
											<tr>
												<td>BM</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="bm_ditangguhkan" placeholder=""/>
												</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="bm_dibebaskan" placeholder=""/>
												</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="bm_tidak_dipungut" placeholder=""/>
												</td>
											</tr>
											<tr>
												<td>BMT</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="bmt_ditangguhkan" placeholder=""/>
												</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="bmt_dibebaskan" placeholder=""/>
												</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="bmt_tidak_dipungut" placeholder=""/>
												</td>
											</tr>
											<tr>
												<td>CUKAI</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="cukai_ditangguhkan" placeholder=""/>
												</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="cukai_dibebaskan" placeholder=""/>
												</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="cukai_tidak_dipungut" placeholder=""/>
												</td>
											</tr>
											<tr>
												<td>PPN</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="ppn_ditangguhkan" placeholder=""/>
												</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="ppn_dibebaskan" placeholder=""/>
												</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="ppn_tidak_dipungut" placeholder=""/>
												</td>
											</tr>
											<tr>
												<td>PPnBM</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="ppnbm_ditangguhkan" placeholder=""/>
												</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="ppnbm_dibebaskan" placeholder=""/>
												</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="ppnbm_tidak_dipungut" placeholder=""/>
												</td>
											</tr>
											<tr>
												<td>PPH</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="pph_ditangguhkan" placeholder=""/>
												</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="pph_dibebaskan" placeholder=""/>
												</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="pph_tidak_dipungut" placeholder=""/>
												</td>
											</tr>
											<tr>
												<td>TOTAL</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="total_ditangguhkan" placeholder=""/>
												</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="total_dibebaskan" placeholder=""/>
												</td>
												<td>
													<input type="text" class="form-control form-control-sm" name="total_tidak_dipungut" placeholder=""/>
												</td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-sm" id="table-detail">
										<thead>
										<tr>
											<th class="text-center">No</th>
											<th class="text-center">No PO</th>
											<th class="text-center">Surat Jalan</th>
											<th class="text-center">No Job</th>
											<th class="text-center">Kode Barang</th>
											<th class="text-center">Nama Barang</th>
											<th class="text-center">Satuan</th>
											<th class="text-center">Quantity</th>
											<th class="text-center">Seri Barang</th>
											<th class="text-center">Harga Satuan</th>
											<th class="text-center">Harga Invoice</th>
											<th class="text-center">Kode Skema Tarif</th>
											<th class="text-center">Pos Tarif</th>
											<th class="text-center">Asuransi</th>
											<th class="text-center">Diskon</th>
											<th class="text-center">
												<button type="button" class="btn btn-success btn-xs btn-add-row"><i
														class="fa fal fa-plus-circle"></i></button>
											</th>
										</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="form-group">
							<a href="<?=base_url('exim/posting_doc_out')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Cancel</a>
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
<table class="x-hidden table-template">
	<tbody>
	<tr>
		<td class="text-center">1</td>
		<td>
			<input type="text" class="form-control form-control-sm x-readonly" readonly name="kode_po" placeholder=""/>
			<input type="hidden" class="form-control form-control-sm" name="id_po" placeholder=""/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm x-readonly" readonly name="no_doc" placeholder=""/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm x-readonly" readonly name="no_job" placeholder=""/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm x-readonly" readonly name="kode_barang"
				   placeholder=""/>
			<input type="hidden" class="form-control form-control-sm" name="id_sub_barang" placeholder=""/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm x-readonly" readonly name="nama_barang"
				   placeholder=""/>
			<input type="hidden" class="form-control form-control-sm" name="id_sub_barang" placeholder=""/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="id_satuan" placeholder=""
				   value="<?= isset($id_satuan) ? $id_satuan : '' ?>"/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="qty" placeholder=""
				   value="<?= isset($qty) ? $qty : '' ?>"/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="seri_barang" placeholder=""
				   value="<?= isset($seri_barang) ? $seri_barang : '' ?>"/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="harga_satuan" placeholder=""
				   value="<?= isset($harga_satuan) ? $harga_satuan : '' ?>"/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="harga_invoice" placeholder=""
				   value="<?= isset($harga_invoice) ? $harga_invoice : '' ?>"/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="kode_tarif" placeholder=""
				   value="<?= isset($kode_tarif) ? $kode_tarif : '' ?>"/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="pos_tarif" placeholder=""
				   value="<?= isset($pos_tarif) ? $pos_tarif : '' ?>"/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="asuransi" placeholder=""
				   value="<?= isset($asuransi) ? $asuransi : '' ?>"/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="diskon" placeholder=""
				   value="<?= isset($diskon) ? $diskon : '' ?>"/>
		</td>
		<td class="text-center">
			<button class="btn btn-xs btn-danger btn-delete-row"><i class="fa fal fa-trash"></i></button>
		</td>
	</tr>
	</tbody>
</table>
<table class="x-hidden table-template-261">
	<tbody>
	<tr>
		<td class="text-center">1</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="jenis_jaminan" placeholder=""/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="nomor_jaminan" placeholder=""/>
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" class="form-control form-control-sm x-datepicker x-readonly"
					   readonly placeholder="Select date" name="tanggal_jaminan">
				<div class="input-group-append">
					<span class="input-group-text fs-xl">
						<i class="fa fal fa-calendar"></i>
					</span>
				</div>
			</div>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="nilai_jaminan" placeholder=""/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="jatuh_tempo" placeholder=""/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="penjamin" placeholder=""/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="nomor_bpj" placeholder=""/>
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" class="form-control form-control-sm x-datepicker x-readonly"
					   readonly placeholder="Select date" name="tanggal_bpj">
				<div class="input-group-append">
					<span class="input-group-text fs-xl">
						<i class="fa fal fa-calendar"></i>
					</span>
				</div>
			</div>
		</td>
		<td class="text-center">
			<button class="btn btn-xs btn-danger btn-delete-row-261"><i class="fa fal fa-trash"></i></button>
		</td>
	</tr>
	</tbody>
</table>
