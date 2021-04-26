<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Exim</li>
		<li class="breadcrumb-item">Transaksi Doc In</li>
		<li class="breadcrumb-item active">Edit</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Edit <small><?=$tpbheader->NOMOR_AJU?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
                    <form method="post" action="<?= base_url('exim/transaksi_doc_in/store') ?>">
                        <input type="hidden" name="tpb_header[ID]" value="<?=placeValue($tpbheader,'ID')?>">
                        <dl class="row">
                            <dt class="col-sm-12 col-lg-3">NOMOR AJU</dt>
                            <dd class="col-sm-12 col-lg-3"><?=placeValue($tpbheader,'NOMOR_AJU')?></dd>
							<dt class="col-sm-12 col-lg-3">DOKUMEN</dt>
                            <dd class="col-sm-12 col-lg-3"><?=placeValue($tpbheader,'URAIAN_DOKUMEN_PABEAN')?></dd>
                            <dt class="col-sm-12 col-lg-3">TANGGAL</dt>
                            <dd class="col-sm-12 col-lg-3"><?=placeValue($tpbheader,'TANGGAL_AJU')?></dd>
                            <dt class="col-sm-12 col-lg-3">SUPPLIER</dt>
                            <dd class="col-sm-12 col-lg-3"><?=placeValue($tpbheader,'NAMA_PEMASOK')?></dd>
                        </dl>
						<div class="form-group row">
							<div class="col-sm-12 col-lg-12 col-xl-12">
								<div class="row">
									<div class="col-sm-12 col-lg-3 col-xl-3">
										<label class="form-label">
											Jenis TPB
										</label>
										<select class="form-control form-control-sm select2" name="tpb_header[KODE_JENIS_TPB]">
											<option value="" disabled selected>Select Data . . .</option>
											<?= createOption($sjenis_tpb, 'KODE_JENIS_TPB', array('URAIAN_JENIS_TPB'), ' - ',$tpbheader->KODE_JENIS_TPB) ?>
										</select>
									</div>
									<div class="col-sm-12 col-lg-3 col-xl-3">
										<label class="form-label">
											Tujuan TPB
										</label>
										<select class="form-control form-control-sm select2" id="tujuan_tpb" name="tpb_header[KODE_TUJUAN_TPB]">
											<option value="" disabled selected>Select Data . . .</option>
											<?=createOption($stujuan_tpb,'KODE_TUJUAN_TPB',array('URAIAN_TUJUAN_TPB'),'-',$tpbheader->KODE_TUJUAN_TPB)?>
										</select>
                                    </div>
                                    <div class="col-sm-12 col-lg-3 col-xl-3">
										<label class="form-label">NETTO</label>
										<input type="text" name="tpb_header[NETTO]" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" value="<?=placeValue($tpbheader,'NETTO')?>">
									</div>
									<div class="col-sm-12 col-lg-3 col-xl-3">
										<label class="form-label">Bruto</label>
										<input type="text" name="tpb_header[BRUTO]" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" value="<?=placeValue($tpbheader,'BRUTO')?>">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
                            <div class="col-sm-12 col-lg-6 col-xl-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Nomor LC</label>
                                        <input type="text" class="form-control form-control-sm" name="dokumenlc[NOMOR_DOKUMEN]" value="<?=placeValue($doclc,'NOMOR_DOKUMEN')?>"/>
                                        <input type="hidden" name="dokumenlc[KODE_JENIS_DOKUMEN]" value="465"/>
                                        <input type="hidden" name="dokumenlc[TIPE_DOKUMEN]" value="02"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Date</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="dokumenlc[TANGGAL_DOKUMEN]" value="<?=date('d-m-Y',strtotime($doclc->TANGGAL_DOKUMEN))?>">
                                            <div class="input-group-append">
												<span class="input-group-text fs-xl">
													<i class="fa fal fa-calendar"></i>
												</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nomor B/L</label>
                                        <input type="text" class="form-control form-control-sm" name="dokumenbl[NOMOR_DOKUMEN]" value="<?=placeValue($docbl,'NOMOR_DOKUMEN')?>"/>
                                        <input type="hidden" name="dokumenbl[KODE_JENIS_DOKUMEN]" value="705"/>
                                        <input type="hidden" name="dokumenbl[TIPE_DOKUMEN]" value="02"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Date</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="dokumenbl[TANGGAL_DOKUMEN]" value="<?=date('d-m-Y',strtotime($docbl->TANGGAL_DOKUMEN))?>">
                                            <div class="input-group-append">
												<span class="input-group-text fs-xl">
													<i class="fa fal fa-calendar"></i>
												</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nomor BC 1.1</label>
                                        <input type="text" class="form-control form-control-sm" name="tpb_header[NOMOR_BC11]" value="<?=placeValue($tpbheader,'NOMOR_BC11')?>"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Date</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="tpb_header[TANGGAL_BC11]" value="<?=date('d-m-Y',strtotime($tpbheader->TANGGAL_BC11))?>">
                                            <div class="input-group-append">
												<span class="input-group-text fs-xl">
													<i class="fa fal fa-calendar"></i>
												</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">POS BC 1.1</label>
                                        <input type="text" class="form-control form-control-sm" name="tpb_header[POS_BC11]" value="<?=placeValue($tpbheader,'POS_BC11')?>"/>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">SUB POS BC 1.1</label>
                                        <input type="text" class="form-control form-control-sm" name="tpb_header[SUBPOS_BC11]" value="<?=placeValue($tpbheader,'SUBPOS_BC11')?>"/>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">SUB SUB POS BC 1.1</label>
                                        <input type="text" class="form-control form-control-sm" name="tpb_header[SUBSUBPOS_BC11]" value="<?=placeValue($tpbheader,'SUBSUBPOS_BC11')?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6 col-xl-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">NDPBM</label>
                                        <input type="text" class="form-control form-control-sm input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''" name="tpb_header[NDPBM]" value="<?=placeValue($tpbheader,'NDPBM')?>"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Valuta</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm x-readonly nama_valuta" readonly  value="<?=placeValue($tpbheader,'KODE_VALUTA')?>"/>
                                            <input type="hidden" class="form-control form-control-sm id_valuta" name="tpb_header[KODE_VALUTA]"  value="<?=placeValue($tpbheader,'KODE_VALUTA')?>"/>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_valuta_modal"><i class="fal fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">FOB</label>
                                        <input type="text" class="form-control form-control-sm input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''" name="tpb_header[FOB]" value="<?=placeValue($tpbheader,'FOB')?>"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Freight</label>
                                        <input type="text" class="form-control form-control-sm input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''" name="tpb_header[FREIGHT]" value="<?=placeValue($tpbheader,'FREIGHT')?>"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Asuransi</label>
                                        <input type="text" class="form-control form-control-sm input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''" name="tpb_header[ASURANSI]"  value="<?=placeValue($tpbheader,'ASURANSI')?>"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nilai CIF</label>
                                        <input type="text" class="form-control form-control-sm input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''" name="tpb_header[CIF]"  value="<?=placeValue($tpbheader,'CIF')?>"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nilai CIF Rupiah</label>
                                        <input type="text" class="form-control form-control-sm input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''" name="tpb_header[CIF_RUPIAH]"  value="<?=placeValue($tpbheader,'CIF_RUPIAH')?>"/>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-lg-6 col-xl-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            Cara Pengangkutan
                                        </label>
                                        <select class="form-control form-control-sm select2" name="tpb_header[KODE_CARA_ANGKUT]">
                                            <option value="" disabled selected>Select Data . . .</option>
                                            <?= createOption($scara_angkut, 'KODE_CARA_ANGKUT', array('URAIAN_CARA_ANGKUT'), ' - ',$tpbheader->KODE_CARA_ANGKUT) ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Sarana Pengangkutan</label>
                                        <input type="text" class="form-control form-control-sm" name="tpb_header[NAMA_PENGANGKUT]" value="<?=placeValue($tpbheader,'NAMA_PENGANGKUT')?>"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">VOY / Flight</label>
                                        <input type="text" class="form-control form-control-sm" name="tpb_header[NOMOR_VOY_FLIGHT]" value="<?=placeValue($tpbheader,'NOMOR_VOY_FLIGHT')?>"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Negara</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm x-readonly nama_negara" readonly value="<?=placeValue($tpbheader,'KODE_NEGARA_PEMASOK')?>"/>
                                            <input type="hidden" class="form-control form-control-sm kode_negara" name="tpb_header[KODE_NEGARA_PEMASOK]" value="<?=placeValue($tpbheader,'KODE_NEGARA_PEMASOK')?>"/>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_negara_modal"><i class="fal fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Pelabuhan Muat</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm x-readonly nama_pelabuhan_muat" readonly value="<?=placeValue($tpbheader,'KODE_PEL_MUAT')?>"/>
                                            <input type="hidden" class="form-control form-control-sm kode_pelabuhan_muat" name="tpb_header[KODE_PEL_MUAT]" value="<?=placeValue($tpbheader,'KODE_PEL_MUAT')?>"/>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_pelabuhan_muat_modal"><i class="fal fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Pelabuhan Transit</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm x-readonly nama_pelabuhan_transit" readonly value="<?=placeValue($tpbheader,'KODE_PEL_TRANSIT')?>"/>
                                            <input type="hidden" class="form-control form-control-sm kode_pelabuhan_transit" name="tpb_header[KODE_PEL_TRANSIT]" value="<?=placeValue($tpbheader,'KODE_PEL_TRANSIT')?>"/>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_pelabuhan_transit_modal"><i class="fal fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Pelabuhan Bongkar</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm x-readonly nama_pelabuhan_bongkar" readonly value="<?=placeValue($tpbheader,'KODE_PEL_BONGKAR')?>"/>
                                            <input type="hidden" class="form-control form-control-sm kode_pelabuhan_bongkar" name="tpb_header[KODE_PEL_BONGKAR]" value="<?=placeValue($tpbheader,'KODE_PEL_BONGKAR')?>"/>
                                            <input type="hidden" class="form-control form-control-sm kode_kantor_bongkar" name="tpb_header[KODE_KANTOR_BONGKAR]" value="<?=placeValue($tpbheader,'KODE_KANTOR_BONGKAR')?>"/>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#referensi_pelabuhan_bongkar_modal"><i class="fal fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Nomor Kontainer</label>
                                        <input type="text" class="form-control form-control-sm" name="tpb_kontainer[NOMOR_KONTAINER]" value="<?=placeValue($tpbkontainer,'NOMOR_KONTAINER')?>"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tipe Kontainer</label>
                                        <select class="form-control form-control-sm select2" name="tpb_kontainer[KODE_TIPE_KONTAINER]">
                                            <option value="" disabled selected>Select Data . . .</option>
                                            <?= createOption($stipe_kontainer, 'KODE_TIPE_KONTAINER', array('URAIAN_TIPE_KONTAINER'), ' - ', $tpbkontainer->KODE_TIPE_KONTAINER) ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Ukuran Kontainer</label>
                                        <select class="form-control form-control-sm select2" name="tpb_kontainer[KODE_UKURAN_KONTAINER]">
                                            <option value="" disabled selected>Select Data . . .</option>
                                            <?= createOption($sukuran_kontainer, 'KODE_UKURAN_KONTAINER', array('URAIAN_UKURAN_KONTAINER'), ' - ', $tpbkontainer->KODE_UKURAN_KONTAINER) ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6 col-xl-6">
                                <table class="table table-sm table-bordered" style="table-layout: fixed">
                                    <tr>
                                        <td class="text-center"><label class="form-label">JENIS PUNGUTAN</label></td>
                                        <td class="text-center"><label class="form-label">DITANGGUHKAN</label></td>
                                        <td class="text-center"><label class="form-label">DIBEBASKAN</label></td>
                                        <td class="text-center"	><label class="form-label">TIDAK DIPUNGUT</label></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><label class="form-label">BM</label></td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="bm_tangguh" name="tpb_pungutan[0][NILAI_PUNGUTAN]">
                                            <input type="hidden" name="tpb_pungutan[0][JENIS_TARIF]" value="BM">
                                            <input type="hidden" name="tpb_pungutan[0][KODE_FASILITAS]" value="2">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="bm_bebas" name="tpb_pungutan[1][NILAI_PUNGUTAN]">
                                            <input type="hidden" name="tpb_pungutan[1][JENIS_TARIF]" value="BM">
                                            <input type="hidden" name="tpb_pungutan[1][KODE_FASILITAS]" value="4">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="bm_tidak" name="tpb_pungutan[2][NILAI_PUNGUTAN]">
                                            <input type="hidden" name="tpb_pungutan[2][JENIS_TARIF]" value="BM">
                                            <input type="hidden" name="tpb_pungutan[2][KODE_FASILITAS]" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><label class="form-label">BMT</label></td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="bmt_tangguh" name="tpb_pungutan[3][NILAI_PUNGUTAN]">
                                            <input type="hidden" name="tpb_pungutan[3][JENIS_TARIF]" value="BMT">
                                            <input type="hidden" name="tpb_pungutan[3][KODE_FASILITAS]" value="2">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="bmt_bebas" name="tpb_pungutan[4][NILAI_PUNGUTAN]">
                                            <input type="hidden" name="tpb_pungutan[4][JENIS_TARIF]" value="BMT">
                                            <input type="hidden" name="tpb_pungutan[4][KODE_FASILITAS]" value="4">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="bmt_tidak" name="tpb_pungutan[5][NILAI_PUNGUTAN]">
                                            <input type="hidden" name="tpb_pungutan[5][JENIS_TARIF]" value="BMT">
                                            <input type="hidden" name="tpb_pungutan[5][KODE_FASILITAS]" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><label class="form-label">CUKAI</label></td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="cukai_tangguh" name="tpb_pungutan[6][NILAI_PUNGUTAN]">
                                            <input type="hidden" name="tpb_pungutan[6][JENIS_TARIF]" value="CUKAI">
                                            <input type="hidden" name="tpb_pungutan[6][KODE_FASILITAS]" value="2">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="cukai_bebas" name="tpb_pungutan[7][NILAI_PUNGUTAN]">
                                            <input type="hidden" name="tpb_pungutan[7][JENIS_TARIF]" value="CUKAI">
                                            <input type="hidden" name="tpb_pungutan[7][KODE_FASILITAS]" value="4">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="cukai_tidak" name="tpb_pungutan[8][NILAI_PUNGUTAN]">
                                            <input type="hidden" name="tpb_pungutan[8][JENIS_TARIF]" value="CUKAI">
                                            <input type="hidden" name="tpb_pungutan[8][KODE_FASILITAS]" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><label class="form-label">PPN</label></td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="ppn_tangguh" name="tpb_pungutan[9][NILAI_PUNGUTAN]">
                                            <input type="hidden" name="tpb_pungutan[9][JENIS_TARIF]" value="PPN">
                                            <input type="hidden" name="tpb_pungutan[9][KODE_FASILITAS]" value="2">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="ppn_bebas" name="tpb_pungutan[10][NILAI_PUNGUTAN]">
                                            <input type="hidden" name="tpb_pungutan[10][JENIS_TARIF]" value="PPN">
                                            <input type="hidden" name="tpb_pungutan[10][KODE_FASILITAS]" value="4">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="ppn_tidak" name="tpb_pungutan[11][NILAI_PUNGUTAN]">
                                            <input type="hidden" name="tpb_pungutan[11][JENIS_TARIF]" value="PPN">
                                            <input type="hidden" name="tpb_pungutan[11][KODE_FASILITAS]" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><label class="form-label">PPNBM</label></td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="ppnbm_tangguh" name="tpb_pungutan[12][NILAI_PUNGUTAN]">
                                            <input type="hidden" name="tpb_pungutan[12][JENIS_TARIF]" value="PPNBM">
                                            <input type="hidden" name="tpb_pungutan[12][KODE_FASILITAS]" value="2">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="ppnbm_bebas" name="tpb_pungutan[13][NILAI_PUNGUTAN]">
                                            <input type="hidden" name="tpb_pungutan[13][JENIS_TARIF]" value="PPNBM">
                                            <input type="hidden" name="tpb_pungutan[13][KODE_FASILITAS]" value="4">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="ppnbm_tidak" name="tpb_pungutan[14][NILAI_PUNGUTAN]">
                                            <input type="hidden" name="tpb_pungutan[14][JENIS_TARIF]" value="PPNBM">
                                            <input type="hidden" name="tpb_pungutan[14][KODE_FASILITAS]" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><label class="form-label">PPH</label></td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="pph_tangguh" name="tpb_pungutan[15][NILAI_PUNGUTAN]">
                                            <input type="hidden" name="tpb_pungutan[15][JENIS_TARIF]" value="PPH">
                                            <input type="hidden" name="tpb_pungutan[15][KODE_FASILITAS]" value="2">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="pph_bebas" name="tpb_pungutan[16][NILAI_PUNGUTAN]">
                                            <input type="hidden" name="tpb_pungutan[16][JENIS_TARIF]" value="PPH">
                                            <input type="hidden" name="tpb_pungutan[16][KODE_FASILITAS]" value="4">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''"  readonly id="pph_tidak" name="tpb_pungutan[17][NILAI_PUNGUTAN]">
                                            <input type="hidden" name="tpb_pungutan[17][JENIS_TARIF]" value="PPH">
                                            <input type="hidden" name="tpb_pungutan[17][KODE_FASILITAS]" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><label class="form-label">TOTAL</label></td>
                                        <td><input type="text" class="form-control form-control-sm total_tangguh x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="total_tangguh" name="tpb_header[TOTAL_TANGGUH]"></td>
                                        <td><input type="text" class="form-control form-control-sm total_bebas x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="total_bebas" name="tpb_header[TOTAL_BEBAS]"></td>
                                        <td><input type="text" class="form-control form-control-sm total_tidak x-readonly input-mask"  data-inputmask="'alias': 'currency', 'prefix': ''" readonly id="total_tidak" name="tpb_header[TOTAL_TIDAK_DIPUNGUT]"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
						<div class="form-group row">
							<div class="col-md-12">
								<label><b>Kemasan</b></label>
								<div class="table-responsive">
									<table class="table table-hover table-bordered table-striped table-sm dt_inv_add" id="table_kemasan" style="white-space: nowrap; min-width: 600px">
										<thead>
										<tr>
											<th class="text-center" width="5px">
												<button type="button" class="btn btn-xs btn-success btn-add-kemasan"><i class="fal fa-plus-circle"></i></button>
											</th>
											<th class="text-center">No</th>
											<th class="text-center">Jenis Kemasan</th>
											<th class="text-center">Jumlah Kemasan</th>
										</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<label><b>Barang</b></label>
								<div class="table-responsive">
									<table class="table table-hover table-bordered table-striped table-sm dt_po_add" id="dt_doc_in_add" style="white-space: nowrap;">
										<thead>
										<tr>
											<th class="text-center">No</th>
											<th class="text-center">PO</th>
											<th class="text-center">Surat Jalan</th>
											<th class="text-center">Job</th>
											<th class="text-center">Barang</th>
											<th class="text-center">Quantity</th>
											<th class="text-center">Harga Satuan</th>
											<th class="text-center">Harga Total</th>
											<th class="text-center">CIF Rupiah</th>
											<th class="text-center">Netto</th>
											<th class="text-center">Asuransi</th>
											<th class="text-center">Diskon</th>
											<th class="text-center">Jumlah Kemasan</th>
											<th class="text-center">Tipe Kemasan</th>
											<th class="text-center">Skema Tarif</th>
											<th class="text-center">Tarif</th>
										</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<label><b>Dokumen Tambahan</b></label>
								<div class="table-responsive">
									<table class="table table-hover table-bordered table-striped table-sm dt_po_add" id="table_dokumen" role="grid" style="white-space: nowrap; min-width: 600px">
										<thead>
										<tr>
											<th class="text-center" width="5px">
												<button type="button" class="btn btn-xs btn-success btn-add-dokumen"><i class="fal fa-plus-circle"></i></button>
											</th>
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
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Save</button>
							<a href="<?=base_url('exim/transaksi_doc_in')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Cancel</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
