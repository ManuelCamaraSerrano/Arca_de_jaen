$(document).ready(function(){

    var map = L.map('divMapa').setView([40.4167, -3.70325], 6.4); // Creamos el mapa

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map); // Añadimos el layer

    var markers = L.markerClusterGroup();

      var customIcon = L.AwesomeMarkers.icon({  // Creamos el icono del marcador
        icon: 'paw',
        prefix:'fa',
        markerColor: 'blue',
        iconColor: 'white'
      });


    $.getJSON("/lostAnimal",
        function(data){
            $.each(data,function(ind,valor){

                const marker = L.marker([
                    valor.lat, 
                    valor.lng
                ],{icon: customIcon})

                marker.bindPopup(`<div class="masInfo">
                        <div class="row">
                            <div class="imagen">
                                <img src="/estilos/assets/images/animals/${valor.photo}" class="col-12" alt="">
                            </div>
                        </div>
                        <div class="row">  
                            <div class="col-5 offset-1">
                                <label for="Nombre">Nombre:</label>
                                <p class="paragraph">${valor.name}</p>
                            </div>
                            <div class="col-5 offset-1">
                                <label for="Tipo">Especie:</label>
                                <p>${valor.type.name}</p>
                            </div>
                            <div class="col-5 offset-1">
                                <label for="Raza">Raza:</label>
                                <p>${valor.race.name}</p>
                            </div>
                            <div class="col-5 offset-1">
                                <label for="Color">Color:</label>
                                <p>${valor.colour}</p>
                            </div>
                            <div class="col-11 offset-1 description">
                                <label for="Color" class="">Descripción:</label>
                                <p class="descripcion">${valor.description}</p>
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <i class="fas fa-caret-down subir"></i>
                            </div>
                            <div class="col-8 offset-1">
                                <h5>Contacto:</h5>
                            </div>
                            <div class="col-5 offset-1">
                                <label for="Color">Email:</label>
                                <p>${valor.usuario.email}</p>
                            </div>
                            <div class="col-5 offset-1">
                                <label for="Color">Teléfono:</label>
                                <p>${valor.usuario.phone}</p>
                            </div>
                            
                        </div>
    
                </div>`);


    markers.addLayer(marker);

            })
        })



    map.addLayer(markers);

    function getRandom(min, max) {
    return Math.random() * (max - min) + min;
    }

    $( ".masInfo" ).click(function(ev) {
        ev.preventDefault();

        alert( "hhh." );

    });



    $( ".leaflet-popup-pane" ).on( 'click', ".subir" ,function() {  // Controlamos el click del icono de expandir

        $(".leaflet-popup-content-wrapper").toggleClass("expanded"); // Cambiamos la clase del contenedor

        if($(".subir").attr("class") == "fas fa-caret-down subir"){  // Cambiamos el icono cuando se pulse

            $(".subir").attr("class","fas fa-caret-up subir");

        }
        else{

            $(".subir").attr("class","fas fa-caret-down subir");

        }

       

    });



})
