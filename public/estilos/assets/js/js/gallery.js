$( document ).ready(function() {

    lightGallery(document.getElementById('lightgallery'));

    // Cargamos las fotos
    $.getJSON("/galleryList/1",{},  // Rellenamos siempre al entrar con la primera página
        function(data){
                 
            rellenaGaleria(data);

        })
        

    crearPaginacion();  // Creamos la paginación



    function crearPaginacion(){

        var botonIni = $("<button>").text("<<").attr("class","anterior").click(function(){  // Gestionamos el click del botono anterior
            
            var actualPage = parseInt($(".btn-activo").attr("id").substring(1)); // Cogemos la página actual
            window.scrollTo(0, 0);

            if(actualPage != 1){  // Si la página es distinta a 1

                $(".btn-activo").removeClass("btn-activo");  // Borramos la clase activo y se la asignamos al boton anterior
                $("#n"+(actualPage-1)).attr("class","btn-activo");
                
                $.getJSON("/galleryList/"+(actualPage-1),{},  // Pedimos los datos de la página anterior
                function(data){

                    rellenaGaleria(data);

                })
            }

        });

        $(".pagination").append(botonIni);  // Añadimos el boton


        $.getJSON("/nPageGallery",{},  // Pedimos cuantas páginas de animales hay
        function(data){
            
            for( i=0; i<data; i++){  // Con el bucle vamos creando los botones de las páginas

                if(i == 0){  // Al primer boton le asignamos la clase btn-activo

                    var boton = $("<button>").text(i+1).attr("id","n"+(i+1)).addClass("btn-activo").click(function(){ // Controlamos el click

                        window.scrollTo(0, 0);
                        $(".btn-activo").removeClass("btn-activo");  // Borramos la clase activo del boton antiguo y se la asignamos al que hemos pulsado
                        $(this).attr("class","btn-activo");
                        $.getJSON("/galleryList/"+$(this).attr("id").substring(1),{},
                            function(data){

                                rellenaGaleria(data);

                            })
                    });
                    
                    $(".pagination").append(boton); // Añadimos el boton

                }
                else{


                    var boton = $("<button>").text(i+1).attr("id","n"+(i+1)).click(function(){
                        window.scrollTo(0, 0);
                        $(".btn-activo").removeClass("btn-activo");
                        $(this).attr("class","btn-activo");
                        $.getJSON("/galleryList/"+$(this).attr("id").substring(1),{},
                            function(data){

                                rellenaGaleria(data);
                            })
                    });

                    $(".pagination").append(boton);

                }
                
                
            }

            var botonfin = $("<button>").text(">>").attr("class","posterior").click(function(){  // Gestionamos el click del botono posterior

                window.scrollTo(0, 0);
                var actualPage = parseInt($(".btn-activo").attr("id").substring(1)); // Cogemos la página actual

                if(actualPage != data){  // Si la página es distinta al total de paginas
    
                    $(".btn-activo").removeClass("btn-activo");  // Borramos la clase activo y se la asignamos al boton posterior
                    $("#n"+(actualPage+1)).attr("class","btn-activo");
                    
                    $.getJSON("/galleryList/"+(actualPage+1),{},  // Pedimos los datos de la página posterior
                    function(data){
    
                        rellenaGaleria(data);
                    })
                }
            });

            $(".pagination").append(botonfin);
        })


    }


    function rellenaGaleria(data){  // Está funcion se encarga de cambiar el src y el href de las fotos de la galería

        for(let i = 0; i < 9 ; i++){

            if(data[i] == undefined)
            {
                $(".foto"+(i+1)).attr("src", "estilos/assets/images/sinFoto.png");  // Asigamos la imagen sin foto
                $("#foto"+(i+1)).attr("href", "estilos/assets/images/sinFoto.png");  
            }
            else{
                $(".foto"+(i+1)).attr("src", "estilos/assets/images/gallery/"+data[i]);  // Asignamos la imagen correspondiente
                $("#foto"+(i+1)).attr("href", "estilos/assets/images/gallery/"+data[i]);
            }
            
        }

    }

})