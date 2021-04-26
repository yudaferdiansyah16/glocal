$(document).ready(function(){
	let oTable = $('#dt').DataTable({
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
			url: _baseurl+"warehouse/request_wh/detaildt/"+id_request,
			type: "POST"
		},
		"columns": [
			{ data: "no" },
			{ data: "tgl_request" },
			{ data: "nomor_daftar" },
			{ data: "no_job" },
			{ data: "nama_barang" },
			{ data: "kode_barang" },
			{ data: "id_satuan" },
			{ data: "qty_request" }
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
