	<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item">Assetting</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Assetting
		</h1>
	</div>
		<div class="row">
			<div class="col-sm-7 col-lg-7 col-xl-7">
				<div class="card mb-g">
					<div class="card-body">
						<h2 class="subheader-title"> Asset Detail </h2>
						<form method="post" action="<?=base_url('')?>">
							<input type="hidden" class="id_dn" name="t_detail_po_dn[id_dn]" value="">
							<div class="form-group row">

								<div class="col-md-12">
									<label class="form-label" for="validationCustom01">Asset Name
										<span class="text-danger">*</span>
									</label>
									<div class="input-group input-group-sm">
										<input type="text" class="form-control form-control form-control-sm x-readonly kode_po" readonly placeholder="Select Asset...">
										<div class="input-group-append">
											<button type="button" class="btn btn-default" data-toggle="modal" data-target="#t_detail_po_dn_modal"><i class="fal fa-search"></i></button>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<label class="form-label" for="validationCustom01">Asset Number
										<span class="text-danger">*</span>
									</label>
									<input type="text" class="form-control form-control form-control-sm x-readonly no_po" readonly required>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<label class="form-label" for="validationCustom01">Fixed Asset Account
										<span class="text-danger">*</span>
									</label>
									<select class="form-control form-control-sm">
										<option value="non_service">Non Service</option>
										<option value="service">Service</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="form-label" for="example-textarea">Description</label>
										<textarea class="form-control" id="example-textarea" rows="5"></textarea>
									</div>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-md-12">
									<label class="form-label">Acquisition Date</label>
									<div class="input-group input-group-sm">
										<input type="text" class="form-control form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="">
										<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<label class="form-label">Acquisition Cost</label>
									<input type="text" class="form-control form-control-sm input-mask" name="email" placeholder="" value="" required>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<label class="form-label">Account Credited</label>
									<select class="form-control form-control-sm">
										<option value="non_service">Non Service</option>
										<option value="service">Service</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<label class="form-label">Tags</label>
									<input type="text" class="form-control form-control-sm input-mask" name="email" placeholder="" value="" required>
								</div>
							</div>

							<h2 class="subheader-title"> Depreciation </h2>
							<div class="col-md-12" style="padding: 15px" >
								<div class="custom-control custom-checkbox custom-control-inline">
									<input type="checkbox" class="custom-control-input" name="havingchild" value="1" id="havingchild">
									<label class="custom-control-label" for="havingchild">Depreciable Asset</label>
								</div>
							</div>
							<div class="form-group row is-child">
								<div class="col-md-12 ">
									<label class="form-label">Method</label>
									<select class="form-control form-control-sm">
										<option value="non_service">Straight Line</option>
										<option value="service">Double Declining Balance</option>
										<option value="service">Sum of The Year Digit</option>
										<option value="service">Service Hours</option>
										<option value="service">Productive Output Method</option>
									</select>
								</div>
							</div>
							<div class="form-group row is-child">
								<div class="col-md-8 ">
									<label class="form-label">Useful Life</label>
									<input type="text" class="form-control form-control-sm input-mask" name="Useful Life" placeholder="Year" value="" required>
								</div>
							</div>

							<div class="form-group row is-child">
								<div class="col-md-8 ">
									<label class="form-label">Rate/Year</label>
									<input type="text" class="form-control form-control-sm input-mask" name="Rate" placeholder="Percent" value="" required>
								</div>
							</div>

							<div class="form-group row is-child">
								<div class="col-md-12 ">
									<label class="form-label">Depreciation Account</label>
									<select class="form-control form-control-sm">
										<option value="non_service">Depreciation Account 1</option>
										<option value="service">Depreciation Account 2</option>
									</select>
								</div>
							</div>

							<div class="form-group row is-child">
								<div class="col-md-12 ">
									<label class="form-label">Accumulated Depreciation Account</label>
									<select class="form-control form-control-sm">
										<option value="non_service">Accumulated Depreciation Account 1</option>
										<option value="service">Accumulated Depreciation Account 2</option>
									</select>
								</div>
							</div>

							<div class="form-group row is-child">
								<div class="col-md-12 ">
									<label class="form-label">Accumulated Depreciation</label>
									<input type="text" class="form-control form-control-sm input-mask" name="email" placeholder="" value="" required>
								</div>
							</div>

							<div class="form-group row is-child">
								<div class="col-md-12">
									<label class="form-label">As a Date</label>
									<div class="input-group input-group-sm">
										<input type="text" class="form-control form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="">
										<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
									<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-5 col-lg-5 col-xl-5">
				<div class="row">
					<div class="col-sm-12 col-lg-12 col-xl-12">
					<div class="card mb-g">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-hover table-bordered table-striped table-sm" id="dtprimary" role="grid" style="width: 100%;">
									<thead>
									<tr>
										<th class="text-center">Simulation</th>
									</thead>
									<tbody>
									<tr class="odd">
										<td valign="top" colspan="3" class="dataTables_empty text-center" >No data available in table</td>
									</tr>
									</tbody>
								</table>
								<div id="dtprimary_processing" class="dataTables_processing card" style="display: none;">
									<div class="d-flex align-items-center justify-content-center fs-lg">
										<div class="spinner-border spinner-border-sm text-primary mr-2" role="status">
											<span class="sr-only"> Loading...</span>
										</div> Processing...</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-5"></div>
							<div class="col-sm-12 col-md-7"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		</div>
		</div>
		</div>
	</main>

