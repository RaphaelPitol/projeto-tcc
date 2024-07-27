<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vistoria extends Model
{
    use HasFactory;

    protected $filable =
    [
        'user_id',
        'locador_id',
        'locatario_id',
        'imovel_id',
        'date',
        'status'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function imovel()
    {
        return $this->belongsTo(Imovel::class);
    }

    public function locador()
    {
        return $this->belongsTo(LocadorLocatario::class, 'locador_id');
    }

    public function locatario()
    {
        return $this->belongsTo(LocadorLocatario::class, 'locatario_id');
    }
}
