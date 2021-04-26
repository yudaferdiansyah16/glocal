<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">GCI</a></li>
		<li class="breadcrumb-item">Exim</li>
		<li class="breadcrumb-item">27in Antar Perusahaan</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			27in Antar Perusahaan
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<div class="form-group row">
						<div class="col-sm-12 col-lg-3 col-xl-3">
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

						<div class="col-sm-12 col-lg-3 col-xl-3">
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

						<div class="col-sm-12 col-lg-3 col-xl-3">
							<div class="input-group input-group-sm">
								<select class="form-control form-control-sm select2"
									name="tpb_header[KODE_DOKUMEN_PABEAN]" id="jenis_dokumen">
									<option value="" disabled selected>Suplier</option>
									<?= createOption($sdokumen_pabean, 'KODE_DOKUMEN_PABEAN', array('URAIAN_DOKUMEN_PABEAN'), ' - ') ?>
								</select>
							</div>
						</div>

						<div class="col-sm-12 col-lg-3 col-xl-3">
							<div class="input-group input-group-sm">

							<a href="<?=base_url('exim/dua_tujuh_in')?>" class="btn btn-sm btn-primary"> View</a>
							</div>
						</div>
					</div>
				</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid"
								style="white-space: nowrap">
								<thead>
									<tr>
										<th>tanggal </th>
										<td> <input type='checkbox' name='as_admin[]' value=1>
										</td>

										<th>Nomor</th>
										<th>Partner</th>
										<th>Kode Barang</th>
										<th>Nama Barang</th>
										<th>Satuan</th>
										<th>QTY</th>
										<th>Harga</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>
					</div>

					<!-- <div class="row">
						<div class="col-sm-12 col-lg-12 col-lx-12">
							<div class="table-responsive">
								<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" style="white-space: nowrap">
									<thead>
										<tr>
											<th class="text-center" rowspan="2">No</th>
											<th class="text-center" colspan="3">Dokumen</th>
											<th class="text-center" rowspan="2">Nama Supplier</th>
											<th class="text-center" rowspan="2">Valuta</th>
											<th class="text-center" rowspan="2">Harga Perolehan</th>
											<th class="text-center" rowspan="2">CIF</th>
											<th class="text-center" rowspan="2">Option</th>
										</tr>
										<tr>
											<th class="text-center">Tanggal</th>
											<th class="text-center">Nomor</th>
											<th class="text-center">Jenis BC</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	
</main>