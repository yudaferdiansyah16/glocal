let oTable_tbljenisekspor;

$(document).ready(function(){
	let t = 'tbljenisekspor';
	let attach = t + '_' + asal_modal;

	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"exim/transaksi_doc_out/viewjenisekspor/false",
			type: "POST",
		},
		columns: [
			{ "data": "No", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "Uraian" },
        ],
		sorting : [[1, 'asc']],
	});
	oTable_tbljenisekspor = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_tbljenisekspor, t);
	listenKeyInput(oTable_tbljenisekspor, t);

	oTable_tbljenisekspor.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_tbljenisekspor, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_tbljenisekspor, this);
	});
});
