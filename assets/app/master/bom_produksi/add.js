function setValue(column, data){
    let index = '-1';
	switch (column) {
        case 't_bom_master':
            var form = $('.form-general');
			form.find('.kode_bom').val(data.kode_bom);
			form.find('input[name=id_bom]').val(data.id_bom);
			form.find('.qty_bom').val(data.qty);
			form.find('.nama_sub_barang').val(data.nama_barang);
			form.find('input[name=id_satuan]').val(data.id_satuan);
			form.find('.kode_satuan').text(data.kode_satuan);
            break;
		case 't_bom_produksi':
			var form = $('.form-rerun');
			form.find('input[name=id_detail_po]').val(data.id_detail_po);
			form.find('.id_bom_master').val(data.id_bom_master);
			form.find('.kode_bom').val(data.kode_bom);
			form.find('.kode_bom_master').val(data.kode_bom_master);
			form.find('.kode_po').val(data.kode_po);
			form.find('.po_buyer').val("#" + data.po_buyer);
			form.find('.nama_supplier').val(data.nama_supplier);
			form.find('input[name=id_bom]').val(data.id_bom_master);
			form.find('.nama_sub_barang').val(data.nama_barang);
			form.find('input[name=id_satuan]').val(data.id_satuan);
			form.find('.kode_satuan').text(data.kode_satuan);
			form.find('.qty_bom').val(data.qty_bom_master);
			break;
        case 't_detail_so_bom':
			var form = $('.form-general');
			form.find('input[name=id_detail_po]').val(data.id_detail_po);
			form.find('.kode_po').val(data.kode_po);
			form.find('.nama_supplier').val(data.nama_supplier);
			form.find('.tanggal_dibuat').val(moment(data.tanggal_dibuat).format('DD-MM-YYYY'));
			form.find('input[name=id_sub_barang]').val(data.id_sub_barang);
			form.find('.nama_sub_barang').val(data.nama_sub_barang);
			form.find('input[name=id_satuan]').val(data.id_satuan);
			form.find('.kode_satuan').text(data.kode_satuan);
			form.find('.po_buyer').val("#" + data.po_buyer);
			form.find('input[name=qty]').val(data.qty_sisa_bom);
            break;
		default:
			break;
	}
}

$(document).ready(function(){
	initDatepicker($('.x-datepicker'));
    $(".input-mask").inputmask({removeMaskOnSubmit: true});
	$(".input-mask").inputmask({removeMaskOnSubmit: true}).on('focus',function(){
		$(this).select();
	});

	let summernote = $('#summernote').summernote({
		height: 600
	});

	$('.bom_type').on('change', function () {
		const bom_type = $(this).val();
		switch (bom_type) {
			case "0":
				$('.form-general').show();
				$('.form-rerun').hide();
				break;
			case "1":
				$('.form-general').hide();
				$('.form-rerun').show();
				break;
			default:
				$('.form-general').hide();
				$('.form-rerun').hide();
				break;
		}
	});
});
