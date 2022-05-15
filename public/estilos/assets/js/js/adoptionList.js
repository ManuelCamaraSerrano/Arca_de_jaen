$( document ).ready(function() {

    // Cargamos la plantilla del animal
    var cont = $("<div>").load("/estilos/assets/js/js/templates/animalList.html",
            function(){
                // Cargamos los animales
                $.getJSON("/animalList/1",{},
                    function(data){
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
                            animal.find(".btn-masinfo").click(function(ev){
                               alert("hola")
                            })
                            
                            $(".cont-animal").append(animal);
                    })

            })
    })


    crearPaginacion();

    function crearPaginacion(){

        var botonIni = $("<button>").text("<<").attr("class","anterior");

        $(".pagination").append(botonIni);


        $.getJSON("/nPageAnimal",{},
        function(data){
            
            for( i=0; i<data; i++){

                if(i == 0){

                    var boton = $("<button>").text(data).attr("id","n"+i+1).addClass("btn-activo");
                    $(".pagination").append(boton);

                }
                else{

                    var boton = $("<button>").text(data).attr("id","n"+i+1);
                    $(".pagination").append(boton);

                }
                
                
            }

            var botonfin = $("<button>").text(">>").attr("class","posterior");

            $(".pagination").append(botonfin);
        })


    }



})