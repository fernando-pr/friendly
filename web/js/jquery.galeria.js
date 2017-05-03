(function($){

    $.fn.extend({

        galeriaImg: function(opciones){

            var configuracion = {
                velocidad : 1000
            }

            jQuery.extend(configuracion, opciones);

            this.each(function(){

                var fotos = $(".imagen");


                var elemento = $(this);
                $(this).css({
                    width:"100%",
                    height:"120px",
                    position:"relative",
                    display:"flex",
                    justifyContent:'center'
                });

                $(this).children("div").css({
                    width:"80px",
                    height:"80px",
                });


                var rutas = [];

                fotos.each(function(i, elemento){
                    rutas.push(elemento.getAttribute("src"));
                });


                var imagen = $(this).children("div").append("<img/>");
                imagen = imagen.children("img");


                var index = 0;

                var interval;
                intervalo();

                function intervalo() {

                    interval = setInterval(changeImage, 3000);
                }

                function changeImage() {

                    imagen.attr("src", rutas[index]);
                    imagen.attr("class", "img-circle img-responsive");
                    elemento.fadeToggle(3000);

                    index++;

                    if(index == rutas.length){
                    index = 0;
                }
            }



            imagen.on("mouseenter", function(){
            clearInterval(interval);
        });

        imagen.on("mouseleave", function(){
        intervalo();
    });
});
return this;
}
});

})(jQuery);
