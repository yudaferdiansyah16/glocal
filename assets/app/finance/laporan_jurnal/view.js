function setValue(column, data) {
    let index = "-1";
    switch (column) {
        case "referensi_valuta":
            $('input[name="id_valuta"]').val(data.ID);
            $(".nama_valuta").val(data.KODE_VALUTA);
            break;
    }
}

$(document).ready(function () {
  initDatepicker($(".x-datepicker"));
  $('.select2').select2();

  $(".form-filter").on("change", function (e) {
    oTable.ajax.reload(null, false);
  });
});
