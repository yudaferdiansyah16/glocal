<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Production</li>
		<li class="breadcrumb-item">Packing</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Packing
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?= base_url('production/packing/store') ?>">
						<div class="form-group row">
							<div class="col-md-6">
								<label class="form-label">No Job</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly no_job" readonly>
									<input type="hidden" class="id_job" name="t_production[id_job]" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#t_job_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label">Tanggal</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="t_production[tanggal_mutasi]">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-sm-12 col-lg-12 col-xl-12">
							<dl class="row">
								<dt class="col-sm-12 col-lg-1 col-xl-1">Customer</dt>
								<dd class="col-sm-12 col-lg-5 col-xl-5">
									<input type="text" class="form-control form-control-sm vcustomer" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-1 col-xl-1">No. PO</dt>
								<dd class="col-sm-12 col-lg-5 col-xl-5">
									<input type="text" class="form-control form-control-sm vpo" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-1 col-xl-1">FG</dt>
								<dd class="col-sm-12 col-lg-5 col-xl-5">
									<input type="text" class="form-control form-control-sm vfg" disabled>
								</dd>
								<dt class="col-sm-12 col-lg-1 col-xl-1">Qty Order</dt>
								<dd class="col-sm-12 col-lg-5 col-xl-5">
									<input type="text" class="form-control form-control-sm vqty" disabled>
								</dd>
							</dl>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<ul class="nav nav-tabs" id="myTab" role="tablist">
											<li class="nav-item">
												<a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab_fg" role="tab" aria-controls="tab_fg" aria-selected="true">Repacking FG</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="contact-tab" data-toggle="tab" href="#tab_wip" role="tab" aria-controls="tab_wip" aria-selected="false">WIP</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab_scrap" role="tab" aria-controls="tab_scrap" aria-selected="false">SCRAP</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab_waste" role="tab" aria-controls="tab_waste" aria-selected="false">Waste</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="contact-tab" data-toggle="tab" href="#tab_loss" role="tab" aria-controls="tab_loss" aria-selected="false">Loss</a>
											</li>
										</ul>
										<div class="tab-content" id="myTabContent">
										<div class="tab-pane fade" id="tab_fg" role="tabpanel" aria-labelledby="profile-tab">
												<div class="row" style="margin-top: 15px;">
													<div class="col-md-12">
														<div class="table-responsive">
															<table id="dt_fg" class="table table-sm table-bordered table-striped table-hover" width="100%">
																<thead>
																	<tr class="text-center">
																		<th rowspan="2">No.</th>
																		<th colspan="5">Barang</th>
																	</tr>
																	<tr class="text-center">
																		<th>Nama</th>
																		<th>Kode</th>
																		<th>Satuan</th>
																		<th>Qty Order</th>
																		<th>Result</th>
																	</tr>
																</thead>
																<tbody>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="tab_wip" role="tabpanel" aria-labelledby="contact-tab">
												<div class="row" style="margin-top: 15px;">
													<div class="col-md-12">
														<div class="table-responsive">
															<table id="dt_wip" class="table table-sm table-bordered table-striped table-hover">
																<thead>
																	<tr class="text-center">
																		<th rowspan="2">No.</th>
																		<th rowspan="2">No Request / Bon Bahan</th>
																		<th rowspan="2">No Job</th>
																		<th colspan="4">Barang</th>
																		<!-- <th class="text-center" rowspan="2" width="80px">Add Item<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#t_production_detail_realisasi_wip_modal"><i class="fal fa-plus-circle"></i></button></th> -->
																	</tr>
																	<tr class="text-center">
																		<th>Nama</th>
																		<th>Kode</th>
																		<th>Satuan</th>
																		<th>Realisasi</th>
																	</tr>
																</thead>
																<tbody>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="tab_scrap" role="tabpanel" aria-labelledby="profile-tab">
												<div class="row" style="margin-top: 15px;">
													<div class="col-md-12">
														<div class="table-responsive">
															<table class="table table-sm table-bordered table-striped table-hover">
																<thead>
																	<tr class="text-center">
																		<th rowspan="2">No.</th>
																		<th rowspan="2">No Request / Bon Bahan</th>
																		<th rowspan="2">No Job</th>
																		<th colspan="4">Barang</th>
																		<th class="text-center" rowspan="2" width="80px">Add Item<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#t_production_detail_realisasi_scrap_modal"><i class="fal fa-plus-circle"></i></button></th>
																	</tr>
																	<tr class="text-center">
																		<th>Nama</th>
																		<th>Kode</th>
																		<th>Satuan</th>
																		<th>Realisasi</th>
																	</tr>
																</thead>
																<tbody>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="tab_waste" role="tabpanel" aria-labelledby="profile-tab">
												<div class="row" style="margin-top: 15px;">
													<div class="col-md-12">
														<div class="table-responsive">
															<table class="table table-sm table-bordered table-striped table-hover">
																<thead>
																	<tr class="text-center">
																		<th rowspan="2">No.</th>
																		<th rowspan="2">No Request / Bon Bahan</th>
																		<th rowspan="2">No Job</th>
																		<th colspan="4">Barang</th>
																		<th class="text-center" rowspan="2" width="80px">Add Item<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#t_production_detail_realisasi_waste_modal"><i class="fal fa-plus-circle"></i></button></th>
																	</tr>
																	<tr class="text-center">
																		<th>Nama</th>
																		<th>Kode</th>
																		<th>Satuan</th>
																		<th>Realisasi</th>
																	</tr>
																</thead>

																<tbody>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="tab_loss" role="tabpanel" aria-labelledby="contact-tab">
												<div class="row" style="margin-top: 15px;">
													<div class="col-md-12">
														<div class="table-responsive">
															<table class="table table-sm table-bordered table-striped table-hover">
																<thead>
																	<tr class="text-center">
																		<th rowspan="2">No.</th>
																		<th rowspan="2">No Request / Bon Bahan</th>
																		<th rowspan="2">No Job</th>
																		<th colspan="4">Barang</th>
																		<th class="text-center" rowspan="2" width="80px">Add Item<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#t_production_detail_realisasi_loss_modal"><i class="fal fa-plus-circle"></i></button></th>
																	</tr>
																	<tr class="text-center">
																		<th>Nama</th>
																		<th>Kode</th>
																		<th>Satuan</th>
																		<th>QTY</th>
																	</tr>
																</thead>
																<tbody>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<a href="<?= base_url($_controller . '/' . $_method) ?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?= $this->lang->line('button_cancel') ?></a>
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?= $this->lang->line('button_save') ?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>

