
$(document).ready(function(){
	
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
