	<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Warehouse</li>
		<li class="breadcrumb-item">Issue Material</li>
		<li class="breadcrumb-item active">Edit</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Edit Issue Material <small><?=$t_wh->kode_mutasi?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url($_controller.'/'.$_method.'/update')?>">
						<input type="hidden" name="t_wh[id_wh]" value="<?=$t_wh->id_wh?>">
						<input type="hidden" name="deleted_detail" id="deleted_detail" value="[]"/>
						<div class="form-group row">
							<div class="col-md-3">
								<label class="form-label">Type of Issue</label>
								<select class="form-control form-control-sm select2" name="t_wh[id_jenis_mutasi]" required disabled>
									<option value="">Choose Type of Issue...</option>
									<?php foreach($m_jenis_mutasi as $item): ?>
									<option value="<?=$item->id_jenis_mutasi?>" <?=($item->id_jenis_mutasi == $t_wh->id_jenis_mutasi ? "selected" : "")?>><?=$item->nama_jenis_mutasi?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-md-2">
								<label class="form-label">Issue Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly" placeholder="Select date" value="<?=date('d-m-Y', strtotime($t_wh->tanggal_terima))?>" required>
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="x-hidden template_request">
									<label class="form-label">No Job</label>
									<div class="input-group input-group-sm">
										<input type="text" class="form-control form-control form-control-sm x-readonly no_job" readonly>
										<input type="hidden" class="id_job"/>
										<div class="input-group-append">
											<button type="button" class="btn btn-default" data-toggle="modal" data-target="#t_job_modal"><i class="fal fa-search"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-hover table-bordered table-striped table-sm" id="dt_request_add" role="grid">
										<thead>
											<tr class="text-center">
												<th class="text-center" width="20px">No</th>
												<th class="text-center" style="width: 150px;">No Job</th>
												<th class="text-center">Item</th>
												<th class="text-center">Location</th>
												<th class="text-center">Stock</th>
												<th class="text-center" style="width: 120px;">Issue</th>
												<th class="text-center" style="width: 50px;">
													<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#t_wh_detail_stock_modal"><i class="fal fa-plus-circle"></i></button>
												</th>
											</tr>
										</thead>
										<tbody>
										<?php foreach($t_wh_buffer as $i => $detail): ?>
										<tr data-index="<?=$i?>">
											<td class="text-center"><?=($i+1)?></td>
											<td>
												<p class="no_job"><?=$detail->no_job?></p>
												<input type="hidden" class="id_wh_buffer" name="t_wh_buffer[<?=$i?>][id_wh_buffer]" value="<?=$detail->id_wh_buffer?>"/>
												<input type="hidden" class="id_job" name="t_wh_buffer[<?=$i?>][id_job]" value="<?=$detail->id_job?>"/>
												<input type="hidden" class="id_production" name="t_wh_buffer[<?=$i?>][id_production]" value="<?=$detail->id_production?>"/>
												<input type="hidden" class="id_detail_dn" name="t_wh_buffer[<?=$i?>][id_detail_dn]" value="<?=$detail->id_detail_dn?>"/>
												<input type="hidden" class="harga_satuan" name="t_wh_buffer[<?=$i?>][harga_satuan]" value="<?=$detail->harga_satuan?>"/>
												<input type="hidden" class="rate" name="t_wh_buffer[<?=$i?>][rate]" value="<?=$detail->rate?>"/>
											</td>
											<td>
												<p class="nama_barang" style="margin: 0;padding: 0"><?=$detail->nama_barang?></p>
												<small class="kode_barang" style="margin: 0;padding: 0"><?=$detail->kode_barang?></small>
												<input type="hidden" class="id_sub_barang" name="t_wh_buffer[<?=$i?>][id_sub_barang]" value="<?=$detail->id_sub_barang?>"/>
												<input type="hidden" class="id_satuan" name="t_wh_buffer[<?=$i?>][id_satuan]" value="<?=$detail->id_satuan?>"/>
											</td>
											<td>
												<span class="nama_gudang"><?=$detail->nama_gudang?></span><br>
												<small class="nama_koordinat"><?=$detail->nama_koordinat?></small>
												<input type="hidden" class="id_koordinat_asal" name="t_wh_buffer[<?=$i?>][id_koordinat_asal]" value="<?=$detail->id_koordinat_asal?>"/>
											</td>
											<td class="text-right">
												<span class="qty_stock"><?=number_format($detail->qty_stock, 2)?></span><br>
												<small class="kode_satuan"><?=$detail->kode_satuan?></small>
											</td>
											<td>
												<input type="text" class="form-control form-control-sm input-mask qty" data-inputmask="'alias': 'currency', 'prefix': '', 'max': '<?=($detail->qty+$detail->qty_stock)?>'" name="t_wh_buffer[<?=$i?>][qty]" value="<?=$detail->qty?>"/>
											</td>
											<td class="text-center">
												<button class="btn btn-xs btn-danger btn-delete-row"><i class="fa fal fa-trash"></i></button>
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
								<label class="form-label">Issue Note</label>
								<textarea class="form-control form-control-sm" name="t_wh[deskripsi]"></textarea>
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
