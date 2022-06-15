$( document ).ready(function() {


    $(".date").on("change",function(){

        $(".error").addClass("oculto");

        $("th").removeClass("reservado");

        var fecha = $(".date").val();

        $.get("/getReservedDay/"+fecha,function( data ) {  // Insertamos la solicitud
                        
             for(let i = 0; i < data.length; i++){

                $("#job"+JSON.parse(data)[i][0]+"tramo"+JSON.parse(data)[i][1]).addClass("reservado");
             }           
                        
        })   

    })

    // Cargamos el modal de confirmación
    var modalconfirm = $("<div>").load("/estilos/assets/js/js/templates/modalConfirmReserve.html",
    function(){})

    // Cargamos el modal de confirmación
    var modalReservaRealizada = $("<div>").load("/estilos/assets/js/js/templates/reservaRealizada.html",
    function(){})

    $("th").on("click", function(){
        if($(this).attr("class") != "reservado" && $(".date").val() != ""){

            var th = $(this);

            $(".error").addClass("oculto");

            $(".contenedorModal").addClass("active");

            var tarea = $(this).attr("id").substring(3,4);

            var tramo = $(this).attr("id").substring(9);

            var fecha = $(".date").val();

            var usuario = $("img[id^='usu']").attr("id").substring(3);

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

                    $(".contenedorModal").removeClass("active");
                    
                  },
                  "Confirmar": function() {  // Si pulsamos confirmar realizamos la reserva

                    var reserva = [usuario, tramo, tarea, fecha];

                    $( this ).dialog( "close" );
                    

                    $.get("/insertReserva/"+JSON.stringify(reserva),function( data ) {  // Insertamos la solicitud
                        
                        th.addClass("reservado");

                        $(modalReservaRealizada).dialog({
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
                        
                     })   

                  },
                }
              });

              $(".ui-dialog-titlebar-close").click(function(){

                $(".contenedorModal").removeClass("active");

              })

        }
        else{
            $(".error").removeClass("oculto");
        }
    })




})