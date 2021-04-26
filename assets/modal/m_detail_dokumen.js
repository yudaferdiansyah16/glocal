let oTable_detail_dokumen;

$(document).ready(function(){
	let t = 'm_detail_dokumen';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"exim/transaksi_doc_in/viewDetailDokumen",
			type: "POST",
			data : {"id_header" : id_header},
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "KODE_JENIS_DOKUMEN" },
			{ "data": "URAIAN_DOKUMEN" },
			{ "data": "NOMOR_DOKUMEN" },
			{ "data": "TANGGAL_DOKUMEN" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_detail_dokumen = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_detail_dokumen, t);
	listenKeyInput(oTable_detail_dokumen, t);

	oTable_detail_dokumen.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_detail_dokumen, c);
	}).on('dblclick','tr', function(){
		var currow = $(this).closest('tr');
		var col0= currow.find('td:eq(0)').text();
		var kode_dok= currow.find('td:eq(1)').text();
		var col2= currow.find('td:eq(2)').text();
		var nomor_dok= currow.find('td:eq(3)').text();
		var tanggal_dok= currow.find('td:eq(4)').text();
		// console.log(col1,col2,col3,col4);
		
		$('#kode_dok').val(kode_dok);
		$('#nomor_dok').val(nomor_dok);
		$('#tanggal_dok').val(tanggal_dok);


	});



	
});
