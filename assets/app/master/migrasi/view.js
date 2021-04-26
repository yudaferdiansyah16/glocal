let oMain, oPrimary, oSecondary;
let arrP = [], arrS = [], arrD = [];

function remove(index) {
	let tr = $('#dtmain tbody tr').eq(index)[0];
	$(tr).hide();

	let data = oMain.row(index).data();

	arrD.push(data.kode_barang);
}

function setPrimary(index) {
	if(arrP.length>0) {

	} else {
		let tr = $('#dtmain tbody tr').eq(index)[0];
		$(tr).hide();

		let data = oMain.row(index).data();

		arrP.push(data.kode_barang);
		oPrimary.row.add(
			[
				data.kode_barang,
				data.nama_barang,
				'<a href="javascript:;" onclick="removePrimary(this, \''+data.kode_barang+'\')" class="btn btn-outline-danger p-1">R</a>'
			]
		).draw();
	}
}

function setSecondary(index) {
	let tr = $('#dtmain tbody tr').eq(index)[0];
	$(tr).hide();

	let data = oMain.row(index).data();

	arrS.push(data.kode_barang);
	oSecondary.row.add(
		[
			data.kode_barang,
			data.nama_barang,
			'<a href="javascript:;" onclick="removeSecondary(this, \''+data.kode_barang+'\')" class="btn btn-outline-danger p-1">R</a>'
		]
	).draw();
}

function removePrimary(e, kode) {
	$(e).closest('tr')[0].remove();
	let data = oMain.rows().data();
	$.each(data, function(i,v){
		if(kode == v.kode_barang){
			let tr = $('#dtmain tbody tr').eq(i)[0];
			$(tr).show();

			$.each(arrP, function(j,k){
				if(k == kode){
					arrP.slice(j,1);
					return false;
				}
			});
			return false;
		}
	});
}

function removeSecondary(e, kode) {
	$(e).closest('tr')[0].remove();
	let data = oMain.rows().data();
	$.each(data, function(i,v){
		if(kode == v.kode_barang){
			let tr = $('#dtmain tbody tr').eq(i)[0];
			$(tr).show();

			$.each(arrS, function(j,k){
				if(k == kode){
					arrS.slice(j,1);
					return false;
				}
			});
			return false;
		}
	});
}

function simpan() {
	let o = {primary: arrP, secondary: arrS, remove: arrD};
	$.post(_baseurl+'master/migrasi/save', o, function(res){
		window.location.reload();
	},'json');
}

$(document).ready(function(){
	oMain = $('#dtmain').DataTable({
		"autoWidth" : true,
		"responsive": false,
		//"scrollX": true,
		"processing": true,
		"serverSide": true,
		"displayLength": 100,
		"paginate": true,
		"lengthChange": false,
		"filter": true,
		"sort": true,
		"info": true,
		"ajax": {
			url: _baseurl+"master/migrasi/viewdt",
			type: "POST",
		},
		"columns": [
			{ data: "kategori" },
			{ data: "asal" },
			{ data: "clas" },
			{ data: "kode_barang" },
			{ data: "nama_barang" },
			{ data: "satuan" },
			{ data: "transaksi" },
			{ data: "blank", orderable: false, searchable: false },
		],
		"sorting" : [[0, 'asc'],[1,'asc'],[2,'asc'],[5,'asc']],
		"createdRow": function( row, data, dataIndex ) {
			let valid = true;
			$.each(arrP, function(i,v){
				if(data.kode_barang == v) {
					valid = false;
					return false;
				}
			});

			$.each(arrS, function(i,v){
				if(data.kode_barang == v) {
					valid = false;
					return false;
				}
			});

			if(!valid) {
				$(row).hide();
				//oMain.rows($(row)).remove();
			}
			else {
				let html = '<a href="javascript:;" onclick="setPrimary('+dataIndex+')" class="btn btn-outline-success p-1">P</a>';
				html += '&nbsp;';
				html += '<a href="javascript:;" onclick="setSecondary('+dataIndex+')" class="btn btn-outline-info p-1">S</a>';
				html += '&nbsp;';
				html += '<a href="javascript:;" onclick="remove('+dataIndex+')" class="btn btn-outline-danger p-1">D</a>';
				$('td', row).eq(7).html(html);

				let kode = '';
				console.log(data);
				if(data.isprimary == 1) kode += '<span class="badge badge-danger">'+data.kode_barang+'</span>';
				else kode += data.kode_barang;
				$('td', row).eq(3).html(kode);
			}
		}
	});

	$('#dtmain_filter input').unbind().bind('keyup', function(e) {
		if (e.keyCode == 13) {
			oMain.search(this.value).draw();
		}
	});

	setTimeout(function(){
		let afterSearch = $('#dtmain_wrapper .mb-3 .col-sm-12')[1];
		console.log(afterSearch);
		$(afterSearch).html('<a href="javascript:;" class="btn btn-primary" onclick="simpan()">Save</a>');
	},500);

	oPrimary = $('#dtprimary').DataTable({
		"autoWidth" : true,
		"responsive": false,
		//"scrollX": true,
		"processing": true,
		//"serverSide": true,
		//"displayLength": 100,
		"paginate": false,
		"lengthChange": false,
		"filter": false,
		"sort": false,
		"info": false,
		/*"ajax": {
			url: _baseurl+"master/mesin/viewdt",
			type: "POST",
		},*/
		/*"columns": [
			{ data: "kode_barang" },
			{ data: "nama_barang" },
			{ data: "option", orderable: false, searchable: false, className: 'text-center' },
		],
		"sorting" : [[0, 'asc']],
		"createdRow": function( row, data, dataIndex ) {
			let html = '<a href="javascript:;" onclick="removePrimary('+data.kode_barang+')" class="btn btn-outline-danger p-1">R</a>';
			$('td', row).eq(2).html(html);
		}*/
	});

	oSecondary = $('#dtsecondary').DataTable({
		"autoWidth" : true,
		"responsive": false,
		//"scrollX": true,
		"processing": true,
		//"serverSide": true,
		//"displayLength": 100,
		"paginate": false,
		"lengthChange": false,
		"filter": false,
		"sort": false,
		"info": true,
		/*"ajax": {
			url: _baseurl+"master/mesin/viewdt",
			type: "POST",
		},
		"columns": [
			{ data: "kode_barang" },
			{ data: "nama_barang" },
			{ data: "option", orderable: false, searchable: false, className: 'text-center' },
		],
		"sorting" : [[0, 'asc']],
		"createdRow": function( row, data, dataIndex ) {
			let html = '<a href="javascript:;" onclick="removeSecondary('+data.kode_barang+')" class="btn btn-outline-danger p-1">R</a>';
			$('td', row).eq(2).html(html);
		}*/
	});

});

