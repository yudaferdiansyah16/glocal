let oTable_return_request;

$(document).ready(function(){
	let t = 'return_request';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"production/return_request_material/viewrequestdt/false",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "kode_mutasi" },
			{ "data": "tanggal_mutasi" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_return_request = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_return_request, t);
	listenKeyInput(oTable_return_request, t);

	oTable_return_request.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_return_request, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_return_request, this);
	});
});
