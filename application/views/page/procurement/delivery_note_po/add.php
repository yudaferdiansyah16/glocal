<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Procurement</li>
		<li class="breadcrumb-item">Receive Note</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Receive Note
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('procurement/delivery_note_po/store')?>" autocomplete="off">
						<div class="form-group row">
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label">Supplier</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly name_supplier" readonly placeholder="Select supplier..." required>
									<input type="hidden" class="id_supplier" name="t_dn[id_supplier]"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#m_supplier_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Transaction Type</label>
								<select class="form-control form-control-sm select2">
									<option value="non_service">Non Service</option>
									<option value="service">Service</option>
								</select>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Arrival Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" placeholder="Select date" name="t_dn[tgl_kedatangan]" required>
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Invoice Number</label>
								<input type="text" name="t_dn[no_invoice]" class="form-control form-control-sm" placeholder=""/>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Invoice Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" placeholder="Select date" name="t_dn[tgl_invoice]">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Tax Invoice</label>
								<input type="text" name="t_dn[no_faktur]" class="form-control form-control-sm" placeholder=""/>
							</div>
							<div class="col-sm-12 col-lg-3 col-xl-3">
								<label class="form-label">Tax Invoice Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" placeholder="Select date" name="t_dn[tgl_faktur]">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-5">
								<label class="form-label">Vehicle Type</label>
								<select class="form-control form-control-sm select2" name="t_dn[id_jenis_kendaraan]" required>
									<option value="" disabled selected>Choose Vehicle Type . . .</option>
									<?=createOption($sjenis_kendaraan,'ID',array('URAIAN_JENIS_KENDARAAN'),'-')?>
								</select>
							</div>
							<div class="col-md-2">
								<label class="form-label">License Plate</label>
								<input type="text" name="t_dn[plat_kendaraan]" class="form-control form-control-sm" placeholder=""/>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-2">
								<label class="form-label">SJ Number</label>
								<input type="text" class="form-control form-control-sm no_sj_all" placeholder=""/>
							</div>
							<div class="col-md-2">
								<label class="form-label">SJ Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker tanggal_sj_all" placeholder=""/>
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<label for="">Status DN</label>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" name="t_dn[id_fasilitas]" value="0" id="id_fasilitas">
									<label class="custom-control-label" for="id_fasilitas">Facility User</label>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-hover table-bordered table-striped table-sm delivery_note_detail_header" id="dt" role="grid">
										<thead>
											<tr class="text-center">
												<th rowspan="2">No</th>
												<th rowspan="2">PO Number</th>
												<th rowspan="2">Item Name</th>
												<th rowspan="2" style="width: 100px;">SJ<br>Number</th>
												<th rowspan="2" style="width: 100px;">SJ<br>Date</th>
												<th rowspan="2" style="width: 130px;">Price</th>
												<th colspan="4">Quantity</th>
												<th rowspan="2">
													<button type="button" class="btn btn-xs btn-success btn-add" data-toggle="modal" data-target="#t_detail_po_dn_modal"><i class="fal fa-plus-circle"></i></button>
												</th>
											</tr>
											<tr class="text-center">
												<th>PO</th>
												<th>Deliv</th>
												<th>SJ</th>
												<th>QC Pass</th>
											</tr>
										</thead>
										<tbody>

										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="form-group row">
						<div class="col-md-6">
								<label class="form-label">Note</label>
								<textarea type="text" name="t_dn[note]" class="form-control form-control-sm" placeholder=""></textarea>
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
<table class="x-hidden" id="template-row">
	<tbody>
	<tr>
		<td class="text-center"></td>
		<td>
			<span class="kode_po"></span><br>
			<small>PO Date: <span class="tanggal_dibuat"></span></small>
		</td>
		<td>
			<span class="nama_sub_barang"></span><br>
			<small class="kode_barang"></small>
		</td>
		<td>
			<input type="hidden" class="data-index" name="t_detail_dn[x][seri_barang]" value="">
			<input type="hidden" class="id_detail_dn" name="t_detail_dn[x][id_detail_dn]" value="">
			<input type="hidden" class="id_detail_po" name="t_detail_dn[x][id_detail_po]" value="">
			<input type="hidden" class="id_sub_barang" name="t_detail_dn[x][id_sub_barang]" value="">
			<input type="text" class="form-control form-control-sm no_sj" name="t_detail_dn[x][no_sj]" placeholder="SJ Number" value=""/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm x-datepicker tanggal_sj" name="t_detail_dn[x][tanggal_sj]">
		</td>
		<td class="text-right">
			<input type="hidden" name="t_detail_dn[x][harga]" class="harga" value="0"/>
			<span class="label_harga"></span><br>
			<small class="kode_valuta"></small>
		</td>
		<td class="text-right"><span class="qty_po"></span><br><small class="kode_satuan"></small></td>
		<td class="text-right"><span class="sisa_qty_dn"></span><br><small class="kode_satuan"></small></td>
		<td>
			<input type="text" name="t_detail_dn[x][qty_sj]" class="form-control form-control-sm input-mask qty_sj" id="qty_sj[x]" data-inputmask="'alias': 'currency', 'prefix': ''" value="0" min="0" step="0.001" max="" onchange="setdnmaxvalue()"/>
		</td>
		<td>
			<input type="text" name="t_detail_dn[x][qty_dn]" class="form-control form-control-sm input-mask qty_dn" id="qty_dn[x]" data-inputmask="'alias': 'currency', 'prefix': ''" value="0" min="0" step="0.001" max=""/>
		</td>
		<td class="text-center">
			<button type="button" class="btn btn-xs btn-danger btn-delete"><i class="fa fal fa-trash"></i></button>
		</td>
	</tr>
	</tbody>
</table>
