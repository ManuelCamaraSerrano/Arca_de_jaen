$( document ).ready(function() {


     // Cargamos el modal de confirmación
     var modalSoliEnviada = $("<div>").load("/estilos/assets/js/js/templates/modalConsultaEnviada.html",
     function(){})


    $("#enviar").on("click", function(ev){
        ev.preventDefault();

        if( validador() ){

            var nombre = $("#nombre").val();
            var asunto = $("#asunto").val();
            var mensaje = $("#mensaje").val();
            var email = $("#email").val();

            var array = [asunto, nombre, email, mensaje];

            $.get("/emailContact/"+JSON.stringify(array),function( data ) {  // Enviamos el correo

                $("#nombre").val("");
                $("#asunto").val("");
                $("#mensaje").val("");
                $("#email").val("");

                $(".contenedorModal").addClass("active");

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
                      "Confirmar": function() { 
                            $( this ).dialog( "close" ); // Cerramos el modal
                            $(".contenedorModal").removeClass("active");
                      },
                    }
                  });

                  $(".ui-dialog-titlebar-close").click(function(){

                    $(".contenedorModal").removeClass("active");
            
                  })
                
            }) 
        }

    })


    function validador(){

         var array = [];

        if($("#nombre").val() == ""){
            $("#e-nombre").removeClass("oculto");
            array.push(false);
        }
        else{
            $("#e-nombre").addClass("oculto");
            array.push(true);
        }
        

        if($("#asunto").val() == ""){
            $("#e-asunto").removeClass("oculto");
            array.push(false);
        }
        else{
            $("#e-asunto").addClass("oculto");
            array.push(true);
        }

        if($("#mensaje").val() == ""){
            $("#e-mensaje").removeClass("oculto");
            array.push(false);
        }
        else{
            $("#e-mensaje").addClass("oculto");
            array.push(true);
        }

        if(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test($("#email").val()) == false ){
            $("#email-invalido").removeClass("oculto");
            array.push(false);
        }
        else{
            $("#email-invalido").addClass("oculto");
            array.push(true);
        }

        if(array.includes(false)){
            return false;
        }
        else{
            return true;
        }

    }


})