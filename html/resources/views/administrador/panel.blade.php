@extends('adminlte::page')

@section('title', 'Votación')

@section('content_header')
    <h1>Votación</h1>
@stop

@section('content')


      <input type="hidden" id="RutaResultadoEleccion" name="RutaResultadoEleccion" value="{{ route('traevotos') }}"
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="far fa-chart-bar"></i>
                Resultados
              </h3>
              <div class="card-tools">
                 <button type="button" class="btn btn-tool" data-card-widget="collapse">
                   <i class="fas fa-minus"></i>
                 </button>

              </div>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="tab-content p-0 ">
                    <div class="chart">
                       <canvas id="barChart" style="min-height: 250px; height: 300px; max-height: 1000px; max-width: 100%;"></canvas>
                     </div>
                  </div>
                </div>
              <div class="col-md-4">
                  <p class="text-center">
                    <strong>Datos de la votación</strong>
                  </p>

                  <div class="progress-group">
                    Cuantos han votado
                    <span class="float-right"><b>{{ $CuantosHanVotado->total_votado }}</b>/{{ $TotalVotantes->total_votantes }}</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-primary" style= "width: {{ $PorcentajeVotantes }}%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->

                  <div class="progress-group">
                    Votos validos
                    <span class="float-right"><b>{{ $TotalVotos->total_votos }}</b>/{{ ($TotalVotantes->total_votantes)*2 }}</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-success" style="width: {{ $PorcentajeVotos }}%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
              </div>



            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>




@stop

@section('css')
    <!-- link rel="stylesheet" href="css/admin_custom.css" -->
@stop

@section('js')
    <script src="js/votacion/panel.js" defer></script>
@stop
