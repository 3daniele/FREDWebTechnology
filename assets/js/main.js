
// funzione per la valutazione
$(function () {
    var star = '.star',
        selected = '.selected';

    $(star).on('click', function () {
        $(selected).each(function () {
            $(this).removeClass('selected');
        });
        $(this).addClass('selected');
        var value = this.value;
        $("#starValue").attr('value', value);
    });
});
