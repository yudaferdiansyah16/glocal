let filter_supplier = '';
let tarif_index = 0;
let harga;
let nama;
let currentRow;
let kemasan_index;
let kemasanIndex;
let doc261;
let tabelreferensi = $('#dt_referensi_261').DataTable({
	paging: false,
	searching:false,
	lengthChange: false,
	responsive: false,
	info: false,
	ordering: false
});

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
		case 't_detail_dn_exim_in':
			let elementTable = $('#dt_doc_in_add');
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
				lastElement.find('.kode_po').val(row.kode_po);
				lastElement.find('.tanggal_po').val(row.tanggal_po);
				lastElement.find('.text_kode_po').text(row.kode_po);
				lastElement.find('.text_tanggal_po').text(row.tanggal_po);
				lastElement.find('.no_sj').val(row.no_sj);
				lastElement.find('.tanggal_dn').val(row.tanggal_invoice);
				lastElement.find('.text_no_sj').text(row.no_sj);
				lastElement.find('.text_tanggal_dn').text(row.tanggal_invoice);
				lastElement.find('.no_job').val(row.no_job);
				lastElement.find('.text_no_job').text(row.no_job);
				lastElement.find('.po_seri_barang').val(row.seri_barang);
				lastElement.find('.dn_seri_barang').val(row.seri_barang);
				lastElement.find('.seri_barang').val(row.seri_barang);
				lastElement.find('.kode_barang').val(row.kode_barang);
				lastElement.find('.nama_barang').val(row.nama_sub_barang);
				lastElement.find('.id_detail_dn').val(row.id_detail_dn);
				lastElement.find('.text_kode_barang').text(row.kode_barang);
				lastElement.find('.text_nama_barang').text(row.nama_sub_barang);
				lastElement.find('.kode_satuan').val(row.kode_satuan);
				lastElement.find('.jumlah_satuan').val(row.qty_dn);
				lastElement.find('.text_kode_satuan').text(row.kode_satuan);
				lastElement.find('.text_jumlah_satuan').text(row.qty_dn);
				let harga_satuan = parseFloat(row.harga);
				let harga_invoice = parseFloat(harga_satuan*row.qty_dn);
				let harga_rate = parseFloat(harga_invoice*row.rate);
				lastElement.find('.harga_penyerahan').val(harga_invoice);
				lastElement.find('.harga_satuan').val(harga_satuan);
				lastElement.find('.harga_invoice').val(harga_invoice);
				lastElement.find('.fob_barang').val(harga_invoice);
				lastElement.find('.cif_barang').val(harga_invoice);
				lastElement.find('.cif_rupiah_barang').val(harga_rate);
				lastElement.find('.mselect2').select2({dropdownAutoWidth : true});
			}
			renderTableNumber(elementTable, 1);
			$(".input-mask").inputmask({removeMaskOnSubmit: true,autoUnmask:true,unmaskAsNumber:true});
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

function setKemasanIndexDocIn(a){
	kemasanIndex = a.replace('[','');
	kemasanIndex = kemasanIndex.replace(']','');
	$('#referensi_kemasan_modal').modal('show');
}

