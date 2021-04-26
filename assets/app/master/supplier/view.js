$(document).ready(function() {
    let oTable = $("#dt").DataTable({
        autoWidth: true,
        language: {
            search: '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>',
        },
        responsive: false,
        //"scrollX": true,
        processing: true,
        serverSide: true,
        displayLength: 10,
        paginate: true,
        lengthChange: true,
        filter: true,
        sort: true,
        info: true,
        ajax: {
            url: _baseurl + "master/customer_suplier/viewDTCustomer",
            type: "POST",
        },
        columns: [
            { data: "no", searchable: false, className: "text-center" },
            { data: "kode_customer", className: "text-center" },
            { data: "nama" },
            { data: "alamat" },
            { data: "email" },
            { data: "telp" },
            { data: "option", searchable: false, className: "text-center" },
        ],
        sorting: [
            [1, "asc"]
        ],
        columnDefs: [{ sortable: false, targets: [0, 6] }],
    });

    $("#dt_filter input")
        .unbind()
        .bind("keyup", function(e) {
            if (e.keyCode == 13) {
                oTable.search(this.value).draw();
            }
        });

});