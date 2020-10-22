$(window).on('load', function () {
    $('#load_screen').fadeOut('slow', function () {
        $(this).remove();
        if( $("#messagesModal").length ) {
            $(document).ready(function(){
                $("#messagesModal").modal('show');
            });
        }
    });
});
