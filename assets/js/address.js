$( document ).ready(function() {
    
    console.log("ready");
    
    $('#regione').on('change', function() {
        var value = $(this).val();
        //$('#regionID').text(value);
        $('#provincia').removeAttr('disabled');
        
        var jSon = jQuery.parseJSON($('#regionID').text());
        console.log(jSon);
    });
    
});