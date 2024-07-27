<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cep',
        'logradouro',
        'cidade',
        'numero'
    ];

    public function vistorias()
    {
        return $this->hasMany(Vistoria::class);
    }
}
