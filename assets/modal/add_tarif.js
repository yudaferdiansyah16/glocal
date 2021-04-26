$(document).ready(function(){
	$('#btn-attach-tarif').on('click', function () {
		let dataTarif = [];
		dataTarif.push(document.getElementById('bm_ditangguhkan').value);
		dataTarif.push(document.getElementById('bm_dibebaskan').value);
		dataTarif.push(document.getElementById('bm_tidak_dipungut').value);
		dataTarif.push(document.getElementById('bmt_ditangguhkan').value);
		dataTarif.push(document.getElementById('bmt_dibebaskan').value);
		dataTarif.push(document.getElementById('bmt_tidak_dipungut').value);
		dataTarif.push(document.getElementById('cukai_ditangguhkan').value);
		dataTarif.push(document.getElementById('cukai_dibebaskan').value);
		dataTarif.push(document.getElementById('cukai_tidak_dipungut').value);
		dataTarif.push(document.getElementById('ppn_ditangguhkan').value);
		dataTarif.push(document.getElementById('ppn_dibebaskan').value);
		dataTarif.push(document.getElementById('ppn_tidak_dipungut').value);
		dataTarif.push(document.getElementById('ppnbm_ditangguhkan').value);
		dataTarif.push(document.getElementById('ppnbm_dibebaskan').value);
		dataTarif.push(document.getElementById('ppnbm_tidak_dipungut').value);
		dataTarif.push(document.getElementById('pph_ditangguhkan').value);
		dataTarif.push(document.getElementById('pph_dibebaskan').value);
		dataTarif.push(document.getElementById('pph_tidak_dipungut').value);
		setTarif(dataTarif,tarif_index, harga);
		$('#add_tarif_modal').modal('hide');
	});
});
