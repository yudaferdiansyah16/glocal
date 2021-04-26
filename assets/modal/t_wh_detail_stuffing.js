let arrdata_t_wh_detail_stuffing = [];
let oTable_t_wh_detail_stuffing;

$(document).ready(function(){
	let t = 't_wh_detail_stuffing';
	let opts = $.extend({},DataTableOptionsModal, {
		ajax: {
			url: _baseurl+"warehouse/stuffing/viewwhdt/false",
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
			{ data: "kode_barang", className: 'text-center', visible: false },
			{ data: "nama_barang", "render": function ( data, type, row, meta ) {
				return data + "<br><small>" + row.kode_barang + "</small>";
			} },
			{ data: "kode_po", "render": function ( data, type, row, meta ) {
				return data + "<br><small>SO Date: " + moment(row.tanggal_dibuat).format('DD-MM-YYYY') + "</small>";
			}  },
			{ data: "po_buyer", className: 'text-center' },
			{ data: "tanggal_dibuat", className: 'text-center', "render": renderDTDate, visible: false },
			{ data: "no_job", "render": function ( data, type, row, meta ) {
				return data + "<br><small>Job Date: " + moment(row.tanggal_job).format('DD-MM-YYYY') + "</small>";
			} },
			{ data: "kode_mutasi", "render": function ( data, type, row, meta ) {
					return data + "<br><small>Trans. Date: " + moment(row.tanggal_terima).format('DD-MM-YYYY') + "</small>";
			} },
			{ data: "qty_remain", className: 'text-right', "render": function ( data, type, row, meta ) {
					return data + " " + row.kode_satuan;
				}  }
		],
		sorting : [[2, 'asc']],
		createdRow: function( row, data, dataIndex ) {
			renderCheck(arrdata_t_wh_detail_stuffing, 'id_wh_detail', data.id_wh_detail, row, 1, dataIndex);
		},
		drawCallback: function(){
			$('.x-check-input').off().on('click', function(){
				let parent = $(this).closest('tr');
				let data = oTable_t_wh_detail_stuffing.row(parent).data();
				arrdata_t_wh_detail_stuffing = selectRow(arrdata_t_wh_detail_stuffing, parent, data, 'id_sub_barang');
			});
		}
	});
	oTable_t_wh_detail_stuffing = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_t_wh_detail_stuffing, t);
	listenShownModal(oTable_t_wh_detail_stuffing, t);
	listenAttach('btn-attach-barang', arrdata_t_wh_detail_stuffing, t, attachData);

	$('#dt_'+t+' tbody').on( 'click', 'tr', function (e) {
		let data = dataCheckSelectedOnRow(this, oTable_t_wh_detail_stuffing);
		arrdata_t_wh_detail_stuffing = selectArray(arrdata_t_wh_detail_stuffing, data, 'id_sub_barang');
	});
});
