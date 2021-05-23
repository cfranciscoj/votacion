<?php

namespace App\Models\votacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class votos extends Model
{
    use HasFactory;

    public function BuscaCandidatos()
    {
      $qry = <<<EOT
            SELECT id_candidato     as id_candidato,
                   nombre_candidato as candidato
              FROM vto_candidatos;

EOT;
      return DB::select($qry);
    }

    public function GuardaVoto($CandidatoA, $CandidatoB)
    {
      DB::table('vto_votos')->insert([
          ['id_candidato' => $CandidatoA, 'fch_modificacion' => null],
          ['id_candidato' => $CandidatoB, 'fch_modificacion' => null],
      ]);

      return true;
    }


    public function GuardaVotante($IdUsuario)
    {
      DB::table('vto_votados')->insert([
          ['id_usuario' => $IdUsuario, 'fch_modificacion' => null],
      ]);

      return true;
    }


    public function BuscaVotantes($IdUsuario)
    {
      $qry = <<<EOT
            SELECT COUNT(1) AS votado
              FROM vto_votados
             WHERE id_usuario = ${IdUsuario};

EOT;
      return DB::select($qry);
    }

    public function BuscaVotosCandidatos()
    {
      $qry = <<<EOT
              SELECT vc.nombre_candidato    AS nombre_candidato,
                     COUNT(vv.id_candidato) AS total_votos
                FROM vto_votos vv
               RIGHT
                JOIN vto_candidatos vc
                  ON vv.id_candidato = vc.id_candidato
               GROUP
                  BY vc.nombre_candidato;

EOT;
      return DB::select($qry);
    }


    public function TotalVotantes()
    {
      $qry = <<<EOT
      SELECT COUNT(1) AS TotalVotantes
        FROM users u
       WHERE u.`role` = 'user';

EOT;
      return DB::select($qry);
    }



    public function TotalVotados()
    {
      $qry = <<<EOT
      SELECT COUNT(1) AS TotalVotados
        FROM vto_votados vv
EOT;
      return DB::select($qry);
    }


    public function TotalVotos()
    {
      $qry = <<<EOT
      SELECT COUNT(1) AS TotalVotos
        FROM vto_votos vv
EOT;
      return DB::select($qry);
    }

    public function TraeInitPass($IdUsuario)
    {
      $qry = <<<EOT
            SELECT u.init_pass AS init_pass
              FROM users u
             WHERE u.id = ${IdUsuario};

EOT;
      return DB::select($qry);
    }

    public function ActPass($IdUsuario, $Pass)
    {
      $affected = DB::table('users')
                     ->where('id', $IdUsuario)
                     ->update(['password' => $Pass, 'init_pass' => 1]);

      return $affected;
    }


    public function BuscaCuantosHanVotado()
    {
      $qry = <<<EOT
            SELECT COUNT(vv.id_votado) AS total_votado
              FROM vto_votados vv;
EOT;
      return DB::select($qry);
    }

    public function BuscaTotalVotantes()
    {
      $qry = <<<EOT
            SELECT COUNT(u.id) AS total_votantes
              FROM users u
             WHERE u.`role` = 'user';
EOT;
      return DB::select($qry);
    }


    public function BuscaTotalVotos()
    {
      $qry = <<<EOT
            SELECT COUNT(vv.id_voto) AS total_votos
              FROM vto_votos vv;
EOT;
      return DB::select($qry);
    }


}
