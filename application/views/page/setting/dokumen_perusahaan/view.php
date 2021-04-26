<main id="js-page-content" role="main" class="page-content">
	
	<div class="subheader">
		<h1 class="subheader-title">
			Dokumen Perusahaan
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('setting/dokumen_perusahaan/update')?>">
						<div class="form-group row">
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label">1. Upload SKEP</label>
								<input type="file"  class="form-control" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label">2. Upload Sertifikat</label>
								<input type="file"  class="form-control" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label">2. Upload LOGO</label>
								<input type="file"  class="form-control" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6">
								<label class="form-label">4. Upload Data Lain</label>
								<input type="file"  class="form-control" placeholder="">
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-6"></div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
							<a href="<?=base_url('setting/dokumen_perusahaan')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
