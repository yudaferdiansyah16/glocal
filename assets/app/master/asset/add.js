function setValue(column, data){
	let index = '-1';
	switch (column) {
		case 'm_sub_barang':
			$('input[name="nama_barang').val(data.nama_barang);
			$('input[name="id_barang').val(data.id_sub_barang);
			$('input[name="id_satuan_terkecil').val(data.id_satuan_terkecil);
			$('input[name="id_satuan_terbesar').val(data.id_satuan_terbesar);
			$('input[name="kode_hs').val(data.kode_hs);
			$('input[name="id_kategori').val(data.id_kategori);
			$('input[name="id_class').val(data.id_class);
			$('input[name="id_asal').val(data.id_asal);
			$('input[name="id_brand').val(data.id_brand);
			$('input[name="style').val(data.id_style);
			$('input[name="colour').val(data.colour);
			$('input[name="size').val(data.size);
			$('input[name="dimensi').val(data.dimensi);
			break;
		default:
			break;
	}
}
