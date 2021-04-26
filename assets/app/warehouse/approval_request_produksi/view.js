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
			url: _baseurl+"warehouse/approval_request_produksi/viewdt",
			type: "POST",
		},
		"columns": [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "kode_mutasi"},
			{ data: "tanggal_terima"},
			{ data: "id_user_approval_1"},
			{ data: "status_approve", className: 'text-center', searchable: false, sortable: false},
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

	$("li.active").removeClass('active');
	$('#menu_warehouse').addClass('active');
	$('#menu_warehouse_approval_request').addClass('active');
});
