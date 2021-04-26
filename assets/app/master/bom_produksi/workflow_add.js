$(document).ready(function(){
	$(".input-mask").inputmask({removeMaskOnSubmit: true});
	$('.select2').select2();

	const table_workflow = $('#table_workflow');

	function addRow(){
		const lastData = table_workflow.find('tbody').find('tr').last();
		let i = 0;
		if (lastData.length > 0) i = lastData.data('index');
		i++;

		let row_template = $('.add_workflow_template').find('tbody').html();
		row_template = replaceAll(row_template, "[x]", "["+i+"]");
		table_workflow.find('tbody').append(row_template);

		let lastElement = table_workflow.find('tbody').find('tr').last();
		lastElement.attr('data-index', i);

		table_workflow.find('.mselect2').select2({dropdownAutoWidth : true});
		initDatepicker($('.x-datepicker'));
		$(".input-mask").inputmask();
		renderTableNumber(table_workflow, 1);
	}

	$(document).on('click', '.btn-add-workflow', function (e) {
		addRow();
	});

	$(document).on('click', '.btn-delete-workflow', function (e) {
		$(this).closest('tr').remove();
		renderTableNumber(table_workflow, 1);
	});

	addRow();
});
