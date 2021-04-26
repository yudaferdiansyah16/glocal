<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">Warehouse</li>
        <li class="breadcrumb-item">Adjust Material</li>
        <li class="breadcrumb-item active">Add</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            Add Adjustment Material
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="card mb-g">
                <div class="card-body">
                    <form method="post" action="<?= base_url('warehouse/adjust_material/store') ?>">
                        <div class="form-group row">                            
                            <div class="col-md-2">
                                <label class="form-label">Adjustment Date</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm x-datepicker x-readonly" placeholder="Select date" name="t_wh[tanggal_terima]" value="<?= date('d-m-Y') ?>" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text fs-xl">
                                            <i class="fa fal fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="x-hidden template_request">
                                    <label class="form-label">No Job</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control form-control form-control-sm x-readonly no_job" readonly>
                                        <input type="hidden" class="id_job"/>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#t_job_modal"><i class="fal fa-search"></i></button>
                                        </div>
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
                                                <th class="text-center">Location</th>
                                                <th class="text-center">Stock</th>
                                                <th class="text-center" style="width: 120px;">Adjust</th>
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
                                <label class="form-label">Adjustment Note</label>
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
<table class="x-hidden table_template">
    <tbody>
        <tr data-index="x">
            <td class="text-center">1</td>
            <td>
                <p class="no_job"></p>
                <input type="hidden" class="id_job" name="t_wh_detail[x][id_job]"/>
                <input type="hidden" class="id_production" name="t_wh_detail[x][id_production]"/>
                <input type="hidden" class="id_detail_dn" name="t_wh_detail[x][id_detail_dn]"/>
                <input type="hidden" class="harga_satuan" name="t_wh_detail[x][harga_satuan]"/>
                <input type="hidden" class="rate" name="t_wh_detail[x][rate]"/>
            </td>
            <td>
                <p class="nama_barang" style="margin: 0;padding: 0"></p>
                <small class="kode_barang" style="margin: 0;padding: 0"></small>
                <input type="hidden" class="id_sub_barang" name="t_wh_detail[x][id_sub_barang]"/>
                <input type="hidden" class="id_satuan_terkecil" name="t_wh_detail[x][id_satuan_terkecil]"/>
                <input type="hidden" class="id_satuan_terbesar" name="t_wh_detail[x][id_satuan_terbesar]"/>
            </td>
            <td>
                <span class="nama_gudang"></span><br>
                <small class="nama_koordinat"></small>
                <input type="hidden" class="id_koordinat" name="t_wh_detail[x][id_koordinat]"/>
            </td>
            <td class="text-right">
                <span class="qty_stock"></span><br>
                <small class="kode_satuan"></small>
            </td>
            <td>
                <input type="text" class="form-control form-control-sm input-mask qty" data-inputmask="'alias': 'currency', 'prefix': ''" name="t_wh_detail[x][qty]" value="0"/>
            </td>
            <td class="text-center">
                <button class="btn btn-xs btn-danger btn-delete-row"><i class="fa fal fa-trash"></i></button>
            </td>
        </tr>
    </tbody>
</table>
