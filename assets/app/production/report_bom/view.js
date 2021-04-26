function setValue(column, data) {
  let index = "-1";
  switch (column) {
    case "referensi_pemasok":
      $(".id_supplier").val(data.ID);
      $(".nama_supplier").val(data.NAMA);
      // $(".btn-search-customer").hide();
      // $(".btn-clear-customer").show();
      oTable.ajax.reload(null, false);
      break;
    default:
      break;
  }
}



$(document).ready(function () {
  initDatepicker($(".x-datepicker"));
  $('.select2').select2();

  oTable = $('#dt').DataTable({
    "autoWidth" : true,
		"responsive": false,
		//"scrollX": true,
		"processing": true,
		"serverSide": true,
		"displayLength": 10,
		"paginate": true,
		"lengthChange": false,
		"filter": true,
		"sort": true,
		"info": true,
    "ajax": {
      url: _baseurl+"production/report_bom/viewdtbom",
      type: "POST",
      data: function(data) {
        if ($('.tglawal').val() != '') data.tglawal = $('.tglawal').val();
        if ($('.tglakhir').val() != '') data.tglakhir = $('.tglakhir').val();
        if ($('.id_supplier').val() != '') data.id_supplier = $('.id_supplier').val();
       
        return data;
    
    }
    },
    "columns": [
      { data: "no", searchable: false, className: 'text-center'},
      { data: "kode_po"},
      { data: "tanggal_dibuat", className: 'text-center'},
      { data: "po_buyer", className: 'text-center'},
      { data: "nama", className: 'text-center'},
      { data: "qty_po", className: 'text-center'},
      { data: "option", className: 'text-center'},
      // {  render: function ( data, type, row, meta ) {
			// 	return "<a>No So: " +row.kode_po + "</a><br><a>Tanggal So : " +row.tanggal_dibutuhkan + "</a><br><a>Tanggal So : " +row.tanggal_dibutuhkan + "</a><br><a>PO Customer : " +row.nama_barang + "</a><br><a>Customer: " +row.nama + "</a><br><a>Destination : " +row.alamat + "</a><br>";
			// } },
      
       
    ],
   
  });		

  // $(".btn-clear-customer").hide();
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
