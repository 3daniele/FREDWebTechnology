$( document ).ready(function() {
    
    $('#regione').on('change', function() {
        var value = $(this).val();
        alert(value);
    });
});