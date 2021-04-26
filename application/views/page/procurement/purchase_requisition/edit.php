<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Procurement</li>
		<li class="breadcrumb-item">Purchase Requisition</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Purchase Requisition
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('procurement/purchase_requisition/update')?>">
						<input type="hidden" name="t_pp[id_pp]" value="<?=placeValue($data,'id_pp')?>">
						<input type="hidden" name="deleted_detail_pp" id="deleted_detail_pp">
						<div class="form-group row">
							<div class="col-md-3">
								<label class="form-label">Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="t_pp[tanggal_dibuat]"  value="<?=placeValue($data,'tanggal_dibuat')?>">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label class="form-label">Due Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="t_pp[tanggal_dibutuhkan]"  value="<?=placeValue($data,'tanggal_dibutuhkan')?>">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label">Jenis PP</label>
								<select class="form-control form-control-sm select2" name="t_pp[id_jenis_pp]">
									<option value="" disabled selected>Select Data . . .</option>
									<?=createOption($sjenis_pp, 'id_jenis_pp', array('nama_jenis_pp'), ' - ',$data->id_jenis_pp)?>
								</select>
							</div>
							<div class="col-md-2">
								<label class="form-label">Type</label>
								<select class="form-control form-control-sm select2" name="t_pp[id_jenis_pp_rutinitas]" id="jenis_pp_rutinitas">
									<option value="" disabled selected>Select Data . . .</option>
									<?=createOption($sjenis_pp_rutinitas, 'id_jenis_pp_rutinitas', array('nama_jenis_pp_rutinitas'), ' - ',$data->id_jenis_pp_rutinitas)?>
								</select>
							</div>
							<div class="col-md-2">
								<label class="form-label">Section</label>
								<select class="form-control form-control-sm select2" name="t_pp[id_bagian]">
									<option value="" disabled selected>Select Data . . .</option>
									<?=createOption($sbagian, 'id_bagian', array('nama_bagian'), ' - ',$data->id_bagian)?>
								</select>
							</div>
						</div>
						<div class="form-group row jenis_pp_rutinitas_template x-hidden include-1">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-hover table-bordered table-striped table-sm" id="dt_pp_rutin_add" role="grid">
										<thead>
										<tr>
											<th class="text-center">No</th>
											<th class="text-center">No Job</th>
											<th class="text-center">Nama Barang</th>
											<th class="text-center">Quantity</th>
											<th class="text-center">Remark</th>
											<th class="text-center">
												<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#t_detail_job_pp_modal"><i class="fal fa-plus-circle"></i></button>
											</th>
										</tr>
										</thead>
										<tbody>
										<?php if ($data->id_jenis_pp_rutinitas==1) { $i=0;?>
											<?php foreach ($detail as $r) { $i++;?>
												<tr data-index="<?=$i?>">
													<td class="text-center"><?=$i?></td>
													<td>
														<p id="no_job"><?=$r->no_job?></p>
											<!--			<input type="text" class="form-control form-control-sm x-readonly no_job" readonly placeholder=""/>-->
														<input type="hidden" class="id_detail_pp" name="t_detail_pp[<?=$i?>][id_detail_pp]" value="<?=$r->id_detail_pp?>">
														<input type="hidden" class="id_detail_job" name="t_detail_pp[<?=$i?>][id_detail_job]" value="<?=$r->id_detail_job?>">
														<input type="hidden" class="id_sub_barang" name="t_detail_pp[<?=$i?>][id_sub_barang]" value="<?=$r->id_sub_barang?>">
													</td>
													<td>
														<?=$r->barang?>
											<!--			<input type="text" class="form-control form-control-sm x-readonly nama_barang" readonly placeholder=""/>-->
													</td>
													<td>
														<input type="number" class="form-control form-control-sm qty_pp" name="t_detail_pp[<?=$i?>][qty_pp]" step="0.001" min="0" max="" value="<?=$r->qty?>"/>
													</td>
													<td>
														<input type="text" class="form-control form-control-sm keterangan" name="t_detail_pp[<?=$i?>][keterangan]" value="<?=$r->keterangan?>"/>
													</td>
													<td class="text-center">
														<button type="button" class="btn btn-xs btn-danger btn-delete"><i class="fa fal fa-trash"></i></button>
													</td>
												</tr>
											<?php } ?>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="form-group row jenis_pp_rutinitas_template x-hidden include-2 include-3 include-4">
							<div class="col-md-3">
								<label class="form-label">Filter Class</label>
								<select class="form-control form-control-sm select2 classFilter">
									<option selected disabled>Select Class . . .</option>
									<?=createOption($sclass,'id_class',array('nama_class'),'-')?>
								</select>
							</div>
						</div>
						<div class="form-group row jenis_pp_rutinitas_template x-hidden include-2 include-3 include-4">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-hover table-bordered table-striped table-sm dt_pp_non_add" id="dt_pp_non_add" role="grid">
										<thead>
										<tr>
											<th class="text-center">No</th>
											<th class="text-center">Nama Barang</th>
											<th class="text-center">Brand</th>
											<th class="text-center">Quantity</th>
											<th class="text-center">Remark</th>
											<th class="text-center">
												<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#m_sub_barang_modal"><i class="fal fa-plus-circle"></i></button>
											</th>
										</tr>
										</thead>
										<tbody>
										<?php if ($data->id_jenis_pp_rutinitas!=1) { $i=0;?>
											<?php foreach ($detail as $r) { $i++;?>
												<tr data-index="<?=$i?>">
													<td class="text-center"><?=$i?></td>
													<td>
														<?=$r->barang?>
											<!--			<input type="text" class="form-control form-control-sm x-readonly nama_barang" readonly placeholder=""/>-->
													</td>
													<td>
														<?=$r->nama_brand?>
											<!--			<input type="text" class="form-control form-control-sm x-readonly nama_barang" readonly placeholder=""/>-->
													</td>
													<td>
														<input type="hidden" class="id_detail_pp" name="t_detail_pp[<?=$i?>][id_detail_pp]" value="<?=$r->id_detail_pp?>">
														<input type="hidden" class="id_sub_barang" name="t_detail_pp[<?=$i?>][id_sub_barang]" value="<?=$r->id_sub_barang?>">
														<input type="number" class="form-control form-control-sm qty_pp" name="t_detail_pp[<?=$i?>][qty_pp]" step="0.001" min="0" max="" value="<?=$r->qty?>"/>
													</td>
													<td>
														<input type="text" class="form-control form-control-sm keterangan" name="t_detail_pp[<?=$i?>][keterangan]" value="<?=$r->keterangan?>"/>
													</td>
													<td class="text-center">
														<button type="button" class="btn btn-xs btn-danger btn-delete"><i class="fa fal fa-trash"></i></button>
													</td>
												</tr>
											<?php } ?>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
							<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?> 	</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
<table class="x-hidden" id="template-row-rutin">
	<tbody>
	<tr data-index="x">
		<td class="text-center">1</td>
		<td>
			<p id="no_job"></p>
<!--			<input type="text" class="form-control form-control-sm x-readonly no_job" readonly placeholder=""/>-->
			<input type="hidden" class="id_detail_job" name="t_detail_pp[x][id_detail_job]">
			<input type="hidden" class="id_sub_barang" name="t_detail_pp[x][id_sub_barang]">
		</td>
		<td>
			<p id="nama_barang" style="margin: 0;padding: 0"></p>
			<small id="kode_barang" style="margin: 0;padding: 0"></small>
<!--			<input type="text" class="form-control form-control-sm x-readonly nama_barang" readonly placeholder=""/>-->
		</td>
		<td>
			<input type="number" class="form-control form-control-sm qty_pp" name="t_detail_pp[x][qty_pp]" step="0.001" min="0" max=""/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm keterangan" name="t_detail_pp[x][keterangan]" placeholder=""/>
		</td>
		<td class="text-center">
			<button type="button" class="btn btn-xs btn-danger btn-delete"><i class="fa fal fa-trash"></i></button>
		</td>
	</tr>
	</tbody>
</table>
<table class="x-hidden" id="template-row-non">
	<tbody>
	<tr data-index="x">
		<td class="text-center">1</td>
		<td>
			<p style="margin: 0;padding:0;" class="text_nama_barang"></p>
			<small style="margin: 0;padding:0;" class="text_kode_barang"></small>
			<input type="hidden" class="id_sub_barang" name="t_detail_pp[x][id_sub_barang]">
		</td>
		<td>
			<p style="margin: 0;padding:0;" class="text_nama_brand"></p>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm qty_pp input-mask" name="t_detail_pp[x][qty_pp]" placeholder="" data-inputmask="'alias': 'currency', 'prefix': ''"/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm keterangan" name="t_detail_pp[x][keterangan]" placeholder=""/>
		</td>
		<td class="text-center">
			<button type="button" class="btn btn-xs btn-danger btn-delete"><i class="fa fal fa-trash"></i></button>
		</td>
	</tr>
	</tbody>
</table>
<script>
	let lastindex = <?=$i?>;
</script>
