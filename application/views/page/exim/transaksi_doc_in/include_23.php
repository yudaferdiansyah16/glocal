<div class="x-hidden dokumen_template include-23">
	<div class="form-group row">
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="row">
				<div class="col-md-6">
					<label class="form-label">Nomor LC</label>
					<input type="text" class="form-control form-control-sm" name="tpb_dokumen[0][NOMOR_DOKUMEN]" placeholder=""/>
					<input type="hidden" name="tpb_dokumen[0][KODE_JENIS_DOKUMEN]" value="465"/>
					<input type="hidden" name="tpb_dokumen[0][TIPE_DOKUMEN]" value="02"/>
				</div>
				<div class="col-md-6">
					<label class="form-label">Date</label>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="tpb_dokumen[0][TANGGAL_DOKUMEN]">
						<div class="input-group-append">
											<span class="input-group-text fs-xl">
												<i class="fa fal fa-calendar"></i>
											</span>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<label class="form-label">Nomor B/L</label>
					<input type="text" class="form-control form-control-sm" name="tpb_dokumen[1][NOMOR_DOKUMEN]" placeholder=""/>
					<input type="hidden" name="tpb_dokumen[1][KODE_JENIS_DOKUMEN]" value="705"/>
					<input type="hidden" name="tpb_dokumen[1][TIPE_DOKUMEN]" value="02"/>
				</div>
				<div class="col-md-6">
					<label class="form-label">Date</label>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="tpb_dokumen[1][TANGGAL_DOKUMEN]">
						<div class="input-group-append">
											<span class="input-group-text fs-xl">
												<i class="fa fal fa-calendar"></i>
											</span>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<label class="form-label">Nomor BC 1.1</label>
					<input type="text" class="form-control form-control-sm" name="tpb_header[NOMOR_BC11]" placeholder=""/>
				</div>
				<div class="col-md-6">
					<label class="form-label">Date</label>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="tpb_header[TANGGAL_BC11]">
						<div class="input-group-append">
											<span class="input-group-text fs-xl">
												<i class="fa fal fa-calendar"></i>
											</span>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<label class="form-label">POS BC 1.1</label>
					<input type="text" class="form-control form-control-sm" name="tpb_header[POS_BC11]" placeholder=""/>
				</div>
				<div class="col-md-4">
					<label class="form-label">SUB POS BC 1.1</label>
					<input type="text" class="form-control form-control-sm" name="tpb_header[SUBPOS_BC11]" placeholder=""/>
				</div>
				<div class="col-md-4">
					<label class="form-label">SUB SUB POS BC 1.1</label>
					<input type="text" class="form-control form-control-sm" name="tpb_header[SUBSUBPOS_BC11]" placeholder=""/>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="row">
				<div class="col-md-12">
					<label class="form-label">NDPBM</label>
					<input type="text" class="form-control form-control-sm input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''" name="tpb_header[NDPBM]" placeholder=""/>
				</div>
				<div class="col-md-6 ">
					<label class="form-label">Valuta</label>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control form-control-sm x-readonly nama_valuta" readonly placeholder=""/>
						<input type="hidden" class="form-control form-control-sm id_valuta" name="tpb_header[KODE_VALUTA]" placeholder=""/>
						<div class="input-group-append">
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_valuta_modal"><i class="fal fa-search"></i></button>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<label class="form-label">FOB</label>
					<input type="text" class="form-control form-control-sm input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''" name="tpb_header[FOB]" placeholder=""/>
				</div>
				<div class="col-md-6">
					<label class="form-label">Freight</label>
					<input type="text" class="form-control form-control-sm input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''" name="tpb_header[FREIGHT]" placeholder=""/>
				</div>
				<div class="col-md-6">
					<label class="form-label">Asuransi</label>
					<input type="text" class="form-control form-control-sm input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''" name="tpb_header[ASURANSI]" placeholder=""/>
				</div>
				<div class="col-md-6">
					<label class="form-label">Nilai CIF</label>
					<input type="text" class="form-control form-control-sm input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''" name="tpb_header[CIF]" placeholder=""/>
				</div>
				<div class="col-md-6">
					<label class="form-label">Nilai CIF Rupiah</label>
					<input type="text" class="form-control form-control-sm input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''" name="tpb_header[CIF_RUPIAH]" placeholder=""/>
				</div>

			</div>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="row">
				<div class="col-md-6">
					<label class="form-label">
						Cara Pengangkutan
					</label>
					<select class="form-control form-control-sm select2" name="tpb_header[KODE_CARA_ANGKUT]">
						<option value="" disabled selected>Select Data . . .</option>
						<?= createOption($scara_angkut, 'KODE_CARA_ANGKUT', array('URAIAN_CARA_ANGKUT'), ' - ') ?>
					</select>
				</div>
				<div class="col-md-6">
					<label class="form-label">Nama Sarana Pengangkutan</label>
					<input type="text" class="form-control form-control-sm" name="tpb_header[NAMA_PENGANGKUT]" placeholder=""/>
				</div>
				<div class="col-md-6">
					<label class="form-label">VOY / Flight</label>
					<input type="text" class="form-control form-control-sm" name="tpb_header[NOMOR_VOY_FLIGHT]" placeholder=""/>
				</div>
				<div class="col-md-6">
					<label class="form-label">Negara</label>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control form-control-sm x-readonly nama_negara" readonly placeholder=""/>
						<input type="hidden" class="form-control form-control-sm kode_negara" name="tpb_header[KODE_NEGARA_PEMASOK]" placeholder=""/>
						<div class="input-group-append">
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_negara_modal"><i class="fal fa-search"></i></button>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<label class="form-label">Pelabuhan Muat</label>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control form-control-sm x-readonly nama_pelabuhan_muat" readonly placeholder=""/>
						<input type="hidden" class="form-control form-control-sm kode_pelabuhan_muat" name="tpb_header[KODE_PEL_MUAT]" placeholder=""/>
						<div class="input-group-append">
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_pelabuhan_muat_modal"><i class="fal fa-search"></i></button>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<label class="form-label">Pelabuhan Transit</label>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control form-control-sm x-readonly nama_pelabuhan_transit" readonly placeholder=""/>
						<input type="hidden" class="form-control form-control-sm kode_pelabuhan_transit" name="tpb_header[KODE_PEL_TRANSIT]" placeholder=""/>
						<div class="input-group-append">
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_pelabuhan_transit_modal"><i class="fal fa-search"></i></button>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<label class="form-label">Pelabuhan Bongkar</label>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control form-control-sm x-readonly nama_pelabuhan_bongkar" readonly placeholder=""/>
						<input type="hidden" class="form-control form-control-sm kode_pelabuhan_bongkar" name="tpb_header[KODE_PEL_BONGKAR]" placeholder=""/>
						<input type="hidden" class="form-control form-control-sm kode_kantor_bongkar" name="tpb_header[KODE_KANTOR_BONGKAR]" placeholder=""/>
						<div class="input-group-append">
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_pelabuhan_bongkar_modal"><i class="fal fa-search"></i></button>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<label class="form-label">Nomor Kontainer</label>
					<input type="text" class="form-control form-control-sm" name="tpb_kontainer[NOMOR_KONTAINER]" placeholder=""/>
				</div>
				<div class="col-md-6">
					<label class="form-label">Tipe Kontainer</label>
					<select class="form-control form-control-sm select2" name="tpb_kontainer[KODE_TIPE_KONTAINER]">
						<option value="" disabled selected>Select Data . . .</option>
						<?= createOption($stipe_kontainer, 'KODE_TIPE_KONTAINER', array('URAIAN_TIPE_KONTAINER'), ' - ') ?>
					</select>
				</div>
				<div class="col-md-6">
					<label class="form-label">Ukuran Kontainer</label>
					<select class="form-control form-control-sm select2" name="tpb_kontainer[KODE_UKURAN_KONTAINER]">
						<option value="" disabled selected>Select Data . . .</option>
						<?= createOption($sukuran_kontainer, 'KODE_UKURAN_KONTAINER', array('URAIAN_UKURAN_KONTAINER'), ' - ') ?>
					</select>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<table class="table table-sm table-bordered" style="table-layout: fixed">
				<tr>
					<td class="text-center"><label class="form-label">JENIS PUNGUTAN</label></td>
					<td class="text-center"><label class="form-label">DITANGGUHKAN</label></td>
					<td class="text-center"><label class="form-label">DIBEBASKAN</label></td>
					<td class="text-center"	><label class="form-label">TIDAK DIPUNGUT</label></td>
				</tr>
				<tr>
					<td class="text-center"><label class="form-label">BM</label></td>
					<td>
						<input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="bm_tangguh" name="tpb_pungutan[0][NILAI_PUNGUTAN]">
						<input type="hidden" name="tpb_pungutan[0][JENIS_TARIF]" value="BM">
						<input type="hidden" name="tpb_pungutan[0][KODE_FASILITAS]" value="2">
					</td>
					<td>
						<input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="bm_bebas" name="tpb_pungutan[1][NILAI_PUNGUTAN]">
						<input type="hidden" name="tpb_pungutan[1][JENIS_TARIF]" value="BM">
						<input type="hidden" name="tpb_pungutan[1][KODE_FASILITAS]" value="4">
					</td>
					<td>
						<input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="bm_tidak" name="tpb_pungutan[2][NILAI_PUNGUTAN]">
						<input type="hidden" name="tpb_pungutan[2][JENIS_TARIF]" value="BM">
						<input type="hidden" name="tpb_pungutan[2][KODE_FASILITAS]" value="5">
					</td>
				</tr>
				<tr>
					<td class="text-center"><label class="form-label">BMT</label></td>
					<td>
						<input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="bmt_tangguh" name="tpb_pungutan[3][NILAI_PUNGUTAN]">
						<input type="hidden" name="tpb_pungutan[3][JENIS_TARIF]" value="BMT">
						<input type="hidden" name="tpb_pungutan[3][KODE_FASILITAS]" value="2">
					</td>
					<td>
						<input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="bmt_bebas" name="tpb_pungutan[4][NILAI_PUNGUTAN]">
						<input type="hidden" name="tpb_pungutan[4][JENIS_TARIF]" value="BMT">
						<input type="hidden" name="tpb_pungutan[4][KODE_FASILITAS]" value="4">
					</td>
					<td>
						<input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="bmt_tidak" name="tpb_pungutan[5][NILAI_PUNGUTAN]">
						<input type="hidden" name="tpb_pungutan[5][JENIS_TARIF]" value="BMT">
						<input type="hidden" name="tpb_pungutan[5][KODE_FASILITAS]" value="5">
					</td>
				</tr>
				<tr>
					<td class="text-center"><label class="form-label">CUKAI</label></td>
					<td>
						<input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="cukai_tangguh" name="tpb_pungutan[6][NILAI_PUNGUTAN]">
						<input type="hidden" name="tpb_pungutan[6][JENIS_TARIF]" value="CUKAI">
						<input type="hidden" name="tpb_pungutan[6][KODE_FASILITAS]" value="2">
					</td>
					<td>
						<input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="cukai_bebas" name="tpb_pungutan[7][NILAI_PUNGUTAN]">
						<input type="hidden" name="tpb_pungutan[7][JENIS_TARIF]" value="CUKAI">
						<input type="hidden" name="tpb_pungutan[7][KODE_FASILITAS]" value="4">
					</td>
					<td>
						<input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="cukai_tidak" name="tpb_pungutan[8][NILAI_PUNGUTAN]">
						<input type="hidden" name="tpb_pungutan[8][JENIS_TARIF]" value="CUKAI">
						<input type="hidden" name="tpb_pungutan[8][KODE_FASILITAS]" value="5">
					</td>
				</tr>
				<tr>
					<td class="text-center"><label class="form-label">PPN</label></td>
					<td>
						<input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="ppn_tangguh" name="tpb_pungutan[9][NILAI_PUNGUTAN]">
						<input type="hidden" name="tpb_pungutan[9][JENIS_TARIF]" value="PPN">
						<input type="hidden" name="tpb_pungutan[9][KODE_FASILITAS]" value="2">
					</td>
					<td>
						<input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="ppn_bebas" name="tpb_pungutan[10][NILAI_PUNGUTAN]">
						<input type="hidden" name="tpb_pungutan[10][JENIS_TARIF]" value="PPN">
						<input type="hidden" name="tpb_pungutan[10][KODE_FASILITAS]" value="4">
					</td>
					<td>
						<input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="ppn_tidak" name="tpb_pungutan[11][NILAI_PUNGUTAN]">
						<input type="hidden" name="tpb_pungutan[11][JENIS_TARIF]" value="PPN">
						<input type="hidden" name="tpb_pungutan[11][KODE_FASILITAS]" value="5">
					</td>
				</tr>
				<tr>
					<td class="text-center"><label class="form-label">PPNBM</label></td>
					<td>
						<input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="ppnbm_tangguh" name="tpb_pungutan[12][NILAI_PUNGUTAN]">
						<input type="hidden" name="tpb_pungutan[12][JENIS_TARIF]" value="PPNBM">
						<input type="hidden" name="tpb_pungutan[12][KODE_FASILITAS]" value="2">
					</td>
					<td>
						<input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="ppnbm_bebas" name="tpb_pungutan[13][NILAI_PUNGUTAN]">
						<input type="hidden" name="tpb_pungutan[13][JENIS_TARIF]" value="PPNBM">
						<input type="hidden" name="tpb_pungutan[13][KODE_FASILITAS]" value="4">
					</td>
					<td>
						<input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="ppnbm_tidak" name="tpb_pungutan[14][NILAI_PUNGUTAN]">
						<input type="hidden" name="tpb_pungutan[14][JENIS_TARIF]" value="PPNBM">
						<input type="hidden" name="tpb_pungutan[14][KODE_FASILITAS]" value="5">
					</td>
				</tr>
				<tr>
					<td class="text-center"><label class="form-label">PPH</label></td>
					<td>
						<input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="pph_tangguh" name="tpb_pungutan[15][NILAI_PUNGUTAN]">
						<input type="hidden" name="tpb_pungutan[15][JENIS_TARIF]" value="PPH">
						<input type="hidden" name="tpb_pungutan[15][KODE_FASILITAS]" value="2">
					</td>
					<td>
						<input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="pph_bebas" name="tpb_pungutan[16][NILAI_PUNGUTAN]">
						<input type="hidden" name="tpb_pungutan[16][JENIS_TARIF]" value="PPH">
						<input type="hidden" name="tpb_pungutan[16][KODE_FASILITAS]" value="4">
					</td>
					<td>
						<input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="pph_tidak" name="tpb_pungutan[17][NILAI_PUNGUTAN]">
						<input type="hidden" name="tpb_pungutan[17][JENIS_TARIF]" value="PPH">
						<input type="hidden" name="tpb_pungutan[17][KODE_FASILITAS]" value="5">
					</td>
				</tr>
				<tr>
					<td class="text-center"><label class="form-label">TOTAL</label></td>
					<td><input type="text" class="form-control form-control-sm total_tangguh x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="total_tangguh" name="tpb_header[TOTAL_TANGGUH]"></td>
					<td><input type="text" class="form-control form-control-sm total_bebas x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="total_bebas" name="tpb_header[TOTAL_BEBAS]"></td>
					<td><input type="text" class="form-control form-control-sm total_tidak x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="total_tidak" name="tpb_header[TOTAL_TIDAK_DIPUNGUT]"></td>
				</tr>
			</table>
		</div>
	</div>
</div>
<br>
