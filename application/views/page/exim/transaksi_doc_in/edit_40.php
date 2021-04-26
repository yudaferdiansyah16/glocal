<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Exim</li>
		<li class="breadcrumb-item">Transaksi Doc In</li>
		<li class="breadcrumb-item active">Edit</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Edit Transaksi Doc In
		</h1>
	</div>
	<div class="card-header ">
				<div class="row">
				<div class="col-sm-12 col-md-5">
				<div class="dataTables_paginate paging_simple_numbers" style="" id="dt_paginate">
						<ul class="pagination">
							<li class="paginate_button page-item previous " id="dt_previous"><a href="<?=base_url('exim/transaksi_doc_out/edit/')?><?=placeValue($tpbHeader,'ID')-1?>"
									aria-controls="dt" data-dt-idx="0" tabindex="0" class="page-link"><i
										class="fal fa-chevron-left"></i></a></li>
						
							
						</ul>
					</div>
				</div>
				<div class="col-sm-12 col-md-6" style=" text-align: right;" >
				</div>
				<div class="col-sm-12 col-md-1" style=" padding-left: 40px; text-align: right;" >
				<div class="dataTables_paginate paging_simple_numbers" style=" text-align: right; " id="dt_paginate">
						<ul class="pagination">
							<li class="paginate_button page-item next" id="dt_next"><a
									href="<?=base_url('exim/transaksi_doc_out/edit/')?><?=placeValue($tpbHeader,'ID')+1?>"
									aria-controls="dt" data-dt-idx="3" tabindex="0" class="page-link"><i
										class="fal fa-chevron-right"></i></a></li>
						</ul>
					</div>
				</div>

			
				</div>
				
					
				</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<?php if ($status->FLAG_APPROVAL2 == 1) { ?>
						<button type="button" disabled class="btn btn-primary btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 2
						</button>
					<?php } else if ($status->FLAG_APPROVAL1 == 1) { ?>
						<button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 1
						</button>
						<button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass-start"></i> Waiting for Approve 2
						</button>
					<?php } else if ($status->FLAG_APPROVAL1 == 0) { ?>
						<button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass-start"></i> Waiting for Approve 1
						</button>
					<?php } ?>
				<div class="card-header   ">
				 <center>
				 PEMBERITAHUAN IMPOR BARANG UNTUK DITIMBUN DI TEMPAT PENIMBUNAN BERIKAT
				 </center>
				 </div>
				</div>
				<div class="card-body">
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top: 15px;">
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
					<input type="text" value="<?=placeValue($tpbHeader,'NOMOR_AJU')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">NOMOR PENDAFTARAN</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'NOMOR_DAFTAR')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">TANGGAL PENDAFTARAN</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'TANGGAL_DAFTAR')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-3">KANTOR PABEAN</dt>
				<dd class="col-sm-3">
					<input type="text" value="<?=placeValue($tpbHeader,'KODE_KANTOR')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
				<dt class="col-sm-3">KODE GUDANG PLB</dt>
				<dd class="col-sm-3">
					<input type="text" value="<?=placeValue($tpbHeader,'KODE_GUDANG_ASAL')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
				<dt class="col-sm-3">JENIS TPB</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'URAIAN_JENIS_TPB')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
				<dt class="col-sm-3">TUJUAN PENGIRIMAN</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'KODE_GUDANG_TUJUAN')?>"
						class="form-control form-control-sm " readOnly>
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
					<input type="text" value="<?=placeValue($tpbHeader,'ID_PENGUSAHA')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">2. NAMA</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'NAMA_PENGUSAHA')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">3. ALAMAT</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'ALAMAT_PENGUSAHA')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">4. NO IZIN</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'NOMOR_IJIN_TPB')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-9"><u>PENGIRIM BARANG</u></dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">5. NPWP </dt>
				<dd class="col-sm-4"><input type="text" value="1 - NPWP 15 DIGIT" class="form-control form-control-sm "
						readOnly>
				</dd>
				<dd class="col-sm-4">
					<input type="text" value="<?=placeValue($tpbHeader,'ID_PENGIRIM')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-1">
					<a href="">CEK NPWP</a>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">6. NAMA</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'NAMA_PENGIRIM')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">7. ALAMAT</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'ALAMAT_PENGIRIM')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-9"><u><a href="#" data-toggle="modal" data-target="#m_detail_dokumen_modal">DOKUMEN
							[F6]</a></u></dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">8. PACKING LIST</dt>
				<dd class="col-sm-5">
					<input type="text" value="" class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-4">
					<input type="text" value="" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">9. KONTRAK</dt>
				<dd class="col-sm-5">
					<input type="text" value="" class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-4">
					<input type="text" value="" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">10. FAKTUR PAJAK</dt>
				<dd class="col-sm-5">
					<input type="text" value="" class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-4">
					<input type="text" value="" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-3">11. SKEP</dt>
				<dd class="col-sm-5">
					<input type="text" value="" class="form-control form-control-sm " readOnly>
				</dd>
				<dd class="col-sm-4">
					<input type="text" value="" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-9">12. DOKUMEN LAINNYA</dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-12">
					<table class="table table-hover table-bordered table-striped table-sm" id="m_detail_dok" role="grid"
						style="white-space: nowrap; min-width: 600px">
						<thead>
							<tr>
								<th class="text-center">JENIS DOKUMEN</th>
								<th class="text-center">NOMOR DOKUMEN</th>
								<th class="text-center">TANGGAL</th>
							</tr>
						</thead>
						<tbody>
							<?php
                    $i = 1;
                    foreach ($doclain as $row) {
                        echo '<tr>';
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
				</dt>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-9"><u>PENGANGKUTAN</u></dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">13. JENIS SARANA PENGANGKUTAN</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'NAMA_PENGANGKUT')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
				<dt class="col-sm-3">14. NOMOR POLISI</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'NOMOR_POLISI')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-9"><u>HARGA</u></dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">15. HARGA PENYERAHAN</dt>
				<dd class="col-sm-9">
					<input type="text" value="<?=placeValue($tpbHeader,'HARGA_PENYERAHAN')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-11"><u><a href="#" data-toggle="modal" data-target="#m_detail_kemasan_modal">16.
							KEMASAN
							[F7]</a></u></dt>
				<dd class="col-sm-1"><input type="text" value="<?=placeValue($tpbHeader,'JUMLAH_KEMASAN')?>"
						class="form-control form-control-sm"></dd>
				<dt class="col-sm-12">
					<table class="table table-hover table-bordered table-striped table-sm" id="" role="grid"
						style="white-space: nowrap; min-width: 600px">
						<thead>
							<tr>
								<th class="text-center">JUMLAH</th>
								<th class="text-center">KODE JENIS</th>
								<th class="text-center">JENIS</th>
							</tr>
						</thead>
						<tbody>
							<?php
                    $i = 1;
                    foreach ($kemasan as $row) {
                        echo '<tr>';
                        echo '<td>'.$row->JUMLAH_KEMASAN.'</td>';
                        echo '<td>'.$row->KODE_JENIS_KEMASAN.'</td>';
                       
                        echo '<td>'.$row->URAIAN_KEMASAN.'</td>';
                        echo '</tr>';
                        $i++;
                    }
                    ?>
						</tbody>
					</table>
				</dt>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-12 col-xl-12" style="margin-top:15px; border-style:dotted; border-width:1px;">
			<dl class="row">
				<dt class="col-sm-9"><u><a href="#" data-toggle="modal" id="btn3"
							data-target="#m_barangdt40_modal">BARANG
							[F4]</a></u></dt>
				<dd class="col-sm-3"></dd>
				<dt class="col-sm-3">17. VOLUME (m3)</dt>
				<dd class="col-sm-1"></dd>
				<dd class="col-sm-8">
					<input type="text" value="<?=placeValue($tpbHeader,'VOLUME')?>"
						class="form-control form-control-sm " readOnly>
				</dd>
				<dt class="col-sm-3">18. BERAT KOTOR (Kg)</dt>
				<dd class="col-sm-1"></dd>
				<dd class="col-sm-8">
					<input type="text" value="<?=placeValue($tpbHeader,'BRUTO')?>" class="form-control form-control-sm "
						readOnly>
				</dd>
				<dt class="col-sm-3">19. BERAT BERSIH (Kg)</dt>
				<dd class="col-sm-1"></dd>
				<dd class="col-sm-8">
					<input type="text" value="<?=placeValue($tpbHeader,'NETTO')?>" class="form-control form-control-sm "
						readOnly>
				</dd>
				<dt class="col-sm-3">JUMLAH BARANG</dt>
				<dd class="col-sm-1"></dd>
				<dd class="col-sm-1">
					<input type="text" value="<?=placeValue($tpbHeader,'JUMLAH_BARANG')?>"
						class="form-control form-control-sm" readOnly>
				</dd>
				<dd class="col-sm-8"></dd>
			</dl>
		</div>
		<div class="col-sm-12 col-lg-6 col-xl-6" style="margin-top:15px;">
			<dl class="row">
				<dt class="col-sm-11">Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal yang
					diberitahukan dalam dokumen ini.</dt>
				<dd class="col-sm-1"></dd>
			</dl>
			<dl class="row">
				<dt class="col-sm-6"><input type="text" value="NGAWI" class="form-control form-control-sm " readOnly>
				</dt>
				<dd class="col-sm-6"><input type="text" value="23-10-2020" class="form-control form-control-sm "
						readOnly></dd>
				<dt class="col-sm-3">Pemberitahu</dt>
				<dd class="col-sm-9"><input type="text" value="IRAWAN" class="form-control form-control-sm " readOnly>
				</dd>
				<dt class="col-sm-3">Jabatan</dt>
				<dd class="col-sm-9"><input type="text" value="Manager" class="form-control form-control-sm " readOnly>
				</dd>
			</dl>
		</div>
	</div>


