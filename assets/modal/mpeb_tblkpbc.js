let oTable_tblkpbc;

$(document).ready(function(){
	let t = 'tblkpbc';
	let attach = t + '_' + asal_modal;

	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"exim/transaksi_doc_out/viewkpbc/false",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "Kdkpbc" },
			{ "data": "UrKdkpbc" },
			{ "data": "Kota" },
			{ "data": "Eselon2" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_tblkpbc = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_tblkpbc, t);
	listenKeyInput(oTable_tblkpbc, t);

	oTable_tblkpbc.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_tblkpbc, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_tblkpbc, this);
	});
});
