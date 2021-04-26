<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Procurement</li>
		<li class="breadcrumb-item active">Purchase Requisition</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Purchase Requisition
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<a href="<?=base_url('procurement/purchase_requisition/add')?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> <?=$this->lang->line('button_add')?></a>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-3">
							<label class="form-label">Date</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-datepicker x-readonly tglawal" readonly placeholder="Select date" onchange="reloadDT('tglawal')">
								<div class="input-group-append">
									<button class="tglawalclose btn btn-sm btn-default x-hidden" onclick="removeFilter('tglawal')">
										<i class="text-danger fal fa-times"></i>
									</button>
									<button class="tglawalcal input-group-text fs-xl">
										<i class="fa fal fa-calendar"></i>
									</button>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<label class="form-label">&nbsp;</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-datepicker x-readonly tglakhir" readonly placeholder="Select date" onchange="reloadDT('tglakhir')">
								<div class="input-group-append">
									<button class="tglakhirclose btn btn-sm btn-default x-hidden" onclick="removeFilter('tglakhir')">
										<i class="text-danger fal fa-times"></i>
									</button>
									<button class="tglakhircal input-group-text fs-xl">
										<i class="fa fal fa-calendar"></i>
									</button>
								</div>
							</div>
						</div>
						<!-- <div class="col-md-2">
							<div class="row">
								<div class="col-sm-9">
									<label class="form-label">Section</label>
									<select class="form-control form-control-sm bagianselect2 bagian" onchange="reloadDT('bagian')">
										<option value="" id="bagianopt" disabled selected>Select Data . . .</option>
										<?=createOption($sbagian, 'id_bagian', array('nama_bagian'), ' - ')?>
									</select>
								</div>
								<div class="col-sm-3">
									<div class="bagianclose x-hidden">
										<label class="form-label">&nbsp;</label>
										<button class="btn btn-sm btn-default" onclick="removeFilter('bagian')">
											<i class="text-danger fal fa-times"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="row">
								<div class="col-sm-9">
									<label class="form-label">Jenis PP</label>
									<select class="form-control form-control-sm jenisppselect2 jenispp" onchange="reloadDT('jenispp')">
										<option value="" id="jenisppopt" disabled selected>Select Data . . .</option>
										<?=createOption($sjenis_pp, 'id_jenis_pp', array('nama_jenis_pp'), ' - ')?>
									</select>
								</div>
								<div class="col-sm-3">
									<div class="jenisppclose x-hidden">
										<label class="form-label">&nbsp;</label>
										<button class="btn btn-sm btn-default" onclick="removeFilter('jenispp')">
											<i class="text-danger fal fa-times"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="row">
								<div class="col-sm-9">
									<label class="form-label">Type</label>
									<select class="form-control form-control-sm rutinitasppselect2 rutinitaspp" onchange="reloadDT('rutinitaspp')">
										<option value="" id="rutinitasppopt" disabled selected>Select Data . . .</option>
										<?=createOption($sjenis_pp_rutinitas, 'id_jenis_pp_rutinitas', array('nama_jenis_pp_rutinitas'), ' - ')?>
									</select>
								</div>
								<div class="col-sm-3">
									<div class="rutinitasppclose x-hidden">
										<label class="form-label">&nbsp;</label>
										<button class="btn btn-sm btn-default" onclick="removeFilter('rutinitaspp')">
											<i class="text-danger fal fa-times"></i>
										</button>
									</div>
								</div>
							</div>
						</div> -->
					</div><br>
					<div class="row">
						<div class="col-sm-12">
							<div class="table-responsive">
								<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" style="white-space: nowrap">
									<thead>
									<tr>
										<th width="40px">No</th>
										<th>Nomor PR</th>
										<th>Date</th>
										<th>Due Date</th>
										<th>Section</th>
										<th>Category</th>
										<th>Type</th>
										<th>Status</th>
										<th width="130px">Option</th>
									</tr>
									</thead>
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
</main>
