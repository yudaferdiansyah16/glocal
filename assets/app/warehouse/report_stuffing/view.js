let oTable = null;
function setValue(column, data){
	let index = '-1';
	switch (column) {
		case 'referensi_pemasok':
			$('.id_supplier').val(data.ID);
			$('.nama_supplier').val(data.NAMA);
			$('.btn-search-customer').hide();
			$('.btn-clear-customer').show();
			oTable.ajax.reload( null, false );
			break;
		default:
			break;
	}
}
$(document).ready(function(){
	initDatepicker($('.x-datepicker'));

	$('.btn-clear-customer').hide();
	$('.btn-clear-customer').on('click', function (e) {
		$('.id_supplier').val("");
		$('.nama_supplier').val("");
		$('.btn-search-customer').show();
		$('.btn-clear-customer').hide();
		oTable.ajax.reload( null, false );
	});

	$('.form-filter').on('change', function (e) {
		oTable.ajax.reload( null, false );
	});

	oTable = $('#dt').DataTable({
		"autoWidth" : true,
		"responsive": false,
		//"scrollX": true,
		"searching": false,
		"processing": true,
		"serverSide": true,
		"displayLength": 50,
		"paginate": true,
		"lengthChange": false,
		"filter": true,
		"sort": true,
		"info": true,
		"ajax": {
			url: _baseurl+"warehouse/stuffing/viewdetaildt",
			type: "POST",
			data: function(data){
				if ($('.id_tipe_sales').val() != '') data.id_tipe_sales = $('.id_tipe_sales').val();
				if ($('.id_supplier').val() != '') data.id_supplier = $('.id_supplier').val();
				if ($('.start_date').val() != '') data.start_date = $('.start_date').val();
				if ($('.end_date').val() != '') data.end_date = $('.end_date').val();
				return data;
			}
		},
		"columns": [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "kode_stuffing", className: 'text-center' },
			{ data: "tanggal_stuffing", className: 'text-center', "render": renderDTDate },
			{ data: "nama_supplier" },
			{ data: "kode_po", className: 'text-center' },
			{ data: "tanggal_dibuat", className: 'text-center', "render": renderDTDate },
			{ data: "po_buyer", className: 'text-center' },
			{ data: "no_job" },
			{ data: "tanggal_job", className: 'text-center', "render": renderDTDate },
			{ data: "kode_mutasi", className: 'text-center' },
			{ data: "tanggal_terima", className: 'text-center', "render": renderDTDate },
			{ data: "container_number", className: 'text-center' },
			{ data: "seal_number", className: 'text-center' },
			{ data: "kode_barang", className: 'text-center' },
			{ data: "nama_barang" },
			{ data: "qty_si_real", className: 'text-right', render: function ( data, type, row, meta ) {
					return formatCurrency(data, 2) + " " + row.kode_satuan;
			} },
			{ data: "qty_mc_real", className: 'text-right', render: function ( data, type, row, meta ) {
				return formatCurrency(data, 0) + " " + row.kode_kemasan;
			} },
			{ data: "netto", className: 'text-right', render: function ( data, type, row, meta ) {
					return formatCurrency(data, 2) + " KGM";
			} },
			{ data: "bruto", className: 'text-right', render: function ( data, type, row, meta ) {
					return formatCurrency(data, 2) + " KGM";
			} },
		],
		"sorting" : [[1, 'asc']],
		dom:
		/*	--- Layout Structure
			--- Options
			l	-	length changing input control
			f	-	filtering input
			t	-	The table!
			i	-	Table information summary
			p	-	pagination control
			r	-	processing display element
			B	-	buttons
			R	-	ColReorder
			S	-	Select

			--- Markup
			< and >				- div element
			<"class" and >		- div with a class
			<"#id" and >		- div with an ID
			<"#id.class" and >	- div with an ID and a class

			--- Further reading
			https://datatables.net/reference/option/dom
			--------------------------------------
		 */
			"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
		buttons: [
			/*{
				extend:    'colvis',
				text:      'Column Visibility',
				titleAttr: 'Col visibility',
				className: 'mr-sm-3'
			},*/
			{
				extend: 'pdfHtml5',
				text: 'PDF',
				titleAttr: 'Generate PDF',
				className: 'btn-outline-danger btn-sm mr-1'
			},
			{
				extend: 'excelHtml5',
				text: 'Excel',
				titleAttr: 'Generate Excel',
				className: 'btn-outline-success btn-sm mr-1'
			},
			{
				extend: 'csvHtml5',
				text: 'CSV',
				titleAttr: 'Generate CSV',
				className: 'btn-outline-primary btn-sm mr-1'
			},
			{
				extend: 'copyHtml5',
				text: 'Copy',
				titleAttr: 'Copy to clipboard',
				className: 'btn-outline-primary btn-sm mr-1'
			},
			{
				extend: 'print',
				text: 'Print',
				titleAttr: 'Print Table',
				className: 'btn-outline-primary btn-sm'
			}
		],
		rowGroup: {
			dataSrc: 'kode_stuffing'
		}
	});
});
