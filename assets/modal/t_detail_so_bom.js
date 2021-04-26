$(document).ready(function(){
    let  t = 't_detail_so_bom';
    let  oTable_t_detail_so_bom = $('#dt_'+t).DataTable({
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
            url: _baseurl+"sales/sales_order_detail/viewbomdt/false",
            type: "POST",
        },
        columns: [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "kode_barang", className: 'text-center', visible: false },
			{ data: "nama_sub_barang", render: function ( data, type, row, meta ) {
				return data + "<br><small>"+row.kode_barang+"</small>";
			}},
			{ data: "kode_po", render: function ( data, type, row, meta ) {
					return data + "<br><small>PO Buyer: #" + row.po_buyer + "</small>";
			}},
			{ data: "nama_supplier" },
			{ data: "tanggal_dibuat", className: 'text-center', render: function ( data, type, row, meta ) {
					return moment(data).format('DD-MM-YYYY');
			}},
			{ data: "qty_mc", className: 'text-right', render: function ( data, type, row, meta ) {
					return formatCurrency(data, 0) + "<br>" + "<small>"+row.kode_kemasan+"</small>";
			}},
			{ data: "kode_kemasan", className: 'text-center', visible: false },
			{ data: "qty_total", className: 'text-right', render: function ( data, type, row, meta ) {
					return formatCurrency(data, 2) + "<br>" + "<small>"+row.kode_satuan+"</small>";
				}},
			{ data: "qty_sisa_bom", className: 'text-right', render: function ( data, type, row, meta ) {
				return formatCurrency(data, 2) + "<br>" + "<small>"+row.kode_satuan+"</small>";
			}},
			{ data: "kode_satuan", className: 'text-center', visible: false }
        ],
        sorting : [[2, 'asc']],
        columnDefs: [
            { 'sortable': false, 'targets': [0,-1] }
        ]
    });

    $('#dt_'+t+'_filter input').unbind().bind('keyup', function(e) {
        if (e.keyCode === 13) {
            oTable_t_detail_so_bom.search(this.value).draw();
        }
    });

    $('#dt_'+t).on('key-focus.dt', function(e, datatable, cell){
        // Select highlighted row
        $(oTable_t_detail_so_bom.row(cell.index().row).node()).addClass('selected');
    });

    // Handle event when cell looses focus
    $('#dt_'+t).on('key-blur.dt', function(e, datatable, cell){
        // Deselect highlighted row
        $(oTable_t_detail_so_bom.row(cell.index().row).node()).removeClass('selected');
    });

    function processSelect_t_detail_so_bom(e, datatable, key, cell, originalEvent){
        if(key === 13){
            setValue(t, datatable.row(cell.index().row).data());
        } else if(e.type === "dblclick"){
            setValue(t, $('#dt_'+t).DataTable().row(this).data());
        }
        $('#'+t+'_modal').modal('hide');
    }

    oTable_t_detail_so_bom.on('key', processSelect_t_detail_so_bom)
        .on('dblclick','tr', processSelect_t_detail_so_bom);
});
