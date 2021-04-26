$(document).ready(function(){
	let  t = 'm_barang';
	let  oTable_m_barang = $('#dt_'+t).DataTable({
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
			url: _baseurl+"master/barang/viewdt/false",
			type: "POST",
		},
		columns: [
			{ data: "no", searchable: false },
			{ data: "id_barang" },
			{ data: "nama_barang" },
			{ data: "nama_kategori" },
			{ data: "nama_class" },
			{ data: "nama_asal" },
			{ data: "nama_brand" }
		],
		sorting : [[1, 'asc']],
		columnDefs: [
			{ 'sortable': false, 'targets': [0,-1] }
		]
	});

	$('#dt_'+t+'_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode === 13) {
			oTable_m_barang.search(this.value).draw();
		}
	});

	$('#dt_'+t).on('key-focus.dt', function(e, datatable, cell){
		// Select highlighted row
		$(oTable_m_barang.row(cell.index().row).node()).addClass('selected');
	});

	// Handle event when cell looses focus
	$('#dt_'+t).on('key-blur.dt', function(e, datatable, cell){
		// Deselect highlighted row
		$(oTable_m_barang.row(cell.index().row).node()).removeClass('selected');
	});

	function processSelect_m_barang(e, datatable, key, cell, originalEvent){
		if(key === 13){
			setValue(t, datatable.row(cell.index().row).data());
		} else if(e.type === "dblclick"){
			setValue(t, $('#dt_'+t).DataTable().row(this).data());
		}
		$('#'+t+'_modal').modal('hide');
	}

	oTable_m_barang.on('key', processSelect_m_barang)
		.on('dblclick','tr', processSelect_m_barang);
});
