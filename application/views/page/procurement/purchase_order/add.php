<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Procurement</li>
		<li class="breadcrumb-item">Purchase Order</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Purchase Order
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?= base_url('procurement/purchase_order/store') ?>">
						<div class="form-group row">
							<div class="col-md-3">
								<label class="form-label">Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly x-datepicker" placeholder="Select date" name="t_po[tanggal_dibuat]" value="<?=date('d-m-Y')?>" required>
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
									<input type="text" class="form-control form-control form-control-sm x-readonly x-datepicker" readonly placeholder="Select date" name="t_po[tanggal_dibutuhkan]">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label class="form-label">Valuta</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly nama_valuta" readonly placeholder="" />
									<input type="hidden" class="form-control form-control-sm id_valuta" name="t_po[id_valuta]" placeholder="" />
									<input type="hidden" class="form-control form-control-sm kode_valuta" name="kode_valuta" placeholder="" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_valuta_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label class="form-label">Rate</label>
								<input type="text" class="form-control form-control-sm input-mask rates" name="t_po[rate]" placeholder="" data-inputmask="'alias': 'currency', 'prefix': ''" value="1" />
							</div>
							<div class="col-md-3">
								<label class="form-label">Supplier</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly nama_supplier" readonly placeholder="" />
									<input type="hidden" class="form-control form-control-sm id_supplier" name="t_po[id_supplier]" placeholder="" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#m_supplier_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-9">
								<label class="form-label">Alamat</label>
								<input type="text" class="form-control form-control-sm alamat_supplier x-readonly" readonly />
							</div>
							<div class="col-md-3">
								<label class="form-label">Down Payment</label>
								<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" name="t_po[down_payment]" placeholder="" />
							</div>
							<div class="col-md-3">
								<label class="form-label">Discount</label>
								<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" name="t_po[diskon]" placeholder="" />
							</div>
							<div class="col-md-3">
								<label class="form-label">Tax</label>
								<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" name="t_po[pajak]" placeholder="" />
							</div>
							<div class="col-md-3">
								<label class="form-label">PPh</label>
								<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" name="t_po[pph]" placeholder="" />
							</div>
							<div class="col-md-3">
								<label class="form-label">Shipping Cost</label>
								<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" name="t_po[biaya_kirim]" placeholder="" />
							</div>
							<div class="col-md-3">
								<label class="form-label">Payment Term</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" name="t_po[payment_term]" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" disabled>days</button>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label class="form-label">Payment Method</label>
								<select class="form-control form-control-sm select2" name="t_po[id_jenis_pembayaran]">
									<option disabled selected>Select Payment Method . . .</option>
									<?= createOption($jenis_pembayaran, 'id_jenis_pembayaran', array('jenis_pembayaran'), '-') ?>
								</select>
							</div>
							<div class="col-md-8">
								<label class="form-label">Remark PO</label>
								<input type="text" class="form-control form-control-sm" name="t_po[catatan_po]" placeholder="" />
							</div>
							<div class="col-md-1">
								<label class="form-label">Non Job</label>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input nonjob" value="" id="nonjob">
									<label class="custom-control-label" for="nonjob">Non Job</label>
								</div>
							</div>
							<div class="col-md-3 filter_job">
								<label class="form-label">Filter Job</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly nama_job" readonly placeholder="" />
									<input type="hidden" class="form-control form-control-sm id_job" placeholder="" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default clearbtn x-hidden" onclick="clearBtn()"><i class="fal fa-times text-danger"></i></button>
										<button type="button" class="btn btn-default searchbtn" data-toggle="modal" data-target="#t_job_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-hover table-bordered table-striped table-sm dt_po_add" id="dt_po_add" role="grid">
										<thead>
											<tr>
												<th class="text-center" rowspan="2">No</th>
												<th class="text-center" rowspan="2">No PP</th>
												<th class="text-center" rowspan="2">Nama Barang</th>
												<th class="text-center" rowspan="2">Price</th>
												<th class="text-center" colspan="3">Quantity</th>
												<th class="text-center" rowspan="2">Sub Total</th>
												<th class="text-center" rowspan="2">Remark</th>
												<th class="text-center" rowspan="2">
													<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#t_detail_pp_po_modal"><i class="fal fa-plus-circle"></i></button>
												</th>
											</tr>
											<tr>
												<th class="text-center">Requested</th>
												<th class="text-center">Purchased</th>
												<th class="text-center">Order</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot>
											<th colspan="7" class="text-center">TOTAL</th>
											<th>
												<input type="text" class="form-control form-control-sm total x-readonly input-mask" id="total" data-inputmask="'alias': 'currency', 'prefix': ''" readonly>
											</th>
											<th></th>
											<th></th>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
							<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?> </a>
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
			<td class="text-center"></td>
			<td>
				<span id="kode_pp"></span><br>
				<small>Job: <span id="no_job"></span></small>
				<input type="hidden" class="id_detail_pp" name="t_detail_po[x][id_detail_pp]" />
				<input type="hidden" class="id_sub_barang" name="t_detail_po[x][id_sub_barang]" />
			</td>
			<td>
				<p id="nama_barang" style="margin: 0;padding: 0"></p>
				<small id="kode_barang" style="margin: 0;padding: 0"></small>
			</td>
			<td>
				<div class="input-group input-group-sm">
					<input type="text" class="form-control form-control-sm harga input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" id="t_detail_po[x][harga]" name="t_detail_po[x][harga]" onchange="renderSummary()" />
					<div class="input-group-append">
						<button type="button" class="btn btn-default valuta" disabled id="valuta[x]"></button>
					</div>
				</div>
			</td>

			<td>
				<div class="input-group input-group-sm">
					<input type="text" class="form-control form-control-sm qty_pp input-mask x-readonly" readonly data-inputmask="'alias': 'currency', 'prefix': ''"/>
					<div class="input-group-append">
						<button type="button" class="btn btn-default satuana" disabled id="satuana[x]"></button>
					</div>
				</div>
			</td>
			<td>
				<div class="input-group input-group-sm">
					<input type="text" class="form-control form-control-sm qty_terbeli input-mask x-readonly" readonly data-inputmask="'alias': 'currency', 'prefix': ''"/>
					<div class="input-group-append">
						<button type="button" class="btn btn-default satuanb" disabled id="satuanb[x]"></button>
					</div>
				</div>
			</td>
			<td>
				<div class="input-group input-group-sm">
					<input type="text" class="form-control form-control-sm qty_po input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" id="t_detail_po[x][qty_po]" name="t_detail_po[x][qty_po]" step="0.0001" min="0" max="" onchange="renderSummary()" />
					<div class="input-group-append">
						<button type="button" class="btn btn-default satuanc" disabled id="satuanc[x]"></button>
					</div>
				</div>
			</td>

			<td>
				<input type="text" class="form-control form-control-sm input-mask x-readonly subtotal" id="subtotal[x]" readonly data-inputmask="'alias': 'currency', 'prefix': ''" />
			</td>
			<td>
				<input type="text" class="form-control form-control-sm keterangan" name="t_detail_po[x][keterangan]" placeholder="" />
			</td>
			<td class="text-center">
				<button class="btn btn-xs btn-danger btn-delete"><i class="fa fal fa-trash"></i></button>
			</td>
		</tr>
	</tbody>
</table>
