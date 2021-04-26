let currentRow = '';
let elementTable;
let table_detail;
let init = false;

function attachData(data, key){
	switch(key) {
		case 't_detail_stuffing_invoice':
			elementTable = $('#dt');
			if(arrdata_t_detail_stuffing_invoice.length>0 && !init) {
				init = true;
				elementTable.find('tbody').empty();
			}

			if(data.length > 0){
				for (let j = 0; j < data.length; j++) {
					const row = data[j];
					if(checkExist(elementTable,'.id_detail_po', row.id_detail_po)){
						const lastData = elementTable.find('tbody').find('tr').last();
						let i = 0;
						if (lastData.length > 0) i = lastData.data('index');
						i++;

						let template_row = $('#template-row').find('tbody').html();
						template_row = replaceAll(template_row, "[x]", "["+i+"]");
						elementTable.find('tbody').append(template_row);

						let lastElement = elementTable.find('tbody').find('tr').last();
						lastElement.attr('data-index', i);
						lastElement.find('.id_detail_po').val(row.id_detail_po);
						lastElement.find('.id_detail_stuffing').val(row.id_detail_stuffing);
						lastElement.find('.id_sub_barang').val(row.id_sub_barang);
						lastElement.find('.kode_po').text(row.kode_po);
						lastElement.find('.po_buyer').text(row.po_buyer);
						lastElement.find('.nama_sub_barang').text(row.nama_barang);
						lastElement.find('.kode_barang').text(row.kode_barang);
						lastElement.find('.kode_kemasan').text(row.kode_kemasan);
						lastElement.find('.nilai_kemasan').val(row.nilai_kemasan);
						lastElement.find('.id_kemasan').val(row.id_kemasan);
						lastElement.find('.id_satuan').val(row.id_satuan);
						lastElement.find('.kode_satuan').text(row.kode_satuan);
						lastElement.find('.qty_si_real').text(row.qty_si_real);
						lastElement.find('.qty_mc_real').text(row.qty_mc_real);
					}

					renderTableNumber(elementTable, 0);
					$(".input-mask").inputmask({removeMaskOnSubmit: true}).on('focus',function(){
						$(this).select();
					});
				}
			}
			break;
	}
}

function setValue(column, data){
	let index = '-1';
	switch (column) {
		case 'referensi_pemasok':
			$('.id_supplier').val(data.ID);
			$('.nama_supplier').val(data.NAMA);
			break;
		case 'detail_supplier_destination':
			console.log(data);
			$('.destination').val(data.alamat);
			$('.id_country').val(data.id_negara);
			$('.uraian_negara').val(data.nama_negara);
			break;
		case 'referensi_valuta':
			$('.id_valuta').val(data.ID);
			$('.kode_valuta').val(data.KODE_VALUTA);
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

$(document).ready(function(){
	initDatepicker($('.x-datepicker'));

	//$('.select2').select2();
	$(".input-mask").inputmask({removeMaskOnSubmit: true});

	const table_detail = $('#table-detail');
	$(document).on('click', '.btn-add-row', function (e) {
		oTable_t_detail_stuffing_invoice.draw( false );
	});

	$(document).on('click', '.btn-search-destination', function () {
		oTable_detail_supplier_destination.draw( false );
	});

	$(document).on('click', '.btn-delete-row', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_detail, 0);
		renderSummary();
	});

	$(document).on('change', '.qty_invoice', function () {
		let quantity = parseFloat($(this).closest('tr').find('.qty_invoice').inputmask('unmaskedvalue') || 0);
		let harga = parseFloat($(this).closest('tr').find('.harga').inputmask('unmaskedvalue') || 0);
		let subtotal = quantity * harga;
		$(this).closest('tr').find('.subtotal').inputmask("setvalue", subtotal);
	});

	$(document).on('change', '.harga', function () {
		let quantity = parseFloat($(this).closest('tr').find('.qty_invoice').inputmask('unmaskedvalue') || 0);
		let harga = parseFloat($(this).closest('tr').find('.harga').inputmask('unmaskedvalue') || 0);
		let subtotal = quantity * harga;
		$(this).closest('tr').find('.subtotal').inputmask("setvalue", subtotal);
	});
});
