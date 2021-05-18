$(document).ready(function() {
  var yaestavotado = $('#yaestavotado').val();
  if (yaestavotado != 0){
    $('#Votado').modal('show');
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


});
