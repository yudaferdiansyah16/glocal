<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Warehouse</li>
		<li class="breadcrumb-item">Stuffing</li>
		<li class="breadcrumb-item"><?=$t_stuffing->kode_stuffing?></li>
		<li class="breadcrumb-item active">Edit</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Edit Stuffing <small><?=$t_stuffing->kode_stuffing?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('warehouse/stuffing/update')?>" autocomplete="off">
						<input type="hidden" name="t_stuffing[id_stuffing]" value="<?=$t_stuffing->id_stuffing?>">
						<div class="form-group row">
							<div class="col-md-4">
								<label class="form-label">Customer</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly nama_supplier" readonly placeholder="Select Customer..." value="<?=$t_stuffing->nama_supplier?>">
									<input type="hidden" class="id_supplier" name="t_stuffing[id_supplier]" value="<?=$t_stuffing->id_supplier?>"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#referensi_pemasok_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label class="form-label">Type of Sales</label>
								<select class="form-control form-control-sm id_tipe_sales" name="t_stuffing[id_tipe_sales]" required>
									<?=createOption($m_tipe_sales, 'id_tipe_sales', array('nama_tipe_sales'), ' - ', $t_stuffing->id_tipe_sales)?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-2">
								<label class="form-label">Stuffing Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker tanggal_stuffing x-readonly" placeholder="Select date" name="t_stuffing[tanggal_stuffing]" value="<?=date('d-m-Y', strtotime($t_stuffing->tanggal_stuffing))?>" required>
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
									<input type="text" name="t_stuffing[destination]" class="form-control form-control form-control-sm x-readonly destination" readonly placeholder="Select destination..." value="<?=$t_stuffing->destination?>">
									<div class="input-group-append">
										<button type="button" class="btn btn-sm btn-default btn-search-destination" data-toggle="modal" data-target="#detail_supplier_destination_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label">Country</label>
								<input type="hidden" name="t_stuffing[id_country]" class="id_country" value="<?=$t_stuffing->id_country?>">
								<input type="text" class="form-control form-control form-control-sm x-readonly uraian_negara" value="<?=$t_stuffing->uraian_negara?>" readonly>
							</div>
							<div class="col-md-3">
								<label class="form-label">Shipping Line</label>
								<input type="text" class="form-control form-control-sm" name="t_stuffing[shipping_line]" placeholder="" value="<?=$t_stuffing->shipping_line?>"/>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-2">
								<label class="form-label">Container Number</label>
								<input type="text" class="form-control form-control-sm" name="t_stuffing[container_number]" placeholder="" value="<?=$t_stuffing->container_number?>"/>
							</div>
							<div class="col-md-2">
								<label class="form-label">Container Size</label>
								<select class="form-control form-control-sm id_ukuran_kontainer" name="t_stuffing[id_ukuran_kontainer]" required>
									<option value="">Choose Size...</option>
									<?=createOption($referensi_ukuran_container, 'ID', array('URAIAN_UKURAN_KONTAINER'), ' - ', $t_stuffing->id_ukuran_kontainer)?>
								</select>
							</div>
							<div class="col-md-2">
								<label class="form-label">Seal Number</label>
								<input type="text" class="form-control form-control-sm" name="t_stuffing[seal_number]" placeholder="" value="<?=$t_stuffing->seal_number?>"/>
							</div>
							<div class="col-md-2">
								<label class="form-label">Loading Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker loading_date x-readonly" readonly placeholder="Select date" name="t_stuffing[loading_date]" value="<?=!empty($t_stuffing->loading_date) ? date('d-m-Y', strtotime($t_stuffing->loading_date)) : ""?>">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label">Closing Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker closing_date x-readonly" readonly placeholder="Select date" name="t_stuffing[closing_date]" value="<?=!empty($t_stuffing->closing_date) ? date('d-m-Y', strtotime($t_stuffing->closing_date)) : ""?>">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label">BL Number</label>
								<input type="text" class="form-control form-control-sm" name="t_stuffing[no_bl]" placeholder="" value="<?=$t_stuffing->no_bl?>"/>
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
												<th rowspan="2">Job<br>Number</th>
												<th rowspan="2">Warehouse<br>Transaction</th>
												<th rowspan="2">WH<br>Qty</th>
												<th colspan="2">Plan</th>
												<!--<th colspan="2">Stuffing</th>-->
												<th rowspan="2" style="width: 80px;">
													Netto<br>(KGM)
												</th>
												<th rowspan="2" style="width: 80px;">
													Bruto<br>(KGM)
												</th>
												<th rowspan="2">
													<button type="button" class="btn btn-success btn-xs btn-add-row" data-toggle="modal" data-target="#t_wh_detail_stuffing_modal"><i class="fa fal fa-plus-circle"></i></button>
												</th>
											</tr>
											<tr class="text-center">
												<th style="width: 90px;">Quantity</th>
												<th style="width: 80px;">MC</th>
												<!--												<th style="width: 110px;">MC</th>-->
												<!--												<th style="width: 120px;">Quantity</th>-->
											</tr>
										</thead>
										<tbody>
										<?php foreach ($t_detail_stuffing as $i => $detail): ?>
											<tr data-index="<?=$i?>">
												<td class="text-center"><?=($i+1)?></td>
												<td>
													<input type="hidden" class="id_detail_stuffing" name="t_detail_stuffing[<?=$i?>][id_detail_stuffing]" value="<?=$detail->id_detail_stuffing?>"/>
													<input type="hidden" class="id_sub_barang" name="t_detail_stuffing[<?=$i?>][id_sub_barang]" value="<?=$detail->id_sub_barang?>"/>
													<input type="hidden" class="id_detail_po" name="t_detail_stuffing[<?=$i?>][id_detail_po]" value="<?=$detail->id_detail_po?>"/>
													<input type="hidden" class="id_wh_detail" name="t_detail_stuffing[<?=$i?>][id_wh_detail]" value="<?=$detail->id_wh_detail?>"/>
													<input type="hidden" class="id_kemasan" name="t_detail_stuffing[<?=$i?>][id_kemasan]" value="<?=$detail->id_kemasan?>"/>
													<input type="hidden" class="nilai_kemasan" value="<?=$detail->nilai_kemasan?>"/>
													<span class="nama_sub_barang"><?=$detail->nama_barang?></span><br>
													<small class="kode_barang"><?=$detail->kode_barang?></small>
												</td>
												<td>
													<span class="no_job"><?=$detail->no_job?></span><br>
													<small>Job Date: <span class="tanggal_job"><?=date('d-m-Y', strtotime($detail->tanggal_job))?></span></small>
												</td>
												<td>
													<span class="kode_mutasi"><?=$detail->kode_mutasi?></span><br>
													<small>Trans. Date: <span class="tanggal_terima"><?=date('d-m-Y', strtotime($detail->tanggal_terima))?></span></small>
												</td>
												<td class="text-right">
													<span class="qty_remain"><?=floatval($detail->qty_remain)+floatval($detail->qty_si_plan)?></span><br>
													<small class="kode_satuan"><?=$detail->kode_satuan?></small>
												</td>
												<td>
													<div class="input-group input-group-sm">
														<input type="text" name="t_detail_stuffing[<?=$i?>][qty_si_plan]" class="form-control form-control-sm input-mask qty_si_plan" data-inputmask="'alias': 'currency', 'prefix': ''" value="<?=$detail->qty_si_plan?>"/>
													</div>
												</td>
												<td>
													<div class="input-group input-group-sm">
														<input type="text" name="t_detail_stuffing[<?=$i?>][qty_mc_plan]" class="form-control form-control-sm input-mask qty_mc_plan" data-inputmask="'alias': 'currency', 'prefix': '', 'digits': '0'" value="<?=$detail->qty_si_plan?>" readonly/>
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
													<input type="text" name="t_detail_stuffing[<?=$i?>][netto]" class="form-control form-control-sm input-mask qty" data-inputmask="'alias': 'currency', 'prefix': '', 'digits': '0'" value="<?=$detail->netto?>"/>
												</td>
												<td>
													<input type="text" name="t_detail_stuffing[<?=$i?>][bruto]" class="form-control form-control-sm input-mask qty" data-inputmask="'alias': 'currency', 'prefix': '', 'digits': '0'" value="<?=$detail->bruto?>"/>
												</td>
												<td class="text-center">
													<a href="javascript://" class="btn btn-xs btn-danger btn-delete-row"><i class="fal fal fa-trash"></i></a>
												</td>
											</tr>
										<?php endforeach; ?>
										</tbody>
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
			<input type="hidden" class="id_sub_barang" name="t_detail_stuffing[x][id_sub_barang]" value=""/>
			<input type="hidden" class="id_detail_po" name="t_detail_stuffing[x][id_detail_po]" value=""/>
			<input type="hidden" class="id_wh_detail" name="t_detail_stuffing[x][id_wh_detail]" value=""/>
			<input type="hidden" class="id_kemasan" name="t_detail_stuffing[x][id_kemasan]" value=""/>
			<input type="hidden" class="nilai_kemasan" value=""/>
			<span class="nama_sub_barang"></span><br>
			<small class="kode_barang"></small>
		</td>
		<td>
			<span class="no_job"></span><br>
			<small>Job Date: <span class="tanggal_job"></span></small>
		</td>
		<td>
			<span class="kode_mutasi"></span><br>
			<small>Trans. Date: <span class="tanggal_terima"></span></small>
		</td>
		<td class="text-right">
			<span class="qty_remain"></span><br>
			<small class="kode_satuan"></small>
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" name="t_detail_stuffing[x][qty_si_plan]" class="form-control form-control-sm input-mask qty_si_plan" data-inputmask="'alias': 'currency', 'prefix': ''" value="0"/>
			</div>
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" name="t_detail_stuffing[x][qty_mc_plan]" class="form-control form-control-sm input-mask qty_mc_plan" data-inputmask="'alias': 'currency', 'prefix': '', 'digits': '0'" value="0" readonly/>
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
