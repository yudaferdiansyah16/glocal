<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item">Transaction</li>
		<li class="breadcrumb-item">General Journal</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add General Journal
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?= base_url('finance/transaction_jurnal/store') ?>">
						<div class="form-group row">
							<div class="col-md-2">
								<label class="form-label">Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="t_finance[tgl_trans]" value="<?= date('d-m-Y') ?>">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label class="form-label">Description</label>
								<textarea class="form-control trans_description" name="t_finance[trans_description]" placeholder="Description..."></textarea>
							</div>
							<div class="col-md-3">
								<label class="form-label">Type Journal</label>
								<select class="form-control form-control-sm select2 type_journal" id="type_journal" name="t_finance[no_trans]" required>
									<option value="" disabled selected>Select Data . . .</option>
									<?=createOption($stype_journal,'kode_jenis_jurnal',array('kode_jenis_jurnal','nama_jenis_jurnal'),' - ', $type_journal);?>
								</select>
							</div>
							<div class="col-md-2">
								<label class="form-label">Currency</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly nama_valuta" readonly placeholder="Select currency...">
									<input type="hidden" name="t_finance[id_valuta]" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_valuta_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label">Rate</label>
								<input type="text" class="form-control form-control-sm input-mask rate" name="t_finance[rate]" placeholder="" data-inputmask="'alias': 'currency', 'prefix': ''" value="1" required />
							</div>
						</div>
						<div class="from-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="dt" class="table table-sm table-bordered table-striped table-hover">
										<thead>
											<tr class="text-center">
												<th style="width: 30px;">No.</th>
												<th style="width: 120px;">Position</th>
												<th style="width: 300px;">Account</th>
												<th>Description</th>
												<!-- <th style="width: 120px;">Nilai</th> -->
												<!-- <th style="width: 120px;">Jumlah</th> -->
												<th style="width: 120px;">Amount</th>
												<th style="width: 50px;">
													<button type="button" class="btn btn-xs btn-success btn-add"><i class="fa fal fa-plus-circle"></i></button>
												</th>
											</tr>
										</thead>
										<tbody></tbody>
										<tfoot>
											<tr>
												<td colspan="4" class="text-center">Total Transaction <span class="balance_status text text-danger"></span></td>
												<td class="text-right"><b><span class="grand_amount"></span></b></td>
												<td></td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Save</button>
							<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Cancel</a>
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
			<td class="text-center">
				<div class="form-check form-check-inline">
					<input class="form-check-input position" type="radio" name="t_finance_detail[x][position]" id="inlineRadio1[x]" value="debet" checked>
					<label class="form-check-label" for="inlineRadio1[x]">Debet</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input position" type="radio" name="t_finance_detail[x][position]" id="inlineRadio2[x]" value="credit">
					<label class="form-check-label" for="inlineRadio2[x]">Credit</label>
				</div>
			</td>
			<td>
				<div class="input-group input-group-sm">
					<input type="text" class="form-control form-control form-control-sm x-readonly nama_akun" placeholder="Select account..." required>
					<input type="hidden" class="id_akun" name="t_finance_detail[x][id_akun]" value="" />
					<div class="input-group-append">
						<button type="button" class="btn btn-default btn-search-akun" data-toggle="modal" data-target="#m_akun_modal"><i class="fal fa-search"></i></button>
					</div>
				</div>
			</td>
			<td><input type="text" name="t_finance_detail[x][description]" class="form-control form-control-sm" value="" required></td>
			<!-- <td>
				<input type="text" class="form-control form-control-sm input-mask qty" name="t_finance_detail[x][qty]" placeholder="" data-inputmask="'alias': 'currency', 'prefix': '', 'suffix': '', 'allowMinus': false" value="0" required />
			</td>
			<td>
				<input type="text" class="form-control form-control-sm input-mask jumlah_rp" name="t_finance_detail[x][jumlah_rp]" placeholder="" data-inputmask="'alias': 'currency', 'prefix': '', 'suffix': '', 'allowMinus': false" value="0" required />
			</td> -->
			<td>
				<input type="text" class="form-control form-control-sm input-mask amount" name="t_finance_detail[x][amount]" placeholder="" data-inputmask="'alias': 'currency', 'prefix': '', 'suffix': '', 'allowMinus': false" value="0" required />
				<input type="hidden" class="jumlah_rp" name="t_finance_detail[x][jumlah_rp]" value="0">
			</td>
			<td class="text-center">
				<a href="javascript://" class="btn btn-xs btn-danger btn-delete-row"><i class="fal fal fa-trash"></i></a>
			</td>
		</tr>
	</tbody>
</table>
