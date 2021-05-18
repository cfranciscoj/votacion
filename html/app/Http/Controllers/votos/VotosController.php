<?php

namespace App\Http\Controllers\votos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\votacion\votos as votos;

class VotosController extends Controller
{
    //
    public function recolecta(Request $request)
    {
      $CandidatoA = $request->input('voto_a');
      $CandidatoB = $request->input('voto_b');
      $IdUsuario = Auth::id();

      $Votacion = new votos;
      $Votante = $Votacion->BuscaVotantes($IdUsuario);

      if($Votante[0]->votado == 0){
        $Resultado = $Votacion->GuardaVoto($CandidatoA, $CandidatoB);
        $Resultado = $Votacion->GuardaVotante($IdUsuario);
        return view('votado',['yavoto'=> 0]);
      }
      else{
        return view('votado',['yavoto'=> 1]);
      }
    }
}
