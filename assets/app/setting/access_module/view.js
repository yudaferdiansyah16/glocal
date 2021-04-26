$(document).ready(function () {
	tabelPrivilege();
	tabelModul("");

	$("li.active").removeClass("active");
	$("#menu_setting").addClass("active");
	$("#menu_setting_access_module").addClass("active");
});

function tabelPrivilege() {
	let dtprivilege = $("#tabelPrivilege").DataTable({
		autoWidth: true,
		responsive: false,
		processing: true,
		serverSide: true,
		// displayLength: 10,
		paginate: false,
		lengthChange: false,
		filter: false,
		sort: true,
		info: true,
		ordering: true,
		ajax: {
			url: _baseurl + "setting/access_module/viewdt",
			type: "POST",
		},
		columns: [
			{ data: "no", searchable: false, className: "text-center" },
			{ data: "nama_priv" },
		],
		sorting: [[1, "asc"]],
		columnDefs: [{ sortable: false, targets: [0, -1] }],
		fnCreatedRow: function (nRow, aData, iDataIndex) {
			$(nRow).attr("id", aData["nama_priv"]);
			$(nRow).addClass("row-select");
		},
	});

	$("#tabelPrivilege").on("click", "tr", function () {
		let data = dtprivilege.row(this).data();
		$(".row-select").removeClass("row-selected");
		$("#" + data["nama_priv"]).addClass("row-selected");
		tabelModul(data["id_priv"]);
	});
}

function tabelModul(id) {
	let dtmodul = $("#tabelModul").DataTable({
		autoWidth: true,
		responsive: false,
		processing: true,
		serverSide: true,
		// displayLength: 100,
		paginate: false,
		lengthChange: false,
		filter: false,
		sort: true,
        info: false,
        destroy: true,
        ordering: true,
		ajax: {
			url: _baseurl + "setting/access_module/viewdtm/" + id,
			type: "POST",
		},
		columns: [
            { data: "no", searchable: false, className: "text-center" },
			{
				data: "nama_modul_id",
				sortable: false,
				render: function ( data, type, row, meta ) {
					let text_depth = "";
					let index = 1;
					while (index < row.depth) {
						text_depth += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						index++;
					}
					return text_depth + " <i class='"+row.icon_class+"'></i> " + data + row.option;
				},
			},
			{ data: "path", className: "text-center", visible: false },
            { data: "action_view", searchable: false, sortable: false, className: "text-center" },
            { data: "action_add", searchable: false, sortable: false, className: "text-center" },
            { data: "action_update", searchable: false, sortable: false, className: "text-center" },
            { data: "action_delete", searchable: false, sortable: false, className: "text-center" },
            { data: "action_approve1", searchable: false, sortable: false, className: "text-center" },
            { data: "action_unapprove1", searchable: false, sortable: false, className: "text-center" },
            { data: "action_approve2", searchable: false, sortable: false, className: "text-center" },
            { data: "action_unapprove2", searchable: false, sortable: false, className: "text-center" },
		],
		sorting: [[2, "asc"]],
        columnDefs: [{ sortable: false, targets: [0, -1] }],
    });

	dtmodul
		.on("order.dt search.dt", function () {
			dtmodul
				.column(0, { search: "applied", order: "applied" })
				.nodes()
				.each(function (cell, i) {
					cell.innerHTML = i + 1;
				});
		})
		.draw();
}

function cekThis(id) {
	var val = "0";
	if ($("#" + id).is(":checked")) {
		val = "1";
	}
	$.ajax({
		url: _baseurl + "setting/access_module/changeStatus",
		type: "POST",
		data: {
			id: id,
			value: val,
		},
		dataType: "JSON",
		success: function (data) {
			if (data.status != true) {
				if (val == 0) {
					$("#" + id).prop("checked", true);
				} else {
					$("#" + id).prop("checked", false);
				}
			}
		},
		error: function (response) {
			if (val == 0) {
				$("#" + id).prop("checked", true);
			} else {
				$("#" + id).prop("checked", false);
			}
			alert("Error");
		},
	});
}
