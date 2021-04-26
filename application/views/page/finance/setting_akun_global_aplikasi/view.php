<!-- <main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">

        <li class="breadcrumb-item">Finance</li>
        <li class="breadcrumb-item active">Setting Akun Global Aplikasi</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            Setting Akun Global Aplikasi
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="card mb-g">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped table-sm" id="dt" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Account Retur Pembelian</th>
                                    <th class="text-center">Account Diskon Pembelian</th>
                                    <th class="text-center">Account Retur Penjualan</th>
                                    <th class="text-center">Account Diskon Pembelian</th>
                                    <th class="text-center">Account COGS</th>
                                    <th class="text-center">Account PPN Masuk</th>
                                    <th class="text-center">Account PPN Keluar</th>
                                    <th class="text-center">Account Laba ditahan</th>
                                    <th class="text-center">Account Laba Hasil</th>
                                    <th class="text-center">Option</th>
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
</main> -->

<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">

        <li class="breadcrumb-item">Finance</li>
        <li class="breadcrumb-item">Setting Akun Global Aplikasi</li>
        <!-- <li class="breadcrumb-item active">Edit</li> -->
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            Setting Akun Global Aplikasi
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6 col-xl-6">
            <div class="card mb-g">
                <div class="card-body">
                    <form method="post" action="<?= base_url('finance/setting_akun_global_aplikasi/update') ?>">
                        <input type="hidden" name="id_sbu" value="<?= placeValue($data, 'id_sbu') ?>">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="form-label">Account Retur Pembelian</label>
                                <select class="form-control form-control-sm akunSelect" name="id_akun_retur_beli">
                                    <option value="<?= placeValue($data, 'id_akun_retur_beli') ?>" selected>
                                        [<?= placeValue($data, 'kode_akun_retur_beli') ?>] <?= placeValue($data, 'nama_akun_retur_beli') ?>
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label">Account Diskon Pembelian</label>
                                <select class="form-control form-control-sm akunSelect" name="id_akun_diskon_beli">
                                    <option value="<?= placeValue($data, 'id_akun_diskon_beli') ?>" selected>
                                        [<?= placeValue($data, 'kode_akun_diskon_beli') ?>] <?= placeValue($data, 'nama_akun_diskon_beli') ?>
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label">Account Retur Penjualan</label>
                                <select class="form-control form-control-sm akunSelect" name="id_akun_retur_jual">
                                    <option value="<?= placeValue($data, 'id_akun_retur_jual') ?>" selected>
                                        [<?= placeValue($data, 'kode_akun_retur_jual') ?>] <?= placeValue($data, 'nama_akun_retur_jual') ?>
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label">Account Diskon Penjualan</label>
                                <select class="form-control form-control-sm akunSelect" name="id_akun_diskon_jual">
                                    <option value="<?= placeValue($data, 'id_akun_diskon_jual') ?>" selected>
                                        [<?= placeValue($data, 'kode_akun_diskon_jual') ?>] <?= placeValue($data, 'nama_akun_diskon_jual') ?>
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label">Account COGS</label>
                                <select class="form-control form-control-sm akunSelect" name="id_akun_cogs">
                                    <option value="<?= placeValue($data, 'id_akun_cogs') ?>" selected>
                                        [<?= placeValue($data, 'kode_akun_cogs') ?>] <?= placeValue($data, 'nama_akun_cogs') ?>
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label">Account PPN Masuk</label>
                                <select class="form-control form-control-sm akunSelect" name="id_akun_ppn_masuk">
                                    <option value="<?= placeValue($data, 'id_akun_ppn_masuk') ?>" selected>
                                        [<?= placeValue($data, 'kode_akun_ppn_masuk') ?>] <?= placeValue($data, 'nama_akun_ppn_masuk') ?>
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label">Account PPN Keluar</label>
                                <select class="form-control form-control-sm akunSelect" name="id_akun_ppn_keluar">
                                    <option value="<?= placeValue($data, 'id_akun_ppn_keluar') ?>" selected>
                                        [<?= placeValue($data, 'kode_akun_ppn_keluar') ?>] <?= placeValue($data, 'nama_akun_ppn_keluar') ?>
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label">Account Laba ditahan</label>
                                <select class="form-control form-control-sm akunSelect" name="id_akun_laba_ditahan">
                                    <option value="<?= placeValue($data, 'id_akun_laba_ditahan') ?>" selected>
                                        [<?= placeValue($data, 'kode_akun_laba_ditahan') ?>] <?= placeValue($data, 'nama_akun_laba_ditahan') ?>
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label">Account Pajak Hasil</label>
                                <select class="form-control form-control-sm akunSelect" name="id_akun_pajak_hasil">
                                    <option value="<?= placeValue($data, 'id_akun_pajak_hasil') ?>" selected>
                                        [<?= placeValue($data, 'kode_akun_pajak_hasil') ?>] <?= placeValue($data, 'nama_akun_pajak_hasil') ?>
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
                            <!-- <a href="<?= base_url('finance/setting_akun_global_aplikasi') ?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
