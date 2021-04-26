let oTable_detail_kemasan;

$(document).ready(function(){
	let t = 'm_detail_kemasan';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"exim/transaksi_doc_in/viewDetailKemasan",
			type: "POST",
			data : {"id_header" : id_header},
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "JUMLAH_KEMASAN" },
			{ "data": "KODE_JENIS_KEMASAN" },
			{ "data": "URAIAN_KEMASAN" },
			{ "data": "MERK_KEMASAN" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_detail_kemasan = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_detail_kemasan, t);
	listenKeyInput(oTable_detail_kemasan, t);

	oTable_detail_kemasan.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_detail_kemasan, c);
	}).on('dblclick','tr', function(){
		var currow = $(this).closest('tr');
		var no= currow.find('td:eq(0)').text();
		var jumlah= currow.find('td:eq(1)').text();
		var kode= currow.find('td:eq(2)').text();
		var uraian= currow.find('td:eq(3)').text();
		var merk= currow.find('td:eq(4)').text();
		// console.log(col1,col2,col3,col4);
		
		$('#jumlah').val(jumlah);
		$('#jenis').val(uraian);
		$('#merk').val(merk);


	});



	
});
