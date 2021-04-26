let arrdata_t_invoice_doc_in = [];
let oTable_t_invoice_doc_in;

$(document).ready(function(){
	let t = 't_invoice_doc_in';
	let opts = $.extend({}, DataTableOptionsModal, {
		ajax: {
			url: _baseurl+"exim/transaksi_doc_in/viewInvoiceDocIn",
			type: "POST",
		},
		columns: [
			{ data: "no", searchable: false, orderable: false, className: 'text-center' },
			{ data: "blank", searchable: false, orderable: false, className: 'text-center' },

			{ data: "kode_dn"  ,className: 'text-center'},
			{ data: "no_sj", className: 'text-center' },
			{ data: "no_job" },
			{ data: "nama_barang", className: 'text-center' },
			// { data: "jumlah_satuan", className: 'text-center' },
			{ data: "jumlah_barang", className: 'text-center' },
			{ data: "seri_barang", className: 'text-center' },
			{ data: "harga", visible:'true', className: 'text-center' },
			{ data: "harga_invoice", visible:'true', className: 'text-center' },
			// { data: "", visible:'true', className: 'text-center' },
			// { data: "", visible:'true', className: 'text-center' },
			{ data: "diskon", visible:'true', className: 'text-center' },
			// { data: "fob_barang", className: 'text-center' },
			// { data: "cif_barang", className: 'text-center' },
			// { data: "fob_barang", className: 'text-center' },
			// { data: "cif_barang", className: 'text-center' },
			// { data: "fob_barang", className: 'text-center' },
			// { data: "cif_barang", visible:'true', className: 'text-center' },
			// { data: "fob_barang", visible:'true', className: 'text-center' },
		],
		sorting : [[2, 'asc']],
		createdRow: function( row, data, dataIndex ) {
			renderCheck(arrdata_t_invoice_doc_in, 'id_invoice_detail', data.id_invoice_detail, row, 1, dataIndex);
		},
		drawCallback: function(){
			$('.x-check-input').off().on('click', function(){
				let parent = $(this).closest('tr');
				let data = oTable_t_invoice_doc_in.row(parent).data();
				arrdata_t_invoice_doc_in = selectRow(arrdata_t_invoice_doc_in, parent, data, 'id_invoice_detail');
			});
		}
	});
	oTable_t_invoice_doc_in = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_t_invoice_doc_in, t);
	listenShownModal(oTable_t_invoice_doc_in, t);
	listenAttach('btn-attach-invoice', arrdata_t_invoice_doc_in, t, attachData);

	$('#dt_'+t+' tbody').on( 'click', 'tr', function (e) {
		let data = dataCheckSelectedOnRow(this, oTable_t_invoice_doc_in);
		arrdata_t_invoice_doc_in = selectArray(arrdata_t_invoice_doc_in, data, 'id_invoice_detail');
	});
});
