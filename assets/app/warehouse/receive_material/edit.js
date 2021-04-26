function setValue(column, data){
	let index = '-1';
	switch (column) {
		case 't_dn':
			let elementTable = $('#dt')
			$('.kode_dn').val(data.kode_dn);
			$('.no_faktur').val(data.no_faktur);
			$('.nama_supplier').val(data.nama_supplier);
			$('.tgl_kedatangan').val(data.tgl_kedatangan);
			$.ajax({
				type: 'GET',
				url: _baseurl+"procurement/delivery_note_po/detailjson/"+data.id_dn,
				dataType: 'json',
				success: function (response) {
					const detail_dn = response;
					elementTable.find('tbody').empty();
					for (let j = 0; j < detail_dn.length; j++) {
						const row = detail_dn[j];

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
						lastElement.find('.id_detail_dn').val(row.id_detail_dn);
						lastElement.find('.label_harga').text(row.harga);
						lastElement.find('.harga_satuan').val(parseFloat(row.harga));
						lastElement.find('.rate').val(row.rate);
						lastElement.find('.kode_valuta').text(row.kode_valuta);
						lastElement.find('.no_sj').text(row.no_sj);
						lastElement.find('.tanggal_dibuat').text(row.tanggal_dibuat);
						lastElement.find('.kode_barang').text(row.kode_barang);
						lastElement.find('.nama_sub_barang').text(row.nama_sub_barang);
						lastElement.find('.kode_satuan').text(row.kode_satuan);
						lastElement.find('.qty_dn').text(row.qty_dn);
						lastElement.find('.qty').val(row.qty_dn);
						i++;
					}
					$(".input-mask").inputmask({removeMaskOnSubmit: true});
					renderTableNumber(elementTable, 0);
				}
			});
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
	$('.select2').select2();
	$(".input-mask").inputmask({removeMaskOnSubmit: true});
});
