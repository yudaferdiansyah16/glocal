	<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Warehouse</li>
		<li class="breadcrumb-item">Request Material</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Request Material
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url($_controller.'/'.$_method.'/store')?>">
						<div class="form-group row">
							<div class="col-md-3">
								<label class="form-label">Type of Request</label>
								<select class="form-control form-control-sm id_jenis_mutasi" name="t_request[id_jenis_mutasi]" required>
									<option value="">Choose Type of Issue...</option>
									<?php foreach($m_jenis_mutasi as $item): ?>
									<option value="<?=$item->id_jenis_mutasi?>"><?=$item->nama_jenis_mutasi?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-md-2">
								<label class="form-label">Request Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" placeholder="Select date" name="t_request[tgl_request]" value="<?=date('d-m-Y')?>" required>
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-7 section-production" style="display: none;">
								<label class="form-label">BOM</label>
								<select class="form-control form-control-sm id_bom" name="t_request[id_bom]">
								</select>
							</div>
							<div class="col-md-7 section-sales" style="display: none;">
								<label class="form-label">Sales Order</label>
								<select class="form-control form-control-sm id_po" name="t_request[id_po]">
								</select>
							</div>
						</div>
						<hr>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-hover table-bordered table-striped table-sm" id="dt_request_add" role="grid">
										<thead class="table-secondary">
											<tr class="text-center align-middle">
												<th rowspan="2" width="20px" class="align-middle">No</th>
												<th rowspan="2" class="align-middle">Item</th>
												<th rowspan="2" class="align-middle" style="width: 150px;">Size</th>
												<th colspan="3" class="align-middle">Quantity</th>
												<th rowspan="2" class="align-middle" style="width: 50px;">
													<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#t_stock_request_modal"><i class="fal fa-plus-circle"></i></button>
												</th>
											</tr>
											<tr class="text-center">
												<th class="align-middle" style="width: 120px;">Stock</th>
												<th class="align-middle" style="width: 120px;">Pending</th>
												<th class="text-center align-middle" style="width: 120px;">Request</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<hr>
						<div class="form-group row">
							<div class="col-md-12">
								<label class="form-label">Request Note</label>
								<textarea class="form-control form-control-sm" name="t_request[deskripsi]"></textarea>
							</div>
						</div>
						<hr>
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
<table class="x-hidden table_template">
	<tbody>
	<tr data-index="x">
		<td class="text-center">1</td>
		<td>
			<p class="nama_barang" style="margin: 0;padding: 0"></p>
			<small class="kode_barang" style="margin: 0;padding: 0"></small>
			<input type="hidden" class="id_sub_barang" name="t_request_detail[x][id_sub_barang]"/>
			<input type="hidden" class="id_satuan" name="t_request_detail[x][id_satuan]"/>
		</td>
		<td class="text-center"><span class="size"></span></td>
		<td class="text-right">
			<span class="qty_stock"></span><br>
			<small class="kode_satuan"></small>
		</td>
		<td class="text-right">
			<span class="qty_pending"></span><br>
			<small class="kode_satuan"></small>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm input-mask qty_request" data-inputmask="'alias': 'currency', 'prefix': ''" name="t_request_detail[x][qty_request]" value="0"/>
		</td>
		<td class="text-center">
			<button class="btn btn-xs btn-danger btn-delete-row"><i class="fa fal fa-trash"></i></button>
		</td>
	</tr>
	</tbody>
</table>
