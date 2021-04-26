$(document).ready(function(){
	let oTable = $('#dt').DataTable({
		"autoWidth" : true,
		"responsive": false,
		//"scrollX": true,
		"processing": true,
		"serverSide": true,
		"paginate": false,
		"lengthChange": false,
		"filter": true,
		"sort": true,
		"info": false,
		"ajax": {
			url: _baseurl+"procurement/purchase_requisition/detaildt/"+idpp,
			type: "POST"
		},
		"columns": [
			{ data: "no", className: 'text-center' },
			{ data: "no_job" },
			{ data: "barang" },
			{ data: "qty_pp", className: 'text-right' },
			{ data: "keterangan" }	
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
