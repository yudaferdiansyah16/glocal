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
			url: _baseurl+"finance/kasbon/viewdt",
			type: "POST",
		},
		"columns": [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "tgl_kasbon", className: 'text-center', render: renderDTDate },
			{ data: "nama" },
			{ data: "ket_kasbon" },
			{ data: "status", className: 'text-center' },
			{ data: "jumlah", className: 'text-right' },
			{ data: "option", searchable: false, className: 'text-center', sortable: false },
		],
		"sorting" : [[1, 'DESC']],
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
