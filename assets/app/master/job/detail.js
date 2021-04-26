// let elementTable = $('#dt');
let deleted_detail_job = [];
function attachData(data, key){
	switch(key) {
		case 't_bom_detail_job':
			let elementTable = $('#dt');
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
				// lastElement.find('.id_detail_job').val(row.id_bom_detail);
				lastElement.find('.id_bom_detail').val(row.id_bom_detail);
				// lastElement.find('.id_satuan').val(row.id_satuan);
				lastElement.find('td').eq(1).text(row.nama_workflow);
				lastElement.find('td').eq(2).text(row.nama_part);
				lastElement.find('.nama_sub_barang').text(row.nama_sub_barang);
				lastElement.find('.kode_barang').text(row.kode_barang);
				if(row.kode_satuan == null) row.kode_satuan = '';
				else row.kode_satuan = ' '+row.kode_satuan;
				lastElement.find('td').eq(3).text(row.qty_sisa_bom+row.kode_satuan);
				lastElement.find('.input-qty-bom').val(row.qty_sisa_bom);
			}
			renderTableNumber(elementTable, 0);
			$(".input-mask").inputmask({removeMaskOnSubmit: true});
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
	$('.btn-add').on('click', function (e) {
		oTable_t_bom_detail_job.draw( false );
	})
	$(document).on('click', '.btn-delete', function () {
		let tr = $(this).closest('tr');
		let id_detail_job = tr.find('.id_detail_job').val();
		if (id_detail_job != '') {
			deleted_detail_job.push(id_detail_job);
			$('#deleted_detail_job').val(JSON.stringify(deleted_detail_job));
		}
		tr.remove();
		renderTableNumber(elementTable, 0);
	});

	$(".input-mask").inputmask({removeMaskOnSubmit: true});
});
