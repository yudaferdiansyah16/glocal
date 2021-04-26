let oTable_referensi_dokumen_pabean;

$(document).ready(function(){
	let t = 'referensi_dokumen_pabean';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"referensi/dokumen_pabean/viewdt/false",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "KODE_DOKUMEN_PABEAN" },
			{ "data": "URAIAN_DOKUMEN_PABEAN" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_referensi_dokumen_pabean = $('#dt_'+t).DataTable(opts);

	dtFilterOnEnter(oTable_referensi_dokumen_pabean, t);
	listenKeyInput(oTable_referensi_dokumen_pabean, t);

	oTable_referensi_dokumen_pabean.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_referensi_dokumen_pabean, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_referensi_dokumen_pabean, this);
	});
});
