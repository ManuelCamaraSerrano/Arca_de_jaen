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


    // Agregamos el usuario al input oculto
    var usuario = $("img[id^='usu']").attr("id").substring(3);
    $("#usuario").val(usuario);


    $( "#subir" ).click(function(ev) {

        $("#lat").val(lat);
        $("#lng").val(lng);
        
        validador(ev);  // Función que valida los campos

    })




    
    function validador(ev){

        if($("#raza").val() == "Raza")
        {
            ev.preventDefault();
            $("#e-raza").removeClass("oculto");
        }
        else{
            $("#e-raza").addClass("oculto");
        }

        if($("#tipo").val() == "Especie")
        {
            ev.preventDefault();
            $("#e-especie").removeClass("oculto");
        }
        else{
            $("#e-especie").addClass("oculto");
        }

        if(lat == 0 && lng == 0){
            ev.preventDefault();
            $("#e-marcador").removeClass("oculto");
        }
        else{
            $("#e-marcador").addClass("oculto");
        }

        if($("#descripcion").val() == "")
        {
            ev.preventDefault();
            $("#e-descripcion").removeClass("oculto");
        }
        else{
            $("#e-descripcion").addClass("oculto");
        }

        if($("#nombre").val() == "")
        {
            ev.preventDefault();
            $("#e-nombre").removeClass("oculto");
        }
        else{
            $("#e-nombre").addClass("oculto");
        }

        if($("#color").val() == "")
        {
            ev.preventDefault();
            $("#e-color").removeClass("oculto");
        }
        else{
            $("#e-color").addClass("oculto");
        }
        
        if($("#file-1").val() == "")
        {
            ev.preventDefault();
            $("#e-foto").removeClass("oculto");
        }
        else{
            $("#e-foto").addClass("oculto");
        }
  
    }


});


    