toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": 300,
    "hideDuration": 100,
    "timeOut": 3000,
    "extendedTimeOut": 1000,
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

function confirmDialog(element){
    let data = $(element).data();
    Swal.fire(
        {
            title: data.header,
            text: data.body,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes"
        }).then(function(result)
    {
        if (result.value)
        {
            window.location = data.url;
        }
    });
}

function changeStatus(e){
    let val, el = $(e);
    let data = el.data();
    if(el.is(':checked')) val = 1;
    else val = 0;
    let o = {[data.key]: data.id, [data.status]: val};

    $.post(data.url, o, function(res){
        if(res.status){
            toastr["success"](res.message, "Success");
            playSound(0);
        } else {
            toastr["error"](res.message, "Error");
            playSound(1);
        }
    });
}

function replaceAll(str, find, replace) {
    while (str.includes(find)) {
        str = str.replace(find, replace);
    }
    return str;
}

function renderTableNumber(element, column){
    element.find('tbody').find('tr:visible').each(function(index) {
        $(this).find('td').eq(column).text((index+1));
    });
}

function initDatepicker(element)
{
    let controls = {
        leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
        rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
    }

    element.datepicker(
        {
            format: 'dd-mm-yyyy',
            setDate: new Date(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: controls,
            autoclose: true
        });
}

function playSound(check){
    switch (check) {
        case 0:
            setTimeout(function(){
                let _play = document.getElementById('playm');
                if(_play !== null) _play.play();
            },500);       
            break;
        case 1:
            setTimeout(function(){
                let _play = document.getElementById('errorwav');
                if(_play !== null) _play.play();
            },500);       
            break;
        default:
            break;
    }
}

function checkExist(e, id, val){
    let arr = e.find(id);
    let exist = false;
    $.each(arr, function(i,v){
        let value = $(v).val();
        if(value ===  val) {
            exist = true
        }
    });
    if(exist) return false;
    else return true;
}

function checkSelected(arrdata, key, val) {
    let checked = false;
    $.each(arrdata,function(i, v){
        checked = false;
        if(v[key] === val) {
            checked = true;
            return false;
        }
    });
    return checked;
}

function checkedRow(e){
    //console.log(e);
}

function dtRedrawHead(t){
    setTimeout(function(){
        //$.fn.dataTable.tables( { visible: true, api: true } ).columns.adjust();

        let body = $('#dt_'+t+'_wrapper .dataTables_scrollBody thead th');
        let head = $('#dt_'+t+'_wrapper .dataTables_scrollHead thead th');
        $.each(body, function(i,v){
            let w = Math.ceil(parseFloat($(v).width()));
            //$(head[i]).width(w)
            //console.log(w);
            //console.log($(head[i]).width(w));
        });
        /* */
    },100);
}

function renderCheck(arrdata, key, val, row, col, dataIndex){
    if(checkSelected(arrdata, key, val)) {
        $('td', row).eq(col).html('<div class="custom-control custom-checkbox custom-control-inline x-check-modal"><input type="checkbox" class="custom-control-input x-check-input"  onclick="checkedRow(this)"  id="havingchild['+dataIndex+']" checked><label class="custom-control-label" for="havingchild['+dataIndex+']"></label></div>');
        $(row).toggleClass('selected');
    } else {
        $('td', row).eq(col).html('<div class="custom-control custom-checkbox custom-control-inline x-check-modal"><input type="checkbox" class="custom-control-input x-check-input" onclick="checkedRow(this)" id="havingchild['+dataIndex+']"><label class="custom-control-label" for="havingchild['+dataIndex+']"></label></div>');
    }
}

function dtFilterOnEnter(dt, t){
    $('#dt_'+t+'_filter input').unbind().bind('keyup', function(e) {
        if (e.keyCode === 13) {
            dt.search(this.value).draw();
        }
    });
}

function listenOnRowClick(dt, t, arr, key){
    $('#dt_'+t+' tbody').on( 'click', 'tr', function (e) {
        let checkbox = $($(this).find('.custom-control-input')[0]);
        let data = dt.row($(this)).data();
        if(checkbox.is(':checked')) checkbox.prop('checked', false);
        else checkbox.prop('checked', true);
        $(this).toggleClass('selected');
        arrdata_job_pp = selectArray(arrdata_job_pp, data, key);
    });
}

function selectArray(arrdata, arr, key, inputCheck = false, checked = false){
    let remove = false;
    let index;
    $.each(arrdata,function(i, v){
        if(v[key] === arr[key]) {
            remove = true;
            index = i;
            return false;
        }
    });
    if(remove) arrdata.splice(index, 1);
    else arrdata.push(arr);
    return arrdata;
}

function selectRow(arrdata, row, data, key, checked = false){
    row.toggleClass('selected');
    return selectArray(arrdata, data, key, true, checked);
}

function deleteAttach(arrdata, val, key){
    $.each(arrdata, function(i,v){
        if(v[key] == val){
            arrdata.splice(i,1);
            return false;
        }
    });
    return arrdata
}

function dataCheckSelectedOnRow(e, dt){
    //console.log('checked row');
    let checkbox = $($(e).find('.custom-control-input')[0]);
    let data = dt.row($(e)).data();
    if(checkbox.is(':checked')) checkbox.prop('checked', false);
    else checkbox.prop('checked', true);
    $(e).toggleClass('selected');
    return data;
}

function listenShownModal(dt, t){
    $('#'+t+'_modal').on('shown.bs.modal', function () {
        dt.draw();
    });
}

function listenAttach(e, arr, t, attach){
    $('#'+e).on('click', function () {
        attach(arr, t);
        hideModal(t);
    });
}

function listenKeyInput(dt, t){
    let element = $('#dt_'+t);
    element.on('key-focus.dt', function(e, datatable, cell){
        $(dt.row(cell.index().row).node()).addClass('selected');
    }).on('key-blur.dt', function(e, datatable, cell){
        $(dt.row(cell.index().row).node()).removeClass('selected');
    });
}

function singleAttach(t, key, dt, c){
    if(key){
        setValue(t, dt.row(c.index().row).data());
    } else {
        setValue(t, dt.row(c).data());
    }
    hideModal(t);
}

function kemasanAttach(t, key, dt, c){
    if(key){
        setKemasan(dt.row(c.index().row).data());
    } else {
        setKemasan(dt.row(c).data());
    }
    hideModal(t);
}

function hideModal(t){
    $('#'+t+"_modal").modal('hide');
}

function reqSession(){
    $.get(_baseurl+'api/keepSession', function(res){
        console.log(res);
    })
}
function keepSession() {
    setInterval(reqSession, 120000);
}

function formatCurrency( data, digit ){
	return accounting.formatMoney(data, "", digit);
}

function formatQuantity(data) {
	return (data.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
}
/*
function renderDetailTable(elTable, template, tags, data){
    elTable.find('tbody').empty();
    for (let j = 0; j < data.length; j++) {
        const row = data[j];
        const lastData = elTable.find('tbody').find('tr').last();
        let i = 0;
        if (lastData.length > 0) i = lastData.data('index');
        i++;

        let template_row = $('#'+template).find('tbody').html();
        template_row = replaceAll(template_row, "[x]", "["+i+"]");
        elTable.find('tbody').append(template_row);

        let lastElement = elTable.find('tbody').find('tr').last();
        lastElement.attr('data-index', i);
        $.each(tags, function(i,v){
            setElementValue(lastElement, v, row);
            //if(v.tag === 'input' && row[v.class] != undefined) lastElement.find('.'+v.class).val(row[v.class]);
        });
        lastElement.find('.id_satuan').empty();
        lastElement.find('.id_satuan').append("<option value='" + row.id_satuan_terbesar + "' selected>" + row.kode_satuan_terbesar + "</option>");
        if (row.id_satuan_terbesar != row.id_satuan_terkecil && row.id_satuan_terkecil != null) lastElement.find('.id_satuan').append("<option value='" + row.id_satuan_terkecil + "'>" + row.kode_satuan_terkecil + "</option>");
    }
}

function setElementValue(el, t, c, v){
    if(t === 'input'){
        if( v !== 'undefined') el.find(c).val(v);
    }
}*/

const DataTableOptionsModal = {
    autoWidth : false,
    responsive: false,
    saveState: true,
    processing: true,
    serverSide: true,
    displayLength: 10,
    paginate: true,
    lengthChange: false,
    filter: true,
    sort: true,
    info: true,
};

$(document).ready(function(){
    if(_alert !== null){
        if(_alert.status){
            toastr["success"](_alert.message, "Success");
            playSound(0);
        } else {
            toastr["error"](_alert.message, "Error");
            playSound(1);
        }
    }
});
