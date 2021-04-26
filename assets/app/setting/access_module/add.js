$(document).ready(function () {
	$(".select2").select2();
	$("#modul").select2({
		placeholder: 'Select Modul . . .',
        allowClear: true
	});
	$("li.active").removeClass("active");
	$("#menu_setting").addClass("active");
	$("#menu_setting_access_module").addClass("active");
});
