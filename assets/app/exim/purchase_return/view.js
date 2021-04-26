let oTable;

function reloadDT(c) {
    let close = c + "close";
    let cal = c + "cal";
    $('.' + cal).hide();
    $('.' + close).show();
    oTable.ajax.reload(null, false);
}

function removeFilter(c) {
    let close = c + "close";
    let cal = c + "cal";
    $('.' + cal).show();
    $('.' + close).hide();
    $('.' + c).val('');
    oTable.ajax.reload(null, false);
}

$(document).ready(function() {
    initDatepicker($('.x-datepicker'));
    $('.select2').select2();


    oTable = $('#dt').DataTable({
        "autoWidth": true,
        "responsive": false,
        //"scrollX": true,
        "processing": true,
        "serverSide": true,
        "displayLength": 10,
        "paginate": true,
        "lengthChange": false,
        "filter": true,
        "sort": true,
        "info": true,
        "ajax": {
            url: _baseurl + "exim/purchase_return/viewdt",
            type: "POST",
            data: function(data) {
                if ($('.tglawal').val() != '') data.tglawal = $('.tglawal').val();
                if ($('.tglakhir').val() != '') data.tglakhir = $('.tglakhir').val();
                return data;
            }
        },
        "columns": [
            { data: "no", searchable: false, className: 'text-center' },
            {
                data: "kode_return",
                render: function(data, type, row) {
                    return "<p style='margin:0;padding:0;'> Nomor : " + row.kode_return + "</p><small style='margin:0;padding:0;'> Tanggal :" + row.tanggal_return + "</small>";
                }
            },
            { data: "tanggal_return", visible: false, className: 'text-center' },
            {
                data: "kode_dn",
                render: function(data, type, row) {
                    return "<p style='margin:0;padding:0;'> Nomor : " + row.kode_dn + "</p><small style='margin:0;padding:0;'> Tanggal : " + row.tgl_kedatangan + "</small>";
                }
            },
            { data: "tgl_kedatangan", visible: false, className: 'text-center' },
            { data: "nama_supplier", className: 'text-left' },
            { data: "keterangan", className: 'text-left' },
            { data: "detailitem", searchable: false, className: 'text-left' },
            { data: "detailqty", searchable: false, className: 'text-right' },
            { data: "status_approve", searchable: false, className: 'text-center' },
            { data: "option", searchable: false, className: 'text-center' },
        ],
        "sorting": [
            [2, 'desc'],
            [1, 'desc']
        ],
        "columnDefs": [
            { 'sortable': false, 'targets': [0, -1] }
        ]
    });

    $('#dt_filter input').unbind().bind('keyup', function(e) {
        if (e.keyCode == 13) {
            oTable.search(this.value).draw();
        }
    });
});