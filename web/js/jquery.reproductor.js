(function($){

    $.extend({

        reproducir: function(opciones){

            var configuracion = {

            }

            jQuery.extend(configuracion, opciones);

            var ventana;


            abrirpopup("/site/reproductor",350,300);

            function abrirpopup(url,ancho,alto){

                var x=(screen.width/2)-(ancho/2);
                var y=(screen.height/2)-(alto/2);

                ventana = window.open(url, 'Reproductor', 'width=' + ancho + ', height=' + alto + ', left=' + x + ', top=' + y +'location=no, titlebar=no');
            }

            // ventana.document.write("<audio controls><source src='/musica/violin.ogg' type='audio/ogg'><source src='/musica/violin.mp3' type='audio/mpeg'></audio>");

        }


    });

    $(document).on('ready', function () {

            $("li:first").css("color", "green");

        $("li").on("click", function() {
            var audio = $(this).attr("id");
            $("audio").remove();
            $(".rep_musica").append("<audio controls autoplay loop><source src='/musica/"+audio+".ogg' type='audio/ogg'><source src='/musica/"+audio+".mp3' type='audio/mpeg'></audio>")

            $("li").css("color", "black");
            $(this).css("color", "green");
        });

    });

})(jQuery);
