$( document ).ready(function() {


    $( "#subir" ).click(function(ev) {

        if($("#name").val() == "")
        {
            ev.preventDefault();
            $("#e-name").removeClass("oculto");
        }
        else{
            $("#e-name").addClass("oculto");
        }

        if($("#ap1").val() == "")
        {
            ev.preventDefault();
            $("#e-ap1").removeClass("oculto");
        }
        else{
            $("#e-ap1").addClass("oculto");
        }

    })


})