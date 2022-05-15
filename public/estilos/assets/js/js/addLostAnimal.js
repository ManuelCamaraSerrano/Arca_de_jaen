$( document ).ready(function() {

    var lat = 0;
    var lng = 0;



    // Rellenamos el comboBox de tipo de animal
    $.getJSON("/type",
    function(data){
        $.each(data,function(ind,valor){
            $("<option></option").text(valor.name)
            .appendTo("#tipo").val(valor.id);
        })
    })


    $("#tipo").change(function(){
        $("#raza").empty();

        $.getJSON("/race/"+$(this).val(),
        function(data){
            $.each(data,function(ind,valor){
                $("<option></option").text(valor.name)
                .appendTo("#raza").val(valor.id);
            })
        })
        
    })
    

    
    var map = L.map('map').setView([37.76922, -3.79028], 15);  // Creamos el mapa

    var Stadia_OSMBright = L.tileLayer('https://tiles.stadiamaps.com/tiles/osm_bright/{z}/{x}/{y}{r}.png', {  // Añadimos el layer
    }).addTo(map);;

    map.on('click', onMapClick);


    function onMapClick(e) {

        $(".leaflet-interactive").remove();  // Borramos el marcador si hay alguno

        var circle = L.circle([e.latlng["lat"], e.latlng["lng"]], {  
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 120
        }).addTo(map);

        var icon = new L.Icon.Default();  // Cogemos el icono por defecto
        icon.options.shadowSize = [0,0];  // Le quitamos el sombreado para que luego no se quede en el mapa la sombra

        var marker = L.marker([e.latlng["lat"], e.latlng["lng"]], { icon : icon}).addTo(map); // Creamos el marcador

        lat = e.latlng["lat"];

        lng = e.latlng["lng"];
        
    }


    $( "#subir" ).click(function(ev) {

        ev.preventDefault();

        var usuario = $("img[id^='usu']").attr("id").substring(3);

        var file = $("#file-1").val().split("\\"); // Cogemos el nombre del archivo

        var animal = [$("#nombre").val(),$("#color").val(),lat,lng,$("#descripcion").val(),file[2],$("#tipo").val(),$("#raza").val(),usuario];

        $.get("/insertAnimal/"+JSON.stringify(animal),function( data ) {
           alert("hola");
        })      
        
    });


});


    