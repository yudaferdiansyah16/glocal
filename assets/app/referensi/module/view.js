$(document).ready(function () {
	let oTable = $("#dt").DataTable({
		autoWidth: true,

		responsive: false,
		//"scrollX": true,
		processing: true,
		serverSide: true,
		displayLength: 10,
		paginate: true,
		lengthChange: false,
		filter: true,
		sort: true,
		info: true,
		ajax: {
			url: _baseurl + "referensi/module/viewdt",
			type: "POST",
		},
		columns: [
			{ data: "no", searchable: false, className: "text-center" },
			{ data: "nama_moul_in" },
			{ data: "nama_modul_en" },
		],
		sorting: [[1, "asc"]],
		columnDefs: [{ sortable: false, targets: [0] }],
	});

	$("#dt_filter input")
		.unbind()
		.bind("keyup", function (e) {
			if (e.keyCode == 13) {
				oTable.search(this.value).draw();
			}
		});
});
