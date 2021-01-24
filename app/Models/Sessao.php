<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessao extends Model
{
    use HasFactory;

    public function perguntas() {
        return $this->hasMany(Pergunta::class);
    }

    public function respostas() {
        return $this->hasManyThrough(Resposta::class, Pergunta::class);
    }

    protected $fillable = [
        'nome',
        'codigo',
        'user_id'
    ];
}
