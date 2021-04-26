<div class="card-body">
	<div class="row">
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="row">
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<p><b>No Pengajuan</b> : <?=placeValue($tpbHeader,'NOMOR_AJU')?></p>
				</div>
				<div class="col-sm-12 col-lg-6 col-xl-6">
					<p><b>Tanggal Pengajuan</b> :
						<?=isset($tpbHeader->TANGGAL_AJU) ? date('d-m-Y',strtotime($tpbHeader->TANGGAL_AJU)) : ''?></p>
				</div>
				<div class="col-sm-12 col-lg-6 col-xl-6">
					<p><b>Jenis TPB</b> : <?=placeValue($tpbHeader,'URAIAN_JENIS_TPB')?></p>
				</div>
				<div class="col-sm-12 col-lg-6 col-xl-6">
					<p><b>Jenis Dokumen</b> : <?=placeValue($tpbHeader,'URAIAN_DOKUMEN_PABEAN')?></p>
				</div>
				<div class="col-sm-12 col-lg-6 col-xl-6">
					<p><b>Tujuan</b> : <?=placeValue($tpbHeader,'URAIAN_TUJUAN_TPB')?></p>
				</div>
				
			</div>
			<div class="row">
			<!-- <div class="col-sm-12 col-lg-12 col-xl-12">
					<p><b>KPPBC Bongkar</b> : <?=placeValue($m_sbu,'KPPBC')?> </p>
				</div>
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<p><b>KPPBC Pengawas</b> : </p>
				</div> -->
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<p><b>Tujuan</b> : <?=placeValue($tpbHeader,'URAIAN_TUJUAN_TPB')?></p>
				</div>
			</div>
		</div>

		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="row">
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<p><b>No Pendaftaran</b> : <?=placeValue($tpbHeader,'NOMOR_DAFTAR')?></p>
				</div>
				<div class="col-sm-12 col-lg-6 col-xl-6">
					<p><b>Tanggal Pendaftaran</b> :
						<?=isset($tpbHeader->TANGGAL_DAFTAR) ? date('d-m-Y',strtotime($tpbHeader->TANGGAL_DAFTAR)) : ''?>
					</p>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="row">
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<p style="margin: 0;padding-top: 10px"><b>PEMASOK</b></p>
					<p style="margin: 0;padding: 0"><b>NAMA</b> : <?=placeValue($tpbHeader,'NAMA_PEMASOK')?></p>
					<p style="margin: 0;padding: 0"><b>ALAMAT</b> : <?=placeValue($tpbHeader,'ALAMAT_PEMASOK')?></p>
					<p style="margin: 0;padding: 0"><b>NEGARA</b> : [<?=placeValue($tpbHeader,'KODE_NEGARA_PEMASOK')?>]
						<?=placeValue($tpbHeader,'URAIAN_NEGARA_PEMASOK')?></p>
				</div>
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<p style="margin: 0;padding-top: 10px"><b>PENGUSAHA</b></p>
					<p style="margin: 0;padding: 0"><b>NPWP</b> : <?=placeValue($tpbHeader,'ID_PENGUSAHA')?></p>
					<p style="margin: 0;padding: 0"><b>NAMA</b> : <?=placeValue($tpbHeader,'NAMA_PENGUSAHA')?></p>
					<p style="margin: 0;padding: 0"><b>ALAMAT</b> : <?=placeValue($tpbHeader,'ALAMAT_PENGUSAHA')?></p>
					<p style="margin: 0;padding: 0"><b>NO IJIN TPB</b> : <?=placeValue($tpbHeader,'NOMOR_IJIN_TPB')?>
					</p>
				</div>
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<p style="margin: 0;padding-top: 10px;"><b>PEMILIK</b></p>
					<p style="margin: 0;padding: 0"><b>NPWP</b> : <?=placeValue($tpbHeader,'ID_PEMILIK')?></p>
					<p style="margin: 0;padding: 0"><b>NAMA</b> : <?=placeValue($tpbHeader,'NAMA_PEMILIK')?></p>
					<p style="margin-top: 0;padding-top: 0"><b>ALAMAT</b> : <?=placeValue($tpbHeader,'ALAMAT_PEMILIK')?>
					</p>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="row">
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<p style="margin-bottom: 0;padding-bottom: 0"><b>NO. INVOICE</b> :
						<?=placeValue($docinv,'NOMOR_DOKUMEN')?>
						<b>TGL</b>.<?=isset($docinv->TANGGAL_DOKUMEN) ? date('d-m-Y',strtotime($docinv->TANGGAL_DOKUMEN)) : ''?>
					</p>
					<p style="margin: 0;padding: 0"><b>NO. LC</b> : <?=placeValue($doclc,'NOMOR_DOKUMEN')?>
						<b>TGL</b>.<?=isset($doclc->TANGGAL_DOKUMEN) ? date('d-m-Y',strtotime($doclc->TANGGAL_DOKUMEN)) : ''?>
					</p>
					<p style="margin: 0;padding: 0"><b>NO. BL</b> : <?=placeValue($docbl,'NOMOR_DOKUMEN')?>
						<b>TGL</b>.<?=isset($docbl->TANGGAL_DOKUMEN) ? date('d-m-Y',strtotime($docbl->TANGGAL_DOKUMEN)) : ''?>
					</p>
					<p style="margin: 0;padding: 0"><b>NO. BC 1.1</b> : <?=placeValue($tpbHeader,'NOMOR_BC11')?>
						<b>TGL</b>.<?=isset($tpbHeader->TANGGAL_BC11) ? date('d-m-Y',strtotime($tpbHeader->TANGGAL_BC11)) : ''?>
					</p>
					<p style="margin: 0;padding: 0"><b>DOKUMEN LAINNYA</b></p>
					<?php foreach ($doclain as $row){ ?>
					<p style="margin: 0;padding: 0"><i class="fal fa-angle-double-right"></i> <b>NO. DOKUMEN</b> :
						<?=placeValue($row,'NOMOR_DOKUMEN')?>
						<b>TGL</b>.<?=isset($row->TANGGAL_DOKUMEN) ? date('d-m-Y',strtotime($row->TANGGAL_DOKUMEN)) : ''?>
					</p>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="row">
				<div class="col-sm-12 col-lg-4 col-xl-4">
					<p style="margin-bottom:0;padding-bottom:0;margin-top: 10px;padding-top: 10px"><b>VALUTA</b> :
						<?=placeValue($tpbHeader,'URAIAN_VALUTA')?></p>
					<p style="margin:0;padding:0;"><b>NDPBM</b> : <?=placeValue($tpbHeader,'NDPBM')?></p>
					<p style="margin-top:0;padding-top:0;"><b>ASURANSI</b> : <?=placeValue($tpbHeader,'ASURANSI')?></p>
				</div>
				<div class="col-sm-12 col-lg-4 col-xl-4">
					<p style="margin-bottom:0;padding-bottom:0;margin-top: 10px;padding-top: 10px"><b>CIF</b> :
						<?=placeValue($tpbHeader,'CIF')?></p>
					<p style="margin-top:0;padding-top:0;"><b>CIF RUPIAH</b> : <?=placeValue($tpbHeader,'CIF_RUPIAH')?>
					</p>
				</div>
				<div class="col-sm-12 col-lg-4 col-xl-4">
					<p style="margin-bottom:0;padding-bottom:0;margin-top: 10px;padding-top: 10px"><b>FOB</b> :
						<?=placeValue($tpbHeader,'FOB')?></p>
					<p style="margin-top:0;padding-top:0;"><b>FREIGHT</b> : <?=placeValue($tpbHeader,'FREIGHT')?></p>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="row">
				<div class="col-sm-12 col-lg-4 col-xl-4">
					<p style="margin-bottom:0;padding-bottom:0;margin-top: 10px;padding-top: 10px"><b>CARA ANGKUT</b> :
						<?=placeValue($tpbHeader,'URAIAN_CARA_ANGKUT')?></p>
					<p style="margin:0;padding:0;"><b>NEGARA</b> : <?=placeValue($tpbHeader,'URAIAN_NEGARA')?></p>
					<p style="margin-top:0;padding-top:0;"><b>PEL. MUAT</b> :
						<?=placeValue($tpbHeader,'URAIAN_PELABUHAN_MUAT')?></p>
				</div>
				<div class="col-sm-12 col-lg-4 col-xl-4">
					<p style="margin-bottom:0;padding-bottom:0;margin-top: 10px;padding-top: 10px"><b>SARANA
							PENGANGKUT</b> : <?=placeValue($tpbHeader,'NAMA_PENGANGKUT')?></p>
					<p style="margin:0;padding:0;"><b>VOY / FLIGHT</b> : <?=placeValue($tpbHeader,'NOMOR_VOY_FLIGHT')?>
					</p>
					<p style="margin-top:0;padding-top:0;"><b>PEL. TRANSIT</b> :
						<?=placeValue($tpbHeader,'URAIAN_PELABUHAN_TRANSIT')?></p>
				</div>
				<div class="col-sm-12 col-lg-4 col-xl-4">
					<p style="margin-bottom:0;padding-bottom:0;margin-top: 10px;padding-top: 10px">&nbsp;</p>
					<p style="margin:0;padding:0;">&nbsp;</p>
					<p style="margin-top:0;padding-top:0;"><b>PEL. BONGKAR</b> :
						<?=placeValue($tpbHeader,'URAIAN_PELABUHAN_BONGKAR')?></p>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="row">
				<div class="col-sm-12 col-lg-4 col-xl-4">
					<p style="margin-bottom:0;padding-bottom:0;margin-top: 10px;padding-top: 10px"><b>TOTAL
							DITANGGUHKAN</b> : <?=placeValue($tpbHeader,'TOTAL_TANGGUH')?></p>
				</div>
				<div class="col-sm-12 col-lg-4 col-xl-4">
					<p style="margin-bottom:0;padding-bottom:0;margin-top: 10px;padding-top: 10px"><b>TOTAL
							DIBEBASKAN</b> : <?=placeValue($tpbHeader,'TOTAL_BEBAS')?></p>
				</div>
				<div class="col-sm-12 col-lg-4 col-xl-4">
					<p style="margin-bottom:0;padding-bottom:0;margin-top: 10px;padding-top: 10px"><b>TOTAL TIDAK
							DIPUNGUT</b> : <?=placeValue($tpbHeader,'TOTAL_TIDAK_DIPUNGUT')?></p>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="row">
				<div class="col-sm-12 col-lg-4 col-xl-4">
					<p style="margin-bottom:0;padding-bottom:0;margin-top: 10px;padding-top: 10px"><b>TIPE KONTAINER</b>
						: <?=placeValue($kontainer,'URAIAN_TIPE_KONTAINER')?></p>
				</div>
				<div class="col-sm-12 col-lg-4 col-xl-4">
					<p style="margin-bottom:0;padding-bottom:0;margin-top: 10px;padding-top: 10px"><b>UKURAN
							KONTAINER</b> : <?=placeValue($kontainer,'URAIAN_UKURAN_KONTAINER')?></p>
				</div>
				<div class="col-sm-12 col-lg-4 col-xl-4">
					<p style="margin-bottom:0;padding-bottom:0;margin-top: 10px;padding-top: 10px"><b>NOMOR
							KONTAINER</b> : <?=placeValue($kontainer,'NOMOR_KONTAINER')?></p>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<label><b>Barang</b></label>
				<table class="table table-hover table-bordered table-striped table-sm" id="dt_doc_in_detail" role="grid"
					style="white-space: nowrap;width: 99%">
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
					</tbody>
				</table>
				<table class="table table-hover table-bordered table-striped table-sm dt_po_add" id="table_dokumen"
					role="grid" style="white-space: nowrap; min-width: 600px">
					<thead>
						<tr>
							<th class="text-center">Jenis Pungutuan</th>
							<th class="text-center">Ditangguhkan (Rp)</th>
							<th class="text-center">Dibebaskan</th>
							<th class="text-center">Tidak</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>