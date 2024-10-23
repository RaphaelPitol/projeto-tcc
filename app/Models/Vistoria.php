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


    public function imobiliaria()
    {
        return $this->belongsTo(User::class, 'id_imobiliaria');
    }

    public function vistoriador()
    {
        return $this->belongsTo(User::class, 'id_vistoriador');
    }

    // Relacionamento com Locador e Locatário
    public function locador()
    {
        return $this->belongsTo(LocadorLocatario::class, 'id_locador');
    }

    public function locatario()
    {
        return $this->belongsTo(LocadorLocatario::class, 'id_locatario');
    }

}
