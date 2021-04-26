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
			url: _baseurl+"procurement/cancel_pr/viewdt",
			type: "POST",
		},
		"columns": [
			{ data: "no", className:'text-center' },
			{ data: "kode_pp" },
			{ data: "tanggal_dibuat" },
			{ data: "tanggal_dibutuhkan" },
			{ data: "nama_bagian" },
			{ data: "nama_jenis_pp" },
			{ data: "nama_jenis_pp_rutinitas" },
			{ data: "option", className:'text-center' },
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
