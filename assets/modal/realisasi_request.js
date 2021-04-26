let oTable_realisasi_request;

$(document).ready(function(){
	let t = 'realisasi_request';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"production/realisasi_request_material/viewrequestdt/false",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "kode_mutasi" },
			{ "data": "tanggal_mutasi" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_realisasi_request = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_realisasi_request, t);
	listenKeyInput(oTable_realisasi_request, t);

	oTable_realisasi_request.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_realisasi_request, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_realisasi_request, this);
	});
});
