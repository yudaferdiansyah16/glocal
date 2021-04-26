<div class="card-body">
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top: 15px; border-width:1px;  ">
			<dl class="row">
				<dt class="col-sm-3">STATUS</dt>
				<dd class="col-sm-3">: <?=placeValue($tpbHeader,'URAIAN_STATUS')?></dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">STATUS PERBAIKAN</dt>
				<dd class="col-sm-3">: <?=placeValue($tpbHeader,'KODE_STATUS_PERBAIKAN')?></dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-3">NOMOR PENGAJUAN</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'NOMOR_AJU')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">NOMOR PENDAFTARAN</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'NOMOR_DAFTAR')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">TANGGAL PENDAFTARAN</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'TANGGAL_DAFTAR')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-3">KANTOR PABEAN</dt>
				<dd class="col-sm-3">
					<input type="text" value="<?=placeValue($tpbHeader,'KODE_KANTOR')?>" class="form-control form-control-sm " readOnly>
				</dd>
				<dt class="col-sm-3">KODE GUDANG PLB</dt>
				<dd class="col-sm-3">
					<input type="text" value="<?=placeValue($tpbHeader,'KODE_JENIS_TPB')?>" class="form-control form-control-sm " readOnly>
				</dd>
				<dt class="col-sm-3">TUJUAN PEMASUKAN</dt>
				<dd class="col-sm-3"><input type="text" value="<?=placeValue($tpbHeader,'URAIAN_JENIS_TPB')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>		
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-9"><u>PENGUSAHA TPB</u></dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">1. NPWP</dt>
				<dd class="col-sm-4">
					<input type="text" value="1 - NPWP 15 DIGIT" class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-5">
					<input type="text" value="<?=placeValue($tpbHeader,'ID_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">2. NAMA</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'NAMA_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">ALAMAT</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'ALAMAT_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">3. IJIN TPB</dt>
				<dd class="col-sm-4">
					<input type="text" value="<?=placeValue($tpbHeader,'NOMOR_IJIN_TPB')?>" class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-5">
					<input type="text" value="<?=placeValue($tpbHeader,'TANGGAL_IJIN_TPB')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">4. API</dt>
				<dd class="col-sm-4">
					<input type="text" value="<?=placeValue($tpbHeader,'KODE_JENIS_API_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-5">
					<input type="text" value="<?=placeValue($tpbHeader,'API_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-9"><u>PENGIRIM BARANG</u></dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">5. </dt>
				<dd class="col-sm-4"><input type="text" value="1 - NPWP 15 DIGIT" class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-4">
					<input type="text" value="<?=placeValue($tpbHeader,'ID_PENGIRIM')?>" class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-1">
					<a href="">CEK N</a>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">6. NAMA</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'NAMA_PENGIRIM')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">7. ALAMAT</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'ALAMAT_PENGIRIM')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-9"><u><a href="#" data-toggle="modal" data-target="#m_dokumen_modal">DOKUMEN [F6]</a></u></dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">8. PACKING LIST</dt>
				<dd class="col-sm-5">
					<input type="text" value="<?=placeValue($dokumen,'KODE_DOKUMEN')?>" class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-4">
					<input type="text" value="<?=placeValue($dokumen,'TANGGAL_DOKUMEN')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">9. SURAT KEPUTUSAN</dt>
				<dd class="col-sm-5">
					<input type="text" value="<?=placeValue($dokumen,'ID_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-4">
					<input type="text" value="<?=placeValue($dokumen,'ID_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">10. DOK. BC 2.6</dt>
				<dd class="col-sm-5">
					<input type="text" value="<?=placeValue($dokumen,'ID_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-4">
					<input type="text" value="<?=placeValue($dokumen,'ID_PENGUSAHA')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-9">DOKUMEN LAINNYA</dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-12">
					<table class="table table-hover table-bordered table-striped table-sm" id="" role="grid" style="white-space: nowrap; min-width: 600px">
						<thead>
							<tr>
								<th class="text-center">JENIS DOKUMEN</th>
								<th class="text-center">NOMOR DOKUMEN</th>
								<th class="text-center">TANGGAL</th>
							</tr>
						</thead>
						<?php
							foreach ($doclain as $row) {
							$tgl = isset($row->TANGGAL_DOKUMEN) ? date('d-m-Y', strtotime($row->TANGGAL_DOKUMEN)) : '';
						?>
						<tbody>
							<tr>
								<td><?php echo $row->URAIAN_DOKUMEN ?></td>
								<td><?php echo $row->NOMOR_DOKUMEN ?></td>
								<td><?php echo $tgl ?></td>
							</tr>
						</tbody>
						<?php } ?>
					</table>
				</dt>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-9"><u>HARGA</u></dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">11. VALUTA</dt>
				<dd class="col-sm-3"></dd>
				<dd class="col-sm-6">
					<input type="text" value="<?=placeValue($tpbHeader,'KODE_VALUTA')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">12. NDPBM</dt>
				<dd class="col-sm-3"><a href="" class="btn btn-sm btn-primary">NDPBM</a></dd>
				<dd class="col-sm-6">
					<input type="text" value="<?=placeValue($tpbHeader,'NDPBM')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">13. NILAI CIF</dt>
				<dd class="col-sm-3"></dd>
				<dd class="col-sm-6">
					<input type="text" value="<?=placeValue($tpbHeader,'CIF')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">NILAI CIF (Rp)</dt>
				<dd class="col-sm-3"></dd>
				<dd class="col-sm-6">
					<input type="text" value="<?=placeValue($tpbHeader,'CIF_RUPIAH')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-9"><u>PENGANGKUTAN</u></dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">14. JENIS SARANA PENGANGKUTAN</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'NAMA_PENGANGKUT')?>" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-11"><u><a href="#" data-toggle="modal" data-target="#m_kontainner_modal">15. KONTAINER [F5]</a></u></dt>
				<dd class="col-sm-1"><input type="text" value="<?=placeValue($tpbHeader,'JUMLAH_KONTAINER')?>" class="form-control form-control-sm "></dd>
				<dt class="col-sm-12">
					<table class="table table-hover table-bordered table-striped table-sm" id="" role="grid" style="white-space: nowrap; min-width: 600px">
						<thead>
							<tr>
								<th class="text-center">NOMOR CONT</th>
								<th class="text-center">UKURAN</th>
								<th class="text-center">TIPE</th>
							</tr>
						</thead>
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
					</table>
				</dt>
			</dl>
			<dl class="row">
				<dt class="col-sm-11"><u><a href="#" data-toggle="modal" data-target="#m_kemasan_modal">16. KEMASAN [F7]</a></u></dt>
				<dd class="col-sm-1"><input type="text" value="<?=placeValue($tpbHeader,'JUMLAH_KEMASAN')?>" class="form-control form-control-sm"></dd>
				<dt class="col-sm-12">
					<table class="table table-hover table-bordered table-striped table-sm" id="" role="grid" style="white-space: nowrap; min-width: 600px">
						<thead>
							<tr>
								<th class="text-center">JUMLAH</th>
								<th class="text-center">KODE JENIS</th>
								<th class="text-center">JENIS</th>
							</tr>
						</thead>
						<?php
							foreach ($kemasan as $row) {
						?>
						<tbody>
							<tr>
								<td><?php echo $row->JUMLAH_KEMASAN?></td>
								<td><?php echo $row->KODE_JENIS_KEMASAN ?></td>
								<td><?php echo $row->URAIAN_KEMASAN ?></td>
							</tr>
						</tbody>
						<?php } ?>
					</table>
				</dt>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-9"><u><a href="#" data-toggle="modal"  id="btn3" data-target="#m_barang_modal">BARANG [F4]</a></u></dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">17. BRUTO (Kg)</dt>
				<dd class="col-sm-1"></dd>
				<dd class="col-sm-8">
					<input type="text" value="<?=placeValue($tpbHeader,'BRUTO')?>" class="form-control form-control-sm " readOnly>
				</dd>
				<dt class="col-sm-3">18. NETTO (Kg)</dt>
				<dd class="col-sm-1"></dd>
				<dd class="col-sm-8">
					<input type="text" value="<?=placeValue($tpbHeader,'NETTO')?>" class="form-control form-control-sm " readOnly>
				</dd>
				<dt class="col-sm-3">JUMLAH BARANG</dt>
				<dd class="col-sm-1">
					<input type="text" value="<?=placeValue($tpbHeader,'JUMLAH_BARANG')?>" class="form-control form-control-sm" readOnly>
				</dd>
				<dd class="col-sm-8"></dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-3">JENIS PUNGUTAN</dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">DITANGGUHKAN (Rp)</dt>
				<dd class="col-sm-3"></dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-6">19. BM</dt>
				<dd class="col-sm-6">
					<input type="text" value="" class="form-control form-control-sm" readOnly>
				</dd>
				<dt class="col-sm-6">20. BMT</dt>
				<dd class="col-sm-6">
					<input type="text" value="" class="form-control form-control-sm" readOnly>
				</dd>
				<dt class="col-sm-6">21. CUKAI</dt>
				<dd class="col-sm-6">
					<input type="text" value="" class="form-control form-control-sm" readOnly>
				</dd>
				<dt class="col-sm-6">22. PPN</dt>
				<dd class="col-sm-6">
					<input type="text" value="" class="form-control form-control-sm" readOnly>
				</dd>
				<dt class="col-sm-6">23. PPnBM</dt>
				<dd class="col-sm-6">
					<input type="text" value="" class="form-control form-control-sm" readOnly>
				</dd>
				<dt class="col-sm-6">24. PPh</dt>
				<dd class="col-sm-6">
					<input type="text" value="" class="form-control form-control-sm" readOnly>
				</dd>
				<dt class="col-sm-6">25. JUMLAH TOTAL</dt>
				<dd class="col-sm-6">
					<input type="text" value="" class="form-control form-control-sm" readOnly>
				</dd>
			</dl>		
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-11"><u><a href="#" data-toggle="modal" data-target="#m_jaminan_modal">26. JAMINAN [F3]</a></u></dt>
				<dd class="col-sm-1"><input type="text" value="<?=placeValue($tpbHeader,'TOTAL_JAMIN')?>" class="form-control form-control-sm "></dd>
				<dt class="col-sm-12">
					<table class="table table-hover table-bordered table-striped table-sm" id="" role="grid" style="white-space: nowrap; min-width: 600px">
						<thead>
							<tr>
								<th class="text-center">JENIS</th>
								<th class="text-center">NOMOR</th>
								<th class="text-center">TANGGAL</th>
								<th class="text-center">NILAI</th>
								<th class="text-center">JATUH TEMPO</th>
								<th class="text-center">PENJAMIN</th>
								<th class="text-center">NOMOR PBJ</th>
							</tr>
						</thead>
						<?php
							foreach ($jaminan as $row) {
							$tgl_jaminan = isset($row->TANGGAL_JAMINAN) ? date('d-m-Y', strtotime($row->TANGGAL_JAMINAN)) : '';
							$tgl_jatuh_tempo = isset($row->TANGGAL_JATUH_TEMPO) ? date('d-m-Y', strtotime($row->TANGGAL_JATUH_TEMPO)) : '';
						?>
						<tbody>
							<tr>
								<td><?php echo $row->URAIAN_JENIS_JAMINAN ?></td>
								<td><?php echo $row->NOMOR_JAMINAN  ?></td>
								<td><?php echo $tgl_jaminan  ?></td>
								<td><?php echo $row->NILAI_JAMINAN  ?></td>
								<td><?php echo $tgl_jatuh_tempo  ?></td>
								<td><?php echo $row->PENJAMIN  ?></td>
								<td><?php echo $row->NOMOR_BPJ  ?></td>
							</tr>
						</tbody>
						<?php } ?>
					</table>
				</dt>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-6 col-xl-6" style="margin-top:15px;">
			<dl class="row">
				<dt class="col-sm-11">Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal yang diberitahukan dalam dokumen pabean ini.</dt>
				<dd class="col-sm-1"></dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-6"><input type="text" value="NGAWI" class="form-control form-control-sm " readOnly></dt>
				<dd class="col-sm-6"><input type="text" value="12-10-2020" class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Pemberitahu</dt>
				<dd class="col-sm-9"><input type="text" value="IRAWAN" class="form-control form-control-sm " readOnly></dd>
				<dt class="col-sm-3">Jabatan</dt>
				<dd class="col-sm-9"><input type="text" value="Manager" class="form-control form-control-sm " readOnly></dd>
			</dl>
		</div>
	</div>
