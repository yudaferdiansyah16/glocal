$(document).ready(function(){
	let  t = 'm_pp';
	let  oTable_m_pp = $('#dt_'+t).DataTable({
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
			url: _baseurl+"master/viewppdt",
			type: "POST",
		},
		columns: [
			{ "data": "no", searchable: false },
			{ "data": "id_jenis_pp" },
			{ "data": "id_jenis_pp_rutinitas" },
			{ "data": "id_bagian" },
			{ "data": "kode_pp" },
			{ "data": "tanggal_dibuat" },
			{ "data": "tanggal_dibutuhkan" },
			{ "data": "id_status" },
			{ "data": "approval_1" },
			{ "data": "approval_2" },
			{ "data": "id_user_approval_1" },
			{ "data": "id_user_approval_2" },
			{ "data": "closing" },
		],
		sorting : [[1, 'asc']],
		columnDefs: [
			{ 'sortable': false, 'targets': [0,-1] }
		]
	});

	$('#dt_'+t+'_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode === 13) {
			oTable_m_pp.search(this.value).draw();
		}
	});

	$('#dt_'+t).on('key-focus.dt', function(e, datatable, cell){
		// Select highlighted row
		$(oTable_m_pp.row(cell.index().row).node()).addClass('selected');
	});

	// Handle event when cell looses focus
	$('#dt_'+t).on('key-blur.dt', function(e, datatable, cell){
		// Deselect highlighted row
		$(oTable_m_pp.row(cell.index().row).node()).removeClass('selected');
	});

	function processSelect_m_pp(e, datatable, key, cell, originalEvent){
		if(key === 13){
			setValue(t, datatable.row(cell.index().row).data());
		} else if(e.type === "dblclick"){
			setValue(t, $('#dt_'+t).DataTable().row(this).data());
		}
		$('#'+t+'_modal').modal('hide');
	}

	oTable_m_pp.on('key', processSelect_m_pp)
		.on('dblclick','tr', processSelect_m_pp);
});
