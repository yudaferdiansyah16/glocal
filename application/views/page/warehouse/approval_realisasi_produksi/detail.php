<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">SMARTONE</a></li>
		<li class="breadcrumb-item">Warehouse</li>
		<li class="breadcrumb-item active">Realization Production Approval</li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Realization Production Approval
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
                    <?php if ($realisasi->flag_closing == 1) { ?>
						<button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Closed
						</button>
					<?php } else if ($realisasi->approval_2 == 1) { ?>
						<button type="button" disabled class="btn btn-primary btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 2
						</button>
					<?php } else if ($realisasi->approval_1 == 1) { ?>
						<button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 1
						</button>
					<?php } else if ($realisasi->approval_1 == 0) { ?>
						<button type="button" disabled class="btn btn-default btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass"></i> Ready
						</button>
					<?php } ?>
                </div>
				<div class="card-body">
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                        <dl class="row">
                            <dt class="col-sm-12 col-lg-1 col-xl-1">No.</dt>
                            <dd class="col-sm-12 col-lg-5 col-xl-5">
                                <input type="text" class="form-control form-control-sm" value="<?=$realisasi->kode_mutasi?>" disabled>
                            </dd>
                            <dt class="col-sm-12 col-lg-1 col-xl-1">No. Job</dt>
                            <dd class="col-sm-12 col-lg-5 col-xl-5">
                                <input type="text" class="form-control form-control-sm" value="<?=$realisasi->no_job?>" disabled>
                            </dd>
                            <dt class="col-sm-12 col-lg-1 col-xl-1">Date</dt>
                            <dd class="col-sm-12 col-lg-5 col-xl-5">
                                <input type="text" class="form-control form-control-sm" value="<?=reverseDate($realisasi->tanggal_mutasi)?>" disabled>
                            </dd>
                        </dl>
                    </div>
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                        <dl class="row">
                            <dt class="col-sm-12 col-lg-1 col-xl-1">Customer</dt>
                            <dd class="col-sm-12 col-lg-5 col-xl-5">
                                <input type="text" class="form-control form-control-sm" value="<?=$realisasi->customer?>" disabled>
                            </dd>
                            <dt class="col-sm-12 col-lg-1 col-xl-1">No. PO</dt>
                            <dd class="col-sm-12 col-lg-5 col-xl-5">
                                <input type="text" class="form-control form-control-sm" value="<?=$realisasi->kode_po?>" disabled>
                            </dd>
                            <dt class="col-sm-12 col-lg-1 col-xl-1">FG</dt>
                            <dd class="col-sm-12 col-lg-5 col-xl-5">
                                <input type="text" class="form-control form-control-sm" value="<?=$realisasi->nama_barang?>" disabled>
                            </dd>
                            <dt class="col-sm-12 col-lg-1 col-xl-1">Qty Order</dt>
                            <dd class="col-sm-12 col-lg-5 col-xl-5">
                                <input type="text" class="form-control form-control-sm" value="<?=$realisasi->qty_po?>" disabled>
                            </dd>
                        </dl>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab_material" role="tab" aria-controls="tab_material" aria-selected="true">Material</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab_fg" role="tab" aria-controls="tab_fg" aria-selected="false">FG</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#tab_wip" role="tab" aria-controls="tab_wip" aria-selected="false">WIP</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab_scrap" role="tab" aria-controls="tab_scrap" aria-selected="false">SCRAP</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab_waste" role="tab" aria-controls="tab_waste" aria-selected="false">Waste</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#tab_return" role="tab" aria-controls="tab_return" aria-selected="false">Return</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#tab_loss" role="tab" aria-controls="tab_loss" aria-selected="false">Loss</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="tab_material" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row" style="margin-top: 15px;">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="dt_material" class="table table-sm table-bordered table-striped table-hover" width="100%">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th rowspan="2">No.</th>
                                                                    <th rowspan="2">No Request / Bon Bahan</th>
                                                                    <th rowspan="2">No Job</th>
                                                                    <th colspan="3">Barang</th>
                                                                </tr>
                                                                <tr class="text-center">
                                                                    <th>Nama</th>
                                                                    <th>Satuan</th>
                                                                    <th>Realisasi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_fg" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="row" style="margin-top: 15px;">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="dt_fg" class="table table-sm table-bordered table-striped table-hover" width="100%">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th rowspan="2">No.</th>
                                                                    <th colspan="5">Barang</th>
                                                                </tr>
                                                                <tr class="text-center">
                                                                    <th>Nama</th>
                                                                    <th>Kode</th>
                                                                    <th>Satuan</th>
                                                                    <th>Result</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_wip" role="tabpanel" aria-labelledby="contact-tab">
                                            <div class="row" style="margin-top: 15px;">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="dt_wip" class="table table-sm table-bordered table-striped table-hover" width="100%">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th rowspan="2">No.</th>
                                                                    <th rowspan="2">No Request / Bon Bahan</th>
                                                                    <th rowspan="2">No Job</th>
                                                                    <th colspan="3">Barang</th>
                                                                </tr>
                                                                <tr class="text-center">
                                                                    <th>Nama</th>
                                                                    <th>Satuan</th>
                                                                    <th>Realisasi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_scrap" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="row" style="margin-top: 15px;">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="dt_scrap" class="table table-sm table-bordered table-striped table-hover" width="100%">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th rowspan="2">No.</th>
                                                                    <th rowspan="2">No Request / Bon Bahan</th>
                                                                    <th colspan="3">Barang</th>
                                                                </tr>
                                                                <tr class="text-center">
                                                                    <th>Nama</th>
                                                                    <th>Satuan</th>
                                                                    <th>Realisasi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_waste" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="row" style="margin-top: 15px;">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="dt_waste" class="table table-sm table-bordered table-striped table-hover" width="100%">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th rowspan="2">No.</th>
                                                                    <th rowspan="2">No Request / Bon Bahan</th>
                                                                    <th colspan="4">Barang</th>
                                                                </tr>
                                                                <tr class="text-center">
                                                                    <th>Nama</th>
                                                                    <th>Satuan</th>
                                                                    <th>Realisasi</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_return" role="tabpanel" aria-labelledby="contact-tab">
                                            <div class="row" style="margin-top: 15px;">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="dt_return" class="table table-sm table-bordered table-striped table-hover" width="100%">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th rowspan="2">No.</th>
                                                                    <th rowspan="2">No Request / Bon Bahan</th>
                                                                    <th colspan="3">Barang</th>
                                                                </tr>
                                                                <tr class="text-center">
                                                                    <th>Nama</th>
                                                                    <th>Satuan</th>
                                                                    <th>Return</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_loss" role="tabpanel" aria-labelledby="contact-tab">
                                            <div class="row" style="margin-top: 15px;">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="dt_loss" class="table table-sm table-bordered table-striped table-hover" width="100%">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th rowspan="2">No.</th>
                                                                    <th rowspan="2">No Request / Bon Bahan</th>
                                                                    <th colspan="3">Barang</th>
                                                                </tr>
                                                                <tr class="text-center">
                                                                    <th>Nama</th>
                                                                    <th>Satuan</th>
                                                                    <th>QTY</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="card-footer">
                    <?php if ($realisasi->approval_2 == 0 && $realisasi->flag_btl == 0 && $realisasi->flag_closing == 0) { ?>
						<a href="<?=base_url('warehouse/approval_realisasi_produksi/approval2/?id_p='.$realisasi->id_production .'&'.'no_job='. $realisasi->no_job .'&'.'id_wh=' .$reqheader->id_wh)?>" class="btn btn-sm btn-primary"><i class="fal fa fa-check-circle"></i> Approve 2</a>
					<?php }?>   
                    <?php if ($realisasi->flag_closing == 0 && $realisasi->approval_2 == 1 && $realisasi->flag_btl == 0) { ?>
						<a href="<?=base_url('warehouse/approval_realisasi_produksi/disapprove/'.$realisasi->id_production)?>" class="btn btn-sm btn-secondary"><i class="fal fa fa-minus-circle"></i> disapprove2</a>
					<?php }?>
                    <?php if ($realisasi->flag_closing == 0 && $realisasi->approval_2 == 1 && $realisasi->flag_btl == 0) { ?>
						<a href="<?=base_url('warehouse/approval_realisasi_produksi/closing/'.$realisasi->id_production)?>" class="btn btn-sm btn-warning"><i class="fal fa fa-minus-circle"></i> Closing</a>
					<?php }?>
					<a href="<?=base_url('warehouse/approval_realisasi_produksi')?>" class="btn btn-sm btn-info align-rigt"><i class="fal fa-times-circle"></i> Back</a>
				</div>
			</div>
		</div>
	</div>
</main>
<script>
	let id_realisasi = <?=$idrealisasi?>;
</script>
