let arrdata_t_invoice_doc_out = [];
let oTable_t_invoice_doc_out;

$(document).ready(function(){
	let t = 't_invoice_doc_out';
	let opts = $.extend({}, DataTableOptionsModal, {
		ajax: {
			url: _baseurl+"exim/transaksi_doc_out/viewInvoiceDocOut",
			type: "POST",
			data: function(data){
				if ($('.id_supplier_filter').val() != '') data.id_supplier = $('.id_supplier_filter').val();
				// console.log( data.id_supplier );
				return data;
			}
		},
		columns: [
			{ data: "no", searchable: false, orderable: false, className: 'text-center' },
			{ data: "blank", searchable: false, orderable: false, className: 'text-center' },
			{ data: "kode_invoice" },
			{ data: "kode_stuffing" },
			{ data: "kode_barang" },
			{ data: "nama_barang" },
			{ data: "satuan" },
			{ data: "qty_invoice" },
			{ data: "harga_satuan" },
			{ data: "harga_invoice" },
			{ data: "NAMA_CUSTOMER" },
		],
		sorting : [[2, 'asc']],
		createdRow: function( row, data, dataIndex ) {
			renderCheck(arrdata_t_invoice_doc_out, 'id_invoice_detail', data.id_invoice_detail, row, 1, dataIndex);
		},
		drawCallback: function(){
			$('.x-check-input').off().on('click', function(){
				let parent = $(this).closest('tr');
				let data = oTable_t_invoice_doc_out.row(parent).data();
				arrdata_t_invoice_doc_out = selectRow(arrdata_t_invoice_doc_out, parent, data, 'id_invoice_detail');
			});
		}
	});
	oTable_t_invoice_doc_out = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_t_invoice_doc_out, t);
	listenShownModal(oTable_t_invoice_doc_out, t);
	listenAttach('btn-attach-invoice', arrdata_t_invoice_doc_out, t, attachData);

	$('#dt_'+t+' tbody').on( 'click', 'tr', function (e) {
		let data = dataCheckSelectedOnRow(this, oTable_t_invoice_doc_out);
		arrdata_t_invoice_doc_out = selectArray(arrdata_t_invoice_doc_out, data, 'id_invoice_detail');
	});
});
