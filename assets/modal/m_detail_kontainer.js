let oTable_detail_kontainer;

$(document).ready(function(){
	let t = 'm_detail_kontainer';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"exim/transaksi_doc_in/viewDetailKontainer",
			type: "POST",
			data : {"id_header" : id_header},
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "NOMOR_KONTAINER" },
			{ "data": "KODE_UKURAN_KONTAINER" },
			{ "data": "KODE_TIPE_KONTAINER" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_detail_kontainer = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_detail_kontainer, t);
	listenKeyInput(oTable_detail_kontainer, t);

	oTable_detail_kontainer.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_detail_kontainer, c);
	}).on('dblclick','tr', function(){
		var currow = $(this).closest('tr');
		var no= currow.find('td:eq(0)').text();
		var nomor= currow.find('td:eq(1)').text();
		var ukuran= currow.find('td:eq(2)').text();
		var tipe= currow.find('td:eq(3)').text();
				
		$('#nomor').val(nomor);
		$('#ukuran').val(ukuran);
		$('#tipe').val(tipe);


	});



	
});
