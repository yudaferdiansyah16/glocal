<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Production</li>
		<li class="breadcrumb-item active">Realisasi Material</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Realisasi Material
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12">
			<div class="card mb-g">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<form method="post" action="<?=base_url($_controller.'/'.$_method.'/store')?>">
								<div class="form-group row">
									<div class="col-md-8">
										<label class="form-label">BOM</label>
										<select class="form-control form-control-sm id_bom" name="t_production[id_bom]">
										</select>
									</div>
									<div class="col-md-4">
										<label class="form-label">Workflow</label>
										<select class="form-control form-control-sm id_bom_workflow" name="t_production[id_bom_workflow]">
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-3">
										<label class="form-label">Customer</label>
										<input type="text" class="form-control form-control-sm form-control-plaintext nama_supplier" value="">
									</div>
									<div class="col-md-2">
										<label class="form-label">PO Buyer</label>
										<input type="text" class="form-control form-control-sm form-control-plaintext po_buyer" value="">
									</div>
									<div class="col-md-3">
										<label class="form-label">FG Product</label>
										<input type="text" class="form-control form-control-sm form-control-plaintext nama_barang" value="">
									</div>
									<div class="col-md-2">
										<label class="form-label">Workflow</label>
										<input type="text" class="form-control form-control-sm form-control-plaintext nama_workflow" value="">
									</div>
									<div class="col-md-2">
										<label class="form-label">Part Name</label>
										<input type="text" class="form-control form-control-sm form-control-plaintext nama_part" value="">
									</div>
								</div>
								<hr>
								<div class="form-group row">
									<div class="col-md-12">
										<div class="table-responsive">
											<table class="table table-sm table-striped table-bordered">
												<thead>
													<tr class="text-center">
														<th>No.</th>
														<th>Job No</th>
														<th>DN Number</th>
														<th>Material Name</th>
														<th>Qty</th>
														<th style="width: 50px;"><button type="button" class="btn btn-xs btn-success"><i class="fal fa-plus-circle"></i></button></th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
									<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
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
