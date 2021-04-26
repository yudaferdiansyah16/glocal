function setValue(column, data){
    let index = '-1';
	switch (column) {
        case 't_detail_so_bom':
            $('input[name=id_detail_po]').val(data.id_detail_po);
            $('.kode_po').val(data.kode_po);
            $('.nama_supplier').val(data.nama_supplier);
            $('.tanggal_dibuat').val(data.tanggal_dibuat);
            $('input[name=id_sub_barang]').val(data.id_sub_barang);
            $('.nama_sub_barang').val(data.nama_sub_barang);
            $('input[name=qty]').val(data.qty_sisa_bom);
            $('input[name=id_satuan]').val(data.id_satuan);
            $('.kode_satuan').text(data.kode_satuan);
            break;
		default:
			break;
	}
}
$(document).ready(function(){
	initDatepicker($('.x-datepicker'));
    $(".input-mask").inputmask({removeMaskOnSubmit: true});

	let summernote = $('#summernote').summernote({
		height: 600
	});
});
