let arrdata = [];
function selectArray(arr){
	let remove = false;
	let index;
	$.each(arrdata,function(i, v){
		if(v.id_po === arr.id_po) {
			remove = true;
			index = i;
			return false;
		}
	});
	if(remove) arrdata.splice(index, 1);
	else arrdata.push(arr);
}

$(document).ready(function(){
	let t = 't_po_detail_planning_stuffing';
	let oTable_t_po_detail_planning_stuffing = $('#dt_'+t).DataTable({
		autoWidth : false,
		responsive: false,
		scrollX: true,
		scrollY: '46vh',
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
			url: _baseurl+"warehouse/planning_stuffing/viewplanningstuffingdt",
			type: "POST",
		},
		columns: [
			{ data: "no", searchable: false, sortable: false, className: 'text-center'},
			{ data: "blank", searchable: false, sortable: false, className: 'x-check-cell' },
			{ data: "kode_barang" },
			{ data: "keterangan", className: 'text-center' },
			{ data: "id_satuan", className: 'text-center' },
			{ data: "qty_po" },
			{ data: "kode_kemasan", className: 'text-center' },
			{ data: "qty_mc", className: 'text-right' }
		],
		sorting : [[3, 'asc']],
		columnDefs: [
			{ 'sortable': false, 'targets': [0,1] }
		],
		createdRow: function( row, data, dataIndex ) {
			$('td', row).eq(1).html('<div class="custom-control custom-checkbox custom-control-inline x-check-modal"><input type="checkbox" class="custom-control-input x-check-input" id="havingchild['+dataIndex+']" readonly><label class="custom-control-label" for="havingchild['+dataIndex+']"></label></div>');
		},
		drawCallback: function(){
			$('.x-check-input').off().on('click', function(){
				let parent = $(this).closest('tr');
				parent.toggleClass('selected');
			})
		}
	});

	$('#dt_'+t+'_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode === 13) {
			oTable_t_po_detail_planning_stuffing.search(this.value).draw();
		}
	});


	/* Checklist Function */

	$('#dt_'+t+' tbody').on( 'click', 'tr', function (e) {
		let checkbox = $($(this).find('.custom-control-input')[0]);
		let data = oTable_t_po_detail_planning_stuffing.row($(this)).data();
		if(checkbox.is(':checked')) checkbox.prop('checked', false);
		else checkbox.prop('checked', true);
		$(this).toggleClass('selected');
		selectArray(data);
	});

	$('#btn-attach').on('click', function () {
		attachData(arrdata, t);
		$('#'+t+"_modal").modal('hide');
	});

	$('#'+t+'_modal').on('shown.bs.modal', function () {
		setTimeout(function(){
			$.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
			oTable_t_po_detail_planning_stuffing.columns.adjust().draw();
		},500);
	});
});
