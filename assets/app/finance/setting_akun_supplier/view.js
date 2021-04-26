$(document).ready(function() {
    let oTable = $("#dt").DataTable({
        autoWidth: true,
        responsive: false,
        //"scrollX": true,
        processing: true,
        serverSide: true,
        displayLength: 10,
        paginate: true,
        lengthChange: false,
        filter: true,
        sort: true,
        info: true,
        ajax: {
            url: _baseurl + "finance/setting_akun_supplier/viewdt",
            type: "POST",
        },
        columns: [
            { data: "no", searchable: false, className: "text-center" },
            { data: "kode_customer", className: "text-center" },
            { data: "nama" },
            {
                data: "nama_akun",
                render: function(data, type, row, meta) {
                    return (row['kode_akun'] == null) ? '-' : '[' + row['kode_akun'] + '] ' + row['nama_akun'];
                }
            },
            // {
            //     data: "nama_akun_um",
            //     render: function(data, type, row, meta) {
            //         return (row['kode_akun_um'] == null) ? '-' : '[' + row['kode_akun_um'] + '] ' + row['nama_akun_um'];
            //     }
            // },
            { data: "option", searchable: false, className: "text-center" },
        ],
        sorting: [
            [1, "asc"]
        ],
        columnDefs: [{ sortable: false, targets: [0, -1] }],
    });

    $("#dt_filter input")
        .unbind()
        .bind("keyup", function(e) {
            if (e.keyCode == 13) {
                oTable.search(this.value).draw();
            }
        });

});