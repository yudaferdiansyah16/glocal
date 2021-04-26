<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">SMARTONE</a></li>
		<li class="breadcrumb-item">Master</li>
		<li class="breadcrumb-item">Warehouse</li>
		<li class="breadcrumb-item"><?=$m_gudang->nama_gudang?></li>
		<li class="breadcrumb-item active">Coordinate</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Warehouse Coordinate <small><?=$m_gudang->nama_gudang?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="card mb-g">
				<div class="card-header">
					<a href="<?=base_url('master/gudang/koordinat_add/'.$m_gudang->id_gudang)?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> <?=$this->lang->line('button_add')?></a>
					<a href="<?=base_url('master/gudang')?>" class="btn btn-sm btn-danger"><i class="fal fa fa-times-circle"></i> Back</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<input type="hidden" class="id_gudang" value="<?=$m_gudang->id_gudang?>">
						<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid">
							<thead>
							<tr class="text-center">
								<th style="width: 50px;">No</th>
								<th>Coordinate Name</th>
								<th style="width: 50px;">Status</th>
								<th style="width: 100px;">Option</th>
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
