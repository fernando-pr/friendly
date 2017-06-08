$(document).on('ready', function () {

    $('#usuario-nombre').on('blur', validarNombre);
    $('#usuario-pass').on('blur', validarContraseña);
    $('#usuario-passconfirm').on('blur', validarRepetirContraseña);
    $('#usuario-email').on('blur', validarEmail);
    $('#usuario-provincia').on('blur', validarProvincia);
    $('#usuario-poblacion').on('blur', validarPoblacion);



    function validarNombre() {

        $(this).siblings('p').remove();
        var nombre = $(this).val();

        var error = $('<p>');
        error.css({'color' : 'red'});
        $(this).parent().append(error);

        if(nombre.length < 4 || !isNaN(nombre)) {

            $(this).css("backgroundColor","red");
            var texto = "El nombre no puede estar vacio, ser menor de 4 caracteres o ser un numero";
            error.append(texto);
        } else {
            $(this).css("backgroundColor","limegreen");
            $(this).siblings('p').remove();
        }
    }


    function validarEmail() {

        $(this).siblings('p').remove();
        var error = $('<p>');
        error.css({'color' : 'red'});
        $(this).parent().append(error);

        if(!/^\D+\@\D+\.\D+$/.test($(this).val())) {

            $(this).css("backgroundColor","red");
            var texto = "Introduce un email valido";
            error.append(texto);
        } else {
            $(this).css("backgroundColor","limegreen");
            $(this).siblings('p').remove();
        }
    }


    function validarContraseña() {

        var pass = $(this).val();

        $(this).siblings('p').remove();
        var error = $('<p>');
        error.css({'color' : 'red'});
        $(this).parent().append(error);

        if(pass.length < 4) {
            $(this).css("backgroundColor","red");
            var texto = "La contraseña debe tener al menos 4 caracteres";
            error.append(texto);
        }
        else {
            $(this).css("backgroundColor","limegreen");
            $(this).siblings('p').remove();
        }
    }

    function validarRepetirContraseña() {

        var repPass = $(this).val();
        var pass = $("#usuario-pass").val();

        $(this).siblings('p').remove();
        var error = $('<p>');
        error.css({'color' : 'red'});
        $(this).parent().append(error);

        if (repPass.length >3 && pass == repPass) {
            $(this).css("backgroundColor","limegreen");
        $(this).siblings('p').remove();
        }
        else {
            $(this).css("backgroundColor","red");
            var texto = "La contraseñas deben coincidir";
            error.append(texto);
        }
    }

    function validarProvincia() {


        $(this).siblings('p').remove();
        var provincia = $(this).val();

        var error = $('<p>');
        error.css({'color' : 'red'});
        $(this).parent().append(error);

        if(provincia.length <= 0) {

            $(this).css("borderColor","red");
            var texto = "la provincia no puede estar vacia";
            error.append(texto);
        } else {
            $(this).css("borderColor","limegreen");
            $(this).siblings('p').remove();
        }
    }
    function validarPoblacion() {


        $(this).siblings('p').remove();
        var poblacion = $(this).val();

        var error = $('<p>');
        error.css({'color' : 'red'});
        $(this).parent().append(error);

        if(poblacion.length <= 0) {

            $(this).css("borderColor","red");
            var texto = "la población no puede estar vacia";
            error.append(texto);
        } else {
            $(this).css("borderColor","limegreen");
            $(this).siblings('p').remove();
        }
    }

});
