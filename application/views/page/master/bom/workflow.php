<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">DPS</a></li>
		<li class="breadcrumb-item">Master</li>
		<li class="breadcrumb-item">BOM</li>
		<li class="breadcrumb-item"><?=$t_bom->kode_bom?></li>
		<li class="breadcrumb-item active">Workflow</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			BOM Workflow<small><?=$t_bom->kode_bom?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<input type="hidden" name="id_bom" value="<?=$t_bom->id_bom?>"/>
					<a href="<?=base_url('master/bom/workflow_add/'.$t_bom->id_bom)?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> Add Workflow</a>
					<a href="<?=base_url('master/bom')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Back</a>
				</div>
				<div class="card-body">
					<dl class="row">
						<dt class="col-sm-2">BOM Code</dt>
						<dd class="col-sm-10"><?=$t_bom->kode_bom?></dd>
						<dt class="col-sm-2">BOM Date</dt>
						<dd class="col-sm-10"><?=date('d-m-Y', strtotime($t_bom->tanggal_bom))?></dd>
						<dt class="col-sm-2">SO Number</dt>
						<dd class="col-sm-10"><?=$t_bom->kode_po?></dd>
						<dt class="col-sm-2">PO Buyer</dt>
						<dd class="col-sm-10"><?=$t_bom->po_buyer?></dd>
						<dt class="col-sm-2">Job Number</dt>
						<dd class="col-sm-10"><?=$t_bom->no_job?></dd>
						<dt class="col-sm-2">Customer</dt>
						<dd class="col-sm-10"><?=$t_bom->nama_supplier?></dd>
						<dt class="col-sm-2">Item Product</dt>
						<dd class="col-sm-10"><?=$t_bom->nama_barang?></dd>
						<dt class="col-sm-2">Item Quantity</dt>
						<dd class="col-sm-10"><?=$t_bom->qty?> <?=$t_bom->kode_satuan?></dd>
					</dl>
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
					<input type="hidden" class="filter_exc_id_class" value="2">
					<form method="post" action="<?=base_url('master/bom/detail_update')?>">
						<input type="hidden" name="id_bom" value="<?=$t_bom->id_bom?>">
						<input type="hidden" name="deleted_bom_detail" id="deleted_bom_detail"/>
								<?php
                                $j = 0;
                                foreach ($t_bom_workflow as $bom_workflow):
									?>
									<div class="form-group row">
										<label class="control-label col-md-12"><h4><?=$bom_workflow->nama_workflow?></h4></label>
										<?php $bagians = json_decode(sterilizeJSON($bom_workflow->rincian)); ?>
										<?php foreach ($bagians as $bagian): ?>
											<div class="col-md-12">
												<table class="table table-hover table-bordered table-sm w-100" id="dt-<?=$bagian->id_bom_workflow?>" role="grid">
													<thead>
													<tr class="bg-gray-300 row-bagian">
														<td colspan="5"><b><?=$bagian->nama_bagian?></b></td>
														<td class="text-center"><a href="<?=base_url('master/bom/workflow_edit/'.$bagian->id_bom_workflow)?>"><i class="fa fal fa-edit"></i> Edit</a></td>
													</tr>
													<tr class="text-center">
														<th>No</th>
														<th>Item Material </th>
														<th style="width: 100px;">Quantity</th>
														<th style="width: 100px;">Unit</th>
														<th style="width: 100px;">Percent Waste</th>
														<th style="width: 60px;">
															<button data-id="<?=$bagian->id_bom_workflow?>" type="button" class="btn btn-xs btn-success btn-add" data-toggle="modal" data-target="#m_sub_barang_modal"><i class="fa fal fa-plus-circle"></i></button>
														</th>
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
															<td class="text-center"><button type="button" class="btn btn-xs btn-danger btn-delete"><i class="fa fal fa-trash"></i></button></td>
														</tr>
														<?php $j++; ?>
													<?php endforeach; ?>
													</tbody>
												</table>
											</div>
										<?php endforeach; ?>
									</div>
								<?php endforeach; ?>
						<button class="btn btn-sm btn-success" type="submit"><i class="fa fal fa-save"></i> Save</button>
					</form>
					<input type="hidden" name="data_count" value="<?=$j?>"/>
				</div>
			</div>
		</div>
	</div>
</main>
