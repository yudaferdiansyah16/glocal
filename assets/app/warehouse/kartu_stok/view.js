function setValue(column, data){
  switch (column) {
    case 'm_sub_barang_single':
      $('.id_sub_barang').val(data.id_sub_barang);
      $('.barang').val(data.nama_barang);
      $('.nama_barang').val(data.nama_barang);
      if($('.id_sub_barang').val(data.id_sub_barang) != ''){
        $('.klasifikasi').prop('required', true);
      }
      break;
    default:
      break;
  }
}

function format (option) {
  if (!option.id) { return option.text; }
  return '<div>'+option.kode+'<br><span style="font-size: 10px">'+option.nama+'</span></div>';
}

$(document).ready(function () {
  initDatepicker($(".x-datepicker"));
  $('.select2').select2();
  $('#dt').DataTable({
    "autoWidth": true,
    "responsive": true,
    "processing": true,
    "serverSide": false,
    "paginate": false,
    "lengthChange": false,
    "filter": false,
    "sort": false,
    "info": true
  });
  // $(".id_sub_barang").select2({
  //   placeholder: 'Find Item',
  //   ajax:{
  //     url: _baseurl+'master/sub_barang/getSelect',
  //     dataType: 'json',
  //     delay: 1000,
  //     processResults: function (data) {
  //       return {
  //         results: data
  //       };
  //     },
  //   },
  //   templateResult: format,
  //   language: {
  //     noResults: function(){
  //       return "Find Item";
  //     }
  //   },
  //   escapeMarkup: function (m) {
  //     return m;
  //   }
  // }).on('select2:select', function(e){
  //   var d = e.params.data;
  // });
});
