let oTable_detail_jaminan;

$(document).ready(function(){
	let t = 'm_detail_jaminan';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"exim/transaksi_doc_in/viewDetailJaminan",
			type: "POST",
			data : {"id_header" : id_header},
		},
		columns: [
			{ "data": "URAIAN_JENIS_JAMINAN" },
			{ "data": "NOMOR_JAMINAN" },
			{ "data": "TANGGAL_JAMINAN" },
			{ "data": "TANGGAL_JATUH_TEMPO" },
			{ "data": "PENJAMIN" },
			{ "data": "NOMOR_BPJ" },
			{ "data": "NILAI_JAMINAN" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_detail_jaminan = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_detail_jaminan, t);
	listenKeyInput(oTable_detail_jaminan, t);

	oTable_detail_jaminan.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_detail_jaminan, c);
	}).on('dblclick','tr', function(){
		var currow = $(this).closest('tr');
		var uraian= currow.find('td:eq(0)').text();
		var nomor= currow.find('td:eq(1)').text();
		var jaminan= currow.find('td:eq(2)').text();
		var jatuhtempo= currow.find('td:eq(3)').text();
		var penjamin= currow.find('td:eq(4)').text();
		var bpj= currow.find('td:eq(5)').text();
		var nilai= currow.find('td:eq(6)').text();
		// console.log(col1,col2,col3,col4);
		
		$('#uraian').val(uraian);
		$('#nomor').val(nomor);
		$('#jaminan').val(jaminan);
		$('#jatuhtempo').val(jatuhtempo);
		$('#penjamin').val(penjamin);
		$('#bpj').val(bpj);
		$('#nilai').val(nilai);


	});



	
});
