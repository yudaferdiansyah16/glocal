<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Production</li>
		<li class="breadcrumb-item">Request Material</li>
		<li class="breadcrumb-item active">Return</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Return Request Material
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-8 col-xl-8">
			<div class="card mb-g">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<form method="post" action="<?=base_url('production/return_request_material/store')?>">
								<div class="form-group row">
									<table class="table table-sm table-borderless" style="table-layout: fixed">
										<tr>
											<td><b>Kode Material Request</b></td>
											<td><b>Tanggal Request</b></td>
											<td><b>Job</b></td>
											<td><b>Tanggal Return</b></td>
										</tr>
										<tr>
											<td>
												<input type="text" class="form-control form-control-sm x-readonly" readonly value="<?=placeValue($requestheader,'kode_mutasi')?>">
											</td>
											<td>
												<input type="text" class="form-control form-control-sm x-readonly" readonly value="<?=placeValue($requestheader,'tanggal_mutasi')?>">
											</td>
											<td>
												<input type="text" class="form-control form-control-sm x-readonly" readonly value="<?=placeValue($jobdt,'no_job')?>">
											</td>
											<td>
												<div class="input-group input-group-sm">
													<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="t_production[tanggal_mutasi]">
													<div class="input-group-append">
														<span class="input-group-text fs-xl">
															<i class="fa fal fa-calendar"></i>
														</span>
													</div>
												</div>
												<input type="hidden" name="t_production[id_detail_dn]" value="<?=placeValue($requestheader,'id_detail_dn')?>">
												<input type="hidden" name="t_production[id_job]" value="<?=placeValue($requestheader,'id_job')?>">
												<input type="hidden" name="t_production[id_master]" value="<?=placeValue($requestheader,'id_production')?>">
												<input type="hidden" name="t_production[id_jenis_mutasi]" value="12">
											</td>
										</tr>
									</table>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="table-responsive">
											<table class="table table-hover table-bordered table-striped table-sm" id="dt_request_add" role="grid">
												<thead>
												<tr>
													<th class="text-center">No</th>
													<th class="text-center">Item Code</th>
													<th class="text-center">Item Name</th>
													<th class="text-center">Qty Sisa</th>
													<th class="text-center">Qty Return</th>
												</tr>
												</thead>
												<tbody>
												<?php $i=1; foreach ($requestdetail as $row) { ?>
													<tr>
														<td class="text-center">
															<?=$i?>
														</td>
														<td>
															<?=placeValue($row,'kode_barang')?>
														</td>
														<td>
															<?=placeValue($row,'nama_barang')?>
														</td>
														<td>
															<?=placeValue($row,'qty_sisa')?>
														</td>
														<td>
															<input type="number" class="form-control form-control-sm" name="tproduction_detail[<?=$i?>][qty]" step="0.01" min="0" max="<?=placeValue($row,'qty_sisa')?>">
															<input type="hidden" name="tproduction_detail[<?=$i?>][id_wh_detail]" value="<?=placeValue($row,'id_wh_detail')?>">
															<input type="hidden" name="tproduction_detail[<?=$i?>][id_job]" value="<?=placeValue($row,'id_job')?>">
															<input type="hidden" name="tproduction_detail[<?=$i?>][SERI_BARANG]" value="<?=placeValue($row,'SERI_BARANG')?>">
															<input type="hidden" name="tproduction_detail[<?=$i?>][id_sub_barang]" value="<?=placeValue($row,'id_sub_barang')?>">
															<input type="hidden" name="tproduction_detail[<?=$i?>][id_jenis_mutasi]" value="12">
														</td>
													</tr>
													<?php $i++; } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="form-group">
									<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
									<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
