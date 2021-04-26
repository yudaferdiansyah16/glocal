$(document).ready(function() {
    initDatepicker($('.x-datepicker'));
    $('#dt').DataTable();
    $(".year").datepicker({
        format: " yyyy", // Notice the Extra space at the beginning
        viewMode: "years",
        minViewMode: "years"
    });
});