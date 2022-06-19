$(document).ready(function(){

    var map = L.map('divMapa').setView([40.4167, -3.70325], 6.4); // Creamos el mapa  [lat, lng, zoom]

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map); // Añadimos el layer

    var markers = L.markerClusterGroup();  // Creamos el grupo de marcadores

      var customIcon = L.AwesomeMarkers.icon({  // Creamos el icono del marcador
        icon: 'paw',
        prefix:'fa',
        markerColor: 'blue',
        iconColor: 'white'
      });


    $.getJSON("/lostAnimal",  // Recogemos todos los animales perdidos
        function(data){
            $.each(data,function(ind,valor){

                pintaMarcador(valor, markers);  // Pintamos los marcadores

            })
        })



    map.addLayer(markers);  // Añadimos los marcadores al mapa
    

    $( ".leaflet-popup-pane" ).on( 'click', ".subir" ,function() {  // Controlamos el click del icono de expandir

        $(".leaflet-popup-content-wrapper").toggleClass("expanded"); // Cambiamos la clase del contenedor

        if($(".subir").attr("class") == "fas fa-caret-down subir"){  // Cambiamos el icono cuando se pulse

            $(".subir").attr("class","fas fa-caret-up subir");

        }
        else{

            $(".subir").attr("class","fas fa-caret-down subir");

        }

       

    });


    $(".icon-filter").on("click", function(){

        if($(this).attr("id") == "perros"){

            filtrarPorEspecie(1);

        }

        if($(this).attr("id") == "gatos"){

            filtrarPorEspecie(2);

        }

        if($(this).attr("id") == "todos"){

            map.remove();  // Borramos el mapa

            markers = L.markerClusterGroup();  // Creamos el grupo de marcadores

            map = L.map('divMapa').setView([40.4167, -3.70325], 6.4); // Creamos el mapa  [lat, lng, zoom]
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map); // Añadimos el layer

            $.getJSON("/lostAnimal",  // Recogemos todos los animales perdidos
            function(data){
                $.each(data,function(ind,valor){

                    pintaMarcador(valor, markers);  // Pintamos los marcadores

                })
            })

            map.addLayer(markers);  // Añadimos los marcadores al mapa
        }

    })






    function pintaMarcador(valor, markers){

        const marker = L.marker([  // Creamos el marcador
                    valor[0], 
                    valor[1]
                ],{icon: customIcon})

                // Añadimos la información del animal
                marker.bindPopup(`<div class="masInfo">
                        <div class="row">
                            <div class="imagen">
                                <img src="/estilos/assets/images/animals/${valor[3]}" class="col-12" alt="">
                            </div>
                        </div>
                        <div class="row">  
                            <div class="col-5 offset-1">
                                <label for="Nombre">Nombre:</label>
                                <p class="paragraph">${valor[2]}</p>
                            </div>
                            <div class="col-5 offset-1">
                                <label for="Tipo">Especie:</label>
                                <p>${valor[6]}</p>
                            </div>
                            <div class="col-5 offset-1">
                                <label for="Raza">Raza:</label>
                                <p>${valor[7]}</p>
                            </div>
                            <div class="col-5 offset-1">
                                <label for="Color">Color:</label>
                                <p>${valor[4]}</p>
                            </div>
                            <div class="col-11 offset-1 description">
                                <label for="Color" class="">Descripción:</label>
                                <p class="descripcion">${valor[5]}</p>
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <i class="fas fa-caret-down subir"></i>
                            </div>
                            <div class="col-7">
                                <label for="Color">Email:</label>
                                <p>${valor[8]}</p>
                            </div>
                            <div class="col-4 offset-1">
                                <label for="Color">Teléfono:</label>
                                <p>${valor[9]}</p>
                            </div>
                            
                        </div>
    
                </div>`);


                markers.addLayer(marker);  // Añadimos al grupo el marcador

    }


    function filtrarPorEspecie($idEspecie){

        map.remove();  // Borramos el mapa

            markers = L.markerClusterGroup();  // Creamos el grupo de marcadores

            map = L.map('divMapa').setView([40.4167, -3.70325], 6.4); // Creamos el mapa  [lat, lng, zoom]
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map); // Añadimos el layer

            $.getJSON("/lostAnimalsForType/"+$idEspecie,  // Recogemos todos los animales perdidos
            function(data){
                $.each(data,function(ind,valor){

                    pintaMarcador(valor, markers);  // Pintamos los marcadores

                })
            })

            map.addLayer(markers);  // Añadimos los marcadores al mapa

    }



})
