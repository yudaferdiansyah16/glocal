

<form method="post" action="<?= base_url('exim/transaksi_doc_out/update') ?>">
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
				<dd class="col-sm-3"><input type="text" value=" <?=placeValue($tpbHeader,'NOMOR_AJU')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">No Pendaftaran</dt>
				<dd class="col-sm-3"><input type="text" value="<?=placeValue($tpbHeader,'NOMOR_DAFTAR')?>"
						class="form-control form-control-sm " readOnly> </dd>

				<dt class="col-sm-3">Tanggal Pendaftaran</dt>
				<dd class="col-sm-3"><input type="text" value="
					<?=isset($tpbHeader->TANGGAL_DAFTAR) ? date('d-m-Y',strtotime($tpbHeader->TANGGAL_DAFTAR)) : ''?>"
						class="form-control form-control-sm " readOnly>
				</dd>

			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<dl class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
				<dt class="col-sm-3">Kantor Pabean</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'KODE_KANTOR_MUAT')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Jenis TPB</dt>
				<dd class="col-sm-9"><input type="text" value=" <?=placeValue($tpbHeader,'URAIAN_JENIS_TPB')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Tujuan</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'URAIAN_TUJUAN_PENGIRIMAN')?>"
						class="form-control form-control-sm " readOnly> </dd>
				<dt class="col-sm-3">KODE GUDANG PLB</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'URAIAN_DOKUMEN_PABEAN')?>"
						class="form-control form-control-sm " readOnly></dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<dl class="row" style="margin-top: 15px; border-style: dotted; border-width:1px;">
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
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<dl class="row" style="margin-top: 15px; border-style: dotted; border-width:1px;">
				<dt class="col-sm-3">PENERIMA</dt>
				<dd class="col-sm-9"></dd>
				<dt class="col-sm-3">NPWP</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'ID_PENERIMA_BARANG')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Nama</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'NAMA_PENERIMA_BARANG')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Alamat</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'ALAMAT_PENERIMA_BARANG')?>"
						class="form-control form-control-sm " readOnly></dd>
			</dl>
		</div>
		<div class="col-md-12">
			<b>PENGANGKUT</b>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<dl class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">

				<dt class="col-sm-3">Jenis Sarana Pengagkut Darat</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'NAMA_PENGANGKUT')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Nomor Polisi</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'NOMOR_POLISI')?>"
						class="form-control form-control-sm " readOnly></dd>

			</dl>
		</div>
		<div class="col-md-12">
			<b>HARGA</b>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<dl class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">

				<dt class="col-sm-3">Harga Penyerahan</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'HARGA_PENYERAHAN')?>"
						class="form-control form-control-sm " readOnly></dd>
				
			</dl>
		</div>


	<div class="col-md-12 col-lg-12 col-xl-12" style="margin-top: 15px; border-style: dotted; border-width:1px;">
		<div class="table-responsive">
			
			<dl class="row" style="margin-top: 15px;">
			<dt class="col-sm-3"><a href="#" data-toggle="modal" data-target="#m_dokumen_modal">DOKUMEN [F6]</a></dt>
					<dd class="col-sm-9"></dd>
				<dt class="col-sm-3">Packing List</dt>
				<dd class="col-sm-9"><input type="text" value="" class="form-control form-control-sm " readOnly></dd>

				<dt class="col-sm-3">Kontrak</dt>
				<dd class="col-sm-9"><input type="text" value="" class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Faktur Pajak</dt>
				<dd class="col-sm-9"><input type="text" value="" class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Skep</dt>
				<dd class="col-sm-9"><input type="text" value="" class="form-control form-control-sm " readOnly></dd>

				<dt class="col-sm-3">Surat Keputusan / Dokumen Lainya</dt>
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

	<hr>
	
	<div class="col-md-12 col-lg-12 col-xl-12" style="margin-top: 15px; border-style: dotted; border-width:1px;">		<div class="col-md-12">
			<b>Kemasan</b>
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
	<hr>
	<div class="col-sm-12 col-lg-12 col-xl-12">
			<dl class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
				<dt class="col-sm-3"><a href="#" data-toggle="modal" data-target="#m_data_barang_out_modal">BARANG (F4)</a></dt>
				<dd class="col-sm-9"></dd>
				<dt class="col-sm-3">Volume (m3)</dt>
				<dd class="col-sm-3"><input type="text" value="<?=placeValue($tpbHeader,'VOLUME')?>"
						class="form-control form-control-sm " readOnly>
				<dt class="col-sm-3"></dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">Berat Kotor (kg)</dt>
				<dd class="col-sm-3"><input type="text" value="<?=placeValue($tpbHeader,'BRUTO')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
				<dt class="col-sm-3"></dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">Berat Bersih</dt>
				<dd class="col-sm-3"><input type="text" value="<?=placeValue($tpbHeader,'NETTO')?>"
						class="form-control form-control-sm " readOnly></dd>
						<dt class="col-sm-3"></dt>
				<dd class="col-sm-3">
				<dt class="col-sm-3">Jumlah Barang</dt>
				<dd class="col-sm-3"><input type="text" value="<?=placeValue($tpbHeader,'JUMLAH_BARANG')?>"
						class="form-control form-control-sm " readOnly></dd>
						<dt class="col-sm-3"></dd>
				
				
			</dl>
		</div>
	<hr>
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

	</div>
	</div>
	<hr>
	<div class="modal fade  modal-fullscreen" id="m_data_barang_out_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Document</h5>
				<button type="button" class="close" data-dismiss="modal" >&times;</button>
			</div>
			<div class="modal-body">
				<div class="">
				<div class="row">
				<div class="col-md-12">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab_detail_barang" role="tab"
						aria-controls="tab_detail_barang" aria-selected="true">Data Detail Barang</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab_detail_rm_import" role="tab"
						aria-controls="tab_detail_rm_import" aria-selected="false">Detail Bahan Baku </a>
				</li>

			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="tab_detail_barang" role="tabpanel"
					aria-labelledby="home-tab">
					<div class="row" style="margin-top: 15px;">
						<div class="col-sm-12 col-lg-12 col-xl-12">
							<dl class="row" style="margin-top: 15px;">
								<dt class="col-sm-3">STATUS</dt>
								<dd class="col-sm-9"> <input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>
							</dl>
						</div>
						<div class="col-sm-12 col-lg-12 col-xl-12">
							<dl class="row"
								style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">

								<dt class="col-sm-2">Barang </dt>
								<dd class="col-sm-3"><input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>

								<dt class="col-sm-3"></dt>
								<dt class="col-sm-3"></dt>
								<dt class="col-sm-2">Kode Barang</dt>
								<dd class="col-sm-3"><input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>
								<dt class="col-sm-3"></dt>
								<dt class="col-sm-3"></dt>
								<dt class="col-sm-2"> Uraian barang</dt>
								<dd class="col-sm-9"><input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>
								<dt class="col-sm-2">Merk</dt>
								<dd class="col-sm-2"><input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>
								<dt class="col-sm-2">Tipe</dt>
								<dd class="col-sm-2"><input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>
								<dt class="col-sm-2">Ukuran</dt>
								<dd class="col-sm-2"><input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>
								<dt class="col-sm-2">Spf Lain</dt>
								<dd class="col-sm-2"><input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>



							</dl>
						</div>
						<div class="col-sm-12 col-lg-12 col-xl-12">
							<dl class="row" style="margin-top: 15px; border-style: dotted; border-width:1px;">
								<dt class="col-sm-3">HARGA</dt>
								<dd class="col-sm-9"></dd>
								<dt class="col-sm-2">Jumlah Satuan </dt>
								<dd class="col-sm-2"> <input type="text" value="" class="form-control form-control-sm "
										readOnly> </dd>
								<dt class="col-sm-2">Jenis Satuan</dt>
								<dd class="col-sm-2"><input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>
								<dt class="col-sm-2">Netto (Kgm)</dt>
								<dd class="col-sm-2"> <input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>

								<dt class="col-sm-2">Volume (M3)</dt>
								<dd class="col-sm-2"><input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>

								<dt class="col-sm-2">Harga Penyerahan Rp</dt>
								<dd class="col-sm-2	"><input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>


							</dl>
						</div>
						<div class="col-sm-12 col-lg-12 col-xl-12">
							<dl class="row" style="margin-top: 15px;">
								<dt class="col-sm-2"></dt>
								<dd class="col-sm-2"></dd>
								<dt class="col-sm-2"> </dt>
								<dd class="col-sm-2"></dd>
								<dt class="col-sm-2">JUMLAH BAHAN BAKU </dt>
								<dd class="col-sm-2"><input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>

							</dl>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="tab_detail_rm_import" role="tabpanel" aria-labelledby="profile-tab">
					<div class="row" style="margin-top: 15px;">
						<div class="col-sm-12 col-lg-12 col-xl-12">
							<dl class="row" style="margin-top: 15px; padding-top: 15px; b">
								<dt class="col-sm-3">STATUS</dt>
								<dd class="col-sm-5"><input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>
							</dl>
						</div>
						<div class="col-sm-12 col-lg-12 col-xl-12">

							<dl class="row"
								style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">

								<dt class="col-sm-12">DATA BAHAN BAKU IMPOR BC 4.1 </dt>
								<dt class="col-sm-3">Barang</dt>
								<dd class="col-sm-3"> <input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>
								<dt class="col-sm-3"></dt>
								<dd class="col-sm-3"></dd>
								<dt class="col-sm-3">Bahan Baku Ke</dt>
								<dd class="col-sm-3"> <input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>

							</dl>
						</div>
						<div class="col-sm-12 col-lg-12 col-xl-12">

							<dl class="row"
								style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">

								<dt class="col-sm-3">Dok Asal</dt>
								<dd class="col-sm-3"> <input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>
								<dt class="col-sm-3">KPPBC Dok</dt>
								<dd class="col-sm-3"><input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>
								<dt class="col-sm-3">No/Tgl Dok</dt>
								<dd class="col-sm-3"><input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>

								<dt class="col-sm-3">No Aju</dt>
								<dd class="col-sm-3"><input type="text" value="" class="form-control form-control-sm "
										readOnly> <b>Urut Ke</b> <input type="text" value=""
										class="form-control form-control-sm " readOnly></dd>




							</dl>
						</div>
						<div class="col-sm-12 col-lg-12 col-xl-12">

							<dl class="row"
								style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">

								<dt class="col-sm-2">Kode Barang</dt>
								<dd class="col-sm-3"><input type="text" value="" class="form-control form-control-sm "
										readOnly> </dd>

								<dt class="col-sm-3"></dt>
								<dd class="col-sm-4"></dd>

								<dt class="col-sm-2">Uraian Barang</dt>
								<dd class="col-sm-10"><input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>
								<dt class="col-sm-2">Tipe</dt>
								<dd class="col-sm-2"><input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>

								<dt class="col-sm-2">Ukuran</dt>
								<dd class="col-sm-2"><input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>
								<dt class="col-sm-2">Spf Lain</dt>
								<dd class="col-sm-2"><input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>
								<dt class="col-sm-2">Merk</dt>
								<dd class="col-sm-2"><input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>


							</dl>
						</div>

						<div class="col-sm-12 col-lg-12 col-xl-12">
							<dl class="row"
								style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
								<dt class="col-sm-3">SATUAN DAN HARGA</dt>
								<dd class="col-sm-9"></dd>
								<dt class="col-sm-2">Jumlah Satuan </dt>
								<dd class="col-sm-2"> <input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>
								<dt class="col-sm-2">Jenis Satuan</dt>
								<dd class="col-sm-2"> <input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>
								<dt class="col-sm-2">Harga Penyerahan Rp</dt>
								<dd class="col-sm-2"> <input type="text" value="" class="form-control form-control-sm "
										readOnly></dd>


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
</div>


<!-- <dl class="row" style="margin-top: 15px;">
	<dt class="col-sm-3">Volume (m3)</dt>
	<dd class="col-sm-9"><?=number_format(floatval(placeValue($tpbHeader,'VOLUME')), 4)?></dd>
	<dt class="col-sm-3">Berat Kotor (KG)</dt>
	<dd class="col-sm-9"><?=number_format(placeValue($tpbHeader,'BRUTO'), 4)?></dd>
	<dt class="col-sm-3">Berat Bersih (KG)</dt>
	<dd class="col-sm-9"><?=number_format(placeValue($tpbHeader,'NETTO'), 4)?></dd>
</dl>
<hr>
<div class="row">
	<div class="col-md-12">
		<b>Dokumen</b>
	</div>
</div>
<div class="row"> -->
<!-- <div class="col-md-12">
	<div class="table-responsive">
		<label></label>
		<table class="table table-hover table-bordered table-striped table-sm dt_po_add" id="table_dokumen" role="grid"
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
</div> -->
<!-- </div> -->


<div class="form-group">
							<a href="<?=base_url('exim/posting_doc_out')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Cancel</a>
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Save</button>
						</div>
</form>
