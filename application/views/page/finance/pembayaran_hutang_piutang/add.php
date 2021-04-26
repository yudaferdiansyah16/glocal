<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item">Payment Debit Credit</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Payment Debit Credit
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-12 col-lg-3 col-xl-3">
							<label class="form-label">Supplier</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-readonly nama_supplier_filter" readonly placeholder=""/>
								<input type="hidden" class="form-control form-control-sm id_supplier_filter" placeholder=""/>
								<div class="input-group-append">
									<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_pengusaha_modal"><i class="fal fa-search"></i></button>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<label class="form-label">Date</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" id="date" name="t_po[tanggal_dibuat]" required>
								<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<label class="form-label">Date</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" id="date" name="t_po[tanggal_dibuat]" required>
								<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-9 col-xl-9"></div>
					</div>
				</div>
				<div class="card-body">
					<form method="post" action="<?=base_url('finance/pembayaran_hutang_piutang/store')?>">
						<div class="form-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-sm table-bordered table-striped table-hover" id="dt">
										<thead>
										<tr>
											<th class="text-center" style="width: 80px;">No</th>
											<th class="text-center" style="width: 120px;">Transaction Number</th>
											<th class="text-center" style="width: 80px;">Due Date</th>
											<th class="text-center" style="width: 90px;">Currency</th>
											<th class="text-center" style="width: 90px;">Delivery Note Number</th>
											<th class="text-center" style="width: 90px;">Invoice Number</th>
											<th class="text-center" style="width: 90px;">Payment</th>
											<th class="text-center" style="width: 90px;">Document Number</th>
											<th class="text-center" style="width: 90px;">Account</th>
											<th class="text-center" style="width: 90px;">Method</th>
											<th class="text-center" style="width: 90px;">Discount</th>
											<th class="text-center" style="width: 90px;">Value</th>
											<th class="text-center" style="width: 90px;">0-30 Dyas</th>
											<th class="text-center" style="width: 90px;">60-90 Days</th>
											<th class="text-center" style="width: 90px;">60-90 Dyas</th>
											<th class="text-center" style="width: 90px;"><90 Dyas</th>
											<th class="text-center" style="width: 90px;">Total</th>
										</thead>
										<tbody>
										<tr data-index="0">
											<td class="text-center">1</td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" readonly></td>
											<td><input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" id="date" name="t_po[tanggal_dibuat]" required>
												<div class="input-group-append">
													<span class="input-group-text fs-xl">
														<i class="fa fal fa-calendar"></i>
													</span>
												</div>
											</td>
											<td><input type="text" class="form-control form-control form-control-sm x-readonly nama_valuta" readonly placeholder="Select currency...">
												<input type="hidden" name="referensi_valuta[id_valuta]"/>
												<div class="input-group-append">
													<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_valuta_modal"><i class="fal fa-search"></i></button>
												</div>
											</td>
											<td><input type="text" class="form-control form-control form-control-sm x-readonly kode_dn" readonly placeholder="Select delivery note...">
												<input type="hidden" name="t_dn[id_dn]"/>
												<div class="input-group-append">
													<button type="button" class="btn btn-default" data-toggle="modal" data-target="#t_dn_modal"><i class="fal fa-search"></i></button>
												</div>
											</td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" readonly/></td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" readonly/></td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" readonly/></td>
											<td><input type="text" class="form-control form-control form-control-sm x-readonly nama_akun" readonly placeholder="Select delivery note...">
												<input type="hidden" name="m_akun[id_akun]"/>
												<div class="input-group-append">
													<button type="button" class="btn btn-default" data-toggle="modal" data-target="#m_akun_modal"><i class="fal fa-search"></i></button>
												</div>
											</td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" /></td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" /></td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" /></td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" readonly/></td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" readonly/></td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" readonly/></td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" readonly/></td>
											<td><input type="text" class="form-control form-control-sm x-readonly" placeholder="" readonly/></td>
										</tr>
										</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="form-group">
							<a href="<?=base_url('finance/pembayaran_hutang_piutang')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Cancel</a>
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
