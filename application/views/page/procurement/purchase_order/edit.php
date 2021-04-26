<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Procurement</li>
		<li class="breadcrumb-item">Purchase Order</li>
		<li class="breadcrumb-item active">Edit</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Edit Purchase Order
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('procurement/purchase_order/update')?>">
						<input type="hidden" name="t_po[id_po]" value="<?=placeValue($poheader,'id_po')?>">
						<input type="hidden" id="deleted_detail_po" name="deleted_detail_po">
						<div class="form-group row">
							<div class="col-md-3">
								<label class="form-label">Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly x-datepicker" readonly placeholder="Select date" id="date" name="t_po[tanggal_dibuat]" value="<?=$poheader->tanggal_dibuat?>">
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
									<input type="text" class="form-control form-control form-control-sm x-readonly x-datepicker" readonly placeholder="Select date" id="date" name="t_po[tanggal_dibutuhkan]" value="<?=placeValue($poheader,'tanggal_dibutuhkan')?>">
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
									<input type="text" class="form-control form-control-sm x-readonly nama_valuta" readonly value="[ <?=placeValue($poheader,'kode_valuta')?> ] <?=placeValue($poheader,'uraian_valuta')?>"/>
									<input type="hidden" class="form-control form-control-sm id_valuta" name="t_po[id_valuta]" value="<?=placeValue($poheader,'id_valuta')?>"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_valuta_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label class="form-label">Rate</label>
								<input type="text" class="form-control form-control-sm input-mask rates" name="t_po[rate]" data-inputmask="'alias': 'currency', 'prefix': ''" value="<?=placeValue($poheader,'rate')?>"/>
							</div>
							<div class="col-md-3">
								<label class="form-label">Supplier</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly nama_supplier" readonly value="<?=placeValue($poheader,'nama_supplier')?>"/>
									<input type="hidden" class="form-control form-control-sm id_supplier" name="t_po[id_supplier]" placeholder="" value="<?=placeValue($poheader,'id_supplier')?>"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#m_supplier_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-9">
								<label class="form-label">Alamat</label>
								<input type="text" class="form-control form-control-sm alamat_supplier x-readonly" readonly value="<?=placeValue($poheader,'alamat')?>"/>
							</div>	
							<div class="col-md-3">
								<label class="form-label">Down Payment</label>
								<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" name="t_po[down_payment]" value="<?=placeValue($poheader,'down_payment')?>"/>
							</div>
							<div class="col-md-3">
								<label class="form-label">Discount</label>
								<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" name="t_po[diskon]" value="<?=placeValue($poheader,'diskon')?>"/>
							</div>
							<div class="col-md-3">
								<label class="form-label">Tax</label>
								<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" name="t_po[pajak]" value="<?=placeValue($poheader,'pajak')?>"/>
							</div>
							<div class="col-md-3">
								<label class="form-label">PPh</label>
								<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" name="t_po[pph]" value="<?=placeValue($poheader,'pph')?>"/>
							</div>
							<div class="col-md-3">
								<label class="form-label">Shipping Cost</label>
								<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" name="t_po[biaya_kirim]" value="<?=placeValue($poheader,'biaya_kirim')?>"/>
							</div>
							<div class="col-md-3">
								<label class="form-label">Payment Term</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" name="t_po[payment_term]" value="<?=placeValue($poheader,'payment_term')?>"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default">days</button>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label class="form-label">Payment Method</label>
								<select class="form-control form-control-sm select2" name="t_po[id_jenis_pembayaran]">
									<option disabled selected>Select Payment Method . . .</option>
									<?=createOption($jenis_pembayaran,'id_jenis_pembayaran',array('jenis_pembayaran'),'-',$poheader->id_jenis_pembayaran)?>
								</select>
							</div>
							<div class="col-md-9">
								<label class="form-label">Remark PO</label>
								<input type="text" class="form-control form-control-sm" name="t_po[catatan_po]" value="<?=placeValue($poheader,'catatan_po')?>"/>
							</div>
							<div class="col-md-3">
								<label class="form-label">Filter Job</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly nama_job" readonly placeholder=""/>
									<input type="hidden" class="form-control form-control-sm id_job" placeholder=""/>
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
											<th class="text-center">No</th>
											<th class="text-center">No PP</th>
											<th class="text-center">Nama Barang</th>
											<th class="text-center">Price</th>
											<th class="text-center">Quantity</th>
											<th class="text-center">Remark</th>
											<th class="text-center">
												<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#t_detail_pp_po_modal"><i class="fal fa-plus-circle"></i></button>
											</th>
										</tr>
										</thead>
										<tbody>
										<?php $i = 0; ?>
										<?php foreach ($detail as $row) { $i++;?>
											<tr data-index="<?=$i?>">
												<td class="text-center"><?=$i?></td>
												<td>
													<p id="kode_pp"><?=$row->kode_pp?></p>
													<input type="hidden" class="id_detail_po" name="t_detail_po[<?=$i?>][id_detail_po]" value="<?=placeValue($row,'id_detail_po')?>"/>
													<input type="hidden" class="id_detail_pp" name="t_detail_po[<?=$i?>][id_detail_pp]" value="<?=placeValue($row,'id_detail_pp')?>"/>
													<input type="hidden" class="id_sub_barang" name="t_detail_po[<?=$i?>][id_sub_barang]" value="<?=placeValue($row,'id_sub_barang')?>"/>
												</td>
												<td>
													<p id="nama_barang" style="margin: 0;padding: 0"><?=placeValue($row,'nama_barang')?></p>
													<small id="kode_barang" style="margin: 0;padding: 0"><?=placeValue($row,'kode_barang')?></small>
												</td>
												<td>
													<input type="text" class="form-control form-control-sm harga input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" name="t_detail_po[<?=$i?>][harga]" value="<?=placeValue($row,'harga')?>"/>
												</td>
												<td>
													<input type="text" class="form-control form-control-sm qty_po input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" name="t_detail_po[<?=$i?>][qty_po]" placeholder="" step="0.0001" min="0" max="<?=placeValue($row,'qty_po')?>" value="<?=placeValue($row,'qty_po')?>"/>
												</td>
												<td>
													<input type="text" class="form-control form-control-sm keterangan" name="t_detail_po[<?=$i?>][keterangan]" value="<?=placeValue($row,'keterangan')?>"/>
												</td>
												<td class="text-center">
													<button type="button" class="btn btn-xs btn-danger btn-delete"><i class="fa fal fa-trash"></i></button>
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
							<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?> 	</a>
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
			<p id="kode_pp"></p>
			<input type="hidden" class="id_detail_pp" name="t_detail_po[x][id_detail_pp]"/>
			<input type="hidden" class="id_sub_barang" name="t_detail_po[x][id_sub_barang]"/>
		</td>
		<td>
			<p id="nama_barang" style="margin: 0;padding: 0"></p>
			<small id="kode_barang" style="margin: 0;padding: 0"></small>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm harga input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" name="t_detail_po[x][harga]"/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm qty_po input-mask qty_po" data-inputmask="'alias': 'currency', 'prefix': ''" name="t_detail_po[x][qty_po]" placeholder="" step="0.0001" min="0" max=""/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm keterangan" name="t_detail_po[x][keterangan]"/>
		</td>
		<td class="text-center">
			<button type="button" class="btn btn-xs btn-danger btn-delete"><i class="fa fal fa-trash"></i></button>
		</td>
	</tr>
	</tbody>
</table>
