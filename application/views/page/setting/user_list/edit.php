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
					<form method="post" action="<?=base_url('setting/user_list/update')?>">
						<input type="hidden" name="id_user" value="<?=placeValue($data,'id_user')?>">
						<div class="form-group row">
							<div class="col-md-3">
								<label class="form-label"><?=$this->lang->line('label_nama_user_list')?></label>
								<input type="text" class="form-control form-control-sm input-mask" name="nama" placeholder="Name"  value="<?=placeValue($data,'nama')?>" required>
							</div>
							<div class="col-md-2">
								<label class="form-label"><?=$this->lang->line('label_pengguna_user_list')?></label>
								<input type="text" class="form-control form-control-sm" name="username" placeholder="Username" value="<?=placeValue($data,'username')?>" required>
							</div>
							<div class="col-md-3">
								<label class="form-label"><?=$this->lang->line('label_email_user_list')?></label>
								<input type="text" class="form-control form-control-sm" name="email" placeholder="example@email.com" value="<?=placeValue($data,'email')?>" required>
							</div>
							<div class="col-md-2">
								<label class="form-label"><?=$this->lang->line('label_ganti_sandi_user_list')?></label>
								<input type="password" id="password" name="passwd" class="form-control" placeholder="Change Password" required>
							</div>
							<div class="col-md-2">
								<label class="form-label"><?=$this->lang->line('label_role_user_list')?></label>
								<select class="form-control form-control-sm select2" name="id_priv">
									<option value="<?=placeValue($data,'id_priv')?>)?>" disabled selected>Select Privilage . . .</option required>
									<?=createOption($priv, 'id_priv', array('nama_priv'), ' - ')?>
								</select>
							</div>

						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> <?=$this->lang->line('button_save')?></button>
							<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> <?=$this->lang->line('button_cancel')?> 	</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
<table class="x-hidden" id="template-row-rutin">
	<tbody>
	<tr data-index="x">
		<td class="text-center">1</td>
		<td>
			<p id="no_job"></p>
			<!--			<input type="text" class="form-control form-control-sm x-readonly no_job" readonly placeholder=""/>-->
			<input type="hidden" class="id_detail_job" name="t_detail_pp[x][id_detail_job]">
			<input type="hidden" class="id_sub_barang" name="t_detail_pp[x][id_sub_barang]">
		</td>
		<td>
			<p id="nama_barang" style="margin: 0;padding: 0"></p>
			<small id="kode_barang" style="margin: 0;padding: 0"></small>
			<!--			<input type="text" class="form-control form-control-sm x-readonly nama_barang" readonly placeholder=""/>-->
		</td>
		<td>
			<input type="number" class="form-control form-control-sm qty_pp" name="t_detail_pp[x][qty_pp]" step="0.001" min="0" max=""/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm keterangan" name="t_detail_pp[x][keterangan]" placeholder=""/>
		</td>
		<td class="text-center">
			<button type="button" class="btn btn-xs btn-danger btn-delete"><i class="fa fal fa-trash"></i></button>
		</td>
	</tr>
	</tbody>
</table>
<table class="x-hidden" id="template-row-non">
	<tbody>
	<tr data-index="x">
		<td class="text-center">1</td>
		<td>
			<input type="text" class="form-control form-control-sm x-readonly nama_barang" readonly placeholder=""/>
			<input type="hidden" class="id_sub_barang" name="t_detail_pp[x][id_sub_barang]">
		</td>
		<td>
			<input type="text" class="form-control form-control-sm x-readonly nama_brand" readonly placeholder=""/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm x-readonly dimensi" readonly placeholder=""/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm x-readonly size" readonly placeholder=""/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm x-readonly colour" readonly placeholder=""/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm x-readonly style" readonly placeholder=""/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm qty_pp" name="t_detail_pp[x][qty_pp]" placeholder=""/>
		</td>
		<td>
			<input type="text" class="form-control form-control-sm keterangan" name="t_detail_pp[x][keterangan]" placeholder=""/>
		</td>
		<td class="text-center">
			<button type="button" class="btn btn-xs btn-danger btn-delete"><i class="fa fal fa-trash"></i></button>
		</td>
	</tr>
	</tbody>
</table>
