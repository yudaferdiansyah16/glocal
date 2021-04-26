let currentGroup = null;
function setValue(column, data){
	let index = '-1';
	switch (column) {
		case 'm_barang' :
			$('input[name="id_barang"]').val(data.id_barang);
			$('input[name="id_fasilitas"]').val(data.id_fasilitas);
			$('input[name="serial_barang"]').val(data.serial_barang);
			$('.nama_barang_parent').val(data.nama_barang);
			break;
		case 'referensi_satuan':
			currentGroup.find('.id_satuan').val(data.ID);
			currentGroup.find('.nama_satuan').val(data.URAIAN_SATUAN);
			break;
		case 'm_hs':
			$('input[name="kode_hs"]').val(data.kode_hs);
			$('.nama_hs').val(data.kode_hs);
			break;
		case 'm_kategori':
			$('input[name="id_kategori"]').val(data.id_kategori);
			$('.nama_kategori').val(data.nama_kategori);
			break;
		default:
			break;
	}
}

$(document).ready(function(){
	$('.select2').select2();

	$('.btn-search-satuan').on('click', function(e) {
		currentGroup = $(this).closest('.input-group-sm');
	})
});
