let elementTable = $('#dt');
let currentRow = null;

function renderSummary() {
	let grand_amount = kasbonheader;
	elementTable.find('tbody').find('tr').each(function (e) {
		let row = $(this);
		let jumlah = parseFloat(row.find('.jumlah').inputmask('unmaskedvalue') || 0);
		let jumlah_total = jumlah;
		row.find('.jumlah_total').val(jumlah_total);
		grand_amount += jumlah;
	});
	$('.grand_amount').text(formatCurrency(grand_amount, 2));
	$('.hgrand_amount').val(grand_amount);
}

$(document).ready(function(){
	$('.btn-add').on('click', function (e) {
		const lastData = elementTable.find('tbody').find('tr').last();
		let i = 0;
		if (lastData.length > 0) i = lastData.data('index');
		i++;

		let template_row = $('#template-row').find('tbody').html();
		template_row = replaceAll(template_row, "[x]", "["+i+"]");
		elementTable.find('tbody').append(template_row);
		let el = elementTable.find('tbody').find('tr').last();
		el.attr('data-index', i);
		el.find(".jumlah").inputmask({removeMaskOnSubmit: true});

		renderTableNumber(elementTable, 0);
		renderSummary();
	});

	$(document).on('click', '.btn-delete-row', function (e) {
		$(this).closest('tr').remove();
		renderSummary();
	});

	$(document).on('change', '.jumlah', function (e) {
		renderSummary();
	});

	$(document).on('keydown', '.x-readonly', function (e) {
		e.preventDefault();
	});

	renderSummary();

    let oTable = $('#dt').DataTable({
		"autoWidth" : true,
		"responsive": false,
		//"scrollX": true,
		"processing": true,
		"serverSide": true,
		"paginate": false,
		"lengthChange": false,
		"filter": true,
		"sort": true,
		"info": false,
		"ajax": {
			url: _baseurl+"finance/realisasi/detaildt/"+idkasbon,
			type: "POST"
		},
		"columns": [
			{ data: "no", className: 'text-center' },
			{ data: "keterangan" },
			{ data: "jumlah", className: 'text-right' },
			{ data: null, defaultContent: "&nbsp;", width: '1%'}
		],
		"sorting" : [],
		"columnDefs": [
			{ 'sortable': false, 'targets': [0, 3] }
		]
	});

	$('#dt_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode == 13) {
			oTable.search(this.value).draw();
		}
	});
});