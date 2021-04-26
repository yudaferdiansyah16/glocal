let oTable_tblkategoriekspor;

$(document).ready(function(){
	let t = 'tblkategoriekspor';
	let attach = t + '_' + asal_modal;

	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"exim/transaksi_doc_out/viewkategoriekspor/false",
			type: "POST",
		},
		columns: [
			{ "data": "No", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "Uraian" },
        ],
		sorting : [[1, 'asc']],
	});
	oTable_tblkategoriekspor = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_tblkategoriekspor, t);
	listenKeyInput(oTable_tblkategoriekspor, t);

	oTable_tblkategoriekspor.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_tblkategoriekspor, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_tblkategoriekspor, this);
	});
});
