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
			url: _baseurl+"warehouse/request_material/viewdt",
			type: "POST",
		},
		"columns": [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "kode_request", render: function ( data, type, row, meta ) {
					return data + "<br><small>Request Date: " + moment(row.tgl_request).format('DD-MM-YYYY') + "</small><br>" + "<span class='badge badge-info'>"+row.nama_jenis_mutasi+"</span>";
			} },
			{ data: "tgl_request", className: "text-center", render: renderDTDate, visible: false },
			{ data: "nama_jenis_mutasi", className: "text-center", visible: false},
			{ data: "deskripsi"},
			{ data: "detail_count", className: 'text-right', render: function ( data, type, row, meta ) {
				return data + " items";
			} },
			{ data: "created_at", className: 'text-right', visible: false },
			{ data: "status_approve", className: 'text-center', searchable: false, sortable: false},
			{ data: "option", className: 'text-center', searchable: false, sortable: false },
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
