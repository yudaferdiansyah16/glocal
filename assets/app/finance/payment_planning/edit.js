function setValue(column, data){
	switch (column) {
		case 'referensi_valuta':
			$('.kode_valuta').val(data.KODE_VALUTA);
			$('.nama_valuta').val(data.URAIAN_VALUTA);
			$('.rates').val(data.rates_beli);
			break;
		default:
			break;
	}
}

$(document).ready(function(){
	initDatepicker($('.x-datepicker'));
	$('.select2').select2();

	$(".input-mask").inputmask();
});
