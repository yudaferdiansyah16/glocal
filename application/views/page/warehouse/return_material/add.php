<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">Warehouse</li>
        <li class="breadcrumb-item">Return Material</li>
        <li class="breadcrumb-item active">Add</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            Add Return Material
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="card mb-g">
                <div class="card-body">
                    <form method="post" action="<?= base_url('warehouse/return_material/store') ?>">
                        <div class="form-group row">                            
                            <div class="col-md-2">
                                <label class="form-label">Return Date</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm x-datepicker x-readonly" placeholder="Select date" name="t_wh[tanggal_terima]" value="<?= date('d-m-Y') ?>" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text fs-xl">
                                            <i class="fa fal fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-striped table-sm" id="dt_request_add" role="grid">
                                        <thead>
                                            <tr class="text-center">
                                                <th class="text-center" width="20px">No</th>
                                                <th class="text-center" style="width: 150px;">No Job</th>
                                                <th class="text-center">Item</th>
                                                <th class="text-center">From</th>
                                                <th class="text-center">Stock</th>
                                                <th class="text-center" style="width: 120px;">Return</th>
                                                <th class="text-center" style="width: 120px;">To Location</th>
                                                <th class="text-center" style="width: 50px;">
                                                    <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#t_wh_detail_stock_modal"><i class="fal fa-plus-circle"></i></button>
                                                </th>
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
                                <label class="form-label">Return Note</label>
                                <textarea class="form-control form-control-sm" name="t_wh[deskripsi]"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?= $this->lang->line('button_save') ?></button>
                            <a href="<?= base_url($_controller . '/' . $_method) ?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?= $this->lang->line('button_cancel') ?></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<!--hidden variable-->
<select class="x-hidden" id="main_location"></select>
