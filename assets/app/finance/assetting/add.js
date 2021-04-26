let currentRow = '';

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
	$('.select2').select2();
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
