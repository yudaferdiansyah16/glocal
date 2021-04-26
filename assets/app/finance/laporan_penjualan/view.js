let oTable = null;
$(document).ready(function () {
  initDatepicker($(".x-datepicker"));
  $('.select2').select2();

  let oTable = $('#dt').DataTable({
    "autoWidth": true,
    "responsive": false,
    "processing": true,
    "serverSide": false,
    "paginate": false,
    "lengthChange": false,
    "filter": false,
    "sort": false,
    "info": true
  });

  $(".form-filter").on("change", function (e) {
    oTable.ajax.reload(null, false);
  });
});
