<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item">Transaction</li>
		<li class="breadcrumb-item">Approval Realisasi</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Approval Realisasi
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('finance/transaction_jurnal/store')?>">
						<div class="form-group row">
							<div class="col-md-6">
								<label class="form-label">No Evidence</label>
								<input type="text" class="form-control form-control-sm" name="no_bukti" placeholder=""/>
							</div>
							<div class="col-md-6">
								<label class="form-label">Date</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" id="date" name="tanggal_kasbon">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<label class="form-label">Rates</label>
								<div class="form-control form-control-sm">
									<input type="checkbox" name="rate" placeholder=""/>
									<label class="form-label">Rate</label>
								</div>
							</div>
							<div class="col-md-4">
								<label class="form-label">Currency</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly nama_valuta" readonly placeholder="Select currency...">
									<input type="hidden" name="referensi_valuta[id_valuta]"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_valuta_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<label class="form-label">Result</label>
								<input type="text" class="form-control form-control-sm" name="hasil_konversi" placeholder=""/>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6">
								<label class="form-label">Ref. Kasbon</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly URAIAN_DOKUMEN" readonly placeholder="Select document...">
									<input type="hidden" name="referensi_dokumen[ID]"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_dokumen_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<label class="form-label">User</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-readonly username" readonly placeholder="Select User...">
									<input type="hidden" name="m_user[id_user]"/>
									<div class="input-group-append">
										<button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#m_user_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<label class="form-label">Jenis Pencairan</label>
								<select class="form-control form-control-sm select2" name="dokumen" id="dokumen">
									<option value="cash">Cash</option>
									<option value="bank">Transfer Bank</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="form-label">Value</label>
								<input type="text" class="form-control form-control-sm" name="nilai_kasbon" placeholder=""/>
							</div>
							<div class="col-md-6">
								<label class="form-label">Info</label>
								<input type="text" class="form-control form-control-sm" name="keterangan" placeholder=""/>
							</div>
							<div class="col-md-6">
								<label class="form-label">Account</label>
								<div class="input-group input-group-sm">
									<div class="input-group input-group-sm">
										<input type="text" class="form-control form-control form-control-sm x-readonly nama_akun" readonly placeholder="Select account...">
										<input type="hidden" name="m_akun[id_akun]"/>
										<div class="input-group-append">
											<button type="button" class="btn btn-default" data-toggle="modal" data-target="#m_akun_modal"><i class="fal fa-search"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<a href="<?=base_url('finance/approval_realisasi')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Cancel</a>
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
