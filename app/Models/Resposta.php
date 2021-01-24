<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    use HasFactory;

    public function perguntas() {
        return $this->belongsTo(Pergunta::class);
    }

    protected $fillable = [
        'resposta',
        'pergunta_id',
        'user_id',
    ];
}
