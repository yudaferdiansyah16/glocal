let oTable = null;

$(document).ready(function(){
	initDatepicker($('.x-datepicker'));

	$('.btn-clear-customer').hide();
	$('.btn-clear-customer').on('click', function (e) {
		$('.id_supplier').val("");
		$('.nama_supplier').val("");
		$('.btn-search-customer').show();
		$('.btn-clear-customer').hide();
		oTable.ajax.reload( null, false );
	});

	$('.form-filter').on('change', function (e) {
		oTable.ajax.reload( null, false );
	});

	oTable = $('#dt_material').DataTable({
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
			url: _baseurl+"warehouse/stock/viewstockdt",
			type: "POST",
			data: function(data){
				return data;
			}
		},
		"columns": [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "kode_barang", className: 'text-center', visible: false },
			{ 
				data: "nama_barang", render: function ( data, type, row, meta ) {
					return data + "<br>" + "<small>"+row.kode_barang+"</small>";
				} 
			},
			{ data: "size", className: 'text-center' },
			{ data: "nama_class" },
			// { data: "uraian_satuan" },
			// { data: "uraian_satuan_terkecil" },
			{ 
				data: "qty", className: 'text-right', render: function ( data, type, row, meta ) {
					return formatCurrency(data / (row.unit_konversi == null ? 1 : row.unit_konversi), 2) + " " + row.kode_satuan_terbesar;
				}
			},
			{ 
				data: "qty", className: 'text-right', render: function ( data, type, row, meta ) {
					return formatCurrency(data, 2) + " " + row.kode_satuan;
				}
			},
			{ data: "option", className: 'text-center', searchable: false, sortable: false },
		],
		"sorting" : [[1, 'asc']]
	});
	
	 $('#dt_fg').DataTable({
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
			url: _baseurl+"warehouse/stock/viewstockdtfg",
			type: "POST",
			data: function(data){
				return data;
			}
		},
		"columns": [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "kode_barang", className: 'text-center', visible: false },
			{ 
				data: "nama_barang", render: function ( data, type, row, meta ) {
					return data + "<br>" + "<small>"+row.kode_barang+"</small>";
				}
			},
			{ data: "size", className: 'text-center' },
			{ data: "nama_class" },
			// { data: "uraian_satuan" },
			// { data: "uraian_satuan_terkecil" },
			{ 
				data: "qty", className: 'text-right', render: function ( data, type, row, meta ) {
					return formatCurrency(data / (row.unit_konversi == null ? 1 : row.unit_konversi), 2) + " " + row.kode_satuan_terbesar;
				}
			},
			{ 
				data: "qty", className: 'text-right', render: function ( data, type, row, meta ) {
					return formatCurrency(data, 2) + " " + row.kode_satuan;
				}
			},
			// { data: "option", className: 'text-center', searchable: false, sortable: false },
		],
		"sorting" : [[1, 'asc']]
	});

	$('#dt_wip').DataTable({
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
			url: _baseurl+"warehouse/stock/viewstockdtwip",
			type: "POST",
			data: function(data){
				return data;
			}
		},
		"columns": [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "kode_barang", className: 'text-center', visible: false },
			{ 
				data: "nama_barang", render: function ( data, type, row, meta ) {
					return data + "<br>" + "<small>"+row.kode_barang+"</small>";
				} 
			},
			{ data: "size", className: 'text-center' },
			{ data: "nama_class" },
			// { data: "uraian_satuan" },
			// { data: "uraian_satuan_terkecil" },
			{ 
				data: "qty", className: 'text-right', render: function ( data, type, row, meta ) {
					return formatCurrency(data / (row.unit_konversi == null ? 1 : row.unit_konversi), 2) + " " + row.kode_satuan_terbesar;
				}
			},
			{ 
				data: "qty", className: 'text-right', render: function ( data, type, row, meta ) {
					return formatCurrency(data, 2) + " " + row.kode_satuan;
				}
			},
			// { data: "option", className: 'text-center', searchable: false, sortable: false },
		],
		"sorting" : [[1, 'asc']]
	});

	$('#dt_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode == 13) {
			oTable.search(this.value).draw();
		}
	});

	$("li.active").removeClass('active');
	$('#menu_warehouse').addClass('active');
	$('#menu_warehouse_stock').addClass('active');

	function format ( d ) {
		let template_detail = $('#template-detail').html();
		return template_detail;
	}

	$('#dt_material').on('click', '.btn-detail', function () {
		var tr = $(this).closest('tr');
		var row = oTable.row( tr );
		console.log(row.data());
		var no = row.data().no;
		// console.log(row);
		if (row.child.isShown()) {
			row.child.hide();
			tr.removeClass('shown');
			$(this).removeClass('btn-danger').addClass('btn-success');
			$(this).html("<i class='fa fal fa-plus-circle'></i> Show");
		} else {
			row.child( format(row.data()) ).show();
			tr.addClass('shown');
			$(this).removeClass('btn-success').addClass('btn-danger');
			$(this).html("<i class='fa fal fa-minus-circle'></i> Hide");
			const oTableDetail = tr.next('tr').find('.dt-detail').DataTable({
				"autoWidth" : true,
				"responsive": false,
				"searching": false,
				//"scrollX": true,
				"processing": true,
				"serverSide": true,
				"paginate": false,
				"lengthChange": false,
				"filter": true,
				"sort": true,
				"info": false,
				"ajax": {
					url: _baseurl+"warehouse/stock/viewkoordinatdt",
					type: "POST",
					data: function(data){
						data.id_sub_barang = row.data().id_sub_barang;
						console.log(data.id_sub_barang);
						return data;
					}
				},
				"columns": [
					{ 
						data: "no", searchable: false, className: 'text-center', render: function ( data, type, row, meta ) {
							return no + "." + data;
						}  
					},
					{ data: "nama_gudang" },
					{ data: "nama_koordinat", className: 'text-center' },
					{ 
						data: "qty", className: 'text-right', render: function ( data, type, row, meta ) {
							return formatCurrency(data, 2) + " " + row.kode_satuan;
						} 
					}
				],
				"sorting" : [[1, 'asc']]
			});
		}
	});
});