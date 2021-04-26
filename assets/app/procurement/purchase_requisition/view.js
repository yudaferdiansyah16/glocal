let oTable;

function reloadDT(c) {
	let close = c+"close";
	if(c=='tglawal' || c=='tglakhir'){
		let cal = c+"cal";
		$('.'+cal).hide();
	} else {
		$('.'+c+'div').hide();
	}
	$('.'+close).show();
	oTable.ajax.reload( null, false );
}

function removeFilter(c) {
	let close = c+"close";
	if(c=='tglawal' || c=='tglakhir'){
		let cal = c+"cal";
		$('.'+cal).show();
	} else {
		let opt = c+"opt";
		$('.'+c+'select2').find('option').attr("selected",false) ;
		$('#'+c+'opt').attr("selected");
	}
	$('.'+close).hide();
	$('.'+c).val('');
	oTable.ajax.reload( null, false );
}

$(document).ready(function(){
	initDatepicker($('.x-datepicker'));
	oTable = $('#dt').DataTable({
		"autoWidth" : true,
		"responsive": false,
		//"scrollX": true,
		"processing": true,
		"serverSide": true,
		"displayLength": 10,
		"paginate": true,
		"lengthChange": false,
		"filter": true,
		"sort": true,
		"info": true,
		"ajax": {
			url: _baseurl+"procurement/purchase_requisition/viewdt",
			type: "POST",
			data: function(data){
				if ($('.tglawal').val() != '') data.tglawal = $('.tglawal').val();
				if ($('.tglakhir').val() != '') data.tglakhir = $('.tglakhir').val();
				// if ($('.bagian').val() != '') data.bagian = $('.bagian').val();
				// if ($('.jenispp').val() != '') data.jenispp = $('.jenispp').val();
				// if ($('.rutinitaspp').val() != '') data.rutinitaspp = $('.rutinitaspp').val();
				return data;
			}
		},
		"columns": [
			{ data: "no", searchable:false },
			{ data: "kode_pp" },
			{ data: "tanggal_dibuat","render":renderDTDate },
			{ data: "tanggal_dibutuhkan","render":renderDTDate },
			{ data: "nama_bagian" },
			{ data: "nama_jenis_pp" },
			{ data: "nama_jenis_pp_rutinitas" },
			{ data: "status_approve", className: 'text-center', searchable: false, sortable: false },
			{ data: "option", className: 'text-center', searchable: false, sortable: false },
		],
		"sorting" : [[1, 'desc']],
		"columnDefs": [
			{ 'sortable': false, 'targets': [0,-1,-2] }
		]
	});

	$('#dt_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode == 13) {
			oTable.search(this.value).draw();
		}
	});
});
