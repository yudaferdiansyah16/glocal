function setValue(column, data){
	let index = '-1';
	switch (column) {
		case 'm_akun':
			$('input[name="m_akun[id_akun]"]').val(data.id_akun);
			$('.nama_akun').val(data.nama_akun);
			break;
		default:
			break;
	}
}

$(document).ready(function(){
	$('.select2').select2();
});


$(document).ready(function(){
	initDatepicker($('.x-datepicker'));
	$(document).on('click', '.btn-delete', function () {
		let tr = $(this).closest('tr');
		tr.find('.deleted_at').val('1');
		tr.hide();
		renderTableNumber(elementTable, 0);
	});
	$(".input-mask").inputmask({removeMaskOnSubmit: true});

	$('.btn-add').on('click', function (e) {
		oTable_t_detail_po_dn.ajax.reload( null, false );
	})
});
