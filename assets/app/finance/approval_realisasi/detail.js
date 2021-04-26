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
			url: _baseurl+"finance/approval_realisasi/detaildt/"+idkasbon,
			type: "POST"
		},
		"columns": [
			{ data: "no", className: 'text-center' },
			{ data: "keterangan" },
			{ data: "jumlah", className: 'text-right' }
		],
		"sorting" : [],
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
