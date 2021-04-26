<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">DPS</a></li>
		<li class="breadcrumb-item">Exim</li>
		<li class="breadcrumb-item">Purchase Return</li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Detail Purchase Return
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
                    <?php if ($return->approval_2 == 1) { ?>
                        <button type="button" disabled class="btn btn-primary btn-sm btn-pills waves-effect waves-themed">
                            <i class="fa fal fa-check"></i> Approved 2
                        </button>
                    <?php } else if ($return->approval_1 == 1) { ?>
                        <button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
                            <i class="fa fal fa-check"></i> Approved 1
                        </button>
                        <button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
                            <i class="fa fal fa-hourglass-start"></i> Waiting for Approve 2
                        </button>
                    <?php } else if ($return->approval_1 == 0) { ?>
                        <button type="button" disabled class="btn btn-warning btn-sm btn-pills waves-effect waves-themed">
                            <i class="fa fal fa-hourglass-start"></i> Waiting for Approve 1
                        </button>
                    <?php } ?>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-2">
							<p><b>Return Code</b></p>
							<p><b>Date</b></p>
						</div>
						<div class="col-md-2">
							<p>: <?=$return->kode_return?></p>
							<p>: <?=date('d-m-Y',strtotime($return->tanggal_return))?></p>
						</div>
						<div class="col-md-2">
							<p><b>Receive Code</b></p>
							<p><b>Date</b></p>
							<p><b>Supplier</b></p>
						</div>
						<div class="col-md-2">
							<p>: <?=$return->kode_dn?></p>
							<p>: <?=date('d-m-Y',strtotime($return->tgl_kedatangan))?></p>
							<p>: <?=$return->nama_supplier?></p>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" width="99%">
							<thead>
								<tr>
									<th class="text-center" width="5%">No</th>
									<th class="text-center" width="25%">Item</th>
									<th class="text-center" width="10%">Quantity</th>
									<th class="text-center" width="60%">Remark</th>
								</tr>
							</thead>
							<tbody>
                                <?php $return->detail = a2o(json_decode(sterilizeJSON($return->detail))); $i=1; foreach ($return->detail as $row) { ?>
                                    <tr>
                                        <td class="text-center"><?=$i?></td>
                                        <td class="text-left">
                                            <p style="margin:0;padding:0;"><?=$row->nama_barang?></p>
                                            <small style="margin:0;padding:0;"><?=$row->kode_barang?></small>
                                        </td>
                                        <td class="text-right">
                                            <p><?=$row->quantity?> [ <?=$row->satuan?> ]</p>
                                        </td>
                                        <td class="text-left"><?=$row->keterangan?></td>
                                    </tr>
                                <?php $i++; } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer">
					<?php if ($return->approval_1 == 0) { ?>
						<a href="<?=base_url('exim/purchase_return/approval1/'.$return->id_return)?>" class="btn btn-sm btn-success"><i class="fal fa fa-check-circle"></i> Approve 1</a>
					<?php }?>
					<?php if ($return->approval_1 == 1 && $return->approval_2 == 0) { ?>
						<a href="<?=base_url('exim/purchase_return/disapprove1/'.$return->id_return)?>" class="btn btn-sm btn-secondary"><i class="fal fa fa-circle"></i> Disapprove 1</a>
						<a href="<?=base_url('exim/purchase_return/approval2/'.$return->id_return)?>" class="btn btn-sm btn-primary"><i class="fal fa fa-check-circle"></i> Approve 2</a>
					<?php }?>
					<?php if ($return->approval_2 == 1) { ?>
						<a href="<?=base_url('exim/purchase_return/disapprove2/'.$return->id_return)?>" class="btn btn-sm btn-secondary"><i class="fal fa fa-circle"></i> Disapprove 2</a>
					<?php }?>
					<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-info align-rigt"><i class="fal fa-times-circle"></i> Back</a>
				</div>
			</div>
		</div>
	</div>
</main>
<script>
    let idpp = <?=$idpp?>;
</script>
