function setValue(column, data){
	switch (column) {
		case 'referensi_valuta':
			$('.nama_valuta').val(data.URAIAN_VALUTA);
			$('.kode_valuta').val(data.KODE_VALUTA);
			break;
		default:
			break;
	}
}

$(document).ready(function () {
	$(".input-mask").inputmask();
});
