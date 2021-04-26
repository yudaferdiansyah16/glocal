<main id="js-page-content" role="main" class="page-content">
	<?=generateBreadcrumb($this->lang->line('breadcrumb_add'))?>
	<div class="subheader">
		<h1 class="subheader-title">
			<?=$this->lang->line('title_add')?>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?= base_url('setting/module/store') ?>" autocomplete="off">
						<div class="form-group row">
							<label class="col-form-label form-label col-md-2"><?=$this->lang->line('label_nama_modul_module')?></label>
							<div class="col-md-5">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><?=$this->lang->line('label_nama_modul_in_module')?></span>
									</div>
									<input type="text" class="form-control form-control-sm input-mask" name="nama_modul_id" value="" placeholder="Name" required />
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-5 offset-md-2">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><?=$this->lang->line('label_nama_modul_en_module')?></span>
									</div>
									<input type="text" class="form-control form-control-sm input-mask" name="nama_modul_en" value="" placeholder="Name" required />
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-5 offset-md-2">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><?=$this->lang->line('label_nama_modul_cn_module')?></span>
									</div>
									<input type="text" class="form-control form-control-sm input-mask" name="nama_modul_cn" value="" placeholder="Name"/>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-5 offset-md-2">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><?=$this->lang->line('label_nama_modul_kr_module')?></span>
									</div>
									<input type="text" class="form-control form-control-sm" name="nama_modul_kr" value="" placeholder="Name"/>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-5 offset-md-2">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><?=$this->lang->line('label_nama_modul_jp_module')?></span>
									</div>
									<input type="text" class="form-control form-control-sm input-mask" name="nama_modul_jp" value="" placeholder="Name"/>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-5 offset-md-2">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><?=$this->lang->line('label_nama_modul_fr_module')?></span>
									</div>
									<input type="text" class="form-control form-control-sm input-mask" name="nama_modul_fr" value="" placeholder="Name"/>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-5 offset-md-2">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<span class="input-group-text"><?=$this->lang->line('label_nama_modul_gr_module')?></span>
									</div>
									<input type="text" class="form-control form-control-sm input-mask" name="nama_modul_gr" value="" placeholder="Name"/>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label form-label col-md-2"><?=$this->lang->line('label_induk_module')?></label>
							<div class="col-md-5">
								<select class="form-control form-control-sm select2" name="id_modul_parent">
									<option value="0">Main Module</option>
									<?php foreach ($modules as $item): ?>
										<option value="<?=$item->id_modul?>"><?=str_pad("-", $item->depth-1, "----", STR_PAD_LEFT).$item->nama_modul_en?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label form-label col-md-2"><?=$this->lang->line('label_tag_module')?></label>
							<div class="col-md-3">
								<input type="text" class="form-control form-control-sm input-mask" name="tag" value="" placeholder="Tag" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label form-label col-md-2"><?=$this->lang->line('label_url_module')?></label>
							<div class="col-md-6">
								<input type="text" class="form-control form-control-sm input-mask" name="url" value="" placeholder="Url" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label form-label col-md-2"><?=$this->lang->line('label_icon_module')?></label>
							<div class="col-md-2">
								<input type="text" class="form-control form-control-sm" name="icon_class" value="" placeholder="Icon" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label form-label col-md-2"><?=$this->lang->line('label_status_module')?></label>
							<div class="col-md-10">
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" name="id_status" class="custom-control-input" value="1" id="defaultInline1Radio">
									<label class="custom-control-label" for="defaultInline1Radio"><?=$this->lang->line('label_aktif_module')?></label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" name="id_status" class="custom-control-input" value="0" id="defaultInline2Radio">
									<label class="custom-control-label" for="defaultInline2Radio"><?=$this->lang->line('label_tidak_aktif_module')?></label>
								</div>
							</div>
						</div>
						<hr>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
							<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?> </a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
