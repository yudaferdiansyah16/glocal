function attachData(data, key){
	switch(key) {
		case 't_production_detail_realisasi_material':
			let elementTableMaterial = $('#dt_material');
			let elementTableReturn = $('#dt_return');
			elementTableMaterial.find('tbody').empty();
			elementTableReturn.find('tbody').empty();
			for (let j = 0; j < data.length; j++) {
				const row = data[j];
				const lastDataMaterial = elementTableMaterial.find('tbody').find('tr').last();
				let i = 0;
				if (lastDataMaterial.length > 0) i = lastDataMaterial.data('index');
				i++;

				let table_template_material = $('.table_template_material').find('tbody').html();
				table_template_material = replaceAll(table_template_material, "[x]", "["+i+"]");
				elementTableMaterial.find('tbody').append(table_template_material);
				let lastElementMaterial = elementTableMaterial.find('tbody').find('tr').last();
				lastElementMaterial.attr('data-index', i);
				lastElementMaterial.find('.text_kode_produksi_material').text(row.kode_mutasi);
				lastElementMaterial.find('.text_no_job_material').text(row.no_job);
				lastElementMaterial.find('.text_nama_barang_material').text(row.nama_barang);
				lastElementMaterial.find('.text_kode_barang_material').text(row.kode_barang);
				lastElementMaterial.find('.text_satuan_material').text(row.uraian_satuan_terkecil);
				lastElementMaterial.find('.text_qty_request_material').text(row.qty);
				// lastElementMaterial.find('.qty_material').attr('max',row.qty_max);
				lastElementMaterial.find('.qty_request_material').val(row.qty_max);
				lastElementMaterial.find('.id_job_material').val(row.id_job);
				lastElementMaterial.find('.id_detail_dn').val(row.id_detail_dn);
				lastElementMaterial.find('.id_sub_barang_material').val(row.id_sub_barang);
				lastElementMaterial.find('.seri_barang_material').val(row.seri_barang);
				lastElementMaterial.find('.tanggal_mutasi').val(row.tanggal_mutasi);
				lastElementMaterial.find('.id_wh_detail').val(row.id_wh_detail);
				lastElementMaterial.find('.id_wh_detail_material').val(row.id_wh_detail);

				let table_template_return = $('.table_template_return').find('tbody').html();
				table_template_return = replaceAll(table_template_return, "[x]", "["+i+"]");
				elementTableReturn.find('tbody').append(table_template_return);
				let lastElementReturn = elementTableReturn.find('tbody').find('tr').last();
				lastElementReturn.find('.text_no_return').text(i);
				lastElementReturn.find('.text_kode_produksi_return').text(row.kode_mutasi);
				lastElementReturn.find('.text_no_job_return').text(row.no_job);
				lastElementReturn.find('.text_nama_barang_return').text(row.nama_barang);
				lastElementReturn.find('.text_kode_barang_return').text(row.kode_barang);
				lastElementReturn.find('.text_satuan_return').text(row.uraian_satuan_terkecil);
				lastElementReturn.find('.qty_return').val('0');
				// lastElementReturn.find('.qty_material').attr('max',row.qty_max);
				lastElementReturn.find('.id_job_return').val(row.id_job);
				lastElementReturn.find('.id_sub_barang_return').val(row.id_sub_barang);
				lastElementReturn.find('.seri_barang_return').val(row.seri_barang);
				lastElementReturn.find('.id_wh_detail_return').val(row.id_wh_detail);
			}
			renderTableNumber(elementTableMaterial, 0);
			renderTableNumber(elementTableReturn, 0);

		break;

		case 't_production_detail_realisasi_wip':
			let elementTableWip = $('#dt_wip');
			elementTableWip.find('tbody').empty();
			for (let j = 0; j < data.length; j++) {
				const row = data[j];
				const lastData = elementTableWip.find('tbody').find('tr').last();
				let i = 0;
				if (lastData.length > 0) i = lastData.data('index');
				i++;

				let table_template_wip = $('.table_template_wip').find('tbody').html();
				table_template_wip = replaceAll(table_template_wip, "[x]", "["+i+"]");
				elementTableWip.find('tbody').append(table_template_wip);
				let lastElementWip = elementTableWip.find('tbody').find('tr').last();
				lastElementWip.attr('data-index', i);
				lastElementWip.find('.text_kode_produksi_wip').text(row.kode_produksi);
				lastElementWip.find('.text_no_job_wip').text(row.no_job);
				lastElementWip.find('.text_nama_barang_wip').text(row.nama_barang);
				lastElementWip.find('.text_kode_barang_wip').text(row.kode_barang);
				lastElementWip.find('.text_satuan_wip').text(row.uraian_satuan_terkecil);
				if(row.qty_max) lastElementWip.find('.qty_wip').attr('max',row.qty_max);
				lastElementWip.find('.id_job_wip').val(row.id_job);
				lastElementWip.find('.id_sub_barang_wip').val(row.id_sub_barang);
				lastElementWip.find('.seri_barang_wip').val(row.seri_barang);
				lastElementWip.find('.id_wh_detail_wip').val(row.id_wh_detail);
			}
			renderTableNumber(elementTableWip, 0);

		break;

		case 't_production_detail_realisasi_scrap':
			let elementTableScrap = $('#dt_scrap');
			elementTableScrap.find('tbody').empty();
			for (let j = 0; j < data.length; j++) {
				const row = data[j];
				const lastData = elementTableScrap.find('tbody').find('tr').last();
				let i = 0;
				if (lastData.length > 0) i = lastData.data('index');
				i++;

				let table_template_scrap = $('.table_template_scrap').find('tbody').html();
				table_template_scrap = replaceAll(table_template_scrap, "[x]", "["+i+"]");
				elementTableScrap.find('tbody').append(table_template_scrap);
				let lastElementScrap = elementTableScrap.find('tbody').find('tr').last();
				lastElementScrap.attr('data-index', i);
				lastElementScrap.find('.text_kode_produksi_scrap').text(row.kode_produksi);
				lastElementScrap.find('.text_no_job_scrap').text(row.no_job);
				lastElementScrap.find('.text_nama_barang_scrap').text(row.nama_barang);
				lastElementScrap.find('.text_kode_barang_scrap').text(row.kode_barang);
				lastElementScrap.find('.text_satuan_scrap').text(row.uraian_satuan_terkecil);
				if(row.qty_max) lastElementScrap.find('.qty_scrap').attr('max',row.qty_max);
				lastElementScrap.find('.id_job_scrap').val(row.id_job);
				lastElementScrap.find('.id_sub_barang_scrap').val(row.id_sub_barang);
				lastElementScrap.find('.seri_barang_scrap').val(row.seri_barang);
				lastElementScrap.find('.id_wh_detail_scrap').val(row.id_wh_detail);
			}
			renderTableNumber(elementTableScrap, 0);

		break;

		case 't_production_detail_realisasi_waste':
			let elementTableWaste = $('#dt_waste');
			elementTableWaste.find('tbody').empty();
			for (let j = 0; j < data.length; j++) {
				const row = data[j];
				const lastData = elementTableWaste.find('tbody').find('tr').last();
				let i = 0;
				if (lastData.length > 0) i = lastData.data('index');
				i++;

				let table_template_waste = $('.table_template_waste').find('tbody').html();
				table_template_waste = replaceAll(table_template_waste, "[x]", "["+i+"]");
				elementTableWaste.find('tbody').append(table_template_waste);
				let lastElementWaste = elementTableWaste.find('tbody').find('tr').last();
				lastElementWaste.attr('data-index', i);
				lastElementWaste.find('.text_kode_produksi_waste').text(row.kode_produksi);
				lastElementWaste.find('.text_no_job_waste').text(row.no_job);
				lastElementWaste.find('.text_nama_barang_waste').text(row.nama_barang);
				lastElementWaste.find('.text_kode_barang_waste').text(row.kode_barang);
				lastElementWaste.find('.text_satuan_waste').text(row.uraian_satuan_terkecil);
				if(row.qty_max) lastElementWaste.find('.qty_waste').attr('max',row.qty_max);
				lastElementWaste.find('.id_job_waste').val(row.id_job);
				lastElementWaste.find('.id_sub_barang_waste').val(row.id_sub_barang);
				lastElementWaste.find('.seri_barang_waste').val(row.seri_barang);
				lastElementWaste.find('.id_wh_detail_waste').val(row.id_wh_detail);
			}
			renderTableNumber(elementTableWaste, 0);

		break;

		case 't_production_detail_realisasi_loss':
			let elementTableLoss = $('#dt_loss');
			elementTableLoss.find('tbody').empty();
			for (let j = 0; j < data.length; j++) {
				const row = data[j];
				const lastData = elementTableLoss.find('tbody').find('tr').last();
				let i = 0;
				if (lastData.length > 0) i = lastData.data('index');
				i++;

				let table_template_loss = $('.table_template_loss').find('tbody').html();
				table_template_loss = replaceAll(table_template_loss, "[x]", "["+i+"]");
				elementTableLoss.find('tbody').append(table_template_loss);
				let lastElementLoss = elementTableLoss.find('tbody').find('tr').last();
				lastElementLoss.attr('data-index', i);
				lastElementLoss.find('.text_kode_produksi_loss').text(row.kode_produksi);
				lastElementLoss.find('.text_no_job_loss').text(row.no_job);
				lastElementLoss.find('.text_nama_barang_loss').text(row.nama_barang);
				lastElementLoss.find('.text_kode_barang_loss').text(row.kode_barang);
				lastElementLoss.find('.text_satuan_loss').text(row.uraian_satuan_terkecil);
				if(row.qty_max) lastElementLoss.find('.qty_loss').attr('max',row.qty_max);
				lastElementLoss.find('.id_job_loss').val(row.id_job);
				lastElementLoss.find('.id_sub_barang_loss').val(row.id_sub_barang);
				lastElementLoss.find('.seri_barang_loss').val(row.seri_barang);
				lastElementLoss.find('.id_wh_detail_loss').val(row.id_wh_detail);
			}
			renderTableNumber(elementTableLoss, 0);

		break;
	}
}

