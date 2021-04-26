<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">Finance</li>
        <li class="breadcrumb-item active">Laporan Kasbon</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">Laporan Kasbon</h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="card mb-g">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <label class="form-label">Start Date</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm x-datepicker x-readonly start_date form-filter" placeholder="Select date" name="tgl1" value="<?php if(isset($tgl1)) echo $tgl1; ?>">
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
                                <input type="text" class="form-control form-control-sm x-datepicker x-readonly end_date form-filter" placeholder="Select date" name="tgl2" value="<?php if(isset($tgl2)) echo $tgl2; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text fs-xl">
                                        <i class="fa fal fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
			    <label class="form-label">Karyawan</label>
                            <div class="input-group input-group-sm">
				<select name="karyawan" class="form-control form-control-sm select2" id="karyawan">
					<option value="">Karyawan</option>
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
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Karyawan</th>
                                            <th class="text-center">Divisi</th>
                                            <th class="text-center">Tanggal Kasbon</th>
					    <th class="text-center">No Kasbon</th>
                                            <th class="text-center">Description</th>
                                            <th class="text-center">Amount Kasbon</th>
                                            <th class="text-center">Realisasi</th>
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