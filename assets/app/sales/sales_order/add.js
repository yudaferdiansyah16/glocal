let currentRow = '';
let elementTable = $('#dt');
let table_detail;
let init = false;

function format (option) {
    if (!option.id) { return option.text; }
    return '<div>'+option.NAMA+'<br><span style="font-size: 10px">'+option.ALAMAT+'</span></div>';
}

function initItemSelect2(lastElement) {
    lastElement.find('.id_kemasan').select2({
        minimumInputLength: 0,
        ajax: {
            dataType: "json",
            method: 'POST',
            url: _baseurl + "master/kemasan/select2",
            delay: 300,
            processResults: function(data) {
                return {
                    results: data.map(function(item) {
                        item.id = item.ID;
                        item.text = item.URAIAN_KEMASAN;
                        return item;
                    })
                };
            },
        },
        escapeMarkup: function(m) {
            return m;
        }
    });
}

function attachData(data, key){
    switch(key) {
        case 'm_sub_barang':
            if(arrdata_m_sub_barang.length>0 && !init) {
                init = true;
                elementTable.find('tbody').empty();
            }

            if(data.length > 0){
                let template = 'template-row';
                for (let j = 0; j < data.length; j++) {
                    const row = data[j];
                    //if(checkExist(elementTable,'.id_sub_barang', row.id_sub_barang)){
                    //}

                    const lastData = elementTable.find('tbody').find('tr').last();
                    let i = 0;
                    if (lastData.length > 0) i = lastData.data('index');
                    i++;

                    let template_row = $('#'+template).find('tbody').html();
                    template_row = replaceAll(template_row, "[x]", "["+i+"]");
                    elementTable.find('tbody').append(template_row);
                    let el = elementTable.find('tbody').find('tr').last();
                    initItemSelect2(el);
                    el.attr('data-index', i);
                    el.find('.id_sub_barang').val(row.id_sub_barang);
                    el.find('.nama_sub_barang').text(row.nama_barang);
                    el.find('.kode_barang').text(row.kode_barang);
                    let id_kemasan = row.id_kemasan == null ? '' : row.id_kemasan;
                    let kode_kemasan = row.kode_kemasan == null ? 'Select Packaging' : row.uraian_kemasan;
                    el.find('.id_kemasan').append("<option value='" + id_kemasan + "' selected>" + kode_kemasan + "</option>");
                    // el.find('.id_kemasan').val(row.id_kemasan);
                    // el.find('.nama_kemasan').val(row.kode_kemasan);
                    el.find('.id_satuan').val(row.id_sat);
                    // console.log(row.id_sat);
                    el.find('.nama_satuan').val(row.kode_satuan_terkecil);
                    // el.find('.id_satuan').empty();
                    // el.find('.id_satuan').append("<option value='" + row.id_satuan_terbesar + "' selected>" + row.kode_satuan_terbesar + "</option>");
                    // if (row.id_satuan_terbesar != row.id_satuan_terkecil && row.id_satuan_terkecil != null) lastElement.find('.id_satuan').append("<option value='" + row.id_satuan_terkecil + "'>" + row.kode_satuan_terkecil + "</option>");
                }

                renderTableNumber(elementTable, 0);
                $(".input-mask").inputmask({removeMaskOnSubmit: true}).on('focus',function(){
                    $(this).select();
                });

                $('#dt').off('change','.input-mask').on('change', '.input-mask', function () {
                    renderSummary();
                });
            }
            arrdata_m_sub_barang.length = 0;
            break;
    }
}

