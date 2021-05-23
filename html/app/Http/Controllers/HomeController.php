<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\votacion\votos;
use Illuminate\Support\Facades\Auth;
use App\Models\votacion\votos as voto;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

      $Votacion = new voto;
      $IdUsuario = Auth::id();
      // $EmailUsuario = 'Auth::email()';
      $Candidatos = $Votacion->BuscaCandidatos();
      $Votante = $Votacion->BuscaVotantes($IdUsuario);
      $PassInit = $Votacion->TraeInitPass($IdUsuario);

      if($Votante[0]->votado == 0){
        $yavoto = $Votante[0]->votado;
      }
      else{
        $yavoto = 1;
      }

      if($PassInit[0]->init_pass == 0){
        $InitPass = $PassInit[0]->init_pass;
      }
      else{
        $InitPass = 1;
      }
      return view('home', ['Candidatos' => $Candidatos, 'yavoto'=> $yavoto, 'InitPass' => $InitPass, 'IdUsuario' => $IdUsuario]);
      //return view('home')->with('EmailUsuario', 'hola');
    }

    public function actualizaPass(Request $request)
    {

      $IdUsuario = Auth::id();
      $PassNew = request()->pass;

      $PassNewHash = bcrypt($PassNew);
      $Votacion = new voto;
      $ActualizacionPass= $Votacion->ActPass($IdUsuario, $PassNewHash);

      $Resultado = json_encode($ActualizacionPass);

      return $Resultado;
    }

}
