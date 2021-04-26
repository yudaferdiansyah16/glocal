<main id="js-page-content" role="main" class="page-content">
	<?=generateBreadcrumb($this->lang->line('breadcrumb_add'))?>
	<div class="subheader">
		<h1 class="subheader-title">
			<?=$this->lang->line('title_add')?>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('master/konversi/store')?>">
						<div class="form-group">
							<label class="form-label"><?=$this->lang->line('label_barang_konversi')?></label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control form-control-sm x-readonly nama_barang" readonly placeholder="Select barang..." required>
								<input type="hidden" name="id_sub_barang"/>
								<div class="input-group-append">
									<button type="button" class="btn btn-default" data-toggle="modal" data-target="#m_sub_barang_modal"><i class="fal fa-search"></i></button>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="form-label">
								<?=$this->lang->line('label_unit_terkecil_konversi')?>
							</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-readonly nama_satuan" name="" readonly value="<?=isset($data) ? $data->nama_satuan_kecil : ''?>" required>
								<input type="hidden" name="id_satuan_terkecil" class="id_satuan" value="<?=isset($data) ? $data->id_satuan_terkecil : ''?>"/>
								<div class="input-group-append">
									<button type="button" class="btn btn-default btn-search-satuan" data-toggle="modal" data-target="#referensi_satuan_modal"><i class="fal fa-search"></i></button>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="form-label">
								<?=$this->lang->line('label_unit_terbesar_konversi')?>
							</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control form-control-sm x-readonly nama_satuan" readonly value="<?=isset($data) ? $data->nama_satuan_besar : ''?>" required>
								<input type="hidden" name="id_satuan_terbesar" class="id_satuan" value="<?=isset($data) ? $data->id_satuan_terbesar : ''?>"/>
								<div class="input-group-append">
									<button type="button" class="btn btn-default btn-search-satuan" data-toggle="modal" data-target="#referensi_satuan_modal"><i class="fal fa-search"></i></button>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="form-label"><?=$this->lang->line('label_hasil_konversi')?></label>
							<input type="text" name="hasil" class="form-control" placeholder="" value="<?=isset($hasil)? $hasil: '';?>">
						</div>
						<div class="form-group">
							<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
