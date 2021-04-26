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
			{ data: "kode_stuffing", render: function ( data, type, row, meta ) {
					return data + "<br><small>Stuffing Date: " + moment(row.tanggal_stuffing).format('DD-MM-YYYY') + "</small>";
			} },
			{ data: "tanggal_stuffing", className: 'text-center', render: renderDTDate, visible: false },
			{ data: "nama_supplier" },
			{ data: "destination" },
			{ data: "container_number", className: 'text-center', visible: false },
			{ data: "status_approve", className: 'text-center', searchable: false, sortable: false },
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
