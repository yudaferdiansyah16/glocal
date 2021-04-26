<br>
<div class="x-hidden dokumen_template include-261">
	<div class="form-group row">
		<div class="col-md-12">
			<label class="form-label">Jaminan</label>
			<div class="table-responsive">
				<table class="table table-hover table-bordered table-striped table-sm dt_" id="table_detail_261" role="grid" style="table-layout: fixed">
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
					</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<select class="form-control form-control-sm select2" name="tpb_jaminan[KODE_JENIS_JAMINAN]">
									<option value="" disabled selected>Select Data . . .</option>
									<?= createOption($sjenis_jaminan, 'KODE_JENIS_JAMINAN', array('URAIAN_JENIS_JAMINAN'), ' - ', 7) ?>
								</select>
							</td>
							<td>
								<input type="text" class="form-control form-control-sm" name="tpb_jaminan[NOMOR_JAMINAN]" placeholder=""/>
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
								<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" name="tpb_jaminan[NILAI_JAMINAN]" placeholder=""/>
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
								<input type="text" class="form-control form-control-sm" name="tpb_jaminan[PENJAMIN]" placeholder=""/>
							</td>
							<td>
								<input type="text" class="form-control form-control-sm" name="tpb_jaminan[NOMOR_BPJ]" placeholder=""/>
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
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>