function setValue(column, data){
    let index = '-1';
	switch (column) {
		case 'm_sub_barang':
            index = currentRow.attr('data-index');
			currentRow.find('input[name="t_detail_po['+index+'][id_sub_barang]"]').val(data.id_sub_barang);
            currentRow.find('.nama_sub_barang').val(data.nama_barang);
            currentRow.find('input[name="t_detail_po['+index+'][id_satuan]"]').val(data.id_sat);
			currentRow.find('.nama_satuan').val(data.kode_satuan_terkecil);
			// currentRow.find('select[name="t_detail_po['+index+'][id_satuan]"]').empty();
			// currentRow.find('select[name="t_detail_po['+index+'][id_satuan]"]').append("<option value='" + data.id_satuan_terbesar + "' selected>" + data.kode_satuan_terbesar + "</option>");
			// if (data.id_satuan_terbesar != data.id_satuan_terkecil && data.id_satuan_terkecil != null) currentRow.find('select[name="t_detail_po['+index+'][id_satuan]"]').append("<option value='" + data.id_satuan_terkecil + "'>" + data.kode_satuan_terkecil + "</option>");
            break;
        case 'referensi_kemasan':
            //console.log(currentRow);
            index = currentRow.attr('data-index');
            // currentRow.find('.id_kemasan').val(data.ID);
            // currentRow.find('.nama_kemasan').val(data.KODE_KEMASAN);
            currentRow.find('select[name="t_detail_po['+index+'][id_kemasan]"]').append("<option value='" + data.id_kem + "' selected>" + data.uraian_kemasan + "</option>");
            if (data.id_kem != null) currentRow.find('select[name="t_detail_po['+index+'][id_kemasan]"]').append("<option value='" + data.id_kem + "'>" + data.uraian_kemasan + "</option>");
            // console.log(currentRow.find('select[name="t_detail_po['+index+'][id_satuan]"]').val());
            break;
        case 'referensi_pemasok':
            $('input[name="t_po[id_supplier]"]').val(data.ID);
            $('.name_supplier').val(data.NAMA);
            break;
        case 'referensi_valuta':
            $('input[name="t_po[id_valuta]"]').val(data.ID);
            $('.nama_valuta').val(data.KODE_VALUTA);
            $('input[name="t_po[rate]"]').val(data.rates_jual);
            break;
		default:
			break;
	}
}

function renderSummary() {
    let total_pack = 0; total_value = 0;
    $('#dt').find('tbody').find('tr').each(function(index) {
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

$(document).ready(function(){
    let customer = $('#customer');
    initDatepicker($('.x-datepicker'));

    $('.select2').select2();

    $(".input-mask").inputmask({removeMaskOnSubmit: true}).on('focus',function(){
        $(this).select();
    });

    $(document).on('click', '.btn-search-item', function () {
        currentRow = $(this).closest('tr');
    });

    $(document).on('click', '.btn-search-packaging', function () {
        currentRow = $(this).closest('tr');
    });

    //listenButtonDeleteRow(elementTable, 0, 'id_sub_barang');
    $(document).on('click', '.btn-delete-row', function (e) {
        let idsb = $(this).closest('tr').find('.id_sub_barang').val();
        arrdata_m_sub_barang = deleteAttach(arrdata_m_sub_barang, idsb, 'id_sub_barang');
        $(this).closest('tr').remove();
        renderTableNumber(elementTable, 0);
        renderSummary();
    });

    // customer.select2({
    //     placeholder: 'Find Customer',
    //     ajax:{
    //         url: _baseurl+'master/customer/select2',
    //         url: _baseurl+'master/customer_suplier/getselectcustomer',
    //         method: 'POST',
    //         dataType: 'json',
    //         delay: 1000,
    //         processResults: function (data) {
    //             return {
    //                 results: data
    //             };
    //         },
    //     },
    //     templateResult: format,
    //     language: {
    //         noResults: function(){
    //             return "Find Customer";
    //         }
    //     },
    //     escapeMarkup: function (m) {
    //         return m;
    //     }
    // }).on('select2:select', function(e){
    //     var d = e.params.data;
    //     $("#ano_hp").val(d.phone == null ? "" : d.phone);
    //     $("#ajabatan_struktural").val(d.jabatan == null ? "" : d.jabatan);
    // });

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

    initItemSelect2($("#dt"));

    keepSession();
});

/*
$(document).on('keypress', 'input, select', function (e) {
    if (e.which == 13) {
        e.preventDefault();
        // Get all focusable elements on the page
        var $canfocus = $(':focusable');
        var index = $canfocus.index(this) + 1;
        if (index >= $canfocus.length) index = 0;
        $canfocus.eq(index).focus();
        // console.log($canfocus.eq(index).focus());
    }
});
*/
