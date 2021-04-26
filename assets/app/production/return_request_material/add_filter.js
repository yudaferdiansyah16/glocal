function setValue(column, data){
	switch (column) {
		case 'return_request':
			//console.log(data);
			$('.kode_production_filter').val(data.kode_mutasi);
			$('.id_production_filter').val(data.id_production);
			break;
		default:
			break;
	}
}
