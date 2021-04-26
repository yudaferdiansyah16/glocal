$(document).ready(function() {
    let oTable = $("#dt").DataTable({
        autoWidth: true,
        responsive: false,
        processing: true,
        serverSide: true,
        displayLength: 10,
        paginate: false,
        lengthChange: false,
        filter: true,
        sort: true,
        info: true,
    });

    $("#dt_filter input")
        .unbind()
        .bind("keyup", function(e) {
            if (e.keyCode == 13) {
                oTable.search(this.value).draw();
            }
        });
    initDatepicker($('.x-datepicker'));
    $(".jumlah_rp").inputmask({ removeMaskOnSubmit: true });
});