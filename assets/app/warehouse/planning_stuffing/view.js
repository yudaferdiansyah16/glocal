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
			url: _baseurl+"warehouse/planning_stuffing/viewdt",
			type: "POST",
		},
		"columns": [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "id_bom", className: 'text-center' },
			{ data: "id_buffer_stock", className: 'text-center' },
			{ data: "id_job", className: 'text-center' },
			{ data: "customer_id", className: 'text-center' },
			{ data: "destination", className: 'text-center' },
			{ data: "country", className: 'text-center' },
			{ data: "option", searchable: false, className: 'text-center', sortable: false },
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
