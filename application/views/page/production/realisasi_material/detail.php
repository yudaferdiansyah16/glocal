<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">SBP</a></li>
		<li class="breadcrumb-item">Production</li>
		<li class="breadcrumb-item">Realisasi Request Material</li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Detail Realisasi  Request Material
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<?php if ($rlzheader->approval_2 == 1) { ?>
						<button type="button" disabled class="btn btn-primary btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 2
						</button>
					<?php } else if ($rlzheader->approval_1 == 1) { ?>
						<button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 1
						</button>
						<button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass-start"></i> Waiting for Approve 2
						</button>
					<?php } else if ($rlzheader->approval_1 == 0) { ?>
						<button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass-start"></i> Waiting for Approve 1
						</button>
					<?php } ?>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<table class="table table-sm table-bordered" role="grid" style="table-layout: fixed">
								<tr>
									<td><b>KODE PRODUKSI</b></td>
									<td><?=$rlzheader->kode_mutasi?></td>
									<td><b>TANGGAL PRODUKSI</b></td>
									<td><?=$rlzheader->tanggal_mutasi?></td>
								</tr>
							</table>
						</div>
						<div class="col-md-12">
							<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid">
								<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Job</th>
									<th class="text-center">Item</th>
									<th class="text-center">Quantity</th>
								</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<?php if ($rlzheader->approval_1 == 0 && $rlzheader->flag_btl == 0 && $rlzheader->flag_closing == 0) { ?>
						<a href="<?=base_url('production/realisasi_request_material/approval1/'.$rlzheader->id_production)?>" class="btn btn-sm btn-primary"><i class="fal fa fa-check-circle"></i> Approve 1</a>
					<?php }?>
					<?php if ($rlzheader->approval_1 == 1 && $rlzheader->approval_2 == 0 && $rlzheader->flag_btl == 0 && $rlzheader->flag_closing == 0) { ?>
						<a href="<?=base_url('production/realisasi_request_material/disapprove1/'.$rlzheader->id_production)?>" class="btn btn-sm btn-secondary"><i class="fal fa fa-circle"></i> Disapprove</a>
					<?php }?>
					<?php if ($rlzheader->flag_btl == 0) { ?>
						<a href="<?=base_url('production/realisasi_request_material/cancel/'.$rlzheader->id_production)?>" class="btn btn-sm btn-danger"><i class="fal fa fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
					<?php }?>
					<?php if ($rlzheader->flag_closing == 0 && $rlzheader->approval_2 == 1 && $rlzheader->flag_btl == 0) { ?>
						<a href="<?=base_url('production/realisasi_request_material/closing/'.$rlzheader->id_production)?>" class="btn btn-sm btn-warning"><i class="fal fa fa-minus-circle"></i> Closing</a>
					<?php }?>
					<a href="<?=base_url('production/realisasi_request_material')?>" class="btn btn-sm btn-info align-rigt"><i class="fal fa-times-circle"></i> Back</a>
				</div>
			</div>
		</div>
	</div>
</main>
<script>
	let id_production = <?=$rlzheader->id_production?>;
</script>
