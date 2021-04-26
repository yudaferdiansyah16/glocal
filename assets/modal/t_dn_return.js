let oTable_t_dn_return;

$(document).ready(function(){
	let t = 't_dn_return';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		"ajax": {
			url: _baseurl+"exim/purchase_return/viewreturndt",
			type: "POST",
		},
		"columns": [
			{ data: "no", searchable: false, orderable: false, className: 'text-center' },
			{ data: "kode_dn", className: 'text-center' },
			{ data: "tgl_kedatangan", className: 'text-center' },
			{ data: "nama_supplier" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_t_dn_return = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_t_dn_return, t);
	listenKeyInput(oTable_t_dn_return, t);

	oTable_t_dn_return.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_t_dn_return, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_t_dn_return, this);
	});
});

