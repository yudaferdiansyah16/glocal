let arrdata_t_detail_po_dn = [];
let  oTable_t_detail_po_dn = null;

$(document).ready(function(){
	let  t = 't_detail_po_dn';

	let opts = $.extend({},DataTableOptionsModal, {
		ajax: {
			url: _baseurl+"procurement/delivery_note_po/viewDNDT",
			type: "POST",
			"data": function(data){
				if ($('.id_supplier').val() != '') data.id_supplier = $('.id_supplier').val();
				return data;
			}
		},
		columns: [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "blank", searchable: false, className: 'x-check-cell' },
			{ data: "kode_po", className: 'text-center' },
			{ data: "tanggal_dibuat", className: 'text-center' },
			{ data: "nama_supplier" },
			{ data: "nama_barang" },
			{ data: "kode_satuan", className: 'text-center' },
			{ data: "qty_po", className: 'text-right' },
			{ data: "qty_dn", className: 'text-right' },
			{ data: "sisa_qty_dn", className: 'text-right' },
			{ data: "kode_valuta", className: 'text-center' },
			{ data: "harga", className: 'text-right' }
		],
		sorting : [[2, 'asc']],
		createdRow: function( row, data, dataIndex ) {
			renderCheck(arrdata_t_detail_po_dn, 'id_detail_po', data.id_detail_po, row, 1, dataIndex);
		},
		drawCallback: function(){
			$('.x-check-input').off().on('click', function(){
				let parent = $(this).closest('tr');
				let data = oTable_t_detail_po_dn.row(parent).data();
				arrdata_t_detail_po_dn = selectRow(arrdata_t_detail_po_dn, parent, data, 'id_detail_po');
			});
		}
	});
	oTable_t_detail_po_dn = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_t_detail_po_dn, t);
	listenShownModal(oTable_t_detail_po_dn, t);
	listenAttach('btn-attach', arrdata_t_detail_po_dn, t, attachData);

	$('#dt_'+t+' tbody').on( 'click', 'tr', function (e) {
		let data = dataCheckSelectedOnRow(this, oTable_t_detail_po_dn);
		arrdata_t_detail_po_dn = selectArray(arrdata_t_detail_po_dn, data, 'id_detail_po');
	});
});

