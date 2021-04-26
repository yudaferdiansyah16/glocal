let oTable = null;
function setValue(column, data) {
  let index = "-1";
  switch (column) {
    case "referensi_pengusaha":
      $(".id_supplier").val(data.ID);
      $(".nama_supplier").val(data.NAMA);
      $(".btn-search-customer").hide();
      $(".btn-clear-customer").show();
      oTable.ajax.reload(null, false);
      break;
    default:
      break;
  }
}
$(document).ready(function () {
  initDatepicker($(".x-datepicker"));
  $('.select2').select2();

  $(".btn-clear-customer").hide();
  $(".btn-clear-customer").on("click", function (e) {
    $(".id_supplier").val("");
    $(".nama_supplier").val("");
    $(".btn-search-customer").show();
    $(".btn-clear-customer").hide();
    oTable.ajax.reload(null, false);
  });

  $(".form-filter").on("change", function (e) {
    oTable.ajax.reload(null, false);
  });
});
