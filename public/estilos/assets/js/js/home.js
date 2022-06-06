$( document ).ready(function() {

    $.getJSON("/animalsRandom",{},
    function(data){

            $(".animal1").attr("href","/infoAnimal?a="+data[0][0]);
            $(".animal1 img").attr("src","estilos/assets/images/animals/"+data[0][2]);
            $(".nameAnimal1").text(data[0][1]);

            $(".animal2").attr("href","/infoAnimal?a="+data[1][0]);
            $(".animal2 img").attr("src","estilos/assets/images/animals/"+data[1][2]);
            $(".nameAnimal2").text(data[1][1]);

            $(".animal3").attr("href","/infoAnimal?a="+data[2][0]);
            $(".animal3 img").attr("src","estilos/assets/images/animals/"+data[2][2]);
            $(".nameAnimal3").text(data[2][1]);
    
    })

})