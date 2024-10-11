<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vistoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_locador',
        'id_locatario',
        'id_imobiliaria',
        'id_vistoriador',
        'status',
        'nome',
        'cep',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'data_prazo'
    ];
}
