<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">

        <li class="breadcrumb-item">Finance</li>
        <li class="breadcrumb-item">Setting Akun Supplier</li>
        <li class="breadcrumb-item active">Edit</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            Edit Setting Akun Supplier
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6 col-xl-6">
            <div class="card mb-g">
                <div class="card-body">
                    <form method="post" action="<?= base_url('finance/setting_akun_supplier/update') ?>">
                        <input type="hidden" name="id_customer" value="<?= placeValue($data, 'id_customer') ?>">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="form-label">Account Hutang</label>
                                <select class="form-control form-control-sm akunSelect" name="id_akun">
                                    <option value="<?= placeValue($data, 'id_akun') ?>" selected>
                                        [<?= placeValue($data, 'kode_akun') ?>] <?= placeValue($data, 'nama_akun') ?>
                                    </option>
                                </select>
                            </div>
                            <!-- <div class="col-sm-12">
                                <label class="form-label">Account Uang Muka Pembelian</label>
                                <select class="form-control form-control-sm akunSelect" name="id_akun_um">
                                    <option value="<?= placeValue($data, 'id_akun_um') ?>" selected>
                                        [<?= placeValue($data, 'kode_akun_um') ?>] <?= placeValue($data, 'nama_akun_um') ?>
                                    </option>
                                </select>
                            </div> -->
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Save</button>
                            <a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
