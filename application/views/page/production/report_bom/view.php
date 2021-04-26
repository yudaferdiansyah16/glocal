<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">Production</li>
        <li class="breadcrumb-item active">Report BOM</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">Report BOM</h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="card mb-g">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <label class="form-label">Start Date</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm x-datepicker x-readonly tglawal form-filter" placeholder="Select date" value="<?= date('01-m-Y') ?>" onchange="reloadDT('tglawal')">
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
                                <input type="text" class="form-control form-control-sm x-datepicker x-readonly tglakhir form-filter" placeholder="Select date" value="<?= date('t-m-Y') ?>"  onchange="reloadDT('tglakhir')"/>
                                <div class="input-group-append">
                                    <span class="input-group-text fs-xl">
                                        <i class="fa fal fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Customer</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm x-readonly nama_supplier" readonly placeholder="Select Customer..." required>
                                <input type="hidden" class="id_supplier" name="id_supplier" />
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-default btn-search-customer" data-toggle="modal" data-target="#referensi_pemasok_modal"><i class="fal fa-search"></i></button>
                                    <button type="button" class="btn btn-danger btn-clear-customer"><i class="fal fa-times-circle"></i></button>
                                </div>
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
                                            <th class="text-center" colspan="3">Dokumen</th>
                                            <th class="text-center" rowspan="2">Customer</th>
                                            <th class="text-center" rowspan="2">Total Item</th>
                                            <th class="text-center" rowspan="2">History</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Nomor</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">PO Customer</th>
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