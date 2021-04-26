let arrdata_t_detail_dn_return = [];
let oTable_t_detail_dn_return;

$(document).ready(function(){
	let t = 't_detail_dn_return';
	let opts = $.extend({}, DataTableOptionsModal, {
		ajax: {
			url: _baseurl+"exim/purchase_return/viewDetailDNReturn",
            type: "POST",
            data: function(data){
				if ($('.id_dn').val() != '') data.id_dn = $('.id_dn').val();
				return data;
			}
		},
		columns: [
			{ data: "no", searchable: false, orderable: false, className: 'text-center' },
			{ data: "blank", searchable: false, orderable: false, className: 'text-center' },
			{ data: "kode_dn" },
			{ data: "kode_barang" },
			{ data: "nama_sub_barang" },
			{ data: "kode_satuan" },
			{ data: "qty_dn" },
		],
		sorting : [[2, 'asc']],
		createdRow: function( row, data, dataIndex ) {
			renderCheck(arrdata_t_detail_dn_return, 'id_detail_dn', data.id_detail_dn, row, 1, dataIndex);
		},
		drawCallback: function(){
			$('.x-check-input').off().on('click', function(){
				let parent = $(this).closest('tr');
				let data = oTable_t_bom_detail_job.row(parent).data();
				arrdata_t_detail_dn_return = selectRow(arrdata_t_detail_dn_return, parent, data, 'id_detail_dn');
			});
		}
	});
	oTable_t_detail_dn_return = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_t_detail_dn_return, t);
	listenShownModal(oTable_t_detail_dn_return, t);
	listenAttach('btn-attach', arrdata_t_detail_dn_return, t, attachData);

	$('#dt_'+t+' tbody').on( 'click', 'tr', function (e) {
		let data = dataCheckSelectedOnRow(this, oTable_t_detail_dn_return);
		arrdata_t_detail_dn_return = selectArray(arrdata_t_detail_dn_return, data, 'id_detail_dn');
	});
});
