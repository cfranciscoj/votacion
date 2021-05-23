@extends('layouts.app')

@section('content')  <!-- div class="row justify-content-center" -->
<form id="form_votacion" method="post" action="{{ route('votado') }}">
    @csrf
    <input type="hidden" name="voto_a" id="voto_a" value="0">
    <input type="hidden" name="voto_b" id="voto_b" value="0">
    <input type="hidden" id="yaestavotado" value="{{ $yavoto }}">
    <input type="hidden" id="initpass" value="{{ $InitPass }}">
    <input type="hidden" id="RutaValidaCambioPass" value="{{ route('actpass')}}">
    
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-12 reset">
        <div class="card">
          <div class="card-header">
            <h3>Seleccione dos candidatos(as)</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12 reset">
                <div class="card">
                  <ul class="list-group list-group-flush">
                    @foreach($Candidatos as $key=>$Candidato)
                      <li class="list-group-item">
                        <!-- div class="custom-control custom-checkbox custom-control-inline" -->
                        <div class="custom-control  custom-checkbox custom-control-inline">
                          <input class="custom-control-input" type="checkbox" value="{{ $Candidato->id_candidato }}" name="lista_{{ $Candidato->id_candidato }}" id="lista_{{ $Candidato->id_candidato }}"/>
                          <label class="custom-control-label" for="lista_{{ $Candidato->id_candidato }}">{{ $Candidato->candidato }}  </label>
                        </div><!-- form-check -->
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div><!-- col-lg-12 -->
            </div><!-- row -->
            <div class="row d-flex flex-row-reverse bd-highlight">
              <div class="form-group col-lg-3">
                <label for="boton">&nbsp;</label>
                <!-- Button trigger modal -->
                <button type="button" id="votar"  class="btn btn-primary btn-block float-right" data-toggle="modal">Votar</button>
              </div>
              <div class="form-group col-lg-3">
                <label for="boton">&nbsp;</label>

                <a class="btn btn-secondary btn-block" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Salir') }}
                </a>

              </div>
            </div>
          </div><!--  card-body -->
        </div><!-- card -->
      </div><!-- col-lg-12 -->
    </div><!-- row -->
  </div><!-- container -->

  <div class="modal fade" id="confirmacionModal" tabindex="-1" role="dialog" aria-labelledby="confirmacionModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="confirmacionModalLabel">Elecciones 2021</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row justify-content-center">
            <div class="col-sm-12">
              <h2>Su voto será enviado. ¿Está seguro(a)? </h2>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col-lg-6">
              <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cerrar</button>
            </div>
            <div class="col-lg-6">
              <button type="button" id="votacion" class="btn btn-primary btn-block">Votar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="ValidaDatos" tabindex="-1" role="dialog" aria-labelledby="ValidaDatos" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="ValidaDatosModalLabel">Elecciones 2021</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row justify-content-center">
            <div class="col-sm-12">
              <h3>Debe seleccionar dos candidatos, si desea votar sólo por un candidato, seleccione <b>"Voto en blanco"</b> y <b>su candidato.</b></h3>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col-lg-12">
              <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="Votado" tabindex="-1" role="dialog" aria-labelledby="Votado" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="VotadoModalLabel">Elecciones</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row justify-content-center">
            <div class="col-sm-12">
              <h1>Su voto ya está ingresado, no puede votar nuevamente.</b></h1>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col-lg-12">
              <label for="boton">&nbsp;</label>
              <a class="btn btn-secondary btn-block" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  {{ __('Salir') }}
              </a>
              <!-- button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cerrar</button -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="InitPass" tabindex="-1" role="dialog" aria-labelledby="InitPass" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="InitPassModalLabel">Debe cambiar su contraseña</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row justify-content-center">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="pwd">Ingrese nueva contraseña:</label>
                <input type="password" class="form-control" id="pwd_001">
              </div>
              <div class="form-group">
                <label for="pwd">Rescriba su nueva contraseña:</label>
                <input type="password" class="form-control" id="pwd_002">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col-lg-12">
              <label for="boton">&nbsp;</label>
              <div class="col-lg-12">
                <button type="button" id="CambioPass" class="btn btn-primary btn-block">Cambiar</button>
              </div>
              <!-- button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cerrar</button -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="ValidaCambioPass" tabindex="-1" role="dialog" aria-labelledby="ValidaCambioPass" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="ValidaCambioPassModalLabel">Validación de contraseña</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row justify-content-center">
            <div class="col-sm-12">
              <h3>Las contraseñas deben ser iguales, distintas de vacio y mínimo de largo 8</h3>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col-lg-12">
              <label for="boton">&nbsp;</label>
              <div class="col-lg-12">
                <button type="button" id="ValidaPass" class="btn btn-primary btn-block" data-dismiss="modal">Aceptar</button>
              </div>
              <!-- button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cerrar</button -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</form>

@endsection

@section('css')
    <link href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}" rel="stylesheet">
@stop

@section('js')
    <script src="js/votacion/voto.js" defer></script>
@stop
