$( document ).ready(function() {

    // Cargamos la plantilla del animal
    var cont = $("<div>").load("/estilos/assets/js/js/templates/animalList.html", 
         function(){
            // Cargamos los animales
            $.getJSON("/animalList/1",{},
                function(data){
                     
                    pintaAnimales(data);

                })
        })


    crearPaginacion();

    function crearPaginacion(){

        var botonIni = $("<button>").text("<<").attr("class","anterior").click(function(){  // Gestionamos el click del botono anterior
            var actualPage = parseInt($(".btn-activo").attr("id").substring(1)); // Cogemos la página actual
            if(actualPage != 1){  // Si la página es distinta a 1

                $(".btn-activo").removeClass("btn-activo");  // Borramos la clase activo y se la asignamos al boton anterior
                $("#n"+(actualPage-1)).attr("class","btn-activo");
                
                $.getJSON("/animalList/"+(actualPage-1),{},  // Pedimos los datos de la página anterior
                function(data){

                    $(".cont-animal").empty();  // Vaciamos el contenedor

                    pintaAnimales(data);  // Pintamos los datos
                })
            }
        });

        $(".pagination").append(botonIni);  // Añadimos el boton


        $.getJSON("/nPageAnimal",{},  // Pedimos cuantas páginas de animales hay
        function(data){
            
            for( i=0; i<data; i++){  // Con el bucle vamos creando los botones de las páginas

                if(i == 0){  // Al primer boton le asignamos la clase btn-activo

                    var boton = $("<button>").text(i+1).attr("id","n"+(i+1)).addClass("btn-activo").click(function(){ // Controlamos el click

                        $(".btn-activo").removeClass("btn-activo");  // Borramos la clase activo del boton antiguo y se la asignamos al que hemos pulsado
                        $(this).attr("class","btn-activo");
                        $.getJSON("/animalList/"+$(this).attr("id").substring(1),{},
                            function(data){

                                $(".cont-animal").empty();

                                pintaAnimales(data);

                            })
                    });
                    
                    $(".pagination").append(boton); // Añadimos el boton

                }
                else{


                    var boton = $("<button>").text(i+1).attr("id","n"+(i+1)).click(function(){
                        $(".btn-activo").removeClass("btn-activo");
                        $(this).attr("class","btn-activo");
                        $.getJSON("/animalList/"+$(this).attr("id").substring(1),{},
                            function(data){

                                $(".cont-animal").empty();

                                pintaAnimales(data);
                            })
                    });

                    $(".pagination").append(boton);

                }
                
                
            }

            var botonfin = $("<button>").text(">>").attr("class","posterior").click(function(){  // Gestionamos el click del botono posterior

                var actualPage = parseInt($(".btn-activo").attr("id").substring(1)); // Cogemos la página actual

                if(actualPage != data){  // Si la página es distinta al total de paginas
    
                    $(".btn-activo").removeClass("btn-activo");  // Borramos la clase activo y se la asignamos al boton posterior
                    $("#n"+(actualPage+1)).attr("class","btn-activo");
                    
                    $.getJSON("/animalList/"+(actualPage+1),{},  // Pedimos los datos de la página posterior
                    function(data){
    
                        $(".cont-animal").empty();  // Vaciamos el contenedor
    
                        pintaAnimales(data);  // Pintamos los datos
                    })
                }
            });

            $(".pagination").append(botonfin);
        })


    }



    function pintaAnimales(data){  // Función que crea las cajas de los animales le pasamos por parametro los animales

        var modelo = cont.find("div[id^=animal]:first");
        //creo las cajas
        $.each(data,function(ind,valor){
            var animal = modelo.clone(true);
            animal.attr("id","animal_"+data[ind][0]);
            animal.find(".name").text(data[ind][1]);

            if(data[ind][3] == "Macho"){
                animal.find(".sex").attr("class","fas fa-mars");
            }
            else{
                animal.find(".sex").attr("class","fas fa-venus");
            }
            animal.find(".image").attr("src","/estilos/assets/images/animals/"+data[ind][2]);
           
            // Cuando pulse el enlace aparecerá el modal
            animal.find(".btn-masinfo").attr("id","a"+data[ind][0]).click(function(){
               window.location = "/infoAnimal?a="+$(this).attr("id").substring(1);
            })
            
            $(".cont-animal").append(animal);
        })
    }



})