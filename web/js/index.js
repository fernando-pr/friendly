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
        } else {
            $(".boton_abrir_buscar").text("Buscar");
        }
    });
$(".lista_desple").on("change", function(){
    console.log($(".lista_desple").val())
});

});
