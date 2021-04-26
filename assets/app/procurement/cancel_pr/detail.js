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
			url: _baseurl+"procurement/cancel_pr/detaildt",
			type: "POST",
		},
		"columns": [
			{ data: "no" },
			{ data: "id_detail_job" },
			{ data: "id_sub_barang" },
			{ data: "dimensi" },
			{ data: "size" },
			{ data: "merk" },
			{ data: "warna" },
			{ data: "spesifikasi" },
			{ data: "style" },
			{ data: "qty" },
			{ data: "harga" },
			{ data: "keterangan" },
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
