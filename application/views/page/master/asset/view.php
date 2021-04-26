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
					<a href="<?=base_url('master/asset/add')?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> <?=$this->lang->line('button_add')?></a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" style="width: 99%;">
							<thead>
							<tr>
								<th class="text-center"><?=$this->lang->line('label_no_asset')?></th>
								<th class="text-center"><?=$this->lang->line('label_nama_asset')?></th>
								<th class="text-center"><?=$this->lang->line('label_id_satuan_terkecil_asset')?></th>
								<th class="text-center"><?=$this->lang->line('label_id_satuan_terbesar_asset')?></th>
								<th class="text-center"><?=$this->lang->line('label_kode_hs_asset')?></th>
								<th class="text-center"><?=$this->lang->line('label_id_kategori_asset')?></th>
								<th class="text-center"><?=$this->lang->line('label_id_kelas_asset')?></th>
								<th class="text-center"><?=$this->lang->line('label_id_asal_asset')?></th>
								<th class="text-center"><?=$this->lang->line('label_id_merek_asset')?></th>
								<th class="text-center"><?=$this->lang->line('label_gaya_asset')?></th>
								<th class="text-center"><?=$this->lang->line('label_warna_asset')?></th>
								<th class="text-center"><?=$this->lang->line('label_ukuran_asset')?></th>
								<th class="text-center"><?=$this->lang->line('label_dimensi_asset')?></th>
								<th class="text-center"><?=$this->lang->line('label_stok_asset')?></th>
								<th class="text-center"><?=$this->lang->line('label_status_asset')?></th>
								<th class="text-center"><?=$this->lang->line('label_option_asset')?></th>
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
