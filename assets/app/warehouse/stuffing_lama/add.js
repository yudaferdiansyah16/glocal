let currentRow = '';
let elementTable;
let table_detail;
let init = false;

function attachData(data, key){
	switch(key) {
		case 't_wh_detail_stuffing':
			elementTable = $('#dt');
			if(arrdata_t_wh_detail_stuffing.length>0 && !init) {
				init = true;
				elementTable.find('tbody').empty();
			}

			if(data.length > 0){
				for (let j = 0; j < data.length; j++) {
					const row = data[j];
					if(checkExist(elementTable,'.id_wh_detail', row.id_wh_detail)){
						const lastData = elementTable.find('tbody').find('tr').last();
						let i = 0;
						if (lastData.length > 0) i = lastData.data('index');
						i++;

						let template_row = $('#template-row').find('tbody').html();
						template_row = replaceAll(template_row, "[x]", "["+i+"]");
						elementTable.find('tbody').append(template_row);

						let lastElement = elementTable.find('tbody').find('tr').last();
						lastElement.attr('data-index', i);
						lastElement.find('.id_detail_po').val(row.id_detail_po);
						lastElement.find('.id_wh_detail').val(row.id_wh_detail);
						lastElement.find('.no_job').text(row.no_job);
						lastElement.find('.tanggal_job').text(moment(row.tanggal_job).format('DD-MM-YYYY'));
						lastElement.find('.kode_mutasi').text(row.kode_mutasi);
						lastElement.find('.tanggal_terima').text(moment(row.tanggal_terima).format('DD-MM-YYYY'));
						lastElement.find('.id_sub_barang').val(row.id_sub_barang);
						lastElement.find('.nama_sub_barang').text(row.nama_barang);
						lastElement.find('.kode_barang').text(row.kode_barang);
						lastElement.find('.nilai_kemasan').val(row.nilai_kemasan);
						lastElement.find('.kode_satuan').text(row.kode_satuan);
						lastElement.find('.qty_remain').text(row.qty_remain);
					}

					renderTableNumber(elementTable, 0);
					$(".input-mask").inputmask({removeMaskOnSubmit: true}).on('focus',function(){
						$(this).select();
					});
				}
			}
			break;
	}
}

function setValue(column, data){
	let index = '-1';
	switch (column) {
		case 'referensi_pemasok':
			$('.id_supplier').val(data.ID);
			$('.nama_supplier').val(data.NAMA);
			break;
		case 'detail_supplier_destination':
			console.log(data);
			$('.destination').val(data.alamat);
			$('.id_country').val(data.id_negara);
			$('.uraian_negara').val(data.nama_negara);
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

	//$('.select2').select2();
	$(".input-mask").inputmask({removeMaskOnSubmit: true});

	const table_detail = $('#table-detail');
	$(document).on('click', '.btn-add-row', function (e) {
		oTable_t_wh_detail_stuffing.draw( false );
	});

	$(document).on('click', '.btn-search-destination', function () {
		oTable_detail_supplier_destination.draw( false );
	});

	$(document).on('click', '.btn-delete-row', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_detail, 0);
		renderSummary();
	})

	$(document).on('change', '.qty_si_plan', function () {
		let qty_mc = parseFloat($(this).inputmask('unmaskedvalue') || 0) * parseFloat($(this).closest('tr').find('.nilai_kemasan').val());
		$(this).closest('tr').find('.qty_mc_plan').inputmask("setvalue", qty_mc);
	});
});
