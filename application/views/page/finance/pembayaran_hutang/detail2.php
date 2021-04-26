<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item">Payment Debit Credit</li>
		<li class="breadcrumb-item active">Credit</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Detail Hutang
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('finance/pembayaran_hutang/payment')?>">
						<div class="row">
							<div class="col-md-2">
								<p><b>Invoice</b></p>
							</div>
							<div class="col-md-4">
								<p>: <input type="hidden" name="hinvoice" value="<?=$hutang->no_invoice?>"><?=$hutang->no_invoice?></p>
								<input type="hidden" name="invoice" value="<?=$hutang->id_dn?>">
							</div>
							<div class="col-md-2">
								<p><b>Date Invoice</b></p>
							</div>
							<div class="col-md-4">
								<p>: <?=$hutang->tgl_invoice?></p>
							</div>
							<div class="col-md-2">
								<p><b>Vendor</b></p>
							</div>
							<div class="col-md-4">
								<p>: <?=$hutang->vendor?></p>
							</div>
							<div class="col-md-2">
								<p><b>Sub Total</b></p>
							</div>
							<div class="col-md-4">
								<p>: <input type="hidden" name="sisa" value="<?=$hutang->nilai-$hutang->jumlah?>"><?=number_format(substr($hutang->nilai, 0, -6), 2)?></p>
							</div>
							<div class="col-md-2">
								<p><b>Valuta</b></p>
							</div>
							<div class="col-md-4">
								<p>: <input type="hidden" name="hvaluta" value="<?=$hutang->id_valuta?>"><?=$hutang->uraian_valuta?></p>
							</div>
							<div class="col-md-2">
								<p><b>Rate</b></p>
							</div>
							<div class="col-md-4">
								<p>: <input type="hidden" name="hrate" value="<?=$hutang->rate?>"><?=number_format($hutang->rate, 2)?></p>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid">
								<thead>
									<tr>
										<th style="width: 30px;" class="text-center">No</th>
										<th>Barang</th>
										<th class="text-center">Satuan</th>
										<th class="text-center">Qty</th>
										<th class="text-right">Harga</th>
										<th class="text-right">Current</th>
										<th class="text-center">COA</th>
										<th style="width: 30px;" class="text-right">&nbsp;</th>
										<th style="width: 30px;" class="text-right">&nbsp;</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="4" class="text-center">TOTAL</th>
										<th class="text-right"><?=number_format($hutang->nilai, 2).",-"?>
										<th colspan="4">&nbsp;</th>
										</th>
									</tr>
								</tfoot>
							</table>
						</div>
						<div class="form-group">
								<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Save</button>
								<a href="<?=base_url('finance/pembayaran_hutang/view')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Cancel</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
<script>
	let iddn = <?=$iddn?> ;

</script>
