<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">SMARTONE</a></li>
		<li class="breadcrumb-item">Warehouse</li>
		<li class="breadcrumb-item">Approval Request Material</li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Approval Request Material
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<?php if ($reqheader->approval_2 == 1) { ?>
						<button type="button" disabled class="btn btn-primary btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 2
						</button>
					<?php } else if ($reqheader->approval_1 == 1) { ?>
						<button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 1
						</button>
					<?php } else if ($reqheader->approval_1 == 0) { ?>
						<button type="button" disabled class="btn btn-default btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass"></i> Ready
						</button>
					<?php } ?>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<table class="table table-sm table-bordered" role="grid" style="table-layout: fixed">
								<tr>
									<td><b>KODE PRODUKSI</b></td>
									<td><?=$reqheader->kode_mutasi?></td>
									<td><b>TANGGAL PRODUKSI</b></td>
									<td><?=$reqheader->tanggal_terima?></td>
								</tr>
							</table>
						</div>
						<div class="col-md-12">
							<table class="table table-hover table-bordered table-striped table-sm" id="dt_approval_request" role="grid">
								<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">No Aju</th>
									<th class="text-center">No Pendaftaran</th>
									<th class="text-center">No DN</th>
									<th class="text-center">Job</th>
									<th class="text-center">Item Code</th>
									<th class="text-center">Item</th>
									<th class="text-center">Quantity</th>
								</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<?php if ($reqheader->approval_2 == 0) { ?>
						<a href="<?=base_url('production/request_material/approval2/'.$reqheader->id_wh)?>" class="btn btn-sm btn-primary"><i class="fal fa fa-check-circle"></i> Approve 2</a>
					<?php }?>
					<?php if ($reqheader->approval_1 == 1 && $reqheader->approval_2 == 1) { ?>
						<a href="<?=base_url('production/request_material/disapprove2/'.$reqheader->id_wh)?>" class="btn btn-sm btn-secondary"><i class="fal fa fa-circle"></i> Disapprove</a>
					<?php }?>
					<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-info align-rigt"><i class="fal fa-times-circle"></i> Back</a>
				</div>
			</div>
		</div>
	</div>
</main>
<script>
	let id_pro = <?=$proheader->id_production?>;
	console.log(<?=$proheader->id_production?>);
</script>
