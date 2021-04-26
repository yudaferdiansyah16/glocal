let arrdata = [];
let  oTable_t_production_detail_realisasi_material = null;
function selectArray(arr){
	let remove = false;
	let index;
	$.each(arrdata,function(i, v){
		if(v.id_wh_detail == arr.id_wh_detail) {
			remove = true;
			index = i;
			return false;
		}
	});
	if(remove) arrdata.splice(index, 1);
	else arrdata.push(arr);
}

let arrdatawip = [];
let  oTable_t_production_detail_realisasi_wip = null;
function selectArray2(arr){
	let remove = false;
	let index;
	$.each(arrdatawip,function(i, v){
		if(v.id_sub_barang == arr.id_sub_barang) {
			remove = true;
			index = i;
			return false;
		}
	});
	if(remove) arrdatawip.splice(index, 1);
	else arrdatawip.push(arr);
}

let arrdatascrap = [];
let  oTable_t_production_detail_realisasi_scrap = null;
function selectArray3(arr){
	let remove = false;
	let index;
	$.each(arrdatascrap,function(i, v){
		if(v.id_sub_barang == arr.id_sub_barang) {
			remove = true;
			index = i;
			return false;
		}
	});
	if(remove) arrdatascrap.splice(index, 1);
	else arrdatascrap.push(arr);
}

let arrdatawaste = [];
let  oTable_t_production_detail_realisasi_waste = null;
function selectArray4(arr){
	let remove = false;
	let index;
	$.each(arrdatawaste,function(i, v){
		if(v.id_sub_barang == arr.id_sub_barang) {
			remove = true;
			index = i;
			return false;
		}
	});
	if(remove) arrdatawaste.splice(index, 1);
	else arrdatawaste.push(arr);
}

let arrdataloss = [];
let  oTable_t_production_detail_realisasi_loss = null;
function selectArray6(arr){
	let remove = false;
	let index;
	$.each(arrdataloss,function(i, v){
		if(v.id_sub_barang == arr.id_sub_barang) {
			remove = true;
			index = i;
			return false;
		}
	});
	if(remove) arrdataloss.splice(index, 1);
	else arrdataloss.push(arr);
}

