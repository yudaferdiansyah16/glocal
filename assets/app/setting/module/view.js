$(document).ready(function () {
	var updateOutput = function(e)
	{
		var list   = e.length ? e : $(e.target),
			output = list.data('output');
		if (window.JSON) {
			output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
		} else {
			output.val('JSON browser support required for this demo.');
		}
	};
	$('.dd').nestable({
		group: 1
	}).on('change', updateOutput);
	updateOutput($('.dd').data('output', $('#nestable-output')));
	$("#btn-save").click(function(){
		var dataString = {
			modules : $("#nestable-output").val(),
		};

		$.ajax({
			type: "POST",
			url: _baseurl + "setting/module/update_state",
			data: dataString,
			cache : false,
			success: function(data){
				alert('Data has been saved');
			} ,error: function(xhr, status, error) {
				alert(error);
			},
		});
	});

	let oTable = $("#dt").DataTable({
		autoWidth: true,
		responsive: false,
		//"scrollX": true,
		processing: true,
		serverSide: true,
		displayLength: 10,
		paginate: false,
		lengthChange: false,
		filter: true,
		sort: true,
		info: false,
		ajax: {
			url: _baseurl + "setting/module/viewdt",
			type: "POST",
		},
		columns: [
			{ data: "no", searchable: false, className: "text-center" },
			{
				data: "nama_modul_en",
				sortable: false,
				render: function ( data, type, row, meta ) {
					let text_depth = "";
					let index = 1;
					while (index < row.depth) {
						text_depth += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						index++;
					}
					return text_depth + " <i class='"+row.icon_class+"'></i> " + data;
				},
			},
			{ data: "url", sortable: false },
			{ data: "path", className: "text-center", visible: false },
			{ data: "id_status", className: "text-center", sortable: false, render: function ( data, type, row, meta ) {
				return data == '1' ? "<i class='fad fa-check-square text-success'></i>" : "<i class='fad fa-times-square text-danger'></i>";
			}},
			{ data: "option", searchable: false, className: "text-center", sortable: false },
		],
		sorting: [[3, "asc"]],
		columnDefs: [{ sortable: false, targets: [0, -1] }],
	});

	$("#dt_filter input")
		.unbind()
		.bind("keyup", function (e) {
			if (e.keyCode == 13) {
				oTable.search(this.value).draw();
			}
		});
});
