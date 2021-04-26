<div class="card-body">
	<div class="row">
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="row">
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<p><b>No Pengajuan</b> : <?=placeValue($tpbHeader,'NOMOR_AJU')?></p>
				</div>
				<div class="col-sm-12 col-lg-6 col-xl-6">
					<p><b>No Pendaftaran</b> :<?=placeValue($tpbHeader, 'NOMOR_DAFTAR')?></p>
				</div>
				<div class="col-sm-12 col-lg-6 col-xl-6">
					<p><b>Tanggal Pengajuan</b> : <?=isset($tpbHeader->TANGGAL_AJU) ? date('d-m-Y',strtotime($tpbHeader->TANGGAL_AJU)) : ''?></p>
				</div>
				<div class="col-sm-12 col-lg-6 col-xl-6">
					<p><b>Kantor Asal</b> : <?=placeValue($tpbHeader,'URAIAN_JENIS_TPB')?></p>
				</div>
				<div class="col-sm-12 col-lg-6 col-xl-6">
					<p><b>Kantor Tujuan</b> : <?=placeValue($tpbHeader,'URAIAN_JENIS_TPB')?></p>
				</div>
				<div class="col-sm-12 col-lg-6 col-xl-6">
					<p><b>Jenis TPB Asal</b> : <?=placeValue($tpbHeader,'URAIAN_JENIS_TPB')?></p>
				</div>
				<div class="col-sm-12 col-lg-6 col-xl-6">
					<p><b>Jenis TPB Tujuan</b> : <?=placeValue($tpbHeader,'URAIAN_JENIS_TPB')?></p>
				</div>
				<div class="col-sm-12 col-lg-6 col-xl-6">
					<p><b>Tujuan Pengiriman</b> : <?=placeValue($tpbHeader,'URAIAN_JENIS_TPB')?></p>
				</div>
				<div class="col-sm-12 col-lg-6 col-xl-6">
					<p><b>Kode Gudang PLB Asal</b> : <?=placeValue($tpbHeader,'URAIAN_JENIS_TPB')?></p>
				</div>
				<div class="col-sm-12 col-lg-6 col-xl-6">
					<p><b>Kode Gudang PLB Tujuan</b> : <?=placeValue($tpbHeader,'URAIAN_JENIS_TPB')?></p>
				</div>
				<!-- <div class="col-sm-12 col-lg-6 col-xl-6">
					<p><b>Jenis Dokumen</b> : <?=placeValue($tpbHeader,'URAIAN_DOKUMEN_PABEAN')?></p>
				</div> -->
			</div>
		</div>
		
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="row">
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<p style="margin: 0;padding-top: 10px"><b>TPB ASAL BARANG</b></p>
					<p style="margin: 0;padding: 0"><b>NPWP</b> : <?=placeValue($tpbHeader,'NAMA_PENGIRIM')?></p>
					<p style="margin: 0;padding: 0"><b>Nama</b> : <?=placeValue($tpbHeader,'ALAMAT_PENGIRIM')?></p>
					<p style="margin: 0;padding: 0"><b>Alamat</b> : <?=placeValue($tpbHeader,'ALAMAT_PENGIRIM')?></p>
					<p style="margin: 0;padding: 0"><b>No.Izin</b> : <?=placeValue($tpbHeader,'ALAMAT_PENGIRIM')?></p>
				</div>
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<p style="margin: 0;padding-top: 10px"><b>TPB Tujuan BARANG</b></p>
					<p style="margin: 0;padding: 0"><b>NPWP</b> : <?=placeValue($tpbHeader,'NAMA_PENGIRIM')?></p>
					<p style="margin: 0;padding: 0"><b>Nama</b> : <?=placeValue($tpbHeader,'ALAMAT_PENGIRIM')?></p>
					<p style="margin: 0;padding: 0"><b>Alamat</b> : <?=placeValue($tpbHeader,'ALAMAT_PENGIRIM')?></p>
					<p style="margin: 0;padding: 0"><b>No.Izin</b> : <?=placeValue($tpbHeader,'ALAMAT_PENGIRIM')?></p>
				</div>
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<p style="margin: 0;padding-top: 10px"><b>DOKUMENTASI</b></p>
					<p style="margin: 0;padding: 0"><b></b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
					<p style="margin: 0;padding: 0"><b></b> : <?=placeValue($tpbHeader,'NAMA_PENGUSAHA')?></p>
					<p style="margin: 0;padding: 0"><b></b> : <?=placeValue($tpbHeader,'ALAMAT_PENGUSAHA')?></p>
					<p style="margin: 0;padding: 0"><b></b> : <?=placeValue($tpbHeader,'NOMOR_IJIN_TPB')?></p>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="row">
				<div class="col-sm-6 col-lg-6 col-xl-6">
					<p style="margin: 0;padding-top: 10px"><b>PENGANGKUTAN</b></p>
					<p style="margin: 0;padding: 0"><b>Jenis Sarana Pengangkutan Darat	</b> : <?=placeValue($docinv,'NOMOR_DOKUMEN')?> <b>TGL</b>.<?=isset($docinv->TANGGAL_DOKUMEN) ? date('d-m-Y',strtotime($docinv->TANGGAL_DOKUMEN)) : ''?></p>
					<p style="margin: 0;padding: 0"><b>No. Polisi</b></p>
					<!-- <?php foreach ($doclain as $row){ ?>
						<p style="margin: 0;padding: 0"><i class="fal fa-angle-double-right"></i> <b>NO. DOKUMEN</b> : <?=placeValue($row,'NOMOR_DOKUMEN')?> <b>TGL</b>.<?=isset($row->TANGGAL_DOKUMEN) ? date('d-m-Y',strtotime($row->TANGGAL_DOKUMEN)) : ''?></p>
					<?php } ?> -->
				</div>
				<div class="col-sm-6 col-lg-6 col-xl-6">
					<p style="margin: 0;padding-top: 10px"><b>SEGEL BC ASAL</b></p>
					<p style="margin: 0;padding: 0"><b>No. Segel</b> : <?=placeValue($docinv,'NOMOR_DOKUMEN')?> <b>TGL</b>.<?=isset($docinv->TANGGAL_DOKUMEN) ? date('d-m-Y',strtotime($docinv->TANGGAL_DOKUMEN)) : ''?></p>
					<p style="margin: 0;padding: 0"><b>Jenis</b></p>
					<p style="margin: 0;padding: 0"><b>Catatan BC Tujuan</b></p>
					<!-- <?php foreach ($doclain as $row){ ?>
						<p style="margin: 0;padding: 0"><i class="fal fa-angle-double-right"></i> <b>NO. DOKUMEN</b> : <?=placeValue($row,'NOMOR_DOKUMEN')?> <b>TGL</b>.<?=isset($row->TANGGAL_DOKUMEN) ? date('d-m-Y',strtotime($row->TANGGAL_DOKUMEN)) : ''?></p>
					<?php } ?> -->
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<label><b>KONTAINER</b></label>
				<table class="table table-hover table-bordered table-striped table-sm" id="dt_doc_in_detail" role="grid" style="white-space: nowrap;width: 99%">
					<thead>
					<tr>
						<th class="text-center">Nomor Count</th>
						<th class="text-center">Kode Barang</th>
						<th class="text-center">Nama Barang</th>
						<th class="text-center">Satuan</th>
						<th class="text-center">Quantity</th>
						<th class="text-center">Harga</th>
						<th class="text-center">Asuransi</th>
						<th class="text-center">Diskon</th>
						<th class="text-center">Jumlah Kemasan</th>
						<th class="text-center">Tipe Kemasan</th>
					</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<label><b>Dokumen</b></label>
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
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
