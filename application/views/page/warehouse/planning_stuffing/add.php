<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Warehouse</li>
		<li class="breadcrumb-item active">Planning Stuffing</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Planning Stuffing
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('warehouse/planning_stuffing/store')?>">
						<input type="hidden" class="is_approved" value="true">
						<div class="form-group row">
							<div class="col-md-6">
								<label class="form-label">SO Code</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly kode_po" readonly placeholder="Select SO Number...">
									<input type="hidden" name="t_po[id_detail_po]" value=""/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#t_so_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
								<label class="form-label">Customer</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm nama_supplier x-readonly" readonly/>
								</div>
								<label class="form-label">Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="tanggal_aju">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
								<label class="form-label">Loading Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="tanggal_aju">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
								<label class="form-label">Closing Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="tanggal_terakhir">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
								<br>
								<div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input" id="lockdokumen" name="lockdokumen">
									<label class="custom-control-label" for="lockdokumen" name="lockdokumen">Lock Document</label>
								</div>
							</div>
							<div class="col-md-6">
								<label class="form-label">No Job</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly no_job" readonly placeholder="Select No Job...">
									<input type="hidden" name="id_job" value=""/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#t_job_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
								<label class="form-label">Shipping Line</label>
								<input type="text" class="form-control form-control-sm" name="shipping_line" placeholder=""/>
								<label class="form-label">Container Number</label>
								<input type="text" class="form-control form-control-sm" name="no_container" placeholder="" />
								<label class="form-label">Seal Number</label>
								<input type="text" class="form-control form-control-sm" name="no_seal" placeholder=""/>
								<label class="form-label">Destination</label>
								<input type="text" class="form-control form-control-sm" name="destination" placeholder=""/>
								<label class="form-label">Country</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly KODE_NEGARA" readonly placeholder="Select negara...">
									<input type="hidden" name="referensi_negara[ID]"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#referensi_negara_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-sm" id="table_detail">
										<thead>
										<tr>
											<th class="text-center">No</th>
											<th class="text-center">Item Code</th>
											<th class="text-center">Description</th>
											<th class="text-center">Unit</th>
											<th class="text-center">Quantity Unit</th>
											<th class="text-center">Packaging</th>
											<th class="text-center">Quantity Packaging</th>
											<th class="text-center">Bruto</th>
											<th class="text-center">Netto</th>
											<th class="text-center">
												<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#t_po_detail_planning_stuffing_modal"><i class="fal fa-plus-circle"></i></button>
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
							<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
						</div>
					</form>
					<table class="x-hidden" id="template_row">
						<tbody>
						<tr data-index="x">
							<td class="text-center"></td>
							<td>
								<input type="text" class="form-control form-control-sm x-readonly kode_barang" name="t_po_detail_planning_stuffing[x][kode_barang]" readonly placeholder="" value=""/>
							</td>
							<td>
								<input type="text" class="form-control form-control-sm x-readonly keterangan" name="t_po_detail_planning_stuffing[x][keterangan]" readonly placeholder=""/>
							</td>
							<td>
								<input type="text" class="form-control form-control-sm x-readonly id_satuan" name="t_po_detail_planning_stuffing[x][id_satuan]" readonly placeholder="" value=""/>
							</td>
							<td>
								<input type="text" class="form-control form-control-sm x-readonly qty_po" name="t_po_detail_planning_stuffing[x][qty_po]" readonly placeholder="" value=""/>
							</td>
							<td>
								<input type="text" class="form-control form-control-sm x-readonly kode_kemasan" name="t_po_detail_planning_stuffing[x][kode_kemasan]" readonly placeholder="" value=""/>
							</td>
							<td>
								<input type="text" class="form-control form-control-sm x-readonly qty_mc" name="t_po_detail_planning_stuffing[x][qty_mc]" readonly placeholder="" value=""/>
							</td>
							<td>
								<input type="text" class="form-control form-control-sm x-readonly bruto" name="t_po_detail_planning_stuffing[x][]" placeholder="" value=""/>
							</td>
							<td>
								<input type="text" class="form-control form-control-sm x-readonly netto" name="t_po_detail_planning_stuffing[x][]" placeholder="" value=""/>
							</td>
							<td class="text-center">
								<button type="button" class="btn btn-xs btn-danger btn-delete"><i class="fa fal fa-trash"></i></button>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</main>

