let filter_bom = '';
$(document).ready(function(){
	let  t = 't_bom';
	let  oTable_t_bom = $('#dt_'+t).DataTable({
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
			url: _baseurl+"master/bom_produksi/viewdt",
			type: "POST",
		},
		columns: [
			{ data: "no", className: 'text-center' },
			{ data: "kode_bom", className: 'text-center' },
			{ data: "tanggal_bom", className: 'text-center', "render": function ( data, type, row, meta ) {
					return moment(data).format('DD-MM-YYYY');
				}},
			{ data: "kode_po", className: 'text-center' },
			{ data: "nama_supplier" },
			{ data: "nama_barang" },
			{ data: "qty", className: 'text-right' },
			{ data: "kode_satuan", className: 'text-center' },
			{ data: "status_trans", className: 'text-center' }
		],
		sorting : [[1, 'asc']],
		columnDefs: [
			{ 'sortable': false, 'targets': [0,-1] }
		]
	});

	$('#dt_'+t+'_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode === 13) {
			oTable_t_bom.search(this.value).draw();
		}
	});

	$('#dt_'+t).on('key-focus.dt', function(e, datatable, cell){
		// Select highlighted row
		$(oTable_t_bom.row(cell.index().row).node()).addClass('selected');
	});

	// Handle event when cell looses focus
	$('#dt_'+t).on('key-blur.dt', function(e, datatable, cell){
		// Deselect highlighted row
		$(oTable_t_bom.row(cell.index().row).node()).removeClass('selected');
	});

	function processSelect_t_bom(e, datatable, key, cell, originalEvent){
		if(key === 13){
			setValue(t, datatable.row(cell.index().row).data());
		} else if(e.type === "dblclick"){
			setValue(t, $('#dt_'+t).DataTable().row(this).data());
		}
		$('#'+t+'_modal').modal('hide');
	}

	oTable_t_bom.on('key', processSelect_t_bom)
		.on('dblclick','tr', processSelect_t_bom);
});
