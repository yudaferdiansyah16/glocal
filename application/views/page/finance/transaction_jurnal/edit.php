<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item">Transaction</li>
		<li class="breadcrumb-item">General Journal</li>
		<li class="breadcrumb-item active">Edit</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Edit General Journal
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<label class="form-label">Transaction No : <?= $data->no_trans ?> </label>
					<form method="post" action="<?= base_url('finance/transaction_jurnal/update') ?>">
						<input name="t_finance[id_finance]" type="hidden" value="<?= $data->id_finance ?>">
						<input type="hidden" name="deleted_finance_detail" id="deleted_finance_detail"/>
						<div class="form-group row">
							<div class="col-md-2">
								<label class="form-label">Date</label>
								<div class="input-group input-group-sm">
									<input type="text"
										class="form-control form-control form-control-sm "
										readonly placeholder="Select date" name="t_finance[tgl_trans]"
										value="<?= reverseDate($data->tgl_trans) ?>">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label class="form-label">Description</label>
								<textarea class="form-control trans_description" name="t_finance[trans_description]" placeholder="Description..."><?= $data->trans_description ?></textarea>
							</div>
							<!-- <div class="col-md-3">
								<label class="form-label">Type Journal</label>
								<select class="form-control form-control-sm select2" name="t_finance[id_jenis_jurnal]">
									<?=createOption($jenis_jurnal, 'id',array('kode_jenis_jurnal','nama_jenis_jurnal'),' - ')?>
								</select>
							</div> -->
							<!-- <div class="col-md-3">
								<label class="form-label">Currency</label>
								<select name="t_finance[id_valuta]" class="form-control form-control-sm id_valuta"
									required>
									<option value="<?=$data->id_valuta?>" selected="selected">
										[<?=$data->KODE_VALUTA?>] <?=$data->URAIAN_VALUTA?>
									</option>
								</select>
							</div> -->
							<div class="col-md-2">
								<label class="form-label">Currency</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly nama_valuta" readonly placeholder="Select currency..." value="<?=$data->KODE_VALUTA?>" required>
									<input type="hidden" name="t_finance[id_valuta]" value="<?=$data->id_valuta?>"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_valuta_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label">Rate</label>
								<input type="text" class="form-control form-control-sm input-mask rate"
									name="t_finance[rate]" 
									data-inputmask="'alias': 'currency', 'prefix': ''" value="<?= $data->rate ?>"
									required />
							</div>
						</div>
						<div class="from-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="dt" class="table table-sm table-bordered table-striped table-hover">
										<thead>
											<tr class="text-center">
												<th style="width: 30px;">No.</th>
												<th style="width: 150px;">Position</th>
												<th style="width: 300px;">Account</th>
												<th>Description</th>
												<th style="width: 120px;">Amount</th>
												<th style="width: 50px;">
													<button type="button" class="btn btn-xs btn-success btn-add"><i class="fa fal fa-plus-circle"></i></button>
												</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($detail as $i => $r) { ?>
											<!-- <input name="t_finance[id_finance]" type ="hidden" value="<?= $r->id_finance ?>"> -->
											<tr data-index="<?= $i ?>">
												<td class="text-center">
													<?= $i+1 ?>
												</td>
												<td>
													<input type="hidden" class="id_finance_detail"
														name="t_finance_detail[<?= $i ?>][id_finance_detail]"
														value="<?= placeValue($r, 'id_finance_detail') ?>" />
													<div class="form-check form-check-inline">
														<label class="form-check-label">Debet&nbsp;</label>
														<input class="form-check-input position" type="radio"
															name="t_finance_detail[<?= $i ?>][position]"
															id="inlineRadio1[<?= $i ?>]" <?php if($r->amount >= 0){?>
															checked='checked' <?php }?> value="debet">
													</div>
													<div class="form-check form-check-inline">
														<input class="form-check-input position" type="radio"
															name="t_finance_detail[<?= $i ?>][position]"
															id="inlineRadio2[<?= $i ?>]" <?php if($r->amount < 0){?>
															checked='checked' <?php }?> value="credit">
														<label class="form-check-label">Credit</label>
													</div>
												</td>

												<td>
													<select class="id_akun" name="t_finance_detail[<?= $i ?>][id_akun]"
														required>
														<option value="<?=$r->id_akun?>" selected="selected">
															[<?=$r->kode_akun?>] <?=$r->nama_akun?></option>
													</select>
												</td>
												<td>
													<input type="text" name="t_finance_detail[<?= $i ?>][description]"
														class="form-control form-control-sm"
														value="<?= placeValue($r, 'description') ?>" required>
												</td>
												<td>
													<input type="text"
														class="form-control form-control-sm input-mask amount"
														name="t_finance_detail[<?= $i ?>][amount]" 
														data-inputmask="'alias': 'currency', 'prefix': '<?php if($r->amount < 0){?>(<?php } ?>', 'suffix': '<?php if($r->amount < 0){?>)<?php } ?>', 'allowMinus': false"
														value="<?= placeValue($r, 'amount') ?>" required />
												</td>
												<td class="text-center">
													<!-- <button type="button" class="btn btn-xs btn-danger btn-delete"><i
															class="fa fal fa-trash"></i></button> -->
													<button type="button" class="btn btn-xs btn-danger btn-delete-row"><i class="fa fal fa-trash"></i></button>
												</td>
											</tr>
											<?php } ?>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="4" class="text-center">Total Transaction <span
														class="balance_status text text-danger"></span></td>
												<td class="text-right"><b><span class="grand_amount"></span></b></td>
												<td></td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
						<div class="form-group">
							<button id="simpan" type="submit" class="btn btn-sm btn-success"><i
									class="fal fa fa-save"></i>
								Save</button>
							<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i
									class="fal fa-times-circle"></i> Cancel</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
<table class="x-hidden" id="template-row">
	<tbody>
		<tr data-index="[x]">
			<td class="text-center">1</td>
			<td class="text-center">
				<div class="form-check form-check-inline">
					<input class="form-check-input position" type="radio" name="t_finance_detail[x][position]"
						id="inlineRadio1[x]" value="debet" checked>
					<label class="form-check-label" for="inlineRadio1[x]">Debet</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input position" type="radio" name="t_finance_detail[x][position]"
						id="inlineRadio2[x]" value="credit">
					<label class="form-check-label" for="inlineRadio2[x]">Credit</label>
				</div>
			</td>
			<td>
				<select class="id_akun" name="t_finance_detail[x][id_akun]" required></select>
			</td>
			<td><input type="text" name="t_finance_detail[x][description]" class="form-control form-control-sm" value=""
					required></td>
			<td>
				<input type="text" class="form-control form-control-sm input-mask amount"
					name="t_finance_detail[x][amount]" 
					data-inputmask="'alias': 'currency', 'prefix': '', 'suffix': '', 'allowMinus': false" value="0"
					required />
				<input type="hidden" class="jumlah_rp" name="t_finance_detail[x][jumlah_rp]" value="0">
			</td>
			<td class="text-center">
				<button type="button" class="btn btn-xs btn-danger btn-delete-row"><i class="fa fal fa-trash"></i></button>
				<!-- <a href="javascript://" class="btn btn-xs btn-danger btn-delete-row"><i
						class="fal fal fa-trash"></i></a> -->
			</td>
		</tr>
	</tbody>
</table>
