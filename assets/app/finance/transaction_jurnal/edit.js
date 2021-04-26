let elementTable = $("#dt");
let currentRow = null;
let amountBalance = 0;
let oTable;
let deleted_finance_detail = [];

function initItemSelect2(lastElement) {
    lastElement.find('.id_akun').select2({
        minimumInputLength: 0,
        ajax: {
            dataType: "json",
            method: 'POST',
            url: _baseurl + "master/akun/select2",
            delay: 300,
            processResults: function(data) {
                return {
                    results: data.map(function(item) {
                        item.id = item.id_akun;
                        item.text = "[" + item.kode_akun + "]" + " " + item.nama_akun;
                        return item;
                    })
                };
            },
        },
        escapeMarkup: function(m) {
            return m;
        }
    });
}

function setValue(column, data) {
    let index = "-1";
    switch (column) {
        case "referensi_valuta":
            $('input[name="t_finance[id_valuta]"]').val(data.ID);
            $(".nama_valuta").val(data.KODE_VALUTA);
            $('input[name="t_finance[rate]"]').val(data.rates_jual);
            break;
        case "m_akun":
            currentRow.find(".id_akun").val(data.id_akun);
            currentRow
                .find(".nama_akun")
                .val(data.kode_akun + " - " + data.nama_akun);
            break;
        default:
            break;
    }
}

function renderSummary() {
    amountBalance = 0;
    let grand_amount = 0;
    let rate = parseFloat($(".rate").inputmask("unmaskedvalue") || 0);
    elementTable
        .find("tbody")
        .find("tr")
        .each(function(e) {
            let row = $(this);
            const position = row.find("input[type=radio]:checked").val();
            let amount = parseFloat(
                row.find(".amount").inputmask("unmaskedvalue") || 0
            );
            let jumlah_rp = rate * amount;
            row.find(".jumlah_rp").val(jumlah_rp);

            grand_amount += position == "debet" ? amount : 0;
            amountBalance += amount * (position == "credit" ? -1 : 1);
        });
    $(".grand_amount").text(formatCurrency(grand_amount, 2));
    if (amountBalance != 0) {
        $(".balance_status").html(
            " <b>(Not Balance: " + formatCurrency(amountBalance, 2) + ")</b>"
        );
        $("#simpan").attr("disabled", true);

    } else {
        $("#simpan").removeAttr("disabled");
        $(".balance_status").html("");
    }
}

$(document).ready(function() {
    $(".rate").inputmask({ removeMaskOnSubmit: true });
    initDatepicker($(".x-datepicker"));
    $('.select2').select2({ width: 'resolve' });
    $(".input-mask").inputmask({ removeMaskOnSubmit: true }).on('focus', function() {
        $(this).select();
    });

    $(".btn-add").on("click", function(e) {
        const lastData = elementTable.find("tbody").find("tr").last();
        let i = 0;
        if (lastData.length > 0) i = lastData.data("index");
        i++;

        let template_row = $("#template-row").find("tbody").html();
        template_row = replaceAll(template_row, "[x]", "[" + i + "]");
        elementTable.find("tbody").append(template_row);
        let el = elementTable.find("tbody").find("tr").last();

        el.attr("data-index", i);
        el.find(".amount").inputmask({ removeMaskOnSubmit: true });
        initItemSelect2(el);

        let prefix = "";
        let suffix = "";
        if (amountBalance > 0) {
            prefix = "(";
            suffix = ")";
            el.find("input[type=radio]")
                .filter('[value="credit"]')
                .attr("checked", true);
        } else {
            el.find("input[type=radio]")
                .filter('[value="debet"]')
                .attr("checked", true);
        }

        el.find(".amount").attr(
            "data-inputmask",
            "'alias': 'currency', 'prefix': '" +
            prefix +
            "', 'suffix': '" +
            suffix +
            "', 'allowMinus': false"
        );
        el.find(".amount").inputmask({ removeMaskOnSubmit: true });
        el.find(".amount").inputmask("setvalue", Math.abs(amountBalance));

        renderTableNumber(elementTable, 0);
        renderSummary();
    });

    $(document).on("click", ".btn-search-akun", function(e) {
        currentRow = $(this).closest("tr");
    });

    $(document).on("change", ".position", function(e) {
        currentRow = $(this).closest("tr");
        let prefix = "";
        let suffix = "";
        let position = $(this).val();
        if (position == "credit") {
            prefix = "(";
            suffix = ")";
        }
        currentRow
            .find(".amount")
            .attr(
                "data-inputmask",
                "'alias': 'currency', 'prefix': '" +
                prefix +
                "', 'suffix': '" +
                suffix +
                "', 'allowMinus': false"
            );
        currentRow.find(".amount").inputmask({ removeMaskOnSubmit: true });
        renderSummary();
    });
    $('.id_valuta').select2({
        placeholder: 'Find Currency',
        ajax: {
            dataType: "json",
            method: 'POST',
            url: _baseurl + "referensi/valuta/select2",
            delay: 300,
            processResults: function(data) {
                return {
                    results: data.map(function(item) {
                        item.id = item.ID;
                        item.text = item.KODE_VALUTA + ' - ' + item.URAIAN_VALUTA;
                        return item;
                    })
                };
                
            },
        },
        escapeMarkup: function(m) {
            return m;
        }
    }).on('select2:select', function(e) {});

    $(document).on('click', '.btn-delete-row', function (e) {
        e.preventDefault();
        let tr = $(this).closest('tr');
        const id_finance_detail = tr.find('.id_finance_detail')[0].value;
        deleted_finance_detail.push(id_finance_detail);
        $('#deleted_finance_detail').val(JSON.stringify(deleted_finance_detail));
        tr.remove();
        renderSummary();
    })

    $(document).on("change", ".amount", function(e) {
        renderSummary();
    });

    $(document).on("change", ".rate", function(e) {
        renderSummary();
    });

    $(document).on("keydown", ".x-readonly", function(e) {
        e.preventDefault();
    });

    renderSummary();
    initItemSelect2($("#dt"))
});