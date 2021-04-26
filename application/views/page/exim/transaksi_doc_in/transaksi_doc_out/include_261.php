<br>
<div class="x-hidden dokumen_template include-261">
	<div class="form-group row">
		<div class="col-md-12">
			<label class="form-label">Jaminan</label>
			<div class="table-responsive">
				<table class="table table-hover table-bordered table-striped table-sm dt_" id="table_detail_261" role="grid" style="table-layout: fixed">
					<thead>
					<tr>
						<th class="text-center" width="50px">
							<button type="button" class="btn btn-success btn-xs btn-add-row-261"><i class="fa fal fa-plus-circle"></i></button>
						</th>
						<th class="text-center" width="50px">No</th>
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
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<table class="x-hidden table_template_261">
	<tbody>
	<tr data-index="x">
		<td class="text-center">
			<button class="btn btn-xs btn-danger btn-delete-row-261"><i class="fa fal fa-trash"></i></button>
		</td>
		<td class="text-center"></td>
		<td>
			<select class="form-control form-control-sm mselect2" name="tpb_jaminan[x][KODE_JENIS_JAMINAN]">
				<option value="" disabled selected>Select Data . . .</option>
				<?= createOption($sjenis_jaminan, 'KODE_JENIS_JAMINAN', array('URAIAN_JENIS_JAMINAN'), ' - ', 7) ?>
			</select>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="tpb_jaminan[x][NOMOR_JAMINAN]" placeholder=""/>
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" class="form-control form-control-sm x-datepicker x-readonly"
					   readonly placeholder="Select date" name="tpb_jaminan[x][TANGGAL_JAMINAN]">
				<div class="input-group-append">
					<span class="input-group-text fs-xl">
						<i class="fa fal fa-calendar"></i>
					</span>
				</div>
			</div>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="tpb_jaminan[x][NILAI_JAMINAN]" placeholder=""/>
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" class="form-control form-control-sm x-datepicker x-readonly"
					   readonly placeholder="Select date" name="tpb_jaminan[x][TANGGAL_JATUH_TEMPO]">
				<div class="input-group-append">
					<span class="input-group-text fs-xl">
						<i class="fa fal fa-calendar"></i>
					</span>
				</div>
			</div>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="tpb_jaminan[x][PENJAMIN]" placeholder=""/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="tpb_jaminan[x][NOMOR_BPJ]" placeholder=""/>
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" class="form-control form-control-sm x-datepicker x-readonly"
					   readonly placeholder="Select date" name="tpb_jaminan[x][TANGGAL_BPJ]">
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
