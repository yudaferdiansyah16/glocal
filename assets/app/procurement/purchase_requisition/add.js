let currentRow = '';
let elementTable;
let table_detail;
let init = false;
let rutin;

function attachData(data, key){
	switch(key) {
		case 't_detail_job_pp':
			rutin = $('#jenis_pp_rutinitas').val();
			if(rutin === '1'){
				elementTable = $('#dt_pp_rutin_add');
				if(arrdata_job_pp.length>0 && !init) {
					init = true;
					elementTable.find('tbody').empty();
				}

				if(data.length > 0){
					for (let j = 0; j < data.length; j++) {
						const row = data[j];
						if(checkExist(elementTable,'.id_detail_job', row.id_detail_job)){
							const lastData = elementTable.find('tbody').find('tr').last();
							let i = 0;
							if (lastData.length > 0) i = lastData.data('index');
							i++;

							let template_row_rutin = $('#template-row-rutin').find('tbody').html();
							template_row_rutin = replaceAll(template_row_rutin, "[x]", "["+i+"]");
							elementTable.find('tbody').append(template_row_rutin);

							let lastElement = elementTable.find('tbody').find('tr').last();
							lastElement.attr('data-index', i);
							lastElement.find('.id_detail_job').val(row.id_detail_job);
							lastElement.find('.id_sub_barang').val(row.id_sub_barang);
							lastElement.find('#no_job').text(row.no_job);
							lastElement.find('#nama_barang').text(row.nama_barang);
							lastElement.find('#kode_barang').text(row.kode_barang);
							// console.log(row.qty_stock);
							lastElement.find('.qty_stock').text(row.qty_stock);
							lastElement.find('.kode_satuan').text(row.kode_satuan);
							lastElement.find('.qty_pp').val(row.qty_sisa);
							lastElement.find('.qty_pp').attr('max', row.qty_sisa);
							lastElement.find('.keterangan').val(row.keterangan);
						}

						$(".input-mask").inputmask({removeMaskOnSubmit: true})

						renderTableNumber(elementTable, 0);
						$(".input-mask").inputmask({removeMaskOnSubmit: true}).on('focus', function(){
							$(this).select();
						});
					}
				}
			} else {
				for (let j = 0; j < data.length; j++) {
					const row = data[j];
					if(checkExist(elementTable,'.id_sub_barang', row.id_sub_barang)){
						const lastData = elementTable.find('tbody').find('tr').last();
						let i = 0;
						if (lastData.length > 0) i = lastData.data('index');
						i++;

						let template_row_rutin = $('#template-row-non').find('tbody').html();
						template_row_rutin = replaceAll(template_row_rutin, "[x]", "["+i+"]");
						elementTable.find('tbody').append(template_row_non);

						let lastElement = elementTable.find('tbody').find('tr').last();
						lastElement.attr('data-index', i);
						lastElement.find('.id_sub_barang').val(row.id_sub_barang);
						lastElement.find('.text_nama_barang').text(row.nama_barang);
						lastElement.find('.text_kode_barang').text(row.kode_barang);
						lastElement.find('.text_nama_brand').text(row.nama_brand);
						lastElement.find('.text_dimensi').text(row.dimensi);
						lastElement.find('.text_size').text(row.size);
						lastElement.find('.text_colour').text(row.colour);
						lastElement.find('.text_kode_barang').text(row.kode_barang);
						lastElement.find('.qty_stock').text(row.qty_stock);
						lastElement.find('.kode_satuan').text(row.kode_satuan);
					}

					renderTableNumber(elementTable, 0);
					$(".input-mask").inputmask({removeMaskOnSubmit: true}).on('focus',function(){
						$(this).select();
					});
				}
			}
			break;
		case 'm_sub_barang':
			rutin = $('#jenis_pp_rutinitas').val();
			if(rutin === '2'){
				elementTable = $('#dt_pp_non_add');
				if(arrdata_job_pp.length>0 && !init) {
					init = true;
					elementTable.find('tbody').empty();
				}

				if(data.length > 0){
					for (let j = 0; j < data.length; j++) {
						const row = data[j];
						if(checkExist(elementTable,'.id_sub_barang', row.id_sub_barang)){
							const lastData = elementTable.find('tbody').find('tr').last();
							let i = 0;
							if (lastData.length > 0) i = lastData.data('index');
							i++;

							let template_row_rutin = $('#template-row-non').find('tbody').html();
							template_row_rutin = replaceAll(template_row_rutin, "[x]", "["+i+"]");
							elementTable.find('tbody').append(template_row_rutin);

							let lastElement = elementTable.find('tbody').find('tr').last();
							lastElement.attr('data-index', i);
							lastElement.find('.id_sub_barang').val(row.id_sub_barang);
							lastElement.find('.text_nama_barang').text(row.nama_barang);
							lastElement.find('.text_kode_barang').text(row.kode_barang);
							lastElement.find('.text_nama_brand').text(row.nama_brand);
							lastElement.find('.text_dimensi').text(row.dimensi);
							lastElement.find('.text_size').text(row.size);
							lastElement.find('.text_colour').text(row.colour);
							lastElement.find('.text_kode_barang').text(row.kode_barang);
							lastElement.find('.qty_stock').text(row.qty_stock);
							lastElement.find('.kode_satuan').text(row.kode_satuan);
						}

						renderTableNumber(elementTable, 0);
						$(".input-mask").inputmask({removeMaskOnSubmit: true}).on('focus',function(){
							$(this).select();
						});
					}
				}
			} else if(rutin === '4'){
				elementTable = $('#dt_pp_non_add');
				if(arrdata_job_pp.length>0 && !init) {
					init = true;
					elementTable.find('tbody').empty();
				}

				if(data.length > 0){
					for (let j = 0; j < data.length; j++) {
						const row = data[j];
						if(checkExist(elementTable,'.id_sub_barang', row.id_sub_barang)){
							const lastData = elementTable.find('tbody').find('tr').last();
							let i = 0;
							if (lastData.length > 0) i = lastData.data('index');
							i++;

							let template_row_rutin = $('#template-row-non').find('tbody').html();
							template_row_rutin = replaceAll(template_row_rutin, "[x]", "["+i+"]");
							elementTable.find('tbody').append(template_row_rutin);

							let lastElement = elementTable.find('tbody').find('tr').last();
							lastElement.attr('data-index', i);
							lastElement.find('.id_sub_barang').val(row.id_sub_barang);
							lastElement.find('.text_nama_barang').text(row.nama_barang);
							lastElement.find('.text_kode_barang').text(row.kode_barang);
							lastElement.find('.text_nama_brand').text(row.nama_brand);
							lastElement.find('.text_dimensi').text(row.dimensi);
							lastElement.find('.text_size').text(row.size);
							lastElement.find('.text_colour').text(row.colour);
							lastElement.find('.text_kode_barang').text(row.kode_barang);
						}

						renderTableNumber(elementTable, 0);
						$(".input-mask").inputmask({removeMaskOnSubmit: true}).on('focus',function(){
							$(this).select();
						});
					}
				}
			}
			break;
	}
}

$(document).ready(function(){
	initDatepicker($('.x-datepicker'));
	$('.select2').select2();

	$(".input-mask").inputmask();
	$(document).on('click', '.btn-delete', function () {
		let idsb = $(this).closest('tr').find('.id_detail_job').val();
		arrdata_job_pp = deleteAttach(arrdata_job_pp, idsb, 'id_detail_job');
		$(this).closest('tr').remove();
		renderTableNumber(elementTable, 0);
	});
});

$(function () {
	$('#jenis_pp_rutinitas').change(function (e) {
		//let v = e.target.value;
		//console.log(v);
		$('.jenis_pp_rutinitas_template').hide();
		$('.include-'+$(this).val()).show();
	})
})
