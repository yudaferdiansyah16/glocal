let filter_supplier = '';
let tarif_index = 0;
let harga;
let id_detail_dokumen;
let id_detail_bahan_baku;
let kemasanIndex;

function setDetailDokumen(e){
	let a = $(e).data();
	let o = {};
	o.id = a.id;
	id_detail_dokumen = o;
}

function setKemasanIndexDocOut(a){
	kemasanIndex = a.replace('[','');
	kemasanIndex = kemasanIndex.replace(']','');
	$('#referensi_kemasan_modal').modal('show');
}

function setDetailBahanBaku(e){
	let a = $(e).data();
	let o = {};
	o.id = a.id;
	id_detail_bahan_baku = o;
}

function setModalIndex(a){
	tarif_index = a.replace('[','');
	tarif_index = tarif_index.replace(']','');
	harga = document.getElementById('tpb_barang['+tarif_index+'][CIF_RUPIAH]').value;
	console.log(harga);
	elementModal = $('#dt_add_tarif');
	elementModal.find('.bm_ditangguhkan').val(document.getElementById('tpb_barang['+tarif_index+'][TARIF][BM_DITANGGUHKAN][TARIF]').value);
	elementModal.find('.bm_dibebaskan').val(document.getElementById('tpb_barang['+tarif_index+'][TARIF][BM_DIBEBASKAN][TARIF]').value);
	elementModal.find('.bm_tidak_dipungut').val(document.getElementById('tpb_barang['+tarif_index+'][TARIF][BM_TIDAK_DIPUNGUT][TARIF]').value);
	elementModal.find('.bmt_ditangguhkan').val(document.getElementById('tpb_barang['+tarif_index+'][TARIF][BMT_DITANGGUHKAN][TARIF]').value);
	elementModal.find('.bmt_dibebaskan').val(document.getElementById('tpb_barang['+tarif_index+'][TARIF][BMT_DIBEBASKAN][TARIF]').value);
	elementModal.find('.bmt_tidak_dipungut').val(document.getElementById('tpb_barang['+tarif_index+'][TARIF][BMT_TIDAK_DIPUNGUT][TARIF]').value);
	elementModal.find('.cukai_ditangguhkan').val(document.getElementById('tpb_barang['+tarif_index+'][TARIF][CUKAI_DITANGGUHKAN][TARIF]').value);
	elementModal.find('.cukai_dibebaskan').val(document.getElementById('tpb_barang['+tarif_index+'][TARIF][CUKAI_DIBEBASKAN][TARIF]').value);
	elementModal.find('.cukai_tidak_dipungut').val(document.getElementById('tpb_barang['+tarif_index+'][TARIF][CUKAI_TIDAK_DIPUNGUT][TARIF]').value);
	elementModal.find('.ppn_ditangguhkan').val(document.getElementById('tpb_barang['+tarif_index+'][TARIF][PPN_DITANGGUHKAN][TARIF]').value);
	elementModal.find('.ppn_dibebaskan').val(document.getElementById('tpb_barang['+tarif_index+'][TARIF][PPN_DIBEBASKAN][TARIF]').value);
	elementModal.find('.ppn_tidak_dipungut').val(document.getElementById('tpb_barang['+tarif_index+'][TARIF][PPN_TIDAK_DIPUNGUT][TARIF]').value);
	elementModal.find('.ppnbm_ditangguhkan').val(document.getElementById('tpb_barang['+tarif_index+'][TARIF][PPNBM_DITANGGUHKAN][TARIF]').value);
	elementModal.find('.ppnbm_dibebaskan').val(document.getElementById('tpb_barang['+tarif_index+'][TARIF][PPNBM_DIBEBASKAN][TARIF]').value);
	elementModal.find('.ppnbm_tidak_dipungut').val(document.getElementById('tpb_barang['+tarif_index+'][TARIF][PPNBM_TIDAK_DIPUNGUT][TARIF]').value);
	elementModal.find('.pph_ditangguhkan').val(document.getElementById('tpb_barang['+tarif_index+'][TARIF][PPH_DITANGGUHKAN][TARIF]').value);
	elementModal.find('.pph_dibebaskan').val(document.getElementById('tpb_barang['+tarif_index+'][TARIF][PPH_DIBEBASKAN][TARIF]').value);
	elementModal.find('.pph_tidak_dipungut').val(document.getElementById('tpb_barang['+tarif_index+'][TARIF][PPH_TIDAK_DIPUNGUT][TARIF]').value);
	$('#add_tarif_modal').modal('show');
}

