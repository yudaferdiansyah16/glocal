$(document).ready(function(){
	let oTable = $('#dt').DataTable({
		"autoWidth" : true,
		"responsive": false,
		"processing": true,
		"serverSide": true,
		"paginate": false,
		"lengthChange": false,
		"filter": false,
		"sort": true,
		"info": false,
		"ajax": {
			url: _baseurl+"finance/pembayaran_piutang/detaildtpiutang/"+idinvoice,
			type: "POST",
		},
		"columns": [
			{ data: "no", className: 'text-center' },
			{ data: "nama_barang" },
			{ data: "kode_satuan", className: 'text-center' },
			{ data: "qty_invoice", className: 'text-center' },
			{ data: "harga", className: 'text-right', "render": renderMoney },
			// { data: "subtotal", className: 'text-right', "render": renderMoney },
			{ data: "current", className: 'text-right', "render": renderMoney },
			{ data: "coa", width: "20%" },
			{ data: "bayar", width: "12%" },
			{ data: "option", className: 'text-center' }
		],
		"sorting" : [],
		"columnDefs": [
			{ 'sortable': false, 'targets': [0, 6, 7, 8] }
		],
		"drawCallback": function() {
			$('.select2').select2();
		},
		"footerCallback": function (row, data, start, end, display) {
            var api = this.api(), data;
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            total = api
                .column(4)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            pageTotal = api
                .column(4, { page: 'current'})
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            $(api.column(4).footer()).html(
                renderMoney(total)
            );
        }
	});

	$("#dt").on("click", "td input[type=checkbox]", function () {
		var isChecked = this.checked;
		var nameInput = $(this).closest('tr').find('.amount');
		if(isChecked==true){
			var dtapi = $("#dt").DataTable();
			var dtRow = dtapi.rows($(this).closest("tr"));
			// var dtHarga = dtRow.data()[0]['subtotal'];
			var dtHarga = dtRow.data()[0]['harga'];
			var dtCur = dtRow.data()[0]['current'];
			nameInput.val(addCommas(dtHarga-dtCur));
		}else{
			nameInput.val('0');
		}
	});
});

function addCommas(a)
{
    a += '';
    x = a.split('.');
    x1 = x[0];
    return x1 +'.00';
}