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
					<a href="<?=base_url('setting/user_list/add')?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> <?=$this->lang->line('button_add')?></a>
				</div>

				<div class="card-body">
					<div class="table-responsive">
						<table id="dt" class="table table-bordered table-striped table-hover table-sm" style="width:100%">
							<thead>
							<tr>
								<th class="text-center"><?=$this->lang->line('label_no_user_list')?></th>
								<th class="text-center"><?=$this->lang->line('label_nama_user_list')?></th>
								<th class="text-center"><?=$this->lang->line('label_pengguna_user_list')?></th>
								<th class="text-center"><?=$this->lang->line('label_email_user_list')?></th>
								<th class="text-center"><?=$this->lang->line('label_role_user_list')?></th>
<!--								<th class="text-center">test foto</th>-->
								<th class="text-center" style="width: 100px;"><?=$this->lang->line('label_option_user_list')?></th>
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