function attachData(data, key){
	switch(key) {
		case 't_invoice_doc_out':
			let elementTable = $('#dt_doc_out_add');
			elementTable.find('tbody').empty();
			for (let j = 0; j < data.length; j++) {
				const row = data[j];
				const lastData = elementTable.find('tbody').find('tr').last();
				let i = 0;
				if (lastData.length > 0) i = lastData.data('index');
				i++;

				let table_template = $('#table-template').find('tbody').html();
				table_template = replaceAll(table_template, "[x]", "["+i+"]");
				elementTable.find('tbody').append(table_template);

				let lastElement = elementTable.find('tbody').find('tr').last();
				lastElement.attr('data-index', i);
				lastElement.find('.kode_inv').val(row.kode_invoice);
				lastElement.find('.text_kode_inv').text(row.kode_invoice);
				lastElement.find('.kode_stuffing').val(row.kode_stuffing);
				lastElement.find('.text_kode_stuffing').text(row.kode_stuffing);
				lastElement.find('.tanggal_inv').val(row.tanggal_invoice);
				lastElement.find('.text_tanggal_inv').text(row.tanggal_invoice);
				lastElement.find('.tanggal_stuffing').val(row.tanggal_stuffing);
				lastElement.find('.text_tanggal_stuffing').text(row.tanggal_stuffing);
				lastElement.find('.kode_barang').val(row.kode_barang);
				lastElement.find('.text_kode_barang').text(row.kode_barang);
				lastElement.find('.nama_barang').val(row.nama_barang);
				lastElement.find('.nama_kategori').val(row.nama_kategori);
				lastElement.find('.text_nama_barang').text(row.nama_barang);
				lastElement.find('.kode_satuan').val(row.KODE_SATUAN);
				lastElement.find('.text_kode_satuan').text(row.KODE_SATUAN);
				lastElement.find('.jumlah_satuan').val(row.qty_invoice);
				lastElement.find('.text_jumlah_satuan').text(row.qty_invoice);
				lastElement.find('.harga_satuan').val(row.harga_satuan);
				lastElement.find('.harga_invoice').val(row.harga_invoice);
				lastElement.find('.harga_penyerahan').val(row.harga_invoice);
				lastElement.find('.text_harga_penyerahan').text(row.harga_invoice);
				lastElement.find('.fob_barang').val(row.harga_invoice);
				lastElement.find('.cif_barang').val(row.harga_invoice);
				lastElement.find('.cif_rupiah').val(row.harga_invoice*row.rate);
				lastElement.find('.netto').val(row.netto);
				lastElement.find('.bruto').val(row.bruto);
				lastElement.find('.jumlah_kemasan').val(row.qty_mc);
				lastElement.find('.kode_kemasan').val(row.KODE_KEMASAN);
				lastElement.find('.text_kode_kemasan').text(row.KODE_KEMASAN);
				lastElement.find('.text_jumlah_kemasan').text(row.qty_mc);
				lastElement.find('.text_kode_kemasan').text(row.KODE_KEMASAN);
				lastElement.find('.mselect2').select2({dropdownAutoWidth : true});
				lastElement.find('.btn-detail-dokumen')[0].dataset.id = row.id_detail_stuffing;
				lastElement.find('.btn-detail-bahan-baku')[0].dataset.id = row.id_detail_stuffing;
			}
			renderTableNumber(elementTable, 1);
			$(".input-mask").inputmask({removeMaskOnSubmit: true});
			break;
	}
}

