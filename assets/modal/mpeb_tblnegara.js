let oTable_tblnegara;

$(document).ready(function(){
	let t = 'tblnegara';

	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"exim/transaksi_doc_out/viewnegara/false",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "KdEdi" },
			{ "data": "UrEdi" },
			{ "data": "Region" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_tblnegara = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_tblnegara, t);
	listenKeyInput(oTable_tblnegara, t);

	oTable_tblnegara.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_tblnegara, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_tblnegara, this);
	});
});
