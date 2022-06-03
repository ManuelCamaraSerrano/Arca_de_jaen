$(document).ready(function(){


   // Array con las ciudades
   var ciudades = $("#color").attr("datos").split(",");

   $("#colores").css("border-bottom","none");  // Quitamos el borde

   // Controlamos el evento de cuando se deja de pulsar una tecla en la caja de texto
   $("#color").keyup(function(ev){

      $("#colores").css("border-bottom","solid 2px gray");  // Quitamos el borde

       if( ev.keyCode != 13 && ev.keyCode != 40 && ev.keyCode != 38 ){  // enter

          var valoresCiudad = $("#color").val();

          // Al principio vaciamos la lista de ciudades
          $("#colores").empty();

          // Si la caja de texto esta vacia vaciamos la lista de ciudades
          if( !valoresCiudad.length ){

             $("#colores").empty();

          }
          else{   // Sino vamos comprobando si por esa letra hay alguna ciudad
            
             var busquedas = valoresCiudad.split(",");


             coincidencias = buscarCoincidencias(busquedas,ciudades); // Buscamos las coincidencias

             
             coincidencias = ordenaCoincidencias(coincidencias,busquedas);  // Ordena las coincidencias


             var coincidenciasHtml = creaHtmlCoincidencia(busquedas,coincidencias);


             pintaCoincidencias(coincidenciasHtml);  // Función que crea una lista con las coincidencias, hay que pasarle un array
             

          }

       }
       
  }); 


  var contador = 0;  // Contador para ver el número de veces que se pulsa una tecla

  $("#color").keydown(function(ev){  // Controlar tecla escape para cerrar la lista y tecla hacia abajo para abrir


     if( ev.keyCode == 27 ){  // Escape

        $("#colores").css("display","none");  // Ocultamos la lista

        contador = 0;  // Reiniciamos el contador

     }


     if( ev.keyCode == 40 ){  // Flecha hacia bajo

       if( contador == 0 ){ // Si es 0

          $("#colores").css("display","block");  // Abrimos la lista

       }
       else{

          if($(".activo").attr("id")!="li"+($("#colores").children().length-1)){ // Si no es el último elemento cambiamos la clase activo al elemento de abajo

             $(".activo").attr("class","inactivo").next().attr("class","activo");

          }

       }

       contador = contador+1;  // Sumamos 1 al contador

     }


     if( ev.keyCode == 38 ){  // Flecha hacia arriba

       if($(".activo").attr("id")!="li0"){  // Si no es el primero

          $(".activo").attr("class","inactivo").prev().attr("class","activo");  // Cambiamos la clase activo al elemento de arriba

       }

     }


     if( ev.keyCode == 13 ){  // enter

      ev.preventDefault();

       if($("#colores").children().length){ // Si la lista no está vacía

          $("#color").val($(".activo").text());  // Cogemos el elemento que hay seleccionado y lo escribimos en el input

          $("#colores").empty(); // Vaciamos la lista

       } 

    }


  })


  function buscarCoincidencias(busquedas, array){

    var coincidencias = [];  // Array donde guardaremos las ocurrencias

    var tamanioBusquedas = busquedas.length;

    var tamanioArray = array.length;
    

    for( let j = 0; j < tamanioBusquedas; j++ )
    {

       if(busquedas[j] == ""){  // Si la string esta vacía pasamos al siguiente

          continue;

       }

       for( let i = 0; i < tamanioArray; i++ ){  // Con este bucle buscamos las ocurrencias y las añadimos a coincidencias

          if(array[i].indexOf(busquedas[j].trim()) != -1){   

             coincidencias.push(array[i]);

          }
       }

    }

    var CoincidenciasUnicas = coincidencias.filter((item,index)=>{  // Eliminamos los repetidos

       return coincidencias.indexOf(item) === index;

     })

    return CoincidenciasUnicas;

  }


  function pintaCoincidencias(coincidencias){

    var tamCoincidencias = coincidencias.length;

       for( let i = 0; i < tamCoincidencias; i++ ){

          if( i == 0 ){
 
             // Si existe una ciudad que contenga esas letras creamos un li y se lo añadimos a la lista, subrayando las coincidencias
             $("<li>").attr("class","activo").attr("id","li0").html(coincidencias[i]).click(function(){
 
                // Controlamos el click sobre el li y lo que hace es rellenar la caja de texto con el nombre de la ciudad que hemos pulsado
                $("#color").val($(this).text());
 
                $("#colores").empty();
 
             }).appendTo("#colores");
 
          }
          else{
 
             // Si existe una ciudad que contenga esas letras creamos un li y se lo añadimos a la lista
             $("<li>").attr("id","li"+i).html(coincidencias[i]).click(function(){
 
                // Controlamos el click sobre el li y lo que hace es rellenar la caja de texto con el nombre de la ciudad que hemos pulsado
                $("#color").val($(this).text());
 
                $("#colores").empty();
 
             }).appendTo("#colores");
 
          }
 
       }      

  }

  function creaHtmlCoincidencia(busquedas,coincidencias){

    var tamCoincidencias = coincidencias.length;


    var busquedasUnicas = busquedas.filter((item,index)=>{  // Eliminamos las busquedas repetidas

       return busquedas.indexOf(item) === index;

     })


     var tamBusquedasUni = busquedasUnicas.length;


    for( let i = 0; i < tamBusquedasUni; i++ )
    {

       if(busquedasUnicas[i] == ""){ // Si la string esta vacía pasamos al siguiente

          continue;

       }

       for( let j = 0; j < tamCoincidencias; j++ ){

          coincidencias[j] = coincidencias[j].replace(busquedasUnicas[i],"<span>"+busquedasUnicas[i]+"</span>");

       }

    }


    return coincidencias;

  }


  function ordenaCoincidencias(coincidencias,busquedas){


    for( let k = 0; k < coincidencias.length-1; k++ ){  // Ordenamos el array por ocurrencia


       for( let j = k+1; j < coincidencias.length; j++ ){


          if(coincidencias[k].indexOf(busquedas[0]) > coincidencias[j].indexOf(busquedas[0])){

             var t = coincidencias[k];

             coincidencias[k] = coincidencias[j];

             coincidencias[j] = t;

          }

          if(coincidencias[k].indexOf(busquedas[0]) == coincidencias[j].indexOf(busquedas[0])){

             if(coincidencias[k].toUpperCase() > coincidencias[j].toUpperCase()){

                var t = coincidencias[k];

                coincidencias[k] = coincidencias[j];

                coincidencias[j] = t;

             }  
             
          }


       }

    }

    return coincidencias;


  }



});