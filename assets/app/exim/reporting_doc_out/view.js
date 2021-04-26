let oTable = '';

function reloadDT(c) {
    let close = c + "close";
    let cal = c + "cal";
    $('.' + cal).hide();
    $('.' + close).show();
    oTable.ajax.reload(null, false);
}

function removeFilter(c) {
    let close = c + "close";
    let cal = c + "cal";
    $('.' + cal).show();
    $('.' + close).hide();
    $('.' + c).val('');
    oTable.ajax.reload(null, false);
}

$(document).ready(function() {
    $('#dokumenbc').val(["25", "261", "41", "27", "30"]);
    initDatepicker($('.x-datepicker'));
    $('.select2').select2();
    $('#dokumenbc').on('change', function(e) {
        oTable.ajax.reload(null, false);
    });

    oTable = $('#dt').DataTable({
        "autoWidth": true,
        "responsive": false,
        //"scrollX": true,
        "processing": true,
        "serverSide": true,
        "paginate": false,
        "lengthChange": false,
        "filter": true,
        "sort": true,
        "info": true,
        "ajax": {
            url: _baseurl + "exim/reporting_doc_out/viewdt",
            type: "POST",
            data: function(data) {
                if ($('.tglajuawal').val() != '') data.tglajuawal = $('.tglajuawal').val();
                if ($('.tglajuakhir').val() != '') data.tglajuakhir = $('.tglajuakhir').val();
                if ($('.tglstuffingawal').val() != '') data.tglstuffingawal = $('.tglstuffingawal').val();
                if ($('.tglstuffingakhir').val() != '') data.tglstuffingakhir = $('.tglstuffingakhir').val();
                if ($('.dokumenbc').val() != '') data.dokumenbc = $('.dokumenbc').val();
                return data;
            }
        },
        "columns": [
            { data: "no", className: 'text-center', searchable: false },
            { data: "URAIAN_DOKUMEN_PABEAN", className: 'text-left' },
            { data: "NOMOR_AJU", className: 'text-center' },
            { data: "TANGGAL_AJU", className: 'text-center', "render": renderDTDate },
            { data: "kode_dokumen", className: 'text-left' },
            { data: "tgl_dokumen", className: 'text-center', "render": renderDTDate },
            { data: "NAMA_PENERIMA_BARANG", className: 'text-left' },
            { data: "KODE_BENDERA", className: 'text-center' },
            { data: "URAIAN", className: 'text-left' },
            { data: "JUMLAH_SATUAN", className: 'text-center', searchable: false },
            { data: "hargarp", className: 'text-right', searchable: false },
            { data: "hargaasli", className: 'text-right', searchable: false },
        ],
        "sorting": [
            [3, 'desc'],
            [2, 'desc']
        ],
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
            { 'sortable': false, 'targets': [0, -1, -2, -3, -4, -5] }
        ],
    });

    $('#dt_filter input').unbind().bind('keyup', function(e) {
        if (e.keyCode == 13) {
            oTable.search(this.value).draw();
        }
    });
});

function setValue(column, data) {
    let index = '-1';
    switch (column) {
        case 'referensi_dokumen_pabean':
            $('input[name="referensi_dokumen_pabean[ID]"]').val(data.ID);
            $('.URAIAN_DOKUMEN_PABEAN').val(data.URAIAN_DOKUMEN_PABEAN);
            break;
        default:
            break;
    }
}

$(document).ready(function() {});