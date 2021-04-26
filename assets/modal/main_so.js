$(document).ready(function(){
	let  t = 'main_so';
	let  oTable_main_so = $('#dt_'+t).DataTable({
		autoWidth : true,
		responsive: false,
		// "scrollX": true,
		keys: {
			keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */ ]
		},
		saveState: true,
		processing: true,
		serverSide: true,
		displayLength: 10,
		paginate: true,
		lengthChange: false,
		filter: true,
		sort: true,
		info: true,
		ajax: {
			url: _baseurl+"sales/main_so/viewdtmodal",
			type: "POST",
		},
		"columns": [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "kode_po", className: 'text-center' },
			{ data: "po_buyer", className: 'text-center' },
			{ data: "tanggal_dibuat", className: 'text-center', "render": renderDTDate },
			{ data: "nama_tipe_sales" },
			{ data: "nama_supplier" },
			{ data: "tanggal_dibutuhkan", className: 'text-center', "render": renderDTDate },
			{ data: "amount", className: 'text-right' },
		],
		sorting : [[1, 'asc']],
		columnDefs: [
			{ 'sortable': false, 'targets': [0,-1] }
		]
	});

	$('#dt_'+t+'_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode === 13) {
			oTable_main_so.search(this.value).draw();
		}
	});

	$('#dt_'+t).on('key-focus.dt', function(e, datatable, cell){
		// Select highlighted row
		$(oTable_main_so.row(cell.index().row).node()).addClass('selected');
	});

	// Handle event when cell looses focus
	$('#dt_'+t).on('key-blur.dt', function(e, datatable, cell){
		// Deselect highlighted row
		$(oTable_main_so.row(cell.index().row).node()).removeClass('selected');
	});

	function processSelect_main_so(e, datatable, key, cell, originalEvent){
		if(key === 13){
			setValue(t, datatable.row(cell.index().row).data());
		} else if(e.type === "dblclick"){
			setValue(t, $('#dt_'+t).DataTable().row(this).data());
		}
		$('#'+t+'_modal').modal('hide');
	}

	oTable_main_so.on('key', processSelect_main_so)
		.on('dblclick','tr', processSelect_main_so);
});
