$(document).ready(function(){
	initDatepicker($('.x-datepicker'));
	$('.select2').select2();

	const table_detail = $('#table-detail');
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
});
