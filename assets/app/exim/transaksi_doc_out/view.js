let valuta, harga, oTable;

function reloadDT(c) {
    let close = c + "close";
    let cal = c + "cal";
    $('.' + cal).hide();
    $('.' + close).show();
    oTable.ajax.reload(null, false);
}

function removeFilter(c) {
    let close = c + "close";
    let cal = c + "cal";
    $('.' + cal).show();
    $('.' + close).hide();
    $('.' + c).val('');
    oTable.ajax.reload(null, false);
}

(function($) {
	var S2MultiCheckboxes = function(options, element) {
	  var self = this;
	  self.options = options;
	  self.$element = $(element);
	  var values = self.$element.val();
	  self.$element.removeAttr('multiple');
	  self.select2 = self.$element.select2({
		allowClear: true,
		minimumResultsForSearch: options.minimumResultsForSearch,
		placeholder: options.placeholder,
		closeOnSelect: false,
		templateSelection: function() {
		  return self.options.templateSelection(self.$element.val() || [], $('option', self.$element).length);
		},
		templateResult: function(result) {
		  if (result.loading !== undefined)
			return result.text;
		  return $('<div>').text(result.text).addClass(self.options.wrapClass);
		},
		matcher: function(params, data) {
		  var original_matcher = $.fn.select2.defaults.defaults.matcher;
		  var result = original_matcher(params, data);
		  if (result && self.options.searchMatchOptGroups && data.children && result.children && data.children.length != result.children.length) {
			result.children = data.children;
		  }
		  return result;
		}
	  }).data('select2');
	  self.select2.$results.off("mouseup").on("mouseup", ".select2-results__option[aria-selected]", (function(self) {
		return function(evt) {
		  var $this = $(this);
	  
	  const Utils = $.fn.select2.amd.require('select2/utils')
		  var data = Utils.GetData(this, 'data');
  
		  if ($this.attr('aria-selected') === 'true') {
			self.trigger('unselect', {
			  originalEvent: evt,
			  data: data
			});
			return;
		  }
  
		  self.trigger('select', {
			originalEvent: evt,
			data: data
		  });
		}
	  })(self.select2));
	  self.$element.attr('multiple', 'multiple').val(values).trigger('change.select2');
	}
  
	$.fn.extend({
	  select2MultiCheckboxes: function() {
		var options = $.extend({
		  placeholder: 'Choose elements',
		  templateSelection: function(selected, total) {
			return selected.length + ' > ' + total + ' total';
		  },
		  wrapClass: 'wrap',
		  minimumResultsForSearch: -1,
		  searchMatchOptGroups: true
		}, arguments[0]);
  
		this.each(function() {
		  new S2MultiCheckboxes(options, this);
		});
	  }
	});
  })(jQuery);

  function formatState (state) {
	if (!state.id) {
	  return state.text;
	}

	var $state = $(
	  '<input type="checkbox" id="" name="" value="">'
	);
	return $state;
  };
  

$(document).ready(function() {
	$('#dokumenbc').val(["25", "261", "41", "27"]);
	initDatepicker($('.x-datepicker'));
	$('.select2').select2();
	$('#dokumenbc').on('change', function(e) {
			oTable.ajax.reload(null, false);
	});


    oTable = $('#dt').DataTable({
        "autoWidth": true,
        "responsive": false,
        //"scrollX": true,
        "processing": true,
        "serverSide": true,
        "displayLength": 10,
        "paginate": true,
        "lengthChange": false,
        "filter": true,
        "sort": true,
        "info": true,
        "ajax": {
            url: _baseurl + "exim/transaksi_doc_out/viewdt",
            type: "POST",
            data: function(data) {
                if ($('.tglajuawal').val() != '') data.tglajuawal = $('.tglajuawal').val();
                if ($('.tglajuakhir').val() != '') data.tglajuakhir = $('.tglajuakhir').val();
                if ($('.dokumenbc').val() != '') data.dokumenbc = $('.dokumenbc').val();
								if ($('.coaid').val() != '') data.coaid= $('.coaid').val();
                return data;
            
            }
        },
        "columns": [
          { data: "no", searchable: false, className: 'text-center' },
            {
                data: "NOMOR_AJU",
                render: function(data, type, row) {
                    return "<p style='margin:0;padding:0;'> Tanggal Daftar : " + row.TANGGAL_DAFTAR + "</p><small style='margin:0;padding:0;'> Tanggal Aju :" + row.TANGGAL_AJU + "</small>";
                }
            },
            {
                data: "NOMOR_DAFTAR",
                render: function(data, type, row) {
                    return "<p style='margin:0;padding:0;'> Nomor Daftar : " + row.NOMOR_DAFTAR + "</p><small style='margin:0;padding:0;'> Nomor Aju : " + row.NOMOR_AJU + "</small>";
                }
            },
            { data: "URAIAN_DOKUMEN_PABEAN", className: 'text-center' },
	  		{ data: "NAMA_PENGIRIM", className: 'text-center' },
            { data: "KODE_VALUTA", className: 'text-center' },
            {
                data: "HARGA_DOCIN",
                className: 'text-right',
                render: function(data, type, row) {
                    return formatCurrency(Number(row.HARGA_DOCIN));
                }
            },
	    { data: "CIF", className: 'text-center' },
            { data: "option", searchable: false, className: 'text-center' },
        ],
        "sorting": [
            [2, 'desc']
        ],
        "columnDefs": [
            { 'sortable': false, 'targets': [0, -1] }
        ]
    });

    $('#dt_filter input').unbind().bind('keyup', function(e) {
        if (e.keyCode == 13) {
            oTable.search(this.value).draw();
        }
    });
});
