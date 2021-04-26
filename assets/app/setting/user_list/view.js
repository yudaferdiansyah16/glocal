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
			url: _baseurl+"setting/user_list/viewdt",
			type: "POST",
		},
		"columns": [
			{ data: "no", className: 'text-center',searchable: false, sortable: false },
			{ data: "nama" },
			{ data: "username"},
			{ data: "email" , className: 'text-left'},
			{ data: "nama_priv" },
			// { data: "photo_file", className: 'text-center' },
			{ data: "option", className: 'text-center', searchable: false, sortable: false },

		],
		"sorting" : [[1, 'asc']],

	});

	$('#dt_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode == 13) {
			oTable.search(this.value).draw();
		}
	});
});
