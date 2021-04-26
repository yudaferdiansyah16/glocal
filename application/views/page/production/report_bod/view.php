<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">Production</li>
        <li class="breadcrumb-item active">Report BOD</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">Report BOD</h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="card mb-g">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <label class="form-label">Start Date</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm x-datepicker x-readonly start_date form-filter" placeholder="Select date" value="<?= date('01-m-Y') ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text fs-xl">
                                        <i class="fa fal fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Due Date</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm x-datepicker x-readonly end_date form-filter" placeholder="Select date" value="<?= date('t-m-Y') ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text fs-xl">
                                        <i class="fa fal fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Jenis Dokumen</label>
				<select class="form-control form-control-sm select2" name="tpb_header[KODE_DOKUMEN_PABEAN]" id="jenis_dokumen">
					<option value="" disabled selected>Select Data . . .</option>
					<?= createOption($sdokumen_pabean, 'KODE_DOKUMEN_PABEAN', array('URAIAN_DOKUMEN_PABEAN'), ' - ') ?>
				</select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label"></label>
                            <div class="input-group input-group-sm">
                                <button type="button" class="btn btn-primary" value="view">View</button>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="dt" class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" style="white-space: nowrap">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-center" rowspan="2">No</th>
                                            <th class="text-center" colspan="2">Dokumen</th>
                                            <th class="text-center" rowspan="2">Customer</th>
                                            <th class="text-center" colspan="5">Barang</th>
                                            <th class="text-center" rowspan="2">History</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">No Bukti</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Nama Barang</th>
                                            <th class="text-center">Kode</th>
                                            <th class="text-center">Satuan</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Harg</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>