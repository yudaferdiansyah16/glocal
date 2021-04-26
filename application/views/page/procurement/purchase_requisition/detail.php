<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">DPS</a></li>
		<li class="breadcrumb-item">Procurement</li>
		<li class="breadcrumb-item">Purchase Requesition</li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Detail Purchase Requesition
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<?php if ($ppheader->flag_btl == 1) { ?>
						<button type="button" disabled class="btn btn-danger btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> <?=$this->lang->line('button_cancel')?>ed
						</button>
					<?php } else if ($ppheader->flag_closing == 1) { ?>
						<button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Closed
						</button>
					<?php } else {?>
						<?php if ($ppheader->approval_2 == 1) { ?>
							<button type="button" disabled class="btn btn-primary btn-sm btn-pills waves-effect waves-themed">
								<i class="fa fal fa-check"></i> Approved 2
							</button>
						<?php } else if ($ppheader->approval_1 == 1) { ?>
							<button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
								<i class="fa fal fa-check"></i> Approved 1
							</button>
							<button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
								<i class="fa fal fa-hourglass-start"></i> Waiting for Approve 2
							</button>
						<?php } else if ($ppheader->approval_1 == 0) { ?>
							<button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
								<i class="fa fal fa-hourglass-start"></i> Waiting for Approve 1
							</button>
						<?php } ?>
					<?php } ?>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-2">
							<p><b>Nomor PP</b></p>
							<p><b>Date</b></p>
							<p><b>Due Date</b></p>
						</div>
						<div class="col-md-2">
							<p>: <?=$ppheader->kode_pp?></p>
							<p>: <?=$ppheader->tanggal_dibuat?></p>
							<p>: <?=$ppheader->tanggal_dibutuhkan?></p>
						</div>
						<div class="col-md-2">
							<p><b>Bagian</b></p>
							<p><b>Jenis PP</b></p>
							<p><b>Jenis PP Rutinitas</b></p>
						</div>
						<div class="col-md-2">
							<p>: <?=$ppheader->nama_bagian?></p>
							<p>: <?=$ppheader->nama_jenis_pp?></p>
							<p>: <?=$ppheader->nama_jenis_pp_rutinitas?></p>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">No Job</th>
									<th class="text-center">Barang</th>
									<th class="text-center">Quantity</th>
									<th class="text-center">Remark</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer">
					<?php if ($ppheader->approval_1 == 0 && $ppheader->flag_btl == 0 && $ppheader->flag_closing == 0) { ?>
						<a href="<?=base_url('procurement/purchase_requisition/approval1/'.$ppheader->id_pp)?>" class="btn btn-sm btn-success"><i class="fal fa fa-check-circle"></i> Approve 1</a>
					<?php }?>
					<?php if ($ppheader->approval_1 == 1 && $ppheader->approval_2 == 0 && $ppheader->flag_btl == 0 && $ppheader->flag_closing == 0) { ?>
						<a href="<?=base_url('procurement/purchase_requisition/disapprove1/'.$ppheader->id_pp)?>" class="btn btn-sm btn-secondary"><i class="fal fa fa-circle"></i> Disapprove 1</a>
						<a href="<?=base_url('procurement/purchase_requisition/approval2/'.$ppheader->id_pp)?>" class="btn btn-sm btn-primary"><i class="fal fa fa-check-circle"></i> Approve 2</a>
					<?php }?>
					<?php if ($ppheader->approval_2 == 1 && $ppheader->flag_btl == 0 && $ppheader->flag_closing == 0) { ?>
						<a href="<?=base_url('procurement/purchase_requisition/disapprove2/'.$ppheader->id_pp)?>" class="btn btn-sm btn-secondary"><i class="fal fa fa-circle"></i> Disapprove 2</a>
					<?php }?>
					<?php if ($ppheader->flag_btl == 0 && $ppheader->approval_1 == 0 && $ppheader->approval_2 == 0) { ?>
						<a href="<?=base_url('procurement/purchase_requisition/cancel/'.$ppheader->id_pp)?>" class="btn btn-sm btn-danger"><i class="fal fa fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
					<?php }?>
					<?php if ($ppheader->flag_closing == 0 && $ppheader->approval_2 == 1 && $ppheader->flag_btl == 0) { ?>
						<a href="<?=base_url('procurement/purchase_requisition/closing/'.$ppheader->id_pp)?>" class="btn btn-sm btn-warning"><i class="fal fa fa-minus-circle"></i> Closing</a>
					<?php }?>
					<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-info align-rigt"><i class="fal fa-times-circle"></i> Back</a>
				</div>
			</div>
		</div>
	</div>
</main>
<script>
    let idpp = <?=$idpp?>;
</script>
