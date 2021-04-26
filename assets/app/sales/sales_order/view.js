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
			url: _baseurl+"sales/sales_order/viewdt",
			type: "POST",
		},
		"columns": [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "kode_po", className: 'text-center' },
			{ data: "tanggal_dibuat", className: 'text-center', "render": renderDTDate },
			{ data: "nama_consignee" },
			{ data: "amount", className: 'text-right' },
			{ data: "status_approve", className: 'text-center', searchable: false, sortable: false },
			{ data: "option", searchable: false, className: 'text-center', sortable: false },
		],
		"sorting" : [[1, 'desc']],
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
