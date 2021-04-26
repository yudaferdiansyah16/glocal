	let oTable_referensi_dokumen;

$(document).ready(function(){
	let t = 'referensi_dokumen';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"referensi/dokumen/viewdt/false",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "KODE_DOKUMEN" },
			{ "data": "TIPE_DOKUMEN" },
			{ "data": "URAIAN_DOKUMEN" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_referensi_dokumen = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_referensi_dokumen, t);
	listenKeyInput(oTable_referensi_dokumen, t);

	oTable_referensi_dokumen.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_referensi_dokumen, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_referensi_dokumen, this);
	});
});