function setTarif(data,i,r){
	document.getElementById('tpb_barang['+i+'][TARIF][BM_DITANGGUHKAN][TARIF]').value = data[0];
	document.getElementById('tpb_barang['+i+'][TARIF][BM_DIBEBASKAN][TARIF]').value = data[1];
	document.getElementById('tpb_barang['+i+'][TARIF][BM_TIDAK_DIPUNGUT][TARIF]').value = data[2];
	document.getElementById('tpb_barang['+i+'][TARIF][BMT_DITANGGUHKAN][TARIF]').value = data[3];
	document.getElementById('tpb_barang['+i+'][TARIF][BMT_DIBEBASKAN][TARIF]').value = data[4];
	document.getElementById('tpb_barang['+i+'][TARIF][BMT_TIDAK_DIPUNGUT][TARIF]').value = data[5];
	document.getElementById('tpb_barang['+i+'][TARIF][CUKAI_DITANGGUHKAN][TARIF]').value = data[6];
	document.getElementById('tpb_barang['+i+'][TARIF][CUKAI_DIBEBASKAN][TARIF]').value = data[7];
	document.getElementById('tpb_barang['+i+'][TARIF][CUKAI_TIDAK_DIPUNGUT][TARIF]').value = data[8];
	document.getElementById('tpb_barang['+i+'][TARIF][PPN_DITANGGUHKAN][TARIF]').value = data[9];
	document.getElementById('tpb_barang['+i+'][TARIF][PPN_DIBEBASKAN][TARIF]').value = data[10];
	document.getElementById('tpb_barang['+i+'][TARIF][PPN_TIDAK_DIPUNGUT][TARIF]').value = data[11];
	document.getElementById('tpb_barang['+i+'][TARIF][PPNBM_DITANGGUHKAN][TARIF]').value = data[12];
	document.getElementById('tpb_barang['+i+'][TARIF][PPNBM_DIBEBASKAN][TARIF]').value = data[13];
	document.getElementById('tpb_barang['+i+'][TARIF][PPNBM_TIDAK_DIPUNGUT][TARIF]').value = data[14];
	document.getElementById('tpb_barang['+i+'][TARIF][PPH_DITANGGUHKAN][TARIF]').value = data[15];
	document.getElementById('tpb_barang['+i+'][TARIF][PPH_DIBEBASKAN][TARIF]').value = data[16];
	document.getElementById('tpb_barang['+i+'][TARIF][PPH_TIDAK_DIPUNGUT][TARIF]').value = data[17];

	document.getElementById('tpb_barang['+i+'][TARIF][BM_DITANGGUHKAN][NILAI_FASILITAS]').value = data[0]*r/100;
	document.getElementById('tpb_barang['+i+'][TARIF][BM_DIBEBASKAN][NILAI_FASILITAS]').value = data[1]*r/100;
	document.getElementById('tpb_barang['+i+'][TARIF][BM_TIDAK_DIPUNGUT][NILAI_FASILITAS]').value = data[2]*r/100;
	document.getElementById('tpb_barang['+i+'][TARIF][BMT_DITANGGUHKAN][NILAI_FASILITAS]').value = data[3]*r/100;
	document.getElementById('tpb_barang['+i+'][TARIF][BMT_DIBEBASKAN][NILAI_FASILITAS]').value = data[4]*r/100;
	document.getElementById('tpb_barang['+i+'][TARIF][BMT_TIDAK_DIPUNGUT][NILAI_FASILITAS]').value = data[5]*r/100;
	document.getElementById('tpb_barang['+i+'][TARIF][CUKAI_DITANGGUHKAN][NILAI_FASILITAS]').value = data[6]*r/100;
	document.getElementById('tpb_barang['+i+'][TARIF][CUKAI_DIBEBASKAN][NILAI_FASILITAS]').value = data[7]*r/100;
	document.getElementById('tpb_barang['+i+'][TARIF][CUKAI_TIDAK_DIPUNGUT][NILAI_FASILITAS]').value = data[8]*r/100;
	document.getElementById('tpb_barang['+i+'][TARIF][PPN_DITANGGUHKAN][NILAI_FASILITAS]').value = data[9]*r/100;
	document.getElementById('tpb_barang['+i+'][TARIF][PPN_DIBEBASKAN][NILAI_FASILITAS]').value = data[10]*r/100;
	document.getElementById('tpb_barang['+i+'][TARIF][PPN_TIDAK_DIPUNGUT][NILAI_FASILITAS]').value = data[11]*r/100;
	document.getElementById('tpb_barang['+i+'][TARIF][PPNBM_DITANGGUHKAN][NILAI_FASILITAS]').value = data[12]*r/100;
	document.getElementById('tpb_barang['+i+'][TARIF][PPNBM_DIBEBASKAN][NILAI_FASILITAS]').value = data[13]*r/100;
	document.getElementById('tpb_barang['+i+'][TARIF][PPNBM_TIDAK_DIPUNGUT][NILAI_FASILITAS]').value = data[14]*r/100;
	document.getElementById('tpb_barang['+i+'][TARIF][PPH_DITANGGUHKAN][NILAI_FASILITAS]').value = data[15]*r/100;
	document.getElementById('tpb_barang['+i+'][TARIF][PPH_DIBEBASKAN][NILAI_FASILITAS]').value = data[16]*r/100;
	document.getElementById('tpb_barang['+i+'][TARIF][PPH_TIDAK_DIPUNGUT][NILAI_FASILITAS]').value = data[17]*r/100;

	document.getElementById('bm_tangguh').value = +document.getElementById('bm_tangguh').value+(r*data[0]/100);
	document.getElementById('bm_bebas').value = +document.getElementById('bm_bebas').value+(r*data[1]/100);
	document.getElementById('bm_tidak').value = +document.getElementById('bm_tidak').value+(r*data[2]/100);
	document.getElementById('bmt_tangguh').value = +document.getElementById('bmt_tangguh').value+(r*data[3]/100);
	document.getElementById('bmt_bebas').value = +document.getElementById('bmt_bebas').value+(r*data[4]/100);
	document.getElementById('bmt_tidak').value = +document.getElementById('bmt_tidak').value+(r*data[5]/100);
	document.getElementById('cukai_tangguh').value = +document.getElementById('cukai_tangguh').value+(r*data[6]/100);
	document.getElementById('cukai_bebas').value = +document.getElementById('cukai_bebas').value+(r*data[7]/100);
	document.getElementById('cukai_tidak').value = +document.getElementById('cukai_tidak').value+(r*data[8]/100);
	document.getElementById('ppn_tangguh').value = +document.getElementById('ppn_tangguh').value+(r*data[9]/100);
	document.getElementById('ppn_bebas').value = +document.getElementById('ppn_bebas').value+(r*data[10]/100);
	document.getElementById('ppn_tidak').value = +document.getElementById('ppn_tidak').value+(r*data[11]/100);
	document.getElementById('ppnbm_tangguh').value = +document.getElementById('ppnbm_tangguh').value+(r*data[12]/100);
	document.getElementById('ppnbm_bebas').value = +document.getElementById('ppnbm_bebas').value+(r*data[13]/100);
	document.getElementById('ppnbm_tidak').value = +document.getElementById('ppnbm_tidak').value+(r*data[14]/100);
	document.getElementById('pph_tangguh').value = +document.getElementById('pph_tangguh').value+(r*data[15]/100);
	document.getElementById('pph_bebas').value = +document.getElementById('pph_bebas').value+(r*data[16]/100);
	document.getElementById('pph_tidak').value = +document.getElementById('pph_tidak').value+(r*data[17]/100);

	let tangguh = +document.getElementById('bm_tangguh').value + +document.getElementById('bmt_tangguh').value + +document.getElementById('cukai_tangguh').value + +document.getElementById('ppn_tangguh').value + +document.getElementById('ppnbm_tangguh').value + +document.getElementById('pph_tangguh').value;
	let bebas = +document.getElementById('bm_bebas').value + +document.getElementById('bmt_bebas').value + +document.getElementById('cukai_bebas').value + +document.getElementById('ppn_bebas').value + +document.getElementById('ppnbm_bebas').value + +document.getElementById('pph_bebas').value;
	let tidak = +document.getElementById('bm_tidak').value + +document.getElementById('bmt_tidak').value + +document.getElementById('cukai_tidak').value + +document.getElementById('ppn_tidak').value + +document.getElementById('ppnbm_tidak').value + +document.getElementById('pph_tidak').value;

	document.getElementById('total_tangguh').value = tangguh;
	document.getElementById('total_bebas').value = bebas;
	document.getElementById('total_tidak').value = tidak;
}

