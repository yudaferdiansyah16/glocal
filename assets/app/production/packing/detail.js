$(document).ready(function(){
    $('#dt_material').DataTable({
		"autoWidth" : true,
		"responsive": false,
		"saveState": true,
		"processing": true,
		"serverSide": true,
		"displayLength": 10,
        "ajax": {
            url: _baseurl+"production/realisasi_produksi/detaildtMaterial/"+id_realisasi,
            type: "POST",
        },
        "columns": [
            { data: "no", searchable: false, className: 'text-center', "width": "1%" },
            { data: "kode_produksi", className: 'text-center', "width": "20%"},
            { data: "no_job", className: 'text-center', "width": "10%"},
            { data: "barang"},
            { data: "uraian_satuan_terkecil", className: 'text-center'},
            { data: "qty", className: 'text-right', "width": "10%"},
        ],
        "sorting" : [],
        "paginate": false,
        "lengthChange": false,
        "filter": false,
        "sort": false,
        "info": false,
        "columnDefs": [
            { 'sortable': false, 'targets': [] }
        ]
    });
    
    $('#dt_fg').DataTable({
		"autoWidth" : true,
		"responsive": true,
		"saveState": true,
		"processing": true,
		"serverSide": true,
		"displayLength": 10,
        "ajax": {
            url: _baseurl+"production/realisasi_produksi/detaildtFg",
			type: "POST",
			data: {
				"id": id_realisasi
			},
        },
        "columns": [
            { data: "no", searchable: false, className: 'text-center', "width": "1%" },
            { data: "nama_barang"},
            { data: "kode_barang", className: 'text-center', "width": "15%"},
            { data: "uraian_satuan_terkecil", className: 'text-center', "width": "20%"},
            { data: "qty_po", className: 'text-right', "width": "10%"},
            { data: "qty", className: 'text-right', "width": "10%"},
        ],
        "sorting" : [],
        "paginate": false,
        "lengthChange": false,
        "filter": false,
        "sort": false,
        "info": false,
        "columnDefs": [
            { 'sortable': false, 'targets': [] }
        ]
    });

 
    
    $('#dt_wip').DataTable({
		"autoWidth" : true,
		"responsive": true,
		"saveState": true,
		"processing": true,
		"serverSide": true,
		"displayLength": 10,
        "ajax": {
            url: _baseurl+"production/packing/detaildtWip",
			type: "POST",
			data: {
				"id": id_realisasi
			},
        },
        "columns": [
            { data: "no", searchable: false, className: 'text-center', "width": "1%" },
            { data: "kode_produksi"},
            { data: "no_job"},
            { data: "nama_barang", className: 'text-center', "width": "15%"},
            { data: "uraian_satuan_terkecil", className: 'text-center', "width": "20%"},
            { data: "qty", className: 'text-right', "width": "10%"},
        ],
        "sorting" : [],
        "paginate": false,
        "lengthChange": false,
        "filter": false,
        "sort": false,
        "info": false,
        "columnDefs": [
            { 'sortable': false, 'targets': [] }
        ]
    });

 


    $('#dt_scrap').DataTable({
		"autoWidth" : true,
		"responsive": true,
		"saveState": true,
		"processing": true,
		"serverSide": true,
		"displayLength": 10,
        "ajax": {
            url: _baseurl+"production/realisasi_produksi/detaildtScrap/"+id_realisasi,
            type: "POST",
        },
        "columns": [
            { data: "no", searchable: false, className: 'text-center', "width": "1%" },
            { data: "kode_produksi", className: 'text-center', "width": "20%"},
            { data: "barang"},
            { data: "uraian_satuan_terkecil", className: 'text-center'},
            { data: "qty", className: 'text-right', "width": "10%"},
        ],
        "sorting" : [],
        "paginate": false,
        "lengthChange": false,
        "filter": false,
        "sort": false,
        "info": false,
        "columnDefs": [
            { 'sortable': false, 'targets': [] }
        ]
    });

    $('#dt_waste').DataTable({
		"autoWidth" : true,
		"responsive": true,
		"saveState": true,
		"processing": true,
		"serverSide": true,
		"displayLength": 10,
        "ajax": {
            url: _baseurl+"production/realisasi_produksi/detaildtWaste/"+id_realisasi,
            type: "POST",
        },
        "columns": [
            { data: "no", searchable: false, className: 'text-center', "width": "1%" },
            { data: "kode_produksi", className: 'text-center', "width": "20%"},
            { data: "barang"},
            { data: "uraian_satuan_terkecil", className: 'text-center'},
            { data: "qty", className: 'text-right', "width": "10%"},
        ],
        "sorting" : [],
        "paginate": false,
        "lengthChange": false,
        "filter": false,
        "sort": false,
        "info": false,
        "columnDefs": [
            { 'sortable': false, 'targets': [] }
        ]
    });

    
    $('#dt_return').DataTable({
		"autoWidth" : true,
		"responsive": true,
		"saveState": true,
		"processing": true,
		"serverSide": true,
		"displayLength": 10,
        "ajax": {
            url: _baseurl+"production/realisasi_produksi/detaildtReturn/"+id_realisasi,
            type: "POST",
        },
        "columns": [
            { data: "no", searchable: false, className: 'text-center', "width": "1%" },
            { data: "kode_produksi", className: 'text-center', "width": "20%"},
            { data: "barang"},
            { data: "uraian_satuan_terkecil", className: 'text-center'},
            { data: "qty", className: 'text-right', "width": "10%"},
        ],
        "sorting" : [],
        "paginate": false,
        "lengthChange": false,
        "filter": false,
        "sort": false,
        "info": false,
        "columnDefs": [
            { 'sortable': false, 'targets': [] }
        ]
    });

    $('#dt_loss').DataTable({
		"autoWidth" : true,
		"responsive": true,
		"saveState": true,
		"processing": true,
		"serverSide": true,
		"displayLength": 10,
        "ajax": {
            url: _baseurl+"production/realisasi_produksi/detaildtLoss/"+id_realisasi,
            type: "POST",
        },
        "columns": [
            { data: "no", searchable: false, className: 'text-center', "width": "1%" },
            { data: "kode_produksi", className: 'text-center', "width": "20%"},
            { data: "barang"},
            { data: "uraian_satuan_terkecil", className: 'text-center'},
            { data: "qty", className: 'text-right', "width": "10%"},
        ],
        "sorting" : [],
        "paginate": false,
        "lengthChange": false,
        "filter": false,
        "sort": false,
        "info": false,
        "columnDefs": [
            { 'sortable': false, 'targets': [] }
        ]
    });

});
