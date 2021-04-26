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
			url: _baseurl+"setting/profile/viewdt",
			type: "POST",
		},
		"columns": [
			{ data: "no", className: 'text-center',searchable: false, sortable: false },
			{ data: "nama" },
			{ data: "username" },
			{ data: "email" },
			{ data: "nama_priv", className: 'text-center' },
			{ data: "option", className: 'text-center', searchable: false, sortable: false },

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
