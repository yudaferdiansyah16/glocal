<main id="js-page-content" role="main" class="page-content">
	<?=generateBreadcrumb($this->lang->line('breadcrumb_edit'))?>
    <div class="subheader">
        <h1 class="subheader-title">
			<?=$this->lang->line('title_edit')?>
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6 col-xl-6">
            <div class="card mb-g">
                <div class="card-body">
                    <form method="post" action="<?= base_url('master/customer/update') ?>">
                        <input type="hidden" name="id_customer" value="<?= placeValue($data, 'id_customer') ?>">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="form-label"><?=$this->lang->line('label_nama_customer')?></label>
                                <input type="text" class="form-control form-control-sm" name="nama" value="<?= placeValue($data, 'nama') ?>">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label"><?=$this->lang->line('label_npwp_customer')?></label>
                                <input type="text" class="form-control form-control-sm" name="npwp" value="<?= $data->npwp > 0 ? $data->npwp : '' ?>">
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label"><?=$this->lang->line('label_alamat_customer')?></label>
                                <input type="text" class="form-control form-control-sm" name="alamat" value="<?= placeValue($data, 'alamat') ?>">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label"><?=$this->lang->line('label_kustomer_awal_customer')?></label>
                                <input type="text" class="form-control form-control-sm" name="job_prefix" value="<?= placeValue($data, 'job_prefix') ?>">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label"><?=$this->lang->line('label_negara_customer')?></label>
                                <select class="form-control form-control-sm negaraSelect" name="kode_negara">
                                    <option value="<?= placeValue($data, 'kode_negara') ?>" selected><?= placeValue($data, 'uraian_negara') ?></option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label"><?=$this->lang->line('label_email_customer')?></label>
                                <input type="text" class="form-control form-control-sm" name="email" value="<?= placeValue($data, 'email') ?>">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label"><?=$this->lang->line('label_no_telpon_customer')?></label>
                                <input type="text" class="form-control form-control-sm" name="telp" value="<?= placeValue($data, 'telp') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="custom-control custom-checkbox" onclick="unhide()">
                                    <input type="checkbox" class="custom-control-input beneficiary" name="beneficiary" id="beneficiary" value="1" <?php if ($data->beneficiary == 1) {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    } ?>>
                                    <label class="custom-control-label" for="beneficiary"><?=$this->lang->line('label_beneficiary_customer')?></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row x-hidden account_input">
                            <div class="col-sm-12">
                                <label class="form-label"><?=$this->lang->line('label_akun_customer')?></label>
                                <select class="form-control form-control-sm akunSelect" name="id_akun">
                                    <option value="<?= placeValue($data, 'id_akun') ?>" selected>
                                        <?= placeValue($data, 'kode_akun') ?><?= placeValue($data, 'nama_akun') ?>
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
                            <a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
