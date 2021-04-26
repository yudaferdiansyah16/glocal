<div class="card-body">
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12"
			style="margin-top: 15px; border-style: dotted;   border-width:1px;  ">
			<dl class="row">
				<dt class="col-sm-3">STATUS</dt>
				<dd class="col-sm-3">: <?=placeValue($tpbHeader,'URAIAN_STATUS')?></dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">STATUS PERBAIKAN</dt>
				<dd class="col-sm-3">: <?=placeValue($tpbHeader,'KODE_STATUS_PERBAIKAN')?></dd>

			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<dl class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
				<dt class="col-sm-3">No Pengajuan</dt>
				<dd class="col-sm-3">
					<input type="text" value="<?=placeValue($tpbHeader,'NOMOR_AJU')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
				<dt class="col-sm-3">No Pendaftaran</dt>
				<dd class="col-sm-3">
					<input type="text" value="<?=placeValue($tpbHeader,'NOMOR_DAFTAR')?>"
						class="form-control form-control-sm " readOnly> </dd>

				<dt class="col-sm-3">Tanggal Pendaftaran</dt>
				<dd class="col-sm-3"><input type="text"
						value="<?=isset($tpbHeader->TANGGAL_DAFTAR) ? date('d-m-Y',strtotime($tpbHeader->TANGGAL_DAFTAR)) : ''?>"
						class="form-control form-control-sm " readOnly>

				</dd>

				<!-- <dt class="col-sm-3">Jenis Dokumen</dt>
				<dd class="col-sm-9">: </dd> -->
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<dl class="row" style="margin-top: 15px;  padding-top: 15px; border-style: dotted; border-width:1px;">
				<dt class="col-sm-3">Kantor Pabean</dt>
				<dd class="col-sm-3">
					<input type="text" value="<?=placeValue($tpbHeader,'KODE_KANTOR')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
				<dt class="col-sm-3">Jenis TPB</dt>
				<dd class="col-sm-3">
					<input type="text" value="<?=placeValue($tpbHeader,'KODE_JENIS_TPB')?>"
						class="form-control form-control-sm " readOnly></dd>
			</dl>
		</div>
		<div class="col-sm-6 col-lg-6 col-xl-6">
			<dl class="row" style="margin-top: 15px; border-style: dotted; border-width:1px;">
				<dt class="col-sm-9">PENGUSAHA TPB</dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">NPWP</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'ID_PENGUSAHA')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Nama Pengusaha</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'NAMA_PENGUSAHA')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Alamat</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'ALAMAT_PENGUSAHA')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">No. Ijin TPB</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'NOMOR_IJIN_TPB')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">API</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'API_PENGUSAHA')?>"
						class="form-control form-control-sm " readOnly></dd>
			</dl>
		</div>
		<div class="col-sm-6 col-lg-6 col-xl-6">
			<dl class="row" style="margin-top: 15px; padding-top: 15px;  border-style: dotted; border-width:1px;">
				<dt class="col-sm-7">PEMILIK BARANG</dt>
				<dd class="col-sm-5"> <a href="" class="btn btn-sm btn-primary waves-effect waves-themed">Copy Data
						Pengusaha </a></dd>
				<dt class="col-sm-3">NPWP</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'ID_PEMILIK')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Nama</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'NAMA_PEMILIK')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Alamat</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'ALAMAT_PEMILIK')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">API</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'API_PEMILIK')?>"
						class="form-control form-control-sm " readOnly></dd>
			</dl>
		</div>
		<div class="col-sm-6 col-lg-6 col-xl-6">
			<dl class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
				<dt class="col-sm-7">PENERIMA BARANG</dt>
				<dd class="col-sm-5"><a href="" class="btn btn-sm btn-primary waves-effect waves-themed">Copy Data
						Pemilik </a></dd>
				<dt class="col-sm-3">NPWP</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'ID_PEMILIK')?>"
						class="form-control form-control-sm " readOnly></dd>

				<dt class="col-sm-3">Nama</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'NAMA_PENERIMA_BARANG')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Alamat</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'ALAMAT_PENERIMA_BARANG')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">NIPER</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'NIPER_PENERIMA')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">API</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'API_PENERIMA')?>"
						class="form-control form-control-sm " readOnly></dd>
			</dl>
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
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'CIF_RUPIAH')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Harga Penyerahan</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'HARGA_PENYERAHAN')?>"
						class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Jenis Sarana Pengangkut</dt>
				<dd class="col-sm-9"><input type="text" value="<?=placeValue($tpbHeader,'NAMA_PENGANGKUT')?>"
						class="form-control form-control-sm " readOnly></dd>
			</dl>
		</div>
	</div>

	<hr>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-xl-12" style="margin-top: 15px; border-style: dotted; border-width:1px;">
			<div class="table-responsive">

				<dl class="row" style="margin-top: 15px;">
					<dt class="col-sm-3"><a href="#" data-toggle="modal" data-target="#m_dokumen_modal">DOKUMEN [F6]</a>
					</dt>
					<dd class="col-sm-9"></dd>
					<dt class="col-sm-3">Invoice</dt>
					<dd class="col-sm-9"><input type="text" value="" class="form-control form-control-sm " readOnly>
					</dd>
					<dt class="col-sm-3">Packing List</dt>
					<dd class="col-sm-9"><input type="text" value="" class="form-control form-control-sm " readOnly>
					</dd>
					<dt class="col-sm-3">Kontrak</dt>
					<dd class="col-sm-9"><input type="text" value="" class="form-control form-control-sm " readOnly>
					</dd>
					<dt class="col-sm-3">Fasilitas Impor</dt>
					<dd class="col-sm-9"><input type="text" value="" class="form-control form-control-sm " readOnly>
					</dd>

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
	</div>
	<hr>
	<div class="col-md-12  col-lg-12 col-xl-12" style="margin-top: 15px; border-style: dotted; border-width:1px;">
		<div class="col-md-12">
			<a href="#" data-toggle="modal" data-target="#m_kontainer_modal">KONTAINER [F5]</a>
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
	<div class="col-sm-6 col-lg-12 col-xl-12">
		<dl class="row" style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
			<dt class="col-sm-3"><a href="" id="btn3" data-toggle="modal" data-target="#m_data_barang_out_modal">BARANG (F4)</a>
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
	<hr>
	<div class="col-md-12  col-lg-12 col-xl-12"
		style="margin-top: 15px; padding-top: 15px;  border-style: dotted; border-width:1px;">
		<div class="col-md-12">
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
						<?php
                    $i = 1;
                    foreach ($kemasan as $row) {
                        echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        echo '<td>'.$row->JUMLAH_KEMASAN.'</td>';
                        echo '<td>'.$row->KODE_JENIS_KEMASAN.'</td>';
                       
                        echo '<td>'.$row->URAIAN_KEMASAN.'</td>';
                        echo '</tr>';
                        $i++;
                    }
                    ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-lg-12 col-xl-12">
		<table class="table table-sm table-bordered" style="table-layout: fixed">
			<tr>
				<td class="text-center"><label class="form-label">JENIS PUNGUTAN</label></td>
				<td class="text-center"><label class="form-label">DITANGGUHKAN</label></td>
				<td class="text-center"><label class="form-label">DIBEBASKAN</label></td>
				<td class="text-center"><label class="form-label">TIDAK DIPUNGUT</label></td>
			</tr>
			<tr>
				<td class="text-center"><label class="form-label">BM</label></td>
				<td>
					<input type="text" class="form-control form-control-sm x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="bm_tangguh"
						<?=placeValue($barangtarif,'NILAI_FASILITAS')?>>
					<input type="hidden" name="tpb_pungutan[0][JENIS_TARIF]" value="BM">
					<input type="hidden" name="tpb_pungutan[0][KODE_FASILITAS]" value="2">
				</td>
				<td>
					<input type="text" class="form-control form-control-sm x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="bm_bebas"
						name="tpb_pungutan[1][NILAI_PUNGUTAN]">
					<input type="hidden" name="tpb_pungutan[1][JENIS_TARIF]" value="BM">
					<input type="hidden" name="tpb_pungutan[1][KODE_FASILITAS]" value="4">
				</td>
				<td>
					<input type="text" class="form-control form-control-sm x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="bm_tidak"
						name="tpb_pungutan[2][NILAI_PUNGUTAN]">
					<input type="hidden" name="tpb_pungutan[2][JENIS_TARIF]" value="BM">
					<input type="hidden" name="tpb_pungutan[2][KODE_FASILITAS]" value="5">
				</td>
			</tr>
			<tr>
				<td class="text-center"><label class="form-label">BMT</label></td>
				<td>
					<input type="text" class="form-control form-control-sm x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="bmt_tangguh"
						name="tpb_pungutan[3][NILAI_PUNGUTAN]">
					<input type="hidden" name="tpb_pungutan[3][JENIS_TARIF]" value="BMT">
					<input type="hidden" name="tpb_pungutan[3][KODE_FASILITAS]" value="2">
				</td>
				<td>
					<input type="text" class="form-control form-control-sm x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="bmt_bebas"
						name="tpb_pungutan[4][NILAI_PUNGUTAN]">
					<input type="hidden" name="tpb_pungutan[4][JENIS_TARIF]" value="BMT">
					<input type="hidden" name="tpb_pungutan[4][KODE_FASILITAS]" value="4">
				</td>
				<td>
					<input type="text" class="form-control form-control-sm x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="bmt_tidak"
						name="tpb_pungutan[5][NILAI_PUNGUTAN]">
					<input type="hidden" name="tpb_pungutan[5][JENIS_TARIF]" value="BMT">
					<input type="hidden" name="tpb_pungutan[5][KODE_FASILITAS]" value="5">
				</td>
			</tr>
			<tr>
				<td class="text-center"><label class="form-label">CUKAI</label></td>
				<td>
					<input type="text" class="form-control form-control-sm x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="cukai_tangguh"
						name="tpb_pungutan[6][NILAI_PUNGUTAN]">
					<input type="hidden" name="tpb_pungutan[6][JENIS_TARIF]" value="CUKAI">
					<input type="hidden" name="tpb_pungutan[6][KODE_FASILITAS]" value="2">
				</td>
				<td>
					<input type="text" class="form-control form-control-sm x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="cukai_bebas"
						name="tpb_pungutan[7][NILAI_PUNGUTAN]">
					<input type="hidden" name="tpb_pungutan[7][JENIS_TARIF]" value="CUKAI">
					<input type="hidden" name="tpb_pungutan[7][KODE_FASILITAS]" value="4">
				</td>
				<td>
					<input type="text" class="form-control form-control-sm x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="cukai_tidak"
						name="tpb_pungutan[8][NILAI_PUNGUTAN]">
					<input type="hidden" name="tpb_pungutan[8][JENIS_TARIF]" value="CUKAI">
					<input type="hidden" name="tpb_pungutan[8][KODE_FASILITAS]" value="5">
				</td>
			</tr>
			<tr>
				<td class="text-center"><label class="form-label">PPN</label></td>
				<td>
					<input type="text" class="form-control form-control-sm x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="ppn_tangguh"
						name="tpb_pungutan[9][NILAI_PUNGUTAN]">
					<input type="hidden" name="tpb_pungutan[9][JENIS_TARIF]" value="PPN">
					<input type="hidden" name="tpb_pungutan[9][KODE_FASILITAS]" value="2">
				</td>
				<td>
					<input type="text" class="form-control form-control-sm x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="ppn_bebas"
						name="tpb_pungutan[10][NILAI_PUNGUTAN]">
					<input type="hidden" name="tpb_pungutan[10][JENIS_TARIF]" value="PPN">
					<input type="hidden" name="tpb_pungutan[10][KODE_FASILITAS]" value="4">
				</td>
				<td>
					<input type="text" class="form-control form-control-sm x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="ppn_tidak"
						name="tpb_pungutan[11][NILAI_PUNGUTAN]">
					<input type="hidden" name="tpb_pungutan[11][JENIS_TARIF]" value="PPN">
					<input type="hidden" name="tpb_pungutan[11][KODE_FASILITAS]" value="5">
				</td>
			</tr>
			<tr>
				<td class="text-center"><label class="form-label">PPNBM</label></td>
				<td>
					<input type="text" class="form-control form-control-sm x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="ppnbm_tangguh"
						name="tpb_pungutan[12][NILAI_PUNGUTAN]">
					<input type="hidden" name="tpb_pungutan[12][JENIS_TARIF]" value="PPNBM">
					<input type="hidden" name="tpb_pungutan[12][KODE_FASILITAS]" value="2">
				</td>
				<td>
					<input type="text" class="form-control form-control-sm x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="ppnbm_bebas"
						name="tpb_pungutan[13][NILAI_PUNGUTAN]">
					<input type="hidden" name="tpb_pungutan[13][JENIS_TARIF]" value="PPNBM">
					<input type="hidden" name="tpb_pungutan[13][KODE_FASILITAS]" value="4">
				</td>
				<td>
					<input type="text" class="form-control form-control-sm x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="ppnbm_tidak"
						name="tpb_pungutan[14][NILAI_PUNGUTAN]">
					<input type="hidden" name="tpb_pungutan[14][JENIS_TARIF]" value="PPNBM">
					<input type="hidden" name="tpb_pungutan[14][KODE_FASILITAS]" value="5">
				</td>
			</tr>
			<tr>
				<td class="text-center"><label class="form-label">PPH</label></td>
				<td>
					<input type="text" class="form-control form-control-sm x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="pph_tangguh"
						name="tpb_pungutan[15][NILAI_PUNGUTAN]">
					<input type="hidden" name="tpb_pungutan[15][JENIS_TARIF]" value="PPH">
					<input type="hidden" name="tpb_pungutan[15][KODE_FASILITAS]" value="2">
				</td>
				<td>
					<input type="text" class="form-control form-control-sm x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="pph_bebas"
						name="tpb_pungutan[16][NILAI_PUNGUTAN]">
					<input type="hidden" name="tpb_pungutan[16][JENIS_TARIF]" value="PPH">
					<input type="hidden" name="tpb_pungutan[16][KODE_FASILITAS]" value="4">
				</td>
				<td>
					<input type="text" class="form-control form-control-sm x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="pph_tidak"
						name="tpb_pungutan[17][NILAI_PUNGUTAN]">
					<input type="hidden" name="tpb_pungutan[17][JENIS_TARIF]" value="PPH">
					<input type="hidden" name="tpb_pungutan[17][KODE_FASILITAS]" value="5">
				</td>
			</tr>
			<tr>
				<td class="text-center"><label class="form-label">TOTAL</label></td>
				<td><input type="text" class="form-control form-control-sm total_tangguh x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="total_tangguh"
						name="tpb_header[TOTAL_TANGGUH]"></td>
				<td><input type="text" class="form-control form-control-sm total_bebas x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="total_bebas"
						name="tpb_header[TOTAL_BEBAS]"></td>
				<td><input type="text" class="form-control form-control-sm total_tidak x-readonly input-mask"
						data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="total_tidak"
						name="tpb_header[TOTAL_TIDAK_DIPUNGUT]"></td>
			</tr>
		</table>
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

	<div class="modal fade  modal-fullscreen" id="m_data_barang_out_modal" tabindex="-1" role="dialog"
		aria-hidden="true">
		<!-- <table class="table table-hover table-bordered table-striped table-sm" id="dt_m_detail_barang" role="grid"> -->
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
											aria-selected="true">Data Detail
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
										<a class="nav-link" id="profile-tab" data-toggle="tab"
											href="#tab_detail_rm_import" role="tab" aria-controls="tab_detail_rm_import"
											aria-selected="false">Detail
											Bahan Baku Impor</a>
									</li>
									<div class="dataTables_paginate paging_simple_numbers">
										<div class="">
											<ul class="pagination">
												<li class="paginate_button page-item previous" id="prev"><a href="#"
														id="brg_prevlokal" aria-controls="dt" data-dt-idx="0" tabindex="0"
														class="page-link"><i class="fal fa-chevron-left"></i></a></li>

												<li class="paginate_button page-item next" id="next"><a href="#"
														id="brg_nextlokal" aria-controls="dt" data-dt-idx="2" tabindex="0"
														class="page-link"><i class="fal fa-chevron-right"></i></a></li>
											</ul>
										</div>
									</div>
									<li class="nav-item">
										<a class="nav-link" id="contact-tab" data-toggle="tab"
											href="#tab_detail_rm_lokal" role="tab" aria-controls="tab_detail_rm_lokal"
											aria-selected="false">Detail
											Bahan Baku Lokal</a>
									</li>
								</ul>
								<div class="tab-content" id="myTabContent">
									<div class="tab-pane fade show active" id="tab_detail_barang" role="tabpanel"
										aria-labelledby="home-tab">
										<div class="row" style="margin-top: 15px;">
											<div id='pagination'></div>
											<div class="col-sm-12 col-lg-12 col-xl-12">
												<dl class="row" style="margin-top: 15px;">
													<dt class="col-sm-3">STATUS</dt>
													<dd class="col-sm-9"><?=placeValue($barang,'URAIAN_STATUS')?></dd>



												</dl>
											</div>
											<div class="col-sm-12 col-lg-12 col-xl-12"
												style="margin-top: 15px; border-style: dotted; border-width:1px;">
												<dl class="row" style="margin-top: 15px;">
													<dt class="col-sm-3">Detail Ke </dt>
													<dd class="col-sm-3"> <input type="text" id="no_barang"
															class="form-control form-control-sm " readOnly> </dd>
													<dt class="col-sm-3">Jumlah Barang </dt>
													<dd class="col-sm-3"> <input type="text" id="jumlah_barang"
															name="jumlah_barang" class="form-control form-control-sm "
															readOnly> </dd>
													<dt class="col-sm-3">Kategori Barang</dt>
													<dd class="col-sm-3"><input type="text" class="form-control form-control-sm " id="kategori_barang"
															readOnly></dd>
													<dt class="col-sm-3">Penggunaan</dt>
													<dd class="col-sm-3"> <input type="text"
															value="<?=placeValue($tpbHeader,'KODE_GUNA')?>"
															class="form-control form-control-sm " readOnly></dd>

													<dt class="col-sm-3">Kondisi Barang</dt>
													<dd class="col-sm-3"> <input type="text"
															value="<?=placeValue($tpbHeader,'KONDISI_BARANG')?>"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Jangka Waktu</dt>
													<dd class="col-sm-3"> <input type="text"
															value="<?=placeValue($tpbHeader,'SERI_BARANG')?>"
															class="form-control form-control-sm " readOnly></dd>


												</dl>
											</div>
											<div class="col-sm-12 col-lg-12 col-xl-12"
												style="margin-top: 15px; border-style: dotted; border-width:1px;">
												<dt class="col-sm-6">DATA BARANG BC 2.5 </dt>
												<dl class="row" style="margin-top: 15px;">

													<dt class="col-sm-2">Kode</dt>
													<dd class="col-sm-2"><input type="text"
													id="kode_barang"
															name="KODE_BARANG"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-2">Nomor HS</dt>
													<dd class="col-sm-2"><input type="text" id="hs"
															class="form-control form-control-sm " readOnly> </dd>
													<dt class="col-sm-2">Negara Asal</dt>
													<dd class="col-sm-2"><input type="text"
															value="<?=placeValue($tpbHeader,'KODE_NEGARA_ASAL')?>"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-2">Uraian Barang</dt>
													<dd class="col-sm-2"> <input type="text"
													id="uraian"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-2">Tipe</dt>
													<dd class="col-sm-2"><input type="text"
														id="tipe"
															class="form-control form-control-sm " readOnly></dd>

													<dt class="col-sm-2">Ukuran</dt>
													<dd class="col-sm-2"><input type="text"
														id="ukuran"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-2">Spf Lain</dt>
													<dd class="col-sm-2"><input type="text" id="spf_lain"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-2">Merk</dt>
													<dd class="col-sm-2"><input type="text" id="merk"
															class="form-control form-control-sm " readOnly> </dd>

												</dl>
											</div>
											<div class="col-sm-12 col-lg-12 col-xl-12">
												<dl class="row" style="margin-top: 15px; padding-top: 5	px;">

													<dt class="col-sm-3">SATUAN DAN HARGA</dt>
													<dd class="col-sm-3"> </dd>
													<dt class="col-sm-3">KODE PERHITUNGAN</dt>
													<dd class="col-sm-3"><input type="text"
															value="<?=placeValue($tpbHeader,'KODE_PERHITUNGAN')?>"
															class="form-control form-control-sm " readOnly></dd>
												</dl>
											</div>
											<div class="col-sm-12 col-lg-12 col-xl-12"
												style="margin-top: 15px; border-style: dotted; border-width:1px;">
												<dl class="row" style="margin-top: 15px;">

													<dt class="col-sm-2">Jumlah Satuan </dt>
													<dd class="col-sm-2"><input type="text"
														id="jumlah"
															class="form-control form-control-sm " readOnly> </dd>

													<dt class="col-sm-2">Jumlah Kemasan</dt>
													<dd class="col-sm-2"><input type="text"
															value="<?=placeValue($tpbHeader,'JUMLAH_KEMASAN')?>"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-2">Nilai CIF</dt>
													<dd class="col-sm-2"><input type="text"
															id="cif"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-2">Jenis Satuan</dt>
													<dd class="col-sm-2"><input type="text"
														id="jenis_satuan"
															class="form-control form-control-sm " readOnly></dd>

													<dt class="col-sm-2">Jenis Kemasan</dt>
													<dd class="col-sm-2"><input type="text"
															value="<?=placeValue($tpbHeader,'KODE_KEMASAN')?>"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-2">CIF Rupiah</dt>
													<dd class="col-sm-2"> <input type="text"
														id="cif_rp"
															class="form-control form-control-sm "
															readOnly><?=placeValue($barang,'')?></dd>
													<dt class="col-sm-2">Netto (Kgm)</dt>
													<dd class="col-sm-2"><input type="text"
															id="netto"
															class="form-control form-control-sm " readOnly></dd>

													<dt class="col-sm-2">Volume (M3)</dt>
													<dd class="col-sm-2"><input type="text"
															id="volume"
															class="form-control form-control-sm " readOnly> </dd>


													<dt class="col-sm-2">Harga Penyerahan Rp</dt>
													<dd class="col-sm-2"><input type="text"
														id="harga_penyerahan	"
															class="form-control form-control-sm " readOnly></dd>


												</dl>
											</div>
										</div>
										<div class="row" style="margin-top: 15px;">
											<div class="col-sm-12 col-lg-12 col-xl-12">
												<dt class="col-sm-4">TARIF & FASILITAS</dt>
												<dd class="col-sm-9"> </dd>

												<dl class="row"
													style="margin-top: 15px; border-style: dotted; border-width:1px;">

													<dt class="col-sm-3">PPN </dt>
													<dd class="col-sm-9"><input type="text"
															value="<?=placeValue($tpbHeader,'JENIS_TARIF')?>"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">PPnBM</dt>
													<dd class="col-sm-9"><input type="text"
															value="<?=placeValue($tpbHeader,'JENIS_TARIF')?>"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">PPh</dt>
													<dd class="col-sm-9"> <input type="text"
															value="<?=placeValue($tpbHeader,'JENIS_TARIF')?>"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Cukai</dt>
													<dd class="col-sm-4"><input type="text"
															value="<?=placeValue($tpbHeader,'JENIS_TARIF')?>"
															class="form-control form-control-sm " readOnly></dd>
													<dd class="col-sm-4"><input type="text"
															value="<?=placeValue($tpbHeader,'JENIS_TARIF')?>"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3"></dt>
													<dd class="col-sm-3"> <input type="text"
															value="<?=placeValue($tpbHeader,'JENIS_TARIF')?>"
															class="form-control form-control-sm " readOnly></dd>
													<dd class="col-sm-3"> <input type="text"
															value="<?=placeValue($tpbHeader,'JENIS_TARIF')?>"
															class="form-control form-control-sm " readOnly></dd>
													<dd class="">%</dd>
													<dd class="col-sm-2"> <input type="text"
															value="<?=placeValue($tpbHeader,'JENIS_TARIF')?>"
															class="form-control form-control-sm " readOnly></dd>

													<dt class="col-sm-3">Jumlah Satuan</dt>

													<dd class="col-sm-3"> <input type="text"
															value="<?=placeValue($tpbHeader,'JENIS_TARIF')?>"
															class="form-control form-control-sm " readOnly></dd>
													<dd class="col-sm-3"> <input type="text"
															value="<?=placeValue($tpbHeader,'JENIS_TARIF')?>"
															class="form-control form-control-sm " readOnly></dd>

													<dd class="col-sm-2"> <input type="text"
															value="<?=placeValue($tpbHeader,'JENIS_TARIF')?>"
															class="form-control form-control-sm " readOnly></dd>
													<dd class="">%</dd>

												</dl>
											</div>

										</div>
										<div class="row"
											style="margin-top: 15px; border-style: dotted; border-width:1px;">
											<div class="col-sm-12 col-lg-12 col-xl-12">
												<b>FASILITAS & SKEMA TARIF</b>
											</div>
											<div class="col-sm-12 col-lg-6 col-xl-6">
												<dl class="row" style="margin-top: 15px;">
													<dt class="col-sm-3">Fasilitas </dt>
													<dd class="col-sm-3"> <input type="text"
															value="<?=placeValue($tpbHeader,'KODE_FASILITAS')?>"
															class="form-control form-control-sm " readOnly> </dd>

												</dl>
											</div>
											<div class="col-sm-12 col-lg-6 col-xl-6">
												<dl class="row" style="margin-top: 15px;">
													<dt class="col-sm-3">Skema Trf </dt>
													<dd class="col-sm-3"> <input type="text"
															value="<?=placeValue($tpbHeader,'TARIF_FASILITAS')?>"
															class="form-control form-control-sm " readOnly> </dd>

												</dl>
											</div>

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
													<dt class="col-sm-6">Jumlah Bahan Baku </dt>
													<dd class="col-sm-3"> <input type="text"
															value="<?=placeValue($tpbHeader,'JUMLAH_BAHAN_BAKU')?>"
															class="form-control form-control-sm " readOnly> </dd>

												</dl>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_detail_rm_import" role="tabpanel"
										aria-labelledby="profile-tab" >
										<div class="row" style="margin-top: 15px;">
											<div class="col-sm-12 col-lg-12 col-xl-12">
												<dl class="row" style="margin-top: 15px;">
													<dt class="col-sm-3">STATUS</dt>
													<dd class="col-sm-9"><?=placeValue($barang,'URAIAN_STATUS')?></dd>



												</dl>
											</div>
											<div class="col-sm-12 col-lg-12 col-xl-12">
												<dl class="row"
													style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
													<dt class="col-sm-2">Detail Ke </dt>
													<dd class="col-sm-2"><input type="text"
															id="no_bar_import"
															class="form-control form-control-sm " readOnly> </dd>
													<dt class="col-sm-2">Bahan Baku ke</dt>
													<dd class="col-sm-2"><input type="text"
															id="jumlah_barang_import"
															class="form-control form-control-sm " readOnly> </dd>
													<dt class="col-sm-2"></dt>
													<dd class="col-sm-2"></dd>
													<dt class="col-sm-2">Dok Asal</dt>
													<dd class="col-sm-2"><input type="text"
															value="<?=placeValue($tpbBb,'KODE_JENIS_DOK_ASAL')?>"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-2">KPPBC Dok</dt>
													<dd class="col-sm-2"><input type="text"
															value="<?=placeValue($tpbBb,'KODE_KANTOR')?>"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-2"></dt>
													<dd class="col-sm-2"></dd>
													<dt class="col-sm-2">No/Tgl Dok</dt>
													<dd class="col-sm-2"><input type="text"
															id="no_dokumen_import"
															class="form-control form-control-sm " readOnly>
													</dd>

													<dt class="col-sm-2">No Aju</dt>
													<dd class="col-sm-2"><input type="text"
														id="nomor_aju_import"
															class="form-control form-control-sm " readOnly>

													</dd>
													<dt class="col-sm-2">Urut Ke</dt>
													<dd class="col-sm-2"><input type="text"
															value="<?=placeValue($tpbBb,'SERI_DOKUMEN_ASAL')?>"
															class="form-control form-control-sm " readOnly>

													</dd>


												</dl>
											</div>
											<div class="col-md-12">
												<b>DATA BAHAN BAKU</b>
											</div>
											<div class="col-sm-12 col-lg-12 col-xl-12"
												style="margin-top: 15px; border-style: dotted; border-width:1px;">
												<dt class="col-sm-6"></dt>
												<dl class="row" style="margin-top: 15px;">

													<dt class="col-sm-2">Kode</dt>
													<dd class="col-sm-2"><input type="text"
														id="kode_barang_import"
															class="form-control form-control-sm " readOnly> </dd>
													<dt class="col-sm-2">Nomor HS</dt>
													<dd class="col-sm-2"><input type="text"
															id="harga_satuan_import"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-2"></dt>
													<dd class="col-sm-2"></dd>
													<dt class="col-sm-2">Uraian Barang</dt>
													<dd class="col-sm-10"><input type="text"
															id="uraian_import"
															class="form-control form-control-sm " readOnly> </dd>
													<dt class="col-sm-2">Tipe</dt>
													<dd class="col-sm-1"><input type="text"
															id="tipe_import"
															class="form-control form-control-sm " readOnly></dd>

													<dt class="col-sm-2">Ukuran</dt>
													<dd class="col-sm-1"><input type="text"
															id="ukuran"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-2">Spf Lain</dt>
													<dd class="col-sm-1"><input type="text"
															id="spf_import"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-2">Merk</dt>
													<dd class="col-sm-1"><input type="text"
															id="merk_import"
															class="form-control form-control-sm " readOnly></dd>


												</dl>
											</div>

											<div class="col-md-12">
												<b>HARGA & SATUAN </b>
											</div>
											<div class="col-sm-12 col-lg-12 col-xl-12">
												<dl class="row"
													style="margin-top: 15px; padding-top: 15px; border-style: dotted; border-width:1px;">
													<div class="col-md-12">
														<b></b>
													</div>
													<dt class="col-sm-2">Harga CIF USD </dt>
													<dd class="col-sm-2"><input type="text"
															id="cif_import"
															class="form-control form-control-sm " readOnly> </dd>
													<dt class="col-sm-2">NDPBM</dt>
													<dd class="col-sm-2"><input type="text"
															value="<?=placeValue($tpbBb,'NDPBM')?>"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-2">CIF Rupiah</dt>
													<dd class="col-sm-2"><input type="text"
															id="cif_rp_import"
															class="form-control form-control-sm " readOnly> </dd>

													<dt class="col-sm-2">Jumlah Satuan</dt>
													<dd class="col-sm-2"><input type="text"
															id="jumlah_satuan_import"
															class="form-control form-control-sm " readOnly> </dd>
													<dt class="col-sm-2">Satuan</dt>
													<dd class="col-sm-2"><input type="text"
															id="jenis_satuan_import"
															class="form-control form-control-sm " readOnly> </dd>
													<dt class="col-sm-2">Netto</dt>
													<dd class="col-sm-2"> <input type="text"
														id="netto_import"
															class="form-control form-control-sm " readOnly> </dd>
												</dl>
											</div>
										</div>
										<div class="col-md-12">
											<b>NILAI BM</b>
										</div>
										<div class="row"
											style="margin-top: 15px; border-style: dotted; border-width:1px;">
											<div class="col-sm-12 col-lg-12 col-xl-12">
												<dt class="col-sm-4"></dt>
												<dd class="col-sm-9"> </dd>
												<dl class="row" style="margin-top: 15px;">

													<dt class="col-sm-3">BM Barang Jadi </dt>
													<dd class="col-sm-9"><input type="text"
															value="<?=placeValue($tpbBb,'NETTO')?>"
															class="form-control form-control-sm " readOnly>
														<?=placeValue($bahantarif,'JENIS_TARIF')?> </dd>
													<dt class="col-sm-3">BM Barang Baku </dt>
													<dd class="col-sm-9"><input type="text"
															value="<?=placeValue($tpbBb,'NETTO')?>"
															class="form-control form-control-sm " readOnly>
														<?=placeValue($bahantarif,'KODE_TARIF')?> </dd>
													<dt class="col-sm-3">PPN </dt>
													<dd class="col-sm-9"> <input type="text"
															value="<?=placeValue($tpbBb,'NETTO')?>"
															class="form-control form-control-sm "
															readOnly><?=placeValue($bahantarif,'JENIS_TARIF')?> </dd>
													<dt class="col-sm-3">PPnBM</dt>
													<dd class="col-sm-9"> <input type="text"
															value="<?=placeValue($tpbBb,'NETTO')?>"
															class="form-control form-control-sm "
															readOnly><?=placeValue($tpbBb,'NETTO')?></dd>
													<dt class="col-sm-3">PPh</dt>
													<dd class="col-sm-9"> <input type="text"
															value="<?=placeValue($tpbBb,'NETTO')?>"
															class="form-control form-control-sm "
															readOnly><?=placeValue($tpbBb,'NETTO')?></dd>
													<dt class="col-sm-3">Cukai</dt>
													<dd class="col-sm-9"><input type="text"
															value="<?=placeValue($tpbBb,'NETTO')?>"
															class="form-control form-control-sm " readOnly>
														<?=placeValue($tpbBb,'NETTO')?></dd>
													<dt class="col-sm-3"></dt>
													<dd class="col-sm-9"> </dd>

													<dt class="col-sm-3">Jumlah Satuan</dt>
													<dd class="col-sm-9"><input type="text"
															value="<?=placeValue($tpbBb,'NETTO')?>"
															class="form-control form-control-sm " readOnly></dd>


												</dl>
											</div>

										</div>


										<div class="col-md-12">
											<b>FASILITAS & SKEMA TARIF</b>
										</div>
										<div class="row"
											style="margin-top: 15px; border-style: dotted; border-width:1px;">
											<div class="col-sm-12 col-lg-6 col-xl-6">
												<dl class="row" style="margin-top: 15px;">
													<dt class="col-sm-3">Fasilitas </dt>
													<dd class="col-sm-9"><input type="text"
															value="<?=placeValue($tpbBb,'UKURAN')?>"
															class="form-control form-control-sm " readOnly> </dd>

												</dl>
											</div>
											<div class="col-sm-12 col-lg-6 col-xl-6">
												<dl class="row" style="margin-top: 15px;">
													<dt class="col-sm-3">Skema Trf </dt>
													<dd class="col-sm-9"> <input type="text"
															value="<?=placeValue($tpbBb,'UKURAN')?>"
															class="form-control form-control-sm " readOnly> </dd>

												</dl>
											</div>

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
													<dd class="col-sm-3"> <input type="text"
															id="no_barlokal" 
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Dari Bahan Baku Ke</dt>
													<dd class="col-sm-3"> <input type="text"
															id="jumlah_baranglokal"
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
													<dd class="col-sm-3"><input type="text"
															id="no_dokumenlokal"
															class="form-control form-control-sm " readOnly>
													</dd>
													<dt class="">/</dt>
													<dd class="col-sm-3">
													<input type="text"  class="form-control form-control-sm " readOnly>
													</dd>

													<dt class="col-sm-3">No Aju</dt>
													<dd class="col-sm-3"><input type="text"
															id="nomor_ajulokal"
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
													<dd class="col-sm-2"> <input type="text"
															id="kode_baranglokal"
															class="form-control form-control-sm " readOnly> </dd>
													<dt class="col-sm-3">Nomor HS</dt>
													<dd class="col-sm-2"> <input type="text"
															id="harga_satuanlokal"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-0"></dt>
													<dd class="col-sm-2"> </dd>
													<dt class="col-sm-3">Uraian Barang</dt>
													<dd class="col-sm-9"> <input type="text"
														id="uraianlokal"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Tipe</dt>
													<dd class="col-sm-2"> <input type="text"
															id="tipelokal"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-1">Ukuran</dt>
													<dd class="col-sm-2"> <input type="text"
															id="ukuranlokal"
															class="form-control form-control-sm " readOnly> </dd>
													<dt class="col-sm-1">Spf Lain</dt>
													<dd class="col-sm-2"> <input type="text"
															id="spflokal"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Merk</dt>
													<dd class="col-sm-2"> <input type="text"
															id="merklokal"
															class="form-control form-control-sm " readOnly> </dd>


												</dl>
											</div>
											<div class="col-md-12">
												<b>HARGA & SATUAN </b>
											</div>
											<div class="col-sm-12 col-lg-12 col-xl-12">
												<dl class="row"
													style="margin-top: 15px; border-style: dotted; border-width:1px;">

													<dt class="col-sm-3">Harga CIF USD </dt>
													<dd class="col-sm-3"><input type="text"
															id="ciflokal"
															class="form-control form-control-sm " readOnly> </dd>
													<dt class="col-sm-3">NDPBM</dt>
													<dd class="col-sm-3"><input type="text"
															value="<?=placeValue($barang,'NDPBM')?>"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">CIF Rupiah</dt>
													<dd class="col-sm-3"><input type="text"
														id="cif_rplokal"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Jumlah Satuan</dt>
													<dd class="col-sm-3"><input type="text"
															value="<?=placeValue($barang,'JUMLAH_SATUAN')?>"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Satuan</dt>
													<dd class="col-sm-3"><input type="text"
													id="jenis_satuanlokal"
															class="form-control form-control-sm " readOnly></dd>
													<dt class="col-sm-3">Netto</dt>
													<dd class="col-sm-3"> <input type="text"
															id="nettolokal"
															class="form-control form-control-sm " readOnly></dd>
												</dl>
											</div>
										</div>
										<div class="col-md-12">
											<b>NILAI PPN</b>
										</div>
										<div class="row"
											style="margin-top: 15px; border-style: dotted; border-width:1px;">
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

										<div class="col-md-12">
											<b>FASILITAS & SKEMA TARIF</b>
										</div>
										<div class="row"
											style="margin-top: 15px; border-style: dotted; border-width:1px;">
											<div class="col-sm-12 col-lg-6 col-xl-6">
												<dl class="row" style="margin-top: 15px;">
													<dt class="col-sm-3">Fasilitas </dt>
													<dd class="col-sm-9"> <input type="text"
															value="<?=placeValue($barang,'NILAI_FASILITAS')?>"
															class="form-control form-control-sm " readOnly> </dd>

												</dl>
											</div>
											<div class="col-sm-12 col-lg-6 col-xl-6">
												<dl class="row" style="margin-top: 15px;">
													<dt class="col-sm-3">Skema Trf </dt>
													<dd class="col-sm-9"> <input type="text"
															value="<?=placeValue($barang,'NILAI_FASILITAS')?>"
															class="form-control form-control-sm " readOnly> </dd>

												</dl>
											</div>

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