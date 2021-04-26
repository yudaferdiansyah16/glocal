let filter_job = '';
$(document).ready(function(){
	let  t = 't_job_packing';
	let  oTable_t_job = $('#dt_'+t).DataTable({
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
			url: _baseurl+"master/job/viewpackingdt",
			type: "POST",
		},
		columns: [
			{ data: "no", searchable: false,className: 'text-center' },
			{ data: "no_job", className: 'text-left' },
			{ data: "tanggal_job", className: 'text-center', render: function ( data, type, row, meta ) {
				return moment(data).format('DD-MM-YYYY');
			} },
		],
		sorting : [[1, 'asc']],
		columnDefs: [
			{ 'sortable': false, 'targets': [0,-1] }
		]
	});

	$('#dt_'+t+'_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode === 13) {
			oTable_t_job.search(this.value).draw();
		}
	});

	$('#dt_'+t).on('key-focus.dt', function(e, datatable, cell){
		// Select highlighted row
		$(oTable_t_job.row(cell.index().row).node()).addClass('selected');
	});

	// Handle event when cell looses focus
	$('#dt_'+t).on('key-blur.dt', function(e, datatable, cell){
		// Deselect highlighted row
		$(oTable_t_job.row(cell.index().row).node()).removeClass('selected');
	});

	function processSelect_t_job(e, datatable, key, cell, originalEvent){
		if(key === 13){
			setValue(t, datatable.row(cell.index().row).data());
		} else if(e.type === "dblclick"){
			setValue(t, $('#dt_'+t).DataTable().row(this).data());
		}
		$('#'+t+'_modal').modal('hide');
	}

	oTable_t_job.on('key', processSelect_t_job)
		.on('dblclick','tr', processSelect_t_job);
});
