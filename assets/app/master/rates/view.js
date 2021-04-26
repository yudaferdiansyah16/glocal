$(document).ready(function(){
	let oTable = $('#dt').DataTable({
		"autoWidth" : true,

		"responsive": false,
		//"scrollX": true,
		"processing": true,
		"serverSide": true,
		"displayLength": 10,
		"paginate": true,
		"lengthChange": true,
		"filter": true,
		"sort": true,
		"info": true,
		"ajax": {
			"url": _baseurl+"master/rates/viewdt",
			"type": "POST",
		},
		"columns": [
			{ "data": "no", searchable: false, className: 'text-center' },
			{ "data": "kode_valuta", className: 'text-center' },
			{ "data": "rates_jual", className: 'text-center'  },
			{ "data": "rates_beli", className: 'text-center'  },
			{ "data": "created_at", className: 'text-center'  },
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
	$('#menu_master').addClass('active');
	$('#menu_master_rates').addClass('active');
});