<table class="x-hidden" id="table-template">
	<tbody>
	<tr data-index="x">
		<td class="text-center"></td>
		<td>
			<p class="text_kode_po" style="margin: 0;padding: 0"></p>
			<small class="text_tanggal_po" style="margin: 0;padding: 0"></small>
			<input type="hidden" class="kode_po"name="tpb_barang[x][dokumen_po][NOMOR_DOKUMEN]"/>
			<input type="hidden" class="tanggal_po" name="tpb_barang[x][dokumen_po][TANGGAL_DOKUMEN]"/>
			<input type="hidden" name="tpb_barang[x][dokumen_po][KODE_JENIS_DOKUMEN]" value="999"/>
			<input type="hidden" name="tpb_barang[x][dokumen_po][TIPE_DOKUMEN]" value="02"/>
		</td>
		<td>
			<p class="text_no_sj" style="margin: 0;padding: 0"></p>
			<small class="text_tanggal_dn" style="margin: 0;padding: 0"></small>
			<input type="hidden" class="no_sj" name="tpb_barang[x][dokumen_dn][NOMOR_DOKUMEN]"/>
			<input type="hidden" class="tanggal_dn" name="tpb_barang[x][dokumen_dn][TANGGAL_DOKUMEN]"/>
			<input type="hidden" name="tpb_barang[x][dokumen_dn][KODE_JENIS_DOKUMEN]" value="640"/>
			<input type="hidden" name="tpb_barang[x][dokumen_dn][TIPE_DOKUMEN]" value="02"/>
		</td>
		<td>
			<p class="text_no_job" style="margin: 0;padding: 0"></p>
		</td>
		<td>
			<p class="text_nama_barang" style="margin: 0;padding: 0"></p>
			<small class="text_kode_barang" style="margin: 0;padding: 0"></small>
			<input type="hidden" class="kode_barang" name="tpb_barang[x][KODE_BARANG]"/>
			<input type="hidden" class="nama_barang" name="tpb_barang[x][URAIAN]"/>
			<input type="hidden" class="seri_barang" name="tpb_barang[x][SERI_BARANG]"/>
			<input type="hidden" class="id_detail_dn" name="tpb_barang[x][id_detail_dn]"/>
		</td>
		<td class="text-right">
			<p class="text_jumlah_satuan" style="margin: 0;padding: 0"></p>
			<small class="text_kode_satuan" style="margin: 0;padding: 0"></small>
			<input type="hidden" class="jumlah_satuan" name="tpb_barang[x][JUMLAH_SATUAN]"/>
			<input type="hidden" class="kode_satuan" name="tpb_barang[x][KODE_SATUAN]"/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm harga_satuan x-readonly input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" readonly size="2000"/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm harga_invoice x-readonly input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" readonly name="tpb_barang[x][HARGA_INVOICE]" id="tpb_barang[x][HARGA_INVOICE]" size="2000"/>
			<input type="hidden" class="fob_barang" name="tpb_barang[x][FOB]"/>
			<input type="hidden" class="cif_barang" name="tpb_barang[x][CIF]"/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm input-mask cif_rupiah_barang" name="tpb_barang[x][CIF_RUPIAH]" id="tpb_barang[x][CIF_RUPIAH]" data-inputmask="'alias': 'currency', 'prefix': ''" size="2000"/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''"  name="tpb_barang[x][NETTO]" size="1000"/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''"  name="tpb_barang[x][ASURANSI]" size="1000"/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''"  name="tpb_barang[x][DISKON]" size="1000"/>
		</td>
		<td>
			<input type="text" name="tpb_barang[x][JUMLAH_KEMASAN]" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" size="1000">
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" class="form-control form-control-sm x-readonly" id="uraian_kemasan_barang[x]" readonly size="1000"/>
				<input type="hidden" id="kode_jenis_kemasan[x]" name="tpb_barang[x][KODE_KEMASAN]"/>
				<div class="input-group-append">
					<button type="button" class="btn btn-default" onclick="setKemasanIndex('[x]')" data-toggle="modal" data-target="#referensi_kemasan_docin_modal"><i class="fal fa-search"></i></button>
				</div>
			</div>
		</td>
		<td>
			<select class="form-control form-control-sm mselect2" name="tpb_barang[x][KODE_SKEMA_TARIF]">
				<option value="" disabled selected>Select Data . . .</option>
				<?= createOption($sskema_tarif, 'KODE_SKEMA', array('URAIAN_SKEMA'), ' - ') ?>
			</select>
		</td>
		<td>
			<div class="input-group input-group-sm">
				<div class="input-group-append">
					<button type="button" class="btn btn-default" onclick="setModalIndex('[x]')"><i class="fal fa-search"></i></button>
				</div>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BM_DITANGGUHKAN][TARIF]" id="tpb_barang[x][TARIF][BM_DITANGGUHKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BM_DITANGGUHKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][BM_DITANGGUHKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][BM_DITANGGUHKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][BM_DITANGGUHKAN][JENIS_TARIF]" value="BM"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BM_DITANGGUHKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][BM_DITANGGUHKAN][KODE_FASILITAS]" value="2"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BM_DITANGGUHKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][BM_DITANGGUHKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BM_DIBEBASKAN][TARIF]" id="tpb_barang[x][TARIF][BM_DIBEBASKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BM_DIBEBASKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][BM_DIBEBASKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][BM_DIBEBASKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][BM_DIBEBASKAN][JENIS_TARIF]" value="BM"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BM_DIBEBASKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][BM_DIBEBASKAN][KODE_FASILITAS]" value="4"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BM_DIBEBASKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][BM_DIBEBASKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BM_TIDAK_DIPUNGUT][TARIF]" id="tpb_barang[x][TARIF][BM_TIDAK_DIPUNGUT][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BM_TIDAK_DIPUNGUT][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][BM_TIDAK_DIPUNGUT][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][BM_TIDAK_DIPUNGUT][JENIS_TARIF]" id="tpb_barang[x][TARIF][BM_TIDAK_DIPUNGUT][JENIS_TARIF]" value="BM"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BM_TIDAK_DIPUNGUT][KODE_FASILITAS]" id="tpb_barang[x][TARIF][BM_TIDAK_DIPUNGUT][KODE_FASILITAS]" value="5"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BM_TIDAK_DIPUNGUT][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][BM_TIDAK_DIPUNGUT][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BMT_DITANGGUHKAN][TARIF]" id="tpb_barang[x][TARIF][BMT_DITANGGUHKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BMT_DITANGGUHKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][BMT_DITANGGUHKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][BMT_DITANGGUHKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][BMT_DITANGGUHKAN][JENIS_TARIF]" value="BMT"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BMT_DITANGGUHKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][BMT_DITANGGUHKAN][KODE_FASILITAS]" value="2"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BMT_DITANGGUHKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][BMT_DITANGGUHKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BMT_DIBEBASKAN][TARIF]" id="tpb_barang[x][TARIF][BMT_DIBEBASKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BMT_DIBEBASKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][BMT_DIBEBASKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][BMT_DIBEBASKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][BMT_DIBEBASKAN][JENIS_TARIF]" value="BMT"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BMT_DIBEBASKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][BMT_DIBEBASKAN][KODE_FASILITAS]" value="4"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BMT_DIBEBASKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][BMT_DIBEBASKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BMT_TIDAK_DIPUNGUT][TARIF]" id="tpb_barang[x][TARIF][BMT_TIDAK_DIPUNGUT][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][BMT_TIDAK_DIPUNGUT][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][BMT_TIDAK_DIPUNGUT][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][BMT_TIDAK_DIPUNGUT][JENIS_TARIF]" id="tpb_barang[x][TARIF][BMT_TIDAK_DIPUNGUT][JENIS_TARIF]" value="BMT"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BMT_TIDAK_DIPUNGUT][KODE_FASILITAS]" id="tpb_barang[x][TARIF][BMT_TIDAK_DIPUNGUT][KODE_FASILITAS]" value="5"/>
				<input type="hidden" name="tpb_barang[x][TARIF][BMT_TIDAK_DIPUNGUT][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][BMT_TIDAK_DIPUNGUT][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][CUKAI_DITANGGUHKAN][TARIF]" id="tpb_barang[x][TARIF][CUKAI_DITANGGUHKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][CUKAI_DITANGGUHKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][CUKAI_DITANGGUHKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][CUKAI_DITANGGUHKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][CUKAI_DITANGGUHKAN][JENIS_TARIF]" value="CUKAI"/>
				<input type="hidden" name="tpb_barang[x][TARIF][CUKAI_DITANGGUHKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][CUKAI_DITANGGUHKAN][KODE_FASILITAS]" value="2"/>
				<input type="hidden" name="tpb_barang[x][TARIF][CUKAI_DITANGGUHKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][CUKAI_DITANGGUHKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][CUKAI_DIBEBASKAN][TARIF]" id="tpb_barang[x][TARIF][CUKAI_DIBEBASKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][CUKAI_DIBEBASKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][CUKAI_DIBEBASKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][CUKAI_DIBEBASKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][CUKAI_DIBEBASKAN][JENIS_TARIF]" value="CUKAI"/>
				<input type="hidden" name="tpb_barang[x][TARIF][CUKAI_DIBEBASKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][CUKAI_DIBEBASKAN][KODE_FASILITAS]" value="4"/>
				<input type="hidden" name="tpb_barang[x][TARIF][CUKAI_DIBEBASKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][CUKAI_DIBEBASKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][CUKAI_TIDAK_DIPUNGUT][TARIF]" id="tpb_barang[x][TARIF][CUKAI_TIDAK_DIPUNGUT][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][CUKAI_TIDAK_DIPUNGUT][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][CUKAI_TIDAK_DIPUNGUT][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][CUKAI_TIDAK_DIPUNGUT][JENIS_TARIF]" id="tpb_barang[x][TARIF][CUKAI_TIDAK_DIPUNGUT][JENIS_TARIF]" value="PPN"/>
				<input type="hidden" name="tpb_barang[x][TARIF][CUKAI_TIDAK_DIPUNGUT][KODE_FASILITAS]" id="tpb_barang[x][TARIF][CUKAI_TIDAK_DIPUNGUT][KODE_FASILITAS]" value="5"/>
				<input type="hidden" name="tpb_barang[x][TARIF][CUKAI_TIDAK_DIPUNGUT][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][CUKAI_TIDAK_DIPUNGUT][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPN_DITANGGUHKAN][TARIF]" id="tpb_barang[x][TARIF][PPN_DITANGGUHKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPN_DITANGGUHKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][PPN_DITANGGUHKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][PPN_DITANGGUHKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][PPN_DITANGGUHKAN][JENIS_TARIF]" value="PPN"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPN_DITANGGUHKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][PPN_DITANGGUHKAN][KODE_FASILITAS]" value="2"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPN_DITANGGUHKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][PPN_DITANGGUHKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPN_DIBEBASKAN][TARIF]" id="tpb_barang[x][TARIF][PPN_DIBEBASKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPN_DIBEBASKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][PPN_DIBEBASKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][PPN_DIBEBASKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][PPN_DIBEBASKAN][JENIS_TARIF]" value="PPN"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPN_DIBEBASKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][PPN_DIBEBASKAN][KODE_FASILITAS]" value="4"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPN_DIBEBASKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][PPN_DIBEBASKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPN_TIDAK_DIPUNGUT][TARIF]" id="tpb_barang[x][TARIF][PPN_TIDAK_DIPUNGUT][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPN_TIDAK_DIPUNGUT][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][PPN_TIDAK_DIPUNGUT][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][PPN_TIDAK_DIPUNGUT][JENIS_TARIF]" id="tpb_barang[x][TARIF][PPN_TIDAK_DIPUNGUT][JENIS_TARIF]" value="PPNBM"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPN_TIDAK_DIPUNGUT][KODE_FASILITAS]" id="tpb_barang[x][TARIF][PPN_TIDAK_DIPUNGUT][KODE_FASILITAS]" value="5"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPN_TIDAK_DIPUNGUT][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][PPN_TIDAK_DIPUNGUT][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPNBM_DITANGGUHKAN][TARIF]" id="tpb_barang[x][TARIF][PPNBM_DITANGGUHKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPNBM_DITANGGUHKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][PPNBM_DITANGGUHKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][PPNBM_DITANGGUHKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][PPNBM_DITANGGUHKAN][JENIS_TARIF]" value="PPNBM"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPNBM_DITANGGUHKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][PPNBM_DITANGGUHKAN][KODE_FASILITAS]" value="2"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPNBM_DITANGGUHKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][PPNBM_DITANGGUHKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPNBM_DIBEBASKAN][TARIF]" id="tpb_barang[x][TARIF][PPNBM_DIBEBASKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPNBM_DIBEBASKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][PPNBM_DIBEBASKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][PPNBM_DIBEBASKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][PPNBM_DIBEBASKAN][JENIS_TARIF]" value="PPNBM"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPNBM_DIBEBASKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][PPNBM_DIBEBASKAN][KODE_FASILITAS]" value="4"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPNBM_DIBEBASKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][PPNBM_DIBEBASKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPNBM_TIDAK_DIPUNGUT][TARIF]" id="tpb_barang[x][TARIF][PPNBM_TIDAK_DIPUNGUT][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPNBM_TIDAK_DIPUNGUT][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][PPNBM_TIDAK_DIPUNGUT][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][PPNBM_TIDAK_DIPUNGUT][JENIS_TARIF]" id="tpb_barang[x][TARIF][PPNBM_TIDAK_DIPUNGUT][JENIS_TARIF]" value="PPH"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPNBM_TIDAK_DIPUNGUT][KODE_FASILITAS]" id="tpb_barang[x][TARIF][PPNBM_TIDAK_DIPUNGUT][KODE_FASILITAS]" value="5"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPNBM_TIDAK_DIPUNGUT][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][PPNBM_TIDAK_DIPUNGUT][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPH_DITANGGUHKAN][TARIF]" id="tpb_barang[x][TARIF][PPH_DITANGGUHKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPH_DITANGGUHKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][PPH_DITANGGUHKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][PPH_DITANGGUHKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][PPH_DITANGGUHKAN][JENIS_TARIF]" value="PPH"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPH_DITANGGUHKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][PPH_DITANGGUHKAN][KODE_FASILITAS]" value="2"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPH_DITANGGUHKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][PPH_DITANGGUHKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPH_DIBEBASKAN][TARIF]" id="tpb_barang[x][TARIF][PPH_DIBEBASKAN][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPH_DIBEBASKAN][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][PPH_DIBEBASKAN][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][PPH_DIBEBASKAN][JENIS_TARIF]" id="tpb_barang[x][TARIF][PPH_DIBEBASKAN][JENIS_TARIF]" value="PPH"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPH_DIBEBASKAN][KODE_FASILITAS]" id="tpb_barang[x][TARIF][PPH_DIBEBASKAN][KODE_FASILITAS]" value="4"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPH_DIBEBASKAN][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][PPH_DIBEBASKAN][TARIF_FASILITAS]" value="100.00"/>
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPH_TIDAK_DIPUNGUT][TARIF]" id="tpb_barang[x][TARIF][PPH_TIDAK_DIPUNGUT][TARIF]" />
				<input type="hidden" class="form-control form-control-sm" name="tpb_barang[x][TARIF][PPH_TIDAK_DIPUNGUT][NILAI_FASILITAS]" id="tpb_barang[x][TARIF][PPH_TIDAK_DIPUNGUT][NILAI_FASILITAS]" />
				<input type="hidden" name="tpb_barang[x][TARIF][PPH_TIDAK_DIPUNGUT][JENIS_TARIF]" id="tpb_barang[x][TARIF][PPH_TIDAK_DIPUNGUT][JENIS_TARIF]" value="PPH"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPH_TIDAK_DIPUNGUT][KODE_FASILITAS]" id="tpb_barang[x][TARIF][PPH_TIDAK_DIPUNGUT][KODE_FASILITAS]" value="5"/>
				<input type="hidden" name="tpb_barang[x][TARIF][PPH_TIDAK_DIPUNGUT][TARIF_FASILITAS]" id="tpb_barang[x][TARIF][PPH_TIDAK_DIPUNGUT][TARIF_FASILITAS]" value="100.00"/>
			</div>
		</td>
	</tr>
	</tbody>
