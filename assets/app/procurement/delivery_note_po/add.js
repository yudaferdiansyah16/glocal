let elementTable = $('#dt');

function setValue(column, data){
	let index = '-1';
	switch (column) {
		case 'm_supplier':
			$('.id_supplier').val(data.id_customer);
			$('.name_supplier').val(data.nama);
			oTable_t_detail_po_dn.ajax.reload().draw();
			break;
		default:
			break;
	}
}

function attachData(data, key){
	switch(key) {
		case 't_detail_po_dn':
			for (let j = 0; j < data.length; j++) {
				const row = data[j];
				if(checkExist(elementTable,'.id_detail_po', row.id_detail_po)) {
					const lastData = elementTable.find('tbody').find('tr').last();
					let i = 0;
					if (lastData.length > 0) i = lastData.data('index');
					i++;

					let template_row = $('#template-row').find('tbody').html();
					template_row = replaceAll(template_row, "[x]", "[" + i + "]");
					elementTable.find('tbody').append(template_row);
					let lastElement = elementTable.find('tbody').find('tr').last();
					lastElement.attr('data-index', i);
					lastElement.find('.id_detail_po').val(row.id_detail_po);
					lastElement.find('.data-index').val(i);
					lastElement.find('.harga').val(row.harga);
					lastElement.find('.label_harga').text(formatCurrency(row.harga, 2));
					lastElement.find('.kode_valuta').text(row.kode_valuta);
					lastElement.find('.kode_satuan').text(row.kode_satuan);
					lastElement.find('.kode_po').text(row.kode_po);
					lastElement.find('.tanggal_dibuat').text(moment(row.tanggal_dibuat).format('DD-MM-YYYY'));
					lastElement.find('.nama_sub_barang').text(row.nama_barang);
					lastElement.find('.kode_barang').text(row.kode_barang);
					lastElement.find('.qty_po').text(formatCurrency(row.qty_po, 2));
					lastElement.find('.sisa_qty_dn').text(row.qty_dn);
					lastElement.find('.qty_sj').val(row.sisa_qty_dn);
					lastElement.find('.id_sub_barang').val(row.id_sub_barang);
					lastElement.find('.qty_dn').val(row.sisa_qty_dn);
					lastElement.find('.qty_sj').attr('max',row.sisa_qty_dn);
					lastElement.find('.qty_dn').attr('max',row.sisa_qty_dn);
					if ($('.no_sj_all').val().length > 0) lastElement.find('.no_sj').val($('.no_sj_all').val());
					if ($('.tanggal_sj_all').val().length > 0) lastElement.find('.tanggal_sj').val($('.tanggal_sj_all').val());
				}
			}
			renderTableNumber(elementTable, 0);
			$(".input-mask").inputmask({removeMaskOnSubmit: true});
			initDatepicker($('.x-datepicker'));
			break;
	}
}

function replaceAll(str, find, replace) {
	while (str.includes(find)) {
		str = str.replace(find, replace);
	}
	return str;
}

function setdnmaxvalue() {
	$('#dt').find('tbody').find('tr').each(function(index) {
        const qty_sj = $(this).find('.qty_sj');
        $(this).find('.qty_dn').inputmask("setvalue", parseFloat(qty_sj.inputmask('unmaskedvalue')));
        $(this).find('.qty_dn').attr('max',parseFloat(qty_sj.inputmask('unmaskedvalue')));
    });
}

$(document).ready(function(){
	initDatepicker($('.x-datepicker'));
	$('.select2').select2()

	$(document).on('click', '.btn-delete', function () {
		let tr = $(this).closest('tr');
		tr.remove();
		renderTableNumber(elementTable, 0);
	});

	$(".input-mask").inputmask({removeMaskOnSubmit: true});

	$('.btn-add').on('click', function (e) {
		oTable_t_detail_po_dn.ajax.reload( null, false );
	});

	$('.no_sj_all').on('change', function (e) {
		const no_sj = $(this).val();
		if (no_sj.length > 0) {
			$('.no_sj').attr('readonly', true);
		} else {
			$('.no_sj').attr('readonly', false);
		}
		$('.no_sj').val(no_sj);
	});

	$('.tanggal_sj_all').on('change', function (e) {
		const no_sj = $(this).val();
		if (no_sj.length > 0) {
			$('.tanggal_sj').attr('readonly', true);
			$('.tanggal_sj').removeClass('x-datepicker');
		} else {
			$('.tanggal_sj').attr('readonly', false);
		}
		$('.tanggal_sj').val(no_sj);
	});
});
