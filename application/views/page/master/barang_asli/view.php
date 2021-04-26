<style>
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_desc:before {
        display: none;
    }

    table.dataTable tbody th,
    table.dataTable tbody td {
        white-space: nowrap;
    }
</style>
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
					<a href="<?=base_url('master/barang/add')?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> <?=$this->lang->line('button_add')?></a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid">
							<thead>
							<tr>
								<th class="text-center"><?=$this->lang->line('label_no_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_kode_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_nama_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_kategori_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_kelas_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_fasilitas_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_asal_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_merek_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_kode_serial_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_pengepakan_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_status_barang')?></th>
								<th class="text-center"><?=$this->lang->line('label_option_barang')?></th>
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
