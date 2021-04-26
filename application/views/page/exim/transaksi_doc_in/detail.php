<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Exim</li>
		<li class="breadcrumb-item">Transaksi Doc In</li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Detail Transaksi Doc In
		</h1>
	</div>
	<div class="card-header ">
				<div class="row">
				<div class="col-sm-12 col-md-5">
				<div class="dataTables_paginate paging_simple_numbers" style="" id="dt_paginate">
						<ul class="pagination">
							<li class="paginate_button page-item previous " id="dt_previous"><a href="<?=base_url('exim/transaksi_doc_out/detail/')?><?=placeValue($tpbHeader,'ID')-1?>"
									aria-controls="dt" data-dt-idx="0" tabindex="0" class="page-link"><i
										class="fal fa-chevron-left"></i></a></li>
						
							
						</ul>
					</div>
				</div>
				<div class="col-sm-12 col-md-6" style=" text-align: right;" >
				</div>
				<div class="col-sm-12 col-md-1" style=" padding-left: 40px; text-align: right;" >
				<div class="dataTables_paginate paging_simple_numbers" style=" text-align: right; " id="dt_paginate">
						<ul class="pagination">
							<li class="paginate_button page-item next" id="dt_next"><a
									href="<?=base_url('exim/transaksi_doc_out/detail/')?><?=placeValue($tpbHeader,'ID')+1?>"
									aria-controls="dt" data-dt-idx="3" tabindex="0" class="page-link"><i
										class="fal fa-chevron-right"></i></a></li>
						</ul>
					</div>
				</div>

			
				</div>
				
					
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
				<div class="card-header   ">
				 <center>
				 PEMBERITAHUAN IMPOR BARANG UNTUK DITIMBUN DI TEMPAT PENIMBUNAN BERIKAT
				 </center>
				 </div>
				</div>
				<?php
				if ($tpbHeader->KODE_DOKUMEN_PABEAN == '23') include 'detail_23.php';
				if ($tpbHeader->KODE_DOKUMEN_PABEAN == '262') include 'detail_262.php';
				if ($tpbHeader->KODE_DOKUMEN_PABEAN == '27IN') include 'detail_27IN.php';
				if ($tpbHeader->KODE_DOKUMEN_PABEAN == '40') include 'detail_40.php';
				?>
				<div class="card-footer">
					<a href="<?=base_url('exim/transaksi_doc_in/')?>" class="btn btn-sm btn-info"><i class="fal fa fa-times-circle"></i> Back</a>
				</div>
			</div>
		</div>
	</div>
</main>
<script>
	<?php 
	if ($tpbHeader->KODE_DOKUMEN_PABEAN != '23') echo "let id_header =".$tpbHeader->ID.";";
	// else echo "let id_header='";
	?>
</script>
