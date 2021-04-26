let oTable_tblpeldn;

$(document).ready(function(){
	let t = 'tblpeldn';

	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"exim/transaksi_doc_out/viewpeldn/false",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "KDEDI" },
			{ "data": "UREDI" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_tblpeldn = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_tblpeldn, t);
	listenKeyInput(oTable_tblpeldn, t);

	oTable_tblpeldn.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_tblpeldn, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_tblpeldn, this);
	});
});
