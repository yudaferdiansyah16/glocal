$(document).ready(function () {
    $('.btn_approve').click(function () {
        $(this).prop('disabled', true);
    });

    $("li.active").removeClass('active');
    $('#menu_warehouse').addClass('active');
    $('#menu_warehouse_return_material').addClass('active');
});
