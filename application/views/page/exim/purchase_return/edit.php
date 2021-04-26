<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);">DPS</a></li>
		<li class="breadcrumb-item">Exim</li>
		<li class="breadcrumb-item">Purchase Return</li>
		<li class="breadcrumb-item active">Edit</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Edit Purchase Return
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-body">
					<div class="row">
						<div class="col-md-2">
							<p><b>Return Code</b></p>
							<p><b>Date</b></p>
						</div>
						<div class="col-md-2">
							<p>: <?=$return->kode_return?></p>
							<p>: <?=date('d-m-Y',strtotime($return->tanggal_return))?></p>
						</div>
						<div class="col-md-2">
							<p><b>Receive Code</b></p>
							<p><b>Date</b></p>
							<p><b>Supplier</b></p>
						</div>
						<div class="col-md-2">
							<p>: <?=$return->kode_dn?></p>
							<p>: <?=date('d-m-Y',strtotime($return->tgl_kedatangan))?></p>
							<p>: <?=$return->nama_supplier?></p>
						</div>
                    </div>
                    <form method="post" action="<?=base_url('exim/purchase_return/update')?>">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid" width="99%">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center" width="25%">Item</th>
                                        <th class="text-center" width="10%">Quantity</th>
                                        <th class="text-center" width="60%">Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $return->detail = a2o(json_decode(sterilizeJSON($return->detail))); $i=1; foreach ($return->detail as $row) { ?>
                                        <tr>
                                            <td class="text-center"><?=$i?></td>
                                            <td class="text-left">
                                                <p style="margin:0;padding:0;"><?=$row->nama_barang?></p>
                                                <small style="margin:0;padding:0;"><?=$row->kode_barang?></small>
                                            </td>
                                            <td class="text-right">
                                            <input type="number" class="form-control form-control-sm input_mask" data-inputmask="'alias': 'currency', 'prefix': ''" min="0" step="0.01" max="<?=$row->qty_dn?>" name="t_return_detail[<?=$i?>][qty]" value="<?=$row->quantity?>"/>
                                                <input type="hidden" class="form-control form-control-sm" name="t_return_detail[<?=$i?>][id_return_detail]" value="<?=$row->id_return_detail?>">
                                            </td>
                                            <td class="text-left">
                                                <input type="text" class="form-control form-control-sm" name="t_return_detail[<?=$i?>][keterangan]" value="<?=$row->keterangan?>">
                                                
                                            </td>
                                        </tr>
                                    <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
							<button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Save</button>
							<a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Cancel</a>
						</div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</main>
<script>
    let idpp = <?=$idpp?>;
</script>
