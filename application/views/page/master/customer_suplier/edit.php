<main id="js-page-content" role="main" class="page-content">
	<?=generateBreadcrumb($this->lang->line('breadcrumb_add'))?>
    <div class="subheader">
        <h1 class="subheader-title">
			Edit Customer / Supplier
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-8 col-xl-8">
            <div class="card mb-g">
                <div class="card-body">
                    <form method="post" action="<?= base_url('master/customer_suplier/update') ?>">
                        <div class="form-group row">
                            <div class="col-sm-12 col-lg-4">
                                <label class="form-label">Tipe</label>
                                <input type="text" class="form-control form-control-sm x-readonly" readonly value="<?=placeValue($data,'tipe')?>">
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label class="form-label">Job Prefix</label>
                                <input type="text" class="form-control form-control-sm x-readonly" readonly value="<?=placeValue($data,'job_prefix')?>">
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label class="form-label">Kode</label>
                                <input type="text" class="form-control form-control-sm x-readonly" readonly value="<?=placeValue($data,'kode_customer')?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-lg-4">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control form-control-sm" name="nama" value="<?=placeValue($data,'nama')?>">
                                <input type="hidden" name="id_customer" value="<?=placeValue($data,'id_customer')?>">
                            </div>
                            <div class="col-sm-12 col-lg-8">
                                <label class="form-label">Alamat</label>
                                <input type="text" class="form-control form-control-sm" name="alamat" value="<?=placeValue($data,'alamat')?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-lg-4">
                                <label class="form-label">Nama Penerima</label>
                                <input type="text" class="form-control form-control-sm" name="nama_consignee" value="<?=placeValue($data,'nama_consignee')?>">
                            </div>
                            <div class="col-sm-12 col-lg-8">
                                <label class="form-label">Tujuan Pengiriman</label>
                                <input type="text" class="form-control form-control-sm" name="destinasi" value="<?=placeValue($data,'destinasi')?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-lg-4">
                                <label class="form-label">NPWP</label>
                                <input type="text" class="form-control form-control-sm" name="npwp" value="<?=placeValue($data,'npwp')?>">
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label class="form-label">Negara</label>
                                <select class="form-control form-control-sm negaraSelect" name="kode_negara">
                                    <option value="<?=placeValue($data,'kode_negara')?>"><?=placeValue($data,'URAIAN_NEGARA')?></option>
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
