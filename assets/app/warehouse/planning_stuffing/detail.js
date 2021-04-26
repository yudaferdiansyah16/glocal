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
			url: _baseurl+"warehouse/planning_stuffing/viewdetaildt",
			type: "POST",
		},
		"columns": [
			{ data: "no" },
			{ data: "blank" },
			{ data: "id_job" },
			{ data: "date" },
			{ data: "customer_id" },
			{ data: "kode_po" },
			{ data: "shipping_line" },
			{ data: "contaiiner_number" },
			{ data: "seal_number" },
			{ data: "destination" },
			{ data: "country" },
			{ data: "lock_document" },
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
