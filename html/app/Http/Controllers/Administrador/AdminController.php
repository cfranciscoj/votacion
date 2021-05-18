<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\votacion\votos as voto;


class AdminController extends Controller
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
    $IdUsuario = Auth::id();

    if (Auth::user()->hasRole($IdUsuario, 'admin')) {
        return redirect()->route('admin');
    } elseif (Auth::user()->hasRole($IdUsuario, 'manager')) {
        return redirect()->route('gestor');
    } elseif (Auth::user()->hasRole($IdUsuario, 'user')) {
        return redirect()->route('home');
    } else {
        return view('welcome');
    }
  }


  public function admin()
  {
    return view('administrador.panel');



  }

  public function gestor()
  {
    return view('dashboard');
  }

  public function traevotos()
  {
    $Votacion = new voto;
    $BuscaVotosCandidatos= $Votacion->BuscaVotosCandidatos();

    $ResultadoEleccion = json_encode($BuscaVotosCandidatos);

    return $ResultadoEleccion;
  }


}
