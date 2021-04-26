let oTable = null;
function setValue(column, data){
	let index = '-1';
	switch (column) {
		case 't_job':
			$('.id_job').val(data.id_job);
			$('.no_job').val(data.no_job);
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
		$('.id_job').val("");
		$('.no_job').val("");
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
		"searching": false,
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
			url: _baseurl+"production/packing/viewdt",
			type: "POST",
			data: function(data){
				if ($('.id_job').val() != '') data.id_job = $('.id_job').val();
				if ($('.start_date').val() != '') data.start_date = $('.start_date').val();
				if ($('.end_date').val() != '') data.end_date = $('.end_date').val();
				return data;
			}
		},
		"columns": [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "kode_mutasi" },
			{ data: "tanggal_mutasi", className: 'text-center', render: renderDTDate },
			{ data: "no_job"},
			{ data: "tanggal_job", className: 'text-center', render: renderDTDate },
			{ data: "kode_barang" },
			{ data: "nama_barang" },
			{ data: "qty_pack", className: 'text-right' },
			{ data: "kode_satuan" },
			{ data: "nama_gudang" },
			{ data: "koordinat" },
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

	$('#dt_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode == 13) {
			oTable.search(this.value).draw();
		}
	});
});
