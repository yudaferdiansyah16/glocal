<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Exim</li>
		<li class="breadcrumb-item">Transaksi Doc Out</li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Detail Transaksi Doc Out
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<?php if ($status->FLAG_APPROVAL2 == 1) { ?>
						<button type="button" disabled class="btn btn-primary btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 2
						</button>
					<?php } else if ($status->FLAG_APPROVAL1 == 1) { ?>
						<button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 1
						</button>
						<button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass-start"></i> Waiting for Approve 2
						</button>
					<?php } else if ($status->FLAG_APPROVAL1 == 0) { ?>
						<button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass-start"></i> Waiting for Approve 1
						</button>
					<?php } ?>
				</div>
				<?php
				if ($tpbHeader->KODE_DOKUMEN_PABEAN == '25') include 'detail_25.php';
				if ($tpbHeader->KODE_DOKUMEN_PABEAN == '261') include 'detail_261.php';
				if ($tpbHeader->KODE_DOKUMEN_PABEAN == '27') include 'detail_27.php';
				if ($tpbHeader->KODE_DOKUMEN_PABEAN == '41') include 'detail_41.php';
				?>
			</div>
		</div>
	</div>
</main>
<script>
    let id_header = <?=$tpbHeader->ID?>;
</script>

