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
			"url": _baseurl+"master/job/viewdt",
			"type": "POST",
			"data": function(data){
				data.id_bom = $('.id_bom').val();
			}
		},
		"columns": [
			{ "data": "no", searchable: false, className: 'text-center' },
			{ "data": "no_job" },
			{ "data": "tanggal_job", className: 'text-center', "render": function ( data, type, row, meta ) {
				return moment(data).format('DD-MM-YYYY');
			}},
			{ "data": "due_date", className: 'text-center', "render": function ( data, type, row, meta ) {
				return moment(data).format('DD-MM-YYYY');
			}},
			{ "data": "status_trans", className: 'text-center' },
			{ "data": "option", searchable: false, className: 'text-center' },
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
