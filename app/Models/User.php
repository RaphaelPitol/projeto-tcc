<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\PasswordRestNotification;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable implements CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'permission',
        'password',
        'sobreNome',
        'nome_fantasia',
        'razao_social',
        'cpf',
        'cnpj',
        'cep',
        'telefone',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'id_imobiliaria',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function sendPasswordResetNotification($token): void
    {
        $url = 'http://localhost:8000/reset-password/' . $token;

        $this->notify(new PasswordRestNotification($url));
    }

    public function vistorias()
    {
        return $this->hasMany(Vistoria::class);
    }

    public function vistoriasVistoriador()
    {
        return $this->hasMany(Vistoria::class, 'id_vistoriador');
    }

}
