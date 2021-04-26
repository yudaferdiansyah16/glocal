<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Sales</li>
		<li class="breadcrumb-item">Main Sales Order</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Main Sales Order
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('sales/main_so/store')?>" autocomplete="off">
						<div class="form-group row">
							<div class="col-md-3">
								<label class="form-label">Type of Sales</label>
								<select class="form-control form-control-sm select2" name="t_po[id_tipe_sales]" required>
									<option value="" disabled selected>Select Data . . .</option>
									<?=createOption($tipe_sales, 'id_tipe_sales', array('nama_tipe_sales'), ' - ')?>
								</select>
							</div>
							<div class="col-md-2">
								<label class="form-label">Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" placeholder="Select date" id="date" name="t_po[tanggal_dibuat]" value="<?=date('d-m-Y')?>" required>
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label">Request Shipdate</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" id="date" name="t_po[tanggal_dibutuhkan]" required>
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-5">
								<label class="form-label">Customer</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly name_supplier" readonly placeholder="Select customer..." required>
									<input type="hidden" name="t_po[id_supplier]"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#m_customer_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-4">
								<label class="form-label">PO Buyer</label>
								<input type="text" name="t_po[po_buyer]" class="form-control form-control-sm x-readonly po_buyer" value="">
							</div>
							<div class="col-md-3">
								<label class="form-label">Currency</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly nama_valuta" readonly placeholder="Select currency..." required>
									<input type="hidden" name="t_po[id_valuta]"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_valuta_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label class="form-label">Rate</label>
								<input type="text" class="form-control form-control-sm input-mask" name="t_po[rate]" placeholder="" data-inputmask="'alias': 'currency', 'prefix': ''" value="1" required/>
							</div>
							<div class="col-md-2">
								<div class="row">
									<div class="col-sm-12" style="padding-bottom: 5px">
										<label class="form-label">Call Of SO</label>
									</div>
									<div class="col-sm-12">
										<div class="custom-control custom-checkbox custom-control-inline">
											<input type="checkbox" class="custom-control-input" name="callof" value="1" id="callof">
											<label class="custom-control-label" for="callof">Call Of</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-sm table-bordered table-striped table-hover" id="dt">
										<thead>
											<tr>
												<th class="text-center" rowspan="2">No.</th>
												<th class="text-center" rowspan="2">Item</th>
												<th class="text-center" rowspan="2">Description</th>
												<th class="text-center" colspan="2">Packaging</th>
												<th class="text-center" colspan="2">Items</th>
												<th class="text-center" rowspan="2" style="width: 100px;">Price</th>
												<th class="text-center" rowspan="2" style="width: 100px;">Subtotal</th>
												<th class="text-center" rowspan="2"><button type="button" class="btn btn-success btn-xs btn-add-row" data-toggle="modal" data-target="#m_sub_barang_modal"><i class="fa fal fa-plus-circle"></i></button></th>
											</tr>
											<tr>
												<th class="text-center" style="width: 80px;">Quantity</th>
												<th class="text-center" style="width: 80px;">Unit</th>
                                                <th class="text-center" style="width: 80px;">Quantity</th>
                                                <th class="text-center" style="width: 90px;">Unit</th>
											</tr>
										</thead>
										<tbody>
											<tr data-index="0">
												<td class="text-center">1</td>
												<td>
													<input type="text" class="form-control form-control form-control-sm x-readonly nama_sub_barang" placeholder="Item name" readonly>
												</td>
												<td><input type="text" name="t_detail_po[0][keterangan]" class="form-control form-control-sm x-readonly" placeholder="Description" readonly/></td>
												<td><input type="text" name="t_detail_po[0][qty_mc]" class="form-control form-control-sm input-pack input-mask x-readonly" data-inputmask="'alias': 'currency', 'prefix': '', 'allowMinus': 'false', 'digits': '0'" value="0" readonly/></td>
												<td>
													<input type="hidden" class="id_kemasan" name="t_detail_po[0][id_kemasan]" value=""/>
													<input type="text" class="form-control form-control form-control-sm x-readonly nama_kemasan" placeholder="Select Packaging" readonly>
												</td>
												<td>
													<input type="text" name="t_detail_po[0][qty_po]" class="form-control form-control-sm input-mask input-qty-po x-readonly" data-inputmask="'alias': 'currency', 'prefix': ''" readonly/>
												</td>
												<td>
													<input type="hidden" name="t_detail_po[0][id_satuan]" value=""/>
													<input type="text" class="form-control form-control form-control-sm x-readonly nama_satuan" placeholder="Select Unit" readonly>
												</td>
												<td><input type="text" name="t_detail_po[0][harga]" class="form-control form-control-sm input-mask input-price x-readonly" data-inputmask="'alias': 'currency', 'prefix': ''" readonly/></td>
												<td><input type="text" class="form-control form-control-sm input-mask input-subtotal x-readonly" data-inputmask="'alias': 'currency', 'prefix': ''" readonly/></td>
												<td class="text-center">
												</td>
											</tr>
										</tbody>
										<tfoot>
											<tr>
												<th colspan="3" class="text-right">Total Pack</th>
												<th>
													<input type="text" class="form-control form-control-sm input-mask input-pack-total x-readonly" data-inputmask="'alias': 'currency', 'digits': '0', 'prefix': ''" value="0" readonly/>
												</th>
												<th colspan="4" class="text-right">Total</th>
												<th>
													<input type="text" class="form-control form-control-sm input-mask input-total x-readonly" data-inputmask="'alias': 'currency', 'prefix': ''" value="0" readonly/>
												</th>
												<th class="text-center"></th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
						<hr>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
							<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
						</div>
					</form>
					<table class="x-hidden" id="template-row">
						<tbody>
							<tr data-index="x">
								<td class="text-center">1</td>
								<td>
                                    <input type="hidden" class="id_sub_barang" name="t_detail_po[x][id_sub_barang]" value=""/>
                                    <span class="nama_sub_barang"></span><br>
									<small class="kode_barang"></small>
								</td>
								<td><input type="text" name="t_detail_po[x][keterangan]" class="form-control form-control-sm" placeholder="Description"/></td>
								<td><input type="text" name="t_detail_po[x][qty_mc]" class="form-control form-control-sm input-pack input-mask" data-inputmask="'alias': 'currency', 'prefix': '', 'allowMinus': 'false', 'digits': '0'" value="0"/></td>
								<td>
									<div class="input-group input-group-sm">
										<input type="hidden" class="id_kemasan" name="t_detail_po[x][id_kemasan]" value=""/>
										<input type="text" class="form-control form-control form-control-sm x-readonly nama_kemasan" placeholder="Select Packaging" readonly required>
									</div>
								</td>
								<td>
									<input type="text" name="t_detail_po[x][qty_po]" class="form-control form-control-sm input-mask input-qty-po" data-inputmask="'alias': 'currency', 'prefix': ''"/>
								</td>
								<td>
									<select class="form-control form-control-sm id_satuan" name="t_detail_po[x][id_satuan]">
									</select>
								</td>
								<td><input type="text" name="t_detail_po[x][harga]" class="form-control form-control-sm input-mask input-price" data-inputmask="'alias': 'currency', 'prefix': ''"/></td>
								<td><input type="text" class="form-control form-control-sm input-mask input-subtotal x-readonly" data-inputmask="'alias': 'currency', 'prefix': ''" readonly/></td>
								<td class="text-center">
                                    <a href="javascript://" class="btn btn-xs btn-danger btn-delete-row"><i class="fal fal fa-trash"></i></a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</main>
