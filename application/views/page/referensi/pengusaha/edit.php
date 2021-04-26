<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">

		<li class="breadcrumb-item">Referensi</li>
		<li class="breadcrumb-item">Supplier</li>
		<li class="breadcrumb-item active">Edit</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Edit New Supplier
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('referensi/pengusaha/update')?>">
						<input type="hidden" name="ID" value="<?=isset($data) ? $data->ID : ''?>">thrynh
						<div class="form-group row">
							<div class="col-md-12">
								<label class="form-label">Address</label>
								<input type="text" name="ALAMAT" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->ALAMAT : ''?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Contact Person</label>
								<input type="text" name="CONTACT_PERSON" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->CONTACT_PERSON : ''?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Email</label>
								<input type="text" name="EMAIL" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->EMAIL : ''?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Fax</label>
								<input type="text" name="FAX" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->FAX : ''?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">ID Card</label>
								<input type="text" name="ID_PENGENAL" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->ID_PENGENAL : ''?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Tipe TPB</label>
								<input type="text" name="JENISTPB" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->JENISTPB : ''?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Kode ID</label>
								<input type="text" name="KODE_ID" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->KODE_ID : ''?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Kode Kantor</label>
								<input type="text" name="KODE_KANTOR" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->KODE_KANTOR : ''?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Nama</label>
								<input type="text" name="NAMA" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->NAMA : ''?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">No Pengenal</label>
								<input type="text" name="NOMOR_PENGENAL" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->NOMOR_PENGENAL : ''?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">No SKEP</label>
								<input type="text" name="NOMOR_SKEP" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->NOMOR_SKEP : ''?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">NPWP</label>
								<input type="text" name="NPWP" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->NPWP : ''?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Status Importir</label>
								<input type="text" name="STATUS_IMPORTIR" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->STATUS_IMPORTIR : ''?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Tanggal SKEP</label>
								<input type="text" name="TANGGAL_SKEP" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->TANGGAL_SKEP : ''?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Telepon</label>
								<input type="text" name="TELEPON" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->TELEPON : ''?>">
							</div>
						</div>
						<div class="form-group">
							<a href="<?=base_url('referensi/pengusaha')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
