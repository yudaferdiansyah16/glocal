<main id="js-page-content" role="main" class="page-content">
	<?=generateBreadcrumb($this->lang->line('breadcrumb_view'))?>
    <div class="subheader">
        <h1 class="subheader-title">
			<?=$this->lang->line('title_view')?>
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="card mb-g">
                <div class="card-header">
                    <a href="<?= base_url('master/customer/add') ?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> <?=$this->lang->line('button_add')?></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" style="white-space: nowrap;">
                            <thead>
                                <tr>
									<th class="text-center"><?=$this->lang->line('label_no_customer')?></th>
									<th class="text-center"><?=$this->lang->line('label_kode_customer')?></th>
									<th class="text-center"><?=$this->lang->line('label_nama_perusahaan_customer')?></th>
									<th class="text-center"><?=$this->lang->line('label_alamat_customer')?></th>
									<th class="text-center"><?=$this->lang->line('label_kontak_customer')?></th>
									<th class="text-center"><?=$this->lang->line('label_pekerjaan_awal_customer')?></th>
									<th class="text-center"><?=$this->lang->line('label_beneficiary_customer')?></th>
									<th class="text-center"><?=$this->lang->line('label_option_customer')?></th>
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
</main>