function setValue(column, data){
	switch (column) {
		case 'm_jenis_pp':
			//console.log(data);
			$('input[name=id_jenis_pp]').val(data.id_jenis_pp);
			$('input[name=nama_jenis_pp]').val(data.nama_jenis_pp);
			break;
		case 'referensi_valuta':
			//console.log(data);
			$('.nama_valuta').val(data.URAIAN_VALUTA);
			$('.id_valuta').val(data.KODE_VALUTA);
			break;
		case 'referensi_kemasan':
			//console.log(data);
			document.getElementById('kode_kemasan['+kemasanIndex+']').value = data.KODE_KEMASAN;
			document.getElementById('uraian_kemasan['+kemasanIndex+']').value = data.URAIAN_KEMASAN;
			break;
		case 'referensi_pemasok':
			$('.nama_pemasok_filter').val(data.NAMA);
			$('.id_pemasok').val(data.ID);
			filter_supplier = data.NAMA;
			// $('#dt_t_invoice_doc_out').DataTable().search(filter_supplier).draw();
			break;
		case 'referensi_dokumen':
			//console.log(data);
			$('.nama_dokumen').val(data.URAIAN_DOKUMEN);
			$('.kode_dokumen').val(data.KODE_DOKUMEN);
			$('.tipe_dokumen').val(data.TIPE_DOKUMEN);
			break;
		case 'm_supplier_docout':
			// console.log(data);
			$('.nama_supplier_filter').val(data.nama);
			$('.id_supplier_filter').val(data.id_customer);
			// console.log(data.id_supplier);
			filter_supplier = data.nama;
			$('#dt_t_invoice_doc_out').DataTable().ajax.reload(null, false);
			// $('#dt_t_detail_dn_exim_out').DataTable().search(filter_supplier).draw();
			break;
		case 'referensi_pelabuhan_muat':
			//console.log(data);
			nama = data.KODE_PELABUHAN + ' - ' + data.URAIAN_PELABUHAN;
			$('.nama_pelabuhan_muat').val(nama);
			$('.kode_pelabuhan_muat').val(data.KODE_PELABUHAN);
			break;
		case 'referensi_pelabuhan_transit':
			//console.log(data);
			nama = data.KODE_PELABUHAN + ' - ' + data.URAIAN_PELABUHAN;
			$('.nama_pelabuhan_transit').val(nama);
			$('.kode_pelabuhan_transit').val(data.KODE_PELABUHAN);
			break;
		case 'referensi_pelabuhan_bongkar':
			//console.log(data);
			nama = data.KODE_PELABUHAN + ' - ' + data.URAIAN_PELABUHAN;
			$('.nama_pelabuhan_bongkar').val(nama);
			$('.kode_pelabuhan_bongkar').val(data.KODE_PELABUHAN);
			break;
		case 'referensi_negara':
			//console.log(data);
			nama = data.KODE_NEGARA + ' - ' + data.URAIAN_NEGARA;
			$('.nama_negara').val(nama);
			$('.kode_negara').val(data.KODE_NEGARA);
			break;
		default:
			break;
	}
}

