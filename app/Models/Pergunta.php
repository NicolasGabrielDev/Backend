<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
    use HasFactory;

    public function sessaos() {
        return $this->belongsTo(Sessao::class);
    }

    public function respostas() {
        return $this->hasMany(Resposta::class);
    }

    protected $fillable = [
        'enunciado',
        'quantidade',
        'tipo',
        'sessao_id'
    ];
}
