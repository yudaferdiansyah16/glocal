let arrdata_dt_pp_non_add = [];
let oTable_dt_pp_non_add;

$(document).ready(function(){
	let  t = 'dt_m_sub_barang_pp';
	let opts = $.extend({},DataTableOptionsModal, {
		ajax: {
			url: _baseurl+"master/sub_barang/viewdt/false",
			type: "POST",
		},
		columns: [
			{ data: "no", searchable: false, orderable: false, className: 'text-center' },
			{ data: "blank", searchable: false, orderable: false, className: 'x-check-cell' },
			{ data: "kode_barang" },
			{ data: "nama_barang" },
			{ data: "nama_brand" },
			{ data: "dimensi" },
			{ data: "size" },
			{ data: "harga" },
			{ data: "keterangan" },
		],
		sorting : [[2, 'asc']],
		createdRow: function( row, data, dataIndex ) {
			renderCheck(arrdata_dt_m_sub_barang_pp, 'id_sub_barang', data.id_sub_barang, row, 1, dataIndex);
		},
		drawCallback: function(){
			$('.x-check-input').off().on('click', function(){
				let parent = $(this).closest('tr');
				let data = oTable_dt_m_sub_barang_pp.row(parent).data();
				arrdata_dt_m_sub_barang_pp = selectRow(arrdata_dt_m_sub_barang_pp, parent, data, 'id_sub_barang');
			});
			$.fn.dataTable.tables( { visible: true, api: true } ).columns.adjust();
		}
	});
	oTable_dt_m_sub_barang_pp = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_dt_m_sub_barang_pp, t);
	listenShownModal(oTable_dt_m_sub_barang_pp, t);
	listenAttach('btn-attach', arrdata_dt_m_sub_barang_pp, t, attachData);

	$('#dt_'+t+' tbody').on( 'click', 'tr', function (e) {
		let data = dataCheckSelectedOnRow(this, oTable_dt_m_sub_barang_pp);
		arrdata_dt_m_sub_barang_pp = selectArray(arrdata_dt_m_sub_barang_pp, data, 'id_sub_barang');
	});
});
