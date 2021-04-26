function setValue(column, data){
	let index = '-1';
	switch (column) {
		case 'm_akun':
			$('input[name="id_akun"]').val(data.id_akun);
			$('.nama_akun').val(data.nama_akun);
			break;
		case 'm_akun_lawan':
			$('input[name="id_akun_lawan"]').val(data.id_akun);
			$('.nama_akun_lawan').val(data.nama_akun);
			break;
		default:
			break;
	}
}

$(document).ready(function(){
	$('.select2').select2();
});
