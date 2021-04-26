let currentRow = '';

let elementTable = $('#table_detail');
function attachData(data, key){
	switch(key) {
		case 't_po_detail_planning_stuffing':
			elementTable.find('tbody').empty();
			let i = 0;
			for (let j = 0; j < data.length; j++) {
				const row = data[j];
				const lastData = elementTable.find('tbody').find('tr').last();
				let i = 0;
				if (lastData.length > 0) i = lastData.data('index');
				i++;

				let table_template = $('#template_row').find('tbody').html();
				table_template = replaceAll(table_template, "[x]", "["+i+"]");
				elementTable.find('tbody').append(table_template);

				let lastElement = elementTable.find('tbody').find('tr').last();
				lastElement.attr('data-index', i);
				lastElement.find('.kode_barang').val(row.kode_barang);
				lastElement.find('.keterangan').val(row.keterangan);
				lastElement.find('.id_satuan').val(row.id_satuan);
				lastElement.find('.qty_po').val(row.qty_po);
				lastElement.find('.kode_kemasan').val(row.kode_kemasan);
				lastElement.find('.qty_mc').val(row.qty_mc);
			}
			renderTableNumber(elementTable, 0);
			$(".input-mask").inputmask({removeMaskOnSubmit: true});
			break;
	}
}
function setValue(column, data){
	let index = '-1';
	switch (column) {
		case 't_stuffing':
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
		case 'referensi_pemasok':
			$('input[name="t_po[id_supplier]"]').val(data.ID);
			$('.name_supplier').val(data.NAMA);
			break;
		case 'referensi_negara':
			$('input[name="referensi_negara[ID]"]').val(data.ID);
			$('.KODE_NEGARA').val(data.URAIAN_NEGARA);
			break;
		case 't_job':
			$('input[name="t_job[id_job]"]').val(data.id_job);
			$('.no_job').val(data.no_job);
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

	$(document).on('click', '.btn-delete', function () {
		let tr = $(this).closest('tr');
		tr.find('.deleted_at').val('1');
		tr.hide();
		renderTableNumber(elementTable, 0);
	});
});