function replaceAll(str, find, replace) {
	while (str.includes(find)) {
		str = str.replace(find, replace);
	}
	return str;
}

function getIndex(e){
	tarif_index = $(e).data().index[0];
}

$(document).ready(function(){
	initDatepicker($('.x-datepicker'));
	$('.select2').select2({dropdownAutoWidth : true});
	$(".input-mask").inputmask({removeMaskOnSubmit: true,autoUnmask:true,unmaskAsNumber:true});

	// const table_detail = $('#dt_doc_out_add');
	const table_detail_261 = $('#table_detail_261');
	const table_dokumen = $('#table_dokumen');
	const table_kemasan = $('#table_kemasan');

	$(document).on('click', '.btn-delete-row', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_detail, 1);
	});

	$(document).on('click', '.btn-add-row-261', function (e) {

		const lastData = table_detail_261.find('tbody').find('tr').last();
		let i = 0;
		if (lastData.length > 0) i = lastData.data('index');
		i++;

		let row_template = $('.table_template_261').find('tbody').html();
		row_template = replaceAll(row_template, "[x]", "["+i+"]");
		table_detail_261.find('tbody').append(row_template);

		let lastElement = table_detail_261.find('tbody').find('tr').last();
		lastElement.attr('data-index', i);

		table_detail_261.find('.mselect2').select2({dropdownAutoWidth : true});
		initDatepicker($('.x-datepicker'));
		$(".input-mask").inputmask();
		renderTableNumber(table_detail_261, 1);
	});

	$(document).on('click', '.btn-delete-row-261', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_detail_261, 1);
	});

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

	$(document).on('click', '.btn-add-kemasan', function (e) {
		const lastData = table_kemasan.find('tbody').find('tr').last();
		let i = 0;
		if (lastData.length > 0) i = lastData.data('index');
		i++;

		let row_template = $('.add_kemasan_template').find('tbody').html();
		row_template = replaceAll(row_template, "[x]", "["+i+"]");
		table_kemasan.find('tbody').append(row_template);

		let lastElement = table_kemasan.find('tbody').find('tr').last();
		lastElement.attr('data-index', i);

		table_kemasan.find('.mselect2').select2({dropdownAutoWidth : true});
		initDatepicker($('.x-datepicker'));
		$(".input-mask").inputmask();
		renderTableNumber(table_kemasan, 1);
	});

	$(document).on('click', '.btn-delete-kemasan', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_kemasan, 1);
	});

	let select2_tujuan = $('#tujuan_pengiriman');

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

