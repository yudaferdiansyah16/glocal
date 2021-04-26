let arrdata_job_pp = [];
let oTable_t_detail_job_pp;

$(document).ready(function(){
	let  t = 't_detail_job_pp';
	let opts = $.extend({},DataTableOptionsModal, {
		ajax: {
			url: _baseurl+"procurement/purchase_requisition/viewDetailjobPP",
			type: "POST",
		},
		columns: [
			{ data: "no", searchable: false, orderable: false, className: 'text-center' },
			{ data: "blank", searchable: false, orderable: false, className: 'x-check-cell' },
			{ data: "no_job" },
			{ data: "kode_barang" },
			{ data: "nama_barang" },
			{ data: "nama_brand" },
			{ data: "dimensi" },
			{ data: "size" },
			{ data: "qty_sisa" },
			{ data: "keterangan" },
		],
		sorting : [[2, 'asc']],
		createdRow: function( row, data, dataIndex ) {
			renderCheck(arrdata_job_pp, 'id_detail_job', data.id_detail_job, row, 1, dataIndex);
		},
		drawCallback: function(){
			$('.x-check-input').off().on('click', function(){
				let parent = $(this).closest('tr');
				let data = oTable_t_detail_job_pp.row(parent).data();
				arrdata_job_pp = selectRow(arrdata_job_pp, parent, data, 'id_detail_job');
			});
			$.fn.dataTable.tables( { visible: true, api: true } ).columns.adjust();
		}
	});
	oTable_t_detail_job_pp = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_t_detail_job_pp, t);
	listenShownModal(oTable_t_detail_job_pp, t);
	listenAttach('btn-attach', arrdata_job_pp, t, attachData);

	$('#dt_'+t+' tbody').on( 'click', 'tr', function (e) {
		let data = dataCheckSelectedOnRow(this, oTable_t_detail_job_pp);
		arrdata_job_pp = selectArray(arrdata_job_pp, data, 'id_detail_job');
	});
});
