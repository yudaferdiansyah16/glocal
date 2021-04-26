let oTable_m_akun_lawan;

$(document).ready(function(){
	let t = 'm_akun_lawan';
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
	oTable_m_akun_lawan = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_m_akun_lawan, t);
	listenKeyInput(oTable_m_akun_lawan, t);

	oTable_m_akun_lawan.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_m_akun_lawan, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_m_akun_lawan, this);
	});
});

