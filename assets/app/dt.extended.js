function renderDTDate( data, type, row ){
    return (data != '' && data != null) ? moment(data).format('DD-MM-YYYY') : '';
}

function renderWeight( data, type, row ){

}

function renderMoney( data, type, row ){
	return accounting.formatMoney(data, "", 2);
}

function renderQuantity( data, type, row ){
	return accounting.formatMoney(data, "", 3);
}

function combine(top, bottom) {
	return "<div>"+top+"<br><span style='font-size: 10px'>"+bottom+"</span></div>";
}
