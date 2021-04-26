let deleted_detail = [];

function attachData(data, key){
	switch(key) {
		case 't_wh_detail_stock':
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
				lastElement.find('.nomor_aju').text(row.nomor_aju);
				lastElement.find('.nomor_daftar').text(row.nomor_daftar);
				lastElement.find('.no_sj').text(row.no_sj);
				lastElement.find('.no_job').text(row.no_job);
				lastElement.find('.id_detail_dn').val(row.id_detail_dn);
				lastElement.find('.id_job').val(row.id_job);
				lastElement.find('.id_sub_barang').val(row.id_sub_barang);
				lastElement.find('.harga_satuan').val(row.harga_satuan);
				lastElement.find('.rate').val(row.rate);
				lastElement.find('.id_satuan').val(row.id_satuan);
				lastElement.find('.id_koordinat_asal').val(row.id_koordinat);
				lastElement.find('.kode_barang').text(row.kode_barang);
				lastElement.find('.nama_barang').text(row.nama_barang);
				lastElement.find('.kode_satuan').text(row.kode_satuan);
				lastElement.find('.nama_gudang').text(row.nama_gudang);
				lastElement.find('.nama_koordinat').text(row.nama_koordinat);
				lastElement.find('.qty_stock').text(formatCurrency(row.qty_stock), 2);
				lastElement.find('.qty').attr("data-inputmask", "'alias': 'currency', 'prefix': '', 'max': '"+parseFloat(row.qty_stock)+"'");

				$(".input-mask").inputmask({removeMaskOnSubmit: true}).on('focus',function(){
					$(this).select();
				});
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
		let tr = $(this).closest('tr');
		const id_wh_detail = tr.find('.id_wh_detail').val();
		if (id_wh_detail != '') {
			deleted_detail.push(id_wh_detail);
			$('#deleted_detail').val(JSON.stringify(deleted_detail));
		}
		$(this).closest('tr').remove();
	})

	$('#tipeRequest').change(function (e) {
		let val = $(this).val();
		if (val == 'job') $('.template_request').show();
		if (val == 'nonjob') $('.template_request').hide();
	});

	$(".input-mask").inputmask({removeMaskOnSubmit: true}).on('focus',function(){
		$(this).select();
	});
});
