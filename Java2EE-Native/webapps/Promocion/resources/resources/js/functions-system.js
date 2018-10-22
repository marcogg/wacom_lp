$(function () {


    // Logout
    $(".btn-logout").on("click", function (evt) {
        evt.preventDefault();
        var url = $(this).attr("href");
        //alert( "Logout..." );

        swal({
                title: "¡¡ Aviso !!",
                text: "¿Seguro que quieres terminar esta sesión?",
                type: "error",
                html: true,
                showCancelButton: true,
                confirmButtonColor: "#d9534f",
                confirmButtonText: "Si",
                cancelButtonColor: "#000",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true,
                animation: "slide-from-top"
            },
            function (isConfirm) {
                if (isConfirm) {
                    self.location = url;
                }

            });

    });

    // Borrar un objeto
    $(".btn-delete").on("click", function (evt) {
        evt.preventDefault();
        var url = $(this).attr("href");
        var title = $(this).attr("title");

        swal({
                title: "¡¡ Aviso !!",
                text: "¿Seguro que quieres eliminar el registro<br>[ <strong>" + title + "</strong> ]?",
                type: "error",
                html: true,
                showCancelButton: true,
                confirmButtonColor: "#d9534f",
                confirmButtonText: "Si",
                cancelButtonColor: "#000",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true,
                animation: "slide-from-top"
            },
            function (isConfirm) {
                if (isConfirm) {
                    self.location = url;
                }

            });

    });

    $(".btn-activar-codigo").on( "click", function (evt) {
        evt.preventDefault();
        var url = $(this).attr( "href" );
        var ticket = $(this).attr( "data-ticket" );

        swal({
                title: "¡¡ Aviso !!",
                text: "<span class='bold'>¿Estás seguro que quieres enviar el código de activación para el ticket[ " + ticket + " ] seleccionado?</span>",
                type: "success",
                html: true,
                showCancelButton: true,
                confirmButtonColor: "#d9534f",
                confirmButtonText: "Si",
                cancelButtonColor: "#000",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true,
                animation: "slide-from-top"
            },
            function (isConfirm) {
                if (isConfirm) {
                    self.location = url;
                }

            });


    } )

});

function validateTicketDescalificarForm( form ) {
    /*
    var comentario = $.trim( form.comentario.value );

    if( comentario == "" ) {
        sweetAlert("¡¡ Aviso !!", "¿Porque se va a desactivar? es necesario", "error");
        return false;
    }
    */
    swal({
            title: "¡¡ Aviso !!",
            text: "¿Estás seguro que quieres descalificar este registro?",
            type: "error",
            html: true,
            showCancelButton: true,
            confirmButtonColor: "#d9534f",
            confirmButtonText: "Si",
            cancelButtonColor: "#000",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: true,
            animation: "slide-from-top"
        },
        function (isConfirm) {
            if (isConfirm) {
                form.submit();
            }

        });

    return false;
}

function validateTicketEnabledForm( form ) {
    swal({
            title: "¡¡ Aviso !!",
            text: "¿Estás seguro que quieres activar este registro?",
            type: "error",
            html: true,
            showCancelButton: true,
            confirmButtonColor: "#d9534f",
            confirmButtonText: "Si",
            cancelButtonColor: "#000",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: true,
            animation: "slide-from-top"
        },
        function (isConfirm) {
            if (isConfirm) {
                form.submit();
            }

        });

    return false;
}

