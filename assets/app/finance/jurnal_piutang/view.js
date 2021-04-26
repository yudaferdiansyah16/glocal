function setValue(column, data){
    let index = '-1';
    switch (column) {
        case 'm_customer':
            $('input[name="m_customer[id_customer]"]').val(data.id_customer);
            $('.nama').val(data.nama);
            break;
        default:
            break;
    }
}

function isValidDate(dateString) {
  let regEx = /^(\d{1,2})-(\d{1,2})-(\d{4})$/;
  return dateString.match(regEx) != null;
}

$(document).ready(function(){
    $('.select2').select2();
    $(".rate").inputmask({removeMaskOnSubmit: true});

    let oTable = $('#dt').DataTable({
        "autoWidth": true,
        "responsive": false,
        "processing": true,
        "serverSide": false,
        "paginate": false,
        "lengthChange": false,
        "filter": false,
        "sort": false,
        "info": true
    });

    initDatepicker($('.x-datepicker'));

    $(".input-mask").inputmask({removeMaskOnSubmit: true});

    $('#select-all').click(function(e){
        let table = $(e.target).closest('table');
        $('th input:checkbox', table).attr('checked', e.target.checked);
    });

    if($(".check:checked").length == 0) {
        $("#btnSave").prop('disabled', true);
    }
    $("td input:checkbox").on("click",function(){
        if($(".check:checked").length == 0) {
            $("#btnSave").prop('disabled', true);
        }else{
            $("#btnSave").prop('disabled', false);
        }
    });

    $(".check").on("click", function (e) {
        let ch = $(":checked");
        let parentRow;
        let cellInvoice;
        let cellDateInvoice;
        ch.each(function () {
            parentRow = $(e.target).closest('tr');
            cellInvoice = $(parentRow).find('.no_invoice');
            cellDateInvoice = $(parentRow).find('.tgl_invoice');
            if (cellInvoice.val() === '') {
                $('td input:checkbox', parentRow).prop('checked', false);
                alert('No. Invoice Harus Diisi');
                if($(".check:checked").length == 0) {
                    $("#btnSave").prop('disabled', true);
                }
                $(cellInvoice).change(function() {
                    if(cellInvoice.val() === ''){
                        $('td input:checkbox', parentRow).prop('checked', false);
                    }
                    if($(".check:checked").length == 0) {
                        $("#btnSave").prop('disabled', true);
                    }
                });
            } else if(cellDateInvoice.val() === '-' || cellDateInvoice.val() === '') {
                $('td input:checkbox', parentRow).prop('checked', false);
                alert('Tanggal Invoice Harus Diisi');
                if($(".check:checked").length == 0) {
                    $("#btnSave").prop('disabled', true);
                }
            } else if(!isValidDate(cellDateInvoice.val())) {
                $('td input:checkbox', parentRow).prop('checked', false);
                alert('Format Tanggal Invoice Salah');
                if($(".check:checked").length == 0) {
                    $("#btnSave").prop('disabled', true);
                }
            }
        });
    });
});