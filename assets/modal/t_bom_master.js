let filter_bom = '';
let oTable_t_bom_master;

function reloadMasterBom(){
	oTable_t_bom_master.ajax.reload().draw();
	console.log("asdasd");
}

$(document).ready(function(){

	let  t = 't_bom_master';
	oTable_t_bom_master = $('#dt_'+t).DataTable({
		autoWidth : true,
		responsive: false,
		// "scrollX": true,
		keys: {
			keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */ ]
		},
		saveState: true,
		processing: true,
		serverSide: true,
		displayLength: 10,
		paginate: true,
		lengthChange: false,
		filter: true,
		sort: true,
		info: true,
		ajax: {
			url: _baseurl+"master/bom/viewdtmodal/false",
			type: "POST",
			data: function(data){
				if ($('.id_sub_barang').val() != '') data.id_sub_barang = $('.id_sub_barang').val();
				return data;
			}
		},
		columns: [
			{ data: "no", className: 'text-center' },
			{ data: "kode_bom", className: 'text-center' },
			{ data: "tanggal_bom", className: 'text-center', "render": function ( data, type, row, meta ) {
					return moment(data).format('DD-MM-YYYY');
			}},
			{ data: "nama_barang" },
			{ data: "qty", className: 'text-right' },
			{ data: "kode_satuan", className: 'text-center' }
		],
		sorting : [[1, 'asc']],
		columnDefs: [
			{ 'sortable': false, 'targets': [0,-1] }
		]
	});

	$('#dt_'+t+'_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode === 13) {
			oTable_t_bom_master.search(this.value).draw();
		}
	});

	$('#dt_'+t).on('key-focus.dt', function(e, datatable, cell){
		// Select highlighted row
		$(oTable_t_bom_master.row(cell.index().row).node()).addClass('selected');
	});

	// Handle event when cell looses focus
	$('#dt_'+t).on('key-blur.dt', function(e, datatable, cell){
		// Deselect highlighted row
		$(oTable_t_bom_master.row(cell.index().row).node()).removeClass('selected');
	});

	function processSelect_t_bom_master(e, datatable, key, cell, originalEvent){
		if(key === 13){
			setValue(t, datatable.row(cell.index().row).data());
		} else if(e.type === "dblclick"){
			setValue(t, $('#dt_'+t).DataTable().row(this).data());
		}
		$('#'+t+'_modal').modal('hide');
	}

	oTable_t_bom_master.on('key', processSelect_t_bom_master)
		.on('dblclick','tr', processSelect_t_bom_master);
});
