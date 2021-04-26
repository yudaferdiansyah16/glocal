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
			url: _baseurl+"procurement/purchase_order/detaildt",
			type: "POST",
			data: {
				id_po: id_po
			}
		},
		"columns": [
			{ data: "no" },
			{ data: "kode_bom" },
			{ data: "no_job" },
			{ data: "barang" },
			{ data: "qty_po",className:'text-right' },
			{ data: "harga",className:'text-right' },
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
