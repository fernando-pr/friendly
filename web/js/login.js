$(document).on('ready', function () {
    $(".enlace").css({
        width:'120px',
        height:'80px'
    });
    $(".enlaces").css({
        'margin-left':'20%'
    });
});
var ventana1;
var ventana2;

$(".registrate").on("click",function(){

    abrirpopup("../usuarios/create",610,780, ventana1);
});

$(".boton_enlace").on("click",function(){
    var enlace = $(this).attr('href');
    window.open(enlace)
    window.close();
});

$(".boton_ok").on("click",function(){
    window.close();
});

function abrirpopup(url,ancho,alto, ventana){

    var x=(screen.width/2)-(ancho/2);
    var y=(screen.height/2)-(alto/2);

    ventana = window.open(url, 'nuevo usuario', 'width=' + ancho + ', height=' + alto + ', left=' + x + ', top=' + y +'');
}
