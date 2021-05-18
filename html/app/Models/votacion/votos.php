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

//     public function BuscaVotosCandidatos()
//     {
//       $qry = <<<EOT
//               SELECT vc.nombre_candidato    AS nombre_candidato,
//                      COUNT(vv.id_candidato) AS total_votos
//                 FROM vto_votos vv
//                RIGHT
//                 JOIN vto_candidatos vc
//                   ON vv.id_candidato = vc.id_candidato
//                GROUP
//                   BY vc.nombre_candidato;
//
// EOT;
//       return DB::select($qry);
//     } hola



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





}
