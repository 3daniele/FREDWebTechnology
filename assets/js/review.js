$( document ).ready(function() {
    
    var reviews = jQuery.parseJSON($('#reviews').text());
    console.log(reviews);

    $('#modal').on('show.bs.modal', function (event) {
        var type = event.relatedTarget.getAttribute('data-whatever');

        if (type == "add") {
            $('#modalBtn').attr('name', 'add');
            console.log($('#modalBtn').attr('name'));
        } else {
            var userID = $('#userID').text();
            var productID = $('#productID').text();

            $('#modalTitle').text('Modifica la tua recensione');

            for (let i in reviews) {
                if (reviews[i].user_id == userID && reviews[i].product_id == productID) {
                    var title = reviews[i].title;
                    var message = reviews[i].message;
                    var vote = reviews[i].vote;

                    $('#title').val(title);
                    $("#starValue").attr('value', vote);
                    $('#message').val(message);

                    $('.star').each(function() {
                        if ($(this).val() <= vote) {
                            $(this).addClass('selected');
                        }
                    });
                }
            }
            
            $('#modalBtn').attr('name', 'update');
            console.log($('#modalBtn').attr('name'));
        }
    });
    
    
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
});

