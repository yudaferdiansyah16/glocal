// $(document).ready(function() {
//     let oTable = $('#dt').DataTable({
//         "autoWidth": true,
//         "responsive": false,
//         //"scrollX": true,
//         "processing": true,
//         "serverSide": true,
//         "paginate": false,
//         "lengthChange": false,
//         "filter": true,
//         "sort": false,
//         "info": true,
//         "searching": false,
//         ajax: {
//             url: _baseurl + "finance/assetting/viewdt",
//             type: "POST",

//         },
//         columns: [
//             { "data": "no", searchable: false, orderable: false, className: 'text-center' },
//             { "data": "kode_barang" },
//             { "data": "nama_barang" },
//             { "data": "kode_suplier" },
//             { "data": "KODE_VALUTA" },
//             { "data": "kode_dn" },
//             { "data": "tgl_kedatangan" },
//             { "data": "harga" },
//         ],
//         "sorting": [
//             [1, 'asc']
//         ],
//         "columnDefs": [
//             { 'sortable': false, 'targets': [0, -1] }
//         ]
//     });

//     $('#dt_filter input').unbind().bind('keyup', function(e) {
//         if (e.keyCode == 13) {
//             oTable.search(this.value).draw();
//         }
//     });

// });
// $(document).ready(function() {
//     initDatepicker($('.x-datepicker'));
// });


$(document).ready(function(){
	let oTable = $('#dt').DataTable({
		"autoWidth" : true,
		"responsive": false,
		"processing": true,
		"serverSide": true,
		"displayLength": 10,
		"paginate": true,
		"lengthChange": false,
		"filter": true,
		"sort": true,
		"info": true,
		"ajax": {
			url: _baseurl+"finance/assetting/viewdt",
			type: "POST",
		},
		"columns": [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "kode_aset1" },
			{ "data": "kode_aset2" },
			{ "data": "nama_barang" },
            { 
                "data": "harga", 
                "render": function(data, type, row, meta){
                    return data == null ? '0' : data;
                },
                "className": 'text-right'
            },
			{ "data": "tgl_depresiasi" },
			{ "data": "nama_tipe_depresiasi" }
		],
		"sorting" : [[3, 'desc']],
		"columnDefs": [
			{ 'sortable': false, 'targets': [0] }
		]
	});

	$('#dt_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode == 13) {
			oTable.search(this.value).draw();
		}
	});
});