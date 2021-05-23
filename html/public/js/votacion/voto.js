$(document).ready(function() {
  var yaestavotado = $('#yaestavotado').val();
  if (yaestavotado != 0){
    $('#Votado').modal('show');
  }

  var initpass = $('#initpass').val();
  if (initpass != 1){
    $('#InitPass').modal('show');
  }


  $("#votacion").click(function(){
    //console.log("Hola Votacion");
    var votos=[];
    var i = 0;
    $('input:checkbox:checked').each(function(){

      // console.log("El checkbox con id " + $(this).attr('id') + " está seleccionado");
      console.log("El checkbox con valor " + $(this).val() + " está seleccionado");
      votos[i] =$(this).val();
      i = i + 1;
    });

    $("#voto_a").val(votos[0]);
    $("#voto_b").val(votos[1]);
    console.log("El checkbox con voto = " + votos[0] + " está seleccionado");
    console.log("El checkbox con voto = " + votos[1] + " está seleccionado");
    $("#form_votacion").submit();
  });

  $("#votar").click(function(){
    //console.log("Hola modal");
    var numberoDeCheckeados = $('input:checkbox:checked').length;

    if (numberoDeCheckeados == 2){
      $('#confirmacionModal').modal('show');
    }
    else{
      $('#ValidaDatos').modal('show');
    }
  });

  $("#CambioPass").click(function(){
    // const bcrypt = require('bcrypt');
    //console.log("Hola modal");
    var pass_001 = $('#pwd_001').val();
    var pass_002 = $('#pwd_002').val();
    var RutaValidaCambioPass = $('#RutaValidaCambioPass').val();
    var IdUser = $('#IdUser').val();
    var ResultadoCambioPass;

    if ( pass_001 !=  pass_002 || pass_001 == '' || pass_002 == '' || pass_001.length < 8 || pass_002.length < 8){
      $('#ValidaCambioPass').modal('show');
    } else {
      $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         // En data puedes utilizar un objeto JSON, un array o un query string
         data: {pass:pass_001},
         //Cambiar a type: POST si necesario
         type: "POST",
         // Formato de datos que se espera en la respuesta
         dataType: "json",
         // URL a la que se enviará la solicitud Ajax
         url: RutaValidaCambioPass,
         // syncronico
         async: false
         })
         .done(function( response, textStatus, jqXHR ) {
              //console.log(response);
              ResultadoCambioPass = response;
         })
         .fail(function( jqXHR, textStatus, errorThrown ) {
              if ( console && console.log ) {
                  console.log( "La solicitud a fallado: " +  textStatus);
                  //$("#formulario-fila").hide();
              }
          })


      $("#InitPass").modal('hide');
    }

  });


});
