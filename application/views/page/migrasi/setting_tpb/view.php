<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Migration</li>
		<li class="breadcrumb-item">Setting TPB</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Setting TPB
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?= base_url('migrasi/setting_tpb/update') ?>">
						<div class="form-group row">
							<input type="hidden" class="form-control form-control-sm" name="id" value="<?=placeValue($_tpbsetting,'id')?>" required />
							<div class="col-sm-12 col-lg-4">
								<label class="form-label">Host</label>
							</div>
							<div class="col-sm-12 col-lg-8">
								<input type="text" class="form-control form-control-sm" name="iphost" value="<?=placeValue($_tpbsetting,'iphost')?>" required />
                            </div>
						</div>
						<div class="form-group row">
                            <div class="col-sm-12 col-lg-4">
								<label class="form-label">Username</label>
							</div>
                            <div class="col-sm-12 col-lg-8">
								<input type="text" class="form-control form-control-sm" name="username" value="<?=placeValue($_tpbsetting,'username')?>" required />
                            </div>
						</div>
						<div class="form-group row">
                            <div class="col-sm-12 col-lg-4">
								<label class="form-label">Password</label>
							</div>
                            <div class="col-sm-12 col-lg-8">
								<input type="password" class="form-control form-control-sm" name="pass" value="<?=placeValue($_tpbsetting,'pass')?>" required />
                            </div>
						</div>
						<div class="form-group row">
                            <div class="col-sm-12 col-lg-4">
								<label class="form-label">Database</label>
							</div>
                            <div class="col-sm-12 col-lg-8">
								<input type="text" class="form-control form-control-sm" name="db" value="<?=placeValue($_tpbsetting,'db')?>" required />
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
