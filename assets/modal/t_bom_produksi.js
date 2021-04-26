let filter_bom_produksi = '';
let oTable_t_bom_produksi;

$(document).ready(function(){

	let  t = 't_bom_produksi';
	oTable_t_bom_produksi = $('#dt_'+t).DataTable({
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
			url: _baseurl+"master/bom_produksi/viewdt/false",
			type: "POST",
			data: function(data){
				if ($('.is_rerun').val() != '') data.is_rerun = $('.is_rerun').val();
				return data;
			}
		},
		columns: [
			{ data: "no", className: 'text-center' },
			{ data: "kode_bom", render: function ( data, type, row, meta ) {
				return data + "<br><small>BOM Date:" + moment(row.tanggal_bom).format('DD-MM-YYYY') + "</small>";
			}},
			{ data: "kode_po", render: function ( data, type, row, meta ) {
				return data + "<br><small>PO Buyer: #" + row.po_buyer + "</small>";
			}},
			{ data: "tanggal_dibuat", className: 'text-center', "render": function ( data, type, row, meta ) {
				return moment(data).format('DD-MM-YYYY');
			}},
			{ data: "nama_supplier" },
			{ data: "nama_barang", render: function ( data, type, row, meta ) {
				return data + "<br><small>" + row.kode_barang + "</small>";
			} },
			{ data: "qty", className: 'text-right', render: function ( data, type, row, meta ) {
				return formatCurrency(data, 2) + " " + row.kode_satuan;
			} },
		],
		sorting : [[1, 'asc']],
		columnDefs: [
			{ 'sortable': false, 'targets': [0,-1] }
		]
	});

	$('#dt_'+t+'_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode === 13) {
			oTable_t_bom_produksi.search(this.value).draw();
		}
	});

	$('#dt_'+t).on('key-focus.dt', function(e, datatable, cell){
		// Select highlighted row
		$(oTable_t_bom_produksi.row(cell.index().row).node()).addClass('selected');
	});

	// Handle event when cell looses focus
	$('#dt_'+t).on('key-blur.dt', function(e, datatable, cell){
		// Deselect highlighted row
		$(oTable_t_bom_produksi.row(cell.index().row).node()).removeClass('selected');
	});

	function processSelect_t_bom_produksi(e, datatable, key, cell, originalEvent){
		if(key === 13){
			setValue(t, datatable.row(cell.index().row).data());
		} else if(e.type === "dblclick"){
			setValue(t, $('#dt_'+t).DataTable().row(this).data());
		}
		$('#'+t+'_modal').modal('hide');
	}

	oTable_t_bom_produksi.on('key', processSelect_t_bom_produksi)
		.on('dblclick','tr', processSelect_t_bom_produksi);
});
