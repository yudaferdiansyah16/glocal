<div class="modal fade modal-fullscreen" id="t_bom_detail_job_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Pick BOM Item</h5>
				<button type="button" class="close" data-dismiss="modal" >&times;</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover table-bordered table-striped table-sm" id="dt_t_bom_detail_job" style="width: 100%;">
						<thead>
						<tr>
							<th rowspan="2">No</th>
							<th rowspan="2"></th>
							<th colspan="4" class="text-center">BOM</th>
							<th colspan="3" class="text-center">Material</th>
							<th colspan="2" class="text-center">Quantity</th>
						</tr>
                        <tr>
                            <th>Number</th>
                            <th>Date</th>
                            <th>Workflow</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Item Unit</th>
                            <th>BOM</th>
                            <th>Remain</th>
                        </tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-primary" id="btn-attach"><i class="fa fal fa-plus-circle"></i> Add Item(s)</button>
			</div>
		</div>
	</div>
</div>
