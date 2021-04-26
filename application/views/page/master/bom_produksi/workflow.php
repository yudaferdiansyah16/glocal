<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">SMARTONE</a></li>
		<li class="breadcrumb-item">Master</li>
		<li class="breadcrumb-item">BOM</li>
		<li class="breadcrumb-item"><?=placeValue($t_bom,'kode_bom')?></li>
		<li class="breadcrumb-item active">Workflow</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			BOM Workflow<small><?=placeValue($t_bom,'kode_bom')?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<input type="hidden" name="id_bom" value="<?=placeValue($t_bom,'id_bom')?>"/>
<!--					<a href="--><?//=base_url('master/bom_produksi/workflow_add/'.placeValue($t_bom,'id_bom'))?><!--" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> Add Workflow</a>-->
					<a href="<?=base_url('master/bom_produksi/bom_print/'.placeValue($t_bom,'id_bom'))?>" class="btn btn-sm btn-info"><i class="fal fa fa-print"></i> Print BOM</a>
					<div class="dropdown open" style="display: inline-block;">
						<button class="btn btn-sm btn-default dropdown-toggle" type="button" id="triggerId"
								data-toggle="dropdown" aria-haspopup="true"
								aria-expanded="false">
							<i class="fal fa-file-alt"></i> Production Intructions
						</button>
						<div class="dropdown-menu" aria-labelledby="triggerId">
							<a class="dropdown-item" href="#" data-toggle="modal" data-target="#pi_modal"><i class="fal fa-eye"></i> View</a>
							<a class="dropdown-item" href="<?=base_url('master/bom_produksi/pi_print/'.$t_bom->id_bom)?>"><i class="fal fa-print"></i> Print</a>
						</div>
					</div>
					<div class="dropdown open" style="display: inline-block;">
						<button class="btn btn-sm btn-default dropdown-toggle" type="button" id="triggerId"
								data-toggle="dropdown" aria-haspopup="true"
								aria-expanded="false">
							<i class="fal fa-file-alt"></i> SPK
						</button>
						<div class="dropdown-menu" aria-labelledby="triggerId">
							<a class="dropdown-item" href="#" data-toggle="modal" data-target="#all_spk_modal"><i class="fal fa-eye"></i> View</a>
							<a class="dropdown-item" href="<?=base_url('master/bom_produksi/all_spk_print/'.$t_bom->id_bom)?>"><i class="fal fa-print"></i> Print</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-8">
							<dl class="row">
								<dt class="col-sm-3">BOM Code</dt>
								<dd class="col-sm-9"><?=$t_bom->kode_bom?></dd>
								<dt class="col-sm-3">BOM Date</dt>
								<dd class="col-sm-9"><?=date('d-m-Y', strtotime($t_bom->tanggal_bom))?></dd>
								<dt class="col-sm-3">SO Number</dt>
								<dd class="col-sm-9"><?=$t_bom->kode_po?>, PO Buyer: #<?=$t_bom->po_buyer?></dd>
								<dt class="col-sm-3">Customer</dt>
								<dd class="col-sm-9"><?=$t_bom->nama_supplier?></dd>
								<dt class="col-sm-3">Item Product</dt>
								<dd class="col-sm-9"><?=$t_bom->nama_barang?></dd>
								<dt class="col-sm-3">Size</dt>
								<dd class="col-sm-9"><?=(!empty($t_bom->size) ? $t_bom->size : '-')?></dd>
								<dt class="col-sm-3">Item Quantity</dt>
								<dd class="col-sm-9"><?=$t_bom->qty?> <?=$t_bom->kode_satuan?> Tolerance: (-<?=number_format($t_bom->qty_min_percent, 2)?>% +<?=number_format($t_bom->qty_max_percent, 2)?>%)</dd>
								<!--<dt class="col-sm-3">Production Instruction</dt>
								<dd class="col-sm-9"><button type="button" class="btn btn-xs btn-default"><i class="fal fa-search"> View</i></button> <a href="<?/*=base_url('master/bom_produksi/pi_print/'.$t_bom->id_bom)*/?>" class="btn btn-xs btn-default"><i class="fal fa-print"> Print</i></a></dd>
								<dt class="col-sm-3">Print All SPK</dt>
								<dd class="col-sm-9"><button type="button" class="btn btn-xs btn-default" data-toggle="modal" data-target="#all_spk_modal"><i class="fal fa-search"> View</i></button> <a href="<?/*=base_url('master/bom_produksi/all_spk_print/'.$t_bom->id_bom)*/?>" class="btn btn-xs btn-default"><i class="fal fa-print"> Print</i></a></dd>-->
							</dl>
						</div>
						<input type="hidden" class="bom_image" value="<?=site_url('upload/bom/'.$t_bom->image_file)?>">
						<div class="col-md-4">
							<form method="post" enctype="multipart/form-data" action="<?=base_url('master/bom_produksi/image_update')?>">
								<input type="hidden" name="id_bom" value="<?=$t_bom->id_bom?>">
								<input id="file-0a" name="bom_image" type="file">
							</form>
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
							<td class="text-center"><button type="button" class="btn btn-xs btn-danger btn-delete"><i class="fa fal fa-trash"></i></button></td>
						</tr>
						</tbody>
					</table>
					<hr>
					<input type="hidden" class="filter_exc_id_class" value="2">
					<div class="row">
						<div class="col-md-12">
							<form method="post" action="<?=base_url('master/bom_produksi/detail_update')?>">
								<input type="hidden" name="id_bom" value="<?=$t_bom->id_bom?>">
								<input type="hidden" name="deleted_bom_detail" id="deleted_bom_detail"/>
								<?php
								$j = 0;
								foreach ($t_bom_workflow as $bom_workflow):
									?>
									<div class="form-group row">
										<label class="control-label col-md-12"><h4><a href="<?=base_url('master/bom_produksi/spk_print/'.$bom_workflow->id_bom.'/'.$bom_workflow->id_workflow)?>"><b><i class="fal fa-print"></i> <?=$bom_workflow->nama_workflow?></b></a></h4></label>
										<?php $bagians = json_decode(sterilizeJSON($bom_workflow->rincian)); ?>
										<?php foreach ($bagians as $bagian): ?>
											<div class="col-md-12">
												<table class="table table-hover table-bordered table-sm w-100" id="dt-<?=$bagian->id_bom_workflow?>" role="grid">
													<thead>
													<tr class="bg-gray-300 row-bagian">
														<td colspan="3"><b><?=$bagian->nama_bagian?></b></td>
														<td colspan="2" class="text-center">
															<a href="<?=base_url('master/bom_produksi/instruction_edit/'.$bagian->id_bom_workflow)?>"><i class="fa fal fa-edit"></i> Edit Instruction</a>
														</td>
														<!--<td class="text-center"><a href="<?/*=base_url('master/bom_produksi/workflow_edit/'.$bagian->id_bom_workflow)*/?>"><i class="fa fal fa-edit"></i> Edit</a></td>-->
													</tr>
													<tr class="text-center">
														<th style="width: 50px;">No</th>
														<th>Item Material </th>
														<th style="width: 100px;">Quantity</th>
														<th style="width: 100px;">Unit</th>
														<th style="width: 100px;">Percent Waste</th>
														<!--<th style="width: 60px;">
															<button data-id="<?/*=$bagian->id_bom_workflow*/?>" type="button" class="btn btn-xs btn-success btn-add" data-toggle="modal" data-target="#m_sub_barang_modal"><i class="fa fal fa-plus-circle"></i></button>
														</th>-->
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
																<input type="text" name="t_bom_detail[<?=$j?>][qty_bom]" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" value="<?=$detail->qty_bom?>"/>
															</td>
															<td class="text-center">
																<?php
																$satuan_terkecil = false;
																if ($detail->id_satuan_terbesar != $detail->id_satuan_terkecil && $detail->id_satuan_terkecil != null) $satuan_terkecil = true;

																$isterkecil = "1";
																if($satuan_terkecil) $isterkecil = "0";
																?>
																<select class="form-control form-control-sm id_satuan" name="t_bom_detail[<?=$j?>][id_satuan]">
																	<option value="<?=$detail->id_satuan_terbesar?>" <?=($detail->id_satuan_terbesar == $detail->id_satuan ? 'selected' : '')?> data-terkecil="<?=$isterkecil?>"><?=$detail->kode_satuan_terbesar?></option>
																	<?php if($detail->id_satuan_terkecil != $detail->id_satuan_terbesar): ?>
																		<option value="<?=$detail->id_satuan_terkecil?>" <?=($detail->id_satuan_terkecil == $detail->id_satuan ? 'selected' : '')?> data-terkecil="1"><?=$detail->kode_satuan_terkecil?></option>
																	<?php endif; ?>
																</select>
																<input type="hidden" class="isterkecil" name="t_bom_detail[<?=$j?>][isterkecil]" value="<?=$isterkecil?>"/>
															</td>
															<td class="text-right">
																<input type="text" name="t_bom_detail[<?=$j?>][prosentase_waste]" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" value="<?=$detail->prosentase_waste?>"/>
															</td>
															<!--<td class="text-center"><button type="button" class="btn btn-xs btn-danger btn-delete"><i class="fa fal fa-trash"></i></button></td>-->
														</tr>
														<?php $j++; ?>
													<?php endforeach; ?>
													</tbody>
												</table>
											</div>
										<?php endforeach; ?>
									</div>
								<?php endforeach; ?>
								<input type="hidden" name="data_count" value="<?=$j?>"/>
								<hr>
								<button class="btn btn-sm btn-success" type="submit"><i class="fa fal fa-save"></i> <?=$this->lang->line('button_save')?></button>
								<a href="<?=base_url('master/bom_produksi')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Back</a>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<div class='modal fade modal-fullscreen' id='pi_modal' tabindex='-1' role='dialog' aria-hidden='true'>
	<div class='modal-dialog modal-dialog-centered' role='document'>
		<div class='modal-content'>
			<div class='modal-header'>
				<h5 class='modal-title'>Production Instruction</h5>
				<button type='button' class='close' data-dismi	ss='modal' >&times;</button>
			</div>
			<div class='modal-body'>
				<div class='row'>
					<div class='col-sm-12 col-lg-12 col-xl-12'>
						<div data-size="A4">
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
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6 text-left">
									<p class="fw-300 display-4 fw-500 color-primary-600 keep-print-font l-h-n m-0">
										Production Instruction
									</p>
								</div>
								<div class="col-sm-6 text-right">
									<div class="text-dark fw-700 h1 mb-g keep-print-font">
										<p># <?=$t_bom->kode_bom?></p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-9">
									<dl class="row">
										<dt class="col-sm-3">BOM Date</dt>
										<dd class="col-sm-9"><?=date('d-m-Y', strtotime($t_bom->tanggal_bom))?></dd>
										<dt class="col-sm-3">SO Number</dt>
										<dd class="col-sm-9"><?=$t_bom->kode_po?>, PO Buyer: #<?=$t_bom->po_buyer?></dd>
										<dt class="col-sm-3">Customer</dt>
										<dd class="col-sm-9"><?=$t_bom->nama_supplier?></dd>
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
									<?=$t_bom->note?>
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
				</div>
			</div>
		</div>
	</div>
</div>
