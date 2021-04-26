let oTable_referensi_negara;

$(document).ready(function(){
	let t = 'referensi_negara';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"referensi/negara/viewdt/false",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "KODE_NEGARA" },
			{ "data": "URAIAN_NEGARA" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_referensi_negara = $('#dt_'+t).DataTable(opts);

	dtFilterOnEnter(oTable_referensi_negara, t);
	listenKeyInput(oTable_referensi_negara, t);

	oTable_referensi_negara.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_referensi_negara, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_referensi_negara, this);
	});
});
