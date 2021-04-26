$(document).ready(function(){
	initDatepicker($('.x-datepicker'));
	$('.select2').select2({dropdownAutoWidth : true});
	$(".input-mask").inputmask({removeMaskOnSubmit: true,autoUnmask:true,unmaskAsNumber:true});

	const table_detail = $('#dt_doc_out_add');
	const table_detail_261 = $('#table_detail_261');
	const table_dokumen = $('#table_dokumen');
	const table_kemasan = $('#table_kemasan');
	$(document).on('click', '.btn-add-dokumen', function (e) {
		const lastData = table_dokumen.find('tbody').find('tr').last();
		let i = 0;
		if (lastData.length > 0) i = lastData.data('index');
		i++;

		let row_template = $('.add_dokumen_template').find('tbody').html();
		row_template = replaceAll(row_template, "[x]", "["+i+"]");
		table_dokumen.find('tbody').append(row_template);

		let lastElement = table_dokumen.find('tbody').find('tr').last();
		lastElement.attr('data-index', i);

		table_dokumen.find('.mselect2').select2({dropdownAutoWidth : true});
		initDatepicker($('.x-datepicker'));
		$(".input-mask").inputmask();
		renderTableNumber(table_dokumen, 1);
	});
	$(document).on('click', '.btn-delete-dokumen', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_dokumen, 1);
	});
	let oTable_jaminan = $('#dt_detail_262').DataTable({
		"autoWidth" : true,
		"responsive": false,
		//"scrollX": true,
		"processing": true,
		"serverSide": true,
		"paginate": false,
		"lengthChange": false,
		"filter": true,
		"sort": true,
		"info": false,
		searching: false,
		"ajax": {
			url: _baseurl+"exim/cas_doc_in/viewjaminan/"+id_header,
			type: "POST"
		},
		"columns": [
			{ data: "no" },
			{ data: "URAIAN_JENIS_JAMINAN" },
			{ data: "NOMOR_JAMINAN" },
			{ data: "TANGGAL_JAMINAN" },
			{ data: "NILAI_JAMINAN" },
			{ data: "TANGGAL_JATUH_TEMPO" },
			{ data: "PENJAMIN" },
			{ data: "NOMOR_BPJ" },
			{ data: "TANGGAL_BPJ" },
			{ data: "NOMOR_BC_261" },
			{ data: "TANGGAL_BC_261" }
		],
		"sorting" : [[1, 'asc']],
		"columnDefs": [
			{ 'sortable': false, 'targets': [0] }
		]
	});

	let oTable_detail = $('#dt_doc_in_detail').DataTable({
		"autoWidth" : true,
		"responsive": false,
		//"scrollX": true,
		"processing": true,
		"serverSide": true,
		"paginate": false,
		"lengthChange": false,
		"filter": true,
		"sort": true,
		"info": false,
		searching: false,
		"ajax": {
			url: _baseurl+"exim/cas_doc_in/viewDetailDocIn/"+id_header,
			type: "POST"
		},
		"columns": [
			{ data: "no", className: 'text-center' },
			{ data: "URAIAN", render: function ( data, type, row, meta ) {
					return data + '<br><small>PO Date: '+row.KODE_BARANG+'</small>';
			}},
			{ data: "MERK" },
			{ data: "TIPE" },
			{ data: "UKURAN" },
			{ data: "SPESIFIKASI_LAIN" },
			{ data: "JUMLAH_SATUAN", className: 'text-right', render: function ( data, type, row, meta ) {
					return accounting.formatMoney(data, "", 4) + ' ' + row.KODE_SATUAN;
			}},
			{ data: "NETTO", className: 'text-right', render: function ( data, type, row, meta ) {
					return accounting.formatMoney(data, "", 4);
			}},
			{ data: "VOLUME", className: 'text-right', render: function ( data, type, row, meta ) {
					return accounting.formatMoney(data, "", 4);
			}},
			{ data: "CIF", className: 'text-right', render: function ( data, type, row, meta ) {
					return accounting.formatMoney(data, "", 2);
			}},
			{ data: "HARGA_PENYERAHAN", className: 'text-right', className: 'text-right', render: function ( data, type, row, meta ) {
					return accounting.formatMoney(data, "", 2);
			}}
		],
		"sorting" : [[1, 'asc']],
		"columnDefs": [
			{ 'sortable': false, 'targets': [0] }
		]
	});

	let oTable_rm_import = $('#dt_rm_import').DataTable({
		"autoWidth" : true,
		"responsive": false,
		//"scrollX": true,
		"processing": true,
		"serverSide": true,
		"paginate": false,
		"lengthChange": false,
		"filter": true,
		"sort": true,
		"info": false,
		"searching": false,
		"ajax": {
			url: _baseurl+"exim/transaksi_doc_out/viewBahanBakuDT/"+id_header,
			type: "POST"
		},
		"columns": [
			{ data: "no", className: 'text-center' },
			{ data: "KODE_JENIS_DOK_ASAL" },
			{ data: "NOMOR_AJU_DOK_ASAL" },
			{ data: "URAIAN", render: function ( data, type, row, meta ) {
					return data + '<br><small>PO Date: '+row.KODE_BARANG+'</small>';
			}},
			{ data: "MERK" },
			{ data: "TIPE" },
			{ data: "UKURAN" },
			{ data: "SPESIFIKASI_LAIN" },
			{ data: "CIF", className: 'text-right', className: 'text-right', render: function ( data, type, row, meta ) {
					return accounting.formatMoney(data, "", 2);
			}},
			{ data: "JUMLAH_SATUAN", className: 'text-right', render: function ( data, type, row, meta ) {
					return accounting.formatMoney(data, "", 4) + ' ' + row.KODE_SATUAN;
			}},
			{ data: "NDPBM", className: 'text-right', className: 'text-right', render: function ( data, type, row, meta ) {
					return accounting.formatMoney(data, "", 2);
			}},
			{ data: "NETTO", className: 'text-right', render: function ( data, type, row, meta ) {
					return accounting.formatMoney(data, "", 4);
			}},
			{ data: "CIF_RUPIAH", className: 'text-right', className: 'text-right', render: function ( data, type, row, meta ) {
					return accounting.formatMoney(data, "", 2);
			}}
		],
		"sorting" : [[1, 'asc']],
		"columnDefs": [
			{ 'sortable': false, 'targets': [0] }
		]
	});

	let oTable_rm_lokal = $('#dt_rm_lokal').DataTable({
		"autoWidth" : true,
		"responsive": false,
		//"scrollX": true,
		"processing": true,
		"serverSide": true,
		"paginate": false,
		"lengthChange": false,
		"filter": true,
		"sort": true,
		"info": false,
		searching: false,
		"ajax": {
			url: _baseurl+"exim/transaksi_doc_out/viewBahanBakuDT/"+id_header,
			type: "POST"
		},
		"columns": [
			{ data: "no", className: 'text-center' },
			{ data: "KODE_JENIS_DOK_ASAL" },
			{ data: "NOMOR_AJU_DOK_ASAL" },
			{ data: "URAIAN", render: function ( data, type, row, meta ) {
					return data + '<br><small>PO Date: '+row.KODE_BARANG+'</small>';
			}},
			{ data: "MERK" },
			{ data: "TIPE" },
			{ data: "UKURAN" },
			{ data: "SPESIFIKASI_LAIN" },
			{ data: "HARGA_PEROLEHAN", className: 'text-right', className: 'text-right', render: function ( data, type, row, meta ) {
					return accounting.formatMoney(data, "", 2);
			}},
			{ data: "HARGA_PENYERAHAN", className: 'text-right', className: 'text-right', render: function ( data, type, row, meta ) {
					return accounting.formatMoney(data, "", 2);
			}},
			{ data: "JUMLAH_SATUAN", className: 'text-right', render: function ( data, type, row, meta ) {
					return accounting.formatMoney(data, "", 4) + ' ' + row.KODE_SATUAN;
			}},
			{ data: "HARGA_PEROLEHAN" },
			{ data: "HARGA_PEROLEHAN" },
			{ data: "HARGA_PEROLEHAN" },
		],
		"sorting" : [[1, 'asc']],
		"columnDefs": [
			{ 'sortable': false, 'targets': [0] }
		]
	});

	// let oTable_dokumen = $('#table_dokumen').DataTable({
	// 	"autoWidth" : true,
	// 	"responsive": false,
	// 	//"scrollX": true,
	// 	"processing": true,
	// 	"serverSide": true,
	// 	"paginate": false,
	// 	"lengthChange": false,
	// 	"filter": true,
	// 	"sort": true,
	// 	"info": false,
	// 	searching: false,
	// 	"ajax": {
	// 		url: _baseurl+"exim/cas_doc_in/viewDokumenDocIn/"+id_header,
	// 		type: "POST"
	// 	},
	// 	"columns": [
			
	// 		{ data: "no", className: 'text-center' },
	// 		{ data: "URAIAN_DOKUMEN" },
	// 		{ data: "NOMOR_DOKUMEN" },
	// 		{ data: "TANGGAL_DOKUMEN" },
	// 	],
	// 	"sorting" : false,
	// 	"columnDefs": [
	// 		{ 'sortable': false, 'targets': [0] }
	// 	]
	// });

	$('#jenis_dokumen').change(function (e) {
		let val = $(this).val();
		$('.dokumen_template').hide();
		$('.include-'+val).show();

		let arr_tujuan_select = [];
		select2_tujuan.empty();
		$.each(arr_tujuan, function(i,v){
			if(v.KODE_DOKUMEN === val){
				//let o = new Option(v.URAIAN_TUJUAN_PENGIRIMAN, v.KODE_TUJUAN_PENGIRIMAN, false, false);
				let o = {
					id: v.KODE_TUJUAN_PENGIRIMAN,
					text: v.URAIAN_TUJUAN_PENGIRIMAN
				};
				arr_tujuan_select.push(o);
			}
		});
		select2_tujuan.select2({data: arr_tujuan_select});
	});

	$('#detail_dokumen_modal').on('shown.bs.modal', function(){
		$.post(_baseurl+'exim/transaksi_doc_out/viewHistoryDocument', id_detail_dokumen, function(res){
			console.log(res);
		},'json');
	});
	$('#detail_bahan_baku_modal').on('shown.bs.modal', function(){
		$.post(_baseurl+'exim/transaksi_doc_out/viewHistoryRM', id_detail_bahan_baku, function(res){
			console.log(res);
		},'json');
	});
	keepSession();
});
