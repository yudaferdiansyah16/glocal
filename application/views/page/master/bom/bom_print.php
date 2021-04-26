<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">SMARTONE</a></li>
		<li class="breadcrumb-item">Sales</li>
		<li class="breadcrumb-item">BOM</li>
		<li class="breadcrumb-item active">Print</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="container">
		<div data-size="A4">
			<!--HEADER-->
			<div class="row">
				<div class="col-sm-1">
					<div class="img-container mb-3 text-left">
						<img src="<?= assets_url('') ?>img/cop_sbp.png" alt="SBP" aria-roledescription="logo" width="100">
					</div>
				</div>
				<div class="col-sm-10">
					<div class="d-flex align-items-center">
						<h2 class="keep-print-font fw-700 mb-0 text-dark flex-1 position-relative" align="center">
							<?=$app->nama_sbu?>
						</h2>
					</div>
					<div class="d-flex align-items-center mb-6">
						<h6 class="keep-print-font fw-400 mb-0 text-dark flex-1 position-relative" align="center">
							<?=$app->alamat?>
						</h6>
					</div>
				</div>
				<div class="col-sm-1 text-right">
					<div id="qrcode"></div>
					<input type="hidden" id="kode_qrcode" value="<?=$t_bom->kode_bom?>">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 text-left">
					<p class="fw-300 display-4 fw-500 color-primary-600 keep-print-font l-h-n m-0">
						Bill of Material
					</p>
				</div>
				<div class="col-sm-6 text-right">
					<div class="text-dark fw-700 h1 mb-g keep-print-font">
						<p># <?=$t_bom->kode_bom?></p>
					</div>
				</div>
			</div>
			<!--END HEADER-->
			<div class="row">
				<div class="col-sm-9">
					<dl class="row">
						<dt class="col-sm-3">BOM Date</dt>
						<dd class="col-sm-9"><?=date('d-m-Y', strtotime($t_bom->tanggal_bom))?></dd>
						<dt class="col-sm-3">Item Product</dt>
						<dd class="col-sm-9"><?=$t_bom->nama_barang?></dd>
						<dt class="col-sm-3">Size</dt>
						<dd class="col-sm-9"><?=(!empty($t_bom->size) ? $t_bom->size : '-')?></dd>
						<dt class="col-sm-3">Item Quantity</dt>
						<dd class="col-sm-9"><?=$t_bom->qty?> <?=$t_bom->kode_satuan?> Tolerance: (-<?=number_format($t_bom->qty_min_percent, 2)?>% +<?=number_format($t_bom->qty_max_percent, 2)?>%)</dd>
					</dl>
				</div>
				<div class="col-sm-3 text-center" style="padding: 5px;border: 1px solid black;">
					<img src="<?=site_url('upload/bom/'.$t_bom->image_file)?>" style="max-height: 200px">
				</div>
			</div>
			<table class="x-hidden" id="template-row">
				<tbody>
				<tr class="row-detail" id="row-detail-x">
					<td class="text-center"></td>
					<td>
						<input type="hidden" name="t_bom_detail[x][id_bom_detail]" class="id_bom_detail" value=""/>
						<input type="hidden" name="t_bom_detail[x][id_bom_workflow]" class="id_bom_workflow" value=""/>
						<input type="hidden" name="t_bom_detail[x][id_sub_barang]" class="id_sub_barang" value=""/>
						<span class="nama_sub_barang"></span><br>
						<small class="kode_barang"></small>
					</td>
					<td class="text-right">
						<input type="text" name="t_bom_detail[x][qty_bom]" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" value="0"/>
					</td>
					<td class="text-center">
						<select class="form-control form-control-sm id_satuan" name="t_bom_detail[x][id_satuan]">
						</select>
						<input type="hidden" class="isterkecil" name="t_bom_detail[x][isterkecil]" value=""/>
					</td>
					<td class="text-right">
						<input type="text" name="t_bom_detail[x][prosentase_waste]" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" value="0"/>
					</td>
				</tr>
				</tbody>
			</table>
			<hr>
			<input type="hidden" class="filter_exc_id_class" value="2">
			<div class="row">
				<div class="col-md-12">
						<?php
						$j = 0;
						foreach ($t_bom_workflow as $bom_workflow):
							?>
							<div class="form-group row">
								<label class="control-label col-md-12"><h4><?=$bom_workflow->nama_workflow?></h4></label>
								<?php $bagians = json_decode(sterilizeJSON($bom_workflow->rincian)); ?>
								<?php foreach ($bagians as $bagian): ?>
									<div class="col-md-12">
										<table class="table table-bordered table-sm w-100" id="dt-<?=$bagian->id_bom_workflow?>" role="grid">
											<thead>
											<tr class="bg-gray-300 row-bagian">
												<td colspan="5"><b><?=$bagian->nama_bagian?></b></td>
											</tr>
											<tr class="text-center">
												<th>No</th>
												<th>Item Material </th>
												<th style="width: 100px;">Quantity</th>
												<th style="width: 100px;">Percent Waste</th>
											</tr>
											</thead>
											<tbody>
											<?php foreach ($bagian->detail as $i => $detail): ?>
												<tr class="row-detail" id="<?='row-detail-'.$j?>">
													<td class="text-center"><?=($i+1)?></td>
													<td>
														<input type="hidden" name="t_bom_detail[<?=$j?>][deleted_at]" class="deleted_at" value=""/>
														<input type="hidden" name="t_bom_detail[<?=$j?>][id_bom_detail]" class="id_bom_detail" value="<?=$detail->id_bom_detail?>"/>
														<input type="hidden" name="t_bom_detail[<?=$j?>][id_bom_workflow]" class="id_bom_workflow" value="<?=$bagian->id_bom_workflow?>"/>
														<input type="hidden" name="t_bom_detail[<?=$j?>][id_sub_barang]" class="id_sub_barang" value="<?=$detail->id_sub_barang?>"/>
														<span class="nama_sub_barang"><?=$detail->nama_sub_barang?></span><br>
														<small class="kode_barang"><?=$detail->kode_barang?></small>
													</td>
													<td class="text-right">
														<p style="margin: 0;padding: 0;"><?=number_format(floatval($detail->qty_bom),3)?></p>
														<small style="margin: 0;padding: 0;"><?=$detail->kode_satuan?></small>
													</td>
													<td class="text-right">
														<p style="margin: 0;padding: 0;"><?=number_format(floatval($detail->prosentase_waste),3)?></p>
														<small style="margin: 0;padding: 0;">%</small>
													</td>
												</tr>
												<?php $j++; ?>
											<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endforeach; ?>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-4 ml-sm-auto">
					<table class="table table-clean">
						<tbody>
						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
</main>

<nav class="shortcut-menu d-none d-sm-block">
	<input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
	<label for="menu_open" class="menu-open-button ">
		<span class="app-shortcut-icon d-block"></span>
	</label>
	<a href="#" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Scroll Top">
		<i class="fal fa-arrow-up"></i>
	</a>
	<a href="#" class="menu-item btn" data-action="app-fullscreen" data-toggle="tooltip" data-placement="left" title="Full Screen">
		<i class="fal fa-expand"></i>
	</a>
	<a href="#" class="menu-item btn" data-action="app-print" data-toggle="tooltip" data-placement="left" title="Print page">
		<i class="fal fa-print"></i>
	</a>
</nav>

