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
			url: _baseurl+"exim/transaksi_doc_out/viewjaminan/"+id_header,
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

	let oTable_detail = $('#dt_doc_out_detail').DataTable({
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
			url: _baseurl+"exim/cas_doc_out/viewDetailDocOut/"+id_header,
			type: "POST"
		},
		"columns": [
			{ data: "no" },
			{ data: "KODE_BARANG" },
			{ data: "URAIAN" },
			{ data: "KODE_SATUAN" },
			{ data: "JUMLAH_SATUAN" },
			{ data: "HARGA_SATUAN" },
			{ data: "HARGA_INVOICE" },
			{ data: "ASURANSI" },
			{ data: "DISKON" },
			{ data: "JUMLAH_KEMASAN" },
			{ data: "KODE_KEMASAN" }
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
			url: _baseurl+"exim/cas_doc_out/viewDokumenDocOut/"+id_header,
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
