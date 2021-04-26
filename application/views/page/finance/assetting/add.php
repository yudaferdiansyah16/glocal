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
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<h2 class="subheader-title"> Asset Detail </h2>
					<form method="post" action="<?=base_url('finance/assetting/store')?>">
						<!-- <div class="form-group row">
							<div class="col-md-12">
								<label class="form-label" name="search_box" id="search_box"
									for="validationCustom01">Asset Name
									<span class="text-danger">*</span>
								</label>
								<div class="input-group input-group-sm">
									<input type="hidden" name="id_sub_barang" id="id_sub_barang" class="form-control form-control form-control-sm x-readonly kode_po">
									<input type="hidden" name="id_supplier" id="id_supplier" class="form-control form-control form-control-sm x-readonly kode_po">
									<input type="hidden" name="id_barang" id="id_barang" class="form-control form-control form-control-sm x-readonly kode_po">
									<input type="hidden" name="harga" id="harga" class="form-control form-control form-control-sm x-readonly kode_po">
									<input type="text" name="nama_barang" id="asset_nama" class="form-control form-control form-control-sm x-readonly kode_po" readonly placeholder="Select Asset...">
									<div class="input-group-append">
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#refrensi_asseting_modal"><i class="fal fa-search"></i></button>
									</div>
								</div>
							</div>
						</div> -->
						<div class="form-group row">
							<div class="col-md-12">
								<label class="form-label">Kode Aset</label><span class="text-danger">*</span>
								<input type="text" class="form-control form-control-sm input-mask" name="kode_aset2" required>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<label class="form-label">Nama Barang</label><span class="text-danger">*</span>
								<input type="text" class="form-control form-control-sm input-mask" name="nama_barang" required>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="form-label" for="example-textarea">Deskripsi</label>
									<textarea name="deskripsi" class="form-control" id="example-textarea" rows="5"></textarea>
								</div>
							</div>
						</div>
						<!-- <div class="form-group row">
							<div class="col-md-12">
								<label class="form-label">Acquisition Date</label>
								<div class="input-group input-group-sm">
									<input type="text"
										class="form-control form-control form-control-sm x-datepicker x-readonly"
										readonly placeholder="Select date" name="ac_date" id="tgl_depresiasi">
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
								<input type="text" class="form-control form-control-sm input-mask" name="acquisisi"
									 value="" required>
							</div>
						</div> -->
						<!-- <div class="form-group row">
							<div class="col-md-12">
								<label class="form-label">Account Credited</label>
								<select class="form-control form-control-sm" name="ac_credit">
									<option value="non_service">Non Service</option>
									<option value="service">Service</option>
								</select>
							</div>
						</div> -->
						<div class="form-group row">
							<div class="col-md-12">
								<label class="form-label">Tags</label>
								<input type="text" class="form-control form-control-sm input-mask" name="tags" value="">
							</div>
						</div>
						<h2 class="subheader-title"> Depreciation </h2>
						<div class="col-md-12" style="padding: 15px">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" class="custom-control-input" checked value="1" name="type_depresiasi" id="depreciable">
								<label class="custom-control-label" for="depreciable">Depreciable Asset</label>
							</div>
						</div>
						<div class="form-group row is-child">
							<div class="col-sm-12 col-lg-6">
								<label class="form-label">Metode Penyusutan</label>
								<select class="form-control form-control-sm select2" name="metode">
									<option disabled selected>Pilih. . .</option>
									<option value="Metode Garis Lurus">Metode Garis Lurus</option>
									<option value="Metode Garis Lurus">Metode Saldo Menurun</option>
									<option value="Metode Garis Lurus">Metode Angka Turun</option>
								</select>
							</div>
							<div class="col-sm-12 col-lg-6">
								<label class="form-label">Umur Asset</label>
								<select class="form-control form-control-sm select2" id="type_depresiasi">
									<option disabled selected>Pilih. . .</option>
									<option value="tahun">Tahun</option>
									<option value="bulan">Bulan</option>
								</select>
							</div>
							<div class="col-sm-12 col-lg-6"></br>
								<label class="form-label">Jenis Tarif</label></br>
								<input type="radio" id="rate_type" name="rate_type" value="Rupiah"> Rupiah
								<input type="radio" id="rate_type1" name="rate_type" value="Persen"> Persen
							</div>
							<div class="col-sm-12 col-lg-6"></br>
								<label class="form-label">Nilai</label></br>
								<input type="number" class="form-control form-control-sm input-mask" name="rate"
									id="jum_depresiasi" min="0" value="">
							</div>
							<div class="col-sm-12 col-lg-6"></br>
								<label class="form-label">Tanggal Akuisisi</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="tgl_depresiasi" id="tgl_depresiasi">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row is-child">
							<div class="col-md-12 ">
								<label class="form-label">Akun Aset</label>
								<select class="form-control form-control-sm select2" name="id_akun">
									<?=createOption($mm_akun1, 'id_akun',array('kode_akun','nama_akun'),' - ')?>
								</select>
							</div>
						</div>
						<!-- <div class="form-group row is-child">
							<div class="col-md-12 ">
								<label class="form-label">Akun Akumulasi Penyusutan</label>
								<select class="form-control form-control-sm" name="id_akun_akumulasi_penyusutan">
									<?=createOption($mm_akun2, 'id_akun',array('kode_akun','nama_akun'),' - ')?>
								</select>
							</div>
						</div> -->
						<div class="form-group row is-child">
							<div class="col-md-12 ">
								<label class="form-label">Akun Beban Penyusutan</label>
								<select class="form-control form-control-sm select2" name="id_akun_beban_penyusutan">
									<?=createOption($mm_akun3, 'id_akun',array('kode_akun','nama_akun'),' - ')?>
								</select>
							</div>
						</div>
						<!-- <div class="form-group row is-child">
							<div class="col-sm-12 col-lg-6">
								<label class="form-label">Accumulated Depreciation</label>
								<input type="text" class="form-control form-control-sm input-mask" id="hasil_simulasi" name="hasil_simulasi" value="">
							</div>
						</div> -->
						<div class="form-group row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-sm btn-success">
									<i class="fal fa fa-save"></i> Save
								</button>
								<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger">
									<i class="fal fa-times-circle"></i> Cancel
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- <div class="col-sm-5 col-lg-5 col-xl-5">
			<div class="row">
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<div class="card mb-g">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-hover table-bordered table-striped table-sm" role="grid"
									style="width: 100%;">
									<thead>
										<tr>
											<th class="text-center">Harga Perolehan </th>
											<th class="text-center">Type Depresiasi </th>
											<th class="text-center">Depresiasi </th>
											<th class="text-center">Type Rate </th>
									</thead>
									<tbody>
										<tr class="odd">
											<td><input type="text" class="form-control form-control-sm x-readonly" readonly id="simulasi_harga"></input></td>
											<td><input type="text" class="form-control form-control-sm x-readonly" readonly id="type"></input></td>
											<td><input type="text" class="form-control form-control-sm x-readonly" readonly id="depresiasi"></input></td>
											<td><input name="rate_type" type="text" class="form-control form-control-sm x-readonly" readonly id="type_rate"></input></td>
										</tr>
									</tbody>
								</table>
								<center>
									<h2 class="subheader-title"> Simulasi </h2>
								</center>
								<table class="table table-hover table-bordered table-striped table-sm" id="dtsimulasi"
									role="grid" style="width: 100%;">
									<thead>
										<tr>
											<th width="3px" class="text-center">No </th>
											<th class="text-center">Tanggal </th>
											<th class="text-center">Harga Asset </th>
											<th class="text-center">Nilai Depresiasi </th>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-5"></div>
							<div class="col-sm-12 col-md-7"></div>
						</div>
					</div>
				</div>
			</div>
		</div> -->

	</div>
</main>