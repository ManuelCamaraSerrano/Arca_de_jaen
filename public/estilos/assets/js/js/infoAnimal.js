$( document ).ready(function() {

     // Recogemos el id del animal que hemos pasado por la url
     const urlParams = new URLSearchParams(window.location.search);
     const animal = urlParams.get('a');

    // Cargamos el modal de confirmación
     var modalconfirm = $("<div>").load("/estilos/assets/js/js/templates/modalConfirm.html",
            function(){})

    // Cargamos el modal de confirmación
    var modalSoliEnviada = $("<div>").load("/estilos/assets/js/js/templates/modalSolicitudEnviada.html",
    function(){})


     // Cargamos la plantilla de información del animal
    var cont = $("<div>").load("/estilos/assets/js/js/templates/infoAnimal.html", 
    function(){
        // Cargamos la plantilla de el modal de solicitud
        var modalSolicitud = $("<div>").load("/estilos/assets/js/js/templates/modalSolicitud.html",
        function(){})
            // Cargamos los animales
            $.getJSON("/getAnimal/"+animal,{},
                function(data){
                        
                        var modalSoli = pintaModal(modalSolicitud, data);  // Pintamos el modal de solicitud

                    pintaInfoAnimal(data,modalSoli);   // Pintamos la información del animal             

                })
             })


   function pintaInfoAnimal(data,modalSoli){  // Función que crea las cajas de los animales le pasamos por parametro los animales

        var modelo = cont.find("div[id^=animal]:first");
        //creo las cajas

        var animal = modelo.clone(true);

        animal.attr("id","animal_"+data.id);
        animal.find(".name").text(data.name);
        animal.find("#especie").text(data.type.name);
        animal.find("#raza").text(data.race.name);
        animal.find("#fechanac").text(data.birthDate);
        animal.find("#sexo").text(data.sex);
        animal.find("#peso").text(data.weigth+" g");
        animal.find("#altura").text(data.height+" cm");
        animal.find("#chip").text(data.chip);
        animal.find("#color").text(data.colour);
        animal.find("#descripcion").text(data.description);
        animal.find("#img1").attr("src","/estilos/assets/images/animals/"+data.photos[0].photo);

        if(data.photos[1] == undefined){
            animal.find("#img2").attr("src","/estilos/assets/images/sinFoto.png");
        }
        else{
            animal.find("#img2").attr("src","/estilos/assets/images/animals/"+data.photos[1].photo);
        }

        if(data.photos[2] == undefined){
            animal.find("#img3").attr("src","/estilos/assets/images/sinFoto.png");
        }
        else{
            animal.find("#img3").attr("src","/estilos/assets/images/animals/"+data.photos[2].photo);
        }

        if(data.photos[3] == undefined){
            animal.find("#img4").attr("src","/estilos/assets/images/sinFoto.png");
        }
        else{
            animal.find("#img4").attr("src","/estilos/assets/images/animals/"+data.photos[3].photo);
        }

        

        animal.find("#adoptar").click(function(ev){

            ev.preventDefault();

            $(".contenedorModal").addClass("active");
            $(modalSoli).dialog({
                width: 500,  // Tamaño del dialog
                height: "auto",
                dialogClass: "modal-solicitud",
                show:{
                    effect: "puff",
                    duration: 1000
                },
                hide:{
                    effect: "fade",
                    duration: 1000
                }
            });

            $(".ui-dialog-titlebar-close").click(function(){
                $(".contenedorModal").removeClass("active");
            })
            
        })
        
        $(".container-info-animal").append(animal);
    
    }


    function imgClick(){

        $(".img-principal").attr("src",$(this).attr("src"));

    }


    function pintaModal(modal,data){

        var modelo = modal.find("div[id^=solicitud]:first");
        //creo las cajas               
        var solicitud = modelo.clone(true);  // Clonamos el modal
        solicitud.attr("id","solicitud_"+data.id);
        solicitud.find(".pregunta").text("¿Porqué quiere adoptar a "+data.name+"?"); 
        
        solicitud.find(".enviarSolicitud").click(function(ev){

            ev.preventDefault();

            if($(".descripcion").val() != "")
            {

                $(".errorSolicitud").text("");

                $(modalconfirm).dialog({
                    resizable: false,
                    height: "auto",
                    width: 400,
                    modal: true,
                    dialogClass: "modal-confirmacion",
                    show:{
                        effect: "puff",
                        duration: 1000
                    },
                    hide:{
                        effect: "fade",
                        duration: 1000
                    },
                    buttons: {
                      Cancelar: function() {  // Si pulsamos cancelar se cierra el modal

                        $( this ).dialog( "close" );

                        $(".contenedorModal").removeClass("superActive");
                        
                      },
                      "Confirmar": function() {  // Si pulsamos confirmar enviamos la solicitud
                        // Recogemos los datos
                        var usuario = $("img[id^='usu']").attr("id").substring(3);
                        var animal = $("div[id^='animal']").attr("id").substring(7);
                        var descripcion = $(".descripcion").val();

                        var solicitud = [usuario, animal, descripcion];

                        $( this ).dialog( "close" );
                        

                        $.get("/insertSolicitud/"+JSON.stringify(solicitud),function( data ) {  // Insertamos la solicitud
                            
                            $(modalSoliEnviada).dialog({
                                resizable: false,
                                height: "auto",
                                width: 500,
                                modal: true,
                                dialogClass: "modal-soliEnviada",
                                show:{
                                    effect: "puff",
                                    duration: 1000
                                },
                                hide:{
                                    effect: "fade",
                                    duration: 1000
                                },
                                buttons: {
                                  "Confirmar": function() {  // Si pulsamos confirmar nos redigirá a la página inicial
                                    window.location = "/";
                                  },
                                }
                              });
                            
                         })   
    
                      },
                    }
                  });

                  $(".ui-dialog-titlebar-close").click(function(){

                    $(".contenedorModal").removeClass("superActive");
                  })

                  $(".contenedorModal").addClass("superActive");

            }
            else{

                $(".errorSolicitud").text("El campo descripción es obligatorio");
            }
        
            
        })
        
   
        return solicitud;
        
    }


})