$(document).ready(function(){
	let oTable = $('#dt').DataTable({
		"autoWidth" : true,
		"responsive": false,
		scrollX: true,
		"processing": true,
		"serverSide": true,
		"displayLength": 10,
		"paginate": true,
		"lengthChange": false,
		"filter": true,
		"sort": true,
		"info": true,
		"ajax": {
			url: _baseurl+"procurement/approval_po/viewdt",
			type: "POST",
		},
		"columns": [
			{ data: "no" },
			{ data: "kode_po" },
			{ data: "tanggal_dibuat" },
			{ data: "tanggal_dibutuhkan" },
			{ data: "id_supplier" },
			{ data: "id_valuta" },
			{ data: "rate" },
			{ data: "down_payment" },
			{ data: "diskon" },
			{ data: "pajak" },
			{ data: "pph" },
			{ data: "biaya_kirim" },
			{ data: "catatan_dibutuhkan" },
			{ data: "catatan_po" },
			{ data: "status" },
			{ data: "approval_1" },
			{ data: "approval_2" },
			{ data: "id_user_approval_1" },
			{ data: "id_user_approval_2" },
			{ data: "date_approval_1" },
			{ data: "date_approval_2" },
			{ data: "date_closing" },
			{ data: "id_user_closing" },
			{ data: "flag_closing" },
			{ data: "flag_edit" },
			{ data: "flag_btl" },
			{ data: "id_user_btl" },
			{ data: "btl_date" },
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

	$('#smartwizard').smartWizard({
		selected: 0,
		theme: 'arrows',
		transition: {
			animation: 'slide-horizontal', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
		},
	});
});
