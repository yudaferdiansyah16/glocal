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
			url: _baseurl+"production/packing/viewdt",
			type: "POST",
		},
		"columns": [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "kode_mutasi", render: function ( data, type, row, meta ) {
					return data + "<br><small>Transaction Date: " + moment(row.tanggal_mutasi).format('DD-MM-YYYY') + "</small>";
				} },
			{ data: "tanggal_mutasi", className: 'text-center', visible: false },
			{ data: "no_job", render: function ( data, type, row, meta ) {
					return data + "<br><small>Job Date: " + moment(row.tanggal_job).format('DD-MM-YYYY') + "</small>";
				} },
			{ data: "tanggal_job", visible: false },
			{ data: "nama_barang", render: function ( data, type, row, meta ) {
					return data + "<br><small>" + row.kode_barang + "</small>";
				} },
			{ data: "qty_pack", className: 'text-right', render: function ( data, type, row, meta ) {
					return data + "<br><small>" + row.kode_satuan + "</small>";
				} },
			{ data: "status_approve", className: 'text-center', searchable: false, sortable: false },
			{ data: "option",searchable: false, className: 'text-center' },
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
