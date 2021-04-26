let oTable_m_customer;

$(document).ready(function(){
    let t = 'm_customer';
    let opts = $.extend({},DataTableOptionsModal, {
        keys: {
            keys: [13, 38, 40]
        },
        ajax: {
            url: _baseurl+"master/customer/viewdt/false",
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
	oTable_m_customer = $('#dt_'+t).DataTable(opts);
    dtFilterOnEnter(oTable_m_customer, t);
    listenKeyInput(oTable_m_customer, t);

	oTable_m_customer.on('key',function(e, f, v, c){
        if(v===13) singleAttach(t, true, oTable_m_customer, c);
    }).on('dblclick','tr', function(){
        singleAttach(t, false, oTable_m_customer, this);
    });
});
