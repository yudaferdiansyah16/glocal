function setValue(column, data){
	let index = '-1';
	switch (column) {
		case 't_dn_receive':
			let elementTable = $('#dt')
			$('.id_dn').val(data.id_dn);
			$('.kode_dn').val(data.kode_dn);
			$('.no_faktur').val(data.no_faktur);
			$('.no_invoice').val(data.no_invoice);
			$('.nama_supplier').val(data.nama_supplier);
			$('.id_header').val(data.id_header);
			$('.nomor_aju').val(data.nomor_aju);
			$('.nomor_daftar').val(data.nomor_daftar);
			if(data.tgl_faktur!=='' && data.tgl_faktur!==null) $('.tgl_faktur').val(moment(data.tgl_faktur).format('DD-MM-YYYY'));
			if(data.tgl_invoice!='' && data.tgl_invoice!==null) $('.tgl_invoice').val(moment(data.tgl_invoice).format('DD-MM-YYYY'));
			if(data.tanggal_aju!='' && data.tanggal_aju!==null) $('.tanggal_aju').val(moment(data.tanggal_aju).format('DD-MM-YYYY'));
			if(data.tanggal_daftar!='' && data.tanggal_daftar!==null) $('.tanggal_daftar').val(moment(data.tanggal_daftar).format('DD-MM-YYYY'));
			$.ajax({
				type: 'GET',
				url: _baseurl+"procurement/delivery_note_po/detailjson/"+data.id_dn,
				dataType: 'json',
				success: function (response) {
					const detail_dn = response;
					elementTable.find('tbody').empty();
					for (let j = 0; j < detail_dn.length; j++) {
						const row = detail_dn[j];

						const lastData = elementTable.find('tbody').find('tr').last();
						let i = 0;
						if (lastData.length > 0) i = lastData.data('index');
						i++;

						let template_row = $('#template-row').find('tbody').html();
						template_row = replaceAll(template_row, "[x]", "["+i+"]");
						elementTable.find('tbody').append(template_row);
						let lastElement = elementTable.find('tbody').find('tr').last();
						lastElement.attr('data-index', i);
						lastElement.find('.id_detail_po').val(row.id_detail_po);
						lastElement.find('.id_detail_dn').val(row.id_detail_dn);
						lastElement.find('.label_harga').text(formatCurrency(parseFloat(row.harga)));
						lastElement.find('.harga_satuan').val(parseFloat(row.harga));
						lastElement.find('.rate').val(row.rate);
						lastElement.find('.kode_valuta').text(row.kode_valuta);
						lastElement.find('.seri_barang').val(row.seri_barang);
						lastElement.find('.id_sub_barang').val(row.id_sub_barang);
						lastElement.find('.id_job').val(row.id_job);
						lastElement.find('.no_job').text(row.no_job);
						lastElement.find('.tanggal_job').text(row.tanggal_job != '' ? moment(row.tanggal_job).format('DD-MM-YYYY') : '-');
						lastElement.find('.kode_po').text(row.kode_po);
						lastElement.find('.tanggal_dibuat').text(row.tgl_po != '' ? moment(row.tgl_po).format('DD-MM-YYYY') : '-');
						lastElement.find('.no_sj').text(row.no_sj);
						lastElement.find('.tanggal_sj').text(row.tanggal_sj != '' && row.tanggal_sj != null ? moment(row.tanggal_sj).format('DD-MM-YYYY') : '-');
						lastElement.find('.tanggal_dibuat').text(row.tanggal_dibuat);
						lastElement.find('.kode_barang').text(row.kode_barang);
						lastElement.find('.nama_sub_barang').text(row.nama_barang);
						lastElement.find('.kode_satuan').text(row.kode_satuan);
						lastElement.find('.qty_dn').text(formatCurrency(parseFloat(row.qty_dn)));
						lastElement.find('.qty').val(row.qty_dn);
						lastElement.find('.id_satuan_terkecil').val(row.id_satuan);
						lastElement.find('.id_satuan_terbesar').val(row.id_satuan);
						lastElement.find('.qty_return').val(row.qty_dn - row.qty_dn);
						lastElement.find(".select2").select2();
						i++;
					}
					$(".input-mask").inputmask({removeMaskOnSubmit: true});
					renderTableNumber(elementTable, 0);
				}
			});
			break;
		default:
			break;
	}
}

function replaceAll(str, find, replace) {
	while (str.includes(find)) {
		str = str.replace(find, replace);
	}
	return str;
}

$(document).ready(function(){
	initDatepicker($('.x-datepicker'));
	$('.select2').select2();
	$(document).on('change', '.qty', function (e) {
		const qty = parseFloat($(this).val());
		const qty_dn = parseFloat($('.qty_dn').text());
		const qty_return = qty_dn - qty;
		$(this).closest('tr').find('.qty_return').val(qty_return);
	});
});
