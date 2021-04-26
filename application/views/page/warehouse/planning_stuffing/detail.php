<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">SMARTONE</a></li>
		<li class="breadcrumb-item">Warehouse</li>
		<li class="breadcrumb-item">Planning Stuffing</li>
		<li class="breadcrumb-item active">Detail</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Detail Planning Stuffing
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<a href="<?=base_url('warehouse/planning_stuffing/approval1/'.$planning_stuffing->id_stuffing)?>" class="btn btn-sm btn-primary"><i class="fal fa fa-check-circle"></i> Approve 1</a>
					<a href="<?=base_url('warehouse/planning_stuffing/approval2/'.$planning_stuffing->id_stuffing)?>" class="btn btn-sm btn-primary"><i class="fal fa fa-check-circle"></i> Approve 2</a>
					<a href="<?=base_url('warehouse/planning_stuffing/disapprove/'.$planning_stuffing->id_stuffing)?>" class="btn btn-sm btn-secondary"><i class="fal fa fa-circle"></i> Disapprove</a>
					<a href="<?=base_url('warehouse/planning_stuffing/cancel/'.$planning_stuffing->id_stuffing)?>" class="btn btn-sm btn-danger"><i class="fal fa fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
					<a href="<?=base_url('warehouse/planning_stuffing/closing/'.$planning_stuffing->id_stuffing)?>" class="btn btn-sm btn-warning"><i class="fal fa fa-minus-circle"></i> Closing</a>
					<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-info align-rigt"><i class="fal fa-times-circle"></i> Back</a>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-2">
							<p><b>Material Request Code</b></p>
							<p><b>No Job</b></p>
						</div>
						<div class="col-md-2">
							<p>: <?=$planning_stuffing->kode_pp?></p>
							<p>: <?=$planning_stuffing->no_job?></p>
						</div>
						<div class="col-md-2">
							<p><b>SI Code</b></p>
							<p><b>SO Code</b></p>
						</div>
						<div class="col-md-2">
							<p>: <?=$planning_stuffing->no_job?></p>
							<p>: <?=$planning_stuffing->kode_po?></p>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid">
							<thead>
							<tr>
								<th>No</th>
								<th>Item Code</th>
								<th>Description</th>
								<th>Qty Satuan</th>
								<th>Packaging</th>
								<th>Qty Packaging</th>
								<th>Bruto</th>
								<th>Netto</th>
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
</main>
<script>
	let idpp = <?=$idpp?>;
</script>