function setValue(column, data){
	let index = '-1';
	switch (column) {
		case 't_job':
			$('input[name="t_production[id_job]').val(data.id_job);
			$('.no_job').val(data.no_job);
			var o = {};
			o.id = data.id_job;
			$.post(_baseurl+"production/realisasi_produksi/getJob", o, function(res) {
				$('.vcustomer').val(res.customer);
				$('.vpo').val(res.kode_po);
				$('.vfg').val(res.nama_barang);
				$('.vqty').val(res.qty_po);

				
				
				// let elementTablefg = $('#dt_fg');
				// elementTablefg.find('tbody').empty();
				// for (let j = 0; j < data.length; j++) {
				// 	const row = data[j];
				// 	const lastData = elementTablefg.find('tbody').find('tr').last();
				// 	let i = 0;
				// 	if (lastData.length > 0) i = lastData.data('index');
				// 	i++;
	
				// 	let table_template_fg = $('.table_template_fg').find('tbody').html();
				// 	table_template_fg = replaceAll(table_template_fg, "[x]", "["+i+"]");
				// 	elementTableFg.find('tbody').append(table_template_loss);
				// 	let lastElementFg = elementTableFg.find('tbody').find('tr').last();
				// 	lastElementFg.attr('data-index', i);
				// 	lastElementFg.find('.text_kode_produksi_loss').text(row.kode_produksi);
				// 	lastElementFg.find('.text_no_job_loss').text(row.no_job);
				// 	lastElementFg.find('.text_nama_barang_loss').text(row.nama_barang);
				// 	lastElementFg.find('.text_kode_barang_loss').text(row.kode_barang);
				// 	lastElementFg.find('.text_satuan_loss').text(row.uraian_satuan_terkecil);
				// 	if(row.qty_max) lastElementFg.find('.qty_loss').attr('max',row.qty_max);
				// 	lastElementFg.find('.id_job_loss').val(row.id_job);
				// 	lastElementFg.find('.id_sub_barang_loss').val(row.id_sub_barang);
				// 	lastElementFg.find('.seri_barang_loss').val(row.seri_barang);
				// 	lastElementFg.find('.id_wh_detail_loss').val(row.id_wh_detail);
				// }
				// renderTableNumber(elementTablefg, 0);
			});
			break;
		default:
			break;
	}
}

