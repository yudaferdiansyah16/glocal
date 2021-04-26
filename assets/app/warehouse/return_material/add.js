function attachData(data, key) {
    switch (key) {
        case 't_wh_detail_stock':
            var t = $('#dt_request_add').DataTable();
            t.clear().draw();


//            let elementTable = $('#dt_request_add');
//            elementTable.find('tbody').empty();
            for (let j = 0; j < data.length; j++) {
                const row = data[j];
                console.log(row);

                var initElment = '<input type="hidden" name="t_wh[id_jenis_mutasi]" value="12"/>' +
                        '<input type="hidden" class="id_job" value="' + row.id_job + '" name="t_wh_detail[' + j + '][id_job]"/>' +
                        '<input type="hidden" class="id_production" value="' + row.id_production + '" name="t_wh_detail[' + j + '][id_production]"/>' +
                        '<input type="hidden" class="id_detail_dn" value="' + row.id_detail_dn + '" name="t_wh_detail[' + j + '][id_detail_dn]"/>' +
                        '<input type="hidden" class="harga_satuan" value="' + row.harga_satuan + '" name="t_wh_detail[' + j + '][harga_satuan]"/>' +
                        '<input type="hidden" class="rate" value="' + row.rate + '" name="t_wh_detail[' + j + '][rate]"/>' +
                        '<input type="hidden" class="id_sub_barang" value="' + row.id_sub_barang + '" name="t_wh_detail[' + j + '][id_sub_barang]"/>' +
                        '<input type="hidden" class="id_satuan_terkecil" value="' + row.id_satuan + '" name="t_wh_detail[' + j + '][id_satuan_terkecil]"/>' +
                        '<input type="hidden" class="id_satuan_terbesar" value="' + row.id_satuan + '" name="t_wh_detail[' + j + '][id_satuan_terbesar]"/>' +
                        '<input type="hidden" class="id_koordinat" value="' + row.id_koordinat + '" name="t_wh_detail_opt[' + j + '][id_koordinat_asal]"/>';
                var node = t.row.add([
                    initElment + (j + 1),
                    row.no_job,
                    row.nama_barang,
                    '<span class="nama_gudang">' + row.nama_gudang + '</span><br>' +
                            '<small class="nama_koordinat">' + row.nama_koordinat + '</small>',
                    '<span class="qty_stock">' + row.qty_stock + '</span><br>' +
                            '<small class="kode_satuan">' + row.kode_satuan + '</small>',
                    '<input type="text" class="form-control form-control-sm input-mask qty" name="t_wh_detail_opt[' + j + '][qty]" value="0" />',
                    '<select class="select2" name="t_wh_detail_opt[' + j + '][id_koordinat_tujuan]">' + $("#main_location").html() + '</select>',
                    '<button class="btn btn-xs btn-danger btn-delete-row"><i class="fa fal fa-trash"></i></button>',
                ]).draw().node();
                $(node).find('.input-mask')
                        .attr("data-inputmask", "'alias': 'currency', 'prefix': '', 'max': '" + parseFloat(row.qty_stock) + "', 'min':'0'")
                        .inputmask({removeMaskOnSubmit: true}).on('focus', function () {
                    $(this).select();
                });
                $(node).find('.select2').select2();
            }

            $('#dt_request_add tbody').on('click', '.btn-delete-row', function () {
                t
                        .row($(this).parents('tr'))
                        .remove()
                        .draw();
            });
            
            break;
    }
}

function replaceAll(str, find, replace) {
    while (str.includes(find)) {
        str = str.replace(find, replace);
    }
    return str;
}



function setValue(column, data) {
    switch (column) {
        case 't_job':
            //console.log(data);
            $('.no_job').val(data.no_job);
            $('.id_job').val(data.id_job);
            $('#dt_t_wh_detail_request').DataTable().search(data.no_job).draw();
            break;
        default:
            break;
    }
}

function getLokasi() {
    var id_gudang = 1;
    $.ajax({
        type: 'POST',
        url: _baseurl + "warehouse/return_material/getgudang/" + id_gudang, //Get Gudang RM
        dataType: 'JSON',
        success: function (response, textStatus, jqXHR) {
            var option = "";
            $.each(response, function (key, value) {
                option += "<option value=" + value.id_koordinat + ">" + value.nama_koordinat + "</option>";
            });
            $('#main_location').html(option);
        },
        complete: function (jqXHR, textStatus) {
        }
    });
}

$(document).ready(function () {
    getLokasi();
    initDatepicker($('.x-datepicker'));
    $('button[type = "submit"]').on('click', function () {
        $(this).prop('disabled', true);
    });

    $("li.active").removeClass('active');
    $('#menu_warehouse').addClass('active');
    $('#menu_warehouse_return_material').addClass('active');
});
