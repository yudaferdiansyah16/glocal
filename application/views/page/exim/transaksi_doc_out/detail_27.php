<div class="card-body">
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<dl class="row" style="margin-top: 15px;">
				<dt class="col-sm-3">STATUS</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'URAIAN_STATUS')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">STATUS PERBAIKAN</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'KODE_STATUS_PERBAIKAN')?>"
						class="form-control form-control-sm " readOnly></dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<dl class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
				<dt class="col-sm-3">No Pengajuan</dt>
				<dd class="col-sm-3"><input type="text" value="<?=placeValue($tpbHeader,'NOMOR_AJU')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">No Pendaftaran</dt>
				<dd class="col-sm-3"><input type="text" value=" <?=placeValue($tpbHeader,'NOMOR_DAFTAR')?>"
						class="form-control form-control-sm " readOnly>:</dd>
				<dt class="col-sm-3">Tanggal Pendaftaran</dt>
				<dd class="col-sm-3"><input type="text"
						value=" <?=isset($tpbHeader->TANGGAL_DAFTAR) ? date('d-m-Y',strtotime($tpbHeader->TANGGAL_DAFTAR)) : ''?>"
						class="form-control form-control-sm " readOnly></dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<dl class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">

				<!-- <dt class="col-sm-3">Tanggal Pengajuan</dt>
				<dd class="col-sm-3"><input type="text"
						value="<?=isset($tpbHeader->TANGGAL_AJU) ? date('d-m-Y',strtotime($tpbHeader->TANGGAL_AJU)) : ''?>"
						class="form-control form-control-sm " readOnly> </dd> -->

				<dt class="col-sm-3">Kantor Asal</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'KODE_KANTOR')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Kantor Tujuan</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'KODE_KANTOR_TUJUAN')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Jenis TPB Asal</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'URAIAN_JENIS_TPB')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Jenis TPB Tujuan</dt>
				<dd class="col-sm-9">:<input type="text" value="<?=placeValue($tpbHeader,'URAIAN_TUJUAN_PENGIRIMAN')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Tujuan Pengiriman</dt>
				<dd class="col-sm-9"> <input type="text" value="<?=placeValue($tpbHeader,'URAIAN_DOKUMEN_PABEAN')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Kode Gudang PLB Asal</dt>
				<dd class="col-sm-9"> <input type="text" value="<?=placeValue($tpbHeader,'KODE_GUDANG_ASAL')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Kode Gudang PLB Tujuan</dt>
				<dd class="col-sm-9"> <input type="text" value="<?=placeValue($tpbHeader,'KODE_GUDANG_TUJUAN')?>"
						class="form-control form-control-sm " readOnly></dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<dl class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px; ">
				<dt class="col-sm-9">TPB ASAL BARANG</dt>
				<dd class="col-sm-3"></dd>
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
				<dt class="col-sm-9">TPB TUJUAN BARANG</dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">NPWP</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'ID_PENERIMA_BARANG')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Nama</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'NAMA_PENERIMA_BARANG')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Alamat</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'ALAMAT_PENERIMA_BARANG')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">No. Ijin TPB</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'NOMOR_IJIN_TPB')?>"
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
				<label></label>
				<dl class="row">
					<dt class="col-sm-3">Invoice</dt>
					<dd class="col-sm-9"><input type="text" value="" class="form-control form-control-sm " readOnly>
					</dd>
					<dt class="col-sm-3">Packing List</dt>
					<dd class="col-sm-9"><input type="text" value="" class="form-control form-control-sm " readOnly>
					</dd>
					<dt class="col-sm-3">Kontak</dt>
					<dd class="col-sm-9"><input type="text" value="" class="form-control form-control-sm " readOnly>
					</dd>
					<dt class="col-sm-3">Surat Jalan</dt>
					<dd class="col-sm-9"><input type="text" value="" class="form-control form-control-sm " readOnly>
					</dd>
					<dt class="col-sm-3">SKEP</dt>
					<dd class="col-sm-9"><input type="text" value="" class="form-control form-control-sm " readOnly>
					</dd>
					<dt class="col-sm-3">Dokumen Lainya</dt>
					<dd class="col-sm-9"></dd>
				</dl>
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
	</div>
	<hr>
	<div class="row">
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<dl class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
				<dt class="col-sm-3">HARGA</dt>
				<dd class="col-sm-9"></dd>
				<dt class="col-sm-3">Valuta</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'KODE_VALUTA')?>"
						class="form-control form-control-sm " readOnly></dd>

				<dt class="col-sm-3">NILAI CIF</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'CIF_RUPIAH')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">HARGA PENYERAHAN</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'HARGA_PENYERAHAN')?>"
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
				<dt class="col-sm-6">No Polisi</dt>
				<dd class="col-sm-6"><input type="text" value="<?=placeValue($tpbHeader,'NOMOR_POLISI')?>"
						class="form-control form-control-sm " readOnly></dd>

			</dl>
		</div>
		<div class="col-sm-6 col-lg-6 col-xl-6">
			<dl class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
				<dt class="col-sm-9">SEGEL BC ASAL</dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-6">No Segel</dt>
				<dd class="col-sm-6"><input type="text" value="" class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-6">Jenis</dt>
				<dd class="col-sm-6"><input type="text" value="" class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-6">Catatan BC Tujuan</dt>
				<dd class="col-sm-6"><input type="text" value="" class="form-control form-control-sm " readOnly></dd>

			</dl>
		</div>
	</div>
	<hr>
	<hr>
	<div class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
		<div class="col-md-12">
			<a href="#" data-toggle="modal" data-target="#m_kontainer_modal"><b>KONTAINER (F5)</b></a>
		</div>

		<div class="col-md-12">
			<div class="table-responsive">
				<label></label>
				<table class="table table-hover table-bordered table-striped table-sm dt_po_add" role="grid"
					style="white-space: nowrap; min-width: 600px">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Nomor Cont</th>
							<th class="text-center">Ukuran</th>
							<th class="text-center">Type</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($kontainer as $row) {
						?>
					<tbody>
						<tr>
							<td><?php echo $row->NOMOR_KONTAINER ?></td>
							<td><?php echo $row->KODE_TIPE_KONTAINER ?></td>
							<td><?php echo $row->KODE_UKURAN_KONTAINER ?></td>
						</tr>
					</tbody>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<hr>
	<div class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
		<div class="col-md-12">
			<a href="#" data-toggle="modal" data-target="#m_kemasan_modal"><b>KEMASAN (F7)</b></a>
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
			<dt class="col-sm-3"><a href="#" data-toggle="modal" id="btn3" data-target="#m_data_barang_out_modal">BARANG
					(F4)</a>
			</dt>
			<dd class="col-sm-9"></dd>
			<dt class="col-sm-3">Volume (m3)</dt>
			<dd class="col-sm-9"><input type="text"
					value="<?=number_format(floatval(placeValue($tpbHeader,'VOLUME')), 4)?>"
					class="form-control form-control-sm " readOnly></dd>
			<dt class="col-sm-3">Berat Kotor (KG)</dt>
			<dd class="col-sm-9"><input type="text" value="<?=number_format(placeValue($tpbHeader,'BRUTO'), 4)?>"
					class="form-control form-control-sm " readOnly></dd>
			<dt class="col-sm-3">Berat Bersih (KG)</dt>
			<dd class="col-sm-9"><input type="text" value="<?=number_format(placeValue($tpbHeader,'NETTO'), 4)?>"
					class="form-control form-control-sm " readOnly></dd>


		</dl>
	</div>
	<div class="col-sm-12 col-lg-6 col-xl-6" style="margin-top: 15px;">
		<dl class="row">
			<dt class="col-sm-11">Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal yang diberitahuka
				dalam dokumen ini.</dt>
			<dd class="col-sm-1"></dd>
		</dl>
		<dl class="row">
			<dt class="col-sm-6"><input type="text" value="NGAWi" class="form-control form-control-sm " readOnly></dt>
			<dd class="col-sm-6"><input type="text" value="15-10-2020" class="form-control form-control-sm " readOnly>
			</dd>
			<dt class="col-sm-3">Pemberitahu</dt>
			<dd class="col-sm-9"><input type="text" value="IRAWAN" class="form-control form-control-sm " readOnly></dd>
			<dt class="col-sm-3">Jabatan</dt>
			<dd class="col-sm-9"><input type="text" value="Manager" class="form-control form-control-sm " readOnly></dd>

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
					<div class="row">
						<div class="col-md-12">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab_detail_barang"
										role="tab" aria-controls="tab_detail_barang" aria-selected="true">Data Detail
										Barang</a>
								</li>
								<div class="dataTables_paginate paging_simple_numbers">
									<div class="">
										<ul class="pagination">
											<li class="paginate_button page-item previous" id="prev"><a href="#"
													id="brg_prev" aria-controls="dt" data-dt-idx="0" tabindex="0"
													class="page-link"><i class="fal fa-chevron-left"></i></a></li>

											<li class="paginate_button page-item next" id="next"><a href="#"
													id="brg_next" aria-controls="dt" data-dt-idx="2" tabindex="0"
													class="page-link"><i class="fal fa-chevron-right"></i></a></li>
										</ul>
									</div>
								</div>
								<li class="nav-item">
									<a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab_detail_rm_import"
										role="tab" aria-controls="tab_detail_rm_import" aria-selected="false">Detail
										Bahan Baku Impor</a>
								</li>
								<div class="dataTables_paginate paging_simple_numbers">
									<div class="">
										<ul class="pagination">
											<li class="paginate_button page-item previous" id="prev_import"><a href="#"
													id="brg_prevlokal" aria-controls="dt" data-dt-idx="0" tabindex="0"
													class="page-link"><i class="fal fa-chevron-left"></i></a></li>

											<li class="paginate_button page-item next" id="next_import"><a href="#"
													id="brg_nextimport" aria-controls="dt" data-dt-idx="2" tabindex="0"
													class="page-link"><i class="fal fa-chevron-right"></i></a></li>
										</ul>
									</div>
								</div>
								<li class="nav-item">
									<a class="nav-link" id="contact-tab" data-toggle="tab" href="#tab_detail_rm_lokal"
										role="tab" aria-controls="tab_detail_rm_lokal" aria-selected="false">Detail
										Bahan Baku Lokal</a>
								</li>
								<div class="dataTables_paginate paging_simple_numbers">
									<div class="">
										<ul class="pagination">
											<li class="paginate_button page-item previous" id="prev_lokal"><a href="#"
													id="brg_prev" aria-controls="dt" data-dt-idx="0" tabindex="0"
													class="page-link"><i class="fal fa-chevron-left"></i></a></li>

											<li class="paginate_button page-item next" id="next_lokal"><a href="#"
													id="brg_nextlokal" aria-controls="dt" data-dt-idx="2" tabindex="0"
													class="page-link"><i class="fal fa-chevron-right"></i></a></li>
										</ul>
									</div>
								</div>
							</ul>
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="tab_detail_barang" role="tabpanel"
									aria-labelledby="home-tab">
									<div class="row">
										<div class="col-sm-12 col-lg-12 col-xl-12">
											<dl class="row" style="margin-top: 15px; padding-top: 15px; ">
												<dt class="col-sm-3">STATUS</dt>
												<dd class="col-sm-9"> <input type="text" value=""
														class="form-control form-control-sm " readOnly></dd>
											</dl>
										</div>
										<div class="col-sm-12 col-lg-12 col-xl-12">
											<dl class="row"
												style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">

												<dt class="col-sm-3">Barang </dt>
												<dd class="col-sm-3"><input type="text" id="no_barang"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-3">Jumlah Barang</dt>
												<dd class="col-sm-3"><input type="text" id="jumlah_barang" class="form-control form-control-sm" readOnly></dd>
												<dt class="col-sm-3">Kode Barang</dt>
												<dd class="col-sm-3"><input type="text" id="kode_barang"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-3">Nomor HS</dt>
												<dd class="col-sm-3"><input type="text" id="harga_satuan"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-3"> Uraian barang</dt>
												<dd class="col-sm-9"><input type="text" id="uraian"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-3">Merk</dt>
												<dd class="col-sm-3"> <input type="text" id="merk"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-3">Tipe</dt>
												<dd class="col-sm-3"><input type="text" id="tipe"
														class="form-control form-control-sm " readOnly> </dd>
												<dt class="col-sm-3">Ukuran</dt>
												<dd class="col-sm-3"> <input type="text" id="ukuran"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-3">Spf Lain</dt>
												<dd class="col-sm-3"><input type="text" id="spf"
														class="form-control form-control-sm " readOnly> </dd>



											</dl>
										</div>
										<div class="col-sm-12 col-lg-12 col-xl-12">
											<dl class="row"
												style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
												<dt class="col-sm-3">SATUAN DAN HARGA</dt>
												<dd class="col-sm-9"></dd>
												<dt class="col-sm-2">Jumlah Satuan </dt>
												<dd class="col-sm-2"> <input type="text" id="jumla_satuan"
														class="form-control form-control-sm " readOnly> </dd>
												<dt class="col-sm-2">Netto (Kgm)</dt>
												<dd class="col-sm-2"> <input type="text" id="netto"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-2">Nilai CIF</dt>
												<dd class="col-sm-2"> <input type="text" id="cif"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-2">Jenis Satuan</dt>
												<dd class="col-sm-2"> <input type="text" id="cif_rp"
														class="form-control form-control-sm " readOnly></dd>


												<dt class="col-sm-2">Volume (M3)</dt>
												<dd class="col-sm-2"> <input type="text" value=""
														class="form-control form-control-sm " readOnly> </dd>

												<dt class="col-sm-2">Harga Penyerahan Rp</dt>
												<dd class="col-sm-2"> <input type="text" id="harga_penyerahan"
														class="form-control form-control-sm " readOnly></dd>


											</dl>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="tab_detail_rm_import" role="tabpanel"
									aria-labelledby="profile-tab">
									<div class="row" style="margin-top: 15px; padding-top: 15px;">
										<div class="col-sm-12 ">

											<dl class="row"
												style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
												<dt class="col-sm-2">STATUS</dt>
												<dd class="col-sm-3"> <input type="text" value=""
														class="form-control form-control-sm " readOnly></dd>

											</dl>
										</div>

										<div class="col-sm-12 col-lg-12 col-xl-12">
											<dt class="col-sm-6">DATA BAHAN BAKU IMPOR BC 2.7 </dt>

											<dl class="row"
												style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">


												<dt class="col-sm-2">Barang</dt>
												<dd class="col-sm-9"> <input type="text" id="no_bar_import"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-2">Bahan Baku Ke</dt>
												<dd class="col-sm-9"> <input type="text" id="jumlah_barang_import"
														class="form-control form-control-sm " readOnly></dd>




											</dl>
										</div>

										<div class="col-sm-12 col-lg-12 col-xl-12">
											<dl class="row"
												style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
												<dt class="col-sm-2">Dok Asal</dt>
												<dd class="col-sm-2"> <input type="text" id=""
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-2">KPPBC Dok</dt>
												<dd class="col-sm-2"><input type="text" value=""
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-2"></dt>
												<dd class="col-sm-2"></dd>
												<dt class="col-sm-2">No/Tgl Dok</dt>
												<dd class="col-sm-2"><input type="text" id="no_dokumen_import"
														class="form-control form-control-sm " readOnly>
												</dd>
												<dt class="col-sm-2">No Aju</dt>
												<dd class="col-sm-2"><input type="text" id="nomor_aju_import"
														class="form-control form-control-sm " readOnly>

												</dd>
												<dt class="col-sm-2">Urut Ke</dt>
												<dd class="col-sm-2"><input type="text"
														value="<?=placeValue($tpbBb,'SERI_DOKUMEN_ASAL')?>"
														class="form-control form-control-sm " readOnly>

												</dd>


											</dl>
										</div>
										<div class="col-sm-12 col-lg-12 col-xl-12">
											<dt class="col-sm-6"></dt>
											<dl class="row"
												style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">

												<dt class="col-sm-3">Kode</dt>
												<dd class="col-sm-3"><input type="text" id="kode_barang_import"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-3">Nomor HS</dt>
												<dd class="col-sm-3"><input type="text" id="harga_satuan_import"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-3">Uraian Barang</dt>
												<dd class="col-sm-9"> <input type="text" id="uraian_import"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-3">Tipe</dt>
												<dd class="col-sm-3"><input type="text" id="tipe_import"
														class="form-control form-control-sm " readOnly></dd>

												<dt class="col-sm-3">Ukuran</dt>
												<dd class="col-sm-3"><input type="text" id="ukuran_import"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-3">Spf Lain</dt>
												<dd class="col-sm-3"><input type="text" id="spf_import"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-3">Merk</dt>
												<dd class="col-sm-3"><input type="text" id="merk_import"
														class="form-control form-control-sm " readOnly></dd>


											</dl>
										</div>
										<div class="col-sm-12 col-lg-12 col-xl-12"
											style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
											<dt class="col-sm-4">NILAI BM</dt>
											<dd class="col-sm-9"> </dd>
											<dl class="row">

												<dt class="col-sm-3">BM Barang Jadi </dt>
												<dd class="col-sm-9"> <input type="text" value=""
														class="form-control form-control-sm " readOnly> </dd>
												<dt class="col-sm-3">BM Barang Baku </dt>
												<dd class="col-sm-9"> <input type="text" value=""
														class="form-control form-control-sm " readOnly></dd>
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


											</dl>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="tab_detail_rm_lokal" role="tabpanel"
									aria-labelledby="contact-tab">
									<div class="row" style="margin-top: 15px;">
										<div class="col-sm-12 col-lg-12 col-xl-12">
											<dl class="row" style="margin-top: 15px;">
												<dt class="col-sm-3">STATUS</dt>
												<dd class="col-sm-9"><input type="text"
														value="<?=placeValue($barang,'URAIAN_STATUS')?>"
														class="form-control form-control-sm " readOnly></dd>



											</dl>
										</div>
										<div class="col-sm-12 col-lg-12 col-xl-12">
											<dl class="row"
												style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
												<dt class="col-sm-3">Detail Ke</dt>
												<dd class="col-sm-3"> <input type="text" id="no_barlokal"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-3">Dari Bahan Baku Ke</dt>
												<dd class="col-sm-3"> <input type="text" id="jumlah_baranglokal"
														class="form-control form-control-sm " readOnly> </dd>
												<dt class="col-sm-3">Dok Asal</dt>
												<dd class="col-sm-3"> <input type="text"
														value="<?=placeValue($barang,'KODE_JENIS_DOK_ASAL')?>"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-3">KPPBC Dok</dt>
												<dd class="col-sm-3"><input type="text"
														value="<?=placeValue($barang,'KODE_KANTOR')?>"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-3">No/Tgl Dok</dt>
												<dd class="col-sm-3"><input type="text" id="no_dokumenlokal"
														class="form-control form-control-sm " readOnly>
												</dd>
												<dt class="">/</dt>
												<dd class="col-sm-3">
													<input type="text" class="form-control form-control-sm " readOnly>
												</dd>

												<dt class="col-sm-3">No Aju</dt>
												<dd class="col-sm-3"><input type="text" id="nomor_ajulokal"
														class="form-control form-control-sm " readOnly> </dd>
												<dt class="col-sm-3">Urut Ke</dt>
												<dd class="col-sm-3"><input type="text"
														value="<?=placeValue($barang,'SERI_DOKUMEN_ASAL') ?>"
														class="form-control form-control-sm " readOnly>
												</dd>


											</dl>
										</div>
										<div class="col-sm-12 col-lg-12 col-xl-12">
											<dt class="col-sm-6">DATA BAHAN BAKU</dt>
											<dl class="row"
												style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">

												<dt class="col-sm-3">Kode</dt>
												<dd class="col-sm-7"> <input type="text" id="kode_baranglokal"
														class="form-control form-control-sm " readOnly> </dd>
												<!-- <dt class="col-sm-3">Nomor HS</dt>
													<dd class="col-sm-2"> <input type="text"
															id="harga_satuanlokal"
															class="form-control form-control-sm " readOnly></dd> -->
												<dt class="col-sm-0"></dt>
												<dd class="col-sm-2"> </dd>
												<dt class="col-sm-3">Uraian Barang</dt>
												<dd class="col-sm-9"> <input type="text" id="uraianlokal"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-3">Tipe</dt>
												<dd class="col-sm-2"> <input type="text" id="tipelokal"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-1">Ukuran</dt>
												<dd class="col-sm-2"> <input type="text" id="ukuranlokal"
														class="form-control form-control-sm " readOnly> </dd>
												<dt class="col-sm-1">Spf Lain</dt>
												<dd class="col-sm-2"> <input type="text" id="spflokal"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-3">Merk</dt>
												<dd class="col-sm-2"> <input type="text" id="merklokal"
														class="form-control form-control-sm " readOnly> </dd>


											</dl>
										</div>
										<div class="col-md-12">
											<b>HARGA & SATUAN </b>
										</div>
										<div class="col-sm-12 col-lg-12 col-xl-12">
											<dl class="row"
												style="margin-top: 15px; border-style: dotted; border-width:1px;">

												<dt class="col-sm-3">Harga Perolehan </dt>
												<dd class="col-sm-3"><input type="text" id="ciflokal"
														class="form-control form-control-sm " readOnly> </dd>
												<dt class="col-sm-3">Harga Penyerahan</dt>
												<dd class="col-sm-3"><input type="text"
														value="<?=placeValue($barang,'NDPBM')?>"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-3">Jumlah Satuan</dt>
												<dd class="col-sm-3"><input type="text" id="cif_rplokal"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-3">Jenis Satuan</dt>
												<dd class="col-sm-3"><input type="text"
														value="<?=placeValue($barang,'JUMLAH_SATUAN')?>"
														class="form-control form-control-sm " readOnly></dd>

											</dl>
										</div>
									</div>
									<div class="col-md-12">
										<b>NILAI PPN</b>
									</div>
									<div class="row" style="margin-top: 15px; border-style: dotted; border-width:1px;">
										<div class="col-sm-12 col-lg-6 col-xl-6">
											<dt class="col-sm-4"></dt>
											<dd class="col-sm-9"> </dd>
											<dl class="row" style="margin-top: 15px;">


												<dt class="col-sm-3">PPN </dt>
												<dd class="col-sm-9"><input type="text"
														value="<?=placeValue($barang,'JENIS_TARIF')?>"
														class="form-control form-control-sm " readOnly> </dd>
												<dt class="col-sm-3">PPN Bayar</dt>
												<dd class="col-sm-9"> <input type="text"
														value="<?=placeValue($barang,'NILAI_BAYAR')?>"
														class="form-control form-control-sm " readOnly></dd>
												<dt class="col-sm-3">PPN Fasilitas</dt>
												<dd class="col-sm-9"> <input type="text"
														value="<?=placeValue($barang,'NILAI_FASILITAS')?>"
														class="form-control form-control-sm " readOnly></dd>



											</dl>
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


	<!-- <div class="row">
    	<div class="col-md-12">
    		<b>Dokumen</b>
    	</div>
    </div>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<label></label>
				<table class="table table-hover table-bordered table-striped table-sm dt_po_add" id="table_dokumen" role="grid" style="white-space: nowrap; min-width: 600px">
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