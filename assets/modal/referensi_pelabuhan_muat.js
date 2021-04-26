let oTable_referensi_pelabuhan_muat;

$(document).ready(function(){
	let t = 'referensi_pelabuhan_muat';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"referensi/pelabuhan/viewdt/false",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "KODE_PELABUHAN" },
			{ "data": "KODE_KANTOR" },
			{ "data": "URAIAN_PELABUHAN" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_referensi_pelabuhan_muat = $('#dt_'+t).DataTable(opts);

	dtFilterOnEnter(oTable_referensi_pelabuhan_muat, t);
	listenKeyInput(oTable_referensi_pelabuhan_muat, t);

	oTable_referensi_pelabuhan_muat.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_referensi_pelabuhan_muat, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_referensi_pelabuhan_muat, this);
	});
});
