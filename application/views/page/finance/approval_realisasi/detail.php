<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item">Approval Realisasi</li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Detail Approval Realisasi
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
			<div class="card-header">
					<?php if ($kasbonheader->status_kasbon == 4) { ?>
						<button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Closed
						</button>
					<?php } else if ($kasbonheader->status_kasbon == 3) {?>
						<button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass-start"></i> Waiting for Closed
						</button>
					<?php } ?>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-2">
							<p><b>Date</b></p>
						</div>
						<div class="col-md-4">
							<p>: <?=$kasbonheader->tgl_kasbon?></p>
						</div>
						<div class="col-md-2">
							<p><b>Nama</b></p>
						</div>
						<div class="col-md-4">
							<p>: <?=$kasbonheader->nama?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<p><b>Note</b></p>
						</div>
						<div class="col-md-10">
							<p>: <?=$kasbonheader->ket_kasbon?></p>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid">
							<thead>
							<tr>
								<th style="width: 30px;" class="text-center">No</th>
								<th class="text-center">Description</th>
								<th style="width: 150px;" class="text-center">Amount</th>
							</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
							<tr>
								<th colspan="2" class="text-center">TOTAL REALISASI</th>
								<th class="text-right"><?=number_format($kasbonheader->total_realisasi, 2).",-"?></th>
							</tr>
							<tr style="background-color: #dedede;">
								<th colspan="2" class="text-center">TOTAL KASBON</th>
								<th class="text-right"><?=number_format($kasbonheader->total_kasbon, 2).",-"?></th>
							</tr>
							<tr>
								<th colspan="2" class="text-center">SELISIH</th>
								<th class="text-right"><?=number_format($kasbonheader->total_kasbon-$kasbonheader->total_realisasi, 2).",-"?></th>
							</tr>
							</tfoot>
						</table>
					</div>
					<div class="card-footer">
						<?php if ($kasbonheader->status_kasbon == 3 ) { ?>
							<a href="<?=base_url('finance/approval_realisasi/closing/'.$kasbonheader->id_kasbon)?>" class="btn btn-sm btn-warning"><i class="fal fa fa-minus-circle"></i> Closing</a>
						<?php }?>
						<a href="<?=base_url('finance/approval_realisasi')?>" class="btn btn-sm btn-info align-rigt"><i class="fal fa-times-circle"></i> Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<script>
    let idkasbon = <?=$idkasbon?>;
</script>