@extends('layouts.app')

@section('content')  <!-- div class="row justify-content-center" -->
  <input type="hidden" id="yaestavotado" value="{{ $yavoto }}">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12 reset">
        <div class="card">
          <div class="card-header">
            <h3>Su voto fue ingresado</h3>
          </div>
          <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-lg-12 justify-content-center">
                <p><h1>Gracias por participar en las elecciones 2021.</h1></p>
              </div><!-- col-lg-6 -->
            </div><!-- row -->
            <div class="row d-flex flex-row-reverse bd-highlight">
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

  <div class="modal fade" id="Votado" tabindex="-1" role="dialog" aria-labelledby="Votado" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Elecciones 2021</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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

@endsection

@section('css')
    <link href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}" rel="stylesheet">
@stop

@section('js')
    <script src="js/votacion/votado.js" defer></script>
@stop
