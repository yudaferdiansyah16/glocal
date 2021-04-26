function setValue(column, data) {
  let index = "-1";
  switch (column) {
    case 'm_suplier':
      $('input[name="m_suplier[id_suplier]"]').val(data.id_suplier);
      $('.nama').val(data.nama);
      break;
    default:
      break;
  }
}
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
