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

      if($Votante[0]->votado == 0){
        $yavoto = 0;
      }
      else{
        $yavoto = 1;
      }

      return view('home', ['Candidatos' => $Candidatos, 'yavoto'=> $yavoto]);
      //return view('home')->with('EmailUsuario', 'hola');


    }

}
