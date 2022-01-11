$(document).ready(function () {

    var addresses = jQuery.parseJSON($('#addresses').text());
    var regions = jQuery.parseJSON($('#regions').text());
    var provinces = jQuery.parseJSON($('#provinces').text());
    var cities = jQuery.parseJSON($('#cities').text());

    $('#modal').on('show.bs.modal', function (event) {

        var type = event.relatedTarget.getAttribute('data-whatever');

        if (type == "aggiungi") {
            $('#modalTitle').text('Inserisci un nuovo indirizzo');

            $("#regione").empty();
            $('#regione').append('<option value="' + 0 + '">' + 'Seleziona la regione' + '</option>');
            for (let i in regions) {
                $('#regione').append('<option value="' + regions[i].id + '">' + regions[i].name + '</option>');
            }

            $("#provincia").empty();
            $('#provincia').append('<option value="' + 0 + '">' + 'Seleziona la provincia' + '</option>');
            
            $("#comune").empty();
            $('#comune').append('<option value="' + 0 + '">' + 'Seleziona il comune' + '</option>');
            
            $('#cap').val("");
            $('#address').val("");

            $('#provincia').attr('disabled', true);
            $('#comune').attr('disabled', true);
            $('#cap').attr('disabled', true);
            $('#address').attr('disabled', true);

            $('#modalBtn').attr('name', 'add');
            console.log($('#modalBtn').attr('name'));
        } else {
            var shipmentID = event.relatedTarget.getAttribute('data-bs-whatever');

            $('#modalTitle').text('Modifica il tuo indirizzo');

            $('#provincia').attr('disabled', true);
            $('#comune').attr('disabled', true);
            $('#cap').attr('disabled', true);
            $('#address').attr('disabled', true);

            $('#flagRegion').text(1);
            $('#flagProvince').text(1);
            $('#flagCity').text(1);

            for (let i in addresses) {
                if (addresses[i].id_shipment == shipmentID) {
                    $('#regione').append('<option selected value="' + addresses[i].region_id + '">' + addresses[i].region_name + '</option>');
                    $('#provincia').append('<option selected value="' + addresses[i].provinces_id + '">' + addresses[i].provinces_name + '</option>');
                    $('#comune').append('<option selected value="' + addresses[i].city + '">' + addresses[i].city_name + '</option>');
                    $('#cap').val(addresses[i].code);
                    $('#address').val(addresses[i].address);
                }
            }
            $('#modalBtn').attr('name', 'update');
        }
    });

    // popolamento della select delle province al settaggio della regione
    $('#regione').on('change', function () {
        var value = $(this).val();
        $('#provincia').removeAttr('disabled');

        var flag = $('#flagRegion').text();
        console.log(flag);
        // verifca se è già stata settata una regione o meno
        if (flag == 0) {
            // aggiunta province
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
            // pulizia dei vecchi comuni
            $("#comune").empty();
            $('#comune').append('<option value="' + 0 + '">' + 'Seleziona il comune' + '</option>');
            $('#comune').attr('disabled', true);
            // pulizia del CAP
            $("#cap").val("");
            $('#cap').attr('disabled', true);
            // pulizia della via 
            $("#address").val("");
            $('#address').attr('disabled', true);
            // aggiunta province
            for (let i in provinces) {
                if (provinces[i].region_id == value) {
                    $('#provincia').append('<option value="' + provinces[i].id + '">' + provinces[i].name + '</option>');
                }
            }
        }
    });

    // popolamento della select dei comuni al settaggio della provincia
    $('#provincia').on('change', function () {
        var value = $(this).val();
        $('#comune').removeAttr('disabled');

        var flag = $('#flagProvince').text();
        // verifca se è già stata settata una provincia o meno
        if (flag == 0) {
            // aggiunta comuni
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
            // pulizia del CAP
            $("#cap").val("");
            $('#cap').attr('disabled', true);
            // pulizia della via 
            $("#address").val("");
            $('#address').attr('disabled', true);
            // aggiunta comuni
            for (let i in cities) {
                if (cities[i].provinces_id == value) {
                    $('#comune').append('<option value="' + cities[i].id + '">' + cities[i].name + '</option>');
                }
            }
        }
    });

    $('#comune').on('change', function () {
        $('#cap').removeAttr('disabled');

        var flag = $('#flagCity').text();
        if (flag == 1) {
            // pulizia del CAP
            $("#cap").val("");
            // pulizia della via 
            $("#address").val("");
            $('#address').attr('disabled', true);
            $('#flagCity').text(0);
        } else {
            $('#flagCity').text(1);
        }
    });

    $('#cap').on('change', function () {
        $('#address').removeAttr('disabled');
    });


});