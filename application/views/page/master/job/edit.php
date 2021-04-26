<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		
		<li class="breadcrumb-item">Master</li>
		<li class="breadcrumb-item">Job</li>
		<li class="breadcrumb-item active">Edit</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Edit Job
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('master/job/update')?>">
						<input type="hidden" name="id_job" value="<?=$data->id_job?>" required>
						<div class="form-group row">
							<div class="col-md-3">
								<label class="form-label">No Job</label>
								<input type="text" name="no_job" class="form-control form-control-sm" placeholder="" value="<?=$data->no_job?>" required>
							</div>
							<div class="col-md-2">
								<label class="form-label">Tanggal Job</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="tanggal_job" value="<?=date('d-m-Y', strtotime($data->tanggal_job))?>" required>
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label">Due Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="due_date" value="<?=date('d-m-Y', strtotime($data->due_date))?>" required>
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<!--<div class="form-group col-md-5">
								<label class="form-label">BOM Code</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly kode_bom" readonly placeholder="Select BOM Code...">
									<input type="hidden" class="id_bom" name="id_bom" value="" disabled/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#t_bom_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>-->
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Save</button>
							<a href="<?=base_url('master/bom/job/'.$data->id_bom)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Cancel</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
