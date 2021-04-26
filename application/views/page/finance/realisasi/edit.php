<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item">Realisasi</li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Detail Realisasi
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('finance/realisasi/store2/'.$idkasbon)?>">
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
										<th style="width: 50px;">
											<button type="button" class="btn btn-xs btn-success btn-add"><i
													class="fa fal fa-plus-circle"></i></button>
										</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="2" class="text-center">TOTAL</th>
										<th class="grand_amount"><?=number_format($kasbonheader->total_kasbon, 2).",-"?>
                                        </th>
										<th><input type="hidden" name="htotal" id="htotal" class="hgrand_amount"></th>
									</tr>
								</tfoot>
							</table>
						</div>
						<div class="form-group">
							<a href="<?=base_url('finance/realisasi')?>" class="btn btn-sm btn-danger"><i
									class="fal fa-times-circle"></i> Cancel</a>
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i>
								Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
<table class="x-hidden" id="template-row">
	<tbody>
		<tr data-index="x">
			<td class="text-center">1</td>
			<td><input type="text" name="t_kasbon_detail[x][keterangan]" class="form-control form-control-sm" value=""
					required></td>
			<td>
				<input type="text" class="form-control form-control-sm input-mask jumlah"
					name="t_kasbon_detail[x][jumlah]" placeholder=""
					data-inputmask="'alias': 'currency', 'prefix': '', 'suffix': '', 'allowMinus': false" value="0"
					required />
				<input type="hidden" class="jumlah_total" name="t_kasbon_detail[x][jumlah]" value="0">
			</td>
			<td class="text-center">
				<a href="javascript://" class="btn btn-xs btn-danger btn-delete-row"><i
						class="fal fal fa-trash"></i></a>
			</td>
		</tr>
	</tbody>
</table>

<script>
	let idkasbon = <?=$idkasbon?> ;
	let kasbonheader = <?=$kasbonheader->total_kasbon?> ;
</script>
