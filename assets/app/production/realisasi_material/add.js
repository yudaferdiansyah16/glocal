function formatBom (option) {
	if (!option.id) { return option.text; }
	return '<div>'+option.nama_barang + ', Size: ' + option.size +'<br><span style="font-size: 10px">Order: #'+option.po_buyer+', Customer: '+ option.nama_supplier +'</span></div>';
}

$(document).ready(function(){
	initDatepicker($('.x-datepicker'));
	$('.id_bom').select2({
		minimumInputLength: 3,
		ajax: {
			dataType: "json",
			method: 'POST',
			url: _baseurl + "master/bom_produksi/select2",
			delay: 300,
			processResults: function (data) {
				return {
					results: data.map(function (item) {
						item.id = item.id_bom;
						item.text = item.nama_barang + ", Size: " + item.size;
						return item;
					})
				};
			},
		},
		escapeMarkup: function (m) {
			return m;
		},
		templateResult: formatBom,
	}).on('select2:select', function(e){
		console.log(e.params.data);
		$('.nama_supplier').val(e.params.data.nama_supplier);
		$('.po_buyer').val(e.params.data.po_buyer);
		$('.nama_barang').val(e.params.data.nama_barang);
	});

	$('.id_bom_workflow').select2({
		minimumInputLength: 3,
		ajax: {
			dataType: "json",
			method: 'POST',
			url: _baseurl + "master/bom_workflow/select2",
			delay: 300,
			data: function (params) {
				params.id_bom = $('.id_bom').val();
				return params;
			},
			processResults: function (data) {
				return {
					results: data.map(function (item) {
						item.id = item.id_bom_workflow;
						item.text = item.nama_workflow + " - " + item.nama_part;
						return item;
					})
				};
			},
		}
	}).on('select2:select', function(e){
		console.log(e.params.data);
		$('.nama_workflow').val(e.params.data.nama_workflow);
		$('.nama_part').val(e.params.data.nama_part);
	});

	$('#t_stock_request_modal').on('show.bs.modal', function (e) {
		return e.preventDefault();
	});
});
