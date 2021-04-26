<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Warehouse</li>
		<li class="breadcrumb-item">Request Material</li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Detail Request Material <small><?=$t_request->kode_request?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<?php if ($t_request->approval_2 == 1) { ?>
						<button type="button" disabled class="btn btn-primary btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 2
						</button>
					<?php } else if ($t_request->approval_1 == 1) { ?>
						<button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-check"></i> Approved 1
						</button>
					<?php } else if ($t_request->approval_1 == 0) { ?>
						<button type="button" disabled class="btn btn-default btn-sm btn-pills waves-effect waves-themed">
							<i class="fa fal fa-hourglass"></i> Ready
						</button>
					<?php } ?>
				</div>
				<div class="card-body">
					<dl class="row">
						<dt class="col-sm-2">Transaction Number</dt>
						<dd class="col-sm-9"><?= $t_request->kode_request ?></dd>
						<dt class="col-sm-2">Request Date</dt>
						<dd class="col-sm-9"><?= date('d-m-Y', strtotime($t_request->tgl_request)) ?></dd>
						<dt class="col-sm-2">Request Type</dt>
						<dd class="col-sm-9"><?= $t_request->nama_jenis_mutasi ?></dd>
						<dt class="col-sm-2">Created at</dt>
						<dd class="col-sm-9"><?= date('d-m-Y H:i', strtotime($t_request->created_at)) ?> by <em><?=$t_request->nama_user_created?></em></dd>
						<dt class="col-sm-2">Last Updated at</dt>
						<dd class="col-sm-9"><?= date('d-m-Y H:i', strtotime($t_request->created_at)) ?> by <em><?=$t_request->nama_user_updated?></em></dd>
					</dl>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid">
									<thead class="table-secondary">
									<tr class="text-center align-middle">
										<th width="20px" class="align-middle">No</th>
										<th class="align-middle">Item</th>
										<th class="align-middle" style="width: 150px;">Size</th>
										<th class="align-middle">Quantity</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach($t_request_detail as $i => $detail): ?>
										<tr>
											<td class="text-center"><?=($i+1)?></td>
											<td>
												<?=$detail->nama_barang?><br>
												<small><?=$detail->kode_barang?></small>
											</td>
											<td class="text-center"><?=$detail->size?></td>
											<td class="text-right">
												<?=number_format($detail->qty_request, 2)?><br>
												<small><?=$detail->kode_satuan?></small>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<label class="form-label">Request Note</label>
							<textarea class="form-control-plaintext"><?=$t_request->deskripsi?></textarea>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="row">
						<div class="col-md-12">
							<?php if($t_request->approval_2 == 0): ?>
								<form class="form-inline" style="float:left; margin-left: 5px;" method="post" action="<?= base_url($_controller.'/'.$_method.'/'.($t_request->approval_1 == 0 ? 'approve1' : 'unapprove1')) ?>">
									<input type="hidden" name="id_request" value="<?=$t_request->id_request?>">
									<?php if($t_request->approval_1 == 0): ?>
										<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-check-circle"></i> Approve 1
										</button>
									<?php else: ?>
										<button type="submit" class="btn btn-sm btn-secondary"><i class="fal fa fa-circle"></i> Disapprove 1
										</button>
									<?php endif; ?>
								</form>
							<?php endif; ?>
							<?php if($t_request->approval_1 == 1): ?>
								<form class="form-inline" style="float:left; margin-left: 5px;" method="post" action="<?= base_url($_controller.'/'.$_method.'/'.($t_request->approval_2 == 0 ? 'approve2' : 'unapprove2')) ?>">
									<input type="hidden" name="id_request" value="<?=$t_request->id_request?>">
									<?php if($t_request->approval_2 == 0): ?>
										<button type="submit" class="btn btn-sm btn-primary"><i class="fal fa fa-check-circle"></i> Approve 2
										</button>
									<?php else: ?>
										<button type="submit" class="btn btn-sm btn-secondary"><i class="fal fa fa-circle"></i> Disapprove 2
										</button>
									<?php endif; ?>
								</form>
							<?php endif; ?>
							<a href="<?=base_url($_controller.'/'.$_method)?>" style="margin-left: 5px;" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Back</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<script>
	let id_production = <?=$reqheader->id_production?>;
</script>
