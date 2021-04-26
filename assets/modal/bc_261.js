let oTable_bc_261;

$(document).ready(function(){
	let t = 'bc_261';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"exim/transaksi_doc_in/view261",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "NOMOR_AJU" },
			{ "data": "TANGGAL_AJU" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_bc_261 = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_bc_261, t);
	listenKeyInput(oTable_bc_261, t);

	oTable_bc_261.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_bc_261, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_bc_261, this);
	});
});
