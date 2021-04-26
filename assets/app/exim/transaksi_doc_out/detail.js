$(document).ready(function(){
	createPagination(0);
	$('#pagination').on('click','a',function(e){
		e.preventDefault(); 
		var pageNum = $(this).attr('data-ci-pagination-page');
		createPagination(pageNum);
	});
	function createPagination(pageNum){
		$.ajax({
			url: _baseurl+"exim/cas_doc_in/viewjaminan/"+id_header,
			type: "POST",
			dataType: 'json',
			success: function(responseData){
				$('#pagination').html(responseData.pagination);
				paginationData(responseData.empData);
			}
		});
	}
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
		"paginate": true,
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

	oTable = $('#dt').DataTable({
		"autoWidth" : true,
		"responsive": false,
		//"scrollX": true,
		"processing": true,
		"serverSide": true,
		"paginate": true,
		"lengthChange": false,
		"filter": true,
		"sort": true,
		"info": false,
		searching: false,
		// "ajax": {
		// 	url: _baseurl+"exim/transaksi_doc_out/viewBahanBakuDT/"+id_header,
		// 	type: "POST"
		// },
		// "columns": [
		// 	{ data: "no", className: 'text-center' },
		// 	{ data: "KODE_JENIS_DOK_ASAL" },
		// 	{ data: "NOMOR_AJU_DOK_ASAL" },
		// 	{ data: "URAIAN", render: function ( data, type, row, meta ) {
		// 			return data + '<br><small>PO Date: '+row.KODE_BARANG+'</small>';
		// 	}},
		// 	{ data: "MERK" },
		// 	{ data: "TIPE" },
		// 	{ data: "UKURAN" },
		// 	{ data: "SPESIFIKASI_LAIN" },
		// 	{ data: "HARGA_PEROLEHAN", className: 'text-right', className: 'text-right', render: function ( data, type, row, meta ) {
		// 			return accounting.formatMoney(data, "", 2);
		// 	}},
		// 	{ data: "HARGA_PENYERAHAN", className: 'text-right', className: 'text-right', render: function ( data, type, row, meta ) {
		// 			return accounting.formatMoney(data, "", 2);
		// 	}},
		// 	{ data: "JUMLAH_SATUAN", className: 'text-right', render: function ( data, type, row, meta ) {
		// 			return accounting.formatMoney(data, "", 4) + ' ' + row.KODE_SATUAN;
		// 	}},
		// 	{ data: "HARGA_PEROLEHAN" },
		// 	{ data: "HARGA_PEROLEHAN" },
		// 	{ data: "HARGA_PEROLEHAN" },
		// ],
		// "sorting" : [[1, 'asc']],
		// "columnDefs": [
		// 	{ 'sortable': false, 'targets': [0] }
		// ]
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
			{ data: "no", className: 'text-center' },
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

$("#btn3").click(function () {
$.ajax({
	url: _baseurl + "exim/transaksi_doc_out/viewDetailBarang/",
	type: "POST",
	data: {
		"id_header": id_header
	},
	dataType: "JSON",
	success: function (data) {
		var length = data.tampil.data.length;
		var no = 0;
		var kode_barang = data.tampil.data;
		var uraian_barang = data.tampil.data.URAIAN;
		var merk = data.tampil.data.MERK;
		var merk = data.tampil.data.MERK;
		var status =data.tampil.data[0].KODE_STATUS;


		console.log(data.tampil);
		$('#result').html(data.tampil.data[0].ID);
			no = 0;
			status = data.tampil.data[no].ID;
			var kode_barang = data.tampil.data[no].KODE_BARANG;
			var uraian_barang = data.tampil.data[no].URAIAN;
			var merk = data.tampil.data[no].MERK;
			var hs = data.tampil.data[no].HARGA_SATUAN;
			var tipe = data.tampil.data[no].TIPE;
			var ukuran = data.tampil.data[no].UKURAN;
			var spf = data.tampil.data[no].SPESIFIKASI_LAIN;
			var jml_satuan = data.tampil.data[no].JUMLAH_SATUAN;
			var kategori_barang = data.tampil.data[no].KATEGORI_BARANG;
			var seri_ijin = data.tampil.data[no].SERI_IJIN;
			var harga_satuan = data.tampil.data[no].HARGA_SATUAN;
			var cif = data.tampil.data[no].CIF;
			var cif_rp = data.tampil.data[no].CIF_RUPIAH;
			var jumlah_kemasan = data.tampil.data[no].JUMLAH_KEMASAN;
			var netto = data.tampil.data[no].NETTO;
			var harga_penyerahan = data.tampil.data[no].HARGA_PENYERAHAN;
			var jenis_satuan = data.tampil.data[no].KODE_SATUAN;
console.log(kode_barang);

			$( "#prev" ).addClass( " previous disabled " );

			$('#no_barang').val(no+1);
			$('#status').val(status);
			$('#jumlah_barang').val(length);
			$('#kode_barang').val(kode_barang);
			$('#uraian').val(uraian_barang);
			$('#merk').val(merk);
			$('#hs').val(hs);
			$('#tipe').val(tipe);
			$('#ukuran').val(ukuran);
			$('#spf').val(spf);
			$('#jumlah_satuan').val(jml_satuan);
			$('#kategori_barang').val(kategori_barang);
			$('#seri_ijin').val(seri_ijin);
			$('#harga_satuan').val(harga_satuan);
			$('#cif').val(cif);
			$('#cif_rp').val(cif_rp);
			$('#jumlah_kemasan').val(jumlah_kemasan);
			$('#netto').val(netto);
			$('#harga_penyerahan').val(harga_penyerahan);
			$('#jenis_satuan').val(jenis_satuan);

			$("#brg_prev").click(function () {
				
				if (no  == 1){
			$( "#prev" ).addClass( " previous disabled " );
			no = 0;
			status = data.tampil.data[no].ID;
			var kode_barang = data.tampil.data[no].KODE_BARANG;
			var uraian_barang = data.tampil.data[no].URAIAN;
			var merk = data.tampil.data[no].MERK;
			var hs = data.tampil.data[no].HARGA_SATUAN;
			var tipe = data.tampil.data[no].TIPE;
			var ukuran = data.tampil.data[no].UKURAN;
			var spf = data.tampil.data[no].SPESIFIKASI_LAIN;
			var jml_satuan = data.tampil.data[no].JUMLAH_SATUAN;
			var kategori_barang = data.tampil.data[no].KATEGORI_BARANG;
			var seri_ijin = data.tampil.data[no].SERI_IJIN;
			var harga_satuan = data.tampil.data[no].HARGA_SATUAN;
			var cif = data.tampil.data[no].CIF;
			var cif_rp = data.tampil.data[no].CIF_RUPIAH;
			var jumlah_kemasan = data.tampil.data[no].JUMLAH_KEMASAN;
			var netto = data.tampil.data[no].NETTO;
			var harga_penyerahan = data.tampil.data[no].HARGA_PENYERAHAN;
			var jenis_satuan = data.tampil.data[no].KODE_SATUAN;
			
			
			
			$('#status').val(status);
			$('#jumlah_barang').val(length);
			$('#no_barang').val(no + 1);
			$('#kode_barang').val(kode_barang);
			$('#uraian').val(uraian_barang);
			$('#merk').val(merk);
			$('#hs').val(hs);
			$('#tipe').val(tipe);
			$('#ukuran').val(ukuran);
			$('#spf').val(spf);
			$('#jumlah_satuan').val(jml_satuan);
			$('#kategori_barang').val(kategori_barang);
			$('#seri_ijin').val(seri_ijin);
			$('#harga_satuan').val(harga_satuan);
			$('#cif').val(cif);
			$('#cif_rp').val(cif_rp);
			$('#jumlah_kemasan').val(jumlah_kemasan);
			$('#netto').val(netto);
			$('#harga_penyerahan').val(harga_penyerahan);
			$('#jenis_satuan').val(jenis_satuan);
			
			
		}else{
			$( "#next" ).removeClass( " next disabled " );
			no = no - 1;
			status = data.tampil.data[no].ID;
			
			var kode_barang = data.tampil.data[no].KODE_BARANG;
			var uraian_barang = data.tampil.data[no].URAIAN;
			var merk = data.tampil.data[no].MERK;
			var hs = data.tampil.data[no].HARGA_SATUAN;
			var tipe = data.tampil.data[no].TIPE;
			var ukuran = data.tampil.data[no].UKURAN;
			var spf = data.tampil.data[no].SPESIFIKASI_LAIN;
			var jml_satuan = data.tampil.data[no].JUMLAH_SATUAN;
			var kategori_barang = data.tampil.data[no].KATEGORI_BARANG;
			var seri_ijin = data.tampil.data[no].SERI_IJIN;
			var harga_satuan = data.tampil.data[no].HARGA_SATUAN;
			var cif = data.tampil.data[no].CIF;
			var cif_rp = data.tampil.data[no].CIF_RUPIAH;
			var jumlah_kemasan = data.tampil.data[no].JUMLAH_KEMASAN;
			var netto = data.tampil.data[no].NETTO;
			var harga_penyerahan = data.tampil.data[no].HARGA_PENYERAHAN;
			var jenis_satuan = data.tampil.data[no].KODE_SATUAN;
			
			
			$('#status').val(status);
			$('#jumlah_barang').val(length);
			$('#no_barang').val(no + 1);
			$('#kode_barang').val(kode_barang);
			$('#uraian').val(uraian_barang);
			$('#merk').val(merk);
			$('#hs').val(hs);
			$('#tipe').val(tipe);
			$('#ukuran').val(ukuran);
			$('#spf').val(spf);
			$('#jumlah_satuan').val(jml_satuan);
			$('#kategori_barang').val(kategori_barang);
			$('#seri_ijin').val(seri_ijin);
			$('#harga_satuan').val(harga_satuan);
			$('#cif').val(cif);
			$('#cif_rp').val(cif_rp);
			$('#jumlah_kemasan').val(jumlah_kemasan);
			$('#netto').val(netto);
			$('#harga_penyerahan').val(harga_penyerahan);
			$('#jenis_satuan').val(jenis_satuan);

			
		}
		});
		$("#brg_next").click(function () {
			no = no + 1;
			if (no +1 == length){
			$( "#next" ).addClass( " next disabled " );
			}
			$( "#prev" ).removeClass( " previous disabled " );
			var kode_barang = data.tampil.data[no].KODE_BARANG;
			var uraian_barang = data.tampil.data[no].URAIAN;
			var merk = data.tampil.data[no].MERK;
			var hs = data.tampil.data[no].HARGA_SATUAN;
			var tipe = data.tampil.data[no].TIPE;
			var ukuran = data.tampil.data[no].UKURAN;
			var spf = data.tampil.data[no].SPESIFIKASI_LAIN;
			var jml_satuan = data.tampil.data[no].JUMLAH_SATUAN;
			var kategori_barang = data.tampil.data[no].KATEGORI_BARANG;
			var seri_ijin = data.tampil.data[no].SERI_IJIN;
			var harga_satuan = data.tampil.data[no].HARGA_SATUAN;
			var cif = data.tampil.data[no].CIF;
			var cif_rp = data.tampil.data[no].CIF_RUPIAH;
			var jumlah_kemasan = data.tampil.data[no].JUMLAH_KEMASAN;
			var netto = data.tampil.data[no].NETTO;
			var harga_penyerahan = data.tampil.data[no].HARGA_PENYERAHAN;
			var jenis_satuan = data.tampil.data[no].KODE_SATUAN;
			
			
			status = data.tampil.data[no].ID;
			$('#status').val(status);
			$('#jumlah_barang').val(length);
			$('#no_barang').val(no + 1);
			$('#kode_barang').val(kode_barang);
			$('#uraian').val(uraian_barang);
			$('#merk').val(merk);
			$('#hs').val(hs);
			$('#tipe').val(tipe);
			$('#ukuran').val(ukuran);
			$('#spf').val(spf);
			$('#jumlah_satuan').val(jml_satuan);
			$('#kategori_barang').val(kategori_barang);
			$('#seri_ijin').val(seri_ijin);
			$('#harga_satuan').val(harga_satuan);
			$('#cif').val(cif);
			$('#cif_rp').val(cif_rp);
			$('#jumlah_kemasan').val(jumlah_kemasan);
			$('#netto').val(netto);
			$('#harga_penyerahan').val(harga_penyerahan);
			$('#jenis_satuan').val(jenis_satuan);
			
			
		});
	}
});

$.ajax({
	url: _baseurl + "exim/transaksi_doc_out/viewDetailLokalBarang/",
	type: "POST",
	data: {
		"id_header": id_header
	},
	dataType: "JSON",
	success: function (data) {
		var length = data.data.length;
		var no = 0;
		var kode_barang = data.data;
		var uraian_barang = data.data.nama_barang;
		var merk = data.data.MERK;
		var merk = data.data.MERK;
		var status =data.data[0].KODE_STATUS;

		
		console.log(data);
		$('#result').html(data.data[0].ID);
			no = 0;
			status = data.data[no].ID;
			var no_aju= data.data[no].NOMOR_AJU;
			var kode_barang = data.data[no].KODE_BARANG;
			var uraian_barang = data.data[no].nama_barang;
			var merk = data.data[no].MERK;
			var tipe = data.data[no].TIPE;
			var ukuran = data.data[no].UKURAN;
			var spf = data.data[no].SPESIFIKASI_LAIN;
			var jml_satuan = data.data[no].JUMLAH_SATUAN;
			var kategori_barang = data.data[no].KATEGORI_BARANG;
			var seri_ijin = data.data[no].SERI_IJIN;
			var harga_satuan = data.data[no].HARGA_SATUAN;
			var cif = data.data[no].CIF;
			var cif_rp = data.data[no].CIF_RUPIAH;
			var jumlah_kemasan = data.data[no].JUMLAH_KEMASAN;
			var netto = data.data[no].NETTO;
			var harga_penyerahan = data.data[no].HARGA_PENYERAHAN;
			var jenis_satuan = data.data[no].uraian_satuan_terkecil;
			var nomor_dokumen = data.data[no].NOMOR_DOKUMEN;
			console.log(kode_barang);
			
			$( "#prev_lokal" ).addClass( " previous disabled " );
			
			$('#no_barlokal').val(no+1);
			$('#statuslokal').val(status);
			$('#nomor_ajulokal').val(no_aju);
			$('#jumlah_baranglokal').val(length);
			$('#kode_baranglokal').val(kode_barang);
			$('#uraianlokal').val(uraian_barang);
			$('#merklokal').val(merk);
			$('#tipelokal').val(tipe);
			$('#ukuranlokal').val(ukuran);
			$('#spflokal').val(spf);
			$('#jumlah_satuanlokal').val(jml_satuan);
			$('#kategori_baranglokal').val(kategori_barang);
			$('#seri_ijinlokal').val(seri_ijin);
			$('#harga_satuanlokal').val(harga_satuan);
			$('#ciflokal').val(cif);
			$('#cif_rplokal').val(cif_rp);
			$('#jumlah_kemasanlokal').val(jumlah_kemasan);
			$('#nettolokal').val(netto);
			$('#harga_penyerahanlokal').val(harga_penyerahan);
			$('#jenis_satuanlokal').val(jenis_satuan);
			$('#no_dokumenlokal').val(nomor_dokumen);
			
		$("#brg_prevlokal").click(function () {

			if (no  == 1){
				$( "#prev_lokal" ).addClass( " previous disabled " );
			no = 0;
			status = data.data[no].ID;
			var no_aju= data.data[no].NOMOR_AJU;
			var kode_barang = data.data[no].KODE_BARANG;
			var uraian_barang = data.data[no].nama_barang;
			var merk = data.data[no].MERK;
			var tipe = data.data[no].TIPE;
			var ukuran = data.data[no].UKURAN;
			var spf = data.data[no].SPESIFIKASI_LAIN;
			var jml_satuan = data.data[no].JUMLAH_SATUAN;
			var kategori_barang = data.data[no].KATEGORI_BARANG;
			var seri_ijin = data.data[no].SERI_IJIN;
			var harga_satuan = data.data[no].HARGA_SATUAN;
			var cif = data.data[no].CIF;
			var cif_rp = data.data[no].CIF_RUPIAH;
			var jumlah_kemasan = data.data[no].JUMLAH_KEMASAN;
			var netto = data.data[no].NETTO;
			var harga_penyerahan = data.data[no].HARGA_PENYERAHAN;
			var jenis_satuan = data.data[no].uraian_satuan_terkecil;
			var nomor_dokumen = data.data[no].NOMOR_DOKUMEN;
			
			
			
			$('#no_barlokal').val(no+1);
			$('#statuslokal').val(status);
			$('#nomor_ajulokal').val(no_aju);
			$('#jumlah_baranglokal').val(length);
			$('#kode_baranglokal').val(kode_barang);
			$('#uraianlokal').val(uraian_barang);
			$('#merklokal').val(merk);
			$('#tipelokal').val(tipe);
			$('#ukuranlokal').val(ukuran);
			$('#spflokal').val(spf);
			$('#jumlah_satuanlokal').val(jml_satuan);
			$('#kategori_baranglokal').val(kategori_barang);
			$('#seri_ijinlokal').val(seri_ijin);
			$('#harga_satuanlokal').val(harga_satuan);
			$('#ciflokal').val(cif);
			$('#cif_rplokal').val(cif_rp);
			$('#jumlah_kemasanlokal').val(jumlah_kemasan);
			$('#nettolokal').val(netto);
			$('#harga_penyerahanlokal').val(harga_penyerahan);
			$('#jenis_satuanlokal').val(jenis_satuan);
			$('#no_dokumenlokal').val(nomor_dokumen);
			
			
		}else{
			$( "#next_lokal" ).removeClass( " next disabled " );
			no = no - 1;
			status = data.data[no].ID;
			var no_aju= data.data[no].NOMOR_AJU;
			var kode_barang = data.data[no].KODE_BARANG;
			var uraian_barang = data.data[no].nama_barang;
			var merk = data.data[no].MERK;
			var tipe = data.data[no].TIPE;
			var ukuran = data.data[no].UKURAN;
			var spf = data.data[no].SPESIFIKASI_LAIN;
			var jml_satuan = data.data[no].JUMLAH_SATUAN;
			var kategori_barang = data.data[no].KATEGORI_BARANG;
			var seri_ijin = data.data[no].SERI_IJIN;
			var harga_satuan = data.data[no].HARGA_SATUAN;
			var cif = data.data[no].CIF;
			var cif_rp = data.data[no].CIF_RUPIAH;
			var jumlah_kemasan = data.data[no].JUMLAH_KEMASAN;
			var netto = data.data[no].NETTO;
			var harga_penyerahan = data.data[no].HARGA_PENYERAHAN;
			var jenis_satuan = data.data[no].uraian_satuan_terkecil;
			var nomor_dokumen = data.data[no].NOMOR_DOKUMEN;
			
			
			$('#no_barlokal').val(no+1);
			$('#statuslokal').val(status);
			$('#nomor_ajulokal').val(no_aju);
			$('#jumlah_baranglokal').val(length);
			$('#kode_baranglokal').val(kode_barang);
			$('#uraianlokal').val(uraian_barang);
			$('#merklokal').val(merk);
			$('#tipelokal').val(tipe);
			$('#ukuranlokal').val(ukuran);
			$('#spflokal').val(spf);
			$('#jumlah_satuanlokal').val(jml_satuan);
			$('#kategori_baranglokal').val(kategori_barang);
			$('#seri_ijinlokal').val(seri_ijin);
			$('#harga_satuanlokal').val(harga_satuan);
			$('#ciflokal').val(cif);
			$('#cif_rplokal').val(cif_rp);
			$('#jumlah_kemasanlokal').val(jumlah_kemasan);
			$('#nettolokal').val(netto);
			$('#harga_penyerahanlokal').val(harga_penyerahan);
			$('#jenis_satuanlokal').val(jenis_satuan);
			$('#no_dokumenlokal').val(nomor_dokumen);
			
			
		}
	});
		$("#brg_nextlokal").click(function () {
			no = no + 1;
			if (no +1 == length){
			$( "#next_lokal" ).addClass( " next disabled " );
		}
			$( "#prev_lokal" ).removeClass( " previous disabled " );
			status = data.data[no].ID;
			var no_aju= data.data[no].NOMOR_AJU;
			var kode_barang = data.data[no].KODE_BARANG;
			var uraian_barang = data.data[no].nama_barang;
			var merk = data.data[no].MERK;
			var tipe = data.data[no].TIPE;
			var ukuran = data.data[no].UKURAN;
			var spf = data.data[no].SPESIFIKASI_LAIN;
			var jml_satuan = data.data[no].JUMLAH_SATUAN;
			var kategori_barang = data.data[no].KATEGORI_BARANG;
			var seri_ijin = data.data[no].SERI_IJIN;
			var harga_satuan = data.data[no].HARGA_SATUAN;
			var cif = data.data[no].CIF;
			var cif_rp = data.data[no].CIF_RUPIAH;
			var jumlah_kemasan = data.data[no].JUMLAH_KEMASAN;
			var netto = data.data[no].NETTO;
			var harga_penyerahan = data.data[no].HARGA_PENYERAHAN;
			var jenis_satuan = data.data[no].uraian_satuan_terkecil;
			var nomor_dokumen = data.data[no].NOMOR_DOKUMEN;
			
			$('#no_barlokal').val(no+1);
			$('#statuslokal').val(status);
			$('#nomor_ajulokal').val(no_aju);
			$('#jumlah_baranglokal').val(length);
			$('#kode_baranglokal').val(kode_barang);
			$('#uraianlokal').val(uraian_barang);
			$('#merklokal').val(merk);
			$('#tipelokal').val(tipe);
			$('#ukuranlokal').val(ukuran);
			$('#spflokal').val(spf);
			$('#jumlah_satuanlokal').val(jml_satuan);
			$('#kategori_baranglokal').val(kategori_barang);
			$('#seri_ijinlokal').val(seri_ijin);
			$('#harga_satuanlokal').val(harga_satuan);
			$('#ciflokal').val(cif);
			$('#cif_rplokal').val(cif_rp);
			$('#jumlah_kemasanlokal').val(jumlah_kemasan);
			$('#nettolokal').val(netto);
			$('#harga_penyerahanlokal').val(harga_penyerahan);
			$('#jenis_satuanlokal').val(jenis_satuan);
			$('#no_dokumenlokal').val(nomor_dokumen);
			
			
		});
	}
});

$.ajax({
	url: _baseurl + "exim/transaksi_doc_out/viewDetailImportBarang/",
	type: "POST",
	data: {
		"id_header": id_header
	},
	dataType: "JSON",
	success: function (data) {
		var length = data.data.length;
		var no = 0;
		var kode_barang = data.data;
		var uraian_barang = data.data.nama_barang;
		var merk = data.data.MERK;
		var merk = data.data.MERK;
		var status =data.data[0].KODE_STATUS;

		
		console.log(data);
		$('#result').html(data.data[0].ID);
			no = 0;
			status = data.data[no].ID;
			var no_aju= data.data[no].NOMOR_AJU;
			var kode_barang = data.data[no].KODE_BARANG;
			var uraian_barang = data.data[no].nama_barang;
			var merk = data.data[no].MERK;
			var tipe = data.data[no].TIPE;
			var ukuran = data.data[no].UKURAN;
			var spf = data.data[no].SPESIFIKASI_LAIN;
			var jml_satuan = data.data[no].JUMLAH_SATUAN;
			var kategori_barang = data.data[no].KATEGORI_BARANG;
			var seri_ijin = data.data[no].SERI_IJIN;
			var harga_satuan = data.data[no].HARGA_SATUAN;
			var cif = data.data[no].CIF;
			var cif_rp = data.data[no].CIF_RUPIAH;
			var jumlah_kemasan = data.data[no].JUMLAH_KEMASAN;
			var netto = data.data[no].NETTO;
			var harga_penyerahan = data.data[no].HARGA_PENYERAHAN;
			var jenis_satuan = data.data[no].uraian_satuan_terkecil;
			var nomor_dokumen = data.data[no].NOMOR_DOKUMEN;
			console.log(kode_barang);
			
			$( "#prev_import" ).addClass( " previous disabled " );
			
			$('#no_bar_import').val(no+1);
			$('#status_import').val(status);
			$('#nomor_aju_import').val(no_aju);
			$('#jumlah_barang_import').val(length);
			$('#kode_barang_import').val(kode_barang);
			$('#uraian_import').val(uraian_barang);
			$('#merk_import').val(merk);
			$('#tipe_import').val(tipe);
			$('#ukuran_import').val(ukuran);
			$('#spf_import').val(spf);
			$('#jumlah_satuan_import').val(jml_satuan);
			$('#kategori_barang_import').val(kategori_barang);
			$('#seri_ijin_import').val(seri_ijin);
			$('#harga_satuan_import').val(harga_satuan);
			$('#cif_import').val(cif);
			$('#cif_rp_import').val(cif_rp);
			$('#jumlah_kemasan_import').val(jumlah_kemasan);
			$('#netto_import').val(netto);
			$('#harga_penyerahan_import').val(harga_penyerahan);
			$('#jenis_satuan_import').val(jenis_satuan);
			$('#no_dokumen_import').val(nomor_dokumen);
			
		$("#prev_import").click(function () {

			if (no  == 1){
				$( "#previmport" ).addClass( " previous disabled " );
			no = 0;
			status = data.data[no].ID;
			var kode_barang = data.data[no].KODE_BARANG;
			var uraian_barang = data.data[no].URAIAN;
			var merk = data.data[no].MERK;
			var hs = data.data[no].HARGA_SATUAN;
			var tipe = data.data[no].TIPE;
			var ukuran = data.data[no].UKURAN;
			var spf = data.data[no].SPESIFIKASI_LAIN;
			var jml_satuan = data.data[no].JUMLAH_SATUAN;
			var kategori_barang = data.data[no].KATEGORI_BARANG;
			var seri_ijin = data.data[no].SERI_IJIN;
			var harga_satuan = data.data[no].HARGA_SATUAN;
			var cif = data.data[no].CIF;
			var cif_rp = data.data[no].CIF_RUPIAH;
			var jumlah_kemasan = data.data[no].JUMLAH_KEMASAN;
			var netto = data.data[no].NETTO;
			var harga_penyerahan = data.data[no].HARGA_PENYERAHAN;
			var jenis_satuan = data.data[no].KODE_SATUAN;
			
			
			
			$('#status').val(status);
			$('#jumlah_barang').val(length);
			$('#no_barang').val(no + 1);
			$('#kode_barang').val(kode_barang);
			$('#uraian').val(uraian_barang);
			$('#merk').val(merk);
			$('#hs').val(hs);
			$('#tipe').val(tipe);
			$('#ukuran').val(ukuran);
			$('#spf').val(spf);
			$('#jumlah_satuan').val(jml_satuan);
			$('#kategori_barang').val(kategori_barang);
			$('#seri_ijin').val(seri_ijin);
			$('#harga_satuan').val(harga_satuan);
			$('#cif').val(cif);
			$('#cif_rp').val(cif_rp);
			$('#jumlah_kemasan').val(jumlah_kemasan);
			$('#netto').val(netto);
			$('#harga_penyerahan').val(harga_penyerahan);
			$('#jenis_satuan').val(jenis_satuan);
			
			
		}else{
			$( "#next_import" ).removeClass( " next disabled " );
			no = no - 1;
			status = data.data[no].ID;
			
			var kode_barang = data.data[no].KODE_BARANG;
			var uraian_barang = data.data[no].URAIAN;
			var merk = data.data[no].MERK;
			var hs = data.data[no].HARGA_SATUAN;
			var tipe = data.data[no].TIPE;
			var ukuran = data.data[no].UKURAN;
			var spf = data.data[no].SPESIFIKASI_LAIN;
			var jml_satuan = data.data[no].JUMLAH_SATUAN;
			var kategori_barang = data.data[no].KATEGORI_BARANG;
			var seri_ijin = data.data[no].SERI_IJIN;
			var harga_satuan = data.data[no].HARGA_SATUAN;
			var cif = data.data[no].CIF;
			var cif_rp = data.data[no].CIF_RUPIAH;
			var jumlah_kemasan = data.data[no].JUMLAH_KEMASAN;
			var netto = data.data[no].NETTO;
			var harga_penyerahan = data.data[no].HARGA_PENYERAHAN;
			var jenis_satuan = data.data[no].KODE_SATUAN;
			
			
			$('#status').val(status);
			$('#jumlah_barang').val(length);
			$('#no_barang').val(no + 1);
			$('#kode_barang').val(kode_barang);
			$('#uraian').val(uraian_barang);
			$('#merk').val(merk);
			$('#hs').val(hs);
			$('#tipe').val(tipe);
			$('#ukuran').val(ukuran);
			$('#spf').val(spf);
			$('#jumlah_satuan').val(jml_satuan);
			$('#kategori_barang').val(kategori_barang);
			$('#seri_ijin').val(seri_ijin);
			$('#harga_satuan').val(harga_satuan);
			$('#cif').val(cif);
			$('#cif_rp').val(cif_rp);
			$('#jumlah_kemasan').val(jumlah_kemasan);
			$('#netto').val(netto);
			$('#harga_penyerahan').val(harga_penyerahan);
			$('#jenis_satuan').val(jenis_satuan);
			
			
		}
	});
		$("#brg_nextimport").click(function () {
			no = no + 1;
			if (no +1 == length){
			$( "#nextimport" ).addClass( " next disabled " );
		}
			$( "#previmport" ).removeClass( " previous disabled " );
			var kode_barang = data.data[no].KODE_BARANG;
			var uraian_barang = data.data[no].URAIAN;
			var merk = data.data[no].MERK;
			var hs = data.data[no].HARGA_SATUAN;
			var tipe = data.data[no].TIPE;
			var ukuran = data.data[no].UKURAN;
			var spf = data.data[no].SPESIFIKASI_LAIN;
			var jml_satuan = data.data[no].JUMLAH_SATUAN;
			var kategori_barang = data.data[no].KATEGORI_BARANG;
			var seri_ijin = data.data[no].SERI_IJIN;
			var harga_satuan = data.data[no].HARGA_SATUAN;
			var cif = data.data[no].CIF;
			var cif_rp = data.data[no].CIF_RUPIAH;
			var jumlah_kemasan = data.data[no].JUMLAH_KEMASAN;
			var netto = data.data[no].NETTO;
			var harga_penyerahan = data.data[no].HARGA_PENYERAHAN;
			var jenis_satuan = data.data[no].KODE_SATUAN;
			
			
			status = data.tampil.data[no].ID;
			$('#status').val(status);
			$('#jumlah_barang').val(length);
			$('#no_barang').val(no + 1);
			$('#kode_barang').val(kode_barang);
			$('#uraian').val(uraian_barang);
			$('#merk').val(merk);
			$('#hs').val(hs);
			$('#tipe').val(tipe);
			$('#ukuran').val(ukuran);
			$('#spf').val(spf);
			$('#jumlah_satuan').val(jml_satuan);
			$('#kategori_barang').val(kategori_barang);
			$('#seri_ijin').val(seri_ijin);
			$('#harga_satuan').val(harga_satuan);
			$('#cif').val(cif);
			$('#cif_rp').val(cif_rp);
			$('#jumlah_kemasan').val(jumlah_kemasan);
			$('#netto').val(netto);
			$('#harga_penyerahan').val(harga_penyerahan);
			$('#jenis_satuan').val(jenis_satuan);
			
			
		});
	}
});
});