<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">

		<li class="breadcrumb-item">Referensi</li>
		<li class="breadcrumb-item">Kode Barang</li>
		<li class="breadcrumb-item active">Edit</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Edit New Kode Barang
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('referensi/kode_barang/update')?>">
						<input type="hidden" name="ID" value="<?=isset($data) ? $data->ID : ''?>">
						<div class="form-group">
							<label class="form-label">Code</label>
							<input type="text" name="kode_barang" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->KODE_BARANG: '';?>">
						</div>
						<div class="form-group">
							<label class="form-label">Brand</label>
							<input type="text" name="merk" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->MERK : '';?>">
						</div>
						<div class="form-group">
							<label class="form-label">NOHSS</label>
							<input type="text" name="nohs" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->NOHS: '';?>">
						</div>
						<div class="form-group">
							<label class="form-label">Specification</label>
							<input type="text" name="spesifikasi_lain" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->SPESIFIKASI_LAIN: '';?>">
						</div>
						<div class="form-group">
							<label class="form-label">Type</label>
							<input type="text" name="tipe" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->TIPE: '';?>">
						</div>
						<div class="form-group">
							<label class="form-label">Description</label>
							<input type="text" name="uraian_barang" class=" form-control  form-control-sm" placeholder="" value="<?=isset($data)? $data->URAIAN_BARANG :'';?>">
						</div>
						<div class="form-group">
							<a href="<?=base_url('referensi/kode_barang')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
