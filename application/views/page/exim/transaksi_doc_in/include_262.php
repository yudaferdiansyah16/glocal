<div class="x-hidden dokumen_template include-262">
	<div class="form-group row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
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
					<label class="form-label">NDPBM</label>
					<input type="text" class="form-control form-control-sm input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" name="tpb_header[NDPBM]" placeholder="" />
				</div>
				<div class="col-md-6 ">
					<label class="form-label">Valuta</label>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control form-control-sm x-readonly nama_valuta" readonly
							placeholder="" />
						<input type="hidden" class="form-control form-control-sm id_valuta"
							name="tpb_header[KODE_VALUTA]" placeholder="" />
						<div class="input-group-append">
							<button type="button" class="btn btn-default" data-toggle="modal"
								data-target="#referensi_valuta_modal"><i class="fal fa-search"></i></button>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<label class="form-label">Nama Sarana Pengangkutan</label>
					<input type="text" class="form-control form-control-sm" name="tpb_header[NAMA_PENGANGKUT]"
						placeholder="" />
				</div>
				<div class="col-md-6">
					<label class="form-label">Nilai CIF</label>
					<input type="text" class="form-control form-control-sm input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" name="tpb_header[CIF]" placeholder="" />
				</div>
				<div class="col-md-6">
					<label class="form-label">Nilai CIF Rupiah</label>
					<input type="text" class="form-control form-control-sm input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" name="tpb_header[CIF_RUPIAH]"
						placeholder="" />
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<label><b>Jaminan</b></label>
			<div class="table-responsive">
				<table class="table table-hover table-bordered table-striped table-sm dt_" id="table_detail_262"
					role="grid">
					<thead>
						<tr>
							<th class="text-center" style="width: 15%">Jenis Jaminan</th>
							<th class="text-center">Nomor</th>
							<th class="text-center">Tanggal</th>
							<th class="text-center">Nilai</th>
							<th class="text-center">Jatuh Tempo</th>
							<th class="text-center">Penjamin</th>
							<th class="text-center">Nomor BPJ</th>
							<th class="text-center">Tanggal BPJ</th>
							<th class="text-center">Dokumen BC 2.6.1</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<select class="form-control form-control-sm mselect2"
									name="tpb_jaminan[KODE_JENIS_JAMINAN]">
									<option value="" disabled selected>Select Data . . .</option>
									<?= createOption($sjenis_jaminan, 'KODE_JENIS_JAMINAN', array('URAIAN_JENIS_JAMINAN'), ' - ', 7) ?>
								</select>
							</td>
							<td>
								<input type="text" class="form-control form-control-sm"
									name="tpb_jaminan[NOMOR_JAMINAN]" placeholder="" />
							</td>
							<td>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly"
										readonly placeholder="Select date" name="tpb_jaminan[TANGGAL_JAMINAN]">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</td>
							<td>
								<input type="text" class="form-control form-control-sm input-mask"
									data-inputmask="'alias': 'currency', 'prefix': ''" name="tpb_jaminan[NILAI_JAMINAN]"
									placeholder="" />
							</td>
							<td>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly"
										readonly placeholder="Select date" name="tpb_jaminan[TANGGAL_JATUH_TEMPO]">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</td>
							<td>
								<input type="text" class="form-control form-control-sm" name="tpb_jaminan[PENJAMIN]"
									placeholder="" />
							</td>
							<td>
								<input type="text" class="form-control form-control-sm" name="tpb_jaminan[NOMOR_BPJ]"
									placeholder="" />
							</td>
							<td>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly"
										readonly placeholder="Select date" name="tpb_jaminan[TANGGAL_BPJ]">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</td>
							<td>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm 261_nodoc"
										name="tpb_dokumen[2][NOMOR_DOKUMEN]" placeholder="" />
									<input type="hidden" name="tpb_dokumen[2][KODE_JENIS_DOKUMEN]" value="261" />
									<input type="hidden" name="tpb_dokumen[2][TIPE_DOKUMEN]" value="01" />
									<input type="hidden" class="261_tanggal" name="tpb_dokumen[2][TANGGAL_DOKUMEN]" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal"
											data-target="#bc_261_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-12">
			<label><b>Referensi Barang Dari BC 2.6.1</b></label>
			<div class="table-responsive">
				<table class="table table-hover table-bordered table-striped table-sm dt_inv_add" id="dt_referensi_261"
					style="white-space: nowrap">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Kode Barang</th>
							<th class="text-center">Nama Barang</th>
							<th class="text-center">Quantity</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>