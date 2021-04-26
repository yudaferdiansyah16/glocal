let oTable_t_dn_docin;

$(document).ready(function(){
	let t = 't_dn_docin';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		"ajax": {
			url: _baseurl+"procurement/delivery_note_po/viewdocindt",
			type: "POST",
			data: function(data){
				if ($('.id_supplier_filter').val() != '') data.id_supplier = $('.id_supplier_filter').val();
				return data;
			}
		},
		"columns": [
			{ data: "no", searchable: false, orderable: false, className: 'text-center' },
			{ data: "kode_dn", className: 'text-center' },
			{ data: "no_invoice", className: 'text-center' },
			{ data: "no_faktur", className: 'text-center' },
			{ data: "tgl_kedatangan", className: 'text-center' },
			{ data: "nama_supplier" },
			{ data: "plat_kendaraan", className: 'text-center' },
			{ data: "nama_fasilitas", className: 'text-center' }
		],
		sorting : [[1, 'asc']],
	});
	oTable_t_dn_docin = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_t_dn_docin, t);
	listenKeyInput(oTable_t_dn_docin, t);

	oTable_t_dn_docin.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_t_dn_docin, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_t_dn_docin, this);
	});
});

