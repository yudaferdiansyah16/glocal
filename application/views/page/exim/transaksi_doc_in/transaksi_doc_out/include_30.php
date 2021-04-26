<div class="x-hidden dokumen_template include-30" id="30">
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
				<div class="col-md-6">
					<label class="form-label">Kategori Export</label>
					<input type="text" class="form-control form-control-sm" name="kategori_eksport" placeholder=""/>
				</div>
				<div class="col-md-6">
					<label class="form-label">Cara Perdagangan</label>
					<input type="text" class="form-control form-control-sm" name="cara_perdagangan" placeholder=""/>
				</div>
				<div class="col-md-6">
					<label class="form-label">Cara Pembayaran</label>
					<select class="form-control form-control-sm select2" name="tpb_header[KODE_CARA_BAYAR]">
						<option value="" disabled selected>Select Data . . .</option>
						<?= createOption($scara_bayar, 'KODE_CARA_BAYAR', array('URAIAN_CARA_BAYAR'), ' - ') ?>
					</select>
				</div>
				<div class="col-md-6">
					<label class="form-label">
						Cara Pengangkutan
					</label>
					<select class="form-control form-control-sm select2" name="tpb_header[KODE_CARA_ANGKUT]">
						<option value="" disabled selected>Select Data . . .</option>
						<?= createOption($scara_angkut, 'ID', array('URAIAN_CARA_ANGKUT'), ' - ') ?>
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
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="row">
				<div class="col-md-6">
					<label class="form-label">Pelabuhan Muat</label>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control form-control-sm x-readonly nama_pelabuhan_muat" readonly placeholder=""/>
						<input type="hidden" class="form-control form-control-sm kode_pelabuhan_muat" name="tpb_header[KODE_PEL_MUAT]" placeholder=""/>
						<div class="input-group-append">
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_pelabuhan_muat_modal"><i class="fal fa-search"></i></button>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<label class="form-label">Pelabuhan Muat Eksport</label>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control form-control-sm x-readonly nama_pelabuhan_muat_eksport" readonly placeholder=""/>
						<input type="hidden" class="form-control form-control-sm kode_pelabuhan_muat_eksport" name="tpb_header[KODE_PEL_MUAT_EKSPORT]" placeholder=""/>
						<div class="input-group-append">
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_pelabuhan_eksport_modal"><i class="fal fa-search"></i></button>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<label class="form-label">Pelabuhan Transit</label>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control form-control-sm x-readonly nama_pelabuhan_transit" readonly placeholder=""/>
						<input type="hidden" class="form-control form-control-sm kode_pelabuhan_transit" name="tpb_header[KODE_PEL_TRANSIT]" placeholder=""/>
						<div class="input-group-append">
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_pelabuhan_transit_modal"><i class="fal fa-search"></i></button>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<label class="form-label">Pelabuhan Bongkar</label>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control form-control-sm x-readonly nama_pelabuhan_bongkar" readonly placeholder=""/>
						<input type="hidden" class="form-control form-control-sm kode_pelabuhan_bongkar" name="tpb_header[KODE_PEL_BONGKAR]" placeholder=""/>
						<div class="input-group-append">
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_pelabuhan_bongkar_modal"><i class="fal fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="row">
				<div class="col-md-12">
					<label class="form-label">Nomor Kontainer</label>
					<input type="text" class="form-control form-control-sm" name="tpb_kontainer[NOMOR_KONTAINER]"/>
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
	</div>
</div>
<br>
