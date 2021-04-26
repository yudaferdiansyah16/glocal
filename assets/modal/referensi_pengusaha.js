let oTable_referensi_pengusaha;

$(document).ready(function(){
	let t = 'referensi_pengusaha';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"referensi/pengusaha/viewdt/false",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "NAMA" },
			{ "data": "ALAMAT" },
			{ "data": "KODE_ID" },
			{ "data": "NOMOR_SKEP" },
			{ "data": "NPWP" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_referensi_pengusaha = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_referensi_pengusaha, t);
	listenKeyInput(oTable_referensi_pengusaha, t);

	oTable_referensi_pengusaha.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_referensi_pengusaha, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_referensi_pengusaha, this);
	});
});
