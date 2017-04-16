

    var ventana;

    $(".registrate").on("click",function(){

        abrirpopup("../usuarios/create",510,880);
    });

    $(".boton_ok").on("click",function(){
        window.close();

    });

    function abrirpopup(url,ancho,alto){

        var x=(screen.width/2)-(ancho/2);
        var y=(screen.height/2)-(alto/2);

        ventana = window.open(url, 'registro', 'width=' + ancho + ', height=' + alto + ', left=' + x + ', top=' + y +'');
    }
