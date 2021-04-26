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
			url: _baseurl+"procurement/delivery_note_po/viewdt",
			type: "POST",
		},
		"columns": [
			{ data: "no", className: 'text-center', searchable: false, sortable: false },
			{ data: "kode_dn", render: function ( data, type, row, meta ) {
				return data + "<br><small>RN Date: " + moment(row.tgl_kedatangan).format('DD-MM-YYYY') + "</small>";
			} },
			{ data: "nama_supplier" },
			{ data: "nama_fasilitas", className: 'text-center' },
			{ data: "amount", className: 'text-right', render: renderMoney },
			{ data: "status_approve", className: 'text-center', searchable: false, sortable: false },
			{ data: "option", className: 'text-center', searchable: false, sortable: false },
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
