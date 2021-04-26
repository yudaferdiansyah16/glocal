let oTable_referensi_satuan;

$(document).ready(function(){
	let t = 'referensi_satuan';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"referensi/satuan/viewdt/false",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "KODE_SATUAN" },
			{ "data": "URAIAN_SATUAN" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_referensi_satuan = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_referensi_satuan, t);
	listenKeyInput(oTable_referensi_satuan, t);

	oTable_referensi_satuan.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_referensi_satuan, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_referensi_satuan, this);
	});
});
