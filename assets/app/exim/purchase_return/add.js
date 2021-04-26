let currentRow = '';
let elementTable = $('#dt_return_add');
let table_detail;
let init = false;
let valuta;

function attachData(data, key) {
	switch (key) {
		case 't_detail_dn_return':
			if (arrdata_t_detail_dn_return.length > 0 && !init) {
				init = true;
				elementTable.find('tbody').empty();
			}

			if (data.length > 0) {
				console.log(data);
				for (let j = 0; j < data.length; j++) {
					const row = data[j];
					if (checkExist(elementTable, '.id_detail_dn', row.id_detail_dn)) {
						const lastData = elementTable.find('tbody').find('tr').last();
						let i = 0;
						if (lastData.length > 0) i = lastData.data('index');
						i++;

						let template_row = $('#template-row').find('tbody').html();
						template_row = replaceAll(template_row, "[x]", "[" + i + "]");
						elementTable.find('tbody').append(template_row);

						let lastElement = elementTable.find('tbody').find('tr').last();
						lastElement.attr('data-index', i);
						lastElement.find('#kode_dn').text(row.kode_dn);
						lastElement.find('#tanggal_dn').text(row.tanggal_kedatangan);
						lastElement.find('.id_detail_dn').val(row.id_detail_dn);
						lastElement.find('.id_sub_barang').val(row.id_sub_barang);
						lastElement.find('#nama_barang').text(row.nama_sub_barang);
                        lastElement.find('#kode_barang').text(row.kode_barang);
                        let qty = formatQuantity(Number(row.qty_dn))+ " " + row.kode_satuan;
                        let max = Number(row.qty_dn);
						lastElement.find('#qty_dn').text(qty);
						lastElement.find('#qty_return').attr('max', row.qty_dn);
					}
				}

				renderTableNumber(elementTable, 0);
				$(".input-mask").inputmask({
					removeMaskOnSubmit: true
				}).on('focus', function () {
					$(this).select();
				});

				$('#dt').off('change', '.input-mask').on('change', '.input-mask', function () {
					renderSummary();
				});
			}
			break;
	}
}

function setValue(column, data) {
	switch (column) {
		case 't_dn_return':
            let dn = ' [ ' + data.kode_dn + ' ] ' + data.nama_supplier
			$('.kode_dn').val(dn);
			$('.id_dn').val(data.id_dn);
			break;
		default:
			break;
	}
}


$(document).ready(function () {
	initDatepicker($('.x-datepicker'));
	
	$(".input-mask").inputmask({
		removeMaskOnSubmit: true,
		autoUnmask: true,
		unmaskAsNumber: true
	});

	$(document).on('click', '.btn-delete', function () {
		let tr = $(this).closest('tr');
		tr.find('.deleted_at').val('1');
		tr.hide();
		renderTableNumber(elementTable, 0);
	});
});
