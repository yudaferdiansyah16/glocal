let arrdata_t_detail_dn_exim_in = [];
let oTable_t_detail_dn_exim_in;

$(document).ready(function(){
	let t = 't_detail_dn_exim_in';
	let opts = $.extend({}, DataTableOptionsModal, {
		ajax: {
			url: _baseurl+"exim/transaksi_doc_in/viewDetailDNDocIn",
			type: "POST",
		},
		columns: [
			{ data: "no", searchable: false, orderable: false, className: 'text-center' },
			{ data: "blank", searchable: false, orderable: false, className: 'text-center' },
			{ data: "kode_po" },
			{ data: "no_sj" },
			{ data: "no_job" },
			{ data: "kode_barang" },
			{ data: "nama_sub_barang" },
			{ data: "kode_satuan" },
			{ data: "qty_dn" },
			{ data: "harga" },
			{ data: "harga" },
			{ data: "nama_supplier" },
		],
		sorting : [[2, 'asc']],
		createdRow: function( row, data, dataIndex ) {
			renderCheck(arrdata_t_detail_dn_exim_in, 'id_detail_dn', data.id_detail_dn, row, 1, dataIndex);
		},
		drawCallback: function(){
			$('.x-check-input').off().on('click', function(){
				let parent = $(this).closest('tr');
				let data = oTable_t_bom_detail_job.row(parent).data();
				arrdata_t_detail_dn_exim_in = selectRow(arrdata_t_detail_dn_exim_in, parent, data, 'id_detail_dn');
			});
		}
	});
	oTable_t_detail_dn_exim_in = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_t_detail_dn_exim_in, t);
	listenShownModal(oTable_t_detail_dn_exim_in, t);
	listenAttach('btn-attach', arrdata_t_detail_dn_exim_in, t, attachData);

	$('#dt_'+t+' tbody').on( 'click', 'tr', function (e) {
		let data = dataCheckSelectedOnRow(this, oTable_t_detail_dn_exim_in);
		arrdata_t_detail_dn_exim_in = selectArray(arrdata_t_detail_dn_exim_in, data, 'id_detail_dn');
	});
});
