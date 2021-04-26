$(document).ready(function(){
	$('.select2').select2();

	$('.jenis_rutinitas').change(function (e) {
		oTable.ajax.reload().draw();
	});

	let oTable = $('#dt').DataTable({
		"autoWidth" : true,
		"responsive": false,
		//"scrollX": true,
		"searching": false,
		"processing": true,
		"serverSide": true,
		"displayLength": 50,
		"paginate": true,
		"lengthChange": false,
		"filter": true,
		"sort": true,
		"info": true,
		'sortable': false,
		"ajax": {
			url: _baseurl+"procurement/reporting_pr/viewdt",
			type: "POST",
			data: function(data){
				if ($('.jenis_rutinitas').val() != '') data.jenis_rutinitas = $('.jenis_rutinitas').val();
				return data;
			}
		},
		"columns": [
			{ data: "no", className: "text-center", width:"20px", sorting:false},
			{
				data: "kode_pp",
				render: function ( data, type, row ) {
					return "<p style='margin:0;padding:0;'> Nomor : "+row.kode_pp+"</p><small style='margin:0;padding:0;'> Tanggal :"+moment(row.tanggal_dibuat).format('DD-MM-YYYY')+"</small>";
				}
			},
			{ data: "tanggal_dibuat", visible: false },
			{ 
				data: "nama_jenis_pp",
				render: function ( data, type, row ) {
					let val = "";
					val += "<dl class='row'>";
					val += "<dd class='col-sm-4 text-center'>["+row.nama_jenis_pp+"]</dd>";
					val += "<dd class='col-sm-4 text-center'>["+row.nama_jenis_pp_rutinitas+"]</dd>";
					val += "<dd class='col-sm-4 text-center'>["+row.nama_bagian+"]</dd>";
					val += "</dl>";
					return val;
				}
			},
			{ data: "nama_jenis_pp_rutinitas", visible: false  },
			{ data: "nama_bagian", visible: false  },
			{ data: "item" },
			{ data: "qty", className:'text-right' },
			{ data: "status_approve", className: "text-center" },
		],
		"sorting" : [[2, 'desc']],
	});

	$('#dt_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode == 13) {
			oTable.search(this.value).draw();
		}
	});
});
