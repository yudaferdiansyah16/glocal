<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item">Approval Kasbon</li>
		<li class="breadcrumb-item active">Add</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Add Approval Kasbon
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('finance/approval_kasbon/store2/'.$idkasbon)?>">
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
							<div class="form-group row">
								<div class="col-md-6">
									<label class="form-label">Note</label>
									<input type="text" class="form-control form-control-sm" name="catatan" placeholder="Note" required/>
								</div>
							</div>
						</div>
						<div class="from-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="dt" class="table table-sm table-bordered table-striped table-hover">
										<thead>
											<tr class="text-center">
												<th style="width: 30px;">No.</th>
												<th>Description</th>
												<th style="width: 120px;">Amount</th>
												<th style="width: 50px;">
													<button type="button" class="btn btn-xs btn-success btn-add"><i class="fa fal fa-plus-circle"></i></button>
												</th>
											</tr>
										</thead>
										<tbody></tbody>
										<tfoot>
											<tr>
												<td colspan="2s" class="text-center">Total</td>
												<td class="text-right"><b><span class="grand_amount"></span></b></td>
												<td></td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Save</button>
							<a href="<?=base_url('finance/approval_kasbon')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Cancel</a>
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
		<td><input type="text" name="t_kasbon_detail[x][keterangan]" class="form-control form-control-sm" value="" required></td>
		<td>
			<input type="text" class="form-control form-control-sm input-mask jumlah" name="t_kasbon_detail[x][jumlah]" placeholder="" data-inputmask="'alias': 'currency', 'prefix': '', 'suffix': '', 'allowMinus': false" value="0" required/>
			<input type="hidden" class="jumlah_total" name="t_kasbon_detail[x][jumlah]" value="0">
		</td>
		<td class="text-center">
			<a href="javascript://" class="btn btn-xs btn-danger btn-delete-row"><i class="fal fal fa-trash"></i></a>
		</td>
	</tr>
	</tbody>
</table>
