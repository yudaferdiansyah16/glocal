let currentRow = '';
let elementTable = $('#dt');
let deleted_detail_po = [];

function attachData(data, key){
	switch(key) {
		case 'm_sub_barang':
			let i = 0;
			for (let j = 0; j < data.length; j++) {
				const row = data[j];
				let i = 0;
				const lastData = elementTable.find('tbody').find('tr').last();
				if (lastData.length > 0) i = lastData.data('index');
				i++;

				let template_row = $('#template-row').find('tbody').html();
				template_row = replaceAll(template_row, "[x]", "["+i+"]");
				elementTable.find('tbody').append(template_row);
				let lastElement = elementTable.find('tbody').find('tr').last();

				lastElement.find('.id_sub_barang').val(row.id_sub_barang);
				lastElement.find('.nama_sub_barang').text(row.nama_barang);
				lastElement.find('.kode_barang').text(row.kode_barang);
				lastElement.find('.id_satuan').val(row.id_satuan);
				lastElement.find('.nama_satuan').val(row.id_satuan);
				lastElement.find('.id_kemasan').val(row.id_kemasan);
				lastElement.find('.nama_kemasan').val(row.kode_kemasan);
				lastElement.find('.id_satuan').empty();
				lastElement.find('.id_satuan').append("<option value='" + row.id_satuan_terbesar + "' selected>" + row.kode_satuan_terbesar + "</option>");
				if (row.id_satuan_terbesar != row.id_satuan_terkecil && row.id_satuan_terkecil != null) lastElement.find('.id_satuan').append("<option value='" + row.id_satuan_terkecil + "'>" + row.kode_satuan_terkecil + "</option>");
			}
			renderTableNumber(elementTable, 0);
			$(".input-mask").inputmask({removeMaskOnSubmit: true});
			//renderSummary();

			$('#dt').off('change','.input-mask').on('change', '.input-mask', function () {
				renderSummary();
			});
			break;
	}
}

function setValue(column, data){
    let index = '-1';
	switch (column) {
		case 'm_sub_barang':
			currentRow.find('.id_sub_barang').val(data.id_sub_barang);
			currentRow.find('.nama_sub_barang').val(data.nama_barang);
			currentRow.find('.id_satuan').empty();
			currentRow.find('.id_satuan"]').append("<option value='" + data.id_satuan_terbesar + "' selected>" + data.kode_satuan_besar + "</option>");
			if (data.id_satuan_terbesar != data.id_satuan_terkecil && data.id_satuan_terkecil != null) currentRow.find('.id_satuan').append("<option value='" + data.id_satuan_terkecil + "'>" + data.kode_satuan_kecil + "</option>");
            break;
        case 'referensi_kemasan':
            index = currentRow.attr('data-index');
            currentRow.find('.id_kemasan').val(data.ID);
            currentRow.find('.nama_kemasan').val(data.KODE_KEMASAN);
            break;
        case 'referensi_pemasok':
            $('input[name="t_po[id_supplier]"]').val(data.ID);
            $('.name_supplier').val(data.NAMA);
            break;
        case 'referensi_valuta':
            $('input[name="t_po[id_valuta]"]').val(data.ID);
            $('.nama_valuta').val(data.KODE_VALUTA);
            break;
		default:
			break;
	}
}

function renderSummary() {
    let total_pack = 0; total_value = 0;
    elementTable.find('tbody').find('tr').each(function(index) {
        const input_pack = $(this).find('.input-pack');
        total_pack = total_pack + parseFloat(input_pack.inputmask('unmaskedvalue') || 0);
        const input_qty_po = $(this).find('.input-qty-po');
        const input_price = $(this).find('.input-price');
        const subtotal = parseFloat(input_qty_po.inputmask('unmaskedvalue') || 0) * parseFloat(input_price.inputmask('unmaskedvalue') || 0);
        $(this).find('.input-subtotal').inputmask("setvalue", subtotal);
        total_value = total_value + subtotal;
    });
    $('.input-pack-total').inputmask("setvalue", total_pack);
    $('.input-total').inputmask("setvalue", total_value);
}

function replaceAll(str, find, replace) {
    while (str.includes(find)) {
        str = str.replace(find, replace);
    }
    return str;
}

function format (option) {
    if (!option.id) { return option.text; }
    return '<div>'+option.NAMA+'<br><span style="font-size: 10px">'+option.ALAMAT+'</span></div>';
}

$(document).ready(function(){
    initDatepicker($('.x-datepicker'));
    $('.select2').select2();

    $(".input-mask").inputmask({removeMaskOnSubmit: true});

    $(document).on('click', '.btn-search-item', function () {
        currentRow = $(this).closest('tr');
    });

    $(document).on('click', '.btn-search-packaging', function () {
        currentRow = $(this).closest('tr');
    });

    $(document).on('click', '.btn-delete-row', function (e) {
        let tr = $(this).closest('tr');
        const id_detail_po = tr.find('.id_detail_po')[0].value;
        deleted_detail_po.push(id_detail_po);
        $('#deleted_detail_po').val(JSON.stringify(deleted_detail_po));
        tr.remove();
        renderTableNumber(table_detail, 0);
        renderSummary();
    })

    $(document).on('change', '.input-mask', function () {
        renderSummary();
    });

    $(".customerselect").select2({
        placeholder: 'Find Customer',
        ajax:{
            url: _baseurl+'master/customer_suplier/getselectcustomer',
            dataType: 'json',
            delay: 1000,
            processResults: function (data) {
                return {
                    results: data
                };
            },
        },
        templateResult: format,
        language: {
            noResults: function(){
                return "Find Customer";
            }
        },
        escapeMarkup: function (m) {
            return m;
        }
    }).on('select2:select', function(e){
        var d = e.params.data;
    });

    renderTableNumber(elementTable, 0);
    renderSummary();
});
