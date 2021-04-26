<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Exim</li>
		<li class="breadcrumb-item">Purchase Return</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Purchase Return
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?= base_url('exim/purchase_return/store') ?>">
						<div class="form-group row">
                            <div class="col-sm-12 col-lg-9">
								<label class="form-label">Receive Notes</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-readonly kode_dn" readonly placeholder="" />
									<input type="hidden" class="form-control form-control-sm id_dn" name="t_return[id_dn]" />
									<div class="input-group-append">
										<button type="button" class="btn btn-default searchbtn" data-toggle="modal" data-target="#t_dn_return_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-3">
								<label class="form-label">Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly x-datepicker" placeholder="Select date" name="t_return[tanggal_return]" value="<?=date('d-m-Y')?>" required>
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<label class="form-label">Return Notes</label>
								<textarea class="form-control form-control-sm" name="t_return[keterangan]" rows="5"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-12">
								<div class="table-responsive">
									<table class="table table-hover table-bordered table-striped table-sm dt_return_add" id="dt_return_add" role="grid">
										<thead>
											<tr>
												<th class="text-center">No</th>
												<th class="text-center">Kode RN</th>
												<th class="text-center">Nama Barang</th>
												<th class="text-center">Quantity RN</th>
												<th class="text-center">Quantity Return</th>
												<th class="text-center">Remark</th>
												<th class="text-center">
													<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#t_detail_dn_return_modal"><i class="fal fa-plus-circle"></i></button>
												</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Save</button>
							<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Cancel</a>
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
				<p style="margin:0;padding:0;"><span id="kode_dn"></span></p>
				<small><span id="tanggal_dn"></span></small>
				<input type="hidden" class="id_detail_dn" name="t_return_detail[x][id_detail_dn]" />
			</td>
			<td>
				<p id="nama_barang" style="margin: 0;padding: 0"></p>
				<small id="kode_barang" style="margin: 0;padding: 0"></small>
            </td>
            <td class="text-right">
                <p id="qty_dn" style="margin: 0;padding: 0"></p>
			</td>
			<td>
                <input type="number" class="form-control form-control-sm input_mask" data-inputmask="'alias': 'currency', 'prefix': ''" min="0" step="0.01" max="" id="qty_return" name="t_return_detail[x][qty]"/>
			</td>
			<td>
                <input type="text" class="form-control form-control-sm"name="t_return_detail[x][keterangan]"/>
			</td>
			<td class="text-center">
				<button class="btn btn-xs btn-danger btn-delete"><i class="fa fal fa-trash"></i></button>
			</td>
		</tr>
	</tbody>
</table>
