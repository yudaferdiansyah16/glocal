<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">SMARTONE</a></li>
		<li class="breadcrumb-item">Procurement</li>
		<li class="breadcrumb-item">Purchase Requesition</li>
		<li class="breadcrumb-item active"><?=$this->lang->line('button_cancel')?></li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			<?=$this->lang->line('button_cancel')?> Purchase Requesition
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<button type="button" onclick="confirmDialog(this)" data-header="Confirm <?=$this->lang->line('button_cancel')?>" data-body="Do you want to approve this transaction?" data-url="<?=base_url('procurement/closing_pr/approve/')?>" class="btn btn-sm btn-primary"><i class="fal fa fa-check-circle"></i> <?=$this->lang->line('button_cancel')?> PR</button>
					<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-arrow-circle-left"></i> Back</a>
				</div>
				<div class="card-body">
					<dl class="row">
						<dt class="col-md-2">Nomor PP</dt>
						<dd class="col-md-10">: <?=$ppheader->kode_pp?></dd>
						<dt class="col-md-2">Date</dt>
						<dd class="col-md-10">: <?=$ppheader->tanggal_dibuat?></dd>
						<dt class="col-md-2">Due Date</dt>
						<dd class="col-md-10">: <?=$ppheader->tanggal_dibutuhkan?></dd>
						<dt class="col-md-2">Bagian</dt>
						<dd class="col-md-10">: <?=$ppheader->nama_bagian?></dd>
						<dt class="col-md-2">Jenis PP</dt>
						<dd class="col-md-10">: <?=$ppheader->nama_jenis_pp?></dd>
						<dt class="col-md-2">Jenis PP Rutinitas</dt>
						<dd class="col-md-10">: <?=$ppheader->nama_jenis_pp_rutinitas?></dd>
					</dl>
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid">
							<thead>
							<tr>
								<th>No</th>
								<th>Job</th>
								<th>Nama Barang</th>
								<th>Dimension</th>
								<th>Size</th>
								<th>Brand</th>
								<th>Colour</th>
								<th>Specification</th>
								<th>Style</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Remark</th>
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
