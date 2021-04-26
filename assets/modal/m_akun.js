let oTable_m_akun;

$(document).ready(function(){
	let t = 'm_akun';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"master/akun/viewdt",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false },
			{ "data": "kode_akun" },
			{ "data": "nama_akun" },
			{ "data": "keterangan" },
			{ "data": "id_status" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_m_akun = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_m_akun, t);
	listenKeyInput(oTable_m_akun, t);

	oTable_m_akun.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_m_akun, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_m_akun, this);
	});
});

