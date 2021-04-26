<div class="form-group row">
	<div class="col-sm-12 col-lg-12 col-xl-12">
		<div class="row">
			<div class="col-md-3 x-hidden dokumen_template include-25 include-30 include-261 include-27">
				<label class="form-label">NDPBM</label>
				<input type="text" class="form-control form-control-sm" name="tpb_header[NDPBM]" placeholder=""/>
			</div>
			<div class="col-md-3 x-hidden dokumen_template include-25 include-30 include-261 include-27">
				<label class="form-label">Valuta</label>
				<div class="input-group input-group-sm">
					<input type="text" class="form-control form-control-sm x-readonly nama_valuta" readonly placeholder=""/>
					<input type="hidden" class="form-control form-control-sm id_valuta" name="tpb_header[KODE_VALUTA]" placeholder=""/>
					<div class="input-group-append">
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_valuta_modal"><i class="fal fa-search"></i></button>
					</div>
				</div>
			</div>
			<div class="col-md-3 x-hidden dokumen_template include-27">
				<label class="form-label">Nama Sarana Pengangkutan</label>
				<input type="text" class="form-control form-control-sm" name="tpb_header[NAMA_PENGANGKUT_27]" placeholder=""/>
			</div>
			<div class="col-md-3 x-hidden dokumen_template include-41">
				<label class="form-label">Nama Sarana Pengangkutan</label>
				<input type="text" class="form-control form-control-sm" name="tpb_header[NAMA_PENGANGKUT_41]" placeholder=""/>
			</div>
			<div class="col-md-3 x-hidden dokumen_template include-41">
				<label class="form-label">Nomor Polisi</label>
				<input type="text" class="form-control form-control-sm" name="tpb_header[NOMOR_POLISI]"/>
			</div>
			<div class="col-md-3 x-hidden dokumen_template include-25 include-30 include-261">
				<label class="form-label">
					Cara Pengangkutan
				</label>
				<select class="form-control form-control-sm select2" name="tpb_header[KODE_CARA_ANGKUT]">
					<option value="" disabled selected>Select Data . . .</option>
					<?= createOption($scara_angkut, 'KODE_CARA_ANGKUT', array('URAIAN_CARA_ANGKUT'), ' - ') ?>
				</select>
			</div>
			<div class="col-md-3 x-hidden dokumen_template include-25 include-30">
				<label class="form-label">
					Lokasi Bayar
				</label>
				<select class="form-control form-control-sm select2" name="tpb_header[KODE_LOKASI_BAYAR]">
					<option value="" disabled selected>Select Data . . .</option>
					<?= createOption($slokasi_bayar, 'KODE_LOKASI_BAYAR', array('URAIAN_LOKASI_BAYAR'), ' - ') ?>
				</select>
			</div>
		</div>
	</div>
</div>
