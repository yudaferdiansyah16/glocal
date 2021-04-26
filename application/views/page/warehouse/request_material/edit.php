	<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Warehouse</li>
		<li class="breadcrumb-item">Request Material</li>
		<li class="breadcrumb-item active">Edit</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Edit Request Material <small><?=$t_request->kode_request?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url($_controller.'/'.$_method.'/update')?>">
						<input type="hidden" name="t_request[id_request]" value="<?=$t_request->id_request?>">
						<input type="hidden" name="deleted_detail" id="deleted_detail" value="[]"/>
						<div class="form-group row">
							<div class="col-md-2">
								<label class="form-label">Type of Request</label>
								<input type="text" class="form-control form-control-sm form-control-plaintext" value="<?=$t_request->nama_jenis_mutasi?>">
							</div>
							<div class="col-md-2">
								<label class="form-label">Request Date</label>
								<input type="text" class="form-control form-control-sm form-control-plaintext" placeholder="Select date" value="<?=date('d-m-Y', strtotime($t_request->tgl_request))?>">
							</div>
							<div class="col-md-7">
								<label class="form-label">BOM</label>
								<input type="text" class="form-control form-control-sm form-control-plaintext" value="<?=$t_request->kode_bom .' - '.$t_request->nama_barang." , Size: ".$t_request->size?>">
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

												</th>
											</tr>
											<tr class="text-center">
												<th class="align-middle" style="width: 120px;">Stock</th>
												<th class="align-middle" style="width: 120px;">Pending</th>
												<th class="text-center align-middle" style="width: 120px;">Request</th>
											</tr>
										</thead>
										<tbody>
										<?php foreach($t_request_detail as $i => $detail): ?>
										<tr data-index="<?=$i?>">
											<td class="text-center"><?=($i+1)?></td>
											<td>
												<p class="nama_barang" style="margin: 0;padding: 0"><?=$detail->nama_barang?></p>
												<small class="kode_barang" style="margin: 0;padding: 0"><?=$detail->kode_barang?></small>
												<input type="hidden" class="id_request_detail" name="t_request_detail[<?=$i?>][id_request_detail]" value="<?=$detail->id_request_detail?>"/>
												<input type="hidden" class="id_sub_barang" name="t_request_detail[<?=$i?>][id_sub_barang]" value="<?=$detail->id_sub_barang?>"/>
												<input type="hidden" class="id_satuan" name="t_request_detail[<?=$i?>][id_satuan]" value="<?=$detail->id_satuan?>"/>
											</td>
											<td class="text-center"><?=$detail->size?></td>
											<td class="text-right">
												<span class="qty_stock"><?=number_format($detail->qty_stock, 2)?></span><br>
												<small class="kode_satuan"><?=$detail->kode_satuan?></small>
											</td>
											<td class="text-right">
												<span class="qty_stock"><?=number_format($detail->qty_pending - $detail->qty_request, 2)?></span><br>
												<small class="kode_satuan"><?=$detail->kode_satuan?></small>
											</td>
											<td>
												<input type="text" class="form-control form-control-sm input-mask qty_request" data-inputmask="'alias': 'currency', 'prefix': '', 'max': '<?=($detail->qty_stock- $detail->qty_pending+$detail->qty_request)?>'" name="t_request_detail[<?=$i?>][qty_request]" value="<?=$detail->qty_request?>"/>
											</td>
											<td class="text-center">

											</td>
										</tr>
										<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<hr>
						<div class="form-group row">
							<div class="col-md-12">
								<label class="form-label">Request Note</label>
								<textarea class="form-control form-control-sm" name="t_request[deskripsi]"><?=$t_request->deskripsi?></textarea>
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
				<p class="no_job"></p>
				<input type="hidden" class="id_job" name="t_wh_buffer[x][id_job]"/>
				<input type="hidden" class="id_production" name="t_wh_buffer[x][id_production]"/>
				<input type="hidden" class="id_detail_dn" name="t_wh_buffer[x][id_detail_dn]"/>
				<input type="hidden" class="harga_satuan" name="t_wh_buffer[x][harga_satuan]"/>
				<input type="hidden" class="rate" name="t_wh_buffer[x][rate]"/>
			</td>
			<td>
				<p class="nama_barang" style="margin: 0;padding: 0"></p>
				<small class="kode_barang" style="margin: 0;padding: 0"></small>
				<input type="hidden" class="id_sub_barang" name="t_wh_buffer[x][id_sub_barang]"/>
				<input type="hidden" class="id_satuan_terkecil" name="t_wh_buffer[x][id_satuan_terkecil]"/>
				<input type="hidden" class="id_satuan_terbesar" name="t_wh_buffer[x][id_satuan_terbesar]"/>
			</td>
			<td>
				<span class="nama_gudang"></span><br>
				<small class="nama_koordinat"></small>
				<input type="hidden" class="id_koordinat" name="t_wh_buffer[x][id_koordinat]"/>
			</td>
			<td class="text-right">
				<span class="qty_stock"></span><br>
				<small class="kode_satuan"></small>
			</td>
			<td>
				<input type="text" class="form-control form-control-sm input-mask qty" data-inputmask="'alias': 'currency', 'prefix': ''" name="t_wh_buffer[x][qty]" value="0"/>
			</td>
			<td class="text-center">
				<button class="btn btn-xs btn-danger btn-delete-row"><i class="fa fal fa-trash"></i></button>
			</td>
		</tr>
	</tbody>
</table>
