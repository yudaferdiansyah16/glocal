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
                    <form method="post" action="<?= base_url('master/supplier/store') ?>">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="form-label"><?=$this->lang->line('label_nama_supplier')?></label>
                                <input type="text" class="form-control form-control-sm" name="nama">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label"><?=$this->lang->line('label_npwp_supplier')?></label>
                                <input type="text" class="form-control form-control-sm" name="npwp">
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label"><?=$this->lang->line('label_alamat_supplier')?></label>
                                <input type="text" class="form-control form-control-sm" name="alamat">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label"><?=$this->lang->line('label_negara_supplier')?></label>
                                <select class="form-control form-control-sm negaraSelect" name="kode_negara"></select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label"><?=$this->lang->line('label_email_supplier')?></label>
                                <input type="text" class="form-control form-control-sm" name="email">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label"><?=$this->lang->line('label_telpon_supplier')?></label>
                                <input type="text" class="form-control form-control-sm" name="telp">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label"><?=$this->lang->line('label_bank_supplier')?></label>
                                <select class="form-control form-control-sm bankSelect" name="id_bank"></select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label"><?=$this->lang->line('label_no_akun_supplier')?></label>
                                <input type="text" class="form-control form-control-sm" name="ban">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label"><?=$this->lang->line('label_akun_supplier')?></label>
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
