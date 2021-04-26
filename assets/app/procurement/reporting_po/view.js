$(document).ready(function(){
	let oTable = $('#dt').DataTable({
		"autoWidth" : true,
		"responsive": false,
		"processing": true,
		"serverSide": true,
		"displayLength": 50,
		"searching":false,
		"paginate": true,
		"lengthChange": false,
		"filter": true,
		"sort": true,
		"info": true,
		"ajax": {
			url: _baseurl+"procurement/reporting_po/viewdt",
			type: "POST",
		},
		"columns": [
			{ data: "no" },
			{ data: "kode_po", visible: false},
			{ data: "tanggal_dibuat","render":renderDTDate },
			{ data: "tanggal_dibutuhkan","render":renderDTDate },
			{ data: "nama_supplier" },
			{ data: "barang" },
			{ data: "qty_po",className:'text-right' },
			{ data: "harga",className:'text-right'},
			{ data: "valuta",className:'text-right'},
			{ data: "catatan_dibutuhkan" },
			{ data: "keterangan" },
			{ data: "status_approve" },
		],
		"sorting" : [[2, 'desc']],
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
			dataSrc: 'kode_po'
		}
	});

	$('#dt_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode == 13) {
			oTable.search(this.value).draw();
		}
	});
});
