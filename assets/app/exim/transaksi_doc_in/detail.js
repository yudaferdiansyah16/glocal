let valuta,tgljaminan,tglbpj,tgl261,docjaminan,docbpj,doc261;

$(document).ready(function(){
	if(typeof(id_header) != "undefined" && id_header !== null){
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
				{ data: "detaildt", className:"text-center"},
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
			"sorting" : [[2, 'asc']],
			"columnDefs": [
				{ 'sortable': false, 'targets': [0,1] }
			]
		});

		$('#dt_doc_in_detail tbody').on('click', 'td.details-control', function () {
			var tr = $(this).closest('tr');
			var row = table.row( tr );
	
			if ( row.child.isShown() ) {
				// This row is already open - close it
				row.child.hide();
				tr.removeClass('shown');
			}
			else {
				// Open this row
				row.child( format(row.data()) ).show();
				tr.addClass('shown');
			}
		} );

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

		
	}


	$.ajax({
		url: _baseurl + "exim/transaksi_doc_in/viewDetailBarang/",
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
			$("#btn3").click(function () {
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

			});
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

	
});