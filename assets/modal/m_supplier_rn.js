let oTable_m_supplier;

$(document).ready(function(){
	let t = 'm_supplier';
	let opts = $.extend({},DataTableOptionsModal, {
		keys: {
			keys: [13, 38, 40]
		},
		ajax: {
			url: _baseurl+"master/supplierrn/viewdt/false",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ "data": "kode_customer" },
			{ "data": "nama" },
			{ "data": "alamat" },
			{ "data": "kode_negara" },
			{ "data": "npwp" },
		],
		sorting : [[1, 'asc']],
	});
	oTable_m_supplier = $('#dt_'+t).DataTable(opts);
	dtFilterOnEnter(oTable_m_supplier, t);
	listenKeyInput(oTable_m_supplier, t);

	oTable_m_supplier.on('key',function(e, f, v, c){
		if(v===13) singleAttach(t, true, oTable_m_supplier, c);
	}).on('dblclick','tr', function(){
		singleAttach(t, false, oTable_m_supplier, this);
	});
});
