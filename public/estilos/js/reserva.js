$(document).ready(function(){

    $("#reserva").click(function(){
        $.ajax( {
            url : '/login',
            type : 'post',
            dataType : 'text',
           
            } )
      });
    
    
});