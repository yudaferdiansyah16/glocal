function formatBom (option) {
	if (!option.id) { return option.text; }
	return '<div>'+option.nama_barang + ', Size: ' + option.size +'<br><span style="font-size: 10px">Order: #'+option.po_buyer+', Customer: '+ option.nama_supplier +'</span></div>';
}
function formatSO (option) {
	if (!option.id) { return option.text; }
	return '<div>'+option.kode_po + ', Customer: ' + option.nama_supplier +'<br><span style="font-size: 10px">Order: #' + option.po_buyer + '</span></div>';
}

function attachData(data, key){
	switch(key) {
		case 't_stock_request':
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
				lastElement.find('.id_sub_barang').val(row.id_sub_barang);
				lastElement.find('.id_satuan').val(row.id_satuan);
				lastElement.find('.kode_barang').text(row.kode_barang);
				lastElement.find('.nama_barang').text(row.nama_barang);
				lastElement.find('.size').text(row.size);
				lastElement.find('.kode_satuan').text(row.kode_satuan);
				lastElement.find('.qty_stock').text(formatCurrency(row.qty_stock), 2);
				lastElement.find('.qty_pending').text(formatCurrency(row.qty_pending), 2);
				lastElement.find('.qty_request').attr("data-inputmask", "'alias': 'currency', 'prefix': '', 'max': '"+parseFloat(row.qty_stock - row.qty_pending)+"'");

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
	$('.id_jenis_mutasi').select2();
	$('.id_jenis_mutasi').on('change', function () {
		const id_jenis_mutasi = $(this).val();
		if (id_jenis_mutasi == '16') {
			$('.section-sales').show();
			$('.section-production').hide();
			$('.id_bom').select2('val', '');
			$('.id_po').select2('val', '');
		} else if (id_jenis_mutasi == '13' || id_jenis_mutasi == '18') {
			$('.section-sales').hide();
			$('.section-production').show();
			$('.id_bom').select2('val', '');
			$('.id_po').select2('val', '');
		} else {
			$('.section-sales').hide();
			$('.section-production').hide();
		}
	});
	$('.id_bom').select2({
		minimumInputLength: 3,
		ajax: {
			dataType: "json",
			method: 'POST',
			url: _baseurl + "master/bom_produksi/select2",
			delay: 300,
			processResults: function (data) {
				return {
					results: data.map(function (item) {
						item.id = item.id_bom;
						item.text = item.nama_barang + ", Size: " + item.size + ' - PO Buyer: #'+item.po_buyer;
						return item;
					})
				};
			},
		},
		escapeMarkup: function (m) {
			return m;
		},
		templateResult: formatBom,
	}).on('select2:select', function(e){
		$('.id_po').val(e.params.data.id_po);
	});
	$('.id_po').select2({
		minimumInputLength: 3,
		ajax: {
			dataType: "json",
			method: 'POST',
			url: _baseurl + "sales/sales_order/select2",
			delay: 300,
			processResults: function (data) {
				return {
					results: data.map(function (item) {
						item.id = item.id_po;
						item.text = item.kode_po + ", Customer: " + item.nama_supplier + ' - PO Buyer: #'+item.po_buyer;
						return item;
					})
				};
			},
		},
		escapeMarkup: function (m) {
			return m;
		},
		templateResult: formatSO,
	}).on('select2:select', function(e){
	});

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
	})

	$('#tipeRequest').change(function (e) {
		let val = $(this).val();
		if (val == 'job') $('.template_request').show();
		if (val == 'nonjob') $('.template_request').hide();
	});
});
