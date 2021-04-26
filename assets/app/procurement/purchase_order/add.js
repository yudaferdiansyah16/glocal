let currentRow = '';
let elementTable = $('#dt_po_add');
let table_detail;
let init = false;
let valuta;

function attachData(data, key) {
	switch (key) {
		case 't_detail_pp_po':
			if (arrdata_job_pp_po.length > 0 && !init) {
				init = true;
				elementTable.find('tbody').empty();
			}

			if (data.length > 0) {
				// console.log(data);
				for (let j = 0; j < data.length; j++) {
					const row = data[j];
					if (checkExist(elementTable, '.id_detail_pp', row.id_detail_pp)) {
						const lastData = elementTable.find('tbody').find('tr').last();
						let i = 0;
						if (lastData.length > 0) i = lastData.data('index');
						i++;

						let template_row = $('#template-row').find('tbody').html();
						template_row = replaceAll(template_row, "[x]", "[" + i + "]");
						elementTable.find('tbody').append(template_row);

						let lastElement = elementTable.find('tbody').find('tr').last();
						lastElement.attr('data-index', i);
						lastElement.find('#kode_pp').text(row.kode_pp);
						lastElement.find('#no_job').text(row.no_job);
						lastElement.find('.id_detail_pp').val(row.id_detail_pp);
						lastElement.find('.id_sub_barang').val(row.id_sub_barang);
						lastElement.find('#nama_barang').text(row.nama_barang);
						lastElement.find('#kode_barang').text(row.kode_barang);
						lastElement.find('.satuana').text(row.satuan);
						lastElement.find('.satuanb').text(row.satuan);
						lastElement.find('.satuanc').text(row.satuan);
						lastElement.find('.valuta').text(valuta);
						lastElement.find('.qty_po').val(row.qty_sisa);
						lastElement.find('.qty_pp').val(row.qty_pp);
						lastElement.find('.qty_terbeli').val(row.qty_terbeli);
						let harga = row.harga;
						let subtotal = parseFloat(harga.replace(",", "")) * parseFloat(row.qty_sisa);
						lastElement.find('.subtotal').val(subtotal);
						// lastElement.find('.qty_po').attr('max', row.qty_sisa);
						// lastElement.find('.qty_po').attr('max', row.qty_sisa);
						lastElement.find('.keterangan').val(row.keterangan);
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

function renderSummary() {
	let total_value = 0;
	$('#dt_po_add').find('tbody').find('tr').each(function(index) {
        const input_qty_po = $(this).find('.qty_po');
        const input_price = $(this).find('.harga');
        const subtotal = parseFloat(input_qty_po.inputmask('unmaskedvalue') || 0) * parseFloat(input_price.inputmask('unmaskedvalue') || 0);
        $(this).find('.subtotal').inputmask("setvalue", subtotal);
        total_value = total_value + subtotal;
    });
    $('.total').inputmask("setvalue", total_value);
}

function setValue(column, data) {
	switch (column) {
		case 'm_supplier':
			$('.id_supplier').val(data.id_customer);
			$('.nama_supplier').val(data.nama);
			$('.alamat_supplier').val(data.alamat);
			oTable_t_detail_pp_po.ajax.reload().draw();
			break;
		case 'referensi_valuta':
			$('.id_valuta').val(data.ID);
			$('.nama_valuta').val(data.URAIAN_VALUTA);
			$('.kode_valuta').val(data.KODE_VALUTA);
			$('.rates').val(data.rates_beli);
			valuta = data.KODE_VALUTA;
			break;
		case 't_job':
			$('.id_job').val(data.id_job);
			$('.nama_job').val(data.no_job);
			oTable_t_detail_pp_po.ajax.reload().draw();
			$('.searchbtn').hide();
			$('.clearbtn').show();
			break;
		default:
			break;
	}
}

function clearBtn() {
	$('.id_job').val('');
	$('.nama_job').val('');
	oTable_t_detail_pp_po.ajax.reload().draw();
	$('.searchbtn').show();
	$('.clearbtn').hide();
}

$(document).ready(function () {
	initDatepicker($('.x-datepicker'));
	$('.select2').select2();

	$(".input-mask").inputmask({
		removeMaskOnSubmit: true,
		autoUnmask: true,
		unmaskAsNumber: true
	});

	$("#nonjob").change(function () {
		if (this.checked) {
			$('.nonjob').val('true');
			$('.filter_job').hide()
			oTable_t_detail_pp_po.ajax.reload().draw();
		} else {
			$('.nonjob').val('');
			$('.filter_job').show()
			oTable_t_detail_pp_po.ajax.reload().draw();
		}
	});

	$(document).on('click', '.btn-delete', function () {
		let tr = $(this).closest('tr');
		tr.find('.deleted_at').val('1');
		tr.hide();
		renderTableNumber(elementTable, 0);
		renderSummary();
	});
});
