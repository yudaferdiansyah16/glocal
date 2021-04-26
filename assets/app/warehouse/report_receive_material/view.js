let oTable = null;
function setValue(column, data){
	let index = '-1';
	switch (column) {
		case 'referensi_pengusaha':
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
			url: _baseurl+"warehouse/receive_material/viewdetaildt",
			type: "POST",
			data: function(data){
				if ($('.id_fasilitas').val() != '') data.id_fasilitas = $('.id_fasilitas').val();
				if ($('.id_supplier').val() != '') data.id_supplier = $('.id_supplier').val();
				if ($('.start_date').val() != '') data.start_date = $('.start_date').val();
				if ($('.end_date').val() != '') data.end_date = $('.end_date').val();
				return data;
			}
		},
		"columns": [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "kode_mutasi", className: 'text-center', visible: false },
			{ data: "tanggal_terima", className: 'text-center', render: renderDTDate },
			{ data: "nama_supplier" },
			{ data: "no_invoice", className: 'text-center' },
			{ data: "tgl_invoice", className: 'text-center', render: renderDTDate },
			{ data: "no_sj", className: 'text-center' },
			{ data: "tanggal_sj", className: 'text-center', render: renderDTDate },
			{ data: "kode_barang", className: 'text-center' },
			{ data: "nama_barang" },
			{ data: "qty", className: 'text-right', render: renderMoney },
			{ data: "kode_satuan_terkecil", className: 'text-center' },
			{ data: "nama_gudang", className: 'text-center' },
			{ data: "koordinat", className: 'text-center' },
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
		"columnDefs": [
			{ 'sortable': false, 'targets': [0,-1] }
		],
		rowGroup: {
			dataSrc: 'kode_mutasi'
		}
	});
});
