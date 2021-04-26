let oTable_tblpelln;

$(document).ready(function(){
	let t = 'tblpelln';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl + "exim/transaksi_doc_out/viewpelln/false",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "KdEdi" },
			{ "data": "UrEdi" }
		],
		sorting : [[1, 'asc']],
	});
	oTable_tblpelln = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_tblpelln, t);
	listenKeyInput(oTable_tblpelln, t);

	oTable_tblpelln.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_tblpelln, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_tblpelln, this);
	});
});
