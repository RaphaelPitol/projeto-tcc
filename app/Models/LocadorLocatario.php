<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocadorLocatario extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'telefone',
        'rg',
        'cpf',
        'id_imobiliaria',
    ];

    public function vistorias()
    {
        return $this->hasMany(Vistoria::class);
    }
}
