<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item active">Ledger Book</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Ledger Book
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('finance/buku_besar/view')?>" autocomplete="off">
						<div class="form-group row">
							<div class="col-md-3">
								<label class="form-label">Start</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select start date" name="tgl1" value="<?php if(isset($tgl1)) echo $tgl1; ?>" required>
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label class="form-label">End</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select end date" name="tgl2" value="<?php if(isset($tgl2)) echo $tgl2; ?>" required>
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fa fal fa-calendar"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<label class="form-label">Account</label>
								<div class="input-group input-group-sm">
									<div class="input-group input-group-sm">
										<select class="form-control form-control-sm select2 coaid" id="coaid" name="coa" required>
											<option value="" disabled selected>Select Data . . .</option>
											<?=createOption($scoa, 'id_akun', array('kode_akun','nama_akun'), ' - ', $coa);?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="form-label">&nbsp;</label>
								<div class="input-group input-group-sm">
									<button type="submit" class="btn btn-sm btn-primary"><i class="fal fa fa-file"></i> &nbsp; Report</button>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<div class="table-responsive">
									<?php if(isset($tgl1) && isset($tgl2) && isset($coa)){ ?>
										<table class="table table-sm table-bordered table-striped table-hover" id="dt">
											<thead>
											<tr>
												<th class="text-center" rowspan="2" style="width: 100px;">Account No.</th>
												<th class="text-center" rowspan="2" style="width: 100px;">Date</th>
												<th class="text-center" rowspan="2">Account Name</th>
												<th class="text-center" rowspan="2">Source</th>
												<th class="text-center" rowspan="2">Account Type</th>
												<th class="text-center" rowspan="2">Description</th>
												<th class="text-center" colspan="2">Opening Balance</th>
												<th class="text-center" rowspan="2">Balance</th>
											</tr>
											<tr>
												<th class="text-center" style="width: 90px;">Debit</th>
												<th class="text-center" style="width: 90px;">Credit</th>
											</tr>
											</thead>
											<tbody>
											<tr>
												<th class="text-center"><?=$data->kode?></th>
												<th>&nbsp;</th>
												<th><?=$data->nama?></th>
												<th>&nbsp;</th>
												<th class="text-center"><?=$data->tipe?></th>
												<th>&nbsp;</th>
												<?php
												if(substr($data->saldoawal, 0, 1)=='-'){
													$saldodebet = 0;
													$saldokredit = $data->saldoawal;
												}else{
													$saldodebet = $data->saldoawal;
													$saldokredit = 0;
												}
												?>
												<th class="text-right"><?php if($saldodebet) echo number_format($saldodebet); else echo "-"; ?></th>
												<th class="text-right"><?php if($saldokredit) echo number_format($saldokredit); else echo "-"; ?></th>
												<th>&nbsp;</th>
											</tr>
											<?php
											$subTotal = 0;
											foreach($data->akun as $p){ 
												$subTotal = $p->hasil;
											?>
											<tr>
												<td class="text-center"><?=$p->kode?></td>
												<td class="text-center"><?=reverseDate($p->tgl)?></td>
												<td><?=$p->nama?></td>
												<td class="text-center"><?=$p->no?></td>
												<td class="text-center"><?=$p->tipe?></td>
												<td><?=$p->ket?></td>
												<td class="text-right"><?php if($p->debet) echo number_format($p->debet); else echo "-"; ?></td>
												<td class="text-right"><?php if($p->kredit) echo number_format($p->kredit); else echo "-"; ?></td>
												<td class="text-right"><?php echo number_format($p->hasil); ?></td>
											</tr>
											<?php } ?>
											<tr>
												<th colspan="6">TOTAL</th>
												<th class="text-right"><?php if($data->totaldebet+$saldodebet) echo number_format($data->totaldebet+$saldodebet); else echo "-"; ?></th>
												<th class="text-right"><?php if($data->totalkredit+$saldokredit) echo number_format($data->totalkredit+$saldokredit); else echo "-"; ?></th>
												<th class="text-right"><?php echo number_format(@$p->hasil); ?></th>
											</tr>
											</tbody>
										</table>
									<?php } ?>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
