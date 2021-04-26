<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
		<?=generateBreadcrumb($this->lang->line('breadcrumb_add'))?>
		<div class="subheader">
        <h1 class="subheader-title">
            Add Access Module
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="card mb-g">
                <div class="card-body">
                    <form method="post" action="<?= base_url('setting/access_module/store') ?>">
                        <div class="form-group row">
                            <div class="form-group col-md-12">
                                <label class="form-label">Privilage</label>
                                <select class="form-control form-control-sm select2" name="id_priv" required>
                                    <option value="" disabled selected>Select Privilage . . .</option>
                                    <?= createOption($privi, 'id_priv', array('nama_priv'), ' - ') ?>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-label">Module</label>
                                <select class="form-control form-control-sm" id="modul" name="id_modul[]" multiple required>
                                    <?= createOption($modul, 'id_modul', array('nama_modul_en'), ' - ') ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
                            <a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?> </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
