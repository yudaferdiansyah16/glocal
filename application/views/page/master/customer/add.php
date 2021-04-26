<main id="js-page-content" role="main" class="page-content">
	<?=generateBreadcrumb($this->lang->line('breadcrumb_add'))?>
    <div class="subheader">
        <h1 class="subheader-title">
			<?=$this->lang->line('title_add')?>
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6 col-xl-6">
            <div class="card mb-g">
                <div class="card-body">
                    <form method="post" action="<?= base_url('master/customer/store') ?>">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="form-label"><?=$this->lang->line('label_nama_customer')?></label>
                                <input type="text" class="form-control form-control-sm" name="nama">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label"><?=$this->lang->line('label_npwp_customer')?></label>
                                <input type="text" class="form-control form-control-sm" name="npwp">
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label"><?=$this->lang->line('label_alamat_customer')?></label>
                                <input type="text" class="form-control form-control-sm" name="alamat">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label"><?=$this->lang->line('label_kustomer_awal_customer')?></label>
                                <input type="text" class="form-control form-control-sm" name="job_prefix">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label"><?=$this->lang->line('label_negara_customer')?></label>
                                <select class="form-control form-control-sm negaraSelect" name="kode_negara"></select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label"><?=$this->lang->line('label_email_customer')?></label>
                                <input type="text" class="form-control form-control-sm" name="email">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label"><?=$this->lang->line('label_no_telpon_customer')?></label>
                                <input type="text" class="form-control form-control-sm" name="telp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="custom-control custom-checkbox" onclick="unhide()">
                                    <input type="checkbox" class="custom-control-input beneficiary" name="beneficiary" id="beneficiary" value="1">
                                    <label class="custom-control-label" for="beneficiary"><?=$this->lang->line('label_beneficiary_customer')?></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row x-hidden account_input">
                            <div class="col-sm-12">
                                <label class="form-label"><?=$this->lang->line('label_akun_customer')?></label>
                                <select class="form-control form-control-sm akunSelect" name="id_akun"></select>
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
