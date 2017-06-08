$(document).on('ready', function () {

    $(".boton_buscar").hide();
    $(".input_buscar").hide();
    $(".lista_desple").hide();

    $(".boton_abrir_buscar").text("Buscar");

    $(".boton_abrir_buscar").on("click", function(){
        $(".boton_buscar").animate({  width: "toggle"});
        $(".input_buscar").animate({  width: "toggle"});
        $(".lista_desple").animate({  width: "toggle"});

        if ($(".boton_abrir_buscar").text()=="Buscar") {
            $(".boton_abrir_buscar").text("Cerrar");
            $("#usuarios").show();

        } else {
            $(".boton_abrir_buscar").text("Buscar");
            $("#usuarios").empty();
            $(".input_buscar").val('');
            $("#usuarios").css({
                'z-index' :'-2',
                'position': 'absolute',
                'background-color': '#f1f5f7'
            });
        }
    });

    // reproductor de musica

    $(".play_musica").on('click', function() {
        $.reproducir();
    });

    $("input[type=hidden]").attr("title", "oculto");
});
