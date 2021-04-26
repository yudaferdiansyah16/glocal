function attachData(data, key){
	switch(key) {
		case 't_wh_detail_request':
			let elementTable = $('#dt_request_add');
			elementTable.find('tbody').empty();
			for (let j = 0; j < data.length; j++) {
				const row = data[j];
				const lastData = elementTable.find('tbody').find('tr').last();
				let i = 0;
				if (lastData.length > 0) i = lastData.data('index');
				i++;

				let table_template = $('.table_template').find('tbody').html();
				table_template = replaceAll(table_template, "[x]", "["+i+"]");
				elementTable.find('tbody').append(table_template);

				let lastElement = elementTable.find('tbody').find('tr').last();
				lastElement.attr('data-index', i);
				lastElement.find('.text_nomor_aju').text(row.nomor_aju);
				lastElement.find('.text_nomor_daftar').text(row.nomor_daftar);
				lastElement.find('.text_no_sj').text(row.no_sj);
				lastElement.find('.text_no_job').text(row.no_job);
				lastElement.find('.id_job').val(row.id_job);
				lastElement.find('.id_sub_barang').val(row.id_sub_barang);
				lastElement.find('.text_kode_barang').text(row.kode_barang);
				lastElement.find('.text_nama_barang').text(row.nama_barang);
				lastElement.find('.seri_barang').val(row.seri_barang);
				lastElement.find('.text_qty_wh').text(formatQuantity(Number(row.qty_sisa)));
				lastElement.find('.qty').attr('max',row.qty_sisa);
				lastElement.find('.id_wh').val(row.id_wh);
				lastElement.find('.id_wh_detail').val(row.id_wh_detail);
				lastElement.find('.id_detail_dn').val(row.id_detail_dn);
				lastElement.find('.id_header').val(row.id_header);
			}
			renderTableNumber(elementTable, 0);
			$(".input-mask").inputmask({removeMaskOnSubmit: true});
			break;
	}
}

function replaceAll(str, find, replace) {
	while (str.includes(find)) {
		str = str.replace(find, replace);
	}
	return str;
}



function setValue(column, data){
	switch (column) {
		case 't_job':
			//console.log(data);
			$('.no_job').val(data.no_job);
			$('.id_job').val(data.id_job);
			$('#dt_t_wh_detail_request').DataTable().search(data.no_job).draw();
			break;
		default:
			break;
	}
}

$(document).ready(function(){
	initDatepicker($('.x-datepicker'));
	$('.select2').select2();

	const table_detail = $('#dt_request_add');
	$(document).on('click', '.btn-add-row', function (e) {
		const row_template = $('.table-template').find('tbody').html();
		table_detail.find('tbody').append(row_template);

		$(".input-mask").inputmask();
		renderTableNumber(table_detail, 0);
	});

	$(document).on('click', '.btn-search-item', function () {
		currentRow = $(this).closest('tr');
	});

	$(document).on('click', '.btn-delete-row', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_detail, 0);
	})

	$('#tipeRequest').change(function (e) {
		let val = $(this).val();
		if (val == 'job') $('.template_request').show();
		if (val == 'nonjob') $('.template_request').hide();
	});
});
