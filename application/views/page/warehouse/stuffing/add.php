<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Warehouse</li>
		<li class="breadcrumb-item">Stuffing</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Stuffing
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('warehouse/stuffing/store')?>" autocomplete="off">
						<div class="form-group row">
							<div class="col-md-2">
								<label class="form-label">Stuffing Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker tanggal_stuffing x-readonly" placeholder="Select date" name="t_stuffing[tanggal_stuffing]" required>
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label class="form-label">Type Stuffing</label>
								<select class="form-control form-control-sm id_tipe_sales" name="t_stuffing[id_tipe_sales]" required>
									<?=createOption($m_tipe_sales, 'id_tipe_sales', array('nama_tipe_sales'), ' - ')?>
								</select>
							</div>
							<div class="col-md-4">
								<label class="form-label">Customer</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly nama_supplier_filter" readonly placeholder="Select Customer...">
									<input type="hidden" class="id_supplier_filter" name="t_stuffing[id_supplier]"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#m_supplier_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-5">
								<label class="form-label">Destination</label>
								<div class="input-group input-group-sm">
									<input type="text" name="t_stuffing[destination]" class="form-control form-control form-control-sm x-readonly destination" readonly placeholder="Select destination...">
									<div class="input-group-append">
										<button type="button" class="btn btn-sm btn-default btn-search-destination" data-toggle="modal" data-target="#detail_supplier_destination_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label">Country</label>
								<input type="hidden" name="t_stuffing[id_country]" class="id_country">
								<input type="text" class="form-control form-control form-control-sm x-readonly uraian_negara" readonly>
							</div>
							<div class="col-md-3">
								<label class="form-label">Shipping Line</label>
								<input type="text" class="form-control form-control-sm" name="t_stuffing[shipping_line]" placeholder=""/>
							</div>
							<div class="col-md-2">
								<label class="form-label">Container Size</label>
								<select class="form-control form-control-sm id_ukuran_kontainer" name="t_stuffing[id_ukuran_kontainer]" required>
									<option value="">Choose Size...</option>
									<?=createOption($referensi_ukuran_container, 'ID', array('URAIAN_UKURAN_KONTAINER'), ' - ')?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-2">
								<label class="form-label">Seal Number</label>
								<input type="text" class="form-control form-control-sm" name="t_stuffing[seal_number]" placeholder=""/>
							</div>
							<div class="col-md-2">
								<label class="form-label">Loading Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker loading_date x-readonly" readonly placeholder="Select date" name="t_stuffing[loading_date]">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label">Container Number</label>
								<input type="text" class="form-control form-control-sm" name="t_stuffing[container_number]" placeholder=""/>
							</div>
							<div class="col-md-2">
								<label class="form-label">Closing Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker closing_date x-readonly" readonly placeholder="Select date" name="t_stuffing[closing_date]">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label">BL Number</label>
								<input type="text" class="form-control form-control-sm" name="t_stuffing[no_bl]" placeholder=""/>
							</div>
							<div class="col-md-2">
								<label class="form-label">BL Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker bl_date x-readonly" readonly placeholder="Select date" name="t_stuffing[bl_date]">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>

						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="dt" class="table table-sm table-bordered table-striped table-hover">
										<thead>
											<tr class="text-center">
												<th rowspan="2">No.</th>
												<th rowspan="2">No Job</th>
												<th colspan="3">Barang</th>
												<th rowspan="2">QTY Order</th>
												<th rowspan="2">Qty WH</th>
												<th colspan="2">Stuffing</th>
												<th rowspan="2">Catatan Return</th>
												<th rowspan="2">
													<button type="button" class="btn btn-success btn-xs btn-add-row" data-toggle="modal" data-target="#t_wh_detail_stuffing_modal"><i class="fa fal fa-plus-circle"></i></button>
												</th>
											</tr>
											<tr class="text-center">
												<th>Nama</th>
												<th>Kode</th>
												<th>Satuan</th>
												<th>QTY MC</th>
												<th>QTY Satuan</th>
											</tr>
										</thead>
										<tbody></tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Save</button>
								<a href="<?=base_url('warehouse/stuffing')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Cancel</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
<table class="x-hidden" id="template-row">
	<tbody>
	<tr data-index="x">
		<td class="text-center">1</td>
		<td>
			<input type="hidden" class="id_sub_barang" name="t_detail_stuffing[x][id_sub_barang]" value=""/>
			<input type="hidden" class="id_detail_po" name="t_detail_stuffing[x][id_detail_po]" value=""/>
			<input type="hidden" class="id_wh_detail" name="t_detail_stuffing[x][id_wh_detail]" value=""/>
			<input type="hidden" class="id_kemasan" name="t_detail_stuffing[x][id_kemasan]" value=""/>
			<input type="hidden" class="nilai_kemasan" value=""/>
			
			<span class="no_job"></span><br>
			<small>Job Date: <span class="tanggal_job"></span></small>
		</td>
		<td>
		<span class="nama_sub_barang"></span><br>
			<small class="kode_barang"></small>
		</td>
		<td>
			<span class="kode_mutasi"></span><br>
			<small>Trans. Date: <span class="tanggal_terima"></span></small>
		</td>
		<td class="text-right">
			<span class="satuan"></span><br>
			<small class="kode_satuan"></small>
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" name="t_detail_stuffing[x][qty_si_plan]" class="form-control form-control-sm input-mask qty_si_plan" data-inputmask="'alias': 'currency', 'prefix': ''" value="0"/>
			</div>
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text"  class="form-control form-control-sm input-mask qty_remain " data-inputmask="'alias': 'currency', 'prefix': '', 'digits': '0'"  readonly/>
			</div>
		</td>
		<!--<td>
			<div class="input-group input-group-sm">
				<input type="text" name="t_detail_stuffing[x][qty_mc_real]" class="form-control form-control-sm input-mask qty" data-inputmask="'alias': 'currency', 'prefix': '', 'digits': '0'" value="0"/>
				<div class="input-group-append">
					<span class="input-group-text kode_kemasan"></span>
				</div>
			</div>
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" name="t_detail_stuffing[x][qty_si_real]" class="form-control form-control-sm input-mask qty" data-inputmask="'alias': 'currency', 'prefix': ''" value="0"/>
				<div class="input-group-append">
					<span class="input-group-text kode_satuan"></span>
				</div>
			</div>
		</td>-->
		<td>
			<input type="text" name="t_detail_stuffing[x][netto]" class="form-control form-control-sm input-mask qty" data-inputmask="'alias': 'currency', 'prefix': '', 'digits': '0'" value="0"/>
		</td>
		<td>
			<input type="text" name="t_detail_stuffing[x][bruto]" class="form-control form-control-sm input-mask qty" data-inputmask="'alias': 'currency', 'prefix': '', 'digits': '0'" value="0"/>
		</td>
		<td class="text-center">
			<a href="javascript://" class="btn btn-xs btn-danger btn-delete-row"><i class="fal fal fa-trash"></i></a>
		</td>
	</tr>
	</tbody>
</table>
