<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item active">Neraca</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">Neraca</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<form method="post" action="<?=base_url('finance/neraca_saldo/view')?>">
					<div class="card-header">
						<div class="row">
							<div class="col-md-3">
								<label class="form-label">Start</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly"
										readonly placeholder="Select start date" name="tgl1"
										value="<?php if(isset($tgl1)) echo $tgl1; ?>">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label class="form-label">End</label>
								<div class="input-group input-group-sm">
									<input type="text"
										class="form-control form-control form-control-sm x-datepicker x-readonly"
										readonly placeholder="Select end date" name="tgl2"
										value="<?php if(isset($tgl2)) echo $tgl2; ?>">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label class="form-label">&nbsp;</label>
								<div class="input-group input-group-sm">
									<button type="submit" class="btn btn-sm btn-primary"><i class="fal fa fa-file"></i>
										&nbsp; Report</button>
								</div>
							</div>
						</div>
					</div>
				</form>
				<div class="card-body">
					<div class="table-responsive">
						<?php if(isset($tgl1) && isset($tgl2)){ ?>
						<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid">
							<thead>
								<tr>
									<th class="text-center" width="100px">ACCOUNT</th>
									<th class="text-left" width="200px">ACCOUNT NAME</th>
									<th class="text-right" width="150px">BEGINNING BALANCE</th>
									<th class="text-right" width="150px">DEBET</th>
									<th class="text-right" width="150px">CREDIT</th>
									<th class="text-right" width="150px">ENDING BALANCE</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$no = 0;
									foreach($data->akun11->result() as $p){
								?>
								<tr>
									<td class="text-center"><?=$p->kode_akun?></td>
									<td class="text-left"><?=$p->nama_akun?></td>
									<td class="text-right">0</td>
									<td class="text-right">0</td>
									<td class="text-right">0</td>
									<td class="text-right">0</td>
								</tr>
								<?php 
									$no++;
									} 
								?>
							</tbody>
						</table>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