<table class="x-hidden table_template_fg">
	<tbody>
	<tr data-index="x">
		<td class="text-center">1</td>
		<td class="text-center">
			<p class="text_kode_produksi_wip"></p>
		</td>
		<!-- <td class="text-center">
			<p class="text_no_job_wip"></p>
			<input type="hidden" class="id_job_wip" name="t_production_detail_wip[x][id_job]"/>
		</td> -->
		<td>
			<p class="text_nama_barang_fg" style="margin: 0;padding: 0"></p>
			<small class="text_kode_barang_fg" style="margin: 0;padding: 0"></small>
			<input type="hidden" class="id_sub_barang_fg" name="t_production_detail_fg[x][id_sub_barang]"/>
			<input type="hidden" class="seri_barang_fg" name="t_production_detail_fg[x][seri_barang]"/>
			<input type="hidden" class="id_wh_detail_fg" name="t_production_detail_fg[x][id_wh_detail]"/>
			
		</td>
		<td class="text-center">
			<p class="text_satuan_fg"></p>
		</td>
		<td>
			<input type="hidden" class="form-control form-control-sm qty_fg" step="0.01" min="0" name="t_production_detail_fg[x][qty]"/>
		</td>
		<td class="text-center">
			<button class="btn btn-xs btn-danger btn-delete-row"><i class="fa fal fa-trash"></i></button>
		</td>
	</tr>
	</tbody>
</table>


<table class="x-hidden table_template_wip">
	<tbody>
	<tr data-index="x">
		<td class="text-center">1</td>
		<td class="text-center">
			<p class="text_kode_produksi_wip"></p>
		</td>
		<td class="text-center">
			<p class="text_no_job_wip"></p>
			<input type="hidden" class="id_job_wip" name="t_production_detail_wip[x][id_job]"/>
		</td>
		<td>
			<p class="text_nama_barang_wip" style="margin: 0;padding: 0"></p>
			<small class="text_kode_barang_wip" style="margin: 0;padding: 0"></small>
			<input type="hidden" class="id_sub_barang_wip" name="t_production_detail_wip[x][id_sub_barang]"/>
			<input type="hidden" class="tanggal_mutasi" name="t_production[tanggal_mutasi]"/>
			<input type="hidden" class="seri_barang_wip" name="t_production_detail_wip[x][seri_barang]"/>
			<input type="hidden" class="id_wh_detail_wip" name="t_production_detail_wip[x][id_wh_detail]"/>
		</td>
		<td class="text-center">
			<p class="text_satuan_wip"></p>
		</td>
		<td>
			<input type="number" class="form-control form-control-sm qty_wip" step="0.01" min="0" name="t_production_detail_wip[x][qty]"/>
		</td>
		<td class="text-center">
			<button class="btn btn-xs btn-danger btn-delete-row"><i class="fa fal fa-trash"></i></button>
		</td>
	</tr>
	</tbody>
