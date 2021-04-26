let currentRow = '';

function setValue(column, data){
	let index = '-1';
	switch (column) {
		case 'referensi_valuta':
			$('input[name="referensi_valuta[id_valuta]"]').val(data.ID);
			$('.nama_valuta').val(data.KODE_VALUTA);
			break;
		case 'referensi_dokumen':
			$('input[name="referensi_dokumen[ID]"]').val(data.ID);
			$('.URAIAN_DOKUMEN').val(data.URAIAN_DOKUMEN);
			break;
		case 'm_akun':
			$('input[name="m_akun[id_akun]"]').val(data.id_akun);
			$('.nama_akun').val(data.nama_akun);
			break;
		case 'm_user':
			$('input[name="m_user[id_user]"]').val(data.id_user);
			$('.username').val(data.username);
			break;
		default:
			break;
	}
}

function renderSummary() {
	let total_pack = 0; total_value = 0;
	$('#table-detail').find('tbody').find('tr').each(function(index) {
		const input_pack = $(this).find('.input-pack');
		total_pack = total_pack + parseFloat(input_pack.inputmask('unmaskedvalue') || 0);
		const input_quantity = $(this).find('.input-quantity');
		const input_price = $(this).find('.input-price');
		const subtotal = parseFloat(input_quantity.inputmask('unmaskedvalue') || 0) * parseFloat(input_price.inputmask('unmaskedvalue') || 0);
		$(this).find('.input-subtotal').inputmask("setvalue", subtotal);
		total_value = total_value + subtotal;
	});
	$('.input-pack-total').inputmask("setvalue", total_pack);
	$('.input-total').inputmask("setvalue", total_value);
}

function addRow() {
	const table_detail = $('#table-detail');
	let row_template = $('.table-template').find('tbody').html();
	let last_row =  table_detail.find('tbody').find('tr').last();
	let last_index = last_row.length > 0 ? parseFloat(last_row.attr('data-index')) : -1;
	last_index++;
	row_template = replaceAll(row_template, '[x]', '['+ last_index +']');
	table_detail.find('tbody').append(row_template);
	$('#table-detail').find('tbody').find('tr').last().attr('data-index', last_index);

	$(".input-mask").inputmask({removeMaskOnSubmit: true});
	renderTableNumber(table_detail, 0);
	renderSummary();
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
		addRow();
	});

	$(document).on('click', '.btn-search-item', function () {
		currentRow = $(this).closest('tr');
	});

	$(document).on('click', '.btn-search-kemasan', function () {
		currentRow = $(this).closest('tr');
	});

	$(document).on('click', '.btn-delete-row', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_detail, 0);
		renderSummary();
	})

	$(document).on('change', '.input-mask', function () {
		renderSummary();
	});

	addRow();
});
