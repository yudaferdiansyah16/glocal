<div class="card-body">
	<div class="row">
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="row">
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<p><b>No Pengajuan</b> : <?=placeValue($tpbHeader,'NOMOR_AJU')?></p>
				</div>
				<div class="col-sm-12 col-lg-6 col-xl-6">
					<p><b>Tanggal Pengajuan</b> : <?=isset($tpbHeader->TANGGAL_AJU) ? date('d-m-Y',strtotime($tpbHeader->TANGGAL_AJU)) : ''?></p>
				</div>
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<p><b>No Pendaftaran</b> : <?=placeValue($tpbHeader,'NOMOR_DAFTAR')?></p>
				</div>
				<div class="col-sm-12 col-lg-6 col-xl-6">
					<p><b>Kantor Pabean</b> : <?=placeValue($tpbHeader,'URAIAN_JENIS_TPB')?></p>
				</div>
				<div class="col-sm-12 col-lg-6 col-xl-6">
					<p><b>Tujuan Pemasukan</b> : <?=placeValue($tpbHeader,'URAIAN_DOKUMEN_PABEAN')?></p>
				</div>
				<div class="col-sm-6 col-lg-6 col-xl-6">
					<p><b>Kode Gudang PLB</b> : <?=placeValue($tpbHeader,'URAIAN_TUJUAN_TPB')?></p>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="row">
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<p style="margin: 0;padding-top: 10px"><b>PENGUSAHA TPB</b></p>
					<p style="margin: 0;padding: 0"><b>NPWP</b> : <?=placeValue($tpbHeader,'NAMA_PENGIRIM')?></p>
					<p style="margin: 0;padding: 0"><b>Nama</b> : <?=placeValue($tpbHeader,'ALAMAT_PENGIRIM')?></p>
					<p style="margin: 0;padding: 0"><b>Alamat</b> : <?=placeValue($tpbHeader,'ALAMAT_PENGIRIM')?></p>
					<p style="margin: 0;padding: 0"><b>Ijin TPB</b> : <?=placeValue($tpbHeader,'ALAMAT_PENGIRIM')?></p>
					<p style="margin: 0;padding: 0"><b>Api</b> : <?=placeValue($tpbHeader,'ALAMAT_PENGIRIM')?></p	>
				</div>
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<p style="margin: 0;padding-top: 10px"><b>PENGIRIMAN BARANG</b></p>
					<p style="margin: 0;padding: 0"><b>NPWP</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
					<p style="margin: 0;padding: 0"><b>NAMA</b> : <?=placeValue($tpbHeader,'NAMA_PENGUSAHA')?></p>
					<p style="margin: 0;padding: 0"><b>ALAMAT</b> : <?=placeValue($tpbHeader,'ALAMAT_PENGUSAHA')?></p>
					<!-- <p style="margin: 0;padding: 0"><b>NO IJIN TPB</b> : <?=placeValue($tpbHeader,'NOMOR_IJIN_TPB')?></p> -->
				</div>
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<p style="margin: 0;padding-top: 10px"><b>DOKUMEN</b></p>
					<p style="margin: 0;padding: 0"><b>Packing List</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
					<p style="margin: 0;padding: 0"><b>Surat Keputusan</b> : <?=placeValue($tpbHeader,'NAMA_PENGUSAHA')?></p>
					<p style="margin: 0;padding: 0"><b>Dok. BC 2.6.1</b> : <?=placeValue($tpbHeader,'ALAMAT_PENGUSAHA')?></p>
					<!-- <p style="margin: 0;padding: 0"><b>NO IJIN TPB</b> : <?=placeValue($tpbHeader,'NOMOR_IJIN_TPB')?></p> -->
				</div>
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<p style="margin: 0;padding-top: 10px"><b>HARGA</b></p>
					<p style="margin: 0;padding: 0"><b>Valuta</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
					<p style="margin: 0;padding: 0"><b>NDPBM</b> : <?=placeValue($tpbHeader,'NAMA_PENGUSAHA')?></p>
					<p style="margin: 0;padding: 0"><b>Nilai CIF (Rp)</b> : <?=placeValue($tpbHeader,'ALAMAT_PENGUSAHA')?></p>
					<!-- <p style="margin: 0;padding: 0"><b>NO IJIN TPB</b> : <?=placeValue($tpbHeader,'NOMOR_IJIN_TPB')?></p> -->
				</div>
				<div class="col-sm-6 col-lg-6 col-xl-6">
					<p style="margin: 0;padding-top: 10px"><b>PENGANGKUTAN</b></p>
					<p style="margin: 0;padding: 0"><b>Jenis Sarana Pengangkutan</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
					<!-- <p style="margin: 0;padding: 0"><b>Surat Keputusan</b> : <?=placeValue($tpbHeader,'NAMA_PENGUSAHA')?></p>
					<p style="margin: 0;padding: 0"><b>Dok. BC 2.6.1</b> : <?=placeValue($tpbHeader,'ALAMAT_PENGUSAHA')?></p>
					<p style="margin: 0;padding: 0"><b>NO IJIN TPB</b> : <?=placeValue($tpbHeader,'NOMOR_IJIN_TPB')?></p> -->
				</div>
				<div class="col-sm-6 col-lg-6 col-xl-6">
					<p style="margin: 0;padding-top: 10px"><b>KONTAINER</b></p>
					<!-- <p style="margin: 0;padding: 0"><b>Jenis Sarana Pengangkutan</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p> -->
					
				</div>
				<div class="col-sm-6 col-lg-6 col-xl-6">
					<p style="margin: 0;padding-top: 10px"><b>KEMASAN</b></p>
					<!-- <p style="margin: 0;padding: 0"><b>Jenis Sarana Pengangkutan</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p> -->
					
				</div>
				<div class="col-sm-6 col-lg-6 col-xl-6">
					<p style="margin: 0;padding-top: 10px"><b>BARANG</b></p>
					<p style="margin: 0;padding: 0"><b>Bruto</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
					<p style="margin: 0;padding: 0"><b>Netto (Kg)</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
					<p style="margin: 0;padding: 0"><b>Jumlah Barang</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
					
				</div>
				<div class="col-sm-6 col-lg-6 col-xl-6">
					<div class="col-sm-3 col-lg-3 col-xl-">
						<p style="margin: 0;padding-top: 10px"><b>Jenis Pungutan</b></p>
						<p style="margin: 0;padding: 0"><b>BM</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
						<p style="margin: 0;padding: 0"><b>BMT</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
						<p style="margin: 0;padding: 0"><b>Cukai</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
						<p style="margin: 0;padding: 0"><b>PPN</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
						<p style="margin: 0;padding: 0"><b>PPnBM</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
						<p style="margin: 0;padding: 0"><b>PPH</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
						<p style="margin: 0;padding: 0"><b>Jumlah Total</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
						<!-- <p style="margin: 0;padding: 0"><b>PPH</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p> -->
					</div>
					<div class="col-sm-3 col-lg-3 col-xl-">
						<p style="margin: 0;padding-top: 10px"><b>Ditangguhkan</b></p>
						<p style="margin: 0;padding: 0"><b>BM</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
						<p style="margin: 0;padding: 0"><b>BMT</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
						<p style="margin: 0;padding: 0"><b>Cukai</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
						<p style="margin: 0;padding: 0"><b>PPN</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
						<p style="margin: 0;padding: 0"><b>PPnBM</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
						<p style="margin: 0;padding: 0"><b>PPH</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
						<p style="margin: 0;padding: 0"><b>Jumlah Total</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
						<!-- <p style="margin: 0;padding: 0"><b>PPH</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p> -->
					</div>
				</div>	
				
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="row">
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<p style="margin-bottom: 0;padding-bottom: 0"><b>JAMINAN</b> : <?=placeValue($docinv,'NOMOR_DOKUMEN')?> <b>TGL</b>.<?=isset($docinv->TANGGAL_DOKUMEN) ? date('d-m-Y',strtotime($docinv->TANGGAL_DOKUMEN)) : ''?></p>
					<p style="margin: 0;padding: 0"><b></b></p>
					<?php foreach ($doclain as $row){ ?>
						<p style="margin: 0;padding: 0"><i class="fal fa-angle-double-right"></i> <b>NO. DOKUMEN</b> : <?=placeValue($row,'NOMOR_DOKUMEN')?> <b>TGL</b>.<?=isset($row->TANGGAL_DOKUMEN) ? date('d-m-Y',strtotime($row->TANGGAL_DOKUMEN)) : ''?></p>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<label><b>Jaminan</b></label>
				<table class="table table-hover table-bordered table-striped table-sm dt_" id="dt_detail_262" role="grid" style="white-space: nowrap; width: 99%">
					<thead>
					<tr>
						<th class="text-center">No</th>
						<th class="text-center">Jenis Jaminan</th>
						<th class="text-center">Nomor</th>
						<th class="text-center">Tanggal</th>
						<th class="text-center">Nilai</th>
						<th class="text-center">Jatuh Tempo</th>
						<th class="text-center">Penjamin</th>
						<th class="text-center">Nomor BPJ</th>
						<th class="text-center">Tanggal BPJ</th>
						<th class="text-center">Dokumen BC 2.6.1</th>
						<th class="text-center">Tanggal BC 2.6.1</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<label><b>Barang</b></label>
				<table class="table table-hover table-bordered table-striped table-sm" id="dt_doc_in_detail" role="grid" style="white-space: nowrap;width: 99%">
					<thead>
					<tr>
						<th class="text-center">No</th>
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