</table>
<table class="x-hidden add_dokumen_template">
	<tbody>
	<tr data-index="x">
		<td class="text-center">
			<button class="btn btn-xs btn-danger btn-delete-dokumen"><i class="fa fal fa-trash"></i></button>
		</td>
		<td class="text-center"></td>
		<td>
			<select class="form-control form-control-sm mselect2" name="dokumen_tambahan[x][KODE_JENIS_DOKUMEN]">
				<option value="" disabled selected>Select Data . . .</option>
				<?= createOption($sdokumen, 'KODE_DOKUMEN', array('URAIAN_DOKUMEN'), ' - ') ?>
			</select>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="dokumen_tambahan[x][NOMOR_DOKUMEN]" />
		</td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" class="form-control form-control-sm x-datepicker x-readonly"
					   readonly placeholder="Select date" name="dokumen_tambahan[x][TANGGAL_DOKUMEN]">
				<div class="input-group-append">
					<span class="input-group-text fs-xl">
						<i class="fa fal fa-calendar"></i>
					</span>
				</div>
			</div>
		</td>
	</tr>
	</tbody>
</table>
<table class="x-hidden add_kemasan_template">
	<tbody>
	<tr data-index="x">
		<td class="text-center">
			<button class="btn btn-xs btn-danger btn-delete-kemasan"><i class="fa fal fa-trash"></i></button>
		</td>
		<td class="text-center"></td>
		<td>
			<div class="input-group input-group-sm">
				<input type="text" class="form-control form-control-sm x-readonly" readonly id="uraian_kemasan[x]"/>
				<input type="hidden" class="form-control form-control-sm" id="kode_kemasan[x]" name="tpb_kemasan[x][KODE_JENIS_KEMASAN]" />
				<div class="input-group-append">
					<button type="button" class="btn btn-default" onclick="setKemasanIndexDocIn('[x]')"><i class="fal fa-search"></i></button>
				</div>
			</div>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'currency', 'prefix': ''" name="tpb_kemasan[x][JUMLAH_KEMASAN]">
		</td>
	</tr>
	</tbody>
</table>

<script>
    let arr_tujuan = <?=json_encode($stujuan_pengiriman)?>;
</script>