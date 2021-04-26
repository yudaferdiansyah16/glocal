<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Warehouse</li>
		<li class="breadcrumb-item">Receive Material</li>
		<li class="breadcrumb-item"><?=$t_wh->kode_mutasi?></li>
		<li class="breadcrumb-item active">Edit</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Edit Receive Material<small><?=$t_wh->kode_mutasi?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('warehouse/receive_material/update')?>">
						<input type="hidden" name="t_wh[id_wh]" value="<?=$t_wh->id_wh?>">
						<div class="form-group row">
							<div class="col-md-4">
								<label class="form-label">RN Number</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly kode_dn" readonly placeholder="Select DN..." value="<?=$t_wh->kode_dn?>">
								</div>
							</div>
							<div class="col-md-4">
								<label class="form-label">Supplier</label>
								<input type="text" class="form-control form-control-sm form-control-plaintext nama_supplier x-readonly" placeholder="" value="<?=$t_wh->nama_supplier?>" readonly/>
							</div>
							<div class="col-md-2">
								<label class="form-label">Invoice</label>
								<input type="text" class="form-control form-control form-control-sm form-control-plaintext x-readonly no_invoice" value="<?=$t_wh->no_invoice?>" readonly>
							</div>
							<div class="col-md-2">
								<label class="form-label">Invoice Date</label>
								<input type="text" class="form-control form-control-sm form-control-plaintext x-readonly tgl_invoice" value="<?=(!empty($t_wh->tgl_invoice) ? date('d-m-Y', strtotime($t_wh->tgl_invoice)) : '-')?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-2">
								<label class="form-label">Tax Invoice</label>
								<input type="text" class="form-control form-control form-control-sm form-control-plaintext x-readonly no_faktur" value="<?=$t_wh->no_faktur?>" readonly>
							</div>
							<div class="col-md-2">
								<label class="form-label">Tax Invoice Date</label>
								<input type="text" class="form-control form-control-sm form-control-plaintext x-readonly tgl_kedatangan" value="<?=(!empty($t_wh->tgl_faktur) ? date('d-m-Y', strtotime($t_wh->tgl_faktur)) : '-')?>" readonly>
							</div>
							<div class="col-md-2">
								<label class="form-label">Submission No.</label>
								<input type="text" class="form-control form-control-sm form-control-plaintext no_aju x-readonly" value="<?=!empty($t_wh->NOMOR_AJU) ? $t_wh->NOMOR_AJU : '-'?>" placeholder="" readonly/>
							</div>
							<div class="col-md-2">
								<label class="form-label">Submission Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm form-control-plaintext x-readonly" readonly>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label">Registration No.</label>
								<input type="text" class="form-control form-control-sm form-control-plaintext no_pend x-readonly" value="<?=$t_wh->NOMOR_DAFTAR?>" placeholder="" readonly/>
							</div>
							<div class="col-md-2">
								<label class="form-label">Registration Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm form-control-plaintext x-readonly" value="<?=(!empty($t_wh->TANGGAL_DAFTAR) ? date('d-m-Y', strtotime($t_wh->TANGGAL_DAFTAR)) : '-')?>" readonly>
								</div>
							</div>
						</div>
						<hr>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="dt" class="table table-striped table-bordered table-sm table-hover">
										<thead>
											<tr class="text-center">
												<th rowspan="2">No.</th>
												<th rowspan="2">Item Material</th>
												<th rowspan="2">Job Number</th>
												<th rowspan="2">PO Number</th>
												<th rowspan="2">RN Number</th>
												<th rowspan="2">Receive<br>Quantity</th>
												<th rowspan="2" style="width: 150px;">Warehouse<br>Location</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($t_wh_detail as $i => $detail): ?>
											<tr>
												<td class="text-center"><?=($i+1)?></td>
												<td>
													<input type="hidden" class="id_detail_dn" name="t_wh_detail[<?=$i?>][id_detail_dn]" value="<?=$detail->id_detail_dn?>">
													<input type="hidden" class="id_wh_detail" name="t_wh_detail[<?=$i?>][id_wh_detail]" value="<?=$detail->id_wh_detail?>">
													<input type="hidden" class="id_wh" name="t_wh_detail[<?=$i?>][id_wh]" value="<?=$detail->id_wh?>">
													<input type="hidden" class="id_header" name="t_wh_detail[<?=$i?>][id_header]" value="<?=$detail->id_header?>">
													<input type="hidden" class="seri_barang" name="t_wh_detail[<?=$i?>][seri_barang]" value="<?=$detail->seri_barang?>">
													<input type="hidden" class="harga_satuan" name="t_wh_detail[<?=$i?>][harga_satuan]" value="<?=$detail->harga?>">
													<input type="hidden" class="rate" name="t_wh_detail[<?=$i?>][rate]" value="<?=$detail->rate?>">
													<span class="nama_sub_barang"><?=$detail->nama_barang?></span><br>
													<small><span class="kode_barang"><?=$detail->kode_barang?></span></small>
												</td>
												<td>
													<span class="no_job"><?=$detail->no_job?></span><br>
													<small>RN Date: <span class="tanggal_job"><?=(!empty($detail->tanggal_job) ? date('d-m-Y', strtotime($detail->tanggal_job)) : '-')?></span></small>
												</td>
												<td>
													<span class="kode_po"><?=$detail->kode_po?></span><br>
													<small>PO Date: <span class="tanggal_dibuat"><?=(!empty($detail->tanggal_dibuat) ? date('d-m-Y', strtotime($detail->tanggal_dibuat)) : '-')?></span></small>
												</td>
												<td>
													<span class="no_sj"><?=$detail->no_sj?></span><br>
													<small>RN Date: <span class="tanggal_sj"><?=(!empty($detail->tanggal_sj) ? date('d-m-Y', strtotime($detail->tanggal_sj)) : '-')?></span></small>
												</td>
												<td class="text-right">
													<span class="qty_dn"><?=number_format($detail->qty_dn, 2)?></span><br>
													<small class="kode_satuan"><?=$detail->kode_satuan_terkecil?></small>
													<input type="hidden" name="t_wh_detail[<?=$i?>][qty]" class="form-control form-control-sm qty" value="<?=$detail->qty_dn?>" readonly/>
												</td>
												<td class="text-center">
													<select class="form-control form-control-sm id_koordinat" name="t_wh_detail[<?=$i?>][id_koordinat]" required>
														<option value="">Choose Coordinate...</option>
														<?=createOption($m_koordinat, 'id_koordinat', array('nama_gudang', 'nama_koordinat'),' - ', $detail->id_koordinat)?>
													</select>
												</td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
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
