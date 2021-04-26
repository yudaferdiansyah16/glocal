<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Sales</li>
		<li class="breadcrumb-item">Sales Invoice</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Sales Invoice
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('sales/invoice/store')?>" autocomplete="off">
						<div class="form-group row">
							<div class="col-md-4">
								<label class="form-label">Customer</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly nama_supplier" readonly placeholder="Select Customer...">
									<input type="hidden" class="id_supplier" name="t_invoice[id_supplier]"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#referensi_pemasok_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label class="form-label">Type of Sales</label>
								<select class="form-control form-control-sm id_tipe_sales" name="t_invoice[id_tipe_sales]" required>
									<?=createOption($tipe_sales, 'id_tipe_sales', array('nama_tipe_sales'), ' - ')?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-2">
								<label class="form-label">Invoice Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker tanggal_invoice x-readonly" placeholder="Select date" name="t_invoice[tanggal_invoice]" required>
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-5">
								<label class="form-label">Destination</label>
								<div class="input-group input-group-sm">
									<input type="text" name="t_invoice[destination]" class="form-control form-control form-control-sm x-readonly destination" readonly placeholder="Select destination...">
									<div class="input-group-append">
										<button type="button" class="btn btn-sm btn-default btn-search-destination" data-toggle="modal" data-target="#detail_supplier_destination_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label">Country</label>
								<input type="hidden" name="t_invoice[id_country]" class="id_country">
								<input type="text" class="form-control form-control form-control-sm x-readonly uraian_negara" readonly>
							</div>
							<div class="col-md-3">
								<label class="form-label">Shipping Line</label>
								<input type="text" class="form-control form-control-sm" name="t_invoice[shipping_line]" placeholder=""/>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-2">
								<label class="form-label">BL Number</label>
								<input type="text" class="form-control form-control-sm" name="t_invoice[no_bl]" placeholder=""/>
							</div>
							<div class="col-md-3">
								<label class="form-label">Currency</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly kode_valuta" readonly placeholder="Select currency..." required>
									<input type="hidden" class="id_valuta" name="t_invoice[id_valuta]"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_valuta_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label">Rate</label>
								<input type="text" class="form-control form-control-sm input-mask" name="t_invoice[rate]" placeholder="" data-inputmask="'alias': 'currency', 'prefix': ''" value="1" required/>
							</div>
							<div class="col-md-2">
								<label class="form-label">Payment</label>
								<input type="text" class="form-control form-control-sm" name="t_invoice[payment]" placeholder=""/>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="dt" class="table table-sm table-bordered table-striped table-hover">
										<thead>
											<tr class="text-center">
												<th rowspan="2">No.</th>
												<th rowspan="2">Item Product</th>
												<th rowspan="2">SO Code</th>
												<th colspan="2">Stuffing</th>
												<th colspan="3">Invoice</th>
												<!--<th colspan="2">Stuffing</th>-->
												<th rowspan="2" style="width: 120px;">Netto</th>
												<th rowspan="2" style="width: 120px;">Bruto</th>
												<th rowspan="2" style="width: 120px;">Subtotal</th>
												<th rowspan="2">
													<button type="button" class="btn btn-success btn-xs btn-add-row" data-toggle="modal" data-target="#t_detail_stuffing_invoice_modal"><i class="fa fal fa-plus-circle"></i></button>
												</th>
											</tr>
											<tr class="text-center">
												<th style="width: 80px;">Quantity</th>
												<th style="width: 80px;">MC</th>
												<th style="width: 90px;">Quantity</th>
												<th style="width: 80px;">MC</th>
												<th>Price</th>
											</tr>
										</thead>
										<tbody></tbody>
										<tfoot>
											<tr>
												<th></th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
								<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
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
			<input type="hidden" class="id_sub_barang" name="t_invoice_detail[x][id_sub_barang]" value=""/>
			<input type="hidden" class="id_detail_stuffing" name="t_invoice_detail[x][id_detail_stuffing]" value=""/>
			<input type="hidden" class="id_kemasan" name="t_invoice_detail[x][id_kemasan]" value=""/>
			<input type="hidden" class="id_satuan" name="t_invoice_detail[x][id_satuan]" value=""/>
			<input type="hidden" class="nilai_kemasan" value=""/>
			<span class="nama_sub_barang"></span><br>
			<small class="kode_barang"></small>
		</td>
		<td>
			<span class="kode_po"></span><br>
			<small class="po_buyer"></small>
		</td>
		<td class="text-right">
			<span class="qty_si_real"></span><br>
			<small class="kode_satuan"></small>
		</td>
		<td class="text-right">
			<span class="qty_mc_real"></span><br>
			<small class="kode_kemasan"></small>
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" name="t_invoice_detail[x][qty_invoice]" class="form-control form-control-sm input-mask qty_invoice" data-inputmask="'alias': 'currency', 'prefix': ''" value="0"/>
			</div>
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" name="t_invoice_detail[x][qty_mc]" class="form-control form-control-sm input-mask qty_mc" data-inputmask="'alias': 'currency', 'prefix': '', 'digits': '0'" value="0"/>
			</div>
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" name="t_invoice_detail[x][harga]" class="form-control form-control-sm input-mask harga" data-inputmask="'alias': 'currency', 'prefix': '', 'digits': '0'" value="0"/>
			</div>
		</td>
		<!--<td>
			<div class="input-group input-group-sm">
				<input type="text" name="t_invoice_detail[x][qty_mc_real]" class="form-control form-control-sm input-mask qty" data-inputmask="'alias': 'currency', 'prefix': '', 'digits': '0'" value="0"/>
				<div class="input-group-append">
					<span class="input-group-text kode_kemasan"></span>
				</div>
			</div>
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" name="t_invoice_detail[x][qty_si_real]" class="form-control form-control-sm input-mask qty" data-inputmask="'alias': 'currency', 'prefix': ''" value="0"/>
				<div class="input-group-append">
					<span class="input-group-text kode_satuan"></span>
				</div>
			</div>
		</td>-->
		<td>
			<div class="input-group input-group-sm">
				<input type="text" name="t_invoice_detail[x][netto]" class="form-control form-control-sm input-mask netto" data-inputmask="'alias': 'currency', 'prefix': '', 'digits': '0'" value="0"/>
				<div class="input-group-append">
					<span class="input-group-text">KGM</span>
				</div>
			</div>
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" name="t_invoice_detail[x][bruto]" class="form-control form-control-sm input-mask bruto" data-inputmask="'alias': 'currency', 'prefix': '', 'digits': '0'" value="0"/>
				<div class="input-group-append">
					<span class="input-group-text">KGM</span>
				</div>
			</div>
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" name="t_invoice_detail[x][subtotal]" class="form-control form-control-sm input-mask subtotal" data-inputmask="'alias': 'currency', 'prefix': '', 'digits': '0'" value="0" readonly/>
			</div>
		</td>
		<td class="text-center">
			<a href="javascript://" class="btn btn-xs btn-danger btn-delete-row"><i class="fal fal fa-trash"></i></a>
		</td>
	</tr>
	</tbody>
</table>