$(document).ready(function(){
	initDatepicker($('.x-datepicker'));
	$('.select2').select2();

	$(document).on('click', '.btn-search-item', function () {
		currentRow = $(this).closest('tr');
	});

	const table_detail_material = $('#dt_material');
	$(document).on('click', '.btn-add-row', function (e) {
		const row_template_material = $('.table-template-material').find('tbody').html();
		table_detail_material.find('tbody').append(row_template_material);

		// $(".input-mask").inputmask();
		renderTableNumber(table_detail_material, 0);
	});

	$(document).on('click', '.btn-delete-row', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_detail_material, 0);
	})

	// $(document).on('change', '.qty_material', function (e) {
	// 	if(parseInt($(this).val())>parseInt($(this).closest('tr').find(".qty_request_material").val())) $(this).val(parseFloat($(this).closest('tr').find(".qty_request_material").val()).toFixed(2));
	// 	else $(this).val(parseFloat($(this).val()).toFixed(2));
	// })

	const table_detail_wip = $('#dt_wip');
	$(document).on('click', '.btn-add-row', function (e) {
		const row_template_wip = $('.table-template-wip').find('tbody').html();
		table_detail_wip.find('tbody').append(row_template_wip);

		// $(".input-mask").inputmask();
		renderTableNumber(table_detail_wip, 0);
	});

	$(document).on('click', '.btn-delete-row', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_detail_wip, 0);
	})

	const table_detail_scrap = $('#dt_scrap');
	$(document).on('click', '.btn-add-row', function (e) {
		const row_template_scrap = $('.table-template-scarp').find('tbody').html();
		table_detail_scrap.find('tbody').append(row_template_scrap);

		// $(".input-mask").inputmask();
		renderTableNumber(table_detail_scrap, 0);
	});

	const table_detail_waste = $('#dt_waste');
	$(document).on('click', '.btn-add-row', function (e) {
		const row_template_waste = $('.table-template-waste').find('tbody').html();
		table_detail_waste.find('tbody').append(row_template_waste);

		// $(".input-mask").inputmask();
		renderTableNumber(table_detail_waste, 0);
	});

	$(document).on('click', '.btn-delete-row', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_detail_waste, 0);
	})

	const table_detail_return = $('#dt_return');
	$(document).on('click', '.btn-add-row', function (e) {
		const row_template_return = $('.table-template-return').find('tbody').html();
		table_detail_return.find('tbody').append(row_template_return);

		// $(".input-mask").inputmask();
		renderTableNumber(table_detail_return, 0);
	});

	$(document).on('click', '.btn-delete-row', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_detail_waste, 0);
	})

	const table_detail_loss = $('#dt_loss');
	$(document).on('click', '.btn-add-row', function (e) {
		const row_template_loss = $('.table-template-loss').find('tbody').html();
		table_detail_loss.find('tbody').append(row_template_loss);

		// $(".input-mask").inputmask();
		renderTableNumber(table_detail_loss, 0);
	});

	$(document).on('click', '.btn-delete-row', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_detail_loss, 0);
	})

	$(document).on('click', '.btn-delete-row', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_detail_wip, 0);
	})

	let oTableFg = $('#dt_fg').DataTable({
		"autoWidth" : true,
		"displayLength": 10,
		"ajax": {
			url: _baseurl+"production/realisasi_produksi/viewdtItemFg",
			type: "POST",
		},
		"columns": [
			{ data: "no", searchable: false, className: 'text-center', "width": "1%" },
			{ data: "nama_barang"},
			{ data: "kode_barang", className: 'text-center', "width": "15%"},
			{ data: "uraian_satuan_terkecil", className: 'text-center', "width": "20%"},
			
			{ data: "qty_po", className: 'text-right', "width": "10%"},
			{  render: function (data, type, row) {
				// $a=data.id_detail_po;
				return '<input class="form-control" id="qty_realisasi" name="t_detail_dn[qty_realisasi]" type="text"  value=""  /><input class="form-id_detail_po" id="id_detail_po" name="t_detail_dn[id_detail_po]" type="hidden"  value="' + row.id_detail_po + '"  /><input class="form-id_detail_po" id="id_detail_po" name="t_production[id_detail_dn]" type="hidden"  value="' + row.id_detail_dn + '"  />';
			}},
		],
		"sorting" : [],
		"paginate": false,
		"lengthChange": false,
		"filter": false,
		"sort": false,
		"info": false,
		"columnDefs": [
			{ 'sortable': false, 'targets': [] }
		]
	});		

	function ref(id){	
	$('#dt_wip').DataTable({
		"autoWidth" : true,
		"responsive": true,
		"saveState": true,
		"processing": true,
		"serverSide": true,
		"displayLength": 10,
		"ajax": {
            url: _baseurl+"production/realisasi_produksi/detaildtWip2",
			type: "POST",
			data: {
				'id': id
        },
		},
		"columns": [
            { data: "no", searchable: false, className: 'text-center', "width": "1%" },
            { data: "kode_produksi", className: 'text-center', "width": "20%"},
            { data: "no_job", className: 'text-center', "width": "10%"},
			{ data: "barang"},
			{ data: "kode_barang", className: 'text-right', "width": "10%"},
            { data: "uraian_satuan_terkecil", className: 'text-center'},
            { data: "qty", className: 'text-right', "width": "10%"},
        ],
		"sorting" : [],
		"paginate": false,
		"lengthChange": false,
		"filter": false,
		"sort": false,
		"info": false,
		"columnDefs": [
			{ 'sortable': false, 'targets': [] }
		]
	});		
	}
	$("#t_job_modal").on("hidden.bs.modal", function () {
		var o = {};
		o.id = $('.id_job').val();
		$.ajax({
			url: _baseurl+"production/realisasi_produksi/viewdtItemFg",
			type: "post",
			data: o
		}).done(function (res) {
			oTableFg.clear().draw();
			oTableFg.rows.add(res.aaData).draw();
			$('#dt_material tr').not(function(){ return !!$(this).has('th').length; }).remove();
			$('#dt_wip tr').not(function(){ return !!$(this).has('th').length; }).remove();
			$('#dt_scrap tr').not(function(){ return !!$(this).has('th').length; }).remove();
			$('#dt_waste tr').not(function(){ return !!$(this).has('th').length; }).remove();
			$('#dt_return tr').not(function(){ return !!$(this).has('th').length; }).remove();
			$('#dt_loss tr').not(function(){ return !!$(this).has('th').length; }).remove();
			// console.log(o.id)
			ref(o.id);
		}).fail(function (jqXHR, textStatus, errorThrown) { 
			oTableFg.clear().draw();
		});
	});
});
