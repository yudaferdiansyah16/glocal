<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Warehouse</li>
		<li class="breadcrumb-item">Receive Material</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Receive Material
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('warehouse/receive_material/store')?>">
						<input type="hidden" class="id_dn" name="t_wh[id_dn]" value="">
						<div class="form-group row">
							<div class="col-md-4">
								<label class="form-label">RN Number</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly kode_dn" readonly placeholder="Select RN Number...">
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#t_dn_receive_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
                            <div class="col-md-4">
                                <label class="form-label">Supplier</label>
                                <input type="text" class="form-control form-control-sm form-control-plaintext nama_supplier x-readonly" placeholder="" readonly/>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Invoice</label>
                                <input type="text" class="form-control form-control form-control-sm form-control-plaintext x-readonly no_invoice" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Invoice Date</label>
                                <input type="text" class="form-control form-control-sm form-control-plaintext x-readonly tgl_invoice" readonly>
                            </div>
						</div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="form-label">Tax Invoice</label>
                                <input type="text" class="form-control form-control form-control-sm form-control-plaintext x-readonly no_faktur" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Tax Invoice Date</label>
                                <input type="text" class="form-control form-control-sm form-control-plaintext x-readonly tgl_faktur" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Submission No.</label>
                                <input type="text" class="form-control form-control-sm form-control-plaintext nomor_aju x-readonly" placeholder="" readonly/>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Submission Date</label>
                                <input type="text" class="form-control form-control-sm form-control-plaintext x-readonly tanggal_aju" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Registration No.</label>
                                <input type="text" class="form-control form-control-sm form-control-plaintext nomor_daftar x-readonly" placeholder="" readonly/>
                            </div>
							<div class="col-md-2">
								<label class="form-label">Registration Date</label>
								<input type="text" class="form-control form-control-sm form-control-plaintext x-readonly tanggal_daftar" readonly>
							</div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="form-label">Receive Date</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm x-datepicker tanggal_terima x-readonly" name="t_wh[tanggal_terima]" placeholder="Select date" value="<?=date('d-m-Y')?>" required>
                                    <div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
                                    </div>
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
												<th rowspan="2" style="width: 200px;">Job Number</th>
												<th rowspan="2">PO Number</th>
												<th rowspan="2">Delivery Note</th>
												<th rowspan="2">Receive<br>Quantity</th>
												<th rowspan="2" style="width: 150px;">Warehouse<br>Location</th>
											</tr>
										</thead>
										<tbody>
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
<table class="x-hidden" id="template-row">
	<tbody>
	<tr>
		<td class="text-center"></td>
		<td>
			<input type="hidden" class="id_detail_dn" name="t_wh_detail[x][id_detail_dn]" value="">
			<input type="hidden" class="harga_satuan" name="t_wh_detail[x][harga_satuan]" value="">
			<input type="hidden" class="rate" name="t_wh_detail[x][rate]" value="">
			<input type="hidden" class="id_header" name="t_wh_detail[x][id_header]" value="">
			<input type="hidden" class="id_sub_barang" name="t_wh_detail[x][id_sub_barang]" value="">
			<input type="hidden" class="id_job" name="t_wh_detail[x][id_job]" value="">
			<input type="hidden" class="seri_barang" name="t_wh_detail[x][seri_barang]" value="">
			<input type="hidden" class="id_satuan_terkecil" name="t_wh_detail[x][id_satuan_terkecil]" value="">
			<input type="hidden" class="id_satuan_terbesar" name="t_wh_detail[x][id_satuan_terbesar]" value="">
			<span class="nama_sub_barang"></span><br>
			<small><span class="kode_barang"></span></small>
		</td>
		<td>
			<span class="no_job"></span><br>
			<small>Job Date: <span class="tanggal_job"></span></small>
		</td>
		<td>
			<span class="kode_po"></span><br>
			<small>PO Date: <span class="tanggal_dibuat"></span></small>
		</td>
		<td>
			<span class="no_sj"></span><br>
			<small>DN Date: <span class="tanggal_sj"></span></small>
		</td>
		<td class="text-right">
			<span class="qty_dn"></span><br><small class="kode_satuan"></small>
			<input type="hidden" name="t_wh_detail[x][qty]" class="form-control form-control-sm qty" value="0" readonly/>
		</td>
		<!--<td class="text-right">
			<div class="input-group input-group-sm">
				<input type="text" class="form-control form-control-sm input-mask qty_return" data-inputmask="'alias': 'currency', 'prefix': ''" value="0" readonly/>
				<div class="input-group-append">
					<span class="input-group-text kode_satuan"></span>
				</div>
			</div>
		</td>-->
		<td class="text-center">
			<select class="form-control form-control-sm select2 id_koordinat" name="t_wh_detail[x][id_koordinat]" required>
				<option value="">Choose Coordinate...</option>
				<?=createOption($m_koordinat, 'id_koordinat', array('nama_gudang', 'nama_koordinat'),' - ')?>
			</select>
		</td>
	</tr>
	</tbody>
</table>
