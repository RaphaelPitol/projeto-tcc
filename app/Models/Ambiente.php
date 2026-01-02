<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    use HasFactory;

    protected $fillable = [
        'vistoria_id',
        'nome_ambiente',
        'piso',
        'cons_piso',
        'observacao_piso',
        'rodape',
        'cons_rodape',
        'observacao_rodape',
        'parede',
        'cons_parede',
        'cor_parede',
        'cons_pintura_parede',
        'observacao_parede',
        'teto',
        'cons_teto',
        'cor_teto',
        'cons_pintura_teto',
        'observacao_teto',
        'porta',
        'cons_porta',
        'cor_porta',
        'cons_pintura_porta',
        'observacao_porta',
        'janela',
        'cons_janela',
        'cor_janela',
        'cons_pintura_janela',
        'observacao_janela',
        'observacoes',
        'detalhes'
    ];

    public function vistoria()
    {
        return $this->belongsTo(Vistoria::class);
    }

    public function fotos()
    {
        return $this->hasMany(AmbienteFoto::class)
                    ->orderBy('ordem');
    }
}
