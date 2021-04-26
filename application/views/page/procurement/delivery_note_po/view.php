<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">GCI</a></li>
		<li class="breadcrumb-item">Procurement</li>
		<li class="breadcrumb-item active">Receive Note</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Receive Note
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<a href="<?=base_url('procurement/delivery_note_po/add')?>" class="btn btn-sm btn-primary"><i
							class="fal fa fa-plus-circle"></i> <?=$this->lang->line('button_add')?></a>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-2">
							<label class="form-label">Submission Date</label>
							<div class="input-group input-group-sm">
								<input type="text"
									class="form-control form-control-sm x-datepicker x-readonly tglajuawal" readonly
									placeholder="Select date" value="<?=date('01-m-Y')?>"
									onchange="reloadDT('tglajuawal')" />
								<div class="input-group-append">
									<button class="tglajuawalclose btn btn-sm btn-default"
										onclick="removeFilter('tglajuawal')">
										<i class="text-danger fal fa-times"></i>
									</button>
									<button class="tglajuawalcal btn btn-sm btn-default x-hidden">
										<i class="fa fal fa-calendar"></i>
									</button>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<label class="form-label">&nbsp;</label>
							<div class="input-group input-group-sm">
								<input type="text"
									class="form-control form-control-sm x-datepicker x-readonly tglajuakhir" readonly
									placeholder="Select date" value="<?=date('t-m-Y')?>"
									onchange="reloadDT('tglajuakhir')" />
								<div class="input-group-append">
									<button class="tglajuakhirclose btn btn-sm btn-default"
										onclick="removeFilter('tglajuakhir')">
										<i class="text-danger fal fa-times"></i>
									</button>
									<button class="tglajuakhircal btn btn-sm btn-default x-hidden">
										<i class="fa fal fa-calendar"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="table-responsive">
								<table class="table table-hover table-bordered table-striped table-sm" id="dt"
									role="grid" style="white-space: nowrap">
									<thead>
										<tr class="text-center">
											<th>No</th>
											<th>RN Number</th>
											<th>Supplier</th>
											<th>Facility</th>
											<th class="text-center">Amount</th>
											<th>Approval<br>Status</th>
											<th>Option</th>
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
</main>