</table>

<table class="x-hidden table_template_scrap">
	<tbody>
	<tr data-index="x">
		<td class="text-center">1</td>
		<td class="text-center">
			<p class="text_kode_produksi_scrap"></p>
		</td>
		<td class="text-center">
			<p class="text_no_job_scrap"></p>
			<input type="hidden" class="id_job_scrap" name="t_production_detail_scrap[x][id_job]"/>
		</td>
		<td>
			<p class="text_nama_barang_scrap" style="margin: 0;padding: 0"></p>
			<small class="text_kode_barang_scrap" style="margin: 0;padding: 0"></small>
			<input type="hidden" class="id_sub_barang_scrap" name="t_production_detail_scrap[x][id_sub_barang]"/>
			<input type="hidden" class="seri_barang_scrap" name="t_production_detail_scrap[x][seri_barang]"/>
			<input type="hidden" class="id_wh_detail_scrap" name="t_production_detail_scrap[x][id_wh_detail]"/>
		</td>
		<td class="text-center">
			<p class="text_satuan_scrap"></p>
		</td>
		<td>
			<input type="number" class="form-control form-control-sm qty_scrap" step="0.01" min="0" name="t_production_detail_scrap[x][qty]"/>
		</td>
		<td class="text-center">
			<button class="btn btn-xs btn-danger btn-delete-row"><i class="fa fal fa-trash"></i></button>
		</td>
	</tr>
	</tbody>
</table>

<table class="x-hidden table_template_waste">
	<tbody>
	<tr data-index="x">
		<td class="text-center">1</td>
		<td class="text-center">
			<p class="text_kode_produksi_waste"></p>
		</td>
		<td class="text-center">
			<p class="text_no_job_waste"></p>
			<input type="hidden" class="id_job_waste" name="t_production_detail_waste[x][id_job]"/>
		</td>
		<td>
			<p class="text_nama_barang_waste" style="margin: 0;padding: 0"></p>
			<small class="text_kode_barang_waste" style="margin: 0;padding: 0"></small>
			<input type="hidden" class="id_sub_barang_waste" name="t_production_detail_waste[x][id_sub_barang]"/>
			<input type="hidden" class="seri_barang_waste" name="t_production_detail_waste[x][seri_barang]"/>
			<input type="hidden" class="id_wh_detail_waste" name="t_production_detail_waste[x][id_wh_detail]"/>
		</td>
		<td class="text-center">
			<p class="text_satuan_waste"></p>
		</td>
		<td>
			<input type="number" class="form-control form-control-sm qty_waste" step="0.01" min="0" name="t_production_detail_waste[x][qty]"/>
		</td>
		<td class="text-center">
			<button class="btn btn-xs btn-danger btn-delete-row"><i class="fa fal fa-trash"></i></button>
		</td>
	</tr>
	</tbody>
</table>


<table class="x-hidden table_template_loss">
	<tbody>
	<tr data-index="x">
		<td class="text-center">1</td>
		<td class="text-center">
			<p class="text_kode_produksi_loss"></p>
		</td>
		<td class="text-center">
			<p class="text_no_job_loss"></p>
			<input type="hidden" class="id_job_loss" name="t_production_detail_loss[x][id_job]"/>
		</td>
		<td>
			<p class="text_nama_barang_loss" style="margin: 0;padding: 0"></p>
			<small class="text_kode_barang_loss" style="margin: 0;padding: 0"></small>
			<input type="hidden" class="id_sub_barang_loss" name="t_production_detail_loss[x][id_sub_barang]"/>
			<input type="hidden" class="seri_barang_loss" name="t_production_detail_loss[x][seri_barang]"/>
			<input type="hidden" class="id_wh_detail_loss" name="t_production_detail_loss[x][id_wh_detail]"/>
		</td>
		<td class="text-center">
			<p class="text_satuan_loss"></p>
		</td>
		<td>
			<input type="number" class="form-control form-control-sm qty_loss" step="0.01" min="0" name="t_production_detail_loss[x][qty]"/>
		</td>
		<td class="text-center">
			<button class="btn btn-xs btn-danger btn-delete-row"><i class="fa fal fa-trash"></i></button>
		</td>
	</tr>
	</tbody>
</table>

