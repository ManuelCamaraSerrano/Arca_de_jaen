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

        if(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test($("#email").val()) == false ){
            ev.preventDefault();
            $("#e-email").removeClass("oculto");
        }
        else{
            $("#e-email").addClass("oculto");
        }


        if(/^(\+34 ?|0034 ?)((\d\d\d ?)(\d\d ?)(\d\d ?\d\d))|((\d\d\d ?)(\d\d\d ?)\d\d\d)$/.test($("#phone").val()) == false ){
            ev.preventDefault();
            $("#e-phone").removeClass("oculto");
        }
        else{
            $("#e-phone").addClass("oculto");
        }

    })


})