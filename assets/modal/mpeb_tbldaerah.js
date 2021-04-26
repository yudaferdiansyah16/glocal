let oTable_tbldaerah;

$(document).ready(function(){
	let t = 'tbldaerah';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"exim/transaksi_doc_out/viewdaerah/false",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "KdDaerah" },
			{ "data": "UrDaerah" },
			{ "data": "IbuKota" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_tbldaerah = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_tbldaerah, t);
	listenKeyInput(oTable_tbldaerah, t);

	oTable_tbldaerah.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_tbldaerah, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_tbldaerah, this);
	});
});
