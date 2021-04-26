<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item active">HPP</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
		HPP
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<form method="post" action="<?=base_url('finance/hpp/view')?>">
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
								<th class="text-center" width="1%">&nbsp;</th>
								<th class="text-center" width="200px">&nbsp;</th>
								<?php
								$bulan = $data->awal-1;
								for($i=1; $i<=$data->range+1; $i++){ 
									if($bulan==12) $bulan = 1;
									else $bulan = $bulan + 1;	
								?>
								<th class="text-center" width="100px"><?=strtoupper(bln($bulan))?></th>
								<?php } ?>
								<th class="text-center" width="100px">TOTAL</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>116.01.01</td>
								<td>Stock Awal Bahan Baku</td>
								<?php
								$totalAkun16 = 0;
								for($i=0; $i<=$data->range; $i++){ 
									$totalAkun16 = $totalAkun16 + $data->nilai16[$i];
									// array_push($totalBulan, $data->nilai16[$i]);
								?>
								<td class="text-right"><?php
								if(!$data->nilai16[$i]) echo "-";
								else echo number_format($data->nilai16[$i]);
								?></td>
								<?php } ?>
								<td class="text-right"><?=number_format($totalAkun16)?></td>
							</tr>
							<tr>
								<td>116.01.01</td>
								<td>Pembelian</td>
								<?php for($i=0; $i<=$data->range; $i++){ echo "<td class='text-right'>-</td>"; } ?>
								<td class="text-right">0</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>Bahan Tersedia di Jual</td><?php
								$subTotalPB = 0;
								for($i=0; $i<=$data->range; $i++){ 
									$totalPB = 0;
									$totalPB = $data->nilai16[$i] + 0;
									$subTotalPB = $subTotalPB + $totalPB;
									echo "<th class='text-right'>".number_format($totalPB)."</th>"; 
								} 
								?>
								<th class="text-right"><?=number_format($subTotalPB)?></th>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<?php for($i=0; $i<=$data->range+1; $i++){
									echo "<td>&nbsp;</td>";
								}
								?>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>Stock Akhir Bahan Baku</td><?php 
								$no = 0;
								for($i=1; $i<=$data->range+1; $i++){
									$no++; 
								?>
								<td class="text-right"><?php
								if(!$data->nilai16[$i]) echo "-";
								else echo number_format($data->nilai16[$i]);
								?></td>
								<?php 
								}
								$subTotalSA = $data->nilai16[$no];
								?>
								<td class="text-right"><?=number_format($subTotalSA)?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>Pemakaian Bahan Baku</td>
								<?php
								for($i=1; $i<=$data->range+1; $i++){
									if($i==1) $h=0;
									else $h++;
									$pemakaianBB = 0;
									$totalPB = 0;
									$totalPB = $data->nilai16[$h] + 0;
									$pemakaianBB = $totalPB - $data->nilai16[$i];
								?>
								<td class="text-right" style="color: blue;"><?php
								if(!$pemakaianBB) echo "-";
								else echo number_format($pemakaianBB);
								?></td>
								<?php 
								}
								$subTotalPBB =  $subTotalPB - $subTotalSA;
								?>
								<td class="text-right" style="color: blue;"><?=number_format($subTotalPBB)?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<?php for($i=0; $i<=$data->range+1; $i++){
									echo "<td>&nbsp;</td>";
								}
								?>
							</tr>
							<?php 
							$no = 0;
							foreach($data->akun->result() as $p){ 
								$totalBulan[$no] = array();
							?>
							<tr>
								<td><?=$p->kode_akun?></td>
								<td><?=$p->nama_akun?></td>
								<?php
								$totalAkun51 = 0;
								for($i=0; $i<=$data->range; $i++){ 
									$totalAkun51 = $totalAkun51 + $data->nilai51[$no][$i];
									array_push($totalBulan[$no], $data->nilai51[$no][$i]);
								?>
								<td class="text-right"><?php
								if(!$data->nilai51[$no][$i]) echo "-";
								else echo number_format($data->nilai51[$no][$i]);
								?></td>
								<?php } ?>
								<td class="text-right"><?=number_format($totalAkun51)?></td>
							</tr>
							<?php 
								$no++;
							}
							$nox = $no;
							?>
							<tr>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<?php 
								$subTotalBulan = 0;
								for($i=0; $i<=$data->range; $i++){
									$totalBulanx = 0;
									for($j=0; $j<$nox; $j++){ 
										$totalBulanx = $totalBulanx + $totalBulan[$j][$i];
									}
								?>
								<th class="text-right"><?=number_format($totalBulanx)?></th>
								<?php 
									$subTotalBulan = $subTotalBulan + $totalBulanx;
								} 
								?>
								<th class="text-right"><?=number_format($subTotalBulan)?></th>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<?php for($i=0; $i<=$data->range+1; $i++){
									echo "<td>&nbsp;</td>";
								}
								?>
							</tr>
							<tr>
								<th>&nbsp;</th>
								<th>TERSEDIA DI PRODUKSI</th>
								<?php 
								$subTotalBulan = 0;
								$k = 0;
								for($i=0; $i<=$data->range; $i++){
									$totalBulanx = 0;
									$totalTP = 0;
									for($j=0; $j<$nox; $j++){ 
										$totalBulanx = $totalBulanx + $totalBulan[$j][$i];
									}

									$k++;
									if($k==1) $h=0;
									else $h++;
									$pemakaianBB = 0;
									$totalPB = 0;
									$totalPB = $data->nilai16[$h] + 0;
									$pemakaianBB = $totalPB - $data->nilai16[$k];
									$totalTP = $pemakaianBB + $totalBulanx;
								?>
								<th class="text-right" style="color: blue;"><?=number_format($totalTP)?></th>
								<?php 
									$subTotalBulan = $subTotalBulan + $totalBulanx;
								} 
								$subTotalTP = $subTotalPBB + $subTotalBulan;
								?>
								<th class="text-right" style="color: blue;"><?=number_format($subTotalTP)?></th>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<?php for($i=0; $i<=$data->range+1; $i++){
									echo "<td>&nbsp;</td>";
								}
								?>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>WIP Awal</td><?php for($i=0; $i<=$data->range; $i++){ ?>
								<td class="text-right"><?php
								if(!$data->nilaiWip[$i]) echo "-";
								else echo number_format($data->nilaiWip[$i]);
								?></td>
								<?php } ?>
								<td class="text-right"><?=number_format($data->nilaiWip[0])?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>WIP Akhir</td><?php
								$no = 0;
								// print_r($data->nilaiWip);
								for($i=1; $i<=$data->range+1; $i++){
									$no++; 
								?>
								<td class="text-right"><?php
								if(!$data->nilaiWip[$i]) echo "-";
								else echo number_format($data->nilaiWip[$i]);
								?></td><?php 
								}
								$subTotalWipA = $data->nilaiWip[$no];
								?>
								<td class="text-right"><?=number_format($subTotalWipA)?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td><?php
								$no = 0;
								$l = 0;
								for($i=1; $i<=$data->range+1; $i++){
									$no++;
									$totalWipAA = $data->nilaiWip[$l] - $data->nilaiWip[$i];
									$l++;
								?>
								<th class="text-right" style="background-color: pink;"><?php
								if(!$totalWipAA) echo "-";
								else echo number_format($totalWipAA);
								?></th><?php 
								}
								$subTotalWipAA = $data->nilaiWip[0] - $data->nilaiWip[$no];
								?>
								<th class="text-right" style="background-color: pink;"><?=number_format($subTotalWipAA)?></th>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<?php for($i=0; $i<=$data->range+1; $i++){
									echo "<td>&nbsp;</td>";
								}
								?>
							</tr>
							<tr>
								<th>&nbsp;</th>
								<th>TOTAL BIAYA PRODUKSI</th>
								<?php 
								$k = 0;
								$h = 0;
								$no = 0;
								for($i=0; $i<=$data->range; $i++){
									$totalBulanx = 0;
									$totalTP = 0;
									for($j=0; $j<$nox; $j++){ 
										$totalBulanx = $totalBulanx + $totalBulan[$j][$i];
									}
									$k++;


									if($k==1) $h=0;
									else $h++;

									$totalWipAA = $data->nilaiWip[$i] - $data->nilaiWip[$k];
									
									$pemakaianBB = 0;
									$totalPB = 0;
									$totalPB = $data->nilai16[$h] + 0;
									$pemakaianBB = $totalPB - $data->nilai16[$k];
									$totalTP = $pemakaianBB + $totalBulanx;

									$totalTBP = $totalTP + $totalWipAA;
								?>
								<th class="text-right"><?=number_format($totalTBP)?></th>
								<?php 
								}
								$subTotalTBP = $subTotalTP + $subTotalWipAA;
								?>
								<th class="text-right"><?=number_format($subTotalTBP)?></th>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<?php for($i=0; $i<=$data->range+1; $i++){
									echo "<td>&nbsp;</td>";
								}
								?>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>Barang Jadi Awal</td><?php for($i=0; $i<=$data->range; $i++){ ?>
								<td class="text-right"><?php
								if(!$data->nilaiBj[$i]) echo "-";
								else echo number_format($data->nilaiBj[$i]);
								?></td>
								<?php } ?>
								<td class="text-right"><?=number_format($data->nilaiBj[0])?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>Barang Jadi Akhir</td><?php
								$no = 0;
								for($i=1; $i<=$data->range+1; $i++){
									$no++; 
								?>
								<td class="text-right"><?php
								if(!$data->nilaiBj[$i]) echo "-";
								else echo number_format($data->nilaiBj[$i]);
								?></td><?php 
								}
								$subTotalBjA = $data->nilaiBj[$no];
								?>
								<td class="text-right"><?=number_format($subTotalBjA)?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td><?php
								$no = 0;
								$l = 0;
								for($i=1; $i<=$data->range+1; $i++){
									$no++;
									$totalBjAA = $data->nilaiBj[$l] - $data->nilaiBj[$i];
									$l++;
								?>
								<th class="text-right" style="background-color: pink;"><?php
								if(!$totalBjAA) echo "-";
								else echo number_format($totalBjAA);
								?></th><?php 
								}
								$subTotalBjAA = $data->nilaiBj[0] - $data->nilaiBj[$no];
								?>
								<th class="text-right" style="background-color: pink;"><?=number_format($subTotalBjAA)?></th>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<?php for($i=0; $i<=$data->range+1; $i++){
									echo "<td>&nbsp;</td>";
								}
								?>
							</tr>
							<tr>
								<th>&nbsp;</th>
								<th>HARGA POKOK PENJUALAN</th>
								<?php 
								$k = 0;
								$h = 0;
								$no = 0;
								for($i=0; $i<=$data->range; $i++){
									$totalBulanx = 0;
									$totalTP = 0;
									for($j=0; $j<$nox; $j++){ 
										$totalBulanx = $totalBulanx + $totalBulan[$j][$i];
									}
									$k++;


									if($k==1) $h=0;
									else $h++;

									$totalWipAA = $data->nilaiWip[$i] - $data->nilaiWip[$k];
									$totalBjAA = $data->nilaiBj[$i] - $data->nilaiBj[$k];

									
									$pemakaianBB = 0;
									$totalPB = 0;
									$totalPB = $data->nilai16[$h] + 0;
									$pemakaianBB = $totalPB - $data->nilai16[$k];
									$totalTP = $pemakaianBB + $totalBulanx;

									$totalTBP = $totalTP + $totalWipAA;

									$totalhpp = $totalTBP + $totalBjAA;
								?>
								<th class="text-right"><?=number_format($totalhpp)?></th>
								<?php 
								}
								$subTotalTBP = $subTotalTP + $subTotalWipAA;
								$hpp = $subTotalTBP + $subTotalBjAA;
								?>
								<th class="text-right"><?=number_format($hpp)?></th>
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
