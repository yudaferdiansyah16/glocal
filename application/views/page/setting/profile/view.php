<main id="js-page-content" role="main" class="page-content">
	<?=generateBreadcrumb($this->lang->line('breadcrumb_view'))?>
	<div class="subheader">
		<h1 class="subheader-title">
			<?=$this->lang->line('title_edit')?>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<form method="post" action="<?=base_url('setting/profile/update')?>">
						<input type="hidden" name="id_user" value="<?=placeValue($data,'id_user')?>">
						<div class="form-group row">
							<div class="col-md-5">
								<label class="form-label"><?=$this->lang->line('label_nama_profile')?></label>
								<input type="text" class="form-control form-control-sm input-mask" name="nama" placeholder="Name"  value="<?=$m_user->nama?>" required/>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-5">
								<label class="form-label"><?=$this->lang->line('label_pengguna_profile')?></label>
								<input type="text" class="form-control form-control-sm input-mask" name="username" placeholder="Username" value="<?=$m_user->username?>" required>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-5">
								<label class="form-label"><?=$this->lang->line('label_email_profile')?></label>
								<input type="text" class="form-control form-control-sm input-mask" name="email" placeholder="Email" value="<?=$m_user->email?>" required>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-5">
								<label class="form-label"><?=$this->lang->line('label_ganti_sandi_profile')?></label>
								<input type="password" id="password" name="passwd" class="form-control" placeholder="Change Your Password" value="">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-5">
								<label class="form-label"><?=$this->lang->line('label_ganti_foto_profil_profile')?></label>
								<div class="input-group">
									<div class="custom-file">
										<input type="file" name="photo_file" size="20" class="custom-file-input" id="photo_file" aria-describedby="inputGroupFileAddon01" value="upload">
										<label class="custom-file-label" for="photo_file">Choose file</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-5">
								<label class="form-label"><?=$this->lang->line('label_ganti_bahasa_profile')?></label>
								<select class="form-control form-control-sm select2" name="lang_code" required>
									<option value="" disabled selected>Select Language . . .</option>
									<option value="indonesia" <?=($m_user->lang_code == 'indonesia' ? 'selected' : '')?>>Indonesia</option>
									<option value="english" <?=($m_user->lang_code == 'english' ? 'selected' : '')?>>English</option>
									<option value="simplified-chinese" <?=($m_user->lang_code == 'simplified-chinese' ? 'selected' : '')?>>China</option>
									<option value="korean" <?=($m_user->lang_code == 'korean' ? 'selected' : '')?>>Korea</option>
									<option value="jp" <?=($m_user->lang_code == 'jp' ? 'selected' : '')?>>Japan</option>
									<option value="french" <?=($m_user->lang_code == 'french' ? 'selected' : '')?>>France</option>
									<option value="german" <?=($m_user->lang_code == 'german' ? 'selected' : '')?>>Germany</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
								<a href="<?=base_url('setting/profile')?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?></a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
</table>
