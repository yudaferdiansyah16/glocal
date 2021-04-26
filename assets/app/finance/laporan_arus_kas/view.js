$(document).ready(function () {
  initDatepicker($(".x-datepicker"));
  $('.select2').select2();

  $(".form-filter").on("change", function (e) {
    oTable.ajax.reload(null, false);
  });
});
