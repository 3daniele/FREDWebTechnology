$( document ).ready(function() {
    
    console.log("ready");

    var provinces = jQuery.parseJSON($('#provinces').text());
    var cities = jQuery.parseJSON($('#cities').text());
    
    // popolamento della select delle province
    $('#regione').on('change', function() {
        var value = $(this).val();
        $('#provincia').removeAttr('disabled');

        var flag = $('#flagRegion').text();
        if (flag == 0) {
            for (let i in provinces) {
                if (provinces[i].region_id == value) {
                    $('#provincia').append('<option value="' + provinces[i].id + '">' + provinces[i].name + '</option>');
                }
            }
            $('#flagRegion').text(1);
        } else {
            // pulizia delle vecchie province
            $("#provincia").empty();
            $('#provincia').append('<option value="' + 0 + '">' + 'Seleziona la provincia' + '</option>');
            // aggiunta province
            for (let i in provinces) {
                if (provinces[i].region_id == value) {
                    $('#provincia').append('<option value="' + provinces[i].id + '">' + provinces[i].name + '</option>');
                }
            }
        }
        
    });

    // popolamento della select dei comuni
    $('#provincia').on('change', function() {
        var value = $(this).val();
        $('#comune').removeAttr('disabled');

        var flag = $('#flagProvince').text();
        if (flag == 0) {
            for (let i in cities) {
                if (cities[i].provinces_id == value) {
                    $('#comune').append('<option value="' + cities[i].id + '">' + cities[i].name + '</option>');
                }
            }
            $('#flagProvince').text(1);
        } else {
            // pulizia dei vecchi comuni
            $("#comune").empty();
            $('#comune').append('<option value="' + 0 + '">' + 'Seleziona il comune' + '</option>');
            // aggiunta comuni
            for (let i in cities) {
                if (cities[i].provinces_id == value) {
                    $('#comune').append('<option value="' + cities[i].id + '">' + cities[i].name + '</option>');
                }
            }
        }
    });

    $('#comune').on('change', function() {
        $('#cap').removeAttr('disabled');
    });
    
    $('#cap').on('change', function() {
        $('#address').removeAttr('disabled');
    });

    $('button').on('click', function () {
        value = $(this).attr('data-whatever');
        console.log(value);
        $('#modal').attr('value', value);
    });

    $('#modal').on('show.bs.modal', function (event) {
        console.log(this);
    });

});