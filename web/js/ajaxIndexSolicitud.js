$(document).on('ready', function () {



    $(".boton_solicitud").on("click", refrescarIndex);

    var id;
    var variable;
    function refrescarIndex(e){
        variable = $(this);
        id = $(this).attr("name");

        $.ajax({
            data: "id="+id,
            type:"GET",
            url: urlSolicitud,
            success:refrescar
        });


    }
    function refrescar(r){

        $(".boton_solicitud[name='"+id+"']").toggle();
        $(".cancelar_peticion[name='"+id+"']").toggle();

    }

    $(".cancelar_peticion").on("click", cancelarPeticion);

    var variableCancelar;
    var idCancelar;

    function cancelarPeticion(e)
    {

        variable = $(this);
        id = $(this).attr("name");

        $.ajax({
            data: "id="+id,
            type:"GET",
            success:cancelar,

            url: urlCancelar
        });


    }

    function cancelar(r){


        $(".cancelar_peticion[name='"+id+"']").toggle();
        $(".boton_solicitud[name='"+id+"']").toggle();
    }


    ocultos();

    function ocultos() {
        $(".oculto").hide();
    }
});
