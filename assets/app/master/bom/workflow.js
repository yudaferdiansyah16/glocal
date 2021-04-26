let currentRow = null;
let elementTable = $('#dt');
let id_bom_workflow = null;
let currentTable = null;
let deleted_bom_detail = [];

function attachData(data, key){
	switch(key) {
		case 'm_sub_barang':
			for (let j = 0; j < data.length; j++) {
				const row = data[j];
				if (checkExist(currentTable,'.id_sub_barang', row.id_sub_barang)) {
					let last_index =  parseInt($('input[name=data_count]').val());
					last_index++;

					let template_row = $('#template-row').find('tbody').html();
					template_row = replaceAll(template_row, 'id="row-detail-x"', 'id="row-detail-' + last_index + '"');
					template_row = replaceAll(template_row, '[x]', '['+ last_index +']');

					currentTable.find('tbody').append(template_row);
					$('input[name=data_count]').val(last_index);

					currentRow = currentTable.find('tr').last();
					currentRow.find('.id_bom_workflow').val(id_bom_workflow);
					currentRow.find('.id_sub_barang').val(row.id_sub_barang);
					currentRow.find('.nama_sub_barang').text(row.nama_barang);
					currentRow.find('.kode_barang').text(row.kode_barang);
					currentRow.find('.id_satuan').empty();
					satuan_terkecil = false;
					if (row.id_satuan_terbesar != data.id_satuan_terkecil && row.id_satuan_terkecil != null) satuan_terkecil = true;

					isterkecil = "1";
					if(satuan_terkecil) isterkecil = "0";

					currentRow.find('.id_satuan').append("<option data-terkecil='"+isterkecil+"' value='" + row.id_satuan_terbesar + "' selected>" + row.kode_satuan_terbesar + "</option>");
					if(satuan_terkecil) currentRow.find('.id_satuan').append("<option data-terkecil='1' value='" + row.id_satuan_terkecil + "'>" + row.kode_satuan_terkecil + "</option>");

					currentRow.find('.isterkecil').val(isterkecil);
				}
			}
			$(".input-mask").inputmask({removeMaskOnSubmit: true});
			renderTableNumber(currentTable, 0);
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
	$(document).on('click', '.btn-add', function () {
		arrdata = [];
		id_bom_workflow = $(this).data('id');
		currentTable = $(this).closest("table");
	});

	$(document).on('change', '.id_satuan', function () {
		const terkecil = $(this).data('terkecil');
		$($this).closest('td').find('.isterkecil', terkecil);
	});

	$(document).on('click', '.btn-delete', function () {
		let tr = $(this).closest('tr');
		let id_bom_detail = tr.find('.id_bom_detail').val();
		if (id_bom_detail != '') {
			deleted_bom_detail.push(id_bom_detail);
			$('#deleted_bom_detail').val(JSON.stringify(deleted_bom_detail));
		}
		tr.remove();
	});

	$(document).on('click', '.btn-search-item', function () {
        currentRow = $(this).closest('tr');
	});
	$(".input-mask").inputmask({removeMaskOnSubmit: true});
});
