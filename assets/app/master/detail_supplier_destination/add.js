function setValue(column, data){
	let index = '-1';
	switch (column) {
		case 'referensi_pemasok':
			$('input[name="id_supplier"]').val(data.ID);
			$('.nama_supplier').val(data.NAMA);
			break;
		case 'referensi_negara':
			$('input[name="id_negara"]').val(data.ID);
			$('.nama_negara').val(data.URAIAN_NEGARA);
			break;
		default:
			break;
	}
}
