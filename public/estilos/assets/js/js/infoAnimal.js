$( document ).ready(function() {

     // Recogemos el id del animal que hemos pasado por la url
     const urlParams = new URLSearchParams(window.location.search);

     const animal = urlParams.get('a');


     // Cargamos la plantilla del animal
    var cont = $("<div>").load("/estilos/assets/js/js/templates/infoAnimal.html", 
    function(){
        // Cargamos la plantilla de el modal
        var modalSolicitud = $("<div>").load("/estilos/assets/js/js/templates/modalSolicitud.html",
        function(){})
       // Cargamos los animales
       $.getJSON("/getAnimal/"+animal,{},
           function(data){
                
                var modalSoli = pintaModal(modalSolicitud, data);

               pintaInfoAnimal(data,modalSoli);               

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
        animal.find("#peso").text(data.weigth);
        animal.find("#altura").text(data.height);
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
        
        // Cuando pulse el enlace aparecerá el modal
       // animal.find(".btn-masinfo").attr("id","a"+data[ind][0]).click(function(){
         //  window.location = "/infoAnimal?a="+$(this).attr("id").substring(1);
        //})

        animal.find("#adoptar").click(function(ev){
            ev.preventDefault();
            //$(".contenedorModal").addClass("active");
            $(modalSoli).dialog({
                width: 1050,  // Tamaño del dialog
                height:500
            });
           // $(".ui-button").click(function(){
             //   $(".contenedorModal").removeClass("active");
            //})
        })
        
        $(".container-info-animal").append(animal);
    
    }


    function pintaModal(modal,data){

        var modelo = modal.find("div[id^=solicitud]:first");
        //creo las cajas               
        var solicitud = modelo.clone(true);
        solicitud.attr("id","solicitud_"+data.id);
        solicitud.find(".pregunta").text("¿Porqué quiere adoptar a "+data.name);
        
        solicitud.find(".enviarSolicitud").click(function(ev){
            ev.preventDefault();
            $(modalconfirm).dialog({
                resizable: false,
                height: "auto",
                width: 400,
                modal: true,
                buttons: {
                  Cancelar: function() {
                    $( this ).dialog( "close" );
                    
                  },
                  "Confirmar": function() {
                    
                    alert("Bien");

                  },
                }
              });
            
        })
        

        
        return solicitud;
        
    }


})