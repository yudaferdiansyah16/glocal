let arrdata_t_detail_stuffing_invoice = [];
let oTable_t_detail_stuffing_invoice;

$(document).ready(function(){
	let t = 't_detail_stuffing_invoice';
	let opts = $.extend({},DataTableOptionsModal, {
		ajax: {
			url: _baseurl+"warehouse/stuffing/viewinvoicedt/false",
			type: "POST",
			"data": function(data){
				if ($('.id_supplier').val() != '') data.id_supplier = $('.id_supplier').val(); else data.id_supplier = 'xxx';
				if ($('.id_tipe_sales').val() != '') data.id_tipe_sales = $('.id_tipe_sales').val(); else data.id_tipe_sales = 'xxx';
				return data;
			}
		},
		columns: [
			{ data: "no", searchable: false, orderable: false, className: 'text-center' },
			{ data: "blank", searchable: false, orderable: false, className: 'text-center x-check-cell' },
			{ data: "kode_barang", className: 'text-center' },
			{ data: "nama_barang" },
			{ data: "kode_po", className: 'text-center' },
			{ data: "po_buyer", className: 'text-center' },
			{ data: "tanggal_dibuat", className: 'text-center', "render": function ( data, type, row, meta ) {
					return moment(data).format('DD-MM-YYYY');
				}},
			{ data: "kode_stuffing", className: 'text-center' },
			{ data: "tanggal_stuffing", className: 'text-center', "render": function ( data, type, row, meta ) {
					return moment(data).format('DD-MM-YYYY');
			} },
			{ data: "qty_mc_real", className: 'text-right', "render": function ( data, type, row, meta ) {
				return data + " " + row.kode_kemasan;
			} },
			{ data: "qty_remain", className: 'text-right', "render": function ( data, type, row, meta ) {
					return data + " " + row.kode_satuan;
				}  }
		],
		sorting : [[2, 'asc']],
		createdRow: function( row, data, dataIndex ) {
			renderCheck(arrdata_t_detail_stuffing_invoice, 'id_detail_stuffing', data.id_detail_stuffing, row, 1, dataIndex);
		},
		drawCallback: function(){
			$('.x-check-input').off().on('click', function(){
				let parent = $(this).closest('tr');
				let data = oTable_t_detail_stuffing_invoice.row(parent).data();
				arrdata_t_detail_stuffing_invoice = selectRow(arrdata_t_detail_stuffing_invoice, parent, data, 'id_sub_barang');
			});
		}
	});
	oTable_t_detail_stuffing_invoice = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_t_detail_stuffing_invoice, t);
	listenShownModal(oTable_t_detail_stuffing_invoice, t);
	listenAttach('btn-attach-barang', arrdata_t_detail_stuffing_invoice, t, attachData);

	$('#dt_'+t+' tbody').on( 'click', 'tr', function (e) {
		let data = dataCheckSelectedOnRow(this, oTable_t_detail_stuffing_invoice);
		arrdata_t_detail_stuffing_invoice = selectArray(arrdata_t_detail_stuffing_invoice, data, 'id_sub_barang');
	});
});
