<div class='modal fade modal-fullscreen' id='add_tarif_modal' tabindex='-1' role='dialog' aria-hidden='true'>
	<div class='modal-dialog modal-dialog-centered' role='document'>
		<div class='modal-content'>
			<div class='modal-header'>
				<h5 class='modal-title'>Input Tarif</h5>
				<button type='button' class='close' data-dismiss='modal' >&times;</button>
			</div>
			<div class='modal-body'>
				<div class='row'>
					<div class='col-sm-12 col-lg-12 col-xl-12'>
						<table class='table table-hover table-bordered table-striped table-sm dt_po_add' id="dt_add_tarif" role='grid' style='white-space: nowrap; width: 100%'>
							<thead>
							<tr>
								<th>JENIS PUNGUTAN</th>
								<th>DITANGGUHKAN</th>
								<th>DIBEBASKAN</th>
								<th>TIDAK DIPUNGUT</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>
									<label class='form-label'>BM</label>
								</td>
								<td>
									<input type='text' class='form-control form-control-sm bm_ditangguhkan' id='bm_ditangguhkan'>
								</td>
								<td>
									<input type='text' class='form-control form-control-sm bm_dibebaskan' id='bm_dibebaskan'>
								</td>
								<td>
									<input type='text' class='form-control form-control-sm bm_tidak_dipungut' id='bm_tidak_dipungut'>
								</td>
							</tr>
							<tr>
								<td>
									<label class='form-label'>BMT</label>
								</td>
								<td>
									<input type='text' class='form-control form-control-sm bmt_ditangguhkan' id='bmt_ditangguhkan'>
								</td>
								<td>
									<input type='text' class='form-control form-control-sm bmt_dibebaskan' id='bmt_dibebaskan'>
								</td>
								<td>
									<input type='text' class='form-control form-control-sm bmt_tidak_dipungut' id='bmt_tidak_dipungut'>
								</td>
							</tr>
							<tr>
								<td>
									<label class='form-label'>CUKAI</label>
								</td>
								<td>
									<input type='text' class='form-control form-control-sm cukai_ditangguhkan' id='cukai_ditangguhkan'>
								</td>
								<td>
									<input type='text' class='form-control form-control-sm cukai_dibebaskan' id='cukai_dibebaskan'>
								</td>
								<td>
									<input type='text' class='form-control form-control-sm cukai_tidak_dipungut' id='cukai_tidak_dipungut'>
								</td>
							</tr>
							<tr>
								<td>
									<label class='form-label'>PPN</label>
								</td>
								<td>
									<input type='text' class='form-control form-control-sm ppn_ditangguhkan' id='ppn_ditangguhkan'>
								</td>
								<td>
									<input type='text' class='form-control form-control-sm ppn_dibebaskan' id='ppn_dibebaskan'>
								</td>
								<td>
									<input type='text' class='form-control form-control-sm ppn_tidak_dipungut' id='ppn_tidak_dipungut'>
								</td>
							</tr>
							<tr>
								<td>
									<label class='form-label'>PPNBM</label>
								</td>
								<td>
									<input type='text' class='form-control form-control-sm ppnbm_ditangguhkan' id='ppnbm_ditangguhkan'>
								</td>
								<td>
									<input type='text' class='form-control form-control-sm ppnbm_dibebaskan' id='ppnbm_dibebaskan'>
								</td>
								<td>
									<input type='text' class='form-control form-control-sm ppnbm_tidak_dipungut' id='ppnbm_tidak_dipungut'>
								</td>
							</tr>
							<tr>
								<td>
									<label class='form-label'>PPH</label>
								</td>
								<td>
									<input type='text' class='form-control form-control-sm pph_ditangguhkan' id='pph_ditangguhkan'>
								</td>
								<td>
									<input type='text' class='form-control form-control-sm pph_dibebaskan' id='pph_dibebaskan'>
								</td>
								<td>
									<input type='text' class='form-control form-control-sm pph_tidak_dipungut' id='pph_tidak_dipungut'>
								</td>
							</tr>
							</tbody>
							<tfoot>
							<tr>
								<td colspan='4' class='text-right'>
									<button type='button' class='btn btn-sm btn-primary' id='btn-attach-tarif'><i class='fa fal fa-plus-circle'></i> Set Tarif</button>
								</td>
							</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
			<div class='modal-footer'>

			</div>
		</div>
	</div>
</div>
