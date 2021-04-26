$(document).ready(function(){
	let  t = 't_dn';
	let  oTable_t_dn = $('#dt_'+t).DataTable({
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
			{ data: "id_dn", className: 'text-center' },
			{ data: "kode_dn", className: 'text-center' },
			{ data: "kode_dn", className: 'text-center' },
			{ data: "no_faktur", className: 'text-center' },
			{ data: "tgl_kedatangan", className: 'text-center' },
			{ data: "nama_supplier" },
			{ data: "plat_kendaraan", className: 'text-center' },
			{ data: "nama_fasilitas", className: 'text-center' },
			{ data: "amount", className: 'text-right' }
		],
		"sorting" : [[1, 'asc']],
		"columnDefs": [
			{ 'sortable': false, 'targets': [0,-1] }
		]
	});

	$('#dt_'+t+'_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode === 13) {
			oTable_t_dn.search(this.value).draw();
		}
	});

	$('#dt_'+t).on('key-focus.dt', function(e, datatable, cell){
		// Select highlighted row
		$(oTable_t_dn.row(cell.index().row).node()).addClass('selected');
	});

	// Handle event when cell looses focus
	$('#dt_'+t).on('key-blur.dt', function(e, datatable, cell){
		// Deselect highlighted row
		$(oTable_t_dn.row(cell.index().row).node()).removeClass('selected');
	});

	function processSelect_t_dn(e, datatable, key, cell, originalEvent){
		if(key === 13){
			setValue(t, datatable.row(cell.index().row).data());
		} else if(e.type === "dblclick"){
			setValue(t, $('#dt_'+t).DataTable().row(this).data());
		}
		$('#'+t+'_modal').modal('hide');
	}

	oTable_t_dn.on('key', processSelect_t_dn)
		.on('dblclick','tr', processSelect_t_dn);
});