$(document).ready(function(){
	let  t1 = 't_production_detail_realisasi_material';
	var o = {};
	oTable_t_production_detail_realisasi_material = $('#dt_'+t1).DataTable({
		autoWidth : true,
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
			url: _baseurl+"production/realisasi_produksi/viewdtItemMaterial",
			type: "POST",
			"data": function ( d ) {
				return  $.extend(d, o);
			 }
		},
		columns: [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "blank", searchable: false, className: 'x-check-cell' },
			{ data: "kode_mutasi" },
			{ data: "no_job", className: 'text-center' },
			{ data: "nama_barang" },
			{ data: "kode_barang", className: 'text-center' },
			{ data: "uraian_satuan_terkecil", className: 'text-center' },
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

	$('#dt_'+t1+'_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode === 13) {
			oTable_t_production_detail_realisasi_material.search(this.value).draw();
		}
	});

	let  t2 = 't_production_detail_realisasi_wip';
	var o = {};
	oTable_t_production_detail_realisasi_wip = $('#dt_'+t2).DataTable({
		autoWidth : true,
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
			url: _baseurl+"production/realisasi_produksi/viewdtItemWip",
			type: "POST",
			"data": function ( d ) {
				return  $.extend(d, o);
			 }
		},
		columns: [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "blank", searchable: false, className: 'x-check-cell' },
			{ data: "kode_produksi" },
			{ data: "no_job" },
			{ data: "nama_barang" },
			{ data: "kode_barang", className: 'text-center' },
			{ data: "uraian_satuan_terkecil", className: 'text-center' },
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

	let  t3 = 't_production_detail_realisasi_scrap';
	var o = {};
	oTable_t_production_detail_realisasi_scrap = $('#dt_'+t3).DataTable({
		autoWidth : true,
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
			url: _baseurl+"production/realisasi_produksi/viewdtItemScrap",
			type: "POST",
			"data": function ( d ) {
				return  $.extend(d, o);
			 }
		},
		columns: [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "blank", searchable: false, className: 'x-check-cell' },
			{ data: "kode_produksi" },
			{ data: "no_job" },
			{ data: "nama_barang" },
			{ data: "kode_barang", className: 'text-center' },
			{ data: "uraian_satuan_terkecil", className: 'text-center' },
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

	let  t4 = 't_production_detail_realisasi_waste';
	var o = {};
	oTable_t_production_detail_realisasi_waste = $('#dt_'+t4).DataTable({
		autoWidth : true,
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
			url: _baseurl+"production/realisasi_produksi/viewdtItemWaste",
			type: "POST",
			"data": function ( d ) {
				return  $.extend(d, o);
			 }
		},
		columns: [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "blank", searchable: false, className: 'x-check-cell' },
			{ data: "kode_produksi" },
			{ data: "no_job" },
			{ data: "nama_barang" },
			{ data: "kode_barang", className: 'text-center' },
			{ data: "uraian_satuan_terkecil", className: 'text-center' },
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

	let  t5 = 't_production_detail_realisasi_return';
	var o = {};
	oTable_t_production_detail_realisasi_return = $('#dt_'+t5).DataTable({
		autoWidth : true,
		responsive: false,
		scrollX: true,
		scrollY: '46vh',
		// saveState: true,
		// processing: true,
		// serverSide: true,
		displayLength: 10,
		paginate: true,
		lengthChange: false,
		filter: true,
		sort: true,
		info: true,
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

	let  t6 = 't_production_detail_realisasi_loss';
	var o = {};
	oTable_t_production_detail_realisasi_loss = $('#dt_'+t6).DataTable({
		autoWidth : true,
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
			url: _baseurl+"production/realisasi_produksi/viewdtItemLoss",
			type: "POST",
			"data": function ( d ) {
				return  $.extend(d, o);
			 }
		},
		columns: [
			{ data: "no", searchable: false, className: 'text-center' },
			{ data: "blank", searchable: false, className: 'x-check-cell' },
			{ data: "kode_produksi" },
			{ data: "no_job" },
			{ data: "nama_barang" },
			{ data: "kode_barang", className: 'text-center' },
			{ data: "uraian_satuan_terkecil", className: 'text-center' },
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

	$('#dt_'+t1+' tbody').on( 'click', 'tr', function (e) {
		let checkbox = $($(this).find('.custom-control-input')[0]);
		let data = oTable_t_production_detail_realisasi_material.row($(this)).data();
		if(checkbox.is(':checked')) checkbox.prop('checked', false);
		else checkbox.prop('checked', true);
		$(this).toggleClass('selected');
		selectArray(data);
	});

	$('#dt_'+t2+' tbody').on( 'click', 'tr', function (e) {
		let checkbox = $($(this).find('.custom-control-input')[0]);
		let data = oTable_t_production_detail_realisasi_wip.row($(this)).data();
		if(checkbox.is(':checked')) checkbox.prop('checked', false);
		else checkbox.prop('checked', true);
		$(this).toggleClass('selected');
		selectArray2(data);
	});

	$('#dt_'+t3+' tbody').on( 'click', 'tr', function (e) {
		let checkbox = $($(this).find('.custom-control-input')[0]);
		let data = oTable_t_production_detail_realisasi_scrap.row($(this)).data();
		if(checkbox.is(':checked')) checkbox.prop('checked', false);
		else checkbox.prop('checked', true);
		$(this).toggleClass('selected');
		selectArray3(data);
	});

	$('#dt_'+t4+' tbody').on( 'click', 'tr', function (e) {
		let checkbox = $($(this).find('.custom-control-input')[0]);
		let data = oTable_t_production_detail_realisasi_waste.row($(this)).data();
		if(checkbox.is(':checked')) checkbox.prop('checked', false);
		else checkbox.prop('checked', true);
		$(this).toggleClass('selected');
		selectArray4(data);
	});

	$('#dt_'+t6+' tbody').on( 'click', 'tr', function (e) {
		let checkbox = $($(this).find('.custom-control-input')[0]);
		let data = oTable_t_production_detail_realisasi_loss.row($(this)).data();
		if(checkbox.is(':checked')) checkbox.prop('checked', false);
		else checkbox.prop('checked', true);
		$(this).toggleClass('selected');
		selectArray6(data);
	});


	$('#btn-attach-material').on('click', function () {
		attachData(arrdata, t1);
		$('#'+t1+"_modal").modal('hide');
	});

	$('#btn-attach-wip').on('click', function () {
		attachData(arrdatawip, t2);
		$('#'+t2+"_modal").modal('hide');
	});

	$('#btn-attach-scrap').on('click', function () {
		attachData(arrdatascrap, t3);
		$('#'+t3+"_modal").modal('hide');
	});

	$('#btn-attach-waste').on('click', function () {
		attachData(arrdatawaste, t4);
		$('#'+t4+"_modal").modal('hide');
	});

	$('#btn-attach-loss').on('click', function () {
		attachData(arrdataloss, t6);
		$('#'+t6+"_modal").modal('hide');
	});

	$('#'+t1+'_modal').on('shown.bs.modal', function () {
		setTimeout(function(){
			$.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
			//oTable_t_detail_so_bom.columns.adjust().draw();
		},500);
	});

	$('#'+t2+'_modal').on('shown.bs.modal', function () {
		setTimeout(function(){
			$.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
			//oTable_t_detail_so_bom.columns.adjust().draw();
		},500);
	});

	$('#'+t3+'_modal').on('shown.bs.modal', function () {
		setTimeout(function(){
			$.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
			//oTable_t_detail_so_bom.columns.adjust().draw();
		},500);
	});

	$('#'+t4+'_modal').on('shown.bs.modal', function () {
		setTimeout(function(){
			$.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
			//oTable_t_detail_so_bom.columns.adjust().draw();
		},500);
	});

	$('#'+t6+'_modal').on('shown.bs.modal', function () {
		setTimeout(function(){
			$.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
			//oTable_t_detail_so_bom.columns.adjust().draw();
		},500);
	});

	$("#t_job_modal").on("hidden.bs.modal", function () {
		o.id = $('.id_job').val();
		oTable_t_production_detail_realisasi_material.ajax.reload();
		oTable_t_production_detail_realisasi_wip.ajax.reload();
		oTable_t_production_detail_realisasi_scrap.ajax.reload();
		oTable_t_production_detail_realisasi_waste.ajax.reload();
		oTable_t_production_detail_realisasi_loss.ajax.reload();

		return false;
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

