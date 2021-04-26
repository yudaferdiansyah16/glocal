<main id="js-page-content" role="main" class="page-content">
	<?=generateBreadcrumb($this->lang->line('breadcrumb_view'))?>
	<div class="subheader">
		<h1 class="subheader-title">
			<?=$this->lang->line('title_view')?>
		</h1>
	</div>
	<style>
		.table-striped>tbody>tr.row-selected{
			background-color: #3c8dbc;
		}
		.point{
			cursor: pointer;
		}
	</style>
	<div class="content-wrapper">
		<section class="content">
			<div class="box">
				<div class="box-body card-body bg-white">
					<form method="post" action="<?= base_url('setting/access_module/changeStatus') ?>">
						<div class="row">
							<div class="col-md-3 col-xs-3">
								<table id="tabelPrivilege" class="table table-bordered table-striped table-hover table-sm" style="width:100%">
									<thead>
									<tr>
										<th class="text-center">No</th>
										<th>Role</th>
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div class="col-md-9 col-xs-9">
								<table id="tabelModul" class="table table-bordered table-striped table-hover table-sm" style="width:100%">
									<thead>
									<tr>
										<th class="text-center">No</th>
										<th class="text-center">Module Name</th>
										<th></th>
										<th class="text-center">View</th>
										<th class="text-center">Create</th>
										<th class="text-center">Update</th>
										<th class="text-center">Delete</th>
										<th class="text-center">App1</th>
										<th class="text-center">Unapp1</th>
										<th class="text-center">App2</th>
										<th class="text-center">Unapp2</th>
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div><hr>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
						</div><hr>
					</form>
				</div>
			</div>
		</section>
	</div>
</main>
