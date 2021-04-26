let arrdata = [];
let  oTable_t_production_detail_packing = null;
function selectArray(arr){
	let remove = false;
	let index;
	$.each(arrdata,function(i, v){
		if(v.id_production_detail == arr.id_production_detail) {
			remove = true;
			index = i;
			return false;
		}
	});
	if(remove) arrdata.splice(index, 1);
	else arrdata.push(arr);
}

$(document).ready(function(){
	let  t = 't_production_detail_packing';
	oTable_t_production_detail_packing = $('#dt_'+t).DataTable({
		autoWidth : true,
		responsive: false,
		//scrollX: true,
		//scrollY: '46vh',
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
			url: _baseurl+"production/packing/viewremaindt",
			type: "POST",
			"data": function(data){
				data.id_job = $('.id_job').val() != '' ? $('.id_job').val() : 'xxx';
				return data;
			}
		},
		columns: [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "blank", searchable: false, className: 'x-check-cell text-center' },
			{ data: "kode_mutasi", className: 'text-center' },
			{ data: "tanggal_mutasi", className: 'text-center', render: function ( data, type, row, meta ) {
				return moment(data).format('DD-MM-YYYY');
			}},
			{ data: "kode_barang", className: 'text-center' },
			{ data: "nama_barang" },
			{ data: "qty", className: 'text-right' },
		],
		sorting : [[2, 'asc']],
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
			oTable_t_production_detail_packing.search(this.value).draw();
		}
	});

	$('#dt_'+t+' tbody').on( 'click', 'tr', function (e) {
		let checkbox = $($(this).find('.custom-control-input')[0]);
		let data = oTable_t_production_detail_packing.row($(this)).data();
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
			//oTable_t_detail_so_bom.columns.adjust().draw();
		},500);
	});

	/*function processSelect_t_detail_po_dn(e, datatable, key, cell, originalEvent){
		if(key === 13){
			setValue(t, datatable.row(cell.index().row).data());
		} else if(e.type === "dblclick"){
			setValue(t, $('#dt_'+t).DataTable().row(this).data());
		}
		$('#'+t+'_modal').modal('hide');
	}

	oTable_t_wh_detail_request.on('key', processSelect_t_detail_po_dn)
		.on('dblclick','tr', processSelect_t_detail_po_dn);
	 */
});

