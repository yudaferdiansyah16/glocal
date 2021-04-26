<main id="js-page-content" role="main" class="page-content">
	<?=generateBreadcrumb($this->lang->line('breadcrumb_edit'))?>
	<div class="subheader">
		<h1 class="subheader-title">
			<?=$this->lang->line('title_edit')?>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?= base_url('setting/module/update') ?>" autocomplete="off">
						<input type="hidden" name="id_modul" value="<?= placeValue($data, 'id_modul') ?>">
						<div class="form-group row">
							<label class="col-form-label form-label col-md-2"><?=$this->lang->line('label_nama_modul_module')?></label>
							<div class="col-md-5">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><?=$this->lang->line('label_nama_modul_in_module')?></span>
									</div>
									<input type="text" class="form-control form-control-sm input-mask" name="nama_modul_id" value="<?= placeValue($data, 'nama_modul_id') ?>" placeholder="Name" required />
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-5 offset-md-2">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><?=$this->lang->line('label_nama_modul_en_module')?></span>
									</div>
									<input type="text" class="form-control form-control-sm input-mask" name="nama_modul_en" value="<?= placeValue($data, 'nama_modul_en') ?>" placeholder="Name" required />
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-5 offset-md-2">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><?=$this->lang->line('label_nama_modul_cn_module')?></span>
									</div>
									<input type="text" class="form-control form-control-sm input-mask" name="nama_modul_cn" value="<?= placeValue($data, 'nama_modul_cn') ?>" placeholder="Name" />
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-5 offset-md-2">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><?=$this->lang->line('label_nama_modul_kr_module')?></span>
									</div>
									<input type="text" class="form-control form-control-sm input-mask" name="nama_modul_kr" value="<?= placeValue($data, 'nama_modul_kr') ?>" placeholder="Name" />
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-5 offset-md-2">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><?=$this->lang->line('label_nama_modul_jp_module')?></span>
									</div>
									<input type="text" class="form-control form-control-sm input-mask" name="nama_modul_jp" value="<?= placeValue($data, 'nama_modul_jp') ?>" placeholder="Name" />
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-5 offset-md-2">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><?=$this->lang->line('label_nama_modul_fr_module')?></span>
									</div>
									<input type="text" class="form-control form-control-sm input-mask" name="nama_modul_fr" value="<?= placeValue($data, 'nama_modul_fr') ?>" placeholder="Name" />
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-5 offset-md-2">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><?=$this->lang->line('label_nama_modul_gr_module')?></span>
									</div>
									<input type="text" class="form-control form-control-sm input-mask" name="nama_modul_gr" value="<?= placeValue($data, 'nama_modul_gr') ?>" placeholder="Name" />
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label form-label col-md-2"><?=$this->lang->line('label_induk_module')?></label>
							<div class="col-md-5">
								<select class="form-control form-control-sm select2" name="id_modul_parent">
									<option value="0" <?=($data->id_modul_parent == '0' ? 'selected' : '')?>>Main Module</option>
									<?php foreach ($modules as $item): ?>
									<option value="<?=$item->id_modul?>" <?=($data->id_modul_parent == $item->id_modul ? 'selected' : '')?>><?=str_pad("-", $item->depth-1, "----", STR_PAD_LEFT).$item->nama_modul_en?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label form-label col-md-2"><?=$this->lang->line('label_tag_module')?></label>
							<div class="col-md-3">
								<input type="text" class="form-control form-control-sm input-mask" name="tag" value="<?= placeValue($data, 'tag') ?>" placeholder="Tag" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label form-label col-md-2"><?=$this->lang->line('label_url_module')?></label>
							<div class="col-md-6">
								<input type="text" class="form-control form-control-sm input-mask" name="url" value="<?= placeValue($data, 'url') ?>" placeholder="Url" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label form-label col-md-2"><?=$this->lang->line('label_icon_module')?></label>
							<div class="col-md-2">
								<input type="text" class="form-control form-control-sm" name="icon_class" value="<?= placeValue($data, 'icon_class') ?>" placeholder="Icon" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label form-label col-md-2"><?=$this->lang->line('label_status_module')?></label>
							<div class="col-md-10">
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" name="id_status" class="custom-control-input" value="1" id="defaultInline1Radio" <?=($data->id_status == '1' ? 'checked' : '')?>>
									<label class="custom-control-label" for="defaultInline1Radio"><?=$this->lang->line('label_aktif_module')?></label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" name="id_status" class="custom-control-input" value="0" id="defaultInline2Radio" <?=($data->id_status == '0' ? 'checked' : '')?>>
									<label class="custom-control-label" for="defaultInline2Radio"><?=$this->lang->line('label_tidak_aktif_module')?></label>
								</div>
							</div>
						</div>
						<hr>
						<div class="form-group row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
								<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?> </a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
