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
			url: _baseurl+"warehouse/stuffing/viewdt",
			type: "POST",
		},
		"columns": [
			{ data: "no" },
			{ data: "kode_stuffing" },
			{ data: "tanggal_stuffing" },
			{ data: "nama_supplier" },
			{ data: "destination" },
			{ data: "container_number", className: 'text-center', visible: false },
			{ data: "status_approve", className: 'text-center', searchable: false, sortable: false },
			{ data: "option", className: 'text-center', searchable: false, sortable: false },
		],
		"sorting" : [[3, 'desc']],
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
