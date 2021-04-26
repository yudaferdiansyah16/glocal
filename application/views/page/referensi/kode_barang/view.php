<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		
		<li class="breadcrumb-item">Referensi</li>
		<li class="breadcrumb-item active">Kode Barang</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Referensi Kode Barang
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<a href="<?=base_url('referensi/kode_barang/add')?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> <?=$this->lang->line('button_add')?></a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped table-sm" id="dt" >
							<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Code</th>
								<th class="text-center">Brand</th>
								<th class="text-center">NOHS</th>
								<th class="text-center">Specification</th>
								<th class="text-center">Type</th>
								<th class="text-center">Description</th>
								<th class="text-center">Option</th>
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

