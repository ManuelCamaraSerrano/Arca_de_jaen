$( document ).ready(function() {

    var contador = 0;
    
    var map = L.map('map').setView([37.76922, -3.79028], 15);  // Creamos el mapa

    var Stadia_OSMBright = L.tileLayer('https://tiles.stadiamaps.com/tiles/osm_bright/{z}/{x}/{y}{r}.png', {  // Añadimos el layer
    }).addTo(map);;

    map.on('click', onMapClick);


    function onMapClick(e) {

        $(".leaflet-interactive").remove();  // Borramos el marcador si es que hay

        var circle = L.circle([e.latlng["lat"], e.latlng["lng"]], {  //
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 120
        }).addTo(map);

        var icon = new L.Icon.Default();  // Cogemos el icono por defecto
        icon.options.shadowSize = [0,0];  // Le quitamos el sombreado para que luego no se quede en el mapa la sombra

        var marker = L.marker([e.latlng["lat"], e.latlng["lng"]], { icon : icon}).addTo(map); 
        
    }

});


    