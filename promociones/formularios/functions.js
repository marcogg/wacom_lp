/**
 * Created by jherrera on 18/01/17.
 */

// Carpeta raiz en el sitio
var webRoot = "/formularios/"

// Variables de formularios .php para Contacto, Newsletter, etc.
var contactoAction = webRoot + "contacto.php";
var newsletterAction = webRoot + "newsletter.php";

//alert( contactoAction + "\n" + newsletterAction );

$(function () {
    // Habilitar los submit
    $("#btn-newsletter-submit").attr("disabled", false);
    $("#submit").attr("disabled", false);

    // Validar el newsletter
    $("#form-newsletter").on("submit", function (evt) {
        evt.preventDefault();

        // Success
        $("#messages-newsletter-success").hide();

        //alert( "Newsletter..." );
        var email = $.trim($("#email-newsletter").val());
        var grupo = $.trim($("#grupo-newsletter").val());
        var errors = "";

        // Campo email
        if (email == null || email == "undefined") {
            errors += 'Campo: <strong>[ id="email-newsletter" name="email-newsletter" type="text" ]</strong> no se encuentra definido<br>';
        }

        // Campo grupo
        if (grupo == null || grupo == "undefined") {
            errors += 'Campo: <strong>[ id="grupo-newsletter" name="grupo-newsletter" type="hidden" ]</strong> no se encuentra definido<br>';
        }

        if (errors != "") {
            $("#messages-newsletter").hide();
            $("#messages-newsletter").show(500);
            $("#messages-newsletter").html(errors);
            return;
        }

        // Campo email
        if (email == "") {
            errors += 'Email es necesario<br>';
        }

        if ( !isEmailString(email) ) {
            errors += 'Email no es una dirección válida<br>';
        }

        // Campo grupo
        if (grupo == "") {
            errors += 'Grupo de Newsletter es necesario<br>';
        }

        if (errors != "") {
            $("#messages-newsletter-danger").hide();
            $("#messages-newsletter-danger").show(500);
            $("#messages-newsletter-danger").html(errors);
            return;
        }

        // Si ok
        var action = newsletterAction;

        // Enviar el correo via ajax
        $.ajax({
            type: "post",
            url: action,
            data: $(this).serialize(),

            beforeSend: function (xhr) {
                $("#btn-newsletter-submit").attr("disabled", true);
                $("#messages-newsletter-danger").hide();
                $("#messages-newsletter-danger").show(500);
                $("#messages-newsletter-danger").html("Tus datos se estan enviando, espera por favor...");
            },
            success: function (data) {
                var object = JSON.parse(data);

                $("#btn-newsletter-submit").attr("disabled", !true);

                if (object.success == 0) {
                    $("#messages-newsletter-danger").html(object.errorMessage);
                    return;
                }

                // Si se envio correctamente
                $("#form-newsletter").trigger("reset");
                $("#messages-newsletter-danger").hide();
                $("#messages-newsletter-success").show( 500 );
                $("#messages-newsletter-success").html("Gracias por registrarte, tus datos han sido enviados.");
            },
            error: function () {
                $("#btn-newsletter-submit").attr("disabled", !true);
            }
        });

    })

})

// Formulario dinamico de contacto
function validateContacto( form ) {
    var errors = "";
    var attributes = "";
    var elements = form.elements.length;

    for( var i = 0;  i < elements;  i ++ ) {
        var label = form.elements[ i ].getAttribute( "data-label" );
        var type = form.elements[ i ].getAttribute( "data-type" );
        var required = form.elements[ i ].getAttribute( "data-required" );

        // Si existen los datos
        if( label != null && type != null && required != null ) {
            // Input
            var input = form.elements[ i ];

            // Validaciones
            if( type == "text" ) {
                errors += isTrim( input, required ) == true ? label + " es necesario<br>" : "";
            }
            if( type == "email" ) {
                errors += isEmail( input, required ) == false ? label + " no es una dirección válida<br>" : "";
            }
            if( type == "integer" ) {
                errors += isInteger( input, required ) == false ? label + " no es válido<br>" : "";
            }
            if( type == "numeric" ) {
                errors += isNumber( input, required ) == false ? label + " no es válido<br>" : "";
            }

            //attributes += "[ " + label + ", " + type + ", " + required + " ]\n";
        }

    }

    // Si hay errores
    if( errors != "" ) {
        $("#messages-danger").hide();
        $("#messages-danger").show(500);
        $("#messages-danger").html( errors );
        return false;
    }

    // Form action
    var action = contactoAction;
    var formNew = $( "#" + form.id );
    var data = formNew.serialize();

    // Enviar el correo via ajax
    $.ajax({
        type: "post",
        url: action,
        data: data,

        beforeSend: function (xhr) {
            $( "#submit" ).attr("disabled", true);
            $("#messages-danger").hide();
            $("#messages-danger").show(500);
            $("#messages-danger").html("Tus datos estan siendo procesados, espera por favor...");
        },
        success: function (data) {
            var object = JSON.parse(data);

            if (object.success == 0) {
                $("#messages-danger").html(object.errorMessage);
                $("#submit").attr("disabled", !true);
                return;
            }

            // Pausa
            setTimeout(function(){
                // Si se envio correctamente
                $("#messages-danger").hide();
                $("#messages-success").show( 500 );
                $("#messages-success").html("Gracias por registrarte, tus datos han sido enviados.");
                $(formNew).trigger("reset");
                $("#submit").attr("disabled", !true);

            }, 2000);

        },
        error: function () {
            $("#submit").attr("disabled", !true);
        }
    });

    return false;

}

function isTrim( input, required ) {
    var value = $.trim( input.value );

    if( required == "false" && value == "" ) {
        return false;
    }

    if( value == "" ) {
        return true;
    }

    return false;
}

function isEmailString( value ) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(value);
}

function isEmail( input, required ) {
    var value = $.trim( input.value );

    if( required == "false" && value == "" ) {
        return true;
    }

    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(value);
}

function isInteger( input, required ) {
    var value = $.trim( input.value );

    if( required == "false" && value == "" ) {
        return true;
    }

    var filter = /^[0-9]+$/;

    if( filter.test( value ) ) {
        return true;
    }
    else {
        return false;
    }
}

function isNumber( input, required ) {
    var value = $.trim( input.value );

    if( required == "false" && value == "" ) {
        return true;
    }

    var filter = /^[0-9].+$/;

    if( filter.test( value ) ) {
        return true;
    }
    else {
        return false;
    }
}
