let asal_modal;
let x;
let kemasanIndex;

function setAsal(i){
	asal_modal = i;
}

function setKemasanIndex(a){
	kemasanIndex = a.replace('[','');
	kemasanIndex = kemasanIndex.replace(']','');
	$('#referensi_kemasan_modal').modal('show');
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
				lastElement.find('.fob_satuan').val(row.harga_satuan);
				lastElement.find('.text_fob_satuan').text(row.harga_satuan);
				lastElement.find('.fob').val(row.harga_invoice);
				lastElement.find('.text_fob').text(row.harga_invoice);
				lastElement.find('.netto').val(row.netto);
				lastElement.find('.text_netto').text(row.netto);
				lastElement.find('.volume').val(row.volume);
				lastElement.find('.text_volume').text(row.volume);
				lastElement.find('.jumlah_kemasan').val(row.qty_mc);
				lastElement.find('.kode_kemasan').val(row.KODE_KEMASAN);
				lastElement.find('.kode_hs').val(row.kode_hs);
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

function hidePenerima() {
	$('.penerima_template').hide();
}

function showPenerima() {
	$('.penerima_template').show();
}

function setValue(column, data){
	switch (column) {
		case 'tblvaluta':
			//console.log(data);
			$('.kode_valuta').val(data.KdEdi);
			$('.uraian_valuta').val(data.UrEdi);
			break;
		case 'tblbank':
			//console.log(data);
			$('.kode_bank').val(data.KdBank);
			$('.uraian_bank').val(data.NmBank);
			break;
		case 'tbldaerah':
			//console.log(data);
			$('.kode_daerah').val(data.KdDaerah);
			$('.uraian_daerah').val(data.UrDaerah);
			break;
		case 'tblkapal':
			//console.log(data);
			$('.nama_sarana_angkut').val(data.AngkutNama);
			break;
		case 'referensi_pemasok':
			//console.log(data);
			$('.uraian_pemasok').val(data.NAMA);
			$('.alamat_pemasok').val(data.ALAMAT);
			$('.uraian_negara_pemasok').val(data.URAIAN_NEGARA);
			$('.kode_negara_pemasok').val(data.KODE_NEGARA);
			break;
			case 'referensi_valuta':
				//console.log(data);
				$('.uraian_valuta').val(data.URAIAN_VALUTA);
				$('.id_valuta').val(data.KODE_VALUTA);
				break;
		case 'referensi_kemasan':
			//console.log(data);
			document.getElementById('kode_kemasan['+kemasanIndex+']').value = data.KODE_KEMASAN;
			document.getElementById('uraian_kemasan['+kemasanIndex+']').value = data.URAIAN_KEMASAN;
			break;
		case 'tblkpbc':
			switch (asal_modal) {
				case 'kpmuat':
					// console.log(data);
					$('.kode_'+asal_modal).val(data.Kdkpbc);
					$('.uraian_'+asal_modal).val(data.UrKdkpbc);
					break;
				case 'kpekspor':
					// console.log(data);
					$('.kode_'+asal_modal).val(data.Kdkpbc);
					$('.uraian_'+asal_modal).val(data.UrKdkpbc);
					break;
				case 'kploktpb':
					// console.log(data);
					$('.kode_'+asal_modal).val(data.Kdkpbc);
					$('.uraian_'+asal_modal).val(data.UrKdkpbc);
					break;
				case 'kpperiksa':
					// console.log(data);
					$('.kode_'+asal_modal).val(data.Kdkpbc);
					$('.uraian_'+asal_modal).val(data.UrKdkpbc);
					break;
				default:
					break;
			}
			break;
		case 'tblnegara':
			switch (asal_modal) {
				case 'negaraPenerima':
					// console.log(data);
					$('.kode_'+asal_modal).val(data.KdEdi);
					$('.uraian_'+asal_modal).val(data.UrEdi);
					break;
				case 'negaraBenderaKapal':
					// console.log(data);
					$('.kode_'+asal_modal).val(data.KdEdi);
					$('.uraian_'+asal_modal).val(data.UrEdi);
					break;
				case 'negaraTujuan':
					// console.log(data);
					$('.kode_'+asal_modal).val(data.KdEdi);
					$('.uraian_'+asal_modal).val(data.UrEdi);
					break;
				default:
					break;
			}
		case 'tblpeldn':
			// console.log(asal_modal);
			switch (asal_modal) {
				case 'muatAsal':
					// console.log(data);
					$('.kode_'+asal_modal).val(data.KDEDI);
					$('.uraian_'+asal_modal).val(data.UREDI);
					break;
				case 'muatEkspor':
					// console.log(data);
					$('.kode_'+asal_modal).val(data.KDEDI);
					$('.uraian_'+asal_modal).val(data.UREDI);
					break;
				default:
					break;
			}
		case 'tblpelln':
			// console.log(asal_modal);
			switch (asal_modal) {
				case 'transit':
					// console.log(data);
					$('.kode_'+asal_modal).val(data.KdEdi);
					$('.uraian_'+asal_modal).val(data.UrEdi);
					break;
				case 'bongkar':
					// console.log(data);
					$('.kode_'+asal_modal).val(data.KdEdi);
					$('.uraian_'+asal_modal).val(data.UrEdi);
					break;
				default:
					break;
			}
			break;
		default:
			// console.log(asal_modal);
			break;

			
	}


}

$(document).ready(function(){
	initDatepicker($('.x-datepicker'));
	$('.select2').select2();
	$(".input-mask").inputmask({removeMaskOnSubmit: true,autoUnmask:true,unmaskAsNumber:true});

	const table_detail = $('#dt_doc_out_add');
	const table_dokumen = $('#table_dokumen');
	const table_kemasan = $('#table_kemasan');

	$(document).on('click', '.btn-delete-row', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_detail, 1);
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

	$('#caraAngkut').change(function (e) {
		let val = $(this).val();
		if (val==1){
			$('.sarana_angkut').hide();
			$('.let-1').show();
		} else {
			$('.sarana_angkut').hide();
			$('.let-other').show();
		}
	});

	keepSession();
});
