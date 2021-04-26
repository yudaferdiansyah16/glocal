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
					<form method="post" action="<?=base_url('production/packing/store')?>" autocomplete="off">
						<div class="form-group row">
							<div class="col-md-2">
								<label class="form-label">Packing Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" placeholder="Select date" name="t_production[tanggal_mutasi]" required>
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label class="form-label">Job Number</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly no_job" readonly placeholder="Select job...">
									<input type="hidden" class="id_job" name="t_production[id_job]"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#t_job_packing_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-7">
								<label class="form-label">FG Product</label>
								<input type="text" class="form-control form-control form-control-sm x-readonly nama_barang" readonly placeholder="FG Product...">
								<input type="hidden" class="id_sub_barang" name="t_wh_detail[0][id_sub_barang]" value="">
								<input type="hidden" class="rate" name="t_wh_detail[0][rate]" value="1">
							</div>
						</div>
						<div class="form-group row">
							<div class="form-group col-md-2">
								<label class="form-label">Quantity</label>
								<div class="input-group input-group-sm">
									<input type="hidden" class="id_satuan_fg" name="t_wh_detail[0][id_satuan_terkecil]"/>
									<input type="hidden" class="id_satuan_fg" name="t_wh_detail[0][id_satuan_terbesar]"/>
									<input type="text" name="t_wh_detail[0][qty]" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''"/>
									<div class="input-group-append">
										<span class="input-group-text kode_satuan"></span>
									</div>
								</div>
							</div>
							<!--<div class="form-group col-md-2">
								<label class="form-label">Pack Quantity</label>
								<div class="input-group input-group-sm">
									<input type="hidden" class="id_kemasan" name="t_wh_detail[0][id_kemasan]"/>
									<input type="text" name="t_wh_detail[0][qty_mc]" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': '', 'digits': '0'"/>
									<div class="input-group-append">
										<span class="input-group-text kode_kemasan"></span>
									</div>
								</div>
							</div>-->
							<!--<div class="form-group col-md-2">
								<label class="form-label">Estimated Price</label>
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text kode_valuta">IDR</span>
									</div>
									<input type="text" name="t_wh_detail[0][harga_satuan]" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': '', 'digits': '0'" value="0"/>
								</div>
							</div>-->
							<div class="form-group col-md-3">
								<label class="form-label">Warehouse</label>
								<select class="form-control form-control-sm id_gudang" name="t_wh_detail[0][id_gudang]" required>
									<option value="">Choose Warehouse...</option>
									<?=createOption($m_gudang, 'id_gudang', array('nama_gudang'),'-')?>
								</select>
							</div>
							<div class="form-group col-md-2">
								<label class="form-label">Coordinate</label>
								<input type="text" name="t_wh_detail[0][koordinat]" class="form-control form-control-sm"/>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-hover table-bordered table-striped table-sm" id="dt_detail" role="grid">
										<thead>
											<tr class="text-center">
												<th class="text-center">No</th>
												<th class="text-center">Item Name</th>
												<th class="text-center">Production Code</th>
												<th class="text-center">Job</th>
												<th class="text-center">Quantity</th>
												<th class="text-center" style="width: 50px;">
													<button type="button" class="btn btn-xs btn-success btn-add" data-toggle="modal" data-target="#t_production_detail_packing_modal"><i class="fal fa-plus-circle"></i></button>
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
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
							<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
<table class="x-hidden template_row">
	<tbody>
	<tr data-index="x">
		<td class="text-center">1</td>
		<td>
			<span class="nama_barang"></span><br>
			<small class="kode_barang"></small>
			<input type="hidden" class="form-control form-control-sm id_job" name="t_production_detail[x][id_job]"/>
			<input type="hidden" class="form-control form-control-sm production_material" name="t_production_detail[x][production_material]"/>
			<input type="hidden" class="form-control form-control-sm id_wh_detail" name="t_production_detail[x][id_wh_detail]"/>
			<input type="hidden" class="form-control form-control-sm qty" name="t_production_detail[x][qty]"/>
<!--			<input type="hidden" class="form-control form-control-sm id_detail_dn" name="t_production_detail[x][id_detail_dn]"/>-->
			<!--<input type="hidden" class="form-control form-control-sm id_header" name="t_production_detail[x][id_header]"/>-->
		</td>
		<td>
			<span class="kode_mutasi"></span><br>
			<small class="tanggal_mutasi"></small>
			<input type="hidden" class="form-control form-control-sm id_sub_barang" name="t_production_detail[x][id_sub_barang]"/>
			<input type="hidden" class="form-control form-control-sm seri_barang" name="t_production_detail[x][seri_barang]"/>
		</td>
		<td>
			<span class="no_job"></span><br>
			<small class="tanggal_job"></small>
		</td>
		<td class="text-right">
			<span class="label_qty"></span><br>
			<small class="kode_satuan"></small>
		</td>
		<td class="text-center">
			<button class="btn btn-xs btn-danger btn-delete-row" type="button"><i class="fa fal fa-trash"></i></button>
		</td>
	</tr>
	</tbody>
</table>
