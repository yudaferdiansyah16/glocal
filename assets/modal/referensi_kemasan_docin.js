let oTable_referensi_kemasan_docin;

$(document).ready(function(){
	let t = 'referensi_kemasan_docin';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"referensi/kemasan/viewdt/false",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "KODE_KEMASAN" },
			{ "data": "URAIAN_KEMASAN" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_referensi_kemasan_docin = $('#dt_'+t).DataTable(opts);

	dtFilterOnEnter(oTable_referensi_kemasan_docin, t);
	listenKeyInput(oTable_referensi_kemasan_docin, t);

	oTable_referensi_kemasan_docin.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_referensi_kemasan_docin, c);
	}).on('dblclick','tr', function(){
		kemasanAttach(t, false, oTable_referensi_kemasan_docin, this);
	});
});
