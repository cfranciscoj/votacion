<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    //
//     public function BuscarPerfil($usuario){
//         $qry = <<<EOT
//         SELECT role FROM users u WHERE u.email  = "${$usuario}"
// EOT;
//       return DB::select($qry);
//     }


    public function hasRole($iduser, $role)
    {

      $Rol= new User;
      $Resultado = $Rol->BuscaRol($iduser, $role);
      if ($Resultado[0]->total == 1) {
          return true;
      }
      return false;
    }


    public function BuscaRol($iduser, $role)
    {
      $qry = <<<EOT
            SELECT count(1) as total
              FROM users usr
             WHERE usr.id = ${iduser}
               AND usr.role = '${role}';

EOT;
      return DB::select($qry);

    }


}
