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
			"url": _baseurl+"referensi/pengusaha/viewdt",
			"type": "POST",
		},
		"columns": [
			{ "data": "no", searchable: false, className: 'text-center' },
			{ "data": "ALAMAT" },
			{ "data": "CONTACT_PERSON" },
			{ "data": "EMAIL" },
			{ "data": "FAX" },
			{ "data": "ID_PENGENAL" },
			{ "data": "JENISTPB" },
			{ "data": "KODE_KANTOR" },
			{ "data": "NAMA" },
			{ "data": "NOMOR_PENGENAL" },
			{ "data": "NOMOR_SKEP" },
			{ "data": "NPWP" },
			{ "data": "STATUS_IMPORTIR" },
			{ "data": "TELEPON" },
			{ "data": "option", className: 'text-center', searchable: false, sortable: false },
		],
		"sorting" : [[1, 'asc']],
		"columnDefs": [
			{ 'sortable': false, 'targets': [0,-1] }
		]
	});

	$('#dt_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode == 13) {
			oTable.search(this.value).draw();
		}
	});
});
