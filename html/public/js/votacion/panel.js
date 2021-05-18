
$(document).ready(function() {
   var RutaResultadoEleccion = $('#RutaResultadoEleccion').val();
   var ResultadoEleccione;
   //console.log(RutaResultadoEleccion);
   $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      // En data puedes utilizar un objeto JSON, un array o un query string
      data: {},
      //Cambiar a type: POST si necesario
      type: "POST",
      // Formato de datos que se espera en la respuesta
      dataType: "json",
      // URL a la que se enviará la solicitud Ajax
      url: RutaResultadoEleccion,
      // syncronico
      async: false
      })
      .done(function( response, textStatus, jqXHR ) {
           //console.log(response);
           ResultadoEleccione = response;
      })
      .fail(function( jqXHR, textStatus, errorThrown ) {
           if ( console && console.log ) {
               console.log( "La solicitud a fallado: " +  textStatus);
               //$("#formulario-fila").hide();
           }
       })

       //console.log(ResultadoEleccione);
       //var arregloNombres = length(ResultadoEleccione);
   var arregloNombres = [];
   var arregloTotales = [];

       //arregloNombres = JSON.stringify(ResultadoEleccione.nombre_candidato);

       //console.log(totalnodos);
       //console.log(Object.keys(ResultadoEleccione));
   var i = 0;
   for (x of ResultadoEleccione) {
     //console.log(x.nombre_candidato + ' ' + x.total_votos);
     arregloNombres[i] = x.nombre_candidato ;
     arregloTotales[i] = x.total_votos;
     i++;
   }


   var areaChartData = {
      labels  : arregloNombres,
      datasets: [
        {
          label               : 'Candidatos',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : arregloTotales
        },
      ]
   }

   var barChartCanvas = $('#barChart').get(0).getContext('2d')
   var barChartData = $.extend(true, {}, areaChartData);
   var temp0 = areaChartData.datasets[0];
   barChartData.datasets[0] = temp0;

   //var temp1 = areaChartData.datasets[1];
   //barChartData.datasets[1] = temp0;

   var barChartOptions = {
     responsive              : true,
     maintainAspectRatio     : false,
     datasetFill             : false
   }

   new Chart(barChartCanvas, {
     type: 'bar',
     data: barChartData,
     options: barChartOptions
   });
});
