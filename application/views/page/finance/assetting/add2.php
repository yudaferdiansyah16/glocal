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
			<div class="col-sm-12 col-lg-6 col-xl-6">
				<div class="card mb-g">
					<div class="card-body">
						<form method="post" action="<?= base_url('finance/assetting/store') ?>">
							<div class="form-group row">
								<div class="col-md-6">
									<label class="form-label">Nama Barang</label>
									<select class="form-control form-control-sm select2" name="nama_barang" id="nama_barang">
										<option value="">Select Data . . .</option>
									</select>
								</div>
								<div class="col-md-6">
									<label class="form-label">Tanggal Penyusutan</label>
									<div class="input-group input-group-sm">
										<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="tanggal_penyusutan">
										<div class="input-group-append">
											<span class="input-group-text fs-xl">
												<i class="fa fal fa-calendar"></i>
											</span>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<label class="form-label">Harga Perolehan</label>
									<input type="text" class="form-control form-control-sm" name="harga_perolehan" placeholder="" />
								</div>
								<div class="col-md-6">
									<label class="form-label">Klasifikasi Asset</label>
									<select class="form-control form-control-sm select2" name="klasifikasi_asset" id="klasifikasi_asset">
										<option value="">Select Data . . .</option>
									</select>
								</div>
								<div class="col-md-6">
									<label class="form-label">Metode Penyusutan</label>
									<select class="form-control form-control-sm select2" name="metode_penyusutan" id="metode_penyusutan">
										<option value="">Select Data . . .</option>
									</select>
								</div>
								<div class="col-md-6">
									<label class="form-label">Persentase Penyusutan</label>
									<select class="form-control form-control-sm select2" name="persentase_penyusutan" id="persentase_penyusutan">
										<option value="">Select Data . . .</option>
									</select>
								</div>
								<div class="col-md-6">
									<label class="form-label">Lama Manfaat</label>
									<input type="text" class="form-control form-control-sm" name="lama_manfaat" placeholder="" />
								</div>
								<div class="col-md-6">
									<label class="form-label">Debit</label>
									<select class="form-control form-control-sm select2" name="debit" id="debit">
										<option value="">Select Data . . .</option>
									</select>
								</div>
								<div class="col-md-6">
									<label class="form-label">Kredit</label>
									<select class="form-control form-control-sm select2" name="kredit" id="kredit">
										<option value="">Select Data . . .</option>
									</select>
								</div>
								<div class="col-md-6">
									<label class="form-label">Lokasi Asset</label>
									<select class="form-control form-control-sm select2" name="lokasi_asset" id="lokasi_asset">
										<option value="">Select Data . . .</option>
									</select>
								</div>
								<div class="col-md-6">
									<label class="form-label">Penanggung Jawab</label>
									<select class="form-control form-control-sm select2" name="penanggung_jawab" id="penanggung_jawab">
										<option value="">Select Data . . .</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<a href="<?= base_url('finance/assetting') ?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Cancel</a>
								<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>