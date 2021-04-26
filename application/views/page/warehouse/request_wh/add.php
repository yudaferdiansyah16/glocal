	<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Warehouse</li>
		<li class="breadcrumb-item">Request WH</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Request WH
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('warehouse/request_wh/store')?>">
						<div class="form-group row">
							<div class="col-md-2">
								<label class="form-label">Jenis Mutasi</label>
								<select class="form-control form-control-sm id_tipe_sales" name="t_stuffing[id_tipe_sales]" required>
									<?=createOption($m_tipe_sales, 'id_tipe_sales', array('nama_tipe_sales'), ' - ')?>
								</select>
							</div>
							<div class="col-md-2">
								<label class="form-label">Tanggal</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="t_request[tgl_request]">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label">Tipe Request</label>
								<select class="form-control form-control-sm select2" id="tipeRequest">
									<option value="" disabled selected>Choose Request Type</option>
									<option value="job">JOB</option>
									<option value="nonjob">NON JOB</option>
								</select>
							</div>
							<div class="col-md-6">
								<div class="x-hidden template_request">
									<label class="form-label">No Job</label>
									<div class="input-group input-group-sm">
										<input type="text" class="form-control form-control form-control-sm x-readonly no_job" readonly>
										<input type="hidden" class="id_job" name="t_request[id_job]"/>
										<div class="input-group-append">
											<button type="button" class="btn btn-default" data-toggle="modal" data-target="#t_job_modal"><i class="fal fa-search"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="dt_request_add" class="table table-hover table-bordered table-striped table-sm" role="grid">
										<thead>
											<tr class="text-center">
												<th class="text-center" rowspan="2" width="20px">No</th>
												<th class="text-center" rowspan="2">No Receive LPB</th>
												<th class="text-center" rowspan="2">No Job</th>
												<th class="text-center" colspan="5">Barang</th>
												<th class="text-center" rowspan="2" width="80px">Add Item<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#t_wh_detail_request_modal"><i class="fal fa-plus-circle"></i></button></th>
												<th class="text-center" rowspan="2">Catatan</th>
											</tr>
											<tr>
												<th>Nama</th>
												<th>Kode</th>
												<th>Satuan</th>
												<th>Stok</th>
												<th>Request</th>
											</tr>
										</thead>
										<tbody>
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
</main>


<table class="x-hidden table_template">
	<tbody>
	<tr data-index="x">
		<td class="text-center">1</td>
		<td>
			<p class="text_nomor_aju"></p>
		</td>
		<td>
			<p class="text_no_job"></p>
		</td>
		<td>
			<p class="text_nama_barang"></p>
		</td>
		<td>
			<p class="text_kode_barang"></p>
			<!-- <input type="hidden" class="id_job" name="t_request_detail[x][id_job]"/> -->
			<input type="hidden" class="id_request" name="t_request_detail[x][id_request]"/>
			<input type="hidden" class="id_wh_detail" name="t_request_detail[x][id_wh_detail]"/>
			<!-- <input type="hidden" class="id_detail_po" name="t_request_detail[x][id_detail_po]"/> -->
			<!-- <input type="hidden" class="id_header" name="t_request_detail[x][id_header]"/> -->
			<!-- <input type="hidden" name="t_request_detail[x][id_jenis_mutasi]" value="13"> -->
		</td>
		<td>
			<p class="text_nama_barang" style="margin: 0;padding: 0"></p>
			<small class="text_kode_barang" style="margin: 0;padding: 0"></small>
			<input type="hidden" class="id_sub_barang" name="t_request_detail[x][id_sub_barang]"/>
			<!-- <input type="hidden" class="seri_barang" name="t_request_detail[x][seri_barang]"/> -->
		</td>
		<td class="text-right">
			<p class="text_qty_wh"></p>
		</td>
		<td>
			<input type="number" class="form-control form-control-sm qty" step="0.01" min="0" name="t_request_detail[x][qty_request]"/>
		</td>
		<td class="text-center">
			<button class="btn btn-xs btn-danger btn-delete-row"><i class="fa fal fa-trash"></i></button>
		</td>
	</tr>
	</tbody>
</table>
