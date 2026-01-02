<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmbienteFoto extends Model
{
    use HasFactory;
    protected $fillable = [
        'vistoria_id',
        'ambiente_id',
        'imagem',
        'ordem'
    ];

    public function vistoria()
    {
        return $this->belongsTo(Vistoria::class);
    }

    public function ambiente()
    {
        return $this->belongsTo(Ambiente::class);
    }
}
