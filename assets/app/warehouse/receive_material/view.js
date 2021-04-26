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
			url: _baseurl+"warehouse/receive_material/viewdt",
			type: "POST",
		},
		"columns": [
			{ data: "no", className: 'text-center' },
			{ data: "kode_mutasi", render: function ( data, type, row, meta ) {
				return data + "<br><small>Receive Date: " + moment(row.tanggal_terima).format('DD-MM-YYYY') + "</small>";
			} },
			{ data: "kode_dn", render: function ( data, type, row, meta ) {
				return data + "<br><small>RN Date: " + moment(row.tanggal_dn).format('DD-MM-YYYY') + "</small>";
			}  },
			{ data: "no_invoice", render: function ( data, type, row, meta ) {
				return data + "<br><small>Invoice Date: " + ((row.tanggal_dn != '' || row.tanggal_dn != null) ? moment(row.tanggal_dn).format('DD-MM-YYYY') : '-') + "</small>";
			}   },
			{ data: "nama_supplier" },
			{ data: "status_approve", className: 'text-center', searchable: false, sortable: false },
			{ data: "option", className: 'text-center' },
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
