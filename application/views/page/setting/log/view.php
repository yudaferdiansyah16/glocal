<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Setting</li>
		<li class="breadcrumb-item active">Log User</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Log User
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<div style="margin-left :-10px;" class="col-sm-12">
						<form method="post" action="<?=base_url('setting/log/view')?>" autocomplete="off">
							<div class="form-group row">
								<div class="col-md-5">
									<label class="form-label">Date</label>
									<div class="input-group input-group-sm">
										<input type="text" class="form-control form-control-sm x-datepicker x-readonly"
											readonly placeholder="Select start date" name="tglawal"
											value="<?= (isset($tglawal)) ? $tglawal : date('d-m-Y') ?>" required>
										<div class="input-group-append">
											<span class="input-group-text fs-xl">
												<i class="fa fal fa-calendar"></i>
											</span>
										</div>
									</div>
								</div>
								<div class="col-md-2" style="margin-right: -73px;">
									<label class=" form-label">&nbsp;</label>
									<div class="input-group input-group-sm">
										<button type="submit" class="btn btn-sm btn-primary"><i class="fal fa fa-file"></i>&nbsp; Report</button>
									</div>
								</div>
								<?php  if($this->session->userdata('id_priv') == '3') { ?>
								<div class="col-md-2">
									<label class="form-label">&nbsp;</label>
									<div class="input-group input-group-sm">
										<button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
											data-target="#exampleModalCenter" style="color:white;"><i class="fal fa-sync"></i> Reset Log
										</button>
									</div>
								</div>
								<?php } ?>
							</div>
						</form>
					</div>
					<div class="p-2"></div>
					<div class="table-responsive">
						<table id="dt" class="table table-hover table-bordered table-sm" role="grid"
							style="white-space: nowrap">
							<thead>
								<tr class="text-center">
									<th width="5px">No</th>
									<th>Nama User</th>
									<th>Menu</th>
									<th>Sub Menu</th>
									<th>Aktivitas</th>
									<th>Date</th>
									<th width="15">Detail Ativitas</th>
								</tr>
							</thead>
							<tbody>
								<?php $count = count((array)$data);?>
								<?php $no = 1 ; if($count>0){ foreach ($data as $row) { ?>
								<tr class="text-center">
									<td><?= $no++ ?></td>
									<td><?= $row->log_nama_user ?></td>
									<td><?= $row->log_menu ?></td>
									<td><?= $row->log_sub_menu ?></td>
									<td><?= $row->log_aktivitas ?></td>
									<td><?= $row->log_time ?></td>

									<td>
										<button class="btn btn-sm btn-info" type="button" class="btn btn-xs btn-default"
											data-toggle="modal" data-target="#posting<?=$row->log_id?>"><i
												class="fal fa-eye"></i>
											Detail</button>
									</td>
									<?php } }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php if($count>0){ foreach ($data as $row) {  ?>
<div class="modal fade " id="posting<?=$row->log_id?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-top" role="document">
		<div class="modal-content">
			<form method="post" action="<?= base_url('finance/jurnal_hutang/store') ?>">
				<div class="modal-header">
					<h5 class="modal-title pr-4">Detail Aktivitas</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						<table class="table table-sm table-bordered" role="grid" style="white-space:nowrap;"
							width="100%">
							<thead class="text-center">
								<tr>
									<th>Log Windows</th>
									<th>Log Url</th>
									<th>Log IP</th>
									<th>Log Browser</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?= $row->log_os ?></td>
									<td><?= $row->log_url ?></td>
									<td><?= $row->log_ip ?></td>
									<td><?= $row->log_browser ?></td>

								</tr>
								<tr>
									<td colspan="4">Log Aktivitas Detail</td>
								</tr>
								<tr>
									<td colspan="4">
										<?= $row->log_aktivitas ?><br>
										<small><?php if($row->log_aktivitas != "Login" && $row->log_aktivitas != "view access_module"){?>
										<?php print_r ( substr($row->log_request,1,-1)) ?>
										<?php } ?></small>
							
										
									</td>



								</tr>
								<!-- <tr>
								 <?php $data = json_decode($row->log_request, true);foreach ($data as $q) { ?>
									<td> <?= $q ?> </td>

									<?php  } ?>
								</tr> -->

							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php } } ?>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header" style="color:white; background:#0f619f;">
				<h5 class="modal-title" id="exampleModalLongTitle">Select Year</h5>
				<button style="color:white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('setting/log/resetLog')?>" autocomplete="off">
				<div class="modal-body">
					<div class="input-group input-group-sm">
						<input type="text" class="form-control form-control-sm year x-readonly" readonly
							placeholder="Select start date" name="tahun"
							value="<?= date('Y') ?>" required>
						<div class="input-group-append">
							<span class="input-group-text fs-xl">
								<i class="fa fal fa-calendar"></i>
							</span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fal fa-times-circle"></i>&nbsp;Close</button>
					<button type="submit" class="btn btn-sm btn-danger"><i class="fal fa-sync" aria-hidden="true"></i>&nbsp;Reset</button>
				</div>
			</form>
		</div>
	</div>
</div>
