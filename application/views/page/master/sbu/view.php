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
					<a href="<?=base_url('master/sbu/add')?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> <?=$this->lang->line('button_add')?></a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped table-sm" id="dt" style="width: 100%;">
							<thead>
							<tr>
								<th><?=$this->lang->line('label_no_sbu')?></th>
								<th><?=$this->lang->line('label_code_sbu')?></th>
								<th><?=$this->lang->line('label_nama_sbu')?></th>
								<th><?=$this->lang->line('label_alamat_sbu')?></th>
								<th><?=$this->lang->line('label_kota_sbu')?></th>
								<th><?=$this->lang->line('label_manajer_sbu')?></th>
								<th><?=$this->lang->line('label_kppbc_sbu')?></th>
								<th><?=$this->lang->line('label_status_sbu')?></th>
								<th><?=$this->lang->line('label_option_sbu')?></th>
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
