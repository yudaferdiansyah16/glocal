function setValue(column, data){
	switch (column) {
		case 'return_request':
			//console.log(data);
			$('.kode_production_filter').val(data.kode_mutasi);
			$('.id_production_filter').val(data.id_production);
			break;
		default:
			break;
	}
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

	$(document).on('click', '.btn-search-item', function () {
		currentRow = $(this).closest('tr');
	});
});
