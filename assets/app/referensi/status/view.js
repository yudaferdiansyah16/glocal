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
			"url": _baseurl+"referensi/status/viewdt",
			"type": "POST",
		},
		"columns": [
			{ "data": "no", searchable: false, className: 'text-center' },
			{ "data": "URAIAN_DOKUMEN" },
			{ "data": "KODE_STATUS" },
			{ "data": "URAIAN_STATUS" }
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
