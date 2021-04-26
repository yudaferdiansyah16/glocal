<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item active">Laporan Hutang</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
		Laporan Hutang
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<form method="post" action="<?=base_url('finance/laporan_hutang/view')?>">
				<div class="card-header">
					<div class="row">
						<div class="col-md-3">
							<label class="form-label">Start</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select start date" name="tgl1" value="<?php if(isset($tgl1)) echo $tgl1; ?>">
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
								<input type="text" class="form-control form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select end date" name="tgl2" value="<?php if(isset($tgl2)) echo $tgl2; ?>">
								<div class="input-group-append">
									<span class="input-group-text fs-xl">
										<i class="fa fal fa-calendar"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<label class="form-label">&nbsp;</label>
							<div class="input-group input-group-sm">
								<button type="submit" class="btn btn-sm btn-primary"><i class="fal fa fa-file"></i> &nbsp; Report</button>
							</div>
						</div>
					</div>
				</div>
				</form>
				<div class="card-body">
					<div class="table-responsive">
						<?php if(isset($tgl1) && isset($tgl2)){ ?>
						<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid">
							<thead>
							<tr>
								<th class="text-center" width="100px" rowspan="2">Kode Supplier</th>
								<th class="text-center" width="150px" rowspan="2">Vendor</th>
								<th class="text-center" width="100px" rowspan="2">Invoice Date</th>
								<th class="text-center" width="100px" rowspan="2">Invoice No</th>
								<th class="text-center" width="100px" rowspan="2">Due Date</th>
								<th class="text-center" width="100px" rowspan="2">Amount</th>
								<th class="text-center" width="100px" rowspan="2">Payment</th>
								<th class="text-center" width="100px" rowspan="2">Current</th>
								<th class="text-center" width="200px" colspan="3">Past Due</th>
								<th class="text-center" width="100px" rowspan="2">Total Due</th>
							</tr>
							<tr>
								<th class="text-center" width="100px">0-30</th>
								<th class="text-center" width="100px">31-60</th>
								<th class="text-center" width="100px">60-90</th>
							</tr>
							</thead>
							<tbody>
							<?php
							foreach($data->res->result() as $p){
								$sqlday = "SELECT DATEDIFF('".$p->tgl_hbayar."','".$p->tgl_invoice."') AS jarak";
								$resday = $this->db->query($sqlday);
								$rday = $resday->row();
								$t1 = 0;
								$t2 = 0;
								$t3 = 0;
								if($rday->jarak<=30) $t1 = $p->jumlah_hbayar;
								elseif($rday->jarak>30 && $rday->jarak<=60) $t2 = $p->jumlah_hbayar;
								elseif($rday->jarak>60 && $rday->jarak<=90) $t3 = $p->jumlah_hbayar;
							?>
							<tr>
								<td class="text-center"><?=$p->npwp?></td>
								<td><?=$p->vendor?></td>
								<td class="text-center"><?=$p->tgl_invoice?></td>
								<td class="text-center"><?=$p->no_invoice?></td>
								<td class="text-right">-</td>
								<td class="text-right"><?=number_format($p->nilai, 2)?></td>
								<td class="text-right"><?=number_format($p->jumlah_hbayar, 2)?></td>
								<td class="text-right"><?=number_format($p->nilai-$p->sisa_hbayar, 2)?></td>
								<td class="text-right"><?=number_format($t1, 2)?></td>
								<td class="text-right"><?=number_format($t2, 2)?></td>
								<td class="text-right"><?=number_format($t3, 2)?></td>
								<td class="text-right"><?=number_format($p->sisa_hbayar, 2)?></td>
							</tr>
							<?php } ?>
							</tbody>
						</table>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>