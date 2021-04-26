<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Finance</li>
		<li class="breadcrumb-item active">Laba Rugi</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">Laba Rugi</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<form method="post" action="<?=base_url('finance/laba_rugi/view')?>">
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
									<th class="text-center" width="100px">
                                    <?php
                                        $nmbulan = strtoupper(bln($bulan));
                                        if($bulan==12) echo $nmbulan."`".$tahun;
                                        else echo $nmbulan;
								    ?>
									</th>
									<?php 
                                        if($bulan==12) $bulan = 1;
                                        else $bulan = $bulan + 1;	
                                        }
                                    ?>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>&nbsp;</th>
									<th>PENDAPATAN</th>
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
									<td class="text-right">
                                    <?php
                                        if(!$p->nilai) echo "-";
                                        else{
                                            if($p->nilai > 0) echo number_format($p->nilai);
                                            else{
                                                echo "<span style='color: red'>(".number_format(substr($p->nilai, 1)).")</span>";
                                            }
                                            $totalawal11 = $totalawal11 +  $p->nilai;
                                        }
                                    ?>
                                    </td>
                                    <?php 
                                        for($i=0; $i<=$data->range; $i++){ 
                                        if(!isset($total11[$i])) $total11[$i] = array();
                                    ?>
									<td class="text-right">
                                    <?php
                                        if(!$data->nilai11[$no][$i]) echo "-";
                                        else{
                                            if($data->nilai11[$no][$i] > 0) echo number_format($data->nilai11[$no][$i]);
                                            else{
                                                echo "<span style='color: red'>(".number_format(substr($data->nilai11[$no][$i], 1)).")</span>";
                                            }
                                        }
                                        array_push($total11[$i], $data->nilai11[$no][$i]);
								    ?>
                                    </td>
									<?php } ?>
								</tr>
								<?php 
                                    $no++;
                                } 
                                ?>
								<tr>
									<th>&nbsp;</th>
									<th>TOTAL PENDAPATAN</th>
									<th class="text-right">
                                    <?php
                                        if($totalawal11 >= 0) echo number_format($totalawal11);
                                        else{
                                            echo "<span style='color: red'>(".number_format(substr($totalawal11, 1)).")</span>";
                                        }
                                    ?>
                                    </th>
                                    <?php 
                                        for($i=0; $i<=$data->range; $i++){ 
                                            $subtotal11[$i] = array_sum($total11[$i]);
                                    ?>
									<th class="text-right">
                                    <?php
                                        if($subtotal11[$i] >= 0) echo number_format($subtotal11[$i]);
                                        else{
                                            echo "<span style='color: red'>(".number_format(substr($subtotal11[$i], 1)).")</span>";
                                        }
                                    ?>
                                    </th>
									<?php } ?>
								</tr>
								<tr>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
                                    <?php for($i=0; $i<=$data->range; $i++){ ?>
                                    <th>&nbsp;</th>
                                    <?php } ?>
								</tr>
								<tr>
									<th>&nbsp;</th>
									<th>BIAYA DAN BEBAN</th>
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
									<td class="text-right">
                                    <?php
                                        if(!$p->nilai) echo "-";
                                        else{
                                            if($p->nilai > 0) echo number_format($p->nilai);
                                            else{
                                                echo "<span style='color: red'>(".number_format(substr($p->nilai, 1)).")</span>";
                                            }
                                            $totalawal12 = $totalawal12 +  $p->nilai;
                                        }
                                    ?>
                                    </td>
                                    <?php 
                                        for($i=0; $i<=$data->range; $i++){ 
                                        if(!isset($total12[$i])) $total12[$i] = array();
                                    ?>
									<td class="text-right">
                                    <?php
                                        if(!$data->nilai12[$no][$i]) echo "-";
                                        else{
                                            if($data->nilai12[$no][$i] > 0) echo number_format($data->nilai12[$no][$i]);
                                            else{
                                                echo "<span style='color: red'>(".number_format(substr($data->nilai12[$no][$i], 1)).")</span>";
                                            }
                                        }
                                        array_push($total12[$i], $data->nilai12[$no][$i]);
                                    ?>
                                    </td>
									<?php } ?>
								</tr>
								<?php 
                                        $no++;
                                    } 
                                ?>
								<tr>
									<th>&nbsp;</th>
									<th>TOTAL BIAYA DAN BEBAN</th>
									<th class="text-right">
                                    <?php
                                        if($totalawal12 >= 0) echo number_format($totalawal12);
                                        else{
                                            echo "<span style='color: red'>(".number_format(substr($totalawal12, 1)).")</span>";
                                        }
                                    ?>
                                    </th>
                                    <?php 
                                        for($i=0; $i<=$data->range; $i++){ 
                                            $subtotal12[$i] = array_sum($total12[$i]);
                                    ?>
									<th class="text-right">
                                    <?php
                                        if($subtotal12[$i] >= 0) echo number_format($subtotal12[$i]);
                                        else{
                                            echo "<span style='color: red'>(".number_format(substr($subtotal12[$i], 1)).")</span>";
                                        }
                                    ?>
                                    </th>
									<?php } ?>
								</tr>
                                <tr>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
                                <tr>
								<tr style="background-color: #dadada">
									<th>&nbsp;</th>
									<th>LABA BERSIH</th>
									<th class="text-right">
                                    <?php
                                        $totalAktiva = $totalawal11 - $totalawal12;
                                        if($totalAktiva >= 0) echo number_format($totalAktiva);
                                        else{
                                            echo "<span style='color: red'>(".number_format(substr($totalAktiva, 1)).")</span>";
                                        }
                                    ?>
                                    </th>
                                    <?php
                                        // $total1 = 0;
                                        for($i=0; $i<=$data->range; $i++){
                                            $total11[$i] = array_sum($total11[$i]);
                                            $total12[$i] = array_sum($total12[$i]);
                                            $total1[$i] = $total11[$i] - $total12[$i];
                                    ?>
								    <th class="text-right"><?php
                                        if($total1[$i] >= 0) echo number_format($total1[$i]);
                                        else{
                                            echo "<span style='color: red'>(".number_format(substr($total1[$i], 1)).")</span>";
                                        }
                                    ?>
                                    </th>
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