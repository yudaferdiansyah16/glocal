<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">SMARTONE</a></li>
		<li class="breadcrumb-item">Production</li>
		<li class="breadcrumb-item">Request Produksi</li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Detail Request Produksi
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
							<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid">
								<thead>
								<tr>
									<th class="text-center" rowspan="2">No Request</th>
									<th class="text-center" rowspan="2">Tanggal Request</th>
									<th class="text-center" rowspan="2">No Receive/LPB</th>
									<th class="text-center" rowspan="2">No Job</th>
									<th class="text-center" colspan="5">Barang</th>
									<th class="text-center" rowspan="2">Other Job</th>
									<th class="text-center" rowspan="2">Catatan</th>
								</tr>
								<tr>
									<th>Nama</th>
									<th>Kode</th>
									<th>Satuan</th>
									<th>Stok</th>
									<th>Request</th>
								</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<?php if ($reqheader->approval_1 == 0 && $reqheader->flag_btl == 0 && $reqheader->flag_closing == 0) { ?>
						<a href="<?=base_url('production/request_produksi/approval1/'.$reqheader->id_production)?>" class="btn btn-sm btn-primary"><i class="fal fa fa-check-circle"></i> Approve 1</a>
					<?php }?>
					<?php if ($reqheader->approval_1 == 1 && $reqheader->approval_2 == 0 && $reqheader->flag_btl == 0 && $reqheader->flag_closing == 0) { ?>
						<a href="<?=base_url('production/request_produksi/disapprove1/'.$reqheader->id_production)?>" class="btn btn-sm btn-secondary"><i class="fal fa fa-circle"></i> Disapprove</a>
					<?php }?>
					<?php if ($reqheader->flag_btl == 0) { ?>
						<a href="<?=base_url('production/request_produksi/cancel/'.$reqheader->id_production)?>" class="btn btn-sm btn-danger"><i class="fal fa fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
					<?php }?>
					<?php if ($reqheader->flag_closing == 0 && $reqheader->approval_2 == 1 && $reqheader->flag_btl == 0) { ?>
						<a href="<?=base_url('production/request_produksi/closing/'.$reqheader->id_production)?>" class="btn btn-sm btn-warning"><i class="fal fa fa-minus-circle"></i> Closing</a>
					<?php }?>
					<a href="<?=base_url('production/request_produksi')?>" class="btn btn-sm btn-info align-rigt"><i class="fal fa-times-circle"></i> Back</a>
				</div>
			</div>
		</div>
	</div>
</main>
<script>
	let id_production = <?=$reqheader->id_production?>;
</script>
