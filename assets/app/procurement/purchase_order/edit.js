let deleted_detail_po = [];

function attachData(data, key){
	switch(key) {
		case 't_detail_pp_po':
			let elementTable = $('.dt_po_add');
			elementTable.find('tbody');
			for (let j = 0; j < data.length; j++) {
				const row = data[j];
				const lastData = elementTable.find('tbody').find('tr').last();
				let i = 0;
				if (lastData.length > 0) i = lastData.data('index');
				i++;
				let template_row = $('#template-row').find('tbody').html();
				template_row = replaceAll(template_row, "[x]", "["+i+"]");
				elementTable.find('tbody').append(template_row);
				let lastElement = elementTable.find('tbody').find('tr').last();
				lastElement.attr('data-index', i);
				lastElement.find('#kode_pp').text(row.kode_pp);
				lastElement.find('.id_detail_pp').val(row.id_detail_pp);
				lastElement.find('.id_sub_barang').val(row.id_sub_barang);
				lastElement.find('#nama_barang').text(row.nama_barang);
				lastElement.find('#kode_barang').text(row.kode_barang);
				lastElement.find('.nama_brand').val(row.nama_brand);
				lastElement.find('.dimensi').val(row.dimensi);
				lastElement.find('.size').val(row.size);
				lastElement.find('.colour').val(row.colour);
				lastElement.find('.nama_style').val(row.nama_style);
				lastElement.find('.harga').val(row.harga);
				lastElement.find('.qty_po').val(row.qty_sisa);
				// lastElement.find('.qty_po').attr('max',row.qty_sisa);
				lastElement.find('.keterangan').val(row.keterangan);
			}
			renderTableNumber(elementTable, 0);
			$(".input-mask").inputmask({removeMaskOnSubmit: true});
			break;
	}
}

function setValue(column, data){
	switch (column) {
		case 'm_supplier':
			console.log(data);
			$('.id_supplier').val(data.id_customer);
			$('.nama_supplier').val(data.nama);
			$('.alamat_supplier').val(data.alamat);
			break;
		case 'referensi_valuta':
			$('.id_valuta').val(data.ID);
			$('.nama_valuta').val(data.URAIAN_VALUTA);
			break;
		default:
			break;
	}
}

function replaceAll(str, find, replace) {
	while (str.includes(find)) {
		str = str.replace(find, replace);
	}
	return str;
}



$(document).ready(function(){
	initDatepicker($('.x-datepicker'));
	$('.select2').select2();
	$(".input-mask").inputmask({removeMaskOnSubmit: true,autoUnmask:true,unmaskAsNumber:true});

	$(document).on('click', '.btn-delete', function () {
		let tr = $(this).closest('tr');
		let id_detail_po = tr.find('.id_detail_po').val();
		if (id_detail_po != '') {
			deleted_detail_po.push(id_detail_po);
			$('#deleted_detail_po').val(JSON.stringify(deleted_detail_po));
		}
		$(this).closest('tr').remove();
		renderTableNumber(elementTable, 0);
	});
});
