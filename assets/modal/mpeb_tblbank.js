let oTable_tblbank;

$(document).ready(function(){
	let t = 'tblbank';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"exim/transaksi_doc_out/viewbank/false",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "KdBank" },
			{ "data": "NmBank" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_tblbank = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_tblbank, t);
	listenKeyInput(oTable_tblbank, t);

	oTable_tblbank.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_tblbank, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_tblbank, this);
	});
});
