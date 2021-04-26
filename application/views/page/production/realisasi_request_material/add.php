<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Production</li>
		<li class="breadcrumb-item">Request Material</li>
		<li class="breadcrumb-item active">Realisasi</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Realisasi Request Material
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-8 col-xl-8">
			<div class="card mb-g">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<form method="post" action="<?=base_url('production/realisasi_request_material/store')?>">
								<div class="form-group row">
									<table class="table table-sm table-borderless" style="table-layout: fixed">
										<tr>
											<td><b>Kode Material Request</b></td>
											<td><b>Tanggal Request</b></td>
											<td><b>Job</b></td>
											<td><b>Tanggal Realisasi</b></td>
										</tr>
										<tr>
											<td>
												<input type="text" class="form-control form-control-sm x-readonly" readonly value="<?=placeValue($requestheader,'kode_mutasi')?>">
											</td>
											<td>
												<input type="text" class="form-control form-control-sm x-readonly" readonly value="<?=placeValue($requestheader,'tanggal_mutasi')?>">
											</td>
											<td>
												<input type="text" class="form-control form-control-sm x-readonly" readonly value="<?=placeValue($jobdt,'no_job')?>">
											</td>
											<td>
												<div class="input-group input-group-sm">
													<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="t_production[tanggal_mutasi]">
													<div class="input-group-append">
														<span class="input-group-text fs-xl">
															<i class="fa fal fa-calendar"></i>
														</span>
													</div>
												</div>
												<input type="hidden" name="t_production[id_detail_dn]" value="<?=placeValue($requestheader,'id_detail_dn')?>">
												<input type="hidden" name="t_production[id_job]" value="<?=placeValue($requestheader,'id_job')?>">
												<input type="hidden" name="t_production[id_master]" value="<?=placeValue($requestheader,'id_production')?>">
												<input type="hidden" name="t_production[id_jenis_mutasi]" value="14">
											</td>
										</tr>
									</table>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="table-responsive">
											<table class="table table-hover table-bordered table-striped table-sm" id="dt_request_add" role="grid">
												<thead>
												<tr>
													<th class="text-center">No</th>
													<th class="text-center">Item Code</th>
													<th class="text-center">Item Name</th>
													<th class="text-center">Qty Request</th>
													<th class="text-center">Qty Realization</th>
												</tr>
												</thead>
												<tbody>
												<?php $i=1; foreach ($requestdetail as $row) { ?>
												<tr>
													<td class="text-center">
														<?=$i?>
													</td>
													<td>
														<?=placeValue($row,'kode_barang')?>
													</td>
													<td>
														<?=placeValue($row,'nama_barang')?>
													</td>
													<td>
														<?=placeValue($row,'qty_sisa')?>
													</td>
													<td>
														<input type="number" class="form-control form-control-sm" name="tproduction_detail[<?=$i?>][qty]" step="0.01" min="0" max="<?=placeValue($row,'qty')?>">
														<input type="hidden" name="tproduction_detail[<?=$i?>][id_wh_detail]" value="<?=placeValue($row,'id_wh_detail')?>">
														<input type="hidden" name="tproduction_detail[<?=$i?>][id_job]" value="<?=placeValue($row,'id_job')?>">
														<input type="hidden" name="tproduction_detail[<?=$i?>][SERI_BARANG]" value="<?=placeValue($row,'SERI_BARANG')?>">
														<input type="hidden" name="tproduction_detail[<?=$i?>][id_sub_barang]" value="<?=placeValue($row,'id_sub_barang')?>">
														<input type="hidden" name="tproduction_detail[<?=$i?>][id_jenis_mutasi]" value="14">
													</td>
												</tr>
												<?php $i++; } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="form-group">
									<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
									<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<table class="x-hidden table-template">
	<tbody>
	<tr>
		<td class="text-center">1</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" class="form-control form-control-sm" name="nama_barang" placeholder="" value="<?=isset($nama_barang) ? $nama_barang : ''?>"/>
				<input type="hidden" name="id_barang" value="<?=isset($id_barang) ? $id_barang : ''?>"/>
				<input type="hidden" name="id_satuan_terkecil" value="<?=isset($id_satuan_terkecil) ? $id_satuan_terkecil : ''?>"/>
				<input type="hidden" name="id_satuan_terbesar" value="<?=isset($id_satuan_terbesar) ? $id_satuan_terbesar : ''?>"/>
				<input type="hidden" name="kode_hs" value="<?=isset($kode_hs) ? $kode_hs : ''?>"/>
				<input type="hidden" name="id_kategori" value="<?=isset($id_kategori) ? $id_kategori : ''?>"/>
				<input type="hidden" name="id_class" value="<?=isset($id_class) ? $id_class : ''?>"/>
				<input type="hidden" name="id_asal" value="<?=isset($id_asal) ? $id_asal : ''?>"/>
				<input type="hidden" name="id_brand" value="<?=isset($id_brand) ? $id_brand : ''?>"/>
				<input type="hidden" name="style" value="<?=isset($style) ? $style : ''?>"/>
				<input type="hidden" name="colour" value="<?=isset($colour) ? $colour : ''?>"/>
				<input type="hidden" name="size" value="<?=isset($size) ? $size : ''?>"/>
				<input type="hidden" name="dimensi" value="<?=isset($dimensi) ? $dimensi : ''?>"/>
				<div class="input-group-append">
					<button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#m_barang_modal"><i class="fal fa-search"></i></button>
				</div>
			</div>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="quantity" placeholder="" value="<?=isset($quantity) ? $quantity : ''?>"/>
		</td>
		<td class="text-center">
			<button class="btn btn-xs btn-danger btn-delete-row"><i class="fa fal fa-trash"></i></button>
		</td>
	</tr>
	</tbody>
</table>
