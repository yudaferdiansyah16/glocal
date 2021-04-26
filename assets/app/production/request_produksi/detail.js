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
			url: _baseurl+"production/request_produksi/detaildt/"+id_production,
			type: "POST"
		},
		"columns": [
			{ data: "no" },
			{ data: "tanggal_produksi" },
			{ data: "nomor_daftar" },
			{ data: "no_job" },
			
			{ data: "nama_barang" },
			{ data: "kode_barang" },
			{ data: "KODE_SATUAN" },
			{ data: "qty" },
			{data: "blank"},
			{data: "blank"},
			{data: "blank"},
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
