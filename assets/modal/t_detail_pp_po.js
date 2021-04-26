let arrdata_job_pp_po = [];
let oTable_t_detail_pp_po;

$(document).ready(function(){
	let  t = 't_detail_pp_po';
	let opts = $.extend({},DataTableOptionsModal, {
		ajax: {
			url: _baseurl+"procurement/purchase_order/viewDetailPPPO",
			type: "POST",
			data: function(data){
				if ($('.nama_job').val() != '') data.nama_job = $('.nama_job').val();
				return data;
			}
		},
		columns: [
			{ data: "no", searchable: false, orderable: false, className: 'text-center' },
			{ data: "blank", searchable: false, orderable: false, className: 'x-check-cell' },
			{ 
				data: "kode_pp",
				render: function ( data, type, row ) {
					return "<p style='margin:0;padding:0;'>"+row.kode_pp+"</p><small style='margin:0;padding:0;'>"+row.tanggal_dibuat+"</small>";
				}
			},
			{ 
				data: "no_job",
				render: function ( data, type, row ) {
					return "<p style='margin:0;padding:0;'>"+row.no_job+"</p><small style='margin:0;padding:0;'>"+row.tanggal_job+"</small>";
				}
			},
			{ 
				data: "nama_barang",
				render: function ( data, type, row ) {
					return "<p style='margin:0;padding:0;'>"+row.nama_barang+"</p><small style='margin:0;padding:0;'>"+row.kode_barang+"</small>";
				}
			},
			{ data: "qty_sisa",className:"text-right" },
		],
		sorting : [[2, 'asc']],
		createdRow: function( row, data, dataIndex ) {
			renderCheck(arrdata_job_pp_po, 'id_detail_pp', data.id_detail_pp, row, 1, dataIndex);
		},
		drawCallback: function(){
			$('.x-check-input').off('click').on('click', function(e){
				let parent = $(this).closest('tr');
				let data = oTable_t_detail_pp_po.row(parent).data();
				arrdata_job_pp_po = selectRow(arrdata_job_pp_po, parent, data, 'id_detail_pp');
			});
			$.fn.dataTable.tables( { visible: true, api: true } ).columns.adjust();
		}
	});
	oTable_t_detail_pp_po = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_t_detail_pp_po, t);
	listenShownModal(oTable_t_detail_pp_po, t);
	listenAttach('btn-attach', arrdata_job_pp_po, t, attachData);

	$('#dt_'+t+' tbody').on( 'click', 'tr', function (e,a,b) {
		let data = dataCheckSelectedOnRow(this, oTable_t_detail_pp_po);
		arrdata_job_pp_po = selectArray(arrdata_job_pp_po, data, 'id_detail_pp');
	});
});
