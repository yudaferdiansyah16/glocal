let oTable_tblkapal;

$(document).ready(function(){
	let t = 'tblkapal';
	let attach = t + '_' + asal_modal;

	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"exim/transaksi_doc_out/viewkapal/false",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "AngkutNama" },
        ],
		sorting : [[1, 'asc']],
	});
	oTable_tblkapal = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_tblkapal, t);
	listenKeyInput(oTable_tblkapal, t);

	oTable_tblkapal.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_tblkapal, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_tblkapal, this);
	});
});
