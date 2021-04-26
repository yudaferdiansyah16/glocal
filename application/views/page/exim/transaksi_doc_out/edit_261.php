
<form method="post" action="<?= base_url('exim/transaksi_doc_out/update') ?>">
<div class="card-body">
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<dl class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
				<dt class="col-sm-3">No Pengajuan</dt>
				<dd class="col-sm-3"><input type="text" value="<?=placeValue($tpbHeader,'NOMOR_AJU')?>"
						class="form-control form-control-sm " readOnly> </dd>
				<dt class="col-sm-3">No Pendaftaran</dt>
				<dd class="col-sm-3"><input type="text" value="<?=placeValue($tpbHeader,'NOMOR_DAFTAR')?>"
						class="form-control form-control-sm " readOnly> </dd>
				<!-- <dt class="col-sm-3">Tanggal Pengajuan</dt>
				<dd class="col-sm-3"><input type="text"
						value=" <?=isset($tpbHeader->TANGGAL_AJU) ? date('d-m-Y',strtotime($tpbHeader->TANGGAL_AJU)) : ''?>"
						class="form-control form-control-sm " readOnly></dd> -->
				<dt class="col-sm-3">Tanggal Pendaftaran</dt>
				<dd class="col-sm-3"><input type="text"
						value="<?=isset($tpbHeader->TANGGAL_DAFTAR) ? date('d-m-Y',strtotime($tpbHeader->TANGGAL_DAFTAR)) : ''?>"
						class="form-control form-control-sm " readOnly> </dd>


				<!-- <dt class="col-sm-3">Jenis TPB</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'URAIAN_JENIS_TPB')?>"
						class="form-control form-control-sm " readOnly> </dd>
				<dt class="col-sm-3">Tujuan</dt>
				<dd class="col-sm-9"><input type="text" value=" <?=placeValue($tpbHeader,'URAIAN_TUJUAN_PENGIRIMAN')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Jenis Dokumen</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'URAIAN_DOKUMEN_PABEAN')?>"
						class="form-control form-control-sm " readOnly> </dd> -->
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<dl class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
				<dt class="col-sm-3">Kantor Asal</dt>
				<dd class="col-sm-9"><input type="text" value=" <?=placeValue($tpbHeader,'KODE_KANTOR')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Kantor Tujuan</dt>
				<dd class="col-sm-9"><input type="text" value=" <?=placeValue($tpbHeader,'KODE_KANTOR_TUJUAN')?>"
						class="form-control form-control-sm " readOnly></dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<dl class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
				<dt class="col-sm-3">PENGUSAHA</dt>
				<dd class="col-sm-9"></dd>
				<dt class="col-sm-3">NPWP</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'ID_PENGUSAHA')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Nama</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'NAMA_PENGUSAHA')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Alamat</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'ALAMAT_PENGUSAHA')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">No. Ijin TPB</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'NOMOR_IJIN_TPB')?>"
						class="form-control form-control-sm " readOnly></dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<dl class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
				<dt class="col-sm-3">PENERIMA</dt>
				<dd class="col-sm-9"></dd>
				<dt class="col-sm-3">NPWP</dt>
				<dd class="col-sm-9"> <input type="text" value=" <?=placeValue($tpbHeader,'ID_PENERIMA_BARANG')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Nama</dt>
				<dd class="col-sm-9"> <input type="text" value="<?=placeValue($tpbHeader,'NAMA_PENERIMA_BARANG')?>"
						class="form-control form-control-sm " readOnly> </dd>
				<dt class="col-sm-3">Alamat</dt>
				<dd class="col-sm-9"> <input type="text" value=" <?=placeValue($tpbHeader,'ALAMAT_PENERIMA_BARANG')?>"
						class="form-control form-control-sm " readOnly></dd>
			</dl>
		</div>
		
	</div>
	<div class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
		<div class="col-md-12">
		<a href="#" data-toggle="modal" data-target="#m_dokumen_modal"><b>DOKUMEN [F6]</b></a>
		</div>

		<div class="col-md-12">
			<div class="table-responsive">

				<table class="table table-hover table-bordered table-striped table-sm dt_po_add" id="table_dokumen"
					role="grid" style="white-space: nowrap; min-width: 600px">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Jenis Dokumen</th>
							<th class="text-center">Nomor Dokumen</th>
							<th class="text-center">Tanggal</th>
						</tr>
					</thead>
					<tbody>
						<?php
                    $i = 1;
                    foreach ($doclain as $row) {
                        echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        echo '<td>'.$row->URAIAN_DOKUMEN.'</td>';
                        echo '<td>'.$row->NOMOR_DOKUMEN.'</td>';
                        $tgl = isset($row->TANGGAL_DOKUMEN) ? date('d-m-Y', strtotime($row->TANGGAL_DOKUMEN)) : '';
                        echo '<td>'.$tgl.'</td>';
                        echo '</tr>';
                        $i++;
                    }
                    ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="col-sm-6 col-lg-6 col-xl-6">
			<dl class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
				<dt class="col-sm-3">HARGA</dt>
				<dd class="col-sm-9"></dd>
				<dt class="col-sm-3">Valuta</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'KODE_VALUTA')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
				<dt class="col-sm-3"><a href="" class="btn btn-sm btn-primary waves-effect waves-themed">NDPBM</a></dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'NDPBM')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Nilai CIF</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'CIF')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Nilai CIF (Rp)</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'CIF_RUPIAH')?>"
						class="form-control form-control-sm " readOnly></dd>

			</dl>
		</div>
		<div class="col-sm-6 col-lg-6 col-xl-6">
			<dl class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
				<dt class="col-sm-9">PENGANGKUTAN</dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-6">Jenis Sarana Pengangkut</dt>
				<dd class="col-sm-6"><input type="text" value="<?=placeValue($tpbHeader,'NAMA_PENGANGKUT')?>"
						class="form-control form-control-sm " readOnly></dd>

			</dl>
		</div>
	</div>

	<div class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
		<div class="col-md-12">
			
			<a href="#" data-toggle="modal" data-target="#m_kontainer_modal"><b>KONTAINER (F5)</b></a>
		</div>

		<div class="col-md-12">
			<div class="table-responsive">
				<label></label>
				<table class="table table-hover table-bordered table-striped table-sm dt_po_add" id="table_kontainer"
					role="grid" style="white-space: nowrap; min-width: 600px">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Nomor Cont</th>
							<th class="text-center">Ukuran</th>
							<th class="text-center">Type</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
	<hr>
	

	<hr>
	<div class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
		<div class="col-md-12">
		<div class="col-md-12">
			
			<a href="#" data-toggle="modal" data-target="#m_data_barang_out_modal"><b>KEMASAN (F7)</b></a>
		</div>
		</div>

		<div class="col-md-12">
			<div class="table-responsive">
				<label></label>
				<table class="table table-hover table-bordered table-striped table-sm dt_po_add" id="table_kemasan"
					role="grid" style="white-space: nowrap; min-width: 600px">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Jumlah</th>
							<th class="text-center">Kode Jenis</th>
							<th class="text-center">Jenis</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-lg-12 col-xl-12">
		<dl class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
			<dt class="col-sm-3"><a href="#" data-toggle="modal" data-target="#m_data_barang_out_modal">BARANG (F4)</a>
			</dt>
			<dd class="col-sm-9"></dd>
			<dt class="col-sm-3">Bruto (kg)</dt>
			<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'BRUTO')?>"
					class="form-control form-control-sm " readOnly>
			</dd>
			<dt class="col-sm-3">Netto</dt>
			<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'NETTO')?>"
					class="form-control form-control-sm " readOnly></dd>


		</dl>
	</div>

	<div class="col-sm-12 col-lg-6 col-xl-6">

		<dl class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
			<dt class="col-sm-6">JENIS PUNGUTAN </dt>
			<dd class="col-sm-6">JUMLAH </dd>
			<dt class="col-sm-3">BM </dt>
			<dd class="col-sm-9"> <input type="text" value="" class="form-control form-control-sm " readOnly> </dd>

			<dt class="col-sm-3">BMT </dt>
			<dd class="col-sm-9"> <input type="text" value="" class="form-control form-control-sm " readOnly> </dd>



			<dt class="col-sm-3">Cukai </dt>
			<dd class="col-sm-9"> <input type="text" value="" class="form-control form-control-sm " readOnly> </dd>

			<dt class="col-sm-3">PPN </dt>
			<dd class="col-sm-9"> <input type="text" value="" class="form-control form-control-sm " readOnly> </dd>
			<dt class="col-sm-3">PPnBM</dt>
			<dd class="col-sm-9"> <input type="text" value="" class="form-control form-control-sm " readOnly></dd>
			<dt class="col-sm-3">PPh</dt>
			<dd class="col-sm-9"> <input type="text" value="" class="form-control form-control-sm " readOnly></dd>
			<dt class="col-sm-3">Total</dt>
			<dd class="col-sm-9"> <input type="text" value="" class="form-control form-control-sm " readOnly></dd>




		</dl>
	</div>
	<div class="col-sm-12 col-lg-6 col-xl-6" style="margin-top: 15px;">
			<dl class="row">
				<dt class="col-sm-11">Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal yang diberitahuka dalam dokumen ini.</dt>
				<dd class="col-sm-1"></dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-6"><input type="text" value="NGAWi"
						class="form-control form-control-sm " readOnly></dt>
				<dd class="col-sm-6"><input type="text" value="15-10-2020"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Pemberitahu</dt>
				<dd class="col-sm-9"><input type="text" value="IRAWAN" class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Jabatan</dt>
				<dd class="col-sm-9"><input type="text" value="Manager"
						class="form-control form-control-sm " readOnly></dd>

			</dl>
		</div>

	<hr>
	<div class="modal fade  modal-fullscreen" id="m_data_barang_out_modal" tabindex="-1" role="dialog"
		aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Document</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="">
						<div class="row">
							<div class="col-md-12">
								<ul class="nav nav-tabs" id="myTab" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" id="home-tab" data-toggle="tab"
											href="#tab_detail_barang" role="tab" aria-controls="tab_detail_barang"
											aria-selected="true">Data Detail Barang</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="profile-tab" data-toggle="tab"
											href="#tab_detail_rm_import" role="tab" aria-controls="tab_detail_rm_import"
											aria-selected="false">Detail Bahan Baku Impor</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="contact-tab" data-toggle="tab"
											href="#tab_detail_rm_lokal" role="tab" aria-controls="tab_detail_rm_lokal"
											aria-selected="false">Detail Bahan Baku Lokal</a>
									</li>
								</ul>
								<div class="tab-content" id="myTabContent">
									<div class="tab-pane fade show active" id="tab_detail_barang" role="tabpanel"
										aria-labelledby="home-tab">
										<div class="row" style="margin-top: 15px;">
											<div class="col-sm-12 col-lg-12 col-xl-12">
												<dl class="row" style="margin-top: 15px;">
													<dt class="col-sm-3">STATUS</dt>
													<dd class="col-sm-9"><input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>

												</dl>
											</div>
											<div class="col-sm-12 col-lg-12 col-xl-12">
												<dl class="row"
													style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">

													<dt class="col-sm-3">Kode Barang</dt>
													<dd class="col-sm-3"><input type="text" value=""
															class="form-control form-control-sm " readOnly> </dd>
													<dt class="col-sm-3"></dt>
													<dd class="col-sm-3"></dd>
													<dt class="col-sm-3">Nomor HS</dt>
													<dd class="col-sm-3"><input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3"></dt>
													<dd class="col-sm-3"></dd>
													<dt class="col-sm-3">Uraian Barang</dt>
													<dd class="col-sm-9"><input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Tipe</dt>
													<dd class="col-sm-2"><input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>

													<dt class="col-sm-3">Ukuran</dt>
													<dd class="col-sm-2"><input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Spf Lain</dt>
													<dd class="col-sm-2"><input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Merk</dt>
													<dd class="col-sm-2"><input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>

												</dl>
											</div>

											<div class="col-sm-12 col-lg-6 col-xl-6">
												<dl class="row"
													style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
													<dt class="col-sm-3">HARGA</dt>
													<dd class="col-sm-9"></dd>
													<dt class="col-sm-3">Jumlah Satuan </dt>
													<dd class="col-sm-3"> <input type="text" value=""
															class="form-control form-control-sm " readOnly> </dd>
													<dt class="col-sm-3">Harga CIF</dt>
													<dd class="col-sm-3"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Satuan</dt>
													<dd class="col-sm-3"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">CIF Rupiah</dt>
													<dd class="col-sm-3"><input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Harga Satuan</dt>
													<dd class="col-sm-3"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>




												</dl>
											</div>


											<div class="col-sm-12 col-lg-6 col-xl-6">
												<dl class="row"
													style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
													<dt class="col-sm-3">KEMASAN</dt>
													<dd class="col-sm-3"></dd>
													<dt class="col-sm-3">ASAL BARANG</dt>
													<dd class="col-sm-3"></dd>
													<dt class="col-sm-3">Jumlah </dt>
													<dd class="col-sm-3"> <input type="text" value=""
															class="form-control form-control-sm " readOnly> </dd>
													<dt class="col-sm-3">Kode</dt>
													<dd class="col-sm-3"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Jenis</dt>
													<dd class="col-sm-3"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">NEGARA</dt>
													<dd class="col-sm-3"><input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Netto</dt>
													<dd class="col-sm-3"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>




												</dl>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-12 col-lg-6 col-xl-6"
												style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">

												<dl class="row" style="margin-top: 15px;">
													<dt class="col-sm-6">JENIS PUNGUTAN </dt>
													<dd class="col-sm-6">JUMLAH </dd>
													<dt class="col-sm-3">BM </dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly> </dd>

													<dt class="col-sm-3">BMT </dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly> </dd>

													<dt class="col-sm-3">Cuka Tembakau </dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly> </dd>

													<dt class="col-sm-3">Cukai Etil Alkohol </dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly> </dd>

													<dt class="col-sm-3">Cukai Minuman </dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly> </dd>

													<dt class="col-sm-3">PPN </dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly> </dd>
													<dt class="col-sm-3">PPnBM</dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">PPh</dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Total</dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3"></dt>



												</dl>
											</div>

										</div>

										<div class="row"
											style="margin-top: 15px; border-style: dotted; border-width:1px;">
											<div class="col-md-12">
												<div class="table-responsive">
													<label>Edit Dokumen</label>
													<table
														class="table table-hover table-bordered table-striped table-sm dt_po_add"
														id="table_dokumen" role="grid"
														style="white-space: nowrap; min-width: 600px">
														<thead>
															<tr>
																<th class="text-center">No</th>
																<th class="text-center">Jenis Dokumen</th>
																<th class="text-center">Nomor Dokumen</th>
																<th class="text-center">Tanggal</th>
															</tr>
														</thead>
														<tbody>
															<?php
                    $i = 1;
                    foreach ($doclain as $row) {
                        echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        echo '<td>'.$row->URAIAN_DOKUMEN.'</td>';
                        echo '<td>'.$row->NOMOR_DOKUMEN.'</td>';
                        $tgl = isset($row->TANGGAL_DOKUMEN) ? date('d-m-Y', strtotime($row->TANGGAL_DOKUMEN)) : '';
                        echo '<td>'.$tgl.'</td>';
                        echo '</tr>';
                        $i++;
                    }
                    ?>
														</tbody>
													</table>
												</div>
											</div>
											<div class="col-sm-12 col-lg-6 col-xl-6">
												<dl class="row" style="margin-top: 15px;">
													<dt class="col-sm-3">Bahan Baku </dt>
													<dd class="col-sm-9"> </dd>
													<dt class="col-sm-4">Jumlah Bahan Baku </dt>
													<dd class="col-sm-8"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">
														</dd>

												</dl>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_detail_rm_import" role="tabpanel"
										aria-labelledby="profile-tab">
										<div class="row" style="margin-top: 15px;">
											<div class="col-sm-12 col-lg-12 col-xl-12">
												<dl class="row" style="margin-top: 15px;">

													<dt class="col-sm-3">STATUS</dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
												</dl>
											</div>
											<div class="col-sm-12 col-lg-12 col-xl-12">
												<dt class="col-sm-6">DATA BAHAN BAKU IMPOR BC 261 </dt>
												<dl class="row"
													style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">

													<!-- <dt class="col-sm-3"></dd> -->
													<dt class="col-sm-3">Barang</dt>
													<dd class="col-sm-3"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3"></dt>
													<dd class="col-sm-3"></dd>
													<dt class="col-sm-3">Bahan Baku Ke</dt>
													<dd class="col-sm-3"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3"></dt>
													<dd class="col-sm-3"></dd>
													<dt class="col-sm-3">Dok Asal</dt>
													<dd class="col-sm-1"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>

													<dt class="col-sm-2">KPPBC Dok</dt>
													<dd class="col-sm-2"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-2">Seri Ijin</dt>
													<dd class="col-sm-2"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">No/Tgl Dok</dt>
													<dd class="col-sm-2"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>

													<dt class="col-sm-2">No Aju</dt>
													<dd class="col-sm-2"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>



													<dt class="col-sm-2">Seri Brg Ke</dt>
													<dd class="col-sm-1"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>




												</dl>
											</div>
											<div class="col-sm-12 col-lg-12 col-xl-12">
												<dt class="col-sm-6"></dt>
												<dl class="row"
													style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">

													<dt class="col-sm-3">Kode</dt>
													<dd class="col-sm-3"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>

													<dt class="col-sm-3">Nomor HS</dt>
													<dd class="col-sm-3"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>

													<dt class="col-sm-3">Uraian Barang</dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>


													<dt class="col-sm-3">Tipe</dt>
													<dd class="col-sm-3"> <input type="text" value=""
															class="form-control form-control-sm " readOnly>

													<dt class="col-sm-3">Ukuran</dt>
													<dd class="col-sm-3"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Spf Lain</dt>
													<dd class="col-sm-3"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Merk</dt>
													<dd class="col-sm-3"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>


												</dl>
											</div>
											<div class="col-sm-12 col-lg-6 col-xl-6">
												<dl class="row"
													style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">

													<dt class="col-sm-9">HARGA & SATUAN </dt>
													<dd class="col-sm-3"> </dd>
													<dt class="col-sm-3">Harga CIF </dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>

													<dt class="col-sm-3">CIF Rupiah</dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>

													<dt class="col-sm-3">Jumlah Satuan</dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Jenis Satuan</dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>


												</dl>
											</div>
											<div class="col-sm-12 col-lg-6 col-xl-6">

												<dl class="row"
													style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">

													<dt class="col-sm-4">HASIL PERHITUNGAN</dt>
													<dd class="col-sm-8"> </dd>
													<dt class="col-sm-3">BM Barang Baku </dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly> </dd>
													<dt class="col-sm-3">PPN </dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly> </dd>
													<dt class="col-sm-3">PPnBM</dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">PPh</dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Cukai</dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3"></dt>
													<dd class="col-sm-9"> </dd>

													<dt class="col-sm-3">Jumlah Satuan</dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_detail_rm_lokal" role="tabpanel"
										aria-labelledby="contact-tab">
										<div class="row" style="margin-top: 15px;">
											<div class="col-sm-12 col-lg-12 col-xl-12">

												<dl class="row" style="margin-top: 15px; padding-top: 15px; ">
													<dt class="col-sm-3">STATUS</dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
												</dl>
											</div>
											<div class="col-sm-12 col-lg-12 col-xl-12">
												<dt class="col-sm-6"></dt>
												<dl class="row"
													style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">


													<dt class="col-sm-3">DATA BAHAN BAKU IMPOR BC 261 </dt>
													<dd class="col-sm-9"></dd>
													<dt class="col-sm-3">Barang</dt>
													<dd class="col-sm-3"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3"></dt>
													<dd class="col-sm-3"> </dd>
													<dt class="col-sm-3">Bahan Baku Ke</dt>
													<dd class="col-sm-3"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3"></dt>
													<dd class="col-sm-3"> </dd>





												</dl>
											</div>
											<div class="col-sm-12 col-lg-12 col-xl-12">
												<dt class="col-sm-6"></dt>
												<dl class="row"
													style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
													<dt class="col-sm-3">Dok Asal</dt>
													<dd class="col-sm-1"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-2">KPPBC Dok</dt>
													<dd class="col-sm-2"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-2">Seri Ijin</dt>
													<dd class="col-sm-2"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">No/Tgl Dok</dt>
													<dd class="col-sm-3"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>

													<dt class="col-sm-3">No Aju</dt>
													<dd class="col-sm-3"> <input type="text" value=""
															class="form-control form-control-sm " readOnly> </dd>

													<dt class="col-sm-3">Seri Brg Ke</dt>
													<dd class="col-sm-2"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
												</dl>
											</div>
											<div class="col-sm-12 col-lg-12 col-xl-12">
												<dt class="col-sm-6"></dt>
												<dl class="row"
													style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">

													<dt class="col-sm-3">Kode</dt>
													<dd class="col-sm-3"><input type="text" value=""
															class="form-control form-control-sm " readOnly> </dd>
													<dt class="col-sm-3">Nomor HS</dt>
													<dd class="col-sm-3"><input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>

													<dt class="col-sm-3">Uraian Barang</dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Tipe</dt>
													<dd class="col-sm-9"><input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>

													<dt class="col-sm-3">Ukuran</dt>
													<dd class="col-sm-9"><input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Spf Lain</dt>
													<dd class="col-sm-9"><input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Merk</dt>
													<dd class="col-sm-9"><input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>


												</dl>
											</div>
											<div class="col-sm-12 col-lg-6 col-xl-6">
												<dl class="row"
													style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
													<dt class="col-sm-9">HARGA & SATUAN </dt>
													<dd class="col-sm-3"> </dd>
													<dt class="col-sm-3">Harga CIF </dt>
													<dd class="col-sm-9"><input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>

													<dt class="col-sm-3">CIF Rupiah</dt>
													<dd class="col-sm-9"><input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>

													<dt class="col-sm-3">Jumlah Satuan</dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Jenis Satuan</dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>


												</dl>
											</div>
											<div class="col-sm-12 col-lg-6 col-xl-6">

												<dl class="row"
													style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
													<dt class="col-sm-4">NILAI PPN</dt>
													<dd class="col-sm-8"> </dd>


													<dt class="col-sm-3">PPN </dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly> </dd>
													<dt class="col-sm-3">PPN Bayar</dt>
													<dd class="col-sm-9"><input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">PPN Fasilitas</dt>
													<dd class="col-sm-9"> <input type="text" value=""
															class="form-control form-control-sm " readOnly></dd>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- <dl class="row" style="margin-top: 15px;">
		<dt class="col-sm-3">Volume (m3)</dt>
		<dd class="col-sm-9"><?=number_format(floatval(placeValue($tpbHeader,'VOLUME')), 4)?></dd>
		<dt class="col-sm-3">Berat Kotor (KG)</dt>
		<dd class="col-sm-9"><?=number_format(placeValue($tpbHeader,'BRUTO'), 4)?></dd>
		<dt class="col-sm-3">Berat Bersih (KG)</dt>
		<dd class="col-sm-9"><?=number_format(placeValue($tpbHeader,'NETTO'), 4)?></dd>
	</dl>
	<hr> -->
	<!-- <div class="row">
		<div class="col-md-12">
			<b>Dokumen</b>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<label></label>
				<table class="table table-hover table-bordered table-striped table-sm dt_po_add" id="table_dokumen"
					role="grid" style="white-space: nowrap; min-width: 600px">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Jenis Dokumen</th>
							<th class="text-center">Nomor Dokumen</th>
							<th class="text-center">Tanggal</th>
						</tr>
					</thead>
					<tbody>
						<?php
                    $i = 1;
                    foreach ($doclain as $row) {
                        echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        echo '<td>'.$row->URAIAN_DOKUMEN.'</td>';
                        echo '<td>'.$row->NOMOR_DOKUMEN.'</td>';
                        $tgl = isset($row->TANGGAL_DOKUMEN) ? date('d-m-Y', strtotime($row->TANGGAL_DOKUMEN)) : '';
                        echo '<td>'.$tgl.'</td>';
                        echo '</tr>';
                        $i++;
                    }
                    ?>
					</tbody>
				</table>
			</div>
		</div>
	</div> -->
</div>


<div class="form-group">
							<a href="<?=base_url('exim/posting_doc_out')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Cancel</a>
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Save</button>
						</div>
</form>
