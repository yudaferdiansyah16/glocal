
$(document).ready(function () {
	initDatepicker($('.x-datepicker'));
	$('.select2').select2();

	$(".input-mask").inputmask({
		removeMaskOnSubmit: true,
		autoUnmask: true,
		unmaskAsNumber: true
	});
});
