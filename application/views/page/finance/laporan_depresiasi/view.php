<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">Finance</li>
        <li class="breadcrumb-item active">Laporan Depresiasi</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">Laporan Depresiasi</h1>
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
                        <div class="col-md-2">
                            <label class="form-label">Lama Penyusutan</label>
                            <div class="input-group input-group-sm">
                                <select name="lama" class="form-control form-control-sm select2">
                                    <option value="">Lama Penyusutan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Status</label>
                            <div class="input-group input-group-sm">
                                <select name="status" class="form-control form-control-sm select2">
                                    <option value="">Status</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Lokasi</label>
                            <div name="lokasi" class="input-group input-group-sm select2">
                                <select class="form-control form-control-sm">
                                    <option value="">Lokasi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label"></label>
                            <div class="input-group input-group-sm">
                                <button type="button" class="btn btn-primary" value="view">View</button>
                                &nbsp;
                                <button type="button" class="btn btn-success" value="excel">Excel</button>
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
                                            <th class="text-center" colspan="5">Barang</th>
                                            <th class="text-center" rowspan="2">Lokasi</th>
                                            <th class="text-center" rowspan="2">Status</th>
                                            <th class="text-center" colspan="4">Perolehan</th>
                                            <th class="text-center" rowspan="2">Umur Ekonomis</th>
                                            <th class="text-center" rowspan="2">Persentase Penyusutan(Thn)</th>
                                            <th class="text-center" rowspan="2">Penyusutan Perbulan</th>
                                            <th class="text-center" rowspan="2">Akumulasi Penyusutan</th>
                                            <th class="text-center" rowspan="2">Nilai Buku</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Kode Asset</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Satuan</th>
                                            <th class="text-center">QTY</th>
                                            <th class="text-center">Kelompok</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Bulan</th>
                                            <th class="text-center">Mulai Penyusutan</th>
                                            <th class="text-center">Akhir Penyusutan</th>
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