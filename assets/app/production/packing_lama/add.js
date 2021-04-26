let currentRow = '';

let elementTable = $('#dt_detail');
function attachData(data, key){
	switch(key) {
		case 't_production_detail_packing':
			elementTable.find('tbody').empty();
			let i = 0;
			for (let j = 0; j < data.length; j++) {
				const row = data[j];
				const lastData = elementTable.find('tbody').find('tr').last();
				let i = 0;
				if (lastData.length > 0) i = lastData.data('index');
				i++;

				let table_template = $('.template_row').find('tbody').html();
				table_template = replaceAll(table_template, "[x]", "["+i+"]");
				elementTable.find('tbody').append(table_template);

				let lastElement = elementTable.find('tbody').find('tr').last();
				lastElement.attr('data-index', i);
				lastElement.find('.production_material').val("["+row.id_production_detail+"]");
				lastElement.find('.id_wh_detail').val(row.id_wh_detail);
				lastElement.find('.id_detail_dn').val(row.id_detail_dn);
				lastElement.find('.id_header').val(row.id_header);
				lastElement.find('.id_sub_barang').val(row.id_sub_barang);
				lastElement.find('.seri_barang').val(row.seri_barang);
				lastElement.find('.kode_barang').text(row.kode_barang);
				lastElement.find('.nama_barang').text(row.nama_barang);
				lastElement.find('.kode_mutasi').text(row.kode_mutasi);
				lastElement.find('.tanggal_mutasi').text(moment(row.tanggal_mutasi).format('DD-MM-YYYY'));
				lastElement.find('.id_job').val(row.id_job);
				lastElement.find('.no_job').text(row.no_job);
				lastElement.find('.tanggal_job').text(moment(row.tanggal_job).format('DD-MM-YYYY'));
				lastElement.find('.id_satuan').val(row.id_satuan);
				lastElement.find('.kode_satuan').val(row.kode_satuan);
				lastElement.find('.label_qty').text(row.qty);
				lastElement.find('.qty').val(row.qty);
			}
			renderTableNumber(elementTable, 0);
			$(".input-mask").inputmask({removeMaskOnSubmit: true});
			break;
	}
}
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
		case 'referensi_pemasok':
			$('input[name="t_po[id_supplier]"]').val(data.ID);
			$('.name_supplier').val(data.NAMA);
			break;
		case 'referensi_negara':
			$('input[name="referensi_negara[ID]"]').val(data.ID);
			$('.KODE_NEGARA').val(data.URAIAN_NEGARA);
			break;
		case 't_job_packing':
			$('.id_job').val(data.id_job);
			$('.no_job').val(data.no_job);
			$('.id_sub_barang').val(data.id_sub_barang);
			$('.nama_barang').val(data.nama_barang);
			$('.id_satuan_fg').val(data.id_satuan);
			$('.kode_satuan').text(data.kode_satuan);
			$('.id_kemasan').val(data.id_kemasan);
			$('.kode_kemasan').text(data.kode_kemasan);
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

	$('.btn-add').on('click', function (e) {
		oTable_t_production_detail_packing.draw(false);
	})

	$(document).on('click', '.btn-delete', function () {
		let tr = $(this).closest('tr');
		tr.find('.deleted_at').val('1');
		tr.hide();
		renderTableNumber(elementTable, 0);
	});
	$(".input-mask").inputmask({removeMaskOnSubmit: true});
});
