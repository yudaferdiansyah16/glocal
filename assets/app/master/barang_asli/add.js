let currentGroup = null;
function setValue(column, data){
	let index = '-1';
	switch (column) {
		case 'referensi_satuan':
			currentGroup.find('.id_satuan').val(data.ID);
			currentGroup.find('.nama_satuan').val(data.URAIAN_SATUAN);
			break;
		case 'm_kategori':
			$('.id_kategori').val(data.id_kategori);
			$('.nama_kategori').val(data.nama_kategori);
			break;
		case 'referensi_kemasan':
			currentGroup.find('.id_kemasan').val(data.ID);
			currentGroup.find('.nama_kemasan').val(data.URAIAN_KEMASAN);
			break;
		default:
			break;
	}
}

$(document).ready(function(){
	$('.select2').select2();

	$('.btn-search-satuan, .btn-search-packaging').on('click', function(e) {
		currentGroup = $(this).closest('.input-group-sm');
	});

	//$('.is-child').hide();

	$('#havingchild').on('change',function(){
		let v = $(this).is(':checked');
		if(!v) $('.is-child').show();
		else $('.is-child').hide();
	})
});
