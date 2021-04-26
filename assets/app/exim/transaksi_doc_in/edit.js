function setValue(column, data){
	switch (column) {
		case 'm_jenis_pp':
			//console.log(data);
			$('input[name=id_jenis_pp]').val(data.id_jenis_pp);
			$('input[name=nama_jenis_pp]').val(data.nama_jenis_pp);
			break;
		default:
			break;
	}
}

$(document).ready(function(){
	initDatepicker($('.x-datepicker'));
	$('.select2').select2();

	const table_detail = $('#table-detail');
	const table_detail_262 = $('#table-detail-262');

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
	});

	$(document).on('click', '.btn-add-row-262', function (e) {
		const row_template = $('.table-template-262').find('tbody').html();
		table_detail_262.find('tbody').append(row_template);
		initDatepicker($('.x-datepicker'));
		$(".input-mask").inputmask();
		renderTableNumber(table_detail_262, 0);
	});

	$(document).on('click', '.btn-delete-row-262', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_detail_262, 0);
	});
});

$(function () {
	$('#jenis_dokumen').change(function (e) {
		//let v = e.target.value;
		//console.log(v);
		$('.dokumen_template').hide();
		$('.include-'+$(this).val()).show();
	})
})
