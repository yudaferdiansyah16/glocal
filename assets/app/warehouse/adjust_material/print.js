$(document).ready(function(){
	let kode_bom = $('#kode_qrcode').val();
	$('#qrcode').qrcode({
		width:60,
		height:60,
		text:kode_bom
	});
        
        $("li.active").removeClass('active');
	$('#menu_warehouse').addClass('active');
	$('#menu_warehouse_adjust_material').addClass('active');
});
