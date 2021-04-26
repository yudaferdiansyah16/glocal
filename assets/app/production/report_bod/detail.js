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
      url: _baseurl+"production/report_bod/viewdtreportbod",
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
      { data: "KODE_BARANG"},
      { data: "fgbarang", className: 'text-center'},
      { data: "uraian_satuan_terkecil", className: 'text-center'},
      { data: "qty_invoice", className: 'text-center'},
      { data: "harga", className: 'text-center'},
      { data: "NOMOR_DOKUMEN", className: 'text-center'},
      { data: "TANGGAL_AJU", className: 'text-center'},
      { data: "nama_barang", className: 'text-center'},
      { data: "KODE_BARANG", className: 'text-center'},
      { data: "qty_invoice", className: 'text-center'},
      { data: "harga", className: 'text-center'},
      { data: "qty_invoice", className: 'text-center'},
      
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
