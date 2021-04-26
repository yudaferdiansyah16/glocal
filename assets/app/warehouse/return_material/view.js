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
			url: _baseurl+"warehouse/return_material/viewdt",
			type: "POST",
		},
		"columns": [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "kode_mutasi", className: 'text-center'},
			{ data: "tanggal_terima", className: "text-center", render: renderDTDate },
			{ data: "deskripsi", className: "text-center"},
			{ data: "detail_count", className: 'text-right', render: function ( data, type, row, meta ) {
				return data + " items";
			} },
			{ data: "created_at", className: 'text-right', visible: false },
			{ data: "status_approve", className: 'text-center', searchable: false, sortable: false},
			{ data: "option",searchable: false, className: 'text-center' },
		],
		"sorting" : [[5, 'desc']],
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
