let arrdata_t_bom_detail_job = [];
let oTable_t_bom_detail_job;

$(document).ready(function(){
	let t = 't_bom_detail_job';
	let opts = $.extend({}, DataTableOptionsModal, {
		ajax: {
			url: _baseurl+"master/bom_detail/viewjobdt/false",
			type: "POST",
			"data": function(data){
				let id_bom = $('.id_bom').val();
				if (id_bom != '') data.id_bom = id_bom;
				return data;
			}
		},
		columns: [
			{ data: "no", searchable: false, orderable: false, className: 'text-center'},
			{ data: "blank", searchable: false, orderable: false, className: 'x-check-cell text-center' },
			{ data: "kode_bom" },
			{ data: "tanggal_bom", className: 'text-center' },
			{ data: "nama_workflow", className: 'text-center' },
			{ data: "kode_barang", className: 'text-center' },
			{ data: "nama_sub_barang" },
			{ data: "kode_satuan", className: 'text-center' },
			{ data: "qty_total", className: 'text-right' },
			{ data: "qty_sisa_bom", className: 'text-right' }
		],
		sorting : [[2, 'asc']],
		createdRow: function( row, data, dataIndex ) {
			renderCheck(arrdata_t_bom_detail_job, 'id_bom_detail', data.id_bom_detail, row, 1, dataIndex);
		},
		drawCallback: function(){
			$('.x-check-input').off().on('click', function(){
				let parent = $(this).closest('tr');
				let data = oTable_t_bom_detail_job.row(parent).data();
				arrdata_t_bom_detail_job = selectRow(arrdata_t_bom_detail_job, parent, data, 'id_bom_detail');
			});
		}
	});
	oTable_t_bom_detail_job = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_t_bom_detail_job, t);
	listenShownModal(oTable_t_bom_detail_job, t);
	listenAttach('btn-attach', arrdata_t_bom_detail_job, t, attachData);

	$('#dt_'+t+' tbody').on( 'click', 'tr', function (e) {
		let data = dataCheckSelectedOnRow(this, oTable_t_bom_detail_job);
		arrdata_t_bom_detail_job = selectArray(arrdata_t_bom_detail_job, data, 'id_bom_detail');
	});
});