function setValue(column, data){
	switch (column) {
		case 't_dn_docin':
			//console.log(data);
			$('.kode_dn').val(data.kode_dn);
			$('.id_dn').val(data.id_dn);
			$('.nama_pengangkut').val(data.uraian_jenis_kendaraan);
			$('.plat_kendaraan').val(data.plat_kendaraan);
			$('.jumlah_barang').val(data.jumlah_barang);
			$('.netto').val(data.netto);
			
			let elementTable = $('#dt_doc_in_add');
			elementTable.find('tbody').empty();
			var data;
			$.getJSON((_baseurl+"exim/transaksi_doc_in/getdndetail/"+data.id_dn),function (json) {
				data = json;
				let i = 0;
				for (let j = 0; j < data.length; j++) {
					const row = data[j];
					const lastData = elementTable.find('tbody').find('tr').last();
					i++;
	
					let table_template = $('#table-template').find('tbody').html();
					table_template = replaceAll(table_template, "[x]", "["+i+"]");
					elementTable.find('tbody').append(table_template);
	
					let lastElement = elementTable.find('tbody').find('tr').last();
					lastElement.attr('data-index', i);
					lastElement.find('.kode_po').val(row.kode_po);
					lastElement.find('.tanggal_po').val(row.tanggal_po);
					lastElement.find('.text_kode_po').text(row.kode_po);
					lastElement.find('.text_tanggal_po').text(row.tanggal_po);
					lastElement.find('.no_sj').val(row.no_sj);
					lastElement.find('.tanggal_dn').val(row.tanggal_invoice);
					lastElement.find('.text_no_sj').text(row.no_sj);
					lastElement.find('.text_tanggal_dn').text(row.tanggal_invoice);
					lastElement.find('.no_job').val(row.no_job);
					lastElement.find('.text_no_job').text(row.no_job);
					lastElement.find('.po_seri_barang').val(row.seri_barang);
					lastElement.find('.dn_seri_barang').val(row.seri_barang);
					lastElement.find('.seri_barang').val(row.seri_barang);
					lastElement.find('.kode_barang').val(row.kode_barang);
					lastElement.find('.nama_barang').val(row.nama_sub_barang);
					lastElement.find('.id_detail_dn').val(row.id_detail_dn);
					lastElement.find('.text_kode_barang').text(row.kode_barang);
					lastElement.find('.text_nama_barang').text(row.nama_sub_barang);
					lastElement.find('.kode_satuan').val(row.kode_satuan);
					lastElement.find('.jumlah_satuan').val(row.qty_dn);
					lastElement.find('.netto').val(row.netto);
					lastElement.find('.text_seri_barang').text(row.seri_barang);
					lastElement.find('.text_kode_satuan').text(row.kode_satuan);
					lastElement.find('.text_jumlah_satuan').text(row.qty_dn);
					let harga_satuan = parseFloat(row.harga);
					let harga_invoice = parseFloat(harga_satuan*row.qty_dn);
					let harga_rate = parseFloat(harga_invoice*row.rate);
					lastElement.find('.harga_penyerahan').val(harga_invoice);
					lastElement.find('.harga_satuan').val(harga_satuan);
					lastElement.find('.harga_invoice').val(harga_invoice);
					lastElement.find('.fob_barang').val(harga_invoice);
					lastElement.find('.cif_barang').val(harga_invoice);
					lastElement.find('.cif_rupiah_barang').val(harga_rate);
					lastElement.find('.mselect2').select2({dropdownAutoWidth : true});
				}
				renderTableNumber(elementTable, 0);
				$(".input-mask").inputmask({removeMaskOnSubmit: true,autoUnmask:true,unmaskAsNumber:true});
			})
			break;
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
		case 'm_supplier':
			// console.log(data);
			$('.nama_supplier_filter').val(data.nama);
			$('.id_supplier_filter').val(data.id_customer);
			filter_supplier = data.nama;
			$('#dt_t_dn_docin').DataTable().ajax.reload().draw();
			$('#dt_t_detail_dn_exim_in').DataTable().search(filter_supplier).draw();
			break;
		case 'referensi_dokumen':
			//console.log(data);
			$('.nama_dokumen').val(data.URAIAN_DOKUMEN);
			$('.kode_dokumen').val(data.KODE_DOKUMEN);
			$('.tipe_dokumen').val(data.TIPE_DOKUMEN);
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
			$('.kode_kantor_bongkar').val(data.KODE_KANTOR);
			break;
		case 'referensi_negara':
			//console.log(data);
			nama = data.KODE_NEGARA + ' - ' + data.URAIAN_NEGARA;
			$('.nama_negara').val(nama);
			$('.kode_negara').val(data.KODE_NEGARA);
			break;
		case 'bc_261':
			//console.log(data);
			$('.261_nodoc').val(data.NOMOR_AJU);
			$('.261_tanggal').val(data.TANGGAL_AJU);
			doc261 = data.NOMOR_AJU;
			tabelreferensi.destroy();
			tabelreferensi = $('#dt_referensi_261').DataTable({
				"autoWidth" : true,
				"responsive": false,
				//"scrollX": true,
				"processing": true,
				"serverSide": true,
				"paginate": false,
				"lengthChange": false,
				"filter": true,
				"sort": true,
				"info": true,
				searching: false,
				"ajax": {
					url: _baseurl+"exim/transaksi_doc_in/viewReferensiBarang261",
					type: "POST",
					data: function(data) {
						data.no_aju = doc261;
						return data;
					}
				},
				"columns": [
					{ data: "no", searchable: false, className: 'text-center' },
					{ data: "KODE_BARANG"},
					{ data: "URAIAN"},
					{ data: "JUMLAH_SATUAN"},
				],
				"sorting" : [[2, 'desc'],[1, 'desc']],
				"columnDefs": [
					{ 'sortable': false, 'targets': [0,-1] }
				]
			});

			$('#dt_filter input').unbind().bind('keyup', function(e) {
				if (e.keyCode == 13) {
					oTable.search(this.value).draw();
				}
			});

			break;
		case 'referensi_kemasan':
			document.getElementById('kode_kemasan['+kemasanIndex+']').value = data.KODE_KEMASAN;
			document.getElementById('uraian_kemasan['+kemasanIndex+']').value = data.URAIAN_KEMASAN;
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

function setKemasanIndex(i){
	kemasan_index = i.replace('[','');
	kemasan_index = kemasan_index.replace(']','');
}

function setKemasan(dt){
	document.getElementById('uraian_kemasan_barang['+kemasan_index+']').value = dt.URAIAN_KEMASAN;
	document.getElementById('kode_jenis_kemasan['+kemasan_index+']').value = dt.KODE_KEMASAN;
}

$(document).ready(function(){

	initDatepicker($('.x-datepicker'));
	$('.select2').select2();
	$(".input-mask").inputmask({removeMaskOnSubmit: true,autoUnmask:true,unmaskAsNumber:true});

	const table_detail = $('#dt_doc_in_add');
	const table_detail_262 = $('#table_detail_262');
	const table_dokumen = $('#table_dokumen');
	const table_kemasan = $('#table_kemasan');

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
		$(".input-mask").inputmask({removeMaskOnSubmit: true,autoUnmask:true,unmaskAsNumber:true});
		renderTableNumber(table_kemasan, 1);
	});

	$(document).on('click', '.btn-delete-kemasan', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_kemasan, 1);
	});

	$(document).on('click', '.btn-delete-row', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_detail, 1);
	});

	$(document).on('click', '.btn-add-row-262', function (e) {

		const lastData = table_detail_262.find('tbody').find('tr').last();
		let i = 0;
		if (lastData.length > 0) i = lastData.data('index');
		i++;

		let row_template = $('.table_template_262').find('tbody').html();
		row_template = replaceAll(row_template, "[x]", "["+i+"]");
		table_detail_262.find('tbody').append(row_template);

		let lastElement = table_detail_262.find('tbody').find('tr').last();
		lastElement.attr('data-index', i);

		table_detail_262.find('.mselect2').select2({dropdownAutoWidth : true});
		initDatepicker($('.x-datepicker'));
		$(".input-mask").inputmask({removeMaskOnSubmit: true,autoUnmask:true,unmaskAsNumber:true});
		renderTableNumber(table_detail_262, 1);
	});

	$(document).on('click', '.btn-delete-row-262', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_detail_262, 1);
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
		$(".input-mask").inputmask({removeMaskOnSubmit: true,autoUnmask:true,unmaskAsNumber:true});
		renderTableNumber(table_dokumen, 1);
	});

	$(document).on('click', '.btn-delete-dokumen', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_dokumen, 1);
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

	keepSession();
});
