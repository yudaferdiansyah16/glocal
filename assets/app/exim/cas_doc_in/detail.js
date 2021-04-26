let valuta,tgljaminan,tglbpj,tgl261,docjaminan,docbpj,doc261;
$(document).ready(function(){
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
			{ data: "no", className:"text-center" },
			{ 
				data: "NOMOR_JAMINAN",
				render: function ( data, type, row ) {
					if (row.NOMOR_JAMINAN!='' && row.NOMOR_JAMINAN != null) {
						docjaminan = row.NOMOR_JAMINAN;
					} else {
						docjaminan = '';
					}
					if (row.TANGGAL_JAMINAN!='' && row.TANGGAL_JAMINAN != null) {
						tgljaminan = moment(row.TANGGAL_JAMINAN).format('DD-MM-YYYY');
					} else {
						tgljaminan = '';
					}
					return docjaminan + '<br>Date : ' + tgljaminan;
				},
				renderDTDate
			},
			{ data: "URAIAN_JENIS_JAMINAN" },
			{ data: "NILAI_JAMINAN",className:"textt-right"},
			{ data: "TANGGAL_JATUH_TEMPO",render: renderDTDate },
			{ data: "PENJAMIN" },
			{ 
				data: "NOMOR_BPJ",
				render: function ( data, type, row ) {
					if (row.NOMOR_BPJ!='' && row.NOMOR_BPJ != null) {
						docbpj = row.NOMOR_BPJ;
					} else {
						docbpj = '';
					}
					if (row.TANGGAL_BPJ!='' && row.TANGGAL_BPJ != null) {
						tglbpj = moment(row.TANGGAL_BPJ).format('DD-MM-YYYY');
					} else {
						tglbpj = '';
					}
					return docbpj + '<br>Date : ' + tglbpj;
				},
				renderDTDate
			},
			{ 
				data: "NOMOR_BC_261",
				render: function ( data, type, row ) {
					if (row.NOMOR_BC_261!='' && row.NOMOR_BC_261 != null) {
						doc261 = row.NOMOR_BC_261;
					} else {
						doc261 = '';
					}
					if (row.TANGGAL_BC_261!='' && row.TANGGAL_BC_261 != null) {
						tgl261 = moment(row.TANGGAL_BC_261).format('DD-MM-YYYY');
					} else {
						tgl261 = '';
					}
					return doc261 + '<br>Date : ' + tgl261;
				},
				renderDTDate
			}
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
			{ data: "no", className:"text-center"},
			{ 
				data: "URAIAN",
				render: function ( data, type, row ) {
					return row.URAIAN + '<br>Item Code : ' + row.KODE_BARANG;
				}
			},
			{ 
				data: "JUMLAH_SATUAN",
				render: function ( data, type, row ) {
					return row.JUMLAH_SATUAN + '<br>' + row.KODE_SATUAN +' ['+ row.URAIAN_SATUAN +']';
				},
				className:"text-right"
			},
			{ 
				data: "HARGA_PENYERAHAN",
				render: function ( data, type, row ) {
					if (row.KODE_VALUTA==null) {
						valuta = 'IDR';
					} else {
						valuta = row.KODE_VALUTA;
					}
					return row.HARGA_PENYERAHAN + '<br>' + valuta;
				},
				className:"text-right"
			},
			{ 
				data: "JUMLAH_KEMASAN",
				render: function ( data, type, row ) {
					return row.JUMLAH_KEMASAN + '<br>' + row.KODE_KEMASAN +' ['+ row.URAIAN_KEMASAN +']';
				},
				className:"text-right"
			},
		],
		"sorting" : [[1, 'asc']],
		"columnDefs": [
			{ 'sortable': false, 'targets': [0] }
		]
	});

	let oTable_dokumen = $('#table_dokumen').DataTable({
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
			url: _baseurl+"exim/cas_doc_in/viewDokumenDocIn/"+id_header,
			type: "POST"
		},
		"columns": [
			{ data: "no" },
			{ data: "URAIAN_DOKUMEN" },
			{ data: "NOMOR_DOKUMEN" },
			{ data: "TANGGAL_DOKUMEN" },
		],
		"sorting" : false,
		"columnDefs": [
			{ 'sortable': false, 'targets': [0] }
		]
	});
});