</div>
</div>

<div class="modal fade modal-fullscreen" id="m_barangdt40_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<table class="table table-hover table-bordered table-striped table-sm" id="dt_m_detail_barang" role="grid">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Data Barang BC 40</h5>
					<div class="dataTables_paginate paging_simple_numbers">

						<ul class="pagination">
							<li class="paginate_button page-item previous" id="prev"><a href="#" id="brg_prev"
									aria-controls="dt" data-dt-idx="0" tabindex="0" class="page-link"><i
										class="fal fa-chevron-left"></i></a></li>

							<li class="paginate_button page-item next" id="next"><a href="#" id="brg_next"
									aria-controls="dt" data-dt-idx="2" tabindex="0" class="page-link"><i
										class="fal fa-chevron-right"></i></a></li>
						</ul>
					</div>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="col-sm-12 col-lg-12 col-xl-12">
						<dt class="col-sm-3">STATUS</dt>
						<dd class="col-sm-9">
							<input type="text" id="status" class="form-control form-control-sm ">
						</dd>
					</div>

					<div class="col-sm-12 col-lg-12 col-xl-12">
						<dl class="row"
							style="margin-top: 15px;  padding-top: 15px; border-style: dotted; border-width:1px;">
							<dt class="col-sm-3">Barang</dt>
							<dd class="col-sm-3">
								<input type="text" id="no_barang" class="form-control form-control-sm ">
							</dd>

							<dt class="col-sm-3">Dari</dt>
							<dd class="col-sm-3">
								<input type="text" id="jumlah_barang" name="jumlah_barang" value=""
									class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-3">Kode Barang</dt>
							<dd class="col-sm-3">
								<input type="text" id="kode_barang" name="KODE_BARANG"
									class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-3">Uraian Barang</dt>
							<dd class="col-sm-3">
								<input type="text" id="uraian" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-3">Merk</dt>
							<dd class="col-sm-3">
								<input type="text" id="merk" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-3">Hs</dt>
							<dd class="col-sm-3">
								<input type="text" id="hs" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-3">Tipe</dt>
							<dd class="col-sm-3">
								<input type="text" id="tipe" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-3">Ukuran</dt>
							<dd class="col-sm-3">
								<input type="text" id="ukuran" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-3">Spf Lain</dt>
							<dd class="col-sm-3">
								<input type="text" id="spf_lain" class="form-control form-control-sm ">
							</dd>
						</dl>
					</div>
					<div class="col-sm-12 col-lg-12 col-xl-12">
						<dt class="col-sm-12 ">SATUAN, BERAT, & HARGA</dt>
						<dl class="row"
							style="margin-top: 15px;  padding-top: 15px; border-style: dotted; border-width:1px;">
							<dt class="col-sm-3">Jumlah Satuan</dt>
							<dd class="col-sm-3">
								<input type="text" id="jumlah_satuan" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-3">Jenis Satuan</dt>
							<dd class="col-sm-3">
								<input type="text" id="jenis_satuan" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-3">Netto(Kgm)</dt>
							<dd class="col-sm-3">
								<input type="text" id="netto" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-3">Volume(m3)</dt>
							<dd class="col-sm-3">
								<input type="text" id="volume" class="form-control form-control-sm ">
							</dd>
							<dt class="col-sm-3">Harga Penyerahan Rp</dt>
							<dd class="col-sm-3">
								<input type="text" id="harga_penyerahan" class="form-control form-control-sm ">
							</dd>
							<!-- <dt class="col-sm-3">CIF Rp.</dt>
				<dd class="col-sm-3">
					<input type="text" class="form-control form-control-sm " >
				</dd> -->
						</dl>
					</div>
				</div>
			</div>
		</div>
	</table>
