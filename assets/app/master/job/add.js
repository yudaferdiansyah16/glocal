function setValue(column, data){
	let index = '-1';
	switch (column) {
		case 't_bom':
			$('.id_bom').val(data.id_bom);
			$('.kode_bom').val(data.kode_bom);
			break;
		default:
			break;
	}
}

$(document).ready(function(){
	initDatepicker($('.x-datepicker'));
});
