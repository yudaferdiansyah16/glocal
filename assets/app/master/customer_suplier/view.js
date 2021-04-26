$(document).ready(function() {
    let oTableCustomer = $("#dt_customer").DataTable({
        autoWidth: true,
        responsive: false,
        //"scrollX": true,
        processing: true,
        serverSide: true,
        displayLength: 10,
        paginate: true,
        lengthChange: false,
        filter: true,
        sort: true,
        info: true,
        ajax: {
            url: _baseurl + "master/customer_suplier/viewdtcustomer",
            type: "POST",
        },
        columns: [
            { 
                data: "kode_customer",
                render: function ( data, type, row ) {
					return "<div>"+row.kode_customer+"<br><span style='font-size: 10px'>"+row.kode_lama+"</span></div>";
				},
            },
            { data: "kode_lama", visible: false },
            { 
                data: "kode_negara",
                className : "text-center",
                render: function ( data, type, row ) {
                    let low = row.kode_negara;
                    let neg = '';
                    if (low.length>0) {
                        neg = low.toLowerCase(); 
                        return '<img src="https://www.countryflags.io/'+neg+'/flat/48.png">';
                    } else {
                        return low;
                    }
				},
            },
            { 
                data: "nama",
                render: function ( data, type, row ) {
					return "<div>"+row.nama+"<br><span style='font-size: 10px'>"+row.alamat+"</span></div>";
				},
            },
            { data: "alamat", visible: false },
            // { 
            //     data: "nama_consignee",
            //     render: function ( data, type, row ) {
			// 		return "<div>"+row.nama_consignee+"<br><span style='font-size: 10px'>"+row.destinasi+"</span></div>";
			// 	},
            // },
            { data: "destinasi", visible : false },
	    { data: "nama_consignee" },
            { data: "npwp" },
            { data: "option", searchable: false, className: "text-center" },
        ],
        sorting: [
            [3, "asc"]
        ],
        columnDefs: [{ sortable: false, targets: [-1] }],
    });

    $("#dt_filter input").unbind().bind("keyup", function(e) {
        if (e.keyCode == 13) {
            oTableCustomer.search(this.value).draw();
        }
    });

    let oTableSupplier = $("#dt_supplier").DataTable({
        autoWidth: true,
        responsive: false,
        //"scrollX": true,
        processing: true,
        serverSide: true,
        displayLength: 10,
        paginate: true,
        lengthChange: false,
        filter: true,
        sort: true,
        info: true,
        ajax: {
            url: _baseurl + "master/customer_suplier/viewdtsupplier",
            type: "POST",
        },
        columns: [
            { 
                data: "kode_customer",
                render: function ( data, type, row ) {
					return "<div>"+row.kode_customer+"<br><span style='font-size: 10px'>"+row.kode_lama+"</span></div>";
				},
            },
            { data: "kode_lama", visible: false },
            { 
                data: "kode_negara",
                className : "text-center",
                render: function ( data, type, row ) {
                    let low = row.kode_negara;
                    let neg = '';
                    if (low.length>0) {
                        neg = low.toLowerCase(); 
                        return '<img src="https://www.countryflags.io/'+neg+'/flat/48.png">';
                    } else {
                        return low;
                    }
				},
            },
            { 
                data: "nama",
                render: function ( data, type, row ) {
					return "<div>"+row.nama+"<br><span style='font-size: 10px'>"+row.alamat+"</span></div>";
				},
            },
            { data: "alamat", visible: false },
            // { 
            //     data: "nama_consignee",
            //     render: function ( data, type, row ) {
			// 		return "<div>"+row.nama_consignee+"<br><span style='font-size: 10px'>"+row.destinasi+"</span></div>";
			// 	},
            // },
            { data: "destinasi", visible : false },
	    { data: "nama_consignee" },
            { data: "npwp" },
            { data: "option", searchable: false, className: "text-center" },
        ],
        sorting: [
            [3, "asc"]
        ],
        columnDefs: [{ sortable: false, targets: [-1] }],
    });

    $("#dt_filter input").unbind().bind("keyup", function(e) {
        if (e.keyCode == 13) {
            oTableSupplier.search(this.value).draw();
        }
    });
});