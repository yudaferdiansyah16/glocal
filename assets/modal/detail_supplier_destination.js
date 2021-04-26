let oTable_detail_supplier_destination;

$(document).ready(function(){
    let t = 'detail_supplier_destination';
    let opts = $.extend({},DataTableOptionsModal, {
        keys: {
            keys: [13, 38, 40]
        },
        ajax: {
            url: _baseurl+"master/detail_supplier_destination/viewdt",
            type: "POST",
			"data": function(data){
				if ($('.id_supplier').val() != '') data.id_supplier = $('.id_supplier').val(); else data.id_supplier = 'xxx';
				return data;
			}
        },
        columns: [
            { "data": "no", searchable: false, orderable: false, className: 'text-center' },
			{ data: "alamat" },
			{ data: "nama_negara" },
		],
        sorting : [[1, 'asc']],
    });
	oTable_detail_supplier_destination = $('#dt_'+t).DataTable(opts);
    dtFilterOnEnter(oTable_detail_supplier_destination, t);
    listenKeyInput(oTable_detail_supplier_destination, t);

	oTable_detail_supplier_destination.on('key',function(e, f, v, c){
        if(v===13) singleAttach(t, true, oTable_detail_supplier_destination, c);
    }).on('dblclick','tr', function(){
        singleAttach(t, false, oTable_detail_supplier_destination, this);
    });
});
