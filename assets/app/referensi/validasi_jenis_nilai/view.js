$(document).ready(function(){
	let oTable = $('#dt').DataTable({
		"autoWidth" : true,

		"responsive": false,
		//"scrollX": true,
		"processing": true,
		"serverSide": true,
		"displayLength": 10,
		"paginate": true,
		"lengthChange": false,
		"filter": true,
		"sort": true,
		"info": true,
		"ajax": {
			"url": _baseurl+"referensi/validasi_jenis_nilai/viewdt",
			"type": "POST",
		},
		"columns": [
			{ "data": "no", searchable: false, className: 'text-center' },
			{ "data": "KODE_DOKUMEN" },
			{ "data": "JENIS_NILAI" },
			{ "data": "FLAG_PENGIRIM" },
			{ "data": "FLAG_PENJUAL" },
			{ "data": "FLAG_PENGUSAHA" },
			{ "data": "FLAG_PEMILIK" },
			{ "data": "FLAG_IMPORTIR" }
		],
		"sorting" : [[1, 'asc']],
		"columnDefs": [
			{ 'sortable': false, 'targets': [0] }
		]
	});

	$('#dt_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode == 13) {
			oTable.search(this.value).draw();
		}
	});
});
