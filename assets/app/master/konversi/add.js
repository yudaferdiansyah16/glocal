let currentGroup = null;
function setValue(column, data){
	let index = '-1';
	switch (column) {
		case 'm_sub_barang':
			$('input[name="id_sub_barang"]').val(data.id_sub_barang);
			$('.nama_barang').val(data.nama_barang);
			break;
		case 'referensi_satuan':
			currentGroup.find('.id_satuan').val(data.ID);
			currentGroup.find('.nama_satuan').val(data.URAIAN_SATUAN);
			break;
		default:
			break;
	}
}

function attachData(data, key){
	switch(key) {
		case 'm_sub_barang':
			if(data.length > 0){
				for (let j = 0; j < data.length; j++) {
					const row = data[j];
					$('input[name="id_sub_barang"]').val(row.id_sub_barang);
					$('.nama_barang').val(row.nama_barang);
				}
			}
			break;
	}
}

$(document).ready(function(){
	$('.btn-search-satuan').on('click', function(e) {
		currentGroup = $(this).closest('.input-group-sm');
	})
});
