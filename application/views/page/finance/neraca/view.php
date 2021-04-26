<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item active">Neraca</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">Neraca</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<form method="post" action="<?=base_url('finance/neraca/view')?>">
					<div class="card-header">
						<div class="row">
							<div class="col-md-3">
								<label class="form-label">Start</label>
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm x-datepicker x-readonly"
										readonly placeholder="Select start date" name="tgl1"
										value="<?php if(isset($tgl1)) echo $tgl1; ?>">
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
									<input type="text"
										class="form-control form-control form-control-sm x-datepicker x-readonly"
										readonly placeholder="Select end date" name="tgl2"
										value="<?php if(isset($tgl2)) echo $tgl2; ?>">
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
									<button type="submit" class="btn btn-sm btn-primary"><i class="fal fa fa-file"></i>
										&nbsp; Report</button>
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
									<th class="text-center" width="100px">NO. AKUN</th>
									<th class="text-center" width="300px">DESCRIPTION</th>
									<?php
								$bulan = $data->awal;
								$tahun = $data->tahun-1;
								for($i=0; $i<=$data->range+1; $i++){ 
								?>
									<th class="text-center" width="100px"><?php
								$nmbulan = strtoupper(bln($bulan));
								if($bulan==12) echo $nmbulan."`".$tahun;
								else echo $nmbulan;
								?>
									</th>
									<?php 
								if($bulan==12) $bulan = 1;
								else $bulan = $bulan + 1;	
								} ?>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>&nbsp;</th>
									<th>AKTIVA LANCAR</th>
									<?php for($i=0; $i<=$data->range+1; $i++){ ?>
									<th>&nbsp;</th>
									<?php } ?>
								</tr>
								<?php 
							$no = 0;
							$totalawal11 = 0;
							foreach($data->akun11->result() as $p){
							?>
								<tr>
									<td class="text-center"><?=$p->kode_akun?></td>
									<td><?=$p->nama_akun?></td>
									<td class="text-right"><?php
								if(!$p->nilai) echo "-";
								else{
									if($p->nilai > 0) echo number_format($p->nilai);
									else{
										echo "<span style='color: red'>(".number_format(substr($p->nilai, 1)).")</span>";
									}
									$totalawal11 = $totalawal11 +  $p->nilai;
								}
								?></td><?php 
								for($i=0; $i<=$data->range; $i++){ 
								if(!isset($total11[$i])) $total11[$i] = array();
								?>
									<td class="text-right"><?php
								if(!$data->nilai11[$no][$i]) echo "-";
								else{
									if($data->nilai11[$no][$i] > 0) echo number_format($data->nilai11[$no][$i]);
									else{
										echo "<span style='color: red'>(".number_format(substr($data->nilai11[$no][$i], 1)).")</span>";
									}
								}
								array_push($total11[$i], $data->nilai11[$no][$i]);
								?></td>
									<?php } ?>
								</tr>
								<?php 
								$no++;
							} 
							?>
								<tr>
									<th>&nbsp;</th>
									<th>TOTAL AKTIVA LANCAR</th>
									<th class="text-right"><?php
								if($totalawal11 >= 0) echo number_format($totalawal11);
								else{
									echo "<span style='color: red'>(".number_format(substr($totalawal11, 1)).")</span>";
								}
								?></th><?php 
								for($i=0; $i<=$data->range; $i++){ 
									$subtotal11[$i] = array_sum($total11[$i]);
								?>
									<th class="text-right"><?php
								if($subtotal11[$i] >= 0) echo number_format($subtotal11[$i]);
								else{
									echo "<span style='color: red'>(".number_format(substr($subtotal11[$i], 1)).")</span>";
								}
								?></th>
									<?php } ?>
								</tr>
								<tr>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th>&nbsp;</th><?php 
								for($i=0; $i<=$data->range; $i++){ 
								?>
								<th>&nbsp;</th>
								<?php } ?>
								</tr>
								<tr>
									<th>&nbsp;</th>
									<th>AKTIVA TETAP</th>
									<?php for($i=0; $i<=$data->range+1; $i++){ ?>
									<th>&nbsp;</th>
									<?php } ?>
								</tr>
								<?php 
							$no = 0;
							$totalawal12 = 0;
							foreach($data->akun12->result() as $p){
							?>
								<tr>
									<td class="text-center"><?=$p->kode_akun?></td>
									<td><?=$p->nama_akun?></td>
									<td class="text-right"><?php
								if(!$p->nilai) echo "-";
								else{
									if($p->nilai > 0) echo number_format($p->nilai);
									else{
										echo "<span style='color: red'>(".number_format(substr($p->nilai, 1)).")</span>";
									}
									$totalawal12 = $totalawal12 +  $p->nilai;
								}
								?></td><?php 
								for($i=0; $i<=$data->range; $i++){ 
								if(!isset($total12[$i])) $total12[$i] = array();
								?>
									<td class="text-right"><?php
								if(!$data->nilai12[$no][$i]) echo "-";
								else{
									if($data->nilai12[$no][$i] > 0) echo number_format($data->nilai12[$no][$i]);
									else{
										echo "<span style='color: red'>(".number_format(substr($data->nilai12[$no][$i], 1)).")</span>";
									}
								}
								array_push($total12[$i], $data->nilai12[$no][$i]);
								?></td>
									<?php } ?>
								</tr>
								<?php 
								$no++;
							} 
							?>
								<tr>
									<th>&nbsp;</th>
									<th>NILAI BUKU AKTIVA</th>
									<th class="text-right"><?php
								if($totalawal12 >= 0) echo number_format($totalawal12);
								else{
									echo "<span style='color: red'>(".number_format(substr($totalawal12, 1)).")</span>";
								}
								?></th><?php 
								for($i=0; $i<=$data->range; $i++){ 
									$subtotal12[$i] = array_sum($total12[$i]);
								?>
									<th class="text-right"><?php
								if($subtotal12[$i] >= 0) echo number_format($subtotal12[$i]);
								else{
									echo "<span style='color: red'>(".number_format(substr($subtotal12[$i], 1)).")</span>";
								}
								?></th>
									<?php } ?>
								</tr>
								<tr>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th>&nbsp;</th><?php 
								for($i=0; $i<=$data->range; $i++){ 
								?>
								<th>&nbsp;</th>
								<?php } ?>
								</tr>
								<?php 
							$no = 0;
							$totalawal13 = 0;
							foreach($data->akun13->result() as $p){
							?>
								<tr>
									<td class="text-center"><?=$p->kode_akun?></td>
									<td><?=$p->nama_akun?></td>
									<td class="text-right"><?php
								if(!$p->nilai) echo "-";
								else{
									if($p->nilai > 0) echo number_format($p->nilai);
									else{
										echo "<span style='color: red'>(".number_format(substr($p->nilai, 1)).")</span>";
									}
									$totalawal13 = $totalawal13 +  $p->nilai;
								}
								?></td><?php 
								for($i=0; $i<=$data->range; $i++){ 
								if(!isset($total13[$i])) $total13[$i] = array();
								?>
									<td class="text-right"><?php
								if(!$data->nilai13[$no][$i]) echo "-";
								else{
									if($data->nilai13[$no][$i] > 0) echo number_format($data->nilai13[$no][$i]);
									else{
										echo "<span style='color: red'>(".number_format(substr($data->nilai13[$no][$i], 1)).")</span>";
									}
								}
								array_push($total13[$i], $data->nilai13[$no][$i]);
								?></td>
									<?php } ?>
								</tr>
								<?php 
								$no++;
							} 
							?>
								<tr>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th class="text-right"><?php
								if($totalawal13 >= 0) echo number_format($totalawal13);
								else{
									echo "<span style='color: red'>(".number_format(substr($totalawal13, 1)).")</span>";
								}
								?></th><?php 
								for($i=0; $i<=$data->range; $i++){ 
									$subtotal13[$i] = array_sum($total13[$i]);
								?>
									<th class="text-right"><?php
								if($subtotal13[$i] >= 0) echo number_format($subtotal13[$i]);
								else{
									echo "<span style='color: red'>(".number_format(substr($subtotal13[$i], 1)).")</span>";
								}
								?></th>
									<?php } ?>
								</tr>
								<tr>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th>&nbsp;</th><?php 
								for($i=0; $i<=$data->range; $i++){ 
								?>
								<th>&nbsp;</th>
								<?php } ?>
								</tr>
								<tr style="background-color: #dadada">
									<th>&nbsp;</th>
									<th>TOTAL AKTIVA</th>
									<th class="text-right"><?php
								$totalAktiva = $totalawal11 + $totalawal12 + $totalawal13;
								if($totalAktiva >= 0) echo number_format($totalAktiva);
								else{
									echo "<span style='color: red'>(".number_format(substr($totalAktiva, 1)).")</span>";
								}
								?></th><?php
								// $total1 = 0;
								for($i=0; $i<=$data->range; $i++){
									$total11[$i] = array_sum($total11[$i]);
									$total12[$i] = array_sum($total12[$i]);
									$total13[$i] = array_sum($total13[$i]);
									$total1[$i] = $total11[$i] + $total12[$i] + $total13[$i];
								?>
								<th class="text-right"><?php
								if($total1[$i] >= 0) echo number_format($total1[$i]);
								else{
									echo "<span style='color: red'>(".number_format(substr($total1[$i], 1)).")</span>";
								}
								?></th>
								<?php } ?>
								</tr>
								<tr>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th>&nbsp;</th><?php 
								for($i=0; $i<=$data->range; $i++){ 
								?>
								<th>&nbsp;</th>
								<?php } ?>
								</tr>
								<tr>
									<th>&nbsp;</th>
									<th>HUTANG LANCAR</th>
									<?php for($i=0; $i<=$data->range+1; $i++){ ?>
									<th>&nbsp;</th>
									<?php } ?>
								</tr>
								<?php 
							$no = 0;
							$totalawal21 = 0;
							foreach($data->akun21->result() as $p){
							?>
								<tr>
									<td class="text-center"><?=$p->kode_akun?></td>
									<td><?=$p->nama_akun?></td>
									<td class="text-right"><?php
								if(!$p->nilai) echo "-";
								else{
									if($p->nilai > 0) echo number_format($p->nilai);
									else{
										echo "<span style='color: red'>(".number_format(substr($p->nilai, 1)).")</span>";
									}
									$totalawal21 = $totalawal21 +  $p->nilai;
								}
								?></td><?php 
								for($i=0; $i<=$data->range; $i++){ 
								if(!isset($total21[$i])) $total21[$i] = array();
								?>
									<td class="text-right"><?php
								if(!$data->nilai21[$no][$i]) echo "-";
								else{
									if($data->nilai21[$no][$i] > 0) echo number_format($data->nilai21[$no][$i]);
									else{
										echo "<span style='color: red'>(".number_format(substr($data->nilai21[$no][$i], 1)).")</span>";
									}
								}
								array_push($total21[$i], $data->nilai21[$no][$i]);
								?></td>
									<?php } ?>
								</tr>
								<?php 
								$no++;
							} 
							?>
								<tr>
									<th>&nbsp;</th>
									<th>TOTAL HUTANG LANCAR</th>
									<th class="text-right"><?php
								if($totalawal21 >= 0) echo number_format($totalawal21);
								else{
									echo "<span style='color: red'>(".number_format(substr($totalawal21, 1)).")</span>";
								}
								?></th><?php 
								for($i=0; $i<=$data->range; $i++){ 
									$subtotal21[$i] = array_sum($total21[$i]);
								?>
									<th class="text-right"><?php
								if($subtotal21[$i] >= 0) echo number_format($subtotal21[$i]);
								else{
									echo "<span style='color: red'>(".number_format(substr($subtotal21[$i], 1)).")</span>";
								}
								?></th>
									<?php } ?>
								</tr>
								<tr>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th>&nbsp;</th><?php 
								for($i=0; $i<=$data->range; $i++){ 
								?>
								<th>&nbsp;</th>
								<?php } ?>
								</tr>
								<?php 
							$no = 0;
							$totalawal22 = 0;
							foreach($data->akun22->result() as $p){
							?>
								<tr>
									<td class="text-center"><?=$p->kode_akun?></td>
									<td><?=$p->nama_akun?></td>
									<td class="text-right"><?php
								if(!$p->nilai) echo "-";
								else{
									if($p->nilai > 0) echo number_format($p->nilai);
									else{
										echo "<span style='color: red'>(".number_format(substr($p->nilai, 1)).")</span>";
									}
									$totalawal22 = $totalawal22 +  $p->nilai;
								}
								?></td><?php 
								for($i=0; $i<=$data->range; $i++){ 
								if(!isset($total22[$i])) $total22[$i] = array();
								?>
									<td class="text-right"><?php
								if(!$data->nilai22[$no][$i]) echo "-";
								else{
									if($data->nilai22[$no][$i] > 0) echo number_format($data->nilai22[$no][$i]);
									else{
										echo "<span style='color: red'>(".number_format(substr($data->nilai22[$no][$i], 1)).")</span>";
									}
								}
								array_push($total22[$i], $data->nilai22[$no][$i]);
								?></td>
									<?php } ?>
								</tr>
								<?php 
								$no++;
							} 
							?>
								<tr>
									<th>&nbsp;</th>
									<th>TOTAL HUTANG BANK</th>
									<th class="text-right"><?php
								if($totalawal22 >= 0) echo number_format($totalawal22);
								else{
									echo "<span style='color: red'>(".number_format(substr($totalawal22, 1)).")</span>";
								}
								?></th><?php 
								for($i=0; $i<=$data->range; $i++){ 
									$subtotal22[$i] = array_sum($total22[$i]);
								?>
									<th class="text-right"><?php
								if($subtotal22[$i] >= 0) echo number_format($subtotal22[$i]);
								else{
									echo "<span style='color: red'>(".number_format(substr($subtotal22[$i], 1)).")</span>";
								}
								?></th>
									<?php } ?>
								</tr>
								<tr>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th>&nbsp;</th><?php 
								for($i=0; $i<=$data->range; $i++){ 
								?>
								<th>&nbsp;</th>
								<?php } ?>
								</tr>
								<?php 
							$no = 0;
							$totalawal3 = 0;
							foreach($data->akun3->result() as $p){
							?>
								<tr>
									<td class="text-center"><?=$p->kode_akun?></td>
									<td><?=$p->nama_akun?></td>
									<td class="text-right"><?php
								if(!$p->nilai) echo "-";
								else{
									if($p->nilai > 0) echo number_format($p->nilai);
									else{
										echo "<span style='color: red'>(".number_format(substr($p->nilai, 1)).")</span>";
									}
									$totalawal3 = $totalawal3 +  $p->nilai;
								}
								?></td><?php 
								for($i=0; $i<=$data->range; $i++){ 
								if(!isset($total3[$i])) $total3[$i] = array();
								?>
									<td class="text-right"><?php
								if(!$data->nilai3[$no][$i]) echo "-";
								else{
									if($data->nilai3[$no][$i] > 0) echo number_format($data->nilai3[$no][$i]);
									else{
										echo "<span style='color: red'>(".number_format(substr($data->nilai3[$no][$i], 1)).")</span>";
									}
								}
								array_push($total3[$i], $data->nilai3[$no][$i]);
								?></td>
									<?php } ?>
								</tr>
								<?php 
								$no++;
							} 
							?>
								<tr>
									<th>&nbsp;</th>
									<th>MODAL BERSIH</th>
									<th class="text-right"><?php
								if($totalawal3 >= 0) echo number_format($totalawal3);
								else{
									echo "<span style='color: red'>(".number_format(substr($totalawal3, 1)).")</span>";
								}
								?></th><?php 
								for($i=0; $i<=$data->range; $i++){ 
									$subtotal3[$i] = array_sum($total3[$i]);
								?>
									<th class="text-right"><?php
								if($subtotal3[$i] >= 0) echo number_format($subtotal3[$i]);
								else{
									echo "<span style='color: red'>(".number_format(substr($subtotal3[$i], 1)).")</span>";
								}
								?></th>
									<?php } ?>
								</tr>
								<tr>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th>&nbsp;</th><?php 
								for($i=0; $i<=$data->range; $i++){ 
								?>
								<th>&nbsp;</th>
								<?php } ?>
								</tr>
								<tr style="background-color: #dadada">
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th class="text-right"><?php
								$totalHm = $totalawal21 + $totalawal22 + $totalawal3;
								if($totalHm >= 0) echo number_format($totalHm);
								else{
									echo "<span style='color: red'>(".number_format(substr($totalHm, 1)).")</span>";
								}
								?></th><?php
								// $total1 = 0;
								for($i=0; $i<=$data->range; $i++){
									$total21[$i] = array_sum($total21[$i]);
									$total22[$i] = array_sum($total22[$i]);
									$total3[$i] = array_sum($total3[$i]);
									$total2[$i] = $total21[$i] + $total22[$i] + $total3[$i];
								?>
								<th class="text-right"><?php
								if($total2[$i] >= 0) echo number_format($total2[$i]);
								else{
									echo "<span style='color: red'>(".number_format(substr($total2[$i], 1)).")</span>";
								}
								?></th>
								<?php } ?>
								</tr>
							</tbody>
						</table>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
