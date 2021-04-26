<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		
		<li class="breadcrumb-item">Master</li>
		<li class="breadcrumb-item">Warehouse</li>
		<li class="breadcrumb-item"><?=$m_gudang->nama_gudang?></li>
		<li class="breadcrumb-item">Coordinate</li>
		<li class="breadcrumb-item active">Edit</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Edit Coordinat <small><?=$m_gudang->nama_gudang?></small>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-6 col-lg-6 col-xl-6">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('master/gudang/koordinat_update')?>">
						<input type="hidden" name="id_koordinat" value="<?=$m_koordinat->id_koordinat?>">
						<input type="hidden" name="id_gudang" value="<?=$m_gudang->id_gudang?>">
						<div class="form-group">
							<label class="form-label">Coordinate Name</label>
							<input type="text" name="nama_koordinat" class="form-control form-control-sm" placeholder="" value="<?=$m_koordinat->nama_koordinat?>" required>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
							<a href="<?=base_url('master/gudang/koordinat/'.$m_gudang->id_gudang)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
