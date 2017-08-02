function modal_confirm(title, msg, callback)
{
    $('#confirmModalTitle').html(title);
    $('#confirmModalBody').html(msg);
    $('#confirmModalOK').show();
    $('#confirmModal').modal('show');
    $('#confirmModalOK').unbind("click").bind('click', function (){
        $('#confirmModal').modal('hide');
        callback();
    });
};

/*
  * 12345678.9.format(2, 3, '.', ',');  // "12.345.678,90"
  * 123456.789.format(4, 4, ' ', ':');  // "12 3456:7890"
  * 12345678.9.format(0, 3, '-');       // "12-345-679"
 */
function number_format(num, n, x, s, c) {
   var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
       num = num.toFixed(Math.max(0, ~~n));

   return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
};

function format_currency(element) {
    var value = $(element).val();
    value = Number(value.split('.').join(''));
    value = number_format(value, 0, 3, '.');
    $(element).val(value);
}