</div>

<div class="modal fade modal-fullscreen" id="m_detail_dokumen_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Document</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="">
					<table class="table table-hover table-bordered table-striped table-sm" id="dt_m_detail_dokumen"
						role="grid">
						<thead>
							<tr>
								<th class="text-center">Seri</th>
								<th class="text-center">Kode Dokumen</th>
								<th class="text-center">Jenis Dokumen</th>
								<th class="text-center">Nomor</th>
								<th class="text-center">Tanggal</th>
							</tr>
						</thead>
						<tbody>


						</tbody>
					</table>
				</div>
				<div class="col-sm-12 col-lg-12 col-xl-12">
					<dt class="col-sm-3">Dokumen</dt>
					<dd class="col-sm-3">
						<input type="text" id="kode_dok" name="kode_dok" class="form-control form-control-sm ">
					</dd>
					<dt class="col-sm-3">Nomor</dt>
					<dd class="col-sm-3">
						<input type="text" id="nomor_dok" name="nomor_dok" class="form-control form-control-sm ">
					</dd>
					<dt class="col-sm-3">Tanggal</dt>
					<dd class="col-sm-3">
						<input type="text" id="tanggal_dok" name="tanggal_dok" class="form-control form-control-sm ">
					</dd>
					</dl>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade modal" id="m_detail_kemasan_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">KEMASAN</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
			
					<table class="table table-hover table-bordered table-striped table-sm" id="dt_m_detail_kemasan"
						role="grid">
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
			
				<div class="col-sm-12">
					<dl class="row">
						<dt class="col-sm-4">Jumlah</dt>
						<dd class="col-sm-4">
							<input type="text" id="jumlah" value="" class="form-control form-control-sm ">
						</dd>
						<dd class="col-sm-4">

						</dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">Jenis</dt>
						<dd class="col-sm-8">
							<input type="text" id="jenis" value="" class="form-control form-control-sm ">
						</dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-4">Merk</dt>
						<dd class="col-sm-8">
							<input type="text" id="merk" value="" class="form-control form-control-sm ">
						</dd>
					</dl>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="card-footer">
					<a href="<?=base_url('exim/transaksi_doc_in/')?>" class="btn btn-sm btn-info"><i class="fal fa fa-times-circle"></i> Back</a>
				</div>
			</div>
		</div>
	</div>
</main>
<script>
    let id_header = <?=$tpbHeader->ID?>;
</script>
