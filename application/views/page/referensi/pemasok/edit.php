<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">

		<li class="breadcrumb-item">Referensi</li>
		<li class="breadcrumb-item">Customer</li>
		<li class="breadcrumb-item active">Edit</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Edit New Customer
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('referensi/pemasok/update')?>">
						<input type="hidden" name="ID" value="<?=isset($data) ? $data->ID : ''?>">
						<div class="form-group">
							<label class="form-label">Address</label>
							<input type="text" name="ALAMAT" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->ALAMAT: '';?>">
						</div>
						<div class="form-group">
							<label class="form-label">Code</label>
							<input type="text" name="KODE_ID" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->KODE_ID : '';?>">
						</div>
						<div class="form-group">
							<label class="form-label">Country Code</label>
							<input type="text" name="KODE_NEGARA" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->KODE_NEGARA: '';?>">
						</div>
						<div class="form-group">
							<label class="form-label">Name</label>
							<input type="text" name="NAMA" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->NAMA: '';?>">
						</div>
						<div class="form-group">
							<label class="form-label">NPWP</label>
							<input type="text" name="NPWP" class="form-control" placeholder="" value="<?=isset($data)? $data->NPWP: '';?>">
						</div>
						<div class="form-group">
							<a href="<?=base_url('referensi/pemasok')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
