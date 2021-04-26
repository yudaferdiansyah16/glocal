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
					<a href="<?=base_url('master/sub_barang/add')?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> <?=$this->lang->line('button_add')?></a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid">
							<thead>
							<tr>
								<th class="text-center"><?=$this->lang->line('label_no_sub_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_kode_sub_barang')?></th>
								<!-- <th class="text-center"><?=$this->lang->line('label_induk_sub_barang')?></th> -->
								<th class="text-center"><?=$this->lang->line('label_nama_sub_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_unit_terkecil_sub_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_unit_terbesar_sub_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_kategori_sub_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_klasifikasi_sub_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_asal_sub_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_merek_sub_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_gaya_sub_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_warna_sub_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_ukuran_sub_barang')?></th>
								<!-- <th class="text-center"><?=$this->lang->line('label_dimensi_sub_barang')?></th> -->
								<th class="text-center"><?=$this->lang->line('label_status_sub_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_option_sub_barang')?></th>
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
