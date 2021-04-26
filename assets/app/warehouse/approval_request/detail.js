$(document).ready(function(){
	let oTable = $('#dt_approval_request').DataTable({
		"autoWidth" : true,
		"responsive": false,
		//"scrollX": true,
		"processing": true,
		"serverSide": true,
		searching:false,
		"paginate": false,
		"lengthChange": false,
		"filter": true,
		"sort": true,
		"info": false,
		"ajax": {
			url: _baseurl+"production/request_material/detaildt/"+id_pro,
			type: "POST"
		},
		"columns": [
			{ data: "no" },
			{ data: "nomor_aju" },
			{ data: "nomor_daftar" },
			{ data: "no_sj" },
			{ data: "no_job" },
			{ data: "kode_barang" },
			{ data: "nama_barang" },
			{ data: "qty" }
		],
		"sorting" : [[1, 'asc']],
		"columnDefs": [
			{ 'sortable': false, 'targets': [0] }
		]
	});

	$('#dt_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode == 13) {
			oTable.search(this.value).draw();
		}
	});
});
