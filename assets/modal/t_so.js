let oTable_t_so;

$(document).ready(function(){
	let t = 't_so';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"sales/sales_order/viewdt",
			type: "POST",
			"data": function(data){
				data.is_approved = $('.is_approved').val();
				return data;
			}
		},
		columns: [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "kode_po", className: 'text-center' },
			{ data: "tanggal_dibuat", className: 'text-center', "render": function ( data, type, row, meta ) {
					return moment(data).format('DD-MM-YYYY');
				}},
			{ data: "nama_supplier" },
			{ data: "amount", className: 'text-right' },
			{ data: "status_approve", className: 'text-center', searchable: false, sortable: false },
		],
		sorting : [[1, 'asc']],
	});
	oTable_t_so = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_t_so, t);
	listenKeyInput(oTable_t_so, t);

	oTable_t_so.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_t_so, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_t_so, this);
	});
});