</div>

<div class="modal fade modal-fullscreen" id="m_jaminan_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">JAMINAN</h5>
				<button type="button" class="close" data-dismiss="modal" >&times;</button>
			</div>
			<div class="modal-body">
				<div class="">
					<table class="table table-hover table-bordered table-striped table-sm" id="dt_m_detail_jaminan" role="grid">
						<thead>
							<tr>
								<th class="text-center">JENIS</th>
								<th class="text-center">NOMOR</th>
								<th class="text-center">TANGGAL</th>
								<th class="text-center">JATUH TEMPO</th>
								<th class="text-center">PENJAMIN</th>
								<th class="text-center">NOMOR BPJ</th>
								<th class="text-center">TANGGAL</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="col-sm-12">
					<dl class="row">
						<dt class="col-sm-4">JENIS JAMINAN</dt>
						<dd class="col-sm-5">
							<input type="text" id="uraian" value="" class="form-control form-control-sm ">
						</dd>
						<dd class="col-sm-3"></dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">NOMOR JAMINAN</dt>
						<dd class="col-sm-5">
							<input type="text" id="nomor" value="" class="form-control form-control-sm ">
						</dd>
						<dd class="col-sm-3">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">NILAI JAMINAN</dt>
						<dd class="col-sm-5">
							<input type="text" id="nilai" value="" class="form-control form-control-sm ">
						</dd>
						<dd class="col-sm-3"></dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">TANGGAL JATUH TEMPO</dt>
						<dd class="col-sm-5">
							<input type="text" id="jatuhtempo" value="" class="form-control form-control-sm ">
						</dd>
						<dd class="col-sm-3"></dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">PENJAMIN</dt>
						<dd class="col-sm-5">
							<input type="text" id="penjamin" value="" class="form-control form-control-sm ">
						</dd>
						<dd class="col-sm-3"></dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">NOMOR DAN TANGGAL BUKTI PENERIMAAN JAMINAN</dt>
						<dd class="col-sm-5">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
						<dd class="col-sm-3">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal-fullscreen" id="m_barang_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-content">
				<table class="table table-hover table-bordered table-striped table-sm" id="dt_m_detail_barang" role="grid">
					<div class="modal-header">
						<div class="col-sm-12 col-lg-12 col-xl-12">
							<dl class="row">
								<dt class="col-sm-3"><h5 class="modal-title">Data Barang BC 262</h5></dt>
								<dd class="col-sm-9">
								<div class="dataTables_paginate paging_simple_numbers">
									<ul class="pagination">
										<li class="paginate_button page-item previous" id="prev" ><a href="#"  id="brg_prev"
										aria-controls="dt" data-dt-idx="0" tabindex="0" class="page-link"><i
										class="fal fa-chevron-left"></i></a></li>
						
										<li class="paginate_button page-item next" id="next"><a href="#" id="brg_next"
										aria-controls="dt" data-dt-idx="2" tabindex="0" class="page-link"><i
										class="fal fa-chevron-right"></i></a></li>
									</ul>
								</div>
								</dd>
							</dl>
						</div>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="col-sm-12 col-lg-12 col-xl-12">
							<dl class="row" style="margin-top: 15px;">
								<dt class="col-sm-3">STATUS</dt>
								<dd class="col-sm-9">
									<input type="text" id="status" class="form-control form-control-sm">
								</dd>
							</dl>
						</div>
						<div class="col-sm-12 col-lg-12 col-xl-12">
							<dl class="row" style="margin-top: 15px; border-style: dotted; border-width:1px;">
								<dt class="col-sm-3">BARANG</dt>
								<dd class="col-sm-3">
									<input type="text" id="no_barang" class="form-control form-control-sm">
								</dd>
								<dt class="col-sm-3">DARI</dt>
								<dd class="col-sm-3">
									<input type="text" id="jumlah_barang" name="jumlah_barang" value=""
									class="form-control form-control-sm ">
								</dd>
								<dt class="col-sm-3">KODE BARANG</dt>
								<dd class="col-sm-3">
									<input type="text" id="kode_barang" class="form-control form-control-sm">
								</dd>
								<dt class="col-sm-3">NOMOR H</dt>
								<dd class="col-sm-3">
									<input type="text" value="" class="form-control form-control-sm ">
								</dd>
								<dt class="col-sm-3">SERI IJIN</dt>
								<dd class="col-sm-3">
									<input type="text" id="seri_ijin" class="form-control form-control-sm ">
								</dd>
								<dt class="col-sm-3">KATEGORI BARANG</dt>
								<dd class="col-sm-3">
									<input type="text" id="kategori_barang" class="form-control form-control-sm ">
								</dd>
								<dt class="col-sm-3">URAIAN BARANG</dt>
								<dd class="col-sm-9">
									<input type="text" id="uraian" class="form-control form-control-sm ">
								</dd>
								<dt class="col-sm-3">MERK</dt>
								<dd class="col-sm-3">
									<input type="text" id="merk" class="form-control form-control-sm ">
								</dd>
								<dt class="col-sm-3">TIPE</dt>
								<dd class="col-sm-3">
									<input type="text" id="tipe" class="form-control form-control-sm ">
								</dd>
								<dt class="col-sm-3">UKURAN</dt>
								<dd class="col-sm-3">
									<input type="text" id="ukuran" class="form-control form-control-sm ">
								</dd>
								<dt class="col-sm-3">SPF LAIN</dt>
								<dd class="col-sm-3">
									<input type="text" id="spf" class="form-control form-control-sm ">
								</dd>
							</dl>
						</div>
						<div class="col-sm-12 col-lg-12 col-xl-12">
							<dl class="row" style="margin-top: 15px; border-style: dotted; border-width:1px;">
								<dt class="col-sm-12">HARGA</dt>
								<dt class="col-sm-6">JUMLAH SATUAN</dt>
								<dd class="col-sm-6">
									<input type="text" id="jumlah_satuan" class="form-control form-control-sm ">
								</dd>
								<dt class="col-sm-6">SATUAN</dt>
								<dd class="col-sm-6">
									<input type="text" value="" class="form-control form-control-sm ">
								</dd>
								<dt class="col-sm-6">HARGA SATUAN</dt>
								<dd class="col-sm-6">
									<input type="text" id="harga_satuan" class="form-control form-control-sm ">
								</dd>
								<dt class="col-sm-6">HARGA CIF</dt>
								<dd class="col-sm-6">
									<input type="text" id="cif" class="form-control form-control-sm ">
								</dd>
								<dt class="col-sm-6">CIF Rp</dt>
								<dd class="col-sm-6">
									<input type="text" id="cif_rp" class="form-control form-control-sm ">
								</dd>		
							</dl>
						</div>
						<div class="col-sm-12 col-lg-12 col-xl-12">
							<dl class="row" style="margin-top: 15px; border-style: dotted; border-width:1px;">
								<dt class="col-sm-12">KEMASAN</dt>
								<dt class="col-sm-6">JUMLAH</dt>
								<dd class="col-sm-6">
									<input type="text" id="jumlah_kemasan" class="form-control form-control-sm ">
								</dd>
								<dt class="col-sm-6">JENIS</dt>
								<dd class="col-sm-6">
									<input type="text" value="" class="form-control form-control-sm ">
								</dd>
								<dt class="col-sm-6">NETTO</dt>
								<dd class="col-sm-6">
									<input type="text" id="netto" class="form-control form-control-sm ">
								</dd>
								<dt class="col-sm-6">NEGARA ASAL BARANG</dt>
								<dd class="col-sm-6">
									<input type="text" value="" class="form-control form-control-sm ">
								</dd>
							</dl>
						</div>
					</table>
					<div class="col-sm-12 col-lg-12 col-xl-12">
						<dl class="row" border-style: dotted; border-width:1px;">
							<dt class="col-sm-9">DOKUMEN</dt>
							<dd class="col-sm-3"></dd>
							<dt class="col-sm-12">
								<table class="table table-hover table-bordered table-striped table-sm" id="" role="grid">
									<thead>
										<tr>
											<th class="text-center">JENIS DOKUMEN</th>
											<th class="text-center">NOMOR DOKUMEN</th>
											<th class="text-center">TANGGAL</th>
										</tr>
									</thead>
									<?php
										foreach ($doclain as $row) {
										$tgl = isset($row->TANGGAL_DOKUMEN) ? date('d-m-Y', strtotime($row->TANGGAL_DOKUMEN)) : '';
									?>
									<tbody>
										<tr>
											<td><?php echo $row->URAIAN_DOKUMEN ?></td>
											<td><?php echo $row->NOMOR_DOKUMEN ?></td>
											<td><?php echo $tgl ?></td>
										</tr>
									</tbody>
									<?php } ?>
								</table>
							</dt>
						</dl>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal-fullscreen" id="m_kemasan_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">KEMASAN</h5>
				<button type="button" class="close" data-dismiss="modal" >&times;</button>
			</div>
			<div class="modal-body">
				<div class="">
					<table class="table table-hover table-bordered table-striped table-sm" id="dt_m_detail_kemasan" role="grid">
						<thead>
							<tr>
								<th class="text-center">NO</th>
								<th class="text-center">JUMLAH</th>
								<th class="text-center">KODE</th>
								<th class="text-center">URAIAN</th>
								<th class="text-center">MERK KEMASAN</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="col-sm-12">
					<dl class="row">
						<dt class="col-sm-4">JUMLAH</dt>
						<dd class="col-sm-8">
							<input type="text" id="jumlah" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">JENIS</dt>
						<dd class="col-sm-8">
							<input type="text" id="jenis" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">MERK</dt>
						<dd class="col-sm-8">
							<input type="text" id="merk" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal-fullscreen" id="m_kontainner_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">KONTAINER</h5>
				<button type="button" class="close" data-dismiss="modal" >&times;</button>
			</div>
			<div class="modal-body">
				<div class="">
					<table class="table table-hover table-bordered table-striped table-sm" id="dt_m_detail_kontainer" role="grid">
						<thead>
							<tr>
								<th class="text-center">NO</th>
								<th class="text-center">NOMOR KONTAINER</th>
								<th class="text-center">UKURAN</th>
								<th class="text-center">TIPE</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="col-sm-12">
					<dl class="row">
						<dt class="col-sm-4">NO KONTAINER</dt>
						<dd class="col-sm-4">
							<input type="text" id="nomor" value="" class="form-control form-control-sm ">
						</dd>
						<dd class="col-sm-4">
							<input type="text" id="nomor" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">KETERANGAN</dt>
						<dd class="col-sm-8">
							<input type="text" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">UKURAN</dt>
						<dd class="col-sm-8">
							<input type="text" id="ukuran" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">TIPE</dt>
						<dd class="col-sm-8">
							<input type="text" id="tipe" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal-fullscreen" id="m_dokumen_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">DOKUMEN</h5>
				<button type="button" class="close" data-dismiss="modal" >&times;</button>
			</div>
			<div class="modal-body">
				<div class="">
					<table class="table table-hover table-bordered table-striped table-sm" id="dt_m_detail_dokumen" role="grid">
						<thead>
							<tr>
								<th class="text-center">SERI</th>
								<th class="text-center">KODE DOKUMEN</th>
								<th class="text-center">JENIS DOKUMEN</th>
								<th class="text-center">NOMOR</th>
								<th class="text-center">TANGGAL</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="col-sm-12">
					<dl class="row">
						<dt class="col-sm-4">DOKUMEN</dt>
						<dd class="col-sm-8">
							<input type="text" id="kode_dok" name="kode_dok" class="form-control form-control-sm ">
						</dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">NOMOR</dt>
						<dd class="col-sm-8">
							<input type="text" id="nomor_dok" name="nomor_dok" class="form-control form-control-sm ">
						</dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">TANGGAL</dt>
						<dd class="col-sm-8">
							<input type="text" id="tanggal_dok" name="tanggal_dok" class="form-control form-control-sm ">
						</dd>
					</dl>
				</div>
			</div>
		</div>
	</div>
</div>