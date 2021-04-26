$(document).ready(function(){
	let  t = 't_detail_stuffing';
	let  oTable_t_detail_stuffing = $('#dt_'+t).DataTable({
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
			url: _baseurl+"sales/invoice/viewstuffingdt/false",
			type: "POST",
		},
		columns: [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "id_stuffing", className: 'text-center' },
			{ data: "id_sub_barang", className: 'text-center' },
			{ data: "id_satuan", className: 'text-center' },
			{ data: "kode_kemasan", className: 'text-center' },
			{ data: "jumlah_kemasan", className: "text-center" },
			{ data: "netto", className: 'text-right' },
			{ data: "container_number", className: 'text-center' },
			{ data: "container_size", className: 'text-center' },
			{ data: "no_bl", className: 'text-center' },
		],
		sorting : [[1, 'asc']],
		columnDefs: [
			{ 'sortable': false, 'targets': [0,-1] }
		]
	});

	$('#dt_'+t+'_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode === 13) {
			oTable_t_detail_stuffing.search(this.value).draw();
		}
	});

	$('#dt_'+t).on('key-focus.dt', function(e, datatable, cell){
		// Select highlighted row
		$(oTable_t_detail_stuffing.row(cell.index().row).node()).addClass('selected');
	});

	// Handle event when cell looses focus
	$('#dt_'+t).on('key-blur.dt', function(e, datatable, cell){
		// Deselect highlighted row
		$(oTable_t_detail_stuffing.row(cell.index().row).node()).removeClass('selected');
	});

	function processSelect_t_detail_stuffing(e, datatable, key, cell, originalEvent){
		if(key === 13){
			setValue(t, datatable.row(cell.index().row).data());
		} else if(e.type === "dblclick"){
			setValue(t, $('#dt_'+t).DataTable().row(this).data());
		}
		$('#'+t+'_modal').modal('hide');
	}

	oTable_t_detail_stuffing.on('key', processSelect_t_detail_stuffing)
		.on('dblclick','tr', processSelect_t_detail_stuffing);
});
