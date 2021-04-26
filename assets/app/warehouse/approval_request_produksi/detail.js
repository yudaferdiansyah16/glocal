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
			url: _baseurl+"warehouse/approval_request_produksi/detaildt/"+id_wh,
			type: "POST"
		},
		"columns": [
			{ data: "no" },
			{ data: "tanggal_terima" },
			{ data: "nomor_daftar" },
			// { data: "no_sj" },
			{ data: "no_job" },
			{ data: "nama_barang" },
			{ data: "kode_barang" },
			{ data: "KODE_SATUAN" },
			{ 
				data: "qty",
				"render": function ( data, type, row, meta ) {
					return row.qty * (row.unit_konversi == null ? 1 : row.unit_konversi);
				}
			},
			{ data: "blank"},
			{ data: "blank"},
			{ data: "blank"},
			
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
