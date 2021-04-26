$(document).ready(function() {
    let oTable = $("#dt").DataTable({
        autoWidth: true,
        responsive: false,
        processing: true,
        serverSide: true,
        displayLength: 10,
        paginate: true,
        lengthChange: false,
        filter: true,
        sort: true,
        info: true,
        ajax: {
            url: _baseurl + "finance/setting_akun_sub_barang/viewdt",
            type: "POST",
        },
        columns: [
            { data: "no", searchable: false, className: "text-center" },
            { data: "kode_barang" },
            { data: "nama_barang" },
            { data: "nama_kategori" },
            { data: "nama_class" },
            {
                data: "nama_akun",
                render: function(data, type, row, meta) {
                    return row["kode_akun"] == null ?
                        " " :
                        "[" + row["kode_akun"] + "] " + row["nama_akun"];
                },
            },
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