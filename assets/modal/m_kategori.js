let oTable_m_kategori;

$(document).ready(function(){
	let t = 'm_kategori';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"master/kategori/viewdt/false",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false },
			{ "data": "kode_kategori" },
			{ "data": "nama_kategori" },
			{ "data": "kode_sbu" },
			{ "data": "keterangan" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_m_kategori = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_m_kategori, t);
	listenKeyInput(oTable_m_kategori, t);

	oTable_m_kategori.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_m_kategori, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_m_kategori, this);
	});
});